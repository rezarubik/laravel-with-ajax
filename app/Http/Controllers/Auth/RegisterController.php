<?php

namespace App\Http\Controllers\Auth;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\RegisterMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /**
     * NOTE: Store new registration
     */
    public function store(RegisterFormRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'validation_code' => Helper::generate_token(255)
            ];
            $user = User::create($data);
            // todo send email after registration
            Mail::to($user->email)->send(new RegisterMail(['fullname' => $user->firstname, 'fullname' => $user->lastname, 'validation_code' => $user->validation_code]));
            DB::commit();
            return redirect()->route('login')->with('status', 'Registraction success, please check your email for verification');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
