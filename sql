-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 05, 2017 at 08:39 AM
-- Server version: 5.6.28
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `task`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `map` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `video` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `Publish` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `title`, `body`, `image`, `map`, `video`, `slug`, `active`, `Publish`, `created_at`, `updated_at`) VALUES
(4, 1, 'test2', '<p>asdfds</p>', '["Screen Shot 2017-02-05 at 9.32.47 AM.png","Screen Shot 2017-02-05 at 9.32.53 AM.png","Screen Shot 2017-02-05 at 9.32.56 AM.png"]', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d65311067.19274228!2d14.365738034096433!3d2.4161938008876205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3663f18a24cbe857%3A0xa9416bfcd3a0f459!2sAsia!5e0!3m2!1sen!2seg!4v1486204340564', '', 'test2', 1, 0, '2017-02-04 09:28:22', '2017-02-04 09:28:22'),
(5, 1, 'asd', '<p>sdfsd</p>', '["Screen Shot 2017-02-05 at 9.32.47 AM.png","Screen Shot 2017-02-05 at 9.32.53 AM.png","Screen Shot 2017-02-05 at 9.32.56 AM.png"]', '', '', 'asd', 1, 0, '2017-02-04 09:30:12', '2017-02-04 09:30:12'),
(8, 1, 'test', 'test', '', '', '', '', 0, 0, '2017-02-04 10:06:09', '2017-02-04 10:06:09'),
(13, 1, 'titledfs', 'bodysdf', '', '', '', 'tetdsfe', 0, 0, '2017-02-05 05:22:13', '2017-02-05 05:22:13'),
(17, 1, 'titledfsdsf', 'bodysdf', '', '', '', 'slug', 0, 0, '2017-02-05 05:23:39', '2017-02-05 05:23:39'),
(21, 2, 'my artical', '<p>asda</p>', '["Screen Shot 2017-02-05 at 9.32.47 AM.png","Screen Shot 2017-02-05 at 9.32.53 AM.png","Screen Shot 2017-02-05 at 9.32.56 AM.png"]', '', '', 'my-artical', 1, 0, '2017-02-05 05:33:31', '2017-02-05 05:33:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_title_unique` (`title`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_author_id_foreign` (`author_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
