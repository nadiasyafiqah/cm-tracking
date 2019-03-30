-- MySQL Script generated by MySQL Workbench
-- Sat Mar 30 22:32:03 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema tracking
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `tracking` ;

-- -----------------------------------------------------
-- Schema tracking
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tracking` DEFAULT CHARACTER SET latin1 ;
USE `tracking` ;

-- -----------------------------------------------------
-- Table `tracking`.`asset`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tracking`.`asset` (
  `assetID` INT(11) NOT NULL AUTO_INCREMENT,
  `assetBrand` VARCHAR(45) NOT NULL,
  `assetModel` VARCHAR(45) NOT NULL,
  `assetSerial` VARCHAR(45) NOT NULL,
  `assetStatus` INT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`assetID`),
  UNIQUE INDEX `assetSerial` (`assetSerial` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 23
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `tracking`.`locationtype`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tracking`.`locationtype` (
  `locationTypeID` INT(11) NOT NULL AUTO_INCREMENT,
  `locationTypeName` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`locationTypeID`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `tracking`.`location`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tracking`.`location` (
  `locationID` INT(11) NOT NULL AUTO_INCREMENT,
  `locationState` VARCHAR(49) NOT NULL,
  `locationName` VARCHAR(45) NOT NULL,
  `locationTypeID` INT(11) NOT NULL,
  PRIMARY KEY (`locationID`),
  INDEX `fk_location_locationtype1_idx` (`locationTypeID` ASC),
  CONSTRAINT `fk_location_locationtype1`
    FOREIGN KEY (`locationTypeID`)
    REFERENCES `tracking`.`locationtype` (`locationTypeID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 13
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `tracking`.`txntype`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tracking`.`txntype` (
  `txnID` INT(11) NOT NULL,
  `txnName` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`txnID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `tracking`.`log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tracking`.`log` (
  `logID` INT(11) NOT NULL AUTO_INCREMENT,
  `logDate` DATE NOT NULL,
  `assetID` INT(11) NOT NULL,
  `txnTypeID` INT(11) NOT NULL,
  `locationID` INT(11) NOT NULL,
  PRIMARY KEY (`logID`),
  INDEX `fk_log_asset_idx` (`assetID` ASC),
  INDEX `fk_log_location1_idx` (`locationID` ASC),
  INDEX `fk_log_txntype1_idx` (`txnTypeID` ASC),
  CONSTRAINT `fk_log_asset`
    FOREIGN KEY (`assetID`)
    REFERENCES `tracking`.`asset` (`assetID`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_log_location1`
    FOREIGN KEY (`locationID`)
    REFERENCES `tracking`.`location` (`locationID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_log_txntype1`
    FOREIGN KEY (`txnTypeID`)
    REFERENCES `tracking`.`txntype` (`txnID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `tracking`.`remarks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tracking`.`remarks` (
  `remarkID` INT(11) NOT NULL AUTO_INCREMENT,
  `logID` INT(11) NOT NULL,
  `remarkContent` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`remarkID`),
  INDEX `fk_remarks_log1_idx` (`logID` ASC),
  CONSTRAINT `fk_remarks_log1`
    FOREIGN KEY (`logID`)
    REFERENCES `tracking`.`log` (`logID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `tracking`.`locationtype`
-- -----------------------------------------------------
START TRANSACTION;
USE `tracking`;
INSERT INTO `tracking`.`locationtype` (`locationTypeID`, `locationTypeName`) VALUES (1, 'School');
INSERT INTO `tracking`.`locationtype` (`locationTypeID`, `locationTypeName`) VALUES (2, 'Store');

COMMIT;


-- -----------------------------------------------------
-- Data for table `tracking`.`txntype`
-- -----------------------------------------------------
START TRANSACTION;
USE `tracking`;
INSERT INTO `tracking`.`txntype` (`txnID`, `txnName`) VALUES (1, 'Checkin');
INSERT INTO `tracking`.`txntype` (`txnID`, `txnName`) VALUES (2, 'Checkout');
INSERT INTO `tracking`.`txntype` (`txnID`, `txnName`) VALUES (3, 'Transfer');

COMMIT;