<?php

use App\Http\Controllers\api\LoginController;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::post("auth/login", [LoginController::class, "login"]);

Route::group(["middleware" => ["unAuthHandle", "auth:sanctum"]], function () {
    Route::post("auth/logout", [LoginController::class, "logout"]);
    Route::get("fields", function () {
        return response()->json([
            "objects" => [
                [
                    1, 1, 1, 1, 1
                ],
                [
                    1, 2, 3, 0, 1
                ],
                [
                    1, 3, 0, 4, 1
                ],
                [
                    1, 1, 1, 1, 1
                ],
            ]
        ]);
    });

    Route::get("results", function () {
        $results = Result::all();
        return response()->json($results);
    });
    Route::post("results", function (Request $request) {
        $result = Result::create([
            "user" => Auth::user()->name,
            "block_moves" => $request->block_moves,
            "time" => $request->time,
        ]);

        return response()->json([
            "success" => true,
            $result
        ]);
    });
});
