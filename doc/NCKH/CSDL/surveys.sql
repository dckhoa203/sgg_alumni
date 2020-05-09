-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2019 at 06:21 PM
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
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `survey_id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'người lập',
  `survey_name` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên mẫu khảo sát',
  `survey_description` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'mô tả khảo sát',
  `survey_start` datetime NOT NULL COMMENT 'ngày bắt đầu',
  `survey_end` datetime NOT NULL COMMENT 'ngày kết thúc',
  `survey_version` int(10) UNSIGNED NOT NULL COMMENT 'phiên bảng khảo sát',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'ngày tạo',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'ngày cập nhật',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'ngày xóa tạm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Mẫu khảo sát';

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`survey_id`, `user_id`, `survey_name`, `survey_description`, `survey_start`, `survey_end`, `survey_version`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'NHẬN QĐ TỐT NGHIỆP KHOA CNTT & TT Từ ngày 02/07/2019', 'Chào các em,\r\n            Các em tốt nghiệp HK2-2018-2019 sẽ nhận quyết định từ ngày 02/07/2019 - 11/07/2019 (cần xuất trình CMND hoặc giấy tờ có dán ảnh).  Nếu SV không nhận trong thời gian này thì sẽ nhận vào thời gian nhận bằng tốt nghiệp. Lưu ý: phải giữ quyết định này thì mới nhận bằng tốt nghiệp được.\r\n            - SV khoa CNTT&TT nhận tại Thư viện Khoa CNTT&TT\r\n            - SV chưa hoàn thành thanh toán phải có xác nhận của đơn vị có liên quan vào Phiếu thanh toán ra trường. \r\n            - SV khoa CNTT&TT nhận bảng điểm tại  Thư viện Khoa CNTT&TT từ 06/08/2019 - 30/08/2019\r\n            - SV liên hệ PĐT nhận bằng tốt nghiệp từ ngày 06/08/2019 - 30/08/2019 (cần xuất trình QĐ tốt nghiệp và CMND hoặc giấy tờ có dán ảnh)\r\n            - Lễ tốt nghiệp sẽ tổ chức trong tháng 9/2019. Tháng 8 Khoa sẽ có thông báo cụ thể qua email sinh viên\r\n            SV hoàn thành mẫu này trước khi nhận quyết định', '2019-10-08 12:00:00', '2020-01-04 12:00:00', 2, '2019-10-15 17:39:41', '2019-10-17 16:21:27', NULL),
(2, 1, 'KHẢO SÁT TÌNH HÌNH VIỆC LÀM CỦA SINH VIÊN SAU 1 NĂM TỐT NGHIỆP', 'DANH SÁCH PHỎNG VẤN TÌNH HÌNH VIỆC LÀM CỦA SINH VIÊN SAU 1 NĂM TỐT NGHIỆP', '2019-10-10 12:00:00', '2019-11-30 23:00:00', 1, '2019-10-17 16:13:17', '2019-10-17 16:21:34', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`survey_id`),
  ADD KEY `surveys_user_id_index` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `survey_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
