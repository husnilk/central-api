<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchMember extends Model
{
    use HasFactory;

    public static $validation_rules = [
        'user_id' => 'required',
        'research_id' => 'required',
        'position' => 'required'
    ];

    const JABATAN_KETUA = 1;
    const JABATAN_ANGGOTA = 2;

    const JABATANS = [
        self::JABATAN_KETUA => 'Ketua',
        self::JABATAN_ANGGOTA => 'Anggota'
    ];

    public function research()
    {
        return $this->belongsTo(Research::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
