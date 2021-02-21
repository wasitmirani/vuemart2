<?php

use App\Helpers\Component;
use Illuminate\Support\Str;

use function PHPUnit\Framework\fileExists;

function icons_img($filename, $type)
{

    if (!empty($filename)) {
        if ($type == "png")
            return asset("/admin/icons/png/" . $filename);
        if ($type == "svg")
            return asset("/admin/icons/svg/" . $filename);
    }

    return asset("/admin/icons/default.png");
}

function SingleImgUpload($request, $path)
{
    if ($request->hasfile('thumbnail')) {
        $name = Str::slug($request->name, '-')  . "-" . time() . '.' . $request->thumbnail->extension();
        $request->thumbnail->move(public_path($path), $name);
    } else
        $name = "";
    return $name;
}

function getAppSetting(){
    return Component::getAppSetting();
}
function productImage($filename)
{
    if (!empty($filename)) {
        return asset('/admin/img/products/' . $filename);
    } else
        return asset('/admin/img/default.png');
}

function categoryImage($filename)
{

    return asset('/admin/img/categories/' . $filename);
}
function sliderImage($filename)
{

    return asset('/admin/img/slider/' . $filename);
}
function AuthImage($filename)
{
    if(!empty($filename))
    return asset('/admin/img/users/' . $filename);
    else
    return asset('/admin/img/users/default.png');
}


function deleteFile($path, $filename)
{

    $existsfile=file_exists(public_path()."".$path . "/" . $filename);

    if($existsfile)
        unlink(public_path($path . "/" . $filename));
}


function boolValConverter($value)
{


    if ($value == true & $value == "true" || $value == 1)
        return 1;
    else
        return 0;
}

function getCategories()
{
    return   Component::getCategories();
}
function shortTimer()
{

    return  now()->addSeconds(20);
}
function sessionTimer()
{

    return  now()->addSeconds(20);
}
