<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Deparment;
use App\Models\Manufacturer;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $categories = Category::get()->pluck('id');
        $deparments = Deparment::get()->pluck('id');
        $manufacturers = Manufacturer::get()->pluck('id');

        return [
            'model_number' => 'string',
            'category_id' => 'numeric|in:' . $categories,
            'deparment_id' => 'numeric|in:' . $deparments,
            'manufacturer_id' => 'numeric|in:' . $manufacturers,
            'upc' => 'numeric',
            'sku' => 'numeric',
            'regular_price' => array('regex:/^(\d+(?:[\.\,]\d{1,2})?)$/'),
            'sale_price' => array('regex:/^(\d+(?:[\.\,]\d{1,2})?)$/'),
            'description' => 'string',
            'url' => 'url'
        ];
    }
}
