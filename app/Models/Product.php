<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['model_number', 'category_id', 'deparment_id', 'manufacturer_id', 'upc', 'sku', 'regular_price', 'sale_price', 'description', 'regular_price', 'url'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function deparment()
    {
        return $this->belongsTo(Deparment::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
}
