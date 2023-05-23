<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Students;
use App\Models\Lecturers;
use App\Models\User;


use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    function studentLogin(Request $request){


    }

    function lecturerLogin(Request $request){

    }

    function adminLogin(Request $request){

    }

     function studentRegister(Request $request){
        $rules  = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'username' => 'required|string|unique:students,username',
            'password' => 'required|string|min:8|confirmed',
            'programme_id' => 'nullable|exists:programmes,id',
            'current_level' => 'nullable',
       ];
       $messages = [
            'programme_id.exists' => 'The selected programme does not exist.',
            'current_level.in' => 'The selected level is invalid.',
        ];

        $validated = $request->validate($rules,$messages);
        $student = new Students;
        $student->fill($validated);
        $student->password = bcrypt($request->password);
        $student->save();
        $token  = $student->createToken('studentToken')->plainTextToken;

        return response()->json([
            'message' => 'Student created successfully',
            'data' => $student,
            'token' => $token
        ], 201);
    }

    function lecturerRegister(Request $request){
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|unique:lecturers,email|email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'nullable|in:lecturer,teaching assistant',
        ];

        $validated = $request->validate($rules);

        $lecturer = new Lecturers;
        $lecturer->fill($validated);
        $lecturer->password = bcrypt($request->password);
        $lecturer->save();
        $token = $lecturer->createToken('lecturerToken')->plainTextToken;

        return response()->json(['message' => 'Lecturer created successfully', 'data' => $lecturer, 'token' => $token],201);
    }

    function adminRegister(Request $request){
         $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|unique:lecturers,email|email|max:255',
            'password' => 'required|string|min:8|confirmed'
        ];

        $validated = $request->validate($rules);

        $user = new User();
        $user->fill($validated);
        $user->password = bcrypt($request->password);
        $user->save();
        $token = $user->createToken('lecturerToken')->plainTextToken;

        return response()->json(['message' => 'Admin created successfully', 'data' => $user, 'token' => $token],201);
    }

}
