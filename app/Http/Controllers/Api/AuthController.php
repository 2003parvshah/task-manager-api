<?php
// app/Http/Controllers/Api/AuthController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\SessionLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use JWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:manager,employee',
        ]);

        $user = User::create([
            'id' => Str::uuid()->toString(),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        $this->logSession($user->id, 'register', $request);

        $token = FacadesJWTAuth::fromUser($user);

        return response()->json([
            'message' => 'User registered',
            'token' => $token
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // if (!$token = auth()->attempt($credentials)) {
        return response()->json(['error' => 'Invalid Credentials'], 401);
        // }

        // $user = auth()->user();
        $this->logSession($user->id, 'login', $request);

        return response()->json([
            'message' => 'Login successful',
            'token' => $token
        ]);
    }

    public function logout()
    {
        // auth()->logout();
        return response()->json(['message' => 'Logged out']);
    }

    private function logSession($userId, $event, Request $request)
    {
        SessionLog::create([
            'user_id' => $userId,
            'event' => $event,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }
}
