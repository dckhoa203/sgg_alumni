<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('mail_logs')) {
            Schema::create('mail_logs', function (Blueprint $table) {
                $table->increments('mail_log_id')->comment('id');
                $table->integer('mail_template_id')->unsigned()->comment('id mẫu email')->nullable();
                $table->integer('register_graduate_id')->unsigned()->comment('id mẫu đăng ký tốt nghiệp')->nullable();
                $table->dateTime('mail_log_send_date_time')->comment('thời gian gửi');
                $table->string('mail_log_to', 255)->comment('địa chỉ nhận');
                $table->text('mail_log_subject')->comment('tiêu đề');
                $table->text('mail_log_body')->comment('nội dung');
                $table->string('mail_log_file')->comment('file gửi kèm')->nullable();

                // log
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
                $table->unique(['mail_template_id', 'register_graduate_id']);
            });
            DB::statement("ALTER TABLE `mail_logs` comment 'Lưu trữ các mail sẽ gửi'");
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
