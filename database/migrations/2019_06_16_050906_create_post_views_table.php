<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('post_views')) {
            Schema::create('post_views', function (Blueprint $table) {
                $table->increments('post_view_id')->comment('id');
                $table->integer('post_id')->unsigned()->comment('id bai dang');
                $table->integer('user_id')->unsigned()->comment('id nguoi dung');
                $table->tinyInteger('post_is_like')->comment('luot like');

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
                //$table->unique(['post_view_id']);
            });
            DB::statement("ALTER TABLE `post_views` comment 'Lưu thông tin về việc người khác đã xem bài post
            Nếu mot user xem bài post thì sẽ tự sinh thêm một dòng'");
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
