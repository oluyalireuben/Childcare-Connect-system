-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2024 at 06:00 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `childcare_connect`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `sent_at`) VALUES
(1, 2, 1, 'hi', '2024-08-09 10:08:13'),
(2, 1, 2, 'hi 2', '2024-08-09 10:08:54'),
(3, 1, 2, 'hi 2', '2024-08-09 10:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `request_message` text DEFAULT NULL,
  `status` enum('pending','approved','declined') DEFAULT 'pending',
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `user_type` enum('parent','provider') NOT NULL,
  `qualification` text DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `services` text DEFAULT NULL,
  `hourly_rate` decimal(10,2) DEFAULT NULL,
  `payment_methods` text DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `location`, `user_type`, `qualification`, `experience`, `services`, `hourly_rate`, `payment_methods`, `profile_image`, `created_at`) VALUES
(1, 'sam', 'sam@gmail.com', '$2y$10$pkMZWtrZZEL3BOfy1RhAoOBtZNv0ARryQwqUNt23hMwdmywrFYKHi', '0792744763', 'Nairobi', 'parent', NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-09 10:05:52'),
(2, 'sam1', 'sam1@gmail.com', '$2y$10$sKO9WIBEVKTp6pfZ8Mqb7.MXIVwKLlJGlXe2RRLzjGfFGb7WsB9a6', NULL, NULL, 'provider', '<br />\r\n<b>Notice</b>:  Undefined index: qualification in <b>C:\\xampp\\htdocs\\projects\\Childcare_Connect_system\\providers\\profile.php</b> on line <b>52</b><br />\r\n', '<br />\r\n<b>Notice</b>:  Undefined index: experience in <b>C:\\xampp\\htdocs\\projects\\Childcare_Connect_system\\providers\\profile.php</b> on line <b>55</b><br />\r\n', '<br />\r\n<b>Notice</b>:  Undefined index: services in <b>C:\\xampp\\htdocs\\projects\\Childcare_Connect_system\\providers\\profile.php</b> on line <b>58</b><br />\r\n', '0.00', '<br />\r\n<b>Notice</b>:  Undefined index: payment_methods in <b>C:\\xampp\\htdocs\\projects\\Childcare_Connect_system\\providers\\profile.php</b> on line <b>64</b><br />\r\n', '', '2024-08-09 10:07:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
