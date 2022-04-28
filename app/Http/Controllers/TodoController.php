<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all(); //This line gets all the todos from the database

        return response()->json([
            'success' => 'true',
            'todos' => $todos,
        ], 200);
        
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => ['required', 'string', 'min:6']
        ]);

        $newTodo = Todo::create([
            'title' => $request->title,
        ]);


        return response()->json([
            'success' => 'true',
            'todos' => $newTodo,
        ],200);
    }

    public function update(Request $request, Todo $todo)
    {
        if(!$todo){
            return response()->json([
                'success' => 'false',
                'message' => 'Todo with this id does not exist'
            ], 404);
        }

        if($request->title){
            $todo->title = $request->title;
        }
        
        if($request->done)
        {
            $todo->done = $request->done;
        }

        $todo->save();

        return response()->json([
            'success' => 'true',
            'message' => 'Todo update successfuly'
        ]);
    }
}
