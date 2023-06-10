<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use http\Env\Response;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function get_todos()
    {
        $all = Todo::all()->count();
        $done = Todo::where('status','1')->count();
        return response()->json(['data' => ['all' => $all, 'done' => $done], 'status' => 200], 200);
    }

    public function new_todo(Request $request)
    {
        $todo = Todo::create($request->all());
        if ($todo)
            return response()->json(['message' => 'todo created successfully', 'data' => $todo, 'status' => 200], 200);
        else
            return response()->json(['message' => 'there was problem, try again.', 'status' => 401]);
    }

    public function update_todo(Request $request)
    {
        $up_todo = Todo::firstWhere('id', $request->id)->update($request->all());
        $todo = Todo::firstWhere('id', $request->id);
        if ($todo)
            return response()->json(['message' => 'todo updated successfully', 'data' => $todo, 'status' => 200], 200);
        else
            return response()->json(['message' => 'there was problem, try again.', 'status' => 401]);
    }

    public function delete_todo(Request $request)
    {
        Todo::firstWhere('id', $request->id)->delete();
        return response()->json(['message' => 'todo deleted successfully.', 'data'=> $request->id, 'status' => 200], 200);
    }

}
