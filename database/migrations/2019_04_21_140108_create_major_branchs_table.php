<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMajorBranchsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('major_branchs')) {
            Schema::create('major_branchs', function (Blueprint $table) {
                $table->increments('major_branch_id')->comment('id chuyên nghành');
                $table->integer('major_id')->unsigned()->comment('id nghành');
                $table->text('major_branch_name')->comment('tên chuyên nghành');

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
            });
            DB::statement("ALTER TABLE `major_branchs` comment'Liên kêt nghành học với chuyên nghành, Quan hệ 1 nhiều'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
    }
}
