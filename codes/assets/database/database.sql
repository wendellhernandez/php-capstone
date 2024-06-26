CREATE SCHEMA IF NOT EXISTS `php_capstone_db` DEFAULT CHARACTER SET utf8 ;
USE `php_capstone_db` ;

CREATE TABLE IF NOT EXISTS `php_capstone_db`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `is_admin` TINYINT(1) NOT NULL  DEFAULT 0,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  `updated_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `php_capstone_db`.`categories` (
  `id` INT(4) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `image_link` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  `updated_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  PRIMARY KEY (`id`));

INSERT INTO `categories` (`id`,`name`,`created_at`,`updated_at`) VALUES (1,'Vegetables','2024-02-18 15:25:13','2024-02-18 15:25:13');
INSERT INTO `categories` (`id`,`name`,`created_at`,`updated_at`) VALUES (2,'Fruits','2024-02-18 15:25:41','2024-02-18 15:25:41');
INSERT INTO `categories` (`id`,`name`,`created_at`,`updated_at`) VALUES (3,'Pork','2024-02-18 15:25:41','2024-02-18 15:25:41');
INSERT INTO `categories` (`id`,`name`,`created_at`,`updated_at`) VALUES (4,'Beef','2024-02-18 15:25:41','2024-02-18 15:25:41');
INSERT INTO `categories` (`id`,`name`,`created_at`,`updated_at`) VALUES (5,'Chicken','2024-02-18 15:25:54','2024-02-18 15:25:54');

CREATE TABLE IF NOT EXISTS `php_capstone_db`.`products` (
  `id` INT(7) NOT NULL AUTO_INCREMENT,
  `category_id` INT(4) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `price` DECIMAL(7,2) NOT NULL,
  `stocks` INT(7) NOT NULL,
  `sold` INT(8) NOT NULL DEFAULT 0,
  `product_image_json` TEXT NOT NULL,
  `created_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  `updated_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_products_categories1`
    FOREIGN KEY (`category_id`)
    REFERENCES `php_capstone_db`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `php_capstone_db`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

INSERT INTO `products` (`id`,`category_id`,`user_id`,`name`,`description`,`price`,`stocks`,`sold`,`product_image_json`,`created_at`,`updated_at`) VALUES (1,1,1,'Tomato','very healthy and delicious',1.70,400,0,'','2024-02-18 15:28:58','2024-02-18 15:28:58');
INSERT INTO `products` (`id`,`category_id`,`user_id`,`name`,`description`,`price`,`stocks`,`sold`,`product_image_json`,`created_at`,`updated_at`) VALUES (2,2,1,'Orange','very yummy and sweet',0.60,350,0,'','2024-02-18 15:30:06','2024-02-18 15:30:06');
INSERT INTO `products` (`id`,`category_id`,`user_id`,`name`,`description`,`price`,`stocks`,`sold`,`product_image_json`,`created_at`,`updated_at`) VALUES (3,1,1,'Onion','very smelly',1.20,600,0,'','2024-02-19 11:24:21','2024-02-19 11:24:21');
INSERT INTO `products` (`id`,`category_id`,`user_id`,`name`,`description`,`price`,`stocks`,`sold`,`product_image_json`,`created_at`,`updated_at`) VALUES (4,2,1,'Pineapple','very yellow',0.90,500,0,'','2024-02-19 11:24:21','2024-02-19 11:24:21');
INSERT INTO `products` (`id`,`category_id`,`user_id`,`name`,`description`,`price`,`stocks`,`sold`,`product_image_json`,`created_at`,`updated_at`) VALUES (5,3,1,'Pork Chop','chopping pork',5.30,250,0,'','2024-02-19 11:24:21','2024-02-19 11:24:21');

CREATE TABLE IF NOT EXISTS `php_capstone_db`.`carts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `product_id` INT(7) NOT NULL,
  `quantity` INT(7) NOT NULL,
  `created_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  `updated_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_carts_products1`
    FOREIGN KEY (`product_id`)
    REFERENCES `php_capstone_db`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_carts_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `php_capstone_db`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE IF NOT EXISTS `php_capstone_db`.`shipping_informations` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `address_1` VARCHAR(100) NOT NULL,
  `address_2` VARCHAR(100) NULL,
  `city` VARCHAR(45) NOT NULL,
  `state` VARCHAR(45) NOT NULL,
  `zip` VARCHAR(10) NOT NULL,
  `created_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  `updated_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  PRIMARY KEY (`id`),
  INDEX `fk_shipping_informations_users1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_shipping_informations_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE IF NOT EXISTS `php_capstone_db`.`billing_informations` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `address_1` VARCHAR(100) NOT NULL,
  `address_2` VARCHAR(100) NULL,
  `city` VARCHAR(45) NOT NULL,
  `state` VARCHAR(45) NOT NULL,
  `zip` VARCHAR(10) NOT NULL,
  `created_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  `updated_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  PRIMARY KEY (`id`),
  INDEX `fk_billing_informations_users1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_billing_informations_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE IF NOT EXISTS `php_capstone_db`.`orders` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `total_amount` DECIMAL(8,2) NOT NULL,
  `status` VARCHAR(45) NOT NULL  DEFAULT 'Pending',
  `created_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  `updated_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_orders_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `php_capstone_db`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE IF NOT EXISTS `php_capstone_db`.`order_details` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `order_id` BIGINT NOT NULL,
  `product_name` VARCHAR(255) NOT NULL,
  `price` DECIMAL(7,2) NOT NULL,
  `quantity` INT(7) NOT NULL,
  `total` DECIMAL(7,2) NOT NULL,
  `created_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  `updated_at` DATETIME NOT NULL  DEFAULT current_timestamp,
  PRIMARY KEY (`id`),
  INDEX `fk_order_details_orders1_idx` (`order_id` ASC) VISIBLE,
  CONSTRAINT `fk_order_details_orders1`
    FOREIGN KEY (`order_id`)
    REFERENCES `mydb`.`orders` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);