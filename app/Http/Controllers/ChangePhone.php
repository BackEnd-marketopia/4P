<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\OtpService;

class ChangePhone extends Controller
{
    public $otpService;
    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }
    public function index()
    {
        return view("change-phone");
    }
    public function getNewPhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required | digits:11 | regex:/^01\d{9}$/ | unique:users,phone',
        ]);
        if ($validator->fails())
            return redirect()->back()->with('error', $validator->errors()->first());

        session(['newPhone' => $request->phone]);
        return redirect()->route('profile.verify');
    }
    public function verify()
    {
        $attempts = cache()->get('otp_attempts_' . session('newPhone'), 0);
        if ($attempts >= 5)
            return redirect()->back()->with('error', __('message.too_many_attempts'));

        cache()->put('otp_attempts_' . session('newPhone'), $attempts + 1, now()->addMinutes(30));

        $otp = $this->otpService->generateAndSend(session('newPhone'));
        if (!$otp['success'])
            return redirect()->back()->with('error', __('message.otp_failed'));
        return view('verify');
    }
    public function resendCode()
    {
        $attempts = cache()->get('otp_attempts_' . session('newPhone'), 0);
        if ($attempts >= 5)
            return redirect()->back()->with('error', __('message.too_many_attempts'));

        cache()->put('otp_attempts_' . session('newPhone'), $attempts + 1, now()->addMinutes(30));

        $phone = session('newPhone');

        $otp = $this->otpService->generateAndSend($phone);
        if (!$otp['success'])
            return redirect()->back()->with('error', __('message.otp_failed'));
        return redirect()->route('profile.verify')->with('success', __('message.otp_sent'));
    }
    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:4|numeric'
        ]);
        if (!$this->otpService->verify(session('newPhone'), $request->code))
            return redirect()->back()->with('error', __('message.otp_failed'));

        $user = auth('web')->user();
        $user->phone = session('newPhone');
        $user->email_verified_at = now();
        $user->save();

        session()->forget('newPhone');
        if ($user->user_type == 'admin')
            return redirect()->route('admin.index');
        elseif ($user->user_type == 'vendor')
            return redirect()->route('vendor.home');
        else
            return redirect()->route('provider.index');
    }
}
