<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Programmes;
use App\Models\Courses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        $programme = Programmes::where('id', $id)
            ->orWhere('programme_code',$id)
           // ->orWhere('course_code','LIKE' ,"%$id%")
            ->first();

        if (!$programme) {
            return response()->json(['error' => 'No programme found'], 404);
        }
        $programme['courses'] = $programme->courses;

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

    public function addCourseToProgramme($programmeId, $courseId)
    {
        try {
        $programme = Programmes::findOrFail($programmeId);
            try {
                    $course = Courses::findOrFail($courseId);
                    try {
                        $programme->courses()->attach($course, [], true);
                    } catch (Exception $e) {
                        return response()->json([
                            'error' => $e
                        ], 409);
                    }
                } catch (ModelNotFoundException $e) {
                        return response()->json([
                        'error' => 'Course not found.'
                    ], 404);
                }
            // Return a response indicating success
            return response()->json([
                'message' => 'Course added to programme successfully.'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Programme not found.'
            ], 404);
        }
    }

    public function addProgrammeToCourse($courseId, $programmeId)
    {
        $course = Courses::findOrFail($courseId);
        $programme = Programmes::findOrFail($programmeId);

        $course->programmes()->attach($programme);

        // Return a response indicating success
        return response()->json([
            'message' => 'Programme added to course successfully.'
        ]);
    }

    /**
     * Add a course to a program.
     *
     * @param  int  $programmeId
     * @param  int  $courseId
     * @return \Illuminate\Http\Response
     */

}
