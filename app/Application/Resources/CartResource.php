<?php
namespace App\Application\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $content = json_decode($this->content);
        $settings = getSiteSettings();
        $total = $content->qty * $content->price;
        $tax = $total * ((int)$settings['tax'] / 100);
        return [
            'key' => $this->key,
            "name" => $content->name,
            "qty" => $content->qty,
            "price" => $content->price,
            "weight" => $content->weight,
            "options" => $content->options,
            "tax" => $tax,
            "subtotal" => $total,
            "total" => $total + $tax
        ];
    }
}
