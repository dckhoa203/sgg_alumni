<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('statuses'))
        {
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('status_id')->comment('id trạng thái');
            $table->string('status_name')->comment('tên của trạng thái');
            $table->string('status_reason')->comment('lý do của trạng thái');
            $table->text('status_note')->comment('ghi chú của trạng thái');

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
        DB::statement("ALTER TABLE `statuses` comment 'Lưu trữ trạng thái của người dùng'");
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
