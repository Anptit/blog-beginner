<?php

namespace App\Http\Controllers;

use App\Actions\CreateUser;
use App\Actions\LoginUser;
use App\Http\Requests\ResetPassword;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials =  $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)){
            $user = User::firstWhere('email', $request->email);
            $token = $user->createToken('authToken', ['get-all-posts'])->plainTextToken;
            return response()->json([
                'status' => 200,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }
 
        return response()->json([
            'status' => 500,
            'message' => 'Error login!'
        ]);
    }

    public function create(StoreUserRequest $request)
    {
        $creds = $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:1|max:30',
            'birthday' => 'required',
            'avatar' => 'required'
        ]);

        User::create($creds);

        return response()->json(['message' => 'Register successfully!']);
    }

    public function forgotPassword(Request $request)
    {
        $user = User::firstWhere('email', $request->email);

        if (isset($user)) {
            return redirect()->route('auth.reset_password', ['user' => $user]);
        }

        return redirect()->back()->with('fail', 'Your email is incorrect!');
    }

    public function resetPassword(ResetPassword $request, User $user)
    {
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with('fail', 'Your password is incorrect!');
        }

        $user->update([
            'password' => Hash::make($request->new_password), // new password: 12345678
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('auth.login')->with('success', 'Password is changed!');
    }
}
