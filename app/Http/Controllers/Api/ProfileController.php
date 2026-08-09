<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(Request $request){
        $user = auth()->user();
        return response()->json(['user' => $user]);
    }



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

        $user->update($validated);

        return response()->json(['message'=>'utilisateur modifier']);
    }
}
