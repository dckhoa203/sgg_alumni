<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('companies')) {
            Schema::create('companies', function (Blueprint $table) {
                $table->increments('company_id')->comment('id công ty');
                $table->integer('ward_id')->unsigned()->comment('id phường-xã');
                $table->string('company_name', 200)->comment('tên công ty');
                $table->string('company_address')->comment('địa chỉ công ty');
                $table->string('company_tel', 50)->comment('sdt công ty');
                $table->string('company_email', 160)->comment('email công ty');
                $table->string('company_website')->comment('website công ty');

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
            DB::statement("ALTER TABLE `companies` comment 'Thông tin công ty'");
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
