<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\City;
use App\Models\Code;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(['code'])->where('user_type', 'user')->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        return view('admin.user.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $image = $request->image ? Helpers::addImage($request->image, 'user') : null;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email ?? null,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'image' => $image,
            'user_type' => 'user',
            'status' => 'active',
            'city_id' => $request->city_id,
        ]);
        if ($request->one_year) {
            $code = Code::where('user_id',  null)->first();
            if ($code) {
                $code->update([
                    'user_id' => $user->id,
                    'start_date' => now(),
                    'end_date' => now()->addYear(),
                ]);
            }
        } elseif ($request->start_date != null && $request->end_date != null) {
            $code = Code::where('user_id', null)->first();
            if ($code) {
                $code->update([
                    'user_id' => $user->id,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                ]);
            }
        }
        return redirect()->route('admin.users.index')->with('success', __('message.User Added Successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = user::findOrFail($id);
        $cities = City::all();
        return view('admin.user.edit', compact('user', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $image = $request->image ? Helpers::addImage($request->image, 'user') : $user->image;

        $user->update([
            'name' => $request->name,
            'email' => $request->email ?? null,
            'phone' => $request->phone,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'image' => $image,
            'user_type' => 'user',
            'status' => $request->status,
            'city_id' => $request->city_id,
        ]);

        if ($request->one_year) {
            $code = Code::where('user_id',  null)->first();
            if ($code) {
                $code->update([
                    'user_id' => $user->id,
                    'start_date' => now(),
                    'end_date' => now()->addYear(),
                ]);
            }
        } elseif ($request->start_date != null && $request->end_date != null) {
            $code = Code::where('user_id', null)->first();
            if ($code) {
                $code->update([
                    'user_id' => $user->id,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                ]);
            }
        }
        return redirect()->route('admin.users.index')->with('success', __('message.User Edit Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', __('message.User Deleted Successfully'));
    }
}
