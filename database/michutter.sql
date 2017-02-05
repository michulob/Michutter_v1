-- phpMyAdmin SQL Dump
-- version 4.6.5.2deb1+deb.cihar.com~xenial.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 05, 2017 at 04:29 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `michutter`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `tweetId` int(11) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `text` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `userId`, `tweetId`, `creationDate`, `text`) VALUES
(6, 21, 16, '2017-02-03 21:57:26', 'gdfgdgdgfd'),
(15, 26, 17, '2017-02-04 10:19:19', 'gfdgdgdfgfd'),
(19, 28, 31, '2017-02-04 13:56:05', 'dfdsfdsfddsfds'),
(20, 28, 31, '2017-02-04 13:56:10', 'fdsfdsfdsfs'),
(21, 28, 31, '2017-02-04 16:39:46', 'fdsfdsfsdfds'),
(22, 28, 29, '2017-02-04 16:39:52', 'fsdfdsfdsfds'),
(23, 28, 9, '2017-02-04 16:40:14', 'ty dziadu kalwaryjski'),
(24, 28, 31, '2017-02-04 16:42:05', 'fsdfdsfdsfs'),
(25, 29, 35, '2017-02-04 16:44:05', 'fsdfdsfdsfds'),
(26, 29, 36, '2017-02-04 16:51:01', 'gfdgdfgfd'),
(27, 29, 37, '2017-02-04 16:52:19', 'fsfdsfdsfds'),
(28, 29, 35, '2017-02-04 16:52:36', 'fsdfsdfsdfdsfsdfds'),
(29, 29, 31, '2017-02-04 16:52:50', 'fsdfdsfsdfdsfsd'),
(30, 29, 37, '2017-02-04 16:53:10', 'fdsfdsfdsfsd'),
(31, 29, 38, '2017-02-04 22:24:19', 'gfdgfdgdf'),
(32, 29, 38, '2017-02-04 22:24:23', 'gdfgdfgdfgf'),
(33, 29, 35, '2017-02-04 22:24:41', 'terterterte'),
(34, 29, 38, '2017-02-04 22:28:02', 'treterte'),
(35, 28, 39, '2017-02-04 23:17:42', 'gfdgfdgfd'),
(36, 30, 40, '2017-02-05 01:26:38', 'ooooo , nie mow hop dop&oacute;ki nie powiesz hip'),
(37, 30, 41, '2017-02-05 01:33:58', 'tertertertre'),
(38, 28, 42, '2017-02-05 14:58:01', 'fdsfdsfdsfd'),
(39, 31, 43, '2017-02-05 15:04:31', 'gfdgdfgdf');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `idN` int(11) NOT NULL,
  `idO` int(11) NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `readed` tinyint(1) NOT NULL,
  `sendDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `idN`, `idO`, `text`, `readed`, `sendDate`) VALUES
(1, 28, 2, 'gdfgdfgdfgdfgdf', 0, '2017-02-04 16:32:36'),
(2, 28, 2, 'gdfgdfgdfgdfgdf', 0, '2017-02-04 16:33:53'),
(3, 28, 25, 'fsdfdsfdsfdsfsdfdsfdsdfs', 0, '2017-02-04 16:34:17'),
(4, 28, 25, 'fsdfdsfdsfdsfsdfdsfdsdfs', 0, '2017-02-04 16:36:39'),
(5, 28, 25, 'fsdfdsfdsfdsfsdfdsfdsdfs', 0, '2017-02-04 16:37:10'),
(6, 28, 25, 'fsdfdsfdsfdsfsdfdsfdsdfs', 0, '2017-02-04 16:37:18'),
(7, 28, 25, 'fsdfdsfdsfdsfsdfdsfdsdfs', 0, '2017-02-04 16:37:42'),
(8, 28, 25, 'fsdfdsfdsfdsfsdfdsfdsdfs', 0, '2017-02-04 16:38:29'),
(9, 28, 7, 'rewrewrwerew', 0, '2017-02-04 16:38:32'),
(10, 28, 7, 'rewrewrwerew', 0, '2017-02-04 16:39:14'),
(11, 28, 2, 'fsdfsdfsdfsf', 0, '2017-02-04 16:39:22'),
(12, 28, 2, 'fdsfdsfdsfdsfdsfds', 0, '2017-02-04 16:42:20'),
(13, 29, 15, 'fdsfdsdfsfdsfds', 0, '2017-02-04 16:45:16'),
(14, 29, 4, 'gfgfdgfdgdfgfd', 0, '2017-02-04 16:49:54'),
(15, 29, 2, 'gdfgfdgdf', 0, '2017-02-04 16:50:53'),
(16, 29, 2, 'f', 0, '2017-02-04 16:56:05'),
(17, 29, 2, 'fdsfdsfsdfdsfsd', 0, '2017-02-04 16:56:32'),
(18, 29, 2, 'fdsfdsfsdfdsfsd', 0, '2017-02-04 16:58:13'),
(29, 29, 2, 'fsdfdsdf', 0, '2017-02-04 16:59:00'),
(30, 29, 2, 'fsdfdsdf', 0, '2017-02-04 17:01:33'),
(31, 29, 2, 'fdsfsfds', 0, '2017-02-04 17:02:40'),
(32, 29, 2, 'fdsfsfds', 0, '2017-02-04 17:03:12'),
(33, 29, 24, 'tretrerte', 0, '2017-02-04 17:03:26'),
(34, 29, 24, 'tretrerte', 0, '2017-02-04 17:04:56'),
(35, 28, 29, 'fsdfdsfsdfsdfsdfds', 1, '2017-02-05 00:00:30'),
(36, 28, 29, 'fdsfdsfsdfdsfds', 1, '2017-02-04 23:39:53'),
(38, 29, 13, 'tretrtretrtre', 0, '2017-02-04 17:23:08'),
(39, 29, 2, 'terterterterter', 0, '2017-02-04 22:27:34'),
(40, 28, 29, 'ggffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff', 1, '2017-02-05 00:08:15'),
(41, 29, 28, 'rewrewrewrew', 1, '2017-02-04 23:18:24'),
(42, 29, 28, 'rewrewrewrewrw', 1, '2017-02-04 23:18:29'),
(43, 28, 29, 'tretretretre', 1, '2017-02-05 00:10:33'),
(44, 28, 7, 'tretertertre', 0, '2017-02-04 23:20:07'),
(45, 28, 29, 'gdfgdfgdfgdfgdfgdfgdfgdfgdfgfdgfdgdfgdfgdfgd', 1, '2017-02-04 23:39:50'),
(46, 29, 28, 'tretretertertre', 1, '2017-02-04 23:39:10'),
(47, 28, 2, 'tertetrete', 0, '2017-02-05 00:49:27'),
(48, 28, 29, 'aaaaaaaaaaaaaaaaaaaaaaaa', 1, '2017-02-05 00:50:16'),
(49, 28, 29, 'fdsfdsfdsfds', 1, '2017-02-05 00:59:00'),
(50, 28, 29, 'fdsfsdfsdfsdfsdfdsfds', 1, '2017-02-05 01:01:17'),
(51, 29, 2, 'fsdfdsfds', 0, '2017-02-05 01:20:50'),
(52, 29, 28, 'fdsfdsfsdfsdfsdfsdfdsfdsfds', 1, '2017-02-05 14:15:42'),
(55, 30, 28, 'gfdgdfgdfgdfgd', 1, '2017-02-05 15:11:44'),
(56, 29, 2, 'fsdfdsfdsfds', 0, '2017-02-05 11:35:25'),
(57, 28, 2, 'gfdgdfgdfgdggdgdf', 0, '2017-02-05 14:16:03'),
(58, 28, 30, 'rewrewrewerw', 0, '2017-02-05 15:00:09'),
(59, 31, 13, 'gdfgdfgdfgfdgd', 0, '2017-02-05 15:10:45'),
(60, 28, 31, 'gfgffgfdgfdgfdgfdgfdgdfgdfgfdgfdgdfgfgdfgdfgfdgfgfgfdgd', 0, '2017-02-05 15:13:31');

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE `tweets` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `text` varchar(140) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`id`, `userId`, `text`, `creationDate`) VALUES
(9, 21, 'fsdfdsfsdfdsfdfds', '2017-02-03 16:04:36'),
(11, 21, 'fdsfdsfdsfds', '2017-02-03 16:10:43'),
(12, 21, 'fdsfdsfdsfds', '2017-02-03 16:10:54'),
(16, 21, 'gdfgfdgfdgfgfdgfdgd', '2017-02-03 18:20:40'),
(17, 21, 'gfdgfdgfdgfdgdfgdgfd', '2017-02-03 18:35:53'),
(23, 26, 'gfdgdfgfdgfdgdfgd', '2017-02-04 09:57:54'),
(24, 26, 'gfdgfdgfdgfd', '2017-02-04 10:27:05'),
(27, 26, 'gdgdfgdfgd', '2017-02-04 10:27:59'),
(28, 26, 'gfdgfdgdf', '2017-02-04 10:28:11'),
(29, 26, 'gdfgfdgdfgd', '2017-02-04 10:29:21'),
(30, 26, 'gfdgddgfd', '2017-02-04 10:34:07'),
(31, 28, 'gfdgfdgdfgfd', '2017-02-04 11:54:48'),
(32, 28, 'fsdfdsfsdfds', '2017-02-04 16:42:08'),
(33, 28, 'fdsfsfdsfdsfds', '2017-02-04 16:42:27'),
(34, 28, 'fdsfdsfds', '2017-02-04 16:42:36'),
(35, 28, 'fdsfdsfdsfds', '2017-02-04 16:42:42'),
(36, 29, 'gdfgfdgdfd', '2017-02-04 16:50:57'),
(37, 29, 'fsdfdsfds', '2017-02-04 16:52:12'),
(38, 29, 'gfdgdfgdfgdf', '2017-02-04 22:24:17'),
(39, 28, 'gfdgfdgfdd', '2017-02-04 23:17:38'),
(40, 30, 'To jest pierwszy Tweet na nieoficjalnie ukonczonym Ptakierrrrro !!!!!!!!!!!!!!!!!!!', '2017-02-05 01:26:09'),
(41, 30, 'tertetertre', '2017-02-05 01:33:48'),
(42, 28, 'fsfdsfdsfdsfds', '2017-02-05 14:57:58'),
(43, 31, 'gfgfdgfgf', '2017-02-05 15:04:07'),
(44, 31, 'gfgfdgdfgfdgfd', '2017-02-05 15:10:32'),
(45, 31, 'gdfgdfgf', '2017-02-05 15:10:34'),
(46, 28, 'fdfdsfdsfds', '2017-02-05 15:13:16'),
(47, 28, 'fdsfdsfds', '2017-02-05 15:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `username` varchar(40) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `hashed_password` varchar(256) DEFAULT NULL,
  `salt` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `hashed_password`, `salt`) VALUES
(2, 'andrzejjj@wp.pl', 'gdfgfdgfdgfd', '6a7b01ce2f8610dc3379e4d867311aa66b883b75f85158eac61b4d1071abae1f', 'dRIOSW'),
(4, 'fdsfdsds@wp.pl', 'fdsfdgdgfd', '92a0633fe6802db5efa5f2454114c7238f8a05660af74f8a1aa74f6d27b011fe', 'C9cfO3'),
(5, 'fdshkf@wp.pl', 'fndsfjkdsfk', '56523aaa42860648b518da635751e955a5df3ab0654b2a69148bd76b8c87dd0e', 'AD57JI'),
(6, 'fdsgfdgfd@wp.pl', 'gfdgfgfd', '4671c4613614f3fea70854d8495dddc76319c3ed3e747bb902ac87915348c0e7', '1kjpvF'),
(7, 'cfdsghfkds@wp.pl', 'michu', 'b4dbf9f0a0684d2b8597ae15aaeea413e20e4c8e28491af87de79932286e5d8a', 'yscxK5'),
(10, 'fdsfds@wp.pl', 'fdsfdsfs', 'f3839ae940c3afb0f58e5cb101996e070e4f00d3e9f30727f10b265b97cae98b', 'wOG3s2'),
(11, 'fdsfdsfsfs@wp.pl', 'fdsfdfds', '06b4bee9eb5a5d38db58c56a7ee697919ca6889b29ae584e10954a840deca7a2', '0u2V81'),
(13, 'fsdfdsfds@wp.pl', 'kalosz', '9485c4a1675edd00246e23359caad4892dc77bfee77287887e22b8bf3bdde4d3', '8s7DLq'),
(14, 'fhdskjfhdsk@wp.pl', 'tretretertr', '9136a629fcc667982aed320c2d493b6f76174f0fb7406f77bd1d70e3590d84d2', 'TMaMvc'),
(15, 'bambus@wp.pl', 'bambus', '0767f4bbe0f0b97f64b891c0f05596b5d6d854fd229d0b4f549a84b3a97fce55', 'J14Iei'),
(16, 'tretretretre@wp.pl', 'trtrert', 'e5a02153952b770a60eece84f1894e8768926fd3d1b3ad9841d2a8e6ea0b3826', 'e3G57j'),
(21, 'testowy2@wp.pl', 'testowy2', '7a585eb134f1df551a8d43a0a276f12205ffef89672521b52a19e86a05384e30', '336ygT'),
(22, 'kaloszmen@wp.pl', 'kaloszmen', '4c386a1ccf838e57397610545d0764c92ee55ff9fb9cdf809737771d63564916', 'x844jz'),
(24, 'fsdgfdsjfgdsjfds@wp.pl', 'gdfgfgfd', 'b0a9ed55f4fb8d6f9a346f2eb73db1ffc42bf86fb21593335e064113dde3df2b', '5VrDa2'),
(25, 'fsdfsdfsdfsd@wp.pl', 'fsdfdsł', '322a0dd9ed211af96c093134abf132cf5ce2c0384c5c041178078ec9901b1186', '3iOeLN'),
(26, 'cwaniak@wp.pl', 'cwaniak', '07821135c02d0be03d9a9bbc5c27a450d3d1ef28887e74997ef9531144c19c5c', '8At26t'),
(27, 'testowy3@wp.pl', 'testowy3', '4287194ec047510fd48ebe149439cf8b561de8f4e764b1ce8ed08e4e530f88cb', 'C2sk7z'),
(28, 'testowy44@wp.pl', 'testowy44', 'b1c466086f012f8259529229ebea5b2a441bcc5b6f373f3a0ce2c7d4c361191e', '3FLW7f'),
(29, 'krzaczory@wp.pl', 'krzaczory', '4a11916236d9e3ada2fcc8d8d9500ee3944c67e338b81e3ec0bbe9cf88b4ff1f', 'rsYtaV'),
(30, 'michutter@wp.pl', 'Michutter', '4d321cba52f5db2e0de01c586d056be8184f8c98cb2902ff30506b652ec3af5a', 'w5ypEH'),
(31, 'michutter1@wp.pl', 'michutter1', '26e4e50934b24418f5d9a0a8196135730d807c8eacf8439271969faffafcd0a5', 'y8u39K');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `tweetId` (`tweetId`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idN` (`idN`),
  ADD KEY `idO` (`idO`);

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`tweetId`) REFERENCES `tweets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`idN`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`idO`) REFERENCES `users` (`id`);

--
-- Constraints for table `tweets`
--
ALTER TABLE `tweets`
  ADD CONSTRAINT `tweets_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
