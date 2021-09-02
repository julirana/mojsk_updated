-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2021 at 02:21 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mojsk`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile_img` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `pan_no` varchar(20) DEFAULT NULL,
  `aadhar_no` varchar(20) DEFAULT NULL,
  `aadhar_img` varchar(100) DEFAULT NULL,
  `pan_img` varchar(100) DEFAULT NULL,
  `shop_img` varchar(100) DEFAULT NULL,
  `bank_passbook_img` varchar(100) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `password` longtext NOT NULL,
  `otp` int(11) DEFAULT NULL,
  `is_validated` int(11) NOT NULL,
  `created_dt` datetime DEFAULT NULL,
  `payment_amt` int(11) DEFAULT NULL,
  `payment_status` int(11) DEFAULT NULL,
  `payment_id` longtext DEFAULT NULL,
  `payment_dt` datetime DEFAULT NULL,
  `deactive_reason` longtext DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `f_name`, `l_name`, `email`, `profile_img`, `mobile`, `pan_no`, `aadhar_no`, `aadhar_img`, `pan_img`, `shop_img`, `bank_passbook_img`, `address`, `password`, `otp`, `is_validated`, `created_dt`, `payment_amt`, `payment_status`, `payment_id`, `payment_dt`, `deactive_reason`, `status`) VALUES
(1, 'Admin', 'Ranjan', 'admin@gmail.com', '', '7377262025', '', '', 'img_2.jpg', 'hero_bg_11.jpg', 'img_1.jpg', NULL, '', 'MTIzNA==', 257433, 1, '2021-08-04 12:07:25', 5000, 1, 'pay_Hh1bD8vtRmx8Zr', '2021-08-04 12:08:55', NULL, 1),
(4, 'soumya', 'ranjan', 'soumya101@gmail.com', 'IMG-20210812-WA0000_thumb.jpg', '09861214269', '', '', NULL, NULL, NULL, NULL, '', 'QmFieUAxOTc3', 137698, 1, '2021-08-07 15:58:57', 490, 1, 'pay_HkhPBknw75ObEn', '2021-08-13 18:59:40', '', 1),
(7, 'ziyaul', 'haque', 'ziyaulhaque78@gmail.com', 'Chrysanthemum_thumb.jpg', '7999860410', '', '', NULL, NULL, NULL, NULL, '', 'Mzg0MzIz', 174146, 1, '2021-08-07 16:32:04', 5000, 1, 'pay_HiIqOFPLRsjYfk', '2021-08-07 17:40:05', NULL, 1),
(8, 'akash', 'shukla', 'akashshukla9691@gmail.com', NULL, '9691455231', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'bmlnaHRmdXJ5OTY5MQ==', 216916, 1, '2021-08-07 16:32:25', 5000, 1, 'pay_HiIJQtJqdmGRyn', '2021-08-07 17:09:02', '', 1),
(9, 'ziyaul', 'haque', 'csc.milestone@gmail.com', NULL, '7999860410', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'bW9qc2s=', 412408, 0, '2021-08-07 16:35:02', 5000, 1, '852', '0000-00-00 00:00:00', NULL, 1),
(10, 'akash', 'milestone ', 'akash.milestone@gmail.com', NULL, '7999860410', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'bW9qc2s=', 507140, 0, '2021-08-07 16:41:05', 5000, 1, '852000bhjvugb', '0000-00-00 00:00:00', NULL, 1),
(11, 'raju14254125', '141', 'raju14254125@gmail.com', NULL, '9425869522', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'bW9qc2s=', 897150, 0, '2021-08-07 16:43:42', 53000, 1, '472000bhjvugb', '2021-09-01 08:32:23', NULL, 1),
(22, 'Naresh', 'Ranjan', 'nareshdipu00@gmail.com', 'Nareshranjan_Nayak_thumb.jpg', '7377262025', 'OR1234', '', NULL, NULL, NULL, NULL, '', 'TmFyZXNoQDA3', 698540, 1, '2021-08-12 23:37:20', 499, 0, NULL, NULL, NULL, 1),
(23, 'Anjan', 'joshi', 'anjanjoshi@gmail.com', 'Tulips_thumb.jpg', '9131200345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NzQ1MDk3', 936887, 1, '2021-08-13 15:36:30', 499, 0, NULL, NULL, NULL, 1),
(24, 'Anjan1', 'joshi', 'anjanjoshi1@gmail.com', NULL, '9131200345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YW5qYW5AMTIz', 424380, 0, '2021-08-13 15:52:52', NULL, 0, NULL, NULL, NULL, 1),
(25, 'Anjan1', 'joshi', 'anjanjoshi123456789@gmail.com', NULL, '9131200345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QW5qYW4xQA==', 559051, 0, '2021-08-13 15:54:44', NULL, 0, NULL, NULL, NULL, 1),
(26, 'BHUPENDRA', 'CHAUHAN', 'bhupendrakumarchauhan098@gmail.com', NULL, '7974123778', '', '', NULL, NULL, NULL, NULL, '', 'QkhVUEVORFJBQA==', 148391, 1, '2021-08-16 11:30:24', 490, 0, NULL, NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
