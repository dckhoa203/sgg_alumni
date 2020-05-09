<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('works')) {
            Schema::create('works', function (Blueprint $table) {
                $table->increments('work_id')->comment('id công việc');
                $table->string('work_name')->comment('tên công việc');
                $table->string('work_position')->comment('chức vụ trong công việc');
                $table->string('work_specialize')->comment('chuyên môn công việc');
                $table->string('work_salary')->comment('lương');
                $table->date('work_begin')->comment('ngày bất đầu làm việc');
                $table->date('work_end')->comment('ngày kết thúc làm việc');
                $table->text('work_note')->comment('ghi chú');
                $table->string('work_status')->default('working')->comment('trạng thái làm việc ng dùng');
                //log time
                $table->timestamp('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->comment('ngày tạo');

                $table->timestamp('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))
                    ->comment('ngày cập nhật');

                $table->timestamp('deleted_at')
                    ->nullable()
                    ->comment('ngày xóa tạm');
            });
            DB::statement("ALTER TABLE `works` comment 'Thông tin công việc mà sinh viên đang làm'");
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
