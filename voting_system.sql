-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2025 at 10:55 AM
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
-- Database: `voting_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'junnu', '$2y$10$nfdUQgbktfyFdIO/NNBztuxKrhDjjX6MwxPlhmSmy3KI9M7iC.1RC'),
(3, 'SatishBora', '$2y$10$LlUmN3grFBVZ38Tu77aSL.DdjVFXBtavKlCagp6l//pyWYCf45YWG');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `votes` int(11) DEFAULT 0,
  `party` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `description`, `image`, `votes`, `party`) VALUES
(3, 'aravinda', 'Aravind is pichipuka', 'uploads/candidate_1.jpg', 0, ''),
(4, 'Rohit ', 'Rohit bhai is a good boy and sampradhaeni sudhapusani', 'uploads/candidate_2.jpg', 0, ''),
(7, 'Hari krishna', 'Nepal from south', 'uploads/IMG_20241231_091938.jpg', 0, 'CNG');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `has_voted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `has_voted`) VALUES
(1, 'B RUKSHITH NAIDU ', 'brukshithnaidu.125601@marwadiuniversity.ac.in', '$2y$10$o9zjxx8RzS8VY43kTJW/D./sHuCs.dqo18aTdwJ5afbOrO6XcKWmK', 0),
(2, 'satish', 'bora.125601@marwadiuniversity.ac.in', '$2y$10$hiDV33kqo09K2hbKujC66eCn5rf1b2ebjrj7cnfvp3a9k0/3yEoEe', 0),
(3, 'aravind', 'aravind@marwadiuniversity.ac.in', '$2y$10$D7KwpMnJGqV/jC4lYXRtuOi3np2aY3vg7UlBWpnzWqHJrSsNARDpi', 0),
(4, 'guru', 'guru.1223456@marwadiuniversity.ac.in', '$2y$10$rCsJi5VgJTaJ0OrOP/WM7ulg6FHlKFcgUzJj.tINGRZKaRaIVKCra', 0),
(5, 'naidu', 'naidu@marwadiuniversity.ac.in', '$2y$10$hSbk8fG364KcZ2vHp/FIDeuJi23wdGhsR7q1//MubmhSnYy.TgaSm', 0),
(6, 'Vikas', 'vikas@marwadiuniversity.ac.in', '$2y$10$oD0GmMpZvjBW7J3pHyivbuXE0vppE8JR7sg9/ltgcCaeWuDc1eeVG', 0),
(7, 'B SATISH KUMAR', 'bora.129935@marwadiuniversity.ac.in', '$2y$10$q6CBKp02a98ZIiQoGxCisu1m5wih9OP4AXJqGn5rqbEVKaGZG.Y5i', 0);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `candidate_id`, `voter_id`) VALUES
(1, 3, 1),
(2, 4, 3),
(3, 3, 4),
(4, 4, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidate_id` (`candidate_id`),
  ADD KEY `voter_id` (`voter_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`voter_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
