-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2024 at 12:03 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `session_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `mobile_number`, `password`, `session_token`) VALUES
(1, '918685844623', '$2y$10$GhgyQGZUyLWfOZ1YPWU9aulHstt67FJ2yrUBB6FNj104Q/8mu8LPW', '5f5344d341d402b985ab96dff55966a4df97c7563e664be1c979fa4eb4d7e97f'),
(2, '918685844612', '$2y$10$EBJZJxt/xOt/k3XGP0u9GeYHgCngWdRHNIA9aPfEPIXL/6V1Ftsai', NULL),
(3, '918965414716', '$2y$10$sOxcxqDu13v53hGLnA6mQOwdY2qotNdIQtvjbFs/uhCJbPkj/tGHi', NULL),
(4, '9185848682', '$2y$10$yT4Co0GD4EiZLMIdzqoiFOKiPbLgBMbdN27t7aeiXtTRR6HOOmWwi', '6a680daf4530e4729d68f35e5e4236731f1c68290ca54eb13f1b94b84f12eb80'),
(5, '91835848682', '$2y$10$o6zBOQAHVz4nBxNbirCeKuDPmn8LUmYbcOPyf4eXFQdR56G7Ho5c.', '4c478d42e2a6e297909552747ab353b23e7ed6ed2d5fd9af878981f94ade0b87');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`) VALUES
(1, 'admin@gmail.com', '$2y$10$GG2msfBXORGhCBhrnwLecOTL5urOeD42Ev1Iw4gyRKPSDlqOg5XYa', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile_number` (`mobile_number`);

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
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
