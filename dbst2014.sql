-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2014 at 02:46 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `st2014`
--

-- --------------------------------------------------------

--
-- Table structure for table `131034_photos`
--

CREATE TABLE IF NOT EXISTS `131034_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `ts` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `filename` text,
  `owner` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `131034_photos`
--

INSERT INTO `131034_photos` (`id`, `name`, `description`, `suffix`, `ts`, `filename`, `owner`) VALUES
(1, 'testimg', 'käsitsi sisestatud andmebaasi sissekanne', 'png', '2014-12-05 02:08:14', 'frkstvemss', 'kajar9'),
(2, 'testimg2', 'teine käsitsi sisestatud', 'jpg', '2014-12-05 02:13:00', 'asfasfasf', 'kajar9');

-- --------------------------------------------------------

--
-- Table structure for table `131034_users`
--

CREATE TABLE IF NOT EXISTS `131034_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `131034_users`
--

INSERT INTO `131034_users` (`user_id`, `user_name`, `user_password_hash`, `user_email`) VALUES
(2, 'kajar9', '$2y$10$rZqGWiBssCB1xQYFRjv50.x66MKXtt4VHqQcZyR6ph6DxhR0eYRGO', 'kajar8@gmail.com'),
(3, 'test1', '$2y$10$gtIGU2MZIdP.K17IkJ7NZOipIu3lA2cAQ5I1A5C0J8okyhHja8jHK', 'test1@local.com'),
(4, 'test2', '$2y$10$H57JK33W/cKJaS0eh348peXn1aOtqVyr7Ywn3.JbqHfCEdU.gPjG2', 'test2@local.com'),
(5, 'test3', '$2y$10$YnUqw9TjoxYrdvMximkWSOszDKb0A1KUweLIcuJTNOgKhNZjTFnz.', 'test3@local.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
