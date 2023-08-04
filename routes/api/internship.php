<?php

//Mahasiswa
use App\Http\Controllers\Api\Internship\MyInternshipController;
use App\Http\Controllers\Api\Internship\MyInternshipLogbookController;

Route::apiResource('my-internships', MyInternshipController::class);
Route::apiResource('my-internship.logbooks', MyInternshipLogbookController::class);
//
