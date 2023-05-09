<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Programmes;
use App\Models\Courses;
use Illuminate\Http\Request;

class ProgrammesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Programmes::all();
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
        $rules = [
            'title' => 'required|string|max:255',
            'programme_code' => 'required|unique:programmes,programme_code|string|max:255',
            'desc' => 'nullable|string'
        ];

        $validated = $request->validate($rules);

        $programme = new Programmes;
        $programme->fill($validated);
        $programme->save();

        return response()->json(['message' => 'Programme created successfully', 'data' => $programme]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $programme = Programmes::find($id);

        if (!$programme) {
            return response()->json(['error' => 'Course not found'], 404);
        }
        $programme['courses'] = $programme->course;

        return response()->json($programme);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Programmes $programmes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Programmes $programmes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Programmes $programmes)
    {
        //
    }

    /**
     * Add a course to a program.
     *
     * @param  int  $programmeId
     * @param  int  $courseId
     * @return \Illuminate\Http\Response
     */
    public function addCourse(Request $request)
    {
        // Find the program by ID
        $programme = Programmes::find($request->programme_id);

        // Find the course by ID
        $course = Courses::find($request->course_id);

        // Add the course to the program's courses
        $programme->courses()->attach($course);

        // Return a response
        return response()->json([
            'message' => 'Course added to program successfully.',
            'programme' => $programme->load('courses'),
        ], 200);
    }
}
