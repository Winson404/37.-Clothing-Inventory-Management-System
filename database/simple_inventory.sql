-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2024 at 07:08 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simple_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `actId` int(11) NOT NULL,
  `actName` text NOT NULL,
  `actDate` varchar(20) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`actId`, `actName`, `actDate`, `date_added`) VALUES
(2, 'Activity 5', '2022-12-23', '0000-00-00 00:00:00'),
(3, 'Activity 3', '2022-12-10', '2022-12-11 00:00:00'),
(4, 'Activity 2', '2022-12-11', '2022-12-11 00:00:00'),
(5, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem, ipsum delectus voluptatum? Molestias aut inventore eaque, maxime numquam dignissimos asperiores, voluptatibus consectetur distinctio excepturi odit architecto, saepe enim sunt, molestiae.', '2022-12-11', '2022-12-11 00:00:00'),
(6, 'sample', '2022-12-27', '2022-12-27 00:00:00'),
(8, 'gfdgfd', '2023-01-06', '2022-12-27 00:00:00'),
(9, 'Announcement sample', '2023-01-09', '2023-01-16 00:00:00'),
(10, 'SAMple', '2023-01-24', '2023-01-16 00:00:00'),
(11, 'yhfng', '2023-02-13', '2023-02-05 00:00:00'),
(12, 'smaple', '2023-07-28', '2023-07-08 00:00:00'),
(13, 'sadsadsa', '2023-07-29', '2023-07-08 07:51:00'),
(14, 'samples', '2023-09-07', '2023-09-20 08:26:00'),
(16, 'dsadsadasdsa', '2023-11-16', '2023-10-24 15:58:49'),
(17, 'akoa kinis', '2023-12-09', '2023-10-24 15:59:24'),
(18, 'dfss', '2023-12-18', '2023-12-18 06:48:00'),
(19, 'Smaple', '2023-12-26', '2023-12-18 19:03:50'),
(20, 'dsa', '2023-12-28', '2023-12-18 19:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `log_history`
--

CREATE TABLE `log_history` (
  `log_Id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `login_time` varchar(100) NOT NULL,
  `logout_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `log_history`
--

INSERT INTO `log_history` (`log_Id`, `user_Id`, `login_time`, `logout_time`) VALUES
(63, 66, '2024-01-02 07:42 PM', '2024-01-02 08:01:09'),
(64, 66, '2024-01-02 08:01 PM', '2024-01-02 08:01:29'),
(65, 72, '2024-01-02 08:01 PM', '2024-01-02 08:03:01'),
(66, 66, '2024-01-02 08:03 PM', '2024-01-02 08:43:30'),
(67, 66, '2024-01-02 08:45 PM', '2024-01-02 08:52:43'),
(68, 72, '2024-01-02 08:52 PM', '2024-01-02 09:06:51'),
(69, 66, '2024-01-02 09:50 PM', '2024-01-02 09:51:36'),
(70, 72, '2024-01-02 09:53 PM', '2024-01-02 10:11:51'),
(71, 72, '2024-01-02 10:42 PM', '2024-01-03 12:54:34'),
(72, 66, '2024-01-03 12:54 AM', '2024-01-03 12:59:20'),
(73, 72, '2024-01-03 12:59 AM', '2024-01-03 12:59:44'),
(74, 66, '2024-01-03 12:59 AM', '2024-01-03 01:03:22'),
(75, 72, '2024-01-03 01:03 AM', '2024-01-03 01:04:54'),
(76, 66, '2024-01-03 01:04 AM', '2024-01-03 01:13:18'),
(77, 72, '2024-01-03 01:13 AM', '2024-01-03 01:18:56'),
(78, 66, '2024-01-03 01:19 AM', '2024-01-03 01:30:59'),
(79, 72, '2024-01-03 01:31 AM', '2024-01-03 01:33:48'),
(80, 66, '2024-01-03 01:33 AM', '2024-01-03 01:55:54'),
(81, 66, '2024-01-03 02:07 AM', '2024-01-03 02:14:45'),
(82, 72, '2024-01-03 02:14 AM', '2024-01-03 02:14:57'),
(83, 72, '2024-01-03 02:15 AM', '2024-01-03 02:19:09'),
(84, 72, '2024-01-03 02:15 AM', '2024-01-03 02:19:09'),
(85, 66, '2024-01-03 02:19 AM', '2024-01-03 02:29:51'),
(86, 66, '2024-01-03 02:30 AM', ''),
(87, 66, '2024-01-03 12:48 PM', '2024-01-03 12:58:48'),
(88, 66, '2024-01-03 01:00 PM', '2024-01-03 01:14:51'),
(89, 72, '2024-01-03 01:14 PM', '2024-01-03 01:27:48'),
(90, 72, '2024-01-03 01:28 PM', '2024-01-03 01:47:48'),
(91, 72, '2024-01-03 01:49 PM', '2024-01-03 01:55:11'),
(92, 66, '2024-01-03 01:55 PM', '2024-01-03 02:05:25'),
(93, 72, '2024-01-03 02:05 PM', '2024-01-03 02:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_ID` int(11) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `prod_desc` text NOT NULL,
  `prod_size` varchar(50) NOT NULL,
  `prod_color` varchar(50) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `prod_qty_orig` int(11) NOT NULL,
  `prod_price` int(11) NOT NULL,
  `supplier_ID` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_ID`, `prod_name`, `prod_desc`, `prod_size`, `prod_color`, `prod_qty`, `prod_qty_orig`, `prod_price`, `supplier_ID`, `created_at`) VALUES
(1, 'Product 11', 'New Desc', 'Small', 'Pink', 180, 200, 200, 4, '2024-01-02 11:37:09'),
(3, 'Product 1', 'Product 1Product 1', 'Large', 'Pink', 0, 200, 2, 1, '2024-01-02 12:32:28'),
(4, 'Product 3', 'Sample', 'Small', 'Balck', 200, 200, 100, 3, '2024-01-02 17:07:32'),
(5, 'Product 4', 'Product 4 Descriptions', 'Large', 'Pink', 188, 200, 100, 1, '2024-01-02 17:13:56'),
(6, 'Product 5', 'dsadsada', 'Dsadasdsa', 'Dsadasdas', 200, 200, 4343, 1, '2024-01-02 18:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `requisition`
--

CREATE TABLE `requisition` (
  `req_ID` int(11) NOT NULL,
  `emp_ID` int(11) NOT NULL,
  `prod_ID` int(11) NOT NULL,
  `req_qty` int(11) NOT NULL,
  `requirements` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `notes` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Approved,2=Rejected',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0=Not Deleted, 1=Not Deleted',
  `delivery_date` date NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requisition`
--

INSERT INTO `requisition` (`req_ID`, `emp_ID`, `prod_ID`, `req_qty`, `requirements`, `reason`, `notes`, `status`, `is_deleted`, `delivery_date`, `request_date`) VALUES
(1, 87, 1, 20, 'Sample2', 'Sample2', 'Sample2', 1, 1, '2024-01-15', '2024-01-02 15:04:54'),
(4, 72, 5, 12, 'Sample', 'Sample', 'Sample', 1, 0, '2024-01-18', '2024-01-02 16:01:51'),
(6, 87, 3, 200, 'Sample', 'Sample', 'Sample', 1, 0, '2024-01-19', '2024-01-02 19:35:41');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_ID` int(11) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `m_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(30) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_ID`, `f_name`, `m_name`, `l_name`, `address`, `contact`, `date_added`) VALUES
(1, 'Supplier 1s2', 'Supplier 1s2', 'Supplier 1s2', 'Supplier S2', '93594289632221', '2024-01-02 11:12:14'),
(3, 'Supplier 2', 'Supplier 2', 'Supplier 2', 'Supplier 2', '93594289631', '2023-12-19 06:17:09'),
(4, 'Supplier 3', 'Supplier 3', 'Supplier 3', 'Supplier 3', '1231231321', '2024-01-02 11:08:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_Id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `age` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `civilstatus` varchar(50) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `purok` varchar(255) NOT NULL,
  `zone` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'User',
  `verification_code` int(11) NOT NULL,
  `date_registered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_Id`, `firstname`, `middlename`, `lastname`, `suffix`, `dob`, `age`, `email`, `contact`, `birthplace`, `gender`, `civilstatus`, `occupation`, `religion`, `house_no`, `street_name`, `purok`, `zone`, `barangay`, `municipality`, `province`, `region`, `image`, `password`, `user_type`, `verification_code`, `date_registered`) VALUES
(66, 'Admins', 'Admin', 'Admin', 'Admin', '2023-10-11', '1 Week Old', 'admin@gmail.com', '9359428963', 'Female', 'Male', 'Single', 'Admin', 'Bible Baptist Church', 'Dsas', 'Admin', 'Admin', 'Dsa', 'Admin', 'Admin', 'Admins', 'Admins', 'testimonials-4.jpg', '0192023a7bbd73250516f069df18b500', 'Admin', 374025, '2022-11-25 00:00:00'),
(72, 'Employee', 'User', 'User', 'Jr', '2022-12-21', '5 Days Old', 'employee@gmail.com', '9359428963', 'Gfdgfdg', 'Male', 'Married', 'Gfdgfdgd', 'Buddhist', 'Gfdg', 'Fdg', 'Gdfgdg', 'Gfdg', 'Dfgd', 'Fdgdg', 'Fdg', 'Dfg', '2.jpg', '0192023a7bbd73250516f069df18b500', 'Employee', 295016, '2022-12-27 00:00:00'),
(86, 'SampleSample Sample', 'Sample Sample Sample', 'Sample Sample', 'Sample', '2008-02-27', '15 Years Old', 'adminfdsfsfs@gmail.com', '9123456789', 'Samplef Fsdfsd', 'Male', 'Single', 'Sampleff Fsdfds', 'Evangelical Christianity', 'Fdfds Fdsf', 'Fsfsdfsdds ', 'Sf Fsdff', 'Fsdfsdfsdfs Fdsf Sfs', 'Fdsfd Fsfs Fs', 'Fdsfds', 'Fsdffdsf', 'Sdfsd', 'pexels-photo-2379005.jpeg', '0192023a7bbd73250516f069df18b500', 'Employee', 0, '2023-12-18 19:19:29'),
(87, 'Leste', 'Leste', 'Leste', 'Leste', '1986-02-26', '37 Years Old', 'adminLeste@gmail.com', '9123456789', 'Leste', 'Female', 'Widow/ER', 'Leste', 'Iglesia Ni Cristo', 'Leste', 'Leste', 'Leste', 'Leste', 'Leste', 'Leste', 'Leste', 'Leste', '4.jpg', '83e7921e87b1df559db9c4d2ad9b2697', 'Employee', 0, '2023-12-18 19:22:55'),
(88, 'Dsad', 'Asdasd', 'Sadsa', 'Dasda', '1979-03-07', '44 Years Old', 'sdsadsadsaonerwin8@gmail.com', '9359428963', 'Dadsa', 'Female', 'Married', 'Dsadasda', 'Buddhist', 'Dsad', 'Sadasd', 'Asdadsad', 'Sadsa', 'Dasda', 'Dsadas', 'Medellindsadasdas', 'Dasdasd', '1.jpg', '0192023a7bbd73250516f069df18b500', 'Employee', 0, '2024-01-02 20:14:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`actId`);

--
-- Indexes for table `log_history`
--
ALTER TABLE `log_history`
  ADD PRIMARY KEY (`log_Id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_ID`);

--
-- Indexes for table `requisition`
--
ALTER TABLE `requisition`
  ADD PRIMARY KEY (`req_ID`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `actId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `log_history`
--
ALTER TABLE `log_history`
  MODIFY `log_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requisition`
--
ALTER TABLE `requisition`
  MODIFY `req_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
