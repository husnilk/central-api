<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLo extends Model
{
    use HasFactory;

    public function courseLoDetail()
    {
        return $this->hasMany(CourseLoDetail::class);
    }

    public function curriculumLo(){
        $data = CourseLoDetail::join('curriculum_los', 'curriculum_los.id', '=', 'course_lo_details.curriculum_lo_id')
                                ->where('course_lo_id', $this->id)
                                ->get();

        return $data;
    }
}
