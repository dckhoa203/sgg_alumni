<?php

use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
        
        // TODO Account
        [
           'route_link'     => 'accounts/profile',
           'route_name'     => 'Thông tin cá nhân',
           
        ],
        [
            'route_link'    => 'accounts/update_profile/{user_id}',
            'route_name'    => 'Cật nhật thông tin người dùng',
        ],
        [
            'route_link'    => 'accounts/profile/logout',
            'route_name'    => 'Đăng xuất',
        ],
        [
            'route_link'    => 'accounts/jobs',
            'route_name'    => 'Thông tin việc làm của người dùng',
        ],
        [
            'route_link'    => 'accounts/add_work_submit',
            'route_name'    => 'Thêm công việc của người dùng',
        ],
        [
            'route_link'    => 'accounts/show_work_yourself',
            'route_name'    => 'Hiển thị tất cả công việc của người dùng',
        ],
        [
            'route_link'    => 'accounts/resign_ajax',
            'route_name'    => 'Xử lý button nghỉ việc của người dugnf',
        ],
        [
            'route_link'    => 'accounts/show_current_work_and_resign',
            'route_name'    => 'Hiển thị công việc gần đây nhất và button nghỉ việc',
        ],
        [
            'route_link'    => 'accounts/change_password',
            'route_name'    => 'Thay đổi mật khẩu người dùng',
        ],
        [
            'route_link'    => 'accounts/update_password',
            'route_name'    => 'Cập nhật mật khẩu',
        ],
        [
            'route_link'    => 'accounts/update_job/{workID}',
            'route_name'    => 'Cập nhật công việc của người dùng'
        ],

        // TODO KHOA VIEN
        [
            'route_link'    => 'khoa-vien',
            'route_name'    => 'Index quản lý khoa viện',
        ],
        [
            'route_link'    => 'khoa-vien/them',
            'route_name'    => 'GD Thêm 1 khoa/viện',
        ],
        [
            'route_link'    => 'khoa-vien/them',
            'route_name'    => 'Store 1 khoa/viện',
        ],
        [
            'route_link'    => 'khoa-vien/edit/{academy_id}',
            'route_name'    => 'GD chỉnh sửa khoa/viện',
        ],
        [
            'route_link'    => 'khoa-vien/edit/submit/{academy_id}',
            'route_name'    => 'Store 1 khoa viện',
        ],
        [
            'route_link'    => 'khoa-vien/destroy/{academy_id}',
            'route_name'    => 'Xóa 1 khoa viện',
        ],

        // TODO SINH VIÊN
        [
            'route_link'    => 'students',
            'route_name'    => 'GD quản lý sinh viên',
        ],
        [
            'route_link'    => 'students/importExportView',
            'route_name'    => 'GD Import file danh sách sinh viên',
        ],
        [
            'route_link'    => 'students/import',
            'route_name'    => 'Import file danh sách sinh viên',
        ],
        [
            'route_link'    => 'students/create',
            'route_name'    => 'GD thêm 1 sinh viên',
        ],
        [
            'route_link'    => 'students/create_submit',
            'route_name'    => 'Store thêm 1 sinh viên',
        ],
        [
            'route_link'    => 'students/edit/{user_id}',
            'route_name'    => 'GD chỉnh sửa 1 sinh viên',
        ],
        [
            'route_link'    => 'students/edit_submit/{user_id}',
            'route_name'    => 'Store chỉnh sửa 1 sinh viên',
        ],
        [
            'route_link'    => 'students/show/{user_id}',
            'route_name'    => 'GD show thông tin sinh viên',
        ],
        [
            'route_link'    => 'students/delete/{user_id}',
            'route_name'    => 'Xóa 1 sinh viên',
        ],


        // TODO TEACHER
        [
            'route_link'    => 'teacher',
            'route_name'    => 'GD quản lý giảng viên',
        ],
        [
            'route_link'    => 'teacher/importExportView',
            'route_name'    => 'GD import ds giảng viên',
        ],
        [
            'route_link'    => 'teacher/import',
            'route_name'    => 'STORE import ds giảng viên',
        ],
        [
            'route_link'    => 'teacher/create',
            'route_name'    => 'GD thêm một giảng viên',
        ],
        [
            'route_link'    => 'teacher/create_submit',
            'route_name'    => 'STORE một giảng viên',
        ],
        [
            'route_link'    => 'teacher/edit/{user_id}',
            'route_name'    => 'GD chỉnh sửa giảng viên',
        ],
        [
            'route_link'    => 'teacher/edit_submit/{user_id}',
            'route_name'    => 'Cập nhật giảng viên',
        ],
        [
            'route_link'    => 'teacher/show/{user_id}',
            'route_name'    => 'Hiển thị một giảng viên',
        ],
        [
            'route_link'    => 'teacher/delete/{user_id}',
            'route_name'    => 'Xóa một giảng viên',
        ],


        // TODO Alumni
        [
            'route_link'    => 'alumnies',
            'route_name'    => 'GD quản lý cựu sinh viên',
        ],
        [
            'route_link'    => 'alumnies/create',
            'route_name'    => 'GD Thêm cựu sinh viên',
        ],
        [
            'route_link'    => 'alumnies/create_submit',
            'route_name'    => 'Lưu cựu sinh viên',
        ],
        [
            'route_link'    => 'alumnies/edit/{user_id}',
            'route_name'    => 'GD Sửa cựu sinh viên',
        ],
        [
            'route_link'    => 'alumnies/edit_submit/{user_id}',
            'route_name'    => 'Cập nhật cựu sinh viên',
        ],
        [
            'route_link'    => 'alumnies/show/{user_id}',
            'route_name'    => 'GD Hiển thị thông tin chi tiết cựu sinh viên',
        ],
        [
            'route_link'    => 'alumnies/show/show_submit/{user_id}',
            'route_name'    => 'Hiển thị thông tin cựu sinh viên'
        ],
        [
            'route_link'    => 'alumnies/delete/{user_id}',
            'route_name'    => 'Xóa 1 cựu sinh viên',
        ],
        [
            'route_link'    => 'alumnies/import_graduate',
            'route_name'    => 'Import danh sách bảng diểm tốt nghiệp',
        ],
        [
            'route_link'    => 'alumnies/show_details_work/{alumni_id}',
            'route_name'    => 'GD Hiển thị chi tiết công việc của cựu sinh viên',
        ],
        [
            'route_link'    => 'alumnies/myclass',
            'route_name'    => 'Lớp của cựu sinh viên',
        ],
        [
            'route_link'    => 'alumnies/myClass/Groupchat',
            'route_name'    => 'Group chat của cựu sinh viên',
        ],


        // TODO BAN-TIN
        [
            'route_link'    => 'posts',
            'route_name'    => 'GD quản lý bản tin'
        ],
        [
            'route_link'    => 'posts/add_posts',
            'route_name'    => 'GD Thêm 1 bài đăng'
        ],
        [
            'route_link'    => 'posts/store',
            'route_name'    => 'Store 1 bài đăng'
        ],
        [
            'route_link'    => 'posts/list_post',
            'route_name'    => 'GD duyệt bài trên Admin'
        ],
        [
            'route_link'    => 'posts/news/{category_slug}/{slug}',
            'route_name'    => 'Hiển thị chi tiết bài viết theo slug',
        ],
        [
            'route_link'    => 'posts/list_post_ajax',
            'route_name'    => 'Duyệt bài trên Admin'
        ],
        [
            'route_link'    => 'posts/show_post_detail_of_admin/{post_id}',
            'route_name'    => 'Hiển thị bài viết trên GD duyệt bài của Admin'
        ],
        [
            'route_link'    => 'posts/block_user_ajax',
            'route_name'    => 'Thực hiện khóa đăng bài của người dùng'
        ],
        [
            'route_link'    => 'posts/lists_account_blocked',
            'route_name'    => 'GD danh sách tài khoản bị khóa'
        ],
        [
            'route_link'    => 'posts/unblock_account_ajax',
            'route_name'    => 'Mở khóa tài khoản của đăng bài'
        ],
        [
            'route_link'    => 'posts/list_post_students',
            'route_name'    => 'GD bản tin trên phân quyền sinh viên'
        ],
        [
            'route_link'    => 'posts/{category_slug}/{slug}',
            'route_name'    => 'GD Hiển thị chi tiết bản tin theo thể loại'
        ],
        [
            'route_link'    => 'posts/post_your_class',
            'route_name'    => 'GD bản tin trên lớp của mình học'
        ],
        [
            'route_link'    => 'posts/list_post_teachers',
            'route_name'    => 'GD bản tin trên phân quyền giảng viên'
        ],
        [
            'route_link'    => 'posts/comment_ajax',
            'route_name'    => 'Chức năng comment trên bản tin'
        ],
        [
            'route_link'    => 'posts/categories_find_job',
            'route_name'    => 'GD bản tin thể loại Tìm việc làm'
        ],
        [
            'route_link'    => 'posts/categories_apply_job',
            'route_name'    => 'GD bản tin thể loại Tuyển dụng'
        ],
        [
            'route_link'    => 'posts/categories_class_meeting',
            'route_name'    => 'GD bản tin Họp lớp'
        ],
        [
            'route_link'    => 'posts/categories_support_scholarship',
            'route_name'    => 'GD bản tin Hỗ trợ học bổng'
        ],
        [
            'route_link'    => 'posts/categories_donations',
            'route_name'    => 'GD bản tin Quyên góp'
        ],
        [
            'route_link'    => 'posts/categories_notifications',
            'route_name'    => 'GD bản tin Thông báo'
        ],
        [
            'route_link'    => 'posts/post_only_class/{post_only_class?}',
            'route_name'    => 'Lấy paramater trên url của bài đăng trên lơp',
        ],
        [
            'route_link'    => 'posts/destroy/{postID}',
            'route_name'    => 'Xóa bài viết không hợp lệ chỉ cho Admin và cố vấn của lớp đó'
        ],
        [
            'route_link'    => 'posts/submit_comment/{commentID}',
            'route_name'    => 'Chỉnh sửa comment cho người dùng'
        ],
        [
            'route_link'    => 'posts/posts/delete_comment/{commentID}',
            'route_name'    => 'Xóa comment đó của người dùng'
        ],


        // TODO NGHÀNH
        [
            'route_link'    => 'major',
            'route_name'    => 'GD quản lý nghành'
        ],
        [
            'route_link'    => 'major/create',
            'route_name'    => 'GD thêm 1 nghành'
        ],
        [
            'route_link'    => 'major/create',
            'route_name'    => 'Store 1 nghành'
        ],
        [
            'route_link'    => 'major/edit/{major_id}',
            'route_name'    => 'GD chỉnh sửa 1 nghành'
        ],
        [
            'route_link'    => 'major/edit/submit/{major_id}',
            'route_name'    => 'Update 1 nghành'
        ],
        [
            'route_link'    => 'major/destroy/{major_id}',
            'route_name'    => 'Xóa 1 nghành'
        ],


        // TODO CHUYÊN NGHÀNH
        [
            'route_link'    => 'major_branch',
            'route_name'    => 'GD quản lý chuyên nghành'
        ],
        [
            'route_link'    => 'major_branch/create',
            'route_name'    => 'GD thêm 1 chuyên nghành'
        ],
        [
            'route_link'    => 'major_branch/create',
            'route_name'    => 'Store 1 chuyên nghành'
        ],
        [
            'route_link'    => 'major_branch/edit/{major_branch_id}',
            'route_name'    => 'GD chỉnh sửa chuyên nghành'
        ],
        [
            'route_link'    => 'major_branch/edit/submit/{major_branch_id}',
            'route_name'    => 'Update chỉnh sửa chuyên nghành'
        ],
        [
            'route_link'    => 'major_branch/destroy/{major_branch_id}',
            'route_name'    => 'Xóa 1 chuyên nghành'
        ],


        // TODO LỚP
        [
            'route_link'    => 'class',
            'route_name'    => 'GD quản lý lớp học'
        ],
        [
            'route_link'    => 'class/create',
            'route_name'    => 'GD thêm 1 lớp học'
        ],
        [
            'route_link'    => 'class/create',
            'route_name'    => 'Store 1 lớp học'
        ],
        [
            'route_link'    => 'class/create_quick',
            'route_name'    => 'GD tạo nhanh một lớp',
        ],
        [
            'route_link'    => 'class/create_quick',
            'route_name'    => 'Lưu trữ một lớp',
        ],
        [
            'route_link'    => 'class/edit/{class_id}',
            'route_name'    => 'GD chỉnh sửa 1 lớp học'
        ],
        [
            'route_link'    => 'class/edit/submit/{class_id}',
            'route_name'    => 'Cập nhật 1 lớp học'
        ],
        [
            'route_link'    => 'class/show/{class_id}',
            'route_name'    => 'GD show 1 lớp học'
        ],
        [
            'route_link'    => 'class/destroy/{class_id}',
            'route_name'    => 'Xóa 1 lớp học'
        ],
        [
            'route_link'    => 'class/major_branch/{major_id}',
            'route_name'    => 'DOM chuyên nghành'
        ],
        [
            'route_link'    => 'class/major_branch/edit/{major_id}',
            'route_name'    => 'DOM chỉnh sửa chuyên nghành'
        ],
        [
            'route_link'    => 'class/index_teacher',
            'route_name'    => 'GD trang chỉ hiển thị lớp của giảng viên',
        ],
        [
            'route_link'    => 'class/import',
            'route_name'    => 'Import danh sách cố vấn của lớp',
        ],


        // TODO KHẢO SÁT 
        [
            'route_link'    => 'survey',
            'route_name'    => 'GD quản lý khảo sát'
        ],
        [
            'route_link'    => 'survey/view/{survey}',
            'route_name'    => 'Hiển thị view khảo sát',
        ],
        [
            'route_link'    => 'survey/view/{survey}/completed',
            'route_name'    => 'thực hiện trả lời của sinh viên ',
        ],
        [
            'route_link'    => 'survey/view/{survey}/update',
            'route_name'    => 'trả lời lại câu trả lời của mình cho sinh viên',
        ],
        [
            'route_link'    => 'survey/create',
            'route_name'    => 'GD thêm khảo sát'
        ],
        [
            'route_link'    => 'survey/create_submit',
            'route_name'    => 'Lưu câu hỏi khảo sát'
        ],
        [
            'route_link'    => 'survey/{survey}',
            'route_name'    => 'GD thêm câu hỏi'
        ],
        [
            'route_link'    => 'survey/destroy/{survey_id}',
            'route_name'    => 'Xóa khảo sát'
        ],
        [
            'route_link'    => 'survey/{survey}/edit',
            'route_name'    => 'GD chỉnh sửa khảo sát'
        ],
        [
            'route_link'    => 'survey/{survey}/update',
            'route_name'    => 'Cập nhật khảo sát'
        ],
        [
            'route_link'    => 'survey/{survey}/add_new',
            'route_name'    => 'Tạo mới khảo sát'
        ],
        [
            'route_link'    => 'survey/view/{survey}',
            'route_name'    => 'Xem khảo sát'
        ],
        [
            'route_link'    => 'survey/answers/{survey}',
            'route_name'    => 'Xem đáp án khảo sát'
        ],
        [
            'route_link'    => 'survey/view/{survey}/export',
            'route_name'    => 'Export khảo sát'
        ],
        [
            'route_link'    => 'survey/{question}/remove',
            'route_name'    => 'Xóa khảo sát theo câu hỏi'
        ],
        [
            'route_link'    => 'survey/{survey}/questions',
            'route_name'    => 'Thêm câu hỏi khảo sát'
        ],
        [
            'route_link'    => 'survey/export',
            'route_name'    => 'Export câu hỏi khảo sát'
        ],
        

        // TODO BIỂU ĐỒ
        [
            'route_link'    => 'chart',
            'route_name'    => 'GD biểu đồ',
        ],


        // TODO CÂU HỎI
        [
            'route_link'    => 'question',
            'route_name'    => 'GD câu hỏi',
        ],
        [
            'route_link'    => 'question/{question}/edit',
            'route_name'    => 'GD chỉnh sửa câu hỏi',
        ],
        [
            'route_link'    => 'question/{question}/update',
            'route_name'    => 'Lưu trữ cập nhật câu hỏi',
        ],
        [
            'route_link'    => 'question/{question_id}/{value}/delete/',
            'route_name'    => 'Xóa câu hỏi',
        ],
        

        // TODO THỐNG KÊ
        [
            'route_link'    => 'statistic',
            'route_name'    => 'GD quản lý thống kê'
        ],
        [
            'route_link'    => 'statistic/showsurvey/{survey_id}',
            'route_name'    => 'GD hiển thị thống kê theo khảo sát'
        ],
        [
            'route_link'    => 'statistic/show',
            'route_name'    => 'Hiển thị thống kê'
        ],
        [
            'route_link'    => 'statistic/export',
            'route_name'    => 'Xuất thống kê'
        ],
        [
            'route_link'    => 'statistic/student',
            'route_name'    => 'Hiển thị GD thống kê tỉ lệ tốt nghiệp sinh viên'
        ],
        [
            'route_link'    => 'statistic/student',
            'route_name'    => 'Lưu trữ thống kê tỉ lệ tốt nghiệp sinh viên'
        ],
        [
            'route_link'    => 'statistic/major_branch/{major_id}',
            'route_name'    => 'Ajax lấy chuyên nghành theo nghành'
        ],
        [
            'route_link'    => 'statistic/class/{major_id}/{major_branch_id}/{course}',
            'route_name'    => 'Ajax lấy tên lớp theo tên chuyên nghành và nghành'
        ],
        [
            'route_link'    => 'statistic/job',
            'route_name'    => 'GD thống kê tỷ lệ việc làm',
        ],
        [
            'route_link'    => 'statistic/job',
            'route_name'    => 'Lưu trữ thống kê tỷ lệ việc làm',
        ],
        [
            'route_link'    => 'statistic/job_export',
            'route_name'    => 'Xuất file thống kê ',
        ],
        [
            'route_link'    => 'statistic/salary',
            'route_name'    => 'GD thống kê lương tỷ lệ việc làm',
        ],
        [
            'route_link'    => 'statistic/show_surveys',
            'route_name'    => 'GD thống kê form khảo sát',
        ],
        [
            'route_link'    => 'statistic/show_statistic_surveys/{survey_id}',
            'route_name'    => 'GD thống kê theo form khảo sát theo id',
        ],
        [
            'route_link'    => 'statistic/export_statistic_surveys',
            'route_name'    => 'Xuất ra file thống kê theo khảo sát',
        ],
        
        // TODO PHÂN QUYỀN THÀNH PHỐ
        [
            'route_link'    => 'city',
            'route_name'    => 'GD quản lý thành phố'
        ],
        [
            'route_link'    => 'city/create',
            'route_name'    => 'GD thêm thành phố'
        ],
        [
            'route_link'    => 'city/create',
            'route_name'    => 'Lưu khi thêm thành phố'
        ],
        [
            'route_link'    => 'city/edit/{city_id}',
            'route_name'    => 'GD chỉnh sửa thành phố'
        ],
        [
            'route_link'    => 'city/edit/submit/{city_id}',
            'route_name'    => 'Cập nhật thành phố'
        ],
        [
            'route_link'    => 'city/destroy/{city_id}',
            'route_name'    => 'Xóa thành phố'
        ],


        // TODO QUẬN/HUYỆN
        [
            'route_link'    => 'district',
            'route_name'    => 'GD quản lý quận/huyện'
        ],
        [
            'route_link'    => 'district/create',
            'route_name'    => 'GD thêm quận/huyện'
        ],
        [
            'route_link'    => 'district/create',
            'route_name'    => 'Lưu quận/huyện'
        ],
        [
            'route_link'    => 'district/edit/{district_id}',
            'route_name'    => 'GD chỉnh sửa quận huyện'
        ],
        [
            'route_link'    => 'district/edit/submit/{district_id}',
            'route_name'    => 'Cập nhật quận huyện'
        ],
        [
            'route_link'    => 'district/destroy/{district_id}',
            'route_name'    => 'Xóa quận huyện'
        ],


        // TODO PHƯỜNG/XÃ
        [
            'route_link'    => 'ward',
            'route_name'    => 'GD quản lý phường/xã'
        ],
        [
            'route_link'    => 'ward/create',
            'route_name'    => 'GD thêm phường xã'
        ],
        [
            'route_link'    => 'ward/create',
            'route_name'    => 'Lưu phường xã'
        ],
        [
            'route_link'    => 'ward/edit/{ward_id}',
            'route_name'    => 'GD chỉnh sửa phường xã'
        ],
        [
            'route_link'    => 'ward/edit/submit/{ward_id}',
            'route_name'    => 'Cập nhật phường xã'
        ],
        [
            'route_link'    => 'ward/destroy/{ward_id}',
            'route_name'    => 'Xóa phường xã'
        ],
        [
            'route_link'    => 'ward/district/{city_id}',
            'route_name'    => 'Lấy quận huyện theo thành phố '
        ],


        // TODO CÔNG TY
        [
            'route_link'    => 'company',
            'route_name'    => 'GD quản lý công ty'
        ],
        [
            'route_link'    => 'company/create',
            'route_name'    => 'GD thêm công ty'
        ],
        [
            'route_link'    => 'company/create',
            'route_name'    => 'Lưu công ty'
        ],
        [
            'route_link'    => 'company/edit/{company_id}',
            'route_name'    => 'GD chỉnh sửa công ty'
        ],
        [
            'route_link'    => 'company/edit/submit/{company_id}',
            'route_name'    => 'Cập nhật công ty'
        ],
        [
            'route_link'    => 'company/destroy/{company_id}',
            'route_name'    => 'Xóa công ty'
        ],
        [
            'route_link'    => 'company/district/{city_id}',
            'route_name'    => 'GD công ty lấy quận huyện theo thành phố'
        ],
        [
            'route_link'    => 'company/ward/{district_id}',
            'route_name'    => 'GD lấy phường xã theo quận huyện'
        ],


        // TODO CÔNG VIỆC
        [
            'route_link'    => 'work',
            'route_name'    => 'GD quản lý công việc'
        ],
        [
            'route_link'    => 'work/create',
            'route_name'    => 'GD thêm công việc'
        ],
        [
            'route_link'    => 'work/create',
            'route_name'    => 'Lưu công việc'
        ],
        [
            'route_link'    => 'work/edit/{work_id}',
            'route_name'    => 'GD chỉnh sửa công việc'
        ],
        [
            'route_link'    => 'work/edit/submit/{work_id}',
            'route_name'    => 'Cập nhật công việc'
        ],
        [
            'route_link'    => 'work/destroy/{work_id}',
            'route_name'    => 'Xóa công việc'
        ],


        // TODO CÔNG VIỆC - NGƯỜI DÙNG
        [
            'route_link'    => 'work_user',
            'route_name'    => 'GD quản lý công việc của ng dùng'
        ],
        [
            'route_link'    => 'work_user/work_history/{user_id}',
            'route_name'    => 'GD hiển thị lịch sử công việc'
        ],
        [
            'route_link'    => 'work_user/create',
            'route_name'    => 'GD thêm công việc của người dùng'
        ],
        [
            'route_link'    => 'work_user/create',
            'route_name'    => 'Lưu công việc của người dùng'
        ],
        [
            'route_link'    => 'work_user/edit/{work_user_id}',
            'route_name'    => 'GD chỉnh sửa công việc của người dùng'
        ],
        [
            'route_link'    => 'work_user/edit/submit/{work_user_id}',
            'route_name'    => 'Cập nhật công việc của người dùng'
        ],
        [
            'route_link'    => 'work_user/destroy/{work_user_id}',
            'route_name'    => 'Xóa công việc của người dùng'
        ],


        // TODO MAIL
        [
            'route_link'    => 'mails',
            'route_name'    => 'GD gửi mail'
        ],
        [
            'route_link'    => 'mails/store',
            'route_name'    => 'GD lưu và gửi mail'
        ],
        [
            'route_link'    => 'mails/store',
            'route_name'    => 'Lưu và gửi mail'
        ],
        [
            'route_link'    => 'mails/import_list_mails',
            'route_name'    => 'Import danh sách người dùng vào để gửi nhìu người'
        ],
        [
            'route_link'    => 'mails/{send_class?}',
            'route_name'    => 'Lấy parameter trên url khi gửi mail trên lớp cố vấn'
        ],


        // TODO PHÂN QUYỀN
        [
            'route_link'    => 'permissions',
            'route_name'    => 'GD quản lý phân quyền'
        ],
        [
            'route_link'    => 'permissions/create/{id}',
            'route_name'    => 'GD thêm route cho phân quyền'
        ],
        [
            'route_link'    => 'permissions/store',
            'route_name'    => 'Lưu route cho phân quyền'
        ],
        [
            'route_link'    => 'permissions/show/{role_id}',
            'route_name'    => 'Hiển thị route của phân quyền đó'
        ],
        [
            'route_link'    => 'permissions/delete_route/{permission_id}',
            'route_name'    => 'Xóa route của phân quyền đó'
        ],
        [
            'route_link'    => 'permissions/advance',
            'route_name'    => 'GD phân vai trò nâng cao',
        ],
        [
            'route_link'    => 'permissions/give_admin_permission/{userID}',
            'route_name'    => 'Gán quyền là Admin',
        ],
        [
            'route_link'    => 'permissions/remove_admin_permission/{userID}',
            'route_name'    => 'Xóa quyền là Admin',
        ],

        [
            'route_link'    => 'permissions/give_teacher_permission/{userID}',
            'route_name'    => 'Gán quyền là giảng viên',
        ],
        [
            'route_link'    => 'permissions/remove_teacher_permission/{userID}',
            'route_name'    => 'Xóa quyền là giảng viên',
        ],
        [
            'route_link'    => 'permissions/give_alumni_permission/{userID}',
            'route_name'    => 'Gán quyền là cựu sinh viên',
        ],
        [
            'route_link'    => 'permissions/remove_alumni_permission/{userID}',
            'route_name'    => 'Xóa quyền là cựu sinh viên',
        ],
        [
            'route_link'    => 'permissions/give_student_permission/{userID}',
            'route_name'    => 'Gáng quyền là sinh viên',
        ],
        [
            'route_link'    => 'permissions/remove_student_permission/{userID}',
            'route_name'    => 'Xóa quyền là sinh viên',
        ],
        [
            'route_link'    => 'permissions/give_manager_permission/{userID}',
            'route_name'    => 'Gáng quyền là giáo vụ khoa',
        ],
        [
            'route_link'    => 'permissions/remove_manager_permission/{userID}',
            'route_name'    => 'Xóa quyền là giáo vụ khoa',
        ],
        [
            'route_link'    => 'permissions/personal_routes',
            'route_name'    => 'Hiển thị danh sách người dùng cho Admin thêm route ưu tiên',
        ],
        [
            'route_link'    => 'permissions/add_personal_route/{userID}',
            'route_name'    => 'Thực hiện thêm route ưu tiên cho người dùng chỉ định',
        ],
        [
            'route_link'    => 'permissions/store_personal_route',
            'route_name'    => 'Lưu trữ route ưu tiên đó vào bảng permission_users',
        ],
        [
            'route_link'    => 'permissions/show_permission_route/{userID}',
            'route_name'    => 'Show ra người dùng chỉ định có bao nhiêu route ưu tiên',
        ],
        [
            'route_link'    => 'permissions/remove_personal_route/{permissionUserID}',
            'route_name'    => 'Xóa route ưu tiên của người dùng chỉ định',
        ],
        



        // TODO IMPORTS
        [
            'route_link'    => 'imports/index',
            'route_name'    => 'GD import tất cả ',
        ],
        [
            'route_link'    => 'imports/import_students',
            'route_name'    => 'import danh sách sinh viên',
        ],
        [
            'route_link'    => 'imports/import_alumnies',
            'route_name'    => 'import danh sách cựu sinh viên',
        ],
        [
            'route_link'    => 'imports/import_graduate',
            'route_name'    => 'import bảng điểm',
        ],
        [
            'route_link'    => 'imports/show_file_import/{phase}/{year}',
            'route_name'    => 'Hiển thị file danh sách tốt nghiệp đã import',
        ],

        // TODO LOP CO VAN
        [
            'route_link'    => 'lop_co_van',
            'route_name'    => 'GD lop co van',
        ],


    );
        DB::table('routes')->insert($data);
    }
}
