<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::paginate(8);

        return response()->json($students);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->all();
        $student = Student::create($data);

        return response()->json($student);
    }
}
