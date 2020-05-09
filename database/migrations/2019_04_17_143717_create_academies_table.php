<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

Schema::defaultStringLength(191);
class CreateAcademiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('academies')) {
            Schema::create('academies', function (Blueprint $table) {
                $table->increments('academy_id')->comment('id');
                $table->string('academy_code', 12)->comment('mã khoa');
                $table->string('academy_name')->comment('tên khoa');
                $table->text('academy_description')->comment('mô tả khoa');

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
                $table->unique(['academy_code', 'academy_name']);
            });
            DB::statement("ALTER TABLE `academies` comment 'Thông tin một khoa, viện, phòng ban'");
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
