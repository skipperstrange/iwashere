<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CoursesController;
use App\Http\Controllers\Api\StudentsController;
use App\Http\Controllers\Api\LecturersController;
use App\Http\Controllers\Api\ProgrammesController;
use App\Http\Controllers\Api\ProgrammeCoursesController;


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
//Route::resou('courses', [CoursesController::class, 'store']);
Route::get('/', function(){
    return "Hi";
});

Route::resource('students', StudentsController::class);
Route::resource('lecturers', LecturersController::class);
Route::resource('programmes', ProgrammesController::class);
Route::resource('courses', CoursesController::class);

Route::get('/courses/search/{query}', [CoursesController::class, 'search']); //Search for a course

//Route::post('/addprogrammecourse', [ProgrammeCoursesController::class, 'attachCourseToProgramme']);

Route::group(['middleware'=>'auth:sanctum'], function(){
Route::post('/addprogrammecourse', [ProgrammeCoursesController::class, 'attachCourseToProgramme']);

});
