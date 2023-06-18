<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Students;
use App\Models\Lecturers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    function studentLogin(Request $request){
         $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = Students::where(['email'=> $fields['email']])
        ->orWhere('username',$fields['email'])
        ->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response()->json(['message' =>'Invalid credentials'], 401);
        }
        $user->role = 'student';
        $token = $user->createToken('token')->plainTextToken;

        return response()->json(['message' => 'Success', 'data' => $user, 'token' => $token],200);
    }

    function lecturerLogin(Request $request){
         $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = Lecturers::where(['email'=> $fields['email']])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response()->json(['message' =>'Invalid credentials'], 401);
        }
        $token = $user->createToken('token')->plainTextToken;

        return response()->json(['message' => 'Success', 'data' => $user, 'token' => $token],200);
    }

    function adminLogin(Request $request){
         $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where(['email'=> $fields['email']])
        ->orWhere('username',$fields['email'])
        ->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response()->json(['message' =>'Invalid credentials'], 401);
        }
        $token = $user->createToken('token')->plainTextToken;

        return response()->json(['message' => 'Success', 'data' => $user, 'token' => $token],200);

    }

     function studentRegister(Request $request){
        $rules  = [
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:students,email',
            'username' => ['required', 'string', 'regex:/^[a-zA-Z0-9]+$/', 'unique:students,username'],
            'password' => 'required|string|min:8|confirmed',
            'programme_id' => 'nullable|exists:programmes,id',
            'current_level' => 'nullable',
       ];
       $messages = [
            'programme_id.exists' => 'The selected programme does not exist.',
            //'programme_id.nullable' => 'The programme id cannot be empty.',
            'current_level.in' => 'The selected level is invalid.',
            'username.regex' => 'The username field should not contain spaces or special characters.',
            'username.unique' => 'The usernamme already  exists.',
        ];

        $validated = $request->validate($rules,$messages);
        $student = new Students;
        $student->fill($validated);
        $student->password = bcrypt($request->password);
        $student->save();
        $token  = $student->createToken('studentToken')->plainTextToken;
        $student->type = 'student';
        $student->role = 'student';

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
            'phone' => 'required|string|max:13|min:10',
            'role' => 'nullable|in:lecturer,teaching assistant',
        ];
        $messages = [
            'email.unique' => 'Email already exists.',
            'username.regex' => 'The username field should not contain spaces or special characters.',
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
            'name' => 'required|unique:users|string|max:255',
            'username' => ['required', 'string', 'regex:/^[a-zA-Z0-9]+$/'],
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required'
        ];

        $messages = [
            'email.unique' => 'Email already exists.',
            'username.unique' => 'Username already exists.',
            'username.regex' => 'The username field should not contain spaces or special characters.',
        ];


        $validated = $request->validate($rules, $messages);

        $user = new User();
        $user->fill($validated);
        $user->password = bcrypt($request->password);
        $user->save();
        $token = $user->createToken('token')->plainTextToken;

        return response()->json(['message' => 'Admin created successfully', 'data' => $user, 'token' => $token],201);
    }

    function logout() {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }

}
