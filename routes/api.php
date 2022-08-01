<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', [UserController::class, 'index'])->middleware(['auth:api', 'cors']);
Route::get('/tes', function () {
    return response(['status' => 'Ok']);
});
Route::post('/tes', function (Request $request) {
    return response(['status' => 'Ok', 'Request' => $request->email]);
});
Route::post('/login', [UserController::class, 'login']);
Route::get('login', function () {
    return response([
        'status' => 401,
        'message' => 'Unauthorized'
    ]);
})->name('login');
