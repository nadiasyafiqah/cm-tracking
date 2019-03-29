-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 29, 2019 at 04:54 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.11

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prodatav0.5`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `assetID` int(11) NOT NULL,
  `assetBrand` varchar(45) NOT NULL,
  `assetModel` varchar(45) NOT NULL,
  `assetSerial` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `locationID` int(11) NOT NULL,
  `locationState` varchar(49) NOT NULL,
  `locationName` varchar(45) NOT NULL,
  `locationTypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `locationtype`
--

CREATE TABLE `locationtype` (
  `locationTypeID` int(11) NOT NULL,
  `locationTypeName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locationtype`
--

INSERT INTO `locationtype` (`locationTypeID`, `locationTypeName`) VALUES
(1, 'School'),
(2, 'Store');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `logID` int(11) NOT NULL,
  `logDate` date NOT NULL,
  `assetID` int(11) NOT NULL,
  `txnTypeID` int(11) NOT NULL,
  `locationID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `remarks`
--

CREATE TABLE `remarks` (
  `remarkID` int(11) NOT NULL,
  `logID` int(11) NOT NULL,
  `remarkContent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `txntype`
--

CREATE TABLE `txntype` (
  `txnID` int(11) NOT NULL,
  `txnName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `txntype`
--

INSERT INTO `txntype` (`txnID`, `txnName`) VALUES
(1, 'Checkin'),
(2, 'Checkout'),
(3, 'Transfer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`assetID`),
  ADD UNIQUE KEY `assetSerial` (`assetSerial`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`locationID`),
  ADD KEY `fk_location_locationtype1_idx` (`locationTypeID`);

--
-- Indexes for table `locationtype`
--
ALTER TABLE `locationtype`
  ADD PRIMARY KEY (`locationTypeID`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`logID`),
  ADD KEY `fk_log_asset_idx` (`assetID`),
  ADD KEY `fk_log_location1_idx` (`locationID`),
  ADD KEY `fk_log_txntype1_idx` (`txnTypeID`);

--
-- Indexes for table `remarks`
--
ALTER TABLE `remarks`
  ADD PRIMARY KEY (`remarkID`),
  ADD KEY `fk_remarks_log1_idx` (`logID`);

--
-- Indexes for table `txntype`
--
ALTER TABLE `txntype`
  ADD PRIMARY KEY (`txnID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `assetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `locationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `locationtype`
--
ALTER TABLE `locationtype`
  MODIFY `locationTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `remarks`
--
ALTER TABLE `remarks`
  MODIFY `remarkID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `fk_location_locationtype1` FOREIGN KEY (`locationTypeID`) REFERENCES `locationtype` (`locationTypeID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `fk_log_asset` FOREIGN KEY (`assetID`) REFERENCES `asset` (`assetID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_log_location1` FOREIGN KEY (`locationID`) REFERENCES `location` (`locationID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_log_txntype1` FOREIGN KEY (`txnTypeID`) REFERENCES `txntype` (`txnID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `remarks`
--
ALTER TABLE `remarks`
  ADD CONSTRAINT `fk_remarks_log1` FOREIGN KEY (`logID`) REFERENCES `log` (`logID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
