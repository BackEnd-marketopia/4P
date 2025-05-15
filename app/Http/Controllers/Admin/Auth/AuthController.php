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
use App\Services\OtpService;

class AuthController extends Controller
{
    public $otpService;
    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }
    public function login()
    {
        return view('admin.auth.login');
    }
    public function verifyView()
    {
        return view('admin.auth.verify');
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
        if ($user->status != 'active')
            return back()->withErrors(['email' => __('message.You Are Blocked Now')]);
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

        $formData = $request->except(['image', 'logo', 'cover']);
        $formData['image'] = $image;
        $formData['logo'] = $logo;
        $formData['cover'] = $cover;
        $formData['user_type'] = 'vendor';
        $formData['status'] = 'pending';
        session(['vendor_registration_data' => $formData]);
        $otp = $this->otpService->generateAndSend((string)$request->phone);
        if (!$otp['success'])
            return redirect()->route('register.vendor')->with('error', __('message.otp_send_failed'));

        $formData['code'] = $otp['code'];
        session(['userType' => 'vendor']);
        return redirect()->route('verifyView');
    }
    public function verifyVendorStore(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);

        $formData = session('vendor_registration_data');

        if (!$this->otpService->verify($formData['phone'], $request->code))
            return redirect()->route('verifyView')->with('error', __('message.otp_verification_failed'));

        $user = User::create([
            'name' => $formData['name'],
            'email' => $formData['email'],
            'phone' => $formData['phone'],
            'password' => Hash::make($formData['password']),
            'image' => $formData['image'] ?? null,
            'user_type' => 'vendor',
            'status' => 'active',
            'city_id' => $formData['city_ids'][0],
            'email_verified_at' => now(),
        ]);

        $cities = json_encode($formData['city_ids']);

        Vendor::create([
            'name' => $formData['name_of_brand'],
            'logo' => $formData['logo'] ?? null,
            'cover' => $formData['cover'] ?? null,
            'description' => $formData['description'],
            'whatsapp' => $formData['whatsapp'] ?? null,
            'facebook' => $formData['facebook'] ?? null,
            'instagram' => $formData['instagram'] ?? null,
            'address' => $formData['address'] ?? null,
            'status' => 'pending',
            'google_map_link' => $formData['google_map_link'] ?? null,
            'citys_id' => $cities,
            'category_id' => $formData['category_id'],
            'user_id' => $user->id,
        ]);
        auth('web')->login($user);
        session()->forget('vendor_registration_data');

        return redirect()->route('vendor.home');
    }
    public function resendVerificationCode()
    {
        $maxAttempts = 5;
        $attempts = cache()->get('resend_attempts_' . session('vendor_registration_data')['phone'], 0);

        if ($attempts >= $maxAttempts)
            return redirect()->route('verifyView')
                ->with('error', __('message.max_resend_attempts_reached'));

        cache()->put('resend_attempts_' . session('vendor_registration_data')['phone'], $attempts + 1, now()->addMinutes(30));

        if (!session('vendor_registration_data'))
            return redirect()->route('verifyView')->with('error', __('message.otp_send_failed'));

        $otp = $this->otpService->generateAndSend(session('vendor_registration_data')['phone']);

        if (!$otp['success'])
            return redirect()->route('verifyView')->with('error', __('message.otp_send_failed'));

        if (!$this->otpService->verify(session('vendor_registration_data')['phone'], $otp['code']))
            return redirect()->route('verifyView')->with('error', __('message.otp_verification_failed'));

        return redirect()->route('verifyView')->with('success', __('message.otp_send_success'));
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

        $formData = $request->except(['image', 'logo']);
        $formData['image'] = $image;
        $formData['logo'] = $logo;
        $formData['user_type'] = 'provider';
        $formData['status'] = 'pending';

        session(['provider_registration_data' => $formData]);

        $otp = $this->otpService->generateAndSend((string)$request->phone);

        if (!$otp['success'])
            return redirect()->route('register.provider')->with('error', __('message.otp_send_failed'));

        $formData['code'] = $otp['code'];
        session(['userType' => 'provider']);
        return redirect()->route('verifyView');
    }

    public function verifyProviderStore(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);

        $formData = session('provider_registration_data');

        if (!$this->otpService->verify($formData['phone'], $request->code))
            return redirect()->route('verifyView')->with('error', __('message.otp_verification_failed'));

        $user = User::create([
            'name' => $formData['name'],
            'email' => $formData['email'],
            'phone' => $formData['phone'],
            'password' => Hash::make($formData['password']),
            'image' => $formData['image'] ?? null,
            'user_type' => 'provider',
            'status' => 'active',
            'city_id' => null,
            'email_verified_at' => now(),
        ]);

        $provider = Provider::create([
            'name_arabic' => $formData['name_of_school_arabic'],
            'name_english' => $formData['name_of_school_english'],
            'logo' => $formData['logo'] ?? null,
            'whatsapp' => $formData['whatsapp'] ?? null,
            'facebook' => $formData['facebook'] ?? null,
            'instagram' => $formData['instagram'] ?? null,
            'address' => $formData['address'] ?? null,
            'status' => 'pending',
            'user_id' => $user->id,
        ]);

        foreach ($formData['educational_department_id'] as $departmentId) {
            DB::table('education_department_provider')->insert([
                'education_department_id' => $departmentId,
                'provider_id' => $provider->id,
            ]);
        }

        auth('web')->login($user);

        session()->forget('provider_registration_data');

        return redirect()->route('provider.index');
    }
    public function providerResendVerificationCode()
    {
        $maxAttempts = 5;
        $attempts = cache()->get('resend_attempts_' . session('provider_registration_data')['phone'], 0);

        if ($attempts >= $maxAttempts)
            return redirect()->route('verifyView')
                ->with('error', __('message.max_resend_attempts_reached'));

        cache()->put('resend_attempts_' . session('provider_registration_data')['phone'], $attempts + 1, now()->addMinutes(30));

        if (!session('provider_registration_data'))
            return redirect()->route('verifyView')->with('error', __('message.otp_send_failed'));

        $otp = $this->otpService->generateAndSend(session('provider_registration_data')['phone']);

        if (!$otp['success'])
            return redirect()->route('verifyView')->with('error', __('message.otp_send_failed'));

        if (!$this->otpService->verify(session('provider_registration_data')['phone'], $otp['code']))
            return redirect()->route('verifyView')->with('error', __('message.otp_verification_failed'));

        return redirect()->route('verifyView')->with('success', __('message.otp_send_success'));
    }
    public function resetPassword()
    {
        return view('admin.auth.reset-password');
    }
    public function resetPasswordCode(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);

        $user = User::where('phone', $request->phone)
            ->where(function ($query) {
                $query->where('user_type', 'provider')
                    ->orWhere('user_type', 'vendor');
            })->first();
        if (!$user)
            return back()->with('error', __('message.phone_not_found'));

        $otp = $this->otpService->generateAndSend((string)$request->phone);
        if (!$otp['success'])
            return back()->with('error', __('message.otp_send_failed'));

        session(['phone' => $request->phone]);
        return redirect()->route('verifyChangePassword');
    }
    public function verifyChangePassword()
    {
        return view('admin.auth.verify-password');
    }
    public function newPassword()
    {
        return view('admin.auth.new-password');
    }
    public function verifyChangePasswordStore(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);
        $maxAttempts = 5;
        $phone = session('phone');
        $attempts = cache()->get('resend_attempts_' . $phone, 0);

        if ($attempts >= $maxAttempts) {
            return redirect()->route('verifyView')
                ->with('error', __('message.max_resend_attempts_reached'));
        }

        cache()->put('resend_attempts_' . $phone, $attempts + 1, now()->addMinutes(30));

        if (!$this->otpService->verify($phone, $request->code))
            return redirect()->route('verifyView')->with('error', __('message.otp_verification_failed'));
        return redirect()->route('newPassword');
    }
    public function passwordResendCode()
    {
        $maxAttempts = 5;
        $attempts = cache()->get('resend_attempts_' . session('phone'), 0);

        if ($attempts >= $maxAttempts)
            return redirect()->route('verifyChangePassword')
                ->with('error', __('message.max_resend_attempts_reached'));

        cache()->put('resend_attempts_' . session('phone'), $attempts + 1, now()->addMinutes(30));

        if (!session('phone'))
            return redirect()->route('verifyChangePassword')->with('error', __('message.otp_send_failed'));

        $otp = $this->otpService->generateAndSend(session('phone'));

        if (!$otp['success'])
            return redirect()->route('verifyChangePassword')->with('error', __('message.otp_send_failed'));

        if (!$this->otpService->verify(session('phone'), $otp['code']))
            return redirect()->route('verifyChangePassword')->with('error', __('message.otp_verification_failed'));

        return redirect()->route('verifyChangePassword')->with('success', __('message.otp_send_success'));
    }
    public function newPasswordStore(Request $request)
    {
        if (!session('phone'))
            return redirect()->route('login')->with('error', __('message.Error'));

        $validator = \Illuminate\Support\Facades\Validator::make(
            $request->all(),
            [
                'password' => 'required | min:8 | regex:/[A-Za-z]/ | regex:/[0-9]/ | confirmed',
            ]
        );
        if ($validator->fails())
            return back()->with('error', $validator->errors()->first());
        $user = User::where('phone', session('phone'))
            ->where(function ($query) {
                $query->where('user_type', 'provider')
                    ->orWhere('user_type', 'vendor');
            })->first();
        if (!$user)
            return back()->with('error', __('message.phone_not_found'));
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        session()->forget('phone');
        return redirect()->route('login')->with('success', __('message.password_changed'));
    }
    public function logout()
    {
        auth('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
