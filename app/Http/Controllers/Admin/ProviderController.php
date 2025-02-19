<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Provider\StoreProviderRequest;
use App\Http\Requests\Admin\Provider\UpdateProviderRequest;
use App\Models\EducationDepartment;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('user_type', 'provider')->paginate(10);

        return view('admin.provider.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $educationDepartments = EducationDepartment::all();
        return view('admin.provider.create', compact('educationDepartments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProviderRequest $request)
    {
        $image = Helpers::addImage($request->image, 'user');
        $logo = Helpers::addImage($request->logo, 'logo');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'image' => $image,
            'user_type' => 'provider',
            'status' => $request->account_status,
        ]);

        $provider = Provider::create([
            'name_arabic' => $request->name_of_school_arabic,
            'name_english' => $request->name_of_school_english,
            'logo' => $logo,
            'address' => $request->address,
            'whatsapp' => $request->whatsapp ?? null,
            'facebook' => $request->facebook ?? null,
            'instagram' => $request->instagram ?? null,
            'status' => $request->provider_status,
            'user_id' => $user->id,
        ]);

        foreach ($request->educational_department_id as $departmentId)
            DB::table('education_department_provider')->insert([
                'education_department_id' => $departmentId,
                'provider_id' => $provider->id,
            ]);

        return redirect()->route('admin.providers.index')->with('success', __('message.Provider Added Successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $provider = Provider::with(['user'])->findOrFail($id);
        $educationDepartments = EducationDepartment::all();

        return view('admin.provider.edit', compact('provider', 'educationDepartments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProviderRequest $request, string $id)
    {
        $provider = Provider::findOrFail($id);
        $image = $request->image ? $request->image : $provider->user->image;
        $logo = $request->logo ? Helpers::addImage($request->logo, 'logo') : $provider->logo;

        if ($request->image) {
            if (File::exists($provider->user->image)) {
                File::delete($provider->user->image);
            }
            $image = Helpers::addImage($request->image, 'user');
        }

        if ($request->logo) {
            if (File::exists($provider->logo)) {
                File::delete($provider->logo);
            }
            $image = Helpers::addImage($request->logo, 'logo');
        }

        $provider->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'image' => $image,
            'user_type' => 'provider',
            'status' => $request->account_status,
        ]);

        $provider->update([
            'name_arabic' => $request->name_of_school_arabic,
            'name_english' => $request->name_of_school_english,
            'logo' => $logo,
            'address' => $request->address,
            'whatsapp' => $request->whatsapp ?? null,
            'facebook' => $request->facebook ?? null,
            'instagram' => $request->instagram ?? null,
            'status' => $request->provider_status,
            'user_id' => $provider->user->id,
        ]);

        DB::table('education_department_provider')->where('provider_id', $provider->id)->delete();

        foreach ($request->educational_department_id as $departmentId)
            DB::table('education_department_provider')->insert([
                'education_department_id' => $departmentId,
                'provider_id' => $provider->id,
            ]);

        return redirect()->route('admin.providers.index')->with('success', __('message.Provider Edit Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $provider = Provider::findOrFail($id);

        $provider->user->delete();

        DB::table('education_department_provider')->where('provider_id', $provider->id)->delete();

        $provider->delete();

        return redirect()->route('admin.providers.index')->with('success', __('message.Provider Deleted Successfully'));
    }
}
