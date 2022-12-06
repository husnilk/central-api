<?php

use App\Http\Controllers\Api\Thesis\ThesisController;
use App\Http\Controllers\Api\Thesis\ThesisListController;
use App\Http\Controllers\Api\Thesis\ThesisLogbookController;
use App\Http\Controllers\Api\Thesis\ThesisSeminarController;
use App\Http\Controllers\Api\Thesis\ThesisSubmissionController;
use App\Http\Controllers\Api\Thesis\ThesisTrialController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['api', 'auth']], function ($router) {
    /** MAHASISWA */
    //List Jadwal Seminar dan Sidang
    Route::get('/list/seminars', [ThesisListController::class, 'seminars']);
    Route::get('/list/trials', [ThesisListController::class, 'trials']);

    //Pengajuan TA
    Route::post('/thesis/submission', [ThesisSubmissionController::class, 'submit']);

    //Thesis
    Route::get('/thesis', [ThesisController::class, 'index']);
    Route::post('/thesis', [ThesisController::class, 'store']);
    Route::get('/thesis/{id}', [ThesisController::class, 'show']);
    Route::patch('/thesis/{id}', [ThesisController::class, 'update']);
    Route::delete('/thesis/{id}', [ThesisController::class, 'destroy']);

    //Logbook
    Route::get('/thesis/{thesis_id}/logbook', [ThesisLogbookController::class, 'index']);
    Route::get('/thesis/{thesis_id}/logbook/{id}', [ThesisLogbookController::class, 'show']);
    Route::post('/thesis/{thesis_id}/logbook', [ThesisLogbookController::class, 'store']);
    Route::patch('/thesis/{thesis_id}/logbook/{id}/update', [ThesisLogbookController::class, 'update']);

    //Seminar Hasil
    Route::get('/thesis/{thesis_id}/seminar', [ThesisSeminarController::class, 'index']);
    Route::get('/thesis/{thesis_id}/seminar/{id}', [ThesisSeminarController::class, 'show']);
    Route::post('/thesis/{thesis_id}/seminar', [ThesisSeminarController::class, 'store']);
    Route::patch('/thesis/{thesis_id}/seminar/{id}/update', [ThesisSeminarController::class, 'update']);

    //Sidang TA
    Route::get('/thesis/trial/show', [ThesisTrialController::class, 'show']);
    Route::post('/thesis/trial/submit', [ThesisTrialController::class, 'submit']);

});
