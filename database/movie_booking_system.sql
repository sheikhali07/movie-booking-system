-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2025 at 09:24 AM
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
-- Database: `movie_booking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  `normal_seats_booked` int(11) DEFAULT 0,
  `gold_seats_booked` int(11) DEFAULT 0,
  `platinum_seats_booked` int(11) DEFAULT 0,
  `box_seats_booked` int(11) DEFAULT 0,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `show_id`, `normal_seats_booked`, `gold_seats_booked`, `platinum_seats_booked`, `box_seats_booked`, `total_amount`, `created_at`) VALUES
(1, 8, 3, 2, 0, 0, 0, 3000.00, '2025-11-05 22:15:53'),
(2, 8, 3, 0, 0, 0, 0, 0.00, '2025-11-05 22:52:54'),
(3, 9, 3, 0, 5, 0, 0, 22500.00, '2025-11-06 18:34:05'),
(4, 9, 3, 0, 5, 0, 0, 22500.00, '2025-11-06 18:34:11'),
(5, 9, 3, 0, 0, 2, 0, 6000.00, '2025-11-06 18:36:39'),
(6, 8, 4, 3, 0, 0, 0, 4500.00, '2025-11-06 18:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `language` varchar(50) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `director` varchar(100) DEFAULT NULL,
  `cast` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `trailer_url` varchar(255) DEFAULT NULL,
  `poster_image` varchar(255) DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT 0.0,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `movie_status` enum('Coming Soon','Released') DEFAULT 'Coming Soon'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `genre`, `language`, `duration`, `release_date`, `director`, `cast`, `description`, `trailer_url`, `poster_image`, `rating`, `status`, `created_at`, `updated_at`, `movie_status`) VALUES
(1, 'Dog Soliders', 'Action', 'English', '240', '2025-11-03', 'Test Happy', 'Test 1 \r\nTest 2\r\nTest 3\r\nTest 4', 'A routine military exercise turns into a nightmare in the Scottish wilderness.', 'https://www.youtube.com/watch?v=5ePiawTX0u8', 'photo.avif', 7.5, 'Active', '2025-11-02 13:17:42', '2025-11-03 23:56:44', 'Released'),
(2, 'Avengers ', 'Action', 'English', '360', '2025-11-05', 'Test 1', 'test test test', 'test test', 'https://www.youtube.com/watch?v=5ePiawTX0u8', '1762091536_photo1.avif', 8.5, 'Active', '2025-11-02 13:52:16', '2025-11-02 14:06:43', 'Released'),
(3, 'Avengers 1', 'Action', 'English', '350', '2025-11-06', 'Test 1', 'test test test', 'test test', 'https://www.youtube.com/watch?v=5ePiawTX0u8', '1762091586_photo2.avif', 9.5, 'Active', '2025-11-02 13:53:06', '2025-11-02 14:06:48', 'Released'),
(4, 'Avengers 3', 'Action', 'English', '350', '2025-11-07', 'Test 34', 'test test testdsadas', 'test test sadasd', 'https://www.youtube.com/watch?v=5ePiawTX0u8', '1762091611_photo3.avif', 9.5, 'Active', '2025-11-02 13:53:31', '2025-11-02 14:06:52', 'Released'),
(5, 'Captain America', 'Action', 'English', '350', '2025-11-08', 'Test 34', 'test test testdsadas', 'test test sadasd', 'https://www.youtube.com/watch?v=5ePiawTX0u8', '1762091656_photo4.avif', 9.5, 'Active', '2025-11-02 13:54:16', '2025-11-02 14:06:56', 'Released');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `movie_id`, `show_id`, `review_text`, `rating`, `created_at`) VALUES
(1, 8, 5, 3, 'test', 2, '2025-11-05 22:52:54');

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE `shows` (
  `id` int(11) NOT NULL,
  `theater_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `show_date` date NOT NULL,
  `show_time` time NOT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `director` varchar(150) DEFAULT NULL,
  `cast` text DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `poster_image` varchar(255) DEFAULT NULL,
  `trailer_url` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `normal_seats_total` int(11) NOT NULL,
  `gold_seats_total` int(11) NOT NULL,
  `platinum_seats_total` int(11) NOT NULL,
  `box_seats_total` int(11) NOT NULL,
  `normal_seats_available` int(11) NOT NULL,
  `gold_seats_available` int(11) NOT NULL,
  `platinum_seats_available` int(11) NOT NULL,
  `box_seats_available` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`id`, `theater_id`, `movie_id`, `show_date`, `show_time`, `genre`, `language`, `duration`, `director`, `cast`, `rating`, `description`, `poster_image`, `trailer_url`, `status`, `normal_seats_total`, `gold_seats_total`, `platinum_seats_total`, `box_seats_total`, `normal_seats_available`, `gold_seats_available`, `platinum_seats_available`, `box_seats_available`, `created_at`, `updated_at`) VALUES
(1, 2, 4, '2025-11-25', '13:00:00', 'Action', 'English', '360', 'Test 1', 'test test test', 8.5, 'test test', '1762091536_photo1.avif', 'https://www.youtube.com/watch?v=5ePiawTX0u8', 'Active', 200, 30, 25, 25, 199, 30, 25, 25, '2025-11-02 21:35:32', '2025-11-02 22:52:14'),
(3, 2, 5, '2025-11-27', '08:00:00', 'Action', 'English', '360', 'Test 1', 'test test test', 8.5, 'test test', '1762091536_photo1.avif', 'https://www.youtube.com/watch?v=5ePiawTX0u8', 'Active', 200, 30, 25, 25, 200, 30, 25, 25, '2025-11-03 23:54:21', '2025-11-04 00:08:34'),
(4, 3, 1, '2025-11-27', '11:08:00', 'Action', 'English', '240', 'Test Happy', 'Test 1 Test 2Test 3Test 4', 7.5, 'A routine military exercise turns into a nightmare in the Scottish wilderness.', 'photo.avif', 'https://www.youtube.com/watch?v=5ePiawTX0u8', 'Active', 250, 50, 30, 25, 250, 50, 30, 25, '2025-11-04 00:02:25', '2025-11-04 00:02:25');

-- --------------------------------------------------------

--
-- Table structure for table `theaters`
--

CREATE TABLE `theaters` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `total_seats` int(11) DEFAULT 0,
  `gold_seats` int(11) DEFAULT 0,
  `platinum_seats` int(11) DEFAULT 0,
  `box_seats` int(11) DEFAULT 0,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `normal_seats` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `theaters`
--

INSERT INTO `theaters` (`id`, `name`, `city`, `address`, `contact_number`, `email`, `total_seats`, `gold_seats`, `platinum_seats`, `box_seats`, `status`, `created_at`, `updated_at`, `normal_seats`) VALUES
(2, 'Test Theater', 'Karachi', 'test street 45-c Sector 147 Karachi Pakistan', '0424343434', 'a2@gmail.com', 280, 30, 25, 25, 'Active', '2025-11-02 00:12:26', '2025-11-02 00:27:19', 200),
(3, 'Universal Theater 35', 'Karachi', 'test street 45-c Sector 147 Karachi', '1234567890', 'test@test.com', 355, 50, 30, 25, 'Active', '2025-11-04 00:00:02', '2025-11-04 00:00:02', 250);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `email_address` varchar(150) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `is_admin` tinyint(1) DEFAULT 0,
  `age` int(11) DEFAULT NULL,
  `user_type` enum('Customer','Admin') DEFAULT 'Customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone_number`, `email_address`, `country`, `language`, `username`, `password`, `is_active`, `is_admin`, `age`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 'ali', 'ahmed', '', 'test@test.com', 'Lahore', NULL, 'aliahmed', '$2y$10$qu8jpgWID2D9bSZklkM76usqGMEsnpw8xlN9/qsPbyOokJAyZxMNe', 0, 0, 20, 'Admin', '2025-11-01 22:27:33', '2025-11-01 23:23:41'),
(7, 'ABC', 'ABC', '1234567890', 'abcc@test.com', 'Karachi', 'English', 'abc', '$2y$10$4nH03.IcVGFrTHd5VwfT7OzEip7.uaiWZyN9KlLkp0KR7/l6v5pmC', 1, 0, 25, 'Customer', '2025-11-01 23:15:01', '2025-11-01 23:20:21'),
(8, 'Ali Ahmed', 'World', '03303699890', 'h@gmail.com', 'Pakistan', 'English', 'h@gmail.com', '$2y$10$HaqY7dFLBHRNWCjmfS.zAO8fiqdOQT/fnf.Iz9DRNdY1.nl7BGaBe', 1, 1, 20, 'Admin', '2025-11-05 08:00:36', '2025-11-07 05:45:09'),
(9, 'Ahmed', 'Tes', '03303699890', 'usera@gmail.com', 'Pakistan', 'English', 'abc@gmail.com', '$2y$10$ElwYUscmu/oRkbFpWikIzuK.muhP2nadt11A2EytL1.c5jMff9JYC', 1, 0, 15, 'Customer', '2025-11-06 18:33:13', '2025-11-06 18:33:13'),
(10, 'Admin ', 'Admin', '123456789', 'admin@test.com', 'Pakistan', NULL, 'admin@gmail.com', '$2y$10$3.m50j5KRQoZ/oG8YTh4Pe5JDctCuCrQzpFyVZPWHIMl3jTchPAuG', 1, 1, 25, 'Admin', '2025-11-09 20:31:23', '2025-11-09 20:38:26'),
(11, 'Customer', ' Customer', '123456789', 'customer@gmail.com', 'Pakistan', 'English', 'customer@gmail.com', '$2y$10$g0scs.YbDrwKLPuN7wOED.uVLVBU0oMrczBBo7OaTG.QNKI9cRhmG', 1, 0, 36, 'Customer', '2025-11-09 20:38:09', '2025-11-12 08:20:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `show_id` (`show_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `show_id` (`show_id`);

--
-- Indexes for table `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theater_id` (`theater_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `theaters`
--
ALTER TABLE `theaters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_address` (`email_address`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shows`
--
ALTER TABLE `shows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `theaters`
--
ALTER TABLE `theaters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`show_id`) REFERENCES `shows` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`show_id`) REFERENCES `shows` (`id`);

--
-- Constraints for table `shows`
--
ALTER TABLE `shows`
  ADD CONSTRAINT `shows_ibfk_1` FOREIGN KEY (`theater_id`) REFERENCES `theaters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shows_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
