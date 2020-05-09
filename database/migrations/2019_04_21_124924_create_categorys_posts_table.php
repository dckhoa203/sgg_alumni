<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorysPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('categorys_posts')) {
            Schema::create('categorys_posts', function (Blueprint $table) {
                $table->increments('category_post_id')->comment('id');
                $table->integer('category_id')->unsigned()->comment('id chuyên mục');
                $table->integer('post_id')->unsigned()->comment('id bài post');

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
            DB::statement("ALTER TABLE `categorys_posts` comment 'Liên kết chuyên mục với bài viết
            Quan hệ nhiều nhiều (một bài viết có thể có nhiều chuyên mục khác nhau, ngược lại 1 chuyên mục có thể có nhiều bài viết)'");
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
