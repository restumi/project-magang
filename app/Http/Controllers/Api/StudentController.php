<?php

namespace App\Http\Controllers\Api;

use App\Classes\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Hobby;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('phones', 'nisn', 'hobbies')->latest()->get();
        return apiResponse::success($students, 'success get students');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'nisn' => 'required|string|unique:nisns,nisn',
            'phones' => 'required|array|min:1',
            'phones.*' => 'required|string|max:20',
        ],[
            'name.required' => 'name is required',
            'nisn.required' => 'nisn is required',
            'phones.required' => 'phones is required',
            'phones.*.required' => 'phones is required bre'
        ]);

        $student = Student::create(['name' => $request->name]);

        $student->nisn()->create(['nisn' => $request->nisn]);

        foreach($request->phones as $number){
            $student->phones()->create(['number' => $number]);
        }

        if($request->hobbies){
            $student->hobbies()->attach($request->hobbies);
        }

        $studentWithRelations = Student::with('phones', 'nisn', 'hobbies')->find($student->id);

        return apiResponse::success($studentWithRelations, "Student created", 201);
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string',
            'nisn' => 'required|string|unique:nisns,nisn,' . ($student->nisn?->id ?? '0'),
            'phones' => 'required|array|min:1',
            'phones.*' => 'required|string|max:20',
            'hobbies' => 'nullable|array',
            'hobbies.*' => 'exists:hobbies,id',
        ]);

        $student->update(['name' => $request->name]);

        $student->nisn()->update(['nisn' => $request->nisn]);

        $student->phones()->delete();
        foreach($request->phones as $number){
            $student->phones()->create(['number' => $number]);
        }

        $student->hobbies()->sync($request->hobbies ?? []);

        $student->load('phones', 'nisn', 'hobbies');

        return apiResponse::success($student, "Student updated");
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return apiResponse::success('', "Student deleted");
    }
}
