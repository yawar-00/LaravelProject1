<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class studentController extends Controller
{
    public function show()
    {
        $student = Student::get();
        return view('contact.showdata', compact('student'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'enroll' => 'required|max:255|string',
            'mob' => 'required|string|between:9,11'
        ]);
        Student::create([
            'name' => $request->name,
            'enroll' => $request->enroll,
            'mob' => $request->mob
        ]);
        // dd($request);
        return redirect()->back()->with('status', 'Inserted');
    }
    public function edit(int $id)
    {
        $student = Student::findOrFail($id);
        // return $student;
        return view('edit', compact('student'));
    }
    public function update(Request $request, int $id)
    {
        // $student=Student::findOrFail($id);
        $request->validate([
            'name' => 'required|max:255|string',
            'enroll' => 'required|max:255|string',
            'mob' => 'required|string|between:9,11'
        ]);
        Student::findOrFail($id)->update([
            'name' => $request->name,
            'enroll' => $request->enroll,
            'mob' => $request->mob
        ]);
        // dd($request);
        return redirect('contact/show')->with('status', 'Updated');
    }
    public function delete(int $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect('contact/show')->with('status', 'deleted');
    }
}