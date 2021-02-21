<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function index()
    {
        $query = request('query');
        $categories = Category::orderBy('name', 'ASC')->where('name', 'like', '%' . $query . '%')->paginate(env('PER_PAGE'));
        CategoryCollection::collection($categories);

        $collect = Category::withTrashed()->get();
        $collect = collect($collect);
        $total = $collect->count();
        $active = $collect->where('status', 1)->count();
        $disable = $collect->where('status', 0)->count();
        $trashed = $collect->whereNotNull('deleted_at')->count();
        return response()->json(['categories' => $categories, 'total' => $total, 'active' => $active, 'disable' => $disable, 'trashed' => $trashed], 200);
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'unique:categories'],
        ]);
        $thumbnail = SingleImgUpload($request, 'admin/img/categories');

        Category::create([
            'name' => $request->name,
            'thumbnail' => $thumbnail,
            'status' => boolValConverter($request->isFeatured),
        ]);

        return response()->json(['success'], 200);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:categories,name,' . $request->id],
        ]);
        $category = Category::where('id', $request->id)->first();
        if ($request->hasFile('thumbnail')) {
            $thumbnail = SingleImgUpload($request, 'admin/img/categories');
        } else {

            $thumbnail = $category->thumbnail;
        }

        $updated = Category::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'status' => boolValConverter($request->isFeatured),
                'thumbnail' => $thumbnail,
            ]);
        if ($updated)
            return response()->json($updated);
    }

    public function uploadCategory(Request $request)
    {
        SingleImgUpload($request, 'admin/img/categories');
    }
    public function destroy($id)
    {
        $deleted = Category::destroy($id);
        if ($deleted)
            return response()->json($deleted);
    }

    public function trashedCategory()
    {
        $query = request('query');
        $categories = Category::onlyTrashed()->orderBy('name', 'ASC')->where('name', 'like', '%' . $query . '%')->paginate(env('PER_PAGE'));
        CategoryCollection::collection($categories);
        return response()->json($categories, 200);
    }

    public function restoreCategory(Request $request)
    {
        $category = Category::withTrashed()->find($request->id)->restore();
        if ($category) {
            return response()->json($category);
        }
    }

    public function permanentlyDeleteCategory(Request $request)
    {
        $category = Category::withTrashed()->find($request->id)->forceDelete();
        if ($category) {
            return response()->json($category);
        }
    }
}
