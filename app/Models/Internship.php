<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;

    protected $table = 'internships';
    protected $guarded = [];

    public function proposal()
    {
        return $this->belongsTo(InternshipProposal::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function supervisor()
    {
        return $this->belongsTo('advisor_id', 'id', Lecturer::class);
    }
}
