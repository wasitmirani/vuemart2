<?php

namespace App\Http\Controllers\Admin\Slider;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    //
    public function index(){
        $query = request('query');
        $sliders=Slider::orderBy('sort','DESC')->where('heading', 'like', '%' . $query . '%')->paginate(env('PER_PAGE'));
        return response()->json( $sliders);
    }
    public function store(Request $request){


        $thumbnail = SingleImgUpload($request, 'admin/img/slider');

        $newslider=Slider::create([
            'heading'=>$request->name,
            'subheading'=>$request->subheading,
            'link'=>$request->link,
            'sort'=>$request->sort,
            'thumbnail'=>$thumbnail,
        ]);
        $others=Slider::where('sort',$newslider->sort)->whereNotIn('id',[$newslider->id])->pluck('id');
        Slider::whereIn('id',$others)->update(['sort'=>null]);
        return response()->json();
    }

    public function update(Request $request){
        $Slider = Slider::where('id', $request->id)->first();
        if ($request->hasFile('thumbnail')) {
            $thumbnail = SingleImgUpload($request, 'admin/img/slider');
        } else {

            $thumbnail = $Slider->thumbnail;
        }

        Slider::where('id',$request->id)->update([
            'heading'=>$request->name,
            'subheading'=>$request->subheading,
            'link'=>$request->link,
            'sort'=>$request->sort,
            'thumbnail'=>$thumbnail,
        ]);
        $others=Slider::where('sort',$request->sort)->whereNotIn('id',[$request->id])->pluck('id');
        Slider::whereIn('id',$others)->update(['sort'=>null]);
        return response()->json();
    }

    public function destroy($id){
        Slider::destroy($id);

    }
}
