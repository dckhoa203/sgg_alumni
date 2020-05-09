-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.25 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for alumni_mng
CREATE DATABASE IF NOT EXISTS `alumni_mng` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `alumni_mng`;

-- Dumping structure for table alumni_mng.academies
CREATE TABLE IF NOT EXISTS `academies` (
  `academy_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `academy_code` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mã khoa',
  `academy_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên khoa',
  `academy_description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'mô tả khoa',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`academy_id`),
  UNIQUE KEY `academy_code_academy_name` (`academy_code`,`academy_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Thông tin một khoa, viện, phòng ban';

-- Dumping data for table alumni_mng.academies: ~0 rows (approximately)
DELETE FROM `academies`;
/*!40000 ALTER TABLE `academies` DISABLE KEYS */;
/*!40000 ALTER TABLE `academies` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.answers
CREATE TABLE IF NOT EXISTS `answers` (
  `answer_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `examine_question_id` int(10) unsigned NOT NULL COMMENT 'id của bảng liên kết câu hỏi với bảng khảo sát',
  `user_id` int(10) unsigned NOT NULL COMMENT 'id người trả lời',
  `answer_content` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nội dung câu trả lời',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Thông tin câu trả lời của sinh viên cho một câu hỏi trong một cuộc khảo sát';

-- Dumping data for table alumni_mng.answers: ~0 rows (approximately)
DELETE FROM `answers`;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên chuyên đề',
  `category_slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên ngắn tắt cho route',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name_category_slug` (`category_name`,`category_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Chuyên đề các bài đăng';

-- Dumping data for table alumni_mng.categories: ~0 rows (approximately)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.categorys_posts
CREATE TABLE IF NOT EXISTS `categorys_posts` (
  `category_post_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `category_id` int(10) unsigned NOT NULL COMMENT 'id chuyên mục',
  `post_id` int(10) unsigned NOT NULL COMMENT 'id bài post',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`category_post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Liên kết chuyên mục với bài viết\r\nQuan hệ nhiều nhiều (một bài viết có thể có nhiều chuyên mục khác nhau, ngược lại 1 chuyên mục có thể có nhiều bài viết)';

-- Dumping data for table alumni_mng.categorys_posts: ~0 rows (approximately)
DELETE FROM `categorys_posts`;
/*!40000 ALTER TABLE `categorys_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `categorys_posts` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.cities
CREATE TABLE IF NOT EXISTS `cities` (
  `city_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `city_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên thành phố',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`city_id`),
  UNIQUE KEY `city_name` (`city_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tỉnh thành';

-- Dumping data for table alumni_mng.cities: ~0 rows (approximately)
DELETE FROM `cities`;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.classes
CREATE TABLE IF NOT EXISTS `classes` (
  `class_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `major_id` int(10) unsigned NOT NULL COMMENT 'id chuyên ngành',
  `class_code` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mã lớp',
  `class_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên lớp',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`class_id`),
  UNIQUE KEY `class_code_class_name` (`class_code`,`class_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Thông tin lớp';

-- Dumping data for table alumni_mng.classes: ~0 rows (approximately)
DELETE FROM `classes`;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.class_users
CREATE TABLE IF NOT EXISTS `class_users` (
  `class_user_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_id` int(10) unsigned NOT NULL COMMENT 'id người dùng',
  `class_id` int(10) unsigned NOT NULL COMMENT 'id lớp',
  `class_user_begin` date DEFAULT NULL COMMENT 'ngày bắt',
  `class_user_end` date DEFAULT NULL COMMENT 'ngày kết thúc',
  `class_user_accountability` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'vai trò (gv, sv)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`class_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Liên kết lớp và một tài khoản, lớp với giảng viên, lớp với sinh viên';

-- Dumping data for table alumni_mng.class_users: ~0 rows (approximately)
DELETE FROM `class_users`;
/*!40000 ALTER TABLE `class_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `class_users` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `post_id` int(10) unsigned NOT NULL COMMENT 'id bài viết',
  `comment_content` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'nội dung bình luận',
  `user_id` int(10) unsigned NOT NULL COMMENT 'id user đã bình luận',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Bình luận cho 1 bài post';

-- Dumping data for table alumni_mng.comments: ~0 rows (approximately)
DELETE FROM `comments`;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.districts
CREATE TABLE IF NOT EXISTS `districts` (
  `district_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int(10) unsigned NOT NULL DEFAULT '0',
  `district_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`district_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Quận huyện';

-- Dumping data for table alumni_mng.districts: ~0 rows (approximately)
DELETE FROM `districts`;
/*!40000 ALTER TABLE `districts` DISABLE KEYS */;
/*!40000 ALTER TABLE `districts` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.examines
CREATE TABLE IF NOT EXISTS `examines` (
  `examine_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_id` int(10) unsigned NOT NULL COMMENT 'người lập',
  `examine_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên mẫu khảo sát',
  `examine_begin` date NOT NULL COMMENT 'ngày bắt đầu',
  `examine_end` date NOT NULL COMMENT 'ngày kết thúc',
  `examine_version` int(2) unsigned NOT NULL COMMENT 'phiên bảng khảo sát',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`examine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Mẫu khảo sát';

-- Dumping data for table alumni_mng.examines: ~0 rows (approximately)
DELETE FROM `examines`;
/*!40000 ALTER TABLE `examines` DISABLE KEYS */;
/*!40000 ALTER TABLE `examines` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.examine_questions
CREATE TABLE IF NOT EXISTS `examine_questions` (
  `examine_question_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `examine_id` int(10) unsigned NOT NULL COMMENT 'id khảo sát',
  `question_id` int(10) unsigned NOT NULL COMMENT 'id câu hỏi',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`examine_question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Bảng liên kết câu hỏi với bảng khảo sát';

-- Dumping data for table alumni_mng.examine_questions: ~0 rows (approximately)
DELETE FROM `examine_questions`;
/*!40000 ALTER TABLE `examine_questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `examine_questions` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.mail_logs
CREATE TABLE IF NOT EXISTS `mail_logs` (
  `mail_log_id` int(11) unsigned NOT NULL COMMENT 'id',
  `mail_template_id` int(11) NOT NULL COMMENT 'id mẫu email',
  `mail_log_send_datetime` datetime NOT NULL COMMENT 'thời gian gửi',
  `mail_log_to` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'địa chỉ nhận',
  `mail_log_subject` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'tiêu đề',
  `mail_log_body` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'nội dung',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`mail_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Lưu trữ các mail sẽ gửi';

-- Dumping data for table alumni_mng.mail_logs: ~0 rows (approximately)
DELETE FROM `mail_logs`;
/*!40000 ALTER TABLE `mail_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `mail_logs` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.mail_templates
CREATE TABLE IF NOT EXISTS `mail_templates` (
  `mail_template_id` int(11) unsigned NOT NULL COMMENT 'id',
  `user_id` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'id người tạo',
  `subject` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'tiêu đề',
  `body` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'nội dung',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`mail_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Mẫu email tạo sẵn';

-- Dumping data for table alumni_mng.mail_templates: ~0 rows (approximately)
DELETE FROM `mail_templates`;
/*!40000 ALTER TABLE `mail_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `mail_templates` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.majors
CREATE TABLE IF NOT EXISTS `majors` (
  `major_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `academy_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'id khoa, viện',
  `major_code` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mã ngành',
  `major_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên ngành',
  `major_description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'mô tả ngành',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`major_id`),
  UNIQUE KEY `major_code_major_name` (`major_code`,`major_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Ngành học';

-- Dumping data for table alumni_mng.majors: ~0 rows (approximately)
DELETE FROM `majors`;
/*!40000 ALTER TABLE `majors` DISABLE KEYS */;
/*!40000 ALTER TABLE `majors` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.major_branchs
CREATE TABLE IF NOT EXISTS `major_branchs` (
  `major_branch_id` int(10) unsigned NOT NULL COMMENT 'id chuyên ngành',
  `major_id` int(10) unsigned NOT NULL COMMENT 'id ngành',
  `major_branch_name` int(10) NOT NULL COMMENT 'tên chuyên ngành',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`major_branch_id`),
  UNIQUE KEY `major_id_major_branch_name` (`major_id`,`major_branch_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Liên kết ngành học với chuyên ngành\r\nQuan hệ 1 nhiều';

-- Dumping data for table alumni_mng.major_branchs: ~0 rows (approximately)
DELETE FROM `major_branchs`;
/*!40000 ALTER TABLE `major_branchs` DISABLE KEYS */;
/*!40000 ALTER TABLE `major_branchs` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `permission_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `route_id` int(10) unsigned NOT NULL COMMENT 'id route action được phép thực hiện',
  `role_id` int(10) unsigned NOT NULL COMMENT 'phân quyền được phép thực hiện',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Các quyền được phân công';

-- Dumping data for table alumni_mng.permissions: ~0 rows (approximately)
DELETE FROM `permissions`;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_id` int(10) unsigned NOT NULL COMMENT 'tác giả bài viết',
  `post_title` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'tiêu đề bài viết',
  `post_content` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'nội dung bài viết',
  `post_slug` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên ngắn tắt cho route',
  `post_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'trạng thái bài viết, duyệt , chưa duyệt ,...',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Thông tin bài đăng';

-- Dumping data for table alumni_mng.posts: ~0 rows (approximately)
DELETE FROM `posts`;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.post_views
CREATE TABLE IF NOT EXISTS `post_views` (
  `post_view_id` int(10) NOT NULL COMMENT 'id',
  `post_id` int(10) NOT NULL COMMENT 'id bai viet',
  `user_id` int(10) DEFAULT NULL COMMENT 'id user',
  `post_is_like` tinyint(1) DEFAULT '0' COMMENT 'trạng thái like (0: chưa like, 1: đã like)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`post_view_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Lưu thông tin về việc người khác đã xem bài post\r\nNếu 1 user xem bài post thì sẽ tự sinh thêm một dòng';

-- Dumping data for table alumni_mng.post_views: ~0 rows (approximately)
DELETE FROM `post_views`;
/*!40000 ALTER TABLE `post_views` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_views` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.profiles
CREATE TABLE IF NOT EXISTS `profiles` (
  `profile_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `profile_structure_id` int(10) unsigned NOT NULL COMMENT 'id cấu trúc',
  `user_id` int(10) unsigned NOT NULL COMMENT 'id tài khoản',
  `profile_values` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'giá trị',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Thông tin chi tiết tài khoản';

-- Dumping data for table alumni_mng.profiles: ~0 rows (approximately)
DELETE FROM `profiles`;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.profile_structures
CREATE TABLE IF NOT EXISTS `profile_structures` (
  `profile_structure_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `role_id` int(10) unsigned NOT NULL COMMENT 'phân quyền có trường thông tin này',
  `profile_structure_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên của trường thông tin',
  `profile_structure_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'kiểu của thông tin (int, string, date)',
  `profile_structure_default` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'giá trị mặc định của trường thông tin',
  `profile_version` tinyint(2) unsigned NOT NULL COMMENT 'phiên bản sử dụng',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`profile_structure_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Cấu trúc lưu trữ thông tin cho mỗi phân quyền';

-- Dumping data for table alumni_mng.profile_structures: ~0 rows (approximately)
DELETE FROM `profile_structures`;
/*!40000 ALTER TABLE `profile_structures` DISABLE KEYS */;
/*!40000 ALTER TABLE `profile_structures` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.questions
CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `question_content` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'nội dung câu hỏi',
  `question_type` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'loại câu hỏi (select, checbox, number, ...)',
  `question_answer` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'câu trả lời mặc định (nếu là select hoặc checkbox thì sẽ có dạng json)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Câu hỏi cho mẫu khảo sát';

-- Dumping data for table alumni_mng.questions: ~0 rows (approximately)
DELETE FROM `questions`;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `role_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tên phân quyền',
  `role_note` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'chú thích về phân quyền',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Thông tin phân quyền';

-- Dumping data for table alumni_mng.roles: ~0 rows (approximately)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.roles_examines
CREATE TABLE IF NOT EXISTS `roles_examines` (
  `role_examine_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `role_id` int(10) unsigned NOT NULL COMMENT 'id phân quyền',
  `academy_id` int(10) unsigned NOT NULL COMMENT 'id khoa',
  `class_id` int(10) unsigned NOT NULL COMMENT 'id lớp (nếu muốn chỉ cho phép khảo sát theo lớp)',
  `examine_id` int(10) unsigned NOT NULL COMMENT 'id khảo sát',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`role_examine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Liên kết giữa phân quyền và bảng khảo sát để biết phân quyền nào được thực hiện bảng khảo sát nào\r\nQuan hệ nhiều nhiều';

-- Dumping data for table alumni_mng.roles_examines: ~0 rows (approximately)
DELETE FROM `roles_examines`;
/*!40000 ALTER TABLE `roles_examines` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles_examines` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.role_users
CREATE TABLE IF NOT EXISTS `role_users` (
  `role_user_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_id` int(10) unsigned NOT NULL COMMENT 'id tài khoản',
  `role_id` int(10) unsigned NOT NULL COMMENT 'id phân quyền',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`role_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Liên kết giữa phân quyền và tài khoản\r\nQuan hệ 1 nhiều';

-- Dumping data for table alumni_mng.role_users: ~0 rows (approximately)
DELETE FROM `role_users`;
/*!40000 ALTER TABLE `role_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_users` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.routes
CREATE TABLE IF NOT EXISTS `routes` (
  `route_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `route_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `route_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`route_id`),
  UNIQUE KEY `route_name` (`route_name`),
  UNIQUE KEY `route_link` (`route_link`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tên các action trong danh sách xử lý';

-- Dumping data for table alumni_mng.routes: ~0 rows (approximately)
DELETE FROM `routes`;
/*!40000 ALTER TABLE `routes` DISABLE KEYS */;
/*!40000 ALTER TABLE `routes` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
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
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Lưu trữ thông tin người dùng';

-- Dumping data for table alumni_mng.users: ~0 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.wards
CREATE TABLE IF NOT EXISTS `wards` (
  `ward_id` int(10) unsigned NOT NULL,
  `district_id` int(10) NOT NULL,
  `ward_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`ward_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Phường xã';

-- Dumping data for table alumni_mng.wards: ~0 rows (approximately)
DELETE FROM `wards`;
/*!40000 ALTER TABLE `wards` DISABLE KEYS */;
/*!40000 ALTER TABLE `wards` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.years
CREATE TABLE IF NOT EXISTS `years` (
  `year_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `year_number` int(10) NOT NULL COMMENT 'Số khóa (K40, K41, ...)',
  `year_begin` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'thời gian bắt đầu',
  `year_end` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'thời gian kết thúc',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm',
  PRIMARY KEY (`year_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Niên khóa';

-- Dumping data for table alumni_mng.years: ~0 rows (approximately)
DELETE FROM `years`;
/*!40000 ALTER TABLE `years` DISABLE KEYS */;
/*!40000 ALTER TABLE `years` ENABLE KEYS */;

-- Dumping structure for table alumni_mng.year_users
CREATE TABLE IF NOT EXISTS `year_users` (
  `year_user_id` int(10) unsigned NOT NULL COMMENT 'id',
  `year_id` int(10) unsigned NOT NULL COMMENT 'id năm học',
  `user_id` int(10) unsigned NOT NULL COMMENT 'id user',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Liên kết năm học với tài khoản\r\nQuan hệ 1 nhiều';

-- Dumping data for table alumni_mng.year_users: ~0 rows (approximately)
DELETE FROM `year_users`;
/*!40000 ALTER TABLE `year_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `year_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
