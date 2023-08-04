<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassAttendance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'study_plan_id',
        'class_meeting_id',
        'device_id',
        'device_name',
        'lattitude',
        'longitude',
        'attendance_status',
        'need_attention',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'study_plan_id' => 'integer',
        'class_meeting_id' => 'integer',
        'lattitude' => 'double',
        'longitude' => 'double',
    ];

    public function studyplan()
    {
        return $this->belongsTo(StudyPlan::class);
    }

    public function meeting()
    {
        return $this->belongsTo(ClassMeeting::class);
    }
}
