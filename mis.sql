-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2020 at 12:49 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mis`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `status` int(1) NOT NULL,
  `time_out` time NOT NULL,
  `num_hr` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `date`, `time_in`, `status`, `time_out`, `num_hr`) VALUES
(13, 1, '2018-04-27', '08:00:00', 1, '17:00:00', 8),
(14, 1, '2018-04-28', '08:00:00', 1, '17:00:00', 8),
(15, 1, '2018-05-04', '08:00:00', 1, '17:00:00', 8),
(16, 1, '2018-05-02', '08:00:00', 1, '17:00:00', 8),
(17, 1, '2018-05-01', '08:00:00', 1, '17:00:00', 8),
(18, 1, '2018-05-03', '08:00:00', 1, '17:00:00', 8),
(74, 1, '2018-04-30', '08:00:00', 1, '16:44:23', 7.7333333333333),
(75, 3, '2018-04-18', '08:00:00', 1, '17:00:00', 8),
(76, 4, '2018-04-19', '08:00:00', 1, '17:00:00', 8),
(77, 4, '2018-04-27', '08:00:00', 1, '17:00:00', 7),
(78, 4, '2018-04-28', '08:00:00', 1, '17:00:00', 8),
(79, 4, '2018-05-01', '08:30:00', 1, '17:00:00', 8),
(80, 4, '2018-05-03', '08:00:00', 1, '17:00:00', 0),
(81, 4, '2018-05-05', '08:00:00', 1, '17:00:00', 9),
(83, 4, '2018-05-31', '08:00:00', 1, '18:00:00', 8),
(84, 4, '2018-05-18', '08:00:00', 1, '17:00:00', 7),
(85, 4, '2018-05-09', '09:00:00', 1, '18:00:00', 8),
(86, 4, '2020-03-30', '09:22:52', 1, '09:23:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cashadvance`
--

CREATE TABLE `cashadvance` (
  `id` int(11) NOT NULL,
  `date_advance` date NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `amount` double NOT NULL,
  `Addedby` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `daily`
--

CREATE TABLE `daily` (
  `id` int(11) NOT NULL,
  `Item_name` varchar(120) NOT NULL,
  `Quantity` varchar(120) NOT NULL,
  `Size` varchar(120) NOT NULL,
  `Datetimes` date NOT NULL,
  `Addedby` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daily`
--

INSERT INTO `daily` (`id`, `Item_name`, `Quantity`, `Size`, `Datetimes`, `Addedby`) VALUES
(1, 'sugar', '34', 'bag', '2020-04-18', 'WAD918054623'),
(2, 'flours', '17', 'bag', '2020-04-18', 'WAD918054623'),
(4, 'sauce', '33.333333333333', 'q-bag', '2020-04-18', 'WAD918054623'),
(5, 'sauce', '1', 'h-bag', '2020-04-18', 'WAD918054623'),
(6, 'flours', '30', 'bag', '2020-04-19', 'XBA846201953'),
(7, 'flours', '5', 'bag', '2020-04-22', 'HKM507684931'),
(8, 'flours', '0.5', 'h-bag', '2020-04-22', 'HKM507684931'),
(9, 'flours', '1', 'bag', '2020-04-22', 'HKM507684931'),
(10, 'flours', '150', 'bag', '2020-04-22', 'HKM507684931'),
(11, 'flours', '50', 'h-bag', '2020-04-23', 'HKM507684931'),
(12, 'flours', '100', 'bag', '2020-04-23', 'UEY763291584');

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `addedby` varchar(120) NOT NULL,
  `employee_id` varchar(120) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `position_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `Start` varchar(120) NOT NULL,
  `gFullname` varchar(120) NOT NULL,
  `gPhone` varchar(120) NOT NULL,
  `gAddress` varchar(120) NOT NULL,
  `gProfession` varchar(120) NOT NULL,
  `gPhoto` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `firstname`, `lastname`, `address`, `birthdate`, `contact_info`, `gender`, `position_id`, `schedule_id`, `photo`, `created_on`, `Start`, `gFullname`, `gPhone`, `gAddress`, `gProfession`, `gPhoto`) VALUES
(33, 'UEY763291584', 'jimoh sheriffdeen ', 'sherifdeen', 'no 57 laduba  area\r\nogidi ilorin kwarastate', '2020-04-17', '0907544644', 'Male', 50, 3, 'IMG_20191225_141612.jpg', '2020-04-14', '2020-04-08', 'mr akanbi fuahad', '9053445655', 'no 57 laduba  area', 'marketer', ''),
(35, 'ISJ089546172', 'jimoh', 'sherifdeen', 'no 57 laduba  area\r\nogidi ilorin kwarastate', '2020-04-20', '0907544644', 'Male', 57, 4, 'IMG_20200208_202352.jpg', '2020-04-21', '2020-04-21', 'mr akanbi fadu', '9053445655', 'no 57 laduba  area', 'banker', 'IMG_20191225_141612.jpg'),
(36, 'HKM507684931', 'reshab', 'musa', 'no 57 laduba  area\r\nogidi ilorin kwarastate', '2020-04-18', '0907544644', 'Male', 58, 3, 'IMG_20200208_202352.jpg', '2020-04-21', '', 'mr akanbi fuahad', '9053445655', 'no 57 laduba  area', 'marketer', 'IMG_20191225_141612.jpg'),
(37, 'DHZ153064928', 'fareed', 'nurudeen', 'no 57 laduba  area\r\nogidi ilorin kwarastate', '2020-04-18', '0907544644', 'Male', 60, 3, 'IMG_20200208_202352.jpg', '2020-04-21', '', 'mr akanbi fuahad', '9053445655', 'no 57 laduba  area', 'banker', 'IMG_20191225_141612.jpg'),
(38, 'LCY216849537', 'fareed', 'rofiat', 'no 57 laduba  area\r\nogidi ilorin kwarastate', '2020-04-21', '0907544644', 'Male', 59, 2, 'IMG_20191225_141612.jpg', '2020-04-21', '', 'jimoh sherifdeen', '9053445655', 'no 57 laduba  area', 'marketer', 'IMG_20191225_141612.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `Addedby` varchar(120) NOT NULL,
  `Expenses` varchar(120) NOT NULL,
  `Date` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `Addedby`, `Expenses`, `Date`) VALUES
(1, 'UEY763291584', '45', '2020-04-24 '),
(2, 'UEY763291584', '140', '2020-04-25 '),
(3, 'UEY763291584', '140', '2020-04-25 '),
(4, 'UEY763291584', '140', '2020-04-25 '),
(5, 'UEY763291584', '140', '2020-04-25 '),
(6, 'UEY763291584', '140', '2020-04-25 '),
(7, 'UEY763291584', '140', '2020-04-25 '),
(8, 'UEY763291584', '140', '2020-04-25 '),
(9, 'UEY763291584', '140', '2020-04-25 '),
(10, 'UEY763291584', '140', '2020-04-25 '),
(11, 'UEY763291584', '140', '2020-04-25 '),
(12, 'UEY763291584', '140', '2020-04-25 '),
(13, 'UEY763291584', '140', '2020-04-25 '),
(14, 'UEY763291584', '140', '2020-04-25 '),
(15, 'UEY763291584', '140', '2020-04-25 '),
(16, 'UEY763291584', '140', '2020-04-25 '),
(17, 'UEY763291584', '140', '2020-04-25 '),
(18, 'UEY763291584', '140', '2020-04-25 '),
(19, 'UEY763291584', '140', '2020-04-25 '),
(20, 'UEY763291584', '140', '2020-04-25 '),
(21, 'UEY763291584', '140', '2020-04-25 '),
(22, 'UEY763291584', '0', '2020-04-26 '),
(23, 'UEY763291584', '0', '2020-04-29 ');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `Prod_amount` varchar(120) NOT NULL,
  `Balance` varchar(120) NOT NULL,
  `Expenses` varchar(120) NOT NULL,
  `Returned` varchar(120) NOT NULL,
  `Totalamount` varchar(120) NOT NULL,
  `Gexpenses` varchar(120) NOT NULL,
  `Payamount` varchar(120) NOT NULL,
  `Addedby` varchar(120) NOT NULL,
  `Datetime` date NOT NULL,
  `Status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `Prod_amount`, `Balance`, `Expenses`, `Returned`, `Totalamount`, `Gexpenses`, `Payamount`, `Addedby`, `Datetime`, `Status`) VALUES
(2, '5026080', '300', '140', '270', '2775000', '45', '2768845', 'UEY763291584', '2020-04-25', 'off'),
(3, '2892100', '0', '0', '70', '2857100', '0', '2826020', 'UEY763291584', '2020-04-26', 'on'),
(4, '2880000', '0', '0', '200', '2810000', '0', '2805800', 'UEY763291584', '2020-04-29', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(120) NOT NULL,
  `Item_name` varchar(120) NOT NULL,
  `Category` varchar(120) NOT NULL,
  `Addedby` varchar(120) NOT NULL,
  `Datetimes` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `Item_name`, `Category`, `Addedby`, `Datetimes`) VALUES
(14, 'flours', 'mill', 'staff', '2020-04-09'),
(15, 'sugar', 'sauce', 'staff', '2020-04-09'),
(16, 'sauce', 'sauce', 'Akanbisherifdeen', '2020-04-13');

-- --------------------------------------------------------

--
-- Table structure for table `overdue`
--

CREATE TABLE `overdue` (
  `id` int(11) NOT NULL,
  `overdue` varchar(120) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overdue`
--

INSERT INTO `overdue` (`id`, `overdue`, `Date`) VALUES
(6, 'overdue', '2020-04-16'),
(7, 'overdue', '2020-04-28'),
(8, 'overdue', '2020-04-28'),
(9, 'overdue', '2020-05-04');

-- --------------------------------------------------------

--
-- Table structure for table `panel`
--

CREATE TABLE `panel` (
  `id` int(11) NOT NULL,
  `username` varchar(120) NOT NULL,
  `Password` varchar(120) NOT NULL,
  `User_id` varchar(120) NOT NULL,
  `User_type` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `panel`
--

INSERT INTO `panel` (`id`, `username`, `Password`, `User_id`, `User_type`) VALUES
(12, 'sheriffproducer', 'producer123', 'ISJ089546172', 'production manager'),
(13, 'sheriffadmin', 'admin123', 'UEY763291584', 'super manager'),
(14, 'sheriffdistributor', 'distributor123', 'LCY216849537', 'distributor'),
(15, 'sheriffstock', 'stock123', 'HKM507684931', 'stock manager'),
(16, 'sheriffsupplier', 'supplier4567', 'DHZ153064928', 'Supplier');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(120) NOT NULL,
  `employee_name` varchar(120) NOT NULL,
  `gross` varchar(120) NOT NULL,
  `cashadvance` varchar(120) NOT NULL,
  `deduction` varchar(120) NOT NULL,
  `netpay` varchar(120) NOT NULL,
  `date` date NOT NULL,
  `Status` varchar(11) NOT NULL,
  `type` varchar(120) NOT NULL,
  `addedby` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id`, `employee_id`, `employee_name`, `gross`, `cashadvance`, `deduction`, `netpay`, `date`, `Status`, `type`, `addedby`) VALUES
(7, 'XBA846201953 , KRY671945823 , WVB724859610 , WAD918054623', 'ameedmalik , jimohsherifdeen , jimohsherifdeen , jimohsherifdeen', '305 , 6000 , 12 , 305', '561.00 , 0 , 0 , 0', '561.00 , 0 , 0 , 0', '0.00 , 6,000.00 , 12.00 , 305.00', '2020-04-16', 'paid', 'date', ''),
(20, 'XBA846201953', 'ameedmalik', '0', '561', '561', '0', '2020-04-16', 'paid', 'single', 'jimohsherifdeen'),
(21, 'KRY671945823', 'jimohsherifdeen', '6,000.00', '0', '0', '6,000.00', '2020-04-16', 'paid', 'single', 'jimohsherifdeen'),
(22, 'WVB724859610', 'jimohsherifdeen', '12.00', '0', '0', '12.00', '2020-04-16', 'unpaid', 'single', 'jimohsherifdeen'),
(23, 'WAD918054623', 'jimohsherifdeen', '305.00', '0', '0', '305.00', '2020-04-16', 'unpaid', 'single', 'jimohsherifdeen'),
(24, 'YVC047825361', 'jimohsherifdeen', '305.00', '0', '0', '305.00', '2020-04-16', 'unpaid', 'single', 'jimohsherifdeen'),
(25, 'OWB154708692', 'jimohsherifdeen', '', '0', '0', '6,000.00', '2020-04-16', 'paid', 'single', 'jimohsherifdeen'),
(26, 'OWB154708692', 'jimohsherifdeen', '6000', '0', '0', '6,000.00', '2020-04-17', 'unpaid', 'date', 'addedby'),
(27, 'ISJ089546172', 'jimohsherifdeen', '3000', '0', '0', '3,000.00', '2020-04-21', 'unpaid', 'date', 'addedby');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `Designation` varchar(120) NOT NULL,
  `Salary` varchar(120) NOT NULL,
  `Addedby` varchar(120) NOT NULL,
  `Datetime` date NOT NULL,
  `Salary_hour` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `Designation`, `Salary`, `Addedby`, `Datetime`, `Salary_hour`) VALUES
(50, 'super manager', '305', 'jimoh sherifdeen', '2020-04-02', '103'),
(57, 'production manager', '3000', 'ameedmalik', '2020-04-21', '104'),
(58, 'stock manager', '3000', 'ameedmalik', '2020-04-21', '104'),
(59, 'distributor', '3000', 'ameedmalik', '2020-04-21', '104'),
(60, 'Supplier', '3000', 'ameedmalik', '2020-04-21', '104');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `P_name` varchar(120) NOT NULL,
  `P_price` varchar(120) NOT NULL,
  `P_size` varchar(120) NOT NULL,
  `Datetimes` date NOT NULL,
  `Addedby` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `P_name`, `P_price`, `P_size`, `Datetimes`, `Addedby`) VALUES
(13, 'butter', '7', '34kg', '2020-04-18', 'WAD918054623'),
(14, 'leather', '21', '23kg', '2020-04-06', ''),
(15, 'mellon', '90', '343kg', '2020-04-09', ''),
(18, 'bread', '21', '23kg', '2020-04-09', ''),
(19, 'indome', '444', '23kg', '2020-04-13', ''),
(20, 'bread', '90', '68kg', '2020-04-20', 'XBA846201953');

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE `production` (
  `id` int(11) NOT NULL,
  `Prod_name` varchar(120) NOT NULL,
  `Prod_peices` varchar(120) NOT NULL,
  `Addedby` varchar(120) NOT NULL,
  `Prod_price` varchar(120) NOT NULL,
  `Datetimes` date NOT NULL,
  `prod_size` varchar(120) NOT NULL,
  `Prod_amount` varchar(120) NOT NULL,
  `Remain` varchar(120) NOT NULL,
  `Status` varchar(120) NOT NULL DEFAULT 'off',
  `update_peices` varchar(120) NOT NULL,
  `update_date` varchar(120) NOT NULL,
  `Cleared_by` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`id`, `Prod_name`, `Prod_peices`, `Addedby`, `Prod_price`, `Datetimes`, `prod_size`, `Prod_amount`, `Remain`, `Status`, `update_peices`, `update_date`, `Cleared_by`) VALUES
(79, 'bread', '5070', 'ISJ089546172', '21', '2020-04-26', '23kg', '105000', '0', 'on', '1', '2020-04-29 ', 'LCY216849537'),
(80, 'bread', '5000', 'ISJ089546172', '90', '2020-04-25', '68kg', '450000', '0', 'on', '', '', 'LCY216849537'),
(82, 'butter', '200', 'ISJ089546172', '7', '2020-04-29', '34kg', '35000', '0', 'on', '', '', 'LCY216849537'),
(85, 'indome', '5000', 'ISJ089546172', '444', '2020-04-26', '23kg', '2220000', '0', 'on', '', '', 'LCY216849537'),
(86, 'butter', '200', 'ISJ089546172', '7', '2020-04-29', '34kg', '35000', '0', 'on', '', '', 'LCY216849537'),
(87, 'mellon', '500', 'ISJ089546172', '90', '2020-04-26', '343kg', '45000', '0', 'on', '', '', 'LCY216849537'),
(88, 'leather', '100', 'ISJ089546172', '21', '2020-04-26', '23kg', '2100', '0', 'on', '', '', 'LCY216849537'),
(91, 'bread', '5070', 'ISJ089546172', '21', '2020-04-26', '23kg', '105000', '0', 'on', '1', '2020-04-29 ', 'LCY216849537'),
(92, 'bread', '5000', 'ISJ089546172', '90', '2020-04-26', '68kg', '450000', '0', 'on', '', '', 'LCY216849537'),
(93, 'indome', '5000', 'ISJ089546172', '444', '2020-04-26', '23kg', '2220000', '0', 'on', '', '', 'LCY216849537'),
(94, 'bread', '5000', 'ISJ089546172', '21', '2020-04-29', '23kg', '105000', '0', 'on', '', '', 'LCY216849537'),
(95, 'indome', '5000', 'ISJ089546172', '444', '2020-04-29', '23kg', '2220000', '0', 'on', '', '', 'LCY216849537'),
(96, 'bread', '5000', 'ISJ089546172', '90', '2020-04-29', '68kg', '450000', '0', 'on', '', '', 'LCY216849537'),
(97, 'butter', '200', 'ISJ089546172', '7', '2020-04-29', '34kg', '35000', '0', 'on', '', '', 'LCY216849537');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `Time_in` time NOT NULL,
  `Time_out` time NOT NULL,
  `Addedby` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `Time_in`, `Time_out`, `Addedby`) VALUES
(2, '04:33:00', '04:33:00', 'jimoh sherifdeen'),
(3, '04:33:00', '06:33:00', 'jimoh sherifdeen'),
(4, '01:55:00', '23:03:00', 'ameedmalik');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `Item_name` varchar(120) NOT NULL,
  `Item_type` varchar(120) NOT NULL,
  `Quantity` varchar(120) NOT NULL,
  `Item_amount` varchar(120) NOT NULL,
  `Exp_date` date NOT NULL,
  `Addedby` varchar(120) NOT NULL,
  `Size` varchar(120) NOT NULL,
  `Measure` varchar(120) NOT NULL,
  `Datetimes` date NOT NULL,
  `Remain` varchar(11) NOT NULL DEFAULT 'off',
  `Status` varchar(11) NOT NULL DEFAULT 'on'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `Item_name`, `Item_type`, `Quantity`, `Item_amount`, `Exp_date`, `Addedby`, `Size`, `Measure`, `Datetimes`, `Remain`, `Status`) VALUES
(34, 'sugar', 'sugar', '134', '300', '2020-04-10', 'jimohsherifdeen', 'q-bag', '10', '2020-04-17', '0', 'off'),
(35, 'flours', 'sugar', '300', '3400', '2020-04-09', 'jimohsherifdeen', 'bag', '78', '2020-04-17', '0', 'off'),
(36, 'sugar', 'sugar', '100', '3400', '2020-04-16', 'jimohsherifdeen', 'bag', '78', '2020-04-17', '0', 'off'),
(37, 'sugar', 'sugar', '100', '300', '2020-04-09', 'jimohsherifdeen', 'bag', '78', '2020-04-17', '0', 'off'),
(38, 'flours', 'flour', '50', '3400', '2020-04-21', 'jimohsherifdeen', 'h-bag', '78', '2020-04-17', '0', 'off'),
(39, 'flours', 'flour', '13', '3400', '2020-04-15', 'jimohsherifdeen', 'shachet', '78', '2020-04-17', '0', 'off'),
(40, 'sauce', 'sugar', '34', '300', '2020-04-15', 'WAD918054623', 'q-bag', '78', '2020-04-18', '0', 'off'),
(41, 'flours', 'flour', '410', '3400', '2020-04-23', 'UEY763291584', 'bag', '10', '2020-04-23', '110', 'on'),
(42, 'sugar', 'sugar', '200', '300', '2020-04-22', 'HKM507684931', 'bag', '78', '2020-04-22', 'off', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `supply`
--

CREATE TABLE `supply` (
  `id` int(11) NOT NULL,
  `Prod_name` varchar(120) NOT NULL,
  `Prod_price` varchar(120) NOT NULL,
  `Prod_peices` varchar(120) NOT NULL,
  `Total` varchar(120) NOT NULL,
  `Status` varchar(11) NOT NULL DEFAULT 'off',
  `Date` date NOT NULL,
  `Supplier` varchar(120) NOT NULL,
  `Prod_size` varchar(120) NOT NULL,
  `Payment` varchar(120) NOT NULL DEFAULT 'off',
  `Balance` varchar(120) NOT NULL DEFAULT '0',
  `Expenses` varchar(120) NOT NULL DEFAULT '0',
  `Returned` varchar(120) NOT NULL DEFAULT '0',
  `Cleared_by` varchar(120) NOT NULL,
  `Paid_to` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supply`
--

INSERT INTO `supply` (`id`, `Prod_name`, `Prod_price`, `Prod_peices`, `Total`, `Status`, `Date`, `Supplier`, `Prod_size`, `Payment`, `Balance`, `Expenses`, `Returned`, `Cleared_by`, `Paid_to`) VALUES
(138, 'bread', '21', '5000', '105000', 'on', '2020-04-25', 'DHZ153064928', '23kg', 'on', '0', '0', '0', 'LCY216849537', 'LCY216849537'),
(139, 'bread', '90', '5000', '450000', 'on', '2020-04-25', 'DHZ153064928', '68kg', 'on', '0', '0', '0', 'LCY216849537', 'LCY216849537'),
(141, 'butter', '7', '5000', '35000', 'on', '2020-04-25', 'DHZ153064928', '34kg', 'on', '0', '70', '0', 'LCY216849537', 'LCY216849537'),
(142, 'indome', '444', '5000', '2220000', 'on', '2020-04-26', 'DHZ153064928', '23kg', 'on', '0', '0', '0', 'LCY216849537', 'LCY216849537'),
(143, 'mellon', '90', '500', '45000', 'on', '2020-04-26', 'DHZ153064928', '343kg', 'on', '0', '0', '0', 'LCY216849537', 'LCY216849537'),
(144, 'bread', '21', '5000', '105000', 'on', '2020-04-26', 'DHZ153064928', '23kg', 'on', '0', '0', '0', 'LCY216849537', 'LCY216849537'),
(145, 'bread', '90', '5000', '450000', 'on', '2020-04-26', 'DHZ153064928', '68kg', 'on', '0', '0', '0', 'LCY216849537', 'LCY216849537'),
(146, 'butter', '7', '5000', '35000', 'on', '2020-04-26', 'DHZ153064928', '34kg', 'on', '0', '0', '70', 'LCY216849537', 'LCY216849537'),
(147, 'leather', '21', '100', '2100', 'on', '2020-04-26', 'DHZ153064928', '23kg', 'on', '0', '0', '0', 'LCY216849537', 'LCY216849537'),
(148, 'butter', '7', '30', '210', 'on', '2020-04-26', 'DHZ153064928', '34kg', 'on', '0', '0', '0', 'LCY216849537', 'LCY216849537'),
(149, 'butter', '7', '30', '210', 'on', '2020-04-26', 'DHZ153064928', '34kg', 'on', '0', '0', '0', 'LCY216849537', 'LCY216849537'),
(151, 'butter', '7', '10', '70', 'on', '2020-04-26', 'DHZ153064928', '34kg', 'on', '0', '0', '0', 'LCY216849537', 'LCY216849537'),
(153, 'bread', '90', '5000', '450000', 'on', '2020-04-26', 'DHZ153064928', '68kg', 'on', '0', '0', '0', 'LCY216849537', 'LCY216849537'),
(154, 'bread', '21', '5000', '105000', 'on', '2020-04-26', 'DHZ153064928', '23kg', 'on', '0', '0', '70', 'LCY216849537', 'LCY216849537'),
(158, 'bread', '21', '5000', '105000', 'on', '2020-04-29', 'DHZ153064928', '23kg', 'on', '0', '0', '0', 'LCY216849537', 'LCY216849537'),
(159, 'bread', '90', '5000', '450000', 'on', '2020-04-29', 'DHZ153064928', '68kg', 'on', '0', '0', '0', 'LCY216849537', 'LCY216849537'),
(162, 'indome', '444', '5000', '2220000', 'on', '2020-04-29', 'DHZ153064928', '23kg', 'on', '0', '0', '0', 'LCY216849537', 'LCY216849537'),
(163, 'butter', '7', '5000', '35000', 'on', '2020-04-29', 'DHZ153064928', '34kg', 'on', '0', '0', '200', 'LCY216849537', 'LCY216849537'),
(164, 'butter', '7', '100', '700', 'on', '2020-05-09', 'DHC615923047', '34kg', 'off', '0', '70', '0', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashadvance`
--
ALTER TABLE `cashadvance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily`
--
ALTER TABLE `daily`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overdue`
--
ALTER TABLE `overdue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `panel`
--
ALTER TABLE `panel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supply`
--
ALTER TABLE `supply`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `cashadvance`
--
ALTER TABLE `cashadvance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daily`
--
ALTER TABLE `daily`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(120) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `overdue`
--
ALTER TABLE `overdue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `panel`
--
ALTER TABLE `panel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `supply`
--
ALTER TABLE `supply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
