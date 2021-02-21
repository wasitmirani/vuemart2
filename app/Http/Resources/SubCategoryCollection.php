<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\URL;
use Illuminate\Http\Resources\Json\JsonResource;


class SubCategoryCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'thumbnail' => $this->thumbnail,
            'status' => $this->status,
            'category_id' => $this->category_id,
            'thumbnailurl' => URL::to('/') . "/admin/img/subcategories/" . $this->thumbnail,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'category' => $this->whenLoaded('category', function () {

                return new CategoryCollection($this->category);
            })
        ];
    }
}
