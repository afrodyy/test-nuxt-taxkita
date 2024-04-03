<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['message' => 'Successfully registered'], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function getUserData(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $userData = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];

        return response()->json($userData);
    }

    public function getUserDataById(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $userData = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];

        return response()->json($userData);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
