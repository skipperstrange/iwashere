<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\ProgrammeCourses;
use App\Models\Programmes;

class CoursesController extends Controller
{
    public function index(){
        //return config(DB_CONNECTION);
        return Courses::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'course_code' => 'required|unique:courses',
            'course_name' => 'required',
            'credit_unit' => 'required|integer',
            'course_desc' => 'nullable',
            //'course_start' => 'required|date',
            //'course_end' => 'required|date|after_or_equal:course_start',
        ]);

        $course = Courses::create($validatedData);

        return response()->json([
            'message' => 'Course created successfully.',
            'data' => $course,
        ], 201);
    }

    public function show($id)
    {
        $course = Courses::where('id', $id)
            ->orWhere('course_code',$id)
           // ->orWhere('course_code','LIKE' ,"%$id%")
            ->first();

        if (!$course) {
            return response()->json(['error' => 'No course found'], 404);
        }

        return response()->json($course);
    }

    function search($query){
         return response()->json(
            Courses::where('title','like',"%$query%")
            ->orWhere('course_code', 'like', '%'.$query.'%')
            ->orWhere('code', 'like', '%'.$query.'%'));
    }
}
