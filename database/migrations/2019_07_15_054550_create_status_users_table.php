<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('status_users')){
            Schema::create('status_users', function (Blueprint $table) {
                $table->increments('status_users_id')->comment('id lien ket giua nguoi dung vs trang thai');
                $table->integer('status_id')->unsigned()->index()->comment('id trang thai');
                $table->integer('user_id')->unsigned()->index()->comment('id nguoi dung');

                $table->string('status_users_reason')->index()->comment('lý do khi Nghỉ học, hoặc đi làm');

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
            DB::statement("ALTER TABLE `status_users` comment 'Lưu trữ liên kết trạng thái giữa người dùng và trạng thái trong việc làm'");
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
