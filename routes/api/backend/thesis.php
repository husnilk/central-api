<?php

use App\Http\Controllers\Api\Thesis\Backend\ThesisController;
use App\Http\Controllers\Api\Thesis\Backend\ThesisLogbookController;
use App\Http\Controllers\Api\Thesis\Backend\ThesisProposalAudienceController;
use App\Http\Controllers\Api\Thesis\Backend\ThesisProposalController;
use App\Http\Controllers\Api\Thesis\Backend\ThesisSeminarAcceptanceController;
use App\Http\Controllers\Api\Thesis\Backend\ThesisSeminarAudienceController;
use App\Http\Controllers\Api\Thesis\Backend\ThesisSeminarController;
use App\Http\Controllers\Api\Thesis\Backend\ThesisSeminarResultController;
use App\Http\Controllers\Api\Thesis\Backend\ThesisSeminarReviewerController;
use App\Http\Controllers\Api\Thesis\Backend\ThesisSeminarSubmissionController;
use App\Http\Controllers\Api\Thesis\Backend\ThesisSubmissionController;
use App\Http\Controllers\Api\Thesis\Backend\ThesisSupervisorController;
use App\Http\Controllers\Api\Thesis\Backend\ThesisTopicController;
use App\Http\Controllers\Api\Thesis\Backend\ThesisTrialAcceptanceController;
use App\Http\Controllers\Api\Thesis\Backend\ThesisTrialController;
use App\Http\Controllers\Api\Thesis\Backend\ThesisTrialExaminerController;
use App\Http\Controllers\Api\Thesis\Backend\ThesisTrialResultController;
use App\Http\Controllers\Api\Thesis\Backend\ThesisTrialSubmissionController;
use App\Http\Controllers\Api\Thesis\ThesisSupervisorAssignmentController;

/**
Route::resource('thesis-topics', ThesisTopicController::class);

Route::resource('thesis-submissions', ThesisSubmissionController::class);
Route::resource('theses', ThesisController::class);
//Mahasiswa
Route::resource('theses.supervisors', ThesisSupervisorController::class)->only(['create', 'store', 'destroy']);
Route::resource('theses.logbooks', ThesisLogbookController::class);

Route::resource('theses.proposals', ThesisProposalController::class)->except(['index', 'destroy']);
Route::resource('theses.seminars', ThesisSeminarController::class)->except(['index', 'destroy']);
Route::resource('theses.trials', ThesisTrialController::class)->except(['index', 'destroy']);

Route::group(['prefix' => 'thesis', 'as' => 'thesis.'], function () {

    Route::post('supervisors-assignments', [ThesisSupervisorAssignmentController::class, "store"]);
    Route::resource('proposals.audiences', ThesisProposalAudienceController::class)->only(['create', 'store', 'destroy']);

    Route::resource('seminar-submissions', ThesisSeminarSubmissionController::class)->only(['index', 'show', 'edit', 'update']);
    Route::resource('seminar-acceptance', ThesisSeminarAcceptanceController::class)->only(['update', 'destroy']);
    Route::resource('seminar-results', ThesisSeminarResultController::class)->only(['edit', 'update']);
    Route::resource('seminars.reviewers', ThesisSeminarReviewerController::class)->only(['create', 'store', 'destroy']);
    Route::resource('seminars.audiences', ThesisSeminarAudienceController::class)->only(['create', 'store', 'destroy']);

    Route::resource('trial-submissions', ThesisTrialSubmissionController::class)->only(['index', 'show', 'edit', 'update']);
    Route::resource('trial-acceptance', ThesisTrialAcceptanceController::class)->only(['update', 'destroy']);
    Route::resource('trial-results', ThesisTrialResultController::class)->only(['edit', 'update']);
    Route::resource('trials.examiners', ThesisTrialExaminerController::class)->only(['create', 'store', 'destroy']);

});
**/
