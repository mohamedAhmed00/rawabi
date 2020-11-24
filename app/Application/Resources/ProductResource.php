<?php
namespace App\Application\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
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
            'slug' => $this->slug,
            'cutting' => $this->cutting,
            'image' => Storage::url($this->image),
            'product_options' => ProductCategoriesResource::collection($this->categories)
        ];
    }
}
