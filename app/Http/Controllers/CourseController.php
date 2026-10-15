<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return view('courses.index', ['items' => config('catalog.items')]);
    }

    public function show(int $id)
    {
        $item = config("catalog.items.$id");
        abort_if(! $item, 404);
        
        return view('courses.show', ['id' => $id, 'item' => $item]);
    }
}