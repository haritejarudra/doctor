-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 18, 2013 at 06:51 PM
-- Server version: 5.5.31-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `peoples_doctor`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(10) NOT NULL AUTO_INCREMENT,
  `lat` decimal(10,6) NOT NULL,
  `long` decimal(10,6) NOT NULL,
  `city` varchar(50) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `lat`, `long`, `city`) VALUES
(1, 17.366000, 78.476000, 'Hyderabad'),
(2, 12.966700, 77.566700, 'Bangalore');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE IF NOT EXISTS `doctor` (
  `doctor_id` int(7) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `gender` char(1) NOT NULL,
  `address` varchar(200) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `current_hospital` varchar(100) NOT NULL,
  `experience` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `age` int(3) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `speciality_Sub_Speciality_link_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`doctor_id`),
  KEY `city_id` (`city_id`),
  KEY `speciality_Sub_Speciality_link_id` (`speciality_Sub_Speciality_link_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `first_name`, `last_name`, `mobile`, `gender`, `address`, `state`, `country`, `current_hospital`, `experience`, `date_of_birth`, `age`, `city_id`, `speciality_Sub_Speciality_link_id`) VALUES
(1, 'Rahul', 'Abraham', '9632578410', 'm', 'Padmarao Nagar,Secunderabad,Andhra Pradesh,500020, Walker town, Padmarao Nagar, Secunderabad, AP', 'AP', 'INDIA', 'Gandhi Medical', '5', '0000-00-00', 19, 1, 7),
(2, 'Sudha', 'Nakala', '1478523690', 'f', 'Padmarao Nagar,Secunderabad,Andhra Pradesh,500020, Walker town, Padmarao Nagar, Bangalore, AP', 'AP', 'INDIA', 'xxx-Medical college', '15', '0000-00-00', 21, 2, 19);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `location_id` int(10) NOT NULL AUTO_INCREMENT,
  `lat` decimal(10,6) NOT NULL,
  `long` decimal(10,6) NOT NULL,
  `city_id` int(10) NOT NULL,
  `location` varchar(50) NOT NULL,
  PRIMARY KEY (`location_id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `lat`, `long`, `city_id`, `location`) VALUES
(2, 17.424438, 78.504285, 1, 'Gandhi Hospital, Padmarao Nagar, Secunderabad'),
(3, 17.373945, 78.474630, 1, 'Osmania Hospital, Koti, Hyderabad');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `patient_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `gender` char(1) NOT NULL,
  `age` int(3) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` varchar(200) NOT NULL,
  `parent_guardian` varchar(100) NOT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `patient_request`
--

CREATE TABLE IF NOT EXISTS `patient_request` (
  `request_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_id` int(10) NOT NULL,
  `schedule_id` int(10) NOT NULL,
  `problem_history` varchar(500) NOT NULL,
  `planned_date_consultation` date NOT NULL,
  `actual_date_of_consultation` date NOT NULL,
  `time_of_consultation` time NOT NULL,
  `request_status` varchar(20) DEFAULT NULL,
  `status_change_date` date NOT NULL,
  PRIMARY KEY (`request_id`),
  KEY `schedule_id` (`schedule_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `qualification`
--

CREATE TABLE IF NOT EXISTS `qualification` (
  `qualification_id` int(10) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(10) NOT NULL,
  `degree` varchar(50) NOT NULL,
  `year` int(4) NOT NULL,
  `university` varchar(20) NOT NULL,
  PRIMARY KEY (`qualification_id`),
  KEY `doctor_id` (`doctor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `qualification`
--

INSERT INTO `qualification` (`qualification_id`, `doctor_id`, `degree`, `year`, `university`) VALUES
(1, 1, 'M.B.B.S', 2012, 'Gandhi Medical Colle'),
(2, 2, 'M.B.B.S', 2013, 'Osmania Medical Coll');

-- --------------------------------------------------------

--
-- Table structure for table `request_status_change`
--

CREATE TABLE IF NOT EXISTS `request_status_change` (
  `Status_Change_id` int(10) NOT NULL AUTO_INCREMENT,
  `Status_from` varchar(20) NOT NULL,
  `Status_to` varchar(20) NOT NULL,
  `Actor` varchar(20) NOT NULL,
  PRIMARY KEY (`Status_Change_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `request_status_change`
--

INSERT INTO `request_status_change` (`Status_Change_id`, `Status_from`, `Status_to`, `Actor`) VALUES
(1, 'Pending', 'Activated', 'Doctor'),
(2, 'Pending', 'Activated', 'Admin'),
(3, 'Pending', 'DeActivated', 'All'),
(4, 'Activated', 'DeActivated', 'Doctor'),
(5, 'Activated', 'DeActivated', 'Admin'),
(6, 'Activated', 'Completed', 'Admin'),
(7, 'Activated', 'DNA', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `days_of_week` varchar(20) NOT NULL,
  `from_time` time NOT NULL,
  `to_time` time NOT NULL,
  `location_id` int(10) NOT NULL,
  `doctor_id` int(10) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`schedule_id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `from_date`, `to_date`, `expiry_date`, `days_of_week`, `from_time`, `to_time`, `location_id`, `doctor_id`, `description`) VALUES
(2, '2013-09-01', '2013-09-01', '2999-12-31', '', '17:00:00', '19:00:00', 2, 1, 'Pediatric consulting below 5 years'),
(3, '2013-09-20', '2013-09-20', '2999-12-31', '', '17:00:00', '18:00:00', 3, 2, 'Free Clinic in Cardiology');

-- --------------------------------------------------------

--
-- Table structure for table `speciality`
--

CREATE TABLE IF NOT EXISTS `speciality` (
  `speciality_id` int(10) NOT NULL AUTO_INCREMENT,
  `speciality` varchar(200) NOT NULL,
  PRIMARY KEY (`speciality_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `speciality`
--

INSERT INTO `speciality` (`speciality_id`, `speciality`) VALUES
(1, 'Pediatrics'),
(2, 'Cardiology'),
(3, 'Neurology'),
(4, 'Anatomy'),
(5, 'Anesthesia'),
(6, 'Bio-Chemistry'),
(7, 'Dermatology'),
(8, 'Dental'),
(9, 'Endocrinology'),
(10, 'ENT'),
(11, 'Gastroentrology'),
(12, 'General Surgery');

-- --------------------------------------------------------

--
-- Table structure for table `speciality_sub_speciality_link`
--

CREATE TABLE IF NOT EXISTS `speciality_sub_speciality_link` (
  `speciality_sub_speciality_link_id` int(10) NOT NULL AUTO_INCREMENT,
  `sub_speciality_id` int(10) NOT NULL,
  `speciality_id` int(10) NOT NULL,
  PRIMARY KEY (`speciality_sub_speciality_link_id`),
  KEY `speciality_id` (`speciality_id`),
  KEY `sub_speciality_id` (`sub_speciality_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `speciality_sub_speciality_link`
--

INSERT INTO `speciality_sub_speciality_link` (`speciality_sub_speciality_link_id`, `sub_speciality_id`, `speciality_id`) VALUES
(1, 2, 1),
(2, 1, 4),
(3, 6, 1),
(4, 6, 2),
(5, 1, 2),
(6, 1, 2),
(7, 3, 2),
(8, 4, 3),
(9, 6, 3),
(11, 9, 3),
(12, 1, 4),
(13, 9, 4),
(14, 2, 5),
(15, 4, 5),
(16, 6, 5),
(17, 3, 6),
(18, 7, 6),
(19, 6, 7),
(20, 9, 7),
(21, 7, 8),
(22, 1, 8),
(23, 2, 8),
(24, 9, 9),
(25, 7, 9),
(26, 1, 9),
(27, 6, 10),
(28, 2, 10),
(29, 3, 10),
(30, 4, 11),
(31, 2, 11),
(32, 1, 11),
(33, 1, 12),
(34, 3, 12),
(35, 4, 12);

-- --------------------------------------------------------

--
-- Table structure for table `sub_speciality`
--

CREATE TABLE IF NOT EXISTS `sub_speciality` (
  `sub_speciality_id` int(10) NOT NULL AUTO_INCREMENT,
  `speciality` varchar(200) NOT NULL,
  PRIMARY KEY (`sub_speciality_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `sub_speciality`
--

INSERT INTO `sub_speciality` (`sub_speciality_id`, `speciality`) VALUES
(1, 'Cardiology'),
(2, 'Cardiotheracic Surgery'),
(3, 'Nephrology'),
(4, 'Urology'),
(6, 'Neonatology'),
(7, 'Neurology'),
(9, 'Neurosurgery');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctor_ibfk_3` FOREIGN KEY (`speciality_Sub_Speciality_link_id`) REFERENCES `speciality_sub_speciality_link` (`speciality_sub_speciality_link_id`) ON DELETE SET NULL;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_request`
--
ALTER TABLE `patient_request`
  ADD CONSTRAINT `patient_request_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`schedule_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_request_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE;

--
-- Constraints for table `qualification`
--
ALTER TABLE `qualification`
  ADD CONSTRAINT `qualification_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`) ON DELETE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE CASCADE;

--
-- Constraints for table `speciality_sub_speciality_link`
--
ALTER TABLE `speciality_sub_speciality_link`
  ADD CONSTRAINT `speciality_sub_speciality_link_ibfk_1` FOREIGN KEY (`speciality_id`) REFERENCES `speciality` (`speciality_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `speciality_sub_speciality_link_ibfk_2` FOREIGN KEY (`sub_speciality_id`) REFERENCES `sub_speciality` (`sub_speciality_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
