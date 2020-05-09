<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');
class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $user)
    {
        // return new User([
        //     'username' => $user['MSSV'],
        //     'code' => $user['MSSV'],
        //     'name' => $user['Họ và Tên'],
        //     'password' => Hash::make($user['Mật khẩu']),
        //     'course' => $user['Khóa'],
        //     'nation' => $user['Dân tộc'],
        //     'tel' => $user['SĐT'],
        //     'email' => $user['Email'],
        //     'address' => $user['Địa chỉ'],
        //     // 'birth' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($user['Ngày sinh']),
        //     'birth' => date('Y-m-d H:i:s', strtotime($user['Ngày sinh'])),
        //     'gender' => $user['Giới tính'],
        //     'family_tel' => $user['SĐT GĐ'],
        //     'family_address' => $user['Địa chỉ GĐ'],
        //     'status_id' => $user['Mã trạng thái'],
        //     'district_id' => $user['Mã quận huyện'],
        //     'created_at' => '',
        //     'updated_at' => '',
        //     'class_code' => $user['Mã lớp'],
        // ]);
    }
}
