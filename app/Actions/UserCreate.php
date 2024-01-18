<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CreateUser 
{
    public function __construct()
    {
        
    }
    public function handle($request)
    {
        $user = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'role' => '0',
            'birthday' => $request['birthday'],
            'password' => Hash::make($request['password'])
        ]);

        if (in_array($request['avatar'], $request)) {
            $file = $request['avatar'];
            $fileName = $file->getClientOriginalName();
            $file->storeAs('avatars', $fileName);
        }

        return $user;
    }
}