<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use OpenApi\Attributes as OA;

class ProfileController extends Controller
{

#[OA\Get(
    path:"/api/profile",
    summary: "Voir son profile --utilisateur",
    tags:["Profil"],
    security:[["bearerAuth" => []]],

    responses:[
        new OA\Response(response:200, description:"profile envoyé"),
        new OA\Response(response:401, description:"non authentifié")
    ]
)]
    public function show(Request $request){
        $user = auth()->user();
        return response()->json(['user' => $user]);
    }

#[OA\Put(
    path:"/api/profile",
    summary:"Modifier son profile --utilisateur",
    tags:["Profil"],
    security:[["bearerAuth" => []]],
    requestBody:new OA\RequestBody(
        required:true,
        content: new OA\JsonContent(
            required:[],

            properties: [
                new OA\Property(property: "name", type: "string", example: "Momo Diabagate"),
                new OA\Property(property: "email", type: "string", format: "email", example: "momodiabagate71@gmail.com"),
                new OA\Property(property: "password", type: "string", format: "password", example: "password0007"),
                new OA\Property(property: "password_confirmation", type: "string", format: "password", example: "password0007"),
            ]
        )
    ),

    responses:[
        new OA\Response(response:200, description:"profil mis à jour"),
        new OA\Response(response:400, description:"Aucune donnée à mettre à jour"),
        new OA\Response(response:401, description:"non authentifié"),
        new OA\Response(response:422, description:"Erreur de validation")
    ]
)]

    public function update(Request $request){
        $user = auth()->user();
       $validated= $request->validate([
            'name'=>'sometimes|string|max:255',
            'email'=>['sometimes','email',Rule::unique('users', 'email')->ignore($user->id)],
            'password'=>'sometimes|string|min:8|confirmed'
        ]);

        if($request->filled('password')){
            $validated['password'] = Hash::make($validated['password']);
        }

        if(empty($validated)){
            return response()->json(['message'=>'Aucune donnée à mettre à jour'], 400);
        }

        $user->update($validated);

        return response()->json(['message'=>'profil mis à jour.']);
    }
}
