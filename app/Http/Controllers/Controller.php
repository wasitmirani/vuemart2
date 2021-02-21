<?php

namespace App\Http\Controllers;

use App\Models\SeoContent;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function __construct()
    {

        $this->seo_tags();
    }

    public function seo_tags()
    {
        $currenct_url = request()->path();

        $check = SeoContent::where('page_url', $currenct_url)->count();

        if ($check > 0) {
            $content = SeoContent::where('page_url', $currenct_url)->first();
            // SEOTools::setTitle($content->page_title);
            // SEOTools::setDescription($content->meta_description);


            \Config::set('meta.Is_seoTags', "1");
            \Config::set('meta.meta_title', $content->page_title);
            \Config::set('meta.meta_description', $content->meta_description);
        }
    }
}
