<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CoursesController;
use App\Http\Controllers\Api\StudentsController;
use App\Http\Controllers\Api\LecturersController;
use App\Http\Controllers\Api\ProgrammesController;
use App\Http\Controllers\Api\ProgrammeCoursesController;
use App\Http\Controllers\Api\AuthController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/courses', [CoursesController::class, 'index']);
//Route::get('/students', [StudentsController::class, 'index']);
//Route::post('/students', [StudentsController::class, 'store']);
//Route::resource('courses', [CoursesController::class, 'store']);
Route::get('/', function(){
    return "Hi";
});

//Route::resource('students', StudentsController::class);
//Route::resource('lecturers', LecturersController::class);
Route::get('/programmes', [ProgrammesController::class, 'index']);
Route::get('/programmes/{id}', [ProgrammesController::class, 'show']);

//Route::resource('courses', CoursesController::class);

Route::get('/courses/search/{query}', [CoursesController::class, 'search']); //Search for a course

//Route::post('/addprogrammecourse', [ProgrammeCoursesController::class, 'attachCourseToProgramme']);




Route::middleware('auth:sanctum')->post('/student/register', [AuthController::class, 'studentRegister']);
Route::middleware('auth:sanctum')->post('/lecturer/register', [AuthController::class, 'lecturerRegister']);
//Route::middleware('auth:sanctum')->post('/admin/register', [AuthController::class, 'adminRegister']);
Route::post('/admin/register', [AuthController::class, 'adminRegister']);


Route::middleware('auth:sanctum')->post('/programmes', [ProgrammesController::class, 'store']);
Route::middleware('auth:sanctum')->post('/addprogrammecourse', [ProgrammeCoursesController::class, 'attachCourseToProgramme']);


Route::post('/auth/student', [AuthController::class, 'student']);
Route::post('/auth/lecturer', [AuthController::class, 'lecturer']);
Route::post('/auth/admin', [AuthController::class, 'administrator']);





