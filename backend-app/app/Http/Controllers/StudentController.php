<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::whereRoleIs('student')->get();

        return response()->json($students, 200, [], JSON_PRETTY_PRINT);


    }

    public function store()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
