<?php

//List Rps
use App\Http\Controllers\Api\Curriculum\CourseLoController;
use App\Http\Controllers\Api\Curriculum\CoursePlanAssessmentController;
use App\Http\Controllers\Api\Curriculum\CoursePlanController;
use App\Http\Controllers\Api\Curriculum\CoursePlanDetailController;
use App\Http\Controllers\Api\Curriculum\LecturerController;
use App\Http\Controllers\Api\Curriculum\ListCoursePlanController;
use App\Http\Controllers\Api\Curriculum\RefController;

/**
Route::get('/rps', [ListCoursePlanController::class, 'index']);
Route::post('/rps', [ListCoursePlanController::class, 'search']);
Route::get('/rps/{rpsId}', [ListCoursePlanController::class, 'show']);
Route::post('/rps/{rpsId}/export', [ListCoursePlanController::class, 'export']);

//Rps
Route::get('/bo/rps/', [CoursePlanController::class, 'index']);
Route::post('/bo/rps/', [CoursePlanController::class, 'store']);
Route::get('/bo/rps/{rpsId}/', [CoursePlanController::class, 'show']);
Route::put('/bo/rps/{rpsId}/', [CoursePlanController::class, 'update']);

//CPMK
Route::get('/bo/rps/{rpsId}/cpmk', [CourseLoController::class, 'getData']);
Route::post('/bo/rps/{rpsId}/cpmk', [CourseLoController::class, 'store']);
Route::put('/bo/rps/{rpsId}/cpmk/{cpmkId}', [CourseLoController::class, 'update']);
Route::delete('/bo/rps/{rpsId}/cpmk/{cpmkId}', [CourseLoController::class, 'destroy']);

//Ref
Route::get('/bo/rps/{rpsId}/refs', [RefController::class, 'index']);
Route::post('/bo/rps/{rpsId}/refs', [RefController::class, 'store']);
Route::put('/bo/rps/{rpsId}/refs/{refId}', [RefController::class, 'update']);
Route::delete('/bo/rps/{rpsId}/refs/{refId}', [RefController::class, 'destroy']);

//Assessment
Route::get('/bo/rps/{rpsId}/assessments', [CoursePlanAssessmentController::class, 'index']);
Route::post('/bo/rps/{rpsId}/assessments', [CoursePlanAssessmentController::class, 'store']);
Route::put('/bo/rps/{rpsId}/assessments/{assessmentId}', [CoursePlanAssessmentController::class, 'update']);
Route::delete('/bo/rps/{rpsId}/assessments/{assessmentId}', [CoursePlanAssessmentController::class, 'destroy']);

//Session
Route::get('/bo/rps/{rpsId}/session', [CoursePlanDetailController::class, 'index']);
Route::post('/bo/rps/{rpsId}/session', [CoursePlanDetailController::class, 'store']);
Route::put('/bo/rps/{rpsId}/session/{sessionId}', [CoursePlanDetailController::class, 'update']);
Route::delete('/bo/rps/{rpsId}/session/{sessionId}', [CoursePlanDetailController::class, 'destroy']);

//Lecturer
Route::get('/bo/rps/{rpsId}/lecturers', [LecturerController::class, 'index']);
Route::post('/bo/rps/{rpsId}/lecturers', [LecturerController::class, 'store']);
Route::delete('/bo/rps/{rpsId}/lecturers/{lecturersId}', [LecturerController::class, 'destroy']);
**/
