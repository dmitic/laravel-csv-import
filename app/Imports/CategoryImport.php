<?php

namespace App\Imports;

use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoryImport implements ToCollection, WithHeadingRow, WithBatchInserts
{
    public function collection(Collection $rows)
    {
        $unique_rows = $rows->unique('category_name');

        foreach ($unique_rows as $row)
        {
            Category::firstOrCreate([
                'name' => $row['category_name'],
            ]);
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }

}
