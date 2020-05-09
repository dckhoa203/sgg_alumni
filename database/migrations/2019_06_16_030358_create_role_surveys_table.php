<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('role_surveys')) {
            Schema::create('role_surveys', function (Blueprint $table) {
                $table->increments('role_survey_id')->comment('id phân quyền vs bảng khảo sát');
                $table->integer('role_id')->unsigned()->comment('id phân quyền');
                $table->integer('survey_id')->unsigned()->comment('id khảo sát');

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
            DB::statement("ALTER TABLE `role_surveys` comment 'Liên kết giữa phân quyền và bảng khảo sát để biết phân quyền nào được thực hiện bảng khảo sát nào
            Quan hệ nhiều nhiều'");
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
