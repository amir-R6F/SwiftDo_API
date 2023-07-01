<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends BaseController
{
    public function index():JsonResponse
    {
        $Todos = Todo::all();
        return $this->sendResponse(TodoResource::collection($Todos), 'Todos retrieved successfully.');
    }

    public function store(Request $request):JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'subject' => 'required',
        ]);

        if ($validator->fails()) {

            return $this->sendError('Validation Error.', $validator->errors());

        }

        $todo = Todo::create($input);

        return $this->sendResponse(new TodoResource($todo), 'Todo created successfully.');
    }

//    public function show():JsonResponse
//    {
//
//    }

    public function update(Request $request, Todo $todo):JsonResponse
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'subject' => 'required',
        ]);


        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $todo->subject = $input['subject'];

        $todo->save();


        return $this->sendResponse(new TodoResource($todo), 'Todo updated successfully.');
    }

    public function destroy(Todo $todo):JsonResponse
    {
        $todo->delete();
        return $this->sendResponse([], 'Todo deleted successfully.');
    }
}
