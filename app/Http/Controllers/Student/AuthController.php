<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session()->has('student_id')) {

            return redirect()->route('student.rules');

        }

        return view('student.auth.login');
    }

    public function login(Request $request)
    {
        
        $request->validate([

            'roll_no' => 'required',
            'password' => 'required',

        ]);

        $student = Student::where('roll_no', $request->roll_no)
                    ->where('is_active', true)
                    ->first();

        if (!$student) {

            return back()
                ->withInput()
                ->with('error', 'Student ID not found.');

        }

        
        if (!Hash::check($request->password, $student->password)) {

            return back()
                ->withInput()
                ->with('error', 'Invalid Password.');

        }

        session([

            'student_id' => $student->id,
            'student_name' => $student->first_name.' '.$student->last_name,
            'roll_no' => $student->roll_no,

        ]);

        return redirect()->route('student.rules');
    }

    public function logout()
    {
        session()->forget([
            'student_id',
            'student_name',
            'roll_no',
        ]);

        return redirect()->route('student.auth.login');
    }
}