<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassLecturer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class_id',
        'lecturer_id',
        'position',
        'grading',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'class_id' => 'integer',
        'lecturer_id' => 'integer',
    ];

    public function meetings()
    {
        return $this->hasMany(ClassMeeting::class);
    }

    public function classcourse()
    {
        return $this->belongsTo(ClassCourse::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }
}
