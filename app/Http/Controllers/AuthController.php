<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
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

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        return response()->json([
            "status" => "201",
            "message" => "User Created Successfully",
        ], 201);
    }
    
    public function login(Request $request){

        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $user = User::where("email",$request->email)->first();

        if(!empty($user)){
            if(Hash::check($request->password, $user->password)){

                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    "status" => "201",
                    "message" => "User Log In Successful",
                    "token" => $token
                ],201);
            }

            return response()->json([
                "status" => "401",
                "message" => "Password didn't match"
            ],401);
        }

        return response()->json([
            "status" => "400",
            "message" => "Invalid Log In Credentials"
        ],400);
    }

    public function profile(){

        $data = auth()->user();

        return response()->json([
            "status" => "201",
            "message" => "USer fetched successfully",
            "data" => $data
        ], 201);
    }

    public function logout(){

        auth()->user()->tokens()->delete();

        return response()->json([
            "status" => "201",
            "message" => "User Logged Out",
        ], 201);

    }
}
