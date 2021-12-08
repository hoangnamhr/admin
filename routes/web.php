<?php

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome']);
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'welcome']);
Route::get('/student-detail', [App\Http\Controllers\HomeController::class, 'welcome']);
Route::get('/student-marks', [App\Http\Controllers\HomeController::class, 'welcome']);
Route::get('/student-marks-detail', [App\Http\Controllers\HomeController::class, 'welcome']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//api
Route::post('/students', [App\Http\Controllers\StudentController::class, 'createStudent']);
Route::get('/students', [App\Http\Controllers\StudentController::class, 'getStudent']);
Route::delete('/students/{id}', [App\Http\Controllers\StudentController::class, 'deleteStudent']);
Route::put('/students', [App\Http\Controllers\StudentController::class, 'updateStudent']);


Route::get('/student-mark', [App\Http\Controllers\StudentController::class, 'getStudentMarks']);
Route::post('/student-mark', [App\Http\Controllers\StudentController::class, 'createStudentMarks']);
Route::delete('/student-mark/{id}', [App\Http\Controllers\StudentController::class, 'deleteStudentMarks']);
Route::put('/student-mark', [App\Http\Controllers\StudentController::class, 'updateStudentMarks']);