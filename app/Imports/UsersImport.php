<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UsersImport implements ToModel ,WithChunkReading , ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name'     => $row[1],
            'email'    => $row[2],
            'password' => Hash::make("123456789"),
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
