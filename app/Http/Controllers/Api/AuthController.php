<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = request(['username', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
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

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function update(Request $request)
    {
        $name = $request->name;
        $email = $request->email;

        $user = \auth()->user();
        $user->name = $name;
        $user->email = $email;
        $user->save();

        return response()->json([
            'status'=> 'success',
            'message' => 'Berhasil mengupdate data pengguna'
        ]);

    }

    public function password(){
        $user = \auth()->user();

        $old_password = request('old_password');
        $new_password = request('new_password');
        $confirm_password = request('confirm_password');

        if(Hash::check($old_password, $user->password) && $new_password == $confirm_password){
            $user->password = bcrypt($new_password);
            $user->save();
            return response()->json([
                'status'=> 'success',
                'message'=> 'Berhasil memperbaharui password'
            ]);
        }else{
            return response()->json([
                'status'=> 'error',
                'message'=> 'Gagal memperbaharui password'
            ]);
        }
    }

    public function forbidden(){
        return response()->json([
            'status' => 'error',
            'message' => 'Not Authenticated'
        ], 401);
    }
}
