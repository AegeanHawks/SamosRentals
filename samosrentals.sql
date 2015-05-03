-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema samosrentals
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema samosrentals
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `samosrentals` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `samosrentals` ;

-- -----------------------------------------------------
-- Table `samosrentals`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `samosrentals`.`User` (
  `Username` VARCHAR(60) NOT NULL,
  `Password` VARCHAR(30) NOT NULL,
  `LastName` VARCHAR(30) NOT NULL,
  `FirstName` VARCHAR(30) NOT NULL,
  `Sex` VARCHAR(10) NOT NULL,
  `Mail` VARCHAR(40) NULL,
  `Birthday` VARCHAR(20) NULL,
  `Role` INT NOT NULL,
  `Image` TEXT NULL,
  `Tel` VARCHAR(20) NULL,
  PRIMARY KEY (`Username`),
  UNIQUE INDEX `Mail_UNIQUE` (`Mail` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `samosrentals`.`Hotel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `samosrentals`.`Hotel` (
  `ID` INT NOT NULL,
  `Name` VARCHAR(100) NULL,
  `Tel` VARCHAR(40) NULL,
  `Description` VARCHAR(500) NULL,
  `Coordinates` VARCHAR(255) NULL,
  `Grade` INT NULL,
  `Manager` VARCHAR(60) NULL,
  `Conforts` VARCHAR(200) NULL,
  `Images` TEXT NULL,
  PRIMARY KEY (`ID`),
  INDEX `FK_Manager_idx` (`Manager` ASC),
  CONSTRAINT `FK_Manager`
    FOREIGN KEY (`Manager`)
    REFERENCES `samosrentals`.`User` (`Username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `samosrentals`.`Auction`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `samosrentals`.`Auction` (
  `ID` INT NOT NULL,
  `Name` VARCHAR(100) NULL,
  `Description` VARCHAR(500) NULL,
  `Closed` TINYINT(1) NULL,
  `Bid_Price` INT NULL,
  `End_Price` INT NULL,
  `idHotel` INT NULL,
  `PeopleCount` INT NULL,
  `End_Date` DATE NULL,
  `Images` TEXT NULL,
  PRIMARY KEY (`ID`),
  INDEX `FK_idHotel_idx` (`idHotel` ASC),
  CONSTRAINT `FK_idHotel`
    FOREIGN KEY (`idHotel`)
    REFERENCES `samosrentals`.`Hotel` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `samosrentals`.`Bid`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `samosrentals`.`Bid` (
  `Username` VARCHAR(60) NOT NULL,
  `idAuction` INT NOT NULL,
  `BidMoney` DECIMAL(2) NULL,
  `Won` TINYINT(1) NULL,
  PRIMARY KEY (`Username`, `idAuction`),
  INDEX `FK_AuctionId_idx` (`idAuction` ASC),
  CONSTRAINT `FK_Username`
    FOREIGN KEY (`Username`)
    REFERENCES `samosrentals`.`User` (`Username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_AuctionId`
    FOREIGN KEY (`idAuction`)
    REFERENCES `samosrentals`.`Auction` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `samosrentals` ;

-- -----------------------------------------------------
-- procedure closeAuctions
-- -----------------------------------------------------

DELIMITER $$
USE `samosrentals`$$
CREATE PROCEDURE `closeAuctions` ()
BEGIN
SELECT @TIMESTAMP_NOW := NOW();
START TRANSACTION;
SELECT *  FROM Auction WHERE End_Date < @TIMESTAMP_NOW AND Closed = '0' FOR UPDATE;
UPDATE Auction SET Closed = '1' WHERE End_Date < @TIMESTAMP_NOW;
COMMIT;
END
$$

DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
