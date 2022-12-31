<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentResourcesController;

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

//Public access @ AuthController
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Protected access @ StudentResourcesContrioller
Route::group(['middleware' => 'auth:api'], function(){
    Route::apiResource('/student', 'App\Http\Controllers\StudentResourcesController');
    Route::post('/import', [StudentResourcesController::class, 'import']);
});



















Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




