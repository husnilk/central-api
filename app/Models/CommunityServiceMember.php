<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityServiceMember extends Model
{
    use HasFactory;

    const VALIDATION_RULES = [
        'user_id' => 'required',
        'community_service_id' => 'required',
        'position' => 'required'
    ];

    const JABATAN_KETUA = 1;
    const JABATAN_ANGGOTA = 2;

    const JABATANS = [
        self::JABATAN_KETUA => 'Ketua',
        self::JABATAN_ANGGOTA=> 'Anggota',
    ];

    public function community_service()
    {
        return $this->belongsTo(CommunityService::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
