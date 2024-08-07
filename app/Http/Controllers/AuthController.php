<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //Register Function
    public function register(Request $request){

        if (!$request->isMethod('post')) {
            return response()->json([
                "status" => "400",
                "message" => "Bad Request. Only Post method allowed"
            ], 400);
        }

        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed"
        ]);

        //Save Data
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        // Generate Token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "status" => "201",
            "message" => "User Created Successfully",
            "token" => $token
        ], 201);
    }
    
    // Log In Function
    public function login(){
        return "Log IN";
    }
}
