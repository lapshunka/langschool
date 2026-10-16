<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        $items = DB::table('courses')
            ->join('languages', 'courses.language_id', '=', 'languages.id')
            ->select('courses.*', 'languages.name as language_name')
            ->orderBy('courses.title')
            ->get();

        return view('courses.index', compact('items'));
    }

    public function show(int $id)
    {
        $item = DB::table('courses')
            ->join('languages', 'courses.language_id', '=', 'languages.id')
            ->select('courses.*', 'languages.name as language_name')
            ->where('courses.id', $id)
            ->first();

        abort_if(!$item, 404);

        return view('courses.show', compact('item'));
    }
}