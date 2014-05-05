SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
USE `c199grp07` ;

-- -----------------------------------------------------
-- Table `c199grp07`.`artist`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `c199grp07`.`artist` ;

CREATE TABLE IF NOT EXISTS `c199grp07`.`artist` (
  `artist_id` INT NOT NULL AUTO_INCREMENT,
  `artist_name` VARCHAR(45) NOT NULL,
  `root_dir` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`artist_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `c199grp07`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `c199grp07`.`user` ;

CREATE TABLE IF NOT EXISTS `c199grp07`.`user` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `artist_id` INT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `birth_date` VARCHAR(10) NOT NULL,
  `not_a_password` VARCHAR(128) NOT NULL,
  `email_address` VARCHAR(45) NOT NULL,
  `city` VARCHAR(45) NULL,
  `country` VARCHAR(45) NULL,
  `created_time` TIMESTAMP NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_artist_artist`
    FOREIGN KEY (`artist_id`)
    REFERENCES `c199grp07`.`artist` (`artist_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `c199grp07`.`receipt`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `c199grp07`.`receipt` ;

CREATE TABLE IF NOT EXISTS `c199grp07`.`receipt` (
  `receipt_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `total_amount` INT NOT NULL,
  `items` VARCHAR(45) NOT NULL,
  `purchase_time` TIMESTAMP NOT NULL,
  PRIMARY KEY (`receipt_id`),
  CONSTRAINT `fk_user_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `c199grp07`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `c199grp07`.`album`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `c199grp07`.`album` ;

CREATE TABLE IF NOT EXISTS `c199grp07`.`album` (
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
    REFERENCES `c199grp07`.`artist` (`artist_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `c199grp07`.`song`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `c199grp07`.`song` ;

CREATE TABLE IF NOT EXISTS `c199grp07`.`song` (
  `song_number` INT NOT NULL,
  `album_id` INT NOT NULL,
  `song_title` VARCHAR(45) NOT NULL,
  `song_price` INT NULL,
  `file_name` VARCHAR(45) NOT NULL,
  `length` INT NULL,
  PRIMARY KEY (`song_number`),
  CONSTRAINT `fk_album_album_id`
    FOREIGN KEY (`album_id`)
    REFERENCES `c199grp07`.`album` (`album_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
