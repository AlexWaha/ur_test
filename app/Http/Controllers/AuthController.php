<?php

namespace App\Http\Controllers;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Hash;

class AuthController extends Controller {

    public function login(Request $request) {
        $request->validate([
            'email'       => 'required|email',
            'password'    => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password) || !$user->is_active) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        if ($existingToken = $user->tokens()->where('name', $request->device_name)->first()) {
            $existingToken->delete();
        }

        return [
            'data' => [
                'access_token' => $user->createToken($request->device_name)->plainTextToken,
            ]
        ];
    }
}
