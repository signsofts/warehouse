-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2024 at 05:46 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warehouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AD_ID` int(11) NOT NULL,
  `AD_NAME` varchar(50) DEFAULT NULL COMMENT 'ชื่อ',
  `AD_USERNAME` varchar(50) DEFAULT NULL COMMENT 'username เข้าระบบ',
  `AD_PASSWORD` varchar(50) DEFAULT NULL COMMENT 'password เข้าระบบ',
  `AD_STAMP` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'วันที่สร้าง',
  `AD_PHONE` varchar(10) DEFAULT NULL COMMENT 'เบอร์มือถือ',
  `AD_CODE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AD_ID`, `AD_NAME`, `AD_USERNAME`, `AD_PASSWORD`, `AD_STAMP`, `AD_PHONE`, `AD_CODE`) VALUES
(1, 'ADMIN', 'ADMIN', 'ADMIN', '2024-01-19 17:05:30', '0987654321', 'AD_0001');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EM_ID` int(11) NOT NULL,
  `EM_CODE` varchar(20) NOT NULL COMMENT 'รหัสพนักงาน',
  `EM_NAME` varchar(50) DEFAULT NULL COMMENT 'ชื่อพนักงาน',
  `EM_USERNAME` varchar(50) NOT NULL COMMENT 'USERNAME เข้าสู่ระบบ',
  `EM_PASSWORD` varchar(50) NOT NULL COMMENT 'Password เข้าสู่ระบบ',
  `EM_LASTNAME` varchar(50) DEFAULT NULL COMMENT 'นามสกุลพนักงาน',
  `EM_PHONE` varchar(10) DEFAULT NULL COMMENT 'เบอร์พนักงาน',
  `EM_BIRTHDAY` date DEFAULT NULL COMMENT 'วันเกิดพนักงาน',
  `EM_STATUS` varchar(2) DEFAULT NULL COMMENT 'สถานะพนักงาน',
  `EM_RESIGN` int(11) NOT NULL DEFAULT 1 COMMENT '0 = ลาออก 1= ทำงาน',
  `EM_STAMP` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'วันที่เพิ่มพนักงาน',
  `EM_ADDRESS` text DEFAULT NULL COMMENT 'ที่อยู่พนักงาน',
  `AD_CODE` varchar(50) DEFAULT NULL COMMENT 'แอดมิน',
  `EM_DSTART` date DEFAULT NULL COMMENT 'วันที่เริ่มทำงาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EM_ID`, `EM_CODE`, `EM_NAME`, `EM_USERNAME`, `EM_PASSWORD`, `EM_LASTNAME`, `EM_PHONE`, `EM_BIRTHDAY`, `EM_STATUS`, `EM_RESIGN`, `EM_STAMP`, `EM_ADDRESS`, `AD_CODE`, `EM_DSTART`) VALUES
(1, 'EM00000', 'emmd', 'em', 'em', 'emm', '0989878978', '2024-01-20', NULL, 1, '2024-01-20 19:07:10', 'em           ', NULL, '2024-01-21');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `PD_ID` int(11) NOT NULL,
  `PD_NAME` varchar(255) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `PD_BARCODE` varchar(255) DEFAULT NULL COMMENT 'รหัสบาร์โค้ด',
  `PD_STAMP` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp() COMMENT 'เวลาเพิ่มสินค้า',
  `PD_COST` decimal(10,2) DEFAULT NULL COMMENT 'ราคาต้นทุนสินค้า',
  `PD_SELL` decimal(10,2) DEFAULT NULL COMMENT 'ราคาขาย',
  `PD_ITEM` int(11) DEFAULT NULL COMMENT 'จำนวนสินค้า',
  `PD_IMAG` varchar(255) DEFAULT NULL COMMENT 'รูปภาพ',
  `PD_PROFIT` decimal(10,2) DEFAULT NULL COMMENT 'กำไรรวม',
  `PD_DELETE` int(11) DEFAULT NULL COMMENT '0 = ลบสินค้า ',
  `PD_STATUS` int(11) DEFAULT NULL COMMENT 'สถานะสินค้า (เพิ่มรอการพัฒนาต่อยอด)',
  `EM_CODE` varchar(20) DEFAULT NULL COMMENT 'พนักงานที่กระทำ',
  `PD_DETAILS` text NOT NULL COMMENT 'รายละเอียดเก็บสินค้า'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`PD_ID`, `PD_NAME`, `PD_BARCODE`, `PD_STAMP`, `PD_COST`, `PD_SELL`, `PD_ITEM`, `PD_IMAG`, `PD_PROFIT`, `PD_DELETE`, `PD_STATUS`, `EM_CODE`, `PD_DETAILS`) VALUES
(6, 'e', 'PD00000', '2024-01-22 11:40:56', '8.00', '34.00', 0, 'product-item.png', '26.00', 0, NULL, 'EM00000', 'e'),
(7, 'ddf', 'PD00006', '2024-01-24 16:33:00', '2.00', '3.00', 0, '20240122185655PD00006_wp5188423-blackpink-4k-wallpapers.jpg', '1.00', NULL, NULL, 'EM00000', 'fs'),
(8, 's', 'PD00007', '2024-01-24 16:35:05', '5.00', '5.00', 20, '20240122190254PD00007_737400.jpg', '0.00', NULL, NULL, 'EM00000', 'd'),
(9, 'd', 'PD00008', '2024-01-22 11:41:02', '2.00', '2.00', 2, 'Screenshot_2024-01-13_014751.png', '0.00', 0, NULL, 'EM00000', 'e');

-- --------------------------------------------------------

--
-- Table structure for table `transction`
--

CREATE TABLE `transction` (
  `TS_ID` int(11) NOT NULL,
  `PD_BARCODE` varchar(255) DEFAULT NULL COMMENT 'รหัสบาร์โค้ดสินค้า',
  `TS_TYPE` int(11) NOT NULL COMMENT '1 = นำเข้าสินค้า  , 2 = ส่งออกสินค้า',
  `TS_ITEM` int(11) NOT NULL COMMENT 'จำนวนสินค้า  ที่นำเข้า หรือ ส่งออก',
  `TS_STAMP` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'เวลาทำธุรกรรม',
  `TS_CANCEL` int(11) DEFAULT NULL COMMENT '0 = ยกเลิกนำเข้า  หรือ ส่งออกสินค้า (ไม่นับรวมจำนวนสินค้า)',
  `EM_CODE` varchar(20) DEFAULT NULL COMMENT 'พนักงานที่กระทำ',
  `TS_COST` decimal(10,2) DEFAULT NULL COMMENT 'ราคาต้นทุนสินค้านำเข้า',
  `TS_SELL` decimal(10,2) DEFAULT NULL COMMENT 'ราคาขายส่งออก',
  `TS_PROFIT` decimal(10,2) DEFAULT NULL COMMENT 'กำไรรวม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `transction`
--

INSERT INTO `transction` (`TS_ID`, `PD_BARCODE`, `TS_TYPE`, `TS_ITEM`, `TS_STAMP`, `TS_CANCEL`, `EM_CODE`, `TS_COST`, `TS_SELL`, `TS_PROFIT`) VALUES
(1, 'PD00000', 1, 0, '2024-01-21 11:47:01', NULL, 'EM00000', '0.00', '0.00', '0.00'),
(2, 'PD00006', 1, 5, '2024-01-21 11:47:40', NULL, 'EM00000', '2.00', '3.00', '1.00'),
(3, 'PD00007', 1, 1, '2024-01-21 11:50:21', NULL, 'EM00000', '5.00', '5.00', '0.00'),
(4, 'PD00008', 1, 2, '2024-01-21 11:52:31', NULL, 'EM00000', '2.00', '2.00', '0.00'),
(5, 'PD00007', 1, 33, '2024-01-23 05:28:10', NULL, 'EM00000', '5.00', '5.00', '0.00'),
(6, 'PD00007', 1, 6, '2024-01-23 05:28:23', NULL, 'EM00000', '5.00', '5.00', '0.00'),
(7, 'PD00006', 2, 1, '2024-01-24 10:32:06', NULL, 'EM00000', '2.00', '3.00', '1.00'),
(8, 'PD00007', 2, 1, '2024-01-24 10:32:06', NULL, 'EM00000', '5.00', '5.00', '0.00'),
(9, 'PD00006', 2, 1, '2024-01-24 10:32:11', NULL, 'EM00000', '2.00', '3.00', '1.00'),
(10, 'PD00007', 2, 1, '2024-01-24 10:32:11', NULL, 'EM00000', '5.00', '5.00', '0.00'),
(11, 'PD00006', 2, 1, '2024-01-24 10:32:17', NULL, 'EM00000', '2.00', '3.00', '1.00'),
(12, 'PD00007', 2, 1, '2024-01-24 10:32:17', NULL, 'EM00000', '5.00', '5.00', '0.00'),
(13, 'PD00006', 2, 1, '2024-01-24 10:32:38', NULL, 'EM00000', '2.00', '3.00', '1.00'),
(14, 'PD00007', 2, 1, '2024-01-24 10:32:38', NULL, 'EM00000', '5.00', '5.00', '0.00'),
(15, 'PD00006', 2, 1, '2024-01-24 10:33:00', NULL, 'EM00000', '2.00', '3.00', '1.00'),
(16, 'PD00007', 2, 1, '2024-01-24 10:33:00', NULL, 'EM00000', '5.00', '5.00', '0.00'),
(17, 'PD00007', 2, 1, '2024-01-24 10:33:26', NULL, 'EM00000', '5.00', '5.00', '0.00'),
(18, 'PD00007', 2, 1, '2024-01-24 10:34:03', NULL, 'EM00000', '5.00', '5.00', '0.00'),
(19, 'PD00007', 2, 1, '2024-01-24 10:34:27', NULL, 'EM00000', '5.00', '5.00', '0.00'),
(20, 'PD00007', 2, 12, '2024-01-24 10:35:05', NULL, 'EM00000', '5.00', '5.00', '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AD_ID`),
  ADD KEY `AD_CODE` (`AD_CODE`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EM_ID`),
  ADD KEY `EM_CODE` (`EM_CODE`),
  ADD KEY `d` (`AD_CODE`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`PD_ID`),
  ADD KEY `PD_BARCODE` (`PD_BARCODE`);

--
-- Indexes for table `transction`
--
ALTER TABLE `transction`
  ADD PRIMARY KEY (`TS_ID`),
  ADD KEY `df` (`EM_CODE`),
  ADD KEY `feee` (`PD_BARCODE`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EM_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `PD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transction`
--
ALTER TABLE `transction`
  MODIFY `TS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `d` FOREIGN KEY (`AD_CODE`) REFERENCES `admin` (`AD_CODE`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `gg` FOREIGN KEY (`EM_CODE`) REFERENCES `employee` (`EM_CODE`);

--
-- Constraints for table `transction`
--
ALTER TABLE `transction`
  ADD CONSTRAINT `df` FOREIGN KEY (`EM_CODE`) REFERENCES `employee` (`EM_CODE`),
  ADD CONSTRAINT `feee` FOREIGN KEY (`PD_BARCODE`) REFERENCES `products` (`PD_BARCODE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
