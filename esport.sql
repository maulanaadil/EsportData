-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2021 at 07:49 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esport`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `playerId` varchar(3) NOT NULL,
  `game` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`playerId`, `game`) VALUES
('P01', 'Dota'),
('P02', 'Dota'),
('P03', 'Valorant'),
('P04', 'Valorant'),
('P05', 'CSGO'),
('P06', 'CSGO'),
('P07', 'Fortnite'),
('P08', 'Fortnite'),
('P09', 'PUBG'),
('P10', 'PUBG'),
('P01', 'Valorant'),
('P03', 'CSGO'),
('P05', 'PUBG'),
('P08', 'Dota');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `playerId` varchar(3) NOT NULL,
  `lastName` varchar(20) DEFAULT NULL,
  `firstName` varchar(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `teamId` varchar(3) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`playerId`, `lastName`, `firstName`, `country`, `teamId`, `gender`, `password`) VALUES
('P01', 'Pham', 'Anathan', 'Australia', 'T01', 'male', '21232f297a57a5a743894a0e4a801fc3'),
('P02', 'Sundstein', 'Johan', 'Denmark', 'T01', 'male', '0192023a7bbd73250516f069df18b500'),
('P03', 'Vu', 'Michael', 'Sweden', 'T02', 'male', 'c1ed8882d7102dda6bb7295af5e11983'),
('P04', 'Sumail', 'Syed', 'Pakistan', 'T02', 'male', 'c1ed8882d7102dda6bb7295af5e11983'),
('P05', 'Babaev', 'Artour', 'Canada', 'T03', 'male', 'e4c471bbaf3c3d0dbf175a0619fdc9a6'),
('P06', 'Yusop', 'Abed', 'Philipines', 'T03', 'male', 'b024944ed240295c928f931b083c8d9b'),
('P07', 'Sapoetrah', 'Rendy', 'Indonesia', 'T04', 'male', 'b024944ed240295c928f931b083c8d9b'),
('P08', 'Putra', 'Adi', 'Indonesia', 'T04', 'male', '22f287f5bb1cb420a99bbe116a238573'),
('P09', 'Yi', 'Pan', 'China', 'T05', 'male', '22f287f5bb1cb420a99bbe116a238573'),
('P10', 'Shenyi', 'Yang', 'China', 'T05', 'male', 'aedb9209893c940f64f83632f2bc373b'),
('P80', 'admin', 'admin', 'test', 'T01', 'male', '21232f297a57a5a743894a0e4a801fc3'),
('P90', 'admin', 'admin', 'admin', 'T04', 'male', '21232f297a57a5a743894a0e4a801fc3'),
('p98', 'asd', 'ds', 'asdas', 'T02', 'female', NULL),
('P99', 'maul', 'adil', 'Indonesia', 'T01', 'male', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `teamId` varchar(3) NOT NULL,
  `teamName` varchar(20) DEFAULT NULL,
  `region` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`teamId`, `teamName`, `region`) VALUES
('T01', 'OG', 'Europe'),
('T02', 'Liquid', 'Europe'),
('T03', 'Evil Geniuses', 'North America'),
('T04', 'BOOM Esporrt', 'SEA'),
('T05', 'Ehome', 'China');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD KEY `fk_playerId` (`playerId`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`playerId`),
  ADD KEY `players_ibfk_1` (`teamId`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`teamId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `fk_playerId` FOREIGN KEY (`playerId`) REFERENCES `players` (`playerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_ibfk_1` FOREIGN KEY (`teamId`) REFERENCES `teams` (`teamId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
