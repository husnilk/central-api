<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ListCoursePlanController;
use App\Http\Controllers\Api\CourseLoController;
use App\Http\Controllers\Api\RefController;
use App\Http\Controllers\Api\CoursePlanAssessmentController;
use App\Http\Controllers\Api\CoursePlanDetailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/rps', [ListCoursePlanController::class, 'index']);
Route::post('/rps', [ListCoursePlanController::class, 'search']);

//CPMK
Route::get('/bo/rps/{rpsId}/cpmk', [CourseLoController::class, 'getData']);
Route::post('/bo/rps/{rpsId}/cpmk', [CourseLoController::class, 'store']);

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


