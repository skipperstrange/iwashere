<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Students;
use App\Models\Courses;
use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){

    }

    /**
     * Display the specified resource.
     */
    public function show(Students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Students $students)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Students $students)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Students $students)
    {
        //
    }

    function  courses(Request $request){

        //dd($user = Auth::guard('sanctum')->user());

        $student = Auth::guard('sanctum')->user();

        if (!$student) {
            return response()->json(['error' => 'No programme found'], 404);
        }
        $student['courses'] = $student->courses;

        return response()->json([
            'data' =>  $student,
        ]);
    }
}
