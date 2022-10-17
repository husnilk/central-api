<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursePlanDetail extends Model
{
    use HasFactory;

    public function los($course_plan_detail_id)
    {
        $data = CoursePlanDetailOutcome::select('course_los.id','course_los.name')
        ->join('course_los', 'course_los.id', '=', 'course_plan_detail_outcomes.course_lo_id')
        ->where('course_plan_detail_id', $course_plan_detail_id)->first();

        return $data;
    }

    public function assessments($course_plan_detail_id)
    {
        $data = CoursePlanDetailAssessment::select('course_plan_assessments.id','course_plan_assessments.name', 'course_plan_assessments.percentage')
        ->join('course_plan_assessments', 'course_plan_assessments.id', '=', 'course_plan_detail_assessments.course_plan_assessment_id')
        ->where('course_plan_detail_id', $course_plan_detail_id)->first();

        return $data;
    }

    public function refs($course_plan_detail_id)
    {
        $data = CoursePlanDetailRef::select('course_plan_references.id','course_plan_references.title as name', 'course_plan_detail_refs.category')
        ->join('course_plan_references', 'course_plan_references.id', '=', 'course_plan_detail_refs.course_plan_reference_id')
        ->where('course_plan_detail_id', $course_plan_detail_id)->first();

        return $data;
    }
}
