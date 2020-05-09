<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('sponsors')) {
            Schema::create('sponsors', function (Blueprint $table) {
                $table->increments('sponsor_id')->comment('id tài trợ');
                $table->string('sponsor_title', 100)->comment('tiêu đề tài trợ');
                $table->text('sponsor_content')->comment('nội dung tài trợ');
                $table->string('sponsor_money', 100)->comment('tài trợ là tiền');
                $table->date('sponsor_date')->comment('ngày tài trợ');
                $table->string('sponsor_to')->comment('tài trợ cho ai?');
                $table->integer('user_id')->unsigned()->comment('id người dùng tài trợ');
                $table->integer('company_id')->unsigned()->comment('id công ty tài trợ');
                $table->integer('academy_id')->unsigned()->comment('id khoa nhận tài trợ');

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
            DB::statement("ALTER TABLE `sponsors` comment 'Thông tin tài trợ, hỗ trợ cho sinh viên hoặc khoa'");
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
