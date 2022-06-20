<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoriesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, Category $category)
    {
        $category->create($request->only(['name', 'type_id']));

        return redirect()->route('settings')->withSuccess('Created category '.$request->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return Response
     */
    public function destroy(Request $request, Category $category)
    {
        $ids = explode(",", $request->ids);
        $category->deleteCategories($ids);

        return redirect()->route('settings')->withDanger('Selected categories are deleted');
    }
}
