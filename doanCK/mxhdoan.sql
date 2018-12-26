-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2018 at 09:19 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mxhdoan`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `user1Id` int(11) NOT NULL,
  `user2Id` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`user1Id`, `user2Id`, `createdAt`) VALUES
(21, 23, '2018-12-23 02:25:52'),
(23, 21, '2018-12-23 02:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `tinhTrangBaiViet` int(11) NOT NULL COMMENT '0: Công khai, 1: Bạn bè, 2: Chỉ mình tôi',
  `timeCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `picture` varchar(30) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `content`, `tinhTrangBaiViet`, `timeCreate`, `picture`, `idUser`) VALUES
(48, 'Mother Fucker!!!!!', 0, '2018-12-22 07:18:37', 'hinh-anh-dep-ve-tinh-yeu-chung', 21),
(49, 'Hay day', 1, '2018-12-23 01:47:35', 'df90296bca61293f7070.jpg', 23),
(50, 'Hay lắm bạn ơi!!!!', 0, '2018-12-23 07:48:02', '6b7b550bb01e53400a0f.jpg', 21),
(51, 'MMMMMM!!!!', 0, '2018-12-23 08:00:47', '', 21),
(52, 'aaaaaaa', 0, '2018-12-23 08:01:10', '', 21),
(53, 'dddddddddđ', 0, '2018-12-23 08:01:15', '', 21),
(54, 'aaaaaaaaaaaaaâdddd', 2, '2018-12-23 08:02:15', '', 23),
(55, 'Anh Tân qq!!!', 0, '2018-12-23 08:08:15', '6b7b550bb01e53400a0f.jpg', 21);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `avatar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `phone`, `avatar`) VALUES
(21, 'Nguyen Thanh Binh', 'nguyenthanhbinhkhtn@gmail.com', '$2y$10$0KMwBr8gbmCjlKCEdFQ4huTFNESTeGTJZomL/uGVPfD1qLM181gZy', NULL, 'default-avatar.jpg'),
(22, 'Nguyen Thanh Binh', 'hack@gmail.com', '$2y$10$pnEytRp9cpYOLU17wkrr2emx/U7dKGXOGWlFEzzldBo/eVj48c4Xi', NULL, 'default-avatar.jpg'),
(23, 'Nguyễn Thanh Bình', 'ntb@gmail.com', '$2y$10$GZ.8HTZ5NmaHolSI0S/VtexBL4.mhADm/z4maB.Fl9yQoQd6VrpF6', NULL, 'default-avatar.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`user1Id`,`user2Id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`) USING BTREE;

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
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
