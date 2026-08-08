<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request){
        $user = auth()->user();
        return response()->json(['user' => $user]);
    }
}
