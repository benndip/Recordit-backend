<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();

        return response()->json([
            'success' => 'true',
            'todos' => $todos,
        ], 200);
        
    }
}
