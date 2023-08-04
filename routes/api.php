<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/forbidden', [AuthController::class, 'forbidden'])->name('api.forbidden');

Route::group(['middleware' => ['api', 'auth']], function ($router) {
    //Auth
    Route::post('/me/update', [ProfileController::class, 'store']);
    Route::get('/me', [ProfileController::class, 'index']);
    Route::post('/password', [ProfileController::class, 'password']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/submit-token', [ProfileController::class, 'mobileToken']);

    require __DIR__ . '/api/curriculum.php';

    require __DIR__ . '/api/thesis.php';

    require __DIR__ . '/api/internship.php';

    require __DIR__ . '/api/frontend/thesis.php';
    require __DIR__ . '/api/frontend/intern.php';

    require __DIR__ . '/api/backend/thesis.php';
    require __DIR__ . '/api/backend/intern.php';
});


