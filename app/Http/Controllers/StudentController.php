<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('phones')->latest()->get();
        return view('students.index', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phones' => 'required|array|min:1',
            'phones.*' => 'required|string|max:20'
        ]);

        $student = Student::create(['name' => $request->name]);

        foreach($request->phones as $number){
            $student->phones()->create(['number' => $number]);
        }

        return redirect()-> back()->with('success', 'Student created!');
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string',
            'phones' => 'required|array|min:1',
            'phones.*' => 'required|string|max:20'
        ]);

        $student->update(['name' => $request->name]);

        $student->phones()->delete();
        foreach($request->phones as $number){
            $student->phones()->create(['number' => $number]);
        }

        return redirect()->back()->with('success', 'Student updated!');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->back()->with('success', 'Student deleted!');
    }
}
