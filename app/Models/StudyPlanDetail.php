<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyPlanDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'study_plan_id',
        'class_id',
        'status',
        'transcript',
        'weight',
        'grade',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'study_plan_id' => 'integer',
        'class_id' => 'integer',
        'weight' => 'double',
    ];

    public function meetings()
    {
        return $this->hasMany(ClassMeeting::class);
    }

    public function studyplan()
    {
        return $this->belongsTo(StudyPlan::class);
    }

    public function classcourse()
    {
        return $this->belongsTo(ClassCourse::class);
    }
}
