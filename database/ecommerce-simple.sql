-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema ecommerce-simple
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ecommerce-simple
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ecommerce-simple` DEFAULT CHARACTER SET utf8 ;
USE `ecommerce-simple` ;

-- -----------------------------------------------------
-- Table `ecommerce-simple`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecommerce-simple`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` LONGTEXT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `username_idx` (`username` ASC) VISIBLE,
  INDEX `email_idx` (`email` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecommerce-simple`.`administrator`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecommerce-simple`.`administrator` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` LONGTEXT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `username_idx` (`username` ASC) VISIBLE,
  INDEX `email_idx` (`email` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecommerce-simple`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecommerce-simple`.`category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `name_idx` (`name` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecommerce-simple`.`product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecommerce-simple`.`product` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `price` DOUBLE NOT NULL,
  `quantity` INT NULL,
  `image` VARCHAR(200) NULL,
  `image_large` VARCHAR(200) NULL,
  `category` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `name_idx` (`name` ASC) VISIBLE,
  INDEX `category_fk_idx` (`category` ASC) VISIBLE,
  CONSTRAINT `category_fk`
    FOREIGN KEY (`category`)
    REFERENCES `ecommerce-simple`.`category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
