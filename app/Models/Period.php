<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'year',
        'semester_id',
        'active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'semester_id' => 'integer',
    ];

    public function studyplans()
    {
        return $this->hasMany(StudyPlan::class);
    }

    public function classcourses()
    {
        return $this->hasMany(ClassCourse::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
