-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2023 at 07:19 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gulf_erp`
--

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
  `attendance_type` tinyint(4) NOT NULL DEFAULT 0,
  `location` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `late` tinyint(4) NOT NULL DEFAULT 0,
  `user_name` varchar(255) DEFAULT NULL,
  `finger_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_leave_applications`
--

CREATE TABLE `hr_leave_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `leave_contact` varchar(255) DEFAULT NULL,
  `leave_location` varchar(255) DEFAULT NULL,
  `purpose` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mast_leave_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL
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
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL
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
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL
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
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL
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
  `passport_no` bigint(20) DEFAULT NULL,
  `driving_license` bigint(20) DEFAULT NULL,
  `marital_status` int(11) DEFAULT NULL,
  `house_phone` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `birth_certificate_no` bigint(20) DEFAULT NULL,
  `emg_person_name` varchar(255) DEFAULT NULL,
  `emg_phone_number` varchar(255) DEFAULT NULL,
  `emg_relationship` varchar(255) DEFAULT NULL,
  `emg_address` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mast_department_id` bigint(20) UNSIGNED NOT NULL,
  `mast_designation_id` bigint(20) UNSIGNED NOT NULL,
  `mast_employee_type_id` bigint(20) UNSIGNED NOT NULL,
  `mast_work_station_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `info_personals`
--

INSERT INTO `info_personals` (`id`, `date_of_birth`, `employee_gender`, `nid_no`, `blood_group`, `number_official`, `email_official`, `joining_date`, `service_length`, `gross_salary`, `reporting_boss`, `is_reporting_boss`, `division_present`, `district_present`, `upazila_present`, `union_present`, `thana_present`, `post_code_present`, `address_present`, `division_permanent`, `district_permanent`, `upazila_permanent`, `union_permanent`, `thana_permanent`, `post_code_permanent`, `address_permanent`, `passport_no`, `driving_license`, `marital_status`, `house_phone`, `father_name`, `mother_name`, `birth_certificate_no`, `emg_person_name`, `emg_phone_number`, `emg_relationship`, `emg_address`, `status`, `created_at`, `updated_at`, `mast_department_id`, `mast_designation_id`, `mast_employee_type_id`, `mast_work_station_id`, `user_id`, `emp_id`) VALUES
(1, '2002-01-01', 0, '25745545458', 3, '0195275932', 'motiur@gulf.com', '2022-11-01', 2, 15000, 0, 1, 6, 42, 322, 2887, NULL, NULL, 'Khilgoan, Domshar, Shariatpur', 6, 42, 322, 2887, NULL, NULL, 'Khilgoan, Domshar, Shariatpur', 1185344689, 415441482, 0, '01922437143', 'Mosharraf Khan', 'Shilpy Begum', 20222145678938, 'Sagour', '01995275933', 'Brother', 'Shariatpur', 1, '2023-07-19 07:47:02', '2023-07-19 07:47:02', 1, 5, 2, 2, 1, 1);

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
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `mast_customer_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_customers`
--

INSERT INTO `mast_customers` (`id`, `name`, `email`, `phone`, `address`, `cont_person`, `cont_designation`, `cont_phone`, `cont_email`, `web_address`, `credit_limit`, `remarks`, `status`, `mast_customer_type_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Motiur Rahman', 'tayfa@gmail.com', '01913954378', 'Shariatpur', 'Sagour Khan', 'Teacher', '01922437143', 'sagour@gmail.com', '', 1000000, 'Test Only', 1, 1, 1, '2023-07-19 07:47:02', '2023-07-19 07:47:02'),
(2, 'Sabbir', 'tayfa@gmail.com', '01913954378', 'Shariatpur', 'Alam Khan', 'Teacher', '01922437143', 'sagour@gmail.com', '', 1000000, 'Test Only', 1, 1, 1, '2023-07-19 07:47:02', '2023-07-19 07:47:02'),
(3, 'Minhaz', 'tayfa@gmail.com', '01913954378', 'Shariatpur', 'Sagour Khan', 'Teacher', '01922437143', 'tamim@gmail.com', '', 1000000, 'Test Only', 1, 1, 1, '2023-07-19 07:47:02', '2023-07-19 07:47:02'),
(4, 'Tamim', 'tayfa@gmail.com', '01913954378', 'Shariatpur', 'Motiur Khan', 'Teacher', '01922437143', 'sagour@gmail.com', '', 1000000, 'Test Only', 1, 2, 1, '2023-07-19 07:47:02', '2023-07-19 07:47:02'),
(5, 'Tayfa Islam', 'tayfa@gmail.com', '01913954378', 'Shariatpur', 'Sagour Khan', 'Teacher', '01922437143', 'koli@gmail.com', '', 1000000, 'Test Only', 1, 3, 1, '2023-07-19 07:47:02', '2023-07-19 07:47:02');

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
(1, 'Corporate', 1, '2023-07-19 07:47:02', '2023-07-19 07:47:02'),
(2, 'Distributer', 1, '2023-07-19 07:47:02', '2023-07-19 07:47:02'),
(3, 'Retailer', 1, '2023-07-19 07:47:02', '2023-07-19 07:47:02');

-- --------------------------------------------------------

--
-- Table structure for table `mast_departments`
--

CREATE TABLE `mast_departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `dept_head` int(11) NOT NULL DEFAULT 0,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_departments`
--

INSERT INTO `mast_departments` (`id`, `dept_name`, `dept_head`, `description`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'AC', 1, 'A department is one section or part of a larger group.', 1, '2023-07-19 07:46:56', '2023-07-19 07:46:56', 1),
(2, 'AC Spare Parts', 1, 'A department is one section or part of a larger group.', 1, '2023-07-19 07:46:56', '2023-07-19 07:46:56', 1),
(3, 'Car Spare Parts', 1, 'A department is one section or part of a larger group.', 1, '2023-07-19 07:46:56', '2023-07-19 07:46:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mast_designations`
--

CREATE TABLE `mast_designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `desig_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_designations`
--

INSERT INTO `mast_designations` (`id`, `desig_name`, `description`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'CEO (Chief Executive Officer)', 'The highest-ranking officer in a company who is responsible for making major corporate decisions, managing the overall operations and resources of the company, and acting as the main point of communication between the board of directors and the companys management team.', 1, '2023-07-19 07:46:56', '2023-07-19 07:46:56', 1),
(2, 'GM (General Manager)', 'The person in charge of managing a specific business unit or division within the company.', 1, '2023-07-19 07:46:56', '2023-07-19 07:46:56', 1),
(3, 'Director', 'An executive-level position that oversees a particular department or function within the company.', 1, '2023-07-19 07:46:56', '2023-07-19 07:46:56', 1),
(4, 'HR Manager', 'Developing and implementing HR policies and procedures that align with the company goals and objectives', 1, '2023-07-19 07:46:56', '2023-07-19 07:46:56', 1),
(5, 'Sales Manager', 'A Sales Manager is an executive-level position responsible for managing the sales department of a company. They oversee the company sales policies and procedures, including sales strategies, customer relationships, sales forecasting, and revenue generation.', 1, '2023-07-19 07:46:56', '2023-07-19 07:46:56', 1),
(6, 'Store Manager', 'A Store Manager is a mid-level position responsible for managing the day-to-day operations of a retail store. They oversee the store policies and procedures, including customer service, inventory management, sales, and staff management.', 1, '2023-07-19 07:46:56', '2023-07-19 07:46:56', 1),
(7, 'Marketing Manager', 'A Marketing Manager is an executive-level position responsible for managing a company marketing strategies and initiatives. They oversee the marketing department, including advertising, promotions, market research, and brand management.', 1, '2023-07-19 07:46:56', '2023-07-19 07:46:56', 1),
(8, 'Supervisor', 'A lower-level position that is responsible for overseeing a small team or group of employees.', 1, '2023-07-19 07:46:56', '2023-07-19 07:46:56', 1),
(9, 'Service Technician', 'A Service Technician, also known as a Field Service Technician, is a skilled worker who provides technical support and maintenance services to customers. They typically work in industries such as information technology, telecommunications, healthcare, and manufacturing.', 1, '2023-07-19 07:46:56', '2023-07-19 07:46:56', 1),
(10, 'Installation Technician', '\r\n            An Installation Technician is a skilled worker who is responsible for installing and setting up various types of equipment and systems. They work in a variety of industries, including telecommunications, information technology, healthcare, and manufacturing.', 1, '2023-07-19 07:46:56', '2023-07-19 07:46:56', 1),
(11, 'Customer Service', 'Customer service is the support and assistance provided to customers before, during, and after they purchase a product or service. It involves a range of activities designed to enhance the customer experience, increase customer satisfaction, and promote customer loyalty.', 1, '2023-07-19 07:46:56', '2023-07-19 07:46:56', 1),
(12, 'Staff', 'An entry-level position that typically involves performing administrative or support duties.', 1, '2023-07-19 07:46:56', '2023-07-19 07:46:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mast_employee_types`
--

CREATE TABLE `mast_employee_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_employee_types`
--

INSERT INTO `mast_employee_types` (`id`, `cat_name`, `cat_type`, `description`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Full-Time Employees', '1', 'These are employees who work for the company on a regular basis and are typically paid a salary or an hourly wage. They may be eligible for benefits such as health insurance, retirement plans, and paid time off.', 1, '2023-07-19 07:46:57', '2023-07-19 07:46:57', 1),
(2, 'Part-Time Employees', '1', 'These are employees who work for the company on a part-time basis, usually less than 40 hours per week. They may be paid an hourly wage and may or may not be eligible for benefits depending on the company policies.', 1, '2023-07-19 07:46:57', '2023-07-19 07:46:57', 1),
(3, 'Contract Employees', '1', 'These are individuals who work for the company on a temporary basis and are usually hired to perform a specific job or task. They may be paid a flat fee or an hourly rate and are typically not eligible for benefits.', 1, '2023-07-19 07:46:57', '2023-07-19 07:46:57', 1),
(4, 'Interns', '1', 'These are students or recent graduates who work for the company on a temporary basis to gain work experience and develop skills. They may be paid a stipend or may work for free, and are typically not eligible for benefits.', 1, '2023-07-19 07:46:57', '2023-07-19 07:46:57', 1),
(5, 'Consultants', '1', 'These are individuals or firms who are hired by the company to provide specialized expertise or services on a project basis. They may be paid a flat fee or an hourly rate and are typically not eligible for benefits.', 1, '2023-07-19 07:46:57', '2023-07-19 07:46:57', 1),
(6, 'Seasonal Employees', '1', 'These are employees who work for the company during specific times of the year when there is a higher demand for the companys products or services. They may be paid an hourly wage and may or may not be eligible for benefits depending on the companys policies.', 1, '2023-07-19 07:46:57', '2023-07-19 07:46:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mast_item_categories`
--

CREATE TABLE `mast_item_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_item_categories`
--

INSERT INTO `mast_item_categories` (`id`, `cat_name`, `description`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'AC', '', 1, '2023-07-19 07:47:00', '2023-07-19 07:47:00', 1),
(2, 'AC Spare Parts', '', 1, '2023-07-19 07:47:00', '2023-07-19 07:47:00', 1),
(3, 'Car Spare Parts', '', 1, '2023-07-19 07:47:00', '2023-07-19 07:47:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mast_item_groups`
--

CREATE TABLE `mast_item_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `mast_item_category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_item_groups`
--

INSERT INTO `mast_item_groups` (`id`, `part_name`, `description`, `status`, `created_at`, `updated_at`, `user_id`, `mast_item_category_id`) VALUES
(1, 'Window Air Conditioners', '', 1, '2023-07-19 07:47:00', '2023-07-19 07:47:00', 1, 1),
(2, 'Split Air Conditioners', '', 1, '2023-07-19 07:47:00', '2023-07-19 07:47:00', 1, 1),
(3, 'Central Air Conditioning', '', 1, '2023-07-19 07:47:00', '2023-07-19 07:47:00', 1, 1),
(4, 'ARM BUSHING', '', 1, '2023-07-19 07:47:00', '2023-07-19 07:47:00', 1, 3),
(5, 'SUSPENSION BUSH', '', 1, '2023-07-19 07:47:00', '2023-07-19 07:47:00', 1, 3),
(6, 'REAR SUSPENSION BUSH', '', 1, '2023-07-19 07:47:00', '2023-07-19 07:47:00', 1, 3),
(7, 'SPRIN SHACKLE BUSH', '', 1, '2023-07-19 07:47:00', '2023-07-19 07:47:00', 1, 3),
(8, 'SHOCK ABSORBER BUSH', '', 1, '2023-07-19 07:47:00', '2023-07-19 07:47:00', 1, 3),
(9, 'SUPRING SHACKLE RUBBER', '', 1, '2023-07-19 07:47:01', '2023-07-19 07:47:01', 1, 3),
(10, 'UP ARM BUSHING', '', 1, '2023-07-19 07:47:01', '2023-07-19 07:47:01', 1, 3),
(11, 'FONT LOWER ARM BUSH', '', 1, '2023-07-19 07:47:01', '2023-07-19 07:47:01', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `mast_item_registers`
--

CREATE TABLE `mast_item_registers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `box_code` int(11) DEFAULT NULL,
  `gulf_code` int(11) DEFAULT NULL,
  `part_no` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `box_qty` int(11) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `warranty` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `bar_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `mast_item_group_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_item_registers`
--

INSERT INTO `mast_item_registers` (`id`, `box_code`, `gulf_code`, `part_no`, `description`, `box_qty`, `price`, `image`, `warranty`, `cat_id`, `bar_code`, `created_at`, `updated_at`, `user_id`, `mast_item_group_id`, `unit_id`) VALUES
(1, 5, 2, '1178598', 'Test Only1', 12, '7500.00', '', 12, 1, '97049180517', '2023-07-19 07:47:01', '2023-07-19 07:47:01', 1, 1, 6),
(2, 5, 2, '1278598', 'Test Only2', 12, '9500.00', '', 12, 1, '97049180517', '2023-07-19 07:47:01', '2023-07-19 07:47:01', 1, 1, 6),
(3, 9, 7, '1078598', 'Test Only3', 16, '10000.00', '', 12, 2, '98049180517', '2023-07-19 07:47:01', '2023-07-19 07:47:01', 1, 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `mast_leaves`
--

CREATE TABLE `mast_leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `leave_name` varchar(255) NOT NULL,
  `leave_code` varchar(255) NOT NULL,
  `max_limit` int(11) NOT NULL,
  `yearly_limit` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_leaves`
--

INSERT INTO `mast_leaves` (`id`, `leave_name`, `leave_code`, `max_limit`, `yearly_limit`, `description`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Vacation Leave', 'LV-0001', 1, 3, 'This is time off that an employee can take for rest, relaxation, or personal reasons. Vacation leave is usually earned based on the length of time the employee has worked for the company.', 1, '2023-07-19 07:46:57', '2023-07-19 07:46:57', 1),
(2, 'Sick Leave', 'LV-0002', 1, 3, 'This is time off that an employee can take when they are ill or injured. Sick leave may be paid or unpaid, depending on the companys policies.', 1, '2023-07-19 07:46:57', '2023-07-19 07:46:57', 1),
(3, 'Personal Leave', 'LV-0003', 1, 3, 'This is time off that an employee can take for personal reasons, such as attending to family matters or dealing with a personal emergency.', 1, '2023-07-19 07:46:57', '2023-07-19 07:46:57', 1),
(4, 'Parental Leave', 'LV-0004', 1, 3, 'This is time off that an employee can take when they become a parent, either through childbirth or adoption. Parental leave may be paid or unpaid, depending on the company policies.', 1, '2023-07-19 07:46:57', '2023-07-19 07:46:57', 1),
(5, 'Bereavement Leave', 'LV-0005', 1, 3, 'This is time off that an employee can take when a close family member dies. Bereavement leave is usually paid and the amount of time off may vary depending on the company policies.', 1, '2023-07-19 07:46:57', '2023-07-19 07:46:57', 1),
(6, 'Maternity Leave', 'LV-0006', 1, 3, 'This is time off that a female employee can take before and after childbirth. Maternity leave may be paid or unpaid, depending on the company policies.', 1, '2023-07-19 07:46:57', '2023-07-19 07:46:57', 1),
(7, 'Maternity Leave', 'LV-0006', 1, 3, 'This is time off that a female employee can take before and after childbirth. Maternity leave may be paid or unpaid, depending on the company policies.', 1, '2023-07-19 07:46:57', '2023-07-19 07:46:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mast_packages`
--

CREATE TABLE `mast_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pkg_name` varchar(255) DEFAULT NULL,
  `pkg_size` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_packages`
--

INSERT INTO `mast_packages` (`id`, `pkg_name`, `pkg_size`, `description`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(1, '1 X 1', 1, '', 1, '2023-07-19 07:46:58', '2023-07-19 07:46:58', 1),
(2, '1 X 4', 4, '', 1, '2023-07-19 07:46:58', '2023-07-19 07:46:58', 1),
(3, '1 X 6', 6, '', 1, '2023-07-19 07:46:58', '2023-07-19 07:46:58', 1),
(4, '1 X 8', 8, '', 1, '2023-07-19 07:46:58', '2023-07-19 07:46:58', 1),
(5, '1 X 10', 10, '', 1, '2023-07-19 07:46:58', '2023-07-19 07:46:58', 1),
(6, '1 X 12', 12, '', 1, '2023-07-19 07:46:58', '2023-07-19 07:46:58', 1),
(7, '1 X 16', 16, '', 1, '2023-07-19 07:46:58', '2023-07-19 07:46:58', 1),
(8, '1 X 20', 20, '', 1, '2023-07-19 07:46:58', '2023-07-19 07:46:58', 1),
(9, '1 X 24', 24, '', 1, '2023-07-19 07:46:58', '2023-07-19 07:46:58', 1),
(10, '1 X 36', 36, '', 1, '2023-07-19 07:46:58', '2023-07-19 07:46:58', 1),
(11, '1 X 48', 48, '', 1, '2023-07-19 07:46:58', '2023-07-19 07:46:58', 1);

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
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_suppliers`
--

INSERT INTO `mast_suppliers` (`id`, `supplier_name`, `contact_person`, `email`, `phone_number`, `address`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Alam', 'Sagour Khan', 'alam@gmail.com', '01995275933', 'Shariatpur', 1, '2023-07-19 07:47:01', '2023-07-19 07:47:01', 1),
(2, 'Sabbir', 'Sagour Khan', 'sabbir@gmail.com', '01995275933', 'Shariatpur', 1, '2023-07-19 07:47:01', '2023-07-19 07:47:01', 1),
(3, 'Minhaz', 'Sagour Khan', 'minhaz@gmail.com', '01995275933', 'Shariatpur', 1, '2023-07-19 07:47:01', '2023-07-19 07:47:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mast_units`
--

CREATE TABLE `mast_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `mast_item_category_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_units`
--

INSERT INTO `mast_units` (`id`, `unit_name`, `description`, `mast_item_category_id`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Cubic Meter', ' This is a unit of volume commonly used to measure the capacity of a box or container. ', 1, 1, '2023-07-19 07:46:58', '2023-07-19 07:46:58', 1),
(2, 'Carton', ' In some cases, \"box\" may be used interchangeably with \"carton\" to refer to a specific packaging unit.', 1, 1, '2023-07-19 07:46:59', '2023-07-19 07:46:59', 1),
(3, 'Crate', 'A crate is a rigid container, typically made of wood or plastic, used for shipping or storing goods.', 2, 1, '2023-07-19 07:46:59', '2023-07-19 07:46:59', 1),
(4, 'Packaging ', 'In the context of retail or wholesale, products may be packaged in specific units, such as a certain number of items per box or package. ', 2, 1, '2023-07-19 07:46:59', '2023-07-19 07:46:59', 1),
(5, 'Window Air', 'These units are self-contained and designed to be installed in a window or a specially made opening in a wall. They provide cooling for individual rooms or small spaces.', 2, 1, '2023-07-19 07:46:59', '2023-07-19 07:46:59', 1),
(6, 'Split Air', 'Split AC units consist of two main components: an indoor unit and an outdoor unit. The indoor unit is installed inside the room, while the outdoor unit is placed outside the building. ', 2, 1, '2023-07-19 07:46:59', '2023-07-19 07:46:59', 1),
(7, 'Central Air', 'Central AC units are designed to cool entire buildings or large areas. They consist of a centralized cooling unit that distributes cool air through a network of ducts and vents. ', 2, 1, '2023-07-19 07:46:59', '2023-07-19 07:46:59', 1),
(8, 'Portable Air', ' These units are freestanding and can be moved from room to room as needed. Portable AC units typically include a venting kit that allows hot air to be exhausted through a window or vent.', 2, 1, '2023-07-19 07:46:59', '2023-07-19 07:46:59', 1),
(9, 'Ductless Mini-Split Air', 'Similar to split AC units, ductless mini-split systems consist of an indoor unit and an outdoor unit. However, they do not require ductwork for air distribution. They are ideal for cooling individual rooms or specific zones within a building.', 2, 1, '2023-07-19 07:46:59', '2023-07-19 07:46:59', 1),
(10, 'Spark plugs', 'Sold as individual units.', 3, 1, '2023-07-19 07:46:59', '2023-07-19 07:46:59', 1),
(11, 'Brake pads', 'Sold as a set for each wheel (usually 2 or 4 pads per set).', 3, 1, '2023-07-19 07:46:59', '2023-07-19 07:46:59', 1),
(12, 'Air filters', 'Sold as individual units.', 3, 1, '2023-07-19 07:46:59', '2023-07-19 07:46:59', 1),
(13, 'Oil filters', 'Sold as individual units.', 3, 1, '2023-07-19 07:46:59', '2023-07-19 07:46:59', 1),
(14, 'Headlights', 'Sold as individual units (left and right headlights)', 3, 1, '2023-07-19 07:46:59', '2023-07-19 07:46:59', 1),
(15, 'Taillights', 'Sold as individual units (left and right taillights).', 3, 1, '2023-07-19 07:46:59', '2023-07-19 07:46:59', 1),
(16, 'Brake discs/rotors', 'Sold as individual units (typically per wheel).', 3, 1, '2023-07-19 07:46:59', '2023-07-19 07:46:59', 1),
(17, 'Timing belts', 'Sold as individual units.', 3, 1, '2023-07-19 07:47:00', '2023-07-19 07:47:00', 1),
(18, 'Fuel filters', 'Sold as individual units.', 3, 1, '2023-07-19 07:47:00', '2023-07-19 07:47:00', 1),
(19, 'Water pumps', 'Sold as individual units.', 3, 1, '2023-07-19 07:47:00', '2023-07-19 07:47:00', 1),
(20, 'Radiators', 'Sold as individual units.', 3, 1, '2023-07-19 07:47:00', '2023-07-19 07:47:00', 1),
(21, 'Shock absorbers', 'Sold as individual units (per wheel).', 3, 1, '2023-07-19 07:47:00', '2023-07-19 07:47:00', 1),
(22, 'Control arms', 'Sold as individual units (per wheel).', 3, 1, '2023-07-19 07:47:00', '2023-07-19 07:47:00', 1),
(23, 'Ball joints', 'Sold as individual units (per wheel).', 3, 1, '2023-07-19 07:47:00', '2023-07-19 07:47:00', 1);

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
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mast_work_stations`
--

INSERT INTO `mast_work_stations` (`id`, `store_name`, `contact_number`, `location`, `description`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Central Storehouse', '01995275933', 'Gulshan', 'This is time off that a female employee can take before and after childbirth. Maternity leave may be paid or unpaid, depending on the company policies.', 1, '2023-07-19 07:46:57', '2023-07-19 07:46:57', 1),
(2, 'Gulf international associates ltd.', '01995275933', 'Gulshan', 'This is time off that a female employee can take before and after childbirth. Maternity leave may be paid or unpaid, depending on the company policies.', 1, '2023-07-19 07:46:57', '2023-07-19 07:46:57', 1),
(3, 'Icon information Systems ltd.', '01995275933', 'Mirpur', 'This is time off that a female employee can take before and after childbirth. Maternity leave may be paid or unpaid, depending on the company policies.', 1, '2023-07-19 07:46:57', '2023-07-19 07:46:57', 1);

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
(8, '2022_09_08_043923_create_permission_tables', 1),
(9, '2022_09_08_043924_create_mast_departments_table', 1),
(10, '2022_09_08_043925_create_mast_designations_table', 1),
(11, '2022_09_08_043926_create_mast_leaves_table', 1),
(12, '2022_09_08_043927_create_mast_employee_types_table', 1),
(13, '2022_09_08_043928_create_mast_work_stations_table', 1),
(14, '2022_09_08_043929_create_mast_item_categories_table', 1),
(15, '2022_09_08_043930_create_mast_packages_table', 1),
(16, '2022_09_08_043930_create_mast_units_table', 1),
(17, '2022_09_08_043931_create_mast_item_groups_table', 1),
(18, '2022_09_08_043932_create_mast_item_registers_table', 1),
(19, '2022_09_08_043933_create_mast_suppliers_table', 1),
(20, '2022_09_08_043934_create_mast_customer_types_table', 1),
(21, '2022_09_08_043935_create_mast_customers_table', 1),
(22, '2023_04_16_081138_create_info_personals_table', 1),
(23, '2023_04_27_063610_create_info_educationals_table', 1),
(24, '2023_04_27_063611_create_info_work_experiences_table', 1),
(25, '2023_04_27_063612_create_info_banks_table', 1),
(26, '2023_04_27_063613_create_info_nominees_table', 1),
(27, '2023_04_30_034227_create_hr_leave_applications_table', 1),
(28, '2023_05_07_045208_create_hr_attendances_table', 1),
(29, '2023_05_15_052417_create_purchases_table', 1),
(30, '2023_05_17_053821_create_purchase_details_table', 1),
(31, '2023_06_05_104851_create_sales_table', 1),
(32, '2023_06_05_115459_create_sales_details_table', 1),
(33, '2023_07_09_083700_create_store_transfers_table', 1),
(34, '2023_07_09_101840_create_store_transfer_details_table', 1),
(35, '2023_07_16_083217_create_sales_returns_table', 1),
(36, '2023_07_16_093835_create_sales_return_details_table', 1),
(37, '2023_08_08_062121_create_reference_types_table', 1),
(38, '2023_08_09_052658_create_sl_movements_table', 1);

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
(1, 'App\\Models\\User', 1);

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
(1, 'Setting access', 'web', '2023-07-19 07:46:53', '2023-07-19 07:46:53'),
(2, 'Pages access', 'web', '2023-07-19 07:46:53', '2023-07-19 07:46:53'),
(3, 'Gallery access', 'web', '2023-07-19 07:46:54', '2023-07-19 07:46:54'),
(4, 'Gallery create', 'web', '2023-07-19 07:46:54', '2023-07-19 07:46:54'),
(5, 'Gallery edit', 'web', '2023-07-19 07:46:54', '2023-07-19 07:46:54'),
(6, 'Gallery delete', 'web', '2023-07-19 07:46:54', '2023-07-19 07:46:54'),
(7, 'Member access', 'web', '2023-07-19 07:46:54', '2023-07-19 07:46:54'),
(8, 'Approve Member', 'web', '2023-07-19 07:46:54', '2023-07-19 07:46:54'),
(9, 'Member create', 'web', '2023-07-19 07:46:54', '2023-07-19 07:46:54'),
(10, 'Member edit', 'web', '2023-07-19 07:46:54', '2023-07-19 07:46:54'),
(11, 'Member delete', 'web', '2023-07-19 07:46:54', '2023-07-19 07:46:54'),
(12, 'User access', 'web', '2023-07-19 07:46:54', '2023-07-19 07:46:54'),
(13, 'User create', 'web', '2023-07-19 07:46:54', '2023-07-19 07:46:54'),
(14, 'User edit', 'web', '2023-07-19 07:46:54', '2023-07-19 07:46:54'),
(15, 'User delete', 'web', '2023-07-19 07:46:54', '2023-07-19 07:46:54'),
(16, 'Role access', 'web', '2023-07-19 07:46:54', '2023-07-19 07:46:54'),
(17, 'Role create', 'web', '2023-07-19 07:46:54', '2023-07-19 07:46:54'),
(18, 'Role edit', 'web', '2023-07-19 07:46:54', '2023-07-19 07:46:54'),
(19, 'Role delete', 'web', '2023-07-19 07:46:55', '2023-07-19 07:46:55');

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
  `remarks` text DEFAULT NULL,
  `mast_item_category_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `is_parsial` tinyint(4) NOT NULL DEFAULT 0,
  `mast_work_station_id` bigint(20) UNSIGNED NOT NULL,
  `mast_supplier_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `inv_date`, `inv_no`, `remarks`, `mast_item_category_id`, `status`, `is_parsial`, `mast_work_station_id`, `mast_supplier_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2023-07-19', 'INV-NO-00000', NULL, 1, 4, 0, 1, 1, 1, '2023-07-19 07:49:37', '2023-07-19 07:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `rcv_qty` int(11) DEFAULT NULL,
  `cat_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `mast_item_register_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `qty`, `price`, `rcv_qty`, `cat_id`, `status`, `purchase_id`, `mast_item_register_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 20, '4500.00', 20, NULL, 1, 1, 3, 1, '2023-07-19 07:49:37', '2023-07-19 07:51:42'),
(2, 20, '5500.00', 20, NULL, 1, 1, 1, 1, '2023-07-19 07:49:37', '2023-07-19 07:53:19'),
(3, 20, '6500.00', 20, NULL, 1, 1, 2, 1, '2023-07-19 07:49:37', '2023-07-19 07:54:20');

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
(1, 'Purchase', 1, '2023-07-19 07:46:57', '2023-07-19 07:46:57'),
(2, 'Sales', 1, '2023-07-19 07:46:58', '2023-07-19 07:46:58'),
(3, 'Store Transfer', 1, '2023-07-19 07:46:58', '2023-07-19 07:46:58'),
(4, 'Sales Return', 1, '2023-07-19 07:46:58', '2023-07-19 07:46:58');

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
(1, 'Supper-Admin', 'web', '2023-07-19 07:46:53', '2023-07-19 07:46:53'),
(2, 'Admin', 'web', '2023-07-19 07:46:53', '2023-07-19 07:46:53'),
(3, 'Member', 'web', '2023-07-19 07:46:53', '2023-07-19 07:46:53');

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
(3, 1),
(3, 3),
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
(19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inv_date` date DEFAULT NULL,
  `inv_no` varchar(255) DEFAULT NULL,
  `vat` int(11) DEFAULT NULL,
  `tax` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `is_parsial` tinyint(4) NOT NULL DEFAULT 0,
  `mast_item_category_id` bigint(20) UNSIGNED NOT NULL,
  `mast_customer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `inv_date`, `inv_no`, `vat`, `tax`, `remarks`, `status`, `is_parsial`, `mast_item_category_id`, `mast_customer_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2023-07-19', 'INV-NO-00000', NULL, NULL, NULL, 3, 1, 1, 1, 1, '2023-07-19 07:56:05', '2023-07-19 07:58:36'),
(2, '2023-07-19', 'INV-NO-00001', NULL, NULL, NULL, 4, 0, 1, 4, 1, '2023-07-19 07:56:28', '2023-07-19 07:59:37'),
(3, '2023-07-19', 'INV-NO-00002', NULL, NULL, NULL, 4, 0, 1, 5, 1, '2023-07-19 07:57:15', '2023-07-19 08:00:32'),
(4, '2023-07-19', 'INV-NO-00003', NULL, NULL, NULL, 4, 0, 1, 5, 1, '2023-07-19 07:57:33', '2023-07-19 08:01:27');

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `deli_qty` int(11) DEFAULT NULL,
  `cat_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `sales_id` bigint(20) UNSIGNED NOT NULL,
  `mast_item_register_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_details`
--

INSERT INTO `sales_details` (`id`, `qty`, `price`, `deli_qty`, `cat_id`, `status`, `sales_id`, `mast_item_register_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 4, '10000.00', 3, NULL, 1, 1, 3, 1, '2023-07-19 07:56:05', '2023-07-19 07:59:07'),
(2, 2, '7500.00', 2, NULL, 1, 1, 1, 1, '2023-07-19 07:56:05', '2023-07-19 07:58:36'),
(3, 2, '9500.00', 2, NULL, 1, 1, 2, 1, '2023-07-19 07:56:05', '2023-07-19 07:58:49'),
(4, 2, '7500.00', 2, NULL, 1, 2, 1, 1, '2023-07-19 07:56:28', '2023-07-19 07:59:26'),
(5, 2, '9500.00', 2, NULL, 1, 2, 2, 1, '2023-07-19 07:56:28', '2023-07-19 07:59:37'),
(6, 1, '7500.00', 1, NULL, 1, 3, 1, 1, '2023-07-19 07:57:15', '2023-07-19 08:00:05'),
(7, 3, '9500.00', 3, NULL, 1, 3, 2, 1, '2023-07-19 07:57:15', '2023-07-19 08:00:23'),
(8, 1, '10000.00', 1, NULL, 1, 3, 3, 1, '2023-07-19 07:57:15', '2023-07-19 08:00:32'),
(9, 2, '10000.00', 2, NULL, 1, 4, 3, 1, '2023-07-19 07:57:34', '2023-07-19 08:01:27'),
(10, 2, '7500.00', 2, NULL, 1, 4, 1, 1, '2023-07-19 07:57:34', '2023-07-19 08:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `sales_returns`
--

CREATE TABLE `sales_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `return_no` varchar(255) DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `remarks` text DEFAULT NULL,
  `from_store` text DEFAULT NULL,
  `mast_work_station_id` bigint(20) UNSIGNED NOT NULL,
  `sales_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_returns`
--

INSERT INTO `sales_returns` (`id`, `return_no`, `return_date`, `status`, `remarks`, `from_store`, `mast_work_station_id`, `sales_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'RT-NO-00000', '2023-07-19', 1, 'No need', NULL, 1, 1, 1, '2023-07-19 08:18:45', '2023-07-19 08:18:45'),
(2, 'RT-NO-00001', '2023-07-19', 1, 'No need', NULL, 1, 4, 1, '2023-07-19 08:43:58', '2023-07-19 08:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `sales_return_details`
--

CREATE TABLE `sales_return_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `rcv_qty` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `sales_return_id` bigint(20) UNSIGNED NOT NULL,
  `mast_item_register_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_return_details`
--

INSERT INTO `sales_return_details` (`id`, `qty`, `price`, `rcv_qty`, `status`, `sales_return_id`, `mast_item_register_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '9500.00', 0, 1, 1, 2, 1, '2023-07-19 08:18:45', '2023-07-19 08:18:45'),
(2, 2, '10000.00', 0, 1, 1, 3, 1, '2023-07-19 08:18:45', '2023-07-19 08:18:45'),
(3, 2, '7500.00', 0, 1, 2, 1, 1, '2023-07-19 08:43:58', '2023-07-19 08:43:58'),
(4, 2, '10000.00', 0, 1, 2, 3, 1, '2023-07-19 08:43:58', '2023-07-19 08:43:58');

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
('OEhgQviHYVPjyZHD8MbtSuRRHVqXcRDWeIlA2ekV', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiUlBjSUVSY01aaDNhNXR6a0ZDM0N1ZmtPSm01bkEyQ3Blbzc4YmowRCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjU1OiJodHRwOi8vbG9jYWxob3N0L2d1bGZfZXJwL3NhbGVzL3NhbGVzLXJlY2VpdmUvZGV0YWlscy8xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRKczFhMS4xLkxiVG5ySE1vYW1CQ3dPb3J4M2lZQ0JnVnhwL2VpTkhxdk53RUEyelM0M2dFeSI7fQ==', 1689786840);

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
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `out_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sl_movements`
--

INSERT INTO `sl_movements` (`id`, `serial_no`, `reference_id`, `reference_type_id`, `mast_item_register_id`, `mast_work_station_id`, `user_id`, `status`, `out_date`, `created_at`, `updated_at`) VALUES
(1, '1-test-01', 1, 1, 3, 1, 1, 0, '2023-07-19', '2023-07-19 07:51:42', '2023-07-19 07:59:07'),
(2, '1-test-02', 1, 1, 3, 1, 1, 0, '2023-07-19', '2023-07-19 07:51:42', '2023-07-19 07:59:07'),
(3, '1-test-03', 1, 1, 3, 1, 1, 0, '2023-07-19', '2023-07-19 07:51:42', '2023-07-19 07:59:07'),
(4, '1-test-04', 1, 1, 3, 1, 1, 0, '2023-07-19', '2023-07-19 07:51:42', '2023-07-19 08:00:32'),
(5, '1-test-05', 1, 1, 3, 1, 1, 0, '2023-07-19', '2023-07-19 07:51:42', '2023-07-19 08:01:27'),
(6, '1-test-06', 1, 1, 3, 1, 1, 0, '2023-07-19', '2023-07-19 07:51:42', '2023-07-19 08:01:27'),
(7, '1-test-07', 1, 1, 3, 1, 1, 1, NULL, '2023-07-19 07:51:42', '2023-07-19 07:51:42'),
(8, '1-test-08', 1, 1, 3, 1, 1, 1, NULL, '2023-07-19 07:51:42', '2023-07-19 07:51:42'),
(9, '1-test-09', 1, 1, 3, 1, 1, 1, NULL, '2023-07-19 07:51:42', '2023-07-19 07:51:42'),
(10, '1-test-10', 1, 1, 3, 1, 1, 1, NULL, '2023-07-19 07:51:42', '2023-07-19 07:51:42'),
(11, '1-test-11', 1, 1, 3, 1, 1, 1, NULL, '2023-07-19 07:51:42', '2023-07-19 07:51:42'),
(12, '1-test-12', 1, 1, 3, 1, 1, 1, NULL, '2023-07-19 07:51:42', '2023-07-19 07:51:42'),
(13, '1-test-13', 1, 1, 3, 1, 1, 1, NULL, '2023-07-19 07:51:42', '2023-07-19 07:51:42'),
(14, '1-test-14', 1, 1, 3, 1, 1, 1, NULL, '2023-07-19 07:51:42', '2023-07-19 07:51:42'),
(15, '1-test-15', 1, 1, 3, 1, 1, 1, NULL, '2023-07-19 07:51:42', '2023-07-19 07:51:42'),
(16, '1-test-16', 1, 1, 3, 1, 1, 1, NULL, '2023-07-19 07:51:42', '2023-07-19 07:51:42'),
(17, '1-test-17', 1, 1, 3, 1, 1, 1, NULL, '2023-07-19 07:51:42', '2023-07-19 07:51:42'),
(18, '1-test-18', 1, 1, 3, 1, 1, 1, NULL, '2023-07-19 07:51:43', '2023-07-19 07:51:43'),
(19, '1-test-19', 1, 1, 3, 1, 1, 1, NULL, '2023-07-19 07:51:43', '2023-07-19 07:51:43'),
(20, '1-test-20', 1, 1, 3, 1, 1, 1, NULL, '2023-07-19 07:51:43', '2023-07-19 07:51:43'),
(21, '2-test-01', 1, 1, 1, 1, 1, 0, '2023-07-19', '2023-07-19 07:53:19', '2023-07-19 07:58:36'),
(22, '2-test-02', 1, 1, 1, 1, 1, 0, '2023-07-19', '2023-07-19 07:53:19', '2023-07-19 07:58:36'),
(23, '2-test-03', 1, 1, 1, 1, 1, 0, '2023-07-19', '2023-07-19 07:53:19', '2023-07-19 07:59:26'),
(24, '2-test-04', 1, 1, 1, 1, 1, 0, '2023-07-19', '2023-07-19 07:53:19', '2023-07-19 07:59:27'),
(25, '2-test-05', 1, 1, 1, 1, 1, 0, '2023-07-19', '2023-07-19 07:53:19', '2023-07-19 08:00:05'),
(26, '2-test-06', 1, 1, 1, 1, 1, 0, '2023-07-19', '2023-07-19 07:53:19', '2023-07-19 08:01:17'),
(27, '2-test-07', 1, 1, 1, 1, 1, 0, '2023-07-19', '2023-07-19 07:53:19', '2023-07-19 08:01:17'),
(28, '2-test-08', 1, 1, 1, 1, 1, 1, NULL, '2023-07-19 07:53:19', '2023-07-19 07:53:19'),
(29, '2-test-09', 1, 1, 1, 1, 1, 1, NULL, '2023-07-19 07:53:19', '2023-07-19 07:53:19'),
(30, '2-test-10', 1, 1, 1, 1, 1, 1, NULL, '2023-07-19 07:53:19', '2023-07-19 07:53:19'),
(31, '2-test-11', 1, 1, 1, 1, 1, 1, NULL, '2023-07-19 07:53:19', '2023-07-19 07:53:19'),
(32, '2-test-12', 1, 1, 1, 1, 1, 1, NULL, '2023-07-19 07:53:19', '2023-07-19 07:53:19'),
(33, '2-test-13', 1, 1, 1, 1, 1, 1, NULL, '2023-07-19 07:53:19', '2023-07-19 07:53:19'),
(34, '2-test-14', 1, 1, 1, 1, 1, 1, NULL, '2023-07-19 07:53:19', '2023-07-19 07:53:19'),
(35, '2-test-15', 1, 1, 1, 1, 1, 1, NULL, '2023-07-19 07:53:19', '2023-07-19 07:53:19'),
(36, '2-test-16', 1, 1, 1, 1, 1, 1, NULL, '2023-07-19 07:53:19', '2023-07-19 07:53:19'),
(37, '2-test-17', 1, 1, 1, 1, 1, 1, NULL, '2023-07-19 07:53:19', '2023-07-19 07:53:19'),
(38, '2-test-18', 1, 1, 1, 1, 1, 1, NULL, '2023-07-19 07:53:19', '2023-07-19 07:53:19'),
(39, '2-test-19', 1, 1, 1, 1, 1, 1, NULL, '2023-07-19 07:53:19', '2023-07-19 07:53:19'),
(40, '2-test-20', 1, 1, 1, 1, 1, 1, NULL, '2023-07-19 07:53:19', '2023-07-19 07:53:19'),
(41, '3-test-01', 1, 1, 2, 1, 1, 0, '2023-07-19', '2023-07-19 07:54:21', '2023-07-19 07:58:49'),
(42, '3-test-02', 1, 1, 2, 1, 1, 0, '2023-07-19', '2023-07-19 07:54:21', '2023-07-19 07:58:49'),
(43, '3-test-03', 1, 1, 2, 1, 1, 0, '2023-07-19', '2023-07-19 07:54:21', '2023-07-19 07:59:37'),
(44, '3-test-04', 1, 1, 2, 1, 1, 0, '2023-07-19', '2023-07-19 07:54:21', '2023-07-19 07:59:37'),
(45, '3-test-05', 1, 1, 2, 1, 1, 0, '2023-07-19', '2023-07-19 07:54:21', '2023-07-19 08:00:23'),
(46, '3-test-06', 1, 1, 2, 1, 1, 0, '2023-07-19', '2023-07-19 07:54:21', '2023-07-19 08:00:23'),
(47, '3-test-07', 1, 1, 2, 1, 1, 0, '2023-07-19', '2023-07-19 07:54:21', '2023-07-19 08:00:23'),
(48, '3-test-08', 1, 1, 2, 1, 1, 1, NULL, '2023-07-19 07:54:21', '2023-07-19 07:54:21'),
(49, '3-test-09', 1, 1, 2, 1, 1, 1, NULL, '2023-07-19 07:54:21', '2023-07-19 07:54:21'),
(50, '3-test-10', 1, 1, 2, 1, 1, 1, NULL, '2023-07-19 07:54:21', '2023-07-19 07:54:21'),
(51, '3-test-11', 1, 1, 2, 1, 1, 1, NULL, '2023-07-19 07:54:21', '2023-07-19 07:54:21'),
(52, '3-test-12', 1, 1, 2, 1, 1, 1, NULL, '2023-07-19 07:54:21', '2023-07-19 07:54:21'),
(53, '3-test-13', 1, 1, 2, 1, 1, 1, NULL, '2023-07-19 07:54:21', '2023-07-19 07:54:21'),
(54, '3-test-14', 1, 1, 2, 1, 1, 1, NULL, '2023-07-19 07:54:21', '2023-07-19 07:54:21'),
(55, '3-test-15', 1, 1, 2, 1, 1, 1, NULL, '2023-07-19 07:54:21', '2023-07-19 07:54:21'),
(56, '3-test-16', 1, 1, 2, 1, 1, 1, NULL, '2023-07-19 07:54:21', '2023-07-19 07:54:21'),
(57, '3-test-17', 1, 1, 2, 1, 1, 1, NULL, '2023-07-19 07:54:21', '2023-07-19 07:54:21'),
(58, '3-test-18', 1, 1, 2, 1, 1, 1, NULL, '2023-07-19 07:54:21', '2023-07-19 07:54:21'),
(59, '3-test-19', 1, 1, 2, 1, 1, 1, NULL, '2023-07-19 07:54:21', '2023-07-19 07:54:21'),
(60, '3-test-20', 1, 1, 2, 1, 1, 1, NULL, '2023-07-19 07:54:21', '2023-07-19 07:54:21'),
(61, '2-test-01', 1, 2, 1, 1, 1, 0, NULL, '2023-07-19 07:58:36', '2023-07-19 07:58:36'),
(62, '2-test-02', 1, 2, 1, 1, 1, 0, NULL, '2023-07-19 07:58:36', '2023-07-19 07:58:36'),
(63, '3-test-01', 1, 2, 2, 1, 1, 0, NULL, '2023-07-19 07:58:49', '2023-07-19 07:58:49'),
(64, '3-test-02', 1, 2, 2, 1, 1, 0, NULL, '2023-07-19 07:58:49', '2023-07-19 07:58:49'),
(65, '1-test-01', 1, 2, 3, 1, 1, 0, NULL, '2023-07-19 07:59:07', '2023-07-19 07:59:07'),
(66, '1-test-02', 1, 2, 3, 1, 1, 0, NULL, '2023-07-19 07:59:07', '2023-07-19 07:59:07'),
(67, '1-test-03', 1, 2, 3, 1, 1, 0, NULL, '2023-07-19 07:59:07', '2023-07-19 07:59:07'),
(68, '2-test-03', 2, 2, 1, 1, 1, 0, NULL, '2023-07-19 07:59:27', '2023-07-19 07:59:27'),
(69, '2-test-04', 2, 2, 1, 1, 1, 0, NULL, '2023-07-19 07:59:27', '2023-07-19 07:59:27'),
(70, '3-test-03', 2, 2, 2, 1, 1, 0, NULL, '2023-07-19 07:59:37', '2023-07-19 07:59:37'),
(71, '3-test-04', 2, 2, 2, 1, 1, 0, NULL, '2023-07-19 07:59:37', '2023-07-19 07:59:37'),
(72, '2-test-05', 3, 2, 1, 1, 1, 0, NULL, '2023-07-19 08:00:05', '2023-07-19 08:00:05'),
(73, '3-test-05', 3, 2, 2, 1, 1, 0, NULL, '2023-07-19 08:00:23', '2023-07-19 08:00:23'),
(74, '3-test-06', 3, 2, 2, 1, 1, 0, NULL, '2023-07-19 08:00:23', '2023-07-19 08:00:23'),
(75, '3-test-07', 3, 2, 2, 1, 1, 0, NULL, '2023-07-19 08:00:23', '2023-07-19 08:00:23'),
(76, '1-test-04', 3, 2, 3, 1, 1, 0, NULL, '2023-07-19 08:00:32', '2023-07-19 08:00:32'),
(77, '2-test-06', 4, 2, 1, 1, 1, 0, NULL, '2023-07-19 08:01:17', '2023-07-19 08:01:17'),
(78, '2-test-07', 4, 2, 1, 1, 1, 0, NULL, '2023-07-19 08:01:17', '2023-07-19 08:01:17'),
(79, '1-test-05', 4, 2, 3, 1, 1, 0, NULL, '2023-07-19 08:01:27', '2023-07-19 08:01:27'),
(80, '1-test-06', 4, 2, 3, 1, 1, 0, NULL, '2023-07-19 08:01:27', '2023-07-19 08:01:27');

-- --------------------------------------------------------

--
-- Table structure for table `store_transfers`
--

CREATE TABLE `store_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inv_date` date DEFAULT NULL,
  `inv_no` varchar(255) DEFAULT NULL,
  `vat` int(11) DEFAULT NULL,
  `tax` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `from_store_id` text DEFAULT NULL,
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
  `price` decimal(8,2) DEFAULT NULL,
  `deli_qty` int(11) DEFAULT NULL,
  `cat_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `store_transfer_id` bigint(20) UNSIGNED NOT NULL,
  `mast_item_register_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
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
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `attendance_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mast_work_station_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact_number`, `employee_code`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `status`, `is_admin`, `attendance_id`, `created_at`, `updated_at`, `mast_work_station_id`) VALUES
(1, 'Gulf-ERP', 'admin@gmail.com', '01909302126', 'GF-00000', '2023-12-31 18:00:00', '$2y$10$Js1a1.1.LbTnrHMoamBCwOorx3iYCBgVxp/eiNHqvNwEA2zS43gEy', NULL, NULL, NULL, NULL, NULL, 'fix/admin.jpg', 1, 0, NULL, '2023-07-19 07:46:53', '2023-07-19 07:46:53', 1);

--
-- Indexes for dumped tables
--

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
  ADD KEY `hr_attendances_user_id_foreign` (`user_id`);

--
-- Indexes for table `hr_leave_applications`
--
ALTER TABLE `hr_leave_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hr_leave_applications_mast_leave_id_foreign` (`mast_leave_id`),
  ADD KEY `hr_leave_applications_user_id_foreign` (`user_id`),
  ADD KEY `hr_leave_applications_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `info_banks`
--
ALTER TABLE `info_banks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_banks_user_id_foreign` (`user_id`),
  ADD KEY `info_banks_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `info_educationals`
--
ALTER TABLE `info_educationals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_educationals_user_id_foreign` (`user_id`),
  ADD KEY `info_educationals_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `info_nominees`
--
ALTER TABLE `info_nominees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_nominees_user_id_foreign` (`user_id`),
  ADD KEY `info_nominees_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `info_personals`
--
ALTER TABLE `info_personals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_personals_mast_department_id_foreign` (`mast_department_id`),
  ADD KEY `info_personals_mast_designation_id_foreign` (`mast_designation_id`),
  ADD KEY `info_personals_mast_employee_type_id_foreign` (`mast_employee_type_id`),
  ADD KEY `info_personals_mast_work_station_id_foreign` (`mast_work_station_id`),
  ADD KEY `info_personals_user_id_foreign` (`user_id`),
  ADD KEY `info_personals_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `info_work_experiences`
--
ALTER TABLE `info_work_experiences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_work_experiences_user_id_foreign` (`user_id`),
  ADD KEY `info_work_experiences_emp_id_foreign` (`emp_id`);

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
  ADD KEY `mast_item_groups_user_id_foreign` (`user_id`),
  ADD KEY `mast_item_groups_mast_item_category_id_foreign` (`mast_item_category_id`);

--
-- Indexes for table `mast_item_registers`
--
ALTER TABLE `mast_item_registers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mast_item_registers_user_id_foreign` (`user_id`),
  ADD KEY `mast_item_registers_mast_item_group_id_foreign` (`mast_item_group_id`),
  ADD KEY `mast_item_registers_unit_id_foreign` (`unit_id`);

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
-- Indexes for table `reference_types`
--
ALTER TABLE `reference_types`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `info_work_experiences`
--
ALTER TABLE `info_work_experiences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mast_designations`
--
ALTER TABLE `mast_designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mast_employee_types`
--
ALTER TABLE `mast_employee_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mast_item_categories`
--
ALTER TABLE `mast_item_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mast_item_groups`
--
ALTER TABLE `mast_item_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mast_item_registers`
--
ALTER TABLE `mast_item_registers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mast_leaves`
--
ALTER TABLE `mast_leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `mast_work_stations`
--
ALTER TABLE `mast_work_stations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reference_types`
--
ALTER TABLE `reference_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sales_returns`
--
ALTER TABLE `sales_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_return_details`
--
ALTER TABLE `sales_return_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sl_movements`
--
ALTER TABLE `sl_movements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hr_attendances`
--
ALTER TABLE `hr_attendances`
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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

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
