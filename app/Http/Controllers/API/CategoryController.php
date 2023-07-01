<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\TodoResource;
use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends BaseController
{
    public function index():JsonResponse
    {
        $Categories = Category::all();
        return $this->sendResponse(CategoryResource::collection($Categories), 'Categories retrieved successfully.');
    }

    public function store(Request $request):JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
        ]);

        if ($validator->fails()) {

            return $this->sendError('Validation Error.', $validator->errors());

        }

        $category = Category::create($input);

        return $this->sendResponse(new CategoryResource($category), 'Category created successfully.');
    }

    public function show($id):JsonResponse
    {
        $Category = Category::find($id);
        $Todos = Todo::where('category', $id)->get();

        if (is_null($Category)) {
            return $this->sendError('Category not found.');
        }

        return $this->sendResponse(TodoResource::collection($Todos), 'Todos retrieved successfully.');
    }

    public function update(Request $request, Category $category):JsonResponse
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'title' => 'required',
        ]);


        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $category->title = $input['title'];

        $category->save();


        return $this->sendResponse(new CategoryResource($category), 'Category updated successfully.');
    }

    public function destroy(Category $category):JsonResponse
    {
        $category->delete();
        return $this->sendResponse([], 'Category deleted successfully.');
    }
}
