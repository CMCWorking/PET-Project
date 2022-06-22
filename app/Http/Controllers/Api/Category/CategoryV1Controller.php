<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryV1Controller extends Controller
{
    /**
     * > Get all categories
     *
     * @param version The version of the API you are using.
     *
     * @return A list of all categories.
     */
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

    /**
     * It creates a category.
     *
     * @param version The version of the API you want to access.
     * @param Request request The request object.
     */
    public function createCategory($version, Request $request)
    {
        try {
            $category = Category::create([
                'name' => $request->name,
                'description' => $request->description,
                'slug' => Str::slug($request->name),
                'image' => $request->image,
                'status' => $request->status,
                'keywords' => $request->keywords,
                'parent_id' => $request->parent_id,
            ]);

            return response()->success($category, 'Successfully created category.', 201);
        } catch (ModelNotFoundException $ex) {
            return response()->error('Category not found.');
        } catch (Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * It returns a category if it exists, otherwise it returns an error
     *
     * @param version The version of the API you are using.
     * @param slug The slug of the category you want to retrieve.
     *
     * @return A category object.
     */
    public function getDetail($version, $id)
    {
        try {
            $category = Category::findOrFail($id);

            return response()->success($category);
        } catch (ModelNotFoundException $ex) {
            return response()->error('Category not found.');
        } catch (Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * It updates the category details.
     *
     * @param version The version of the API you are using.
     * @param Request request The request object.
     * @param id The id of the category to be updated.
     */
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

    /**
     * > Delete a category by id
     *
     * @param version The version of the API you're using.
     * @param id The id of the category to delete.
     *
     * @return A response object.
     */
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
