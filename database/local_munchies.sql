-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2021 at 06:43 PM
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
-- Database: `local_munchies`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cuisine`
--

CREATE TABLE `cuisine` (
  `cuisine_id` int(11) NOT NULL,
  `cuisine_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cuisine`
--

INSERT INTO `cuisine` (`cuisine_id`, `cuisine_name`) VALUES
(1, 'kota'),
(2, 'African Food'),
(3, 'Chicken'),
(4, 'Pizza'),
(5, 'Beef'),
(6, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `Fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phoneNo` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passwod` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `c_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` text COLLATE utf8_unicode_ci NOT NULL,
  `customerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`Fname`, `surname`, `phoneNo`, `email`, `passwod`, `c_address`, `gender`, `customerID`) VALUES
('Lunghile', 'chauke', 784529530, 'lunghilesuccess1@gmail.com', 'Lungh!le7', 'Kagiso 2, otlega 829', 'Male', 5),
('Destiny', 'the sir', 823456789, 'destiny@my.richfield.ac.za', 'Lungh!le7', '975 krugersdorp', 'Male', 6);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `food_id` int(11) NOT NULL,
  `storeID` int(11) NOT NULL,
  `cuisine_id` int(11) NOT NULL,
  `food_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `food_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `food_price` decimal(10,2) NOT NULL,
  `food_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`food_id`, `storeID`, `cuisine_id`, `food_name`, `food_desc`, `food_price`, `food_img`) VALUES
(14, 1, 1, 'Kota J', 'french, russian, cheese, chips, sause', '14.00', 'kota1.jpeg'),
(15, 1, 1, 'Kota', 'Cheese, vienna, fries', '16.00', 'kota3.jpeg'),
(16, 1, 1, 'Cheese Tower Kota', 'Lettuce, sauce, cheese, 1 beef patty, gerkins', '39.99', 'kota2.jpeg'),
(18, 1, 6, 'Cheese Tower Burger', 'Lettuce, sauce, cheese, 2 beef patties, gerkins, bacon', '85.00', 'burger-1 (1).jpg'),
(19, 1, 3, 'Chicken', 'half chicken', '120.00', 'lunch-8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `food_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `food_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `OrderStatus` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `customerAddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `OrderDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `food_id`, `customer_id`, `store_id`, `food_name`, `food_price`, `quantity`, `OrderStatus`, `customerAddress`, `OrderDate`) VALUES
(6, 14, 5, 1, 'Kota J', '28.00', 2, 'Complete', '11423 violet crescent', '2021-11-01 21:20:51'),
(7, 15, 6, 1, 'Kota', '112.00', 7, 'Processing', '11423 violet crescent', '2021-11-02 12:54:30'),
(8, 18, 6, 1, 'Cheese Tower Burger', '85.00', 1, 'Complete', '11423 violet crescent', '2021-11-02 12:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `storeowners`
--

CREATE TABLE `storeowners` (
  `storeID` int(11) NOT NULL,
  `ownerName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `storeEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phoneNo` int(10) NOT NULL,
  `rasturantName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rasturantAddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cuisine_id` int(11) NOT NULL,
  `passwod` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `storeowners`
--

INSERT INTO `storeowners` (`storeID`, `ownerName`, `storeEmail`, `phoneNo`, `rasturantName`, `rasturantAddress`, `cuisine_id`, `passwod`) VALUES
(1, 'Lunghile', 'lunghilesuccess1@gmail.com', 784529530, 'localMunchies', 'Kagiso 2, otlega 829', 4, 'Lungh!le7'),
(2, 'KwaJerry', 'chauke.ls2000@gmail.com', 123456789, 'KwaJerry', '11423 violet crescent', 1, 'Lungh!le7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cuisine`
--
ALTER TABLE `cuisine`
  ADD PRIMARY KEY (`cuisine_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `storeowners`
--
ALTER TABLE `storeowners`
  ADD PRIMARY KEY (`storeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cuisine`
--
ALTER TABLE `cuisine`
  MODIFY `cuisine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `storeowners`
--
ALTER TABLE `storeowners`
  MODIFY `storeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
