<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('authentication.login');
    }
    /**
     * note: Login
     */
    public function authenticate(Request $request)
    {
        $check_user = User::where('email', $request->email)->first();
        if (!$check_user) {
            return response()->json([
                'status' => false,
                'message' => 'Email does not exist'
            ]);
        }


        if (!Hash::check($request->password, $check_user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Sorry, wrong password'
            ]);
        }

        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (!$credentials) {
            return response()->json([
                'status' => false,
                'message' => 'Please check your email or password'
            ]);
        }
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json([
                'status' => true,
                'message' => 'Login Successful'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Sorry, Login Failed'
        ]);
    }

    /**
     * note: Logout
     */
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('auth/login');
    }
}
