<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('mail_templates')) {
            Schema::create('mail_templates', function (Blueprint $table) {
                $table->increments('mail_template_id')->comment('id');
                $table->integer('user_id')->unsigned()->comment('id người tạo');
                $table->text('subject')->comment('tiêu đề');
                $table->text('body')->comment('nội dung');

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
                // Setting unique
                $table->unique(['user_id']);
            });
            DB::statement("ALTER TABLE `mail_templates` comment 'Mẫu mail tạo sẳn'");
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
