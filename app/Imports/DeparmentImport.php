<?php

namespace App\Imports;

use App\Models\Deparment;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DeparmentImport implements ToCollection, WithHeadingRow, WithBatchInserts
{
    public function collection(Collection $rows)
    {
        $unique_rows = $rows->unique('deparment_name');

        foreach ($unique_rows as $row)
        {
            Deparment::firstOrCreate([
                'name' => $row['deparment_name'],
            ]);
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
