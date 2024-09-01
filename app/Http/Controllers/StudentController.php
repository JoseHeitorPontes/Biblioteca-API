<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentCollection;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::paginate(10);

        return new StudentCollection($students);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $student = Student::create($data);

        return response()->json($student, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            throw ValidationException::withMessages([
                'student' => 'Aluno não existente!',
            ]);
        }

        $student->destroy();

        return response()->json([
            'message' => 'Aluno excluido com sucesso!',
        ]);
    }
}
