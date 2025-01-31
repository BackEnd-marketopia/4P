<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\UpdatePofileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.index');
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
