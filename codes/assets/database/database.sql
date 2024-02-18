CREATE SCHEMA IF NOT EXISTS `php_capstone_db` DEFAULT CHARACTER SET utf8 ;
USE `php_capstone_db` ;

CREATE TABLE IF NOT EXISTS `php_capstone_db`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `is_admin` TINYINT NOT NULL  DEFAULT 0,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  `updated_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `php_capstone_db`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `created_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  `updated_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `php_capstone_db`.`products` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `categories_id` INT NOT NULL,
  `users_id` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `price` DECIMAL(7,2) NOT NULL,
  `stocks` INT(7) NOT NULL,
  `sold` INT NOT NULL DEFAULT 0,
  `product_image_json` TEXT NOT NULL,
  `created_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  `updated_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_products_categories1`
    FOREIGN KEY (`categories_id`)
    REFERENCES `php_capstone_db`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `php_capstone_db`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE IF NOT EXISTS `php_capstone_db`.`carts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `users_id` INT NOT NULL,
  `products_id` INT NOT NULL,
  `quantity` INT(7) NOT NULL,
  `created_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  `updated_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_carts_products1`
    FOREIGN KEY (`products_id`)
    REFERENCES `php_capstone_db`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_carts_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `php_capstone_db`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE IF NOT EXISTS `php_capstone_db`.`shipping_informations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `address_1` VARCHAR(100) NOT NULL,
  `address_2` VARCHAR(100) NULL,
  `city` VARCHAR(45) NOT NULL,
  `state` VARCHAR(45) NOT NULL,
  `zip` VARCHAR(10) NOT NULL,
  `created_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  `updated_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `php_capstone_db`.`transactions` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `users_id` INT NOT NULL,
  `shipping_informations_id` INT NOT NULL,
  `quantity` INT(7) NOT NULL,
  `total_amount` DECIMAL(8,2) NOT NULL,
  `status` VARCHAR(45) NOT NULL,
  `created_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  `updated_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_transactions_shipping_informations1`
    FOREIGN KEY (`shipping_informations_id`)
    REFERENCES `php_capstone_db`.`shipping_informations` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_transactions_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `php_capstone_db`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);