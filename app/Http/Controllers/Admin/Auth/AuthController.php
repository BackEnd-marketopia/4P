<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Http\Requests\Admin\Auth\RegisterRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginStore(LoginRequest $request)
    {
        $user = User::where('email', $request->email)
            ->where(function ($query) {
                $query->where('user_type', 'admin')
                    ->orWhere('user_type', 'vendor');
            })->first();

        if (!$user) {
            return back()->withErrors(['email' => __('message.email_not_found')]);
        }
        if (!Hash::check($request->password, $user->password))
            return back()->withErrors(['password' => __('message.incorrect_password')]);

        auth('web')->login($user);

        if ($user->user_type == 'admin')
            return redirect()->route('admin.index');
        else
            return redirect()->route('vendor.index');
    }
    public function register()
    {
        $cities = City::all();
        $categories = Category::all();
        return view('admin.auth.register', compact('cities', 'categories'));
    }

    public function registerStore(RegisterRequest $request)
    {
        $image = null;
        if ($request->image)
            $image = Helpers::addImage($request->image, 'user');

        $logo = Helpers::addImage($request->logo, 'logo');
        $cover = Helpers::addImage($request->cover, 'cover');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'image' => $image ?? null,
            'user_type' => 'vendor',
            'status' => 'active',
            'city_id' => $request->city_ids[0],
        ]);

        $cities = json_encode($request->city_ids);

        Vendor::create([
            'logo' => $logo ?? null,
            'cover' => $cover ?? null,
            'description' => $request->description,
            'whatsapp' => $request->whatsapp ?? null,
            'facebook' => $request->facebook ?? null,
            'instagram' => $request->instagram ?? null,
            'address' => $request->address,
            'status' => 'pending',
            'google_map_link' => $request->google_map_link ?? null,
            'citys_id' => $cities,
            'category_id' => $request->category_id,
            'user_id' => $user->id,
        ]);
        auth('web')->login($user);
        return redirect()->route('admin.index');
    }

    public function logout()
    {
        auth('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
