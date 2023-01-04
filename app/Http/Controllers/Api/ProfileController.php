<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function index()
    {
        return auth()->user();
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $civitas = $user->civitas;
        if ($civitas != null) {
            $civitas->phone = request('phone');
            $civitas->email = request('email');
            $civitas->nik = request('nik');
            $civitas->address = request('address');
            $civitas->birthday = request('birthday');
            $civitas->birthplace = request('birthplace');
            switch ($user->type) {
                case User::STUDENT:
                    $civitas->year = request('year');
                    break;
                case User::LECTURER:
                    $civitas->nim = request('nidn');
                    $civitas->karpeg = request('karpeg');
                    break;
                case User::STAFF:
                    $civitas->karpeg = request('karpeg');
                    break;
            }
            $civitas->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengupdate profile pengguna'
        ]);
    }

    public function password(Request $request)
    {
        $user = auth()->user();
        if ($user != null) {
           $old_password = request('old_password');
           if(Hash::check($old_password, $user->password)){
               $new_password = request('new_password');
               $confirm_pasword = request('confirm_password');
               if($new_password == $confirm_pasword){
                   $user->password = bcrypt($new_password);
                   if($user->save())
                   {
                       return response()->json([
                           'status' => 'success',
                           'message' => 'Password berhasil diganti'
                       ]);
                   }
                   return response()->json([
                       'status' => 'failed',
                       'message' => 'Password baru tidak sama'
                   ]);
               }
               return response()->json([
                   'status' => 'failed',
                   'message' => 'Password tidak dikenali'
               ]);
           }

        }
        return response()->json([
            'status' => 'failed',
            'message' => 'User tidak ditemukan'
        ], 404);
    }

    public function mobileToken(Request $request)
    {
        $user = auth()->user();
        if ($user != null) {
            $user->mobile_token = request('token');
            if ($user->save()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Token Aplikasi mobile telah didaftarkan'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Gagal mendaftarkan token'
                ]);
            }
        }
        return response()->json([
            'status' => 'failed',
            'message' => 'User tidak ditemukan'
        ], 404);
    }
}
