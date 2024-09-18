-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2024 at 07:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `internetbanking`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(30) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `pin` text NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `middlename` varchar(250) NOT NULL,
  `moblie` bigint(10) DEFAULT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `generated_password` text NOT NULL,
  `balance` float NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ib_acc_types`
--

CREATE TABLE `ib_acc_types` (
  `acctype_id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` longtext NOT NULL,
  `rate` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ib_acc_types`
--

INSERT INTO `ib_acc_types` (`acctype_id`, `name`, `description`, `rate`, `code`) VALUES
(1, 'Savings', '<p>Savings accounts&nbsp;are typically the first official bank account anybody opens. Children may open an account with a parent to begin a pattern of saving. Teenagers open accounts to stash cash earned&nbsp;from a first job&nbsp;or household chores.</p><p>Savings accounts are an excellent place to park&nbsp;emergency cash. Opening a savings account also marks the beginning of your relationship with a financial institution. For example, when joining a credit union, your &ldquo;share&rdquo; or savings account establishes your membership.</p>', '20', 'ACC-CAT-4EZFO'),
(2, ' Retirement', '<p>Retirement accounts&nbsp;offer&nbsp;tax advantages. In very general terms, you get to&nbsp;avoid paying income tax on interest&nbsp;you earn from a savings account or CD each year. But you may have to pay taxes on those earnings at a later date. Still, keeping your money sheltered from taxes may help you over the long term. Most banks offer IRAs (both&nbsp;Traditional IRAs&nbsp;and&nbsp;Roth IRAs), and they may also provide&nbsp;retirement accounts for small businesses</p>', '10', 'ACC-CAT-1QYDV'),
(4, 'Recurring deposit', '<p><strong>Recurring deposit account or RD account</strong> is opened by those who want to save certain amount of money regularly for a certain period of time and earn a higher interest rate.&nbsp;In RD&nbsp;account a&nbsp;fixed amount is deposited&nbsp;every month for a specified period and the total amount is repaid with interest at the end of the particular fixed period.&nbsp;</p><p>The period of deposit is minimum six months and maximum ten years.&nbsp;The interest rates vary&nbsp;for different plans based on the amount one saves and the period of time and also on banks. No withdrawals are allowed from the RD account. However, the bank may allow to close the account before the maturity period.</p><p>These accounts can be opened in single or joint names. Banks are also providing the Nomination facility to the RD account holders.&nbsp;</p>', '15', 'ACC-CAT-VBQLE'),
(5, 'Fixed Deposit Account', '<p>In <strong>Fixed Deposit Account</strong> (also known as <strong>FD Account</strong>), a particular sum of money is deposited in a bank for specific&nbsp;period of time. It&rsquo;s one time deposit and one time take away (withdraw) account.&nbsp;The money deposited in this account can not be withdrawn before the expiry of period.&nbsp;</p><p>However, in case of need,&nbsp; the depositor can ask for closing the fixed deposit prematurely by paying a penalty. The penalty amount varies with banks.</p><p>A high interest rate is paid on fixed deposits. The rate of interest paid for fixed deposit vary according to amount, period and also from bank to bank.</p>', '40', 'ACC-CAT-A86GO'),
(7, 'Current account', '<p><strong>Current account</strong> is mainly for business persons, firms, companies, public enterprises etc and are never used for the purpose of investment or savings.These deposits are the most liquid deposits and there are no limits for number of transactions or the amount of transactions in a day. While, there is no interest paid on amount held in the account, banks charges certain &nbsp;service charges, on such accounts. The current accounts do not have any fixed maturity as these are on continuous basis accounts.</p>', '20', 'ACC-CAT-4O8QW'),
(13, 'Education', '', '77', 'ACC-CAT-H27Z1');

-- --------------------------------------------------------

--
-- Table structure for table `ib_admin`
--

CREATE TABLE `ib_admin` (
  `admin_id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `number` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `profile_pic` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ib_admin`
--

INSERT INTO `ib_admin` (`admin_id`, `name`, `email`, `number`, `password`, `profile_pic`) VALUES
(2, 'Saiganesh Raju Gottam', 'gsaiganesh628@gmail.com', 'iBank-ADM-0516', '76555815804f5af8a8fa7afa1ea32b3047801d09', '');

-- --------------------------------------------------------

--
-- Table structure for table `ib_bankaccounts`
--

CREATE TABLE `ib_bankaccounts` (
  `account_id` int(20) NOT NULL,
  `name` varchar(200) CHARACTER SET geostd8 COLLATE geostd8_general_ci NOT NULL,
  `account_number` varchar(200) CHARACTER SET geostd8 COLLATE geostd8_general_ci NOT NULL,
  `gender` varchar(10) CHARACTER SET geostd8 COLLATE geostd8_general_ci NOT NULL,
  `acc_type` varchar(200) CHARACTER SET geostd8 COLLATE geostd8_general_ci NOT NULL,
  `acc_rates` varchar(200) CHARACTER SET geostd8 COLLATE geostd8_general_ci NOT NULL,
  `acc_status` varchar(200) CHARACTER SET geostd8 COLLATE geostd8_general_ci NOT NULL,
  `acc_amount` varchar(200) CHARACTER SET geostd8 COLLATE geostd8_general_ci NOT NULL,
  `client_id` varchar(200) CHARACTER SET geostd8 COLLATE geostd8_general_ci NOT NULL,
  `client_name` varchar(200) CHARACTER SET geostd8 COLLATE geostd8_general_ci NOT NULL,
  `client_national_id` varchar(200) CHARACTER SET geostd8 COLLATE geostd8_general_ci NOT NULL,
  `client_phone` varchar(200) CHARACTER SET geostd8 COLLATE geostd8_general_ci NOT NULL,
  `client_number` varchar(200) CHARACTER SET geostd8 COLLATE geostd8_general_ci NOT NULL,
  `client_email` varchar(200) CHARACTER SET geostd8 COLLATE geostd8_general_ci NOT NULL,
  `client_adr` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(200) NOT NULL,
  `dob` date NOT NULL,
  `aadhar` varchar(200) NOT NULL,
  `pan_no` varchar(200) CHARACTER SET geostd8 COLLATE geostd8_general_ci NOT NULL,
  `address` varchar(200) CHARACTER SET geostd8 COLLATE geostd8_general_ci NOT NULL,
  `signature` text CHARACTER SET geostd8 COLLATE geostd8_general_ci NOT NULL,
  `password` text NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `created_by` varchar(200) NOT NULL,
  `profile_pic` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ib_bankaccounts`
--

INSERT INTO `ib_bankaccounts` (`account_id`, `name`, `account_number`, `gender`, `acc_type`, `acc_rates`, `acc_status`, `acc_amount`, `client_id`, `client_name`, `client_national_id`, `client_phone`, `client_number`, `client_email`, `client_adr`, `email`, `contact`, `dob`, `aadhar`, `pan_no`, `address`, `signature`, `password`, `created_at`, `created_by`, `profile_pic`) VALUES
(47, 'Saiganesh Raju Gottam', '893450712', 'Male', 'Fixed Deposit Account ', '40', 'Active', '0', '22', 'SRM NAGAR', '6182', '9390475897', 'iBank-BRANCH-6182', 'yy2819@srmist.edu.in', 'SRM Nagar, Kattankulathur', 'saiganesh@gmail.com', '6281718680', '2002-12-05', '696868018088', 'FAFPR6122A', 'Pileru', 'Saiganesh Raju Gottam', '76555815804f5af8a8fa7afa1ea32b3047801d09', '2024-06-28 08:26:15.995656', 'Admin', ''),
(50, 'Durga Bhavani Y', '937468501', 'Female', 'Current account ', '20', 'Active', '0', '22', 'SRM NAGAR', '6182', '9390475897', 'iBank-BRANCH-6182', 'yy2819@srmist.edu.in', 'SRM Nagar, Kattankulathur', 'bhavani@gmail.com', '9390475897', '2003-06-28', '123456789012', 'ABCDE1234F', 'Tanaku', 'Durga Bhavani Y', '76555815804f5af8a8fa7afa1ea32b3047801d09', '2024-06-28 08:26:28.044639', 'STAFF', ''),
(51, 'Mummadi Venkata Pavan Kumar', '714956823', 'Male', 'Recurring deposit ', '15', 'Active', '0', '21', 'POTHERI', '9857', '6281718680', 'iBank-BRANCH-9857', 'gsaiganesh628@gmail.com', 'Potheri', 'pavan@gmail.com', '1234567890', '2004-01-13', '123456789012', 'ABCDE1234F', 'Kadapa', 'Mummadi Venkata Pavan Kumar', '76555815804f5af8a8fa7afa1ea32b3047801d09', '2024-06-28 08:26:05.256193', 'CLIENT', ''),
(52, 'Shaik Mohammed Fahad', '329761084', 'Male', 'Education ', '77', 'Active', '0', '21', 'POTHERI', '9857', '6281718680', 'iBank-BRANCH-9857', 'gsaiganesh628@gmail.com', 'Potheri', 'fahad@gmail.com', '1234567890', '2003-01-06', '123456789012', 'ABCDE1234F', 'Pileru', 'Shaik Mohammed Fahad', '76555815804f5af8a8fa7afa1ea32b3047801d09', '2024-06-28 08:28:01.994960', 'SELF - ONLINE', ''),
(53, 'Cheruvu Chethan', '241795306', 'Male', 'Education ', '77', 'Active', '0', '21', 'POTHERI', '9857', '6281718680', 'iBank-BRANCH-9857', 'gsaiganesh628@gmail.com', 'Potheri', 'cc2443@srmist.edu.in', '9030568531', '0000-00-00', '123456789012', 'ABCDE1234F', 'sodam', 'Chethan', '76555815804f5af8a8fa7afa1ea32b3047801d09', '2024-07-21 04:29:17.512382', 'ADMIN', '');

-- --------------------------------------------------------

--
-- Table structure for table `ib_clients`
--

CREATE TABLE `ib_clients` (
  `client_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `national_id` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `profile_pic` varchar(200) NOT NULL,
  `client_number` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ib_clients`
--

INSERT INTO `ib_clients` (`client_id`, `name`, `national_id`, `phone`, `address`, `email`, `password`, `profile_pic`, `client_number`) VALUES
(21, 'POTHERI', '9857', '6281718680', 'Potheri', 'gsaiganesh628@gmail.com', '76555815804f5af8a8fa7afa1ea32b3047801d09', '', 'iBank-BRANCH-9857'),
(22, 'SRM NAGAR', '6182', '9390475897', 'SRM Nagar, Kattankulathur', 'yy2819@srmist.edu.in', '76555815804f5af8a8fa7afa1ea32b3047801d09', '', 'iBank-BRANCH-6182');

-- --------------------------------------------------------

--
-- Table structure for table `ib_notifications`
--

CREATE TABLE `ib_notifications` (
  `notification_id` int(20) NOT NULL,
  `notification_details` text NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ib_notifications`
--

INSERT INTO `ib_notifications` (`notification_id`, `notification_details`, `created_at`) VALUES
(32, 'Saiganesh Raju Gottam Has Deposited $ 10000000 To Bank Account 398465721', '2024-03-13 06:50:29.371208'),
(33, 'Saiganesh Raju Gottam Has Deposited $ 50000 To Bank Account 398465721', '2024-03-13 06:50:33.871826'),
(34, 'Saiganesh Raju Gottam Has Deposited $ 250000 To Bank Account 632958071', '2024-03-13 06:51:43.091803'),
(35, 'Saiganesh Raju Gottam Has Deposited $ 250000 To Bank Account 632958071', '2024-03-13 06:56:48.883327'),
(36, 'Saiganesh Raju Gottam Has Transfered $ 5000 From Bank Account 398465721 To Bank Account 398465721', '2024-03-13 12:14:34.343290'),
(37, ' Has Deposited $ 500000 To Bank Account 987654321', '2024-03-13 18:25:32.051073'),
(38, ' Has Deposited $ 10000 To Bank Account 987654321', '2024-03-13 19:42:39.898155'),
(39, ' Has Deposited $ 100000 To Bank Account 123456789', '2024-03-13 19:44:15.581729'),
(40, 'SRMIST Has Transfered $ 1 From Bank Account 398465721 To Bank Account 398465721', '2024-03-13 20:14:58.010020'),
(41, 'SRMIST Has Transfered $ 1 From Bank Account 632958071 To Bank Account 032971564', '2024-03-13 20:28:38.481806'),
(42, ' Has Transfered $ 50000 From Bank Account 987654321 To Bank Account 987654321', '2024-03-13 20:29:48.371153'),
(43, 'SRMIST Has Transfered $ 1200 From Bank Account 398465721 To Bank Account 037928541 Likhitha Priya D', '2024-03-14 03:39:35.869580'),
(44, 'SRMIST Has Transfered $ 50000 From Bank Account 398465721 To Bank Account 032971564 Sukumar', '2024-03-14 03:46:44.304996'),
(45, 'SRMIST Has Deposited $ 20000 To Bank Account 398465721', '2024-03-24 16:47:39.766184'),
(46, ' Has Deposited $ 20000 To Bank Account 123456789', '2024-03-24 16:47:55.172895'),
(47, ' Has Deposited $ 20000 To Bank Account 123456789', '2024-03-24 16:49:22.924197'),
(48, 'SRMIST Has Transfered $ 1200 From Bank Account 398465721 To Bank Account 398465721 Saiganesh Raju', '2024-03-24 16:50:23.061586'),
(49, 'SRMIST Has Transfered $ 20000 From Bank Account 398465721 To Bank Account 632958071', '2024-03-24 19:18:39.706135'),
(50, 'SRMIST Has Deposited $ 100000 To Bank Account 398465721', '2024-03-24 19:24:16.705980'),
(51, ' Has Withdrawn $ 25 From Bank Account 123456789', '2024-03-30 09:23:25.847334'),
(52, ' Has Withdrawn $ 25 From Bank Account 123456789', '2024-03-30 10:09:51.207213'),
(53, ' Has Withdrawn $ 10 From Bank Account 123456789', '2024-03-30 10:10:05.134884'),
(54, 'SRMIST Has Deposited $ 20000 To Bank Account 398465721', '2024-04-07 06:24:10.102488'),
(55, 'POTHERI Has Deposited $ 200000 To Bank Account 329761084', '2024-06-28 08:04:01.865540'),
(56, 'POTHERI Has Transfered $ 20000 From Bank Account 329761084 To Bank Account 893450712', '2024-06-28 08:06:39.121983'),
(57, 'POTHERI Has Withdrawn $ 2000 From Bank Account 329761084', '2024-06-28 08:25:10.572110'),
(58, 'POTHERI Has Deposited $ 250000 To Bank Account 714956823', '2024-07-21 06:34:57.091518'),
(59, 'SRM NAGAR Has Deposited $ 50000 To Bank Account 893450712', '2024-07-21 06:35:18.882556'),
(60, 'SRM NAGAR Has Deposited $ 50000 To Bank Account 893450712', '2024-07-21 10:17:33.277299'),
(61, 'SRM NAGAR Has Withdrawn $ 20000 From Bank Account 893450712', '2024-07-21 10:18:00.661029');

-- --------------------------------------------------------

--
-- Table structure for table `ib_staff`
--

CREATE TABLE `ib_staff` (
  `staff_id` int(20) NOT NULL,
  `branch_id` int(100) NOT NULL,
  `staff_branch` varchar(200) NOT NULL,
  `staff_name` varchar(200) NOT NULL,
  `staff_number` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `sex` varchar(200) NOT NULL,
  `profile_pic` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ib_staff`
--

INSERT INTO `ib_staff` (`staff_id`, `branch_id`, `staff_branch`, `staff_name`, `staff_number`, `phone`, `email`, `password`, `sex`, `profile_pic`) VALUES
(6, 21, 'POTHERI', 'Saiganesh Raju Gottam', 'iBank-STAFF-0165', '6281718680', 'gsaiganesh628@gmail.com', '76555815804f5af8a8fa7afa1ea32b3047801d09', 'Male', 'my_photo.jpg'),
(8, 22, 'SRM NAGAR', 'Fahad Shaik', 'iBank-STAFF-2568', '9030475897', 'fahad@gmail.com', '76555815804f5af8a8fa7afa1ea32b3047801d09', 'Male', '');

-- --------------------------------------------------------

--
-- Table structure for table `ib_systemsettings`
--

CREATE TABLE `ib_systemsettings` (
  `id` int(20) NOT NULL,
  `sys_name` longtext NOT NULL,
  `sys_tagline` longtext NOT NULL,
  `sys_logo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ib_systemsettings`
--

INSERT INTO `ib_systemsettings` (`id`, `sys_name`, `sys_tagline`, `sys_logo`) VALUES
(1, 'SRM Internet Banking', 'Financial success at every service we offer.', 'srm logo.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `ib_transactions`
--

CREATE TABLE `ib_transactions` (
  `tr_id` int(20) NOT NULL,
  `tr_code` varchar(200) NOT NULL,
  `account_id` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `account_number` varchar(200) NOT NULL,
  `acc_type` varchar(200) NOT NULL,
  `acc_amount` varchar(200) NOT NULL,
  `tr_type` varchar(200) NOT NULL,
  `tr_status` varchar(200) NOT NULL,
  `client_id` varchar(200) NOT NULL,
  `client_name` varchar(200) NOT NULL,
  `client_national_id` varchar(200) NOT NULL,
  `transaction_amt` varchar(200) NOT NULL,
  `client_phone` varchar(200) NOT NULL,
  `receiving_acc_no` varchar(200) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `receiving_acc_name` varchar(200) NOT NULL,
  `receiving_acc_holder` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ib_transactions`
--

INSERT INTO `ib_transactions` (`tr_id`, `tr_code`, `account_id`, `name`, `account_number`, `acc_type`, `acc_amount`, `tr_type`, `tr_status`, `client_id`, `client_name`, `client_national_id`, `transaction_amt`, `client_phone`, `receiving_acc_no`, `created_at`, `receiving_acc_name`, `receiving_acc_holder`) VALUES
(78, 'JM0HLv3V64ERAT8sDfaF', '52', 'Shaik Mohammed Fahad', '329761084', 'Savings ', '', 'Deposit', 'Success ', '21', 'POTHERI', '9857', '200000', '', '', '2024-06-28 08:04:01.862774', '', ''),
(79, 'cUEpaOmsXJwvt4MuWPGr', '52', 'Shaik Mohammed Fahad', '329761084', 'Savings ', '', 'Transfer', 'Success ', '21', 'POTHERI', '9857', '20000', '6281718680', '893450712', '2024-06-28 08:06:39.119337', 'Saiganesh Raju Gottam', 'SRM NAGAR'),
(80, 'yrlEaUKY8GTfNS0JLZn6', '52', 'Shaik Mohammed Fahad', '329761084', 'Savings ', '', 'Withdrawal', 'Success ', '21', 'POTHERI', '9857', '2000', '<br /><b>Warning</b>:  Undefined property: stdClass::$phone in <b>C:\\Users\\gsaig\\OneDrive\\Documents\\GitHub\\online-banking-PHP\\admin\\pages_withdraw_money.php</b> on line <b>166</b><br />', '', '2024-06-28 08:25:10.570354', '', ''),
(81, 'tQhqsxW3FE9lk18dXU6A', '51', 'Mummadi Venkata Pavan Kumar', '714956823', 'Recurring deposit ', '', 'Deposit', 'Success ', '21', 'POTHERI', '9857', '250000', '', '', '2024-07-21 06:34:57.082131', '', ''),
(82, 'eqzFT9XcHLKaI3tGvRdV', '47', 'Saiganesh Raju Gottam', '893450712', 'Fixed Deposit Account ', '', 'Deposit', 'Success ', '22', 'SRM NAGAR', '6182', '50000', '', '', '2024-07-21 06:35:18.868293', '', ''),
(83, 'eqzFT9XcHLKaI3tGvRdV', '47', 'Saiganesh Raju Gottam', '893450712', 'Fixed Deposit Account ', '', 'Deposit', 'Success ', '22', 'SRM NAGAR', '6182', '50000', '', '', '2024-07-21 10:17:33.269785', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ib_user`
--

CREATE TABLE `ib_user` (
  `acc_id` int(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `gender` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `dob` varchar(45) NOT NULL,
  `aadhar` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `pan_no` varchar(45) NOT NULL,
  `signature` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `contact` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ib_user`
--

INSERT INTO `ib_user` (`acc_id`, `name`, `gender`, `type`, `dob`, `aadhar`, `customer_id`, `phone`, `email`, `address`, `pan_no`, `signature`, `password`, `contact`) VALUES
(2, 'Saiganesh Raju', '', 'Savings', '05/12/2002', 696868018088, 0, 6281718680, 'gg4906@srmist.edu.in', 'Pileru', 'FAFPR6122A', 'Saiganesh Raju Gottam', '76555815804f5af8a8fa7afa1ea32b3047801d09', 0),
(4, 'Bhavani', '', 'Savings', '05/12/2002', 123456789123, 0, 123456789123, 'yy2819@srmist.edu.in', 'potheri', 'dfghj455', 'Bhavani', '76555815804f5af8a8fa7afa1ea32b3047801d09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kyc`
--

CREATE TABLE `kyc` (
  `aadhar` bigint(20) NOT NULL,
  `fullname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `dob` varchar(45) DEFAULT NULL,
  `income_proof` varchar(200) NOT NULL,
  `source_of_funds` varchar(45) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kyc`
--

INSERT INTO `kyc` (`aadhar`, `fullname`, `email`, `phone`, `address`, `dob`, `income_proof`, `source_of_funds`, `photo`) VALUES
(696868018081, 'Saiganesh Raju', 'gsaiganesh628@gmail.com', 6281718680, 'Potheri', '2002-12-05', '', 'Student', ''),
(696868018082, 'Saiganesh Raju', 'gsaiganesh628@gmail.com', 6281718680, 'Potheri', '2002-12-05', '', 'Student', ''),
(696868018083, 'Saiganesh Raju', 'gsaiganesh628@gmail.com', 6281718680, 'Potheri', '2002-12-05', '', 'Student', ''),
(696868018084, 'Saiganesh Raju', 'gsaiganesh628@gmail.com', 6281718680, 'Potheri', '2002-12-05', '', 'Student', ''),
(696868018085, 'Saiganesh Raju', 'gsaiganesh628@gmail.com', 6281718680, 'Potheri', '2002-12-05', '', 'Student', ''),
(696868018088, 'Saiganesh Raju', 'gsaiganesh628@gmail.com', 6281718680, 'potheri\r\n\r\n', '2002-12-05', '', 'Student', ''),
(1234567891234, 'SRMIST', 'srm@srmist.edu.in', 1234567890, 'Potheri', '1975-01-01', '', 'Fees', ''),
(1234567891235, 'SRMIST', 'srm@srmist.edu.in', 1234567890, 'Potheri', '1975-01-01', '', 'Fees', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ib_acc_types`
--
ALTER TABLE `ib_acc_types`
  ADD PRIMARY KEY (`acctype_id`);

--
-- Indexes for table `ib_admin`
--
ALTER TABLE `ib_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `ib_bankaccounts`
--
ALTER TABLE `ib_bankaccounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `ib_clients`
--
ALTER TABLE `ib_clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `ib_notifications`
--
ALTER TABLE `ib_notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `ib_staff`
--
ALTER TABLE `ib_staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `ib_systemsettings`
--
ALTER TABLE `ib_systemsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ib_transactions`
--
ALTER TABLE `ib_transactions`
  ADD PRIMARY KEY (`tr_id`);

--
-- Indexes for table `ib_user`
--
ALTER TABLE `ib_user`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `kyc`
--
ALTER TABLE `kyc`
  ADD PRIMARY KEY (`aadhar`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ib_acc_types`
--
ALTER TABLE `ib_acc_types`
  MODIFY `acctype_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ib_admin`
--
ALTER TABLE `ib_admin`
  MODIFY `admin_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ib_bankaccounts`
--
ALTER TABLE `ib_bankaccounts`
  MODIFY `account_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `ib_clients`
--
ALTER TABLE `ib_clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `ib_notifications`
--
ALTER TABLE `ib_notifications`
  MODIFY `notification_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `ib_staff`
--
ALTER TABLE `ib_staff`
  MODIFY `staff_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ib_systemsettings`
--
ALTER TABLE `ib_systemsettings`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ib_transactions`
--
ALTER TABLE `ib_transactions`
  MODIFY `tr_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `ib_user`
--
ALTER TABLE `ib_user`
  MODIFY `acc_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
