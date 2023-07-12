<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function signup(Request $request){
        try{
            $data = $request->validate([
                'name' => 'required|min:4',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'role' => 'required'
            ]);        
    
            $user = User::createUser($data);
            $token = $user->createToken('auth-token')->plainTextToken;
            return response()->json(['token' => $token], 201);
        }
        catch(ValidationException $e){
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
    public function signin(){
        try {
            $data = request()->validate([
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
    public function logout(){
        request()->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
