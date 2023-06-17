<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CoursesController;
use App\Http\Controllers\Api\StudentsController;
use App\Http\Controllers\Api\LecturersController;
use App\Http\Controllers\Api\ProgrammesController;
use App\Http\Controllers\Api\ProgrammeCoursesController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\GuestOnlyMiddleware;

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

Route::get('/user', function (Request $request) {
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


//Route::resource('courses', CoursesController::class);

Route::get('/courses/search/{query}', [CoursesController::class, 'search']); //Search for a course

//Route::post('/addprogrammecourse', [ProgrammeCoursesController::class, 'attachCourseToProgramme']);




//Route::post('/admin/register', [AuthController::class, 'adminRegister']);



// admin roles
Route::group(['middleware' => ['auth:sanctum', 'role:admin']], function () {
    //Users, Students, and Lectures
    Route::post('/student/register', [AuthController::class, 'studentRegister']);
    Route::post('/students', [StudentsController::class, 'index']);
    Route::post('/students/{id}', [StudentsController::class, 'show']);


    Route::post('/lecturer/register', [AuthController::class, 'lecturerRegister']);
    Route::post('/lecturer', [LecturersController::class, 'index']);
    Route::post('/lecturer/{id}', [LecturersController::class, 'show']);

    //Courses   and Programmes
    Route::post('/courses/register', [CoursesController::class, 'store']);
    Route::post('/programmes/register', [ProgrammesController::class, 'store']);
    Route::post('/addprogrammecourse/{programmeId}/{CourseId}', [ProgrammesController::class, 'addCourseToProgramme']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

// admin and lecturer roles
Route::group(['middleware' => ['auth:sanctum', 'role:admin', 'role:lecturer']], function () {
 //   Route::post('/addprogrammecourse/{programmeId}/{CourseId}', [StudentsController::class, 'addCourseToProgramme']);
});


Route::middleware('public')->post('/admin/register', [AuthController::class, 'adminRegister']);



Route::group(['middleware' => ['public']], function () {
Route::get('/programmes', [ProgrammesController::class, 'index']);
Route::get('/programmes/{id}', [ProgrammesController::class, 'show']);
Route::get('/courses', [CoursesController::class, 'index']);
Route::get('/courses/{id}', [CoursesController::class, 'show']);

}); // public routes

Route::middleware([GuestOnlyMiddleware::class])->post('/admin/login', [AuthController::class, 'adminLogin']);
Route::middleware([GuestOnlyMiddleware::class])->post('/student/login', [AuthController::class, 'studentLogin']);
Route::middleware([GuestOnlyMiddleware::class])->post('/lecturer/login', [AuthController::class, 'lecturerLogin']);


Route::post('/auth/student', [AuthController::class, 'student']);
Route::post('/auth/lecturer', [AuthController::class, 'lecturer']);
Route::post('/auth/admin', [AuthController::class, 'administrator']);





