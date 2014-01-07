-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 04, 2014 at 03:17 PM
-- Server version: 5.6.14
-- PHP Version: 5.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kdmk`
--

-- --------------------------------------------------------

--
-- Structure for view `j_articles`
--

CREATE VIEW `j_articles` AS select `articles`.`id` AS `id`,`articles`.`cat_id` AS `cat_id`,`articles`.`status` AS `status`,`articles`.`slider` AS `slider`,`articles`.`anounce` AS `anounce`,`articles`.`deleted_at` AS `deleted_at`,`articles`.`ended_at` AS `ended_at`,`categories`.`name` AS `category`,`article_details`.`title` AS `title`,`article_details`.`content` AS `content`,`article_details`.`desc` AS `desc`,`article_details`.`lang` AS `lang`,`article_details`.`created_at` AS `created_at`,`article_details`.`updated_at` AS `updated_at` from ((`articles` join `article_details` on((`articles`.`id` = `article_details`.`article_id`))) join `categories` on((`articles`.`cat_id` = `categories`.`id`)));

--
-- VIEW  `j_articles`
-- Data: None
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
