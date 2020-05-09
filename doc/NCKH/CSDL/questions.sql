-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2019 at 06:22 PM
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
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(10) UNSIGNED NOT NULL COMMENT 'id câu hỏi',
  `survey_id` int(10) UNSIGNED NOT NULL COMMENT 'id khảo sát',
  `question_title` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nội dung câu hỏi',
  `question_mandatory` int(11) DEFAULT NULL COMMENT 'câu hỏi bắt buộc',
  `question_type` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'loại câu hỏi (select, checbox, number, ...)',
  `question_option` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'phương án trả lời (nếu là select hoặc checkbox thì sẽ có dạng json)',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Câu hỏi cho mẫu khảo sát';

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `survey_id`, `question_title`, `question_mandatory`, `question_type`, `question_option`, `created_at`, `updated_at`, `deleted_at`) VALUES
(23, 1, 'Điện thoại gia đình', 1, 'Text', NULL, '2019-10-15 17:39:42', '2019-10-17 16:21:09', NULL),
(24, 1, 'Điện thoại SV (số sẽ sử dụng lâu dài để Nhà Trường có thể liên hệ sau này)', 1, 'Text', NULL, '2019-10-15 17:39:43', '2019-10-17 16:21:09', NULL),
(25, 1, 'Email đang sử dụng (Mail sẽ sử dụng lâu dài để Nhà Trường có thể liên hệ sau này, KHÔNG GHI EMAIL student)', 1, 'Text', NULL, '2019-10-15 17:39:44', '2019-10-17 16:21:09', NULL),
(26, 1, 'Địa chỉ liên hệ', 1, 'Text', NULL, '2019-10-15 17:39:45', '2019-10-17 16:21:09', NULL),
(27, 1, 'Bạn đánh giá thế nào về chương trình đào tạo mà bạn đã học?', 1, 'Checkbox', '{\"option\":[\"Ph\\u00f9 h\\u1ee3p\",\"C\\u1ea7n t\\u0103ng th\\u00eam th\\u1eddi l\\u01b0\\u1ee3ng gi\\u1ea3ng d\\u1ea1y l\\u00fd thuy\\u1ebft v\\u00e0 th\\u1ef1c h\\u00e0nh\",\"Ch\\u1ec9 c\\u1ea7n t\\u0103ng th\\u00eam gi\\u1edd th\\u1ef1c h\\u00e0nh\",\"Ch\\u1ec9 c\\u1ea7n t\\u0103ng th\\u00eam gi\\u1edd l\\u00fd thuy\\u1ebft\",\"T\\u0103ng th\\u00eam b\\u00e0i t\\u1eadp l\\u1edbn\",\"M\\u1eddi th\\u00eam m\\u1ed9t s\\u1ed1 chuy\\u00ean gia \\u1edf c\\u00e1c c\\u00f4ng ty d\\u1ea1y 1 s\\u1ed1 chuy\\u00ean \\u0111\\u1ec1\"]}', '2019-10-15 17:39:46', '2019-10-17 16:21:09', NULL),
(28, 1, 'Bạn đánh giá thế nào về cơ sở vật chất (CSVC) của Trường?', 1, 'Radio', '{\"option\":[\"Qu\\u00e1 t\\u1ec7\",\"Ph\\u00f9 h\\u1ee3p, \\u0111\\u00e1p \\u1ee9ng nhu c\\u1ea7u h\\u1ecdc t\\u1eadp v\\u00e0 sinh ho\\u1ea1t\",\"Hi\\u1ec7n \\u0111\\u1ea1i\"]}', '2019-10-15 17:39:47', '2019-10-17 16:21:09', NULL),
(29, 1, 'Bạn đánh giá thế nào về môi Trường học tập của nhà Trường?', 1, 'Radio', '{\"option\":[\"Qu\\u00e1 t\\u1ec7\",\"Trung b\\u00ecnh\",\"Kh\\u00e1 t\\u1ed1t\",\"R\\u1ea5t t\\u1ed1t\"]}', '2019-10-15 17:39:48', '2019-10-17 16:21:09', NULL),
(30, 1, 'Bạn có hài lòng sau khi đã học tại Khoa CNTT&TT', 1, 'Radio', '{\"option\":[\"Kh\\u00f4ng h\\u00e0i l\\u00f2ng\",\"H\\u00e0i l\\u00f2ng\",\"R\\u1ea5t h\\u00e0i l\\u00f2ng\"]}', '2019-10-15 17:39:49', '2019-10-17 16:21:09', NULL),
(31, 1, '1 - Bạn đã có việc làm chưa? (Nếu đang đi NVQS thì cũng coi như đang có việc làm trong cơ quan Nhà nước)', 1, 'Radio', '{\"option\":[\"C\\u00f3 vi\\u1ec7c l\\u00e0m\",\"\\u0110ang h\\u1ecdc cao h\\u1ecdc\",\"\\u0110ang h\\u1ecdc ng\\u00e0nh\\/ ngh\\u1ec1 kh\\u00e1c\",\"Ch\\u01b0a c\\u00f3 vi\\u1ec7c l\\u00e0m\"]}', '2019-10-15 17:39:50', '2019-10-17 16:21:09', NULL),
(32, 1, '2 - Bạn đang làm tại đơn vị thuộc loại nào? (Chỉ trả lời nếu bạn đã có việc làm)', NULL, 'Radio', '{\"option\":[\"C\\u01a1 quan nh\\u00e0 n\\u01b0\\u1edbc\",\"Doanh nghi\\u1ec7p t\\u01b0 nh\\u00e2n\",\"Doanh nghi\\u1ec7p li\\u00ean doanh v\\u1edbi n\\u01b0\\u1edbc ngo\\u00e0i\",\"T\\u1ef1 t\\u1ea1o vi\\u1ec7c l\\u00e0m (\\u0111ang bu\\u00f4n b\\u00e1n ho\\u1eb7c l\\u00e0m m\\u1ed9t c\\u00f4ng vi\\u1ec7c t\\u1ef1 do kh\\u00f4ng kh\\u00f4ng thu\\u1ed9c c\\u00f4ng ty n\\u00e0o)\"]}', '2019-10-15 17:39:51', '2019-10-17 16:21:09', NULL),
(33, 1, '3 - Tên đơn vị bạn đang làm việc (Chỉ trả lời nếu bạn đã có việc làm)', NULL, 'Textarea', NULL, '2019-10-15 17:39:52', '2019-10-17 16:21:09', NULL),
(34, 1, '4 - Địa chỉ đơn vị bạn đang làm việc (Chỉ trả lời nếu bạn đã có việc làm)', NULL, 'Textarea', NULL, '2019-10-15 17:39:53', '2019-10-17 16:21:09', NULL),
(35, 1, '5 - Đơn vị bạn đang làm thuộc tỉnh/ TP nào (Chỉ trả lời nếu bạn đã có việc làm)?', NULL, 'Text', NULL, '2019-10-15 17:39:54', '2019-10-17 16:21:09', NULL),
(36, 1, '6 - Công việc mà Anh/Chị đang làm có đúng với ngành Anh/Chị được đào tạo hay không? (Chỉ trả lời nếu bạn đã có việc làm)', NULL, 'Radio', '{\"option\":[\"\\u0110\\u00fang v\\u1edbi ng\\u00e0nh \\u0111\\u01b0\\u1ee3c \\u0111\\u00e0o t\\u1ea1o\",\"Ch\\u01b0a \\u0111\\u00fang v\\u1edbi ng\\u00e0nh \\u0111\\u01b0\\u1ee3c \\u0111\\u00e0o t\\u1ea1o\"]}', '2019-10-15 17:39:55', '2019-10-17 16:21:09', NULL),
(37, 1, '7 - Kiến thức và kỹ năng mà chương trình đã cung cấp cho Anh/Chị có đáp ứng được yêu cầu công việc mà Anh/Chị đang làm hay chưa? (Chỉ trả lời nếu bạn đã có việc làm)', NULL, 'Radio', '{\"option\":[\"\\u0110\\u00e1p \\u1ee9ng \\u0111\\u01b0\\u1ee3c y\\u00eau c\\u1ea7u c\\u00f4ng vi\\u1ec7c\",\"Ch\\u01b0a \\u0111\\u00e1p \\u1ee9ng \\u0111\\u01b0\\u1ee3c y\\u00eau c\\u1ea7u c\\u00f4ng vi\\u1ec7c\"]}', '2019-10-15 17:39:56', '2019-10-17 16:21:09', NULL),
(38, 1, '8 - Thu nhập bình quân/tháng của Anh/Chị hiện nay là:', NULL, 'Radio', '{\"option\":[\"D\\u01b0\\u1edbi 5 tri\\u1ec7u\",\"T\\u1eeb 5 - 10 tri\\u1ec7u\",\"Tr\\u00ean 10 tri\\u1ec7u\"]}', '2019-10-15 17:39:57', '2019-10-17 16:21:09', NULL),
(39, 1, 'Bạn hài lòng với công việc hiện tại không? (Chỉ trả lời nếu bạn đã có việc làm)', NULL, 'Radio', '{\"option\":[\"R\\u1ea5t h\\u00e0i l\\u00f2ng\",\"H\\u00e0i l\\u00f2ng\",\"Kh\\u00f4ng h\\u00e0i l\\u00f2ng\"]}', '2019-10-15 17:39:58', '2019-10-17 16:21:09', NULL),
(40, 1, 'Bạn có dự định học tiếp cao học không?', NULL, 'Radio', '{\"option\":[\"C\\u00f3\",\"Kh\\u00f4ng\"]}', '2019-10-15 17:39:59', '2019-10-17 16:21:09', NULL),
(41, 1, 'Nếu học cao học tại Khoa CNTT&TT trường Đại học Cần Thơ, bạn muốn học ngành nào?', NULL, 'Checkbox', '{\"option\":[\"H\\u1ec7 th\\u1ed1ng Th\\u00f4ng tin\",\"Khoa h\\u1ecdc m\\u00e1y t\\u00ednh\",\"M\\u1ee5c kh\\u00e1c:\"]}', '2019-10-15 17:40:00', '2019-10-17 16:21:09', NULL),
(42, 1, 'Bạn có việc làm vào tháng - năm nào (chỉ trả lời nếu bạn đã có việc làm). Ví dụ cách ghi như sau: 06-2019 (tháng ghi 2 chữ số), nếu chưa có việc làm thì ghi 00-0000', 1, 'Text', NULL, '2019-10-15 17:40:01', '2019-10-17 16:21:09', NULL),
(43, 1, 'Bạn mong muốn làm việc tại công ty loại nào?', 1, 'Checkbox', '{\"option\":[\"C\\u01a1 quan nh\\u00e0 n\\u01b0\\u1edbc\",\"Doanh nghi\\u1ec7p li\\u00ean doanh v\\u1edbi n\\u01b0\\u1edbc ngo\\u00e0i\",\"Doanh nghi\\u1ec7p t\\u01b0 nh\\u00e2n\",\"T\\u1ef1 t\\u1ea1o vi\\u1ec7c l\\u00e0m\"]}', '2019-10-15 17:40:02', '2019-10-17 16:21:09', NULL),
(44, 1, 'Bạn mong muốn làm việc ở vị trí nào?', 1, 'Radio', '{\"option\":[\"L\\u1eadp tr\\u00ecnh vi\\u00ean\",\"Chuy\\u00ean vi\\u00ean t\\u01b0 v\\u1ea5n v\\u1ec1 CNTT\",\"Gi\\u1ea3ng vi\\u00ean\\/ gi\\u00e1o vi\\u00ean CNTT\",\"Qu\\u1ea3n l\\u00fd\"]}', '2019-10-15 17:40:03', '2019-10-17 16:21:09', NULL),
(59, 2, '1. Anh/Chị có việc làm hay chưa?', 1, 'Radio', '{\"option\":[\"C\\u00f3 vi\\u1ec7c  (Ti\\u1ebfp t\\u1ee5c kh\\u1ea3o s\\u00e1t)\",\"Ch\\u01b0a - \\u0110ang h\\u1ecdc (K\\u1ebft th\\u00fac kh\\u1ea3o s\\u00e1t)\",\"Ch\\u01b0a c\\u00f3 (K\\u1ebft th\\u00fac kh\\u1ea3o s\\u00e1t)\"]}', '2019-10-17 16:13:55', '2019-10-17 16:21:17', NULL),
(60, 2, '2.Anh/chị tìm được việc làm trong khoảng thời gian nào sau đây?', NULL, 'Radio', '{\"option\":[\"Tr\\u01b0\\u1edbc khi t\\u1ed1t nghi\\u1ec7p\",\"Trong v\\u00f2ng 3 th\\u00e1ng sau khi t\\u1ed1t nghi\\u1ec7p\",\"Trong v\\u00f2ng 6 th\\u00e1ng sau khi t\\u1ed1t nghi\\u1ec7p\",\"Sau 6 th\\u00e1ng sau khi t\\u1ed1t nghi\\u1ec7p\"]}', '2019-10-17 16:14:36', '2019-10-17 16:21:17', NULL),
(61, 2, '3. Anh/chị làm việc trong khu vực nào?', NULL, 'Radio', '{\"option\":[\"Nh\\u00e0 n\\u01b0\\u1edbc\",\"T\\u01b0 nh\\u00e2n\",\"Li\\u00ean doanh n\\u01b0\\u1edbc ngo\\u00e0i\",\"T\\u1ef1 t\\u1ea1o vi\\u1ec7c l\\u00e0m\"]}', '2019-10-17 16:15:12', '2019-10-17 16:21:17', NULL),
(62, 2, '4. Vui lòng cho biết Tên cơ quan/công ty anh/chị đang  làm việc?   (Bao gồm cả hình thức Anh/Chị tự tạo việc làm)', NULL, 'Text', NULL, '2019-10-17 16:15:23', '2019-10-17 16:21:17', NULL),
(63, 2, '5.Anh/Chị vui lòng cho biết Địa chỉ cơ quan/công ty mà anh/chị đang làm việc?', NULL, 'Text', NULL, '2019-10-17 16:15:32', '2019-10-17 16:21:17', NULL),
(64, 2, '6. Công việc mà Anh/Chị đang làm có đúng với ngành Anh/Chị được đào tạo hay không?', NULL, 'Radio', '{\"option\":[\"\\u0110\\u00fang v\\u1edbi ng\\u00e0nh \\u0111\\u00e0o t\\u1ea1o\",\"Kh\\u00f4ng \\u0111\\u00fang v\\u1edbi ng\\u00e0nh \\u0111\\u00e0o t\\u1ea1o\",\"Kh\\u00f4ng li\\u00ean quan \\u0111\\u1ebfn ng\\u00e0nh \\u0111\\u01b0\\u1ee3c \\u0111\\u00e0o t\\u1ea1o\"]}', '2019-10-17 16:16:00', '2019-10-17 16:21:17', NULL),
(65, 2, '7.CTĐT trang bị cho Anh/Chị kiến thức chuyên môn đáp ứng được yêu cầu công việc đang làm hay không?', NULL, 'Radio', '{\"option\":[\"\\u0110\\u00e1p \\u1ee9ng \\u0111\\u01b0\\u1ee3c y\\u00eau c\\u1ea7u c\\u00f4ng vi\\u1ec7c\",\"Ch\\u01b0a \\u0111\\u00e1p \\u1ee9ng \\u0111\\u01b0\\u1ee3c y\\u00eau c\\u1ea7u c\\u00f4ng vi\\u1ec7c\"]}', '2019-10-17 16:16:36', '2019-10-17 16:21:17', NULL),
(66, 2, '8.CTĐT trang bị cho Anh/Chị kỹ năng chuyên môn đáp ứng được yêu cầu công việc đang làm hay không?', NULL, 'Radio', '{\"option\":[\"\\u0110\\u00e1p \\u1ee9ng \\u0111\\u01b0\\u1ee3c y\\u00eau c\\u1ea7u c\\u00f4ng vi\\u1ec7c\",\"Ch\\u01b0a \\u0111\\u00e1p \\u1ee9ng \\u0111\\u01b0\\u1ee3c y\\u00eau c\\u1ea7u c\\u00f4ng vi\\u1ec7c\"]}', '2019-10-17 16:16:58', '2019-10-17 16:21:17', NULL),
(67, 2, '9.CTĐT trang bị cho Anh/Chị kỹ năng ngoại ngữ đáp ứng được yêu cầu công việc đang làm hay không?', NULL, 'Radio', '{\"option\":[\"\\u0110\\u00e1p \\u1ee9ng \\u0111\\u01b0\\u1ee3c y\\u00eau c\\u1ea7u c\\u00f4ng vi\\u1ec7c\",\"Ch\\u01b0a \\u0111\\u00e1p \\u1ee9ng \\u0111\\u01b0\\u1ee3c y\\u00eau c\\u1ea7u c\\u00f4ng vi\\u1ec7c\"]}', '2019-10-17 16:17:13', '2019-10-17 16:21:17', NULL),
(68, 2, '10.CTĐT trang bị cho Anh/Chị kỹ năng công nghệ thông tin đáp ứng được yêu cầu công việc đang làm hay không?', NULL, 'Radio', '{\"option\":[\"\\u0110\\u00e1p \\u1ee9ng \\u0111\\u01b0\\u1ee3c y\\u00eau c\\u1ea7u c\\u00f4ng vi\\u1ec7c\",\"Ch\\u01b0a \\u0111\\u00e1p \\u1ee9ng \\u0111\\u01b0\\u1ee3c y\\u00eau c\\u1ea7u c\\u00f4ng vi\\u1ec7c\"]}', '2019-10-17 16:17:34', '2019-10-17 16:21:17', NULL),
(69, 2, '11. CTĐT trang bị cho Anh/Chị kỹ năng mềm đáp ứng được yêu cầu công việc đang làm hay không?', NULL, 'Radio', '{\"option\":[\"\\u0110\\u00e1p \\u1ee9ng \\u0111\\u01b0\\u1ee3c y\\u00eau c\\u1ea7u c\\u00f4ng vi\\u1ec7c\",\"Ch\\u01b0a \\u0111\\u00e1p \\u1ee9ng \\u0111\\u01b0\\u1ee3c y\\u00eau c\\u1ea7u c\\u00f4ng vi\\u1ec7c\"]}', '2019-10-17 16:17:51', '2019-10-17 16:21:17', NULL),
(70, 2, '12. Vui lòng cho biết  mức Thu nhập bình quân/tháng của Anh/Chị hiện nay là:', NULL, 'Radio', '{\"option\":[\"D\\u01b0\\u1edbi 5 tri\\u1ec7u\\/th\\u00e1ng\",\"T\\u1eeb 5 - 10 tri\\u1ec7u\\/th\\u00e1ng\",\"Tr\\u00ean 10 tri\\u1ec7u\\/th\\u00e1ng\"]}', '2019-10-17 16:18:16', '2019-10-17 16:21:17', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD UNIQUE KEY `questions_question_id_unique` (`question_id`),
  ADD KEY `questions_survey_id_index` (`survey_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id câu hỏi', AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
