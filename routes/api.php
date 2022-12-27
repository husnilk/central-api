<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ListCoursePlanController;
use App\Http\Controllers\Api\CourseLoController;
use App\Http\Controllers\Api\RefController;
use App\Http\Controllers\Api\CoursePlanAssessmentController;
use App\Http\Controllers\Api\CoursePlanDetailController;
use App\Http\Controllers\Api\LecturerController;
use App\Http\Controllers\Api\CoursePlanController;
use App\Http\Controllers\Api\AuthController;

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

//Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/me/update', [AuthController::class, 'update']);
Route::get('/me', [AuthController::class, 'me']);
Route::post('/password', [AuthController::class, 'password']);
Route::get('/forbidden', [AuthController::class, 'forbidden'])->name('api.forbidden');

Route::group(['middleware' => ['api', 'auth']], function ($router) {
    //Auth
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);

    //List Rps
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

});

require __DIR__ . '/api/frontend/thesis.php';
require __DIR__ . '/api/frontend/intern.php';

require __DIR__ . '/api/backend/thesis.php';
require __DIR__ . '/api/backend/intern.php';
