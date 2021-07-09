<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response([
            'message' => 'Successfully registered. You can now login.'
        ]);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    
        return $user->createToken($request->device_name)->plainTextToken;
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response([
            'message' => 'Successfully logged out.'
        ]);
    }
}
