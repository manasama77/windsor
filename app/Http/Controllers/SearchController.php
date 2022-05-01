<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function autocomplete_student(Request $request)
    {
        $data = [];
        if ($request->filled('q')) {
            $data = Student::select('id', 'name')
                ->where('name', 'LIKE', '%' . $request->get('q') . '%')
                ->get();
        }

        return response()->json($data);
    }
}
