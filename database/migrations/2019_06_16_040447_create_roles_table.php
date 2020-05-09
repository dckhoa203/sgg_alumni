<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('roles')) {
            Schema::create('roles', function (Blueprint $table) {
                $table->increments('role_id')->comment('id phân quyền');
                $table->string('role_name')->comment('tên phân quyền');
                $table->string('role_level')->comment('mức phân quyền');
                $table->text('role_note')->comment('chú thích về phân quyền');

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
            DB::statement("ALTER TABLE `roles` comment 'Thông tin phân quyền'");
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
