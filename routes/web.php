<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SensorsController;
use App\Http\Controllers\TemperatureController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/* definição das rotas de exibição, confirmação de login e logout */
Route::middleware("guest")->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get("/login", "index")->name("login.index");
        Route::post("/login", "auth")->name("login.auth");
        Route::get("/logout", "logout")->name("login.logout");
    });
});

Route::middleware("auth")->group(function () {
    Route::get("/home", [HomeController::class, "index"])->name("home.index");

    Route::get("/auth/email", [AuthController::class, "index"])->name("auth.index");

    Route::get("/sensors", [SensorsController::class, "index"])->name("sensors.index");

    Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard.index");

    Route::get("/temperature", [TemperatureController::class, "index"])->name("temperature.index");

    Route::get("/logout", [LoginController::class, "logout"])->name("logout");

    Route::resource("user", UserController::class);
});
