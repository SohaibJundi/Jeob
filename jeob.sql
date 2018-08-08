-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 18, 2017 at 01:26 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jeob`
--

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

DROP TABLE IF EXISTS `domains`;
CREATE TABLE IF NOT EXISTS `domains` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `domains`
--

INSERT INTO `domains` (`id`, `name`) VALUES
(1, 'Accountant'),
(2, 'Architect'),
(3, 'Bank Worker'),
(4, 'Chef'),
(5, 'Chemical Engineer'),
(6, 'Civil engineer'),
(7, 'Dental Assistant'),
(8, 'Developer programmer'),
(9, 'Driver'),
(10, 'Economist'),
(11, 'Electrical Engineer'),
(12, 'Electrician'),
(13, 'Game developer'),
(14, 'Graphic designer'),
(15, 'Laboratory manager'),
(16, 'Musician'),
(17, 'Network Engineer'),
(18, 'Nurse Manager'),
(19, 'Nutritionist'),
(20, 'Pharmacy technician'),
(21, 'Photographer'),
(22, 'Sales and marketing assistant'),
(23, 'Sales and marketing manager'),
(24, 'Translator'),
(25, 'Waiter');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
CREATE TABLE IF NOT EXISTS `offers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `domain_id` int(10) UNSIGNED NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `experience` int(10) UNSIGNED NOT NULL,
  `salary` varchar(12) NOT NULL,
  `description` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`,`user_id`,`domain_id`),
  KEY `fk_offers_users_idx` (`user_id`),
  KEY `fk_offers_domains1_idx` (`domain_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `user_id`, `domain_id`, `longitude`, `latitude`, `experience`, `salary`, `description`) VALUES
(1, 1, 1, '0.0000000', '0.0000000', 5, '5000-6000', 'nothing'),
(2, 4, 1, '0.0000000', '0.0000000', 5, '5000-6000', 'aass'),
(3, 5, 1, '35.6327820', '33.9629389', 2, '2000-3000', ''),
(4, 1, 1, '35.5201721', '33.8070401', 5, '5000-6000', 'xzc');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `domain_id` int(10) UNSIGNED NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `experience` int(10) UNSIGNED NOT NULL,
  `salary` varchar(12) NOT NULL,
  `cv` varchar(40) NOT NULL,
  `expectations` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`,`user_id`,`domain_id`),
  KEY `fk_requests_users_idx` (`user_id`),
  KEY `fk_requests_domains1_idx` (`domain_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `user_id`, `domain_id`, `longitude`, `latitude`, `experience`, `salary`, `cv`, `expectations`) VALUES
(1, 1, 1, '0.0000000', '0.0000000', 5, '5000-6000', '39254cd32d0f0cc1e1fb09f5839a1ae6205feef4', 'nothing'),
(2, 3, 14, '1.2500000', '2.2000000', 5, '500-6000', '', ''),
(3, 4, 1, '0.0000000', '0.0000000', 5, '5000-6000', '6250f3d38bc340f06d407406c1c4c9c79e05319e', 'aa'),
(4, 4, 1, '35.4954529', '33.8786477', 5, '500-6000', '', 'assd'),
(5, 5, 8, '33.2000000', '23.3000000', 1, '790-900', '', ''),
(6, 10, 16, '35.6712341', '34.0676629', 15, '5000-7000', '', 'no actual work'),
(7, 1, 1, '35.5133057', '33.8800387', 5, '500-6000', 'ca5bfba8cf434d4b471b65fe0eff8d75288c3ab1', 'axax'),
(8, 1, 13, '35.5256653', '33.8606545', 5, '500-6000', '2e808b7a2efdf4933a2085f058522698a2f90595', 'sad'),
(9, 1, 1, '35.6053162', '33.8036168', 10, '2000-3000', '44aa1eb5489416456e7af3f548d9ab1d755261e4', 'asxz');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `phone` int(10) UNSIGNED NOT NULL,
  `password` varchar(32) NOT NULL,
  `image` varchar(45) NOT NULL DEFAULT 'images/profileDefault.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone`, `password`, `image`) VALUES
(1, 'Sohaib El Jundi', 'soh@xd.ae', 76451609, '123Q@e123', 'images/1.jpg'),
(2, 'test user', 'test@user.ne', 70000001, '123Q@e123', 'images/profileDefault.jpg'),
(3, 'haidar safa', 'haidar@safa.com', 70123456, '!QAZ2wsx', 'images/profileDefault.jpg'),
(4, 'test users', 'test@user.net', 71111111, '123Q@e123', 'images/4.jpg'),
(5, 'rim Awik', 'rimalawik@gmail.com', 51234456, 'R@work123', 'images/profileDefault.jpg'),
(6, 'Mahmoud Othman', 'mao18@mail.aub.edu', 76585510, '@Mrimsohaib278%', 'images/profileDefault.jpg'),
(7, 'aaa aaa', 'aa@aa.aa', 44444444, '!QAZ2wsx', 'images/profileDefault.jpg'),
(8, 'bbbb bbb', 'bb@bb.bb', 55555555, '!QAZ2wsx', 'images/profileDefault.jpg'),
(9, 'bbbb bbbb', 'bb@bb.bbb', 55555554, '!QAZ2wsx', 'images/profileDefault.jpg'),
(10, 'salam helwany', 'smh54@mail.aub.edu', 76479764, 'S@work123', 'images/10.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `fk_offers_domains1` FOREIGN KEY (`domain_id`) REFERENCES `domains` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_offers_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `fk_requests_domains1` FOREIGN KEY (`domain_id`) REFERENCES `domains` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_requests_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
