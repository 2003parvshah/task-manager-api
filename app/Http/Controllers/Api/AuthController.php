<?php
// app/Http/Controllers/Api/AuthController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\SessionLog;
// use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use JWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;
use App\Http\Requests\RegisterRequest;


class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        Log::info("in register fucntion");



        $user = User::create([
            'id' => Str::uuid()->toString(),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        Log::info($user);

        $this->logSession($user->id, 'register', $request);

        $token = FacadesJWTAuth::fromUser($user);

        return response()->json([
            'message' => 'User registered',
            'token' => $token
        ]);
    }

    public function login(Request $request)
    {
        // Validate request inputs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        Log::info('Login attempt', ['email' => $credentials['email']]);

        // Attempt authentication
        if (!$token = FacadesJWTAuth::attempt($credentials)) {
            Log::warning('Login failed for email: ' . $credentials['email']);
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        // Get authenticated user
        $user = FacadesJWTAuth::user();

        // Log session
        $this->logSession($user->id, 'login', $request);

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'role' => $user->role,
            ],
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
