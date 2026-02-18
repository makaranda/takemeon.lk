<?php

namespace App\Http\Controllers\admin;

use App\Helpers\SmsHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        //dd($admin);
         if (!empty($admin->role) && $admin->id > 0) {
               //dd($admin);
             return redirect()->route('admin.dashboard');
         } else {
            return view('pages.frontend.login.index');
        }
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function userLogin()
    {
        return view('pages.frontend.userlogin.index');
    }

    public function userResetPassword(Request $request)
    {
        $request->validate([
            'formResetPwd' => 'required|string|max:255',
        ]);

        $input = $request->input('formResetPwd');
        $user = User::where('email', $input)
                    ->orWhere('username', $input)
                    ->first();

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User not found.']);
        }
        // Generate 6-digit OTP
        $otp = rand(100000, 999999);
        SmsHelper::sendOtp($user->phone, $otp);

        // Save OTP in cache or DB
        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(5);
        $user->save();

        // Simulate SMS sending (replace with actual SMS gateway)
        // You should replace this with your SMS API (e.g. Twilio, Nexmo, etc.)
        Log::info("OTP for {$user->phone}: $otp");

        return response()->json([
            'status' => 'otp_sent',
            'message' => 'OTP sent to registered phone number.',
            'user_id' => $user->id
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);

        if (!$user || $user->otp != $request->otp || now()->gt($user->otp_expires_at)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid or expired OTP.']);
        }

        // Generate new random password
        $newPassword = Str::random(8);
        SmsHelper::send($user->phone, "Hi,\nyour new password is: {$newPassword}\n\nThanks,\nEcommerce Team");
        $user->password = Hash::make($newPassword);
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        // Simulate SMS sending of new password (replace with actual gateway)
        Log::info("New password for {$user->phone}: $newPassword");

        return response()->json(['status' => 'success', 'message' => 'New password has been sent to your phone.']);
    }


    public function userLoginSubmit(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $login = $request->input('username');
        $password = $request->input('password');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$fieldType => $login, 'password' => $password])) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }elseif (Auth::user()->role === 'candidate') {
                //echo 'test 1'.Auth::user()->role;
                return redirect()->route('candidate.dashboard');
            }
            //else{
                //echo 'test 2';
                //return redirect()->route('frontend.userlogin');
            //}
        }

        return back()->withErrors(['username' => 'Invalid Credentials']);
    }

    public function userRegister()
    {
        return view('pages.frontend.userregister.index');
    }
    public function userRegisterSubmit(Request $request)
    {
        $loginURL = route('frontend.userlogin');
        $otp = rand(100000, 999999);

        $request->validate([
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'nullable|max:20',
            'address' => 'nullable|max:150',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password',
        ]);
        //dd($request->all());
        if (User::where('username', $request->username)->exists()) {
            return redirect()->back()->withErrors(['username' => 'Username already exists.']);
        }
        $user = User::create([
            'name' => $request->full_name ?? 'User',
            'username' => $request->username,
            'email' => $request->email ?? '',
            'phone' => $request->phone_number,
            'address' => $request->address ?? '',
            'password' => Hash::make($request->password),
            'role' => 'candidate',
            'status' => 0,
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5), // 5 min expiry
        ]);

        SmsHelper::send($request->phone_number, "Hi {$request->full_name},\nYou have successfully registered here,
        \nYour OTP is: {$otp}\nValid for 5 minutes.
\nUsername: {$request->username}\nEmail: {$request->email}\nPassword: {$request->password}\nLogin URL: {$loginURL}\n\nPlease login to your account.\n\nIf you have any questions, feel free to contact us.\n\nThanks,\nEcommerce Team");


        return redirect()->route('frontend.verifyOtpForm', $user->id)->with('success', 'OTP sent to your phone.');
    }

    public function verifyOtpForm($id)
    {
        return view('pages.frontend.userregister.verify', compact('id'));
    }

    public function verifyOtpSubmit(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'otp' => 'required|digits:6'
        ]);

        $user = User::find($request->user_id);

        // Check expiry
        if (Carbon::now()->gt($user->otp_expires_at)) {
            $user->delete();

            return redirect()->route('frontend.userRegister')
                ->withErrors(['otp' => 'You have not entered OTP in time. Please try again.']);
        }

        // Check OTP
        if ($user->otp != $request->otp) {
            $user->delete();

            return redirect()->route('frontend.verifyOtpForm')
                ->withErrors(['otp' => 'Invalid OTP. Please register again.']);
        }

        // Success
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->status = 1;
        $user->save();

        return redirect()->route('frontend.userlogin')
            ->with('success', 'Registration completed successfully.');
    }


    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $login = $request->input('username');
        $password = $request->input('password');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Find user first
        $user = User::where($fieldType, $login)->first();

        if (!$user) {
            return back()->withErrors(['username' => 'User not found']);
        }

        // Check OTP verification
        if ($user->status != 1) {
            return back()->withErrors(['username' => 'Your account is not verified. Please complete OTP verification.']);
        }

        // Attempt login
        if (Auth::attempt([$fieldType => $login, 'password' => $password])) {

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('candidate.dashboard');
        }

        return back()->withErrors(['username' => 'Invalid Credentials']);
    }

   

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function userLogout()
    {
        Auth::logout();
        return redirect()->route('frontend.userlogin');
    }

}
