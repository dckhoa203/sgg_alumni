<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('posts/', 'Master\PostController@index')->name('posts.index');
Route::get('posts/news/{category_slug}/{slug}/{postID}', 'Master\PostController@posts_slug')->name('posts.slug');
// CATEGORIES Tìm việc làm
Route::get('posts/categories_find_job', 'Master\PostController@categories_find_job')->name('posts.categories_find_job');

// CATEGORIES Tuyển việc làm
Route::get('posts/categories_apply_job', 'Master\PostController@categories_apply_job')->name('posts.categories_apply_job');

// CATEGORIES Họp lớp
Route::get('posts/categories_class_meeting', 'Master\PostController@categories_class_meeting')->name('posts.categories_class_meeting');

// CATEGORIES Hổ trợ học bổng
Route::get('posts/categories_support_scholarship', 'Master\PostController@categories_support_scholarship')->name('posts.categories_support_scholarship');

// CATEGORIES Quyên góp
Route::get('posts/categories_donations', 'Master\PostController@categories_donations')->name('posts.categories_donations');

// CATEGORIES Thông báo
Route::get('posts/categories_notifications', 'Master\PostController@categories_notifications')->name('posts.categories_notifications');
Route::get('/', function () {
    return view('pages.admins.category.index');
});

Route::get('/test_calendar', function () {
    return view('pages.admins.test_calendar');
});

    // TODO QUÊN MẬT KHẨU
    Route::group(['prefix' => 'forget_passwords'], function () {
        Route::get('/', 'Master\ForgetPassController@index')->name('forget_passwords.index');

        Route::post('/update', 'Master\ForgetPassController@update')->name('forget_passwords.update');

        Route::get('/reset/{userID}/{email}/{token}', 'Master\ForgetPassController@get_url_token')->name('forget_passwords.get_url_token');

        Route::get('/update_password/{userID}/{email}/{token}', 'Master\ForgetPassController@update_password')->name('forget_passwords.update_password');

        Route::post('/update_password_submit/{userID}', 'Master\ForgetPassController@update_password_submit')->name('forget_passwords.update_password_submit');
    });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// RETURN ERROR
Route::get('/error', function () {
    return view('pages.admins.error');
})->name('error');


Route::get('/error_role',function(){
    return view('pages.admins.error_role');
})->name('error_role');

Route::get('/profile/logout', 'Master\AccountController@logout')->name('accounts/logout');

Route::group(['middleware' => ['auth']], function () {
    // TODO Midleware permission
    Route::group(['middleware' => ['permission']], function () {
        // ACCOUNT
        Route::prefix('accounts')->group(function () {
            // PROFILE
            // Route::get('/profile', "Master\AccountController@profile")->name('accounts/profile');

            // TODO PROFILE NEW
            Route::get('/profile', 'Master\AccountController@profile_new')->name('accounts.profile_new');

            // TODO THÊM EMAIL LIÊN HỆ GIÀNH CHO CỰU SINH VIÊN
            Route::post('/add_other_email/{userID}', 'Master\AccountController@add_other_email')->name('accounts/add_other_email');
            // UPDATE PROFILE
            Route::post('/update_profile/{user_id}', 'Master\AccountController@update_profile')->name('accounts/update_profile');

            // LOGOUT
            // Route::get('/profile/logout', 'Master\AccountController@logout')->name('accounts/logout');

            // JOBS
            Route::get('/jobs', 'Master\AccountController@jobs')->name('accounts/jobs');

            // ADD WORK FOR ALUMNI
            Route::post('/add_work_submit', 'Master\AccountController@add_work_submit')->name('accounts/add_work_submit');

            // HIỂN THỊ TÁT CẢ CÔNG VIỆC CỦA MÌNH ĐÃ LÀM VỪA QUA
            Route::get('/show_work_yourself', 'Master\AccountController@show_work')->name('accounts/show_work_yourself');

            // XỬ LÝ BUTTON NGHỈ VIỆC
            Route::post('/resign_ajax', 'Master\AccountController@resign_ajax')->name('accounts/resign_ajax');

            // HIỂN THỊ CÔNG VIỆC HIỆN TẠI CỦA MÌNH VÀ THỰC HIỆN CHỨC NĂNG NGHỈ VIỆC
            Route::get('/show_current_work_and_resign', 'Master\AccountController@show_current_work_and_resign')->name('accounts/show_current_work_and_resign');

            // THAY ĐỔI MẬT KHẨU CÁ NHÂN
            Route::get('/change_password', 'Master\AccountController@change_password')->name('account/change_password');
            Route::post('/update_password', 'Master\AccountController@update_password')->name('accounts/update_password');

            // TODO CẬP NHẬT CÔNG VIỆC CỦA NGƯỜI DÙNG
            Route::post('/update_job/{workID}', 'Master\AccountController@update_job')->name('accounts/update_job');
        });

        // ACADEMY
        Route::prefix('khoa-vien')->group(function () {
            Route::get('/', "Master\AcademyController@index")->name('khoa-vien/index');
            // Route::group(['middleware' => ['checkadmin']], function () {
            // ADD
            Route::get('/them', "Master\AcademyController@create_render")->name('khoa-vien/them');
            Route::post('/them', "Master\AcademyController@create_submit")->name('khoa-vien/them/submit');
            // EDIT
            Route::get('/edit/{academy_id}', 'Master\AcademyController@edit')->name('khoa-vien/edit');
            Route::post('/edit/submit/{academy_id}', 'Master\AcademyController@update')->name('khoa-vien/edit/submit');
            // DELETE
            Route::post('/destroy/{academy_id}', 'Master\AcademyController@destroy')->name('khoa-vien/destroy');
            // });
                // TODO end checkAdmin
        });

        // STUDENT
        Route::prefix('students')->group(function () {
            Route::get('/', 'Master\StudentController@index')->name('students.index');

            // Route::group(['middleware' => ['checkadmin']], function () {
            //IMPORT EXPORT
            // Route::get('export', 'Master\StudentController@export')->name('students.export');
            Route::get('importExportView', 'Master\StudentController@importExportView');
            Route::post('import', 'Master\StudentController@import')->name('students.import');

            // ADD
            Route::get('/create', 'Master\StudentController@create')->name('students.create');
            Route::post('/create_submit', 'Master\StudentController@store')->name('students.store');

            // EDIT
            Route::get('/edit/{user_id}', 'Master\StudentController@edit')->name('students.edit');
            Route::post('/edit_submit/{user_id}', 'Master\StudentController@update')->name('students.update');
            // SHOW
            Route::get('/show/{user_id}', 'Master\StudentController@show')->name('students.show');
            // DELETE
            Route::post('/delete/{user_id}', 'Master\StudentController@destroy')->name('students.destroy');

            // LIVE SEARCH STUDENT
            Route::get('/live_search_student', 'Master\StudentController@live_search_student')->name('students.live_search_action');
            // });
                // TODO end checkAdmin
        });

        // TEACHER
        Route::prefix('teacher')->group(function () {
            Route::get('/', 'Master\TeacherController@index')->name('teacher.index');

            // Route::group(['middleware' => ['checkadmin']], function () {
            //IMPORT EXPORT
            Route::get('importExportView', 'Master\TeacherController@importExportView');
            Route::post('import', 'Master\TeacherController@import')->name('teacher.import');

            // ADD
            Route::get('/create', 'Master\TeacherController@create')->name('teacher.create');
            Route::post('/create_submit', 'Master\TeacherController@store')->name('teacher.store');

            // EDIT
            Route::get('/edit/{user_id}', 'Master\TeacherController@edit')->name('teacher.edit');
            Route::post('/edit_submit/{user_id}', 'Master\TeacherController@update')->name('teacher.update');
            // SHOW
            Route::get('/show/{user_id}', 'Master\TeacherController@show')->name('teacher.show');
            // DELETE
            Route::post('/delete/{user_id}', 'Master\TeacherController@destroy')->name('teacher.destroy');

            // LIVE SEARCH TEACHER
            Route::get('/live_search_teacher', 'Master\TeacherController@live_search_teacher')->name('teacher.live_search_action');
            // });
                // TODO end checkAdmin
        });

        // ALUMNI
        Route::prefix('alumnies')->group(function () {
            Route::get('/', 'Master\AlumniController@index')->name('alumnies/index');

            // Route::group(['middleware' => ['checkadmin']], function () {
            // ADD
            Route::get('/create', 'Master\AlumniController@create')->name('alumnies/create');
            Route::post('/create_submit', 'Master\AlumniController@store')->name('alumnies/store');
            // EDIT
            Route::get('/edit/{user_id}', 'Master\AlumniController@edit')->name('alumnies/edit');
            Route::post('/edit_submit/{user_id}', 'Master\AlumniController@update')->name('alumnies/update');
            // SHOW
            Route::get('/show/{user_id}', 'Master\AlumniController@show')->name('alumnies/show');
            Route::post('/show/show_submit/{user_id}', 'Master\AlumniController@show_submit')->name('alumnies/show_submit');
            // DELETE
            Route::post('/delete/{user_id}', 'Master\AlumniController@destroy')->name('alumnies/destroy');

            // TODO LỚP CỦA TÔI
            Route::get('/myclass','Master\AlumniController@myClass')->name('alumnies.myClass');
            // EXPORT
            // Route::get('/export', 'Master\AlumniController@export')->name('alumnies/export');
            // IMPORT
            // Route::post('/import', 'Master\AlumniController@import')->name('alumnies/import');

            // IMPORT GRADUATE
            Route::post('/import_graduate', 'Master\AlumniController@import_graduate')->name('alumnies/import_register_graduate');

            // SHOW DETAILS WORK OF USERS HAVE STATUS_ID === 3 : DI LAM
            Route::get('/show_details_work/{alumni_id}', 'Master\AlumniController@show_details_work')->name('alumnies/show_details_work');

            // LIVE SEARCH ALUMNIES
                // Route::get('/live_search', 'Master\AlumniController@live_search')->name('alumnies/live_search_action');
            // });

            // TODO GROUP CHAT TRÊN LỚP CỦA TÔI
            Route::get('/myClass/Groupchat','Master\AlumniController@viewgroupchat')->name('alumnies.myClass.groupChat');

            // TODO end checkAdmin
        });

        // POST
        Route::prefix('posts')->group(function () {
            // // REGISTER
            // Route::get('/register', 'Master\PostController@register')->name('posts.register');
            // Route::post('/register', 'Master\PostController@register_store')->name('posts.register_store');
            // Route::get('/sucess', 'Master\PostController@success')->name('posts.success');

            // // LOGIN
            // Route::get('/login', 'Master\PostController@login')->name('posts.login');
            // Route::get('/login2', 'Master\PostController@login2')->name('posts.login2');
            // Route::post('/checklogin', 'Master\PostController@checklogin')->name('posts.checklogin');

            // // LOGOUT
            // Route::get('/logout', 'Master\PostController@logout')->name('posts.logout');

            // TRANG INDEX
            // Route::get('/', 'Master\PostController@index')->name('posts.index');

            // CHỨC NĂNG ĐĂNG BÀI
            Route::get('/add_posts', 'Master\PostController@add_posts')->name('posts.add_posts');
            Route::post('/store', 'Master\PostController@store')->name('posts.store');

            // LIST POST STUDENTS
            Route::get('/list_post_students', 'Master\PostController@list_post_students')->name('posts.list_post_students');

            // HIỂN THỊ CHI TIẾT BÀI VIẾT KHI CLICK VÀO

            // Route::get('/news/{category_slug}/{slug}', 'Master\PostController@posts_slug')->name('posts.slug');

            // Route::get('{category_slug}/{slug}', 'Master\PostController@posts_slug')->name('posts.slug');

            // LIST POST YOUR CLASS
            Route::get('/post_your_class', 'Master\PostController@post_your_class')->name('posts.post_your_class');

            // LIST POST TEACHERS
            Route::get('/list_post_teachers', 'Master\PostController@list_post_teachers')->name('posts.list_post_teachers');

            // COMMENT
            Route::post('/comment_ajax', 'Master\PostController@comment_ajax')->name('posts.comment_ajax');

            // POST OF YOURSELF
            // Route::get('/post_yourself', 'Master\PostController@post_yourself')->name('posts.post_yourself');

            // // CATEGORIES Tìm việc làm
            // Route::get('/categories_find_job', 'Master\PostController@categories_find_job')->name('posts.categories_find_job');

            // // CATEGORIES Tuyển việc làm
            // Route::get('/categories_apply_job', 'Master\PostController@categories_apply_job')->name('posts.categories_apply_job');

            // // CATEGORIES Họp lớp
            // Route::get('/categories_class_meeting', 'Master\PostController@categories_class_meeting')->name('posts.categories_class_meeting');

            // // CATEGORIES Hổ trợ học bổng
            // Route::get('/categories_support_scholarship', 'Master\PostController@categories_support_scholarship')->name('posts.categories_support_scholarship');

            // // CATEGORIES Quyên góp
            // Route::get('/categories_donations', 'Master\PostController@categories_donations')->name('posts.categories_donations');

            // // CATEGORIES Thông báo
            // Route::get('/categories_notifications', 'Master\PostController@categories_notifications')->name('posts.categories_notifications');

            // TODO GET PARAMETER ĐĂNG BÀI TRÊN LỚP
            Route::get('/post_only_class/{post_only_class?}', 'Master\PostController@post_class_url')
                    ->where('post_only_class', '(.*)')
                    ->name('posts.post_only_class');

            // Route::group(['middleware' => ['checkadmin']], function () {
            // TODO ADMIN
            // Xử lý duyệt bài trên Admin
            Route::get('/list_post', 'Master\PostController@list_post')->name('posts.list_post');
            Route::post('/list_post_ajax', 'Master\PostController@list_post_ajax')->name('posts.list_post_ajax');

            // HIỂN THỊ CHI TIẾT BÀI VIẾT TRÊN CHỨC NĂNG DUYỆT BÀI CỦA ADMIN
            Route::get('/show_post_detail_of_admin/{post_id}', 'Master\PostController@show_post_detail_of_admin')->name('posts.show_post_detail_of_admin');

            // CHỨC NĂNG KHÓA TÀI KHOẢN NGƯỜI DÙNG NẾU ĐĂNG NHỮNG BÀI KHÔNG HỢP LÝ
            Route::post('/block_user_ajax', 'Master\PostController@block_user_ajax')->name('posts.block_user_ajax');

            // HIỂN THỊ DANH SÁCH TÀI KHOẢN BỊ KHÓA VÀ CHỨC NĂNG MỞ KHÓA TÀI KHOẢN ĐÓ
            Route::get('/lists_account_blocked', 'Master\PostController@lists_account_blocked')->name('posts.lists_account_blocked');
            Route::post('/unblock_account_ajax', 'Master\PostController@unblock_account_ajax')->name('posts.unblock_account_ajax');

            // TODO XÓA BÀI VIẾT KHÔNG HỢP LỆ
            Route::post('/destroy/{postID}','Master\PostController@destroy')->name('posts/destroy');

            // TODO SUA COMMENT
            Route::post('/submit_comment/{commentID}','Master\PostController@submit_comment')->name('posts/submit_comment');

            // TODO XOA COMMENT
            Route::post('/posts/delete_comment/{commentID}','Master\PostController@delete_comment')->name('posts/delete_comment');
            // });
                // TODO end checkAdmin
        });

        //Major
        Route::group(['prefix' => 'major'], function () {
            Route::get('/', "Master\MajorController@index")->name('major/index');

            // Route::group(['middleware' => ['checkadmin']], function () {
            // ADD
            Route::get('/create', "Master\MajorController@create_render")->name('major/create');
            Route::post('/create', "Master\MajorController@create_submit")->name('major/create/submit');
            // EDIT
            Route::get('/edit/{major_id}', 'Master\MajorController@edit')->name('major/edit');
            Route::post('/edit/submit/{major_id}', 'Master\MajorController@update')->name('major/edit/submit');
            // DELETE
            Route::post('/destroy/{major_id}', 'Master\MajorController@destroy')->name('major/destroy');
            // });
                // TODO end checkAdmin
        });
        //Major Branch
        Route::group(['prefix' => 'major_branch'], function () {
            Route::get('/', "Master\MajorBranchController@index")->name('major_branch/index');
            // Route::group(['middleware' => ['checkadmin']], function () {
            // ADD
            Route::get('/create', "Master\MajorBranchController@create_render")->name('major_branch/create');
            Route::post('/create', "Master\MajorBranchController@create_submit")->name('major_branch/create/submit');
            // EDIT
            Route::get('/edit/{major_branch_id}', 'Master\MajorBranchController@edit')->name('major_branch/edit');
            Route::post('/edit/submit/{major_branch_id}', 'Master\MajorBranchController@update')->name('major_branch/edit/submit');
            // DELETE
            Route::post('/destroy/{major_branch_id}', 'Master\MajorBranchController@destroy')->name('major_branch/destroy');
            // });
                // TODO end checkAdmin
        });
        //Class
        Route::group(['prefix' => 'class'], function () {
            Route::get('/', "Master\ClassController@index")->name('class/index');

            Route::get('/index_teacher', 'Master\ClassController@index_teacher')->name('class/index_teacher');

            // Route::group(['middleware' => ['checkadmin']], function () {
            // ADD
            Route::get('/create', "Master\ClassController@create_render")->name('class/create');
            Route::post('/create', "Master\ClassController@create_submit")->name('class/create/submit');
            // QUICK ADD
            Route::get('/create_quick', "Master\ClassController@render_quick")->name('class/create_quick');
            Route::post('/create_quick', "Master\ClassController@submit_quick")->name('class/create_quick/submit');
            // EDIT
            Route::get('/edit/{class_id}', 'Master\ClassController@edit')->name('class/edit');
            Route::post('/edit/submit/{class_id}', 'Master\ClassController@update')->name('class/edit/submit');
            // SHOW
            Route::get('/show/{class_id}', 'Master\ClassController@show')->name('class/show');
            // DELETE
            Route::post('/destroy/{class_id}', 'Master\ClassController@destroy')->name('class/destroy');
            //DOM
            Route::get('major_branch/{major_id}', 'Master\ClassController@get_major_branch')->name('class.major_branch');
            Route::get('major_branch/edit/{major_id}', 'Master\ClassController@get_major_branch_edit')->name('class.get_major_branch_edit');

            // QUICK ADD
            Route::get('/create_quick', "Master\ClassController@render_quick")->name('class/create_quick');
            Route::post('/create_quick', "Master\ClassController@submit_quick")->name('class/create_quick/submit');
            // });
                // TODO end checkAdmin

            //Import
            Route::post('/import', 'Master\ClassController@import')->name('class/import');
        });

        //Survey
        Route::group(['prefix' => 'survey'], function () {
            Route::get('/', 'Master\SurveyController@index')->name('survey.index');
            Route::get('/view/{survey}', 'Master\SurveyController@view_survey')->name('survey.view');
            //trả lời
            Route::post('/view/{survey}/completed', 'Master\AnswerController@store')->name('survey.complete');
            //trả lời lại
            Route::post('/view/{survey}/update', 'Master\AnswerController@update')->name('survey.update_answer');

            // Route::group(['middleware' => ['checkadmin']], function () {
            //create survey
            Route::get('/create', 'Master\SurveyController@create_render')->name('survey.create_render');
            Route::post('/create_submit', 'Master\SurveyController@create_submit')->name('survey/create/submit');
            //add question
            Route::get('/{survey}', 'Master\SurveyController@detail_survey')->name('survey.detail');
            //update survey
            Route::post('/destroy/{survey_id}', 'Master\SurveyController@destroy')->name('survey/destroy');
            Route::get('/{survey}/edit', 'Master\SurveyController@edit')->name('survey.edit');
            Route::post('/{survey}/update', 'Master\SurveyController@update')->name('survey.update');
            //tạo mới
            Route::get('/{survey}/add_new', 'Master\SurveyController@add_new')->name('survey.add_new');

            // Route::get('/view/{survey}', 'Master\SurveyController@view_survey')->name('survey.view');
            //xem đáp án
            Route::get('/answers/{survey}', 'Master\SurveyController@view_survey_answers')->name('view.survey.answers');
            //export
            Route::get('/view/{survey}/export', 'Master\AnswerController@excel')->name('survey.export');
            //trả lời
            // Route::post('/view/{survey}/completed', 'Master\AnswerController@store')->name('survey.complete');

            //thêm câu hỏi
            Route::post('/{survey}/questions', 'Master\QuestionController@store')->name('survey.store');
            Route::post('/export', 'Master\SurveyController@export')->name('survey.export');
            Route::get('/{question}/remove', 'Master\QuestionController@remove')->name('question.remove');

            // });
                // TODO end checkAdmin
        });
        // TODO end checkAdmin

        // //Survey
        // Route::group(['prefix' => 'survey'], function () {
        //     Route::get('/', 'Master\SurveyController@index')->name('survey.index');
        //     Route::group(['middleware' => ['checkadmin']], function () {
        //         //create survey
        //         Route::get('/create', 'Master\SurveyController@create_render')->name('survey.create_render');
        //         Route::post('/create_submit', 'Master\SurveyController@create_submit')->name('survey/create/submit');
        //         //add question
        //         Route::get('/{survey}', 'Master\SurveyController@detail_survey')->name('survey.detail');
        //         //update survey
        //         Route::post('/destroy/{survey_id}', 'Master\SurveyController@destroy')->name('survey/destroy');
        //         Route::get('/{survey}/edit', 'Master\SurveyController@edit')->name('survey.edit');
        //         Route::post('/{survey}/update', 'Master\SurveyController@update')->name('survey.update');
        //         //tạo mới
        //         Route::get('/{survey}/add_new', 'Master\SurveyController@add_new')->name('survey.add_new');

        //         Route::get('/view/{survey}', 'Master\SurveyController@view_survey')->name('survey.view');
        //         //xem đáp án
        //         Route::get('/answers/{survey}', 'Master\SurveyController@view_survey_answers')->name('view.survey.answers');
        //         //export
        //         Route::get('/view/{survey}/export', 'Master\AnswerController@excel')->name('survey.export');
        //         //trả lời
        //         Route::post('/view/{survey}/completed', 'Master\AnswerController@store')->name('survey.complete');

        //         //thêm câu hỏi
        //         Route::post('/{survey}/questions', 'Master\QuestionController@store')->name('survey.store');
        //         Route::post('/export', 'Master\SurveyController@export')->name('survey.export');
        //     });
        //     // TODO end checkAdmin
        // });
        Route::get('/chart', 'Master\SurveyController@chart');
        // Route::group(['middleware' => ['checkadmin']], function () {
        //Question
        Route::group(['prefix' => 'question'], function () {
            Route::get('/{question}/up', 'Master\QuestionController@up')->name('question.up');
            Route::post('/{question}/up', 'Master\QuestionController@up')->name('question.up.sub');
            Route::get('/{question}/down', 'Master\QuestionController@down')->name('question.down');
            Route::post('/{question}/down', 'Master\QuestionController@update')->name('question.down.sub');

            Route::get('/{question}/edit', 'Master\QuestionController@edit')->name('question.edit');
            Route::post('/{question}/update', 'Master\QuestionController@update')->name('question.update');
            Route::get('/{question_id}/{value}/delete/', 'Master\QuestionController@delete')->name('question.delete');
        });
        // TODO end checkAdmin
        // });

        //Thống kê
        Route::group(['prefix' => 'statistic'], function () {
            Route::get('/', 'Master\StatisticController@index')->name('statistic');
            // Route::group(['middleware' => ['checkadmin']], function () {
            Route::get('/showsurvey/{survey_id}', 'Master\StatisticController@get_survey')->name('statistic.get_survey');
            Route::post('/show', 'Master\StatisticController@show')->name('statistic.show');
            Route::post('/export', 'Master\StatisticController@export')->name('statistic.export');

            //thống kê tỉ lệ tốt nghiệp
            Route::get('/student', 'Master\StatisticController@student')->name('statistic.student');
            Route::post('/student', 'Master\StatisticController@course')->name('statistic.student_sort');
            // ajax lấy marjor_branch theo major_id
            Route::post('/showMajor', 'Master\StatisticController@showMajor');
            Route::get('major/{course}', 'Master\StatisticController@get_major')->name('statistic.major');
            Route::get('major_branch/{major_id}', 'Master\StatisticController@get_major_branch')->name('statistic.major_branch');
            Route::get('class/{major_id}/{major_branch_id}/{course}', 'Master\StatisticController@get_class')->name('statistic.class');

            //thống kê việc làm
            Route::get('job', 'Master\StatisticController@job')->name('statistic.job');
            Route::post('job', 'Master\StatisticController@job_statistic')->name('statistic.job_statistic');
            Route::post('job_export', 'Master\StatisticController@job_export')->name('statistic.job_export');
            // Lương
            // Route::get('/salary', 'Master\StatisticController@salary')->name('statistic.salary');

            // Thống kê form khảo sát
            Route::get('/show_surveys', 'Master\StatisticController@show_surveys')->name('statistic.show_surveys');
            Route::post('/show_statistic_surveys/{survey_id}', 'Master\StatisticController@show_statistic_surveys')->name('statistic.show_statistic_surveys');
            Route::post('/export_statistic_surveys', 'Master\StatisticController@export_statistic_surveys')->name('statistic.export_statistic_surveys');

            // TODO THỐNG KÊ VIỆC LÀM THỰC TÉ
            Route::get('/job_profile','Master\StatisticController@job_profile')->name('statistic.job_profile');
            // });
                // TODO end checkAdmin
        });

        // ROLE_SURVEY

        // route::prefix('rolesurveys')->group(function () {
        //     route::get('/', 'Master\RoleSurveyController@index')->name('rolesurveys/index');

        //     //add
        //     route::get('/create', 'Master\RoleSurveyController@create_render')->name('rolesurveys/create');
        //     route::post('/create', 'Master\RoleSurveyController@create_submit')->name('rolesurveys/create/submit');
        //     //edit
        //     route::get('/edit/{role_survey_id}', 'Master\RoleSurveyController@edit');
        //     route::post('/edit/{role_survey_id}', 'Master\RoleSurveyController@update');
        //     //delete
        //     route::post('/destroy/{role_survey_id}', 'Master\RoleSurveyController@destroy')->name('rolesurveys/destroy');
        // });

        // CITY
        Route::prefix('city')->group(function () {
            Route::get('/', 'Master\CityController@index')->name('city/index');
            // Route::group(['middleware' => ['checkadmin']], function () {
            //create
            Route::get('/create', 'Master\CityController@create_render')->name('city/create');
            Route::post('/create', 'Master\CityController@create_submit')->name('city/create/submit');
            //edit
            Route::get('/edit/{city_id}', 'Master\CityController@edit')->name('city/edit');
            Route::post('/edit/submit/{city_id}', 'Master\CityController@update')->name('city/edit/submit');
            // delete
            Route::post('/destroy/{city_id}', 'Master\CityController@destroy')->name('city/destroy');
            // });
                // TODO end checkAdmin
        });

        // DISTRICT
        Route::prefix('district')->group(function () {
            Route::get('/', 'Master\DistrictController@index')->name('district/index');
            // Route::group(['middleware' => ['checkadmin']], function () {
            //create
            Route::get('/create', 'Master\DistrictController@create_render')->name('district/create');
            Route::post('/create', 'Master\DistrictController@create_submit')->name('district/create/submit');
            //edit
            Route::get('/edit/{district_id}', 'Master\DistrictController@edit')->name('district/edit');
            Route::post('/edit/submit/{district_id}', 'Master\DistrictController@update')->name('district/edit/submit');
            // delete
            Route::post('/destroy/{district_id}', 'Master\DistrictController@destroy')->name('district/destroy');
            // });
                // TODO end checkAdmin
        });

        // WARD
        Route::prefix('ward')->group(function () {
            Route::get('/', 'Master\WardController@index')->name('ward/index');
            // Route::group(['middleware' => ['checkadmin']], function () {
            //create
            Route::get('/create', 'Master\WardController@create_render')->name('ward/create');
            Route::post('/create', 'Master\WardController@create_submit')->name('ward/create/submit');
            //edit
            Route::get('/edit/{ward_id}', 'Master\WardController@edit')->name('ward/edit');
            Route::post('/edit/submit/{ward_id}', 'Master\WardController@update')->name('ward/edit/submit');
            // delete
            Route::post('/destroy/{ward_id}', 'Master\WardController@destroy')->name('ward/destroy');
            // ajax lấy district theo city_id
            Route::get('/district/{city_id}', 'Master\WardController@getDistrict');
            // });
                // TODO end checkAdmin
        });

        // COMPANY
        Route::prefix('company')->group(function () {
            Route::get('/', 'Master\CompanyController@index')->name('company/index');
            // Route::group(['middleware' => ['checkadmin']], function () {
            //create
            Route::get('/create', 'Master\CompanyController@create_render')->name('company/create');
            Route::post('/create', 'Master\CompanyController@create_submit')->name('company/create/submit');
            //edit
            Route::get('/edit/{company_id}', 'Master\CompanyController@edit')->name('company/edit');
            Route::post('/edit/submit/{company_id}', 'Master\CompanyController@update')->name('company/edit/submit');
            // delete
            Route::post('/destroy/{company_id}', 'Master\CompanyController@destroy')->name('company/destroy');
            // Ajax lấy districts theo city_id
            Route::get('/district/{city_id}', 'Master\CompanyController@getDistrict');
            // Ajax lấy wards theo district_id
            Route::get('/ward/{district_id}', 'Master\CompanyController@getWard');
            // });
                // TODO end checkAdmin
        });

        // Route::group(['middleware' => ['checkadmin']], function () {
        // WORK
        Route::prefix('work')->group(function () {
            Route::get('/', 'Master\WorkController@index')->name('work/index');
            //create
            Route::get('/create', 'Master\WorkController@create_render')->name('work/create');
            Route::post('/create', 'Master\WorkController@create_submit')->name('work/create/submit');
            //edit
            Route::get('/edit/{work_id}', 'Master\WorkController@edit')->name('work/edit');
            Route::post('/edit/submit/{work_id}', 'Master\WorkController@update')->name('work/edit/submit');
            // delete
            Route::post('/destroy/{work_id}', 'Master\WorkController@destroy')->name('work/destroy');
        });

        // WORK_USER
        Route::prefix('work_user')->group(function () {
            Route::get('/', 'Master\WorkUserController@index')->name('work_user/index');
            // show work_history
            Route::get('/work_history/{user_id}', 'Master\WorkUserController@work_history')->name('work_user/work_history');
            //create
            Route::get('/create', 'Master\WorkUserController@create_render')->name('work_user/create');
            Route::post('/create', 'Master\WorkUserController@create_submit')->name('work_user/create/submit');
            //edit
            Route::get('/edit/{work_user_id}', 'Master\WorkUserController@edit')->name('work_user/edit');
            Route::post('/edit/submit/{work_user_id}', 'Master\WorkUserController@update')->name('work_user/edit/submit');
            // delete
            Route::post('/destroy/{work_user_id}', 'Master\WorkUserController@destroy')->name('work_user/destroy');
        });
        // });
        // TODO end checkAdmin
        // // SALARY
        // Route::group(['prefix' => 'statistic'], function () {
        //     Route::get('/salary', 'Master\StatisticController@salary')->name('statistic.salary');
        // });

        // SEND-MAIL
        Route::prefix('mails')->group(function () {
            // TRANG INDEX
            Route::get('/', 'Master\SendEmailController@index')->name('mails.index');

            // TODO GET PARAMETER GỬI MAIL TRÊN LỚP
            Route::get('/{send_class?}', 'Master\SendEmailController@get_class_url')
                ->where('send_class', '(.*)')
                ->name('mails.send_class');

            //STORE
            Route::get('/store', 'Master\SendEmailController@store')->name('mails.store');
            Route::post('/store', 'Master\SendEmailController@store')->name('mails.store');

            // IMPORT LIST MAILS
            Route::post('/import_list_mails', 'Master\SendEmailController@import_list_mails')->name('mails.import_list_mails');
        });

        // Route::group(['middleware' => ['checkadmin']], function () {
        // PHÂN QUYỀN
        Route::group(['prefix' => 'permissions'], function () {
            // INDEX
            Route::get('/', 'Master\PermissionController@index')->name('permissions/index');
            // CREATE
            Route::get('/create/{id}', 'Master\PermissionController@create')->name('permissions/create');
            // STORE
            Route::post('/store', 'Master\PermissionController@store')->name('permissions/store');
            // SHOW
            Route::get('/show/{role_id}', 'Master\PermissionController@show')->name('permissions/show');

            // XÓA ROUTE CỦA 1 PHÂN QUYỀN NÀO ĐÓ
            Route::post('/delete_route/{permission_id}', 'Master\PermissionController@destroy')->name('permissions/remove_route');

            // NÂNG CAO XÓA VÀ THÊM ROLE CHO 1 NGƯỜI DÙNG
            Route::get('/advance', 'Master\PermissionController@permission_advance')->name('permissions/advance');

            // TODO ADMIN PERMISSION
            // CHO PHÂN QUYỀN LÀ ADMIN
            Route::get('/give_admin_permission/{userID}', 'Master\PermissionController@give_admin_permission')->name('permissions/give_admin');
            // XÓA PHÂN QUYỀN LÀ ADMIN
            Route::get('/remove_admin_permission/{userID}', 'Master\PermissionController@remove_admin_permission')->name('permissions/remove_admin');

            // TODO TEACHER PERMISSION
            // CHO PHÂN QUYỀN LÀ TEACHER
            Route::get('/give_teacher_permission/{userID}', 'Master\PermissionController@give_teacher_permission')->name('permissions/give_teacher');
            // XÓA PHÂN QUYỀN LÀ TEACHER
            Route::get('/remove_teacher_permission/{userID}', 'Master\PermissionController@remove_teacher_permission')->name('permissions/remove_teacher');
            // TODO ALUMNI PERMISSION
            // CHO PHÂN QUYỀN LÀ ALUMNI
            Route::get('/give_alumni_permission/{userID}', 'Master\PermissionController@give_alumni_permission')->name('permissions/give_alumni');
            // XÓA PHÂN QUYỀN LÀ ALUMNI
            Route::get('/remove_alumni_permission/{userID}', 'Master\PermissionController@remove_alumni_permission')->name('permissions/remove_alumni');
            // TODO STUDENT PERMISSION
            // CHO PHÂN QUYỀN LÀ STUDENT
            Route::get('/give_student_permission/{userID}', 'Master\PermissionController@give_student_permission')->name('permissions/give_student');
            // XÓA PHÂN QUYỀN LÀ STUDENT
            Route::get('/remove_student_permission/{userID}', 'Master\PermissionController@remove_student_permission')->name('permissions/remove_student');
            // TODO MANAGER ACADEMIES PERMISSION
            // CHO PHÂN QUYỀN LÀ GIÁO VỤ KHOA
            Route::get('/give_manager_permission/{userID}', 'Master\PermissionController@give_manager_permission')->name('permissions/give_manager');
            // XÓA PHÂN QUYỀN LÀ GIÁO VỤ KHOA
            Route::get('/remove_manager_permission/{userID}', 'Master\PermissionController@remove_manager_permission')->name('permissions/remove_manager');

            // TODO THÊM ĐƯỜNG DẪN CHO MỖI CÁ NHÂN RIÊNG ĐỂ THỰC HIỆN QUẢN LÝ KHẢO SÁT GIÚP CÔ
            // TODO SHOW VIEW 
            Route::get('/personal_routes','Master\PermissionController@personal_route')->name('permission/personal_route');

            // TODO SHOW
            Route::get('/show_permission_route/{userID}','Master\PermissionController@show_personal_route')->name('permissions/show_personal_route');
            //  TODO ADD
            Route::get('/add_personal_route/{userID}','Master\PermissionController@add_personal_route')->name('permissions/add_personal_route');

            // TODO STORE
            Route::post('/store_personal_route','Master\PermissionController@store_personal_route')->name('permissions/store_personal_route');
            // TODO DELETE
            Route::post('/remove_personal_route/{permissionUserID}','Master\PermissionController@remove_personal_route')->name('permissions/remove_personal_route');
        });
        // });
        // TODO end checkAdmin

        // Route::group(['middleware' => ['checkadmin']], function () {
        // IMPORT ALL
        Route::group(['prefix' => 'imports'], function () {
            Route::get('/index', 'Master\ImportController@index')->name('imports.index');
            Route::post('import_students', 'Master\ImportController@import_students')->name('imports.import_students');
            Route::post('import_alumnies', 'Master\ImportController@import_alumnies')->name('imports.import_alumnies');

            Route::post('import_graduate', 'Master\ImportController@import_graduate')->name('imports.import_graduate');
            // TODO HIỂN THỊ FILE ĐÃ IMPORT 
            Route::get('/show_file_import/{phase}/{year}','Master\ImportController@show_file_import')->name('imports.show_file_import');
        });
        // });
        // TODO end checkAdmin

        Route::group(['prefix' => 'lop_co_van'], function () {
            Route::get('/', 'Master\LopCoVanController@index')->name('lop_co_van/index');
        });
    });
    // TODO end middleware-permission
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
