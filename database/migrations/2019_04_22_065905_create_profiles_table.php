<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('profiles')) {
            Schema::create('profiles', function (Blueprint $table) {
                $table->increments('profile_id', 10)->comment('id');
                $table->integer('profile_structure_id')->unsigned()->comment('id cấu trúc tài khoản');
                $table->integer('user_id')->unsigned()->comment('id người dùng');
                $table->text('profile_values')->comment('giá trị của tài khoản');

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
                $table->unique(['profile_id', 'profile_structure_id', 'user_id']);
            });
            DB::statement("ALTER TABLE `profiles` comment 'Thông tin chi tiết tài khoản'");
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
