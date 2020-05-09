<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('role_users'))
        {
            Schema::create('role_users', function (Blueprint $table) {
                $table->increments('role_user_id')->comment('Khóa chính');
    
                $table->integer('user_id')->unsigned();
                $table->integer('role_id')->unsigned();
    
                $table->foreign('user_id')->references('user_id')->on('users')->onCascade('cascade');
                $table->foreign('role_id')->references('role_id')->on('roles')->onCascade('cascade');
            });
            DB::statement("ALTER TABLE `role_users` comment 'Liên kết giữa phân quyền và tài khoản, quan hệ 1 nhiều'");
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
