<?php

namespace App\Http\Controllers\Provider;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Profile\UpdatePofileRequest;
use App\Http\Requests\Provider\ProfileRequest;
use App\Models\ClassRoom;
use App\Models\EducationDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        $classRooms = ClassRoom::with(['educationDepartment'])
            ->where('provider_id', auth('web')->user()->provider->id)
            ->get();

        return view('provider.home', compact('classRooms'));
    }

    public function account()
    {
        $user = auth('web')->user();

        return view('provider.account', compact('user'));
    }

    public function accountStore(UpdatePofileRequest $request)
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
        return redirect()->route('provider.account')->with('success', __('message.Profile Updated Successfully'));
    }

    public function profile()
    {
        $user = auth('web')->user()->provider;
        $educationDepartments = EducationDepartment::all();
        $educationDepartmentOfUser = $user->educationDepartments;

        return view('provider.profile', compact('user', 'educationDepartments', 'educationDepartmentOfUser'));
    }

    public function profileStore(ProfileRequest $request)
    {
        $provider = auth('web')->user()->provider;
        $logo = $request->logo ? $request->logo : $provider->logo;
        if ($request->logo) {
            if (File::exists($provider->logo)) {
                File::delete($provider->logo);
            }
            $logo = Helpers::addImage($request->logo, 'logo');
        }
        $provider->update([
            'name_of_school_arabic' => $request->name_of_school_arabic,
            'name_of_school_english' => $request->name_of_school_english,
            'logo' => $logo,
            'address' => $request->address ?? null,
            'whatsapp' => $request->whatsapp ?? null,
            'facebook' => $request->facebook ?? null,
            'instagram' => $request->instagram ?? null,
        ]);

        DB::table('education_department_provider')->where('provider_id', $provider->id)->delete();

        foreach ($request->educational_department_id as $departmentId) {
            DB::table('education_department_provider')->insert([
                'education_department_id' => $departmentId,
                'provider_id' => $provider->id,
            ]);
        }
        return redirect()->back()->with('success', __('message.Profile Updated Successfully'));
    }
}
