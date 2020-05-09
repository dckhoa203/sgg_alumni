-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2019 at 05:25 PM
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
(1, 1, 'Tình hình việc làm', 1, 'Radio', '{\"option\":[\"C\\u00f3 vi\\u1ec7c l\\u00e0m\\t\\t\\u0110\\u00fang ng\\u00e0nh \\u0111\\u00e0o t\\u1ea1o\",\"C\\u00f3 vi\\u1ec7c l\\u00e0m\\t\\tLi\\u00ean quan \\u0111\\u1ebfn ng\\u00e0nh \\u0111\\u00e0o t\\u1ea1o\",\"C\\u00f3 vi\\u1ec7c l\\u00e0m\\t\\tKh\\u00f4ng li\\u00ean quan \\u0111\\u1ebfn ng\\u00e0nh \\u0111\\u00e0o t\\u1ea1o\",\"Ti\\u1ebfp t\\u1ee5c h\\u1ecdc\",\"Ch\\u01b0a c\\u00f3 vi\\u1ec7c l\\u00e0m\"]}', '2019-10-08 14:44:22', '2019-10-10 15:25:18', NULL),
(2, 1, 'Khu vực làm việc', 1, 'Radio', '{\"option\":[\"Nh\\u00e0 n\\u01b0\\u1edbc\",\"T\\u01b0 nh\\u00e2n\",\"T\\u1ef1 t\\u1ea1o vi\\u1ec7c l\\u00e0m\",\"C\\u00f3 y\\u1ebfu t\\u1ed1 n\\u01b0\\u1edbc ngo\\u00e0i\"]}', '2019-10-08 14:45:06', '2019-10-10 15:25:18', NULL),
(3, 1, 'Nơi làm việc (Tỉnh/TP)', NULL, 'Text', NULL, '2019-10-08 14:45:14', '2019-10-10 15:25:18', NULL);

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
  MODIFY `question_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id câu hỏi', AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
