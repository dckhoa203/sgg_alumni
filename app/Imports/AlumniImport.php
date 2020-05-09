<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Status;

class AlumniImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user                      = new User();
        $user->code                = $row[0];
        $user->course              = $row[1];
        $user->username            = $row[2];
        $user->name                = $row[3];
        $user->password            = Hash::make($row[4]);
        $user->nation              = $row[5];
        $user->tel                 = $row[6];
        $user->email               = $row[7];
        $user->gender              = $row[8];
        $user->birth               = date('Y-m-d H:i:s', strtotime($row[9]));
        $user->address             = $row[10];
        $user->family_tel          = $row[11];
        $user->family_address      = $row[12];
        $user->status_id           = $row[13];
        $user->ward_id             = $row[14];
        $user->created_at          = '' ;
        $user->updated_at          = '';
        return $user;
    }
}

// 'code'          => $row[0],
//             'first_name'    => $row[1],
//             'last_name'     => $row[2],
//             'username'      => $row[3],
//             'password'      => Hash::make($row[4]),
//             'tel'           => $row[5],
//             'email'         => $row[6],
//             'gender'        => $row[7],
//             'birthday'      => $row[8],
//             'address'       => $row[9],
//             'status_id'     => $row[10],

// 'code'          => $row["code"],
//             'first_name'    => $row["first_name"],
//             'last_name'     => $row["last_name"],
//             'username'      => $row["username"],
//             'password'      => Hash::make($row["password"]),
//             'tel'           => $row["tel"],
//             'email'         => $row["email"],
//             'gender'        => $row["gender"],
//             'birthday'      => $row["birthday"],
//             'address'       => $row["address"],
//             'status_id'     => $row["status_id"],