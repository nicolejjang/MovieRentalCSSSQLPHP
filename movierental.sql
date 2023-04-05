-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Dec 02, 2021 at 06:57 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movierental`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendance`
--

CREATE TABLE `employee_attendance` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `time_in` varchar(255) NOT NULL,
  `today_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_attendance`
--

INSERT INTO `employee_attendance` (`id`, `fname`, `lname`, `time_in`, `today_date`) VALUES
(3, ' Alec', ' Sison', '12:38:am ', '2003-12-21');

-- --------------------------------------------------------

--
-- Table structure for table `employee_timeout`
--

CREATE TABLE `employee_timeout` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `time_out` varchar(255) NOT NULL,
  `today_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_timeout`
--

INSERT INTO `employee_timeout` (`id`, `fname`, `lname`, `time_out`, `today_date`) VALUES
(4, ' Alec', ' Sison', '12:38:am ', '2003-12-21');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `movie_name` varchar(50) NOT NULL,
  `director` varchar(255) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `year_released` date NOT NULL,
  `rating` varchar(50) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `movie_name`, `director`, `genre`, `year_released`, `rating`, `duration`, `price`, `stock`, `image`) VALUES
(1, 'Eternals', 'Chloé Zhao', 'Action', '2021-11-05', '6.9', '2h 37m', 500, 98, 'Movies/eternals.jpg'),
(2, 'Dune', 'Denis Villeneuve', 'Adventure', '2021-09-03', '8.2', '2h 35m', 600, 99, 'Movies/dune.jpg'),
(3, 'Free Guy', 'Shawn Levy', 'Action', '2021-08-13', '7.2', '1h 55m', 500, 99, 'Movies/fg.jpg'),
(4, 'The Suicide Squad', 'James Gunn', 'Action', '2021-08-06', '7.3', '2h 12m', 700, 99, 'Movies/ss.jpg'),
(5, 'Black Widow', 'Cate Shortland', 'Action', '2021-07-09', '6.8', '2h 13m', 600, 99, 'Movies/bw.jpg'),
(6, 'Shang CHi', 'Destin Daniel Cretton', 'Action', '2021-09-21', '7.6', '2h 12m', 600, 97, 'Movies/shangchi.jpg'),
(7, 'Red Notice', 'Rawson Thurber', 'Action', '2021-11-05', '6.4', '2h 12m', 500, 94, 'Movies/rednotice.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `products` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `username`, `email`, `phone`, `address`, `payment`, `products`, `amount`) VALUES
(1, 'rovin', 'asdasdasd@gmail.com', '123456789', 'Lian', '', 'Dune', '600'),
(2, 'rovin', 'rovin@gmail.com', '123456789', 'MAnila', 'MASTER CARD', 'Free Guy', '500'),
(3, 'rovin', 'rovin@gmail.com', '123456789', 'Manila', 'VISA', 'Eternals', '500'),
(4, 'nicole', 'nicole@gmail.com', '09123456789', 'Nueva Ecija', 'Gcash', 'Eternals', '500'),
(5, 'nicole', 'nicole@gmail.com', '09123456789', 'Nueva Ecija', 'Gcash', 'Shang CHi', '600'),
(6, 'michael', 'michaelthomps@gmail.com', '09123456789', 'Manila', 'MASTER CARD', 'Red Notice', '500');

-- --------------------------------------------------------

--
-- Table structure for table `rented_movies`
--

CREATE TABLE `rented_movies` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rented_movies`
--

INSERT INTO `rented_movies` (`id`, `user_name`, `movie_name`, `quantity`) VALUES
(1, 'rovin', 'Dune', 1),
(2, 'rovin', 'Dune', 1),
(3, 'rovin', 'Free Guy', 1),
(4, 'rovin', 'Eternals', 1),
(5, 'nicole', 'Eternals', 1),
(6, 'nicole', 'Shang CHi', 2),
(7, 'michael', 'Red Notice', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `phone_number` int(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `first_name`, `middle_name`, `last_name`, `birthday`, `phone_number`, `email`, `user_name`, `password`, `status`, `picture`) VALUES
(1, 'Rovinjan', 'Del Mundo', 'Medrano', '2021-11-05', 912345678, 'rov123123@gmail.com', 'admin', 'admin', 'admin', 'ProfilePic/default.jpg'),
(2, 'Rovinjan', 'D', 'Medrano', '2021-11-12', 2147483647, 'rovinjan123@gmail.com', 'rovin', 'rovin123', 'user', 'ProfilePic/2-81031562_2633208453441277_7872676573986422784_o.jpg'),
(3, 'Nicole', 'S', 'Mabale', '2021-11-30', 123456789, 'nicolemabale12@gmail.com', 'nicole', 'nicole12345', 'user', 'ProfilePic/3-animegirl.jpg'),
(4, 'Alec', '', 'Sison', '2021-08-10', 987654321, 'alec@gmail.com', 'alec', 'alec123', 'employee', 'ProfilePic/default.jpg'),
(5, 'Jose Rafael', '', 'Cruz', '2021-11-03', 2147483647, 'rj@gmail.com', 'rj', 'rj123', 'employee', 'ProfilePic/default.jpg'),
(6, 'Rovin', '', 'Medrano', '2021-11-05', 2147483647, 'rovinjan@gmail.com', 'rovin123', 'rovin12345', 'employee', 'ProfilePic/default.jpg'),
(7, 'Edward', 'Birskin', 'Docks', '2021-10-05', 987654321, 'birskindocks@gmail.com', 'Edward', 'edward123', 'employee', 'ProfilePic/default.jpg'),
(8, 'Michael', 'Edwards', 'Thompson', '2021-12-18', 2147483647, 'michaelthomps@gmail.com', 'michael', 'michael123', 'user', 'ProfilePic/default.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_timeout`
--
ALTER TABLE `employee_timeout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rented_movies`
--
ALTER TABLE `rented_movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee_timeout`
--
ALTER TABLE `employee_timeout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rented_movies`
--
ALTER TABLE `rented_movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
