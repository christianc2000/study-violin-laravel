<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponseHelpers;
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->respondUnAuthenticated('Invalid credentials');
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->respondWithSuccess([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete(); // Revocar todos los tokens del usuario
        
        return response()->json(['message' => 'Successfully logged out']);
    }
    
    public function perfil(Request $request)
    {
        $user = $request->user();
        $user->load('estudiante'); // Cargar la relación estudiante si existe
        $user->load('profesor'); // Cargar la relación estudiante si existe
        $user->load('tutor'); // Cargar la relación estudiante si existe

        return response()->json([
            'user' => $user,
        ]);
    }
}
