<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('work_companies')){
            Schema::create('work_companies', function (Blueprint $table) {
                $table->increments('work_company_id');
                $table->integer('work_id')->unsigned()->index();
                $table->integer('company_id')->unsigned()->index();
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
            DB::statement("ALTER TABLE `work_companies` comment 'Liên kết giữa công việc và công ty'");
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
