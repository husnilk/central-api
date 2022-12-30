<?php


use App\Http\Controllers\Api\Internship\MyInternshipController;

Route::group(['middleware' => ['auth','api']], function(){

    Route::resource('my-internship', MyInternshipController::class);
});
