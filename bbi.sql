-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 12, 2023 at 01:20 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbi`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_audit`
--

DROP TABLE IF EXISTS `action_audit`;
CREATE TABLE IF NOT EXISTS `action_audit` (
  `aa_id` int(11) NOT NULL AUTO_INCREMENT,
  `moderator` int(11) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  `table_name` varchar(100) DEFAULT NULL,
  `condition_statement` varchar(100) DEFAULT NULL,
  `affected_row` int(11) DEFAULT NULL,
  `transactionid` varchar(56) DEFAULT NULL,
  `transaction_time` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`aa_id`)
) ENGINE=MyISAM AUTO_INCREMENT=384 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `action_audit`
--

INSERT INTO `action_audit` (`aa_id`, `moderator`, `action`, `table_name`, `condition_statement`, `affected_row`, `transactionid`, `transaction_time`) VALUES
(1, 0, 'Insert', 'user_failwer_login_attempt', 'Insertid-3', 1, 'cMnD2D', '2023-04-13 10:40:09'),
(2, 0, 'Insert', 'user_failwer_login_attempt', 'Insertid-4', 1, 'CUedre', '2023-04-13 10:40:36'),
(3, 0, 'Insert', 'user_log_history', 'Insertid-12', 1, 'w72HQG', '2023-04-13 10:40:46'),
(4, 0, 'Insert', 'user_failwer_login_attempt', 'Insertid-5', 1, 'TwVca4', '2023-04-13 17:55:14'),
(5, 0, 'Insert', 'user_log_history', 'Insertid-13', 1, '3TKRRb', '2023-04-13 17:55:31'),
(6, 1, 'Insert', 'user_detail', 'Insertid-3', 1, 'p1Y6LL', '2023-04-13 18:20:34'),
(7, 1, 'Insert', 'ibo_user', 'Insertid-2', 1, 'p1Y6LL', '2023-04-13 18:20:34'),
(8, 1, 'Insert', 'user_detail', 'Insertid-4', 1, 'rteUcM', '2023-04-13 18:25:03'),
(9, 1, 'Insert', 'ibo_user', 'Insertid-3', 1, 'rteUcM', '2023-04-13 18:25:03'),
(10, 1, 'Insert', 'user_detail', 'Insertid-5', 1, 'dffRAU', '2023-04-13 18:25:15'),
(11, 1, 'Insert', 'ibo_user', 'Insertid-4', 1, 'dffRAU', '2023-04-13 18:25:15'),
(12, 1, 'Update', 'user_detail', 'id_user/5()', 1, 'dffRAU', '2023-04-13 18:25:15'),
(13, 1, 'Insert', 'user_detail', 'Insertid-6', 1, 'BVPBdV', '2023-04-13 18:26:41'),
(14, 1, 'Insert', 'ibo_user', 'Insertid-5', 1, 'BVPBdV', '2023-04-13 18:26:41'),
(15, 1, 'Update', 'user_detail', 'id_user/6()', 1, 'BVPBdV', '2023-04-13 18:26:41'),
(16, 1, 'Insert', 'ibo_sponsor_position', 'Insertid-1', 1, 'BVPBdV', '2023-04-13 18:26:41'),
(17, 1, 'Update', 'user_detail', 'id_user/6()', 1, 'cL29VP', '2023-04-13 18:31:52'),
(18, 1, 'Update', 'user_detail', 'id_user/6()', 1, 'eFHMH1', '2023-04-13 18:31:56'),
(19, 1, 'Update', 'user_detail', 'id_user/6()', 0, 'qEaXpV', '2023-04-13 18:36:33'),
(20, 1, 'Update', 'user_detail', 'id_user/6()', 0, '23aRaC', '2023-04-13 18:36:37'),
(21, 1, 'Update', 'user_detail', 'id_user/6()', 0, 'Km55NW', '2023-04-13 18:36:40'),
(22, 1, 'Update', 'user_detail', 'id_user/6()', 0, 'J1Lh62', '2023-04-13 18:36:43'),
(23, 1, 'Update', 'user_detail', 'id_user/6()', 1, '3EDNn6', '2023-04-13 18:37:25'),
(24, 1, 'Update', 'user_detail', 'id_user/6()', 1, 'pu3ALW', '2023-04-13 18:38:01'),
(25, 0, 'Insert', 'user_failwer_login_attempt', 'Insertid-6', 1, '1Qd8K3', '2023-04-14 01:58:43'),
(26, 0, 'Insert', 'user_log_history', 'Insertid-14', 1, 'ACFU7u', '2023-04-14 01:59:04'),
(27, 0, 'Insert', 'user_failwer_login_attempt', 'Insertid-7', 1, 'VA2erq', '2023-04-14 05:24:45'),
(28, 0, 'Insert', 'user_log_history', 'Insertid-15', 1, 'XEbLXA', '2023-04-14 05:25:01'),
(29, 1, 'Update', 'location_module', 'lm_id/1()', 1, 'rBAXRa', '2023-04-14 06:17:30'),
(30, 1, 'Update', 'location_module', 'lm_id/1()', 1, 'naFcYW', '2023-04-14 06:17:53'),
(31, 0, 'Insert', 'user_log_history', 'Insertid-16', 1, '8QY9qR', '2023-04-14 11:00:50'),
(32, 1, 'Insert', 'location_module', 'Insertid-2', 1, 'p215X1', '2023-04-14 12:10:50'),
(33, 1, 'Update', 'location_module', 'lm_id/2()', 1, 'p215X1', '2023-04-14 12:10:50'),
(34, 1, 'Update', 'location_module', 'lm_id/2()', 0, '62gpgg', '2023-04-14 12:53:53'),
(35, 1, 'Update', 'location_module', 'lm_id/2()', 1, 'ru753c', '2023-04-14 13:13:03'),
(36, 1, 'Update', 'location_module', 'lm_id/2()', 1, 'rDJGgu', '2023-04-14 13:13:09'),
(37, 1, 'Insert', 'module_position_audit', 'Insertid-1', 1, 'W9QJL4', '2023-04-14 15:28:06'),
(38, 1, 'Update', 'location_module', 'lm_id/2()', 1, 'W9QJL4', '2023-04-14 15:28:06'),
(39, 1, 'Update', 'location_module', 'lm_id/2()', 1, 'LaXcbM', '2023-04-14 15:39:22'),
(40, 1, 'Update', 'location_module', 'lm_id/2()', 1, 'A362AK', '2023-04-14 15:45:25'),
(41, 1, 'Update', 'location_module', 'lm_id/2()', 1, 'WYUe3q', '2023-04-14 15:45:39'),
(42, 1, 'Insert', 'module_position_audit', 'Insertid-1', 1, 'dLbe6u', '2023-04-14 15:49:34'),
(43, 1, 'Update', 'location_module', 'lm_id/2()', 1, 'dLbe6u', '2023-04-14 15:49:34'),
(44, 1, 'Update', 'location_module', 'lm_id/2()', 1, 'LhdUUV', '2023-04-14 15:50:21'),
(45, 1, 'Insert', 'module_position_audit', 'Insertid-1', 1, '1heCPt', '2023-04-14 15:59:12'),
(46, 1, 'Update', 'location_module', 'lm_id/2()', 1, '1heCPt', '2023-04-14 15:59:12'),
(47, 1, 'Insert', 'module_position_audit', 'Insertid-2', 1, 'NYDXH4', '2023-04-14 15:59:44'),
(48, 1, 'Update', 'location_module', 'lm_id/2()', 1, 'NYDXH4', '2023-04-14 15:59:44'),
(49, 1, 'Insert', 'module_position_audit', 'Insertid-3', 1, 'paQnmK', '2023-04-14 16:01:58'),
(50, 1, 'Update', 'location_module', 'lm_id/2()', 1, 'paQnmK', '2023-04-14 16:01:58'),
(51, 1, 'Insert', 'module_position_audit', 'Insertid-1', 1, 'waQMMc', '2023-04-14 16:26:33'),
(52, 1, 'Update', 'location_module', 'lm_id/2()', 1, 'waQMMc', '2023-04-14 16:26:33'),
(53, 1, 'Insert', 'module_position_audit', 'Insertid-2', 1, 'PfuYVV', '2023-04-14 16:27:04'),
(54, 1, 'Update', 'location_module', 'lm_id/2()', 1, 'PfuYVV', '2023-04-14 16:27:04'),
(55, 1, 'Insert', 'module_position_audit', 'Insertid-3', 1, 'CWPwUY', '2023-04-14 16:29:19'),
(56, 1, 'Update', 'location_module', 'lm_id/2()', 1, 'CWPwUY', '2023-04-14 16:29:19'),
(57, 1, 'Insert', 'module_position_audit', 'Insertid-4', 1, 'L4T7uc', '2023-04-14 16:30:43'),
(58, 1, 'Update', 'location_module', 'lm_id/2()', 1, 'L4T7uc', '2023-04-14 16:30:43'),
(59, 1, 'Insert', 'module_position_audit', 'Insertid-1', 1, 'FB4TRf', '2023-04-14 16:31:55'),
(60, 1, 'Update', 'location_module', 'lm_id/2()', 1, 'FB4TRf', '2023-04-14 16:31:55'),
(61, 1, 'Insert', 'module_position_audit', 'Insertid-2', 1, 'Y2C4W1', '2023-04-14 16:32:24'),
(62, 1, 'Update', 'location_module', 'lm_id/2()', 1, 'Y2C4W1', '2023-04-14 16:32:24'),
(63, 1, 'Insert', 'module_position_audit', 'Insertid-1', 1, '8D7Xdr', '2023-04-14 16:36:51'),
(64, 1, 'Update', 'location_module', 'lm_id/2()', 1, '8D7Xdr', '2023-04-14 16:36:51'),
(65, 1, 'Insert', 'module_position_audit', 'Insertid-2', 1, '37Q25Y', '2023-04-14 16:37:04'),
(66, 1, 'Update', 'location_module', 'lm_id/2()', 1, '37Q25Y', '2023-04-14 16:37:04'),
(67, 1, 'Insert', 'module_position_audit', 'Insertid-3', 1, 'abJ79f', '2023-04-14 16:38:45'),
(68, 1, 'Update', 'location_module', 'lm_id/2()', 1, 'abJ79f', '2023-04-14 16:38:45'),
(69, 1, 'Insert', 'module_position_audit', 'Insertid-4', 1, 'rabKh6', '2023-04-14 16:39:27'),
(70, 1, 'Update', 'location_module', 'lm_id/2()', 1, 'rabKh6', '2023-04-14 16:39:27'),
(71, 0, 'Insert', 'user_log_history', 'Insertid-17', 1, 'r5ueW1', '2023-04-18 17:26:25'),
(72, 0, 'Insert', 'user_log_history', 'Insertid-18', 1, 'uQ8MHh', '2023-04-19 05:34:46'),
(73, 0, 'Insert', 'user_log_history', 'Insertid-19', 1, 'g3E3ch', '2023-04-19 05:37:25'),
(74, 0, 'Insert', 'user_log_history', 'Insertid-20', 1, 'fUV4XP', '2023-04-19 10:22:00'),
(75, 1, 'Insert', 'user_detail', 'Insertid-7', 1, 'w4d1DK', '2023-04-19 12:15:32'),
(76, 1, 'Insert', 'ibo_user', 'Insertid-6', 1, 'w4d1DK', '2023-04-19 12:15:32'),
(77, 1, 'Update', 'user_detail', 'id_user/7()', 1, 'w4d1DK', '2023-04-19 12:15:32'),
(78, 1, 'Insert', 'ibo_sponsor_position', 'Insertid-2', 1, 'w4d1DK', '2023-04-19 12:15:32'),
(79, 1, 'Update', 'user_detail', 'id_user/7()', 1, 'TVKn8P', '2023-04-19 12:27:35'),
(80, 1, 'Update', 'user_detail', 'id_user/7()', 1, 'LAN9Ut', '2023-04-19 12:36:38'),
(81, 0, 'Insert', 'user_log_history', 'Insertid-21', 1, 'WaJYr9', '2023-04-21 06:32:02'),
(82, 0, 'Insert', 'user_log_history', 'Insertid-22', 1, '3RHrga', '2023-04-21 17:09:21'),
(83, 1, 'Insert', 'location_module', 'Insertid-3', 1, 'RTYEKu', '2023-04-21 17:27:49'),
(84, 1, 'Update', 'location_module', 'lm_id/3()', 1, 'RTYEKu', '2023-04-21 17:27:49'),
(85, 1, 'Update', 'location_module', 'lm_id/2()', 1, 'wqqtY3', '2023-04-21 17:41:33'),
(86, 1, 'Update', 'location_module', 'lm_id/1()', 1, '1DrYcD', '2023-04-21 17:42:00'),
(87, 0, 'Insert', 'user_log_history', 'Insertid-23', 1, 'neAbGL', '2023-04-22 05:37:40'),
(88, 1, 'Insert', 'user_detail', 'Insertid-8', 1, '8BubHT', '2023-04-22 05:41:35'),
(89, 1, 'Insert', 'ibo_user', 'Insertid-7', 1, '8BubHT', '2023-04-22 05:41:35'),
(90, 1, 'Update', 'user_detail', 'id_user/8()', 1, '8BubHT', '2023-04-22 05:41:35'),
(91, 1, 'Insert', 'ibo_sponsor_position', 'Insertid-3', 1, '8BubHT', '2023-04-22 05:41:35'),
(92, 1, 'Insert', 'user_detail', 'Insertid-9', 1, '4uEUd1', '2023-04-22 05:54:29'),
(93, 1, 'Insert', 'ibo_user', 'Insertid-8', 1, '4uEUd1', '2023-04-22 05:54:29'),
(94, 1, 'Update', 'user_detail', 'id_user/9()', 1, '4uEUd1', '2023-04-22 05:54:29'),
(95, 1, 'Insert', 'ibo_sponsor_position', 'Insertid-4', 1, '4uEUd1', '2023-04-22 05:54:29'),
(96, 1, 'Insert', 'user_detail', 'Insertid-10', 1, 'g85BLK', '2023-04-22 05:57:07'),
(97, 1, 'Insert', 'ibo_user', 'Insertid-9', 1, 'g85BLK', '2023-04-22 05:57:07'),
(98, 1, 'Update', 'user_detail', 'id_user/10()', 1, 'g85BLK', '2023-04-22 05:57:07'),
(99, 1, 'Insert', 'ibo_sponsor_position', 'Insertid-5', 1, 'g85BLK', '2023-04-22 05:57:07'),
(100, 1, 'Insert', 'user_detail', 'Insertid-11', 1, 'D2naPL', '2023-04-22 06:12:48'),
(101, 1, 'Insert', 'ibo_user', 'Insertid-10', 1, 'D2naPL', '2023-04-22 06:12:48'),
(102, 1, 'Update', 'user_detail', 'id_user/11()', 1, 'D2naPL', '2023-04-22 06:12:48'),
(103, 1, 'Insert', 'ibo_sponsor_position', 'Insertid-6', 1, 'D2naPL', '2023-04-22 06:12:48'),
(104, 1, 'Insert', 'user_detail', 'Insertid-12', 1, 'wuVgCY', '2023-04-22 07:22:43'),
(105, 1, 'Insert', 'ibo_user', 'Insertid-11', 1, 'wuVgCY', '2023-04-22 07:22:43'),
(106, 1, 'Insert', 'ibo_business_detail', 'Insertid-1', 1, 'wuVgCY', '2023-04-22 07:22:43'),
(107, 1, 'Update', 'user_detail', 'id_user/12()', 1, 'wuVgCY', '2023-04-22 07:22:43'),
(108, 1, 'Insert', 'ibo_sponsor_position', 'Insertid-7', 1, 'wuVgCY', '2023-04-22 07:22:43'),
(109, 1, 'Insert', 'user_detail', 'Insertid-13', 1, '67XEEd', '2023-04-22 07:26:41'),
(110, 1, 'Insert', 'ibo_user', 'Insertid-12', 1, '67XEEd', '2023-04-22 07:26:41'),
(111, 1, 'Insert', 'ibo_business_detail', 'Insertid-2', 1, '67XEEd', '2023-04-22 07:26:41'),
(112, 1, 'Update', 'user_detail', 'id_user/13()', 1, '67XEEd', '2023-04-22 07:26:41'),
(113, 1, 'Insert', 'ibo_sponsor_position', 'Insertid-8', 1, '67XEEd', '2023-04-22 07:26:41'),
(114, 1, 'Update', 'location_module', 'lm_id/3()', 0, 'gWhPfN', '2023-04-22 07:31:44'),
(115, 1, 'Update', 'master_segment', 'segment_id/23()', 1, 'C8TLKG', '2023-04-22 09:57:33'),
(116, 1, 'Update', 'master_segment', 'segment_id/22()', 1, 'eCYNTg', '2023-04-22 09:57:38'),
(117, 1, 'Update', 'master_segment', 'segment_id/23()', 0, 'XVuwMm', '2023-04-22 10:10:24'),
(118, 1, 'Update', 'master_segment', 'segment_id/23()', 1, '2Lnt6t', '2023-04-22 10:10:29'),
(119, 1, 'Update', 'master_segment', 'segment_id/23()', 1, 'URew8g', '2023-04-22 10:10:33'),
(120, 1, 'Insert', 'master_segment', 'Insertid-24', 1, 'Kpa9aA', '2023-04-22 10:15:21'),
(121, 0, 'Insert', 'user_failwer_login_attempt', 'Insertid-8', 1, 'Y3um5G', '2023-04-24 08:10:19'),
(122, 0, 'Insert', 'user_failwer_login_attempt', 'Insertid-9', 1, '2nJQcK', '2023-04-24 08:10:23'),
(123, 0, 'Insert', 'user_log_history', 'Insertid-24', 1, 'tm9Cd6', '2023-04-24 08:10:31'),
(124, 0, 'Insert', 'user_log_history', 'Insertid-25', 1, 'rRmGgQ', '2023-05-02 05:23:22'),
(125, 1, 'Update', 'master_segment', 'segment_id/24()', 1, '2gUAUc', '2023-05-02 05:24:55'),
(126, 1, 'Update', 'master_segment', 'segment_id/24()', 1, 'XPP9Wa', '2023-05-02 05:24:58'),
(127, 0, 'Insert', 'user_log_history', 'Insertid-26', 1, 'nV72ee', '2023-05-02 11:34:23'),
(128, 0, 'Insert', 'user_log_history', 'Insertid-27', 1, 'B9qKwD', '2023-05-04 17:16:43'),
(129, 1, 'Update', 'master_category', 'category_id/7()', 1, 'fbRud7', '2023-05-04 17:30:47'),
(130, 1, 'Update', 'master_category', 'category_id/6()', 1, 'LgedW8', '2023-05-04 17:30:51'),
(131, 1, 'Update', 'master_category', 'category_id/7()', 1, 'qmVmBd', '2023-05-04 17:31:22'),
(132, 1, 'Update', 'master_sub_category', 'sub_category_id/10()', 1, 'm8fpB1', '2023-05-04 17:57:17'),
(133, 1, 'Update', 'master_sub_category', 'sub_category_id/9()', 1, 'H6uQe7', '2023-05-04 17:57:21'),
(134, 1, 'Update', 'master_sub_category', 'sub_category_id/10()', 1, 'q1Ln7e', '2023-05-04 17:57:25'),
(135, 1, 'Insert', 'master_segment', 'Insertid-25', 1, 'RNUWG7', '2023-05-04 18:01:46'),
(136, 1, 'Insert', 'master_category', 'Insertid-8', 1, 'bq42TC', '2023-05-04 18:17:17'),
(137, 1, 'Update', 'master_category', 'category_id/8()', 0, 'dAVhmX', '2023-05-04 18:28:12'),
(138, 1, 'Insert', 'master_sub_category', 'Insertid-11', 1, 'UCEWDN', '2023-05-04 18:59:20'),
(139, 1, 'Update', 'master_category', 'category_id/8()', 0, 'U1uPEV', '2023-05-04 19:00:20'),
(140, 0, 'Insert', 'user_log_history', 'Insertid-28', 1, 'cmAr1p', '2023-05-05 06:15:40'),
(141, 1, 'Update', 'master_category', 'category_id/8()', 0, 'dnrcN1', '2023-05-05 06:16:01'),
(142, 1, 'Update', 'master_sub_category', 'sub_category_id/11()', 1, 'RL4Gra', '2023-05-05 06:17:24'),
(143, 1, 'Update', 'master_sub_category', 'sub_category_id/11()', 0, 'qXPaWM', '2023-05-05 06:27:31'),
(144, 0, 'Insert', 'user_log_history', 'Insertid-29', 1, 'rf7VAm', '2023-05-05 18:03:20'),
(145, 1, 'Insert', 'user_detail', 'Insertid-14', 1, 'Ja7Vpd', '2023-05-05 18:48:22'),
(146, 1, 'Insert', 'ibo_user', 'Insertid-13', 1, 'Ja7Vpd', '2023-05-05 18:48:22'),
(147, 1, 'Insert', 'ibo_business_detail', 'Insertid-3', 1, 'Ja7Vpd', '2023-05-05 18:48:22'),
(148, 1, 'Update', 'user_detail', 'id_user/14()', 1, 'Ja7Vpd', '2023-05-05 18:48:22'),
(149, 1, 'Insert', 'ibo_sponsor_position', 'Insertid-9', 1, 'Ja7Vpd', '2023-05-05 18:48:22'),
(150, 1, 'Insert', 'user_detail', 'Insertid-15', 1, 'V2CJVH', '2023-05-05 19:16:15'),
(151, 1, 'Insert', 'ibo_user', 'Insertid-14', 1, 'V2CJVH', '2023-05-05 19:16:15'),
(152, 1, 'Insert', 'ibo_business_detail', 'Insertid-4', 1, 'V2CJVH', '2023-05-05 19:16:15'),
(153, 1, 'Update', 'user_detail', 'id_user/15()', 1, 'V2CJVH', '2023-05-05 19:16:15'),
(154, 1, 'Insert', 'ibo_sponsor_position', 'Insertid-10', 1, 'V2CJVH', '2023-05-05 19:16:15'),
(155, 0, 'Insert', 'user_log_history', 'Insertid-30', 1, 'BhFfGJ', '2023-05-06 17:14:14'),
(156, 1, 'Insert', 'master_segment', 'Insertid-26', 1, 'Xe9pEC', '2023-05-06 18:11:07'),
(157, 1, 'Insert', 'master_category', 'Insertid-9', 1, '1wDcEb', '2023-05-06 18:11:31'),
(158, 1, 'Insert', 'master_sub_category', 'Insertid-12', 1, 'uuGhaR', '2023-05-06 18:11:51'),
(159, 1, 'Insert', 'master_segment', 'Insertid-27', 1, 'p1L1Td', '2023-05-06 18:26:28'),
(160, 1, 'Insert', 'master_category', 'Insertid-10', 1, 'cQMfVc', '2023-05-06 18:26:46'),
(161, 1, 'Insert', 'master_sub_category', 'Insertid-13', 1, 'f9uPHu', '2023-05-06 18:27:03'),
(162, 1, 'Insert', 'user_detail', 'Insertid-16', 1, 'efpHaL', '2023-05-06 18:37:17'),
(163, 1, 'Insert', 'ibo_user', 'Insertid-15', 1, 'efpHaL', '2023-05-06 18:37:17'),
(164, 1, 'Insert', 'user_detail', 'Insertid-17', 1, 'TfNGVT', '2023-05-06 18:38:57'),
(165, 1, 'Insert', 'ibo_user', 'Insertid-16', 1, 'TfNGVT', '2023-05-06 18:38:57'),
(166, 1, 'Insert', 'ibo_business_detail', 'Insertid-5', 1, 'TfNGVT', '2023-05-06 18:38:57'),
(167, 1, 'Insert', 'user_detail', 'Insertid-18', 1, 'F4pcNV', '2023-05-06 18:40:04'),
(168, 1, 'Insert', 'ibo_user', 'Insertid-17', 1, 'F4pcNV', '2023-05-06 18:40:04'),
(169, 1, 'Insert', 'ibo_business_detail', 'Insertid-6', 1, 'F4pcNV', '2023-05-06 18:40:04'),
(170, 1, 'Insert', 'ibo_business_detail', 'Insertid-7', 1, 'F4pcNV', '2023-05-06 18:40:04'),
(171, 1, 'Insert', 'ibo_business_detail', 'Insertid-8', 1, 'F4pcNV', '2023-05-06 18:40:04'),
(172, 1, 'Insert', 'ibo_business_detail', 'Insertid-9', 1, 'F4pcNV', '2023-05-06 18:40:04'),
(173, 1, 'Insert', 'ibo_business_detail', 'Insertid-10', 1, 'F4pcNV', '2023-05-06 18:40:04'),
(174, 1, 'Insert', 'ibo_business_detail', 'Insertid-11', 1, 'F4pcNV', '2023-05-06 18:40:04'),
(175, 1, 'Update', 'user_detail', 'id_user/18()', 1, 'F4pcNV', '2023-05-06 18:40:04'),
(176, 1, 'Insert', 'ibo_sponsor_position', 'Insertid-11', 1, 'F4pcNV', '2023-05-06 18:40:04'),
(177, 1, 'Insert', 'user_detail', 'Insertid-19', 1, 't3AAC2', '2023-05-06 19:31:22'),
(178, 1, 'Insert', 'ibo_user', 'Insertid-18', 1, 't3AAC2', '2023-05-06 19:31:22'),
(179, 1, 'Insert', 'ibo_joining_payment_detail', 'Insertid-1', 1, 't3AAC2', '2023-05-06 19:31:22'),
(180, 1, 'Insert', 'ibo_business_detail', 'Insertid-1', 1, 't3AAC2', '2023-05-06 19:31:22'),
(181, 1, 'Update', 'user_detail', 'id_user/19()', 1, 't3AAC2', '2023-05-06 19:31:22'),
(182, 1, 'Insert', 'ibo_sponsor_position', 'Insertid-1', 1, 't3AAC2', '2023-05-06 19:31:22'),
(183, 1, 'Insert', 'user_detail', 'Insertid-20', 1, 'm2dwem', '2023-05-06 19:40:07'),
(184, 1, 'Insert', 'ibo_user', 'Insertid-19', 1, 'm2dwem', '2023-05-06 19:40:07'),
(185, 1, 'Insert', 'ibo_joining_payment_detail', 'Insertid-2', 1, 'm2dwem', '2023-05-06 19:40:07'),
(186, 1, 'Insert', 'ibo_business_detail', 'Insertid-2', 1, 'm2dwem', '2023-05-06 19:40:07'),
(187, 1, 'Insert', 'ibo_business_detail', 'Insertid-3', 1, 'm2dwem', '2023-05-06 19:40:07'),
(188, 1, 'Insert', 'ibo_business_detail', 'Insertid-4', 1, 'm2dwem', '2023-05-06 19:40:07'),
(189, 1, 'Insert', 'ibo_business_detail', 'Insertid-5', 1, 'm2dwem', '2023-05-06 19:40:07'),
(190, 1, 'Insert', 'ibo_business_detail', 'Insertid-6', 1, 'm2dwem', '2023-05-06 19:40:07'),
(191, 1, 'Update', 'user_detail', 'id_user/20()', 1, 'm2dwem', '2023-05-06 19:40:07'),
(192, 1, 'Insert', 'ibo_sponsor_position', 'Insertid-2', 1, 'm2dwem', '2023-05-06 19:40:07'),
(193, 1, 'Insert', 'ibo_sponsor_position', 'Insertid-3', 1, 'm2dwem', '2023-05-06 19:40:07'),
(194, 1, 'Update', 'ibo_business_detail', 'paymentdetail_id/2()', 5, '8uW2FB', '2023-05-06 19:48:59'),
(195, 1, 'Update', 'ibo_business_detail', 'paymentdetail_id/2()', 0, '2q7QAT', '2023-05-06 19:50:30'),
(196, 1, 'Update', 'ibo_joining_payment_detail', 'mpd_id/2()', 1, '2q7QAT', '2023-05-06 19:50:30'),
(197, 1, 'Update', 'ibo_joining_payment_detail', 'mpd_id/1()', 1, '6LnDdG', '2023-05-06 19:51:02'),
(198, 1, 'Update', 'ibo_business_detail', 'paymentdetail_id/1()', 1, 'cdhUXc', '2023-05-06 19:53:02'),
(199, 1, 'Update', 'ibo_joining_payment_detail', 'mpd_id/1()', 1, 'cdhUXc', '2023-05-06 19:53:02'),
(200, 1, 'Update', 'user_detail', 'id_user/20()', 1, 'YRUEbX', '2023-05-06 19:55:13'),
(201, 1, 'Update', 'ibo_business_detail', 'paymentdetail_id/2()', 0, 'YRUEbX', '2023-05-06 19:55:13'),
(202, 1, 'Update', 'ibo_joining_payment_detail', 'mpd_id/2()', 1, 'YRUEbX', '2023-05-06 19:55:13'),
(203, 1, 'Update', 'user_detail', 'id_user/19()', 1, 'FMdQGe', '2023-05-06 19:55:22'),
(204, 1, 'Update', 'ibo_business_detail', 'paymentdetail_id/1()', 1, 'FMdQGe', '2023-05-06 19:55:22'),
(205, 1, 'Update', 'ibo_joining_payment_detail', 'mpd_id/1()', 1, 'FMdQGe', '2023-05-06 19:55:22'),
(206, 0, 'Insert', 'user_log_history', 'Insertid-31', 1, 'DeJtWt', '2023-05-07 04:59:07'),
(207, 0, 'Insert', 'user_log_history', 'Insertid-32', 1, 'WGf7rF', '2023-05-07 16:59:54'),
(208, 1, 'Insert', 'cron_table', 'Insertid-1', 1, 'q9PhPK', '2023-05-07 17:00:11'),
(209, 1, 'Insert', 'cron_table', 'Insertid-2', 1, 'T8bhh8', '2023-05-07 17:00:45'),
(210, 1, 'Insert', 'cron_table', 'Insertid-3', 1, 'cVRGAn', '2023-05-07 17:01:01'),
(211, 1, 'Insert', 'payout_date', 'Insertid-2', 1, 'cVRGAn', '2023-05-07 17:01:01'),
(212, 1, 'Insert', 'cron_table', 'Insertid-4', 1, 'cVRGAn', '2023-05-07 17:01:01'),
(213, 1, 'Insert', 'cron_table', 'Insertid-5', 1, 'AuAtcd', '2023-05-07 17:02:30'),
(214, 1, 'Insert', 'payout_date', 'Insertid-3', 1, 'AuAtcd', '2023-05-07 17:02:30'),
(215, 1, 'Insert', 'cron_table', 'Insertid-6', 1, 'AuAtcd', '2023-05-07 17:02:30'),
(216, 1, 'Insert', 'cron_table', 'Insertid-7', 1, 'mUPaWQ', '2023-05-07 17:02:58'),
(217, 1, 'Insert', 'payout_date', 'Insertid-1', 1, 'mUPaWQ', '2023-05-07 17:02:58'),
(218, 1, 'Insert', 'cron_table', 'Insertid-8', 1, 'mUPaWQ', '2023-05-07 17:02:58'),
(219, 1, 'Insert', 'cron_table', 'Insertid-9', 1, 'nJ1RBw', '2023-05-07 17:02:59'),
(220, 1, 'Insert', 'user_detail', 'Insertid-21', 1, 'mmrhm8', '2023-05-07 17:58:44'),
(221, 1, 'Insert', 'ibo_user', 'Insertid-20', 1, 'mmrhm8', '2023-05-07 17:58:44'),
(222, 1, 'Insert', 'ibo_joining_payment_detail', 'Insertid-3', 1, 'mmrhm8', '2023-05-07 17:58:44'),
(223, 1, 'Insert', 'ibo_business_detail', 'Insertid-7', 1, 'mmrhm8', '2023-05-07 17:58:44'),
(224, 1, 'Insert', 'ibo_business_detail', 'Insertid-8', 1, 'mmrhm8', '2023-05-07 17:58:44'),
(225, 1, 'Insert', 'ibo_business_detail', 'Insertid-9', 1, 'mmrhm8', '2023-05-07 17:58:44'),
(226, 1, 'Update', 'user_detail', 'id_user/21()', 1, 'mmrhm8', '2023-05-07 17:58:44'),
(227, 1, 'Insert', 'ibo_sponsor_position', 'Insertid-4', 1, 'mmrhm8', '2023-05-07 17:58:44'),
(228, 1, 'Update', 'user_detail', 'id_user/21()', 1, 'wWKDb6', '2023-05-07 18:09:16'),
(229, 1, 'Update', 'ibo_business_detail', 'paymentdetail_id/3()', 3, 'wWKDb6', '2023-05-07 18:09:16'),
(230, 1, 'Update', 'ibo_joining_payment_detail', 'mpd_id/3()', 1, 'wWKDb6', '2023-05-07 18:09:16'),
(231, 1, 'Insert', 'cron_table', 'Insertid-10', 1, 'ddE5mT', '2023-05-07 18:13:57'),
(232, 1, 'Insert', 'module_position_audit', 'Insertid-5', 1, '1mABRP', '2023-05-07 18:14:39'),
(233, 1, 'Update', 'location_module', 'lm_id/3()', 1, '1mABRP', '2023-05-07 18:14:39'),
(234, 1, 'Insert', 'cron_table', 'Insertid-11', 1, 'RheMJV', '2023-05-07 18:15:55'),
(235, 1, 'Insert', 'cron_table', 'Insertid-12', 1, 'DpttdR', '2023-05-07 18:35:09'),
(236, 1, 'Insert', 'cron_table', 'Insertid-13', 1, 'DKgRtB', '2023-05-07 18:35:21'),
(237, 1, 'Insert', 'member_income', 'Insertid-1', 1, 'DKgRtB', '2023-05-07 18:35:21'),
(238, 1, 'Insert', 'member_income', 'Insertid-2', 1, 'DKgRtB', '2023-05-07 18:35:21'),
(239, 1, 'Insert', 'member_income', 'Insertid-3', 1, 'DKgRtB', '2023-05-07 18:35:21'),
(240, 1, 'Insert', 'member_income', 'Insertid-4', 1, 'DKgRtB', '2023-05-07 18:35:21'),
(241, 1, 'Insert', 'member_income', 'Insertid-5', 1, 'DKgRtB', '2023-05-07 18:35:21'),
(242, 1, 'Update', 'ibo_joining_payment_detail', 'mpd_id/1()', 1, 'DKgRtB', '2023-05-07 18:35:21'),
(243, 1, 'Insert', 'member_income', 'Insertid-6', 1, 'DKgRtB', '2023-05-07 18:35:21'),
(244, 1, 'Insert', 'member_income', 'Insertid-7', 1, 'DKgRtB', '2023-05-07 18:35:21'),
(245, 1, 'Insert', 'member_income', 'Insertid-8', 1, 'DKgRtB', '2023-05-07 18:35:21'),
(246, 1, 'Insert', 'member_income', 'Insertid-9', 1, 'DKgRtB', '2023-05-07 18:35:21'),
(247, 1, 'Insert', 'member_income', 'Insertid-10', 1, 'DKgRtB', '2023-05-07 18:35:21'),
(248, 1, 'Update', 'ibo_joining_payment_detail', 'mpd_id/2()', 1, 'DKgRtB', '2023-05-07 18:35:21'),
(249, 1, 'Insert', 'member_income', 'Insertid-11', 1, 'DKgRtB', '2023-05-07 18:35:21'),
(250, 1, 'Insert', 'member_income', 'Insertid-12', 1, 'DKgRtB', '2023-05-07 18:35:21'),
(251, 1, 'Insert', 'member_income', 'Insertid-13', 1, 'DKgRtB', '2023-05-07 18:35:21'),
(252, 1, 'Insert', 'member_income', 'Insertid-14', 1, 'DKgRtB', '2023-05-07 18:35:21'),
(253, 1, 'Insert', 'member_income', 'Insertid-15', 1, 'DKgRtB', '2023-05-07 18:35:21'),
(254, 1, 'Update', 'ibo_joining_payment_detail', 'mpd_id/3()', 1, 'DKgRtB', '2023-05-07 18:35:21'),
(255, 1, 'Insert', 'cron_table', 'Insertid-14', 1, 'DKgRtB', '2023-05-07 18:35:21'),
(256, 1, 'Insert', 'cron_table', 'Insertid-15', 1, 'arV26M', '2023-05-07 19:11:23'),
(257, 1, 'Update', 'monthly_payout', 'mp_id/1()', 1, 'arV26M', '2023-05-07 19:11:23'),
(258, 1, 'Update', 'monthly_payout', 'mp_id/1()', 1, 'arV26M', '2023-05-07 19:11:23'),
(259, 1, 'Update', 'monthly_payout', 'mp_id/1()', 1, 'arV26M', '2023-05-07 19:11:23'),
(260, 1, 'Update', 'monthly_payout', 'mp_id/1()', 1, 'arV26M', '2023-05-07 19:11:23'),
(261, 1, 'Update', 'monthly_payout', 'mp_id/1()', 1, 'arV26M', '2023-05-07 19:11:23'),
(262, 1, 'Insert', 'monthly_payout', 'Insertid-2', 1, 'arV26M', '2023-05-07 19:11:23'),
(263, 1, 'Insert', 'cron_table', 'Insertid-16', 1, 'arV26M', '2023-05-07 19:11:23'),
(264, 1, 'Update', 'user_detail', 'id_user/21()', 0, 'dnKKrA', '2023-05-07 19:27:25'),
(265, 1, 'Update', 'ibo_business_detail', 'paymentdetail_id/3()', 0, 'dnKKrA', '2023-05-07 19:27:25'),
(266, 1, 'Update', 'ibo_joining_payment_detail', 'mpd_id/3()', 1, 'dnKKrA', '2023-05-07 19:27:25'),
(267, 1, 'Update', 'user_detail', 'id_user/20()', 0, 'ag5G5A', '2023-05-07 19:27:30'),
(268, 1, 'Update', 'ibo_business_detail', 'paymentdetail_id/2()', 0, 'ag5G5A', '2023-05-07 19:27:30'),
(269, 1, 'Update', 'ibo_joining_payment_detail', 'mpd_id/2()', 1, 'ag5G5A', '2023-05-07 19:27:30'),
(270, 1, 'Update', 'user_detail', 'id_user/19()', 0, 'uf1Q7C', '2023-05-07 19:27:35'),
(271, 1, 'Update', 'ibo_business_detail', 'paymentdetail_id/1()', 0, 'uf1Q7C', '2023-05-07 19:27:35'),
(272, 1, 'Update', 'ibo_joining_payment_detail', 'mpd_id/1()', 1, 'uf1Q7C', '2023-05-07 19:27:35'),
(273, 1, 'Insert', 'cron_table', 'Insertid-17', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(274, 1, 'Insert', 'member_income', 'Insertid-1', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(275, 1, 'Insert', 'member_income', 'Insertid-2', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(276, 1, 'Insert', 'member_income', 'Insertid-3', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(277, 1, 'Insert', 'member_income', 'Insertid-4', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(278, 1, 'Insert', 'member_income', 'Insertid-5', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(279, 1, 'Insert', 'member_income', 'Insertid-6', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(280, 1, 'Update', 'ibo_joining_payment_detail', 'mpd_id/1()', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(281, 1, 'Insert', 'member_income', 'Insertid-7', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(282, 1, 'Insert', 'member_income', 'Insertid-8', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(283, 1, 'Insert', 'member_income', 'Insertid-9', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(284, 1, 'Insert', 'member_income', 'Insertid-10', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(285, 1, 'Insert', 'member_income', 'Insertid-11', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(286, 1, 'Insert', 'member_income', 'Insertid-12', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(287, 1, 'Update', 'ibo_joining_payment_detail', 'mpd_id/2()', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(288, 1, 'Insert', 'member_income', 'Insertid-13', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(289, 1, 'Insert', 'member_income', 'Insertid-14', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(290, 1, 'Insert', 'member_income', 'Insertid-15', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(291, 1, 'Insert', 'member_income', 'Insertid-16', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(292, 1, 'Insert', 'member_income', 'Insertid-17', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(293, 1, 'Insert', 'member_income', 'Insertid-18', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(294, 1, 'Update', 'ibo_joining_payment_detail', 'mpd_id/3()', 1, 'E3C5Ap', '2023-05-07 19:27:54'),
(295, 1, 'Insert', 'cron_table', 'Insertid-18', 1, 'E3C5Ap', '2023-05-07 19:27:55'),
(296, 1, 'Insert', 'cron_table', 'Insertid-19', 1, '6dARhJ', '2023-05-07 19:28:06'),
(297, 1, 'Insert', 'monthly_payout', 'Insertid-1', 1, '6dARhJ', '2023-05-07 19:28:06'),
(298, 1, 'Update', 'monthly_payout', 'mp_id/1()', 1, '6dARhJ', '2023-05-07 19:28:06'),
(299, 1, 'Update', 'monthly_payout', 'mp_id/1()', 1, '6dARhJ', '2023-05-07 19:28:06'),
(300, 1, 'Update', 'monthly_payout', 'mp_id/1()', 1, '6dARhJ', '2023-05-07 19:28:06'),
(301, 1, 'Update', 'monthly_payout', 'mp_id/1()', 1, '6dARhJ', '2023-05-07 19:28:06'),
(302, 1, 'Update', 'monthly_payout', 'mp_id/1()', 1, '6dARhJ', '2023-05-07 19:28:06'),
(303, 1, 'Insert', 'monthly_payout', 'Insertid-2', 1, '6dARhJ', '2023-05-07 19:28:06'),
(304, 1, 'Insert', 'cron_table', 'Insertid-20', 1, '6dARhJ', '2023-05-07 19:28:06'),
(305, 0, 'Insert', 'user_failwer_login_attempt', 'Insertid-10', 1, 'ptgt2D', '2023-05-08 10:12:32'),
(306, 0, 'Insert', 'user_log_history', 'Insertid-33', 1, 'u5CawG', '2023-05-08 11:44:15'),
(307, 0, 'Insert', 'user_failwer_login_attempt', 'Insertid-11', 1, 'Q3CCtT', '2023-05-08 17:21:54'),
(308, 0, 'Insert', 'user_failwer_login_attempt', 'Insertid-12', 1, 'H6PRLW', '2023-05-08 17:22:05'),
(309, 0, 'Insert', 'user_log_history', 'Insertid-34', 1, 'XJ2CtH', '2023-05-08 17:24:17'),
(310, 19, 'Insert', 'user_failwer_login_attempt', 'Insertid-13', 1, 'NFPB2D', '2023-05-08 17:26:34'),
(311, 19, 'Insert', 'user_failwer_login_attempt', 'Insertid-14', 1, 'unw69K', '2023-05-08 17:29:56'),
(312, 19, 'Insert', 'user_failwer_login_attempt', 'Insertid-15', 1, 'LdMWne', '2023-05-08 17:30:11'),
(313, 19, 'Insert', 'user_log_history', 'Insertid-35', 1, 'L14n94', '2023-05-08 17:33:27'),
(314, 0, 'Insert', 'user_log_history', 'Insertid-36', 1, 'ftKNFg', '2023-05-09 05:12:56'),
(315, 0, 'Insert', 'user_failwer_login_attempt', 'Insertid-16', 1, 'nV2BPb', '2023-05-09 09:12:41'),
(316, 0, 'Insert', 'user_log_history', 'Insertid-37', 1, 'cEHfG5', '2023-05-09 09:13:01'),
(317, 0, 'Insert', 'user_log_history', 'Insertid-38', 1, '5tXYTP', '2023-05-09 09:28:34'),
(318, 0, 'Insert', 'user_log_history', 'Insertid-39', 1, '1w3PWX', '2023-05-09 17:25:52'),
(319, 0, 'Insert', 'user_log_history', 'Insertid-40', 1, 'Gbgt5g', '2023-05-09 17:39:04'),
(320, 0, 'Insert', 'user_log_history', 'Insertid-41', 1, 'wTcJpK', '2023-05-09 17:56:34'),
(321, 0, 'Update', 'user_detail', 'id_user/2()', 1, '1wVH7t', '2023-05-09 18:26:09'),
(322, 0, 'Insert', 'smtp_email', 'Insertid-1', 1, '1wVH7t', '2023-05-09 18:26:09'),
(323, 0, 'Insert', 'user_detail', 'Insertid-22', 1, '5cW4RX', '2023-05-09 18:49:39'),
(324, 0, 'Insert', 'ibo_user', 'Insertid-21', 1, '5cW4RX', '2023-05-09 18:49:39'),
(325, 0, 'Insert', 'ibo_joining_payment_detail', 'Insertid-4', 1, '5cW4RX', '2023-05-09 18:49:39'),
(326, 0, 'Insert', 'ibo_business_detail', 'Insertid-10', 1, '5cW4RX', '2023-05-09 18:49:39'),
(327, 0, 'Insert', 'user_detail', 'Insertid-23', 1, 'LHP5BP', '2023-05-09 18:52:03'),
(328, 0, 'Insert', 'ibo_user', 'Insertid-22', 1, 'LHP5BP', '2023-05-09 18:52:03'),
(329, 0, 'Insert', 'ibo_joining_payment_detail', 'Insertid-5', 1, 'LHP5BP', '2023-05-09 18:52:03'),
(330, 0, 'Insert', 'ibo_business_detail', 'Insertid-11', 1, 'LHP5BP', '2023-05-09 18:52:03'),
(331, 0, 'Update', 'user_detail', 'id_user/23()', 1, 'LHP5BP', '2023-05-09 18:52:03'),
(332, 0, 'Insert', 'ibo_sponsor_position', 'Insertid-5', 1, 'LHP5BP', '2023-05-09 18:52:03'),
(333, 0, 'Insert', 'user_log_history', 'Insertid-42', 1, 'e2NdhF', '2023-05-09 19:01:00'),
(334, 0, 'Insert', 'user_detail', 'Insertid-24', 1, 'eqWKF2', '2023-05-09 19:16:29'),
(335, 0, 'Insert', 'ibo_user', 'Insertid-3', 1, 'eqWKF2', '2023-05-09 19:16:29'),
(336, 0, 'Insert', 'ibo_joining_payment_detail', 'Insertid-1', 1, 'eqWKF2', '2023-05-09 19:16:29'),
(337, 0, 'Insert', 'ibo_business_detail', 'Insertid-1', 1, 'eqWKF2', '2023-05-09 19:16:29'),
(338, 0, 'Insert', 'ibo_business_detail', 'Insertid-2', 1, 'eqWKF2', '2023-05-09 19:16:29'),
(339, 0, 'Update', 'user_detail', 'id_user/24()', 1, 'eqWKF2', '2023-05-09 19:16:29'),
(340, 0, 'Insert', 'ibo_sponsor_position', 'Insertid-1', 1, 'eqWKF2', '2023-05-09 19:16:29'),
(341, 0, 'Insert', 'user_detail', 'Insertid-25', 1, 'Ubc2Lw', '2023-05-09 19:20:20'),
(342, 0, 'Insert', 'ibo_user', 'Insertid-4', 1, 'Ubc2Lw', '2023-05-09 19:20:20'),
(343, 0, 'Insert', 'ibo_joining_payment_detail', 'Insertid-2', 1, 'Ubc2Lw', '2023-05-09 19:20:20'),
(344, 0, 'Insert', 'ibo_business_detail', 'Insertid-3', 1, 'Ubc2Lw', '2023-05-09 19:20:20'),
(345, 0, 'Update', 'user_detail', 'id_user/25()', 1, 'Ubc2Lw', '2023-05-09 19:20:20'),
(346, 0, 'Insert', 'ibo_sponsor_position', 'Insertid-2', 1, 'Ubc2Lw', '2023-05-09 19:20:20'),
(347, 0, 'Insert', 'user_log_history', 'Insertid-43', 1, 'epQ4LK', '2023-05-09 19:21:00'),
(348, 0, 'Insert', 'user_log_history', 'Insertid-44', 1, 'BXLuRB', '2023-05-10 02:23:20'),
(349, 0, 'Insert', 'user_failwer_login_attempt', 'Insertid-17', 1, '3pgpAu', '2023-05-10 02:51:10'),
(350, 0, 'Insert', 'user_log_history', 'Insertid-45', 1, '5r3YQL', '2023-05-10 02:51:28'),
(351, 0, 'Insert', 'user_detail', 'Insertid-26', 1, 'Wb2MXM', '2023-05-10 03:17:57'),
(352, 0, 'Insert', 'ibo_user', 'Insertid-5', 1, 'Wb2MXM', '2023-05-10 03:17:57'),
(353, 0, 'Insert', 'ibo_joining_payment_detail', 'Insertid-3', 1, 'Wb2MXM', '2023-05-10 03:17:57'),
(354, 0, 'Insert', 'ibo_business_detail', 'Insertid-4', 1, 'Wb2MXM', '2023-05-10 03:17:57'),
(355, 0, 'Update', 'user_detail', 'id_user/26()', 1, 'Wb2MXM', '2023-05-10 03:17:57'),
(356, 0, 'Insert', 'ibo_sponsor_position', 'Insertid-3', 1, 'Wb2MXM', '2023-05-10 03:17:57'),
(357, 0, 'Insert', 'user_detail', 'Insertid-27', 1, '79qwqL', '2023-05-10 03:23:32'),
(358, 0, 'Insert', 'ibo_user', 'Insertid-6', 1, '79qwqL', '2023-05-10 03:23:32'),
(359, 0, 'Insert', 'ibo_joining_payment_detail', 'Insertid-4', 1, '79qwqL', '2023-05-10 03:23:32'),
(360, 0, 'Insert', 'ibo_business_detail', 'Insertid-5', 1, '79qwqL', '2023-05-10 03:23:32'),
(361, 0, 'Update', 'user_detail', 'id_user/27()', 1, '79qwqL', '2023-05-10 03:23:32'),
(362, 0, 'Insert', 'ibo_sponsor_position', 'Insertid-4', 1, '79qwqL', '2023-05-10 03:23:32'),
(363, 0, 'Insert', 'user_log_history', 'Insertid-46', 1, 'DYPKT4', '2023-05-10 03:27:50'),
(364, 0, 'Insert', 'user_log_history', 'Insertid-47', 1, 'm1rmGf', '2023-05-10 03:56:48'),
(365, 0, 'Insert', 'user_failwer_login_attempt', 'Insertid-18', 1, 'LcHf7f', '2023-05-10 04:02:48'),
(366, 0, 'Insert', 'user_failwer_login_attempt', 'Insertid-19', 1, '8qDdUE', '2023-05-10 08:39:20'),
(367, 0, 'Insert', 'user_log_history', 'Insertid-48', 1, 'hWq9PW', '2023-05-10 08:39:33'),
(368, 1, 'Update', 'location_module', 'lm_id/1()', 1, 'bn4AW6', '2023-05-10 08:50:00'),
(369, 1, 'Update', 'team_sr_consulting_board', 'scaab_id/1()', 1, 'dRCuaT', '2023-05-10 09:44:30'),
(370, 1, 'Update', 'team_sr_consulting_board', 'scaab_id/()', 0, 'aV4HWV', '2023-05-10 10:16:40'),
(371, 1, 'Insert', 'team_sr_consulting_board', 'Insertid-2', 1, 'JF1qQG', '2023-05-10 10:23:56'),
(372, 1, 'Update', 'team_sr_consulting_board', 'scaab_id/2()', 1, 'TrqMAD', '2023-05-10 10:39:19'),
(373, 1, 'Insert', 'team_consulting_board', 'Insertid-1', 1, 'qP78cA', '2023-05-10 10:43:33'),
(374, 1, 'Update', 'team_sr_consulting_board', 'scaab_id/1()', 1, 'rtgMgt', '2023-05-10 10:44:22'),
(375, 1, 'Update', 'team_consulting_board', 'cbt_id/1()', 1, 'HB58JF', '2023-05-10 10:45:44'),
(376, 1, 'Insert', 'team_consulting_board', 'Insertid-2', 1, 'PaAptD', '2023-05-10 10:46:00'),
(377, 1, 'Insert', 'team_state', 'Insertid-1', 1, '1Yw5Uh', '2023-05-10 10:49:54'),
(378, 1, 'Update', 'team_state', 'st_id/1()', 1, 'fdXarn', '2023-05-10 10:53:15'),
(379, 1, 'Insert', 'team_sr_consulting_board', 'Insertid-3', 1, 'r4gefe', '2023-05-10 10:58:55'),
(380, 1, 'Insert', 'team_national', 'Insertid-1', 1, 'uNnFYG', '2023-05-10 10:59:36'),
(381, 1, 'Insert', 'team_zone', 'Insertid-1', 1, 'M3BpGt', '2023-05-10 11:04:04'),
(382, 0, 'Insert', 'user_log_history', 'Insertid-49', 1, 'EHRfJ6', '2023-05-10 11:20:17'),
(383, 0, 'Insert', 'user_log_history', 'Insertid-50', 1, 'nbb6df', '2023-05-10 11:28:50');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE IF NOT EXISTS `admin_user` (
  `au_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_user` int(11) DEFAULT NULL,
  `user_modules` varchar(256) DEFAULT NULL,
  `user_module_controls` varchar(512) DEFAULT NULL,
  `user_permission_updated_on` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`au_id`),
  UNIQUE KEY `user_id_user` (`user_id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`au_id`, `user_id_user`, `user_modules`, `user_module_controls`, `user_permission_updated_on`) VALUES
(1, 1, '1,2,3,4,5,6,7,8,9,10,11,12', '1,2,3,4,5,6,7,24,23,22,21,11,10,9,8,25,13,14,15,16,17,18,19,20', '2023-02-17 16:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `cron_table`
--

DROP TABLE IF EXISTS `cron_table`;
CREATE TABLE IF NOT EXISTS `cron_table` (
  `cron_id` int(11) NOT NULL AUTO_INCREMENT,
  `cron_date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `cron_module` varchar(200) NOT NULL,
  `insert_type` varchar(100) NOT NULL,
  `cron_comment` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`cron_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cron_table`
--

INSERT INTO `cron_table` (`cron_id`, `cron_date_time`, `cron_module`, `insert_type`, `cron_comment`) VALUES
(1, '2023-05-07 17:00:11', 'Creating Monthly Payout Date', 'Cron Started', ''),
(2, '2023-05-07 17:00:45', 'Creating Monthly Payout Date', 'Cron Started', ''),
(3, '2023-05-07 17:01:01', 'Creating Monthly Payout Date', 'Cron Started', ''),
(4, '2023-05-07 17:01:01', 'Creating Daily Payout Date', 'Cron Closed', ''),
(5, '2023-05-07 17:02:30', 'Creating Monthly Payout Date', 'Cron Started', ''),
(6, '2023-05-07 17:02:30', 'Creating Daily Payout Date', 'Cron Closed', ''),
(7, '2023-05-07 17:02:58', 'Creating Monthly Payout Date', 'Cron Started', ''),
(8, '2023-05-07 17:02:58', 'Creating Daily Payout Date', 'Cron Closed', ''),
(9, '2023-05-07 17:02:59', 'Creating Monthly Payout Date', 'Cron Started', ''),
(10, '2023-05-07 18:13:57', 'Confirm Transaction', 'Cron Started', ''),
(11, '2023-05-07 18:15:55', 'Confirm Transaction', 'Cron Started', ''),
(12, '2023-05-07 18:35:09', 'Confirm Transaction', 'Cron Started', ''),
(13, '2023-05-07 18:35:21', 'Confirm Transaction', 'Cron Started', ''),
(14, '2023-05-07 18:35:21', 'Confirm Transaction', 'Cron Closed', '3 Transactions Confirmed'),
(15, '2023-05-07 19:11:23', 'Generate Payout', 'Cron Started', ''),
(16, '2023-05-07 19:11:23', 'Generate Payout', 'Cron Closed', '6 Payout Released'),
(17, '2023-05-07 19:27:54', 'Confirm Transaction', 'Cron Started', ''),
(18, '2023-05-07 19:27:54', 'Confirm Transaction', 'Cron Closed', '3 Transactions Confirmed'),
(19, '2023-05-07 19:28:06', 'Generate Payout', 'Cron Started', ''),
(20, '2023-05-07 19:28:06', 'Generate Payout', 'Cron Closed', '7 Payout Released');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
CREATE TABLE IF NOT EXISTS `district` (
  `id_district` int(11) NOT NULL AUTO_INCREMENT,
  `district_name` varchar(256) NOT NULL,
  `state_id_state` int(11) NOT NULL,
  PRIMARY KEY (`id_district`)
) ENGINE=InnoDB AUTO_INCREMENT=633 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id_district`, `district_name`, `state_id_state`) VALUES
(1, 'Ananthapur', 1),
(2, 'Chittoor', 1),
(3, 'Cuddapah', 1),
(4, 'East Godavari', 1),
(5, 'Guntur', 1),
(6, 'Krishna', 1),
(7, 'Kurnool', 1),
(8, 'Mahabub Nagar', 1),
(9, 'Nellore', 1),
(10, 'Prakasam', 1),
(11, 'Srikakulam', 1),
(12, 'Visakhapatnam', 1),
(13, 'Vizianagaram', 1),
(14, 'West Godavari', 1),
(15, 'Changlang', 2),
(16, 'Dibang Valley', 2),
(17, 'East Kameng', 2),
(18, 'East Siang', 2),
(19, 'Kurung Kumey', 2),
(20, 'Lohit', 2),
(21, 'Lower Dibang Valley', 2),
(22, 'Lower Subansiri', 2),
(23, 'Papum Pare', 2),
(24, 'Tawang', 2),
(25, 'Tirap', 2),
(26, 'Upper Siang', 2),
(27, 'Upper Subansiri', 2),
(28, 'West Kameng', 2),
(29, 'West Siang', 2),
(30, 'Barpeta', 3),
(31, 'Bongaigaon', 3),
(32, 'Cachar', 3),
(33, 'Darrang', 3),
(34, 'Dhemaji', 3),
(35, 'Dhubri', 3),
(36, 'Dibrugarh', 3),
(37, 'Goalpara', 3),
(38, 'Golaghat', 3),
(39, 'Hailakandi', 3),
(40, 'Jorhat', 3),
(41, 'Kamrup', 3),
(42, 'Karbi Anglong', 3),
(43, 'Karimganj', 3),
(44, 'Kokrajhar', 3),
(45, 'Lakhimpur', 3),
(46, 'Marigaon', 3),
(47, 'Nagaon', 3),
(48, 'Nalbari', 3),
(49, 'North Cachar Hills', 3),
(50, 'Sibsagar', 3),
(51, 'Sonitpur', 3),
(52, 'Tinsukia', 3),
(53, 'Araria', 4),
(54, 'Arwal', 4),
(55, 'Aurangabad(BH)', 4),
(56, 'Banka', 4),
(57, 'Begusarai', 4),
(58, 'Bhagalpur', 4),
(59, 'Bhojpur', 4),
(60, 'Buxar', 4),
(61, 'Darbhanga', 4),
(62, 'East Champaran', 4),
(63, 'Gaya', 4),
(64, 'Gopalganj', 4),
(65, 'Jamui', 4),
(66, 'Jehanabad', 4),
(67, 'Kaimur (Bhabua)', 4),
(68, 'Katihar', 4),
(69, 'Khagaria', 4),
(70, 'Kishanganj', 4),
(71, 'Lakhisarai', 4),
(72, 'Madhepura', 4),
(73, 'Madhubani', 4),
(74, 'Munger', 4),
(75, 'Muzaffarpur', 4),
(76, 'Nalanda', 4),
(77, 'Nawada', 4),
(78, 'Patna', 4),
(79, 'Purnia', 4),
(80, 'Rohtas', 4),
(81, 'Saharsa', 4),
(82, 'Samastipur', 4),
(83, 'Saran', 4),
(84, 'Sheikhpura', 4),
(85, 'Sheohar', 4),
(86, 'Sitamarhi', 4),
(87, 'Siwan', 4),
(88, 'Supaul', 4),
(89, 'Vaishali', 4),
(90, 'West Champaran', 4),
(91, 'Bastar', 5),
(92, 'Bijapur(CGH)', 5),
(93, 'Bilaspur(CGH)', 5),
(94, 'Dantewada', 5),
(95, 'Dhamtari', 5),
(96, 'Durg', 5),
(97, 'Gariaband', 5),
(98, 'Janjgir-champa', 5),
(99, 'Jashpur', 5),
(100, 'Kanker', 5),
(101, 'Kawardha', 5),
(102, 'Korba', 5),
(103, 'Koriya', 5),
(104, 'Mahasamund', 5),
(105, 'Narayanpur', 5),
(106, 'Raigarh', 5),
(107, 'Raipur', 5),
(108, 'Rajnandgaon', 5),
(109, 'Surguja', 5),
(110, 'North Goa', 6),
(111, 'South Goa', 6),
(112, 'Ahmedabad', 7),
(113, 'Amreli', 7),
(114, 'Anand', 7),
(115, 'Banaskantha', 7),
(116, 'Bharuch', 7),
(117, 'Bhavnagar', 7),
(118, 'Dahod', 7),
(119, 'Gandhi Nagar', 7),
(120, 'Jamnagar', 7),
(121, 'Junagadh', 7),
(122, 'Kachchh', 7),
(123, 'Kheda', 7),
(124, 'Mahesana', 7),
(125, 'Narmada', 7),
(126, 'Navsari', 7),
(127, 'Panch Mahals', 7),
(128, 'Patan', 7),
(129, 'Porbandar', 7),
(130, 'Rajkot', 7),
(131, 'Sabarkantha', 7),
(132, 'Surat', 7),
(133, 'Surendra Nagar', 7),
(134, 'Tapi', 7),
(135, 'The Dangs', 7),
(136, 'Vadodara', 7),
(137, 'Valsad', 7),
(138, 'Ambala', 8),
(139, 'Bhiwani', 8),
(140, 'Faridabad', 8),
(141, 'Fatehabad', 8),
(142, 'Gurgaon', 8),
(143, 'Hisar', 8),
(144, 'Jhajjar', 8),
(145, 'Jind', 8),
(146, 'Kaithal', 8),
(147, 'Karnal', 8),
(148, 'Kurukshetra', 8),
(149, 'Mahendragarh', 8),
(150, 'Panchkula', 8),
(151, 'Panipat', 8),
(152, 'Rewari', 8),
(153, 'Rohtak', 8),
(154, 'Sirsa', 8),
(155, 'Sonipat', 8),
(156, 'Yamuna Nagar', 8),
(157, 'Bilaspur (HP)', 9),
(158, 'Chamba', 9),
(159, 'Hamirpur(HP)', 9),
(160, 'Kangra', 9),
(161, 'Kinnaur', 9),
(162, 'Kullu', 9),
(163, 'Lahul & Spiti', 9),
(164, 'Mandi', 9),
(165, 'Shimla', 9),
(166, 'Sirmaur', 9),
(167, 'Solan', 9),
(168, 'Una', 9),
(169, 'Ananthnag', 10),
(170, 'Bandipur', 10),
(171, 'Baramulla', 10),
(172, 'Budgam', 10),
(173, 'Doda', 10),
(174, 'Jammu', 10),
(175, 'Kargil', 10),
(176, 'Kathua', 10),
(177, 'Kulgam', 10),
(178, 'Kupwara', 10),
(179, 'Leh', 10),
(180, 'Poonch', 10),
(181, 'Pulwama', 10),
(182, 'Rajauri', 10),
(183, 'Reasi', 10),
(184, 'Shopian', 10),
(185, 'Srinagar', 10),
(186, 'Udhampur', 10),
(187, 'Bokaro', 11),
(188, 'Chatra', 11),
(189, 'Deoghar', 11),
(190, 'Dhanbad', 11),
(191, 'Dumka', 11),
(192, 'East Singhbhum', 11),
(193, 'Garhwa', 11),
(194, 'Giridh', 11),
(195, 'Godda', 11),
(196, 'Gumla', 11),
(197, 'Hazaribag', 11),
(198, 'Jamtara', 11),
(199, 'Khunti', 11),
(200, 'Koderma', 11),
(201, 'Latehar', 11),
(202, 'Lohardaga', 11),
(203, 'Pakur', 11),
(204, 'Palamau', 11),
(205, 'Ramgarh', 11),
(206, 'Ranchi', 11),
(207, 'Sahibganj', 11),
(208, 'Seraikela-kharsawan', 11),
(209, 'Simdega', 11),
(210, 'West Singhbhum', 11),
(211, 'Bagalkot', 12),
(212, 'Bangalore', 12),
(213, 'Bangalore Rural', 12),
(214, 'Belgaum', 12),
(215, 'Bellary', 12),
(216, 'Bidar', 12),
(217, 'Bijapur(KAR)', 12),
(218, 'Chamrajnagar', 12),
(219, 'Chickmagalur', 12),
(220, 'Chikkaballapur', 12),
(221, 'Chitradurga', 12),
(222, 'Dakshina Kannada', 12),
(223, 'Davangere', 12),
(224, 'Dharwad', 12),
(225, 'Gadag', 12),
(226, 'Gulbarga', 12),
(227, 'Hassan', 12),
(228, 'Haveri', 12),
(229, 'Kodagu', 12),
(230, 'Kolar', 12),
(231, 'Koppal', 12),
(232, 'Mandya', 12),
(233, 'Mysore', 12),
(234, 'Raichur', 12),
(235, 'Ramanagar', 12),
(236, 'Shimoga', 12),
(237, 'Tumkur', 12),
(238, 'Udupi', 12),
(239, 'Uttara Kannada', 12),
(240, 'Yadgir', 12),
(241, 'Alappuzha', 13),
(242, 'Ernakulam', 13),
(243, 'Idukki', 13),
(244, 'Kannur', 13),
(245, 'Kasargod', 13),
(246, 'Kollam', 13),
(247, 'Kottayam', 13),
(248, 'Kozhikode', 13),
(249, 'Malappuram', 13),
(250, 'Palakkad', 13),
(251, 'Pathanamthitta', 13),
(252, 'Thiruvananthapuram', 13),
(253, 'Thrissur', 13),
(254, 'Wayanad', 13),
(255, 'Alirajpur', 14),
(256, 'Anuppur', 14),
(257, 'Ashok Nagar', 14),
(258, 'Balaghat', 14),
(259, 'Barwani', 14),
(260, 'Betul', 14),
(261, 'Bhind', 14),
(262, 'Bhopal', 14),
(263, 'Burhanpur', 14),
(264, 'Chhatarpur', 14),
(265, 'Chhindwara', 14),
(266, 'Damoh', 14),
(267, 'Datia', 14),
(268, 'Dewas', 14),
(269, 'Dhar', 14),
(270, 'Dindori', 14),
(271, 'East Nimar', 14),
(272, 'Guna', 14),
(273, 'Gwalior', 14),
(274, 'Harda', 14),
(275, 'Hoshangabad', 14),
(276, 'Indore', 14),
(277, 'Jabalpur', 14),
(278, 'Jhabua', 14),
(279, 'Katni', 14),
(280, 'Khandwa', 14),
(281, 'Khargone', 14),
(282, 'Mandla', 14),
(283, 'Mandsaur', 14),
(284, 'Morena', 14),
(285, 'Narsinghpur', 14),
(286, 'Neemuch', 14),
(287, 'Panna', 14),
(288, 'Raisen', 14),
(289, 'Rajgarh', 14),
(290, 'Ratlam', 14),
(291, 'Rewa', 14),
(292, 'Sagar', 14),
(293, 'Satna', 14),
(294, 'Sehore', 14),
(295, 'Seoni', 14),
(296, 'Shahdol', 14),
(297, 'Shajapur', 14),
(298, 'Sheopur', 14),
(299, 'Shivpuri', 14),
(300, 'Sidhi', 14),
(301, 'Singrauli', 14),
(302, 'Tikamgarh', 14),
(303, 'Ujjain', 14),
(304, 'Umaria', 14),
(305, 'Vidisha', 14),
(306, 'West Nimar', 14),
(307, 'Ahmed Nagar', 15),
(308, 'Akola', 15),
(309, 'Amravati', 15),
(310, 'Aurangabad', 15),
(311, 'Beed', 15),
(312, 'Bhandara', 15),
(313, 'Buldhana', 15),
(314, 'Chandrapur', 15),
(315, 'Dhule', 15),
(316, 'Gadchiroli', 15),
(317, 'Gondia', 15),
(318, 'Hingoli', 15),
(319, 'Jalgaon', 15),
(320, 'Jalna', 15),
(321, 'Kolhapur', 15),
(322, 'Latur', 15),
(323, 'Mumbai', 15),
(324, 'Nagpur', 15),
(325, 'Nanded', 15),
(326, 'Nandurbar', 15),
(327, 'Nashik', 15),
(328, 'Osmanabad', 15),
(329, 'Parbhani', 15),
(330, 'Pune', 15),
(331, 'Raigarh(MH)', 15),
(332, 'Ratnagiri', 15),
(333, 'Sangli', 15),
(334, 'Satara', 15),
(335, 'Sindhudurg', 15),
(336, 'Solapur', 15),
(337, 'Thane', 15),
(338, 'Wardha', 15),
(339, 'Washim', 15),
(340, 'Yavatmal', 15),
(341, 'Bishnupur', 16),
(342, 'Chandel', 16),
(343, 'Churachandpur', 16),
(344, 'Imphal East', 16),
(345, 'Imphal West', 16),
(346, 'Senapati', 16),
(347, 'Tamenglong', 16),
(348, 'Thoubal', 16),
(349, 'Ukhrul', 16),
(350, 'East Garo Hills', 17),
(351, 'East Khasi Hills', 17),
(352, 'Jaintia Hills', 17),
(353, 'Ri Bhoi', 17),
(354, 'South Garo Hills', 17),
(355, 'West Garo Hills', 17),
(356, 'West Khasi Hills', 17),
(357, 'Aizawl', 18),
(358, 'Champhai', 18),
(359, 'Kolasib', 18),
(360, 'Lawngtlai', 18),
(361, 'Lunglei', 18),
(362, 'Mammit', 18),
(363, 'Saiha', 18),
(364, 'Serchhip', 18),
(365, 'Dimapur', 19),
(366, 'Kiphire', 19),
(367, 'Kohima', 19),
(368, 'Longleng', 19),
(369, 'Mokokchung', 19),
(370, 'Mon', 19),
(371, 'Peren', 19),
(372, 'Phek', 19),
(373, 'Tuensang', 19),
(374, 'Wokha', 19),
(375, 'Zunhebotto', 19),
(376, 'Angul', 20),
(377, 'Balangir', 20),
(378, 'Baleswar', 20),
(379, 'Bargarh', 20),
(380, 'Bhadrak', 20),
(381, 'Boudh', 20),
(382, 'Cuttack', 20),
(383, 'Debagarh', 20),
(384, 'Dhenkanal', 20),
(385, 'Gajapati', 20),
(386, 'Ganjam', 20),
(387, 'Jagatsinghapur', 20),
(388, 'Jajapur', 20),
(389, 'Jharsuguda', 20),
(390, 'Kalahandi', 20),
(391, 'Kandhamal', 20),
(392, 'Kendrapara', 20),
(393, 'Kendujhar', 20),
(394, 'Khorda', 20),
(395, 'Koraput', 20),
(396, 'Malkangiri', 20),
(397, 'Mayurbhanj', 20),
(398, 'Nabarangapur', 20),
(399, 'Nayagarh', 20),
(400, 'Nuapada', 20),
(401, 'Puri', 20),
(402, 'Rayagada', 20),
(403, 'Sambalpur', 20),
(404, 'Sonapur', 20),
(405, 'Sundergarh', 20),
(406, 'Amritsar', 21),
(407, 'Barnala', 21),
(408, 'Bathinda', 21),
(409, 'Faridkot', 21),
(410, 'Fatehgarh Sahib', 21),
(411, 'Fazilka', 21),
(412, 'Firozpur', 21),
(413, 'Gurdaspur', 21),
(414, 'Hoshiarpur', 21),
(415, 'Jalandhar', 21),
(416, 'Kapurthala', 21),
(417, 'Ludhiana', 21),
(418, 'Mansa', 21),
(419, 'Moga', 21),
(420, 'Mohali', 21),
(421, 'Muktsar', 21),
(422, 'Nawanshahr', 21),
(423, 'Pathankot', 21),
(424, 'Patiala', 21),
(425, 'Ropar', 21),
(426, 'Rupnagar', 21),
(427, 'Sangrur', 21),
(428, 'Tarn Taran', 21),
(429, 'Ajmer', 22),
(430, 'Alwar', 22),
(431, 'Banswara', 22),
(432, 'Baran', 22),
(433, 'Barmer', 22),
(434, 'Bharatpur', 22),
(435, 'Bhilwara', 22),
(436, 'Bikaner', 22),
(437, 'Bundi', 22),
(438, 'Chittorgarh', 22),
(439, 'Churu', 22),
(440, 'Dausa', 22),
(441, 'Dholpur', 22),
(442, 'Dungarpur', 22),
(443, 'Ganganagar', 22),
(444, 'Hanumangarh', 22),
(445, 'Jaipur', 22),
(446, 'Jaisalmer', 22),
(447, 'Jalor', 22),
(448, 'Jhalawar', 22),
(449, 'Jhujhunu', 22),
(450, 'Jodhpur', 22),
(451, 'Karauli', 22),
(452, 'Kota', 22),
(453, 'Nagaur', 22),
(454, 'Pali', 22),
(455, 'Rajsamand', 22),
(456, 'Sawai Madhopur', 22),
(457, 'Sikar', 22),
(458, 'Sirohi', 22),
(459, 'Tonk', 22),
(460, 'Udaipur', 22),
(461, 'East Sikkim', 23),
(462, 'North Sikkim', 23),
(463, 'South Sikkim', 23),
(464, 'West Sikkim', 23),
(465, 'Ariyalur', 24),
(466, 'Chennai', 24),
(467, 'Coimbatore', 24),
(468, 'Cuddalore', 24),
(469, 'Dharmapuri', 24),
(470, 'Dindigul', 24),
(471, 'Erode', 24),
(472, 'Kanchipuram', 24),
(473, 'Kanyakumari', 24),
(474, 'Karur', 24),
(475, 'Krishnagiri', 24),
(476, 'Madurai', 24),
(477, 'Nagapattinam', 24),
(478, 'Namakkal', 24),
(479, 'Nilgiris', 24),
(480, 'Perambalur', 24),
(481, 'Pudukkottai', 24),
(482, 'Ramanathapuram', 24),
(483, 'Salem', 24),
(484, 'Sivaganga', 24),
(485, 'Thanjavur', 24),
(486, 'Theni', 24),
(487, 'Tiruchirappalli', 24),
(488, 'Tirunelveli', 24),
(489, 'Tiruvallur', 24),
(490, 'Tiruvannamalai', 24),
(491, 'Tiruvarur', 24),
(492, 'Tuticorin', 24),
(493, 'Vellore', 24),
(494, 'Villupuram', 24),
(495, 'Virudhunagar', 24),
(496, 'Adilabad', 25),
(497, 'Hyderabad', 25),
(498, 'K.V.Rangareddy', 25),
(499, 'Karim Nagar', 25),
(500, 'Khammam', 25),
(501, 'Mahabub Nagar', 25),
(502, 'Medak', 25),
(503, 'Nalgonda', 25),
(504, 'Nizamabad', 25),
(505, 'Warangal', 25),
(506, 'Dhalai', 26),
(507, 'North Tripura', 26),
(508, 'South Tripura', 26),
(509, 'West Tripura', 26),
(510, 'Agra', 27),
(511, 'Aligarh', 27),
(512, 'Allahabad', 27),
(513, 'Ambedkar Nagar', 27),
(514, 'Auraiya', 27),
(515, 'Azamgarh', 27),
(516, 'Bagpat', 27),
(517, 'Bahraich', 27),
(518, 'Ballia', 27),
(519, 'Balrampur', 27),
(520, 'Banda', 27),
(521, 'Barabanki', 27),
(522, 'Bareilly', 27),
(523, 'Basti', 27),
(524, 'Bijnor', 27),
(525, 'Budaun', 27),
(526, 'Bulandshahr', 27),
(527, 'Chandauli', 27),
(528, 'Chitrakoot', 27),
(529, 'Deoria', 27),
(530, 'Etah', 27),
(531, 'Etawah', 27),
(532, 'Faizabad', 27),
(533, 'Farrukhabad', 27),
(534, 'Fatehpur', 27),
(535, 'Firozabad', 27),
(536, 'Gautam Buddha Nagar', 27),
(537, 'Ghaziabad', 27),
(538, 'Ghazipur', 27),
(539, 'Gonda', 27),
(540, 'Gorakhpur', 27),
(541, 'Hamirpur', 27),
(542, 'Hardoi', 27),
(543, 'Hathras', 27),
(544, 'Jalaun', 27),
(545, 'Jaunpur', 27),
(546, 'Jhansi', 27),
(547, 'Jyotiba Phule Nagar', 27),
(548, 'Kannauj', 27),
(549, 'Kanpur Dehat', 27),
(550, 'Kanpur Nagar', 27),
(551, 'Kaushambi', 27),
(552, 'Kheri', 27),
(553, 'Kushinagar', 27),
(554, 'Lalitpur', 27),
(555, 'Lucknow', 27),
(556, 'Maharajganj', 27),
(557, 'Mahoba', 27),
(558, 'Mainpuri', 27),
(559, 'Mathura', 27),
(560, 'Mau', 27),
(561, 'Meerut', 27),
(562, 'Mirzapur', 27),
(563, 'Moradabad', 27),
(564, 'Muzaffarnagar', 27),
(565, 'Pilibhit', 27),
(566, 'Pratapgarh', 27),
(567, 'Raebareli', 27),
(568, 'Rampur', 27),
(569, 'Saharanpur', 27),
(570, 'Sant Kabir Nagar', 27),
(571, 'Sant Ravidas Nagar', 27),
(572, 'Shahjahanpur', 27),
(573, 'Shrawasti', 27),
(574, 'Siddharthnagar', 27),
(575, 'Sitapur', 27),
(576, 'Sonbhadra', 27),
(577, 'Sultanpur', 27),
(578, 'Unnao', 27),
(579, 'Varanasi', 27),
(580, 'Almora', 28),
(581, 'Bageshwar', 28),
(582, 'Chamoli', 28),
(583, 'Champawat', 28),
(584, 'Dehradun', 28),
(585, 'Haridwar', 28),
(586, 'Nainital', 28),
(587, 'Pauri Garhwal', 28),
(588, 'Pithoragarh', 28),
(589, 'Rudraprayag', 28),
(590, 'Tehri Garhwal', 28),
(591, 'Udham Singh Nagar', 28),
(592, 'Uttarkashi', 28),
(593, 'Bankura', 29),
(594, 'Bardhaman', 29),
(595, 'Birbhum', 29),
(596, 'Cooch Behar', 29),
(597, 'Darjiling', 29),
(598, 'East Midnapore', 29),
(599, 'Hooghly', 29),
(600, 'Howrah', 29),
(601, 'Jalpaiguri', 29),
(602, 'Kolkata', 29),
(603, 'Malda', 29),
(604, 'Medinipur', 29),
(605, 'Murshidabad', 29),
(606, 'Nadia', 29),
(607, 'North 24 Parganas', 29),
(608, 'North Dinajpur', 29),
(609, 'Puruliya', 29),
(610, 'South 24 Parganas', 29),
(611, 'South Dinajpur', 29),
(612, 'West Midnapore', 29),
(613, 'Nicobar', 30),
(614, 'North And Middle Andaman', 30),
(615, 'South Andaman', 30),
(616, 'Chandigarh', 31),
(617, 'Dadra & Nagar Haveli', 32),
(618, 'Daman', 33),
(619, 'Diu', 33),
(620, 'Lakshadweep', 34),
(621, 'Central Delhi', 35),
(622, 'East Delhi', 35),
(623, 'New Delhi', 35),
(624, 'North Delhi', 35),
(625, 'North East Delhi', 35),
(626, 'North West Delhi', 35),
(627, 'South Delhi', 35),
(628, 'South West Delhi', 35),
(629, 'West Delhi', 35),
(630, 'Karaikal', 36),
(631, 'Mahe', 36),
(632, 'Pondicherry', 36);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `upload_date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date_time` datetime DEFAULT NULL,
  `user_id_user` bigint(20) DEFAULT NULL,
  `doc_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-pan,2-address,3-bank',
  `doc_no` varchar(30) DEFAULT NULL,
  `file_path` varchar(150) DEFAULT NULL,
  `doc_status` tinyint(4) DEFAULT 1 COMMENT '1- uploaded,2-rejected,3- verified',
  `approve_reject_comment` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ibo_business_detail`
--

DROP TABLE IF EXISTS `ibo_business_detail`;
CREATE TABLE IF NOT EXISTS `ibo_business_detail` (
  `ibd_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_user` int(11) DEFAULT NULL,
  `business_name` varchar(256) DEFAULT NULL,
  `business_designation` varchar(256) DEFAULT NULL,
  `business_segment` int(6) DEFAULT NULL,
  `business_category` int(6) DEFAULT NULL,
  `business_subcategory` int(6) DEFAULT NULL,
  `actual_subcategory` int(4) DEFAULT NULL,
  `business_address` varchar(256) DEFAULT NULL,
  `business_city` varchar(156) DEFAULT NULL,
  `gst_address` varchar(256) DEFAULT NULL,
  `business_pan` varchar(20) DEFAULT NULL,
  `current_business` varchar(156) DEFAULT NULL,
  `business_email` varchar(150) DEFAULT NULL,
  `business_website` varchar(150) DEFAULT NULL,
  `overall_experience` float DEFAULT NULL,
  `social_presence` varchar(156) DEFAULT NULL,
  `paymentdetail_id` int(11) DEFAULT NULL,
  `approval_status` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`ibd_id`),
  UNIQUE KEY `user_id_user` (`user_id_user`,`business_subcategory`),
  KEY `paymentdetail_id` (`paymentdetail_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ibo_business_detail`
--

INSERT INTO `ibo_business_detail` (`ibd_id`, `user_id_user`, `business_name`, `business_designation`, `business_segment`, `business_category`, `business_subcategory`, `actual_subcategory`, `business_address`, `business_city`, `gst_address`, `business_pan`, `current_business`, `business_email`, `business_website`, `overall_experience`, `social_presence`, `paymentdetail_id`, `approval_status`) VALUES
(1, 24, 'ssaas', 'ssasasss', 1, 1, 2, 2, 'Mani Nagar,Prachinagar', 'Bhadrak', 'Mani Nagar,Prachinagar', 'qwwwqwqwqwqww', 'wqwqwwwqwqw', 'manojdashmca@gmail.com', 'wwwqwqwqwqw', 0, 'Facebook', 1, 0),
(2, 24, 'ssaas', 'ssasasss', 1, 1, 5, 5, 'Mani Nagar,Prachinagar', 'Bhadrak', 'Mani Nagar,Prachinagar', 'qwwwqwqwqwqww', 'wqwqwwwqwqw', 'manojdashmca@gmail.com', 'wwwqwqwqwqw', 0, 'Facebook', 1, 0),
(3, 25, 'ssaas', 'ssasasss', 1, 1, 3, 3, 'Mani Nagar,Prachinagar', 'Bhadrak', '467E, 2nd Main, 5th Cross, Sidhartha Layout', 'qwwwqwqwqwqww', 'wqwqwwwqwqw', 'manojdashmca@gmail.com', 'wwwqwqwqwqw', 23233200, 'Facebook', 2, 0),
(4, 26, 'ssaas', 'ssasasss', 1, 1, 1, 1, 'Mani Nagar,Prachinagar', 'Bhadrak', 'Mani Nagar,Prachinagar', 'qwwwqwqwqwqww', 'wqwqwwwqwqw', 'manojdashmca@gmail.com', 'wwwqwqwqwqw', 23233200, 'Facebook,Instagram', 3, 0),
(5, 27, 'ssaas', 'ssasasss', 1, 1, 8, 8, 'Mani Nagar,Prachinagar', 'Bhadrak', 'Mani Nagar,Prachinagar', 'ASJPD7878R', 'wqwqwwwqwqw', 'manojdashmca@gmail.com', 'wwwqwqwqwqw', 23233200, 'Instagram,Linkedin', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ibo_joining_payment_detail`
--

DROP TABLE IF EXISTS `ibo_joining_payment_detail`;
CREATE TABLE IF NOT EXISTS `ibo_joining_payment_detail` (
  `mpd_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_user` int(11) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `joining_fee` float DEFAULT 0,
  `topup_fee` float DEFAULT 0,
  `gst` float DEFAULT 0,
  `payment_amount` float DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_remark` varchar(256) DEFAULT NULL,
  `pg_id` int(11) DEFAULT NULL,
  `payment_status` int(2) DEFAULT 1 COMMENT '1-Initiated,2-Approved,3-rejected',
  `payment_approved_by` int(11) DEFAULT NULL,
  `payment_approve_comment` varchar(256) DEFAULT NULL,
  `payment_approve_reject_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `payout_status` int(11) DEFAULT 0,
  PRIMARY KEY (`mpd_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ibo_joining_payment_detail`
--

INSERT INTO `ibo_joining_payment_detail` (`mpd_id`, `user_id_user`, `payment_date`, `joining_fee`, `topup_fee`, `gst`, `payment_amount`, `payment_method`, `payment_remark`, `pg_id`, `payment_status`, `payment_approved_by`, `payment_approve_comment`, `payment_approve_reject_date`, `payout_status`) VALUES
(1, 24, '2023-05-10 00:46:29', 25000, 5000, 5400, 35400, 'Cash', '*7878', NULL, 1, NULL, NULL, NULL, 0),
(2, 25, '2023-05-10 00:50:20', 25000, 0, 4500, 29500, 'Bank Transfer', 'sdsdsdsdsdsd', NULL, 1, NULL, NULL, NULL, 0),
(3, 26, '2023-05-10 08:47:57', 25000, 0, 4500, 29500, 'Cash', '*9090', NULL, 1, NULL, NULL, NULL, 0),
(4, 27, '2023-05-10 08:53:32', 25000, 0, 4500, 29500, 'Cash', '*9090', NULL, 1, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ibo_sponsor_position`
--

DROP TABLE IF EXISTS `ibo_sponsor_position`;
CREATE TABLE IF NOT EXISTS `ibo_sponsor_position` (
  `isp_id` int(11) NOT NULL AUTO_INCREMENT,
  `sponsor` bigint(20) DEFAULT NULL,
  `child` bigint(20) DEFAULT NULL,
  `level` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`isp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ibo_sponsor_position`
--

INSERT INTO `ibo_sponsor_position` (`isp_id`, `sponsor`, `child`, `level`) VALUES
(1, 2, 24, 1),
(2, 2, 25, 1),
(3, 2, 26, 1),
(4, 2, 27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ibo_user`
--

DROP TABLE IF EXISTS `ibo_user`;
CREATE TABLE IF NOT EXISTS `ibo_user` (
  `iu_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_user` int(11) DEFAULT NULL,
  `user_is_active` tinyint(4) NOT NULL DEFAULT 0,
  `user_activation_date` datetime DEFAULT NULL,
  `user_activation_type` tinyint(1) DEFAULT NULL COMMENT '1- Autometic,2-Manual',
  `payout_status` tinyint(1) DEFAULT 0,
  `joining_type` tinyint(1) DEFAULT 1 COMMENT '1- Beginner(10%),2-Starter(15%)',
  `last_update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`iu_id`),
  UNIQUE KEY `user_id_user` (`user_id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ibo_user`
--

INSERT INTO `ibo_user` (`iu_id`, `user_id_user`, `user_is_active`, `user_activation_date`, `user_activation_type`, `payout_status`, `joining_type`, `last_update_date`) VALUES
(1, 2, 0, NULL, NULL, 0, 1, NULL),
(3, 24, 0, NULL, NULL, 0, 1, NULL),
(4, 25, 0, NULL, NULL, 0, 1, NULL),
(5, 26, 0, NULL, NULL, 0, 1, NULL),
(6, 27, 0, NULL, NULL, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `location_module`
--

DROP TABLE IF EXISTS `location_module`;
CREATE TABLE IF NOT EXISTS `location_module` (
  `lm_id` int(11) NOT NULL AUTO_INCREMENT,
  `lm_name` varchar(160) DEFAULT NULL,
  `lm_code` varchar(15) DEFAULT NULL,
  `lm_city` varchar(156) DEFAULT NULL,
  `lm_state` varchar(156) DEFAULT NULL,
  `lm_country` varchar(156) DEFAULT NULL,
  `lm_create_date` timestamp NULL DEFAULT current_timestamp(),
  `lm_status` tinyint(4) DEFAULT 1,
  `director_id` int(11) DEFAULT NULL,
  `director_join_date` datetime DEFAULT NULL,
  `assistant_director_id` int(11) DEFAULT NULL,
  `assistant_director_join_date` datetime DEFAULT NULL,
  `associate_director_id` int(11) DEFAULT NULL,
  `associate_director_join_date` datetime DEFAULT NULL,
  PRIMARY KEY (`lm_id`),
  KEY `lm_name` (`lm_name`),
  KEY `director_id` (`director_id`),
  KEY `assistant_director_id` (`assistant_director_id`),
  KEY `associate_director_id` (`associate_director_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_module`
--

INSERT INTO `location_module` (`lm_id`, `lm_name`, `lm_code`, `lm_city`, `lm_state`, `lm_country`, `lm_create_date`, `lm_status`, `director_id`, `director_join_date`, `assistant_director_id`, `assistant_director_join_date`, `associate_director_id`, `associate_director_join_date`) VALUES
(1, 'Test', 'LM-0001', 'Test', 'Andhra Pradesh', 'Test', '2023-04-21 17:27:49', 1, 2, '2023-05-07 23:44:39', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mail_link_keys`
--

DROP TABLE IF EXISTS `mail_link_keys`;
CREATE TABLE IF NOT EXISTS `mail_link_keys` (
  `id_key` bigint(20) NOT NULL AUTO_INCREMENT,
  `key_string` varchar(256) NOT NULL,
  `key_created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `key_expire_time` datetime DEFAULT NULL,
  `key_type` int(2) DEFAULT NULL COMMENT '1-Forgot Password',
  `key_generate_ip` varchar(30) DEFAULT NULL,
  `key_generate_os` varchar(56) DEFAULT NULL,
  `key_generate_browser` varchar(56) DEFAULT NULL,
  `key_status` tinyint(1) DEFAULT 1,
  `log_id_log` bigint(20) DEFAULT NULL,
  `user_id_user` bigint(20) DEFAULT NULL,
  `key_used_ip` varchar(30) DEFAULT NULL,
  `key_used_browser` varchar(156) DEFAULT NULL,
  `key_used_os` varchar(156) DEFAULT NULL,
  `key_used_date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_key`),
  UNIQUE KEY `key` (`key_string`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_category`
--

DROP TABLE IF EXISTS `master_category`;
CREATE TABLE IF NOT EXISTS `master_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(256) DEFAULT NULL,
  `category_status` tinyint(4) DEFAULT 1,
  `segment_id_segment` int(5) DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`,`segment_id_segment`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_category`
--

INSERT INTO `master_category` (`category_id`, `category_name`, `category_status`, `segment_id_segment`) VALUES
(1, 'Advertising & Branding Agency', 1, 1),
(2, 'Digital Partner (Promotion)', 1, 1),
(3, 'Promotion', 1, 1),
(4, 'Modelling Agency', 1, 1),
(5, 'PR Agency', 1, 1),
(6, 'Print Media ', 2, 1),
(7, 'Affiliate Marketing ', 1, 1),
(8, 'Print Media1', 1, 1),
(9, 'Student', 1, 26),
(10, 'Home Made Product', 1, 27);

-- --------------------------------------------------------

--
-- Table structure for table `master_segment`
--

DROP TABLE IF EXISTS `master_segment`;
CREATE TABLE IF NOT EXISTS `master_segment` (
  `segment_id` int(11) NOT NULL AUTO_INCREMENT,
  `segment_name` varchar(256) DEFAULT NULL,
  `segment_status` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`segment_id`),
  UNIQUE KEY `segment_name` (`segment_name`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_segment`
--

INSERT INTO `master_segment` (`segment_id`, `segment_name`, `segment_status`) VALUES
(1, 'Advertising & Promotion', 1),
(2, 'Agriculture', 1),
(3, 'Arts & Crafts', 1),
(4, 'Beauty Services', 1),
(5, 'Construction', 1),
(6, 'Consultancy', 1),
(7, 'Education', 1),
(8, 'Event', 1),
(9, 'Finance', 1),
(10, 'Food & Bevrage', 1),
(11, 'Health & Wellness', 1),
(12, 'Insurance', 1),
(13, 'Legal', 1),
(14, 'Maintenance', 1),
(15, 'Manufacturing', 1),
(16, 'Marketing', 1),
(17, 'Production', 1),
(18, 'Retail', 1),
(19, 'Security', 1),
(20, 'Technology', 1),
(21, 'Telecommunication', 1),
(22, 'Transport', 2),
(23, 'Travel', 2),
(24, 'MyChoice', 1),
(25, 'New Segment', 1),
(26, 'Student For Learning', 1),
(27, 'Women\'s Home Made Product', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_sub_category`
--

DROP TABLE IF EXISTS `master_sub_category`;
CREATE TABLE IF NOT EXISTS `master_sub_category` (
  `sub_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_category_name` varchar(256) DEFAULT NULL,
  `sub_category_status` tinyint(4) DEFAULT 1,
  `category_id_category` int(6) DEFAULT NULL,
  `segment_id_segment` int(5) DEFAULT NULL,
  PRIMARY KEY (`sub_category_id`),
  UNIQUE KEY `sub_category_name` (`sub_category_name`,`category_id_category`,`segment_id_segment`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_sub_category`
--

INSERT INTO `master_sub_category` (`sub_category_id`, `sub_category_name`, `sub_category_status`, `category_id_category`, `segment_id_segment`) VALUES
(1, 'News Paper', 1, 1, 1),
(2, 'Television', 1, 1, 1),
(3, 'OTT Platform', 1, 1, 1),
(4, 'Radio Channels', 1, 1, 1),
(5, 'Social Medial', 1, 1, 2),
(6, 'Exibitions & Stalls', 1, 1, 3),
(7, 'Modelling Agency', 1, 1, 4),
(8, 'PR Agency', 1, 1, 5),
(9, 'Printing Solutions (All types)', 2, 1, 6),
(10, 'Influencer Marketeer', 1, 1, 7),
(11, 'My Subcategory', 2, 1, 1),
(12, 'Student', 1, 9, 26),
(13, 'Agarbatti', 1, 10, 27);

-- --------------------------------------------------------

--
-- Table structure for table `member_income`
--

DROP TABLE IF EXISTS `member_income`;
CREATE TABLE IF NOT EXISTS `member_income` (
  `mi_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_user` int(11) DEFAULT NULL,
  `payout_id_payout` int(11) DEFAULT NULL,
  `payment_id_payment` int(11) DEFAULT NULL,
  `income_type` int(2) DEFAULT NULL,
  `income_amount` float DEFAULT 0,
  `mi_release_status` tinyint(1) DEFAULT 0,
  `mi_release_date` date DEFAULT NULL,
  `mi_release_detail` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`mi_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `module_id` int(4) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(50) NOT NULL,
  `module_status` tinyint(1) NOT NULL DEFAULT 1,
  `module_short_order` int(2) DEFAULT NULL,
  `module_is_default` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`module_id`, `module_name`, `module_status`, `module_short_order`, `module_is_default`) VALUES
(1, 'Admin Users', 1, 1, 0),
(2, 'Member', 1, 2, 0),
(3, 'Tree View', 1, 3, 0),
(4, 'Modules', 1, 4, 0),
(5, 'Payout', 1, 5, 0),
(6, 'Reports', 1, 6, 0),
(7, 'Utility', 1, 7, 0),
(8, 'Verification', 1, 8, 0),
(9, 'Configuration', 1, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `module_controls`
--

DROP TABLE IF EXISTS `module_controls`;
CREATE TABLE IF NOT EXISTS `module_controls` (
  `id_mc` int(11) NOT NULL AUTO_INCREMENT,
  `mc_name` varchar(70) NOT NULL,
  `mc_display_name` varchar(156) DEFAULT NULL,
  `module_id_module` int(4) NOT NULL,
  `mc_status` tinyint(1) NOT NULL DEFAULT 1,
  `mc_short_order` int(2) DEFAULT NULL,
  `mc_is_default` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_mc`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_controls`
--

INSERT INTO `module_controls` (`id_mc`, `mc_name`, `mc_display_name`, `module_id_module`, `mc_status`, `mc_short_order`, `mc_is_default`) VALUES
(1, 'add_new_user', 'Add New User', 1, 1, NULL, 0),
(2, 'edit_user', 'Edit User', 1, 1, NULL, 0),
(3, 'download_user', 'Download User', 1, 1, NULL, 0),
(4, 'user_controls', 'User Controls', 1, 1, NULL, 0),
(5, 'block_unblock_user', 'Block/unblock User', 1, 1, NULL, 0),
(7, 'add_Member', 'Add Member', 2, 1, NULL, 0),
(8, 'edit_member', 'Edit Member', 2, 1, NULL, 0),
(9, 'change_sponsor', 'Change Sponsor', 2, 1, NULL, 0),
(10, 'block_unblock_member', 'Block/Unblock Member', 2, 1, NULL, 0),
(15, 'add_module', 'Add Module', 4, 1, NULL, 0),
(16, 'edit_module', 'Edit Module', 4, 1, NULL, 0),
(17, 'block_unblock_module', 'Block/Unblock Module', 4, 1, NULL, 0),
(18, 'edit_director', 'Edit Director', 4, 1, NULL, 0),
(19, 'edit_associate_director', 'Edit Associate Director', 4, 1, NULL, 0),
(20, 'edit_assistant_director', 'Edit Assistant Director', 4, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `module_position_audit`
--

DROP TABLE IF EXISTS `module_position_audit`;
CREATE TABLE IF NOT EXISTS `module_position_audit` (
  `mpa_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_user` int(11) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL COMMENT '1-Diector,2-Associate_director,3-Assistant director',
  `date_of_join` datetime DEFAULT NULL,
  `date_of_exit` datetime DEFAULT NULL,
  `module_id_module` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`mpa_id`),
  KEY `user_id_user` (`user_id_user`),
  KEY `position_id` (`position_id`),
  KEY `module_id_module` (`module_id_module`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_position_audit`
--

INSERT INTO `module_position_audit` (`mpa_id`, `user_id_user`, `position_id`, `date_of_join`, `date_of_exit`, `module_id_module`, `status`) VALUES
(1, 1, 1, '2023-04-14 22:06:51', '2023-04-14 22:08:45', 2, 2),
(2, 6, 1, '2023-04-14 22:07:04', '2023-04-14 22:09:27', 2, 2),
(3, 1, 1, '2023-04-14 22:08:45', NULL, 2, 1),
(4, 6, 1, '2023-04-14 22:09:27', NULL, 2, 1),
(5, 2, 1, '2023-05-07 23:44:39', NULL, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_payout`
--

DROP TABLE IF EXISTS `monthly_payout`;
CREATE TABLE IF NOT EXISTS `monthly_payout` (
  `mp_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_user` bigint(20) DEFAULT NULL,
  `payout_id_payout` int(11) DEFAULT NULL,
  `md_income` float DEFAULT 0 COMMENT 'income as module director',
  `ma_income` decimal(10,0) DEFAULT 0 COMMENT 'income as module associate director',
  `mas_income` float DEFAULT 0 COMMENT 'ancome as module assistant director',
  `referrer_income` float DEFAULT 0 COMMENT 'referral income',
  `srcab_income` float NOT NULL DEFAULT 0 COMMENT 'sr consulting advisory board income',
  `cab_income` float DEFAULT 0 COMMENT 'consulting advisory board income',
  `nt_income` float DEFAULT 0 COMMENT 'national team income',
  `st_income` float DEFAULT 0 COMMENT 'state team income',
  `zt_income` float NOT NULL DEFAULT 0 COMMENT 'zonal team income',
  `bbi_head_income` float NOT NULL DEFAULT 0 COMMENT 'Income as BBI head',
  `gross_income` decimal(11,2) DEFAULT 0.00,
  `tds_deducted` decimal(11,2) DEFAULT 0.00,
  `net_income` decimal(11,2) DEFAULT 0.00,
  `release_status` tinyint(1) DEFAULT 0,
  `release_date` date DEFAULT NULL,
  `release_detail` varchar(156) DEFAULT NULL,
  `release_updated_date` datetime DEFAULT NULL,
  `release_updated_log` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`mp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `netsicure`
--

DROP TABLE IF EXISTS `netsicure`;
CREATE TABLE IF NOT EXISTS `netsicure` (
  `netsicureid` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_user` bigint(20) DEFAULT NULL,
  `user_mobile` bigint(20) DEFAULT NULL,
  `netsicure_code` varchar(8) NOT NULL,
  `generate_date_time` datetime NOT NULL,
  `valid_till` datetime NOT NULL,
  `netsecure_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`netsicureid`),
  UNIQUE KEY `user_id_user` (`user_id_user`,`netsicure_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_transaction`
--

DROP TABLE IF EXISTS `payment_transaction`;
CREATE TABLE IF NOT EXISTS `payment_transaction` (
  `pt_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_user` bigint(20) DEFAULT NULL,
  `pt_date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_date` date DEFAULT NULL,
  `payment_type` smallint(6) DEFAULT NULL,
  `payment_amount` float DEFAULT 0,
  `payment_remark` varchar(150) DEFAULT NULL,
  `utr_no` varchar(30) DEFAULT NULL,
  `payment_attachment` varchar(150) DEFAULT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 1,
  `create_log_id` bigint(20) DEFAULT NULL,
  `update_log_id` bigint(20) DEFAULT NULL,
  `update_date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`pt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payout_date`
--

DROP TABLE IF EXISTS `payout_date`;
CREATE TABLE IF NOT EXISTS `payout_date` (
  `payout_date_id` int(11) NOT NULL AUTO_INCREMENT,
  `payout_type` int(1) NOT NULL DEFAULT 1,
  `payout_start_date` datetime NOT NULL,
  `payout_close_date` datetime NOT NULL,
  `payout_release_date` date NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `trimming_allowed` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`payout_date_id`),
  UNIQUE KEY `payout_type` (`payout_type`,`payout_start_date`,`payout_close_date`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payout_date`
--

INSERT INTO `payout_date` (`payout_date_id`, `payout_type`, `payout_start_date`, `payout_close_date`, `payout_release_date`, `created_by`, `created_on`, `trimming_allowed`) VALUES
(1, 1, '2023-05-01 00:00:00', '2023-05-31 23:59:59', '2023-06-05', 'Server', '2023-05-07 17:02:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

DROP TABLE IF EXISTS `sms`;
CREATE TABLE IF NOT EXISTS `sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `getway_id` varchar(50) NOT NULL,
  `numbers` bigint(20) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `send_type` varchar(50) NOT NULL DEFAULT '1',
  `send_by` varchar(20) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `smtp_email`
--

DROP TABLE IF EXISTS `smtp_email`;
CREATE TABLE IF NOT EXISTS `smtp_email` (
  `smpt_send_id` int(11) NOT NULL AUTO_INCREMENT,
  `smtp_email_content` text DEFAULT NULL,
  `smtp_email_type` varchar(256) DEFAULT NULL,
  `smtp_sender_email` varchar(156) DEFAULT NULL,
  `smtp_target_emails` varchar(1056) DEFAULT NULL,
  `smtp_cc_emails` varchar(1056) DEFAULT NULL,
  `smtp_bcc_email` varchar(1056) DEFAULT NULL,
  `smtp_send_status` tinyint(1) NOT NULL DEFAULT 0,
  `smtp_send_date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `smtp_deliver_date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`smpt_send_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smtp_email`
--

INSERT INTO `smtp_email` (`smpt_send_id`, `smtp_email_content`, `smtp_email_type`, `smtp_sender_email`, `smtp_target_emails`, `smtp_cc_emails`, `smtp_bcc_email`, `smtp_send_status`, `smtp_send_date_time`, `smtp_deliver_date_time`) VALUES
(1, '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n                    <html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n                    <head>\r\n                        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n                        <title>WINWELLNESS Mailer</title>\r\n                        </head>\r\n                        <body>\r\n                            <table width=\"750\" border=\"0\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:12px;\" cellpadding=\"0\" cellspacing=\"0\">\r\n                                <tr style=\"background: url(http://bbi.com:8090/mailer/header_bg.jpg); height:90px; width:100%\">\r\n                                    <td  width=\"310\" align=\"left\" style=\"padding-left:10px;\"><img height=\"46\" src=\"http://bbi.com:8090/mailer/logo.png\"/></td>\r\n                                    <td width=\"430\" align=\"right\" style=\"padding-right:10px;\">\r\n                                        Office No.13, Amrut Madhura,<br>\r\n                                        RSC 28, Sector 3, Opp. Apna Bazaar,<br/>\r\n                                        Charkop Market,Kandivali West<br/>\r\n                                        Mumbai, Maharastra, India-400067<br/>\r\n                                        +91 816 949 1109,+91 937 239 0109 <br/>\r\n					Email- support@winwellness.in<br/>\r\n                                        Website- www.winwellness.in\r\n                                    </td>\r\n                                </tr>\r\n                                <tr>\r\n                                <td colspan=\"2\" valign=\"top\" style=\"padding-top:20px; padding-left:15px;\">Dear TOP Id,<p>You just changed your password, If not done please contact to site admin. </p></td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td style=\"padding-bottom:20px; padding-left:15px;\" colspan=\"2\">    \r\n                            <br/><br/><br/>Thank you,<br/><br/>Windna Life Science Pvt Ltd\r\n                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                    <tr>\r\n                        <td colspan=\"2\"><br/>This email was sent from an email address that can\'t receive emails. Please don\'t reply to this email. <i>The information in this e-mail may be confidential and/or legally privileged.  It is intended solely for the use of the addressee.  Access to this e-mail by anyone else is unauthorized.  If you are not the intended recipient, any disclosure, copying, distribution or any action taken or omitted to be taken in reliance on it, is prohibited and may be unlawful</i></td>\r\n                    </tr>\r\n                    <td style=\"background: url(http://bbi.com:8090/mailer/footer_bg.png) repeat-x; height:60px; width:100%\"  colspan=\"2\"  ><span style=\"float:left; padding-left:20px; margin-top:35px;\">All right reserved, Allay Healthcare 2010-2023</span>\r\n                        <span style=\"float:right; padding-right:20px; padding-top:15px;\">\r\n                            <p style=\"text-align:center\">\r\n                                    <!--Facebook icon-->\r\n                                    <a href=\"http://facebook.com\" target=\"_blank\"><img alt=\"\" src=\"http://bbi.com:8090/mailer/facebook.png\" style=\"height:30px; width:30px\" /></a>&nbsp;&nbsp;&nbsp;\r\n                                    <!--Google+ icon-->\r\n                                    <a href=\"http://plus.google.com\" target=\"_blank\"><img alt=\"\" src=\"http://bbi.com:8090/mailer/g+.png\" style=\"height:30px; width:30px\" /></a>&nbsp;&nbsp;&nbsp;\r\n                                    <!--Twitter icon-->\r\n                                    <a href=\"http://twitter.com\" target=\"_blank\"><img alt=\"\" src=\"http://bbi.com:8090/mailer/twitter.png\" style=\"height:30px; width:30px\" /></a>&nbsp;&nbsp;&nbsp;\r\n                                    <!--Linkedin icon-->\r\n                                    <a href=\"http://linkedin.com\" target=\"_blank\"><img alt=\"\" src=\"http://bbi.com:8090/mailer/linkedin.png\" style=\"height:30px; width:30px\" /></a>&nbsp;&nbsp;&nbsp;\r\n                                    <!--You tube icon-->\r\n                                    <a href=\"http://youtube.com\" target=\"_blank\"><img alt=\"\" src=\"http://bbi.com:8090/mailer/youtube.png\" style=\"height:30px; width:30px\" /></a>\r\n                              </p>\r\n                        </span></td>\r\n                    </tr>\r\n                    \r\n                    </table>\r\n                    </body>\r\n                    </html>', 'Password change Intimation ', 'support@medserve.co.in', '', NULL, NULL, 0, '2023-05-09 18:26:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `id_state` int(2) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(100) NOT NULL,
  `state_code` varchar(2) NOT NULL,
  PRIMARY KEY (`id_state`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id_state`, `state_name`, `state_code`) VALUES
(1, 'Andhra Pradesh', 'AP'),
(2, 'Arunachal Pradesh', 'AR'),
(3, 'Assam', 'AS'),
(4, 'Bihar', 'BR'),
(5, 'Chhattisgarh', 'CT'),
(6, 'Goa', 'GA'),
(7, 'Gujarat', 'GJ'),
(8, 'Haryana', 'HR'),
(9, 'Himachal Pradesh', 'HP'),
(10, 'Jammu and Kashmir', 'JK'),
(11, 'Jharkhand', 'JH'),
(12, 'Karnataka', 'KA'),
(13, 'Kerala', 'KL'),
(14, 'Madhya Pradesh', 'MP'),
(15, 'Maharashtra', 'MH'),
(16, 'Manipur', 'MN'),
(17, 'Meghalaya', 'ML'),
(18, 'Mizoram', 'MZ'),
(19, 'Nagaland', 'NL'),
(20, 'Odisha', 'OD'),
(21, 'Punjab', 'PB'),
(22, 'Rajasthan', 'RJ'),
(23, 'Sikkim', 'SK'),
(24, 'Tamil Nadu', 'TN'),
(25, 'Telangana', 'TG'),
(26, 'Tripura', 'TR'),
(27, 'Uttar Pradesh', 'UP'),
(28, 'Uttarakhand', 'UT'),
(29, 'West Bengal', 'WB'),
(30, 'Andaman and Nicobar Islands', 'AN'),
(31, 'Chandigarh', 'CH'),
(32, 'Dadra and Nagar Haveli', 'DN'),
(33, 'Daman and Diu', 'DD'),
(34, 'Lakshadweep', 'LD'),
(35, 'National Capital Territory of Delhi', 'DL'),
(36, 'Puducherry', 'PY');

-- --------------------------------------------------------

--
-- Table structure for table `team_consulting_board`
--

DROP TABLE IF EXISTS `team_consulting_board`;
CREATE TABLE IF NOT EXISTS `team_consulting_board` (
  `cbt_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_user` int(11) DEFAULT NULL,
  `added_on` timestamp NULL DEFAULT current_timestamp(),
  `addition_type` tinyint(4) DEFAULT 1 COMMENT '1- manual,2-autometic',
  `status` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`cbt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team_consulting_board`
--

INSERT INTO `team_consulting_board` (`cbt_id`, `user_id_user`, `added_on`, `addition_type`, `status`) VALUES
(1, 2, '2023-05-10 10:43:33', 1, 2),
(2, 2, '2023-05-10 10:46:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `team_national`
--

DROP TABLE IF EXISTS `team_national`;
CREATE TABLE IF NOT EXISTS `team_national` (
  `nt_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_user` int(11) DEFAULT NULL,
  `added_on` timestamp NULL DEFAULT current_timestamp(),
  `addition_type` tinyint(4) DEFAULT 1 COMMENT '1-Manual,2-Autometic',
  `status` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`nt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team_national`
--

INSERT INTO `team_national` (`nt_id`, `user_id_user`, `added_on`, `addition_type`, `status`) VALUES
(1, 2, '2023-05-10 10:59:36', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `team_sr_consulting_board`
--

DROP TABLE IF EXISTS `team_sr_consulting_board`;
CREATE TABLE IF NOT EXISTS `team_sr_consulting_board` (
  `scaab_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_user` int(11) DEFAULT NULL,
  `join_date` datetime DEFAULT current_timestamp(),
  `status` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`scaab_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team_sr_consulting_board`
--

INSERT INTO `team_sr_consulting_board` (`scaab_id`, `user_id_user`, `join_date`, `status`) VALUES
(1, 2, '2023-05-07 23:46:25', 2),
(2, 26, '2023-05-10 15:53:56', 2),
(3, 2, '2023-05-10 16:28:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `team_state`
--

DROP TABLE IF EXISTS `team_state`;
CREATE TABLE IF NOT EXISTS `team_state` (
  `st_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_user` int(11) DEFAULT NULL,
  `added_on` timestamp NULL DEFAULT current_timestamp(),
  `addition_type` tinyint(4) DEFAULT 1 COMMENT '1-Manual,2-Autometic',
  `status` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`st_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team_state`
--

INSERT INTO `team_state` (`st_id`, `user_id_user`, `added_on`, `addition_type`, `status`) VALUES
(1, 2, '2023-05-10 10:49:54', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `team_zone`
--

DROP TABLE IF EXISTS `team_zone`;
CREATE TABLE IF NOT EXISTS `team_zone` (
  `zt_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_user` int(11) DEFAULT NULL,
  `added_on` timestamp NULL DEFAULT current_timestamp(),
  `addition_type` tinyint(4) DEFAULT 1 COMMENT '1- manual,2-autometic',
  `status` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`zt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team_zone`
--

INSERT INTO `team_zone` (`zt_id`, `user_id_user`, `added_on`, `addition_type`, `status`) VALUES
(1, 2, '2023-05-10 11:04:04', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

DROP TABLE IF EXISTS `user_detail`;
CREATE TABLE IF NOT EXISTS `user_detail` (
  `id_user` bigint(20) NOT NULL AUTO_INCREMENT,
  `utr_no` varchar(20) DEFAULT NULL,
  `user_code` varchar(20) DEFAULT NULL,
  `module_id_module` int(5) DEFAULT 0,
  `user_login_name` varchar(30) DEFAULT NULL,
  `user_login_key` varchar(256) DEFAULT NULL,
  `sponsor_user_id` bigint(20) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_company_name` varchar(256) DEFAULT NULL,
  `user_mobile` bigint(20) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_dob` date DEFAULT NULL,
  `user_address` varchar(520) DEFAULT NULL,
  `user_city` varchar(100) DEFAULT NULL,
  `user_pincode` int(8) DEFAULT NULL,
  `user_post_office` varchar(256) DEFAULT NULL,
  `user_district` varchar(256) DEFAULT NULL,
  `user_state` varchar(30) DEFAULT NULL,
  `user_country` varchar(100) DEFAULT NULL,
  `user_pan` varchar(10) DEFAULT NULL,
  `user_bank_ac_no` varchar(20) DEFAULT NULL,
  `user_bank_ifsc` varchar(11) DEFAULT NULL,
  `user_bank_name` varchar(256) DEFAULT NULL,
  `user_bank_branch` varchar(256) DEFAULT NULL,
  `user_profile_pic` varchar(256) DEFAULT NULL,
  `user_type` int(2) NOT NULL DEFAULT 4,
  `updated_date_time` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `user_create_date` datetime DEFAULT NULL,
  `user_status` tinyint(1) DEFAULT 2 COMMENT '1- Active,2-Blocked, 3-Deleted',
  `user_last_login_date` datetime DEFAULT NULL,
  `user_need_pass_change` tinyint(1) DEFAULT 0,
  `user_education` varchar(256) DEFAULT NULL,
  `user_profession_certification` varchar(256) DEFAULT NULL,
  `user_group_link` varchar(10) DEFAULT NULL,
  `user_group_link_org` varchar(156) DEFAULT NULL,
  `user_blood_group` varchar(10) DEFAULT NULL,
  `user_business_bank_account` varchar(50) DEFAULT NULL,
  `user_business_bank_name` varchar(150) DEFAULT NULL,
  `user_business_bank_ifsc` varchar(15) DEFAULT NULL,
  `user_business_bank_branch` varchar(150) DEFAULT NULL,
  `shop_act` varchar(10) DEFAULT NULL,
  `shop_license_no` varchar(100) DEFAULT NULL,
  `gst_registered` varchar(10) DEFAULT NULL,
  `gst_no` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `utr_no` (`utr_no`),
  UNIQUE KEY `user_code` (`user_code`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_detail`
--

INSERT INTO `user_detail` (`id_user`, `utr_no`, `user_code`, `module_id_module`, `user_login_name`, `user_login_key`, `sponsor_user_id`, `user_name`, `user_company_name`, `user_mobile`, `user_email`, `user_dob`, `user_address`, `user_city`, `user_pincode`, `user_post_office`, `user_district`, `user_state`, `user_country`, `user_pan`, `user_bank_ac_no`, `user_bank_ifsc`, `user_bank_name`, `user_bank_branch`, `user_profile_pic`, `user_type`, `updated_date_time`, `user_create_date`, `user_status`, `user_last_login_date`, `user_need_pass_change`, `user_education`, `user_profession_certification`, `user_group_link`, `user_group_link_org`, `user_blood_group`, `user_business_bank_account`, `user_business_bank_name`, `user_business_bank_ifsc`, `user_business_bank_branch`, `shop_act`, `shop_license_no`, `gst_registered`, `gst_no`) VALUES
(1, '1', 'BBI00009', 1, 'USER1', '123456', NULL, 'Manoj Kumar Dash', NULL, 6370515614, 'admin@gmail.com', '2023-02-13', 'Mani Nagar,Prachinagar', 'Bhadrak', 756181, 'Gelpur', 'Bhadrak', 'Odisha', 'India', 'ASJPD7173N', '23232323232323', 'UTIB0000024', 'AXIS BANK', 'BHUBANESHWAR', NULL, 4, '2023-05-09 19:07:16', '2023-02-19 00:24:02', 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '344343434343', 'BBI00001', 1, NULL, 'Manojgv219!', 0, 'TOP Id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-05-09 18:26:09', '2023-05-09 00:00:00', 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, '16836596309676', 'BBI21424', 1, NULL, 'OwNdjALNa61pinPIHjKjGw==', 2, 'Manoj Kumar Dash', NULL, 8722040200, 'manojdashmca@gmail.com', '2022-07-14', '467E, 2nd Main, 5th Cross, Sidhartha Layout', 'Bangalore', 560067, 'Kadugodi', 'Bangalore', 'Karnataka', '', 'ASJPD7153N', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-09 19:16:29', '2023-05-10 00:46:29', 2, NULL, 0, 'sasasasasa', 'This is a test dddddd', 'No', '', 'A -Ve', '12121212121', 'AXIS BANK', 'UTIB0000024', 'BHUBANESHWAR', 'No', '', 'No', ''),
(25, '16836598503117', 'BBI11825', 1, NULL, 'Qeq+dQNYQAyL4LxYCpi7kA==', 2, 'Manoj Kumar Dash', NULL, 9583445593, 'manoj.aws2022@gmail.com', '1986-04-13', '467E, 2nd Main, 5th Cross, Sidhartha Layout', 'bhadrak', 560067, 'Kadugodi Extention', 'Bangalore', 'Karnataka', '', 'ASJPD7173W', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-09 19:20:20', '2023-05-10 00:50:20', 2, NULL, 0, 'sasasasas', 'This is a test dddddd', 'No', 'This is a test', '', '12121212121', 'AXIS BANK', 'UTIB0000024', 'BHUBANESHWAR', 'No', '', 'No', ''),
(26, '16836884934289', 'BBI59726', 1, NULL, 'eo0qLGkk/war4uT0KV05/w==', 2, 'Manoj Kumar Dash', NULL, 8989899090, 'manoj@mailinator.com', '2023-02-01', '467E, 2nd Main, 5th Cross, Sidhartha Layout', 'Bhadrak', 560067, 'Kadugodi Extention', 'Bangalore', 'Karnataka', '', 'ASJPD7153R', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-10 03:17:57', '2023-05-10 08:47:57', 2, NULL, 0, 'sccxccccc', 'ccxccxcxcx', 'No', '', '', '12121212121', 'AXIS BANK', 'UTIB0000024', 'BHUBANESHWAR', 'No', '', 'No', ''),
(27, '16836889169135', 'BBI49627', 1, NULL, 'sOdm6ReoFffFp8mP0cPpPg==', 2, 'Manoj Kumar Dash', NULL, 8987878989, 'manojdashmca0001@gmail.com', '2023-02-01', '467E, 2nd Main, 5th Cross, Sidhartha Layout', 'Bhadrak', 560067, 'Devanagundi', 'Bangalore', 'Karnataka', '', 'ASJPD7153S', '23232323232323', 'UTIB0000024', 'AXIS BANK', 'BHUBANESHWAR', NULL, 1, '2023-05-10 03:23:32', '2023-05-10 08:53:32', 2, NULL, 0, 'sasasasasa', 'This is a test dddddd', 'No', '', 'O -Ve', '12121212121', 'AXIS BANK', 'UTIB0000024', 'BHUBANESHWAR', 'Yes', 'sddsddsdsdsd', 'No', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_failwer_login_attempt`
--

DROP TABLE IF EXISTS `user_failwer_login_attempt`;
CREATE TABLE IF NOT EXISTS `user_failwer_login_attempt` (
  `id_login_attempt` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id_user` varchar(256) DEFAULT NULL,
  `attempt_user_login_id` varchar(120) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `attempt_date_time` timestamp NULL DEFAULT current_timestamp(),
  `attempt_ip` varchar(30) DEFAULT NULL,
  `attempt_os` varchar(56) DEFAULT NULL,
  `attempt_browser` varchar(100) DEFAULT NULL,
  `failwer_reason` varchar(100) DEFAULT NULL,
  `attempt_status` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id_login_attempt`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_failwer_login_attempt`
--

INSERT INTO `user_failwer_login_attempt` (`id_login_attempt`, `user_id_user`, `attempt_user_login_id`, `user_password`, `attempt_date_time`, `attempt_ip`, `attempt_os`, `attempt_browser`, `failwer_reason`, `attempt_status`) VALUES
(1, '2', 'WIN00002', 'XXXXXX', '2023-04-12 02:51:53', '::1', 'Windows 10', 'Chrome 112.0.0.0', 'Incorrect Password', 0),
(2, '3', 'WIN00003', 'XXXXXX', '2023-04-12 02:52:14', '::1', 'Windows 10', 'Chrome 112.0.0.0', 'Incorrect Password', 0),
(3, '0', 'admin', 'WINdna@123#', '2023-04-13 10:40:09', '::1', 'Windows 10', 'Chrome 112.0.0.0', 'user not available', 0),
(4, '0', 'admin', 'WINdna123#', '2023-04-13 10:40:36', '::1', 'Windows 10', 'Chrome 112.0.0.0', 'user not available', 0),
(5, '1', 'BBI00001', 'XXXXXX', '2023-04-13 17:55:14', '::1', 'Windows 10', 'Chrome 112.0.0.0', 'Incorrect Password', 0),
(6, '0', 'BBI00001', 'WINdna123#', '2023-04-14 01:58:43', '::1', 'Windows 10', 'Chrome 112.0.0.0', 'user not available', 0),
(7, '1', 'BBI00009', 'XXXXXX', '2023-04-14 05:24:45', '::1', 'Windows 10', 'Chrome 112.0.0.0', 'Incorrect Password', 0),
(8, '1', 'BBI00009', 'XXXXXX', '2023-04-24 08:10:19', '::1', 'Windows 10', 'Chrome 112.0.0.0', 'Incorrect Password', 0),
(9, '1', 'BBI00009', 'XXXXXX', '2023-04-24 08:10:23', '::1', 'Windows 10', 'Chrome 112.0.0.0', 'Incorrect Password', 0),
(10, '1', 'BBI00009', 'XXXXXX', '2023-05-08 10:12:32', '::1', 'Windows 10', 'Chrome 112.0.0.0', 'Incorrect Password', 0),
(11, '0', 'manojdashmca@gmail.com', 'Bbi@2023#', '2023-05-08 17:21:54', '::1', 'Windows 10', 'Chrome 112.0.0.0', 'user not available', 0),
(12, '0', 'manojdashmca@gmail.com', 'Bbi@2023#', '2023-05-08 17:22:05', '::1', 'Windows 10', 'Chrome 112.0.0.0', 'user not available', 0),
(13, '19', 'manojdashmca@gmail.com', 'XXXXXX', '2023-05-08 17:26:34', '::1', 'Windows 10', 'Chrome 112.0.0.0', 'Incorrect Password', 0),
(14, '19', 'manojdashmca@gmail.com', 'XXXXXX', '2023-05-08 17:29:56', '::1', 'Windows 10', 'Chrome 112.0.0.0', 'Incorrect Password', 0),
(15, '19', 'manojdashmca@gmail.com', 'XXXXXX', '2023-05-08 17:30:11', '::1', 'Windows 10', 'Chrome 112.0.0.0', 'Incorrect Password', 0),
(16, '19', 'manojdashmca@gmail.com', 'XXXXXX', '2023-05-09 09:12:41', '::1', 'Windows 10', 'Chrome 112.0.0.0', 'Incorrect Password', 0),
(17, '0', 'BBI00009', 'bbi@2023#', '2023-05-10 02:51:10', '::1', 'Windows 10', 'Chrome 112.0.0.0', 'user not available', 0),
(18, '1', 'BBI00009', 'XXXXXX', '2023-05-10 04:02:48', '::1', 'Windows 10', 'Chrome 112.0.0.0', 'Incorrect Password', 0),
(19, '1', 'BBI00009', 'XXXXXX', '2023-05-10 08:39:20', '::1', 'Windows 10', 'Chrome 112.0.0.0', 'Incorrect Password', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_log_history`
--

DROP TABLE IF EXISTS `user_log_history`;
CREATE TABLE IF NOT EXISTS `user_log_history` (
  `id_log` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id_user` bigint(20) NOT NULL,
  `logged_date` timestamp NULL DEFAULT current_timestamp(),
  `logged_ip` varchar(30) DEFAULT NULL,
  `logged_browser` varchar(100) DEFAULT NULL,
  `logged_os` varchar(56) DEFAULT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_log_history`
--

INSERT INTO `user_log_history` (`id_log`, `user_id_user`, `logged_date`, `logged_ip`, `logged_browser`, `logged_os`) VALUES
(1, 1, '2023-03-20 15:49:16', '::1', 'Chrome 111.0.0.0', 'Windows 10'),
(2, 1, '2023-03-22 11:49:58', '::1', 'Chrome 111.0.0.0', 'Windows 10'),
(3, 2, '2023-03-24 15:31:42', '::1', 'Chrome 111.0.0.0', 'Windows 10'),
(4, 2, '2023-03-24 15:32:00', '::1', 'Chrome 111.0.0.0', 'Windows 10'),
(5, 2, '2023-03-24 15:32:14', '::1', 'Chrome 111.0.0.0', 'Windows 10'),
(6, 1, '2023-04-09 15:15:38', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(7, 1, '2023-04-10 03:36:27', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(8, 1, '2023-04-10 07:16:29', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(9, 1, '2023-04-11 04:22:26', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(10, 1, '2023-04-11 07:02:46', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(11, 1, '2023-04-12 02:45:55', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(12, 1, '2023-04-13 10:40:46', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(13, 1, '2023-04-13 17:55:31', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(14, 1, '2023-04-14 01:59:04', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(15, 1, '2023-04-14 05:25:01', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(16, 1, '2023-04-14 11:00:50', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(17, 1, '2023-04-18 17:26:25', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(18, 1, '2023-04-19 05:34:46', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(19, 1, '2023-04-19 05:37:25', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(20, 1, '2023-04-19 10:22:00', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(21, 1, '2023-04-21 06:32:02', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(22, 1, '2023-04-21 17:09:21', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(23, 1, '2023-04-22 05:37:40', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(24, 1, '2023-04-24 08:10:31', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(25, 1, '2023-05-02 05:23:22', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(26, 1, '2023-05-02 11:34:23', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(27, 1, '2023-05-04 17:16:43', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(28, 1, '2023-05-05 06:15:40', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(29, 1, '2023-05-05 18:03:20', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(30, 1, '2023-05-06 17:14:14', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(31, 1, '2023-05-07 04:59:07', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(32, 1, '2023-05-07 16:59:54', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(33, 1, '2023-05-08 11:44:15', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(34, 19, '2023-05-08 17:24:17', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(35, 19, '2023-05-08 17:33:27', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(36, 19, '2023-05-09 05:12:56', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(37, 19, '2023-05-09 09:13:01', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(38, 19, '2023-05-09 09:28:34', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(39, 19, '2023-05-09 17:25:52', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(40, 2, '2023-05-09 17:39:04', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(41, 2, '2023-05-09 17:56:34', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(42, 1, '2023-05-09 19:01:00', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(43, 2, '2023-05-09 19:21:00', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(44, 2, '2023-05-10 02:23:20', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(45, 1, '2023-05-10 02:51:28', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(46, 1, '2023-05-10 03:27:50', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(47, 1, '2023-05-10 03:56:48', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(48, 1, '2023-05-10 08:39:33', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(49, 2, '2023-05-10 11:20:17', '::1', 'Chrome 112.0.0.0', 'Windows 10'),
(50, 2, '2023-05-10 11:28:50', '::1', 'Chrome 112.0.0.0', 'Windows 10');

-- --------------------------------------------------------

--
-- Table structure for table `verification_request`
--

DROP TABLE IF EXISTS `verification_request`;
CREATE TABLE IF NOT EXISTS `verification_request` (
  `vr_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id_user` bigint(20) DEFAULT NULL,
  `vr_type` tinyint(1) DEFAULT 1 COMMENT '1-address,2-bankaccount,3-pancard',
  `vr_date_time` timestamp NULL DEFAULT current_timestamp(),
  `vr_approve_reject_date_time` datetime DEFAULT NULL,
  `vr_approve_reject_log_id` bigint(20) DEFAULT NULL,
  `vr_status` tinyint(1) DEFAULT 1 COMMENT '1-submitted,2-approved,3-rejected',
  `vr_approve_reject_user` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`vr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
