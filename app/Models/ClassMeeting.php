<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassMeeting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'meet_no',
        'class_id',
        'course_plan_detail_id',
        'method',
        'ol_platform',
        'ol_links',
        'room_id',
        'lecture_date',
        'start_at',
        'end_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'class_id' => 'integer',
        'course_plan_detail_id' => 'integer',
        'room_id' => 'integer',
        'lecture_date' => 'date',
    ];

    public function attendances()
    {
        return $this->hasMany(ClassAttendance::class);
    }

    public function classcourse()
    {
        return $this->belongsTo(ClassCourse::class);
    }

    public function courseplandetail()
    {
        return $this->belongsTo(CoursePlanDetail::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
