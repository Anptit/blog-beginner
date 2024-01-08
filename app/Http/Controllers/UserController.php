<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth')->except('logout');
    }

    public function index()
    {
        return view('home.user.dashboard', [
            'user' => auth()->user(),
            'title' => 'Dashboard'
        ]);
    }

    public function logout(Request $request)
    { 
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect()->route('auth.login');

    }
}
