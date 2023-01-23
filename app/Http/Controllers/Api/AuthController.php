<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $app_token = $request->get('app_token');

        $app_version = AppVersion::where('app_token', $app_token)
            ->where('enabled', 1)
            ->first();

        if( $app_version != null){
            return response()->json([
                'status' => 'outdated',
                'message' => 'Outdated Apps. Please update the app'], 400);
        }


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
}
