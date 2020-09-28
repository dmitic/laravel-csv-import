<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'model_number' => $this->model_number,
            'category_id' => $this->category->id,
            'category_name' => $this->category->name,
            'deparment_id' => $this->deparment->id,
            'deparment_name' => $this->deparment->name,
            'manufacturer_id' => $this->manufacturer->id,
            'manufacturer_name' => $this->manufacturer->name,
            'upc' => $this->upc,
            'sku'=> $this->sku,
            'regular_price' => $this->regular_price,
            'sale_price' => $this->sale_price,
            'description' => $this->description,
            'url' => $this->url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
