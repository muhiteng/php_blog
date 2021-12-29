-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2021 at 09:09 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `rank` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `status`, `rank`) VALUES
(1, 'Categoey1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies sapien sit amet elit fermentum, sed sagittis nulla hendrerit. Etiam semper, velit a porttitor ullamcorper, nisi sapien elementum...', 1, 1),
(2, 'category 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies sapien sit amet elit fermentum, sed sagittis nulla hendrerit. Etiam semper, velit a porttitor ullamcorper, nisi sapien elementum...', 1, 1),
(3, 'Category 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies sapien sit amet elit fermentum, sed sagittis nulla hendrerit. Etiam semper, velit a porttitor ullamcorper, nisi sapien elementum...', 1, 8),
(4, 'Category 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies sapien sit amet elit fermentum, sed sagittis nulla hendrerit. Etiam semper, velit a porttitor ullamcorper, nisi sapien elementum...', 1, 1),
(5, 'ategory 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies sapien sit amet elit fermentum, sed sagittis nulla hendrerit. Etiam semper, velit a porttitor ullamcorper, nisi sapien elementum...', 1, 1),
(6, 'Category 6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies sapien sit amet elit fermentum, sed sagittis nulla hendrerit. Etiam semper, velit a porttitor ullamcorper, nisi sapien elementum...', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contributor_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `text` longtext NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `show` tinyint(1) NOT NULL DEFAULT 1,
  `rank` smallint(6) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `contributor_name`, `email`, `text`, `post_id`, `parent_id`, `status`, `show`, `rank`, `created_at`, `updated_at`) VALUES
(2, 'Ali', 'ali@gmail.com', 'Good article', 4, NULL, 1, 1, 1, '2021-12-27 17:26:09', NULL),
(3, 'Hadi', 'hadi@gmail.com', 'Good article', 4, NULL, 1, 1, 1, '2021-12-27 17:26:09', NULL),
(4, 'mohamad', 'mohamad@gmail.com', 'Perfect article', 3, NULL, 1, 1, 1, '2021-12-27 17:26:09', NULL),
(6, 'Ali', 'ali@gmail.com', 'I need help', 3, NULL, 1, 1, 1, NULL, NULL),
(7, 'Huda', 'huda@gmail.com', 'Thanks', 1, NULL, 1, 1, 1, NULL, NULL),
(8, 'Noor', 'noor@gmail.com', 'right', 1, NULL, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` longtext NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `text`, `category_id`, `user_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'post title 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies sapien sit amet elit fermentum, sed sagittis nulla hendrerit. Etiam semper, velit a porttitor ullamcorper, nisi sapien elementum...', 2, 1, 1, '2021-12-26 17:02:43', NULL, NULL),
(2, 'post title 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies sapien sit amet elit fermentum, sed sagittis nulla hendrerit. Etiam semper, velit a porttitor ullamcorper, nisi sapien elementum...', 2, 1, 1, '2021-12-26 17:02:43', NULL, NULL),
(3, 'post title 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies sapien sit amet elit fermentum, sed sagittis nulla hendrerit. Etiam semper, velit a porttitor ullamcorper, nisi sapien elementum...', 2, 1, 0, '2021-12-26 17:02:43', '2021-12-27 08:00:00', NULL),
(4, 'post title 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies sapien sit amet elit fermentum, sed sagittis nulla hendrerit. Etiam semper, velit a porttitor ullamcorper, nisi sapien elementum...', 3, 2, 0, '2021-12-26 17:02:43', NULL, NULL),
(5, 'post title 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies sapien sit amet elit fermentum, sed sagittis nulla hendrerit. Etiam semper, velit a porttitor ullamcorper, nisi sapien elementum...', 3, 2, 1, '2021-12-26 17:02:43', NULL, NULL),
(6, 'post title 6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies sapien sit amet elit fermentum, sed sagittis nulla hendrerit. Etiam semper, velit a porttitor ullamcorper, nisi sapien elementum...', 4, 2, 1, '2021-12-26 17:02:43', NULL, NULL),
(7, 'New article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies sapien sit amet elit fermentum, sed sagittis nulla hendrerit. Etiam semper, velit a porttitor ullamcorper, nisi sapien elementum...', 2, 1, 1, '2021-12-27 08:00:00', NULL, NULL),
(10, 'Hiring by', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies sapien sit amet elit fermentum, sed sagittis nulla hendrerit. Etiam semper, velit a porttitor ullamcorper, nisi sapien elementum...', 1, 1, 1, '2021-12-27 08:00:00', NULL, NULL),
(11, 'Technologies', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies sapien sit amet elit fermentum, sed sagittis nulla hendrerit. Etiam semper, velit a porttitor ullamcorper, nisi sapien elementum...', 3, 1, 0, '2021-12-27 08:00:00', NULL, NULL),
(12, 'Agile 2021', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies sapien sit amet elit fermentum, sed sagittis nulla hendrerit. Etiam semper, velit a porttitor ullamcorper, nisi sapien elementum...', 1, 1, 1, '2021-12-28 08:00:00', NULL, NULL),
(13, 'Human services', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies sapien sit amet elit fermentum, sed sagittis nulla hendrerit. Etiam semper, velit a porttitor ullamcorper, nisi sapien elementum...', 2, 6, 1, '2021-12-28 08:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `status`) VALUES
(1, 'Mohamad', 'muh.it@gmail.com', '12345', 1, 1),
(2, 'Ali', 'Ali.it@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 1),
(3, 'Hadi', 'mmm@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, 1),
(4, 'Saeed', 'mm@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 1),
(6, 'Abas', 'mm1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 1),
(7, 'Huda', 'yy@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_forign_key` (`post_id`),
  ADD KEY `parent_forign_key` (`parent_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_forign_key` (`category_id`),
  ADD KEY `user_forign_key` (`user_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `parent_forign_key` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`),
  ADD CONSTRAINT `post_forign_key` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `category_forign_key` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `user_forign_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
