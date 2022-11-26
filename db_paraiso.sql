-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2022 at 08:40 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_paraiso`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` mediumtext NOT NULL,
  `password` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint(20) NOT NULL,
  `resolved` tinyint(1) NOT NULL DEFAULT 0,
  `name_first` text NOT NULL,
  `name_last` text NOT NULL,
  `email` text NOT NULL,
  `subject` text NOT NULL,
  `message` longtext NOT NULL,
  `post_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `resolved`, `name_first`, `name_last`, `email`, `subject`, `message`, `post_time`) VALUES
(1, 1, 'Hans', 'Ramos', 'hans@mail.com', 'This is Hans\' subject', 'The test message here is lorem ipsum: Ullamco non culpa exercitation cillum id eu nostrud quis. Anim pariatur ut pariatur est anim magna officia ut sunt sunt. Cupidatat adipisicing incididunt duis cillum amet ut amet occaecat excepteur amet do duis.\r\n\r\nEx duis eiusmod aute qui. Lorem dolor commodo reprehenderit qui officia do. Id officia irure minim velit veniam ex do pariatur reprehenderit. Ea amet id commodo et laboris velit tempor non ut nostrud veniam pariatur.', '2022-11-26 13:14:32'),
(2, 1, 'Kercwin', 'Ocampo', 'kercwin@mail.com', 'This is my subject', 'This is my message', '2022-11-26 13:15:11'),
(3, 1, 'John', 'Ancheta', 'john@mail.com', 'Feedback abt site', 'This site is really great!\r\n\r\nThat\'s it. That\'s the message', '2022-11-26 13:15:58'),
(4, 0, 'Angelo', 'Filomeno', 'gelo@mail.com', 'Nice site', 'This site is nice. I hope I can make a site like this one day.', '2022-11-26 13:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `package_inquiries`
--

CREATE TABLE `package_inquiries` (
  `id` bigint(20) NOT NULL,
  `resolved` tinyint(1) NOT NULL DEFAULT 0,
  `package_id` int(11) NOT NULL,
  `name_first` mediumtext NOT NULL,
  `name_last` mediumtext NOT NULL,
  `email` mediumtext NOT NULL,
  `subject` mediumtext NOT NULL,
  `message` longtext NOT NULL,
  `post_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package_inquiries`
--

INSERT INTO `package_inquiries` (`id`, `resolved`, `package_id`, `name_first`, `name_last`, `email`, `subject`, `message`, `post_time`) VALUES
(1, 0, 1, 'Kercwin', 'Ocampo', 'kercwin@mail.com', 'I would like a vacation', 'Vacation\'s are fun and relaxing', '2022-11-26 13:18:18'),
(2, 0, 2, 'Hans', 'Ramos', 'hans@mail.com', 'I, too, like vacations', 'I am tired. I want to go on a vacation.', '2022-11-26 13:18:58'),
(3, 0, 3, 'John', 'Ancheta', 'john@mail.com', 'This place looks nice', 'I want to bring my family with me', '2022-11-26 13:20:05'),
(4, 0, 2, 'Angelo', 'Filomeno', 'gelo@mail.com', 'Family of 5', 'Ullamco non culpa exercitation cillum id eu nostrud quis. Anim pariatur ut pariatur est anim magna officia ut sunt sunt. Cupidatat adipisicing incididunt duis cillum amet ut amet occaecat excepteur amet do duis.\r\n\r\nEx duis eiusmod aute qui. Lorem dolor commodo reprehenderit qui officia do. Id officia irure minim velit veniam ex do pariatur reprehenderit. Ea amet id commodo et laboris velit tempor non ut nostrud veniam pariatur.', '2022-11-26 13:21:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_inquiries`
--
ALTER TABLE `package_inquiries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `package_inquiries`
--
ALTER TABLE `package_inquiries`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
