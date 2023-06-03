-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 03, 2023 at 01:46 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_project_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `cus_name` varchar(20) NOT NULL,
  `cus_lname` varchar(20) NOT NULL,
  `cus_email` varchar(30) NOT NULL,
  `cus_tel` int(11) NOT NULL,
  `cus_address` varchar(150) NOT NULL,
  `provinces` varchar(150) NOT NULL,
  `districts` varchar(150) NOT NULL,
  `subdistricts` varchar(150) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `car_name` varchar(200) NOT NULL,
  `car_model` varchar(100) NOT NULL,
  `car_manufacturer` varchar(100) NOT NULL,
  `license_plate_number` varchar(100) NOT NULL,
  `vin_number` varchar(100) NOT NULL,
  `insurance_company_name` varchar(200) NOT NULL,
  `other_details` text NOT NULL,
  `car_image` varchar(200) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `cus_name`, `cus_lname`, `cus_email`, `cus_tel`, `cus_address`, `provinces`, `districts`, `subdistricts`, `zipcode`, `car_name`, `car_model`, `car_manufacturer`, `license_plate_number`, `vin_number`, `insurance_company_name`, `other_details`, `car_image`, `date_created`) VALUES
(18, 'sdfasfasdfsa', 'dasfadsfsdfs', 'sdfasasdf@asdfadsfk.com', 1234567890, '123 LDKFJ;SADFLKJ', '10', '1001', '100102', 10200, 'sfsfas', 'asdfdasfasf', 'afasfkjlk;jlkadsj', 'aa1234', 'aaksdjf;ksdajfkljl', 'กรุงเทพประกันภัย', '', '1681537528060_vyls88kjqawk8chc0n767x16winb9duu-car-image-1685786372.jpg', '2023-06-03'),
(19, 'Pornsupat', 'Vutisuwan', 'intania@intania.com', 1234567890, '123 Rama', '10', '1002', '100201', 10300, 'City', 'City 2019', 'Honda', 'AA-1234', 'asdf1234asdf', 'ไทยวิวัฒน์', '', 'Exotic-Car-Wallpapers-HD-Edition-stugon (1)-car-image-1685792268.jpg', '2023-06-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
