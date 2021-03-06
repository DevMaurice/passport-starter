<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register()
    {
        request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|confirmed|max:255|min:6',
        ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
        ]);


        return new JsonResponse([
            'success' => true,
            'message' => 'User Created Successfully.',
            'data'  => [],
        ], 201);
    }


    /**
     * Logout a user.
     *
     * @return JsonResponse
     */
    public function logout()
    {
        $accessToken = Auth::user()->token();

        $accessToken->revoke();

        return  new JsonResponse([
            'success' => true,
            'message' => 'Logged User out successfully',
        ], 200);
    }

    /**
    * Return a user
    *
    * @return JsonResponse
    */
    public function user()
    {
        return new UserResource(request()->user());
    }
}
