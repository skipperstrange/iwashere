<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Students;

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
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'username' => 'required|string|unique:students,username',
            'password' => 'required|string|min:8',
            'programme_id' => 'required|exists:programmes,id',
            'current_level' => 'nullable|in:100,200,300,400',
        ];

        $messages = [
            'programme_id.exists' => 'The selected programme is invalid.',
            'current_level.in' => 'The selected level is invalid.',
        ];

        $validatedData = $request->validate($rules, $messages);

        $student = Students::create($validatedData);

        return response()->json([
            'message' => 'Student created successfully',
            'data' => $student,
        ], 201);
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
}
