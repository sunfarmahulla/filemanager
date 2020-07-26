<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

class AuthController extends Controller
{
    public function login(Request $request){
        $email=$request->get('email');
        $password=$request->input('password');
        request()->validate([
            'email'=>'required|email',
            'password'=>'required|min:8|regex:/^[a-zA-Z0-9!@#$%^&*]{6,16}$/',

        ],[
            'email.required'=>'email is required',
            'email.email'=>'email must be valid',
            'password.required'=>'password must be required',
            'password.min'=>'password must be at least 8 characters',
            'password.regax'=>'password must containe one numeric and one letter'

        ]);
       if($email=='manager@gmail.com' and $password=='password123'){
           return Redirect::to('file-manager');
       }else{
           return Redirect::to('login')->with('error','email and password is wrong');
       }
        
    }
}
