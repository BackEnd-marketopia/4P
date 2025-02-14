<?php

namespace App\Http\Controllers\Vendor;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\UpdatePofileRequest;
use App\Http\Requests\Vendor\Profile\UpdateProfileRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function home()
    {
        $vendor = Vendor::with(['discounts'])->where('user_id', auth('web')->id())->first();
        return view('vendor.home', compact('vendor'));
    }

    public function pending()
    {
        return view('vendor.pending');
    }

    public function rejected()
    {
        return view('vendor.rejected');
    }

    public function account()
    {
        return view('vendor.account');
    }

    public function accountSotre(UpdatePofileRequest $request)
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
        return redirect()->route('vendor.account')->with('success', __('message.Profile Updated Successfully'));
    }

    public function profile()
    {
        $user = auth('web')->user();
        $categories = Category::all();
        $cities = City::all();
        return view('vendor.profile', compact('user', 'categories', 'cities'));
    }

    public function profileSotre(UpdateProfileRequest $request)
    {
        $user = auth('web')->user();
        $logo = $request->logo ? Helpers::addImage($request->logo, 'logo') : $user->vendor->logo;
        $cover = $request->cover ? Helpers::addImage($request->cover, 'cover') : $user->vendor->cover;
        $cities = json_encode($request->city_ids);

        $user->vendor->update([
            'name' => $request->name_of_brand,
            'logo' => $logo,
            'cover' => $cover,
            'description' => $request->description,
            'whatsapp' => $request->whatsapp ?? null,
            'facebook' => $request->facebook ?? null,
            'instagram' => $request->instagram ?? null,
            'address' => $request->address,
            'google_map_link' => $request->google_map_link ?? null,
            'citys_id' => $cities,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('vendor.home')->with('success', __('message.Profile Edit Successfully'));
    }
}
