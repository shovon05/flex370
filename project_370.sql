-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2026 at 07:31 AM
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
-- Database: `project_370`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `full_name`, `email`, `password`, `phone_number`) VALUES
(1, 'admin', 'a@gmail.com', '123', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `building_id` int(11) NOT NULL,
  `total_floor` int(11) DEFAULT NULL,
  `construction_year` int(11) DEFAULT NULL,
  `built_material` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `owns_date` date DEFAULT NULL,
  `building_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`building_id`, `total_floor`, `construction_year`, `built_material`, `address`, `owner_id`, `owns_date`, `building_name`) VALUES
(1, 6, 1990, 'Brick', 'M-53, West Merul Badda, Dhaka', 11111, '1990-07-12', 'Mina Garden'),
(2, 6, 1900, 'Concrete', 'M-79, West Merul Badda, Gulshan 1, Dhaka 1212', 11111, '1920-11-25', 'Shirin Tower');

-- --------------------------------------------------------

--
-- Table structure for table `complain`
--

CREATE TABLE `complain` (
  `complain_id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `building_id` int(11) DEFAULT NULL,
  `inspector_id` int(11) DEFAULT NULL,
  `assigned_date` date DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `feedback_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complain`
--

INSERT INTO `complain` (`complain_id`, `status`, `photo`, `description`, `building_id`, `inspector_id`, `assigned_date`, `tenant_id`, `feedback`, `feedback_photo`) VALUES
(101, 'Working', 'crack.jpg', 'The building has so many crack in it. One of the proof is attached in my complain please inspect the complain and take possible step to solve the problem', 2, 101, '2026-05-25', 1001, 'I have visited the building and found so many crack as the complaints say', '1779686805_crack.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_facility`
--

CREATE TABLE `emergency_facility` (
  `building_id` int(11) NOT NULL,
  `fire_exit` tinyint(1) DEFAULT NULL,
  `stair_case` tinyint(1) DEFAULT NULL,
  `assembly_point` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_facility`
--

INSERT INTO `emergency_facility` (`building_id`, `fire_exit`, `stair_case`, `assembly_point`) VALUES
(1, 0, 1, 0),
(2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inspector`
--

CREATE TABLE `inspector` (
  `inspector_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `exp_year` int(11) DEFAULT NULL,
  `certification_num` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inspector`
--

INSERT INTO `inspector` (`inspector_id`, `full_name`, `email`, `password`, `phone_number`, `exp_year`, `certification_num`) VALUES
(101, 'inspector', 'i@gmail.com', '123', '3456789', 3, '13456');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `present_address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `full_name`, `email`, `password`, `phone_number`, `present_address`) VALUES
(11111, 'ownerName', 'o@gmail.com', '123', '019999999999', 'Gulshan 1,Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `request_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Paid',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rental_request`
--

CREATE TABLE `rental_request` (
  `request_id` int(11) NOT NULL,
  `let_id` int(11) DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `tenant_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `moving_date` date DEFAULT NULL,
  `building_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`tenant_id`, `full_name`, `email`, `password`, `phone_number`, `moving_date`, `building_id`) VALUES
(1001, 'tenantName', 't@gmail.com', '123', '01888888888', '2026-05-05', 2);

-- --------------------------------------------------------

--
-- Table structure for table `to_let`
--

CREATE TABLE `to_let` (
  `let_id` int(11) NOT NULL,
  `building_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `room_count` int(11) DEFAULT NULL,
  `rent` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`building_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `complain`
--
ALTER TABLE `complain`
  ADD PRIMARY KEY (`complain_id`),
  ADD KEY `building_id` (`building_id`),
  ADD KEY `inspector_id` (`inspector_id`),
  ADD KEY `tenant_id` (`tenant_id`);

--
-- Indexes for table `emergency_facility`
--
ALTER TABLE `emergency_facility`
  ADD PRIMARY KEY (`building_id`);

--
-- Indexes for table `inspector`
--
ALTER TABLE `inspector`
  ADD PRIMARY KEY (`inspector_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `rental_request`
--
ALTER TABLE `rental_request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `let_id` (`let_id`),
  ADD KEY `tenant_id` (`tenant_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`tenant_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `building_id` (`building_id`);

--
-- Indexes for table `to_let`
--
ALTER TABLE `to_let`
  ADD PRIMARY KEY (`let_id`),
  ADD KEY `building_id` (`building_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `complain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `inspector`
--
ALTER TABLE `inspector`
  MODIFY `inspector_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11112;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `rental_request`
--
ALTER TABLE `rental_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `tenant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- AUTO_INCREMENT for table `to_let`
--
ALTER TABLE `to_let`
  MODIFY `let_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `building`
--
ALTER TABLE `building`
  ADD CONSTRAINT `building_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`owner_id`) ON DELETE CASCADE;

--
-- Constraints for table `complain`
--
ALTER TABLE `complain`
  ADD CONSTRAINT `complain_ibfk_1` FOREIGN KEY (`building_id`) REFERENCES `building` (`building_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `complain_ibfk_2` FOREIGN KEY (`inspector_id`) REFERENCES `inspector` (`inspector_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `complain_ibfk_3` FOREIGN KEY (`tenant_id`) REFERENCES `tenant` (`tenant_id`) ON DELETE CASCADE;

--
-- Constraints for table `emergency_facility`
--
ALTER TABLE `emergency_facility`
  ADD CONSTRAINT `emergency_facility_ibfk_1` FOREIGN KEY (`building_id`) REFERENCES `building` (`building_id`) ON DELETE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `rental_request` (`request_id`) ON DELETE CASCADE;

--
-- Constraints for table `rental_request`
--
ALTER TABLE `rental_request`
  ADD CONSTRAINT `rental_request_ibfk_1` FOREIGN KEY (`let_id`) REFERENCES `to_let` (`let_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rental_request_ibfk_2` FOREIGN KEY (`tenant_id`) REFERENCES `tenant` (`tenant_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rental_request_ibfk_3` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`owner_id`) ON DELETE CASCADE;

--
-- Constraints for table `tenant`
--
ALTER TABLE `tenant`
  ADD CONSTRAINT `tenant_ibfk_1` FOREIGN KEY (`building_id`) REFERENCES `building` (`building_id`) ON DELETE CASCADE;

--
-- Constraints for table `to_let`
--
ALTER TABLE `to_let`
  ADD CONSTRAINT `to_let_ibfk_1` FOREIGN KEY (`building_id`) REFERENCES `building` (`building_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `to_let_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`owner_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
