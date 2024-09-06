<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel,WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'cedula'        => $row['cedula'],
            'name1'         => $row['name1'],
            'name2'         => $row['name2'],
            'lastname1'     => $row['lastname1'],
            'lastname2'     => $row['lastname2'],
            'email'         => $row['email'],
            'tel_movil'     => $row['tel_movil'],
            'estado'        => $row['estado'],
            'password'      => Hash::make($row['password']),
            'avatar'        => $row['avatar'],

        ]);
    }
}
