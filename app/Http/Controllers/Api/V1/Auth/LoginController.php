<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        // Log the start of the login request
        Log::info('Login request started', ['email' => $request->email]);
    
        $user = User::where('email', $request->email)->first();
    
        // Log if the user is not found or the password is incorrect
        if (!$user || !Hash::check($request->password, $user->password)) {
            Log::warning('Login failed - incorrect credentials', ['email' => $request->email]);
            return response()->json(['error' => 'The provided credentials are incorrect'], 422);
        }
    
        // Log successful login
        Log::info('Login successful', ['user_id' => $user->id]);
    
        $device = substr($request->userAgent() ?? 'unknown-device', 0, 255);
    
        // Log token creation
        Log::info('Token created for user', ['user_id' => $user->id, 'device' => $device]);
    
        return response()->json(['access_token' => $user->createToken($device)->plainTextToken]);
    }
    
    
}