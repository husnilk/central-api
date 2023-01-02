<?php

namespace App\Http\Controllers\Api\Curriculum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
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

}
