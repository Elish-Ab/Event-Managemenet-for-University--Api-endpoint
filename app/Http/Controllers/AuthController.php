<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function SignUp(Request $request){
        $validatedUser = $request->validate([
            "name"=>"required|string",
            "email"=> "required|string|unique:users,email",
            "password"=> "required|string|confirmed",
        ]);

        $user = User::create([
            "name"=>$validatedUser["name"],
            "email"=>$validatedUser["email"],
            "password"=>bcrypt($validatedUser["password"]),
        ]);
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user'=>$user,
            'token'=>$token
        ];

        return response($response,201);

    }

    public function login(Request $request){
        $validatedUser = $request->validate([
            "email"=> "required|string",
            "password"=> "required|string",
        ]);

        $user = User::where('email', $validatedUser['email'])->first();

        if(!$user || !Hash::check($validatedUser['password'], $user->password)){
            return response([
                "message"=> "Bad Credentials"
            ]);
        }
    
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user'=>$user,
            'token'=>$token
        ];

        return response($response,201);

    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            "message"=>"Logged out Successfully"
        ];
    }

    


}
