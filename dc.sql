-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2021 at 01:41 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dc`
--
CREATE DATABASE IF NOT EXISTS `dc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `dc`;

-- --------------------------------------------------------

--
-- Table structure for table `tblboy`
--

DROP TABLE IF EXISTS `tblboy`;
CREATE TABLE `tblboy` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `cp` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `tblboy`
--

TRUNCATE TABLE `tblboy`;
--
-- Dumping data for table `tblboy`
--

INSERT INTO `tblboy` (`id`, `name`, `cp`, `created`) VALUES
(1, 1, '2', '2021-03-15 01:39:13'),
(2, 1, '4', '2021-03-15 01:39:13'),
(3, 2, '1', '2021-03-15 01:39:13'),
(4, 2, '3', '2021-03-15 01:39:13'),
(5, 1, '8', '2021-03-15 01:39:13'),
(6, 3, '2', '2021-03-15 01:39:13'),
(7, 3, '1', '2021-03-15 01:39:13'),
(8, 2, '2', '2021-03-15 01:39:13'),
(9, 1, '1', '2021-03-15 01:39:13');

-- --------------------------------------------------------

--
-- Table structure for table `tblitems`
--

DROP TABLE IF EXISTS `tblitems`;
CREATE TABLE `tblitems` (
  `id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `cprice` double NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `tblitems`
--

TRUNCATE TABLE `tblitems`;
--
-- Dumping data for table `tblitems`
--

INSERT INTO `tblitems` (`id`, `code`, `item`, `price`, `cprice`, `created`) VALUES
('1s', 'slim25', 'Slim', 25, 0, '2021-02-26 05:53:38'),
('2aa', 'slim25', 'Slim Small', 20, 0, '2021-02-26 05:53:38'),
('312', 'round25', 'Round Small', 20, 0, '2021-02-26 05:53:38'),
('4e', 'round25', 'Round', 25, 0, '2021-02-26 05:53:38'),
('6049a41578fb8', 'ck', 'cringkills', 2, 0, '2021-03-11 05:01:09'),
('604eab25d5f22', '', 'Slim + Container', 220, 0, '2021-03-15 00:32:37'),
('6051e5a1ab3de', '', 'PROMO! Slim with free Round Small', 30, 0, '2021-03-17 11:18:57');

-- --------------------------------------------------------

--
-- Table structure for table `tblorders`
--

DROP TABLE IF EXISTS `tblorders`;
CREATE TABLE `tblorders` (
  `id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  `part` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cp` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge` double NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `boy` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otw` tinyint(1) NOT NULL DEFAULT '0',
  `delivered` tinyint(1) NOT NULL DEFAULT '0',
  `cancelled` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `tblorders`
--

TRUNCATE TABLE `tblorders`;
--
-- Dumping data for table `tblorders`
--

INSERT INTO `tblorders` (`id`, `userid`, `time`, `part`, `customer`, `addr`, `cp`, `charge`, `paid`, `boy`, `otw`, `delivered`, `cancelled`, `created`) VALUES
('6051e3728dc58', '604cbc7002cc6', '2021-03-17 00:00:00', '', 'Angelo Cortuna', 'Santo Cristo', '0912345671', 240, 0, '', 0, 0, 0, '2021-03-17 11:09:38'),
('6051e3a4e8462', '603e7227df497', '2021-04-10 00:00:00', '', 'Cendy Grace Bechayda', 'San Vicente Tabaco City', '09512995498', 10, 0, '', 0, 0, 0, '2021-03-17 11:10:28'),
('6051e851d9430', '6051e80aa7419', '2021-03-17 00:00:00', '', 'Edward', 'Payahan Malinao Albay', '09953976965', 310, 0, '', 0, 0, 1, '2021-03-17 11:30:25'),
('6051ea2f5ab3a', '6051e80aa7419', '2021-03-17 00:00:00', '', 'Edward', 'Payahan Malinao Albay', '09953976965', 30, 0, '', 0, 0, 0, '2021-03-17 11:38:23'),
('6051ea61b406a', '3', '2021-03-17 00:00:00', '', 'Janet C. Benavente', 'P-5 Naga, Tiwi, Albay', '639301830281', 60, 0, '', 0, 0, 0, '2021-03-17 11:39:14'),
('6051ed6f1e7ff', '', '2021-03-17 00:00:00', '', 'Jeremie', 'Malinao', '18394020420', 265, 0, '', 0, 0, 0, '2021-03-17 11:52:15'),
('60575f1536a0f', '6055c85e9ae02', '2021-03-21 00:00:00', '', 'cendy grace', 'San Vicente', '09512995498', 25, 0, '', 0, 0, 1, '2021-03-21 14:58:29'),
('60575fdf65fcd', '6055c85e9ae02', '2021-03-21 00:00:00', '', 'Cendy Grace Bechayda', 'San Vicente', '09512995498', 25, 0, '', 0, 0, 0, '2021-03-21 15:01:51'),
('605760cc4badd', '3', '2021-03-02 00:00:00', '', 'Janet C. Benavente', 'P-5 Naga, Tiwi, Albay', '639301830281', 25, 0, '', 0, 0, 0, '2021-03-21 15:05:48'),
('605766b4c8c0d', '603e7227df497', '2021-03-26 00:00:00', '', 'Cendy Grace Bechayda', 'San Vicente Tabaco City', '09512995498', 20, 0, '', 0, 0, 0, '2021-03-21 15:31:00'),
('6057690c9669d', '', '0000-00-00 00:00:00', ' 1 round small,  2 slim', 'Ken', 'Panal, Tabaco City', ' 639637182256', 90, 0, '', 0, 0, 1, '2021-03-21 15:41:00'),
('605769f995242', '', '2021-03-21 23:41:00', ' 1 round small,  2 slim', 'Ken', 'Panal, Tabaco City', ' 639637182256', 90, 0, '', 0, 0, 0, '2021-03-21 15:44:57'),
('60576b163396f', '', '2021-03-21 23:44:39', ' 1 round small,  2 slim', 'Ken', 'Panal, Tabaco City', ' 639637182256', 90, 0, '', 0, 0, 1, '2021-03-21 15:49:42'),
('605b30a5bbfa6', '3', '2021-04-27 00:00:00', '', 'Janet C. Benavente', 'P-5 Naga, Tiwi, Albay', '639301830281', 20, 0, '', 0, 0, 0, '2021-03-24 12:29:26'),
('605d9cc247ba6', '605d9ca1e6844', '2021-03-26 00:00:00', '', 'Kennedy Borboran', 'Mariroc Tabaco City', '09659882257', 25, 0, '', 0, 0, 0, '2021-03-26 08:35:14'),
('605d9d317ed31', '605d9ca1e6844', '2021-03-26 00:00:00', '', 'Ken  Borboran', 'Mariroc Tabaco City', '09659882257', 25, 0, '', 0, 0, 0, '2021-03-26 08:37:05'),
('605d9d79c67fe', '605d9ca1e6844', '2021-03-26 00:00:00', '', 'Ken  Borboran', 'Mariroc Tabaco City', '09659882257', 25, 0, '', 0, 0, 0, '2021-03-26 08:38:17'),
('605d9ff7f0dfe', '', '2021-03-26 00:00:00', '', 'Cendy Grace Bechayda', 'San Vicente, Tabaco City', '09659882257', 25, 0, '', 0, 0, 0, '2021-03-26 08:48:56'),
('605da1a1d436a', '', '2021-03-26 00:00:00', '', 'Cendy Grace Bechayda', 'San Vicente, Tabaco City', '09659882257', 50, 0, '', 0, 0, 0, '2021-03-26 08:56:01'),
('605dc86be44e0', '', '2021-03-26 00:00:00', '', 'Cendy Grace Bechayda', 'San Vicente, Tabaco City', '09659882257', 50, 0, '', 0, 0, 0, '2021-03-26 11:41:32'),
('605dd9cb5e305', '605dd90753a56', '2021-03-26 00:00:00', '', 'Jeremie Samuel Candaza', 'Payahan Malinao Albay', '09123456789', 20, 0, '', 0, 0, 0, '2021-03-26 12:55:39'),
('605f28ecda9b7', '603f808b0b293', '2021-03-27 00:00:00', '', 'Ryan Alfons S. Lucson', 'Soa, Malinao, Albay', '09659884908', 25, 0, '', 0, 0, 0, '2021-03-27 12:45:32'),
('605f2a7b985d2', '', '2021-03-27 00:00:00', '', 'John', 'San Vicente, Tabaco City', '09659882257', 25, 0, '', 0, 0, 0, '2021-03-27 12:52:11'),
('605f45c547957', '605f40148aa0f', '2021-03-27 00:00:00', '', 'Ken Borboran', 'Mariroc, Tabaco City', '09512995498', 220, 0, '', 0, 0, 0, '2021-03-27 14:48:37'),
('60608cdb2b4b8', '603e7227df497', '2021-03-28 22:04:11', ' 1 Slim', 'Cendy ', 'San Vicente, Tabaco City', ' 639659884908', 30, 0, '', 0, 0, 0, '2021-03-28 14:04:11'),
('6061cd2e7e768', '', '2021-03-29 00:00:00', '', 'yhen', 'p-3 ginobat tabaco city', '09666098993', 280, 0, '', 0, 0, 0, '2021-03-29 12:50:54'),
('60642b5a8bdfd', '603e7227df497', '2021-04-12 00:00:00', '', 'Jessa Bendal', 'Z-7 Fatima, Tabaco City', '09512995498', 50, 0, '', 0, 0, 0, '2021-03-31 07:57:14'),
('606747183a059', '605f40148aa0f', '2021-04-03 00:00:00', '', 'khen borboran', 'panal tabaco city', '09888098978', 240, 0, '', 0, 0, 1, '2021-04-02 16:32:24'),
('60680749e2dea', '603e7227df497', '2021-04-05 00:00:00', '', 'Cendy Grace Bechayda', 'San Vicente, Tabaco City', '09512995498', 50, 0, '', 0, 0, 1, '2021-04-03 06:12:26'),
('60680a416abeb', '', '2021-04-03 00:00:00', '', 'John Botalon', 'San Vicente, Tabaco City', '09659882257', 465, 0, '', 0, 0, 0, '2021-04-03 06:25:05'),
('60680ba6301b8', '60680afd8e47c', '2021-04-03 00:00:00', '', 'Jerry Candaza', 'Malinao, Albay', '09512995498', 100, 0, '', 0, 0, 0, '2021-04-03 06:31:02'),
('606811ee00e70', '603e7227df497', '2021-04-03 00:00:00', '', 'Cendy Grace Bechayda', 'San Vicente, Tabaco City', '09512995498', 440, 0, '', 0, 0, 1, '2021-04-03 06:57:50'),
('6068b4621bdef', '604cca1e18bcc', '0000-00-00 00:00:00', '3 round', 'test', 'tabaco', '09123456789', 90, 0, '', 0, 0, 0, '2021-04-03 18:30:59'),
('6068beff394b7', '604cca1e18bcc', '0000-00-00 00:00:00', '3 round', 'test', 'tabaco', '09123456789', 75, 0, '', 0, 0, 0, '2021-04-03 19:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_items`
--

DROP TABLE IF EXISTS `tblorder_items`;
CREATE TABLE `tblorder_items` (
  `id` int(11) NOT NULL,
  `orderid` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `itemid` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` double NOT NULL,
  `fromsched` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `tblorder_items`
--

TRUNCATE TABLE `tblorder_items`;
--
-- Dumping data for table `tblorder_items`
--

INSERT INTO `tblorder_items` (`id`, `orderid`, `itemid`, `qty`, `fromsched`) VALUES
(1, '6051e3728dc58', '604eab25d5f22', 1, 0),
(2, '6051e3728dc58', '312', 1, 0),
(3, '6051e3a4e8462', '6049a41578fb8', 5, 0),
(4, '6051e851d9430', '2aa', 1, 0),
(5, '6051e851d9430', '604eab25d5f22', 1, 0),
(6, '6051e851d9430', '1s', 1, 0),
(7, '6051e851d9430', '312', 1, 0),
(8, '6051e851d9430', '4e', 1, 0),
(9, '6051ea2f5ab3a', '6051e5a1ab3de', 1, 0),
(10, '6051ea61b406a', '2aa', 2, 0),
(11, '6051ea61b406a', '312', 1, 0),
(12, '6051ea8fab5f8', '2aa', 0, 0),
(13, '6051ea8fab5f8', '604eab25d5f22', 1, 0),
(14, '6051ea8fab5f8', '1s', 1, 0),
(15, '6051ea8fab5f8', '312', 1, 0),
(16, '6051ea8fab5f8', '4e', 1, 0),
(17, '6051ea8fab5f8', '6051e5a1ab3de', 1, 0),
(18, '6051ea8fab5f8', '6049a41578fb8', 1, 0),
(19, '6051eb681edaa', '6049a41578fb8', 1, 0),
(20, '6051ed6f1e7ff', '2aa', 1, 0),
(21, '6051ed6f1e7ff', '604eab25d5f22', 1, 0),
(22, '6051ed6f1e7ff', '1s', 1, 0),
(23, '60522dc15e505', '6051e5a1ab3de', 0, 0),
(24, '60522de107e4d', '6051e5a1ab3de', 1, 0),
(25, '60523237e120a', '6051e5a1ab3de', 1, 0),
(26, '6054bad8bb92c', '6051e5a1ab3de', 1, 0),
(27, '6054bad8e6d96', '6051e5a1ab3de', 0, 0),
(28, '6056331c411f3', '604eab25d5f22', 1, 0),
(29, '6056331c411f3', '6051e5a1ab3de', 1, 0),
(30, '60575f1536a0f', '4e', 1, 0),
(31, '60575fdf65fcd', '4e', 1, 0),
(32, '605760cc4badd', '4e', 1, 0),
(33, '605766b4c8c0d', '312', 1, 0),
(34, '6057690c9669d', '6051e5a1ab3de', 1, 0),
(35, '6057690c9669d', '6051e5a1ab3de', 2, 0),
(36, '605769f995242', '6051e5a1ab3de', 1, 0),
(37, '605769f995242', '6051e5a1ab3de', 2, 0),
(38, '60576b163396f', '6051e5a1ab3de', 1, 0),
(39, '60576b163396f', '6051e5a1ab3de', 2, 0),
(40, '605b30a5bbfa6', '312', 1, 0),
(41, '605d9cc247ba6', '4e', 1, 0),
(42, '605d9d317ed31', '4e', 1, 0),
(43, '605d9d79c67fe', '4e', 1, 0),
(44, '605d9df4aa1d4', '4e', 1, 1),
(45, '605d9ff7f0dfe', '4e', 1, 0),
(46, '605da1a1d436a', '4e', 2, 0),
(47, '605dc7d18d706', '2aa', 1, 0),
(48, '605dc7d18d706', '604eab25d5f22', 1, 0),
(49, '605dc7d18d706', '1s', 1, 0),
(50, '605dc7d18d706', '312', 1, 0),
(51, '605dc7d18d706', '4e', 2, 0),
(52, '605dc7d18d706', '6051e5a1ab3de', 1, 0),
(53, '605dc7d18d706', '6049a41578fb8', 1, 0),
(54, '605dc86be44e0', '1s', 1, 0),
(55, '605dc86be44e0', '4e', 1, 0),
(56, '605dcf4acaff9', '2aa', 1, 0),
(57, '605dcf4acaff9', '604eab25d5f22', 1, 0),
(58, '605dcf4acaff9', '1s', 1, 0),
(59, '605dcf4acaff9', '312', 1, 0),
(60, '605dcf4acaff9', '4e', 1, 0),
(61, '605dcf4acaff9', '6051e5a1ab3de', 1, 0),
(62, '605dcf4acaff9', '6049a41578fb8', 1, 0),
(63, '605dcfca41e0f', '2aa', 1, 0),
(64, '605dcfca41e0f', '604eab25d5f22', 1, 0),
(65, '605dcfca41e0f', '1s', 1, 0),
(66, '605dcfca41e0f', '312', 1, 0),
(67, '605dcfca41e0f', '4e', 1, 0),
(68, '605dcfca41e0f', '6051e5a1ab3de', 1, 0),
(69, '605dcfca41e0f', '6049a41578fb8', 1, 0),
(70, '605dd9cb5e305', '2aa', 1, 0),
(71, '605e060a5b1d0', '6051e5a1ab3de', 1, 1),
(72, '605f28ecda9b7', '1s', 1, 0),
(73, '605f2a7b985d2', '4e', 1, 0),
(74, '605f45c547957', '604eab25d5f22', 1, 0),
(75, '60608cdb2b4b8', '6051e5a1ab3de', 1, 0),
(76, '6061bec29c5b1', '2aa', 1, 0),
(77, '6061bec29c5b1', '604eab25d5f22', 3, 0),
(78, '6061bec29c5b1', '1s', 2, 0),
(79, '6061bec29c5b1', '312', 1, 0),
(80, '6061c17d8e151', '604eab25d5f22', 1, 0),
(81, '6061c17d8e151', '1s', 1, 0),
(82, '6061cd2e7e768', '2aa', 3, 0),
(83, '6061cd2e7e768', '604eab25d5f22', 1, 0),
(84, '60642b5a8bdfd', '1s', 1, 0),
(85, '60642b5a8bdfd', '4e', 1, 0),
(86, '606487a2538dd', '2aa', 1, 1),
(87, '606487a2538dd', '1s', 1, 1),
(88, '606747183a059', '2aa', 1, 0),
(89, '606747183a059', '604eab25d5f22', 1, 0),
(90, '60680749e2dea', '4e', 2, 0),
(91, '60680a416abeb', '604eab25d5f22', 2, 0),
(92, '60680a416abeb', '1s', 1, 0),
(93, '60680ba6301b8', '1s', 4, 0),
(94, '606811ee00e70', '604eab25d5f22', 2, 0),
(95, '6068b4621bdef', '6051e5a1ab3de', 3, 0),
(96, '6068beff394b7', '4e', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblsched`
--

DROP TABLE IF EXISTS `tblsched`;
CREATE TABLE `tblsched` (
  `id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sched` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `part` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cp` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge` double NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `delivered` tinyint(1) NOT NULL DEFAULT '0',
  `cancelled` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `tblsched`
--

TRUNCATE TABLE `tblsched`;
-- --------------------------------------------------------

--
-- Table structure for table `tblsms`
--

DROP TABLE IF EXISTS `tblsms`;
CREATE TABLE `tblsms` (
  `id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id2` bigint(20) NOT NULL,
  `cp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `_out` tinyint(1) NOT NULL,
  `msg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hash` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `tblsms`
--

TRUNCATE TABLE `tblsms`;
--
-- Dumping data for table `tblsms`
--

INSERT INTO `tblsms` (`id`, `id2`, `cp`, `_out`, `msg`, `stime`, `hash`, `status`, `created`) VALUES
('605774a097c15', 0, 'SMARTLoad', 0, 'Tuloy ang Saya! May Unli Trinet Calls and Texts + 50 Allnet Texts ka na for 2 days with UTP 15.', '2021-03-17 13:55:39', 'dfef0109fa3d52f7ca5b80b5dd523d55', 0, '2021-03-21 16:30:24'),
('605774a0aa774', 0, 'SMARTLoad', 0, 'Para i-check ang balance at latest promos, dial *123# or it`s SIMPLER with the NEW GigaLife App! http://onelink.to/GigaLifeApp', '2021-03-17 13:55:38', 'e6213157e05df3a6f394e90404eb72c9', 0, '2021-03-21 16:30:24'),
('60608c553c614', 0, ' 639659884908', 0, ' Cendy @San Vicente, Tabaco City, Slim 1', '2021-03-28 22:01:54', '327f25fc185a7c5febec25b3ad112c9c', 0, '2021-03-28 14:01:57'),
('60608cdb13294', 0, ' 639659884908', 0, ' Cendy @San Vicente, Tabaco City; Slim, 1', '2021-03-28 22:04:11', '41e26c196d6c57adc60e1001d43fecbb', 0, '2021-03-28 14:04:11'),
('60608cfbaa500', 0, ' 639659884908', 0, ' Cendy@San Vicente, Tabaco City, Slim 1', '2021-03-28 22:04:43', '0ab63c3d9d7d08b6eb0db3213a97063b', 0, '2021-03-28 14:04:43'),
('6061bec2adea3', 0, '09344676879808', 1, 'Order has been created with the total amount of P750. -(DC Water Refilling Station)', '2021-03-29 00:00:00', '', 0, '2021-03-29 11:49:22'),
('6061c17da330c', 0, '12345678902', 1, 'Order has been created with the total amount of P245. -(DC Water Refilling Station)', '2021-03-29 00:00:00', '', 0, '2021-03-29 12:01:01'),
('6061cd2e8eb39', 0, '09666098993', 1, 'Order has been created with the total amount of P280. -(DC Water Refilling Station)', '2021-03-29 00:00:00', '', 0, '2021-03-29 12:50:54'),
('606426924406c', 0, ' 639659884908', 1, 'Good day Cendy , Your order(s) are on its way. Please prepare a total amount of P30.00. Thank you. -(DC Water Refilling Station)', '2021-03-28 00:00:00', '', 0, '2021-03-31 07:36:50'),
('6064269ad26e6', 0, ' 639659884908', 1, 'Good day Cendy , Your order(s) are on its way. Please prepare a total amount of P30.00. Thank you. -(DC Water Refilling Station)', '2021-03-28 00:00:00', '', 0, '2021-03-31 07:36:58'),
('60642702bb6a1', 0, ' 639659884908', 1, 'Good day Cendy , Your order(s) are on its way. Please prepare a total amount of P30.00. Thank you. -(DC Water Refilling Station)', '2021-03-28 00:00:00', '', 0, '2021-03-31 07:38:42'),
('60642b5a955ce', 0, '09512995498', 1, 'Order has been created with the total amount of P50. -(DC Water Refilling Station)', '2021-03-31 00:00:00', '', 0, '2021-03-31 07:57:14'),
('606487a2d8fe3', 0, '639301830281', 1, 'Order has been created with the total amount of P45. -(DC Water Refilling Station)', '2021-03-31 00:00:00', '', 0, '2021-03-31 14:30:58'),
('60674660e363e', 0, '09512995498', 1, 'Good day Jessa Bendal, Your order(s) are on its way. Please prepare a total amount of P50.00. Thank you. -(DC Water Refilling Station)', '2021-03-31 00:00:00', '', 0, '2021-04-02 16:29:20'),
('60674661e3fde', 0, '09512995498', 1, 'Good day Jessa Bendal, Your order(s) are on its way. Please prepare a total amount of P50.00. Thank you. -(DC Water Refilling Station)', '2021-03-31 00:00:00', '', 0, '2021-04-02 16:29:21'),
('606746621d00c', 0, '09512995498', 1, 'Good day Jessa Bendal, Your order(s) are on its way. Please prepare a total amount of P50.00. Thank you. -(DC Water Refilling Station)', '2021-03-31 00:00:00', '', 0, '2021-04-02 16:29:22'),
('60674718418a0', 0, '09888098978', 1, 'Order has been created with the total amount of P240. -(DC Water Refilling Station)', '2021-04-03 00:00:00', '', 0, '2021-04-02 16:32:24'),
('6068074a08f6b', 0, '09512995498', 1, 'Order has been created with the total amount of P50. -(DC Water Refilling Station)', '2021-04-03 00:00:00', '', 0, '2021-04-03 06:12:26'),
('60680a41717c6', 0, '09659882257', 1, 'Order has been created with the total amount of P465. -(DC Water Refilling Station)', '2021-04-03 00:00:00', '', 0, '2021-04-03 06:25:05'),
('60680ba638f28', 0, '09512995498', 1, 'Order has been created with the total amount of P100. -(DC Water Refilling Station)', '2021-04-03 00:00:00', '', 0, '2021-04-03 06:31:02'),
('606811ee13a21', 0, '09512995498', 1, 'Order has been created with the total amount of P440. -(DC Water Refilling Station)', '2021-04-03 00:00:00', '', 0, '2021-04-03 06:57:50');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

DROP TABLE IF EXISTS `tblusers`;
CREATE TABLE `tblusers` (
  `id` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  `fname` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `contact` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `banned` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Truncate table before insert `tblusers`
--

TRUNCATE TABLE `tblusers`;
--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `username`, `password`, `level`, `fname`, `address`, `gender`, `contact`, `email`, `banned`, `created`) VALUES
('3', 'jha', 'a245952731e7665b9f023e935c748c78', 1, 'Janet C. Benavente', 'P-5 Naga, Tiwi, Albay', '', '639301830281', '', 0, '2021-02-26 07:03:08'),
('5e43b79b49bcd', 'admin', 'f7b3f34f35f3da121561bb28632e78a7', 3, 'Administrator', 'Admin', '', '639317638754', '', 0, '2017-07-16 07:56:19'),
('603e7227df497', 'cendy', '2cc8bc39854b68e3bfa33d751b314898', 1, 'Cendy Grace Bechayda', 'San Vicente, Tabaco City', '', '09512995498', '', 0, '2021-03-02 17:13:11'),
('603f808b0b293', 'rycen', 'a245952731e7665b9f023e935c748c78', 1, 'Ryan Alfons S. Lucson', 'Soa, Malinao, Albay', '', '09659884908', 'yanzlucson@gmail.com', 0, '2021-03-03 12:26:51'),
('604cbc7002cc6', 'angelo', 'a245952731e7665b9f023e935c748c78', 1, 'Angelo Cortuna', 'Santo Cristo', '', '0912345671', '09512995498', 0, '2021-03-13 13:21:52'),
('604cca1e18bcc', 'test', 'a245952731e7665b9f023e935c748c78', 1, 'tests', 'test', '', '09', '', 0, '2021-03-13 14:20:14'),
('6051e80aa7419', 'Tham', 'a245952731e7665b9f023e935c748c78', 1, 'Jeremie Samuel Candaz', 'Payahan Malinao Albay', '', '09123456789', 'Samycandaza15@gmail.com', 0, '2021-03-17 11:29:14'),
('6055c85e9ae02', 'Sky', 'a245952731e7665b9f023e935c748c78', 1, 'Cendy Grace Bechayda', 'San Vicente', '', '09512995498', 'cendygracebechayda@gmail.com', 0, '2021-03-20 10:03:10'),
('60562128638c0', 'dev', 'a245952731e7665b9f023e935c748c78', 1, 'Dev', 'Tabaco', '', '09637182256', '', 0, '2021-03-20 16:22:00'),
('605d9ca1e6844', 'ken', '3ca1f977b26bb087946bd26e89ee582c', 1, 'Kennedy Borboran', 'Mariroc Tabaco City', '', '09659882257', '', 0, '2021-03-26 08:34:41'),
('605dbc0eee00a', 'Grace', '68727d15820a0c2ebc29636a8ba6d666', 1, 'Grace bechayda', 'San Vicente, Tabaco City', '', '09512995498', '', 0, '2021-03-26 10:48:46'),
('605dcd07baf9a', 'Leony', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'Leony balaoro', 'Malinao', '', '0906666666666666666', '', 0, '2021-03-26 12:01:11'),
('605dd90753a56', 'Jersam', '202cb962ac59075b964b07152d234b70', 1, 'Jeremie Samuel Candaza', 'Payahan Malinao Albay', '', '09123456789', '', 0, '2021-03-26 12:52:23'),
('605ddab99e721', 'Jeremie!', '202cb962ac59075b964b07152d234b70', 1, 'Aidiwkxpwodisj', 'Mirasol P7, Payahan', '', '4512', '', 1, '2021-03-26 12:59:37'),
('605f40148aa0f', 'kenken', 'cab24f46fdb69cab06d4b606fe32eccd', 1, 'khen borboran', 'panal tabaco city', '', '09888098978', '', 0, '2021-03-27 14:24:20'),
('605f462c23918', 'jem', 'a245952731e7665b9f023e935c748c78', 1, 'Jeremie Candaza', 'Malinao, Albay', '', '09659882257', '', 0, '2021-03-27 14:50:20'),
('6061c13b3eb94', 'win', '254764ba857b07f2ff999930a7fbd03c', 1, 'winskie borbo', 'santo cristo t.c', '', '12345678902', '', 0, '2021-03-29 11:59:55'),
('60641792aa41d', 'Tham15', 'b5efc0b8b1d08f3335a068598e97cc61', 1, 'Jeremie Samuel Candaza', 'Mirasol P7, Payahan', '', '4512', '', 1, '2021-03-31 06:32:50'),
('60680afd8e47c', 'Jerry', 'a245952731e7665b9f023e935c748c78', 1, 'Jerry Candaza', 'Malinao, Albay', '', '09512995498', '', 1, '2021-04-03 06:28:13'),
('60680b645133b', 'Sam', 'b5efc0b8b1d08f3335a068598e97cc61', 1, '', 'Mirasol P7, Payahan', '', '4512', 'Agakdabc', 0, '2021-04-03 06:29:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblboy`
--
ALTER TABLE `tblboy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblitems`
--
ALTER TABLE `tblitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblorders`
--
ALTER TABLE `tblorders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblorder_items`
--
ALTER TABLE `tblorder_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsched`
--
ALTER TABLE `tblsched`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsms`
--
ALTER TABLE `tblsms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblboy`
--
ALTER TABLE `tblboy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblorder_items`
--
ALTER TABLE `tblorder_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
