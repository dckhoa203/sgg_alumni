<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('user_id')->comment('id người dùng');
                // Mac dinh lenght = 10 , Khong dc comment
                $table->string('username',12)->comment('mã mssv đăng nhập');
                $table->string('code', 12)->comment('ma sv hoac gv');
                $table->string('name')->comment('tên đầy đủ của người dùng');
                $table->char('password', 60)->commnet('mat khau');
                $table->char('course', 5)->comment('khóa');
                $table->char('nation', 45)->comment('dân tộc');
                $table->string('tel', 20)->commnet('sdt');
                $table->string('email', 64)->commnet('email');
                $table->string('other_email',255)->unique()->comment('email liên hệ khác');
                $table->text('address')->comment('địa chỉ');
                $table->date('birth')->comment('ngày sinh');
                $table->string('gender')->comment('giới tính');
                $table->string('family_tel')->nullable()->comment('số điện thoại gia đình');
                $table->string('family_address')->nullable()->comment('địa chỉ gia đình');
                $table->integer('status_id')->unsigned()->index()->comment('FK id trạng thái của người dùng');
                $table->integer('district_id')->unsigned()->index()->comment('FK id phường/xã');

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
                // Setting unique
                $table->unique(['code']);
            });
            DB::statement("ALTER TABLE `users` comment 'Luu tru thong tin nguoi dung'");
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
