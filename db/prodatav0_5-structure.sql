-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 29, 2019 at 03:58 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.11

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
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `locationID` int(11) NOT NULL AUTO_INCREMENT,
  `locationState` varchar(49) NOT NULL,
  `locationName` varchar(45) NOT NULL,
  `locationTypeID` int(11) NOT NULL,
  PRIMARY KEY (`locationID`),
  KEY `fk_location_locationtype1_idx` (`locationTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `locationtype`
--

DROP TABLE IF EXISTS `locationtype`;
CREATE TABLE IF NOT EXISTS `locationtype` (
  `locationTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `locationTypeName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`locationTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `logID` int(11) NOT NULL AUTO_INCREMENT,
  `logDate` date NOT NULL,
  `assetID` int(11) NOT NULL,
  `txnTypeID` int(11) NOT NULL,
  `locationID` int(11) NOT NULL,
  PRIMARY KEY (`logID`),
  KEY `fk_log_asset_idx` (`assetID`),
  KEY `fk_log_location1_idx` (`locationID`),
  KEY `fk_log_txntype1_idx` (`txnTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `remarks`
--

DROP TABLE IF EXISTS `remarks`;
CREATE TABLE IF NOT EXISTS `remarks` (
  `remarkID` int(11) NOT NULL AUTO_INCREMENT,
  `logID` int(11) NOT NULL,
  `remarkContent` int(11) NOT NULL,
  PRIMARY KEY (`remarkID`),
  KEY `fk_remarks_log1_idx` (`logID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `txntype`
--

DROP TABLE IF EXISTS `txntype`;
CREATE TABLE IF NOT EXISTS `txntype` (
  `txnID` int(11) NOT NULL,
  `txnName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`txnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;