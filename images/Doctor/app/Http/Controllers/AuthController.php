<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model;

class AuthController extends Controller
{
    public function rules($data){
        $messages= [
            'email.reqired'=> 'Please enter your email address',
            'email.exists' => 'Email already exists',
            'email.email' => 'Please enter a valid email address',
            'password.required'  => 'Password is required ',
            'password.min'  => 'Password must be at least 6 characters '

        ];

        $validator=Validator::make($data, [
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ],  $messages);

    }
    public function savedoc1(Request $request)
    {
      
        $request ->validate([
            'name' => 'required|string|regex:/^[a-zA-Z],{3,16}/i',
        'email' => 'required|unique:users|regex:/(.+)@(.+)\.(.+)/i',
        'password' => 'required|min:6|confirmed',
        'password_confirmation' => 'sometimes|required_with:password'
        ]);

    $user = new User([
        'name' => $request->get('name'),
        'email' => $request->get('email'),
        'password' => $request->get('password'),
        'user_type' => 'doctor'
    ]);
    $user ->save();

    return redirect()->intended('doctor/dashboard');
}


}
