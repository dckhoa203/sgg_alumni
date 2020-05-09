<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->increments('post_id')->comment('id bai dang');
                $table->integer('user_id')->unsigned()->index()->comment('id nguoi dung');
                $table->integer('class_id')->unsigned()->index()->comment('id lớp'); // Đăng trên 1 lớp luôn . K cần tạo group_id . Đã tham khảo với Cô .
                $table->integer('role_id')->unsigned()->index()->comment('id phân quyền'); //. Chỉ muốn đăng trên phân quyền mình muốn cho họ xem
                $table->text('post_title')->comment('tieu de bai dang');
                $table->text('post_content')->comment('noi dung bai dang');
                $table->text('post_slug')->comment('tên ngắn tắt cho bài viết');
                $table->string('post_status', 50)->comemnt('trang thai bai dang')->default('pending');
                $table->string('status_user')->comment('trạng thái của người dùng: khóa')->default('active');
                $table->string('post_file')->comment('upload file dạng pdf,word');
                $table->string('post_link')->comment('chia sẽ liên kết tới link bài viết chi tiết')->nullable();

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
                $table->unique(['post_id', 'user_id']);
            });
            DB::statement("ALTER TABLE `posts` comment 'Thông tin bài đăng'");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('posts');
    }
}
