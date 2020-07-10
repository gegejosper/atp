-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 27, 2020 at 01:05 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atpcaltex`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountbills`
--

CREATE TABLE `accountbills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `billnum` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billdate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billstatus` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `accountid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branchid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalamount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prevbal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accountbills`
--

INSERT INTO `accountbills` (`id`, `billnum`, `billdate`, `balance`, `discount`, `amount`, `billstatus`, `created_at`, `updated_at`, `accountid`, `userid`, `branchid`, `totalamount`, `prevbal`) VALUES
(13, '1', '09/01/2019 - 09/30/2019', '0', '625', '7011', 'paid', '2019-10-03 01:15:29', '2019-10-03 01:20:21', '5', '9', '13', '6386', '0'),
(14, '2', '10/01/2019 - 10/15/2019', '0', '76', '4290', 'paid', '2019-10-03 01:18:41', '2019-12-08 20:27:41', '5', '9', '13', '4214', '6386'),
(15, '3', '10/01/2019 - 10/31/2019', '2214', '76', '4290', 'merge', '2020-01-26 06:39:09', '2020-01-26 07:04:38', '5', '9', '13', '4214', '0'),
(20, '4', '01/01/2020 - 01/15/2020', '714', '0', '0', 'merge', '2020-01-26 07:04:38', '2020-01-28 01:39:15', '5', '9', '13', '2214', '2214'),
(21, '5', '01/16/2020 - 01/31/2020', '0', '0', '0', 'paid', '2020-01-28 01:39:15', '2020-02-05 03:14:36', '5', '9', '13', '714', '714'),
(22, '6', '02/01/2020 - 02/15/2020', '0', '0', '0', 'not paid', '2020-02-05 03:17:26', '2020-02-05 03:17:26', '5', '9', '13', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `accountcredits`
--

CREATE TABLE `accountcredits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `accountid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creditdate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoicenum` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unitprice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `platenumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credittype` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accountcredits`
--

INSERT INTO `accountcredits` (`id`, `accountid`, `creditdate`, `invoicenum`, `quantity`, `product`, `unitprice`, `amount`, `platenumber`, `credittype`, `created_at`, `updated_at`) VALUES
(1, '  5', '08-30-2019', '2332', '234', '4', '45', '2344', '233', 'Petrol', '2019-08-30 00:32:25', '2019-08-30 00:32:25'),
(2, '  5', '08-30-2019', '2322', '20', '15', '232', '2220', 'n/a', 'Product', '2019-08-30 00:32:25', '2019-08-30 00:32:25'),
(3, '  5', '09-04-2019', '122', '34', '1', '46', '344', '3333', 'Petrol', '2019-09-04 01:39:59', '2019-09-04 01:39:59'),
(4, '  5', '09-04-2019', '233', '1', '15', '23', '23', 'n/a', 'Product', '2019-09-04 01:40:00', '2019-09-04 01:40:00'),
(5, '  5', '09-18-2019', '123', '3', '1', '46', '233', '1233', 'Petrol', '2019-09-17 19:06:21', '2019-09-17 19:06:21'),
(6, '  5', '09-18-2019', '234', '2', '15', '23', '234', 'n/a', 'Product', '2019-09-17 19:06:21', '2019-09-17 19:06:21'),
(7, '  5', '09-30-2019', '32444', '355', '1', '46', '5566', '333', 'Petrol', '2019-09-30 06:13:22', '2019-09-30 06:13:22'),
(8, '  5', '09-30-2019', '34566', '888', '15', '345', '234', 'n/a', 'Product', '2019-09-30 06:13:22', '2019-09-30 06:13:22'),
(9, '  5', '09-30-2019', '222222', '233', '4', '46', '333', '2333', 'Petrol', '2019-09-30 06:18:44', '2019-09-30 06:18:44'),
(10, '  5', '09-30-2019', '34444', '23', '15', '33', '44', 'n/a', 'Product', '2019-09-30 06:18:44', '2019-09-30 06:18:44'),
(11, '  5', '10-01-2019', '456644', '67', '4', '45', '3344', '466', 'Petrol', '2019-10-01 06:20:18', '2019-10-01 06:20:18'),
(12, '  5', '10-01-2019', '234556', '566', '15', '334', '344', 'n/a', 'Product', '2019-10-01 06:20:20', '2019-10-01 06:20:20'),
(13, '  5', '10-02-2019', '89222', '3', '4', '23', '69.000', '233', 'Petrol', '2019-10-01 23:10:36', '2019-10-01 23:10:36'),
(14, '  5', '10-02-2019', '54433', '3', '15', '33', '99.000', 'n/a', 'Product', '2019-10-01 23:10:36', '2019-10-01 23:10:36'),
(15, '  5', '10-02-2019', '673', '3', '4', '34', '102.000', '334', 'Petrol', '2019-10-02 00:22:17', '2019-10-02 00:22:17'),
(16, '  5', '10-02-2019', '5666', '5', '15', '23', '115.000', 'n/a', 'Product', '2019-10-02 00:22:17', '2019-10-02 00:22:17'),
(17, '  5', '10-02-2019', '673', '3', '4', '34', '102.000', '334', 'Petrol', '2019-10-02 00:31:29', '2019-10-02 00:31:29'),
(18, '  5', '10-02-2019', '5666', '5', '15', '23', '115.000', 'n/a', 'Product', '2019-10-02 00:31:29', '2019-10-02 00:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactnum` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `branchid`, `fname`, `lname`, `mname`, `address`, `contactnum`, `discount`, `tax`, `created_at`, `updated_at`) VALUES
(2, '11', 'GEGEJOSPER', 'CENIZA', 'B', 'SDADSA', '', '122333', '12222', '2019-06-13 08:02:12', '2019-06-13 08:28:54'),
(4, '11', 'KENNETH', 'MAYOL', 'R', 'SADA', '', 'asdsa', 'sadas', '2019-06-13 08:34:11', '2019-06-13 08:36:00'),
(5, '13', 'ARCHIE', 'YONGCO', 'TE', 'AURORA', '', '1', '274156700', '2019-07-17 01:47:05', '2019-07-17 01:47:05');

-- --------------------------------------------------------

--
-- Table structure for table `branchcredits`
--

CREATE TABLE `branchcredits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accountid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gasname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `liters` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unitprice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creditplatenum` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creditdate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creditsession` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creditstatus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branchcredits`
--

INSERT INTO `branchcredits` (`id`, `branchid`, `userid`, `accountid`, `account`, `gasname`, `invoice`, `liters`, `unitprice`, `amount`, `creditplatenum`, `creditdate`, `creditsession`, `creditstatus`, `created_at`, `updated_at`) VALUES
(1, '13', '8', '5', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '2344', '23', '45', '233', '2333', '07-28-2019', '7HRWNSVKQN', 'INITIAL', '2019-07-28 03:51:09', '2019-07-28 03:51:09'),
(3, '13', '8', '5', 'YONGCO, ARCHIE,  5', 'Premium, 4', '0909', '32', '45', '567', '3433', '07-28-2019', '7HRWNSVKQN', 'INITIAL', '2019-07-28 04:22:05', '2019-07-28 04:22:05'),
(7, '13', '8', '5', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '6433', '23', '34', '500', '34sss', '08-06-2019', 'SNKPKNTR2Z', 'INITIAL', '2019-08-05 19:22:21', '2019-08-05 19:22:21'),
(8, '13', '8', '5', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '23232', '233', '34', '2222', '233', '08-06-2019', 'KS5UDDFGIF', 'INITIAL', '2019-08-05 23:24:03', '2019-08-05 23:24:03'),
(9, '13', '8', '5', 'YONGCO, ARCHIE,  5', 'Desiel, 1', 'dsadas', '23', '33', '42', 'dsdasd', '08-13-2019', 'QYFZPY2WX8', 'INITIAL', '2019-08-12 21:35:57', '2019-08-12 21:35:57'),
(10, '13', '8', '5', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '2311', '23322', '66', '2333', '2333', '08-26-2019', 'DR7DVVAH4E', 'INITIAL', '2019-08-25 16:44:52', '2019-08-25 16:44:52'),
(11, '13', '8', '5', 'YONGCO, ARCHIE,  5', 'Premium, 4', '322', '34', '55', '3344', '1233', '08-29-2019', 'EIGJB59PF4', 'INITIAL', '2019-08-29 00:19:11', '2019-08-29 00:19:11'),
(12, '13', '8', '5', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '200', '333', '44', '3333', '2333', '08-30-2019', '9D9QVZAJJE', 'FINAL', '2019-08-29 20:19:24', '2019-08-29 23:27:17'),
(13, '13', '8', '5', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '2332', '234', '33', '2344', '233', '08-30-2019', '3ASRWED04P', 'FINAL', '2019-08-30 00:25:55', '2019-08-30 00:32:25'),
(14, '13', '8', '5', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '1233', '3', '33', '322', '233', '09-03-2019', 'XCXETHGPLX', 'INITIAL', '2019-09-02 23:26:11', '2019-09-02 23:26:11'),
(17, '13', '8', '5', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '122', '34', '33', '344', '3333', '09-04-2019', 'GMZDHDEIU9', 'FINAL', '2019-09-04 01:26:56', '2019-09-04 01:40:00'),
(18, '13', '8', '5', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '123', '3', '43', '233', '1233', '09-18-2019', 'DSGPDMCJWR', 'FINAL', '2019-09-17 18:46:19', '2019-09-17 19:06:21'),
(19, '13', '8', 'ARCHIE', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '32444', '355', '46', '5566', '333', '09-30-2019', 'TMSC7TW4JR', 'FINAL', '2019-09-30 06:11:56', '2019-09-30 06:13:22'),
(20, '13', '8', 'ARCHIE', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '222222', '233', '54', '333', '2333', '09-30-2019', 'K8M20ZQU4K', 'FINAL', '2019-09-30 06:16:13', '2019-09-30 06:18:44'),
(21, '13', '8', 'ARCHIE', 'YONGCO, ARCHIE,  5', 'Premium, 4', '456644', '67', '34', '3344', '466', '10-01-2019', '6AP79TFSEC', 'FINAL', '2019-10-01 06:18:29', '2019-10-01 06:20:24'),
(22, '13', '8', 'ARCHIE', 'YONGCO, ARCHIE,  5', 'Desiel, 61, 50', '3445', '4', '34', '136.000', '455', '10-02-2019', 'GW3L9MQOD0', 'INITIAL', '2019-10-01 16:23:09', '2019-10-01 16:23:09'),
(23, '13', '8', 'ARCHIE', 'YONGCO, ARCHIE,  5', 'Desiel, 61, 50', '89222', '3', '23', '69.000', '233', '10-02-2019', '6TRJZAQ6XU', 'FINAL', '2019-10-01 23:09:44', '2019-10-01 23:10:36'),
(24, '13', '8', 'ARCHIE', 'YONGCO, ARCHIE,  5', 'Desiel, 61, 50', '673', '3', '34', '102.000', '334', '10-02-2019', '2RA6Y2GOHY', 'FINAL', '2019-10-02 00:20:58', '2019-10-02 00:31:29'),
(25, '13', '10', 'ARCHIE', 'YONGCO, ARCHIE,  5', 'Diesel, 1, 50', '0000sdsa', '40', '47', '1880.000', '00000', '02-05-2020', 'SD1BSEBRTZ', 'INITIAL', '2020-02-05 03:16:05', '2020-02-05 03:16:05');

-- --------------------------------------------------------

--
-- Table structure for table `branchdippings`
--

CREATE TABLE `branchdippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gasid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dipvolume` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dipopenvolume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dipclosevolume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deliveryvolume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dippingdate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dippingsession` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branchdippings`
--

INSERT INTO `branchdippings` (`id`, `branchid`, `gasid`, `dipvolume`, `dipopenvolume`, `dipclosevolume`, `deliveryvolume`, `dippingdate`, `type`, `status`, `created_at`, `updated_at`, `dippingsession`) VALUES
(82, '11', '55', '5000', '5000', '30000', '20000', '12-06-2019', 'Dipping', 'Final', '2019-12-05 23:28:00', '2019-12-05 23:28:52', 'CH11CRA608'),
(83, '11', '56', '10000', '10000', '40000', '20000', '12-06-2019', 'Dipping', 'Final', '2019-12-05 23:28:22', '2019-12-05 23:28:52', 'CH11CRA608'),
(84, '11', '57', '9000', '1000', '40000', '30000', '12-06-2019', 'Dipping', 'Final', '2019-12-05 23:28:45', '2019-12-05 23:28:52', 'CH11CRA608'),
(87, '13', '61', '-20000', '50000', '30000', '0', '01-26-2020', 'Dipping', 'Initial', '2020-01-26 07:36:32', '2020-01-26 07:36:32', 'MHSWPANH07');

-- --------------------------------------------------------

--
-- Table structure for table `branchdiscounts`
--

CREATE TABLE `branchdiscounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gasname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `platenum` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discountdate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discountsession` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branchdiscounts`
--

INSERT INTO `branchdiscounts` (`id`, `branchid`, `userid`, `account`, `gasname`, `amount`, `platenum`, `discountdate`, `discountsession`, `status`, `created_at`, `updated_at`) VALUES
(2, '13', '8', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '45', '2332', '08-06-2019', 'SNKPKNTR2Z', 'INITIAL', '2019-08-05 18:13:17', '2019-08-05 18:13:17'),
(4, '13', '8', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '3443', '322', '08-06-2019', 'KS5UDDFGIF', 'INITIAL', '2019-08-05 23:24:35', '2019-08-05 23:24:35'),
(5, '13', '8', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '3222', '23232', '08-13-2019', 'QYFZPY2WX8', 'INITIAL', '2019-08-12 21:36:04', '2019-08-12 21:36:04'),
(6, '13', '8', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '2', '23344', '08-26-2019', 'DR7DVVAH4E', 'INITIAL', '2019-08-25 16:45:04', '2019-08-25 16:45:04'),
(7, '13', '8', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '30', '22233', '08-29-2019', 'EIGJB59PF4', 'INITIAL', '2019-08-29 00:19:25', '2019-08-29 00:19:25'),
(8, '13', '8', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '155', '1344', '08-30-2019', '9D9QVZAJJE', 'FINAL', '2019-08-29 20:19:35', '2019-08-29 23:27:17'),
(9, '13', '8', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '332', '233', '08-30-2019', '3ASRWED04P', 'FINAL', '2019-08-30 00:26:01', '2019-08-30 00:32:25'),
(10, '13', '8', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '33', '233', '09-03-2019', 'XCXETHGPLX', 'INITIAL', '2019-09-02 23:26:24', '2019-09-02 23:26:24'),
(11, '13', '8', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '23', '2wuew', '09-04-2019', 'GMZDHDEIU9', 'FINAL', '2019-09-04 01:27:24', '2019-09-04 01:40:00'),
(12, '13', '8', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '3', '234', '09-18-2019', 'DSGPDMCJWR', 'FINAL', '2019-09-17 18:46:26', '2019-09-17 19:06:21'),
(13, '13', '8', 'YONGCO, ARCHIE,  5', 'Silver, 3', '2', 'ew322', '10-01-2019', '6AP79TFSEC', 'FINAL', '2019-10-01 06:19:00', '2019-10-01 06:20:29'),
(14, '13', '8', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '34', '3222', '10-02-2019', '6TRJZAQ6XU', 'FINAL', '2019-10-01 23:09:52', '2019-10-01 23:10:36'),
(15, '13', '8', 'YONGCO, ARCHIE,  5', 'Desiel, 1', '23', '2355', '10-02-2019', '2RA6Y2GOHY', 'FINAL', '2019-10-02 00:21:17', '2019-10-02 00:31:31');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branchname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branchname`, `created_at`, `updated_at`) VALUES
(11, 'Aurora', '2019-04-07 23:58:17', '2019-04-07 23:58:17'),
(12, 'Pagadian', '2019-06-14 05:57:02', '2019-06-14 05:57:02'),
(13, 'Cebu', '2019-07-17 01:24:26', '2019-07-17 01:24:26'),
(14, 'Tubod', '2020-01-26 06:27:21', '2020-01-26 06:27:21'),
(15, 'Manila', '2020-02-05 02:34:57', '2020-02-05 02:34:57');

-- --------------------------------------------------------

--
-- Table structure for table `branchgases`
--

CREATE TABLE `branchgases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gasid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branchgases`
--

INSERT INTO `branchgases` (`id`, `branchid`, `gasid`, `volume`, `price`, `status`, `created_at`, `updated_at`) VALUES
(55, '11', '1', '35000', '51', 'active', '2019-07-17 23:07:06', '2020-02-14 09:20:29'),
(56, '11', '3', '40000', '40', 'active', '2019-07-17 23:07:07', '2019-12-05 23:28:52'),
(57, '11', '4', '40000', '45', 'active', '2019-07-17 23:07:08', '2019-12-05 23:28:52'),
(58, '12', '1', '40000', '50', 'active', '2019-07-19 05:18:14', '2019-07-19 13:00:20'),
(59, '12', '3', '37000', '40', 'active', '2019-07-19 05:18:16', '2019-07-19 13:00:20'),
(60, '12', '4', '25000', '48', 'active', '2019-07-19 05:18:17', '2019-07-19 13:00:20'),
(61, '13', '1', '24000', '50', 'active', '2019-07-21 04:28:57', '2019-07-21 04:29:15'),
(62, '13', '3', '24000', '40', 'active', '2019-07-21 04:28:59', '2019-07-21 04:29:25'),
(63, '13', '4', '24000', '45', 'active', '2019-07-21 04:28:59', '2019-07-21 04:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `branchothers`
--

CREATE TABLE `branchothers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descsession` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `othersdate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branchothers`
--

INSERT INTO `branchothers` (`id`, `branchid`, `userid`, `desc`, `amount`, `descsession`, `status`, `othersdate`, `created_at`, `updated_at`) VALUES
(1, '13', '8', '32323', '222', 'QYFZPY2WX8', 'INITIAL', '08-13-2019', '2019-08-12 21:37:40', '2019-08-12 21:37:40'),
(2, '13', '8', '2eew', '233', 'QYFZPY2WX8', 'INITIAL', '08-13-2019', '2019-08-12 21:51:01', '2019-08-12 21:51:01'),
(10, '13', '8', 'Borrow', '1223', 'DR7DVVAH4E', 'INITIAL', '08-26-2019', '2019-08-25 16:47:12', '2019-08-25 16:47:12'),
(11, '13', '8', 'Borw', '233', 'EIGJB59PF4', 'INITIAL', '08-29-2019', '2019-08-29 00:20:08', '2019-08-29 00:20:08'),
(12, '13', '8', 'Borrow', '233', '9D9QVZAJJE', 'FINAL', '08-30-2019', '2019-08-29 20:20:07', '2019-08-29 23:27:17'),
(13, '13', '8', '232', '344', '3ASRWED04P', 'FINAL', '08-30-2019', '2019-08-30 00:30:02', '2019-08-30 00:32:25'),
(14, '13', '8', 'Pay', '233', 'XCXETHGPLX', 'INITIAL', '09-03-2019', '2019-09-02 23:27:07', '2019-09-02 23:27:07'),
(15, '13', '8', 'Petty Cash', '200', 'GMZDHDEIU9', 'FINAL', '09-04-2019', '2019-09-04 01:33:47', '2019-09-04 01:40:00'),
(16, '13', '8', 'Petty Cash', '400', 'DSGPDMCJWR', 'FINAL', '09-18-2019', '2019-09-17 18:47:18', '2019-09-17 19:06:21');

-- --------------------------------------------------------

--
-- Table structure for table `branchpayments`
--

CREATE TABLE `branchpayments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accountid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branchpayments`
--

INSERT INTO `branchpayments` (`id`, `userid`, `branchid`, `billid`, `accountid`, `payment`, `balance`, `created_at`, `updated_at`) VALUES
(7, '8', '13', '13', '5', '2000', '4386', '2019-10-03 01:17:24', '2019-10-03 01:17:24'),
(8, '8', '13', '13', '5', '4386', '0', '2019-10-03 01:20:20', '2019-10-03 01:20:20'),
(9, '8', '13', '14', '5', '2000', '2214', '2019-10-07 05:05:27', '2019-10-07 05:05:27'),
(10, '8', '13', '14', '5', '1000', '1214', '2019-10-07 05:05:46', '2019-10-07 05:05:46'),
(11, '8', '13', '14', '5', '100', '1114', '2019-10-07 05:09:38', '2019-10-07 05:09:38'),
(12, '8', '13', '14', '5', '100', '1014', '2019-10-07 05:09:50', '2019-10-07 05:09:50'),
(13, '8', '13', '14', '5', '1014', '0', '2019-12-08 20:27:40', '2019-12-08 20:27:40'),
(14, '10', '13', '15', '5', '2000', '2214', '2020-01-26 06:40:17', '2020-01-26 06:40:17'),
(15, '1', '13', '20', '5', '1000', '1214', '2020-01-27 06:19:12', '2020-01-27 06:19:12'),
(16, '1', '13', '20', '5', '500', '714', '2020-01-28 01:38:53', '2020-01-28 01:38:53'),
(17, '10', '13', '21', '5', '714', '0', '2020-02-05 03:14:36', '2020-02-05 03:14:36');

-- --------------------------------------------------------

--
-- Table structure for table `branchproducts`
--

CREATE TABLE `branchproducts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branchproducts`
--

INSERT INTO `branchproducts` (`id`, `branchid`, `productid`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(10, '11', '15', '8', '3', '2019-05-07 22:37:26', '2019-05-18 22:37:55'),
(11, '13', '15', '50', '50', '2019-07-17 01:49:20', '2019-07-22 23:32:40'),
(12, '13', '16', '50', '60', '2019-07-17 01:54:08', '2019-07-22 23:32:50');

-- --------------------------------------------------------

--
-- Table structure for table `branchpumps`
--

CREATE TABLE `branchpumps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pumpid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gasid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branchreports`
--

CREATE TABLE `branchreports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reportdate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sessionrecord` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branchreports`
--

INSERT INTO `branchreports` (`id`, `reportdate`, `sessionrecord`, `branchid`, `userid`, `created_at`, `updated_at`) VALUES
(1, '10-02-19', '2RA6Y2GOHY', '13', '8', '2019-10-02 00:31:31', '2019-10-02 00:31:31');

-- --------------------------------------------------------

--
-- Table structure for table `branchsales`
--

CREATE TABLE `branchsales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paymenttype` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saledate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salesession` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branchsales`
--

INSERT INTO `branchsales` (`id`, `branchid`, `userid`, `invoice`, `account`, `product`, `amount`, `price`, `quantity`, `paymenttype`, `saledate`, `salesession`, `status`, `created_at`, `updated_at`) VALUES
(4, '13', '8', '3223', 'CASH, CASH, 0', 'Delo Oil, 11', '333', '2334', '44', 'CASH', '08-06-2019', 'KS5UDDFGIF', 'INITIAL', '2019-08-06 00:52:26', '2019-08-06 00:52:26'),
(5, '13', '8', '3222', 'CASH, CASH, 0', 'Delo Oil, 11', '333', '2233', '322', 'CASH', '08-07-2019', 'QK8OOQ1QVM', 'INITIAL', '2019-08-06 20:30:16', '2019-08-06 20:30:16'),
(6, '13', '8', '1212133', 'CASH, CASH, 0', 'Delo Oil, 11', '2344', '232', '23', 'CASH', '08-07-2019', 'QK8OOQ1QVM', 'INITIAL', '2019-08-06 20:37:39', '2019-08-06 20:37:39'),
(9, '13', '8', '1212', 'YONGCO, ARCHIE,  5', 'Delo Oil, 11', '233', '232', '233', 'CREDIT', '08-07-2019', 'QK8OOQ1QVM', 'INITIAL', '2019-08-06 20:45:03', '2019-08-06 20:45:03'),
(12, '13', '8', '3323', 'CASH, CASH, 0', 'Delo Oil, 11', '221', '232', '322', 'CASH', '08-13-2019', 'QYFZPY2WX8', 'INITIAL', '2019-08-12 21:45:57', '2019-08-12 21:45:57'),
(13, '13', '8', '4334', 'YONGCO, ARCHIE,  5', 'Delo Oil, 11', '223', '333', '445', 'CREDIT', '08-13-2019', 'QYFZPY2WX8', 'INITIAL', '2019-08-12 22:01:32', '2019-08-12 22:01:32'),
(14, '13', '8', '2322', 'CASH, CASH, 0', 'Delo Oil, 11', '22', '233', '332', 'CASH', '08-26-2019', 'DR7DVVAH4E', 'INITIAL', '2019-08-25 16:45:16', '2019-08-25 16:45:16'),
(15, '13', '8', '433', 'YONGCO, ARCHIE,  5', 'Delo Oil, 11', '445', '34', '3', 'CREDIT', '08-26-2019', 'DR7DVVAH4E', 'INITIAL', '2019-08-25 16:45:34', '2019-08-25 16:45:34'),
(16, '13', '8', '332', 'CASH, CASH, 0', 'Delo Oil, 11', '42', '2', '3', 'CASH', '08-29-2019', 'EIGJB59PF4', 'INITIAL', '2019-08-29 00:19:35', '2019-08-29 00:19:35'),
(17, '13', '8', '2322', 'YONGCO, ARCHIE,  5', 'Delo Oil, 11', '344', '23', '12', 'CREDIT', '08-29-2019', 'EIGJB59PF4', 'INITIAL', '2019-08-29 00:19:58', '2019-08-29 00:19:58'),
(18, '13', '8', '2333', 'CASH, CASH, 0', 'Delo Oil, 11', '233', '23', '3', 'CASH', '08-30-2019', '9D9QVZAJJE', 'FINAL', '2019-08-29 20:19:46', '2019-08-29 23:27:17'),
(19, '13', '8', '23344', 'YONGCO, ARCHIE,  5', 'Delo Oil, 11', '0', '233', '1', 'CREDIT', '08-30-2019', '9D9QVZAJJE', 'FINAL', '2019-08-29 20:20:00', '2019-08-29 23:27:17'),
(20, '13', '8', '22333', 'CASH, CASH, 0', 'Delo Oil, 11', '3222', '23', '30', 'CASH', '08-30-2019', '3ASRWED04P', 'FINAL', '2019-08-30 00:26:30', '2019-08-30 00:32:25'),
(21, '13', '8', '2322', 'YONGCO, ARCHIE,  5', 'Delo Oil, 11', '2220', '232', '20', 'CREDIT', '08-30-2019', '3ASRWED04P', 'FINAL', '2019-08-30 00:29:55', '2019-08-30 00:32:25'),
(22, '13', '8', '234', 'YONGCO, ARCHIE,  5', 'Delo Oil, 11', '2345', '23', '233', 'CREDIT', '09-03-2019', 'XCXETHGPLX', 'INITIAL', '2019-09-02 23:26:38', '2019-09-02 23:26:38'),
(23, '13', '8', '23444', 'CASH, CASH, 0', 'Delo Oil, 11', '233', '1234', '233', 'CASH', '09-03-2019', 'XCXETHGPLX', 'INITIAL', '2019-09-02 23:26:57', '2019-09-02 23:26:57'),
(24, '13', '8', '2121', 'CASH, CASH, 0', 'Delo Oil, 11', '90', '90', '1', 'CASH', '09-04-2019', 'GMZDHDEIU9', 'FINAL', '2019-09-04 01:33:13', '2019-09-04 01:40:00'),
(25, '13', '8', '233', 'YONGCO, ARCHIE,  5', 'Delo Oil, 11', '23', '23', '1', 'CREDIT', '09-04-2019', 'GMZDHDEIU9', 'FINAL', '2019-09-04 01:33:31', '2019-09-04 01:40:00'),
(26, '13', '8', '234', 'CASH, CASH, 0', 'Delo Oil, 11', '234', '12', '23', 'CASH', '09-18-2019', 'DSGPDMCJWR', 'FINAL', '2019-09-17 18:46:44', '2019-09-17 19:06:21'),
(27, '13', '8', '234', 'YONGCO, ARCHIE,  5', 'Delo Oil, 11', '234', '23', '2', 'CREDIT', '09-18-2019', 'DSGPDMCJWR', 'FINAL', '2019-09-17 18:47:02', '2019-09-17 19:06:21'),
(28, '13', '8', '34566', 'YONGCO, ARCHIE,  5', 'Delo Oil, 11', '234', '345', '888', 'CREDIT', '09-30-2019', 'TMSC7TW4JR', 'FINAL', '2019-09-30 06:12:25', '2019-09-30 06:13:22'),
(29, '13', '8', '34444', 'YONGCO, ARCHIE,  5', 'Delo Oil, 11', '44', '33', '23', 'CREDIT', '09-30-2019', 'K8M20ZQU4K', 'FINAL', '2019-09-30 06:16:46', '2019-09-30 06:18:44'),
(30, '13', '8', '234556', 'YONGCO, ARCHIE,  5', 'Delo Oil, 11', '344', '334', '566', 'CREDIT', '10-01-2019', '6AP79TFSEC', 'FINAL', '2019-10-01 06:19:17', '2019-10-01 06:20:28'),
(31, '13', '8', '54433', 'YONGCO, ARCHIE,  5', 'Delo Oil, 15, 50', '99.000', '33', '3', 'CREDIT', '10-02-2019', '6TRJZAQ6XU', 'FINAL', '2019-10-01 23:10:08', '2019-10-01 23:10:36'),
(32, '13', '8', '5666', 'YONGCO, ARCHIE,  5', 'Delo Oil, 15, 50', '115.000', '23', '5', 'CREDIT', '10-02-2019', '2RA6Y2GOHY', 'FINAL', '2019-10-02 00:21:47', '2019-10-02 00:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `branchusers`
--

CREATE TABLE `branchusers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branchusers`
--

INSERT INTO `branchusers` (`id`, `branchid`, `userid`, `status`, `created_at`, `updated_at`) VALUES
(1, '11', '8', 'active', '2019-07-21 02:28:12', '2019-07-21 02:28:12'),
(2, '13', '9', 'active', '2019-09-17 23:02:24', '2019-09-17 23:02:24'),
(3, '11', '10', 'active', '2019-09-17 23:11:04', '2019-09-17 23:11:04');

-- --------------------------------------------------------

--
-- Table structure for table `cashiers`
--

CREATE TABLE `cashiers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cashremittancereports`
--

CREATE TABLE `cashremittancereports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cashierid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cashsalesreports`
--

CREATE TABLE `cashsalesreports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cashierid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cashtype` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoicenum` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `creditsalesreports`
--

CREATE TABLE `creditsalesreports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cashierid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customerid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customeraccounts`
--

CREATE TABLE `customeraccounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accountid` int(255) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoicenum` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoicedate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branchid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactnum` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taxnumber` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gaschanges`
--

CREATE TABLE `gaschanges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branchgasid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volumeedit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priceedit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gaschanges`
--

INSERT INTO `gaschanges` (`id`, `branchid`, `branchgasid`, `volumeedit`, `priceedit`, `created_at`, `updated_at`) VALUES
(1, '11', '1', '4000', '55', '2019-11-12 21:47:00', '2019-11-12 21:47:00'),
(2, '11', '1', '35000', '51', '2020-02-14 09:20:29', '2020-02-14 09:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `gasrecords`
--

CREATE TABLE `gasrecords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branchgasid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gasid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oldprice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `newprice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oldvolume` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `newvolume` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gasrecords`
--

INSERT INTO `gasrecords` (`id`, `branchgasid`, `gasid`, `branchid`, `oldprice`, `newprice`, `oldvolume`, `newvolume`, `created_at`, `updated_at`) VALUES
(1, '55', '1', '11', '55', '51', '30000', '35000', '2020-02-14 09:20:29', '2020-02-14 09:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `gassalesreports`
--

CREATE TABLE `gassalesreports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branchpumpid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `openingvolume` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `closingvolume` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consumevolume` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unitprice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gastypes`
--

CREATE TABLE `gastypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gasname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gastypes`
--

INSERT INTO `gastypes` (`id`, `gasname`, `created_at`, `updated_at`) VALUES
(1, 'Diesel', '2019-04-07 23:55:03', '2020-02-05 02:36:05'),
(3, 'Silver', '2019-05-07 01:44:57', '2019-05-07 01:45:27'),
(4, 'Platinum', '2019-05-07 01:47:42', '2020-02-05 02:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_03_01_130906_create_branches_table', 1),
(4, '2019_03_01_130930_create_gastypes_table', 1),
(5, '2019_03_01_130950_create_pumps_table', 1),
(7, '2019_03_31_120258_create_branchpump_table', 1),
(9, '2019_03_31_121619_create_gassalesreport_table', 1),
(10, '2019_03_31_121642_create_cashsalesreport_table', 1),
(11, '2019_03_31_121710_create_creditsalesreport_table', 1),
(12, '2019_03_31_121838_create_cashremittancereport_table', 1),
(13, '2019_03_31_121952_create_cashier_table', 1),
(14, '2019_03_31_122354_create_salesreport_table', 1),
(15, '2019_05_08_022528_create_branchgas_table', 2),
(16, '2019_05_08_022556_create_branchproducts_table', 2),
(18, '2019_05_08_022751_create_products_table', 3),
(23, '2019_03_01_132446_create_customers_table', 4),
(24, '2019_03_31_120952_create_customeraccount_table', 4),
(25, '2019_06_03_213630_create_branchdipping_table', 5),
(26, '2019_06_13_145718_create_account_table', 6),
(27, '2019_06_27_201232_create_branchpumplogs_table', 7),
(28, '2019_06_28_152139_create_branchpumprecord_table', 7),
(30, '2019_07_18_033607_create_purchase_table', 8),
(31, '2019_07_18_041002_create_purchaserecord_table', 8),
(32, '2019_07_21_102158_create_branchuser_table', 9),
(33, '2019_07_24_072729_create_branchcredit_table', 10),
(34, '2019_07_24_072805_create_branchdiscount_table', 10),
(35, '2019_07_24_072824_create_branchsale_table', 10),
(36, '2019_07_28_054703_create_branchother_table', 10),
(37, '2019_08_26_082820_create_accountcredits_table', 11),
(38, '2019_08_26_082916_create_accountbills_table', 11),
(39, '2019_10_02_071407_create_branchreport_table', 12),
(40, '2019_10_03_083105_create_branchpayment_table', 13),
(41, '2019_11_13_000647_create_gaschanges_table', 14),
(42, '2020_02_13_071654_create_orderrecords_table', 15),
(43, '2020_02_14_170933_create_gasrecords_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `orderrecords`
--

CREATE TABLE `orderrecords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prnum` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkdate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bankname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checknum` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderrecords`
--

INSERT INTO `orderrecords` (`id`, `prnum`, `checkdate`, `bankname`, `checknum`, `amount`, `userid`, `status`, `created_at`, `updated_at`) VALUES
(2, 'ATP-02-13-2020-2', '2020-02-13', 'China Bank', '90900222', '542500.000', '1', 'Processed', '2020-02-12 23:35:26', '2020-02-12 23:35:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productname`, `created_at`, `updated_at`) VALUES
(15, 'Delo Oil', '2019-05-07 18:56:55', '2019-05-07 18:57:09'),
(16, 'CAR FRESHENER', '2019-07-17 01:53:46', '2019-07-17 01:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `pumplogs`
--

CREATE TABLE `pumplogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gasid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logsession` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pumpid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consumevolume` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `openvolume` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `closevolume` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unitprice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datelog` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batchcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pumplogs`
--

INSERT INTO `pumplogs` (`id`, `branchid`, `gasid`, `logsession`, `userid`, `pumpid`, `consumevolume`, `openvolume`, `closevolume`, `unitprice`, `amount`, `datelog`, `batchcode`, `status`, `created_at`, `updated_at`) VALUES
(25, '13', '1', '9D9QVZAJJE', '8', '34', '111.00', '0', '111', '50', '5550.00', '08-30-2019', 'RYS4MYOEJM', 'FINAL', '2019-08-29 20:44:46', '2019-08-29 23:27:17'),
(26, '13', '3', '9D9QVZAJJE', '8', '35', '221.00', '0', '221', '40', '8840.00', '08-30-2019', 'RYS4MYOEJM', 'FINAL', '2019-08-29 20:44:46', '2019-08-29 23:27:17'),
(27, '13', '4', '9D9QVZAJJE', '8', '36', '221.00', '0', '221', '45', '9945.00', '08-30-2019', 'RYS4MYOEJM', 'FINAL', '2019-08-29 20:44:46', '2019-08-29 23:27:17'),
(28, '13', '1', '9D9QVZAJJE', '8', '37', '322.00', '0', '322', '50', '16100.00', '08-30-2019', 'RYS4MYOEJM', 'FINAL', '2019-08-29 20:44:46', '2019-08-29 23:27:17'),
(29, '13', '3', '9D9QVZAJJE', '8', '38', '234.00', '0', '234', '40', '9360.00', '08-30-2019', 'RYS4MYOEJM', 'FINAL', '2019-08-29 20:44:46', '2019-08-29 23:27:17'),
(30, '13', '4', '9D9QVZAJJE', '8', '39', '432.00', '0', '432', '45', '19440.00', '08-30-2019', 'RYS4MYOEJM', 'FINAL', '2019-08-29 20:44:46', '2019-08-29 23:27:17'),
(31, '13', '1', '3ASRWED04P', '8', '34', '189.00', '111', '300', '50', '9450.00', '08-30-2019', 'KNBTPU1HZI', 'FINAL', '2019-08-30 00:32:11', '2019-08-30 00:32:26'),
(32, '13', '3', '3ASRWED04P', '8', '35', '179.00', '221', '400', '40', '7160.00', '08-30-2019', 'KNBTPU1HZI', 'FINAL', '2019-08-30 00:32:11', '2019-08-30 00:32:26'),
(33, '13', '4', '3ASRWED04P', '8', '36', '101.00', '221', '322', '45', '4545.00', '08-30-2019', 'KNBTPU1HZI', 'FINAL', '2019-08-30 00:32:11', '2019-08-30 00:32:26'),
(34, '13', '1', '3ASRWED04P', '8', '37', '-90.00', '322', '232', '50', '-4500.00', '08-30-2019', 'KNBTPU1HZI', 'FINAL', '2019-08-30 00:32:11', '2019-08-30 00:32:26'),
(35, '13', '3', '3ASRWED04P', '8', '38', '106.00', '234', '340', '40', '4240.00', '08-30-2019', 'KNBTPU1HZI', 'FINAL', '2019-08-30 00:32:11', '2019-08-30 00:32:26'),
(36, '13', '4', '3ASRWED04P', '8', '39', '68.00', '432', '500', '45', '3060.00', '08-30-2019', 'KNBTPU1HZI', 'FINAL', '2019-08-30 00:32:11', '2019-08-30 00:32:26'),
(37, '13', '1', 'XCXETHGPLX', '8', '34', '45.00', '300', '345', '50', '2250.00', '09-03-2019', 'I3QE4M3WDR', 'Initial', '2019-09-02 23:27:31', '2019-09-02 23:27:31'),
(38, '13', '3', 'XCXETHGPLX', '8', '35', '56.00', '400', '456', '40', '2240.00', '09-03-2019', 'I3QE4M3WDR', 'Initial', '2019-09-02 23:27:31', '2019-09-02 23:27:31'),
(39, '13', '4', 'XCXETHGPLX', '8', '36', '22.00', '322', '344', '45', '990.00', '09-03-2019', 'I3QE4M3WDR', 'Initial', '2019-09-02 23:27:31', '2019-09-02 23:27:31'),
(40, '13', '1', 'XCXETHGPLX', '8', '37', '112.00', '232', '344', '50', '5600.00', '09-03-2019', 'I3QE4M3WDR', 'Initial', '2019-09-02 23:27:32', '2019-09-02 23:27:32'),
(41, '13', '3', 'XCXETHGPLX', '8', '38', '94.00', '340', '434', '40', '3760.00', '09-03-2019', 'I3QE4M3WDR', 'Initial', '2019-09-02 23:27:32', '2019-09-02 23:27:32'),
(42, '13', '4', 'XCXETHGPLX', '8', '39', '66.00', '500', '566', '45', '2970.00', '09-03-2019', 'I3QE4M3WDR', 'Initial', '2019-09-02 23:27:32', '2019-09-02 23:27:32'),
(43, '13', '1', 'GMZDHDEIU9', '8', '34', '25.00', '345', '370', '50', '1250.00', '09-04-2019', 'URZMJRUTMQ', 'FINAL', '2019-09-04 01:35:35', '2019-09-04 01:40:00'),
(44, '13', '3', 'GMZDHDEIU9', '8', '35', '44.00', '456', '500', '40', '1760.00', '09-04-2019', 'URZMJRUTMQ', 'FINAL', '2019-09-04 01:35:35', '2019-09-04 01:40:00'),
(45, '13', '4', 'GMZDHDEIU9', '8', '36', '56.00', '344', '400', '45', '2520.00', '09-04-2019', 'URZMJRUTMQ', 'FINAL', '2019-09-04 01:35:35', '2019-09-04 01:40:00'),
(46, '13', '1', 'GMZDHDEIU9', '8', '37', '56.00', '344', '400', '50', '2800.00', '09-04-2019', 'URZMJRUTMQ', 'FINAL', '2019-09-04 01:35:35', '2019-09-04 01:40:00'),
(47, '13', '3', 'GMZDHDEIU9', '8', '38', '66.00', '434', '500', '40', '2640.00', '09-04-2019', 'URZMJRUTMQ', 'FINAL', '2019-09-04 01:35:35', '2019-09-04 01:40:00'),
(48, '13', '4', 'GMZDHDEIU9', '8', '39', '4434.00', '566', '5000', '45', '199530.00', '09-04-2019', 'URZMJRUTMQ', 'FINAL', '2019-09-04 01:35:35', '2019-09-04 01:40:00'),
(61, '13', '1', 'DSGPDMCJWR', '8', '34', '30.00', '370', '400', '50', '1500.00', '09-18-2019', 'HCVR7YBQZV', 'FINAL', '2019-09-17 19:06:08', '2019-09-17 19:06:21'),
(62, '13', '3', 'DSGPDMCJWR', '8', '35', '200.00', '500', '700', '40', '8000.00', '09-18-2019', 'HCVR7YBQZV', 'FINAL', '2019-09-17 19:06:08', '2019-09-17 19:06:21'),
(63, '13', '4', 'DSGPDMCJWR', '8', '36', '300.00', '400', '700', '45', '13500.00', '09-18-2019', 'HCVR7YBQZV', 'FINAL', '2019-09-17 19:06:08', '2019-09-17 19:06:21'),
(64, '13', '1', 'DSGPDMCJWR', '8', '37', '300.00', '400', '700', '50', '15000.00', '09-18-2019', 'HCVR7YBQZV', 'FINAL', '2019-09-17 19:06:08', '2019-09-17 19:06:21'),
(65, '13', '3', 'DSGPDMCJWR', '8', '38', '100.00', '500', '600', '40', '4000.00', '09-18-2019', 'HCVR7YBQZV', 'FINAL', '2019-09-17 19:06:08', '2019-09-17 19:06:21'),
(66, '13', '4', 'DSGPDMCJWR', '8', '39', '600.00', '5000', '5600', '45', '27000.00', '09-18-2019', 'HCVR7YBQZV', 'FINAL', '2019-09-17 19:06:08', '2019-09-17 19:06:21'),
(67, '13', '1', 'TMSC7TW4JR', '8', '34', '55.000', '400', '455', '50', '2750.000', '09-30-2019', '3HSVBWNUWE', 'FINAL', '2019-09-30 06:12:49', '2019-09-30 06:13:22'),
(68, '13', '3', 'TMSC7TW4JR', '8', '35', '77.000', '700', '777', '40', '3080.000', '09-30-2019', '3HSVBWNUWE', 'FINAL', '2019-09-30 06:12:49', '2019-09-30 06:13:22'),
(69, '13', '4', 'TMSC7TW4JR', '8', '36', '77.000', '700', '777', '45', '3465.000', '09-30-2019', '3HSVBWNUWE', 'FINAL', '2019-09-30 06:12:49', '2019-09-30 06:13:22'),
(70, '13', '1', 'TMSC7TW4JR', '8', '37', '77.000', '700', '777', '50', '3850.000', '09-30-2019', '3HSVBWNUWE', 'FINAL', '2019-09-30 06:12:49', '2019-09-30 06:13:22'),
(71, '13', '3', 'TMSC7TW4JR', '8', '38', '177.000', '600', '777', '40', '7080.000', '09-30-2019', '3HSVBWNUWE', 'FINAL', '2019-09-30 06:12:49', '2019-09-30 06:13:22'),
(72, '13', '4', 'TMSC7TW4JR', '8', '39', '177.000', '5600', '5777', '45', '7965.000', '09-30-2019', '3HSVBWNUWE', 'FINAL', '2019-09-30 06:12:49', '2019-09-30 06:13:22'),
(73, '13', '1', 'K8M20ZQU4K', '8', '34', '100.000', '455', '555', '50', '5000.000', '09-30-2019', 'O5K2LTWG23', 'FINAL', '2019-09-30 06:18:23', '2019-09-30 06:18:44'),
(74, '13', '3', 'K8M20ZQU4K', '8', '35', '111.000', '777', '888', '40', '4440.000', '09-30-2019', 'O5K2LTWG23', 'FINAL', '2019-09-30 06:18:23', '2019-09-30 06:18:44'),
(75, '13', '4', 'K8M20ZQU4K', '8', '36', '111.000', '777', '888', '45', '4995.000', '09-30-2019', 'O5K2LTWG23', 'FINAL', '2019-09-30 06:18:23', '2019-09-30 06:18:44'),
(76, '13', '1', 'K8M20ZQU4K', '8', '37', '111.000', '777', '888', '50', '5550.000', '09-30-2019', 'O5K2LTWG23', 'FINAL', '2019-09-30 06:18:23', '2019-09-30 06:18:44'),
(77, '13', '3', 'K8M20ZQU4K', '8', '38', '111.000', '777', '888', '40', '4440.000', '09-30-2019', 'O5K2LTWG23', 'FINAL', '2019-09-30 06:18:23', '2019-09-30 06:18:44'),
(78, '13', '4', 'K8M20ZQU4K', '8', '39', '-4889.000', '5777', '888', '45', '-220005.000', '09-30-2019', 'O5K2LTWG23', 'FINAL', '2019-09-30 06:18:23', '2019-09-30 06:18:44'),
(79, '13', '1', '6AP79TFSEC', '8', '34', '111.000', '555', '666', '50', '5550.000', '10-01-2019', 'C9GWETGRGR', 'FINAL', '2019-10-01 06:19:41', '2019-10-01 06:20:30'),
(80, '13', '3', '6AP79TFSEC', '8', '35', '111.000', '888', '999', '40', '4440.000', '10-01-2019', 'C9GWETGRGR', 'FINAL', '2019-10-01 06:19:41', '2019-10-01 06:20:30'),
(81, '13', '4', '6AP79TFSEC', '8', '36', '111.000', '888', '999', '45', '4995.000', '10-01-2019', 'C9GWETGRGR', 'FINAL', '2019-10-01 06:19:43', '2019-10-01 06:20:30'),
(82, '13', '1', '6AP79TFSEC', '8', '37', '111.000', '888', '999', '50', '5550.000', '10-01-2019', 'C9GWETGRGR', 'FINAL', '2019-10-01 06:19:44', '2019-10-01 06:20:30'),
(83, '13', '3', '6AP79TFSEC', '8', '38', '111.000', '888', '999', '40', '4440.000', '10-01-2019', 'C9GWETGRGR', 'FINAL', '2019-10-01 06:19:44', '2019-10-01 06:20:30'),
(84, '13', '4', '6AP79TFSEC', '8', '39', '111.000', '888', '999', '45', '4995.000', '10-01-2019', 'C9GWETGRGR', 'FINAL', '2019-10-01 06:19:45', '2019-10-01 06:20:30'),
(85, '13', '1', '6TRJZAQ6XU', '8', '34', '111.000', '666', '777', '50', '5550.000', '10-02-2019', 'OCBN28AOHW', 'FINAL', '2019-10-01 23:10:25', '2019-10-01 23:10:37'),
(86, '13', '3', '6TRJZAQ6XU', '8', '35', '1.000', '999', '1000', '40', '40.000', '10-02-2019', 'OCBN28AOHW', 'FINAL', '2019-10-01 23:10:25', '2019-10-01 23:10:37'),
(87, '13', '4', '6TRJZAQ6XU', '8', '36', '1.000', '999', '1000', '45', '45.000', '10-02-2019', 'OCBN28AOHW', 'FINAL', '2019-10-01 23:10:25', '2019-10-01 23:10:37'),
(88, '13', '1', '6TRJZAQ6XU', '8', '37', '1.000', '999', '1000', '50', '50.000', '10-02-2019', 'OCBN28AOHW', 'FINAL', '2019-10-01 23:10:25', '2019-10-01 23:10:37'),
(89, '13', '3', '6TRJZAQ6XU', '8', '38', '1.000', '999', '1000', '40', '40.000', '10-02-2019', 'OCBN28AOHW', 'FINAL', '2019-10-01 23:10:25', '2019-10-01 23:10:37'),
(90, '13', '4', '6TRJZAQ6XU', '8', '39', '1.000', '999', '1000', '45', '45.000', '10-02-2019', 'OCBN28AOHW', 'FINAL', '2019-10-01 23:10:26', '2019-10-01 23:10:37'),
(91, '13', '1', '2RA6Y2GOHY', '8', '34', '111.000', '777', '888', '50', '5550.000', '10-02-2019', 'L9QRKQN31E', 'FINAL', '2019-10-02 00:22:10', '2019-10-02 00:31:31'),
(92, '13', '3', '2RA6Y2GOHY', '8', '35', '111.000', '1000', '1111', '40', '4440.000', '10-02-2019', 'L9QRKQN31E', 'FINAL', '2019-10-02 00:22:10', '2019-10-02 00:31:31'),
(93, '13', '4', '2RA6Y2GOHY', '8', '36', '111.000', '1000', '1111', '45', '4995.000', '10-02-2019', 'L9QRKQN31E', 'FINAL', '2019-10-02 00:22:11', '2019-10-02 00:31:31'),
(94, '13', '1', '2RA6Y2GOHY', '8', '37', '111.000', '1000', '1111', '50', '5550.000', '10-02-2019', 'L9QRKQN31E', 'FINAL', '2019-10-02 00:22:11', '2019-10-02 00:31:31'),
(95, '13', '3', '2RA6Y2GOHY', '8', '38', '111.000', '1000', '1111', '40', '4440.000', '10-02-2019', 'L9QRKQN31E', 'FINAL', '2019-10-02 00:22:11', '2019-10-02 00:31:31'),
(96, '13', '4', '2RA6Y2GOHY', '8', '39', '111.000', '1000', '1111', '45', '4995.000', '10-02-2019', 'L9QRKQN31E', 'FINAL', '2019-10-02 00:22:11', '2019-10-02 00:31:31');

-- --------------------------------------------------------

--
-- Table structure for table `pumprecords`
--

CREATE TABLE `pumprecords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batchcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `readingdate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pumprecords`
--

INSERT INTO `pumprecords` (`id`, `branchid`, `batchcode`, `readingdate`, `created_at`, `updated_at`) VALUES
(3, '11', 'IXOQAXDMSD', '07-19-2019', '2019-07-19 05:01:09', '2019-07-19 05:01:09'),
(4, '13', 'FTIBBGBKSB', '08-26-2019', '2019-08-25 17:32:16', '2019-08-25 17:32:16'),
(5, '13', 'V2WDXFW2JH', '08-26-2019', '2019-08-25 17:36:56', '2019-08-25 17:36:56'),
(6, '13', 'RL2KPRWKJG', '08-26-2019', '2019-08-25 17:39:58', '2019-08-25 17:39:58'),
(7, '13', 'CXG4S2UUBM', '08-29-2019', '2019-08-29 00:20:31', '2019-08-29 00:20:31'),
(8, '13', 'TWOQE3XSX7', '08-29-2019', '2019-08-29 00:53:15', '2019-08-29 00:53:15'),
(9, '13', 'OWJ6RJGFE6', '08-30-2019', '2019-08-29 20:23:40', '2019-08-29 20:23:40'),
(10, '13', 'U2DM2BOZBP', '08-30-2019', '2019-08-29 20:41:12', '2019-08-29 20:41:12'),
(11, '13', 'RYS4MYOEJM', '08-30-2019', '2019-08-29 20:44:46', '2019-08-29 20:44:46'),
(12, '13', 'KNBTPU1HZI', '08-30-2019', '2019-08-30 00:32:11', '2019-08-30 00:32:11'),
(13, '13', 'I3QE4M3WDR', '09-03-2019', '2019-09-02 23:27:32', '2019-09-02 23:27:32'),
(14, '13', 'URZMJRUTMQ', '09-04-2019', '2019-09-04 01:35:35', '2019-09-04 01:35:35'),
(15, '13', 'HMEDEOYLBL', '09-18-2019', '2019-09-17 18:47:57', '2019-09-17 18:47:57'),
(16, '13', '09VTGAUOLE', '09-18-2019', '2019-09-17 19:05:21', '2019-09-17 19:05:21'),
(17, '13', 'HCVR7YBQZV', '09-18-2019', '2019-09-17 19:06:08', '2019-09-17 19:06:08'),
(18, '13', '3HSVBWNUWE', '09-30-2019', '2019-09-30 06:12:49', '2019-09-30 06:12:49'),
(19, '13', 'O5K2LTWG23', '09-30-2019', '2019-09-30 06:18:23', '2019-09-30 06:18:23'),
(20, '13', 'C9GWETGRGR', '10-01-2019', '2019-10-01 06:19:46', '2019-10-01 06:19:46'),
(21, '13', 'OCBN28AOHW', '10-02-2019', '2019-10-01 23:10:26', '2019-10-01 23:10:26'),
(22, '13', 'L9QRKQN31E', '10-02-2019', '2019-10-02 00:22:11', '2019-10-02 00:22:11');

-- --------------------------------------------------------

--
-- Table structure for table `pumps`
--

CREATE TABLE `pumps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pumpname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gasid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `volume` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pumps`
--

INSERT INTO `pumps` (`id`, `pumpname`, `branchid`, `gasid`, `volume`, `created_at`, `updated_at`) VALUES
(28, 'Deisel 1', '11', '1', NULL, '2019-07-19 04:52:43', '2019-07-19 04:52:43'),
(29, 'Deisel 2', '11', '1', NULL, '2019-07-19 04:55:03', '2019-07-19 04:55:03'),
(30, 'Silver 1', '11', '3', NULL, '2019-07-19 04:55:34', '2019-07-19 04:55:34'),
(31, 'Silver 2', '11', '3', NULL, '2019-07-19 04:55:44', '2019-07-19 04:55:44'),
(32, 'Premium 2', '11', '4', NULL, '2019-07-19 04:58:13', '2019-07-19 04:58:13'),
(33, 'Premium 1', '11', '4', NULL, '2019-07-19 04:58:59', '2019-07-19 04:58:59'),
(34, 'Pump 1', '13', '1', NULL, '2019-07-21 04:29:47', '2019-07-21 04:29:47'),
(35, 'Pump 2', '13', '3', NULL, '2019-07-21 04:29:53', '2019-07-21 04:29:53'),
(36, 'Pump 3', '13', '4', NULL, '2019-07-21 04:30:00', '2019-07-21 04:30:00'),
(37, 'Pump 4', '13', '1', NULL, '2019-08-29 00:51:00', '2019-08-29 00:51:00'),
(38, 'Pump 5', '13', '3', NULL, '2019-08-29 00:51:07', '2019-08-29 00:51:07'),
(39, 'Pump 6', '13', '4', NULL, '2019-08-29 00:51:37', '2019-08-29 00:51:37');

-- --------------------------------------------------------

--
-- Table structure for table `purchaserecords`
--

CREATE TABLE `purchaserecords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchasenumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recquantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `itemid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recdate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchaserecords`
--

INSERT INTO `purchaserecords` (`id`, `purchasenumber`, `quantity`, `recquantity`, `price`, `itemid`, `status`, `date`, `recdate`, `created_at`, `updated_at`) VALUES
(1, 'ATP-01-01', '3000', '2300', NULL, '1', 'received', '11/13/2019', NULL, '2019-11-12 23:17:57', '2019-12-08 06:34:52'),
(2, 'ATP-01-01', '5000', '4000', NULL, '3', 'received', '11/13/2019', NULL, '2019-11-12 23:18:04', '2019-12-08 06:34:52'),
(3, 'ATP-01-01', '6000', '5000', NULL, '4', 'received', '11/13/2019', NULL, '2019-11-12 23:18:10', '2019-12-08 06:34:52'),
(4, 'ATP-12092019-2', '5000', '4000', '50.40', '1', 'received', '12/09/2019', NULL, '2019-12-08 18:07:35', '2019-12-08 18:35:13'),
(5, 'ATP-12092019-2', '2000', '5000', '40.65', '3', 'received', '12/09/2019', NULL, '2019-12-08 18:07:41', '2019-12-08 18:35:13'),
(6, 'ATP-12092019-2', '10000', '7000', '40.44', '4', 'received', '12/09/2019', NULL, '2019-12-08 18:07:48', '2019-12-08 18:35:13'),
(7, 'ATP-02-05-2020-2', '8000', '8000', '42.70', '1', 'received', '02/05/2020', NULL, '2020-02-05 02:41:21', '2020-02-05 02:53:54'),
(8, 'ATP-02-05-2020-2', '2000', '2000', '46.76', '3', 'received', '02/05/2020', NULL, '2020-02-05 02:41:27', '2020-02-05 02:53:54'),
(9, 'ATP-02-05-2020-2', '4000', '4000', '47.24', '4', 'received', '02/05/2020', NULL, '2020-02-05 02:41:31', '2020-02-05 02:53:54'),
(10, 'ATP-02-13-2020-2', '4000', '4000', '51', '1', 'received', '02/13/2020', NULL, '2020-02-12 20:09:38', '2020-02-12 20:59:23'),
(11, 'ATP-02-13-2020-2', '5000', '5000', '50.11', '3', 'received', '02/13/2020', NULL, '2020-02-12 20:09:43', '2020-02-12 22:46:28'),
(12, 'ATP-02-13-2020-2', '3000', '2000', '44', '4', 'received', '02/13/2020', NULL, '2020-02-12 20:09:55', '2020-02-12 22:20:05');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchasenumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `producttype` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `purchasenumber`, `quantity`, `producttype`, `branch_id`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ATP-01-01', '', '', '13', '11/13/2019', 'received', '2019-11-12 23:17:45', '2019-12-08 06:34:52'),
(2, 'ATP-12092019-2', '', '', '11', '12/09/2019', 'received', '2019-12-08 18:07:29', '2019-12-08 18:35:13'),
(3, 'ATP-02-05-2020-2', '', '', '11', '02/05/2020', 'received', '2020-02-05 02:41:03', '2020-02-05 02:53:54'),
(4, 'ATP-02-13-2020-2', '', '', '11', '02/13/2020', 'received', '2020-02-12 20:09:32', '2020-02-12 20:28:41');

-- --------------------------------------------------------

--
-- Table structure for table `salesreports`
--

CREATE TABLE `salesreports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cashierid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branchid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `usertype`, `branch`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Gegejosper', 'gege', 'gegejosper@gmail.com', NULL, '$2y$10$XuVOhrdUL/jqcXXd5wR6RO22B692rzB7XhV4L6e.OY2uZzxcHckO.', 'admin', '', '', NULL, '2019-04-07 17:08:33', '2019-04-07 17:08:33'),
(8, 'REGIE DSA', 'gegejosper', 'regie@gmail.com', NULL, '$2y$12$CHU2YJm7JyD9/o8hrwZ4POuGwoQx2HpJGYlEorUSSqLkZol3ww4WK', 'incharge', '', '', NULL, '2019-07-21 02:28:12', '2019-07-21 02:28:12'),
(9, 'TEAST', 'tes', 'test@gmail.com', NULL, '$2y$12$CHU2YJm7JyD9/o8hrwZ4POuGwoQx2HpJGYlEorUSSqLkZol3ww4WK', 'billing', '', '', NULL, '2019-09-17 23:02:24', '2019-09-17 23:02:24'),
(10, 'WQWQ', 'reg', 'www@gmail.com', NULL, '$2y$10$5xB..DXFqBnTgfTo/gMtc.bpGUItbtVpVtDOgDYhhEXu.lz2DFYja', 'incharge', '', '', NULL, '2019-09-17 23:11:04', '2019-12-05 20:39:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountbills`
--
ALTER TABLE `accountbills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accountcredits`
--
ALTER TABLE `accountcredits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branchcredits`
--
ALTER TABLE `branchcredits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branchdippings`
--
ALTER TABLE `branchdippings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branchdiscounts`
--
ALTER TABLE `branchdiscounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branchgases`
--
ALTER TABLE `branchgases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branchothers`
--
ALTER TABLE `branchothers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branchpayments`
--
ALTER TABLE `branchpayments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branchproducts`
--
ALTER TABLE `branchproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branchpumps`
--
ALTER TABLE `branchpumps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branchreports`
--
ALTER TABLE `branchreports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branchsales`
--
ALTER TABLE `branchsales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branchusers`
--
ALTER TABLE `branchusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashiers`
--
ALTER TABLE `cashiers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashremittancereports`
--
ALTER TABLE `cashremittancereports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashsalesreports`
--
ALTER TABLE `cashsalesreports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `creditsalesreports`
--
ALTER TABLE `creditsalesreports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customeraccounts`
--
ALTER TABLE `customeraccounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gaschanges`
--
ALTER TABLE `gaschanges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gasrecords`
--
ALTER TABLE `gasrecords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gassalesreports`
--
ALTER TABLE `gassalesreports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gastypes`
--
ALTER TABLE `gastypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderrecords`
--
ALTER TABLE `orderrecords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pumplogs`
--
ALTER TABLE `pumplogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pumprecords`
--
ALTER TABLE `pumprecords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pumps`
--
ALTER TABLE `pumps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaserecords`
--
ALTER TABLE `purchaserecords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salesreports`
--
ALTER TABLE `salesreports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountbills`
--
ALTER TABLE `accountbills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `accountcredits`
--
ALTER TABLE `accountcredits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `branchcredits`
--
ALTER TABLE `branchcredits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `branchdippings`
--
ALTER TABLE `branchdippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `branchdiscounts`
--
ALTER TABLE `branchdiscounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `branchgases`
--
ALTER TABLE `branchgases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `branchothers`
--
ALTER TABLE `branchothers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `branchpayments`
--
ALTER TABLE `branchpayments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `branchproducts`
--
ALTER TABLE `branchproducts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `branchpumps`
--
ALTER TABLE `branchpumps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branchreports`
--
ALTER TABLE `branchreports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branchsales`
--
ALTER TABLE `branchsales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `branchusers`
--
ALTER TABLE `branchusers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cashiers`
--
ALTER TABLE `cashiers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cashremittancereports`
--
ALTER TABLE `cashremittancereports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cashsalesreports`
--
ALTER TABLE `cashsalesreports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `creditsalesreports`
--
ALTER TABLE `creditsalesreports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customeraccounts`
--
ALTER TABLE `customeraccounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gaschanges`
--
ALTER TABLE `gaschanges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gasrecords`
--
ALTER TABLE `gasrecords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gassalesreports`
--
ALTER TABLE `gassalesreports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gastypes`
--
ALTER TABLE `gastypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `orderrecords`
--
ALTER TABLE `orderrecords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pumplogs`
--
ALTER TABLE `pumplogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `pumprecords`
--
ALTER TABLE `pumprecords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pumps`
--
ALTER TABLE `pumps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `purchaserecords`
--
ALTER TABLE `purchaserecords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `salesreports`
--
ALTER TABLE `salesreports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
