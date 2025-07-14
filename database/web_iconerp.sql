-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2025 at 07:45 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_iconerp`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `issue_date` date DEFAULT NULL,
  `issue_no` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `visit` int(11) NOT NULL DEFAULT 0,
  `with_warranty` tinyint(4) NOT NULL DEFAULT 0,
  `tech_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `mast_complaint_type_id` bigint(20) UNSIGNED NOT NULL,
  `mast_customer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `deli_date` date DEFAULT NULL,
  `warranty` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `price` decimal(8,2) DEFAULT NULL,
  `sales_id` bigint(20) UNSIGNED NOT NULL,
  `mast_customer_id` bigint(20) UNSIGNED NOT NULL,
  `mast_work_station_id` bigint(20) UNSIGNED NOT NULL,
  `mast_item_register_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_attendances`
--

CREATE TABLE `hr_attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `in_time` time DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `location` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `attendance_type` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `finger_id` int(11) DEFAULT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_late` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_leave_applications`
--

CREATE TABLE `hr_leave_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purpose` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `leave_contact` varchar(255) DEFAULT NULL,
  `leave_location` varchar(255) DEFAULT NULL,
  `mast_leave_id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info_banks`
--

CREATE TABLE `info_banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `brance_name` varchar(255) DEFAULT NULL,
  `acount_name` varchar(255) DEFAULT NULL,
  `acount_no` int(11) DEFAULT NULL,
  `acount_type` int(11) DEFAULT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info_educationals`
--

CREATE TABLE `info_educationals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qualification` int(11) DEFAULT NULL,
  `institute_name` varchar(255) DEFAULT NULL,
  `passing_year` date DEFAULT NULL,
  `out_of` int(11) DEFAULT NULL,
  `grade` double(8,2) DEFAULT 0.00,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info_nominees`
--

CREATE TABLE `info_nominees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `nid_no` int(11) DEFAULT NULL,
  `relation` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `nominee_percentage` int(11) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info_personals`
--

CREATE TABLE `info_personals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `employee_gender` int(11) DEFAULT NULL,
  `nid_no` varchar(255) DEFAULT NULL,
  `blood_group` int(11) DEFAULT NULL,
  `number_official` varchar(255) DEFAULT NULL,
  `email_official` varchar(255) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `service_length` int(11) DEFAULT NULL,
  `gross_salary` double DEFAULT NULL,
  `reporting_boss` int(11) DEFAULT NULL,
  `is_reporting_boss` tinyint(4) NOT NULL DEFAULT 0,
  `division_present` int(11) DEFAULT NULL,
  `district_present` int(11) DEFAULT NULL,
  `upazila_present` int(11) DEFAULT NULL,
  `union_present` int(11) DEFAULT NULL,
  `thana_present` varchar(255) DEFAULT NULL,
  `post_code_present` int(11) DEFAULT NULL,
  `address_present` varchar(255) DEFAULT NULL,
  `division_permanent` int(11) DEFAULT NULL,
  `district_permanent` int(11) DEFAULT NULL,
  `upazila_permanent` int(11) DEFAULT NULL,
  `union_permanent` int(11) DEFAULT NULL,
  `thana_permanent` varchar(255) DEFAULT NULL,
  `post_code_permanent` int(11) DEFAULT NULL,
  `address_permanent` varchar(255) DEFAULT NULL,
  `passport_no` varchar(255) DEFAULT NULL,
  `driving_license` varchar(255) DEFAULT NULL,
  `marital_status` int(11) DEFAULT NULL,
  `house_phone` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `birth_certificate_no` bigint(20) DEFAULT NULL,
  `emg_person_name` varchar(255) DEFAULT NULL,
  `emg_phone_number` varchar(255) DEFAULT NULL,
  `emg_relationship` varchar(255) DEFAULT NULL,
  `emg_address` text DEFAULT NULL,
  `mast_department_id` bigint(20) UNSIGNED NOT NULL,
  `mast_designation_id` bigint(20) UNSIGNED NOT NULL,
  `mast_employee_type_id` bigint(20) UNSIGNED NOT NULL,
  `mast_work_station_id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info_work_experiences`
--

CREATE TABLE `info_work_experiences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `job_description` text DEFAULT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_cards`
--

CREATE TABLE `job_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `in_time` time DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `is_tools` tinyint(4) NOT NULL DEFAULT 0,
  `is_spare_parts` tinyint(4) NOT NULL DEFAULT 0,
  `is_next_visit` tinyint(4) NOT NULL DEFAULT 0,
  `is_complete` tinyint(4) NOT NULL DEFAULT 0,
  `note` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `complaint_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tech_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mast_complaint_types`
--

CREATE TABLE `mast_complaint_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_complaint_types`
--

INSERT INTO `mast_complaint_types` (`id`, `name`, `description`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'New Installation', 'TEST-01', 1, 1, '2025-07-13 23:30:22', '2025-07-13 23:30:22'),
(2, 'Service Problem', 'TEST-02', 1, 1, '2025-07-13 23:30:22', '2025-07-13 23:30:22'),
(3, 'Gass Problem', 'TEST-03', 1, 1, '2025-07-13 23:30:22', '2025-07-13 23:30:22');

-- --------------------------------------------------------

--
-- Table structure for table `mast_customers`
--

CREATE TABLE `mast_customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `cont_person` varchar(255) DEFAULT NULL,
  `cont_designation` varchar(255) DEFAULT NULL,
  `cont_phone` varchar(255) DEFAULT NULL,
  `cont_email` text DEFAULT NULL,
  `web_address` text DEFAULT NULL,
  `credit_limit` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `mast_customer_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_customers`
--

INSERT INTO `mast_customers` (`id`, `name`, `email`, `phone`, `address`, `cont_person`, `cont_designation`, `cont_phone`, `cont_email`, `web_address`, `credit_limit`, `remarks`, `mast_customer_type_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Motiur Rahman', 'motiur.cmt@gmail.com', '01913954378', 'Shariatpur', 'Sagour Khan', 'Teacher', '01922437143', 'sagour@gmail.com', '', 1000000, 'Test Only', 1, 1, 1, '2025-07-13 23:30:22', '2025-07-13 23:30:22'),
(2, 'Sabbir', 'tayfa@gmail.com', '01913954378', 'Shariatpur', 'Alam Khan', 'Teacher', '01922437143', 'sagour@gmail.com', '', 1000000, 'Test Only', 1, 1, 1, '2025-07-13 23:30:22', '2025-07-13 23:30:22'),
(3, 'Minhaz', 'tayfa@gmail.com', '01913954378', 'Shariatpur', 'Sagour Khan', 'Teacher', '01922437143', 'tamim@gmail.com', '', 1000000, 'Test Only', 1, 1, 1, '2025-07-13 23:30:22', '2025-07-13 23:30:22'),
(4, 'Tamim', 'tayfa@gmail.com', '01913954378', 'Shariatpur', 'Motiur Khan', 'Teacher', '01922437143', 'sagour@gmail.com', '', 1000000, 'Test Only', 2, 1, 1, '2025-07-13 23:30:22', '2025-07-13 23:30:22'),
(5, 'Tayfa Islam', 'tayfa@gmail.com', '01913954378', 'Shariatpur', 'Sagour Khan', 'Teacher', '01922437143', 'koli@gmail.com', '', 1000000, 'Test Only', 3, 1, 1, '2025-07-13 23:30:22', '2025-07-13 23:30:22');

-- --------------------------------------------------------

--
-- Table structure for table `mast_customer_types`
--

CREATE TABLE `mast_customer_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_customer_types`
--

INSERT INTO `mast_customer_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Corporate', 1, '2025-07-13 23:30:22', '2025-07-13 23:30:22'),
(2, 'Distributer', 1, '2025-07-13 23:30:22', '2025-07-13 23:30:22'),
(3, 'Retailer', 1, '2025-07-13 23:30:22', '2025-07-13 23:30:22');

-- --------------------------------------------------------

--
-- Table structure for table `mast_departments`
--

CREATE TABLE `mast_departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dept_name` varchar(255) DEFAULT NULL,
  `dept_head` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_departments`
--

INSERT INTO `mast_departments` (`id`, `dept_name`, `dept_head`, `description`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Air Condition Sales', 1, NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(2, 'Air Condition Service', 1, NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(3, 'HR & Admin', 1, NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(4, 'Car Spear Parts', 1, NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(5, 'Store', 1, NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(6, 'Wear House', 1, NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(7, 'Accounts & Finnance', 1, NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `mast_designations`
--

CREATE TABLE `mast_designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `desig_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_designations`
--

INSERT INTO `mast_designations` (`id`, `desig_name`, `description`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'G.M (Sales & Admin)', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(2, 'AGM Finance & Accounts', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(3, 'Jr. Manager', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(4, 'Executive Officer (Sales & Service)', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(5, 'Sales Excecutive', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(6, 'Manager Sales', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(7, 'Sr. Manager Sales', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(8, 'General Manager (Commercial Division)', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(9, 'Managing Director', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(10, 'Head of Engineer (Service Section)', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(11, 'A.G.M Sales', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(12, 'Excecutive (Accounts)', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(13, 'Tecnichian', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(14, 'Director', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(15, 'Store In-Charge', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(16, 'Helper', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(17, 'Security', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(18, 'Store Keper', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(19, 'Electronics Tec.', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(20, 'Service Supervisor (Sr. Tec)', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(21, 'Peon', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(22, 'Welding Technician', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(23, 'Driver', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(24, 'Security In-charge', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(25, 'Imam', NULL, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `mast_employee_types`
--

CREATE TABLE `mast_employee_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_name` varchar(255) DEFAULT NULL,
  `cat_type` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_employee_types`
--

INSERT INTO `mast_employee_types` (`id`, `cat_name`, `cat_type`, `description`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Full-Time', '1', 'These are employees who work for the company on a regular basis and are typically paid a salary or an hourly wage. They may be eligible for benefits such as health insurance, retirement plans, and paid time off.', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(2, 'Half-Time', '1', 'These are employees who work for the company on a part-time basis, usually less than 40 hours per week. They may be paid an hourly wage and may or may not be eligible for benefits depending on the company policies.', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(3, 'Contract', '1', 'These are individuals who work for the company on a temporary basis and are usually hired to perform a specific job or task. They may be paid a flat fee or an hourly rate and are typically not eligible for benefits.', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(4, 'Interns', '1', 'These are students or recent graduates who work for the company on a temporary basis to gain work experience and develop skills. They may be paid a stipend or may work for free, and are typically not eligible for benefits.', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(5, 'Consultants', '1', 'These are individuals or firms who are hired by the company to provide specialized expertise or services on a project basis. They may be paid a flat fee or an hourly rate and are typically not eligible for benefits.', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(6, 'Seasonal Employees', '1', 'These are employees who work for the company during specific times of the year when there is a higher demand for the companys products or services. They may be paid an hourly wage and may or may not be eligible for benefits depending on the companys policies.', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `mast_holidays`
--

CREATE TABLE `mast_holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mast_item_categories`
--

CREATE TABLE `mast_item_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_item_categories`
--

INSERT INTO `mast_item_categories` (`id`, `cat_name`, `description`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AC', '', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(2, 'AC Spare Parts', '', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(3, 'Car Spare Parts', '', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(4, 'Tools Requisition', '', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `mast_item_groups`
--

CREATE TABLE `mast_item_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `mast_item_category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_item_groups`
--

INSERT INTO `mast_item_groups` (`id`, `part_name`, `description`, `mast_item_category_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Window Air Conditioners', '', 1, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(2, 'Split Air Conditioners', '', 1, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(3, 'Central Air Conditioning', '', 1, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(4, 'ARM BUSHING', '', 3, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(5, 'SUSPENSION BUSH', '', 3, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(6, 'REAR SUSPENSION BUSH', '', 3, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(7, 'SPRIN SHACKLE BUSH', '', 3, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(8, 'SHOCK ABSORBER BUSH', '', 3, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(9, 'SUPRING SHACKLE RUBBER', '', 3, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(10, 'UP ARM BUSHING', '', 3, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(11, 'FONT LOWER ARM BUSH', '', 3, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `mast_item_models`
--

CREATE TABLE `mast_item_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ton` varchar(255) DEFAULT NULL,
  `coling_capacity` varchar(255) DEFAULT NULL,
  `indoor` varchar(255) DEFAULT NULL,
  `outdoor` varchar(255) DEFAULT NULL,
  `full_set` varchar(255) DEFAULT NULL,
  `mast_item_group_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mast_item_registers`
--

CREATE TABLE `mast_item_registers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `box_code` int(11) DEFAULT NULL,
  `gulf_code` int(11) DEFAULT NULL,
  `part_no` varchar(255) DEFAULT NULL,
  `box_qty` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `warranty` int(11) DEFAULT NULL,
  `bar_code` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `unit_type` tinyint(4) DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `mast_item_models_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mast_item_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mast_item_group_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_item_registers`
--

INSERT INTO `mast_item_registers` (`id`, `box_code`, `gulf_code`, `part_no`, `box_qty`, `price`, `image`, `warranty`, `bar_code`, `description`, `unit_type`, `unit_id`, `mast_item_models_id`, `mast_item_category_id`, `mast_item_group_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(4, 6, 6, 'NO-234521', 12, '15000.00', 'WhatsApp_Image_2025-07-08_at_11.19.37_PM-removebg-preview_1752471165.png', 12, '91772965236', NULL, NULL, 4, NULL, 3, 11, 1, 1, '2025-07-13 23:32:46', '2025-07-13 23:32:46'),
(5, 7, 8, 'NO-234578', 6, '1000.00', 'WhatsApp Image 2025-07-08 at 4.41.28 PM_1752471545.jpeg', 6, '10232090165', 'Test', NULL, 4, NULL, 3, 4, 1, 1, '2025-07-13 23:39:05', '2025-07-13 23:39:05');

-- --------------------------------------------------------

--
-- Table structure for table `mast_leaves`
--

CREATE TABLE `mast_leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `leave_name` varchar(255) DEFAULT NULL,
  `leave_code` varchar(255) DEFAULT NULL,
  `max_limit` int(11) DEFAULT NULL,
  `yearly_limit` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_leaves`
--

INSERT INTO `mast_leaves` (`id`, `leave_name`, `leave_code`, `max_limit`, `yearly_limit`, `description`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Personal Leave', '01', 5, 2, 'N/A', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(2, 'Sick Leave', '02', 20, 3, 'N/A', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(3, 'Casual', '03', 10, 2, 'N/A', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(4, 'Vacation leave (Annual leave)', '04', 6, 1, 'N/A', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(5, 'Unpaid leave (or leave without pay)', '05', 3, 5, 'N/A', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(6, 'Study leave', '06', 40, 2, 'N/A', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `mast_packages`
--

CREATE TABLE `mast_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pkg_name` varchar(255) DEFAULT NULL,
  `pkg_size` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_packages`
--

INSERT INTO `mast_packages` (`id`, `pkg_name`, `pkg_size`, `description`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '1 X 1', 1, '', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(2, '1 X 4', 4, '', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(3, '1 X 6', 6, '', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(4, '1 X 8', 8, '', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(5, '1 X 10', 10, '', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(6, '1 X 12', 12, '', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(7, '1 X 16', 16, '', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(8, '1 X 20', 20, '', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(9, '1 X 24', 24, '', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(10, '1 X 36', 36, '', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(11, '1 X 48', 48, '', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `mast_suppliers`
--

CREATE TABLE `mast_suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_suppliers`
--

INSERT INTO `mast_suppliers` (`id`, `supplier_name`, `contact_person`, `email`, `phone_number`, `address`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Alam', 'Sagour Khan', 'alam@gmail.com', '01995275933', 'Shariatpur', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(2, 'Sabbir', 'Sagour Khan', 'sabbir@gmail.com', '01995275933', 'Shariatpur', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(3, 'Minhaz', 'Sagour Khan', 'minhaz@gmail.com', '01995275933', 'Shariatpur', 1, 1, '2025-07-13 23:30:22', '2025-07-13 23:30:22');

-- --------------------------------------------------------

--
-- Table structure for table `mast_units`
--

CREATE TABLE `mast_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `mast_item_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_units`
--

INSERT INTO `mast_units` (`id`, `unit_name`, `description`, `mast_item_category_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Set (set)', 'Count', 1, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(2, 'Piece (pcs)', 'Count', 1, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(3, 'Dozen (doz)', 'Count', 2, 1, 2, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(4, 'Pack (pk)', 'Count', 3, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(5, 'Milligram (mg)', 'Weight/Mass', 3, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(6, 'Gram (g)', 'Weight/Mass', 3, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(7, 'Kilogram (kg)', 'Weight/Mass', 2, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(8, 'Metric Ton (MT)', 'Weight/Mass', 2, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(9, 'Ounce (oz)', 'Weight/Mass', 2, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(10, 'Pound (lb)', 'Weight/Mass', 2, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(11, 'Square Meter (m²)', 'Area', 2, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(12, 'Square Foot (sq ft)', 'Area', 3, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(13, 'Acre (ac)', 'Area', 3, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(14, 'Square Kilometer (sq km)', 'Area', 2, 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `mast_work_stations`
--

CREATE TABLE `mast_work_stations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_name` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `location` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_work_stations`
--

INSERT INTO `mast_work_stations` (`id`, `store_name`, `contact_number`, `location`, `description`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Central Storehouse', '01995275933', 'Gulshan', 'This is time off that a female employee can take before and after childbirth. Maternity leave may be paid or unpaid, depending on the company policies.', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(2, 'Gulf international associates ltd.', '01995275933', 'Gulshan', 'This is time off that a female employee can take before and after childbirth. Maternity leave may be paid or unpaid, depending on the company policies.', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(3, 'Icon information Systems ltd.', '01995275933', 'Mirpur', 'This is time off that a female employee can take before and after childbirth. Maternity leave may be paid or unpaid, depending on the company policies.', 1, 1, '2025-07-13 23:30:21', '2025-07-13 23:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_09_25_024913_create_todos_table', 1),
(7, '2022_08_27_075954_create_sessions_table', 1),
(8, '2022_09_08_010102_create_mast_holidays_table', 1),
(9, '2022_09_08_043923_create_permission_tables', 1),
(10, '2022_09_08_043924_create_mast_departments_table', 1),
(11, '2022_09_08_043925_create_mast_designations_table', 1),
(12, '2022_09_08_043926_create_mast_leaves_table', 1),
(13, '2022_09_08_043927_create_mast_employee_types_table', 1),
(14, '2022_09_08_043928_create_mast_work_stations_table', 1),
(15, '2022_09_08_043929_create_mast_item_categories_table', 1),
(16, '2022_09_08_043930_create_mast_packages_table', 1),
(17, '2022_09_08_043930_create_mast_units_table', 1),
(18, '2022_09_08_043931_create_mast_item_groups_table', 1),
(19, '2022_09_08_043932_create_mast_item_registers_table', 1),
(20, '2022_09_08_043933_create_mast_suppliers_table', 1),
(21, '2022_09_08_043934_create_mast_customer_types_table', 1),
(22, '2022_09_08_043935_create_mast_customers_table', 1),
(23, '2022_09_08_043936_create_mast_complaint_types_table', 1),
(24, '2022_09_08_043937_create_mast_item_models_table', 1),
(25, '2023_04_16_081138_create_info_personals_table', 1),
(26, '2023_04_27_063610_create_info_educationals_table', 1),
(27, '2023_04_27_063611_create_info_work_experiences_table', 1),
(28, '2023_04_27_063612_create_info_banks_table', 1),
(29, '2023_04_27_063613_create_info_nominees_table', 1),
(30, '2023_04_30_034227_create_hr_attendances_table', 1),
(31, '2023_04_30_034227_create_hr_leave_applications_table', 1),
(32, '2023_04_30_200003_create_salary_structures_table', 1),
(33, '2023_04_30_200004_create_salary_sheets_table', 1),
(34, '2023_05_15_052417_create_purchases_table', 1),
(35, '2023_05_17_053821_create_purchase_details_table', 1),
(36, '2023_06_05_104849_create_quotations_table', 1),
(37, '2023_06_05_104850_create_quotation_details_table', 1),
(38, '2023_06_05_104851_create_sales_table', 1),
(39, '2023_06_05_115459_create_sales_details_table', 1),
(40, '2023_07_09_083700_create_store_transfers_table', 1),
(41, '2023_07_09_101840_create_store_transfer_details_table', 1),
(42, '2023_07_09_101841_create_deliveries_table', 1),
(43, '2023_07_16_083217_create_sales_returns_table', 1),
(44, '2023_07_16_093835_create_sales_return_details_table', 1),
(45, '2023_07_24_085305_create_complaints_table', 1),
(46, '2023_07_24_091706_create_job_cards_table', 1),
(47, '2023_07_25_084447_create_service_bills_table', 1),
(48, '2023_07_25_085132_create_service_bill_details_table', 1),
(49, '2023_07_27_052142_create_requisitions_table', 1),
(50, '2023_07_27_052212_create_requisition_details_table', 1),
(51, '2023_08_08_062121_create_reference_types_table', 1),
(52, '2023_08_09_052658_create_sl_movements_table', 1),
(53, '2023_08_10_063321_create_setups_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super-Admin', 'web', '2025-07-13 23:30:20', '2025-07-13 23:30:20'),
(2, 'Admin', 'web', '2025-07-13 23:30:20', '2025-07-13 23:30:20'),
(3, 'Moderator', 'web', '2025-07-13 23:30:20', '2025-07-13 23:30:20'),
(4, 'Manager', 'web', '2025-07-13 23:30:20', '2025-07-13 23:30:20'),
(5, 'Supervisor', 'web', '2025-07-13 23:30:20', '2025-07-13 23:30:20'),
(6, 'Employee', 'web', '2025-07-13 23:30:20', '2025-07-13 23:30:20'),
(7, 'Viewer', 'web', '2025-07-13 23:30:20', '2025-07-13 23:30:20'),
(8, 'Editor', 'web', '2025-07-13 23:30:20', '2025-07-13 23:30:20'),
(9, 'Customer', 'web', '2025-07-13 23:30:20', '2025-07-13 23:30:20'),
(10, 'Sales', 'web', '2025-07-13 23:30:20', '2025-07-13 23:30:20'),
(11, 'Support', 'web', '2025-07-13 23:30:20', '2025-07-13 23:30:20'),
(12, 'Developer', 'web', '2025-07-13 23:30:20', '2025-07-13 23:30:20'),
(13, 'Analyst', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(14, 'Tester', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(15, 'Guest', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(16, 'Marketing', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(17, 'Finance', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(18, 'HR', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(19, 'Hr access', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(20, 'Inventory access', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(21, 'Sales access', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(22, 'Warrenty access', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(23, 'Employee access', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(24, 'Employee create', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(25, 'Employee edit', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(26, 'Employee delete', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(27, 'Leave access', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(28, 'Leave create', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(29, 'Leave edit', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(30, 'Leave delete', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(31, 'Attendance access', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(32, 'Attendance create', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(33, 'Attendance edit', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(34, 'Attendance delete', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(35, 'Salary access', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(36, 'Salary create', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(37, 'Salary edit', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(38, 'Salary delete', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(39, 'Hr setting access', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(40, 'Inventory setting access', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(41, 'Sales setting access', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(42, 'Warrenty setting access', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(43, 'User access', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(44, 'User create', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(45, 'User edit', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(46, 'User delete', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(47, 'Role access', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(48, 'Role create', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(49, 'Role edit', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(50, 'Role delete', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inv_date` date DEFAULT NULL,
  `inv_no` varchar(255) DEFAULT NULL,
  `vat` double(8,2) DEFAULT 0.00,
  `tax` double(8,2) DEFAULT 0.00,
  `remarks` text DEFAULT NULL,
  `mast_item_category_id` bigint(20) UNSIGNED NOT NULL,
  `mast_work_station_id` bigint(20) UNSIGNED NOT NULL,
  `mast_supplier_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_parsial` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `inv_date`, `inv_no`, `vat`, `tax`, `remarks`, `mast_item_category_id`, `mast_work_station_id`, `mast_supplier_id`, `user_id`, `is_parsial`, `status`, `created_at`, `updated_at`) VALUES
(1, '2025-07-14', 'INV-NO-00000', 0.00, 0.00, NULL, 3, 1, 1, 1, 0, 4, '2025-07-13 23:34:56', '2025-07-13 23:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `rcv_qty` int(11) DEFAULT NULL,
  `mast_item_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `mast_item_register_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `qty`, `price`, `rcv_qty`, `mast_item_category_id`, `purchase_id`, `mast_item_register_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, '50000.00', 3, 3, 1, 4, 1, 1, '2025-07-13 23:34:56', '2025-07-13 23:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quot_date` date DEFAULT NULL,
  `quot_no` varchar(255) DEFAULT NULL,
  `vat` double(8,2) DEFAULT 0.00,
  `tax` double(8,2) DEFAULT 0.00,
  `remarks` text DEFAULT NULL,
  `mast_item_category_id` bigint(20) UNSIGNED NOT NULL,
  `mast_customer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_sales` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_details`
--

CREATE TABLE `quotation_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `mast_item_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quotation_id` bigint(20) UNSIGNED NOT NULL,
  `mast_item_register_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reference_types`
--

CREATE TABLE `reference_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reference_types`
--

INSERT INTO `reference_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Purchase', 1, '2025-07-13 23:30:22', '2025-07-13 23:30:22'),
(2, 'Sales', 1, '2025-07-13 23:30:22', '2025-07-13 23:30:22'),
(3, 'Store Transfer', 1, '2025-07-13 23:30:22', '2025-07-13 23:30:22'),
(4, 'Sales Return', 1, '2025-07-13 23:30:22', '2025-07-13 23:30:22');

-- --------------------------------------------------------

--
-- Table structure for table `requisitions`
--

CREATE TABLE `requisitions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requ_no` varchar(255) DEFAULT NULL,
  `requ_date` date DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `complaint_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tech_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requisition_details`
--

CREATE TABLE `requisition_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requisition_id` bigint(20) UNSIGNED NOT NULL,
  `mast_item_category_id` bigint(20) UNSIGNED NOT NULL,
  `mast_item_group_id` bigint(20) UNSIGNED NOT NULL,
  `mast_item_register_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `rcv_qty` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super-Admin', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21'),
(2, 'Admin', 'web', '2025-07-13 23:30:21', '2025-07-13 23:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `salary_sheets`
--

CREATE TABLE `salary_sheets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `salary_year` varchar(10) DEFAULT NULL,
  `salary_month` varchar(10) DEFAULT NULL,
  `basic_pay` decimal(10,2) DEFAULT NULL,
  `house_rent_pay` decimal(10,2) DEFAULT NULL,
  `medical_pay` decimal(10,2) DEFAULT NULL,
  `conveyance_pay` decimal(10,2) DEFAULT NULL,
  `additional_pay` decimal(10,2) DEFAULT NULL,
  `basic` decimal(10,2) DEFAULT NULL,
  `house_rent` decimal(10,2) DEFAULT NULL,
  `medical` decimal(10,2) DEFAULT NULL,
  `conveyance` decimal(10,2) DEFAULT NULL,
  `additional` decimal(10,2) DEFAULT NULL,
  `gross` decimal(10,2) DEFAULT NULL,
  `pf_dedaction` decimal(10,2) DEFAULT NULL,
  `loan_dedaction` decimal(10,2) DEFAULT NULL,
  `tax_dedaction` decimal(10,2) DEFAULT NULL,
  `mobile_dedaction` decimal(10,2) DEFAULT NULL,
  `other_dedaction` decimal(10,2) DEFAULT NULL,
  `dedaction` decimal(10,2) DEFAULT NULL,
  `net_pay` decimal(10,2) DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `mast_work_station_id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary_structures`
--

CREATE TABLE `salary_structures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gross_salary` decimal(10,2) DEFAULT NULL,
  `basic` decimal(10,2) DEFAULT NULL,
  `house_rent` decimal(10,2) DEFAULT NULL,
  `medical` decimal(10,2) DEFAULT NULL,
  `conveyance` decimal(10,2) DEFAULT NULL,
  `additional` decimal(10,2) DEFAULT NULL,
  `overtime` decimal(10,2) DEFAULT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inv_date` date DEFAULT NULL,
  `inv_no` varchar(255) DEFAULT NULL,
  `ref_date` date DEFAULT NULL,
  `ref_no` varchar(255) DEFAULT NULL,
  `vat` double(8,2) DEFAULT 0.00,
  `tax` double(8,2) DEFAULT 0.00,
  `total` decimal(8,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `quotation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mast_item_category_id` bigint(20) UNSIGNED NOT NULL,
  `mast_customer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_parsial` tinyint(4) NOT NULL DEFAULT 0,
  `is_return` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `deli_qty` int(11) DEFAULT NULL,
  `mast_item_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sales_id` bigint(20) UNSIGNED NOT NULL,
  `mast_item_register_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_returns`
--

CREATE TABLE `sales_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `return_no` varchar(255) DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `from_store_id` int(11) DEFAULT NULL,
  `mast_work_station_id` bigint(20) UNSIGNED NOT NULL,
  `sales_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_parsial` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_return_details`
--

CREATE TABLE `sales_return_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `rcv_qty` int(11) DEFAULT NULL,
  `sales_return_id` bigint(20) UNSIGNED NOT NULL,
  `mast_item_register_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_bills`
--

CREATE TABLE `service_bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bill_no` varchar(255) DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `complaint_id` bigint(20) UNSIGNED NOT NULL,
  `mast_customer_id` bigint(20) UNSIGNED NOT NULL,
  `tech_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `remarks` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_bill_details`
--

CREATE TABLE `service_bill_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `service_bill_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4gI0AVlRQlfxe2gqRWnVpLzBx4pXkiFYQAwi3OQV', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieWEzV0Y2alh3cFByOFkwMmdTd1JjcThFam42bTl1aHROc3JmTmFYRyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ2OiJodHRwOi8vbG9jYWxob3N0L2d1bGZfZXJwL3N0b2NrLXBvc2l0aW9uL2luZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1752471821);

-- --------------------------------------------------------

--
-- Table structure for table `setups`
--

CREATE TABLE `setups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `install_technician` int(11) DEFAULT NULL,
  `services_technician` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setups`
--

INSERT INTO `setups` (`id`, `install_technician`, `services_technician`, `created_at`, `updated_at`) VALUES
(1, 10, 9, '2025-07-13 23:30:22', '2025-07-13 23:30:22');

-- --------------------------------------------------------

--
-- Table structure for table `sl_movements`
--

CREATE TABLE `sl_movements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `reference_type_id` bigint(20) UNSIGNED NOT NULL,
  `mast_item_register_id` bigint(20) UNSIGNED NOT NULL,
  `mast_work_station_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `out_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sl_movements`
--

INSERT INTO `sl_movements` (`id`, `serial_no`, `reference_id`, `reference_type_id`, `mast_item_register_id`, `mast_work_station_id`, `user_id`, `out_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'a1', 1, 1, 4, 1, 1, NULL, 1, '2025-07-13 23:35:27', '2025-07-13 23:35:27'),
(2, 'a2', 1, 1, 4, 1, 1, NULL, 1, '2025-07-13 23:35:27', '2025-07-13 23:35:27'),
(3, 'a3', 1, 1, 4, 1, 1, NULL, 1, '2025-07-13 23:35:27', '2025-07-13 23:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `store_transfers`
--

CREATE TABLE `store_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inv_date` date DEFAULT NULL,
  `inv_no` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `from_store_id` int(11) DEFAULT NULL,
  `mast_work_station_id` bigint(20) UNSIGNED NOT NULL,
  `mast_item_category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_parsial` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_transfer_details`
--

CREATE TABLE `store_transfer_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `deli_qty` int(11) DEFAULT NULL,
  `mast_item_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `store_transfer_id` bigint(20) UNSIGNED NOT NULL,
  `mast_item_register_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `employee_code` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(255) DEFAULT NULL,
  `mast_work_station_id` int(11) NOT NULL DEFAULT 1,
  `attendance_id` int(11) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact_number`, `employee_code`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `mast_work_station_id`, `attendance_id`, `is_admin`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SUPER-ERP', 'super@gmail.com', '01909302126', 'GF-00000', '2023-12-31 18:00:00', '$2y$10$9X0JXnrJmBxmIB3ftmV1fe8o36o9KiVJxBBquwvSLZi.ahn6.ZRlG', NULL, NULL, NULL, NULL, NULL, 'fix/admin.jpg', 1, NULL, 1, 1, '2025-07-13 23:30:20', '2025-07-13 23:30:20'),
(2, 'Gulf-ERP', 'admin@gmail.com', '01909302126', 'GF-00000', '2023-12-31 18:00:00', '$2y$10$aUeew0AXexC6TGwJ6URSsuGLQPmZ31EGUcne79XAqZxG/iPMhqQ1K', NULL, NULL, NULL, NULL, NULL, 'fix/admin.jpg', 2, NULL, 0, 1, '2025-07-13 23:30:20', '2025-07-13 23:30:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaints_mast_complaint_type_id_foreign` (`mast_complaint_type_id`),
  ADD KEY `complaints_mast_customer_id_foreign` (`mast_customer_id`),
  ADD KEY `complaints_user_id_foreign` (`user_id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deliveries_sales_id_foreign` (`sales_id`),
  ADD KEY `deliveries_mast_customer_id_foreign` (`mast_customer_id`),
  ADD KEY `deliveries_mast_work_station_id_foreign` (`mast_work_station_id`),
  ADD KEY `deliveries_mast_item_register_id_foreign` (`mast_item_register_id`),
  ADD KEY `deliveries_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hr_attendances`
--
ALTER TABLE `hr_attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hr_attendances_emp_id_foreign` (`emp_id`),
  ADD KEY `hr_attendances_user_id_foreign` (`user_id`);

--
-- Indexes for table `hr_leave_applications`
--
ALTER TABLE `hr_leave_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hr_leave_applications_mast_leave_id_foreign` (`mast_leave_id`),
  ADD KEY `hr_leave_applications_emp_id_foreign` (`emp_id`),
  ADD KEY `hr_leave_applications_user_id_foreign` (`user_id`);

--
-- Indexes for table `info_banks`
--
ALTER TABLE `info_banks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_banks_emp_id_foreign` (`emp_id`),
  ADD KEY `info_banks_user_id_foreign` (`user_id`);

--
-- Indexes for table `info_educationals`
--
ALTER TABLE `info_educationals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_educationals_emp_id_foreign` (`emp_id`),
  ADD KEY `info_educationals_user_id_foreign` (`user_id`);

--
-- Indexes for table `info_nominees`
--
ALTER TABLE `info_nominees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_nominees_emp_id_foreign` (`emp_id`),
  ADD KEY `info_nominees_user_id_foreign` (`user_id`);

--
-- Indexes for table `info_personals`
--
ALTER TABLE `info_personals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_personals_mast_department_id_foreign` (`mast_department_id`),
  ADD KEY `info_personals_mast_designation_id_foreign` (`mast_designation_id`),
  ADD KEY `info_personals_mast_employee_type_id_foreign` (`mast_employee_type_id`),
  ADD KEY `info_personals_mast_work_station_id_foreign` (`mast_work_station_id`),
  ADD KEY `info_personals_emp_id_foreign` (`emp_id`),
  ADD KEY `info_personals_user_id_foreign` (`user_id`);

--
-- Indexes for table `info_work_experiences`
--
ALTER TABLE `info_work_experiences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_work_experiences_emp_id_foreign` (`emp_id`),
  ADD KEY `info_work_experiences_user_id_foreign` (`user_id`);

--
-- Indexes for table `job_cards`
--
ALTER TABLE `job_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_cards_complaint_id_foreign` (`complaint_id`),
  ADD KEY `job_cards_tech_id_foreign` (`tech_id`),
  ADD KEY `job_cards_user_id_foreign` (`user_id`);

--
-- Indexes for table `mast_complaint_types`
--
ALTER TABLE `mast_complaint_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mast_complaint_types_user_id_foreign` (`user_id`);

--
-- Indexes for table `mast_customers`
--
ALTER TABLE `mast_customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mast_customers_mast_customer_type_id_foreign` (`mast_customer_type_id`),
  ADD KEY `mast_customers_user_id_foreign` (`user_id`);

--
-- Indexes for table `mast_customer_types`
--
ALTER TABLE `mast_customer_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mast_departments`
--
ALTER TABLE `mast_departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mast_departments_user_id_foreign` (`user_id`);

--
-- Indexes for table `mast_designations`
--
ALTER TABLE `mast_designations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mast_designations_user_id_foreign` (`user_id`);

--
-- Indexes for table `mast_employee_types`
--
ALTER TABLE `mast_employee_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mast_employee_types_user_id_foreign` (`user_id`);

--
-- Indexes for table `mast_holidays`
--
ALTER TABLE `mast_holidays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mast_holidays_user_id_foreign` (`user_id`);

--
-- Indexes for table `mast_item_categories`
--
ALTER TABLE `mast_item_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mast_item_categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `mast_item_groups`
--
ALTER TABLE `mast_item_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mast_item_groups_mast_item_category_id_foreign` (`mast_item_category_id`),
  ADD KEY `mast_item_groups_user_id_foreign` (`user_id`);

--
-- Indexes for table `mast_item_models`
--
ALTER TABLE `mast_item_models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mast_item_models_mast_item_group_id_foreign` (`mast_item_group_id`),
  ADD KEY `mast_item_models_user_id_foreign` (`user_id`);

--
-- Indexes for table `mast_item_registers`
--
ALTER TABLE `mast_item_registers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mast_item_registers_unit_id_foreign` (`unit_id`),
  ADD KEY `mast_item_registers_mast_item_group_id_foreign` (`mast_item_group_id`),
  ADD KEY `mast_item_registers_user_id_foreign` (`user_id`);

--
-- Indexes for table `mast_leaves`
--
ALTER TABLE `mast_leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mast_leaves_user_id_foreign` (`user_id`);

--
-- Indexes for table `mast_packages`
--
ALTER TABLE `mast_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mast_packages_user_id_foreign` (`user_id`);

--
-- Indexes for table `mast_suppliers`
--
ALTER TABLE `mast_suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mast_suppliers_user_id_foreign` (`user_id`);

--
-- Indexes for table `mast_units`
--
ALTER TABLE `mast_units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mast_units_mast_item_category_id_foreign` (`mast_item_category_id`),
  ADD KEY `mast_units_user_id_foreign` (`user_id`);

--
-- Indexes for table `mast_work_stations`
--
ALTER TABLE `mast_work_stations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mast_work_stations_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_mast_item_category_id_foreign` (`mast_item_category_id`),
  ADD KEY `purchases_mast_work_station_id_foreign` (`mast_work_station_id`),
  ADD KEY `purchases_mast_supplier_id_foreign` (`mast_supplier_id`),
  ADD KEY `purchases_user_id_foreign` (`user_id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_details_purchase_id_foreign` (`purchase_id`),
  ADD KEY `purchase_details_mast_item_register_id_foreign` (`mast_item_register_id`),
  ADD KEY `purchase_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quotations_mast_item_category_id_foreign` (`mast_item_category_id`),
  ADD KEY `quotations_mast_customer_id_foreign` (`mast_customer_id`),
  ADD KEY `quotations_user_id_foreign` (`user_id`);

--
-- Indexes for table `quotation_details`
--
ALTER TABLE `quotation_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quotation_details_quotation_id_foreign` (`quotation_id`),
  ADD KEY `quotation_details_mast_item_register_id_foreign` (`mast_item_register_id`),
  ADD KEY `quotation_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `reference_types`
--
ALTER TABLE `reference_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requisitions_tech_id_foreign` (`tech_id`),
  ADD KEY `requisitions_user_id_foreign` (`user_id`);

--
-- Indexes for table `requisition_details`
--
ALTER TABLE `requisition_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requisition_details_requisition_id_foreign` (`requisition_id`),
  ADD KEY `requisition_details_mast_item_category_id_foreign` (`mast_item_category_id`),
  ADD KEY `requisition_details_mast_item_group_id_foreign` (`mast_item_group_id`),
  ADD KEY `requisition_details_mast_item_register_id_foreign` (`mast_item_register_id`),
  ADD KEY `requisition_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `salary_sheets`
--
ALTER TABLE `salary_sheets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salary_sheets_mast_work_station_id_foreign` (`mast_work_station_id`),
  ADD KEY `salary_sheets_emp_id_foreign` (`emp_id`),
  ADD KEY `salary_sheets_user_id_foreign` (`user_id`);

--
-- Indexes for table `salary_structures`
--
ALTER TABLE `salary_structures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salary_structures_emp_id_foreign` (`emp_id`),
  ADD KEY `salary_structures_user_id_foreign` (`user_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_mast_item_category_id_foreign` (`mast_item_category_id`),
  ADD KEY `sales_mast_customer_id_foreign` (`mast_customer_id`),
  ADD KEY `sales_user_id_foreign` (`user_id`);

--
-- Indexes for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_details_sales_id_foreign` (`sales_id`),
  ADD KEY `sales_details_mast_item_register_id_foreign` (`mast_item_register_id`),
  ADD KEY `sales_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `sales_returns`
--
ALTER TABLE `sales_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_returns_mast_work_station_id_foreign` (`mast_work_station_id`),
  ADD KEY `sales_returns_sales_id_foreign` (`sales_id`),
  ADD KEY `sales_returns_user_id_foreign` (`user_id`);

--
-- Indexes for table `sales_return_details`
--
ALTER TABLE `sales_return_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_return_details_sales_return_id_foreign` (`sales_return_id`),
  ADD KEY `sales_return_details_mast_item_register_id_foreign` (`mast_item_register_id`),
  ADD KEY `sales_return_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `service_bills`
--
ALTER TABLE `service_bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_bills_complaint_id_foreign` (`complaint_id`),
  ADD KEY `service_bills_mast_customer_id_foreign` (`mast_customer_id`),
  ADD KEY `service_bills_tech_id_foreign` (`tech_id`),
  ADD KEY `service_bills_user_id_foreign` (`user_id`);

--
-- Indexes for table `service_bill_details`
--
ALTER TABLE `service_bill_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_bill_details_service_bill_id_foreign` (`service_bill_id`),
  ADD KEY `service_bill_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `setups`
--
ALTER TABLE `setups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sl_movements`
--
ALTER TABLE `sl_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sl_movements_reference_type_id_foreign` (`reference_type_id`),
  ADD KEY `sl_movements_mast_item_register_id_foreign` (`mast_item_register_id`),
  ADD KEY `sl_movements_mast_work_station_id_foreign` (`mast_work_station_id`),
  ADD KEY `sl_movements_user_id_foreign` (`user_id`);

--
-- Indexes for table `store_transfers`
--
ALTER TABLE `store_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_transfers_mast_work_station_id_foreign` (`mast_work_station_id`),
  ADD KEY `store_transfers_mast_item_category_id_foreign` (`mast_item_category_id`),
  ADD KEY `store_transfers_user_id_foreign` (`user_id`);

--
-- Indexes for table `store_transfer_details`
--
ALTER TABLE `store_transfer_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_transfer_details_store_transfer_id_foreign` (`store_transfer_id`),
  ADD KEY `store_transfer_details_mast_item_register_id_foreign` (`mast_item_register_id`),
  ADD KEY `store_transfer_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
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
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_attendances`
--
ALTER TABLE `hr_attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_leave_applications`
--
ALTER TABLE `hr_leave_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_banks`
--
ALTER TABLE `info_banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_educationals`
--
ALTER TABLE `info_educationals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_nominees`
--
ALTER TABLE `info_nominees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_personals`
--
ALTER TABLE `info_personals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_work_experiences`
--
ALTER TABLE `info_work_experiences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_cards`
--
ALTER TABLE `job_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mast_complaint_types`
--
ALTER TABLE `mast_complaint_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mast_customers`
--
ALTER TABLE `mast_customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mast_customer_types`
--
ALTER TABLE `mast_customer_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mast_departments`
--
ALTER TABLE `mast_departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mast_designations`
--
ALTER TABLE `mast_designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `mast_employee_types`
--
ALTER TABLE `mast_employee_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mast_holidays`
--
ALTER TABLE `mast_holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mast_item_categories`
--
ALTER TABLE `mast_item_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mast_item_groups`
--
ALTER TABLE `mast_item_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mast_item_models`
--
ALTER TABLE `mast_item_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mast_item_registers`
--
ALTER TABLE `mast_item_registers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mast_leaves`
--
ALTER TABLE `mast_leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mast_packages`
--
ALTER TABLE `mast_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mast_suppliers`
--
ALTER TABLE `mast_suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mast_units`
--
ALTER TABLE `mast_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mast_work_stations`
--
ALTER TABLE `mast_work_stations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_details`
--
ALTER TABLE `quotation_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reference_types`
--
ALTER TABLE `reference_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `requisitions`
--
ALTER TABLE `requisitions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requisition_details`
--
ALTER TABLE `requisition_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salary_sheets`
--
ALTER TABLE `salary_sheets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary_structures`
--
ALTER TABLE `salary_structures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_returns`
--
ALTER TABLE `sales_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_return_details`
--
ALTER TABLE `sales_return_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_bills`
--
ALTER TABLE `service_bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_bill_details`
--
ALTER TABLE `service_bill_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setups`
--
ALTER TABLE `setups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sl_movements`
--
ALTER TABLE `sl_movements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `store_transfers`
--
ALTER TABLE `store_transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_transfer_details`
--
ALTER TABLE `store_transfer_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_mast_complaint_type_id_foreign` FOREIGN KEY (`mast_complaint_type_id`) REFERENCES `mast_complaint_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `complaints_mast_customer_id_foreign` FOREIGN KEY (`mast_customer_id`) REFERENCES `mast_customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `complaints_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_mast_customer_id_foreign` FOREIGN KEY (`mast_customer_id`) REFERENCES `mast_customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `deliveries_mast_item_register_id_foreign` FOREIGN KEY (`mast_item_register_id`) REFERENCES `mast_item_registers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `deliveries_mast_work_station_id_foreign` FOREIGN KEY (`mast_work_station_id`) REFERENCES `mast_work_stations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `deliveries_sales_id_foreign` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `deliveries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hr_attendances`
--
ALTER TABLE `hr_attendances`
  ADD CONSTRAINT `hr_attendances_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_attendances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hr_leave_applications`
--
ALTER TABLE `hr_leave_applications`
  ADD CONSTRAINT `hr_leave_applications_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_leave_applications_mast_leave_id_foreign` FOREIGN KEY (`mast_leave_id`) REFERENCES `mast_leaves` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_leave_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `info_banks`
--
ALTER TABLE `info_banks`
  ADD CONSTRAINT `info_banks_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `info_banks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `info_educationals`
--
ALTER TABLE `info_educationals`
  ADD CONSTRAINT `info_educationals_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `info_educationals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `info_nominees`
--
ALTER TABLE `info_nominees`
  ADD CONSTRAINT `info_nominees_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `info_nominees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `info_personals`
--
ALTER TABLE `info_personals`
  ADD CONSTRAINT `info_personals_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `info_personals_mast_department_id_foreign` FOREIGN KEY (`mast_department_id`) REFERENCES `mast_departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `info_personals_mast_designation_id_foreign` FOREIGN KEY (`mast_designation_id`) REFERENCES `mast_designations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `info_personals_mast_employee_type_id_foreign` FOREIGN KEY (`mast_employee_type_id`) REFERENCES `mast_employee_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `info_personals_mast_work_station_id_foreign` FOREIGN KEY (`mast_work_station_id`) REFERENCES `mast_work_stations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `info_personals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `info_work_experiences`
--
ALTER TABLE `info_work_experiences`
  ADD CONSTRAINT `info_work_experiences_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `info_work_experiences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_cards`
--
ALTER TABLE `job_cards`
  ADD CONSTRAINT `job_cards_complaint_id_foreign` FOREIGN KEY (`complaint_id`) REFERENCES `complaints` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_cards_tech_id_foreign` FOREIGN KEY (`tech_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_cards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mast_complaint_types`
--
ALTER TABLE `mast_complaint_types`
  ADD CONSTRAINT `mast_complaint_types_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mast_customers`
--
ALTER TABLE `mast_customers`
  ADD CONSTRAINT `mast_customers_mast_customer_type_id_foreign` FOREIGN KEY (`mast_customer_type_id`) REFERENCES `mast_customer_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mast_customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mast_departments`
--
ALTER TABLE `mast_departments`
  ADD CONSTRAINT `mast_departments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mast_designations`
--
ALTER TABLE `mast_designations`
  ADD CONSTRAINT `mast_designations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mast_employee_types`
--
ALTER TABLE `mast_employee_types`
  ADD CONSTRAINT `mast_employee_types_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mast_holidays`
--
ALTER TABLE `mast_holidays`
  ADD CONSTRAINT `mast_holidays_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mast_item_categories`
--
ALTER TABLE `mast_item_categories`
  ADD CONSTRAINT `mast_item_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mast_item_groups`
--
ALTER TABLE `mast_item_groups`
  ADD CONSTRAINT `mast_item_groups_mast_item_category_id_foreign` FOREIGN KEY (`mast_item_category_id`) REFERENCES `mast_item_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mast_item_groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mast_item_models`
--
ALTER TABLE `mast_item_models`
  ADD CONSTRAINT `mast_item_models_mast_item_group_id_foreign` FOREIGN KEY (`mast_item_group_id`) REFERENCES `mast_item_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mast_item_models_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mast_item_registers`
--
ALTER TABLE `mast_item_registers`
  ADD CONSTRAINT `mast_item_registers_mast_item_group_id_foreign` FOREIGN KEY (`mast_item_group_id`) REFERENCES `mast_item_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mast_item_registers_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `mast_units` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mast_item_registers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mast_leaves`
--
ALTER TABLE `mast_leaves`
  ADD CONSTRAINT `mast_leaves_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mast_packages`
--
ALTER TABLE `mast_packages`
  ADD CONSTRAINT `mast_packages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mast_suppliers`
--
ALTER TABLE `mast_suppliers`
  ADD CONSTRAINT `mast_suppliers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mast_units`
--
ALTER TABLE `mast_units`
  ADD CONSTRAINT `mast_units_mast_item_category_id_foreign` FOREIGN KEY (`mast_item_category_id`) REFERENCES `mast_item_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mast_units_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mast_work_stations`
--
ALTER TABLE `mast_work_stations`
  ADD CONSTRAINT `mast_work_stations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_mast_item_category_id_foreign` FOREIGN KEY (`mast_item_category_id`) REFERENCES `mast_item_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchases_mast_supplier_id_foreign` FOREIGN KEY (`mast_supplier_id`) REFERENCES `mast_suppliers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchases_mast_work_station_id_foreign` FOREIGN KEY (`mast_work_station_id`) REFERENCES `mast_work_stations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD CONSTRAINT `purchase_details_mast_item_register_id_foreign` FOREIGN KEY (`mast_item_register_id`) REFERENCES `mast_item_registers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_details_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quotations`
--
ALTER TABLE `quotations`
  ADD CONSTRAINT `quotations_mast_customer_id_foreign` FOREIGN KEY (`mast_customer_id`) REFERENCES `mast_customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quotations_mast_item_category_id_foreign` FOREIGN KEY (`mast_item_category_id`) REFERENCES `mast_item_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quotations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quotation_details`
--
ALTER TABLE `quotation_details`
  ADD CONSTRAINT `quotation_details_mast_item_register_id_foreign` FOREIGN KEY (`mast_item_register_id`) REFERENCES `mast_item_registers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quotation_details_quotation_id_foreign` FOREIGN KEY (`quotation_id`) REFERENCES `quotations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quotation_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD CONSTRAINT `requisitions_tech_id_foreign` FOREIGN KEY (`tech_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `requisitions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requisition_details`
--
ALTER TABLE `requisition_details`
  ADD CONSTRAINT `requisition_details_mast_item_category_id_foreign` FOREIGN KEY (`mast_item_category_id`) REFERENCES `mast_item_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `requisition_details_mast_item_group_id_foreign` FOREIGN KEY (`mast_item_group_id`) REFERENCES `mast_item_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `requisition_details_mast_item_register_id_foreign` FOREIGN KEY (`mast_item_register_id`) REFERENCES `mast_item_registers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `requisition_details_requisition_id_foreign` FOREIGN KEY (`requisition_id`) REFERENCES `requisitions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `requisition_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salary_sheets`
--
ALTER TABLE `salary_sheets`
  ADD CONSTRAINT `salary_sheets_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `salary_sheets_mast_work_station_id_foreign` FOREIGN KEY (`mast_work_station_id`) REFERENCES `mast_work_stations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `salary_sheets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salary_structures`
--
ALTER TABLE `salary_structures`
  ADD CONSTRAINT `salary_structures_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `salary_structures_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_mast_customer_id_foreign` FOREIGN KEY (`mast_customer_id`) REFERENCES `mast_customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_mast_item_category_id_foreign` FOREIGN KEY (`mast_item_category_id`) REFERENCES `mast_item_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD CONSTRAINT `sales_details_mast_item_register_id_foreign` FOREIGN KEY (`mast_item_register_id`) REFERENCES `mast_item_registers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_details_sales_id_foreign` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales_returns`
--
ALTER TABLE `sales_returns`
  ADD CONSTRAINT `sales_returns_mast_work_station_id_foreign` FOREIGN KEY (`mast_work_station_id`) REFERENCES `mast_work_stations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_returns_sales_id_foreign` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_returns_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales_return_details`
--
ALTER TABLE `sales_return_details`
  ADD CONSTRAINT `sales_return_details_mast_item_register_id_foreign` FOREIGN KEY (`mast_item_register_id`) REFERENCES `mast_item_registers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_return_details_sales_return_id_foreign` FOREIGN KEY (`sales_return_id`) REFERENCES `sales_returns` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_return_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_bills`
--
ALTER TABLE `service_bills`
  ADD CONSTRAINT `service_bills_complaint_id_foreign` FOREIGN KEY (`complaint_id`) REFERENCES `complaints` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_bills_mast_customer_id_foreign` FOREIGN KEY (`mast_customer_id`) REFERENCES `mast_customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_bills_tech_id_foreign` FOREIGN KEY (`tech_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_bills_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_bill_details`
--
ALTER TABLE `service_bill_details`
  ADD CONSTRAINT `service_bill_details_service_bill_id_foreign` FOREIGN KEY (`service_bill_id`) REFERENCES `service_bills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_bill_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sl_movements`
--
ALTER TABLE `sl_movements`
  ADD CONSTRAINT `sl_movements_mast_item_register_id_foreign` FOREIGN KEY (`mast_item_register_id`) REFERENCES `mast_item_registers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sl_movements_mast_work_station_id_foreign` FOREIGN KEY (`mast_work_station_id`) REFERENCES `mast_work_stations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sl_movements_reference_type_id_foreign` FOREIGN KEY (`reference_type_id`) REFERENCES `reference_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sl_movements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `store_transfers`
--
ALTER TABLE `store_transfers`
  ADD CONSTRAINT `store_transfers_mast_item_category_id_foreign` FOREIGN KEY (`mast_item_category_id`) REFERENCES `mast_item_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `store_transfers_mast_work_station_id_foreign` FOREIGN KEY (`mast_work_station_id`) REFERENCES `mast_work_stations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `store_transfers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `store_transfer_details`
--
ALTER TABLE `store_transfer_details`
  ADD CONSTRAINT `store_transfer_details_mast_item_register_id_foreign` FOREIGN KEY (`mast_item_register_id`) REFERENCES `mast_item_registers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `store_transfer_details_store_transfer_id_foreign` FOREIGN KEY (`store_transfer_id`) REFERENCES `store_transfers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `store_transfer_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
