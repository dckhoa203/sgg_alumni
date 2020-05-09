<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('permission_users'))
        {
            Schema::create('permission_users', function (Blueprint $table) {
                $table->increments('permission_user_id')->comment('Khóa chính');
    
                $table->integer('user_id')->unsigned();
                $table->integer('route_id')->unsigned();
    
                $table->foreign('user_id')->references('user_id')->on('users')->onCascade('cascade');
                $table->foreign('route_id')->references('route_id')->on('routes')->onCascade('cascade');


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
            DB::statement("ALTER TABLE `permission_users` comment 'Phân quyền cho riêng mỗi cá nhân có được 1 route'");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('permission_users');
    }
}
