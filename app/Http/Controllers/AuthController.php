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
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function login(Request $request, LoginUser $user)
    {
        if (Auth::attempt($user->handle($request), $request->has('remember_account'))) {

            if (isset($request->remember_account) && !empty($request->remember_account)) {
                setcookie('username', $request->username, time() + 86400);
                setcookie('password', $request->password, time() + 86400);
            } else {
                setcookie('username', "");
                setcookie('password', "");
            }

            $request->session()->regenerate();

            return redirect()->route('user.home');
        }

        return redirect()->back()->with('fail', 'Your credential is incorrect!');
    }

    public function createView()
    {
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }

    public function create(StoreUserRequest $request, CreateUser $user)
    {
        $validated = $request->validated();

        $user->handle($validated);

        return redirect()->route('auth.login')->with('success', 'Register successfully!');
    }
    
    public function forgotPasswordView()
    {
        return view('auth.forgot-password', [
            'title' => 'Forgot password'
        ]);
    }

    public function forgotPassword(Request $request)
    {
        $user = User::firstWhere('email', $request->email);

        if (isset($user)) {
            return redirect()->route('auth.reset_password', ['user' => $user]);
        }

        return redirect()->back()->with('fail', 'Your email is incorrect!');
    }

    public function resetPasswordView(User $user)
    {
        return view('auth.reset-password', [
            'title' => 'Reset password',
            'user' => $user
        ]);
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
