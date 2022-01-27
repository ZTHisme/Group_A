<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\MstCalender;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class MstCalendarsImport implements ToModel, WithHeadingRow, WithStartRow, WithCustomCsvSettings
{
    public function startRow(): int
    {
        return 2;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new MstCalender([
            'year'  => $row['year'],
            'month' => $row['month'],
            'working_days' => $row['working_days'],
            'created_at'    => $row['created_at'],
            'updated_at'    => $row['updated_at'],
        ]);
    }
}
