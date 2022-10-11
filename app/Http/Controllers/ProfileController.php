<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Staff;
use App\Models\Student;
use App\Models\User;
use App\Traits\UploadFileTrait;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    use UploadFileTrait;

    public function show()
    {
        $user = auth()->user();
        $civitas = $user->civitas;

        return view('profile.show', compact('user', 'civitas'));
    }

    public function edit()
    {
        $user = auth()->user();
        $civitas = $user->civitas;

        if($user->type == User::LECTURER){
            $association_types = Lecturer::ASSOCIATION_SELECT;
        }elseif($user->type == User::STAFF){
            $association_types = Staff::ASSOCIATION_SELECT;
        }else{
            $association_types = [];
        }

        return view('profile.edit', compact(
            'user',
            'civitas',
            'association_types'
        ));

    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'photo' => 'nullable|image|dimensions:min_width=300'
        ]);
        $folder = '';

        $user = auth()->user();
        $civitas = $user->civitas;

        $user->name = request('name');
        $user->email = request('email');
        $user->save();

        $civitas->name = request('name');
        $civitas->nik = request('nik');
        $civitas->birthplace = request('birthplace');
        $civitas->birthday = request('birthday');
        $civitas->gender = request('gender');
        $civitas->phone = request('phone');
        $civitas->address = request('address');
        $civitas->marital_status = request('marital_status');
        $civitas->religion = request('religion');

        switch ($user->type){
            case User::STUDENT:
                $folder = config('central.path.student_photo');
                $civitas->nim = request('nim');
                $civitas->year = request('year');
                break;
            case User::LECTURER:
                $folder = config('central.path.lecturer_photo');
                $civitas->nidn = request('nidn');
                $civitas->npwp = request('npwp');
                $civitas->karpeg = request('karpeg');
                $civitas->association_type = request('association_type');
                break;
            case User::STAFF:
                $folder = config('central.path.staff_photo');
                $civitas->npwp = request('npwp');
                $civitas->karpeg = request('karpeg');
                $civitas->association_type = request('association_type');
                break;
        }

        if($request->hasFile('photo')) {
            $filename = uniqid($civitas->id.'_').'.'.$request->file('photo')->getClientOriginalExtension();
            $civitas->photo = $this->saveUploadedPhoto($civitas->photo, $request->file('photo'), $folder, $filename);
            $user->avatar = $this->saveAvatar($user->avatar, $request->file('photo', $filename), $filename);
        }

        if($user->save() && $civitas->save())
        {
            notify('success', 'Berhasil mengupdate profil Anda');
        }else{
            notify('error', 'Gagal memperbaharui profil Anda');
        }

        return redirect()->route('profile.show');
    }
    public function history()
    {
        $logins = auth()->user()
            ->logins()
            ->orderBy('login_at', 'desc')
            ->paginate(100);

        $user = auth()->user();

        return view('profile.history', compact('logins', 'user'));
    }

}
