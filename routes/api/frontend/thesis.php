<?php

use Illuminate\Support\Facades\Route;


/** MAHASISWA */
//Route::get('students/{id}', [ThesisController::class, 'showmahasiswa']);
//Route::get('/list/seminars', [ThesisListController::class, 'seminars']);
//Route::get('/list/trials', [ThesisListController::class, 'trials']);
//
//Route::resource('theses.submissions', ThesisSubmissionController::class)->except(['edit', 'create']);
//Route::resource('theses', ThesisController::class)->except(['edit', 'create']);
//Route::resource('theses.proposals', ThesisProposalController::class);
//Route::resource('theses.logbooks', ThesisLogbookController::class)->except(['edit', 'create']);
//Route::resource('theses.seminars', ThesisSeminarController::class)->except(['edit', 'create']);
//Route::resource('theses.trials', ThesisTrialController::class)->only(['show', 'store', 'index']);

Route::group(['prefix' => 'thesis', 'as' => 'thesis.'], function () {
    /** MAHASISWA */
//    Route::resource('seminars.audiences', ThesisSeminarAudienceController::class)->only(['create', 'store', 'destroy', 'index']);

    /** DOSEN */
//    Route::resource('advisors', ThesisAdvisorController::class)->except(['create', 'store']); //Tadi diubah
//    Route::resource('submissions', ThesisSupervisorSubmissionController::class);
//    Route::post('submissions/{thesis}/accept', [ThesisSupervisorSubmissionController::class, 'accept'])->name('submissions.accept');
//    Route::post('submissions/{thesis}/reject', [ThesisSupervisorSubmissionController::class, 'reject'])->name('submissions.reject');
//    Route::resource('advisor-cancellation', ThesisAdvisorCancellationController::class)->only(['create', 'update']);
//    Route::resource('advisors.logbooks', ThesisAdvisorLogbookController::class)->only(['show', 'edit', 'update']);
//    Route::post('advisors-logbooks/{thesis}/accept', [ThesisAdvisorLogbookController::class, 'accept'])->name('advisors.logbook.accept');
//    Route::post('advisors-logbooks/{thesis}/reject', [ThesisAdvisorLogbookController::class, 'reject'])->name('advisors.logbook.reject');
//
//    Route::resource('proposal-grades', ThesisProposalGradeController::class)->only(['index', 'show', 'edit', 'update']);
//
//    Route::resource('advisors.seminars', ThesisSupervisorSeminarController::class);
//    Route::resource('reviewer-submissions', ThesisReviewerSubmissionController::class)->only(['index', 'show', 'update', 'destroy']);
//    Route::resource('reviewer-scores', ThesisReviewerScoreController::class)->only(['edit', 'update']);
//
//    Route::resource('advisors.trials', ThesisSupervisorTrialController::class);
//    Route::resource('examiner-submissions', ThesisExaminerSubmissionController::class)->only(['index', 'show', 'update', 'destroy']);
//    Route::resource('examiner-scores', ThesisExaminerScoreController::class)->only(['edit', 'update']);
//
//    Route::resource('grades', ThesisAdvisorGradeController::class)->except(['update', 'destroy', 'create', 'store']);

    /** KAPRODI */
//    Route::resource('seminar-submissions', ThesisSeminarSubmissionController::class)->only(['index', 'show', 'update', 'destroy']);
//    Route::resource('seminar.reviewer-assignments', ThesisSeminarReviewerAssignmentController::class)->only(['create', 'store', 'destroy']);
//
//    Route::resource('trial-submissions', ThesisTrialSubmissionController::class)->only(['index', 'show', 'update', 'destroy']);
//    Route::resource('trials.examiner-assignments', ThesisTrialExaminerAssignmentController::class)->only(['create', 'store', 'destroy']);
//
//    Route::resource('finals', ThesisFinalController::class)->only(['index', 'show', 'update']);

});

