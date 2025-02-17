<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Http\Requests\Admin\Auth\RegisterVendorRequest;
use App\Http\Requests\Provider\RegisterRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\EducationDepartment;
use App\Models\Provider;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                    ->orWhere('user_type', 'vendor')
                    ->orWhere('user_type', 'provider');
            })->first();

        if (!$user) {
            return back()->withErrors(['email' => __('message.email_not_found')]);
        }
        if (!Hash::check($request->password, $user->password))
            return back()->withErrors(['password' => __('message.incorrect_password')]);

        auth('web')->login($user);

        if ($user->user_type == 'admin')
            return redirect()->route('admin.index');
        elseif ($user->user_type == 'vendor')
            return redirect()->route('vendor.home');
        else
            return redirect()->route('provider.index');
    }
    public function registerVendor()
    {
        $cities = City::all();
        $categories = Category::all();
        return view('admin.auth.register_vendor', compact('cities', 'categories'));
    }

    public function registerVendorStore(RegisterVendorRequest $request)
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
            'name' => $request->name_of_brand,
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
        return redirect()->route('vendor.home');
    }

    public function registerprovider()
    {
        $educationDepartments = EducationDepartment::all();
        return view('admin.auth.register_provider', compact('educationDepartments'));
    }

    public function registerProviderStore(RegisterRequest $request)
    {
        $image = null;

        if ($request->image)
            $image = Helpers::addImage($request->image, 'user');

        $logo = Helpers::addImage($request->logo, 'logo');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'image' => $image ?? null,
            'user_type' => 'provider',
            'status' => 'active',
            'city_id' => null,
        ]);

        $provider = Provider::create([
            'name_arabic' => $request->name_of_school_arabic,
            'name_english' => $request->name_of_school_english,
            'logo' => $logo,
            'whatsapp' => $request->whatsapp ?? null,
            'facebook' => $request->facebook ?? null,
            'instagram' => $request->instagram ?? null,
            'address' => $request->address ?? null,
            'status' => 'pending',
            'user_id' => $user->id,
        ]);

        foreach ($request->educational_department_id as $departmentId) {
            DB::table('education_department_provider')->insert([
                'education_department_id' => $departmentId,
                'provider_id' => $provider->id,
            ]);
        }

        auth('web')->login($user);

        return redirect()->route('provider.index');
    }

    public function logout()
    {
        auth('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
