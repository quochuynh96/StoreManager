-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2018 at 06:22 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `storemanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `displayname` text COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `displayname`, `role`) VALUES
(1, 'admin', '12345', 'Quản trị viên', 0),
(2, 'user1', '12345', 'Nhân viên bán hàng #1', 1),
(3, 'user2', '12345', 'Thủ kho #2', 2),
(4, 'user3', '12345', 'Thủ kho #1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `num` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`id`, `name`, `image`, `detail`, `num`, `active`, `price`) VALUES
(11, 'Samsung Galaxy Note 9', 'https://cdn.tgdd.vn/Products/Images/42/154897/samsung-galaxy-note-9-black-400x460-400x460.png', 'Mang lại sự cải tiến đặc biệt trong cây bút S-Pen, siêu phẩm Samsung Galaxy Note 9 còn sở hữu dung lượng pin khủng lên tới 4.000 mAh cùng hiệu năng mạnh mẽ vượt bậc, xứng đáng là một trong những chiếc điện thoại cao cấp nhất của Samsung.', 99, 1, 22990000),
(12, 'iPhone Xs Max 64GB', 'https://cdn.tgdd.vn/Products/Images/42/190321/iphone-xs-max-gray-400x460.png', 'Hoàn toàn xứng đáng với những gì được mong chờ, phiên bản cao cấp nhất iPhone Xs Max của Apple năm nay nổi bật với chip A12 Bionic mạnh mẽ, màn hình rộng đến 6.5 inch, cùng camera kép trí tuệ nhân tạo và Face ID được nâng cấp.', 99, 1, 33990000),
(13, 'Samsung Galaxy S9+ 128GB', 'https://cdn.tgdd.vn/Products/Images/42/154695/samsung-galaxy-s9-plus-128gb-400x460-400x460.png', 'Samsung Galaxy S9 Plus 128Gb, siêu phẩm smartphone hàng đầu trong thế giới Android đã ra mắt với màn hình vô cực, camera chuyên nghiệp như máy ảnh và hàng loạt những tính năng cao cấp đầy hấp dẫn.', 99, 1, 24490000),
(14, 'Apple Macbook Air MQD32SA(2017)', 'https://cdn.tgdd.vn/Products/Images/44/106875/apple-macbook-air-mqd32sa-a-i5-5350u-400-1-450x300-600x600.jpg', 'Macbook Air MQD32SA/A i5 5350U với thiết kế vỏ nhôm nguyên khối Unibody rất đẹp, chắc chắn và sang trọng. Macbook Air là một chiếc máy tính xách tay siêu mỏng nhẹ, hiệu năng ổn định mượt mà, thời lượng pin cực lâu, phục vụ tốt cho nhu cầu làm việc lẫn giải trí.', 98, 1, 21000000),
(15, 'HP Envy 13 (4ME92PA)', 'https://cdn.tgdd.vn/Products/Images/44/169424/hp-envy-13-ah0025tu-4me92pa-600x600.jpg', 'HP Envy 13 là phiên bản máy tính xách tay có thiết kế cao cấp - sang trọng đầy ấn tượng cùng với một cấu hình mạnh mẽ cho hiệu suất hoạt động mạnh mẽ để xử lý công việc hay giải trí mượt mà.', 100, 1, 20990000);

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`id`, `name`, `address`, `phone`) VALUES
(7, 'Trương Quốc Huynh', '18/36 Đống Đa, Tp Huế', '0772956695'),
(8, 'Lê Trọng Đại', '9/100 Ngự Bình, Tp Huế', '033221233');

-- --------------------------------------------------------

--
-- Table structure for table `guestorder`
--

CREATE TABLE `guestorder` (
  `id` int(11) NOT NULL,
  `idguest` int(11) NOT NULL,
  `idaccount` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `pay` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `guestorder`
--

INSERT INTO `guestorder` (`id`, `idguest`, `idaccount`, `date`, `pay`) VALUES
(21, 7, 2, '2018-12-10 00:18:11', 1),
(22, 8, 2, '2018-12-10 00:18:32', 1),
(23, 8, 2, '2018-12-10 00:19:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hisaddgoods`
--

CREATE TABLE `hisaddgoods` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `idgoods` int(11) NOT NULL,
  `idaccount` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hisaddgoods`
--

INSERT INTO `hisaddgoods` (`id`, `type`, `idgoods`, `idaccount`, `date`, `note`) VALUES
(10, 1, 11, 3, '2018-12-10 00:10:09', 'Thêm mặt hàng : Samsung Galaxy Note 9. Số lượng : 100'),
(11, 1, 12, 3, '2018-12-10 00:10:51', 'Thêm mặt hàng : iPhone Xs Max 64GB. Số lượng : 100'),
(12, 1, 13, 3, '2018-12-10 00:11:35', 'Thêm mặt hàng : Samsung Galaxy S9+ 128GB. Số lượng : 100'),
(13, 1, 14, 3, '2018-12-10 00:12:30', 'Thêm mặt hàng : Apple Macbook Air MQD32SA(2017). Số lượng : 100'),
(14, 1, 15, 3, '2018-12-10 00:13:38', 'Thêm mặt hàng : HP Envy 13 (4ME92PA). Số lượng : 100'),
(15, 2, 14, 3, '2018-12-10 00:13:53', 'Cập nhật mặt hàng : Apple Macbook Air MQD32SA(2017). Số lượng : 100');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `id` int(11) NOT NULL,
  `idguestorder` int(11) NOT NULL,
  `idgoods` int(11) NOT NULL,
  `num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`id`, `idguestorder`, `idgoods`, `num`) VALUES
(6, 21, 11, 1),
(7, 21, 12, 1),
(8, 22, 13, 1),
(9, 22, 14, 1),
(10, 23, 14, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guestorder`
--
ALTER TABLE `guestorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hisaddgoods`
--
ALTER TABLE `hisaddgoods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `guestorder`
--
ALTER TABLE `guestorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `hisaddgoods`
--
ALTER TABLE `hisaddgoods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
