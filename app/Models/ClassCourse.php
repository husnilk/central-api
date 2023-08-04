<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassCourse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'course_id',
        'period_id',
        'course_plan_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'course_id' => 'integer',
        'period_id' => 'integer',
        'course_plan_id' => 'integer',
    ];

    public function lecturers()
    {
        return $this->hasMany(ClassLecturer::class);
    }

    public function schedules()
    {
        return $this->hasMany(ClassSchedule::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function courseplan()
    {
        return $this->belongsTo(CoursePlan::class);
    }
}
