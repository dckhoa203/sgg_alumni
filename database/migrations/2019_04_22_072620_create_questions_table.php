<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('questions')) {
            Schema::create('questions', function (Blueprint $table) {
                $table->increments('question_id')->comment('id câu hỏi');
                $table->integer('survey_id')->unsigned()->index()->comment('id khảo sát');
                $table->text('question_title')->comment('nội dung câu hỏi');
                $table->integer('question_mandatory')->nullable()->comment('câu hỏi bắt buộc');

                $table->text('question_type')->comment('loại câu hỏi (select, checbox, number, ...)');
                $table->text('question_option')->nullable()->comment('phương án trả lời (nếu là select hoặc checkbox thì sẽ có dạng json)');

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
                $table->unique(['question_id']);
            });
            DB::statement("ALTER TABLE `questions` comment 'Câu hỏi cho mẫu khảo sát'");
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
