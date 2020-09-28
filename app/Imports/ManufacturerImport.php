<?php

namespace App\Imports;

use App\Models\Manufacturer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ManufacturerImport implements ToCollection, WithHeadingRow, WithBatchInserts
{
    public function collection(Collection $rows)
    {
        $unique_rows = $rows->unique('manufacturer_name');

        foreach ($unique_rows as $row)
        {
            Manufacturer::firstOrCreate([
                'name' => $row['manufacturer_name'],
            ]);
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
