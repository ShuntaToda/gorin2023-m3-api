<?php

use App\Http\Controllers\api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->middleware("unAuthHandle")->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("login", [LoginController::class, "login"]);

Route::group(["middleware" => ["unAuthHandle", "auth:samctum"]], function () {
    Route::get("logout", [LoginController::class, "logout"]);
});
