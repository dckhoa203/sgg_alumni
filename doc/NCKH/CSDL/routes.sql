-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2019 at 05:05 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `route_id` int(10) UNSIGNED NOT NULL COMMENT 'id action',
  `route_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'đường dẫn',
  `route_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên đường dẫn',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tên các action trong danh sách xử lý';

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `route_link`, `route_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(154, 'accounts/profile', 'Thông tin cá nhân', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(155, 'accounts/update_profile/{user_id}', 'Cật nhật thông tin người dùng', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(156, 'accounts/profile/logout', 'Đăng xuất', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(157, 'accounts/jobs', 'Thông tin việc làm của người dùng', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(158, 'accounts/add_work_submit', 'Thêm công việc của người dùng', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(159, 'accounts/show_work_yourself', 'Hiển thị tất cả công việc của người dùng', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(160, 'accounts/resign_ajax', 'Xử lý button nghỉ việc của người dugnf', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(161, 'accounts/show_current_work_and_resign', 'Hiển thị công việc gần đây nhất và button nghỉ việc', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(162, 'accounts/change_password', 'Thay đổi mật khẩu người dùng', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(163, 'accounts/update_password', 'Cập nhật mật khẩu', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(164, 'khoa-vien', 'Index quản lý khoa viện', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(165, 'khoa-vien/them', 'GD Thêm 1 khoa/viện', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(166, 'khoa-vien/them', 'Store 1 khoa/viện', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(167, 'khoa-vien/edit/{academy_id}', 'GD chỉnh sửa khoa/viện', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(168, 'khoa-vien/edit/submit/{academy_id}', 'Store 1 khoa viện', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(169, 'khoa-vien/destroy/{academy_id}', 'Xóa 1 khoa viện', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(170, 'students', 'GD quản lý sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(171, 'students/importExportView', 'GD Import file danh sách sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(172, 'students/import', 'Import file danh sách sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(173, 'students/create', 'GD thêm 1 sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(174, 'students/create_submit', 'Store thêm 1 sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(175, 'students/edit/{user_id}', 'GD chỉnh sửa 1 sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(176, 'students/edit_submit/{user_id}', 'Store chỉnh sửa 1 sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(177, 'students/show/{user_id}', 'GD show thông tin sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(178, 'students/delete/{user_id}', 'Xóa 1 sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(179, 'teacher', 'GD quản lý giảng viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(180, 'teacher/importExportView', 'GD import ds giảng viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(181, 'teacher/import', 'STORE import ds giảng viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(182, 'teacher/create', 'GD thêm một giảng viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(183, 'teacher/create_submit', 'STORE một giảng viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(184, 'teacher/edit/{user_id}', 'GD chỉnh sửa giảng viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(185, 'teacher/edit_submit/{user_id}', 'Cập nhật giảng viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(186, 'teacher/show/{user_id}', 'Hiển thị một giảng viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(187, 'teacher/delete/{user_id}', 'Xóa một giảng viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(188, 'alumnies', 'GD quản lý cựu sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(189, 'alumnies/create', 'GD Thêm cựu sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(190, 'alumnies/create_submit', 'Lưu cựu sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(191, 'alumnies/edit/{user_id}', 'GD Sửa cựu sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(192, 'alumnies/edit_submit/{user_id}', 'Cập nhật cựu sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(193, 'alumnies/show/{user_id}', 'GD Hiển thị thông tin chi tiết cựu sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(194, 'alumnies/show/show_submit/{user_id}', 'Hiển thị thông tin cựu sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(195, 'alumnies/delete/{user_id}', 'Xóa 1 cựu sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(196, 'alumnies/import_graduate', 'Import danh sách bảng diểm tốt nghiệp', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(197, 'alumnies//show_details_work/{alumni_id}', 'GD Hiển thị chi tiết công việc của cựu sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(198, 'posts', 'GD quản lý bản tin', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(199, 'posts/add_posts', 'GD Thêm 1 bài đăng', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(200, 'posts/store', 'Store 1 bài đăng', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(201, 'posts/list_post', 'GD duyệt bài trên Admin', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(202, 'posts/news/{category_slug}/{slug}', 'Hiển thị chi tiết bài viết theo slug', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(203, 'posts/list_post_ajax', 'Duyệt bài trên Admin', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(204, 'posts/show_post_detail_of_admin/{post_id}', 'Hiển thị bài viết trên GD duyệt bài của Admin', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(205, 'posts/block_user_ajax', 'Thực hiện khóa đăng bài của người dùng', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(206, 'posts/lists_account_blocked', 'GD danh sách tài khoản bị khóa', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(207, 'posts/unblock_account_ajax', 'Mở khóa tài khoản của đăng bài', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(208, 'posts/list_post_students', 'GD bản tin trên phân quyền sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(209, 'posts/{category_slug}/{slug}', 'GD Hiển thị chi tiết bản tin theo thể loại', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(210, 'posts/post_your_class', 'GD bản tin trên lớp của mình học', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(211, 'posts/list_post_teachers', 'GD bản tin trên phân quyền giảng viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(212, 'posts/comment_ajax', 'Chức năng comment trên bản tin', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(213, 'posts/categories_find_job', 'GD bản tin thể loại Tìm việc làm', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(214, 'posts/categories_apply_job', 'GD bản tin thể loại Tuyển dụng', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(215, 'posts/categories_class_meeting', 'GD bản tin Họp lớp', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(216, 'posts/categories_support_scholarship', 'GD bản tin Hỗ trợ học bổng', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(217, 'posts/categories_donations', 'GD bản tin Quyên góp', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(218, 'posts/categories_notifications', 'GD bản tin Thông báo', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(219, 'major', 'GD quản lý nghành', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(220, 'major/create', 'GD thêm 1 nghành', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(221, 'major/create', 'Store 1 nghành', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(222, 'major/edit/{major_id}', 'GD chỉnh sửa 1 nghành', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(223, 'major/edit/submit/{major_id}', 'Update 1 nghành', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(224, 'major/destroy/{major_id}', 'Xóa 1 nghành', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(225, 'major_branch', 'GD quản lý chuyên nghành', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(226, 'major_branch/create', 'GD thêm 1 chuyên nghành', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(227, 'major_branch/create', 'Store 1 chuyên nghành', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(228, 'major_branch/edit/{major_branch_id}', 'GD chỉnh sửa chuyên nghành', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(229, 'major_branch/edit/submit/{major_branch_id}', 'Update chỉnh sửa chuyên nghành', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(230, 'major_branch/destroy/{major_branch_id}', 'Xóa 1 chuyên nghành', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(231, 'class', 'GD quản lý lớp học', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(232, 'class/create', 'GD thêm 1 lớp học', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(233, 'class/create', 'Store 1 lớp học', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(234, 'class/create_quick', 'GD tạo nhanh một lớp', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(235, 'class/create_quick', 'Lưu trữ một lớp', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(236, 'class/edit/{class_id}', 'GD chỉnh sửa 1 lớp học', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(237, 'class/edit/submit/{class_id}', 'Cập nhật 1 lớp học', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(238, 'class/show/{class_id}', 'GD show 1 lớp học', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(239, 'class/destroy/{class_id}', 'Xóa 1 lớp học', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(240, 'class/major_branch/{major_id}', 'DOM chuyên nghành', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(241, 'class/major_branch/edit/{major_id}', 'DOM chỉnh sửa chuyên nghành', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(242, 'survey', 'GD quản lý khảo sát', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(243, 'survey/view/{survey}', '', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(244, 'survey/view/{survey}/completed', 'thực hiện trả lời của sinh viên', '2019-10-11 13:40:52', '2019-10-12 14:24:53', NULL),
(245, 'survey/create', 'GD thêm khảo sát', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(246, 'survey/create_submit', 'Lưu câu hỏi khảo sát', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(247, 'survey/{survey}', 'GD thêm câu hỏi', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(248, 'survey/destroy/{survey_id}', 'Xóa khảo sát', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(249, 'survey/{survey}/edit', 'GD chỉnh sửa khảo sát', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(250, 'survey/{survey}/update', 'Cập nhật khảo sát', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(251, 'survey/{survey}/add_new', 'Tạo mới khảo sát', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(252, 'survey/view/{survey}', 'Xem khảo sát', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(253, 'survey/answers/{survey}', 'Xem đáp án khảo sát', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(254, 'survey/view/{survey}/export', 'Export khảo sát', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(255, 'survey/view/{survey}/completed', 'Hoàn thành trả lời khảo sát', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(256, 'survey/{survey}/questions', 'Thêm câu hỏi khảo sát', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(257, 'survey/export', 'Export câu hỏi khảo sát', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(258, 'chart', 'GD biểu đồ', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(259, 'question', 'GD câu hỏi', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(260, 'question/{question}/edit', 'GD chỉnh sửa câu hỏi', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(261, 'question/{question}/update', 'Lưu trữ cập nhật câu hỏi', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(262, 'question/{question_id}/{value}/delete/', 'Xóa câu hỏi', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(263, 'statistic', 'GD quản lý thống kê', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(264, 'statistic/showsurvey/{survey_id}', 'GD hiển thị thống kê theo khảo sát', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(265, 'statistic/show', 'Hiển thị thống kê', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(266, 'statistic/export', 'Xuất thống kê', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(267, 'statistic/student', 'Hiển thị GD thống kê tỉ lệ tốt nghiệp sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(268, 'statistic/student', 'Lưu trữ thống kê tỉ lệ tốt nghiệp sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(269, 'statistic/major_branch/{major_id}', 'Ajax lấy chuyên nghành theo nghành', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(270, 'statistic/class/{major_id}/{major_branch_id}/{course}', 'Ajax lấy tên lớp theo tên chuyên nghành và nghành', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(271, 'statistic/job', 'GD thống kê tỷ lệ việc làm', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(272, 'statistic/job', 'Lưu trữ thống kê tỷ lệ việc làm', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(273, 'statistic/salary', 'GD thống kê lương tỷ lệ việc làm', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(274, 'statistic/show_surveys', 'GD thống kê form khảo sát', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(275, 'statistic/show_statistic_surveys/{survey_id}', 'GD thống kê theo form khảo sát theo id', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(276, 'statistic/export_statistic_surveys', 'Xuất ra file thống kê theo khảo sát', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(277, 'city', 'GD quản lý thành phố', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(278, 'city/create', 'GD thêm thành phố', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(279, 'city/create', 'Lưu khi thêm thành phố', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(280, 'city/edit/{city_id}', 'GD chỉnh sửa thành phố', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(281, 'city/edit/submit/{city_id}', 'Cập nhật thành phố', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(282, 'city/destroy/{city_id}', 'Xóa thành phố', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(283, 'district', 'GD quản lý quận/huyện', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(284, 'district/create', 'GD thêm quận/huyện', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(285, 'district/create', 'Lưu quận/huyện', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(286, 'district/edit/{district_id}', 'GD chỉnh sửa quận huyện', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(287, 'district/edit/submit/{district_id}', 'Cập nhật quận huyện', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(288, 'district/destroy/{district_id}', 'Xóa quận huyện', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(289, 'ward', 'GD quản lý phường/xã', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(290, 'ward/create', 'GD thêm phường xã', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(291, 'ward/create', 'Lưu phường xã', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(292, 'ward/edit/{ward_id}', 'GD chỉnh sửa phường xã', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(293, 'ward/edit/submit/{ward_id}', 'Cập nhật phường xã', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(294, 'ward/destroy/{ward_id}', 'Xóa phường xã', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(295, 'ward/district/{city_id}', 'Lấy quận huyện theo thành phố ', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(296, 'company', 'GD quản lý công ty', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(297, 'company/create', 'GD thêm công ty', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(298, 'company/create', 'Lưu công ty', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(299, 'company/edit/{company_id}', 'GD chỉnh sửa công ty', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(300, 'company/edit/submit/{company_id}', 'Cập nhật công ty', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(301, 'company/destroy/{company_id}', 'Xóa công ty', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(302, 'company/district/{city_id}', 'GD công ty lấy quận huyện theo thành phố', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(303, 'company/ward/{district_id}', 'GD lấy phường xã theo quận huyện', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(304, 'work', 'GD quản lý công việc', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(305, 'work/create', 'GD thêm công việc', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(306, 'work/create', 'Lưu công việc', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(307, 'work/edit/{work_id}', 'GD chỉnh sửa công việc', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(308, 'work/edit/submit/{work_id}', 'Cập nhật công việc', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(309, 'work/destroy/{work_id}', 'Xóa công việc', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(310, 'work_user', 'GD quản lý công việc của ng dùng', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(311, 'work_user/work_history/{user_id}', 'GD hiển thị lịch sử công việc', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(312, 'work_user/create', 'GD thêm công việc của người dùng', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(313, 'work_user/create', 'Lưu công việc của người dùng', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(314, 'work_user/edit/{work_user_id}', 'GD chỉnh sửa công việc của người dùng', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(315, 'work_user/edit/submit/{work_user_id}', 'Cập nhật công việc của người dùng', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(316, 'work_user/destroy/{work_user_id}', 'Xóa công việc của người dùng', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(317, 'mails', 'GD gửi mail', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(318, 'mails/store', 'GD lưu và gửi mail', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(319, 'mails/store', 'Lưu và gửi mail', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(320, 'mails/import_list_mails', 'Import danh sách người dùng vào để gửi nhìu người', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(321, 'permissions', 'GD quản lý phân quyền', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(322, 'permissions/create/{id}', 'GD thêm route cho phân quyền', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(323, 'permissions/store', 'Lưu route cho phân quyền', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(324, 'permissions/show/{role_id}', 'Hiển thị route của phân quyền đó', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(325, 'permissions/delete_route/{permission_id}', 'Xóa route của phân quyền đó', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(326, 'permissions/advance', 'GD phân vai trò nâng cao', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(327, 'permissions/give_admin_permission/{userID}', 'Gán quyền là Admin', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(328, 'permissions/remove_admin_permission/{userID}', 'Xóa quyền là Admin', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(329, 'permissions/give_teacher_permission/{userID}', 'Gán quyền là giảng viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(330, 'permissions/remove_teacher_permission/{userID}', 'Xóa quyền là giảng viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(331, 'permissions/give_alumni_permission/{userID}', 'Gán quyền là cựu sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(332, 'permissions/remove_alumni_permission/{userID}', 'Xóa quyền là cựu sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(333, 'permissions/give_student_permission/{userID}', 'Gáng quyền là sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(334, 'permissions/remove_student_permission/{userID}', 'Xóa quyền là sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(335, 'permissions/give_manager_permission/{userID}', 'Gáng quyền là giáo vụ khoa', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(336, 'permissions/remove_manager_permission/{userID}', 'Xóa quyền là giáo vụ khoa', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(337, 'imports/index', 'GD import tất cả ', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(338, 'imports/import_students', 'import danh sách sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(339, 'imports/import_alumnies', 'import danh sách cựu sinh viên', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(340, 'imports/import_graduate', 'import bảng điểm', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(341, 'lop_co_van', 'GD lop co van', '2019-10-11 13:40:52', '2019-10-11 13:40:52', NULL),
(342, 'accounts/update_job/{workID}', 'Cập nhật công việc của người dùng', '2019-10-12 14:23:52', '2019-10-12 14:23:52', NULL),
(343, 'posts/post_only_class/{post_only_class?}', 'Lấy paramater trên url của bài đăng trên lơp', '2019-10-12 14:24:08', '2019-10-12 14:24:08', NULL),
(344, 'survey/view/{survey}/update', 'trả lời lại câu trả lời của mình cho sinh viên', '2019-10-12 14:25:19', '2019-10-12 14:25:19', NULL),
(345, 'survey/{question}/remove', 'Xóa khảo sát theo câu hỏi', '2019-10-12 14:25:33', '2019-10-12 14:25:33', NULL),
(346, 'statistic/job_export', 'Xuất file thống kê', '2019-10-12 14:25:53', '2019-10-12 14:25:53', NULL),
(347, 'mails/{send_class?}', 'Lấy parameter trên url khi gửi mail trên lớp cố vấn', '2019-10-12 14:26:10', '2019-10-12 14:26:10', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`route_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id action', AUTO_INCREMENT=348;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
