SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `testing` ;
CREATE SCHEMA IF NOT EXISTS `testing` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
DROP SCHEMA IF EXISTS `mydb` ;
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `testing` ;

-- -----------------------------------------------------
-- Table `testing`.`artist`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `testing`.`artist` ;

CREATE TABLE IF NOT EXISTS `testing`.`artist` (
  `artist_id` INT NOT NULL AUTO_INCREMENT,
  `artist_name` VARCHAR(45) NOT NULL,
  `root_dir` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`artist_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testing`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `testing`.`user` ;

CREATE TABLE IF NOT EXISTS `testing`.`user` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `artist_id` INT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `birth_date` VARCHAR(10) NOT NULL,
  `not_a_password` VARCHAR(45) NOT NULL,
  `email_address` VARCHAR(45) NOT NULL,
  `city` VARCHAR(45) NULL,
  `country` VARCHAR(45) NULL,
  `created_time` TIMESTAMP NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_artist_artist`
    FOREIGN KEY (`artist_id`)
    REFERENCES `testing`.`artist` (`artist_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testing`.`receipt`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `testing`.`receipt` ;

CREATE TABLE IF NOT EXISTS `testing`.`receipt` (
  `receipt_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `total_amount` INT NOT NULL,
  `items` VARCHAR(45) NOT NULL,
  `purchase_time` TIMESTAMP NOT NULL,
  PRIMARY KEY (`receipt_id`),
  CONSTRAINT `fk_user_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `testing`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testing`.`album`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `testing`.`album` ;

CREATE TABLE IF NOT EXISTS `testing`.`album` (
  `album_id` INT NOT NULL AUTO_INCREMENT,
  `artist_id` INT NOT NULL,
  `album_title` VARCHAR(45) NOT NULL,
  `album_price` INT NOT NULL,
  `tags` VARCHAR(45) NULL,
  `date_of_release` VARCHAR(10) NOT NULL,
  `dir_location` VARCHAR(45) NULL,
  `description` LONGTEXT NULL,
  PRIMARY KEY (`album_id`),
  CONSTRAINT `fk_artist_artist_id`
    FOREIGN KEY (`artist_id`)
    REFERENCES `testing`.`artist` (`artist_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testing`.`song`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `testing`.`song` ;

CREATE TABLE IF NOT EXISTS `testing`.`song` (
  `song_number` INT NOT NULL,
  `album_id` INT NOT NULL,
  `song_title` VARCHAR(45) NOT NULL,
  `song_price` INT NULL,
  `file_name` VARCHAR(45) NOT NULL,
  `length` INT NULL,
  PRIMARY KEY (`song_number`),
  CONSTRAINT `fk_album_album_id`
    FOREIGN KEY (`album_id`)
    REFERENCES `testing`.`album` (`album_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`tblAgeGroupCategories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tblAgeGroupCategories` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tblAgeGroupCategories` (
  `ageGroupID` INT(10) NOT NULL AUTO_INCREMENT,
  `ageGroupName` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`ageGroupID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`tblCart`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tblCart` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tblCart` (
  `cartID` INT(10) NOT NULL AUTO_INCREMENT,
  `cartitem` BLOB NULL DEFAULT NULL,
  PRIMARY KEY (`cartID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`tblProductCategories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tblProductCategories` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tblProductCategories` (
  `categoryID` INT(10) NOT NULL AUTO_INCREMENT,
  `categoryName` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`categoryID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`tblProducts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tblProducts` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tblProducts` (
  `productID` INT(10) NOT NULL AUTO_INCREMENT,
  `productName` VARCHAR(50) NULL DEFAULT NULL,
  `productDescription` LONGTEXT NULL DEFAULT NULL,
  `productPicture` VARCHAR(255) NULL DEFAULT NULL,
  `productPrice` VARCHAR(50) NULL DEFAULT NULL,
  `productCategory` INT(10) NULL DEFAULT NULL,
  `productMonth` INT(10) NULL DEFAULT NULL,
  `productAgeGroup` INT(10) NULL DEFAULT NULL,
  `productGender` VARCHAR(3) NULL DEFAULT NULL,
  PRIMARY KEY (`productID`),
  CONSTRAINT `fk_tblProducts_tblProductCategories`
    FOREIGN KEY (`productCategory`)
    REFERENCES `mydb`.`tblProductCategories` (`categoryID`),
  CONSTRAINT `fk_tblProducts_tblAgeGroupCategories`
    FOREIGN KEY (`productAgeGroup`)
    REFERENCES `mydb`.`tblAgeGroupCategories` (`ageGroupID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`tblProductReviews`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tblProductReviews` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tblProductReviews` (
  `reviewID` INT(10) NOT NULL AUTO_INCREMENT,
  `ProductReview` LONGTEXT NULL DEFAULT NULL,
  `tblProducts_productID` INT(10) NOT NULL,
  PRIMARY KEY (`reviewID`),
  CONSTRAINT `fk_tblProductReviews_tblProducts`
    FOREIGN KEY (`tblProducts_productID`)
    REFERENCES `mydb`.`tblProducts` (`productID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`tblUsers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tblUsers` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tblUsers` (
  `userID` MEDIUMINT(10) NOT NULL AUTO_INCREMENT,
  `userName` VARCHAR(45) NULL DEFAULT NULL,
  `userPass` VARCHAR(32) NULL DEFAULT NULL,
  `userEmail` VARCHAR(45) NULL DEFAULT NULL,
  `userAuth` VARCHAR(45) NULL DEFAULT NULL,
  `authcode` VARCHAR(32) NULL DEFAULT NULL,
  `role` VARCHAR(6) NULL DEFAULT NULL,
  PRIMARY KEY (`userID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
