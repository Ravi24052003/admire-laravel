<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // public function signup(SignupRequest $request){
    // $data = $request->validated();

    // User::create($data);

    //  return response()->json(["message"=>"Your account created successfully soon our team will verify your account"], 201);

    // }

    public function login(LoginRequest $request){
        $credentials = $request->validated();

        if (Auth::attempt($credentials)){
                return redirect()->to("dashboard-home"); 
        } 
        else{
           return redirect()->back()->withErrors('Invalid email or password');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
