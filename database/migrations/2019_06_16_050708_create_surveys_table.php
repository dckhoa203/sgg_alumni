<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('surveys')) {
            Schema::create('surveys', function (Blueprint $table) {
                $table->increments('survey_id')->comment('id');
                $table->integer('user_id')->unsigned()->index()->comment('người lập');
                $table->text('survey_name')->comment('tên mẫu khảo sát');
                $table->text('survey_description')->comment('mô tả khảo sát');
                $table->datetime('survey_start')->comment('ngày bắt đầu');
                $table->datetime('survey_end')->comment('ngày kết thúc');
                $table->integer('survey_version')->length(2)->unsigned()->comment('phiên bảng khảo sát');

                //log time
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
            DB::statement("ALTER TABLE `surveys` comment 'Mẫu khảo sát'");
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
