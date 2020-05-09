<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResetPasswordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('reset_passwords')) {
            Schema::create('reset_passwords', function (Blueprint $table) {
                $table->increments('reset_password_id');
                $table->integer('user_id')->unique()->comment('FK user_id');
                $table->string('password_token')->unique()->comment('token để gửi qua mail');
                $table->dateTime('send_request_time')->comment('thời gian chết của token');
                $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');

                // log time
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
            DB::statement("ALTER TABLE `reset_passwords` comment 'Xử lý quên mật khẩu của người dùng'");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('reset_passwords');
    }
}
