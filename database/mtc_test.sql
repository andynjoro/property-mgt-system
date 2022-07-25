-- Adminer 4.8.1 MySQL 8.0.18 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;

SET NAMES utf8mb4;

CREATE TABLE `properties` (
  `uuid` text NOT NULL,
  `property_type_id` int(10) NOT NULL,
  `county` text NOT NULL,
  `country` text NOT NULL,
  `town` text NOT NULL,
  `description` text NOT NULL,
  `address` text NOT NULL,
  `image_full` text NOT NULL,
  `image_thumbnail` text NOT NULL,
  `latitude` text NOT NULL,
  `longitude` text NOT NULL,
  `num_bedrooms` int(3) NOT NULL,
  `num_bathrooms` int(3) NOT NULL,
  `price` int(10) NOT NULL,
  `type` enum('sale','rent') NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`uuid`(255)),
  KEY `town` (`town`(255)),
  KEY `num_bedrooms` (`num_bedrooms`),
  KEY `price` (`price`),
  KEY `type` (`type`),
  KEY `property_type_id` (`property_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `property_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- 2022-07-25 13:38:40
