<?php

namespace App\Http\Controllers\Admin\SubCategory;

use App\Models\User;
use App\Helpers\Component;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\SubCategoryCollection;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $query = request('query');
        $subCategories = SubCategory::orderBy('name', 'ASC')->where('name', 'like', '%' . $query . '%')->orwhereHas('category', function ($q) use ($query) {
            return $q->where('name', 'like', '%' . $query . '%');
        })->with('category')->paginate(env('PER_PAGE'));
        SubCategoryCollection::collection($subCategories);
        $categories = Component::getCategories();
        $collect = SubCategory::withTrashed()->get();
        $collect = collect($collect);
        $total = $collect->count();
        $active = $collect->where('status', 1)->count();
        $disable = $collect->where('status', 0)->count();
        $trashed = $collect->whereNotNull('deleted_at')->count();
        return response()->json(['categories' => $categories, 'subCategories' => $subCategories, 'total' => $total, 'active' => $active, 'disable' => $disable, 'trashed' => $trashed], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:sub_categories'],
        ]);
        $thumbnail = SingleImgUpload($request, 'admin/img/subcategories');
        SubCategory::create([
            'name' => $request->name,
            'thumbnail' => $thumbnail,
            'category_id' => $request->cateogry_id,
            'status' => boolValConverter($request->isFeatured),
        ]);

        return response()->json(['success'], 200);
    }


    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:categories,name,' . $request->id],
        ]);
        $subcategory = SubCategory::where('id', $request->id)->first();
        if ($request->hasFile('thumbnail')) {
            $thumbnail = SingleImgUpload($request, 'admin/img/subcategories');
        } else {

            $thumbnail = $subcategory->thumbnail;
        }

        $updated = SubCategory::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'status' => boolValConverter($request->isFeatured),
                'category_id' => $request->cateogry_id,
                'thumbnail' => $thumbnail,
            ]);
        if ($updated)
            return response()->json($updated);
    }


    public function destroy($id)
    {
        //
        $deleted = SubCategory::destroy($id);
        if ($deleted)
            return response()->json($deleted);
    }

    public function trashedCategory()
    {
        $query = request('query');
        $subCategories = SubCategory::onlyTrashed()->orderBy('name', 'ASC')->where('name', 'like', '%' . $query . '%')->with('category')->paginate(env('PER_PAGE'));
        SubCategoryCollection::collection($subCategories);
        return response()->json($subCategories, 200);
    }

    public function restoreCategory(Request $request)
    {
        $category = SubCategory::withTrashed()->find($request->id)->restore();
        if ($category) {
            return response()->json($category);
        }
    }

    public function permanentlyDeleteCategory(Request $request)
    {
        $category = SubCategory::withTrashed()->find($request->id)->forceDelete();
        if ($category) {
            return response()->json($category);
        }
    }
}
