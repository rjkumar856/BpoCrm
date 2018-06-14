-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2018 at 10:38 AM
-- Server version: 5.6.39
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo_bpo`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_leads`
--

CREATE TABLE `add_leads` (
  `lead_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(200) NOT NULL,
  `middleName` varchar(200) NOT NULL DEFAULT '',
  `lastName` varchar(200) NOT NULL,
  `email` varchar(500) NOT NULL,
  `phoneNum` varchar(15) NOT NULL,
  `alterPhoneNum` varchar(15) NOT NULL DEFAULT '',
  `address1` varchar(500) NOT NULL,
  `address2` varchar(500) NOT NULL DEFAULT '',
  `city` varchar(200) NOT NULL DEFAULT '',
  `state` varchar(200) NOT NULL DEFAULT '',
  `country` varchar(200) NOT NULL DEFAULT '',
  `zipcode` varchar(10) NOT NULL DEFAULT '',
  `cus_pass_phrase` varchar(255) NOT NULL DEFAULT '',
  `customer_problem` text,
  `upload_doc` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(200) NOT NULL,
  `local_id` bigint(20) NOT NULL DEFAULT '0',
  `server_name` varchar(255) NOT NULL DEFAULT '',
  `modifiedBy` varchar(200) NOT NULL DEFAULT '',
  `ip_address` varchar(50) NOT NULL DEFAULT '',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_leads`
--

INSERT INTO `add_leads` (`lead_id`, `user_id`, `firstName`, `middleName`, `lastName`, `email`, `phoneNum`, `alterPhoneNum`, `address1`, `address2`, `city`, `state`, `country`, `zipcode`, `cus_pass_phrase`, `customer_problem`, `upload_doc`, `status`, `local_id`, `server_name`, `modifiedBy`, `ip_address`, `date_added`, `lastModified`) VALUES
(1, 5, 'Sameer', 'Kumar', 'Shahu', 'sameer@gmail.com', '8902361738', '9021763891', 'BTM', '2nd Satge', 'bangalore', 'karnataka', 'india', '560091', '', NULL, '', 'Y', 23, 'server3', '1', '180.151.35.7', '2018-05-23 11:24:40', '2018-05-23 11:24:40'),
(10, 2, 'Rajkumar', 'Kumar', 'Anbalagan', 'rjkumar856@gmail.com', '9092310791', '9952422729', 'Bommanahalli, HSR Layout\r\nHSR Layout', 'Bommanahalli, HSR Layout\r\nHSR Layout', '17', '9', '1', '560102', '', NULL, '', 'Y', 0, '', '2', '180.151.35.7', '2018-06-07 07:35:09', '2018-06-07 07:35:09'),
(4, 2, 'Rajku A', 'asdsa asMayank', 'Anbalagan', 'admin@admin.com', '9845369846', '9952422729', 'asdasd', 'sadsa', 'bangalore', 'karnataka', 'india', '560016', '', NULL, '', 'Y', 88, 'server3', '2', '180.151.35.7', '2018-05-23 11:24:40', '2018-05-23 11:24:40'),
(5, 1, 'Sameer', 'Kumar', 'Shahu', 'rjkumar856@gmail.com', '34353', '', '', '', 'Select Your City', 'Select Your State', 'Select Your Country', '', '', NULL, '', 'Y', 0, '', '1', '180.151.35.7', '2018-05-25 07:13:22', '2018-05-25 07:13:22'),
(6, 5, 'mkmmmmm', '', 'mkmmmkm', 'ds880760@gmail.com', '586952405', '', '', '', '10', '5', '3', '12232', '', NULL, '', 'Y', 0, '', '5', '203.122.14.50', '2018-05-25 19:02:52', '2018-05-25 19:02:52'),
(7, 5, 'Prakhar', '', 'Soni', 'prakharsonips02@gmail.com', '979991869', '', '#85/1, 19TH MAIN, 17TH CROSS, SECTOR 1,\r\nHSR LAYOUT, BANGALORE-56010', '', 'Select Your City', '5', '3', '', '', NULL, '', 'Y', 0, '', '5', '106.51.38.74', '2018-06-06 13:25:40', '2018-06-06 13:25:40'),
(8, 5, 'test', 'test', 'test1', 'test@gmail.com', '123456789', '', 'ghfhgfhgfhgfhg', '', '9', '5', '3', '07306', '', NULL, '', 'Y', 0, '', '5', '203.122.14.50', '2018-06-06 13:25:49', '2018-06-06 13:25:49'),
(11, 2, 'Rajkumar', 'Kumar', 'Anbalagan', 'rjkumar856@gmail.com', '9092310791', '9952422729', 'Bommanahalli, HSR Layout\r\nHSR Layout', 'Bommanahalli, HSR Layout\r\nHSR Layout', '17', '9', '1', '560102', '', NULL, '', 'Y', 0, '', '2', '180.151.35.7', '2018-06-07 07:37:26', '2018-06-07 07:37:26'),
(12, 2, 'Rajkumar', 'Kumar', 'Anbalagan', 'rjkumar856@gmail.com', '9092310791', '9952422729', 'Bommanahalli, HSR Layout\r\nHSR Layout', 'Bommanahalli, HSR Layout\r\nHSR Layout', '17', '9', '1', '560102', '', NULL, '', 'Y', 0, '', '2', '180.151.35.7', '2018-06-07 07:52:34', '2018-06-07 07:52:34'),
(13, 2, 'Rajkumar', 'Kumar', 'Anbalagan', 'rjkumar856@gmail.com', '9092310791', '9952422729', 'Bommanahalli, HSR Layout\r\nHSR Layout', 'Bommanahalli, HSR Layout\r\nHSR Layout', '17', '9', '1', '560102', '', NULL, '', 'Y', 0, '', '2', '180.151.35.7', '2018-06-07 08:02:13', '2018-06-07 08:02:13'),
(14, 2, 'Rajkumar', 'Kumar', 'Anbalagan', 'rjkumar856@gmail.com', '9092310791', '9952422729', 'Bommanahalli, HSR Layout\r\nHSR Layout', 'Bommanahalli, HSR Layout\r\nHSR Layout', '17', '9', '1', '560102', '', NULL, '', 'Y', 0, '', '2', '180.151.35.7', '2018-06-07 08:07:34', '2018-06-07 08:07:34'),
(15, 2, 'Rajkumar', 'Kumar', 'Anbalagan', 'rjkumar856@gmail.com', '9092310791', '9952422729', 'Bommanahalli, HSR Layout\r\nHSR Layout', 'Bommanahalli, HSR Layout\r\nHSR Layout', 'Select Your City', 'Select Your State', 'Select Your Country', '560102', '', NULL, '', 'Y', 0, '', '2', '180.151.35.7', '2018-06-07 08:08:08', '2018-06-07 08:08:08'),
(16, 2, 'Rajkumar', 'Kumar', 'Anbalagan', 'rjkumar856@gmail.com', '9092310791', '9952422729', 'Bommanahalli, HSR Layout\r\nHSR Layout', 'Bommanahalli, HSR Layout\r\nHSR Layout', '17', '9', '1', '560102', '', NULL, '', 'Y', 0, '', '2', '180.151.35.7', '2018-06-07 08:10:23', '2018-06-07 08:10:23'),
(17, 2, 'Rajkumar', 'Kumar', 'Anbalagan', 'rjkumar856@gmail.com', '9092310791', '9952422729', 'Bommanahalli, HSR Layout\r\nHSR Layout', 'Bommanahalli, HSR Layout\r\nHSR Layout', '17', '9', '1', '560102', 'rajkumar1', 'nothing', '15283658626359.xlsx', 'Y', 0, '', '2', '106.51.38.74', '2018-06-07 10:04:22', '2018-06-07 10:04:22');

-- --------------------------------------------------------

--
-- Table structure for table `add_sales`
--

CREATE TABLE `add_sales` (
  `id` int(11) NOT NULL,
  `lead_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` varchar(255) NOT NULL DEFAULT '0',
  `tenture` varchar(255) NOT NULL DEFAULT '0',
  `reff_number` varchar(255) NOT NULL,
  `ticket_number` varchar(255) NOT NULL,
  `status` set('Y','N','') DEFAULT 'Y',
  `local_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `server_name` varchar(255) NOT NULL DEFAULT '',
  `modified_by` varchar(50) NOT NULL DEFAULT '',
  `ip_address` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_sales`
--

INSERT INTO `add_sales` (`id`, `lead_id`, `user_id`, `total_amount`, `tenture`, `reff_number`, `ticket_number`, `status`, `local_id`, `server_name`, `modified_by`, `ip_address`, `date_added`, `last_modified`) VALUES
(1, 1, 5, '3000', '2 days', 'Ref_15264583595828', 'Tic_96391526458359', 'Y', 23, 'server3', '1', '180.151.35.7', '2018-05-23 11:24:40', '2018-05-23 16:54:40'),
(10, 10, 2, '4500', 'Payment Gateway', 'Ref_008966', 'Tic_000087480', 'Y', 0, '', '2', '180.151.35.7', '2018-06-07 07:35:09', '2018-06-07 13:05:09'),
(4, 4, 2, '6000', '12month', 'Ref_15270678288929', 'Tic_35071527067828', 'Y', 88, 'server3', '2', '180.151.35.7', '2018-05-23 11:24:40', '2018-05-23 16:54:40'),
(5, 5, 1, '', '', 'Ref_15272323843175', 'Tic_59151527232384', 'Y', 0, '', '1', '180.151.35.7', '2018-05-25 07:13:22', '2018-05-25 12:43:22'),
(6, 6, 5, '', '', 'Ref_15272748533742', 'Tic_57021527274853', 'Y', 0, '', '5', '203.122.14.50', '2018-05-25 19:02:52', '2018-05-26 00:32:52'),
(7, 7, 5, '', '', 'Ref_15282913972413', 'Tic_43221528291397', 'Y', 0, '', '5', '106.51.38.74', '2018-06-06 13:25:40', '2018-06-06 18:55:40'),
(8, 8, 5, '', '', 'Ref_15282913922523', 'Tic_87781528291392', 'Y', 0, '', '5', '203.122.14.50', '2018-06-06 13:25:49', '2018-06-06 18:55:49'),
(11, 11, 2, '4564', 'Payment Gateway', 'Ref_010575', 'Tic_000102389', 'Y', 0, '', '2', '180.151.35.7', '2018-06-07 07:37:26', '2018-06-07 13:07:26'),
(12, 12, 2, '4564', 'Payment Gateway', 'Ref_010575', 'Tic_000102389', 'Y', 0, '', '2', '180.151.35.7', '2018-06-07 07:52:34', '2018-06-07 13:22:34'),
(13, 14, 2, '', '', 'Ref_012589', 'Tic_000012804', 'Y', 0, '', '2', '180.151.35.7', '2018-06-07 08:07:34', '2018-06-07 13:37:34'),
(14, 15, 2, '', '', 'Ref_012589', 'Tic_000012804', 'Y', 0, '', '2', '180.151.35.7', '2018-06-07 08:08:08', '2018-06-07 13:38:08'),
(15, 16, 2, '5000', 'Payment Gateway', 'Ref_015577', 'Tic_000156604', 'Y', 0, '', '2', '180.151.35.7', '2018-06-07 08:10:23', '2018-06-07 13:40:23'),
(16, 17, 2, '600', 'Pending', 'Ref_016889', 'Tic_000166719', 'Y', 0, '', '2', '106.51.38.74', '2018-06-07 10:04:22', '2018-06-07 15:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `Id` int(11) NOT NULL,
  `summary` varchar(200) NOT NULL,
  `announcements` text NOT NULL,
  `publishDate` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `reserveId` int(11) NOT NULL DEFAULT '1',
  `userType` varchar(200) NOT NULL DEFAULT 'admin',
  `local_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `server_name` varchar(255) NOT NULL DEFAULT '',
  `modifiedBy` varchar(200) NOT NULL DEFAULT '1',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`Id`, `summary`, `announcements`, `publishDate`, `status`, `reserveId`, `userType`, `local_id`, `server_name`, `modifiedBy`, `createdAt`, `lastModified`) VALUES
(1, 'Team Lunch2', 'hi,On 20th, may 2018 there is a team lunch.All team members are invited for the lunch.thanks in advance,Head of Department.', '2018-05-19', 'Deactive', 1, 'admin', 6, 'server3', '1', '2018-05-23 11:24:13', '2018-05-23 11:24:13');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(3) NOT NULL,
  `state_id` int(3) NOT NULL,
  `city_name` varchar(35) NOT NULL,
  `local_id` bigint(20) NOT NULL DEFAULT '0',
  `server_name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `state_id`, `city_name`, `local_id`, `server_name`) VALUES
(1, 1, 'Surat', 0, ''),
(2, 1, 'Ahmedabad', 0, ''),
(3, 2, 'Pune', 0, ''),
(4, 2, 'Mumbai', 0, ''),
(5, 3, 'royston', 0, ''),
(6, 3, 'bedford', 0, ''),
(7, 4, 'Litherland', 0, ''),
(8, 4, 'ST. helens', 0, ''),
(9, 5, 'Abbeville', 0, ''),
(10, 5, 'Alpine', 0, ''),
(11, 6, 'Angoon', 0, ''),
(12, 6, 'Aniak', 0, ''),
(13, 7, 'Aprelevka', 0, ''),
(14, 7, 'Balashikha', 0, ''),
(15, 8, 'Lukhovitsy', 0, ''),
(16, 8, 'Lytkarino', 0, ''),
(17, 9, 'Bangalore', 0, ''),
(18, 9, 'Mysure', 0, ''),
(19, 9, 'Mangalore', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(3) NOT NULL,
  `country_name` varchar(25) NOT NULL,
  `local_id` bigint(20) NOT NULL DEFAULT '0',
  `server_name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`, `local_id`, `server_name`) VALUES
(1, 'India', 0, ''),
(2, 'United kingdom', 0, ''),
(3, 'United States', 0, ''),
(4, 'Russia', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `startEvent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `endEvent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reserveId` varchar(255) DEFAULT '',
  `userType` varchar(200) NOT NULL DEFAULT 'admin',
  `local_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `server_name` varchar(255) NOT NULL DEFAULT '',
  `modifiedBy` varchar(200) NOT NULL DEFAULT '1',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `startEvent`, `endEvent`, `reserveId`, `userType`, `local_id`, `server_name`, `modifiedBy`, `createdAt`, `lastModified`) VALUES
(1, 'sadsabcvbcv 5', '2018-08-01 05:30:25', '2018-08-02 02:52:00', '', 'admin', 11, 'server3', '1', '2018-05-23 11:25:21', '2018-06-07 10:10:54'),
(3, 'Test', '2018-06-06 01:46:00', '2018-06-07 00:47:00', '', 'admin', 0, '', '1', '2018-06-07 06:15:45', '2018-06-07 10:11:27'),
(7, 'Tee dvf Raj dfsdfdsfdsfds', '2018-06-07 08:25:14', '2018-06-07 08:25:14', '', 'admin', 0, '', '1', '2018-06-07 07:52:34', '2018-06-07 10:09:28'),
(8, 'Tee dvf Raj', '2018-06-08 09:05:32', '2018-06-08 09:05:32', '', 'admin', 0, '', '1', '2018-06-07 08:08:08', '2018-06-07 10:09:32'),
(10, 'meeting fsdfds dfdsf sfdsf dfdsf', '2018-06-09 10:25:48', '2018-06-09 10:25:48', '', 'admin', 0, '', '1', '2018-06-07 10:04:22', '2018-06-07 10:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `lead_allocation`
--

CREATE TABLE `lead_allocation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lead_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` set('open','close','') NOT NULL DEFAULT 'open',
  `allocated_by` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(40) NOT NULL,
  `local_id` bigint(20) NOT NULL DEFAULT '0',
  `server_name` varchar(255) NOT NULL DEFAULT '',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lead_allocation`
--

INSERT INTO `lead_allocation` (`id`, `lead_id`, `user_id`, `status`, `allocated_by`, `ip_address`, `local_id`, `server_name`, `date_added`, `date_modified`) VALUES
(1, 1, 6, 'open', 1, '180.151.35.7', 6, 'server3', '2018-05-23 11:25:30', '2018-05-23 11:25:30'),
(2, 12, 1, 'open', 1, '180.151.35.7', 7, 'server3', '2018-05-23 11:25:30', '2018-06-01 10:57:32');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `bg` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `logo`, `bg`) VALUES
(1, 'uploads/logo.png', 'uploads/2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rds`
--

CREATE TABLE `rds` (
  `id` int(11) NOT NULL,
  `lead_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rds_id` varchar(255) NOT NULL,
  `rds_pass` varchar(255) NOT NULL DEFAULT '0',
  `status` set('Y','N','') NOT NULL DEFAULT 'Y',
  `local_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `server_name` varchar(255) NOT NULL DEFAULT '',
  `modified_by` varchar(255) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rds`
--

INSERT INTO `rds` (`id`, `lead_id`, `user_id`, `rds_id`, `rds_pass`, `status`, `local_id`, `server_name`, `modified_by`, `ip_address`, `date_added`, `last_modified`) VALUES
(1, 1, 5, 'RDS_69031526458359', 'sameer test5', 'Y', 23, 'server3', '1', '180.151.35.7', '2018-05-23 11:24:40', '2018-05-23 11:24:40'),
(10, 10, 2, '', '', 'Y', 0, '', '2', '180.151.35.7', '2018-06-07 07:35:09', '2018-06-07 07:35:09'),
(11, 11, 2, '', '', 'Y', 0, '', '2', '180.151.35.7', '2018-06-07 07:37:26', '2018-06-07 07:37:26'),
(4, 4, 2, 'RDS_43801527067828', 'RDS Pass', 'Y', 88, 'server3', '2', '180.151.35.7', '2018-05-23 11:24:40', '2018-05-23 11:24:40'),
(5, 5, 1, 'RDS_61571527232384', '', 'Y', 0, '', '1', '180.151.35.7', '2018-05-25 07:13:22', '2018-05-25 07:13:22'),
(6, 6, 5, 'RDS_25521527274853', '', 'Y', 0, '', '5', '203.122.14.50', '2018-05-25 19:02:52', '2018-05-25 19:02:52'),
(7, 7, 5, 'RDS_96581528291397', '', 'Y', 0, '', '5', '106.51.38.74', '2018-06-06 13:25:40', '2018-06-06 13:25:40'),
(8, 8, 5, 'RDS_92001528291392', '', 'Y', 0, '', '5', '203.122.14.50', '2018-06-06 13:25:49', '2018-06-06 13:25:49'),
(12, 12, 2, '', '', 'Y', 0, '', '2', '180.151.35.7', '2018-06-07 07:52:34', '2018-06-07 07:52:34'),
(13, 14, 2, '', '', 'Y', 0, '', '2', '180.151.35.7', '2018-06-07 08:07:34', '2018-06-07 08:07:34'),
(14, 15, 2, '', '', 'Y', 0, '', '2', '180.151.35.7', '2018-06-07 08:08:08', '2018-06-07 08:08:08'),
(15, 16, 2, '15263724966717', 'rajkumar test', 'Y', 0, '', '2', '180.151.35.7', '2018-06-07 08:10:23', '2018-06-07 08:10:23'),
(16, 17, 2, '1', '2', 'Y', 0, '', '2', '106.51.38.74', '2018-06-07 10:04:22', '2018-06-07 10:04:22'),
(17, 17, 2, '3', '4', 'Y', 0, '', '2', '106.51.38.74', '2018-06-07 10:04:22', '2018-06-07 10:04:22'),
(18, 17, 2, '5', '6', 'Y', 0, '', '2', '106.51.38.74', '2018-06-07 10:04:22', '2018-06-07 10:04:22'),
(20, 17, 2, '9', '10', 'Y', 0, '', '2', '106.51.38.74', '2018-06-07 10:44:16', '2018-06-07 10:44:16');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(3) NOT NULL,
  `country_id` int(3) NOT NULL,
  `state_name` varchar(35) NOT NULL,
  `local_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `server_name` varchar(255) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `country_id`, `state_name`, `local_id`, `server_name`) VALUES
(1, 1, 'Gujarat', 0, ''),
(2, 1, 'Maharashtra', 0, ''),
(3, 2, 'Cambridge', 0, ''),
(4, 2, 'Liverpool', 0, ''),
(5, 3, 'Alabama', 0, ''),
(6, 3, 'Alaska', 0, ''),
(7, 4, 'Abakan', 0, ''),
(8, 4, 'Moscow', 0, ''),
(9, 1, 'Karnataka', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middel_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `cusEmail` varchar(255) NOT NULL,
  `email_status` varchar(40) NOT NULL DEFAULT 'YES',
  `cusPassword` varchar(255) NOT NULL,
  `profile_img` varchar(255) NOT NULL DEFAULT '',
  `phn` varchar(200) NOT NULL DEFAULT 'Y',
  `mobile` varchar(200) NOT NULL,
  `dob` date NOT NULL,
  `anniversary` date NOT NULL,
  `address1` text,
  `address2` varchar(255) DEFAULT '',
  `city` varchar(255) NOT NULL DEFAULT '',
  `state` varchar(255) NOT NULL DEFAULT '',
  `country` varchar(255) NOT NULL DEFAULT 'India',
  `pincode` varchar(50) NOT NULL DEFAULT '',
  `usertype` set('admin','normal','manager','agents','super-admin','l2-level') NOT NULL DEFAULT 'normal',
  `cusStatus` set('Y','N','') NOT NULL DEFAULT 'N',
  `local_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `server_name` varchar(255) NOT NULL DEFAULT '',
  `reserve_id` varchar(255) NOT NULL DEFAULT '',
  `ip_address` varchar(50) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `first_name`, `middel_name`, `last_name`, `cusEmail`, `email_status`, `cusPassword`, `profile_img`, `phn`, `mobile`, `dob`, `anniversary`, `address1`, `address2`, `city`, `state`, `country`, `pincode`, `usertype`, `cusStatus`, `local_id`, `server_name`, `reserve_id`, `ip_address`, `created_at`, `last_modified`) VALUES
(1, 'admin', 'Uriah Solution', '', 'Pvt Ltd', 'admin@admin.com', 'YES', '202cb962ac59075b964b07152d234b70', 'uploads/download.jpg', 'Y', '9092310791', '2000-02-12', '2018-01-31', 'HSR Layout', 'BTM', 'Bangalore', 'Karnataka', 'India', '', 'manager', 'Y', 1, 'server3', '1', '', '2017-12-11 18:30:00', '2018-05-23 06:55:13'),
(2, 'rjkumar856', 'Rjkumar1', '', 'Kumar', 'rjkumar856@gmail.com', 'YES', '202cb962ac59075b964b07152d234b70', 'uploads/1527136784.jpg', 'Y', '9799918691', '2018-05-18', '2018-05-11', 'Bommanahalli', 'HSR Layout', 'Bangalore', 'Karnataka', 'India', '', 'admin', 'Y', 2, 'server3', '3', '180.151.35.7', '2017-11-29 18:30:00', '2018-05-24 04:39:44'),
(5, 'rajakumar@uriahsolution.com', 'Rajakumar2', '', '', 'rajakumar@uriahsolution.com', 'NO', '202cb962ac59075b964b07152d234b70', 'uploads/_mg_3_0.jpg', 'Y', '9092310791', '0000-00-00', '0000-00-00', '', '', '', '', '', '', 'agents', 'Y', 5, 'server3', '2', '180.151.35.7', '2018-05-14 12:37:54', '2018-05-23 07:54:09'),
(6, 'srivastava.apra@gmail.com', 'Rajkumar', '', '', 'srivastava.apra@gmail.com', 'YES', '202cb962ac59075b964b07152d234b70', '', 'Y', '9092310791', '0000-00-00', '0000-00-00', '', '', '', '', '', '', 'l2-level', 'Y', 6, 'server3', '4', '180.151.35.7', '2018-05-14 13:25:36', '2018-05-23 13:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_image`
--

CREATE TABLE `user_image` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `userimage` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_image`
--

INSERT INTO `user_image` (`id`, `username`, `userimage`) VALUES
(1, 'sefdf', '2.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_leads`
--
ALTER TABLE `add_leads`
  ADD PRIMARY KEY (`lead_id`);

--
-- Indexes for table `add_sales`
--
ALTER TABLE `add_sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lead_id` (`lead_id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_allocation`
--
ALTER TABLE `lead_allocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rds`
--
ALTER TABLE `rds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_image`
--
ALTER TABLE `user_image`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_leads`
--
ALTER TABLE `add_leads`
  MODIFY `lead_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `add_sales`
--
ALTER TABLE `add_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lead_allocation`
--
ALTER TABLE `lead_allocation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rds`
--
ALTER TABLE `rds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_image`
--
ALTER TABLE `user_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
