/*
Created: 11/6/2019
Modified: 13/6/2019
Model: arduino ph
Database: MySQL 5.6
*/


-- Create tables section -------------------------------------------------

-- Table ph_list

CREATE TABLE `ph_list`
(
  `id` Int(6) NOT NULL AUTO_INCREMENT,
  `value` Double(7,4) NOT NULL,
  `creation_date` Datetime,
  `category_id` Int(6),
  PRIMARY KEY (`id`)
)
;

CREATE INDEX `IX_Relationship1` ON `ph_list` (`category_id`)
;

-- Table ph_categories

CREATE TABLE `ph_categories`
(
  `id` Int(6) NOT NULL AUTO_INCREMENT,
  `description` Varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
)
;

-- Table users

CREATE TABLE `users`
(
  `id` Int(6) NOT NULL AUTO_INCREMENT,
  `fullname` Varchar(55),
  `username` Varchar(35) NOT NULL,
  `password` Varchar(35) NOT NULL,
  `type` Enum('admin','user') NOT NULL,
  PRIMARY KEY (`id`)
)
;

-- Create foreign keys (relationships) section ------------------------------------------------- 


ALTER TABLE `ph_list` ADD CONSTRAINT `Relationship1` FOREIGN KEY (`category_id`) REFERENCES `ph_categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;


