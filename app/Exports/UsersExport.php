<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection  , WithHeadings
{
    public function collection()
    {
        // return User::all();
        return DB::table('users')->select('name', 'email', 'password')->get();
    }

    public function headings(): array
    {
        return [
            'name',
            'email',
            'password',
        ];
    }
}
