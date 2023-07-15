<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
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
    public function signin(Request $request){
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
    public function logout()
{
    try {
        $user = request()->user();

        if ($user) {
            $user->tokens()->delete();
            return response()->json(['message' => 'You have successfully logged out and the token was successfully deleted'], 200);
        } else {
            return response()->json(['message' => 'User not authenticated'], 401);
        }
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error occurred during logout'], 500);
    }
}

}
