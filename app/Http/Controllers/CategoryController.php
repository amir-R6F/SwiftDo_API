<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function get_categories()
    {
        $categories = Category::all();
        return response()->json(['list' => $categories, 'status' => 200], 200);
    }

    public function get_category_todo(Request $request)
    {
        $todos = Todo::where('category', $request->id)->get();
        return response()->json(['todos' => $todos, 'status' => 200], 200);
    }

    public function new_category(Request $request)
    {
        $cat = Category::create($request->all());
        if ($cat)
            return response()->json(['message' => 'category created successfully', 'data' => $cat, 'status' => 200], 200);
        else
            return response()->json(['message' => 'there was problem, try again.', 'status' => 401]);
    }

    public function update_category(Request $request)
    {
        $cat_up = Category::firstWhere('id', $request->id)->update($request->all());
        $cat = Category::firstWhere('id', $request->id);
        if ($cat)
            return response()->json(['message' => 'category updated successfully', 'data' => $cat, 'status' => 200], 200);
        else
            return response()->json(['message' => 'there was problem, try again.', 'status' => 401]);
    }

    public function delete_category(Request $request)
    {
        $cat = Category::firstWhere('id', $request->id)->delete();
        return response()->json(['message' => 'category deleted successfully.', 'data'=> $request->id, 'status' => 200], 200);
    }
}
