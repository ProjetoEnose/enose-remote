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

Route::middleware("guest")->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get("/login", "show")->name("login.show");
        Route::post("/login/check", "check")->name("login.check");
    });
});

Route::middleware("auth")->group(function () {
    Route::get("/home", [HomeController::class, "show"])->name("home.show");

    Route::get("/auth/email", [AuthController::class, "show"])->name("auth.show");

    Route::get("/sensors", [SensorsController::class, "show"])->name("sensors.show");

    Route::get("/dashboard", [DashboardController::class, "show"])->name("dashboard.show");

    Route::get("/temperature", [TemperatureController::class, "show"])->name("temperature.show");

    Route::get("/logout", [LoginController::class, "logout"])->name("logout");

    Route::resource("user", UserController::class);
});
