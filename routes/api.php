<?php
use App\Http\Controllers\api\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\StudentController;
use App\Http\Controllers\Api\Auth\EmployeeController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
return 'Request received';
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::get('me', [AuthController::class, 'me'])->middleware('auth:api');
Route::post('password/send-reset-token', [ResetPasswordController::class, 'sendResetToken']);
Route::post('password/reset', [ResetPasswordController::class, 'resetPassword']);
Route::get('/students', [StudentController::class, 'index']);
Route::get('/employees', [EmployeeController::class, 'index']);
Route::apiResource('students', StudentController::class);







