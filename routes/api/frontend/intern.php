<?php


Route::group(['middleware' => ['api', 'auth']], function ($router) {
    /** MAHASISWA */

    Route::group(['prefix' => 'internship', 'as' => 'internship.'], function () {
        /** MAHASISWA */

        /** DOSEN */

        /** KAPRODI */

    });

});
