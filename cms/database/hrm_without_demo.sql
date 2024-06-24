-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2022 at 12:01 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inta_hrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `table` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `row_id` int(11) DEFAULT NULL,
  `action_id` int(11) DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('primary','present','permanent') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'primary',
  `address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addressable_id` int(10) UNSIGNED NOT NULL,
  `addressable_type` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `device_ip` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkin_time` datetime DEFAULT NULL,
  `checkout_time` datetime DEFAULT NULL,
  `attendance_date` date DEFAULT NULL,
  `overtime` decimal(6,2) DEFAULT NULL,
  `working_hour` decimal(6,2) DEFAULT NULL,
  `late` decimal(6,2) DEFAULT 0.00,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_deduction_policies`
--

CREATE TABLE `attendance_deduction_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `absent` int(11) DEFAULT NULL,
  `deduction_amount` decimal(6,2) DEFAULT NULL,
  `is_percent` tinyint(4) DEFAULT 0,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_log`
--

CREATE TABLE `attendance_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `device_ip` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `punch_time` datetime DEFAULT NULL,
  `state` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `com_id`, `name`, `email`, `phone`, `address`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`) VALUES
(1, 1, 'Demo Branch', 'branch@demo.com', '01826319556', 'Dhaka, Bangladesh', 1, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `branch_settings`
--

CREATE TABLE `branch_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `allow_employee_login` tinyint(4) DEFAULT NULL,
  `allow_overtime` tinyint(4) DEFAULT NULL,
  `attendance` enum('ip_based','manual') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_ip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable_device` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branch_settings`
--

INSERT INTO `branch_settings` (`id`, `com_id`, `branch_id`, `allow_employee_login`, `allow_overtime`, `attendance`, `device_ip`, `enable_device`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `email`, `phone`, `details`, `address`, `status`, `deleted_at`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Demo Company', 'company@demo.com', '01826319556', 'This is testing master agent', 'Dhaka, Bangladesh', 1, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `company_settings`
--

CREATE TABLE `company_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `yearly_leave` int(11) DEFAULT 10,
  `employee_id_prefix` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_id_length` int(11) DEFAULT 6,
  `has_provision_period` tinyint(4) NOT NULL DEFAULT 0,
  `allow_overtime` tinyint(4) NOT NULL DEFAULT 0,
  `attendance` enum('ip_based','manual') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_attendance_deduction_policy` tinyint(4) NOT NULL DEFAULT 0,
  `has_allowances` tinyint(4) NOT NULL DEFAULT 0,
  `allow_employee_login` tinyint(4) NOT NULL DEFAULT 0,
  `allow_holiday_work_as_overtime` tinyint(4) NOT NULL DEFAULT 0,
  `enable_device` tinyint(4) DEFAULT 0,
  `allow_bulk_upload` tinyint(4) DEFAULT 0,
  `device_ip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_settings`
--

INSERT INTO `company_settings` (`id`, `com_id`, `yearly_leave`, `employee_id_prefix`, `employee_id_length`, `has_provision_period`, `allow_overtime`, `attendance`, `has_attendance_deduction_policy`, `has_allowances`, `allow_employee_login`, `allow_holiday_work_as_overtime`, `enable_device`, `allow_bulk_upload`, `device_ip`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 'DC', 6, 0, 0, 'manual', 0, 0, 1, 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capital` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` int(10) UNSIGNED DEFAULT NULL,
  `timezone_id` int(10) UNSIGNED DEFAULT NULL,
  `citizenship` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iso_code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso_numeric` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calling_code` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eea` tinyint(1) DEFAULT 0,
  `active` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `full_name`, `capital`, `currency_id`, `timezone_id`, `citizenship`, `iso_code`, `iso_numeric`, `calling_code`, `flag`, `eea`, `active`, `created_at`, `updated_at`) VALUES
(4, 'Afghanistan', 'Islamic Republic of Afghanistan', 'Kabul', NULL, NULL, 'Afghan', 'AF', '004', '93', 'AF.png', 0, 1, '2022-06-10 03:59:11', '2022-06-10 03:59:11'),
(8, 'Albania', 'Republic of Albania', 'Tirana', NULL, NULL, 'Albanian', 'AL', '008', '355', 'AL.png', 0, 1, '2022-06-10 03:59:12', '2022-06-10 03:59:12'),
(10, 'Antarctica', 'Antarctica', 'Antartica', NULL, NULL, 'of Antartica', 'AQ', '010', '672', 'AQ.png', 0, 1, '2022-06-10 03:59:12', '2022-06-10 03:59:12'),
(12, 'Algeria', 'People’s Democratic Republic of Algeria', 'Algiers', NULL, NULL, 'Algerian', 'DZ', '012', '213', 'DZ.png', 0, 1, '2022-06-10 03:59:12', '2022-06-10 03:59:12'),
(16, 'American Samoa', 'Territory of American', 'Pago Pago', NULL, NULL, 'American Samoan', 'AS', '016', '1', 'AS.png', 0, 1, '2022-06-10 03:59:12', '2022-06-10 03:59:12'),
(20, 'Andorra', 'Principality of Andorra', 'Andorra la Vella', NULL, NULL, 'Andorran', 'AD', '020', '376', 'AD.png', 0, 1, '2022-06-10 03:59:12', '2022-06-10 03:59:12'),
(24, 'Angola', 'Republic of Angola', 'Luanda', NULL, NULL, 'Angolan', 'AO', '024', '244', 'AO.png', 0, 1, '2022-06-10 03:59:12', '2022-06-10 03:59:12'),
(28, 'Antigua and Barbuda', 'Antigua and Barbuda', 'St John’s', NULL, NULL, 'of Antigua and Barbuda', 'AG', '028', '1', 'AG.png', 0, 1, '2022-06-10 03:59:13', '2022-06-10 03:59:13'),
(31, 'Azerbaijan', 'Republic of Azerbaijan', 'Baku', NULL, NULL, 'Azerbaijani', 'AZ', '031', '994', 'AZ.png', 0, 1, '2022-06-10 03:59:13', '2022-06-10 03:59:13'),
(32, 'Argentina', 'Argentine Republic', 'Buenos Aires', NULL, NULL, 'Argentinian', 'AR', '032', '54', 'AR.png', 0, 1, '2022-06-10 03:59:13', '2022-06-10 03:59:13'),
(36, 'Australia', 'Commonwealth of Australia', 'Canberra', NULL, NULL, 'Australian', 'AU', '036', '61', 'AU.png', 0, 1, '2022-06-10 03:59:13', '2022-06-10 03:59:13'),
(40, 'Austria', 'Republic of Austria', 'Vienna', NULL, NULL, 'Austrian', 'AT', '040', '43', 'AT.png', 1, 1, '2022-06-10 03:59:13', '2022-06-10 03:59:13'),
(44, 'Bahamas', 'Commonwealth of the Bahamas', 'Nassau', NULL, NULL, 'Bahamian', 'BS', '044', '1', 'BS.png', 0, 1, '2022-06-10 03:59:14', '2022-06-10 03:59:14'),
(48, 'Bahrain', 'Kingdom of Bahrain', 'Manama', NULL, NULL, 'Bahraini', 'BH', '048', '973', 'BH.png', 0, 1, '2022-06-10 03:59:14', '2022-06-10 03:59:14'),
(50, 'Bangladesh', 'People’s Republic of Bangladesh', 'Dhaka', NULL, NULL, 'Bangladeshi', 'BD', '050', '880', 'BD.png', 0, 1, '2022-06-10 03:59:14', '2022-06-10 03:59:14'),
(51, 'Armenia', 'Republic of Armenia', 'Yerevan', NULL, NULL, 'Armenian', 'AM', '051', '374', 'AM.png', 0, 1, '2022-06-10 03:59:14', '2022-06-10 03:59:14'),
(52, 'Barbados', 'Barbados', 'Bridgetown', NULL, NULL, 'Barbadian', 'BB', '052', '1', 'BB.png', 0, 1, '2022-06-10 03:59:14', '2022-06-10 03:59:14'),
(56, 'Belgium', 'Kingdom of Belgium', 'Brussels', NULL, NULL, 'Belgian', 'BE', '056', '32', 'BE.png', 1, 1, '2022-06-10 03:59:14', '2022-06-10 03:59:14'),
(60, 'Bermuda', 'Bermuda', 'Hamilton', NULL, NULL, 'Bermudian', 'BM', '060', '1', 'BM.png', 0, 1, '2022-06-10 03:59:14', '2022-06-10 03:59:14'),
(64, 'Bhutan', 'Kingdom of Bhutan', 'Thimphu', NULL, NULL, 'Bhutanese', 'BT', '064', '975', 'BT.png', 0, 1, '2022-06-10 03:59:14', '2022-06-10 03:59:14'),
(68, 'Bolivia, Plurinational State of', 'Plurinational State of Bolivia', 'Sucre (BO1)', NULL, NULL, 'Bolivian', 'BO', '068', '591', 'BO.png', 0, 1, '2022-06-10 03:59:14', '2022-06-10 03:59:14'),
(70, 'Bosnia and Herzegovina', 'Bosnia and Herzegovina', 'Sarajevo', NULL, NULL, 'of Bosnia and Herzegovina', 'BA', '070', '387', 'BA.png', 0, 1, '2022-06-10 03:59:14', '2022-06-10 03:59:14'),
(72, 'Botswana', 'Republic of Botswana', 'Gaborone', NULL, NULL, 'Botswanan', 'BW', '072', '267', 'BW.png', 0, 1, '2022-06-10 03:59:14', '2022-06-10 03:59:14'),
(74, 'Bouvet Island', 'Bouvet Island', 'Bouvet island', NULL, NULL, 'of Bouvet island', 'BV', '074', '47', 'BV.png', 0, 1, '2022-06-10 03:59:14', '2022-06-10 03:59:14'),
(76, 'Brazil', 'Federative Republic of Brazil', 'Brasilia', NULL, NULL, 'Brazilian', 'BR', '076', '55', 'BR.png', 0, 1, '2022-06-10 03:59:14', '2022-06-10 03:59:14'),
(84, 'Belize', 'Belize', 'Belmopan', NULL, NULL, 'Belizean', 'BZ', '084', '501', 'BZ.png', 0, 1, '2022-06-10 03:59:15', '2022-06-10 03:59:15'),
(86, 'British Indian Ocean Territory', 'British Indian Ocean Territory', 'Diego Garcia', NULL, NULL, 'Changosian', 'IO', '086', '246', 'IO.png', 0, 1, '2022-06-10 03:59:15', '2022-06-10 03:59:15'),
(90, 'Solomon Islands', 'Solomon Islands', 'Honiara', NULL, NULL, 'Solomon Islander', 'SB', '090', '677', 'SB.png', 0, 1, '2022-06-10 03:59:15', '2022-06-10 03:59:15'),
(92, 'Virgin Islands, British', 'British Virgin Islands', 'Road Town', NULL, NULL, 'British Virgin Islander;', 'VG', '092', '1', 'VG.png', 0, 1, '2022-06-10 03:59:15', '2022-06-10 03:59:15'),
(96, 'Brunei Darussalam', 'Brunei Darussalam', 'Bandar Seri Begawan', NULL, NULL, 'Bruneian', 'BN', '096', '673', 'BN.png', 0, 1, '2022-06-10 03:59:15', '2022-06-10 03:59:15'),
(100, 'Bulgaria', 'Republic of Bulgaria', 'Sofia', NULL, NULL, 'Bulgarian', 'BG', '100', '359', 'BG.png', 1, 1, '2022-06-10 03:59:15', '2022-06-10 03:59:15'),
(104, 'Myanmar', 'Union of Myanmar/', 'Yangon', NULL, NULL, 'Burmese', 'MM', '104', '95', 'MM.png', 0, 1, '2022-06-10 03:59:15', '2022-06-10 03:59:15'),
(108, 'Burundi', 'Republic of Burundi', 'Bujumbura', NULL, NULL, 'Burundian', 'BI', '108', '257', 'BI.png', 0, 1, '2022-06-10 03:59:15', '2022-06-10 03:59:15'),
(112, 'Belarus', 'Republic of Belarus', 'Minsk', NULL, NULL, 'Belarusian', 'BY', '112', '375', 'BY.png', 0, 1, '2022-06-10 03:59:15', '2022-06-10 03:59:15'),
(116, 'Cambodia', 'Kingdom of Cambodia', 'Phnom Penh', NULL, NULL, 'Cambodian', 'KH', '116', '855', 'KH.png', 0, 1, '2022-06-10 03:59:15', '2022-06-10 03:59:15'),
(120, 'Cameroon', 'Republic of Cameroon', 'Yaoundé', NULL, NULL, 'Cameroonian', 'CM', '120', '237', 'CM.png', 0, 1, '2022-06-10 03:59:15', '2022-06-10 03:59:15'),
(124, 'Canada', 'Canada', 'Ottawa', NULL, NULL, 'Canadian', 'CA', '124', '1', 'CA.png', 0, 1, '2022-06-10 03:59:15', '2022-06-10 03:59:15'),
(132, 'Cape Verde', 'Republic of Cape Verde', 'Praia', NULL, NULL, 'Cape Verdean', 'CV', '132', '238', 'CV.png', 0, 1, '2022-06-10 03:59:15', '2022-06-10 03:59:15'),
(136, 'Cayman Islands', 'Cayman Islands', 'George Town', NULL, NULL, 'Caymanian', 'KY', '136', '1', 'KY.png', 0, 1, '2022-06-10 03:59:15', '2022-06-10 03:59:15'),
(140, 'Central African Republic', 'Central African Republic', 'Bangui', NULL, NULL, 'Central African', 'CF', '140', '236', 'CF.png', 0, 1, '2022-06-10 03:59:15', '2022-06-10 03:59:15'),
(144, 'Sri Lanka', 'Democratic Socialist Republic of Sri Lanka', 'Colombo', NULL, NULL, 'Sri Lankan', 'LK', '144', '94', 'LK.png', 0, 1, '2022-06-10 03:59:15', '2022-06-10 03:59:15'),
(148, 'Chad', 'Republic of Chad', 'N’Djamena', NULL, NULL, 'Chadian', 'TD', '148', '235', 'TD.png', 0, 1, '2022-06-10 03:59:16', '2022-06-10 03:59:16'),
(152, 'Chile', 'Republic of Chile', 'Santiago', NULL, NULL, 'Chilean', 'CL', '152', '56', 'CL.png', 0, 1, '2022-06-10 03:59:16', '2022-06-10 03:59:16'),
(156, 'China', 'People’s Republic of China', 'Beijing', NULL, NULL, 'Chinese', 'CN', '156', '86', 'CN.png', 0, 1, '2022-06-10 03:59:16', '2022-06-10 03:59:16'),
(158, 'Taiwan, Province of China', 'Republic of China, Taiwan (TW1)', 'Taipei', NULL, NULL, 'Taiwanese', 'TW', '158', '886', 'TW.png', 0, 1, '2022-06-10 03:59:16', '2022-06-10 03:59:16'),
(162, 'Christmas Island', 'Christmas Island Territory', 'Flying Fish Cove', NULL, NULL, 'Christmas Islander', 'CX', '162', '61', 'CX.png', 0, 1, '2022-06-10 03:59:16', '2022-06-10 03:59:16'),
(166, 'Cocos (Keeling) Islands', 'Territory of Cocos (Keeling) Islands', 'Bantam', NULL, NULL, 'Cocos Islander', 'CC', '166', '61', 'CC.png', 0, 1, '2022-06-10 03:59:16', '2022-06-10 03:59:16'),
(170, 'Colombia', 'Republic of Colombia', 'Santa Fe de Bogotá', NULL, NULL, 'Colombian', 'CO', '170', '57', 'CO.png', 0, 1, '2022-06-10 03:59:16', '2022-06-10 03:59:16'),
(174, 'Comoros', 'Union of the Comoros', 'Moroni', NULL, NULL, 'Comorian', 'KM', '174', '269', 'KM.png', 0, 1, '2022-06-10 03:59:16', '2022-06-10 03:59:16'),
(175, 'Mayotte', 'Departmental Collectivity of Mayotte', 'Mamoudzou', NULL, NULL, 'Mahorais', 'YT', '175', '262', 'YT.png', 0, 1, '2022-06-10 03:59:16', '2022-06-10 03:59:16'),
(178, 'Congo', 'Republic of the Congo', 'Brazzaville', NULL, NULL, 'Congolese', 'CG', '178', '242', 'CG.png', 0, 1, '2022-06-10 03:59:16', '2022-06-10 03:59:16'),
(180, 'Congo, the Democratic Republic of the', 'Democratic Republic of the Congo', 'Kinshasa', NULL, NULL, 'Congolese', 'CD', '180', '243', 'CD.png', 0, 1, '2022-06-10 03:59:16', '2022-06-10 03:59:16'),
(184, 'Cook Islands', 'Cook Islands', 'Avarua', NULL, NULL, 'Cook Islander', 'CK', '184', '682', 'CK.png', 0, 1, '2022-06-10 03:59:17', '2022-06-10 03:59:17'),
(188, 'Costa Rica', 'Republic of Costa Rica', 'San José', NULL, NULL, 'Costa Rican', 'CR', '188', '506', 'CR.png', 0, 1, '2022-06-10 03:59:17', '2022-06-10 03:59:17'),
(191, 'Croatia', 'Republic of Croatia', 'Zagreb', NULL, NULL, 'Croatian', 'HR', '191', '385', 'HR.png', 1, 1, '2022-06-10 03:59:17', '2022-06-10 03:59:17'),
(192, 'Cuba', 'Republic of Cuba', 'Havana', NULL, NULL, 'Cuban', 'CU', '192', '53', 'CU.png', 0, 1, '2022-06-10 03:59:17', '2022-06-10 03:59:17'),
(196, 'Cyprus', 'Republic of Cyprus', 'Nicosia', NULL, NULL, 'Cypriot', 'CY', '196', '357', 'CY.png', 1, 1, '2022-06-10 03:59:17', '2022-06-10 03:59:17'),
(203, 'Czech Republic', 'Czech Republic', 'Prague', NULL, NULL, 'Czech', 'CZ', '203', '420', 'CZ.png', 1, 1, '2022-06-10 03:59:17', '2022-06-10 03:59:17'),
(204, 'Benin', 'Republic of Benin', 'Porto Novo (BJ1)', NULL, NULL, 'Beninese', 'BJ', '204', '229', 'BJ.png', 0, 1, '2022-06-10 03:59:17', '2022-06-10 03:59:17'),
(208, 'Denmark', 'Kingdom of Denmark', 'Copenhagen', NULL, NULL, 'Danish', 'DK', '208', '45', 'DK.png', 1, 1, '2022-06-10 03:59:17', '2022-06-10 03:59:17'),
(212, 'Dominica', 'Commonwealth of Dominica', 'Roseau', NULL, NULL, 'Dominican', 'DM', '212', '1', 'DM.png', 0, 1, '2022-06-10 03:59:17', '2022-06-10 03:59:17'),
(214, 'Dominican Republic', 'Dominican Republic', 'Santo Domingo', NULL, NULL, 'Dominican', 'DO', '214', '1', 'DO.png', 0, 1, '2022-06-10 03:59:17', '2022-06-10 03:59:17'),
(218, 'Ecuador', 'Republic of Ecuador', 'Quito', NULL, NULL, 'Ecuadorian', 'EC', '218', '593', 'EC.png', 0, 1, '2022-06-10 03:59:17', '2022-06-10 03:59:17'),
(222, 'El Salvador', 'Republic of El Salvador', 'San Salvador', NULL, NULL, 'Salvadoran', 'SV', '222', '503', 'SV.png', 0, 1, '2022-06-10 03:59:17', '2022-06-10 03:59:17'),
(226, 'Equatorial Guinea', 'Republic of Equatorial Guinea', 'Malabo', NULL, NULL, 'Equatorial Guinean', 'GQ', '226', '240', 'GQ.png', 0, 1, '2022-06-10 03:59:17', '2022-06-10 03:59:17'),
(231, 'Ethiopia', 'Federal Democratic Republic of Ethiopia', 'Addis Ababa', NULL, NULL, 'Ethiopian', 'ET', '231', '251', 'ET.png', 0, 1, '2022-06-10 03:59:17', '2022-06-10 03:59:17'),
(232, 'Eritrea', 'State of Eritrea', 'Asmara', NULL, NULL, 'Eritrean', 'ER', '232', '291', 'ER.png', 0, 1, '2022-06-10 03:59:17', '2022-06-10 03:59:17'),
(233, 'Estonia', 'Republic of Estonia', 'Tallinn', NULL, NULL, 'Estonian', 'EE', '233', '372', 'EE.png', 1, 1, '2022-06-10 03:59:18', '2022-06-10 03:59:18'),
(234, 'Faroe Islands', 'Faeroe Islands', 'Tórshavn', NULL, NULL, 'Faeroese', 'FO', '234', '298', 'FO.png', 0, 1, '2022-06-10 03:59:18', '2022-06-10 03:59:18'),
(238, 'Falkland Islands (Malvinas)', 'Falkland Islands', 'Stanley', NULL, NULL, 'Falkland Islander', 'FK', '238', '500', 'FK.png', 0, 1, '2022-06-10 03:59:18', '2022-06-10 03:59:18'),
(239, 'South Georgia and the South Sandwich Islands', 'South Georgia and the South Sandwich Islands', 'King Edward Point (Grytviken)', NULL, NULL, 'of South Georgia and the South Sandwich Islands', 'GS', '239', '44', 'GS.png', 0, 1, '2022-06-10 03:59:18', '2022-06-10 03:59:18'),
(242, 'Fiji', 'Republic of Fiji', 'Suva', NULL, NULL, 'Fijian', 'FJ', '242', '679', 'FJ.png', 0, 1, '2022-06-10 03:59:18', '2022-06-10 03:59:18'),
(246, 'Finland', 'Republic of Finland', 'Helsinki', NULL, NULL, 'Finnish', 'FI', '246', '358', 'FI.png', 1, 1, '2022-06-10 03:59:18', '2022-06-10 03:59:18'),
(248, 'Åland Islands', 'Åland Islands', 'Mariehamn', NULL, NULL, 'Åland Islander', 'AX', '248', '358', NULL, 0, 1, '2022-06-10 03:59:18', '2022-06-10 03:59:18'),
(250, 'France', 'French Republic', 'Paris', NULL, NULL, 'French', 'FR', '250', '33', 'FR.png', 1, 1, '2022-06-10 03:59:18', '2022-06-10 03:59:18'),
(254, 'French Guiana', 'French Guiana', 'Cayenne', NULL, NULL, 'Guianese', 'GF', '254', '594', 'GF.png', 0, 1, '2022-06-10 03:59:18', '2022-06-10 03:59:18'),
(258, 'French Polynesia', 'French Polynesia', 'Papeete', NULL, NULL, 'Polynesian', 'PF', '258', '689', 'PF.png', 0, 1, '2022-06-10 03:59:18', '2022-06-10 03:59:18'),
(260, 'French Southern Territories', 'French Southern and Antarctic Lands', 'Port-aux-Francais', NULL, NULL, 'of French Southern and Antarctic Lands', 'TF', '260', '33', 'TF.png', 0, 1, '2022-06-10 03:59:18', '2022-06-10 03:59:18'),
(262, 'Djibouti', 'Republic of Djibouti', 'Djibouti', NULL, NULL, 'Djiboutian', 'DJ', '262', '253', 'DJ.png', 0, 1, '2022-06-10 03:59:18', '2022-06-10 03:59:18'),
(266, 'Gabon', 'Gabonese Republic', 'Libreville', NULL, NULL, 'Gabonese', 'GA', '266', '241', 'GA.png', 0, 1, '2022-06-10 03:59:18', '2022-06-10 03:59:18'),
(268, 'Georgia', 'Georgia', 'Tbilisi', NULL, NULL, 'Georgian', 'GE', '268', '995', 'GE.png', 0, 1, '2022-06-10 03:59:18', '2022-06-10 03:59:18'),
(270, 'Gambia', 'Republic of the Gambia', 'Banjul', NULL, NULL, 'Gambian', 'GM', '270', '220', 'GM.png', 0, 1, '2022-06-10 03:59:18', '2022-06-10 03:59:18'),
(275, 'Palestinian Territory, Occupied', NULL, NULL, NULL, NULL, 'Palestinian', 'PS', '275', '970', 'PS.png', 0, 1, '2022-06-10 03:59:18', '2022-06-10 03:59:18'),
(276, 'Germany', 'Federal Republic of Germany', 'Berlin', NULL, NULL, 'German', 'DE', '276', '49', 'DE.png', 1, 1, '2022-06-10 03:59:18', '2022-06-10 03:59:18'),
(288, 'Ghana', 'Republic of Ghana', 'Accra', NULL, NULL, 'Ghanaian', 'GH', '288', '233', 'GH.png', 0, 1, '2022-06-10 03:59:18', '2022-06-10 03:59:18'),
(292, 'Gibraltar', 'Gibraltar', 'Gibraltar', NULL, NULL, 'Gibraltarian', 'GI', '292', '350', 'GI.png', 0, 1, '2022-06-10 03:59:19', '2022-06-10 03:59:19'),
(296, 'Kiribati', 'Republic of Kiribati', 'Tarawa', NULL, NULL, 'Kiribatian', 'KI', '296', '686', 'KI.png', 0, 1, '2022-06-10 03:59:19', '2022-06-10 03:59:19'),
(300, 'Greece', 'Hellenic Republic', 'Athens', NULL, NULL, 'Greek', 'GR', '300', '30', 'GR.png', 1, 1, '2022-06-10 03:59:19', '2022-06-10 03:59:19'),
(304, 'Greenland', 'Greenland', 'Nuuk', NULL, NULL, 'Greenlander', 'GL', '304', '299', 'GL.png', 0, 1, '2022-06-10 03:59:19', '2022-06-10 03:59:19'),
(308, 'Grenada', 'Grenada', 'St George’s', NULL, NULL, 'Grenadian', 'GD', '308', '1', 'GD.png', 0, 1, '2022-06-10 03:59:19', '2022-06-10 03:59:19'),
(312, 'Guadeloupe', 'Guadeloupe', 'Basse Terre', NULL, NULL, 'Guadeloupean', 'GP', '312', '590', 'GP.png', 0, 1, '2022-06-10 03:59:19', '2022-06-10 03:59:19'),
(316, 'Guam', 'Territory of Guam', 'Agaña (Hagåtña)', NULL, NULL, 'Guamanian', 'GU', '316', '1', 'GU.png', 0, 1, '2022-06-10 03:59:19', '2022-06-10 03:59:19'),
(320, 'Guatemala', 'Republic of Guatemala', 'Guatemala City', NULL, NULL, 'Guatemalan', 'GT', '320', '502', 'GT.png', 0, 1, '2022-06-10 03:59:19', '2022-06-10 03:59:19'),
(324, 'Guinea', 'Republic of Guinea', 'Conakry', NULL, NULL, 'Guinean', 'GN', '324', '224', 'GN.png', 0, 1, '2022-06-10 03:59:19', '2022-06-10 03:59:19'),
(328, 'Guyana', 'Cooperative Republic of Guyana', 'Georgetown', NULL, NULL, 'Guyanese', 'GY', '328', '592', 'GY.png', 0, 1, '2022-06-10 03:59:19', '2022-06-10 03:59:19'),
(332, 'Haiti', 'Republic of Haiti', 'Port-au-Prince', NULL, NULL, 'Haitian', 'HT', '332', '509', 'HT.png', 0, 1, '2022-06-10 03:59:20', '2022-06-10 03:59:20'),
(334, 'Heard Island and McDonald Islands', 'Territory of Heard Island and McDonald Islands', 'Territory of Heard Island and McDonald Islands', NULL, NULL, 'of Territory of Heard Island and McDonald Islands', 'HM', '334', '61', 'HM.png', 0, 1, '2022-06-10 03:59:20', '2022-06-10 03:59:20'),
(336, 'Holy See (Vatican City State)', 'the Holy See/ Vatican City State', 'Vatican City', NULL, NULL, 'of the Holy See/of the Vatican', 'VA', '336', '39', 'VA.png', 0, 1, '2022-06-10 03:59:20', '2022-06-10 03:59:20'),
(340, 'Honduras', 'Republic of Honduras', 'Tegucigalpa', NULL, NULL, 'Honduran', 'HN', '340', '504', 'HN.png', 0, 1, '2022-06-10 03:59:20', '2022-06-10 03:59:20'),
(344, 'Hong Kong', 'Hong Kong Special Administrative Region of the People’s Republic of China (HK2)', '(HK3)', NULL, NULL, 'Hong Kong Chinese', 'HK', '344', '852', 'HK.png', 0, 1, '2022-06-10 03:59:20', '2022-06-10 03:59:20'),
(348, 'Hungary', 'Republic of Hungary', 'Budapest', NULL, NULL, 'Hungarian', 'HU', '348', '36', 'HU.png', 1, 1, '2022-06-10 03:59:20', '2022-06-10 03:59:20'),
(352, 'Iceland', 'Republic of Iceland', 'Reykjavik', NULL, NULL, 'Icelander', 'IS', '352', '354', 'IS.png', 1, 1, '2022-06-10 03:59:20', '2022-06-10 03:59:20'),
(356, 'India', 'Republic of India', 'New Delhi', NULL, NULL, 'Indian', 'IN', '356', '91', 'IN.png', 0, 1, '2022-06-10 03:59:20', '2022-06-10 03:59:20'),
(360, 'Indonesia', 'Republic of Indonesia', 'Jakarta', NULL, NULL, 'Indonesian', 'ID', '360', '62', 'ID.png', 0, 1, '2022-06-10 03:59:20', '2022-06-10 03:59:20'),
(364, 'Iran, Islamic Republic of', 'Islamic Republic of Iran', 'Tehran', NULL, NULL, 'Iranian', 'IR', '364', '98', 'IR.png', 0, 1, '2022-06-10 03:59:20', '2022-06-10 03:59:20'),
(368, 'Iraq', 'Republic of Iraq', 'Baghdad', NULL, NULL, 'Iraqi', 'IQ', '368', '964', 'IQ.png', 0, 1, '2022-06-10 03:59:20', '2022-06-10 03:59:20'),
(372, 'Ireland', 'Ireland (IE1)', 'Dublin', NULL, NULL, 'Irish', 'IE', '372', '353', 'IE.png', 1, 1, '2022-06-10 03:59:20', '2022-06-10 03:59:20'),
(376, 'Israel', 'State of Israel', '(IL1)', NULL, NULL, 'Israeli', 'IL', '376', '972', 'IL.png', 0, 1, '2022-06-10 03:59:20', '2022-06-10 03:59:20'),
(380, 'Italy', 'Italian Republic', 'Rome', NULL, NULL, 'Italian', 'IT', '380', '39', 'IT.png', 1, 1, '2022-06-10 03:59:20', '2022-06-10 03:59:20'),
(384, 'Côte d\'Ivoire', 'Republic of Côte d’Ivoire', 'Yamoussoukro (CI1)', NULL, NULL, 'Ivorian', 'CI', '384', '225', 'CI.png', 0, 1, '2022-06-10 03:59:21', '2022-06-10 03:59:21'),
(388, 'Jamaica', 'Jamaica', 'Kingston', NULL, NULL, 'Jamaican', 'JM', '388', '1', 'JM.png', 0, 1, '2022-06-10 03:59:21', '2022-06-10 03:59:21'),
(392, 'Japan', 'Japan', 'Tokyo', NULL, NULL, 'Japanese', 'JP', '392', '81', 'JP.png', 0, 1, '2022-06-10 03:59:21', '2022-06-10 03:59:21'),
(398, 'Kazakhstan', 'Republic of Kazakhstan', 'Astana', NULL, NULL, 'Kazakh', 'KZ', '398', '7', 'KZ.png', 0, 1, '2022-06-10 03:59:21', '2022-06-10 03:59:21'),
(400, 'Jordan', 'Hashemite Kingdom of Jordan', 'Amman', NULL, NULL, 'Jordanian', 'JO', '400', '962', 'JO.png', 0, 1, '2022-06-10 03:59:21', '2022-06-10 03:59:21'),
(404, 'Kenya', 'Republic of Kenya', 'Nairobi', NULL, NULL, 'Kenyan', 'KE', '404', '254', 'KE.png', 0, 1, '2022-06-10 03:59:21', '2022-06-10 03:59:21'),
(408, 'Korea, Democratic People\'s Republic of', 'Democratic People’s Republic of Korea', 'Pyongyang', NULL, NULL, 'North Korean', 'KP', '408', '850', 'KP.png', 0, 1, '2022-06-10 03:59:21', '2022-06-10 03:59:21'),
(410, 'Korea, Republic of', 'Republic of Korea', 'Seoul', NULL, NULL, 'South Korean', 'KR', '410', '82', 'KR.png', 0, 1, '2022-06-10 03:59:21', '2022-06-10 03:59:21'),
(414, 'Kuwait', 'State of Kuwait', 'Kuwait City', NULL, NULL, 'Kuwaiti', 'KW', '414', '965', 'KW.png', 0, 1, '2022-06-10 03:59:21', '2022-06-10 03:59:21'),
(417, 'Kyrgyzstan', 'Kyrgyz Republic', 'Bishkek', NULL, NULL, 'Kyrgyz', 'KG', '417', '996', 'KG.png', 0, 1, '2022-06-10 03:59:21', '2022-06-10 03:59:21'),
(418, 'Lao People\'s Democratic Republic', 'Lao People’s Democratic Republic', 'Vientiane', NULL, NULL, 'Lao', 'LA', '418', '856', 'LA.png', 0, 1, '2022-06-10 03:59:22', '2022-06-10 03:59:22'),
(422, 'Lebanon', 'Lebanese Republic', 'Beirut', NULL, NULL, 'Lebanese', 'LB', '422', '961', 'LB.png', 0, 1, '2022-06-10 03:59:22', '2022-06-10 03:59:22'),
(426, 'Lesotho', 'Kingdom of Lesotho', 'Maseru', NULL, NULL, 'Basotho', 'LS', '426', '266', 'LS.png', 0, 1, '2022-06-10 03:59:22', '2022-06-10 03:59:22'),
(428, 'Latvia', 'Republic of Latvia', 'Riga', NULL, NULL, 'Latvian', 'LV', '428', '371', 'LV.png', 1, 1, '2022-06-10 03:59:22', '2022-06-10 03:59:22'),
(430, 'Liberia', 'Republic of Liberia', 'Monrovia', NULL, NULL, 'Liberian', 'LR', '430', '231', 'LR.png', 0, 1, '2022-06-10 03:59:22', '2022-06-10 03:59:22'),
(434, 'Libya', 'Socialist People’s Libyan Arab Jamahiriya', 'Tripoli', NULL, NULL, 'Libyan', 'LY', '434', '218', 'LY.png', 0, 1, '2022-06-10 03:59:22', '2022-06-10 03:59:22'),
(438, 'Liechtenstein', 'Principality of Liechtenstein', 'Vaduz', NULL, NULL, 'Liechtensteiner', 'LI', '438', '423', 'LI.png', 1, 1, '2022-06-10 03:59:22', '2022-06-10 03:59:22'),
(440, 'Lithuania', 'Republic of Lithuania', 'Vilnius', NULL, NULL, 'Lithuanian', 'LT', '440', '370', 'LT.png', 1, 1, '2022-06-10 03:59:22', '2022-06-10 03:59:22'),
(442, 'Luxembourg', 'Grand Duchy of Luxembourg', 'Luxembourg', NULL, NULL, 'Luxembourger', 'LU', '442', '352', 'LU.png', 1, 1, '2022-06-10 03:59:23', '2022-06-10 03:59:23'),
(446, 'Macao', 'Macao Special Administrative Region of the People’s Republic of China (MO2)', 'Macao (MO3)', NULL, NULL, 'Macanese', 'MO', '446', '853', 'MO.png', 0, 1, '2022-06-10 03:59:23', '2022-06-10 03:59:23'),
(450, 'Madagascar', 'Republic of Madagascar', 'Antananarivo', NULL, NULL, 'Malagasy', 'MG', '450', '261', 'MG.png', 0, 1, '2022-06-10 03:59:23', '2022-06-10 03:59:23'),
(454, 'Malawi', 'Republic of Malawi', 'Lilongwe', NULL, NULL, 'Malawian', 'MW', '454', '265', 'MW.png', 0, 1, '2022-06-10 03:59:23', '2022-06-10 03:59:23'),
(458, 'Malaysia', 'Malaysia', 'Kuala Lumpur (MY1)', NULL, NULL, 'Malaysian', 'MY', '458', '60', 'MY.png', 0, 1, '2022-06-10 03:59:23', '2022-06-10 03:59:23'),
(462, 'Maldives', 'Republic of Maldives', 'Malé', NULL, NULL, 'Maldivian', 'MV', '462', '960', 'MV.png', 0, 1, '2022-06-10 03:59:23', '2022-06-10 03:59:23'),
(466, 'Mali', 'Republic of Mali', 'Bamako', NULL, NULL, 'Malian', 'ML', '466', '223', 'ML.png', 0, 1, '2022-06-10 03:59:23', '2022-06-10 03:59:23'),
(470, 'Malta', 'Republic of Malta', 'Valletta', NULL, NULL, 'Maltese', 'MT', '470', '356', 'MT.png', 1, 1, '2022-06-10 03:59:23', '2022-06-10 03:59:23'),
(474, 'Martinique', 'Martinique', 'Fort-de-France', NULL, NULL, 'Martinican', 'MQ', '474', '596', 'MQ.png', 0, 1, '2022-06-10 03:59:23', '2022-06-10 03:59:23'),
(478, 'Mauritania', 'Islamic Republic of Mauritania', 'Nouakchott', NULL, NULL, 'Mauritanian', 'MR', '478', '222', 'MR.png', 0, 1, '2022-06-10 03:59:23', '2022-06-10 03:59:23'),
(480, 'Mauritius', 'Republic of Mauritius', 'Port Louis', NULL, NULL, 'Mauritian', 'MU', '480', '230', 'MU.png', 0, 1, '2022-06-10 03:59:23', '2022-06-10 03:59:23'),
(484, 'Mexico', 'United Mexican States', 'Mexico City', NULL, NULL, 'Mexican', 'MX', '484', '52', 'MX.png', 0, 1, '2022-06-10 03:59:23', '2022-06-10 03:59:23'),
(492, 'Monaco', 'Principality of Monaco', 'Monaco', NULL, NULL, 'Monegasque', 'MC', '492', '377', 'MC.png', 0, 1, '2022-06-10 03:59:23', '2022-06-10 03:59:23'),
(496, 'Mongolia', 'Mongolia', 'Ulan Bator', NULL, NULL, 'Mongolian', 'MN', '496', '976', 'MN.png', 0, 1, '2022-06-10 03:59:23', '2022-06-10 03:59:23'),
(498, 'Moldova, Republic of', 'Republic of Moldova', 'Chisinau', NULL, NULL, 'Moldovan', 'MD', '498', '373', 'MD.png', 0, 1, '2022-06-10 03:59:23', '2022-06-10 03:59:23'),
(499, 'Montenegro', 'Montenegro', 'Podgorica', NULL, NULL, 'Montenegrin', 'ME', '499', '382', NULL, 0, 1, '2022-06-10 03:59:24', '2022-06-10 03:59:24'),
(500, 'Montserrat', 'Montserrat', 'Plymouth (MS2)', NULL, NULL, 'Montserratian', 'MS', '500', '1', 'MS.png', 0, 1, '2022-06-10 03:59:24', '2022-06-10 03:59:24'),
(504, 'Morocco', 'Kingdom of Morocco', 'Rabat', NULL, NULL, 'Moroccan', 'MA', '504', '212', 'MA.png', 0, 1, '2022-06-10 03:59:24', '2022-06-10 03:59:24'),
(508, 'Mozambique', 'Republic of Mozambique', 'Maputo', NULL, NULL, 'Mozambican', 'MZ', '508', '258', 'MZ.png', 0, 1, '2022-06-10 03:59:24', '2022-06-10 03:59:24'),
(512, 'Oman', 'Sultanate of Oman', 'Muscat', NULL, NULL, 'Omani', 'OM', '512', '968', 'OM.png', 0, 1, '2022-06-10 03:59:24', '2022-06-10 03:59:24'),
(516, 'Namibia', 'Republic of Namibia', 'Windhoek', NULL, NULL, 'Namibian', 'NA', '516', '264', 'NA.png', 0, 1, '2022-06-10 03:59:24', '2022-06-10 03:59:24'),
(520, 'Nauru', 'Republic of Nauru', 'Yaren', NULL, NULL, 'Nauruan', 'NR', '520', '674', 'NR.png', 0, 1, '2022-06-10 03:59:24', '2022-06-10 03:59:24'),
(524, 'Nepal', 'Nepal', 'Kathmandu', NULL, NULL, 'Nepalese', 'NP', '524', '977', 'NP.png', 0, 1, '2022-06-10 03:59:24', '2022-06-10 03:59:24'),
(528, 'Netherlands', 'Kingdom of the Netherlands', 'Amsterdam (NL2)', NULL, NULL, 'Dutch', 'NL', '528', '31', 'NL.png', 1, 1, '2022-06-10 03:59:24', '2022-06-10 03:59:24'),
(531, 'Curaçao', 'Curaçao', 'Willemstad', NULL, NULL, 'Curaçaoan', 'CW', '531', '599', NULL, 0, 1, '2022-06-10 03:59:25', '2022-06-10 03:59:25'),
(533, 'Aruba', 'Aruba', 'Oranjestad', NULL, NULL, 'Aruban', 'AW', '533', '297', 'AW.png', 0, 1, '2022-06-10 03:59:25', '2022-06-10 03:59:25'),
(534, 'Sint Maarten (Dutch part)', 'Sint Maarten', 'Philipsburg', NULL, NULL, 'Sint Maartener', 'SX', '534', '721', NULL, 0, 1, '2022-06-10 03:59:25', '2022-06-10 03:59:25'),
(535, 'Bonaire, Sint Eustatius and Saba', NULL, NULL, NULL, NULL, 'of Bonaire, Sint Eustatius and Saba', 'BQ', '535', '599', NULL, 0, 1, '2022-06-10 03:59:25', '2022-06-10 03:59:25'),
(540, 'New Caledonia', 'New Caledonia', 'Nouméa', NULL, NULL, 'New Caledonian', 'NC', '540', '687', 'NC.png', 0, 1, '2022-06-10 03:59:25', '2022-06-10 03:59:25'),
(548, 'Vanuatu', 'Republic of Vanuatu', 'Port Vila', NULL, NULL, 'Vanuatuan', 'VU', '548', '678', 'VU.png', 0, 1, '2022-06-10 03:59:25', '2022-06-10 03:59:25'),
(554, 'New Zealand', 'New Zealand', 'Wellington', NULL, NULL, 'New Zealander', 'NZ', '554', '64', 'NZ.png', 0, 1, '2022-06-10 03:59:25', '2022-06-10 03:59:25'),
(558, 'Nicaragua', 'Republic of Nicaragua', 'Managua', NULL, NULL, 'Nicaraguan', 'NI', '558', '505', 'NI.png', 0, 1, '2022-06-10 03:59:25', '2022-06-10 03:59:25'),
(562, 'Niger', 'Republic of Niger', 'Niamey', NULL, NULL, 'Nigerien', 'NE', '562', '227', 'NE.png', 0, 1, '2022-06-10 03:59:25', '2022-06-10 03:59:25'),
(566, 'Nigeria', 'Federal Republic of Nigeria', 'Abuja', NULL, NULL, 'Nigerian', 'NG', '566', '234', 'NG.png', 0, 1, '2022-06-10 03:59:25', '2022-06-10 03:59:25'),
(570, 'Niue', 'Niue', 'Alofi', NULL, NULL, 'Niuean', 'NU', '570', '683', 'NU.png', 0, 1, '2022-06-10 03:59:25', '2022-06-10 03:59:25'),
(574, 'Norfolk Island', 'Territory of Norfolk Island', 'Kingston', NULL, NULL, 'Norfolk Islander', 'NF', '574', '672', 'NF.png', 0, 1, '2022-06-10 03:59:25', '2022-06-10 03:59:25'),
(578, 'Norway', 'Kingdom of Norway', 'Oslo', NULL, NULL, 'Norwegian', 'NO', '578', '47', 'NO.png', 1, 1, '2022-06-10 03:59:25', '2022-06-10 03:59:25'),
(580, 'Northern Mariana Islands', 'Commonwealth of the Northern Mariana Islands', 'Saipan', NULL, NULL, 'Northern Mariana Islander', 'MP', '580', '1', 'MP.png', 0, 1, '2022-06-10 03:59:25', '2022-06-10 03:59:25'),
(581, 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', NULL, NULL, 'of United States Minor Outlying Islands', 'UM', '581', '1', 'UM.png', 0, 1, '2022-06-10 03:59:25', '2022-06-10 03:59:25'),
(583, 'Micronesia, Federated States of', 'Federated States of Micronesia', 'Palikir', NULL, NULL, 'Micronesian', 'FM', '583', '691', 'FM.png', 0, 1, '2022-06-10 03:59:26', '2022-06-10 03:59:26'),
(584, 'Marshall Islands', 'Republic of the Marshall Islands', 'Majuro', NULL, NULL, 'Marshallese', 'MH', '584', '692', 'MH.png', 0, 1, '2022-06-10 03:59:26', '2022-06-10 03:59:26'),
(585, 'Palau', 'Republic of Palau', 'Melekeok', NULL, NULL, 'Palauan', 'PW', '585', '680', 'PW.png', 0, 1, '2022-06-10 03:59:26', '2022-06-10 03:59:26'),
(586, 'Pakistan', 'Islamic Republic of Pakistan', 'Islamabad', NULL, NULL, 'Pakistani', 'PK', '586', '92', 'PK.png', 0, 1, '2022-06-10 03:59:26', '2022-06-10 03:59:26'),
(591, 'Panama', 'Republic of Panama', 'Panama City', NULL, NULL, 'Panamanian', 'PA', '591', '507', 'PA.png', 0, 1, '2022-06-10 03:59:26', '2022-06-10 03:59:26'),
(598, 'Papua New Guinea', 'Independent State of Papua New Guinea', 'Port Moresby', NULL, NULL, 'Papua New Guinean', 'PG', '598', '675', 'PG.png', 0, 1, '2022-06-10 03:59:26', '2022-06-10 03:59:26'),
(600, 'Paraguay', 'Republic of Paraguay', 'Asunción', NULL, NULL, 'Paraguayan', 'PY', '600', '595', 'PY.png', 0, 1, '2022-06-10 03:59:26', '2022-06-10 03:59:26'),
(604, 'Peru', 'Republic of Peru', 'Lima', NULL, NULL, 'Peruvian', 'PE', '604', '51', 'PE.png', 0, 1, '2022-06-10 03:59:26', '2022-06-10 03:59:26'),
(608, 'Philippines', 'Republic of the Philippines', 'Manila', NULL, NULL, 'Filipino', 'PH', '608', '63', 'PH.png', 0, 1, '2022-06-10 03:59:26', '2022-06-10 03:59:26'),
(612, 'Pitcairn', 'Pitcairn Islands', 'Adamstown', NULL, NULL, 'Pitcairner', 'PN', '612', '649', 'PN.png', 0, 1, '2022-06-10 03:59:26', '2022-06-10 03:59:26'),
(616, 'Poland', 'Republic of Poland', 'Warsaw', NULL, NULL, 'Polish', 'PL', '616', '48', 'PL.png', 1, 1, '2022-06-10 03:59:26', '2022-06-10 03:59:26'),
(620, 'Portugal', 'Portuguese Republic', 'Lisbon', NULL, NULL, 'Portuguese', 'PT', '620', '351', 'PT.png', 1, 1, '2022-06-10 03:59:26', '2022-06-10 03:59:26'),
(624, 'Guinea-Bissau', 'Republic of Guinea-Bissau', 'Bissau', NULL, NULL, 'Guinea-Bissau national', 'GW', '624', '245', 'GW.png', 0, 1, '2022-06-10 03:59:26', '2022-06-10 03:59:26'),
(626, 'Timor-Leste', 'Democratic Republic of East Timor', 'Dili', NULL, NULL, 'East Timorese', 'TL', '626', '670', 'TL.png', 0, 1, '2022-06-10 03:59:26', '2022-06-10 03:59:26'),
(630, 'Puerto Rico', 'Commonwealth of Puerto Rico', 'San Juan', NULL, NULL, 'Puerto Rican', 'PR', '630', '1', 'PR.png', 0, 1, '2022-06-10 03:59:26', '2022-06-10 03:59:26'),
(634, 'Qatar', 'State of Qatar', 'Doha', NULL, NULL, 'Qatari', 'QA', '634', '974', 'QA.png', 0, 1, '2022-06-10 03:59:26', '2022-06-10 03:59:26'),
(638, 'Réunion', 'Réunion', 'Saint-Denis', NULL, NULL, 'Reunionese', 'RE', '638', '262', 'RE.png', 0, 1, '2022-06-10 03:59:26', '2022-06-10 03:59:26'),
(642, 'Romania', 'Romania', 'Bucharest', NULL, NULL, 'Romanian', 'RO', '642', '40', 'RO.png', 1, 1, '2022-06-10 03:59:26', '2022-06-10 03:59:26'),
(643, 'Russian Federation', 'Russian Federation', 'Moscow', NULL, NULL, 'Russian', 'RU', '643', '7', 'RU.png', 0, 1, '2022-06-10 03:59:27', '2022-06-10 03:59:27'),
(646, 'Rwanda', 'Republic of Rwanda', 'Kigali', NULL, NULL, 'Rwandan; Rwandese', 'RW', '646', '250', 'RW.png', 0, 1, '2022-06-10 03:59:27', '2022-06-10 03:59:27'),
(652, 'Saint Barthélemy', 'Collectivity of Saint Barthélemy', 'Gustavia', NULL, NULL, 'of Saint Barthélemy', 'BL', '652', '590', NULL, 0, 1, '2022-06-10 03:59:27', '2022-06-10 03:59:27'),
(654, 'Saint Helena, Ascension and Tristan da Cunha', 'Saint Helena, Ascension and Tristan da Cunha', 'Jamestown', NULL, NULL, 'Saint Helenian', 'SH', '654', '290', 'SH.png', 0, 1, '2022-06-10 03:59:27', '2022-06-10 03:59:27'),
(659, 'Saint Kitts and Nevis', 'Federation of Saint Kitts and Nevis', 'Basseterre', NULL, NULL, 'Kittsian; Nevisian', 'KN', '659', '1', 'KN.png', 0, 1, '2022-06-10 03:59:27', '2022-06-10 03:59:27'),
(660, 'Anguilla', 'Anguilla', 'The Valley', NULL, NULL, 'Anguillan', 'AI', '660', '1', 'AI.png', 0, 1, '2022-06-10 03:59:28', '2022-06-10 03:59:28'),
(662, 'Saint Lucia', 'Saint Lucia', 'Castries', NULL, NULL, 'Saint Lucian', 'LC', '662', '1', 'LC.png', 0, 1, '2022-06-10 03:59:28', '2022-06-10 03:59:28'),
(663, 'Saint Martin (French part)', 'Collectivity of Saint Martin', 'Marigot', NULL, NULL, 'of Saint Martin', 'MF', '663', '590', NULL, 0, 1, '2022-06-10 03:59:28', '2022-06-10 03:59:28'),
(666, 'Saint Pierre and Miquelon', 'Territorial Collectivity of Saint Pierre and Miquelon', 'Saint-Pierre', NULL, NULL, 'St-Pierrais; Miquelonnais', 'PM', '666', '508', 'PM.png', 0, 1, '2022-06-10 03:59:28', '2022-06-10 03:59:28'),
(670, 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines', 'Kingstown', NULL, NULL, 'Vincentian', 'VC', '670', '1', 'VC.png', 0, 1, '2022-06-10 03:59:28', '2022-06-10 03:59:28'),
(674, 'San Marino', 'Republic of San Marino', 'San Marino', NULL, NULL, 'San Marinese', 'SM', '674', '378', 'SM.png', 0, 1, '2022-06-10 03:59:28', '2022-06-10 03:59:28'),
(678, 'Sao Tome and Principe', 'Democratic Republic of São Tomé and Príncipe', 'São Tomé', NULL, NULL, 'São Toméan', 'ST', '678', '239', 'ST.png', 0, 1, '2022-06-10 03:59:28', '2022-06-10 03:59:28'),
(682, 'Saudi Arabia', 'Kingdom of Saudi Arabia', 'Riyadh', NULL, NULL, 'Saudi Arabian', 'SA', '682', '966', 'SA.png', 0, 1, '2022-06-10 03:59:28', '2022-06-10 03:59:28'),
(686, 'Senegal', 'Republic of Senegal', 'Dakar', NULL, NULL, 'Senegalese', 'SN', '686', '221', 'SN.png', 0, 1, '2022-06-10 03:59:28', '2022-06-10 03:59:28'),
(688, 'Serbia', 'Republic of Serbia', 'Belgrade', NULL, NULL, 'Serb', 'RS', '688', '381', NULL, 0, 1, '2022-06-10 03:59:28', '2022-06-10 03:59:28'),
(690, 'Seychelles', 'Republic of Seychelles', 'Victoria', NULL, NULL, 'Seychellois', 'SC', '690', '248', 'SC.png', 0, 1, '2022-06-10 03:59:28', '2022-06-10 03:59:28'),
(694, 'Sierra Leone', 'Republic of Sierra Leone', 'Freetown', NULL, NULL, 'Sierra Leonean', 'SL', '694', '232', 'SL.png', 0, 1, '2022-06-10 03:59:28', '2022-06-10 03:59:28'),
(702, 'Singapore', 'Republic of Singapore', 'Singapore', NULL, NULL, 'Singaporean', 'SG', '702', '65', 'SG.png', 0, 1, '2022-06-10 03:59:28', '2022-06-10 03:59:28'),
(703, 'Slovakia', 'Slovak Republic', 'Bratislava', NULL, NULL, 'Slovak', 'SK', '703', '421', 'SK.png', 1, 1, '2022-06-10 03:59:28', '2022-06-10 03:59:28'),
(704, 'Viet Nam', 'Socialist Republic of Vietnam', 'Hanoi', NULL, NULL, 'Vietnamese', 'VN', '704', '84', 'VN.png', 0, 1, '2022-06-10 03:59:28', '2022-06-10 03:59:28'),
(705, 'Slovenia', 'Republic of Slovenia', 'Ljubljana', NULL, NULL, 'Slovene', 'SI', '705', '386', 'SI.png', 1, 1, '2022-06-10 03:59:28', '2022-06-10 03:59:28'),
(706, 'Somalia', 'Somali Republic', 'Mogadishu', NULL, NULL, 'Somali', 'SO', '706', '252', 'SO.png', 0, 1, '2022-06-10 03:59:28', '2022-06-10 03:59:28'),
(710, 'South Africa', 'Republic of South Africa', 'Pretoria (ZA1)', NULL, NULL, 'South African', 'ZA', '710', '27', 'ZA.png', 0, 1, '2022-06-10 03:59:28', '2022-06-10 03:59:28'),
(716, 'Zimbabwe', 'Republic of Zimbabwe', 'Harare', NULL, NULL, 'Zimbabwean', 'ZW', '716', '263', 'ZW.png', 0, 1, '2022-06-10 03:59:29', '2022-06-10 03:59:29'),
(724, 'Spain', 'Kingdom of Spain', 'Madrid', NULL, NULL, 'Spaniard', 'ES', '724', '34', 'ES.png', 1, 1, '2022-06-10 03:59:29', '2022-06-10 03:59:29'),
(728, 'South Sudan', 'Republic of South Sudan', 'Juba', NULL, NULL, 'South Sudanese', 'SS', '728', '211', NULL, 0, 1, '2022-06-10 03:59:29', '2022-06-10 03:59:29'),
(729, 'Sudan', 'Republic of the Sudan', 'Khartoum', NULL, NULL, 'Sudanese', 'SD', '729', '249', NULL, 0, 1, '2022-06-10 03:59:29', '2022-06-10 03:59:29'),
(732, 'Western Sahara', 'Western Sahara', 'Al aaiun', NULL, NULL, 'Sahrawi', 'EH', '732', '212', 'EH.png', 0, 1, '2022-06-10 03:59:29', '2022-06-10 03:59:29'),
(740, 'Suriname', 'Republic of Suriname', 'Paramaribo', NULL, NULL, 'Surinamese', 'SR', '740', '597', 'SR.png', 0, 1, '2022-06-10 03:59:29', '2022-06-10 03:59:29'),
(744, 'Svalbard and Jan Mayen', 'Svalbard and Jan Mayen', 'Longyearbyen', NULL, NULL, 'of Svalbard', 'SJ', '744', '47', 'SJ.png', 0, 1, '2022-06-10 03:59:29', '2022-06-10 03:59:29'),
(748, 'Swaziland', 'Kingdom of Swaziland', 'Mbabane', NULL, NULL, 'Swazi', 'SZ', '748', '268', 'SZ.png', 0, 1, '2022-06-10 03:59:29', '2022-06-10 03:59:29'),
(752, 'Sweden', 'Kingdom of Sweden', 'Stockholm', NULL, NULL, 'Swedish', 'SE', '752', '46', 'SE.png', 1, 1, '2022-06-10 03:59:29', '2022-06-10 03:59:29'),
(756, 'Switzerland', 'Swiss Confederation', 'Berne', NULL, NULL, 'Swiss', 'CH', '756', '41', 'CH.png', 1, 1, '2022-06-10 03:59:29', '2022-06-10 03:59:29'),
(760, 'Syrian Arab Republic', 'Syrian Arab Republic', 'Damascus', NULL, NULL, 'Syrian', 'SY', '760', '963', 'SY.png', 0, 1, '2022-06-10 03:59:29', '2022-06-10 03:59:29'),
(762, 'Tajikistan', 'Republic of Tajikistan', 'Dushanbe', NULL, NULL, 'Tajik', 'TJ', '762', '992', 'TJ.png', 0, 1, '2022-06-10 03:59:29', '2022-06-10 03:59:29'),
(764, 'Thailand', 'Kingdom of Thailand', 'Bangkok', NULL, NULL, 'Thai', 'TH', '764', '66', 'TH.png', 0, 1, '2022-06-10 03:59:29', '2022-06-10 03:59:29'),
(768, 'Togo', 'Togolese Republic', 'Lomé', NULL, NULL, 'Togolese', 'TG', '768', '228', 'TG.png', 0, 1, '2022-06-10 03:59:30', '2022-06-10 03:59:30'),
(772, 'Tokelau', 'Tokelau', '(TK2)', NULL, NULL, 'Tokelauan', 'TK', '772', '690', 'TK.png', 0, 1, '2022-06-10 03:59:30', '2022-06-10 03:59:30'),
(776, 'Tonga', 'Kingdom of Tonga', 'Nuku’alofa', NULL, NULL, 'Tongan', 'TO', '776', '676', 'TO.png', 0, 1, '2022-06-10 03:59:30', '2022-06-10 03:59:30'),
(780, 'Trinidad and Tobago', 'Republic of Trinidad and Tobago', 'Port of Spain', NULL, NULL, 'Trinidadian; Tobagonian', 'TT', '780', '1', 'TT.png', 0, 1, '2022-06-10 03:59:30', '2022-06-10 03:59:30'),
(784, 'United Arab Emirates', 'United Arab Emirates', 'Abu Dhabi', NULL, NULL, 'Emirian', 'AE', '784', '971', 'AE.png', 0, 1, '2022-06-10 03:59:30', '2022-06-10 03:59:30'),
(788, 'Tunisia', 'Republic of Tunisia', 'Tunis', NULL, NULL, 'Tunisian', 'TN', '788', '216', 'TN.png', 0, 1, '2022-06-10 03:59:30', '2022-06-10 03:59:30'),
(792, 'Turkey', 'Republic of Turkey', 'Ankara', NULL, NULL, 'Turk', 'TR', '792', '90', 'TR.png', 0, 1, '2022-06-10 03:59:30', '2022-06-10 03:59:30'),
(795, 'Turkmenistan', 'Turkmenistan', 'Ashgabat', NULL, NULL, 'Turkmen', 'TM', '795', '993', 'TM.png', 0, 1, '2022-06-10 03:59:31', '2022-06-10 03:59:31'),
(796, 'Turks and Caicos Islands', 'Turks and Caicos Islands', 'Cockburn Town', NULL, NULL, 'Turks and Caicos Islander', 'TC', '796', '1', 'TC.png', 0, 1, '2022-06-10 03:59:31', '2022-06-10 03:59:31'),
(798, 'Tuvalu', 'Tuvalu', 'Funafuti', NULL, NULL, 'Tuvaluan', 'TV', '798', '688', 'TV.png', 0, 1, '2022-06-10 03:59:31', '2022-06-10 03:59:31'),
(800, 'Uganda', 'Republic of Uganda', 'Kampala', NULL, NULL, 'Ugandan', 'UG', '800', '256', 'UG.png', 0, 1, '2022-06-10 03:59:31', '2022-06-10 03:59:31'),
(804, 'Ukraine', 'Ukraine', 'Kiev', NULL, NULL, 'Ukrainian', 'UA', '804', '380', 'UA.png', 0, 1, '2022-06-10 03:59:31', '2022-06-10 03:59:31'),
(807, 'Macedonia, the former Yugoslav Republic of', 'the former Yugoslav Republic of Macedonia', 'Skopje', NULL, NULL, 'of the former Yugoslav Republic of Macedonia', 'MK', '807', '389', 'MK.png', 0, 1, '2022-06-10 03:59:31', '2022-06-10 03:59:31'),
(818, 'Egypt', 'Arab Republic of Egypt', 'Cairo', NULL, NULL, 'Egyptian', 'EG', '818', '20', 'EG.png', 0, 1, '2022-06-10 03:59:31', '2022-06-10 03:59:31'),
(826, 'United Kingdom', 'United Kingdom of Great Britain and Northern Ireland', 'London', NULL, NULL, 'British', 'GB', '826', '44', 'GB.png', 1, 1, '2022-06-10 03:59:31', '2022-06-10 03:59:31'),
(831, 'Guernsey', 'Bailiwick of Guernsey', 'St Peter Port', NULL, NULL, 'of Guernsey', 'GG', '831', '44', NULL, 0, 1, '2022-06-10 03:59:31', '2022-06-10 03:59:31'),
(832, 'Jersey', 'Bailiwick of Jersey', 'St Helier', NULL, NULL, 'of Jersey', 'JE', '832', '44', NULL, 0, 1, '2022-06-10 03:59:31', '2022-06-10 03:59:31'),
(833, 'Isle of Man', 'Isle of Man', 'Douglas', NULL, NULL, 'Manxman; Manxwoman', 'IM', '833', '44', NULL, 0, 1, '2022-06-10 03:59:31', '2022-06-10 03:59:31'),
(834, 'Tanzania, United Republic of', 'United Republic of Tanzania', 'Dodoma (TZ1)', NULL, NULL, 'Tanzanian', 'TZ', '834', '255', 'TZ.png', 0, 1, '2022-06-10 03:59:31', '2022-06-10 03:59:31'),
(840, 'United States', 'United States of America', 'Washington DC', NULL, NULL, 'American', 'US', '840', '1', 'US.png', 0, 1, '2022-06-10 03:59:31', '2022-06-10 03:59:31'),
(850, 'Virgin Islands, U.S.', 'United States Virgin Islands', 'Charlotte Amalie', NULL, NULL, 'US Virgin Islander', 'VI', '850', '1', 'VI.png', 0, 1, '2022-06-10 03:59:31', '2022-06-10 03:59:31'),
(854, 'Burkina Faso', 'Burkina Faso', 'Ouagadougou', NULL, NULL, 'Burkinabe', 'BF', '854', '226', 'BF.png', 0, 1, '2022-06-10 03:59:31', '2022-06-10 03:59:31'),
(858, 'Uruguay', 'Eastern Republic of Uruguay', 'Montevideo', NULL, NULL, 'Uruguayan', 'UY', '858', '598', 'UY.png', 0, 1, '2022-06-10 03:59:31', '2022-06-10 03:59:31'),
(860, 'Uzbekistan', 'Republic of Uzbekistan', 'Tashkent', NULL, NULL, 'Uzbek', 'UZ', '860', '998', 'UZ.png', 0, 1, '2022-06-10 03:59:31', '2022-06-10 03:59:31'),
(862, 'Venezuela, Bolivarian Republic of', 'Bolivarian Republic of Venezuela', 'Caracas', NULL, NULL, 'Venezuelan', 'VE', '862', '58', 'VE.png', 0, 1, '2022-06-10 03:59:31', '2022-06-10 03:59:31'),
(876, 'Wallis and Futuna', 'Wallis and Futuna', 'Mata-Utu', NULL, NULL, 'Wallisian; Futunan; Wallis and Futuna Islander', 'WF', '876', '681', 'WF.png', 0, 1, '2022-06-10 03:59:32', '2022-06-10 03:59:32'),
(882, 'Samoa', 'Independent State of Samoa', 'Apia', NULL, NULL, 'Samoan', 'WS', '882', '685', 'WS.png', 0, 1, '2022-06-10 03:59:32', '2022-06-10 03:59:32'),
(887, 'Yemen', 'Republic of Yemen', 'San’a', NULL, NULL, 'Yemenite', 'YE', '887', '967', 'YE.png', 0, 1, '2022-06-10 03:59:32', '2022-06-10 03:59:32'),
(894, 'Zambia', 'Republic of Zambia', 'Lusaka', NULL, NULL, 'Zambian', 'ZM', '894', '260', 'ZM.png', 0, 1, '2022-06-10 03:59:32', '2022-06-10 03:59:32');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `iso_code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso_numeric` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disambiguate_symbol` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subunit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subunit_to_unit` int(11) NOT NULL DEFAULT 100,
  `symbol_first` tinyint(1) NOT NULL DEFAULT 1,
  `html_entity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decimal_mark` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thousands_separator` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smallest_denomination` int(11) NOT NULL DEFAULT 1,
  `priority` int(11) DEFAULT 100,
  `active` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `iso_code`, `iso_numeric`, `name`, `symbol`, `disambiguate_symbol`, `subunit`, `subunit_to_unit`, `symbol_first`, `html_entity`, `decimal_mark`, `thousands_separator`, `smallest_denomination`, `priority`, `active`, `created_at`, `updated_at`) VALUES
(1, 'AED', '784', 'United Arab Emirates Dirham', 'د.إ', NULL, 'Fils', 100, 0, '', '.', ',', 25, 100, 0, '2022-06-10 03:59:32', '2022-06-10 03:59:32'),
(2, 'AFN', '971', 'Afghani', '؋', NULL, 'Pul', 100, 0, '', '.', ',', 100, 100, 0, '2022-06-10 03:59:32', '2022-06-10 03:59:32'),
(3, 'ALL', '008', 'Albanian Lek', 'L', 'Lek', 'Qintar', 100, 0, '', '.', ',', 100, 100, 0, '2022-06-10 03:59:32', '2022-06-10 03:59:32'),
(4, 'AMD', '051', 'Armenian Dram', 'դր.', NULL, 'Luma', 100, 0, '', '.', ',', 10, 100, 0, '2022-06-10 03:59:32', '2022-06-10 03:59:32'),
(5, 'ANG', '532', 'Netherlands Antillean Gulden', 'ƒ', NULL, 'Cent', 100, 1, '&#x0192;', ',', '.', 1, 100, 0, '2022-06-10 03:59:33', '2022-06-10 03:59:33'),
(6, 'AOA', '973', 'Angolan Kwanza', 'Kz', NULL, 'Cêntimo', 100, 0, '', '.', ',', 10, 100, 0, '2022-06-10 03:59:33', '2022-06-10 03:59:33'),
(7, 'ARS', '032', 'Argentine Peso', '$', '$m/n', 'Centavo', 100, 1, '&#x20B1;', ',', '.', 1, 100, 0, '2022-06-10 03:59:33', '2022-06-10 03:59:33'),
(8, 'AUD', '036', 'Australian Dollar', '$', 'A$', 'Cent', 100, 1, '$', '.', ',', 5, 4, 0, '2022-06-10 03:59:33', '2022-06-10 03:59:33'),
(9, 'AWG', '533', 'Aruban Florin', 'ƒ', NULL, 'Cent', 100, 0, '&#x0192;', '.', ',', 5, 100, 0, '2022-06-10 03:59:33', '2022-06-10 03:59:33'),
(10, 'AZN', '944', 'Azerbaijani Manat', '₼', NULL, 'Qəpik', 100, 1, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:33', '2022-06-10 03:59:33'),
(11, 'BAM', '977', 'Bosnia and Herzegovina Convertible Mark', 'КМ', NULL, 'Fening', 100, 1, '', '.', ',', 5, 100, 0, '2022-06-10 03:59:33', '2022-06-10 03:59:33'),
(12, 'BBD', '052', 'Barbadian Dollar', '$', 'Bds$', 'Cent', 100, 0, '$', '.', ',', 1, 100, 0, '2022-06-10 03:59:33', '2022-06-10 03:59:33'),
(13, 'BDT', '050', 'Bangladeshi Taka', '৳', NULL, 'Paisa', 100, 1, '', '.', ',', 1, 10, 1, '2022-06-10 03:59:33', '2022-06-10 03:59:33'),
(14, 'BGN', '975', 'Bulgarian Lev', 'лв.', NULL, 'Stotinka', 100, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:33', '2022-06-10 03:59:33'),
(15, 'BHD', '048', 'Bahraini Dinar', 'ب.د', NULL, 'Fils', 1000, 1, '', '.', ',', 5, 100, 0, '2022-06-10 03:59:33', '2022-06-10 03:59:33'),
(16, 'BIF', '108', 'Burundian Franc', 'Fr', 'FBu', 'Centime', 1, 0, '', '.', ',', 100, 100, 0, '2022-06-10 03:59:33', '2022-06-10 03:59:33'),
(17, 'BMD', '060', 'Bermudian Dollar', '$', 'BD$', 'Cent', 100, 1, '$', '.', ',', 1, 100, 0, '2022-06-10 03:59:33', '2022-06-10 03:59:33'),
(18, 'BND', '096', 'Brunei Dollar', '$', 'BND', 'Sen', 100, 1, '$', '.', ',', 1, 100, 0, '2022-06-10 03:59:34', '2022-06-10 03:59:34'),
(19, 'BOB', '068', 'Bolivian Boliviano', 'Bs.', NULL, 'Centavo', 100, 1, '', '.', ',', 10, 100, 0, '2022-06-10 03:59:34', '2022-06-10 03:59:34'),
(20, 'BRL', '986', 'Brazilian Real', 'R$', NULL, 'Centavo', 100, 1, 'R$', ',', '.', 5, 100, 0, '2022-06-10 03:59:34', '2022-06-10 03:59:34'),
(21, 'BSD', '044', 'Bahamian Dollar', '$', 'BSD', 'Cent', 100, 1, '$', '.', ',', 1, 100, 0, '2022-06-10 03:59:34', '2022-06-10 03:59:34'),
(22, 'BTN', '064', 'Bhutanese Ngultrum', 'Nu.', NULL, 'Chertrum', 100, 0, '', '.', ',', 5, 100, 0, '2022-06-10 03:59:34', '2022-06-10 03:59:34'),
(23, 'BWP', '072', 'Botswana Pula', 'P', NULL, 'Thebe', 100, 1, '', '.', ',', 5, 100, 0, '2022-06-10 03:59:34', '2022-06-10 03:59:34'),
(24, 'BYN', '933', 'Belarusian Ruble', 'Br', 'BYN', 'Kapeyka', 100, 0, '', ',', ' ', 1, 100, 0, '2022-06-10 03:59:34', '2022-06-10 03:59:34'),
(25, 'BYR', '974', 'Belarusian Ruble', 'Br', 'BYR', NULL, 1, 0, '', ',', ' ', 100, 50, 0, '2022-06-10 03:59:34', '2022-06-10 03:59:34'),
(26, 'BZD', '084', 'Belize Dollar', '$', 'BZ$', 'Cent', 100, 1, '$', '.', ',', 1, 100, 0, '2022-06-10 03:59:34', '2022-06-10 03:59:34'),
(27, 'CAD', '124', 'Canadian Dollar', '$', 'C$', 'Cent', 100, 1, '$', '.', ',', 5, 5, 0, '2022-06-10 03:59:34', '2022-06-10 03:59:34'),
(28, 'CDF', '976', 'Congolese Franc', 'Fr', 'FC', 'Centime', 100, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:34', '2022-06-10 03:59:34'),
(29, 'CHF', '756', 'Swiss Franc', 'CHF', NULL, 'Rappen', 100, 1, '', '.', ',', 5, 100, 0, '2022-06-10 03:59:34', '2022-06-10 03:59:34'),
(30, 'CLF', '990', 'Unidad de Fomento', 'UF', NULL, 'Peso', 10000, 1, '&#x20B1;', ',', '.', 1, 100, 0, '2022-06-10 03:59:34', '2022-06-10 03:59:34'),
(31, 'CLP', '152', 'Chilean Peso', '$', 'CLP', 'Peso', 1, 1, '&#36;', ',', '.', 1, 100, 0, '2022-06-10 03:59:34', '2022-06-10 03:59:34'),
(32, 'CNY', '156', 'Chinese Renminbi Yuan', '¥', NULL, 'Fen', 100, 1, '￥', '.', ',', 1, 100, 0, '2022-06-10 03:59:34', '2022-06-10 03:59:34'),
(33, 'COP', '170', 'Colombian Peso', '$', 'COL$', 'Centavo', 100, 1, '&#36;', ',', '.', 20, 100, 0, '2022-06-10 03:59:34', '2022-06-10 03:59:34'),
(34, 'CRC', '188', 'Costa Rican Colón', '₡', NULL, 'Céntimo', 100, 1, '&#x20A1;', ',', '.', 500, 100, 0, '2022-06-10 03:59:34', '2022-06-10 03:59:34'),
(35, 'CUC', '931', 'Cuban Convertible Peso', '$', 'CUC$', 'Centavo', 100, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:35', '2022-06-10 03:59:35'),
(36, 'CUP', '192', 'Cuban Peso', '$', '$MN', 'Centavo', 100, 1, '&#x20B1;', '.', ',', 1, 100, 0, '2022-06-10 03:59:35', '2022-06-10 03:59:35'),
(37, 'CVE', '132', 'Cape Verdean Escudo', '$', 'Esc', 'Centavo', 100, 0, '', '.', ',', 100, 100, 0, '2022-06-10 03:59:35', '2022-06-10 03:59:35'),
(38, 'CZK', '203', 'Czech Koruna', 'Kč', NULL, 'Haléř', 100, 0, '', ',', ' ', 100, 100, 0, '2022-06-10 03:59:35', '2022-06-10 03:59:35'),
(39, 'DJF', '262', 'Djiboutian Franc', 'Fdj', NULL, 'Centime', 1, 0, '', '.', ',', 100, 100, 0, '2022-06-10 03:59:36', '2022-06-10 03:59:36'),
(40, 'DKK', '208', 'Danish Krone', 'kr.', 'DKK', 'Øre', 100, 0, '', ',', '.', 50, 100, 0, '2022-06-10 03:59:36', '2022-06-10 03:59:36'),
(41, 'DOP', '214', 'Dominican Peso', '$', 'RD$', 'Centavo', 100, 1, '&#x20B1;', '.', ',', 100, 100, 0, '2022-06-10 03:59:36', '2022-06-10 03:59:36'),
(42, 'DZD', '012', 'Algerian Dinar', 'د.ج', NULL, 'Centime', 100, 0, '', '.', ',', 100, 100, 0, '2022-06-10 03:59:36', '2022-06-10 03:59:36'),
(43, 'EGP', '818', 'Egyptian Pound', 'ج.م', NULL, 'Piastre', 100, 1, '&#x00A3;', '.', ',', 25, 100, 0, '2022-06-10 03:59:36', '2022-06-10 03:59:36'),
(44, 'ERN', '232', 'Eritrean Nakfa', 'Nfk', NULL, 'Cent', 100, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:36', '2022-06-10 03:59:36'),
(45, 'ETB', '230', 'Ethiopian Birr', 'Br', 'ETB', 'Santim', 100, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:36', '2022-06-10 03:59:36'),
(46, 'EUR', '978', 'Euro', '€', NULL, 'Cent', 100, 1, '&#x20AC;', ',', '.', 1, 2, 1, '2022-06-10 03:59:36', '2022-06-10 03:59:36'),
(47, 'FJD', '242', 'Fijian Dollar', '$', 'FJ$', 'Cent', 100, 0, '$', '.', ',', 5, 100, 0, '2022-06-10 03:59:36', '2022-06-10 03:59:36'),
(48, 'FKP', '238', 'Falkland Pound', '£', 'FK£', 'Penny', 100, 0, '&#x00A3;', '.', ',', 1, 100, 0, '2022-06-10 03:59:36', '2022-06-10 03:59:36'),
(49, 'GBP', '826', 'British Pound', '£', NULL, 'Penny', 100, 1, '&#x00A3;', '.', ',', 1, 3, 0, '2022-06-10 03:59:36', '2022-06-10 03:59:36'),
(50, 'GEL', '981', 'Georgian Lari', 'ლ', NULL, 'Tetri', 100, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:36', '2022-06-10 03:59:36'),
(51, 'GHS', '936', 'Ghanaian Cedi', '₵', NULL, 'Pesewa', 100, 1, '&#x20B5;', '.', ',', 1, 100, 0, '2022-06-10 03:59:36', '2022-06-10 03:59:36'),
(52, 'GIP', '292', 'Gibraltar Pound', '£', 'GIP', 'Penny', 100, 1, '&#x00A3;', '.', ',', 1, 100, 0, '2022-06-10 03:59:36', '2022-06-10 03:59:36'),
(53, 'GMD', '270', 'Gambian Dalasi', 'D', NULL, 'Butut', 100, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:36', '2022-06-10 03:59:36'),
(54, 'GNF', '324', 'Guinean Franc', 'Fr', 'FG', 'Centime', 1, 0, '', '.', ',', 100, 100, 0, '2022-06-10 03:59:36', '2022-06-10 03:59:36'),
(55, 'GTQ', '320', 'Guatemalan Quetzal', 'Q', NULL, 'Centavo', 100, 1, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:36', '2022-06-10 03:59:36'),
(56, 'GYD', '328', 'Guyanese Dollar', '$', 'G$', 'Cent', 100, 0, '$', '.', ',', 100, 100, 0, '2022-06-10 03:59:36', '2022-06-10 03:59:36'),
(57, 'HKD', '344', 'Hong Kong Dollar', '$', 'HK$', 'Cent', 100, 1, '$', '.', ',', 10, 100, 0, '2022-06-10 03:59:36', '2022-06-10 03:59:36'),
(58, 'HNL', '340', 'Honduran Lempira', 'L', 'HNL', 'Centavo', 100, 1, '', '.', ',', 5, 100, 0, '2022-06-10 03:59:36', '2022-06-10 03:59:36'),
(59, 'HRK', '191', 'Croatian Kuna', 'kn', NULL, 'Lipa', 100, 0, '', ',', '.', 1, 100, 0, '2022-06-10 03:59:37', '2022-06-10 03:59:37'),
(60, 'HTG', '332', 'Haitian Gourde', 'G', NULL, 'Centime', 100, 0, '', '.', ',', 5, 100, 0, '2022-06-10 03:59:37', '2022-06-10 03:59:37'),
(61, 'HUF', '348', 'Hungarian Forint', 'Ft', NULL, 'Fillér', 1, 0, '', ',', '.', 5, 100, 0, '2022-06-10 03:59:37', '2022-06-10 03:59:37'),
(62, 'IDR', '360', 'Indonesian Rupiah', 'Rp', NULL, 'Sen', 100, 1, '', ',', '.', 5000, 100, 0, '2022-06-10 03:59:37', '2022-06-10 03:59:37'),
(63, 'ILS', '376', 'Israeli New Sheqel', '₪', NULL, 'Agora', 100, 1, '&#x20AA;', '.', ',', 10, 100, 0, '2022-06-10 03:59:37', '2022-06-10 03:59:37'),
(64, 'INR', '356', 'Indian Rupee', '₹', NULL, 'Paisa', 100, 1, '&#x20b9;', '.', ',', 50, 59, 1, '2022-06-10 03:59:37', '2022-06-10 03:59:37'),
(65, 'IQD', '368', 'Iraqi Dinar', 'ع.د', NULL, 'Fils', 1000, 0, '', '.', ',', 50000, 100, 0, '2022-06-10 03:59:37', '2022-06-10 03:59:37'),
(66, 'IRR', '364', 'Iranian Rial', '﷼', NULL, NULL, 100, 1, '&#xFDFC;', '.', ',', 5000, 100, 0, '2022-06-10 03:59:37', '2022-06-10 03:59:37'),
(67, 'ISK', '352', 'Icelandic Króna', 'kr', NULL, NULL, 1, 1, '', ',', '.', 1, 100, 0, '2022-06-10 03:59:37', '2022-06-10 03:59:37'),
(68, 'JMD', '388', 'Jamaican Dollar', '$', 'J$', 'Cent', 100, 1, '$', '.', ',', 1, 100, 0, '2022-06-10 03:59:37', '2022-06-10 03:59:37'),
(69, 'JOD', '400', 'Jordanian Dinar', 'د.ا', NULL, 'Fils', 1000, 1, '', '.', ',', 5, 100, 0, '2022-06-10 03:59:37', '2022-06-10 03:59:37'),
(70, 'JPY', '392', 'Japanese Yen', '¥', NULL, NULL, 1, 1, '&#x00A5;', '.', ',', 1, 6, 1, '2022-06-10 03:59:38', '2022-06-10 03:59:38'),
(71, 'KES', '404', 'Kenyan Shilling', 'KSh', NULL, 'Cent', 100, 1, '', '.', ',', 50, 100, 0, '2022-06-10 03:59:38', '2022-06-10 03:59:38'),
(72, 'KGS', '417', 'Kyrgyzstani Som', 'som', NULL, 'Tyiyn', 100, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:38', '2022-06-10 03:59:38'),
(73, 'KHR', '116', 'Cambodian Riel', '៛', NULL, 'Sen', 100, 0, '&#x17DB;', '.', ',', 5000, 100, 0, '2022-06-10 03:59:38', '2022-06-10 03:59:38'),
(74, 'KMF', '174', 'Comorian Franc', 'Fr', 'CF', 'Centime', 1, 0, '', '.', ',', 100, 100, 0, '2022-06-10 03:59:38', '2022-06-10 03:59:38'),
(75, 'KPW', '408', 'North Korean Won', '₩', NULL, 'Chŏn', 100, 0, '&#x20A9;', '.', ',', 1, 100, 0, '2022-06-10 03:59:38', '2022-06-10 03:59:38'),
(76, 'KRW', '410', 'South Korean Won', '₩', NULL, NULL, 1, 1, '&#x20A9;', '.', ',', 1, 100, 0, '2022-06-10 03:59:38', '2022-06-10 03:59:38'),
(77, 'KWD', '414', 'Kuwaiti Dinar', 'د.ك', NULL, 'Fils', 1000, 1, '', '.', ',', 5, 100, 0, '2022-06-10 03:59:38', '2022-06-10 03:59:38'),
(78, 'KYD', '136', 'Cayman Islands Dollar', '$', 'CI$', 'Cent', 100, 1, '$', '.', ',', 1, 100, 0, '2022-06-10 03:59:38', '2022-06-10 03:59:38'),
(79, 'KZT', '398', 'Kazakhstani Tenge', '〒', NULL, 'Tiyn', 100, 0, '', '.', ',', 100, 100, 0, '2022-06-10 03:59:38', '2022-06-10 03:59:38'),
(80, 'LAK', '418', 'Lao Kip', '₭', NULL, 'Att', 100, 0, '&#x20AD;', '.', ',', 10, 100, 0, '2022-06-10 03:59:38', '2022-06-10 03:59:38'),
(81, 'LBP', '422', 'Lebanese Pound', 'ل.ل', NULL, 'Piastre', 100, 1, '&#x00A3;', '.', ',', 25000, 100, 0, '2022-06-10 03:59:38', '2022-06-10 03:59:38'),
(82, 'LKR', '144', 'Sri Lankan Rupee', '₨', 'SLRs', 'Cent', 100, 0, '&#x0BF9;', '.', ',', 100, 100, 0, '2022-06-10 03:59:38', '2022-06-10 03:59:38'),
(83, 'LRD', '430', 'Liberian Dollar', '$', 'L$', 'Cent', 100, 0, '$', '.', ',', 5, 100, 0, '2022-06-10 03:59:38', '2022-06-10 03:59:38'),
(84, 'LSL', '426', 'Lesotho Loti', 'L', 'M', 'Sente', 100, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:38', '2022-06-10 03:59:38'),
(85, 'LTL', '440', 'Lithuanian Litas', 'Lt', NULL, 'Centas', 100, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:38', '2022-06-10 03:59:38'),
(86, 'LVL', '428', 'Latvian Lats', 'Ls', NULL, 'Santīms', 100, 1, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:38', '2022-06-10 03:59:38'),
(87, 'LYD', '434', 'Libyan Dinar', 'ل.د', NULL, 'Dirham', 1000, 0, '', '.', ',', 50, 100, 0, '2022-06-10 03:59:38', '2022-06-10 03:59:38'),
(88, 'MAD', '504', 'Moroccan Dirham', 'د.م.', NULL, 'Centime', 100, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:38', '2022-06-10 03:59:38'),
(89, 'MDL', '498', 'Moldovan Leu', 'L', NULL, 'Ban', 100, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:39', '2022-06-10 03:59:39'),
(90, 'MGA', '969', 'Malagasy Ariary', 'Ar', NULL, 'Iraimbilanja', 5, 1, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:39', '2022-06-10 03:59:39'),
(91, 'MKD', '807', 'Macedonian Denar', 'ден', NULL, 'Deni', 100, 0, '', '.', ',', 100, 100, 0, '2022-06-10 03:59:39', '2022-06-10 03:59:39'),
(92, 'MMK', '104', 'Myanmar Kyat', 'K', 'MMK', 'Pya', 100, 0, '', '.', ',', 50, 100, 0, '2022-06-10 03:59:39', '2022-06-10 03:59:39'),
(93, 'MNT', '496', 'Mongolian Tögrög', '₮', NULL, 'Möngö', 100, 0, '&#x20AE;', '.', ',', 2000, 100, 0, '2022-06-10 03:59:39', '2022-06-10 03:59:39'),
(94, 'MOP', '446', 'Macanese Pataca', 'P', NULL, 'Avo', 100, 0, '', '.', ',', 10, 100, 0, '2022-06-10 03:59:39', '2022-06-10 03:59:39'),
(95, 'MRO', '478', 'Mauritanian Ouguiya', 'UM', NULL, 'Khoums', 5, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:39', '2022-06-10 03:59:39'),
(96, 'MUR', '480', 'Mauritian Rupee', '₨', NULL, 'Cent', 100, 1, '&#x20A8;', '.', ',', 100, 100, 0, '2022-06-10 03:59:39', '2022-06-10 03:59:39'),
(97, 'MVR', '462', 'Maldivian Rufiyaa', 'MVR', NULL, 'Laari', 100, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:39', '2022-06-10 03:59:39'),
(98, 'MWK', '454', 'Malawian Kwacha', 'MK', NULL, 'Tambala', 100, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:39', '2022-06-10 03:59:39'),
(99, 'MXN', '484', 'Mexican Peso', '$', 'MEX$', 'Centavo', 100, 1, '$', '.', ',', 5, 100, 0, '2022-06-10 03:59:39', '2022-06-10 03:59:39'),
(100, 'MYR', '458', 'Malaysian Ringgit', 'RM', NULL, 'Sen', 100, 1, '', '.', ',', 5, 100, 0, '2022-06-10 03:59:39', '2022-06-10 03:59:39'),
(101, 'MZN', '943', 'Mozambican Metical', 'MTn', NULL, 'Centavo', 100, 1, '', ',', '.', 1, 100, 0, '2022-06-10 03:59:39', '2022-06-10 03:59:39'),
(102, 'NAD', '516', 'Namibian Dollar', '$', 'N$', 'Cent', 100, 0, '$', '.', ',', 5, 100, 0, '2022-06-10 03:59:39', '2022-06-10 03:59:39'),
(103, 'NGN', '566', 'Nigerian Naira', '₦', NULL, 'Kobo', 100, 1, '&#x20A6;', '.', ',', 50, 100, 0, '2022-06-10 03:59:39', '2022-06-10 03:59:39'),
(104, 'NIO', '558', 'Nicaraguan Córdoba', 'C$', NULL, 'Centavo', 100, 0, '', '.', ',', 5, 100, 0, '2022-06-10 03:59:39', '2022-06-10 03:59:39'),
(105, 'NOK', '578', 'Norwegian Krone', 'kr', 'NOK', 'Øre', 100, 0, 'kr', ',', '.', 100, 100, 0, '2022-06-10 03:59:39', '2022-06-10 03:59:39'),
(106, 'NPR', '524', 'Nepalese Rupee', '₨', 'NPR', 'Paisa', 100, 1, '&#x20A8;', '.', ',', 1, 100, 0, '2022-06-10 03:59:40', '2022-06-10 03:59:40'),
(107, 'NZD', '554', 'New Zealand Dollar', '$', 'NZ$', 'Cent', 100, 1, '$', '.', ',', 10, 100, 0, '2022-06-10 03:59:40', '2022-06-10 03:59:40'),
(108, 'OMR', '512', 'Omani Rial', 'ر.ع.', NULL, 'Baisa', 1000, 1, '&#xFDFC;', '.', ',', 5, 100, 0, '2022-06-10 03:59:40', '2022-06-10 03:59:40'),
(109, 'PAB', '590', 'Panamanian Balboa', 'B/.', NULL, 'Centésimo', 100, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:40', '2022-06-10 03:59:40'),
(110, 'PEN', '604', 'Peruvian Nuevo Sol', 'S/.', NULL, 'Céntimo', 100, 1, 'S/.', '.', ',', 1, 100, 0, '2022-06-10 03:59:40', '2022-06-10 03:59:40'),
(111, 'PGK', '598', 'Papua New Guinean Kina', 'K', 'PGK', 'Toea', 100, 0, '', '.', ',', 5, 100, 0, '2022-06-10 03:59:40', '2022-06-10 03:59:40'),
(112, 'PHP', '608', 'Philippine Peso', '₱', NULL, 'Centavo', 100, 1, '&#x20B1;', '.', ',', 1, 100, 0, '2022-06-10 03:59:40', '2022-06-10 03:59:40'),
(113, 'PKR', '586', 'Pakistani Rupee', '₨', 'PKR', 'Paisa', 100, 1, '&#x20A8;', '.', ',', 100, 100, 0, '2022-06-10 03:59:40', '2022-06-10 03:59:40'),
(114, 'PLN', '985', 'Polish Złoty', 'zł', NULL, 'Grosz', 100, 0, 'z&#322;', ',', ' ', 1, 100, 0, '2022-06-10 03:59:40', '2022-06-10 03:59:40'),
(115, 'PYG', '600', 'Paraguayan Guaraní', '₲', NULL, 'Céntimo', 1, 1, '&#x20B2;', '.', ',', 5000, 100, 0, '2022-06-10 03:59:40', '2022-06-10 03:59:40'),
(116, 'QAR', '634', 'Qatari Riyal', 'ر.ق', NULL, 'Dirham', 100, 0, '&#xFDFC;', '.', ',', 1, 100, 0, '2022-06-10 03:59:40', '2022-06-10 03:59:40'),
(117, 'RON', '946', 'Romanian Leu', 'Lei', NULL, 'Bani', 100, 0, '', ',', '.', 1, 100, 0, '2022-06-10 03:59:40', '2022-06-10 03:59:40'),
(118, 'RSD', '941', 'Serbian Dinar', 'РСД', NULL, 'Para', 100, 1, '', '.', ',', 100, 100, 0, '2022-06-10 03:59:40', '2022-06-10 03:59:40'),
(119, 'RUB', '643', 'Russian Ruble', '₽', NULL, 'Kopeck', 100, 0, '&#x20BD;', ',', '.', 1, 100, 0, '2022-06-10 03:59:41', '2022-06-10 03:59:41'),
(120, 'RWF', '646', 'Rwandan Franc', 'FRw', NULL, 'Centime', 1, 0, '', '.', ',', 100, 100, 0, '2022-06-10 03:59:41', '2022-06-10 03:59:41'),
(121, 'SAR', '682', 'Saudi Riyal', 'ر.س', NULL, 'Hallallah', 100, 1, '&#xFDFC;', '.', ',', 5, 100, 0, '2022-06-10 03:59:41', '2022-06-10 03:59:41'),
(122, 'SBD', '090', 'Solomon Islands Dollar', '$', 'SI$', 'Cent', 100, 0, '$', '.', ',', 10, 100, 0, '2022-06-10 03:59:41', '2022-06-10 03:59:41'),
(123, 'SCR', '690', 'Seychellois Rupee', '₨', 'SRe', 'Cent', 100, 0, '&#x20A8;', '.', ',', 1, 100, 0, '2022-06-10 03:59:41', '2022-06-10 03:59:41'),
(124, 'SDG', '938', 'Sudanese Pound', '£', 'SDG', 'Piastre', 100, 1, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:41', '2022-06-10 03:59:41'),
(125, 'SEK', '752', 'Swedish Krona', 'kr', 'SEK', 'Öre', 100, 0, '', ',', ' ', 100, 100, 0, '2022-06-10 03:59:41', '2022-06-10 03:59:41'),
(126, 'SGD', '702', 'Singapore Dollar', '$', 'S$', 'Cent', 100, 1, '$', '.', ',', 1, 100, 0, '2022-06-10 03:59:41', '2022-06-10 03:59:41'),
(127, 'SHP', '654', 'Saint Helenian Pound', '£', 'SHP', 'Penny', 100, 0, '&#x00A3;', '.', ',', 1, 100, 0, '2022-06-10 03:59:41', '2022-06-10 03:59:41'),
(128, 'SKK', '703', 'Slovak Koruna', 'Sk', NULL, 'Halier', 100, 1, '', '.', ',', 50, 100, 0, '2022-06-10 03:59:41', '2022-06-10 03:59:41'),
(129, 'SLL', '694', 'Sierra Leonean Leone', 'Le', NULL, 'Cent', 100, 0, '', '.', ',', 1000, 100, 0, '2022-06-10 03:59:41', '2022-06-10 03:59:41'),
(130, 'SOS', '706', 'Somali Shilling', 'Sh', NULL, 'Cent', 100, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:41', '2022-06-10 03:59:41'),
(131, 'SRD', '968', 'Surinamese Dollar', '$', 'SRD', 'Cent', 100, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:41', '2022-06-10 03:59:41'),
(132, 'SSP', '728', 'South Sudanese Pound', '£', 'SSP', 'piaster', 100, 0, '&#x00A3;', '.', ',', 5, 100, 0, '2022-06-10 03:59:41', '2022-06-10 03:59:41'),
(133, 'STD', '678', 'São Tomé and Príncipe Dobra', 'Db', NULL, 'Cêntimo', 100, 0, '', '.', ',', 10000, 100, 0, '2022-06-10 03:59:41', '2022-06-10 03:59:41'),
(134, 'SVC', '222', 'Salvadoran Colón', '₡', NULL, 'Centavo', 100, 1, '&#x20A1;', '.', ',', 1, 100, 0, '2022-06-10 03:59:41', '2022-06-10 03:59:41'),
(135, 'SYP', '760', 'Syrian Pound', '£S', NULL, 'Piastre', 100, 0, '&#x00A3;', '.', ',', 100, 100, 0, '2022-06-10 03:59:41', '2022-06-10 03:59:41'),
(136, 'SZL', '748', 'Swazi Lilangeni', 'E', 'SZL', 'Cent', 100, 1, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:42', '2022-06-10 03:59:42'),
(137, 'THB', '764', 'Thai Baht', '฿', NULL, 'Satang', 100, 1, '&#x0E3F;', '.', ',', 1, 100, 0, '2022-06-10 03:59:42', '2022-06-10 03:59:42'),
(138, 'TJS', '972', 'Tajikistani Somoni', 'ЅМ', NULL, 'Diram', 100, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:42', '2022-06-10 03:59:42'),
(139, 'TMT', '934', 'Turkmenistani Manat', 'T', NULL, 'Tenge', 100, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:42', '2022-06-10 03:59:42'),
(140, 'TND', '788', 'Tunisian Dinar', 'د.ت', NULL, 'Millime', 1000, 0, '', '.', ',', 10, 100, 0, '2022-06-10 03:59:42', '2022-06-10 03:59:42'),
(141, 'TOP', '776', 'Tongan Paʻanga', 'T$', NULL, 'Seniti', 100, 1, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:42', '2022-06-10 03:59:42'),
(142, 'TRY', '949', 'Turkish Lira', '₺', NULL, 'kuruş', 100, 1, '&#8378;', ',', '.', 1, 100, 0, '2022-06-10 03:59:42', '2022-06-10 03:59:42'),
(143, 'TTD', '780', 'Trinidad and Tobago Dollar', '$', 'TT$', 'Cent', 100, 0, '$', '.', ',', 1, 100, 0, '2022-06-10 03:59:42', '2022-06-10 03:59:42'),
(144, 'TWD', '901', 'New Taiwan Dollar', '$', 'NT$', 'Cent', 100, 1, '$', '.', ',', 50, 100, 0, '2022-06-10 03:59:42', '2022-06-10 03:59:42'),
(145, 'TZS', '834', 'Tanzanian Shilling', 'Sh', NULL, 'Cent', 100, 1, '', '.', ',', 5000, 100, 0, '2022-06-10 03:59:43', '2022-06-10 03:59:43'),
(146, 'UAH', '980', 'Ukrainian Hryvnia', '₴', NULL, 'Kopiyka', 100, 0, '&#x20B4;', '.', ',', 1, 100, 0, '2022-06-10 03:59:43', '2022-06-10 03:59:43'),
(147, 'UGX', '800', 'Ugandan Shilling', 'USh', NULL, 'Cent', 1, 0, '', '.', ',', 1000, 100, 0, '2022-06-10 03:59:43', '2022-06-10 03:59:43'),
(148, 'USD', '840', 'United States Dollar', '$', 'US$', 'Cent', 100, 1, '$', '.', ',', 1, 1, 1, '2022-06-10 03:59:43', '2022-06-10 03:59:43'),
(149, 'UYU', '858', 'Uruguayan Peso', '$', NULL, 'Centésimo', 100, 1, '&#x20B1;', ',', '.', 100, 100, 0, '2022-06-10 03:59:43', '2022-06-10 03:59:43'),
(150, 'UZS', '860', 'Uzbekistan Som', '', NULL, 'Tiyin', 100, 0, '', '.', ',', 100, 100, 0, '2022-06-10 03:59:43', '2022-06-10 03:59:43'),
(151, 'VEF', '937', 'Venezuelan Bolívar', 'Bs', NULL, 'Céntimo', 100, 1, '', ',', '.', 1, 100, 0, '2022-06-10 03:59:43', '2022-06-10 03:59:43'),
(152, 'VND', '704', 'Vietnamese Đồng', '₫', NULL, 'Hào', 1, 1, '&#x20AB;', ',', '.', 100, 100, 0, '2022-06-10 03:59:43', '2022-06-10 03:59:43'),
(153, 'VUV', '548', 'Vanuatu Vatu', 'Vt', NULL, NULL, 1, 1, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:43', '2022-06-10 03:59:43'),
(154, 'WST', '882', 'Samoan Tala', 'T', 'WS$', 'Sene', 100, 0, '', '.', ',', 10, 100, 0, '2022-06-10 03:59:43', '2022-06-10 03:59:43'),
(155, 'XAF', '950', 'Central African Cfa Franc', 'Fr', 'FCFA', 'Centime', 1, 0, '', '.', ',', 100, 100, 0, '2022-06-10 03:59:43', '2022-06-10 03:59:43'),
(156, 'XAG', '961', 'Silver (Troy Ounce)', 'oz t', 'XAG', 'oz', 1, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:43', '2022-06-10 03:59:43'),
(157, 'XAU', '959', 'Gold (Troy Ounce)', 'oz t', 'XAU', 'oz', 1, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:43', '2022-06-10 03:59:43'),
(158, 'XBA', '955', 'European Composite Unit', '', 'XBA', '', 1, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:43', '2022-06-10 03:59:43'),
(159, 'XBB', '956', 'European Monetary Unit', '', 'XBB', '', 1, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:43', '2022-06-10 03:59:43'),
(160, 'XBC', '957', 'European Unit of Account 9', '', 'XBC', '', 1, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:43', '2022-06-10 03:59:43'),
(161, 'XBD', '958', 'European Unit of Account 17', '', 'XBD', '', 1, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:43', '2022-06-10 03:59:43'),
(162, 'XCD', '951', 'East Caribbean Dollar', '$', 'EX$', 'Cent', 100, 1, '$', '.', ',', 1, 100, 0, '2022-06-10 03:59:43', '2022-06-10 03:59:43'),
(163, 'XDR', '960', 'Special Drawing Rights', 'SDR', NULL, '', 1, 0, '$', '.', ',', 1, 100, 0, '2022-06-10 03:59:44', '2022-06-10 03:59:44'),
(164, 'XOF', '952', 'West African Cfa Franc', 'Fr', 'CFA', 'Centime', 1, 0, '', '.', ',', 100, 100, 0, '2022-06-10 03:59:44', '2022-06-10 03:59:44'),
(165, 'XPD', '964', 'Palladium', 'oz t', 'XPD', 'oz', 1, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:44', '2022-06-10 03:59:44'),
(166, 'XPF', '953', 'Cfp Franc', 'Fr', NULL, 'Centime', 1, 0, '', '.', ',', 100, 100, 0, '2022-06-10 03:59:44', '2022-06-10 03:59:44'),
(167, 'XPT', '962', 'Platinum', 'oz t', NULL, '', 1, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:44', '2022-06-10 03:59:44'),
(168, 'xts', '963', 'Codes specifically reserved for testing purposes', '', NULL, '', 1, 0, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:44', '2022-06-10 03:59:44'),
(169, 'YER', '886', 'Yemeni Rial', '﷼', NULL, 'Fils', 100, 0, '&#xFDFC;', '.', ',', 100, 100, 0, '2022-06-10 03:59:44', '2022-06-10 03:59:44'),
(170, 'ZAR', '710', 'South African Rand', 'R', NULL, 'Cent', 100, 1, '&#x0052;', '.', ',', 10, 100, 0, '2022-06-10 03:59:44', '2022-06-10 03:59:44'),
(171, 'ZMK', '894', 'Zambian Kwacha', 'ZK', 'ZMK', 'Ngwee', 100, 0, '', '.', ',', 5, 100, 0, '2022-06-10 03:59:44', '2022-06-10 03:59:44'),
(172, 'ZMW', '967', 'Zambian Kwacha', 'ZK', 'ZMW', 'Ngwee', 100, 0, '', '.', ',', 5, 100, 0, '2022-06-10 03:59:44', '2022-06-10 03:59:44'),
(173, 'BTC', '', 'Bitcoin', 'B⃦', NULL, 'Satoshi', 100000000, 1, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:44', '2022-06-10 03:59:44'),
(174, 'JEP', '', 'Jersey Pound', '£', 'JEP', 'Penny', 100, 1, '&#x00A3;', '.', ',', 1, 100, 0, '2022-06-10 03:59:44', '2022-06-10 03:59:44'),
(175, 'GGP', '', 'Guernsey Pound', '£', 'GGP', 'Penny', 100, 1, '&#x00A3;', '.', ',', 1, 100, 0, '2022-06-10 03:59:44', '2022-06-10 03:59:44'),
(176, 'IMP', '', 'Isle of Man Pound', '£', 'IMP', 'Penny', 100, 1, '&#x00A3;', '.', ',', 1, 100, 0, '2022-06-10 03:59:45', '2022-06-10 03:59:45'),
(177, 'XFU', '', 'UIC Franc', '', 'XFU', '', 100, 1, '', '.', ',', 1, 100, 0, '2022-06-10 03:59:45', '2022-06-10 03:59:45');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ext` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `documentable_id` int(10) UNSIGNED NOT NULL,
  `documentable_type` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_index` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `designation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shift_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `leave_policy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provision_period` int(11) DEFAULT NULL,
  `allow_overtime` tinyint(4) DEFAULT NULL,
  `overtime_allowance` decimal(6,2) DEFAULT NULL,
  `allowance_percent` tinyint(4) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `is_terminate` tinyint(4) DEFAULT NULL,
  `termination_date` date DEFAULT NULL,
  `basic_salary` decimal(20,6) DEFAULT 0.000000,
  `first_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` enum('Single','Married','Widowed') COLLATE utf8mb4_unicode_ci DEFAULT 'Single',
  `card_no` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `device_id` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_updated` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_educations`
--

CREATE TABLE `employee_educations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `exam_title` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passing_year` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cgpa` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `out_of` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_types`
--

CREATE TABLE `employee_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_company_facility` tinyint(4) DEFAULT 0,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `occasion` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `days` int(11) NOT NULL,
  `holiday_year` year(4) DEFAULT NULL,
  `holiday_month` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT 0,
  `type` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imageable_id` int(10) UNSIGNED NOT NULL,
  `imageable_type` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `path`, `name`, `extension`, `size`, `order`, `type`, `imageable_id`, `imageable_type`, `created_at`, `updated_at`) VALUES
(1, 'images\\logo.png', 'logo.png', 'png', '0', 0, 'logo', 1, 'App\\Models\\SystemSetting', '2022-06-10 03:59:11', '2022-06-10 03:59:11'),
(2, 'images\\user.jpg', 'user.jpg', 'jpg', '0', 0, 'profile', 1, 'Modules\\Branch\\Entities\\Branch', '2022-06-10 03:59:54', '2022-06-10 03:59:54'),
(3, 'images\\user.jpg', 'user.jpg', 'jpg', '0', 0, 'profile', 1, 'Modules\\Company\\Entities\\Company', '2022-06-10 03:59:54', '2022-06-10 03:59:54'),
(4, 'images\\user.jpg', 'user.jpg', 'jpg', '0', 0, 'profile', 1, 'Modules\\User\\Entities\\Profile', '2022-06-10 03:59:57', '2022-06-10 03:59:57'),
(5, 'images\\user.jpg', 'user.jpg', 'jpg', '0', 0, 'profile', 2, 'Modules\\User\\Entities\\Profile', '2022-06-10 03:59:57', '2022-06-10 03:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `in_out_logs`
--

CREATE TABLE `in_out_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `in_time` time DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `time_calc` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_applications`
--

CREATE TABLE `leave_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `leave_for` enum('days','hour') COLLATE utf8mb4_unicode_ci DEFAULT 'days',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `leave_hour_date` date DEFAULT NULL,
  `leave_hour` decimal(6,2) DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leave_days` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `approval_status` tinyint(4) DEFAULT 0,
  `approved_by` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_policies`
--

CREATE TABLE `leave_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`type_id`)),
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `apply_at` enum('joining_date','after_provision') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'after_provision',
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `submodule_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show` tinyint(4) NOT NULL DEFAULT 0,
  `order` int(11) DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `submodule_id`, `name`, `url`, `action`, `show`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Activities', 'activities', 'list', 1, 1, 1, NULL, NULL),
(2, 1, 'View Activities', 'activity/view', 'view', 0, 2, 1, NULL, NULL),
(3, 2, 'Branches', 'branches', 'list', 1, 1, 1, NULL, NULL),
(4, 2, 'New Branch', 'branch/add', 'add', 0, 2, 1, NULL, NULL),
(5, 2, 'Edit Branch', 'branch/edit', 'edit', 0, 3, 1, NULL, NULL),
(6, 2, 'Export Branch', 'branch/export', 'export', 0, 5, 1, NULL, NULL),
(7, 2, 'View Branch', 'branch/view', 'view', 0, 6, 1, NULL, NULL),
(8, 2, 'Trash Branch', 'branch/trash', 'trash', 0, 7, 1, NULL, NULL),
(9, 2, 'Restore Branch', 'branch/restore', 'restore', 0, 8, 1, NULL, NULL),
(10, 2, 'Delete Branch', 'branch/delete', 'delete', 0, 9, 1, NULL, NULL),
(11, 3, 'companies', 'companies', 'list', 1, 1, 1, NULL, NULL),
(12, 3, 'New Company', 'company/add', 'add', 0, 2, 1, NULL, NULL),
(13, 3, 'Edit Company', 'company/edit', 'edit', 0, 3, 1, NULL, NULL),
(14, 3, 'Export Company', 'company/export', 'export', 0, 5, 1, NULL, NULL),
(15, 3, 'View Company', 'company/view', 'view', 0, 6, 1, NULL, NULL),
(16, 3, 'Trash Company', 'company/trash', 'trash', 0, 7, 1, NULL, NULL),
(17, 3, 'Restore Company', 'company/restore', 'restore', 0, 8, 1, NULL, NULL),
(18, 3, 'Delete Company', 'company/delete', 'delete', 0, 9, 1, NULL, NULL),
(19, 4, 'New Employee', 'employee/add', 'add', 1, 1, 1, NULL, NULL),
(20, 4, 'Employees', 'employees', 'list', 1, 2, 1, NULL, NULL),
(21, 4, 'Inactive Employees', 'employees/inactive', 'list', 1, 3, 1, NULL, NULL),
(22, 4, 'Edit Employment information', 'employment/edit', 'editEmployment', 0, 4, 1, NULL, NULL),
(23, 4, 'Edit Personal Information', 'personal/edit', 'editPersonal', 0, 5, 1, NULL, NULL),
(24, 4, 'New Education', 'education/add', 'addEducation', 0, 6, 1, NULL, NULL),
(25, 4, 'Employee Educations', 'education/list', 'listEducation', 0, 7, 1, NULL, NULL),
(26, 4, 'Edit Education', 'education/edit', 'editEducation', 0, 8, 1, NULL, NULL),
(27, 4, 'Approve Education', 'education/approve', 'approveEducation', 0, 10, 1, NULL, NULL),
(28, 4, 'Delete Education', 'education/delete', 'deleteEducation', 0, 11, 1, NULL, NULL),
(29, 4, 'New Address', 'address/add', 'addAddress', 0, 12, 1, NULL, NULL),
(30, 4, 'Employee Addresses', 'address/list', 'listAddress', 0, 15, 1, NULL, NULL),
(31, 4, 'Edit Address', 'address/edit', 'editAddress', 0, 17, 1, NULL, NULL),
(32, 4, 'View Address', 'address/view', 'viewAddress', 0, 18, 1, NULL, NULL),
(33, 4, 'Delete Address', 'address/delete', 'deleteAddress', 0, 21, 1, NULL, NULL),
(34, 4, 'New Document', 'document/add', 'addDocument', 0, 22, 1, NULL, NULL),
(35, 4, 'Documents', 'document/list', 'listDocument', 0, 23, 1, NULL, NULL),
(36, 4, 'Edit Document', 'document/edit', 'editDocument', 0, 25, 1, NULL, NULL),
(37, 4, 'Delete Document', 'document/delete', 'deleteDocument', 0, 27, 1, NULL, NULL),
(38, 4, 'Export Document', 'document/export', 'exportDocument', 0, 29, 1, NULL, NULL),
(39, 4, 'Approve Document', 'document/approve', 'approveDocument', 0, 31, 1, NULL, NULL),
(40, 4, 'View Employee', 'employee/view', 'view', 0, 35, 1, NULL, NULL),
(41, 4, 'Export Employee', 'employee/export', 'export', 0, 37, 1, NULL, NULL),
(42, 4, 'Import Employee', 'employee/import', 'import', 0, 39, 1, NULL, NULL),
(43, 4, 'Trash Employee', 'employee/trash', 'trash', 0, 33, 1, NULL, NULL),
(44, 4, 'Restore Employee', 'employee/restore', 'restore', 0, 34, 1, NULL, NULL),
(45, 4, 'Delete Employee', 'employee/delete', 'delete', 0, 40, 1, NULL, NULL),
(46, 5, 'New Department', 'department/add', 'add', 0, 1, 1, NULL, NULL),
(47, 5, 'Departments', 'departments', 'list', 1, 2, 1, NULL, NULL),
(48, 5, 'Edit Department', 'department/edit', 'edit', 0, 3, 1, NULL, NULL),
(49, 5, 'Trash Department', 'department/trash', 'trash', 0, 5, 1, NULL, NULL),
(50, 5, 'Restore Department', 'department/restore', 'restore', 0, 6, 1, NULL, NULL),
(51, 5, 'Delete Department', 'department/delete', 'delete', 0, 8, 1, NULL, NULL),
(52, 6, 'New Designation', 'designation/add', 'add', 0, 1, 1, NULL, NULL),
(53, 6, 'Designations', 'designations', 'list', 1, 2, 1, NULL, NULL),
(54, 6, 'Edit Designation', 'designation/edit', 'edit', 0, 3, 1, NULL, NULL),
(55, 6, 'Trash Designation', 'designation/trash', 'trash', 0, 6, 1, NULL, NULL),
(56, 6, 'Restore Designation', 'designation/restore', 'restore', 0, 7, 1, NULL, NULL),
(57, 6, 'Delete Designation', 'designation/delete', 'delete', 0, 8, 1, NULL, NULL),
(58, 7, 'New Deduction Policy', 'deduction-policy/add', 'add', 0, 1, 1, NULL, NULL),
(59, 7, 'Attendance Deduction Policy', 'deduction-policies', 'list', 1, 2, 1, NULL, NULL),
(60, 7, 'Edit Deduction Policy', 'deduction-policy/edit', 'edit', 0, 3, 1, NULL, NULL),
(61, 7, 'Trash Deduction Policy', 'deduction-policy/trash', 'trash', 0, 6, 1, NULL, NULL),
(62, 7, 'Restore Deduction Policy', 'deduction-policy/restore', 'restore', 0, 7, 1, NULL, NULL),
(63, 7, 'Delete Deduction Policy', 'deduction-policy/delete', 'delete', 0, 8, 1, NULL, NULL),
(64, 8, 'New Leave Policy', 'leave-policy/add', 'add', 0, 1, 1, NULL, NULL),
(65, 8, 'Leave Policy', 'leave-policies', 'list', 1, 2, 1, NULL, NULL),
(66, 8, 'Edit Leave Policy', 'leave-policy/edit', 'edit', 0, 3, 1, NULL, NULL),
(67, 8, 'Trash Leave Policy', 'leave-policy/trash', 'trash', 0, 5, 1, NULL, NULL),
(68, 8, 'Restore Leave Policy', 'leave-policy/restore', 'restore', 0, 6, 1, NULL, NULL),
(69, 8, 'Delete Leave Policy', 'leave-policy/delete', 'delete', 0, 7, 1, NULL, NULL),
(70, 9, 'New Component', 'structure/add', 'add', 0, 1, 1, NULL, NULL),
(71, 9, 'Salary Structure Components', 'structures', 'list', 1, 2, 1, NULL, NULL),
(72, 9, 'Edit Salary Structure Component', 'structure/edit', 'edit', 0, 3, 1, NULL, NULL),
(73, 9, 'Delete Salary Structure Components', 'structure/delete', 'delete', 0, 4, 1, NULL, NULL),
(74, 10, 'New Salary Rule', 'rule/add', 'add', 1, 1, 1, NULL, NULL),
(75, 10, 'Salary Rules', 'rules', 'list', 1, 2, 1, NULL, NULL),
(76, 10, 'Edit Salary Rule', 'rule/edit', 'edit', 0, 3, 1, NULL, NULL),
(77, 10, 'Delete Salary Rule', 'rule/delete', 'delete', 0, 5, 1, NULL, NULL),
(78, 10, 'View Salary Rule', 'rule/view', 'view', 0, 6, 1, NULL, NULL),
(79, 11, 'Generate Salary', 'salary-generate', 'add', 0, 1, 1, NULL, NULL),
(80, 11, 'Pending Salaries', 'pending-salaries', 'list', 1, 2, 1, NULL, NULL),
(81, 11, 'Approved Salaries', 'approved-salaries', 'list', 1, 2, 1, NULL, NULL),
(82, 11, 'Salary Approve', 'salary/approve', 'edit', 0, 3, 1, NULL, NULL),
(83, 11, 'Salary Pay', 'salary/pay', 'edit', 0, 3, 1, NULL, NULL),
(84, 11, 'Salary Payslip', 'salary/payslip', 'view', 0, 4, 1, NULL, NULL),
(85, 11, 'Payslip Print', 'salary/payslip/print', 'export', 0, 5, 1, NULL, NULL),
(86, 11, 'View Salary', 'salary/view', 'view', 0, 6, 1, NULL, NULL),
(87, 11, 'Delete Salary', 'salary/delete', 'delete', 0, 7, 1, NULL, NULL),
(88, 12, 'Attendance Report', 'attendance', 'list', 1, 1, 1, NULL, NULL),
(89, 12, 'Attendance month wise', 'attendance-month-wise', 'list', 1, 1, 1, NULL, NULL),
(90, 12, 'Salary Report', 'salary', 'list', 1, 2, 1, NULL, NULL),
(91, 12, 'leave Report', 'leave', 'list', 1, 2, 1, NULL, NULL),
(92, 12, 'View Report', 'report/view', 'view', 0, 3, 1, NULL, NULL),
(93, 12, 'Export Report', 'report/export', 'export', 0, 4, 1, NULL, NULL),
(94, 13, 'Sms Log', 'sms-log', 'list', 1, 1, 1, NULL, NULL),
(95, 13, 'Send Sms', 'sms/add', 'add', 0, 2, 1, NULL, NULL),
(96, 13, 'Delete Sms log', 'sms/delete', 'delete', 0, 4, 1, NULL, NULL),
(97, 14, 'Emails', 'emails', 'list', 1, 1, 1, NULL, NULL),
(98, 14, 'Send Email', 'email/add', 'add', 0, 2, 1, NULL, NULL),
(99, 14, 'View Email', 'email/view', 'view', 0, 2, 1, NULL, NULL),
(100, 14, 'Delete Email', 'email/delete', 'delete', 0, 4, 1, NULL, NULL),
(101, 15, 'New Employment Type', 'employment-type/add', 'add', 0, 1, 1, NULL, NULL),
(102, 15, 'Employment Types', 'employment-types', 'list', 1, 2, 1, NULL, NULL),
(103, 15, 'Edit Employment Types', 'employment-type/edit', 'edit', 0, 3, 1, NULL, NULL),
(104, 15, 'Trash Employment Types', 'employment-type/trash', 'trash', 0, 4, 1, NULL, NULL),
(105, 15, 'Restore Employment Types', 'employment-type/restore', 'restore', 0, 5, 1, NULL, NULL),
(106, 15, 'Delete Employment Types', 'employment-type/delete', 'delete', 0, 7, 1, NULL, NULL),
(107, 16, 'New Leave Type', 'leave-type/add', 'add', 0, 1, 1, NULL, NULL),
(108, 16, 'Leave Types', 'leave-types', 'list', 1, 2, 1, NULL, NULL),
(109, 16, 'Edit Leave Type', 'leave-type/edit', 'edit', 0, 3, 1, NULL, NULL),
(110, 16, 'Trash Leave Type', 'leave-type/trash', 'trash', 0, 4, 1, NULL, NULL),
(111, 16, 'Restore Leave Type', 'leave-type/restore', 'restore', 0, 5, 1, NULL, NULL),
(112, 16, 'Delete Leave Type', 'leave-type/delete', 'delete', 0, 6, 1, NULL, NULL),
(113, 17, 'New Tax', 'tax/add', 'add', 0, 1, 1, NULL, NULL),
(114, 17, 'Taxes', 'taxes', 'list', 1, 2, 1, NULL, NULL),
(115, 17, 'Edit Tax', 'tax/edit', 'edit', 0, 3, 1, NULL, NULL),
(116, 17, 'Trash Tax', 'tax/trash', 'trash', 0, 5, 1, NULL, NULL),
(117, 17, 'Restore Tax', 'tax/restore', 'restore', 0, 6, 1, NULL, NULL),
(118, 17, 'Delete Tax', 'tax/delete', 'delete', 0, 7, 1, NULL, NULL),
(119, 18, 'New Shift', 'shift/add', 'add', 0, 1, 1, NULL, NULL),
(120, 18, 'Working Shifts', 'shifts', 'list', 1, 2, 1, NULL, NULL),
(121, 18, 'Edit Shift', 'shift/edit', 'edit', 0, 3, 1, NULL, NULL),
(122, 18, 'Trash Shift', 'shift/trash', 'trash', 0, 4, 1, NULL, NULL),
(123, 18, 'Restore Shift', 'shift/restore', 'restore', 0, 5, 1, NULL, NULL),
(124, 18, 'Delete Shift', 'shift/delete', 'delete', 0, 7, 1, NULL, NULL),
(125, 19, 'New Holiday', 'holiday/add', 'add', 0, 1, 1, NULL, NULL),
(126, 19, 'Holidays', 'holidays', 'list', 1, 2, 1, NULL, NULL),
(127, 19, 'Trash Holiday', 'holiday/trash', 'trash', 0, 7, 1, NULL, NULL),
(128, 19, 'Restore Holiday', 'holiday/restore', 'restore', 0, 7, 1, NULL, NULL),
(129, 19, 'Delete Holiday', 'holiday/delete', 'delete', 0, 8, 1, NULL, NULL),
(130, 20, 'Dashboard', 'dashboard', 'list', 1, 2, 1, NULL, NULL),
(131, 21, 'New Leave Application', 'leave/add', 'add', 0, 1, 1, NULL, NULL),
(132, 21, 'Pending Applications', 'leaves', 'list', 1, 2, 1, NULL, NULL),
(133, 21, 'Approve Application', 'leave/approve', 'leaveApprove', 0, 3, 1, NULL, NULL),
(134, 21, 'Approved Applications', 'leave/approved', 'listApproved', 1, 4, 1, NULL, NULL),
(135, 21, 'Reject Application', 'leave/reject', 'leaveReject', 0, 5, 1, NULL, NULL),
(136, 21, 'Rejected Applications', 'leave/rejected', 'listRejected', 1, 6, 1, NULL, NULL),
(137, 21, 'Edit Leave Application', 'leave/edit', 'edit', 0, 7, 1, NULL, NULL),
(138, 21, 'View Leave Application', 'leave/view', 'view', 0, 7, 1, NULL, NULL),
(139, 21, 'delete Leave Application', 'shift/delete', 'delete', 0, 8, 1, NULL, NULL),
(140, 22, 'New Punch', 'attendance/add', 'add', 0, 1, 1, NULL, NULL),
(141, 22, 'Punch Log', 'punch-log', 'list', 1, 2, 1, NULL, NULL),
(142, 22, 'Attendances', 'attendances', 'list', 1, 3, 1, NULL, NULL),
(143, 22, 'Absent', 'absent', 'list', 1, 4, 1, NULL, NULL),
(144, 22, 'On Leave', 'on-leave', 'list', 1, 6, 1, NULL, NULL),
(145, 22, 'Edit Attendance', 'attendance/edit', 'edit', 0, 17, 1, NULL, NULL),
(146, 22, 'Delete Attendance', 'attendance/delete', 'delete', 0, 18, 1, NULL, NULL),
(147, 22, 'View Attendance', 'attendance/view', 'view', 0, 19, 1, NULL, NULL),
(148, 22, 'Export Attendance', 'attendance/export', 'export', 0, 20, 1, NULL, NULL),
(149, 23, 'Roles', 'roles', 'list', 1, 2, 1, NULL, NULL),
(150, 23, 'New Role', 'role/add', 'add', 1, 1, 1, NULL, NULL),
(151, 23, 'Edit Role', 'role/edit', 'edit', 0, 3, 1, NULL, NULL),
(152, 23, 'Trash Role', 'role/trash', 'trash', 0, 4, 1, NULL, NULL),
(153, 23, 'Restore Role', 'role/restore', 'restore', 0, 5, 1, NULL, NULL),
(154, 23, 'Delete Role', 'role/delete', 'delete', 0, 7, 1, NULL, NULL),
(155, 24, 'Users', 'users', 'list', 1, 2, 1, NULL, NULL),
(156, 24, 'New User', 'user/add', 'add', 0, 1, 1, NULL, NULL),
(157, 24, 'Edit User', 'user/edit', 'edit', 0, 3, 1, NULL, NULL),
(158, 24, 'View User', 'user/view', 'view', 0, 4, 1, NULL, NULL),
(159, 24, 'Export User', 'user/export', 'export', 0, 5, 1, NULL, NULL),
(160, 24, 'Trash User', 'user/trash', 'trash', 0, 6, 1, NULL, NULL),
(161, 24, 'Restore User', 'user/restore', 'restore', 0, 7, 1, NULL, NULL),
(162, 24, 'Delete User', 'user/delete', 'delete', 0, 8, 1, NULL, NULL),
(163, 25, 'Password Reset', 'user/password-reset', 'list', 1, 3, 1, NULL, NULL),
(164, 25, 'Update Password', 'user/update-password', 'add', 0, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_05_00_000000_create_companies_table', 1),
(2, '2014_05_01_000000_create_organization_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2014_12_31_000001_create_countries_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '20211_04_12_100000_create_password_resets_table', 1),
(8, '2021_01_12_000002_create_system_settings_table', 1),
(9, '2021_04_11_000020_create_documents_table', 1),
(10, '2021_04_12_000000_create_roles_table', 1),
(11, '2021_04_13_000000_create_branches_table', 1),
(12, '2021_04_13_000000_create_role_permissions_table', 1),
(13, '2021_05_01_000002_create_employee_table', 1),
(14, '2021_05_01_000004_create_payroll_table', 1),
(15, '2021_05_02_000000_create_users_table', 1),
(16, '2021_05_11_000000_create_modules_table', 1),
(17, '2021_05_11_000020_create_images_table', 1),
(18, '2021_05_20_000000_create_component_settings_table', 1),
(19, '2021_05_20_151049_create_activity_table', 1),
(20, '2021_06_01_000000_create_timesheet_table', 1),
(21, '2021_06_11_000020_create_addresses_table', 1),
(22, '2021_08_23_185057_create_zkteco_devices_table', 1),
(23, '2021_08_23_185624_create_in_out_logs_table', 1),
(24, '2021_08_27_093252_create_notifications_table', 1),
(25, '2021_08_27_221845_create_jobs_table', 1),
(26, '2021_10_27_221845_create_sms_gateway_table', 1),
(27, '2021_11_13_000000_create_sms_log_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scope` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`scope`)),
  `icon` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `scope`, `icon`, `url`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Activities', '[\"common\"]', 'fa fa-history', 'activities', 8, 0, NULL, NULL),
(2, 'Branch', '[\"company\"]', 'fa fa-list', 'branch', 3, 1, NULL, NULL),
(3, 'Company', '[\"admin\"]', 'fa fa-dropbox', 'company', 2, 1, NULL, NULL),
(4, 'Employee Information', '[\"common\",\"employee\"]', 'fa fa-user', 'employee', 5, 1, NULL, NULL),
(5, 'Organization', '[\"admin\",\"company\"]', 'fa fa-building-o', 'organization', 4, 1, NULL, NULL),
(6, 'Payroll', '[\"admin\",\"company\"]', 'fa fa-credit-card-alt', 'payroll', 7, 1, NULL, NULL),
(7, 'Reports', '[\"common\",\"employee\"]', 'fa fa-history', 'reports', 15, 1, NULL, NULL),
(8, 'SMS', '[\"common\"]', 'fa fa-envelope-o', 'sms', 10, 1, NULL, NULL),
(9, 'Component Settings', '[\"common\"]', 'fa fa-cog', 'component-settings', 0, 1, NULL, NULL),
(10, 'Timesheet', '[\"common\",\"employee\"]', 'fa fa-clock-o', 'timesheet', 6, 1, NULL, NULL),
(11, 'User Management', '[\"company\",\"admin\"]', 'fa fa-users', 'user-managements', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `com_id`, `branch_id`, `name`, `email`, `phone`, `dob`, `gender`, `address`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`) VALUES
(1, NULL, NULL, 'Super Admin', 'superadmin@demo.com', '01826319556', '1993-01-01', 'Male', 'Dhaka, Bangladesh', NULL, NULL, NULL, 0, 0),
(2, NULL, NULL, 'Admin', 'admin@demo.com', '01826319556', '1993-01-01', 'Male', 'Dhaka, Bangladesh', NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `com_id`, `branch_id`, `name`, `level`, `details`, `status`, `deleted_at`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, NULL, NULL, 'Admin', 'admin_user', 'Admin role', 1, NULL, NULL, NULL, 0, 0),
(2, NULL, NULL, 'Company Role', 'company', 'Company Role', 1, NULL, NULL, NULL, 0, 0),
(3, 1, NULL, 'Branch Role', 'branch', 'Branch Role', 1, NULL, NULL, NULL, 0, 0),
(4, 1, NULL, 'Employee Role', 'employee', 'Employee Role', 1, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `module_id` bigint(20) UNSIGNED DEFAULT NULL,
  `submodule_id` bigint(20) UNSIGNED DEFAULT NULL,
  `menu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `module_id`, `submodule_id`, `menu_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 3, 11, NULL, NULL, NULL),
(2, 1, 3, 3, 12, NULL, NULL, NULL),
(3, 1, 3, 3, 13, NULL, NULL, NULL),
(4, 1, 3, 3, 14, NULL, NULL, NULL),
(5, 1, 3, 3, 15, NULL, NULL, NULL),
(6, 1, 3, 3, 16, NULL, NULL, NULL),
(7, 1, 3, 3, 17, NULL, NULL, NULL),
(8, 1, 3, 3, 18, NULL, NULL, NULL),
(9, 1, 4, 4, 19, NULL, NULL, NULL),
(10, 1, 4, 4, 20, NULL, NULL, NULL),
(11, 1, 4, 4, 21, NULL, NULL, NULL),
(12, 1, 4, 4, 22, NULL, NULL, NULL),
(13, 1, 4, 4, 23, NULL, NULL, NULL),
(14, 1, 4, 4, 24, NULL, NULL, NULL),
(15, 1, 4, 4, 25, NULL, NULL, NULL),
(16, 1, 4, 4, 26, NULL, NULL, NULL),
(17, 1, 4, 4, 27, NULL, NULL, NULL),
(18, 1, 4, 4, 28, NULL, NULL, NULL),
(19, 1, 4, 4, 29, NULL, NULL, NULL),
(20, 1, 4, 4, 30, NULL, NULL, NULL),
(21, 1, 4, 4, 31, NULL, NULL, NULL),
(22, 1, 4, 4, 32, NULL, NULL, NULL),
(23, 1, 4, 4, 33, NULL, NULL, NULL),
(24, 1, 4, 4, 34, NULL, NULL, NULL),
(25, 1, 4, 4, 35, NULL, NULL, NULL),
(26, 1, 4, 4, 36, NULL, NULL, NULL),
(27, 1, 4, 4, 37, NULL, NULL, NULL),
(28, 1, 4, 4, 38, NULL, NULL, NULL),
(29, 1, 4, 4, 39, NULL, NULL, NULL),
(30, 1, 4, 4, 40, NULL, NULL, NULL),
(31, 1, 4, 4, 41, NULL, NULL, NULL),
(32, 1, 4, 4, 42, NULL, NULL, NULL),
(33, 1, 4, 4, 43, NULL, NULL, NULL),
(34, 1, 4, 4, 44, NULL, NULL, NULL),
(35, 1, 4, 4, 45, NULL, NULL, NULL),
(36, 1, 5, 5, 46, NULL, NULL, NULL),
(37, 1, 5, 5, 47, NULL, NULL, NULL),
(38, 1, 5, 5, 48, NULL, NULL, NULL),
(39, 1, 5, 5, 49, NULL, NULL, NULL),
(40, 1, 5, 5, 50, NULL, NULL, NULL),
(41, 1, 5, 5, 51, NULL, NULL, NULL),
(42, 1, 5, 6, 52, NULL, NULL, NULL),
(43, 1, 5, 6, 53, NULL, NULL, NULL),
(44, 1, 5, 6, 54, NULL, NULL, NULL),
(45, 1, 5, 6, 55, NULL, NULL, NULL),
(46, 1, 5, 6, 56, NULL, NULL, NULL),
(47, 1, 5, 6, 57, NULL, NULL, NULL),
(48, 1, 5, 7, 58, NULL, NULL, NULL),
(49, 1, 5, 7, 59, NULL, NULL, NULL),
(50, 1, 5, 7, 60, NULL, NULL, NULL),
(51, 1, 5, 7, 61, NULL, NULL, NULL),
(52, 1, 5, 7, 62, NULL, NULL, NULL),
(53, 1, 5, 7, 63, NULL, NULL, NULL),
(54, 1, 5, 8, 64, NULL, NULL, NULL),
(55, 1, 5, 8, 65, NULL, NULL, NULL),
(56, 1, 5, 8, 66, NULL, NULL, NULL),
(57, 1, 5, 8, 67, NULL, NULL, NULL),
(58, 1, 5, 8, 68, NULL, NULL, NULL),
(59, 1, 5, 8, 69, NULL, NULL, NULL),
(60, 1, 6, 9, 70, NULL, NULL, NULL),
(61, 1, 6, 9, 71, NULL, NULL, NULL),
(62, 1, 6, 9, 72, NULL, NULL, NULL),
(63, 1, 6, 9, 73, NULL, NULL, NULL),
(64, 1, 6, 10, 74, NULL, NULL, NULL),
(65, 1, 6, 10, 75, NULL, NULL, NULL),
(66, 1, 6, 10, 76, NULL, NULL, NULL),
(67, 1, 6, 10, 77, NULL, NULL, NULL),
(68, 1, 6, 10, 78, NULL, NULL, NULL),
(69, 1, 6, 11, 79, NULL, NULL, NULL),
(70, 1, 6, 11, 80, NULL, NULL, NULL),
(71, 1, 6, 11, 81, NULL, NULL, NULL),
(72, 1, 6, 11, 82, NULL, NULL, NULL),
(73, 1, 6, 11, 83, NULL, NULL, NULL),
(74, 1, 6, 11, 84, NULL, NULL, NULL),
(75, 1, 6, 11, 85, NULL, NULL, NULL),
(76, 1, 6, 11, 86, NULL, NULL, NULL),
(77, 1, 6, 11, 87, NULL, NULL, NULL),
(78, 1, 7, 12, 88, NULL, NULL, NULL),
(79, 1, 7, 12, 89, NULL, NULL, NULL),
(80, 1, 7, 12, 90, NULL, NULL, NULL),
(81, 1, 7, 12, 91, NULL, NULL, NULL),
(82, 1, 7, 12, 92, NULL, NULL, NULL),
(83, 1, 7, 12, 93, NULL, NULL, NULL),
(84, 1, 8, 13, 94, NULL, NULL, NULL),
(85, 1, 8, 13, 95, NULL, NULL, NULL),
(86, 1, 8, 13, 96, NULL, NULL, NULL),
(87, 1, 8, 14, 97, NULL, NULL, NULL),
(88, 1, 8, 14, 98, NULL, NULL, NULL),
(89, 1, 8, 14, 99, NULL, NULL, NULL),
(90, 1, 8, 14, 100, NULL, NULL, NULL),
(91, 1, 9, 15, 101, NULL, NULL, NULL),
(92, 1, 9, 15, 102, NULL, NULL, NULL),
(93, 1, 9, 15, 103, NULL, NULL, NULL),
(94, 1, 9, 15, 104, NULL, NULL, NULL),
(95, 1, 9, 15, 105, NULL, NULL, NULL),
(96, 1, 9, 15, 106, NULL, NULL, NULL),
(97, 1, 9, 16, 107, NULL, NULL, NULL),
(98, 1, 9, 16, 108, NULL, NULL, NULL),
(99, 1, 9, 16, 109, NULL, NULL, NULL),
(100, 1, 9, 16, 110, NULL, NULL, NULL),
(101, 1, 9, 16, 111, NULL, NULL, NULL),
(102, 1, 9, 16, 112, NULL, NULL, NULL),
(103, 1, 9, 17, 113, NULL, NULL, NULL),
(104, 1, 9, 17, 114, NULL, NULL, NULL),
(105, 1, 9, 17, 115, NULL, NULL, NULL),
(106, 1, 9, 17, 116, NULL, NULL, NULL),
(107, 1, 9, 17, 117, NULL, NULL, NULL),
(108, 1, 9, 17, 118, NULL, NULL, NULL),
(109, 1, 9, 18, 119, NULL, NULL, NULL),
(110, 1, 9, 18, 120, NULL, NULL, NULL),
(111, 1, 9, 18, 121, NULL, NULL, NULL),
(112, 1, 9, 18, 122, NULL, NULL, NULL),
(113, 1, 9, 18, 123, NULL, NULL, NULL),
(114, 1, 9, 18, 124, NULL, NULL, NULL),
(115, 1, 9, 19, 125, NULL, NULL, NULL),
(116, 1, 9, 19, 126, NULL, NULL, NULL),
(117, 1, 9, 19, 127, NULL, NULL, NULL),
(118, 1, 9, 19, 128, NULL, NULL, NULL),
(119, 1, 9, 19, 129, NULL, NULL, NULL),
(120, 1, 10, 20, 130, NULL, NULL, NULL),
(121, 1, 10, 21, 131, NULL, NULL, NULL),
(122, 1, 10, 21, 132, NULL, NULL, NULL),
(123, 1, 10, 21, 133, NULL, NULL, NULL),
(124, 1, 10, 21, 134, NULL, NULL, NULL),
(125, 1, 10, 21, 135, NULL, NULL, NULL),
(126, 1, 10, 21, 136, NULL, NULL, NULL),
(127, 1, 10, 21, 137, NULL, NULL, NULL),
(128, 1, 10, 21, 138, NULL, NULL, NULL),
(129, 1, 10, 21, 139, NULL, NULL, NULL),
(130, 1, 10, 22, 140, NULL, NULL, NULL),
(131, 1, 10, 22, 141, NULL, NULL, NULL),
(132, 1, 10, 22, 142, NULL, NULL, NULL),
(133, 1, 10, 22, 143, NULL, NULL, NULL),
(134, 1, 10, 22, 144, NULL, NULL, NULL),
(135, 1, 10, 22, 145, NULL, NULL, NULL),
(136, 1, 10, 22, 146, NULL, NULL, NULL),
(137, 1, 10, 22, 147, NULL, NULL, NULL),
(138, 1, 10, 22, 148, NULL, NULL, NULL),
(139, 1, 11, 23, 149, NULL, NULL, NULL),
(140, 1, 11, 23, 150, NULL, NULL, NULL),
(141, 1, 11, 23, 151, NULL, NULL, NULL),
(142, 1, 11, 23, 152, NULL, NULL, NULL),
(143, 1, 11, 23, 153, NULL, NULL, NULL),
(144, 1, 11, 23, 154, NULL, NULL, NULL),
(145, 1, 11, 24, 155, NULL, NULL, NULL),
(146, 1, 11, 24, 156, NULL, NULL, NULL),
(147, 1, 11, 24, 157, NULL, NULL, NULL),
(148, 1, 11, 24, 158, NULL, NULL, NULL),
(149, 1, 11, 24, 159, NULL, NULL, NULL),
(150, 1, 11, 24, 160, NULL, NULL, NULL),
(151, 1, 11, 24, 161, NULL, NULL, NULL),
(152, 1, 11, 24, 162, NULL, NULL, NULL),
(153, 1, 11, 25, 163, NULL, NULL, NULL),
(154, 1, 11, 25, 164, NULL, NULL, NULL),
(155, 2, 2, 2, 3, NULL, NULL, NULL),
(156, 2, 2, 2, 4, NULL, NULL, NULL),
(157, 2, 2, 2, 5, NULL, NULL, NULL),
(158, 2, 2, 2, 6, NULL, NULL, NULL),
(159, 2, 2, 2, 7, NULL, NULL, NULL),
(160, 2, 2, 2, 8, NULL, NULL, NULL),
(161, 2, 2, 2, 9, NULL, NULL, NULL),
(162, 2, 2, 2, 10, NULL, NULL, NULL),
(163, 2, 4, 4, 19, NULL, NULL, NULL),
(164, 2, 4, 4, 20, NULL, NULL, NULL),
(165, 2, 4, 4, 21, NULL, NULL, NULL),
(166, 2, 4, 4, 22, NULL, NULL, NULL),
(167, 2, 4, 4, 23, NULL, NULL, NULL),
(168, 2, 4, 4, 24, NULL, NULL, NULL),
(169, 2, 4, 4, 25, NULL, NULL, NULL),
(170, 2, 4, 4, 26, NULL, NULL, NULL),
(171, 2, 4, 4, 27, NULL, NULL, NULL),
(172, 2, 4, 4, 28, NULL, NULL, NULL),
(173, 2, 4, 4, 29, NULL, NULL, NULL),
(174, 2, 4, 4, 30, NULL, NULL, NULL),
(175, 2, 4, 4, 31, NULL, NULL, NULL),
(176, 2, 4, 4, 32, NULL, NULL, NULL),
(177, 2, 4, 4, 33, NULL, NULL, NULL),
(178, 2, 4, 4, 34, NULL, NULL, NULL),
(179, 2, 4, 4, 35, NULL, NULL, NULL),
(180, 2, 4, 4, 36, NULL, NULL, NULL),
(181, 2, 4, 4, 37, NULL, NULL, NULL),
(182, 2, 4, 4, 38, NULL, NULL, NULL),
(183, 2, 4, 4, 39, NULL, NULL, NULL),
(184, 2, 4, 4, 40, NULL, NULL, NULL),
(185, 2, 4, 4, 41, NULL, NULL, NULL),
(186, 2, 4, 4, 42, NULL, NULL, NULL),
(187, 2, 4, 4, 43, NULL, NULL, NULL),
(188, 2, 4, 4, 44, NULL, NULL, NULL),
(189, 2, 4, 4, 45, NULL, NULL, NULL),
(190, 2, 5, 5, 46, NULL, NULL, NULL),
(191, 2, 5, 5, 47, NULL, NULL, NULL),
(192, 2, 5, 5, 48, NULL, NULL, NULL),
(193, 2, 5, 5, 49, NULL, NULL, NULL),
(194, 2, 5, 5, 50, NULL, NULL, NULL),
(195, 2, 5, 5, 51, NULL, NULL, NULL),
(196, 2, 5, 6, 52, NULL, NULL, NULL),
(197, 2, 5, 6, 53, NULL, NULL, NULL),
(198, 2, 5, 6, 54, NULL, NULL, NULL),
(199, 2, 5, 6, 55, NULL, NULL, NULL),
(200, 2, 5, 6, 56, NULL, NULL, NULL),
(201, 2, 5, 6, 57, NULL, NULL, NULL),
(202, 2, 5, 7, 58, NULL, NULL, NULL),
(203, 2, 5, 7, 59, NULL, NULL, NULL),
(204, 2, 5, 7, 60, NULL, NULL, NULL),
(205, 2, 5, 7, 61, NULL, NULL, NULL),
(206, 2, 5, 7, 62, NULL, NULL, NULL),
(207, 2, 5, 7, 63, NULL, NULL, NULL),
(208, 2, 5, 8, 64, NULL, NULL, NULL),
(209, 2, 5, 8, 65, NULL, NULL, NULL),
(210, 2, 5, 8, 66, NULL, NULL, NULL),
(211, 2, 5, 8, 67, NULL, NULL, NULL),
(212, 2, 5, 8, 68, NULL, NULL, NULL),
(213, 2, 5, 8, 69, NULL, NULL, NULL),
(214, 2, 6, 9, 70, NULL, NULL, NULL),
(215, 2, 6, 9, 71, NULL, NULL, NULL),
(216, 2, 6, 9, 72, NULL, NULL, NULL),
(217, 2, 6, 9, 73, NULL, NULL, NULL),
(218, 2, 6, 10, 74, NULL, NULL, NULL),
(219, 2, 6, 10, 75, NULL, NULL, NULL),
(220, 2, 6, 10, 76, NULL, NULL, NULL),
(221, 2, 6, 10, 77, NULL, NULL, NULL),
(222, 2, 6, 10, 78, NULL, NULL, NULL),
(223, 2, 6, 11, 79, NULL, NULL, NULL),
(224, 2, 6, 11, 80, NULL, NULL, NULL),
(225, 2, 6, 11, 81, NULL, NULL, NULL),
(226, 2, 6, 11, 82, NULL, NULL, NULL),
(227, 2, 6, 11, 83, NULL, NULL, NULL),
(228, 2, 6, 11, 84, NULL, NULL, NULL),
(229, 2, 6, 11, 85, NULL, NULL, NULL),
(230, 2, 6, 11, 86, NULL, NULL, NULL),
(231, 2, 6, 11, 87, NULL, NULL, NULL),
(232, 2, 7, 12, 88, NULL, NULL, NULL),
(233, 2, 7, 12, 89, NULL, NULL, NULL),
(234, 2, 7, 12, 90, NULL, NULL, NULL),
(235, 2, 7, 12, 91, NULL, NULL, NULL),
(236, 2, 7, 12, 92, NULL, NULL, NULL),
(237, 2, 7, 12, 93, NULL, NULL, NULL),
(238, 2, 8, 13, 94, NULL, NULL, NULL),
(239, 2, 8, 13, 95, NULL, NULL, NULL),
(240, 2, 8, 13, 96, NULL, NULL, NULL),
(241, 2, 8, 14, 97, NULL, NULL, NULL),
(242, 2, 8, 14, 98, NULL, NULL, NULL),
(243, 2, 8, 14, 99, NULL, NULL, NULL),
(244, 2, 8, 14, 100, NULL, NULL, NULL),
(245, 2, 9, 15, 101, NULL, NULL, NULL),
(246, 2, 9, 15, 102, NULL, NULL, NULL),
(247, 2, 9, 15, 103, NULL, NULL, NULL),
(248, 2, 9, 15, 104, NULL, NULL, NULL),
(249, 2, 9, 15, 105, NULL, NULL, NULL),
(250, 2, 9, 15, 106, NULL, NULL, NULL),
(251, 2, 9, 16, 107, NULL, NULL, NULL),
(252, 2, 9, 16, 108, NULL, NULL, NULL),
(253, 2, 9, 16, 109, NULL, NULL, NULL),
(254, 2, 9, 16, 110, NULL, NULL, NULL),
(255, 2, 9, 16, 111, NULL, NULL, NULL),
(256, 2, 9, 16, 112, NULL, NULL, NULL),
(257, 2, 9, 17, 113, NULL, NULL, NULL),
(258, 2, 9, 17, 114, NULL, NULL, NULL),
(259, 2, 9, 17, 115, NULL, NULL, NULL),
(260, 2, 9, 17, 116, NULL, NULL, NULL),
(261, 2, 9, 17, 117, NULL, NULL, NULL),
(262, 2, 9, 17, 118, NULL, NULL, NULL),
(263, 2, 9, 18, 119, NULL, NULL, NULL),
(264, 2, 9, 18, 120, NULL, NULL, NULL),
(265, 2, 9, 18, 121, NULL, NULL, NULL),
(266, 2, 9, 18, 122, NULL, NULL, NULL),
(267, 2, 9, 18, 123, NULL, NULL, NULL),
(268, 2, 9, 18, 124, NULL, NULL, NULL),
(269, 2, 9, 19, 125, NULL, NULL, NULL),
(270, 2, 9, 19, 126, NULL, NULL, NULL),
(271, 2, 9, 19, 127, NULL, NULL, NULL),
(272, 2, 9, 19, 128, NULL, NULL, NULL),
(273, 2, 9, 19, 129, NULL, NULL, NULL),
(274, 2, 10, 20, 130, NULL, NULL, NULL),
(275, 2, 10, 21, 131, NULL, NULL, NULL),
(276, 2, 10, 21, 132, NULL, NULL, NULL),
(277, 2, 10, 21, 133, NULL, NULL, NULL),
(278, 2, 10, 21, 134, NULL, NULL, NULL),
(279, 2, 10, 21, 135, NULL, NULL, NULL),
(280, 2, 10, 21, 136, NULL, NULL, NULL),
(281, 2, 10, 21, 137, NULL, NULL, NULL),
(282, 2, 10, 21, 138, NULL, NULL, NULL),
(283, 2, 10, 21, 139, NULL, NULL, NULL),
(284, 2, 10, 22, 140, NULL, NULL, NULL),
(285, 2, 10, 22, 141, NULL, NULL, NULL),
(286, 2, 10, 22, 142, NULL, NULL, NULL),
(287, 2, 10, 22, 143, NULL, NULL, NULL),
(288, 2, 10, 22, 144, NULL, NULL, NULL),
(289, 2, 10, 22, 145, NULL, NULL, NULL),
(290, 2, 10, 22, 146, NULL, NULL, NULL),
(291, 2, 10, 22, 147, NULL, NULL, NULL),
(292, 2, 10, 22, 148, NULL, NULL, NULL),
(293, 2, 11, 23, 149, NULL, NULL, NULL),
(294, 2, 11, 23, 150, NULL, NULL, NULL),
(295, 2, 11, 23, 151, NULL, NULL, NULL),
(296, 2, 11, 23, 152, NULL, NULL, NULL),
(297, 2, 11, 23, 153, NULL, NULL, NULL),
(298, 2, 11, 23, 154, NULL, NULL, NULL),
(299, 2, 11, 24, 155, NULL, NULL, NULL),
(300, 2, 11, 24, 156, NULL, NULL, NULL),
(301, 2, 11, 24, 157, NULL, NULL, NULL),
(302, 2, 11, 24, 158, NULL, NULL, NULL),
(303, 2, 11, 24, 159, NULL, NULL, NULL),
(304, 2, 11, 24, 160, NULL, NULL, NULL),
(305, 2, 11, 24, 161, NULL, NULL, NULL),
(306, 2, 11, 24, 162, NULL, NULL, NULL),
(307, 2, 11, 25, 163, NULL, NULL, NULL),
(308, 2, 11, 25, 164, NULL, NULL, NULL),
(309, 3, 4, 4, 19, NULL, NULL, NULL),
(310, 3, 4, 4, 20, NULL, NULL, NULL),
(311, 3, 4, 4, 21, NULL, NULL, NULL),
(312, 3, 4, 4, 22, NULL, NULL, NULL),
(313, 3, 4, 4, 23, NULL, NULL, NULL),
(314, 3, 4, 4, 24, NULL, NULL, NULL),
(315, 3, 4, 4, 25, NULL, NULL, NULL),
(316, 3, 4, 4, 26, NULL, NULL, NULL),
(317, 3, 4, 4, 27, NULL, NULL, NULL),
(318, 3, 4, 4, 28, NULL, NULL, NULL),
(319, 3, 4, 4, 29, NULL, NULL, NULL),
(320, 3, 4, 4, 30, NULL, NULL, NULL),
(321, 3, 4, 4, 31, NULL, NULL, NULL),
(322, 3, 4, 4, 32, NULL, NULL, NULL),
(323, 3, 4, 4, 33, NULL, NULL, NULL),
(324, 3, 4, 4, 34, NULL, NULL, NULL),
(325, 3, 4, 4, 35, NULL, NULL, NULL),
(326, 3, 4, 4, 36, NULL, NULL, NULL),
(327, 3, 4, 4, 37, NULL, NULL, NULL),
(328, 3, 4, 4, 38, NULL, NULL, NULL),
(329, 3, 4, 4, 39, NULL, NULL, NULL),
(330, 3, 4, 4, 40, NULL, NULL, NULL),
(331, 3, 4, 4, 41, NULL, NULL, NULL),
(332, 3, 4, 4, 42, NULL, NULL, NULL),
(333, 3, 4, 4, 43, NULL, NULL, NULL),
(334, 3, 4, 4, 44, NULL, NULL, NULL),
(335, 3, 4, 4, 45, NULL, NULL, NULL),
(336, 3, 7, 12, 88, NULL, NULL, NULL),
(337, 3, 7, 12, 89, NULL, NULL, NULL),
(338, 3, 7, 12, 90, NULL, NULL, NULL),
(339, 3, 7, 12, 91, NULL, NULL, NULL),
(340, 3, 7, 12, 92, NULL, NULL, NULL),
(341, 3, 7, 12, 93, NULL, NULL, NULL),
(342, 3, 8, 13, 94, NULL, NULL, NULL),
(343, 3, 8, 13, 95, NULL, NULL, NULL),
(344, 3, 8, 13, 96, NULL, NULL, NULL),
(345, 3, 8, 14, 97, NULL, NULL, NULL),
(346, 3, 8, 14, 98, NULL, NULL, NULL),
(347, 3, 8, 14, 99, NULL, NULL, NULL),
(348, 3, 8, 14, 100, NULL, NULL, NULL),
(349, 3, 9, 15, 101, NULL, NULL, NULL),
(350, 3, 9, 15, 102, NULL, NULL, NULL),
(351, 3, 9, 15, 103, NULL, NULL, NULL),
(352, 3, 9, 15, 104, NULL, NULL, NULL),
(353, 3, 9, 15, 105, NULL, NULL, NULL),
(354, 3, 9, 15, 106, NULL, NULL, NULL),
(355, 3, 9, 16, 107, NULL, NULL, NULL),
(356, 3, 9, 16, 108, NULL, NULL, NULL),
(357, 3, 9, 16, 109, NULL, NULL, NULL),
(358, 3, 9, 16, 110, NULL, NULL, NULL),
(359, 3, 9, 16, 111, NULL, NULL, NULL),
(360, 3, 9, 16, 112, NULL, NULL, NULL),
(361, 3, 9, 17, 113, NULL, NULL, NULL),
(362, 3, 9, 17, 114, NULL, NULL, NULL),
(363, 3, 9, 17, 115, NULL, NULL, NULL),
(364, 3, 9, 17, 116, NULL, NULL, NULL),
(365, 3, 9, 17, 117, NULL, NULL, NULL),
(366, 3, 9, 17, 118, NULL, NULL, NULL),
(367, 3, 9, 18, 119, NULL, NULL, NULL),
(368, 3, 9, 18, 120, NULL, NULL, NULL),
(369, 3, 9, 18, 121, NULL, NULL, NULL),
(370, 3, 9, 18, 122, NULL, NULL, NULL),
(371, 3, 9, 18, 123, NULL, NULL, NULL),
(372, 3, 9, 18, 124, NULL, NULL, NULL),
(373, 3, 9, 19, 125, NULL, NULL, NULL),
(374, 3, 9, 19, 126, NULL, NULL, NULL),
(375, 3, 9, 19, 127, NULL, NULL, NULL),
(376, 3, 9, 19, 128, NULL, NULL, NULL),
(377, 3, 9, 19, 129, NULL, NULL, NULL),
(378, 3, 10, 20, 130, NULL, NULL, NULL),
(379, 3, 10, 21, 131, NULL, NULL, NULL),
(380, 3, 10, 21, 132, NULL, NULL, NULL),
(381, 3, 10, 21, 133, NULL, NULL, NULL),
(382, 3, 10, 21, 134, NULL, NULL, NULL),
(383, 3, 10, 21, 135, NULL, NULL, NULL),
(384, 3, 10, 21, 136, NULL, NULL, NULL),
(385, 3, 10, 21, 137, NULL, NULL, NULL),
(386, 3, 10, 21, 138, NULL, NULL, NULL),
(387, 3, 10, 21, 139, NULL, NULL, NULL),
(388, 3, 10, 22, 140, NULL, NULL, NULL),
(389, 3, 10, 22, 141, NULL, NULL, NULL),
(390, 3, 10, 22, 142, NULL, NULL, NULL),
(391, 3, 10, 22, 143, NULL, NULL, NULL),
(392, 3, 10, 22, 144, NULL, NULL, NULL),
(393, 3, 10, 22, 145, NULL, NULL, NULL),
(394, 3, 10, 22, 146, NULL, NULL, NULL),
(395, 3, 10, 22, 147, NULL, NULL, NULL),
(396, 3, 10, 22, 148, NULL, NULL, NULL),
(397, 4, 4, 4, 19, NULL, NULL, NULL),
(398, 4, 4, 4, 20, NULL, NULL, NULL),
(399, 4, 4, 4, 21, NULL, NULL, NULL),
(400, 4, 4, 4, 22, NULL, NULL, NULL),
(401, 4, 4, 4, 23, NULL, NULL, NULL),
(402, 4, 4, 4, 24, NULL, NULL, NULL),
(403, 4, 4, 4, 25, NULL, NULL, NULL),
(404, 4, 4, 4, 26, NULL, NULL, NULL),
(405, 4, 4, 4, 27, NULL, NULL, NULL),
(406, 4, 4, 4, 28, NULL, NULL, NULL),
(407, 4, 4, 4, 29, NULL, NULL, NULL),
(408, 4, 4, 4, 30, NULL, NULL, NULL),
(409, 4, 4, 4, 31, NULL, NULL, NULL),
(410, 4, 4, 4, 32, NULL, NULL, NULL),
(411, 4, 4, 4, 33, NULL, NULL, NULL),
(412, 4, 4, 4, 34, NULL, NULL, NULL),
(413, 4, 4, 4, 35, NULL, NULL, NULL),
(414, 4, 4, 4, 36, NULL, NULL, NULL),
(415, 4, 4, 4, 37, NULL, NULL, NULL),
(416, 4, 4, 4, 38, NULL, NULL, NULL),
(417, 4, 4, 4, 39, NULL, NULL, NULL),
(418, 4, 4, 4, 40, NULL, NULL, NULL),
(419, 4, 4, 4, 41, NULL, NULL, NULL),
(420, 4, 4, 4, 42, NULL, NULL, NULL),
(421, 4, 4, 4, 43, NULL, NULL, NULL),
(422, 4, 4, 4, 44, NULL, NULL, NULL),
(423, 4, 4, 4, 45, NULL, NULL, NULL),
(424, 4, 7, 12, 88, NULL, NULL, NULL),
(425, 4, 7, 12, 89, NULL, NULL, NULL),
(426, 4, 7, 12, 90, NULL, NULL, NULL),
(427, 4, 7, 12, 91, NULL, NULL, NULL),
(428, 4, 7, 12, 92, NULL, NULL, NULL),
(429, 4, 7, 12, 93, NULL, NULL, NULL),
(430, 4, 10, 20, 130, NULL, NULL, NULL),
(431, 4, 10, 21, 131, NULL, NULL, NULL),
(432, 4, 10, 21, 132, NULL, NULL, NULL),
(433, 4, 10, 21, 133, NULL, NULL, NULL),
(434, 4, 10, 21, 134, NULL, NULL, NULL),
(435, 4, 10, 21, 135, NULL, NULL, NULL),
(436, 4, 10, 21, 136, NULL, NULL, NULL),
(437, 4, 10, 21, 137, NULL, NULL, NULL),
(438, 4, 10, 21, 138, NULL, NULL, NULL),
(439, 4, 10, 21, 139, NULL, NULL, NULL),
(440, 4, 10, 22, 140, NULL, NULL, NULL),
(441, 4, 10, 22, 141, NULL, NULL, NULL),
(442, 4, 10, 22, 142, NULL, NULL, NULL),
(443, 4, 10, 22, 143, NULL, NULL, NULL),
(444, 4, 10, 22, 144, NULL, NULL, NULL),
(445, 4, 10, 22, 145, NULL, NULL, NULL),
(446, 4, 10, 22, 146, NULL, NULL, NULL),
(447, 4, 10, 22, 147, NULL, NULL, NULL),
(448, 4, 10, 22, 148, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `salary_rule_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `month` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `basic_salary` decimal(20,6) DEFAULT 0.000000,
  `allowance` decimal(20,6) DEFAULT 0.000000,
  `deduction` decimal(20,6) DEFAULT 0.000000,
  `other_allowance` decimal(20,6) DEFAULT 0.000000,
  `other_deduction` decimal(20,6) DEFAULT 0.000000,
  `details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax` decimal(20,6) DEFAULT NULL,
  `total` decimal(20,6) DEFAULT 0.000000,
  `paid_amount` decimal(20,6) DEFAULT 0.000000,
  `due_amount` decimal(20,6) DEFAULT 0.000000,
  `is_paid` tinyint(4) DEFAULT 0,
  `approval_status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary_rules`
--

CREATE TABLE `salary_rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `designation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `basic_salary` decimal(20,6) NOT NULL,
  `details` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary_rule_structures`
--

CREATE TABLE `salary_rule_structures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `salary_rule_id` bigint(20) UNSIGNED DEFAULT NULL,
  `salary_structure_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_percent` tinyint(4) NOT NULL DEFAULT 0,
  `amount` decimal(20,6) NOT NULL DEFAULT 0.000000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary_structures`
--

CREATE TABLE `salary_structures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `working_hour` decimal(6,2) DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_gateway`
--

CREATE TABLE `sms_gateway` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `driver` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`details`)),
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_log`
--

CREATE TABLE `sms_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sms` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submodules`
--

CREATE TABLE `submodules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scope` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`scope`)),
  `order` int(11) DEFAULT 0,
  `show` tinyint(4) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `submodules`
--

INSERT INTO `submodules` (`id`, `module_id`, `name`, `scope`, `order`, `show`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Activities', '[\"common\"]', 1, 0, 1, NULL, NULL),
(2, 2, 'Branches', '[\"common\"]', 1, 0, 1, NULL, NULL),
(3, 3, 'Companies', '[\"admin\"]', 1, 0, 1, NULL, NULL),
(4, 4, 'Employees', '[\"common\",\"employee\"]', 1, 0, 1, NULL, NULL),
(5, 5, 'Departments', '[\"common\"]', 1, 0, 1, NULL, NULL),
(6, 5, 'Designations', '[\"common\"]', 2, 0, 1, NULL, NULL),
(7, 5, 'Attendance Deduction Policy', '[\"common\"]', 3, 0, 1, NULL, NULL),
(8, 5, 'Leave Policy', '[\"common\"]', 3, 0, 1, NULL, NULL),
(9, 6, 'Salary Structure Components', '[\"common\"]', 2, 0, 1, NULL, NULL),
(10, 6, 'Salary Rules', '[\"common\"]', 3, 1, 1, NULL, NULL),
(11, 6, 'Salary', '[\"common\"]', 4, 1, 1, NULL, NULL),
(12, 7, 'Reports', '[\"common\",\"employee\"]', 1, 0, 1, NULL, NULL),
(13, 8, 'SMS', '[\"common\"]', 1, 0, 1, NULL, NULL),
(14, 8, 'Emails', '[\"common\"]', 1, 0, 0, NULL, NULL),
(15, 9, 'Employment Type', '[\"admin\",\"company\"]', 1, 0, 1, NULL, NULL),
(16, 9, 'Leave Types', '[\"common\"]', 3, 0, 1, NULL, NULL),
(17, 9, 'Taxes', '[\"common\"]', 4, 0, 1, NULL, NULL),
(18, 9, 'Working Shift', '[\"admin\",\"company\"]', 2, 0, 1, NULL, NULL),
(19, 9, 'Holidays', '[\"common\",\"employee\"]', 1, 0, 1, NULL, NULL),
(20, 10, 'Dashboard', '[\"common\"]', 2, 0, 1, NULL, NULL),
(21, 10, 'Leave Applications', '[\"common\",\"employee\"]', 3, 1, 1, NULL, NULL),
(22, 10, 'Attendance', '[\"common\",\"employee\"]', 4, 1, 1, NULL, NULL),
(23, 11, 'Roles', '[\"common\"]', 1, 1, 1, NULL, NULL),
(24, 11, 'Users', '[\"common\"]', 2, 0, 1, NULL, NULL),
(25, 11, 'Password Reset', '[\"common\"]', 3, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_phone` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_events` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sms_events`)),
  `email_notification` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pagination` int(11) NOT NULL DEFAULT 25,
  `report_pagination` int(11) NOT NULL DEFAULT 100,
  `use_cache` tinyint(4) DEFAULT 0,
  `timezone_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `show_currency_symbol` tinyint(4) DEFAULT 0,
  `show_space_after_symbol` tinyint(4) DEFAULT 0,
  `has_tax_policy` tinyint(4) DEFAULT 0,
  `system_realtime_notification` tinyint(4) DEFAULT 0,
  `mix` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `system_name`, `system_phone`, `system_email`, `sms_events`, `email_notification`, `pagination`, `report_pagination`, `use_cache`, `timezone_id`, `currency_id`, `show_currency_symbol`, `show_space_after_symbol`, `has_tax_policy`, `system_realtime_notification`, `mix`, `created_at`, `updated_at`) VALUES
(1, 'Inta-Hrm', '01826319556', 'help.intadev@gmail.com', NULL, '0', 10, 100, 0, 70, 148, 0, 0, 0, 0, 'MTAwMDBodHRwOi8vbG9jYWxob3N0fDk5OTktMzMyMy0yMzQ1', '2022-06-10 03:59:11', '2022-06-10 10:00:17');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `eligible_amount` decimal(20,6) DEFAULT NULL,
  `tax` decimal(6,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE `timezones` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abbr` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offset` int(11) DEFAULT NULL,
  `text` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utc` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dst` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timezones`
--

INSERT INTO `timezones` (`id`, `value`, `abbr`, `offset`, `text`, `utc`, `dst`, `created_at`, `updated_at`) VALUES
(1, 'Dateline Standard Time', 'DST', -12, '(UTC-12:00) International Date Line West', 'Etc/GMT+12', 0, '2022-06-10 03:59:46', '2022-06-10 03:59:46'),
(2, 'UTC-11', 'U', -11, '(UTC-11:00) Coordinated Universal Time-11', 'Pacific/Midway', 0, '2022-06-10 03:59:46', '2022-06-10 03:59:46'),
(3, 'Hawaiian Standard Time', 'HST', -10, '(UTC-10:00) Hawaii', 'Pacific/Honolulu', 0, '2022-06-10 03:59:46', '2022-06-10 03:59:46'),
(4, 'Alaskan Standard Time', 'AKDT', -8, '(UTC-09:00) Alaska', 'America/Anchorage', 1, '2022-06-10 03:59:46', '2022-06-10 03:59:46'),
(5, 'Pacific Standard Time (Mexico)', 'PDT', -7, '(UTC-08:00) Baja California', 'America/Santa_Isabel', 1, '2022-06-10 03:59:46', '2022-06-10 03:59:46'),
(6, 'Pacific Standard Time', 'PDT', -7, '(UTC-08:00) Pacific Time (US & Canada)', 'America/Los_Angeles', 1, '2022-06-10 03:59:46', '2022-06-10 03:59:46'),
(7, 'US Mountain Standard Time', 'UMST', -7, '(UTC-07:00) Arizona', 'America/Phoenix', 0, '2022-06-10 03:59:46', '2022-06-10 03:59:46'),
(8, 'Mountain Standard Time (Mexico)', 'MDT', -6, '(UTC-07:00) Chihuahua, La Paz, Mazatlan', 'America/Chihuahua', 1, '2022-06-10 03:59:46', '2022-06-10 03:59:46'),
(9, 'Mountain Standard Time', 'MDT', -6, '(UTC-07:00) Mountain Time (US & Canada)', 'America/Denver', 1, '2022-06-10 03:59:46', '2022-06-10 03:59:46'),
(10, 'Central America Standard Time', 'CAST', -6, '(UTC-06:00) Central America', 'America/Guatemala', 0, '2022-06-10 03:59:46', '2022-06-10 03:59:46'),
(11, 'Central Standard Time', 'CDT', -5, '(UTC-06:00) Central Time (US & Canada)', 'America/Chicago', 1, '2022-06-10 03:59:46', '2022-06-10 03:59:46'),
(12, 'Central Standard Time (Mexico)', 'CDT', -5, '(UTC-06:00) Guadalajara, Mexico City, Monterrey', 'America/Mexico_City', 1, '2022-06-10 03:59:47', '2022-06-10 03:59:47'),
(13, 'Canada Central Standard Time', 'CCST', -6, '(UTC-06:00) Saskatchewan', 'America/Regina', 0, '2022-06-10 03:59:47', '2022-06-10 03:59:47'),
(14, 'SA Pacific Standard Time', 'SPST', -5, '(UTC-05:00) Bogota, Lima, Quito', 'America/Lima', 0, '2022-06-10 03:59:47', '2022-06-10 03:59:47'),
(15, 'Eastern Standard Time', 'EDT', -4, '(UTC-05:00) Eastern Time (US & Canada)', 'America/New_York', 1, '2022-06-10 03:59:47', '2022-06-10 03:59:47'),
(16, 'US Eastern Standard Time', 'UEDT', -4, '(UTC-05:00) Indiana (East)', 'America/Indianapolis', 1, '2022-06-10 03:59:47', '2022-06-10 03:59:47'),
(17, 'Venezuela Standard Time', 'VST', -5, '(UTC-04:30) Caracas', 'America/Caracas', 0, '2022-06-10 03:59:47', '2022-06-10 03:59:47'),
(18, 'Paraguay Standard Time', 'PST', -4, '(UTC-04:00) Asuncion', 'America/Asuncion', 0, '2022-06-10 03:59:47', '2022-06-10 03:59:47'),
(19, 'Atlantic Standard Time', 'ADT', -3, '(UTC-04:00) Atlantic Time (Canada)', 'Atlantic/Bermuda', 1, '2022-06-10 03:59:47', '2022-06-10 03:59:47'),
(20, 'Central Brazilian Standard Time', 'CBST', -4, '(UTC-04:00) Cuiaba', 'America/Cuiaba', 0, '2022-06-10 03:59:47', '2022-06-10 03:59:47'),
(21, 'SA Western Standard Time', 'SWST', -4, '(UTC-04:00) Georgetown, La Paz, Manaus, San Juan', 'America/Aruba', 0, '2022-06-10 03:59:47', '2022-06-10 03:59:47'),
(22, 'Pacific SA Standard Time', 'PSST', -4, '(UTC-04:00) Santiago', 'America/Santiago', 0, '2022-06-10 03:59:48', '2022-06-10 03:59:48'),
(23, 'Newfoundland Standard Time', 'NDT', -3, '(UTC-03:30) Newfoundland', 'America/St_Johns', 1, '2022-06-10 03:59:48', '2022-06-10 03:59:48'),
(24, 'E. South America Standard Time', 'ESAST', -3, '(UTC-03:00) Brasilia', 'America/Sao_Paulo', 0, '2022-06-10 03:59:48', '2022-06-10 03:59:48'),
(25, 'Argentina Standard Time', 'AST', -3, '(UTC-03:00) Buenos Aires', 'America/Buenos_Aires', 0, '2022-06-10 03:59:48', '2022-06-10 03:59:48'),
(26, 'SA Eastern Standard Time', 'SEST', -3, '(UTC-03:00) Cayenne, Fortaleza', 'America/Cayenne', 0, '2022-06-10 03:59:48', '2022-06-10 03:59:48'),
(27, 'Greenland Standard Time', 'GDT', -2, '(UTC-03:00) Greenland', 'America/Godthab', 1, '2022-06-10 03:59:48', '2022-06-10 03:59:48'),
(28, 'Montevideo Standard Time', 'MST', -3, '(UTC-03:00) Montevideo', 'America/Montevideo', 0, '2022-06-10 03:59:48', '2022-06-10 03:59:48'),
(29, 'Bahia Standard Time', 'BST', -3, '(UTC-03:00) Salvador', 'America/Bahia', 0, '2022-06-10 03:59:48', '2022-06-10 03:59:48'),
(30, 'UTC-02', 'U', -2, '(UTC-02:00) Coordinated Universal Time-02', 'America/Noronha', 0, '2022-06-10 03:59:48', '2022-06-10 03:59:48'),
(31, 'Azores Standard Time', 'ADT', 0, '(UTC-01:00) Azores', 'Atlantic/Azores', 1, '2022-06-10 03:59:48', '2022-06-10 03:59:48'),
(32, 'Cape Verde Standard Time', 'CVST', -1, '(UTC-01:00) Cape Verde Is.', 'Atlantic/Cape_Verde', 0, '2022-06-10 03:59:48', '2022-06-10 03:59:48'),
(33, 'Morocco Standard Time', 'MDT', 1, '(UTC) Casablanca', 'Africa/Casablanca', 1, '2022-06-10 03:59:48', '2022-06-10 03:59:48'),
(34, 'UTC', 'CUT', 0, '(UTC) Coordinated Universal Time', 'America/Danmarkshavn', 0, '2022-06-10 03:59:48', '2022-06-10 03:59:48'),
(35, 'GMT Standard Time', 'GDT', 1, '(UTC) Dublin, Edinburgh, Lisbon, London', 'Europe/London', 1, '2022-06-10 03:59:48', '2022-06-10 03:59:48'),
(36, 'Greenwich Standard Time', 'GST', 0, '(UTC) Monrovia, Reykjavik', 'Africa/Monrovia', 0, '2022-06-10 03:59:48', '2022-06-10 03:59:48'),
(37, 'W. Europe Standard Time', 'WEDT', 2, '(UTC+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna', 'Europe/Amsterdam', 1, '2022-06-10 03:59:48', '2022-06-10 03:59:48'),
(38, 'Central Europe Standard Time', 'CEDT', 2, '(UTC+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague', 'Europe/Budapest', 1, '2022-06-10 03:59:48', '2022-06-10 03:59:48'),
(39, 'Romance Standard Time', 'RDT', 2, '(UTC+01:00) Brussels, Copenhagen, Madrid, Paris', 'Europe/Paris', 1, '2022-06-10 03:59:49', '2022-06-10 03:59:49'),
(40, 'Central European Standard Time', 'CEDT', 2, '(UTC+01:00) Sarajevo, Skopje, Warsaw, Zagreb', 'Europe/Warsaw', 1, '2022-06-10 03:59:49', '2022-06-10 03:59:49'),
(41, 'W. Central Africa Standard Time', 'WCAST', 1, '(UTC+01:00) West Central Africa', 'Africa/Lagos', 0, '2022-06-10 03:59:49', '2022-06-10 03:59:49'),
(42, 'Namibia Standard Time', 'NST', 1, '(UTC+01:00) Windhoek', 'Africa/Windhoek', 0, '2022-06-10 03:59:49', '2022-06-10 03:59:49'),
(43, 'GTB Standard Time', 'GDT', 3, '(UTC+02:00) Athens, Bucharest, Chisinau, Nicosia', 'Europe/Athens', 1, '2022-06-10 03:59:49', '2022-06-10 03:59:49'),
(44, 'Middle East Standard Time', 'MEDT', 3, '(UTC+02:00) Beirut', 'Asia/Beirut', 1, '2022-06-10 03:59:49', '2022-06-10 03:59:49'),
(45, 'Egypt Standard Time', 'EST', 2, '(UTC+02:00) Cairo', 'Africa/Cairo', 0, '2022-06-10 03:59:49', '2022-06-10 03:59:49'),
(46, 'Syria Standard Time', 'SDT', 3, '(UTC+02:00) Damascus', 'Asia/Damascus', 1, '2022-06-10 03:59:49', '2022-06-10 03:59:49'),
(47, 'South Africa Standard Time', 'SAST', 2, '(UTC+02:00) Harare, Pretoria, Johannesburg, Bujumbura', 'Africa/Harare', 0, '2022-06-10 03:59:49', '2022-06-10 03:59:49'),
(48, 'FLE Standard Time', 'FDT', 3, '(UTC+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius', 'Europe/Helsinki', 1, '2022-06-10 03:59:49', '2022-06-10 03:59:49'),
(49, 'Turkey Standard Time', 'TDT', 3, '(UTC+02:00) Istanbul', 'Europe/Istanbul', 1, '2022-06-10 03:59:49', '2022-06-10 03:59:49'),
(50, 'Israel Standard Time', 'JDT', 3, '(UTC+02:00) Jerusalem', 'Asia/Jerusalem', 1, '2022-06-10 03:59:49', '2022-06-10 03:59:49'),
(51, 'Libya Standard Time', 'LST', 2, '(UTC+02:00) Tripoli', 'Africa/Tripoli', 0, '2022-06-10 03:59:49', '2022-06-10 03:59:49'),
(52, 'Jordan Standard Time', 'JST', 3, '(UTC+03:00) Amman', 'Asia/Amman', 0, '2022-06-10 03:59:49', '2022-06-10 03:59:49'),
(53, 'Arabic Standard Time', 'AST', 3, '(UTC+03:00) Baghdad', 'Asia/Baghdad', 0, '2022-06-10 03:59:49', '2022-06-10 03:59:49'),
(54, 'Kaliningrad Standard Time', 'KST', 3, '(UTC+03:00) Kaliningrad, Minsk', 'Europe/Kaliningrad', 0, '2022-06-10 03:59:50', '2022-06-10 03:59:50'),
(55, 'Arab Standard Time', 'AST', 3, '(UTC+03:00) Aden, Bahrain, Kuwait, Riyadh, Qatar', 'Asia/Qatar', 0, '2022-06-10 03:59:50', '2022-06-10 03:59:50'),
(56, 'E. Africa Standard Time', 'EAST', 3, '(UTC+03:00) Nairobi, Comoro, Juba', 'Africa/Nairobi', 0, '2022-06-10 03:59:50', '2022-06-10 03:59:50'),
(57, 'Iran Standard Time', 'IDT', 5, '(UTC+03:30) Tehran', 'Asia/Tehran', 1, '2022-06-10 03:59:50', '2022-06-10 03:59:50'),
(58, 'Arabian Standard Time', 'AST', 4, '(UTC+04:00) Abu Dhabi, Muscat', 'Asia/Dubai', 0, '2022-06-10 03:59:50', '2022-06-10 03:59:50'),
(59, 'Azerbaijan Standard Time', 'ADT', 5, '(UTC+04:00) Baku', 'Asia/Baku', 1, '2022-06-10 03:59:50', '2022-06-10 03:59:50'),
(60, 'Russian Standard Time', 'RST', 4, '(UTC+04:00) Samara, Moscow, St. Petersburg, Simferopol, Volgograd', 'Europe/Moscow', 0, '2022-06-10 03:59:50', '2022-06-10 03:59:50'),
(61, 'Mauritius Standard Time', 'MST', 4, '(UTC+04:00) Port Louis, Mauritius, Reunion, Mahe', 'Indian/Mauritius', 0, '2022-06-10 03:59:50', '2022-06-10 03:59:50'),
(62, 'Georgian Standard Time', 'GST', 4, '(UTC+04:00) Tbilisi', 'Asia/Tbilisi', 0, '2022-06-10 03:59:50', '2022-06-10 03:59:50'),
(63, 'Caucasus Standard Time', 'CST', 4, '(UTC+04:00) Yerevan', 'Asia/Yerevan', 0, '2022-06-10 03:59:50', '2022-06-10 03:59:50'),
(64, 'Afghanistan Standard Time', 'AST', 5, '(UTC+04:30) Kabul', 'Asia/Kabul', 0, '2022-06-10 03:59:51', '2022-06-10 03:59:51'),
(65, 'West Asia Standard Time', 'WAST', 5, '(UTC+05:00) Ashgabat, Dushanbe, Tashkent, Maldives', 'Asia/Tashkent', 0, '2022-06-10 03:59:51', '2022-06-10 03:59:51'),
(66, 'Pakistan Standard Time', 'PST', 5, '(UTC+05:00) Islamabad, Karachi', 'Asia/Karachi', 0, '2022-06-10 03:59:51', '2022-06-10 03:59:51'),
(67, 'India Standard Time', 'IST', 6, '(UTC+05:30) Chennai, Kolkata, Mumbai, New Delhi', 'Asia/Calcutta', 0, '2022-06-10 03:59:51', '2022-06-10 03:59:51'),
(68, 'Sri Lanka Standard Time', 'SLST', 6, '(UTC+05:30) Sri Jayawardenepura', 'Asia/Colombo', 0, '2022-06-10 03:59:51', '2022-06-10 03:59:51'),
(69, 'Nepal Standard Time', 'NST', 6, '(UTC+05:45) Kathmandu', 'Asia/Katmandu', 0, '2022-06-10 03:59:51', '2022-06-10 03:59:51'),
(70, 'Central Asia Standard Time', 'CAST', 6, '(UTC+06:00) Astana, Dhaka, Thimphu', 'Asia/Dhaka', 0, '2022-06-10 03:59:51', '2022-06-10 03:59:51'),
(71, 'Ekaterinburg Standard Time', 'EST', 6, '(UTC+06:00) Ekaterinburg', 'Asia/Yekaterinburg', 0, '2022-06-10 03:59:51', '2022-06-10 03:59:51'),
(72, 'Myanmar Standard Time', 'MST', 7, '(UTC+06:30) Yangon (Rangoon), Cocos', 'Asia/Rangoon', 0, '2022-06-10 03:59:51', '2022-06-10 03:59:51'),
(73, 'SE Asia Standard Time', 'SAST', 7, '(UTC+07:00) Bangkok, Hanoi, Jakarta, Saigon', 'Asia/Bangkok', 0, '2022-06-10 03:59:51', '2022-06-10 03:59:51'),
(74, 'N. Central Asia Standard Time', 'NCAST', 7, '(UTC+07:00) Novosibirsk', 'Asia/Novosibirsk', 0, '2022-06-10 03:59:51', '2022-06-10 03:59:51'),
(75, 'China Standard Time', 'CST', 8, '(UTC+08:00) Beijing, Chongqing, Hong Kong, Macau, Shanghai, Urumqi', 'Asia/Shanghai', 0, '2022-06-10 03:59:51', '2022-06-10 03:59:51'),
(76, 'North Asia Standard Time', 'NAST', 8, '(UTC+08:00) Krasnoyarsk', 'Asia/Krasnoyarsk', 0, '2022-06-10 03:59:51', '2022-06-10 03:59:51'),
(77, 'Singapore Standard Time', 'MPST', 8, '(UTC+08:00) Kuala Lumpur, Singapore, Brunei, Makassar, Manila', 'Asia/Singapore', 0, '2022-06-10 03:59:51', '2022-06-10 03:59:51'),
(78, 'W. Australia Standard Time', 'WAST', 8, '(UTC+08:00) Perth', 'Australia/Perth', 0, '2022-06-10 03:59:51', '2022-06-10 03:59:51'),
(79, 'Taipei Standard Time', 'TST', 8, '(UTC+08:00) Taipei', 'Asia/Taipei', 0, '2022-06-10 03:59:51', '2022-06-10 03:59:51'),
(80, 'Ulaanbaatar Standard Time', 'UST', 8, '(UTC+08:00) Ulaanbaatar', 'Asia/Ulaanbaatar', 0, '2022-06-10 03:59:52', '2022-06-10 03:59:52'),
(81, 'North Asia East Standard Time', 'NAEST', 9, '(UTC+09:00) Irkutsk', 'Asia/Irkutsk', 0, '2022-06-10 03:59:52', '2022-06-10 03:59:52'),
(82, 'Tokyo Standard Time', 'TST', 9, '(UTC+09:00) Dili, Osaka, Palau, Sapporo, Tokyo', 'Asia/Tokyo', 0, '2022-06-10 03:59:52', '2022-06-10 03:59:52'),
(83, 'Korea Standard Time', 'KST', 9, '(UTC+09:00) Pyongyang, Seoul', 'Asia/Seoul', 0, '2022-06-10 03:59:52', '2022-06-10 03:59:52'),
(84, 'Cen. Australia Standard Time', 'CAST', 10, '(UTC+09:30) Adelaide', 'Australia/Adelaide', 0, '2022-06-10 03:59:52', '2022-06-10 03:59:52'),
(85, 'AUS Central Standard Time', 'ACST', 10, '(UTC+09:30) Darwin', 'Australia/Darwin', 0, '2022-06-10 03:59:52', '2022-06-10 03:59:52'),
(86, 'E. Australia Standard Time', 'EAST', 10, '(UTC+10:00) Brisbane', 'Australia/Brisbane', 0, '2022-06-10 03:59:52', '2022-06-10 03:59:52'),
(87, 'AUS Eastern Standard Time', 'AEST', 10, '(UTC+10:00) Canberra, Melbourne, Sydney', 'Australia/Sydney', 0, '2022-06-10 03:59:52', '2022-06-10 03:59:52'),
(88, 'West Pacific Standard Time', 'WPST', 10, '(UTC+10:00) Guam, Port Moresby', 'Pacific/Guam', 0, '2022-06-10 03:59:52', '2022-06-10 03:59:52'),
(89, 'Tasmania Standard Time', 'TST', 10, '(UTC+10:00) Hobart', 'Australia/Hobart', 0, '2022-06-10 03:59:52', '2022-06-10 03:59:52'),
(90, 'Yakutsk Standard Time', 'YST', 10, '(UTC+10:00) Yakutsk', 'Asia/Yakutsk', 0, '2022-06-10 03:59:52', '2022-06-10 03:59:52'),
(91, 'Central Pacific Standard Time', 'CPST', 11, '(UTC+11:00) Solomon Is., New Caledonia', 'Pacific/Guadalcanal', 0, '2022-06-10 03:59:53', '2022-06-10 03:59:53'),
(92, 'Vladivostok Standard Time', 'VST', 11, '(UTC+11:00) Vladivostok', 'Asia/Vladivostok', 0, '2022-06-10 03:59:53', '2022-06-10 03:59:53'),
(93, 'New Zealand Standard Time', 'NZST', 12, '(UTC+12:00) Auckland, Wellington', 'Antarctica/McMurdo', 0, '2022-06-10 03:59:53', '2022-06-10 03:59:53'),
(94, 'UTC+12', 'U', 12, '(UTC+12:00) Coordinated Universal Time+12', 'Pacific/Tarawa', 0, '2022-06-10 03:59:53', '2022-06-10 03:59:53'),
(95, 'Fiji Standard Time', 'FST', 12, '(UTC+12:00) Fiji', 'Pacific/Fiji', 0, '2022-06-10 03:59:53', '2022-06-10 03:59:53'),
(96, 'Magadan Standard Time', 'MST', 12, '(UTC+12:00) Magadan', 'Asia/Magadan', 0, '2022-06-10 03:59:53', '2022-06-10 03:59:53'),
(97, 'Samoa/Tonga/Kamchatka Standard Time', 'SST', 13, '(UTC+13:00) Samoa, Tongatapu, Fakaofo, Enderbury', 'Pacific/Apia', 0, '2022-06-10 03:59:53', '2022-06-10 03:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `com_id`, `branch_id`, `department_id`, `role_id`, `profile_id`, `employee_id`, `name`, `email`, `level`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, NULL, NULL, 1, NULL, 'Super Admin', 'superadmin@demo.com', 'super_admin', 1, NULL, '$2y$10$1evQF2Vt8.E5n2EZ6CWEl.pG6lnQxQJWt7I00lAyXKBzBo4zlbDzy', NULL, '2022-06-10 03:59:56', '2022-06-10 03:59:56', NULL),
(2, NULL, NULL, NULL, 1, 2, NULL, 'Admin', 'admin@demo.com', 'admin_admin', 1, NULL, '$2y$10$hSQyDXJUzsJhCUyAlGxPnezzoSf0ejMndWrRDnQoTCw7ZCf4i7qMu', NULL, '2022-06-10 03:59:57', '2022-06-10 03:59:57', NULL),
(3, 1, NULL, NULL, 2, NULL, NULL, 'Demo Company', 'company@demo.com', 'company_admin', 1, NULL, '$2y$10$bGpYZDJE9bPlcEGT.YG8fOoJRDtYttZoEEeiusF60f6iOalDCKsb6', NULL, NULL, NULL, NULL),
(4, NULL, 1, NULL, 3, NULL, NULL, 'Demo Branch', 'branch@demo.com', 'branch_admin', 1, NULL, '$2y$10$tUUParH.6mrkFMDduoj/jOp4MQEuG1GyKGWhZC38vcMwnmd0faUwW', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zkteco_devices`
--

CREATE TABLE `zkteco_devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `port` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '4370',
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_log_com_id_foreign` (`com_id`),
  ADD KEY `activity_log_branch_id_foreign` (`branch_id`),
  ADD KEY `activity_log_user_id_foreign` (`user_id`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_com_id_foreign` (`com_id`),
  ADD KEY `attendances_branch_id_foreign` (`branch_id`),
  ADD KEY `attendances_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `attendance_deduction_policies`
--
ALTER TABLE `attendance_deduction_policies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_deduction_policies_com_id_foreign` (`com_id`);

--
-- Indexes for table `attendance_log`
--
ALTER TABLE `attendance_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_log_com_id_foreign` (`com_id`),
  ADD KEY `attendance_log_branch_id_foreign` (`branch_id`),
  ADD KEY `attendance_log_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `branches_email_unique` (`email`),
  ADD KEY `branches_com_id_foreign` (`com_id`);

--
-- Indexes for table `branch_settings`
--
ALTER TABLE `branch_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_settings_com_id_foreign` (`com_id`),
  ADD KEY `branch_settings_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_email_unique` (`email`);

--
-- Indexes for table `company_settings`
--
ALTER TABLE `company_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_settings_com_id_foreign` (`com_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countries_timezone_id_foreign` (`timezone_id`),
  ADD KEY `countries_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_com_id_foreign` (`com_id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `designations_com_id_foreign` (`com_id`),
  ADD KEY `designations_department_id_foreign` (`department_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD KEY `employees_com_id_foreign` (`com_id`),
  ADD KEY `employees_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `employee_educations`
--
ALTER TABLE `employee_educations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_educations_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `employee_types`
--
ALTER TABLE `employee_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_types_com_id_foreign` (`com_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `holidays_com_id_foreign` (`com_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_out_logs`
--
ALTER TABLE `in_out_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `leave_applications`
--
ALTER TABLE `leave_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_applications_com_id_foreign` (`com_id`),
  ADD KEY `leave_applications_branch_id_foreign` (`branch_id`),
  ADD KEY `leave_applications_type_id_foreign` (`type_id`),
  ADD KEY `leave_applications_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `leave_policies`
--
ALTER TABLE `leave_policies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_policies_com_id_foreign` (`com_id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_types_com_id_foreign` (`com_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_submodule_id_foreign` (`submodule_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profiles_email_unique` (`email`),
  ADD KEY `profiles_com_id_foreign` (`com_id`),
  ADD KEY `profiles_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salaries_salary_rule_id_foreign` (`salary_rule_id`),
  ADD KEY `salaries_com_id_foreign` (`com_id`),
  ADD KEY `salaries_branch_id_foreign` (`branch_id`),
  ADD KEY `salaries_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `salary_rules`
--
ALTER TABLE `salary_rules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salary_rules_com_id_foreign` (`com_id`),
  ADD KEY `salary_rules_designation_id_foreign` (`designation_id`);

--
-- Indexes for table `salary_rule_structures`
--
ALTER TABLE `salary_rule_structures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salary_rule_structures_salary_rule_id_foreign` (`salary_rule_id`),
  ADD KEY `salary_rule_structures_salary_structure_id_foreign` (`salary_structure_id`);

--
-- Indexes for table `salary_structures`
--
ALTER TABLE `salary_structures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salary_structures_com_id_foreign` (`com_id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shifts_com_id_foreign` (`com_id`);

--
-- Indexes for table `sms_gateway`
--
ALTER TABLE `sms_gateway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_log`
--
ALTER TABLE `sms_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sms_log_com_id_foreign` (`com_id`),
  ADD KEY `sms_log_branch_id_foreign` (`branch_id`),
  ADD KEY `sms_log_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `submodules`
--
ALTER TABLE `submodules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submodules_module_id_foreign` (`module_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taxes_com_id_foreign` (`com_id`);

--
-- Indexes for table `timezones`
--
ALTER TABLE `timezones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_com_id_foreign` (`com_id`),
  ADD KEY `users_branch_id_foreign` (`branch_id`),
  ADD KEY `users_department_id_foreign` (`department_id`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_profile_id_foreign` (`profile_id`),
  ADD KEY `users_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `zkteco_devices`
--
ALTER TABLE `zkteco_devices`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_deduction_policies`
--
ALTER TABLE `attendance_deduction_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_log`
--
ALTER TABLE `attendance_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branch_settings`
--
ALTER TABLE `branch_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_settings`
--
ALTER TABLE `company_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=895;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_educations`
--
ALTER TABLE `employee_educations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_types`
--
ALTER TABLE `employee_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `in_out_logs`
--
ALTER TABLE `in_out_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_applications`
--
ALTER TABLE `leave_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_policies`
--
ALTER TABLE `leave_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=449;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary_rules`
--
ALTER TABLE `salary_rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary_rule_structures`
--
ALTER TABLE `salary_rule_structures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary_structures`
--
ALTER TABLE `salary_structures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_gateway`
--
ALTER TABLE `sms_gateway`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_log`
--
ALTER TABLE `sms_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submodules`
--
ALTER TABLE `submodules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timezones`
--
ALTER TABLE `timezones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `zkteco_devices`
--
ALTER TABLE `zkteco_devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD CONSTRAINT `activity_log_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `activity_log_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `activity_log_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `attendances_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `attendances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `attendance_deduction_policies`
--
ALTER TABLE `attendance_deduction_policies`
  ADD CONSTRAINT `attendance_deduction_policies_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attendance_log`
--
ALTER TABLE `attendance_log`
  ADD CONSTRAINT `attendance_log_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `attendance_log_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `attendance_log_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `branch_settings`
--
ALTER TABLE `branch_settings`
  ADD CONSTRAINT `branch_settings_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `branch_settings_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `company_settings`
--
ALTER TABLE `company_settings`
  ADD CONSTRAINT `company_settings_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `countries`
--
ALTER TABLE `countries`
  ADD CONSTRAINT `countries_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `countries_timezone_id_foreign` FOREIGN KEY (`timezone_id`) REFERENCES `timezones` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `designations`
--
ALTER TABLE `designations`
  ADD CONSTRAINT `designations_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `designations_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employees_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `employee_educations`
--
ALTER TABLE `employee_educations`
  ADD CONSTRAINT `employee_educations_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_types`
--
ALTER TABLE `employee_types`
  ADD CONSTRAINT `employee_types_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `holidays`
--
ALTER TABLE `holidays`
  ADD CONSTRAINT `holidays_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `leave_applications`
--
ALTER TABLE `leave_applications`
  ADD CONSTRAINT `leave_applications_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `leave_applications_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `leave_applications_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `leave_applications_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `leave_types` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `leave_policies`
--
ALTER TABLE `leave_policies`
  ADD CONSTRAINT `leave_policies_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD CONSTRAINT `leave_types_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_submodule_id_foreign` FOREIGN KEY (`submodule_id`) REFERENCES `submodules` (`id`);

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `profiles_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salaries`
--
ALTER TABLE `salaries`
  ADD CONSTRAINT `salaries_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `salaries_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `salaries_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `salaries_salary_rule_id_foreign` FOREIGN KEY (`salary_rule_id`) REFERENCES `salary_rules` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `salary_rules`
--
ALTER TABLE `salary_rules`
  ADD CONSTRAINT `salary_rules_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `salary_rules_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `salary_rule_structures`
--
ALTER TABLE `salary_rule_structures`
  ADD CONSTRAINT `salary_rule_structures_salary_rule_id_foreign` FOREIGN KEY (`salary_rule_id`) REFERENCES `salary_rules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `salary_rule_structures_salary_structure_id_foreign` FOREIGN KEY (`salary_structure_id`) REFERENCES `salary_structures` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salary_structures`
--
ALTER TABLE `salary_structures`
  ADD CONSTRAINT `salary_structures_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `shifts`
--
ALTER TABLE `shifts`
  ADD CONSTRAINT `shifts_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `sms_log`
--
ALTER TABLE `sms_log`
  ADD CONSTRAINT `sms_log_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sms_log_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sms_log_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `submodules`
--
ALTER TABLE `submodules`
  ADD CONSTRAINT `submodules_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`);

--
-- Constraints for table `taxes`
--
ALTER TABLE `taxes`
  ADD CONSTRAINT `taxes_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_com_id_foreign` FOREIGN KEY (`com_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
