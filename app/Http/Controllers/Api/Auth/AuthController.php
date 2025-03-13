<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Helpers;
use App\Http\Requests\Api\Profile\UpdatePofileRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;
use App\Models\City;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        if ($request->image) {
            $image = Helpers::addImage($request->image, 'user');
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email ?? null,
            'phone'    => $request->phone,
            'code'     => $request->code ?? null,
            'image'    => $image ?? null,
            'password' => Hash::make($request->password),
            'city_id'  => $request->city_id,
            'fcm_token' => $request->fcmToken ?? null,
        ]);
        $token = JWTAuth::fromUser($user);
        $user->load(['code']);
        return Response::api(__('message.user_registered_success'), 200, true, null, ['user' => $user, 'token' => $token]);
    }

    public function login(LoginRequest $request)
    {
        if (!$request->email && !$request->phone)
            return Response::api(__('message.email_or_phone_required'), 400, false, 400);

        $user = User::with(['code'])->where($request->email ? 'email' : 'phone', $request->email ? $request->email : $request->phone)
            ->first();

        if (!$user)
            return Response::api(__('message.invalid_credentials'), 400, false, 400);

        $credentials = [
            'password' => $request->password,
        ];
        if ($request->email)
            $credentials['email'] = $request->email;
        elseif ($request->phone)
            $credentials['phone'] = $request->phone;

        if (!$token = auth('api')->attempt($credentials))
            return Response::api(__('message.incorrect_password'), 400, false, 400);

        if ($user->status != 'active')
            return Response::api(__('message.You Are Blocked Now'), 400, false, 400);
        $user->update([
            'fcm_token' => $request->fcmToken ?? null,
        ]);

        return Response::api(__('message.login_success'), 200, true, null, [
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout()
    {
        if (JWTAuth::getToken()) {
            JWTAuth::invalidate(JWTAuth::getToken());
            return Response::api(__('message.logout_success'), 200, true, null);
        }

        return Response::api(__('message.token_not_found'), 404, false, 404);
    }

    public function profile()
    {
        $user = User::findOrFail(auth('api')->user()->id);
        $user->load(['code']);
        return Response::api(__('message.Success'), 200, true, null, $user);
    }

    public function profileUpdate(UpdatePofileRequest $request)
    {
        $user = auth('api')->user();
        $image = $request->image ? $request->image : $user->image;
        $password = $request->password &&
            !Hash::check($request->password, $user->password)
            ? Hash::make($request->password)
            : $user->password;

        if ($request->image) {
            if (File::exists($user->image)) {
                File::delete($user->image);
            }
            $image = Helpers::addImage($request->image, 'user');
        }
        $city = City::find($request->city_id);

        if (!$city)
            return Response::api(__('message.city_not_found'), 404, false, 404);

        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => $password,
            'image'    => $image,
            'city_id'  => $request->city_id,
        ]);
        return Response::api(__('message.Profile Updated Successfully'), 200, true, null, $user);
    }

    public function deleteAccount()
    {
        $user = auth('api')->user();

        if (($user->user_type == 'admin' && $user->id == 1) || $user->user_type == 'vendor' || $user->user_type == 'provider')
            return Response::api(__("message.Can't delete This Account"), 403, false, 403);

        $user->delete();

        return Response::api(__('message.Account Deleted Successfully'), 200, true, null);
    }
}
