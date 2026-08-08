<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){

        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:8|confirmed'
        ]);

        $user = User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['password'])
        ]);

        event(new Registered($user));
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['token'=> $token,
                                  'user'=> $user], 
                                  201);


    }



    public function login(Request $request){

        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required|string'
        ]);

        if(!Auth::attempt($credentials)){
            return response()->json(['message' =>'Identifiants invaliders.'], 401);
        }
       
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['token'=> $token]);


    }
}
