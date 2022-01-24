<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class EmployeesImport implements ToModel, WithHeadingRow, WithStartRow, WithCustomCsvSettings
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
        return new Employee([
           
            'name'  => $row['name'],
            'email' => $row['email'],
            'password' => $row['password'],
            'phone'    => $row['phone'],
            'address'    => $row['address'],
            'profile'    => $row['profile'],
            'created_user_id'    => $row['created_user_id'],
            'role_id'    => $row['role_id'],
            'department_id'    => $row['department_id'],
            'created_at'    => $row['created_at'],
            'updated_at'    => $row['updated_at'],
        ]);
    }
}
