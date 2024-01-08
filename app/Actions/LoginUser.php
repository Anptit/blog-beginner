<?php

namespace App\Actions;

class LoginUser
{
    public function __construct() 
    {

    }
    
    public function handle($request)
    {
        $fieldType = filter_var($request->usernameOrEmail, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $request->merge([$fieldType => $request->usernameOrEmail]);

        $validator = $request->validate([
            $fieldType => 'required',
            'password' => 'required'
        ]);
        
        return $validator;
    }
}