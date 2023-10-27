<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $students = Student::count();
        $books = Book::count();

        return response()->json([
            'students' => $students,
            'books' => $books,
        ]);
    }
}
