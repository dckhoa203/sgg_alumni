<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterGraduatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('register_graduate')) {
            Schema::create('register_graduate', function (Blueprint $table) {
                $table->increments('register_graduate_id')->comment('id mau dang ky tot nghiep');
                $table->string('register_graduate_phase', 50)->comment('đợt tốt nghiệp');
                $table->string('register_graduate_academy')->comment('đơn vị');
                $table->string('register_graduate_decision',50)->comment('quyết định tốt nghiệp');
                $table->date('register_graduate_date')->comment('ngày đăng ký tốt nghiệp');     // QUAN TRONG: nó quyết định luôn years_end. Vì vậy mới bỏ bảng years và year_users
                $table->string('register_graduate_code',10)->comment('MSSV');
                $table->string('register_graduate_name')->comment('ho va ten');
                $table->date('register_graduate_birth')->comment('ngày sinh');
                $table->string('register_graduate_gender',10)->comment('giới tính')->nullable();
                $table->string('register_graduate_place_of_birth')->comment('nơi sinh');
                $table->string('register_graduate_class_code',50)->comment('mã lớp');
                $table->string('register_graduate_AUN')->comment('AUN')->nullable();
                $table->string('register_graduate_major_name',100)->comment('tên nghành');
                $table->string('register_graduate_major_branch_name',100)->comment('tên chuyên nghành');
                $table->double('register_graduate_GPA')->comment('điểm trung bình');
                $table->double('register_graduate_DRL')->comment('điểm rèn luyện');
                $table->integer('register_graduate_TCTL')->comment('tổng tín chỉ tích lũy');
                $table->string('register_graduate_ranked', 50)->comment('xếp loại');
                $table->text('register_graduate_note')->comment('ghi chú')->nullable();
                $table->string('register_graduate_nation',50)->comment('tên dân tộc không dấu')->nullable();
                $table->integer('register_graduate_year_begin')->comment('năm bất đầu');
                $table->integer('register_graduate_course')->comment('khóa học')->nullable();
                $table->string('register_graduate_degree', 50)->comment('danh hiệu ');
                $table->string('register_graduate_type_of_tranning',100)->comment('hệ đào tạo')->nullable();
                
                
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
            DB::statement("ALTER TABLE `register_graduate` comment 'Mẫu đăng ký tốt nghiệp '");
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
