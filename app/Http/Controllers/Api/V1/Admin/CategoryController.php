<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryCreateRequest;
use App\Http\Resources\Admin\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return new CategoryCollection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
       return true;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request)
    {
        $category = $request->all();
        try {
            $result = Category::create($category);
            return response()->json(['message' => 'دسته بندی با موفقیت ایجاد شد'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryCreateRequest $request, Category $category)
    {
        $data = $request->all();
        try {
            $category->update($data);
            return response()->json(['message' => 'دسته بندی با موفقیت تغییر یافت'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $result = $category->delete();
            return response()->json(['message' => 'دسته بندی با موفقیت حذف شد']);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }

    }
}
