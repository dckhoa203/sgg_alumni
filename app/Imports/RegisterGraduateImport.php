<?php

namespace App\Imports;

use App\Models\RegisterGraduate;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');
class RegisterGraduateImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    // public function model(array $row)
    // {
    //     return new RegisterGraduate([
    //         'register_graduate_id'                      => $row[0],
    //         'register_graduate_phase'                   => $row[1],
    //         'register_graduate_academy'                 => $row[2],
    //         'register_graduate_decision'                => $row[3],
    //         'register_graduate_date'                    => date('Y-m-d H:i:s', strtotime($row[4])),
    //         'register_graduate_code'                    => $row[5],
    //         'register_graduate_name'                    => $row[6],
    //         'register_graduate_birth'                   => date('Y-m-d H:i:s', strtotime($row[7])),
    //         'register_graduate_gender'                  => $row[8],
    //         'register_graduate_place_of_birth'          => $row[9],
    //         'register_graduate_class_code'              => $row[10],
    //         'register_graduate_AUN'                     => $row[11],
    //         'register_graduate_major_name'              => $row[12],
    //         'register_graduate_major_branch_name'       => $row[13],
    //         'register_graduate_GPA'                     => $row[14],
    //         'register_graduate_DRL'                     => $row[15],
    //         'register_graduate_TCTL'                    => $row[16],
    //         'register_graduate_ranked'                  => $row[17],
    //         'register_graduate_note'                    => $row[18],
    //         'register_graduate_nation'                  => $row[19],
    //         'register_graduate_year_begin'              => $row[20],
    //         'register_graduate_course'                  => $row[21],
    //         'register_graduate_degree'                  => $row[22],
    //         'register_graduate_type_of_tranning'        => '',
    //     ]);
    // }
    public function model(array $row)
    {
        // return new RegisterGraduate([
        //     'register_graduate_phase' => $row['Đợt TN'],
        //     'register_graduate_academy' => $row['Đơn vị'],
        //     'register_graduate_decision' => $row['QĐ'],
        //     'register_graduate_date' => date('Y-m-d H:i:s', strtotime($row['Ngày ký'])),
        //     'register_graduate_code' => $row['MSSV'],
        //     'register_graduate_name' => $row['Họ tên'],
        //     'register_graduate_birth' => date('Y-m-d H:i:s', strtotime($row['Họ tên	Ngày sinh'])),
        //     'register_graduate_gender' => $row['Nữ'],
        //     'register_graduate_place_of_birth' => $row['Nơi sinh'],
        //     'register_graduate_class_code' => $row['Lớp'],
        //     'register_graduate_AUN' => $row['AUN'],
        //     'register_graduate_major_name' => $row['Tên ngành'],
        //     'register_graduate_major_branch_name' => $row['Tên chuyên ngành'],
        //     'register_graduate_GPA' => $row['Điểm TB'],
        //     'register_graduate_DRL' => $row['Điểm RL'],
        //     'register_graduate_TCTL' => $row['TCTL'],
        //     'register_graduate_ranked' => $row['Xếp loại'],
        //     'register_graduate_note' => $row['Ghi chú'],
        //     'register_graduate_nation' => $row['Dân tộc không dấu'],
        //     'register_graduate_year_begin' => $row['Năm vào'],
        //     'register_graduate_course' => $row['Khóa học'],
        //     'register_graduate_degree' => $row['Danh hiệu'],
        //     'register_graduate_type_of_tranning' => '',
        // ]);
    }
}
