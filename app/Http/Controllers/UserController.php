<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (!auth('api')->user()->tokenCan('get-all-posts')) {
            abort(403);
        }

        $user = User::all();

        return response()->json([
            'data' => $user
        ], 200);
    }

    public function logout(Request $request)
    { 
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return response()->json(['message' => 'You have logout'], 200);
    }
}
