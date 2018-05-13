-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 05, 2018 at 08:59 AM
-- Server version: 5.6.38-log
-- PHP Version: 5.4.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
CREATE DATABASE m6;
USE m6;
--
-- Database: `m6`
--

DELIMITER $$
--
-- Procedures to save user
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `procSaveUser`(IN `i_id` INT, IN `i_firstname` VARCHAR(50), IN `i_lastname` VARCHAR(50), IN `i_email` VARCHAR(50), IN `i_salt` VARCHAR(6), IN `i_password` VARCHAR(128), IN `i_creation_time` DATETIME, IN `i_role` VARCHAR(10), IN `i_user_access` VARCHAR(10), IN `i_subscription` CHAR(1))
BEGIN
    if(i_id=0) then
      insert into tb_user(firstname,lastname,email,salt,password, account_creation_time, role, user_access, subscription) values(i_firstname,i_lastname,i_email,i_salt,i_password, i_creation_time, i_role, i_user_access, i_subscription);
    Else
                 update tb_user set firstname=i_firstname,lastname=i_lastname,email=i_email,salt=i_salt,password=i_password,role=i_role,user_access=i_user_access,subscription=i_subscription where id=i_id;
    end if;
END$$


-- --------------------------------------------------------

--
-- Procedures to save email sent
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `procSaveEmailSent`(IN `i_id` INT(11), IN `i_subject` VARCHAR(125), IN `i_message` TEXT, IN `i_type` VARCHAR(50), IN `i_sent_by` VARCHAR(125), IN `i_recipient` TEXT)
BEGIN
    if(i_id=0) then
      insert into tb_email_sent(subject,message,type,sent_by,recipient) values(i_subject,i_message,i_type,i_sent_by,i_recipient);
    end if;
END$$


-- --------------------------------------------------------

--
-- Procedures for user login
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `procLoginUser`(IN `i_email` VARCHAR(50))
BEGIN
insert into tb_login(email) values(i_email);
END$$

DELIMITER ;

-- --------------------------------------------------------
--
-- Table structure for table `tb_feedback`
--

CREATE TABLE IF NOT EXISTS `tb_feedback` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `comments` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_feedback`
--

INSERT INTO `tb_feedback` (`id`, `firstname`, `lastname`, `email`, `comments`) VALUES
(1, 'Public', 'User', 'public@testmail.com', 'This is a feedback submitted a public user.'),
(2, 'Adam', 'Wong', 'dandarawiyah.shafira@gmail.com', 'This is a feedback submitted by a registered user.');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `salt` varchar(6) UNIQUE,
  `password` varchar(128) NOT NULL,
  `account_creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(10) NOT NULL,
  `user_access` varchar(10) NOT NULL,
  `subscription` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `firstname`, `lastname`, `email`, `salt`,`password`, `account_creation_time`, `role`, `user_access`, `subscription`) VALUES
(1, 'Shafiraton', 'Mardhiah', 'shafiraton@gmail.com','qG2jPR', '3f46d2897363db761f8a6ca6b1655cb9fe571fd6fdd7a2cf4f2bce08f748349667b19d1092838036f72e7ee28689cdbac5cf01ad5d57564df8c24032d6a7f134', '2018-01-04 17:26:13', 'Admin', 'Allowed', 'Y'),
(2, 'Adam', 'Wong', 'dandarawiyah.shafira@gmail.com','zD2qL0', 'd597ea9a692173e6aed2ccb167c2692fd3d4510795c8eb02b3497eec8b5b8aba28a57b521ebae470a652958f1a868511a5ab25b9cbd27f91b9da383d1d8572e2', '2018-01-04 17:26:13', 'User', 'Allowed', 'Y'),
(3, 'Felicia', 'Stones', 'ishika.ulhaq@gmail.com','gD840w', '3fad31689578c56cfbfcb7bae65e83bec006d237731f38c1df1851d5727f014772a209c671e7029a8f1b977f09da7985d86fb0c0979fea4a00862a3be379ba6c', '2018-01-04 17:26:13', 'Admin', 'Allowed', 'N'),
(4, 'Edmund', 'Chow', 'shafiraton.m@gmail.com','rZ2pUJ', '994b41d3def7fcd4bb79472bfe2adbaec17a7b2f52979450a3663de46f43ccecc794ae538cd56f993bbd6d85e11cdd71fa53bed53ad249056ab601872175d5b4', '2018-01-04 17:26:13', 'User', 'Denied', 'Y');


--
-- Table structure for table `tb_login`
--

CREATE TABLE IF NOT EXISTS `tb_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `log_in_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Table structure for table `tb_email_sent`
--

CREATE TABLE IF NOT EXISTS `tb_email_sent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subject` varchar(125) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `sent_by` varchar(125) NOT NULL,
  `recipient` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
