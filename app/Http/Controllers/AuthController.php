<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);
        
        $user = User::create([
            'user_name' => $request->input('user_name'),
            'password' => Hash::make($request->input('password')),
        ]);
        
        $token = $user->createToken('API_TOKEN')->plainTextToken;

        return response([
            'message' => 'registered successfully',
            'user' => $user,
            'token' => $token
        ], 201);
    }


    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($incomingFields))
        {
            $user = User::where('user_name', $request->input('user_name'))->first();

            $token = $user->createToken('API_TOKEN')->plainTextToken;

            return response([
                'message' => 'logged in successfully',
                'user' => $user,
                'token' => $token
            ], 201);
        }
        
        return response()->json([
            'message' => 'incorrect user name or password'
        ], 401);
        
    }
    
    public function logout(Request $request)
    {
        auth()->user()->currentAccessToken()->delete();
        
        return [
            'message' => 'logged out successfully',
        ];
    }
}
