<?php

namespace App\Http\Controllers\Admin\Seo;

use App\Models\Category;
use App\Models\SeoContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeoController extends Controller
{
    //

    public function index()
    {
        $query = request('query');
        $seo = SeoContent::orderBy('page_title', 'ASC')
        ->where('page_title', 'like', '%' . $query . '%')
        ->orWhere('page_url', 'like', '%' . $query . '%')->paginate(env('PER_PAGE'));

        return response()->json($seo);
    }

    public function store(Request $request){
        $request->validate([
            'pageurl' => ['required', 'unique:seo_contents,page_url'],
        ]);
        SeoContent::create([
            'page_title'=>$request->pagetitle,
            'page_url'=>$request->pageurl,
            'meta_description'=>$request->metadescription,
        ]);

        return response()->json();
    }
    public function update(Request $request){
        $request->validate([
            'pageurl' => ['required', 'unique:seo_contents,page_url,' . $request->id],
        ]);
        SeoContent::where('id',$request->id)->update([
            'page_title'=>$request->pagetitle,
            'page_url'=>$request->pageurl,
            'meta_description'=>$request->metadescription,
        ]);

        return response()->json();
    }

    public function destroy($id)
    {
        $deleted = SeoContent::destroy($id);
        if ($deleted)
            return response()->json($deleted);
    }
}
