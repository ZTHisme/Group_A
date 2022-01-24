<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class EmployeesExport implements FromCollection, WithCustomCsvSettings, WithHeadings
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function headings(): array
    {
        return [
            
            'Name',
            'Email',
            'Phone',
            'Address',
            'Profile',
            'Created_User_Id',
            'Role_Id',
            'Department_Id',
            'Created_at',
            'Updated_at'
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Employee::select(
            [
               
                'name',
                'email',
                'phone',
                'address',
                'profile',
                'created_user_id',
                'role_id',
                'department_id',
                'created_at',
                'updated_at'
            ])->get();
    }
}