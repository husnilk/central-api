<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = request(['username', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Not Authenticated'], 401);
        }

        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'name' => $user->name,
            'email' => $user->email,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }


    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $token = auth()->refresh();

        return response()->json([
            'status' => 'success',
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function forbidden(){
        return response()->json([
            'status' => 'error',
            'message' => 'Not Authenticated'
        ], 401);
    }

    public function me()
    {
        return auth()->user();
    }
}
