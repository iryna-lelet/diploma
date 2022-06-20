<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class CategoriesController extends Controller
{
    public function category()
    {
        try {
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        return response()->json(Category::get(), 200);
    }

    public function getCategoryById($id)
    {
        try {
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        $category = Category::find($id);

        if(is_null($category)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        return response()->json($category, 200);
    }

    public function saveCategory(Request $request)
    {
        try {
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        $rules = [
            'name' => 'required',
            'type_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $category = Category::create($request->all());

        return response()->json($category, 201);
    }

    public function deleteCategory($id)
    {
        try {
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        $category = Category::find($id);

        if(is_null($category)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }

        $category->delete();

        return response()->json('', 204);
    }
}
