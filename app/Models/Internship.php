<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;

    const STATUS_DRAFT = 0;
    const STATUS_PROPOSED = 1;
    const STATUS_ON_FIELD = 2;
    const STATUS_SUPERVISING = 3;
    const STATUS_CANCELLED = 4;
    const STATUS_FINISHED = 7;

    const STATUSES = [
        self::STATUS_DRAFT => "Draft",
        self::STATUS_PROPOSED => 'Pengecekan Proposal',
        self::STATUS_ON_FIELD => 'Sedang di Lapangan',
        self::STATUS_SUPERVISING => 'Bimbingan KP',
        self::STATUS_CANCELLED => 'Batal',
        self::STATUS_FINISHED => 'Selesai'
    ];

    protected $table = 'internships';
    protected $guarded = [];

    public function proposal()
    {
        return $this->belongsTo(InternshipProposal::class, 'proposal_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'id', 'student_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(Lecturer::class, 'supervisor_id', 'id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'seminar_room_id', 'id');
    }

    public function audiences()
    {
        return $this->belongsToMany(Student::class, 'internship_seminar_audiences', 'internship_id', 'student_id');
    }

    public function logbooks()
    {
        return $this->hasMany(InternshipLogbook::class, 'internship_id', 'id');
    }
}
