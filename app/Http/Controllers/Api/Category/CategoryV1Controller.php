<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryV1Controller extends Controller
{
    public function getList($version)
    {
        try {
            $categories = Category::all();

            return response()->success($categories);
        } catch (ModelNotFoundException $ex) {
            return response()->error('Category not found.');
        } catch (Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    public function getDetail($version, $slug)
    {
        try {
            $category = Category::whereSlug($slug)->firstOrFail();

            return response()->success($category);
        } catch (ModelNotFoundException $ex) {
            return response()->error('Category not found.');
        } catch (Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    public function updateDetail($version, Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);

            $category->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'image' => $request->image,
                'parent_id' => $request->parent_id,
                'keywords' => $request->keywords,
                'status' => $request->status,
            ]);

            return response()->success([], 'Category updated.');
        } catch (ModelNotFoundException $ex) {
            return response()->error('Category not found.');
        } catch (Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    public function deleteCategory($version, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return response()->success([], 'Category deleted.');
        } catch (ModelNotFoundException $ex) {
            return response()->error('Category not found.');
        } catch (Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }
}
