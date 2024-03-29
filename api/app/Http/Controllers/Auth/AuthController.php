<?php

namespace App\Http\Controllers\Auth;

// use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|min:4',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'role' => 'required'
            ]);

            $user = User::createUser($data);
            $token = $user->createToken('auth-token')->plainTextToken;
            return response()->json(['token' => $token], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
    public function signin(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            $user = User::userLogin($data);
            $token = $user->createToken('auth-token')->plainTextToken;
            return response()->json(['token' => $token], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 401);
        }
    }
    public function logout(Request $request)
    {
        // $tokenId = Str::before($request->bearerToken(), '|');
        // $token = $request->bearerToken();


        // dd($token);
        try {
            $user = $request->user();
            if ($user) {
                $user->tokens()->delete();
                return response()->json(['message' => 'You have logged out.'], 200);
            } else {
                return response()->json(['message' => 'User not authenticated'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error occurred during logout'], 500);
        }
    }
    public function user(Request $request)
    {
        try {
            return response()->json([
                'id' => Auth::id(),
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'role' => Auth::user()->role,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error occurred.'], 500);
        }
    }
}
