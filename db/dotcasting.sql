-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for dotcasting
CREATE DATABASE IF NOT EXISTS `dotcasting` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dotcasting`;

-- Dumping structure for table dotcasting.birthday
CREATE TABLE IF NOT EXISTS `birthday` (
  `birthday_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`birthday_id`),
  KEY `FK_verjaardag_persoon` (`user_id`),
  KEY `FK_verjaardag_categorie` (`category_id`),
  KEY `FK_verjaardag_bestand` (`file_id`),
  CONSTRAINT `FK_verjaardag_bestand` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_verjaardag_categorie` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_verjaardag_persoon` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.birthday: ~0 rows (approximately)
/*!40000 ALTER TABLE `birthday` DISABLE KEYS */;
INSERT INTO `birthday` (`birthday_id`, `user_id`, `date`, `category_id`, `file_id`) VALUES
	(1, 3, '2017-11-27', 1, NULL);
/*!40000 ALTER TABLE `birthday` ENABLE KEYS */;

-- Dumping structure for table dotcasting.category
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.category: ~0 rows (approximately)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`category_id`, `name`, `color`) VALUES
	(1, 'Test', '#AD1919');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping structure for table dotcasting.file
CREATE TABLE IF NOT EXISTS `file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(255) NOT NULL,
  `type` varchar(45) NOT NULL COMMENT 'afbeelding, video',
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.file: ~0 rows (approximately)
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` (`file_id`, `location`, `type`) VALUES
	(1, '\\img\\kerst.png', 'afbeelding');
/*!40000 ALTER TABLE `file` ENABLE KEYS */;

-- Dumping structure for table dotcasting.layout
CREATE TABLE IF NOT EXISTS `layout` (
  `layout_id` int(11) NOT NULL AUTO_INCREMENT,
  `font` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL,
  `font_size` varchar(45) NOT NULL,
  `default_background` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`layout_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.layout: ~0 rows (approximately)
/*!40000 ALTER TABLE `layout` DISABLE KEYS */;
INSERT INTO `layout` (`layout_id`, `font`, `color`, `font_size`, `default_background`) VALUES
	(1, 'arial', '#000000', '15', NULL);
/*!40000 ALTER TABLE `layout` ENABLE KEYS */;

-- Dumping structure for table dotcasting.location
CREATE TABLE IF NOT EXISTS `location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal_code` varchar(45) NOT NULL,
  `main_number` varchar(45) NOT NULL,
  `intern_number` int(11) NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.location: ~1 rows (approximately)
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` (`location_id`, `name`, `address`, `postal_code`, `main_number`, `intern_number`) VALUES
	(1, 'Zwolle', '', '', '', 0);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;

-- Dumping structure for table dotcasting.news_article
CREATE TABLE IF NOT EXISTS `news_article` (
  `news_article_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `category_id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `location_id` int(11) NOT NULL,
  `display_from` datetime NOT NULL,
  `display_till` datetime NOT NULL,
  `priority` int(11) NOT NULL DEFAULT '0',
  `description` longtext,
  PRIMARY KEY (`news_article_id`),
  KEY `FK_nieuwsbericht_categorie` (`category_id`),
  KEY `FK_nieuwsbericht_bestand` (`file_id`),
  KEY `FK_nieuwsbericht_locaties` (`location_id`),
  CONSTRAINT `FK_nieuwsbericht_bestand` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_nieuwsbericht_categorie` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_nieuwsbericht_locaties` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.news_article: ~0 rows (approximately)
/*!40000 ALTER TABLE `news_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `news_article` ENABLE KEYS */;

-- Dumping structure for table dotcasting.right
CREATE TABLE IF NOT EXISTS `right` (
  `right_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` longtext,
  PRIMARY KEY (`right_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.right: ~0 rows (approximately)
/*!40000 ALTER TABLE `right` DISABLE KEYS */;
INSERT INTO `right` (`right_id`, `name`, `description`) VALUES
	(1, 'Aanmaken nieuwsbericht', 'Aanmaken van een nieuwsbericht');
/*!40000 ALTER TABLE `right` ENABLE KEYS */;

-- Dumping structure for table dotcasting.screen
CREATE TABLE IF NOT EXISTS `screen` (
  `screen_id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `orientation` varchar(45) NOT NULL,
  `theme_id` int(11) NOT NULL,
  PRIMARY KEY (`screen_id`),
  KEY `FK__locaties` (`location_id`),
  KEY `FK__thema` (`theme_id`),
  CONSTRAINT `FK__locaties` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK__thema` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`theme_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.screen: ~0 rows (approximately)
/*!40000 ALTER TABLE `screen` DISABLE KEYS */;
INSERT INTO `screen` (`screen_id`, `location_id`, `orientation`, `theme_id`) VALUES
	(2, 1, 'verticaal', 1);
/*!40000 ALTER TABLE `screen` ENABLE KEYS */;

-- Dumping structure for table dotcasting.theme
CREATE TABLE IF NOT EXISTS `theme` (
  `theme_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `file_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`theme_id`),
  KEY `FK__bestand` (`file_id`),
  KEY `FK_thema_layout` (`layout_id`),
  CONSTRAINT `FK__bestand` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_thema_layout` FOREIGN KEY (`layout_id`) REFERENCES `layout` (`layout_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.theme: ~0 rows (approximately)
/*!40000 ALTER TABLE `theme` DISABLE KEYS */;
INSERT INTO `theme` (`theme_id`, `name`, `file_id`, `layout_id`) VALUES
	(1, 'Kerst', 1, 1);
/*!40000 ALTER TABLE `theme` ENABLE KEYS */;

-- Dumping structure for table dotcasting.user
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `insertion` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `location` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `FK_persoon_locaties` (`location`),
  CONSTRAINT `FK_persoon_locaties` FOREIGN KEY (`location`) REFERENCES `location` (`location_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='Alle informatie van de medewerkers maar ook admins';

-- Dumping data for table dotcasting.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `first_name`, `insertion`, `last_name`, `birthday`, `email`, `password`, `admin`, `location`) VALUES
	(3, 'Admin', NULL, 'admin', '1998-05-14', 'admin@dotcasting.nl', 'test', 1, 1),
	(6, 'Medewerker', NULL, 'medewerker', '1978-10-10', 'medewerker@dotcasting.nl', 'test', 0, 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table dotcasting.user_has_right
CREATE TABLE IF NOT EXISTS `user_has_right` (
  `user_id` int(11) NOT NULL,
  `right_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`right_id`),
  KEY `FK_persoon_has_recht_recht` (`right_id`),
  CONSTRAINT `FK__persoon` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_persoon_has_recht_recht` FOREIGN KEY (`right_id`) REFERENCES `right` (`right_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tussentabel voor rechten en personen';

-- Dumping data for table dotcasting.user_has_right: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_has_right` DISABLE KEYS */;
INSERT INTO `user_has_right` (`user_id`, `right_id`) VALUES
	(6, 1);
/*!40000 ALTER TABLE `user_has_right` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
