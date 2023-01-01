<?php


use App\Http\Controllers\Api\Internship\LecturerInternshipController;
use App\Http\Controllers\Api\Internship\MyInternshipAudienceController;
use App\Http\Controllers\Api\Internship\MyInternshipController;
use App\Http\Controllers\Api\Internship\MyInternshipLogbookController;
use App\Http\Controllers\Api\Internship\MyInternshipStatementController;
use App\Http\Controllers\Api\Internship\MyInternshipSubmissionController;

Route::group(['middleware' => ['auth','api']], function(){

    //Mahasiswa
    Route::resource('my-internship.logbook', MyInternshipLogbookController::class);
    Route::resource('my-internship', MyInternshipController::class);
    Route::post('my-internship-submissions', [MyInternshipSubmissionController::class, 'store']);
    Route::post('my-internship/{internship_id}/finish-statement', [MyInternshipStatementController::class, 'store']);
    Route::patch('my-internship/{internship_id}/ready-statement', [MyInternshipStatementController::class, 'balasankp']);
    Route::patch('my-internship/{internship_id}/final_report', [MyInternshipStatementController::class, 'uploadlapkp']);
    Route::patch('my-internship/{internship_id}/input_seminar', [MyInternshipStatementController::class, 'inputseminar']);
    Route::resource('my-internship.audiences', MyInternshipAudienceController::class);
    Route::get('info-seminar-internship', [MyInternshipStatementController::class, 'infoseminar']);
    Route::post('attend-seminar-internship/{internship_id}', [MyInternshipStatementController::class, 'inputabsenseminar']);

    //Dosen
    Route::get('internship-students', [LecturerInternshipController::class, 'listbimbingan']);
    Route::patch('internship-students/{internship_id}/grade', [LecturerInternshipController::class, 'inputnilaikp']);
    Route::post('internship-students/{internship_id}/cancellation', [LecturerInternshipController::class, 'batalkp']);
    Route::get('internship-students/{internship_id}/seminar', [LecturerInternshipController::class, 'detailseminar']);
    Route::patch('internship-students/{internship_id}/seminar', [LecturerInternshipController::class, 'inputbaseminarkp']);
    Route::patch('internship-students/{internship_id}/approve-audiences', [LecturerInternshipController::class, 'approvepeserta']);
    Route::patch('internship-students/{internship_id}/reject-audiences', [LecturerInternshipController::class, 'rejectpeserta']);
    Route::patch('internship-students/{internship_id}/logbook/{logbook_id}', [LecturerInternshipController::class, 'updatelogbook']);

});
