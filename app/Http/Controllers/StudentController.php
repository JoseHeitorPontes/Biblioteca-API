<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentCollection;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $studentName = $request->studentName;

        $students = Student::when($studentName, function (Builder $query) use ($studentName) {
            $query->where('name', 'like', "%$studentName%");
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return new StudentCollection($students);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->all();

        $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $data['image'] = $fileName;

        Storage::disk('public')->putFileAs('images/students', $request->file('image'), $fileName);

        $student = Student::create($data);

        return response()->json($student);
    }

    public function destroy($id): JsonResponse
    {
        Student::destroy($id);

        return response()->json();
    }
}
