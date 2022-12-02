<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursePlan extends Model
{
    use HasFactory;

    public function coursePlanDetail()
    {
        return $this->hasMany(coursePlanDetail::class);
    }

    public function creator()
    {
        $data = Lecturer::select('id as creator_id', 'name as creator_name', 'reg_id as creator_regno')
                        ->where('id', $this->created_by)
                        ->first();
        return $data;
    }

    public function validator()
    {
        $data = Lecturer::select('id as creator_id', 'name as creator_name', 'reg_id as creator_regno')
                        ->where('id', $this->validated_by)
                        ->first();
        return $data;
    }

    public function curriculumLo()
    {
        $data = CoursePlan::select('curriculum_los.id', 'curriculum_los.code', 'curriculum_los.name as curriculum_lo_name')
                        ->join('courses', 'courses.id', '=', 'course_plans.course_id')
                        ->join('curricula', 'curricula.id', '=', 'courses.curriculum_id')
                        ->join('curriculum_los', 'curriculum_los.curriculum_id', 'curricula.id')
                        ->where('course_plans.id', $this->id)
                        ->first();

        return $data;
    }

    public function courseLo()
    {
        $data = CoursePlan::select('course_los.id', 'course_los.code', 'course_los.name as lo_name')
                        ->join('course_los', 'course_los.course_plan_id', '=', 'course_plans.id')
                        ->where('course_plans.id', $this->id)
                        ->get();

        return $data;
    }

    public function courseReference()
    {
        $data = CoursePlan::join('course_plan_references', 'course_plan_references.course_plan_id', '=', 'course_plans.id')
                        ->where('course_plans.id', $this->id)
                        ->get();

        return $data;
    }

    public function thisCoursePlanDetail()
    {
        $data = CoursePlan::select('course_plan_details.id', 'course_plan_details.week', 'course_plan_details.material', 'course_plan_details.method', 'course_plan_details.student_experience as student_exp')
                        ->join('course_plan_details', 'course_plan_details.course_plan_id', '=', 'course_plans.id')
                        ->where('course_plans.id', $this->id)
                        ->get();

        return $data;
    }

    public function detailReference($detailId)
    {
        $data = CoursePlanDetail::select('course_plan_references.id as ref_id', 'course_plan_references.title as ref_name', 'course_plan_references.description as ref_desc')
                        ->join('course_plan_detail_refs', 'course_plan_details.id', '=', 'course_plan_detail_refs.course_plan_detail_id')
                        ->join('course_plan_references', 'course_plan_detail_refs.course_plan_reference_id', '=', 'course_plan_references.id')
                        ->where('course_plan_details.id', $detailId)
                        ->get();

        return $data;
    }

    public function detailAssessment($detailId)
    {
        $data = CoursePlanDetail::select('course_plan_assessments.id', 'course_plan_assessments.name', 'course_plan_assessments.percentage')
                        ->join('course_plan_detail_assessments', 'course_plan_details.id', '=', 'course_plan_detail_assessments.course_plan_detail_id')
                        ->join('course_plan_assessments', 'course_plan_detail_assessments.course_plan_assessment_id', '=', 'course_plan_assessments.id')
                        ->where('course_plan_details.id', $detailId)
                        ->get();

        return $data;
    }


}
