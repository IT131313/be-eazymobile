<?php

namespace App\Http\Controllers\Api\Auth;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'fullname' => 'required',
            'studyprogram_id' => 'required',
            'student_school_year' => 'required',
            'student_type_id' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
        ]);

        $student_number = $this->generateStudentNumber();
        $student = Student::create([
            'student_number' => $student_number,
            'student_id' => $request->student_id,
            'fullname' => $request->fullname,
            'studyprogram_id' => $request->studyprogram_id,
            'student_school_year' => $request->student_school_year,
            'student_type_id' => $request->student_type_id,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        return response()->json(['message' => 'Student successfully created'],201);
    }

    public function show($student_number)
    {
        return Student::findOrFail($student_number);
    }

    public function update(Request $request, $student_number)
    {
        $student = Student::findOrFail($student_number);

        $request->validate([
            'student_id' => 'sometimes|required',
            'fullname' => 'sometimes|required',
            'studyprogram_id' => 'sometimes|required',
            'student_school_year' => 'sometimes|required',
            'student_type_id' => 'sometimes|required',
            'gender' => 'sometimes|required',
            'email' => 'sometimes|required|email',
            'phone_number' => 'sometimes|required',
        ]);

        $student->update($request->all());

        return response()->json(['message' => 'Student successfully updated'], 200);
    }

    public function destroy($student_number)
    {
        $student = Student::findOrFail($student_number);
        $student->delete();

        return response()->json(['message' => 'Student successfully deleted'], 200);
    }

    private function generateStudentNumber()
    {
        // Implementasi logika untuk generate student number dengan sequence
        // Contoh:
        $lastStudent = Student::orderBy('student_number', 'desc')->first();
        return $lastStudent ? $lastStudent->student_number + 1 : 1;
    }

}