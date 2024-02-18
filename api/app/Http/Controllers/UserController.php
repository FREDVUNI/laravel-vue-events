<?php

namespace App\Http\Controllers;

use \App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Users()
    {
        try {
            $users = User::fetchUsers();
            return response()->json(['users' => $users], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
    public function show($id)
    {
        try {
            $user = User::getUser($id);
            return response()->json(['user' => $user], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'User not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
    public function edit($slug)
    {
        try {
            $user = User::editUser($slug);
            return response()->json(['user' => $user], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Event not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'name' => 'required|min:4',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'required|min:6',
                'role' => 'required'
            ]);
            $user = User::getUser($id);
            $update = User::updateUser($id, $data);
            return response()->json(['user' => $update], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'user not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
    public function delete($id)
    {
        try {
            User::deleteUser($id);
            return response()->json(["message" => "user has been deleted."]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'user not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
    public function count()
    {
        try {
            $users = User::fetchUsers();
            $userCount = count($users);
            return response()->json(['count' => $userCount], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
}
