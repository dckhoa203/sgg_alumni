<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('answers')) {
            Schema::create('answers', function (Blueprint $table) {
                $table->increments('answer_id')->comment('id');
                $table->integer('survey_id')->unsigned()->index()->comment('id của câu hỏi');
                $table->integer('user_id')->unsigned()->index()->comment('id người trả lời');
                $table->text('answer_content')->comment('Nội dung câu trả lời');

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
            DB::statement("ALTER TABLE `answers` comment 'Thông tin câu trả lời của sinh viên cho một câu hỏi trong một cuộc khảo sát'");
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
