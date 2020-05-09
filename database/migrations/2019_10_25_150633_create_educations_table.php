<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('educations')) {
            Schema::create('educations', function (Blueprint $table) {
                $table->increments('education_id')->comment('Khóa chính chương trình đào tạo');

                $table->int('education_training_time')->comment('thời gian đào tạo');

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
            DB::statement("ALTER TABLE `educations` comment 'chương trình đào tạo để xác định tiền độ ra trường cho 1 khóa'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
    }
}
