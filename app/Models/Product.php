<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function productImages()
    {

        return $this->hasMany(ProductImages::class);
    }



    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }
}
