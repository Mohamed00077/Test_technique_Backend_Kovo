<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OA;

class AuthController extends Controller
{

#[OA\Post(
    path: "/api/register",
    summary: "Inscription d'un nouvel utilisateur",
    tags: ["Authentification"],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ["name", "email", "password", "password_confirmation"],
            properties: [
                new OA\Property(property: "name", type: "string", example: "Momo Diabagate"),
                new OA\Property(property: "email", type: "string", format: "email", example: "momodiabagate71@gmail.com"),
                new OA\Property(property: "password", type: "string", format: "password", example: "password0007"),
                new OA\Property(property: "password_confirmation", type: "string", format: "password", example: "password0007"),
            ]
        )
    ),
    responses: [
        new OA\Response(response: 201, description: "Utilisateur créé avec succès"),
        new OA\Response(response: 422, description: "Erreur de validation"),
    ]
)]
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


#[OA\Post(
    path: "/api/login",
    summary:"Connection d'un utilisateur",
    tags:["Authentification"],
    requestBody: new OA\RequestBody(
        required:true,
        content: new OA\JsonContent(
            required:["email","password"],
            properties:[
                new OA\Property(property: "email", type:"string", format:"email",example:"momodiabagate71@gmail.com"),
                new OA\Property(property: "password", type:"string", format:"password", example:"password0007"),
            ]
        )
    ),
    responses:[
        new OA\Response(response:200, description:"Utilisateur connecté avec succès"),
        new OA\Response(response:401, description:"Identifiants invalides"),
    ]
)]
    public function login(Request $request){

        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required|string'
        ]);

        if(!Auth::attempt($credentials)){
            return response()->json(['message' =>'Identifiants invalides.'], 401);
        }
       
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['token'=> $token]);


    }

}
