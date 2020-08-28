-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2020 at 09:57 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rcp`
--

-- --------------------------------------------------------

--
-- Table structure for table `approvers`
--

CREATE TABLE `approvers` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `alt_app_id` int(11) NOT NULL,
  `sec_id` int(11) NOT NULL,
  `alt_sec_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `approvers`
--

INSERT INTO `approvers` (`id`, `dept_id`, `app_id`, `alt_app_id`, `sec_id`, `alt_sec_id`, `created`, `modified`) VALUES
(1, 1, 3, 4, 5, 6, '2020-07-19 20:54:00', '2020-08-27 07:56:16'),
(2, 2, 0, 0, 5, 6, '2020-07-19 20:54:00', '2020-08-27 07:56:28'),
(3, 3, 0, 0, 0, 0, '2020-07-19 20:54:00', '2020-08-27 07:56:36'),
(4, 4, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(5, 5, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(6, 6, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(7, 7, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(8, 8, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(9, 9, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(10, 10, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(11, 11, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(12, 12, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(13, 13, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(14, 14, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(15, 15, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(16, 16, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(17, 17, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(18, 18, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(19, 19, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(20, 20, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(21, 21, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(22, 22, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(23, 23, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(24, 24, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(25, 25, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(26, 26, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(27, 27, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(28, 28, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(29, 29, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(30, 30, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(31, 31, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(32, 32, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(33, 33, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(34, 34, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(35, 35, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(36, 36, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(37, 37, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(38, 38, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(39, 39, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(40, 40, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(41, 41, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(42, 42, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(43, 43, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00'),
(44, 44, 1, 2, 3, 4, '2020-07-19 20:54:00', '2020-07-19 04:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `code`, `name`, `created`, `modified`) VALUES
(1, 'CAB', 'ABIATHAR CORPORATION', '2020-07-18 20:11:41', '2020-07-18 12:11:41'),
(2, 'CAP', 'AEONPRIME LAND DEVELOPMENT CORPORATION', '2020-07-18 20:11:41', '2020-07-18 12:11:41'),
(3, 'CCI', 'CITRINELAND CORPORATION', '2020-07-18 20:11:41', '2020-07-18 12:11:41'),
(4, 'CEX', 'EXCEL TOWERS INCORPORATION', '2020-07-18 20:11:41', '2020-07-18 12:11:41'),
(5, 'CID', 'INNOLAND DEVELOPMENT CORPORATION', '2020-07-18 20:11:41', '2020-07-18 12:11:41'),
(6, 'COT', 'ONG TIAK DEVELOPMENT CORPORATION', '2020-07-18 20:11:41', '2020-07-18 12:11:41'),
(7, 'IGC', 'INNOGROUP OF COMPANIES', '2020-07-18 20:11:41', '2020-07-18 12:11:41'),
(8, 'CIP', 'INNOPRIME PROPERTY SERVICES', '2020-07-18 20:11:41', '2020-07-18 12:11:41'),
(9, 'COH', 'OHMORI DEVELOPMENT CORPORATION', '2020-07-18 20:11:41', '2020-07-18 12:11:41'),
(10, 'CTG', 'TG UNIVERSAL BUSINESS VENTURES INCORPORATION', '2020-07-18 20:11:41', '2020-07-18 12:11:41'),
(11, 'CVE', 'VELSONS MANAGEMENT AND DEVELOPMENT CORPORATION', '2020-07-18 20:11:41', '2020-07-18 12:11:41'),
(12, 'CIN', 'INDUCO RESOURCE CONSTRUCTION CORPORATION', '2020-07-18 20:11:41', '2020-07-18 12:11:41'),
(13, 'CMJ', 'MJ LANDTRADE DEVELOPMENT CORPORATION', '2020-07-18 20:11:41', '2020-07-18 12:11:41'),
(14, 'CKZ', 'TOTAL KENZO ESSENTIALS INCORPORATION', '2020-07-18 20:11:41', '2020-07-18 12:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `code`, `name`, `created`, `modified`) VALUES
(1, 'AAP', 'ACCOUNTING-PAYABLES', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(2, 'AAR', 'ACCOUNTING-RECEIVABLES', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(3, 'ACM', 'ACCOUNTING-COMPLIANCE', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(4, 'AFR', 'ACCOUNTING-FIN REPORTS', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(5, 'ATR', 'ACCOUNTING-TREASURY', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(6, 'ANC', 'ANCILLARY-CEBU', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(7, 'ANM', 'ANCILLARY-MANILA', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(8, 'AUD', 'AUDIT', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(9, 'BPM', 'BUSINESS PROCESS MANAGEMENT', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(10, 'EDS', 'ENGINEERING-DESIGN', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(11, 'EDT', 'ENGINEERING-DESIGN TECH', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(12, 'HRC', 'HUMAN RESOURCE-CEBU', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(13, 'HRM', 'HUMAN RESOROURCE-MANILA', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(14, 'ITS', 'INFO TECHNOLOGY', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(15, 'KEN', 'KENZO', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(16, 'LEG', 'LEGAL', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(17, 'LRC', 'LOGISTICS RESOURCE-CEBU', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(18, 'LRM', 'LOGISTICS RESOURCE-MANILA', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(19, 'LSC', 'LEASING-CEBU', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(20, 'LSM', 'LEASING-MANILA', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(21, 'MKC', 'MARKETING-CEBU', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(22, 'MKM', 'MARKETING-MANILA', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(23, 'OFO', 'OPERATIONS-FIT-OUTS', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(24, 'OHO', 'OPERATIONS-HORIZONTAL', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(25, 'OME', 'OPERATIONS-MEPF', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(26, 'OVE', 'OPERATIONS-VERTICAL', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(27, 'ONT', 'ONG TIAK', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(28, 'PCM', 'PROJECT MANAGEMENT - COMMERCIAL', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(29, 'PHS', 'PROJECT MANAGEMENT - HSE', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(30, 'PQA', 'PROJECT MANAGEMENT - QAQC', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(31, 'PAC', 'PMO - AEON CENTER', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(32, 'PCC', 'PMO - CALYX CENTRE', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(33, 'PCP', 'PMO - CAPELLA', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(34, 'PCR', 'PMO - CALYX RESIDENCES', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(35, 'PHA', 'PMO - HARMONIS', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(36, 'PLN', 'PMO - LINK', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(37, 'PO2', 'PMO - OHMORI 2', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(38, 'POH', 'PMO - OHMORI', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(39, 'PPO', 'PMO - POLARIS', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(40, 'PTG', 'PMO - TGU', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(41, 'PUC', 'PURCHASING-CEBU', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(42, 'PUM', 'PURCHASING-MANILA', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(43, 'SAL', 'SALES', '2020-07-18 20:03:54', '2020-07-18 12:03:54'),
(44, 'SUP', 'SUPPORT SERVICES', '2020-07-18 20:03:54', '2020-07-18 12:03:54');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_role` int(11) NOT NULL,
  `tag` text NOT NULL,
  `title` text NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `user_role`, `tag`, `title`, `body`) VALUES
(13, 6, 1, 'new_job', 'New job', 'Received a new job');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `code`, `name`, `created`, `modified`) VALUES
(1, 'PAC', 'AEON CENTER', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(2, 'PAL', 'ALTAIRE', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(3, 'PAN', 'ANGELES', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(4, 'PCL', 'CALIPHA', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(5, 'PCC', 'CALYX CENTRE', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(6, 'PCR', 'CALYX RESIDENCES', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(7, 'PCP', 'CAPELLA', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(8, 'F01', 'FIT-OUT - SAVVY SHERPA', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(9, 'F02', 'FIT-OUT - FLUOR 5/F', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(10, 'F03', 'FIT-OUT - FLUOR 12/F', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(11, 'F04', 'FIT-OUT - HIKAY SM', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(12, '405', 'FIT-OUT - CALYX PENTHOUSE', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(13, 'F06', 'FIT-OUT - THE MEDIAN SHOWROOM', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(14, 'F07', 'FIT-OUT - MA. LUISA', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(15, 'F08', 'FIT-OUT - CALYX PLUG-N-PLAY', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(16, 'F09', 'FIT-OUT - TGU PLUG-N-PLAY', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(17, 'F10', 'FIT-OUT - LINK PLUG-N-PLAY', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(18, 'F11', 'FIT-OUT - CALCEN 1201W', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(19, 'F12', 'FIT-OUT - CALCEN 1901W', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(20, 'F13', 'FIT-OUT - CALCEN 2101W', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(21, 'F14', 'FIT-OUT - CALCEN 2301W', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(22, 'F15', 'FIT-OUT - CALCEN 2401W', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(23, 'F16', 'FIT-OUT - CALRES 09D', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(24, 'F17', 'FIT-OUT - CALRES 18LM', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(25, 'F18', 'FIT-OUT - CALRES 22FG', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(26, 'F19', 'FIT-OUT - CALRES 26A', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(27, 'P01', 'PLUG-N-PLAY - AEON .6F', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(28, 'P02', 'PLUG-N-PLAY - AEON 10F', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(29, 'POR', 'ORION', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(30, 'PSN', 'SERENIS NORTH', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(31, 'PSP', 'SERENIS PLAINS', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(32, 'PSS', 'SERENIS SOUTH', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(33, 'PSE', 'SERENITEA', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(34, 'PSU', 'SUNBURST', '2020-07-18 20:08:40', '2020-07-18 12:08:40'),
(35, 'PTM', 'THE MEDIAN', '2020-07-18 20:08:40', '2020-07-18 12:08:40');

-- --------------------------------------------------------

--
-- Table structure for table `rcps`
--

CREATE TABLE `rcps` (
  `id` int(11) NOT NULL,
  `rcp_no` varchar(15) NOT NULL,
  `req_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `proj_id` int(11) NOT NULL,
  `payee` varchar(100) NOT NULL,
  `issued_on` date NOT NULL,
  `amount` double NOT NULL,
  `amount_in_words` varchar(255) NOT NULL,
  `expense_type` varchar(25) NOT NULL,
  `is_rush` tinyint(1) NOT NULL,
  `is_vatable` tinyint(1) NOT NULL,
  `is_edited` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rcps`
--

INSERT INTO `rcps` (`id`, `rcp_no`, `req_id`, `app_id`, `comp_id`, `dept_id`, `proj_id`, `payee`, `issued_on`, `amount`, `amount_in_words`, `expense_type`, `is_rush`, `is_vatable`, `is_edited`, `created`, `modified`, `status_id`) VALUES
(1, 'AAP 20-0001', 2, 3, 1, 1, 1, 'Petron', '2020-08-27', 52000, 'Fifty two thousand pesos', 'DEPARTMENT EXPENSE', 0, 0, 0, '2020-08-27 15:54:48', '2020-08-27 07:56:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rcp_approvers`
--

CREATE TABLE `rcp_approvers` (
  `id` int(11) NOT NULL,
  `rcp_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rcp_approvers`
--

INSERT INTO `rcp_approvers` (`id`, `rcp_id`, `app_id`, `created`, `status_id`) VALUES
(1, 1, 3, '2020-08-27 15:54:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rcp_particulars`
--

CREATE TABLE `rcp_particulars` (
  `id` int(11) NOT NULL,
  `rcp_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit` varchar(30) DEFAULT NULL,
  `particulars` varchar(100) NOT NULL,
  `ref_code` varchar(20) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `amount` double NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rcp_particulars`
--

INSERT INTO `rcp_particulars` (`id`, `rcp_id`, `qty`, `unit`, `particulars`, `ref_code`, `code`, `amount`, `created`, `modified`) VALUES
(1, 1, 1, 'ABC', 'ABC', 'ABC', 'ABC', 52000, '2020-08-27 15:54:48', '2020-08-27 07:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `rcp_rushes`
--

CREATE TABLE `rcp_rushes` (
  `id` int(11) NOT NULL,
  `rcp_id` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `justification` text NOT NULL,
  `supporting_file` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Approved'),
(3, 'Declined'),
(4, 'Rush'),
(5, 'Vatable');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `proj_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `middle_initial` char(1) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `comp_id`, `dept_id`, `proj_id`, `type_id`, `firstname`, `lastname`, `middle_initial`, `created`, `modified`, `status_id`) VALUES
(1, 1, 1, 1, 1, 'Admin', 'Admin', NULL, '2020-08-27 00:00:00', '2020-08-27 07:43:10', 1),
(2, 2, 1, 1, 2, 'Requestor', 'Requestor', 'R', '2020-08-27 09:45:14', '2020-08-27 01:45:14', 1),
(3, 2, 1, 1, 3, 'Primary', 'Approver', 'R', '2020-08-27 09:45:54', '2020-08-27 01:45:54', 1),
(4, 2, 1, 1, 4, 'Alternate Primary', 'Approver', 'R', '2020-08-27 09:46:13', '2020-08-27 01:46:13', 1),
(5, 2, 1, 1, 5, 'Secondary', 'Approver', 'R', '2020-08-27 09:46:41', '2020-08-27 01:46:41', 1),
(6, 2, 1, 1, 6, 'Alternate Secondary', 'Approver', 'R', '2020-08-27 09:46:54', '2020-08-27 01:46:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `log_count` char(1) NOT NULL,
  `player_id` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `user_id`, `username`, `password`, `log_count`, `player_id`, `email`, `created`, `modified`) VALUES
(1, 1, 'admin', '271e7f2f928bbebf1a2312aa7b009f712cab074e', '', NULL, 'admin@gmail.com', '2020-08-27 15:44:31', '2020-08-27 07:51:42'),
(2, 2, 'requestor', '87b852f4a17ef41a62d849a26ba49de7b5931fb4', '0', NULL, 'requestor@innoland.com', '2020-08-27 09:45:14', '2020-08-27 07:51:45'),
(3, 3, 'primary_approver', '1626ab1fdacd280df6ed97805f28b320c42ea927', '0', NULL, 'primary_approver@innoland.com', '2020-08-27 09:45:54', '2020-08-27 07:51:47'),
(4, 4, 'alt_primary_approver', '29af8179931d891b076f5e59c27e303be7059acc', '0', NULL, 'alt_primary_approver@innoland.com', '2020-08-27 09:46:13', '2020-08-27 07:51:49'),
(5, 5, 'secondary_approver', 'b7e86f63e4cc67140745691f92804fb510b67efa', '0', NULL, 'secondary_approver@innoland.com', '2020-08-27 09:46:41', '2020-08-27 07:51:52'),
(6, 6, 'alt_secondary_approver', '44fad9ccf01f23adad067523270276239b3e51a8', '0', NULL, 'alt_secondary_approver@innoland.com', '2020-08-27 09:46:54', '2020-08-27 07:51:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Requestor'),
(3, 'Primary Approver'),
(4, 'Alternate Primary Approver'),
(5, 'Secondary Approver'),
(6, 'Alternate Secondary Approver');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approvers`
--
ALTER TABLE `approvers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rcps`
--
ALTER TABLE `rcps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rcp_approvers`
--
ALTER TABLE `rcp_approvers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rcp_particulars`
--
ALTER TABLE `rcp_particulars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rcp_rushes`
--
ALTER TABLE `rcp_rushes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approvers`
--
ALTER TABLE `approvers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `rcps`
--
ALTER TABLE `rcps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rcp_approvers`
--
ALTER TABLE `rcp_approvers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rcp_particulars`
--
ALTER TABLE `rcp_particulars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rcp_rushes`
--
ALTER TABLE `rcp_rushes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
