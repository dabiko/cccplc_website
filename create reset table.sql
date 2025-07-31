-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 18, 2024 at 12:11 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cccplc_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

DROP TABLE IF EXISTS `user_logs`;
CREATE TABLE IF NOT EXISTS `reset_ctl` (
  `reset_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `reset_code` varchar(200) NOT NULL,
  `reset_status` varchar(5) NOT NULL,
  `gen_time` datetime NOT NULL,
  `reset_time` datetime NULL,
  PRIMARY KEY (`reset_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_logs`
--

-- transfer reset.php to home DIRECTORY
-- transfer reset_login.js --- to RESOURCE
-- transer reset_login.php --- to home DIRECTORY
-- transfer resources/auth_forgotpass.php  ---- to resource directory
-- transfer forgotpass.php --- to home directory
-- replace form_validation.js ---- resources directory
-- transfer passforgot_process.php  ---- resources directory
-- transfer footer.php  ---- home directory oR correct subscribe email 
-- add section to cv page ending to close it properly
-- loginity remove echo logger from _browser_shutdown() to remove 150 at the end of the file.

-- upload edit_customer.php  to home directory
--update profile_menu.php --- add edit_customer.php
--transfer to edit_register_process --- resources directory
--- add function in register class 
    -- user_profile_edit
--transfer to profile_pull.php --- resources directory
-- transfer pull_cus_pro_edit  --- resources directory

--- add function in dynamic_puller class
    --- get_cus_cred