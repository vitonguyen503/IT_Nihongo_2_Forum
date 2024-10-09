-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 10:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postID` int(11) NOT NULL,
  `quoted_postID` int(11) DEFAULT NULL,
  `threadID` bigint(6) DEFAULT NULL,
  `poster` bigint(8) NOT NULL,
  `content` varchar(10000) DEFAULT NULL,
  `reaction_count` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `last_reaction_user` bigint(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `quoted_postID`, `threadID`, `poster`, `content`, `reaction_count`, `created_at`, `last_reaction_user`) VALUES
(1, NULL, 100000, 10000000, 'Cái này hay lắm mn ơiiiii', 4, '2024-09-22 22:00:58', 10000001),
(2, NULL, 100001, 10000000, 'Bổ ích lắm, còn được tận 2 điểm rèn luyện nữa, đi thôi mọi người ơiii', 9, '2024-09-22 22:00:58', 10000000),
(5, 2, 100001, 10000000, 'Go go', 0, '2024-09-23 09:00:13', NULL),
(6, 0, 100000, 10000000, 'Update post from Postman', 22, '2024-10-02 11:08:11', 10000000),
(7, 0, 100000, 10000001, 'Create new post from postman', 0, '2024-10-02 11:16:00', NULL),
(8, 7, 100000, 10000001, 'Create new post from postman 2', 0, '2024-10-02 11:18:33', NULL),
(20, 0, 100001, 10000000, '初めまして。😇', 0, '2024-10-06 16:49:29', NULL),
(21, 0, 100009, 10000000, 'Nothing. ', 0, '2024-10-07 16:00:35', NULL),
(22, 21, 100009, 10000000, 'Kudaranai', 0, '2024-10-07 16:00:50', NULL),
(23, 0, 100010, 10000000, 'Hội đồng Tuyển sinh Trường Đại học Phenikaa (PKA) công bố điểm chuẩn đợt xét tuyển bổ sung đợt 2 hệ chính quy năm 2024 đối với các phương thức xét tuyển bao gồm:\\n\\nXét tuyển thẳng theo Đề án tuyển sinh của Trường Đại học Phenikaa;\\nXét tuyển dựa vào kết quả kỳ thi tốt nghiệp THPT năm 2024;\\nXét tuyển dựa vào học bạ bậc THPT;\\nXét tuyển dựa vào kết quả bài thi đánh giá năng lực (ĐGNL) của Đại học Quốc gia Hà Nội và kết quả kỳ thi đánh giá tư duy (ĐGTD) của Đại học Bách khoa Hà Nội.\\n1. Điểm chuẩn trúng tuyển đại học hệ chính quy theo các phương thức xét tuyển năm 2024\\n\\nĐối với phương thức xét tuyển thẳng: Thí sinh trúng tuyển khi đạt đầy đủ các tiêu chí xét tuyển thẳng được quy định trong Đề án tuyển sinh đại học năm 2024 của Trường Đại học Phenikaa.\\nĐối với phương thức xét tuyển dựa vào học bạ bậc THPT, xét tuyển dựa vào kết quả kỳ thi tốt nghiệp THPT năm 2024, xét tuyển dựa vào kết quả bài thi ĐGNL của Đại học Quốc gia Hà Nội hoặc kết quả kỳ thi đánh giá tư duy của Đại học Bách khoa Hà Nội được quy định như sau: \\n\\n\\nĐối với tất cả các phương thức xét Khối ngành Khoa học sức khỏe (trừ phương thức xét tuyển bằng kết quả thi tốt nghiệp THPT):\\nNgành Y khoa, Răng - Hàm - Mặt, Dược học, Y học cổ truyền: Học lực lớp 12 xếp loại Giỏi, đồng thời tổng điểm trung bình cộng 3 môn trong tổ hợp xét tuyển đạt 24,0 điểm trở lên;\\nNgành Điều dưỡng, Kỹ thuật xét nghiệm y học, Kỹ thuật phục hồi chức năng, Kỹ thuật hình ảnh y học: Học lực lớp 12 xếp loại từ Khá trở lên, đồng thời tổng điểm trung bình cộng 3 môn trong tổ hợp xét tuyển đạt 19,5 điểm trở lên;\\nLưu ý: \\n\\n1. Tra cứu kết quả xét tuyển\\n\\nThí sinh tra cứu kết quả xét tuyển trên trang thông tin tuyển sinh của Trường từ ngày 13/09/2024 theo địa chỉ: tuyensinh.phenikaa-uni.edu.vn. \\n\\n2. Từ ngày 13/09/2024, Trường Đại học Phenikaa sẽ gửi “Giấy báo trúng tuyển và nhập học” kèm “Hướng dẫn nhập học” đến các thí sinh trúng tuyển theo địa chỉ email thí sinh đã cung cấp trên Hệ thống tuyển sinh của trường Đại học Phenikaa, đồng thời đăng tải Hướng dẫn nhập học trên các kênh truyền thông của nhà trường. Giấy báo trúng tuyển bản cứng nhận trực tiếp khi nhập học.\\n\\n3. Thời gian và địa điểm nhập học\\n\\nThời gian: 17/09/2024 (theo 2 hình thức trực tiếp và trực tuyến)\\nĐịa điểm: Tầng 1 Tòa nhà A9 - A10, Trường Đại học Phenikaa.\\n4. Chi tiết liên hệ\\n\\nPhòng Tuyển sinh và Truyền thông\\n\\nĐịa chỉ: Tầng 1 Nhà A9, Trường Đại học Phenikaa, Đường Nguyễn Văn Trác, Phường Yên Nghĩa, quận Hà Đông, Hà Nội.\\n\\nSố điện thoại: 096.951.1010 - 094.651.1010 hoặc 0246.291.8118.', 0, '2024-10-07 16:51:48', NULL),
(24, NULL, 100010, 10000004, 'Em đỗ IT-VJ rồi các anh chị ơiii', 3, '2024-10-07 17:01:14', 10000003),
(25, NULL, 100010, 10000001, 'Chúc mừng em nhé', 2, '2024-10-07 17:01:14', 10000002),
(26, 24, 100010, 10000000, 'Thằng này khá. \\nChúc mừng em nhé', 0, '2024-10-07 17:07:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE `thread` (
  `threadID` bigint(6) NOT NULL,
  `userID` bigint(8) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` mediumtext DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thread`
--

INSERT INTO `thread` (`threadID`, `userID`, `title`, `image`, `created_at`, `updated_at`) VALUES
(100000, 10000000, 'WORKSHOP \"NHỮNG HIỆN THỰC MỚI\"', 'https://phenikaa-uni.edu.vn:3600/pu/vi/posts/tiktok-01_20210423114158.jpg', '2024-09-22 17:50:39', '2024-09-22 17:51:08'),
(100001, 10000000, 'Chuỗi sự kiện \"Khoa Công nghệ số liên ngành: Tích hợp các công nghệ và ứng dụng liên ngành trong kinh tế\"', 'https://phenikaa-uni.edu.vn:3600/pu/vi/posts/thumbnail-su-kien-workshop-cong-nghe-so-lien-nganh-04.jpg', '2024-09-22 17:50:39', '2024-09-22 23:10:13'),
(100002, 10000000, 'Cuộc thi tìm kiếm tài năng MC - Brighten Your Voice', 'https://phenikaa-uni.edu.vn:3600/pu/vi/posts/26777559125189562382354391458338620411672386n.jpg', '2024-09-22 17:50:39', '2024-09-22 17:50:39'),
(100005, 10000000, '天命人', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRnjOJI7zcvJR_zqr29Ns2HEA9fAKU8_5UeWA&s', '2024-10-04 10:46:54', '2024-10-04 10:46:54'),
(100009, 10000000, 'Teamwork without code convention is frustrating...', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRnjOJI7zcvJR_zqr29Ns2HEA9fAKU8_5UeWA&s', '2024-10-04 11:39:38', '2024-10-04 11:39:38'),
(100010, 10000000, 'Công bố điểm chuẩn xét tuyển đợt 2 PKA', 'https://phenikaa-uni.edu.vn:3600/pu/vi/posts/thumbnail-diem-chuan-dot-bs2-02.jpg', '2024-10-06 16:53:36', '2024-10-06 16:53:36'),
(100011, 10000000, 'Lịch nhập học K18', 'https://phenikaa-uni.edu.vn:3600/pu/vi/posts/dsc5395-enhanced-nr.jpg', '2024-10-06 16:58:11', '2024-10-06 16:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `year_code` varchar(3) NOT NULL,
  `profile_picture` mediumtext DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `phone_number` varchar(10) DEFAULT NULL,
  `userID` bigint(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `dob`, `address`, `is_admin`, `year_code`, `profile_picture`, `created_at`, `username`, `password`, `phone_number`, `userID`) VALUES
('Admin', NULL, NULL, 0, 'K15', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS1DeyZNqRdLF9WiyJOo7YQW5HxbSp3F6tNQQ&s', '2024-09-17 17:35:51', 'admin', 'admin', NULL, 10000000),
('H503', NULL, NULL, 0, 'K15', NULL, '2024-09-24 10:56:14', 'h503', 'h503', NULL, 10000001),
('Thu Quynh', NULL, NULL, 0, 'K14', 'data:image/jpeg;base64,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', '2024-10-07 16:57:45', 'thuQuynh', 'thuQuynh', NULL, 10000002),
('KietCT', NULL, NULL, 1, '', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRcWnbZGbP61F3wDnPIrc2IpZ-b_ilFLGCzaQ&s', '2024-10-07 16:57:45', 'kietct', 'kietct', NULL, 10000003),
('ThaiLQ', NULL, NULL, 0, '', 'data:image/jpeg;base64,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', '2024-10-07 16:59:46', 'thailq', 'thailq', NULL, 10000004);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `threadID` (`threadID`),
  ADD KEY `poster` (`poster`),
  ADD KEY `last_reaction_user` (`last_reaction_user`);

--
-- Indexes for table `thread`
--
ALTER TABLE `thread`
  ADD PRIMARY KEY (`threadID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `thread`
--
ALTER TABLE `thread`
  MODIFY `threadID` bigint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100012;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` bigint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000005;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`threadID`) REFERENCES `thread` (`threadID`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`poster`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `posts_ibfk_3` FOREIGN KEY (`last_reaction_user`) REFERENCES `users` (`userID`);

--
-- Constraints for table `thread`
--
ALTER TABLE `thread`
  ADD CONSTRAINT `thread_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
