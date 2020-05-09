<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('profile_structures')) {
            Schema::create('profile_structures', function (Blueprint $table) {
                $table->increments('profile_structure_id')->comment('id cau truc tai khoan');
                $table->integer('role_id')->unsigned()->comment('id phân quyền. phân quyền có trường thông tin này');
                $table->string('profile_structure_name', 200)->comment('tên của trường thông tin');
                $table->string('profile_structure_type', 200)->comment('kiểu của thông tin (int, string, date)');
                $table->text('profile_structure_default')->comment('giá trị mặc định của trường thông tin');
                $table->tinyInteger('profile_structure_version')->comment('phiên bản sử dụng'); // Ví dụ. Năm 16 cô yêu cầu tài khoản chỉ có đăng nhập qua mssv + pass . 2019 cô cho thêm login via mssv + email + pass.

                $table->timestamp('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->comment('ngày tạo');

                $table->timestamp('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))
                    ->comment('ngày cập nhật');

                $table->timestamp('deleted_at')
                    ->nullable()
                    ->comment('ngày xóa tạm');
                // Setting unique
                //$table->unique(['profile_structure_id', 'role_id','profile_version']);
            });
            DB::statement("ALTER TABLE `profile_structures` comment 'Cấu trúc lưu trữ thông tin cho mỗi phân quyền'");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
