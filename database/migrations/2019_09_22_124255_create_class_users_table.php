<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('class_users')) {
            Schema::create('class_users', function (Blueprint $table) {
                $table->increments('class_user_id')->comment('id lớp học của người dùng');
                $table->integer('user_id')->unsigned()->comment('id người dùng');
                $table->integer('class_id')->unsigned()->comment('id lớp');
                // $table->date('class_user_begin')->comment('ngày bắt');
                // $table->date('class_user_end')->comment('ngày kết thúc');
                $table->string('class_user_accountability')->comment('vai trò (gv, sv)');
                //log time
                $table->timestamp('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->comment('ngày tạo');

                $table->timestamp('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))
                    ->comment('ngày cập nhật');

                $table->timestamp('deleted_at')
                    ->nullable()
                    ->comment('ngày xóa tạm');
            });
            DB::statement("ALTER TABLE `class_users` comment 'Liên kết lớp và một tài khoản, lớp với giảng viên, lớp với sinh viên'");
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