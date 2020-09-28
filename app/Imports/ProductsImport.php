<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Deparment;
use App\Models\Manufacturer;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow, WithBatchInserts
{
    private $category;
    private $deparment;
    private $manufacturer;

    public function __construct()
    {
        $this->category = Category::select('id', 'name')->get()->keyBy(function ($item) {
            return $item->name;
        })->toArray();

        $this->deparment = Deparment::select('id', 'name')->get()->keyBy(function ($item) {
            return $item->name;
        })->toArray();

        $this->manufacturer = Manufacturer::select('id', 'name')->get()->keyBy(function ($item) {
            return $item->name;
        })->toArray();
    }


    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'model_number' => $row['model_number'],
            'deparment_id' => $this->getDeparmentId($row['deparment_name']),
            'manufacturer_id' => $this->getManufacturerId($row['manufacturer_name']),
            'category_id' => $this->getCategoryId($row['category_name']),
            'upc' => $row['upc'],
            'sku' => $row['sku'],
            'sale_price' => $row['sale_price'],
            'description' => $row['description'],
            'regular_price' => $row['regular_price'],
            'url' => $row['url'],
        ]);
    }

    private function getCategoryId($name)
    {
        $category = $this->category[$name] ?? null;
        if(!$category) return null;

        return $category['id'];
    }

    private function getDeparmentId($name)
    {
        $deparment = $this->deparment[$name] ?? null;
        if(!$deparment) return null;

        return $deparment['id'];
    }

    private function getManufacturerId($name)
    {
        $manufacturer = $this->manufacturer[$name] ?? null;
        if(!$manufacturer) return null;

        return $manufacturer['id'];
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
