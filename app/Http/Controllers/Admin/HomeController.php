<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\UpdatePofileRequest;
use App\Models\User;
use App\Models\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::where('user_type', 'user')->count();
        $vendors = User::where('user_type', 'vendor')->count();
        $providers = User::where('user_type', 'provider')->count();
        $codesPaied = Code::where('user_id', '!=', null)->count();
        $codesUnpaied = Code::where('user_id', null)->count();
        return view('admin.index', compact('users', 'vendors', 'providers', 'codesPaied', 'codesUnpaied'));
    }
    public function profileMe()
    {
        return view('admin.profile');
    }

    public function profileMeSotre(UpdatePofileRequest $request)
    {
        $user = auth('web')->user();
        $image = $request->image ? $request->image : $user->image;
        $password = $request->password ? Hash::make($request->password) : $user->password;
        if ($request->image) {
            if (File::exists($user->image)) {
                File::delete($user->image);
            }
            $image = Helpers::addImage($request->image, 'user');
        }
        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => $password,
            'image'    => $image,
        ]);
        return redirect()->route('admin.profileMe');
    }
}
