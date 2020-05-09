-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2019 at 04:21 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni_mng`
--

-- --------------------------------------------------------

--
-- Table structure for table `academies`
--

CREATE TABLE `academies` (
  `academy_id` int(10) UNSIGNED NOT NULL COMMENT 'Id',
  `academy_code` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mã khoa',
  `academy_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên khoa',
  `academy_description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'mô tả khoa',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Thông tin một khoa, viện, phòng ban';

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `answer_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `examine_question_id` int(10) UNSIGNED NOT NULL COMMENT 'id của bảng liên kết câu hỏi với bảng khảo sát',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'id người trả lời',
  `answer_content` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nội dung câu trả lời',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Thông tin câu trả lời của sinh viên cho một câu hỏi trong một cuộc khảo sát';

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên chuyên đề',
  `category_slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên ngắn tắt cho route',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Chuyên đề các bài đăng';

-- --------------------------------------------------------

--
-- Table structure for table `categorys_posts`
--

CREATE TABLE `categorys_posts` (
  `category_post_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `category_id` int(10) UNSIGNED NOT NULL COMMENT 'id chuyên mục',
  `post_id` int(10) UNSIGNED NOT NULL COMMENT 'id bài post',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Liên kết chuyên mục với bài viết\r\nQuan hệ nhiều nhiều (một bài viết có thể có nhiều chuyên mục khác nhau, ngược lại 1 chuyên mục có thể có nhiều bài viết)';

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `city_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên thành phố',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tỉnh thành';

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `major_id` int(10) UNSIGNED NOT NULL COMMENT 'id chuyên ngành',
  `class_code` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mã lớp',
  `class_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên lớp',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Thông tin lớp';

-- --------------------------------------------------------

--
-- Table structure for table `class_users`
--

CREATE TABLE `class_users` (
  `class_user_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'id người dùng',
  `class_id` int(10) UNSIGNED NOT NULL COMMENT 'id lớp',
  `class_user_begin` date DEFAULT NULL COMMENT 'ngày bắt',
  `class_user_end` date DEFAULT NULL COMMENT 'ngày kết thúc',
  `class_user_accountability` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'vai trò (gv, sv)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Liên kết lớp và một tài khoản, lớp với giảng viên, lớp với sinh viên';

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `post_id` int(10) UNSIGNED NOT NULL COMMENT 'id bài viết',
  `comment_content` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'nội dung bình luận',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'id user đã bình luận',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Bình luận cho 1 bài post';

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `district_id` int(10) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `district_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Quận huyện';

-- --------------------------------------------------------

--
-- Table structure for table `examines`
--

CREATE TABLE `examines` (
  `examine_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'người lập',
  `examine_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên mẫu khảo sát',
  `examine_begin` date NOT NULL COMMENT 'ngày bắt đầu',
  `examine_end` date NOT NULL COMMENT 'ngày kết thúc',
  `examine_version` int(2) UNSIGNED NOT NULL COMMENT 'phiên bảng khảo sát',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Mẫu khảo sát';

-- --------------------------------------------------------

--
-- Table structure for table `examine_questions`
--

CREATE TABLE `examine_questions` (
  `examine_question_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `examine_id` int(10) UNSIGNED NOT NULL COMMENT 'id khảo sát',
  `question_id` int(10) UNSIGNED NOT NULL COMMENT 'id câu hỏi',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Bảng liên kết câu hỏi với bảng khảo sát';

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `group_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên group',
  `group_icon` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'icon của group',
  `group_slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên ngắn tắt cho route',
  `group_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'loại group (music, video, image, chat)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Nhóm một danh sách các tài khoản với nhau';

-- --------------------------------------------------------

--
-- Table structure for table `group_users`
--

CREATE TABLE `group_users` (
  `group_user_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `user_id` int(10) DEFAULT NULL COMMENT 'id tài khoản',
  `group_id` int(10) DEFAULT NULL COMMENT 'id group',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Lưu trữ các user trong một group';

-- --------------------------------------------------------

--
-- Table structure for table `mail_logs`
--

CREATE TABLE `mail_logs` (
  `mail_log_id` int(11) UNSIGNED NOT NULL COMMENT 'id',
  `mail_template_id` int(11) NOT NULL COMMENT 'id mẫu email',
  `register_graduate_id` int(11) DEFAULT NULL COMMENT 'id mẫu đăng ký tốt nghiệp',
  `mail_log_send_datetime` datetime NOT NULL COMMENT 'thời gian gửi',
  `mail_log_to` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'địa chỉ nhận',
  `mail_log_subject` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'tiêu đề',
  `mail_log_body` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'nội dung',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Lưu trữ các mail sẽ gửi';

-- --------------------------------------------------------

--
-- Table structure for table `mail_templates`
--

CREATE TABLE `mail_templates` (
  `mail_template_id` int(11) UNSIGNED NOT NULL COMMENT 'id',
  `user_id` int(11) NOT NULL COMMENT 'id người tạo',
  `register_graduate_id` int(11) NOT NULL COMMENT 'id đăng ký tốt nghiệp',
  `subject` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'tiêu đề',
  `body` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'nội dung',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Mẫu email tạo sẵn';

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `major_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `academy_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'id khoa, viện',
  `major_code` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mã ngành',
  `major_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên ngành',
  `major_description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'mô tả ngành',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Ngành học';

-- --------------------------------------------------------

--
-- Table structure for table `major_branchs`
--

CREATE TABLE `major_branchs` (
  `major_branch_id` int(10) UNSIGNED NOT NULL COMMENT 'id chuyên ngành',
  `major_id` int(10) UNSIGNED NOT NULL COMMENT 'id ngành',
  `major_branch_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên chuyên ngành',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Liên kết ngành học với chuyên ngành\r\nQuan hệ 1 nhiều';

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `route_id` int(10) UNSIGNED NOT NULL COMMENT 'id route action được phép thực hiện',
  `role_id` int(10) UNSIGNED NOT NULL COMMENT 'phân quyền được phép thực hiện',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Các quyền được phân công';

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'tác giả bài viết',
  `group_id` int(11) NOT NULL COMMENT 'id group',
  `post_title` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'tiêu đề bài viết',
  `post_content` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'nội dung bài viết',
  `post_slug` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên ngắn tắt cho route',
  `post_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'trạng thái bài viết, duyệt , chưa duyệt ,...',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Thông tin bài đăng';

-- --------------------------------------------------------

--
-- Table structure for table `posts_class`
--

CREATE TABLE `posts_class` (
  `post_class_id` int(10) UNSIGNED NOT NULL COMMENT 'id của bài đăng trên lớp',
  `user_id` int(10) DEFAULT NULL COMMENT 'id giảng viên nào đăng',
  `class_id` int(10) DEFAULT NULL COMMENT 'id lớp nhận bài đăng',
  `year_user_id` int(10) DEFAULT NULL COMMENT 'id khóa của lớp đó ',
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'tiêu đề bài đăng',
  `content` text COLLATE utf8_unicode_ci COMMENT 'nội dung bài đăng',
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'nội dung ngắn tắt của routes',
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'trạng thái của bài đăng',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Bài post của giảng viên đăng trên 1 lớp của giảng viên đó ';

-- --------------------------------------------------------

--
-- Table structure for table `post_views`
--

CREATE TABLE `post_views` (
  `post_view_id` int(10) NOT NULL COMMENT 'id',
  `post_id` int(10) NOT NULL COMMENT 'id bai viet',
  `user_id` int(10) DEFAULT NULL COMMENT 'id user',
  `post_is_like` tinyint(1) DEFAULT '0' COMMENT 'trạng thái like (0: chưa like, 1: đã like)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Lưu thông tin về việc người khác đã xem bài post\r\nNếu 1 user xem bài post thì sẽ tự sinh thêm một dòng';

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `profile_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `profile_structure_id` int(10) UNSIGNED NOT NULL COMMENT 'id cấu trúc',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'id tài khoản',
  `profile_values` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'giá trị',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Thông tin chi tiết tài khoản';

-- --------------------------------------------------------

--
-- Table structure for table `profile_structures`
--

CREATE TABLE `profile_structures` (
  `profile_structure_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `role_id` int(10) UNSIGNED NOT NULL COMMENT 'phân quyền có trường thông tin này',
  `profile_structure_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên của trường thông tin',
  `profile_structure_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'kiểu của thông tin (int, string, date)',
  `profile_structure_default` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'giá trị mặc định của trường thông tin',
  `profile_version` tinyint(2) UNSIGNED NOT NULL COMMENT 'phiên bản sử dụng',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Cấu trúc lưu trữ thông tin cho mỗi phân quyền';

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `question_content` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'nội dung câu hỏi',
  `question_type` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'loại câu hỏi (select, checbox, number, ...)',
  `question_answer` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'câu trả lời mặc định (nếu là select hoặc checkbox thì sẽ có dạng json)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Câu hỏi cho mẫu khảo sát';

-- --------------------------------------------------------

--
-- Table structure for table `register_graduate`
--

CREATE TABLE `register_graduate` (
  `register_graduate_id` int(11) NOT NULL COMMENT 'id TN',
  `register_graduate_semester` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'học kỳ tốt nghiệp',
  `register_graduate_session` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'năm tốt nghiệp',
  `register_graduate_date` date DEFAULT NULL COMMENT 'ngày đăng ký tốt nghiệp',
  `register_graduate_GPA` double DEFAULT NULL COMMENT 'điểm trung bình',
  `register_graduate_DRL` double DEFAULT NULL COMMENT 'điểm rèn luyện',
  `register_graduate_TCTL` int(11) DEFAULT NULL COMMENT 'tổng tín chỉ tích lũy',
  `register_graduate_ranked` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'xếp loại',
  `register_graduate_degree` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'danh hiệu ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Mẫu đăng ký tốt nghiệp ';

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `role_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên phân quyền',
  `role_note` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'chú thích về phân quyền',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Thông tin phân quyền';

-- --------------------------------------------------------

--
-- Table structure for table `roles_examines`
--

CREATE TABLE `roles_examines` (
  `role_examine_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `role_id` int(10) UNSIGNED NOT NULL COMMENT 'id phân quyền',
  `academy_id` int(10) UNSIGNED NOT NULL COMMENT 'id khoa',
  `class_id` int(10) UNSIGNED NOT NULL COMMENT 'id lớp (nếu muốn chỉ cho phép khảo sát theo lớp)',
  `examine_id` int(10) UNSIGNED NOT NULL COMMENT 'id khảo sát',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Liên kết giữa phân quyền và bảng khảo sát để biết phân quyền nào được thực hiện bảng khảo sát nào\r\nQuan hệ nhiều nhiều';

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `role_user_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'id tài khoản',
  `role_id` int(10) UNSIGNED NOT NULL COMMENT 'id phân quyền',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Liên kết giữa phân quyền và tài khoản\r\nQuan hệ 1 nhiều';

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `route_id` int(10) UNSIGNED NOT NULL COMMENT 'id route',
  `route_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'đường dẫn action',
  `route_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên action',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tên các action trong danh sách xử lý';

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `code` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mã sv hoặc gv',
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên đệm và tên',
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'họ',
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên đăng nhập',
  `password` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'mật khẩu đăng nhập',
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'sđt',
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'email',
  `token` text COLLATE utf8_unicode_ci COMMENT 'token bảo mật',
  `device_token` text COLLATE utf8_unicode_ci COMMENT 'token thiết bị',
  `active_code` text COLLATE utf8_unicode_ci COMMENT 'key kích hoạt tài khoản',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Lưu trữ thông tin người dùng';

-- --------------------------------------------------------

--
-- Table structure for table `wards`
--

CREATE TABLE `wards` (
  `ward_id` int(10) UNSIGNED NOT NULL COMMENT 'id phường xã',
  `district_id` int(10) NOT NULL COMMENT 'id quận huyện',
  `ward_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên phường xã',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Phường xã';

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `year_id` int(10) NOT NULL COMMENT 'id',
  `year_number` int(10) NOT NULL COMMENT 'Số khóa (K40, K41, ...)',
  `year_begin` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'thời gian bắt đầu',
  `year_end` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'thời gian kết thúc',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Niên khóa \r\nVí dụ: thời gian học thực tế 3 năm hoặc 4 năm\r\nSinh viên có thể ra trường sớm or trễ';

-- --------------------------------------------------------

--
-- Table structure for table `year_users`
--

CREATE TABLE `year_users` (
  `year_user_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `year_id` int(10) UNSIGNED NOT NULL COMMENT 'id năm học',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'id user',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Liên kết năm học với tài khoản\r\nQuan hệ 1 nhiều\r\nví dụ năm học mặc định của 1 nghành HTTT K42 (2016-2020)';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academies`
--
ALTER TABLE `academies`
  ADD PRIMARY KEY (`academy_id`),
  ADD UNIQUE KEY `academy_code` (`academy_code`),
  ADD UNIQUE KEY `academy_name` (`academy_name`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`),
  ADD UNIQUE KEY `category_slug` (`category_slug`);

--
-- Indexes for table `categorys_posts`
--
ALTER TABLE `categorys_posts`
  ADD PRIMARY KEY (`category_post_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`),
  ADD UNIQUE KEY `city_name` (`city_name`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD UNIQUE KEY `class_code` (`class_code`),
  ADD UNIQUE KEY `class_name` (`class_name`);

--
-- Indexes for table `class_users`
--
ALTER TABLE `class_users`
  ADD PRIMARY KEY (`class_user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `examines`
--
ALTER TABLE `examines`
  ADD PRIMARY KEY (`examine_id`);

--
-- Indexes for table `examine_questions`
--
ALTER TABLE `examine_questions`
  ADD PRIMARY KEY (`examine_question_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `group_users`
--
ALTER TABLE `group_users`
  ADD PRIMARY KEY (`group_user_id`);

--
-- Indexes for table `mail_logs`
--
ALTER TABLE `mail_logs`
  ADD PRIMARY KEY (`mail_log_id`);

--
-- Indexes for table `mail_templates`
--
ALTER TABLE `mail_templates`
  ADD PRIMARY KEY (`mail_template_id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`major_id`),
  ADD UNIQUE KEY `major_code` (`major_code`),
  ADD UNIQUE KEY `major_name` (`major_name`);

--
-- Indexes for table `major_branchs`
--
ALTER TABLE `major_branchs`
  ADD PRIMARY KEY (`major_branch_id`),
  ADD UNIQUE KEY `major_id` (`major_id`),
  ADD UNIQUE KEY `major_branch_name` (`major_branch_name`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `posts_class`
--
ALTER TABLE `posts_class`
  ADD PRIMARY KEY (`post_class_id`);

--
-- Indexes for table `post_views`
--
ALTER TABLE `post_views`
  ADD PRIMARY KEY (`post_view_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `profile_structures`
--
ALTER TABLE `profile_structures`
  ADD PRIMARY KEY (`profile_structure_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `register_graduate`
--
ALTER TABLE `register_graduate`
  ADD PRIMARY KEY (`register_graduate_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `roles_examines`
--
ALTER TABLE `roles_examines`
  ADD PRIMARY KEY (`role_examine_id`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`role_user_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`route_id`),
  ADD UNIQUE KEY `route_link` (`route_link`),
  ADD UNIQUE KEY `route_name` (`route_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `wards`
--
ALTER TABLE `wards`
  ADD PRIMARY KEY (`ward_id`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`year_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academies`
--
ALTER TABLE `academies`
  MODIFY `academy_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id';

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `categorys_posts`
--
ALTER TABLE `categorys_posts`
  MODIFY `category_post_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `class_users`
--
ALTER TABLE `class_users`
  MODIFY `class_user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `district_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `examines`
--
ALTER TABLE `examines`
  MODIFY `examine_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `examine_questions`
--
ALTER TABLE `examine_questions`
  MODIFY `examine_question_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `group_users`
--
ALTER TABLE `group_users`
  MODIFY `group_user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `major_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `profile_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `profile_structures`
--
ALTER TABLE `profile_structures`
  MODIFY `profile_structure_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `roles_examines`
--
ALTER TABLE `roles_examines`
  MODIFY `role_examine_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `role_users`
--
ALTER TABLE `role_users`
  MODIFY `role_user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id route';

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `year_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
