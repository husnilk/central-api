<?php

use App\Http\Controllers\Api\Thesis\Backend\ThesisSeminarReviewerAssignmentController;
use App\Http\Controllers\Api\Thesis\Backend\ThesisTrialExaminerAssignmentController;
use App\Http\Controllers\Api\Thesis\ThesisAdvisorCancellationController;
use App\Http\Controllers\Api\Thesis\ThesisAdvisorController;
use App\Http\Controllers\Api\Thesis\ThesisAdvisorGradeController;
use App\Http\Controllers\Api\Thesis\ThesisAdvisorLogbookController;
use App\Http\Controllers\Api\Thesis\ThesisController;
use App\Http\Controllers\Api\Thesis\ThesisExaminerScoreController;
use App\Http\Controllers\Api\Thesis\ThesisExaminerSubmissionController;
use App\Http\Controllers\Api\Thesis\ThesisFinalController;
use App\Http\Controllers\Api\Thesis\ThesisListController;
use App\Http\Controllers\Api\Thesis\ThesisLogbookController;
use App\Http\Controllers\Api\Thesis\ThesisProposalController;
use App\Http\Controllers\Api\Thesis\ThesisProposalGradeController;
use App\Http\Controllers\Api\Thesis\ThesisReviewerScoreController;
use App\Http\Controllers\Api\Thesis\ThesisReviewerSubmissionController;
use App\Http\Controllers\Api\Thesis\ThesisSeminarAudienceController;
use App\Http\Controllers\Api\Thesis\ThesisSeminarController;
use App\Http\Controllers\Api\Thesis\ThesisSeminarSubmissionController;
use App\Http\Controllers\Api\Thesis\ThesisSubmissionController;
use App\Http\Controllers\Api\Thesis\ThesisSupervisorSeminarController;
use App\Http\Controllers\Api\Thesis\ThesisSupervisorSubmissionController;
use App\Http\Controllers\Api\Thesis\ThesisSupervisorTrialController;
use App\Http\Controllers\Api\Thesis\ThesisTrialController;
use App\Http\Controllers\Api\Thesis\ThesisTrialSubmissionController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['api', 'auth']], function ($router) {
    /** MAHASISWA */
    Route::get('/list/seminars', [ThesisListController::class, 'seminars']);
    Route::get('/list/trials', [ThesisListController::class, 'trials']);

    Route::resource('theses.submissions', ThesisSubmissionController::class)->except(['edit', 'create']);
    Route::resource('theses', ThesisController::class)->except(['edit', 'create']);
    Route::resource('theses.proposals', ThesisProposalController::class);
    Route::resource('theses.logbooks', ThesisLogbookController::class)->except(['edit', 'create']);
    Route::resource('theses.seminars', ThesisSeminarController::class)->except(['edit', 'create']);
    Route::resource('theses.trials', ThesisTrialController::class)->only(['show', 'store']);

    Route::group(['prefix' => 'thesis', 'as' => 'thesis.'], function () {
        /** MAHASISWA */
        Route::resource('seminars.audiences', ThesisSeminarAudienceController::class)->only(['create', 'store', 'destroy']);

        /** DOSEN */
        Route::resource('advisors', ThesisAdvisorController::class)->except(['create', 'store']); //Tadi diubah
        Route::resource('submissions', ThesisSupervisorSubmissionController::class);
        Route::post('submissions/{thesis}/accept', [ThesisSupervisorSubmissionController::class, 'accept'])->name('submissions.accept');
        Route::post('submissions/{thesis}/reject', [ThesisSupervisorSubmissionController::class, 'reject'])->name('submissions.reject');
        Route::resource('advisor-cancellation', ThesisAdvisorCancellationController::class)->only(['create', 'update']);
        Route::resource('advisors.logbooks', ThesisAdvisorLogbookController::class)->only(['show', 'edit', 'update']);
        Route::post('advisors-logbooks/{thesis}/accept', [ThesisAdvisorLogbookController::class, 'accept'])->name('advisors.logbook.accept');
        Route::post('advisors-logbooks/{thesis}/reject', [ThesisAdvisorLogbookController::class, 'reject'])->name('advisors.logbook.reject');

        Route::resource('proposal-grades', ThesisProposalGradeController::class)->only(['index', 'show', 'edit', 'update']);

        Route::resource('advisors.seminars', ThesisSupervisorSeminarController::class);
        Route::resource('reviewer-submissions', ThesisReviewerSubmissionController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::resource('reviewer-scores', ThesisReviewerScoreController::class)->only(['edit', 'update']);

        Route::resource('advisors.trials', ThesisSupervisorTrialController::class);
        Route::resource('examiner-submissions', ThesisExaminerSubmissionController::class)->only(['show', 'update', 'destroy']);
        Route::resource('examiner-scores', ThesisExaminerScoreController::class)->only(['edit', 'update']);

        Route::resource('grades', ThesisAdvisorGradeController::class)->except(['destroy', 'create', 'store']);

        /** KAPRODI */
        Route::resource('seminar-submissions', ThesisSeminarSubmissionController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::resource('seminar.reviewer-assignments', ThesisSeminarReviewerAssignmentController::class)->only(['create', 'store', 'destroy']);

        Route::resource('trial-submissions', ThesisTrialSubmissionController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::resource('trials.examiner-assignments', ThesisTrialExaminerAssignmentController::class)->only(['create', 'store', 'destroy']);

        Route::resource('finals', ThesisFinalController::class)->only(['index', 'show', 'update']);

    });

});
