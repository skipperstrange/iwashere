<?php

namespace App\Http\Controllers;

use App\Models\ProgrammeCourses;
use App\Models\Courses as Course;
use App\Models\Programmes as Programme;
use Illuminate\Http\Request;

class ProgrammeCoursesController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgrammeCourses $programmeCourses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgrammeCourses $programmeCourses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgrammeCourses $programmeCourses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgrammeCourses $programmeCourses)
    {
        //
    }

    public function attachCourseToProgramme(Request $request)
    {
        $programme = Programme::findOrFail($request->programme_id);
        $course = Course::findOrFail($request->course_id);

        $programme->courses()->attach($course);

        return response()->json([
            'message' => 'Course attached to programme successfully.'
        ]);
    }
}
