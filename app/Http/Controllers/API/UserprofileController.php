<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserprofileController extends Controller
{
    public function getUsers()
    {
        $users = User::find();
        return response()->json($users);
    }

    public function getProfileByUserId(Request $request)
    {
        $userId = $request->userId;
        if (! $userId) {
            return response()->json(['message' => 'User ID is required'], 400);
        }
        $user = User::with('profile')->find($userId);

        if (! $user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $data = $user->getProfileData();

        if (! $data) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        return response()->json($data);
    }

    public function getPostByUserId(Request $request)
    {
        $userId = $request->userId;
        if (! $userId) {
            return response()->json(['message' => 'User ID is required'], 400);
        }
       $user = User::with('posts')->find($userId);
       
        if (! $user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $posts = $user->posts;

        if ($posts->isEmpty()) {
            return response()->json(['message' => 'No posts found for this user'], 404);
        }

        return response()->json($posts);
    }

    public function getUserRolesByUserId(Request $request)
    {
        $userId = 10;
        if (! $userId) {
            return response()->json(['message' => 'User ID is required'], 400);
        }

        $user = User::with('roles')->find($userId);

        if (! $user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $roles = $user->roles;

        if ($roles->isEmpty()) {
            return response()->json(['message' => 'No roles found for this user'], 404);
        }

        return response()->json($roles);
    }
}
