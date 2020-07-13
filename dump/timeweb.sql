-- Adminer 4.7.7 MySQL dump

SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `links`;
CREATE TABLE `links` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `url` char(50) NOT NULL,
  `elements` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE `pictures` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `url` char(50) NOT NULL,
  `elements` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


SET NAMES utf8mb4;

DROP TABLE IF EXISTS `text`;
CREATE TABLE `text` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `url` char(50) NOT NULL,
  `elements` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 2020-07-13 03:52:27
