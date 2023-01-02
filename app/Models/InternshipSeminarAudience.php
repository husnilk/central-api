<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipSeminarAudience extends Model
{
    use HasFactory;


    const STATUS_NOT_VALIDATED = 0;
    const STATUS_ATTENDED = 1;
    const STATUS_UNATTENDED = 2;

    const STATUSES = [
        self::STATUS_NOT_VALIDATED => 'Belum divalidasi',
        self::STATUS_ATTENDED => 'Hadir',
        self::STATUS_UNATTENDED => 'Tidak Hadir'
    ];

    protected $table = 'internship_seminar_audiences';
    protected $guarded = [];

    public function internship()
    {
        return $this->belongsTo(Internship::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
