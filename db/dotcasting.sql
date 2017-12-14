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
  `background_color` varchar(45) NOT NULL,
  PRIMARY KEY (`category_id`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.category: ~5 rows (approximately)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`category_id`, `name`, `background_color`) VALUES
	(1, 'Test', '#AD1919'),
	(2, 'Financieel', 'grey'),
	(3, 'Administratie', 'green'),
	(4, 'Wereldnieuws', 'blue'),
	(5, 'Evenement', 'orange');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping structure for table dotcasting.file
CREATE TABLE IF NOT EXISTS `file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(255) NOT NULL,
  `type` varchar(45) NOT NULL COMMENT 'afbeelding, video',
  `muted` tinyint(4) NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.file: ~5 rows (approximately)
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` (`file_id`, `location`, `type`, `muted`) VALUES
	(1, '\\img\\kerst.png', 'afbeelding', 0),
	(2, '../bestanden/media/foto/test.jpg', 'afbeelding', 0),
	(3, '../bestanden/media/foto/test2.jpg', 'afbeelding', 0),
	(4, '\\img\\bolcom.png', 'afbeelding', 0),
	(5, '../bestanden/media/foto/Bedrijfkolom.png', 'foto', 0),
	(6, 'D:/Program Files/Xampp/htdocs/KBS/Project-KBS/bestanden/media/foto/8206ERD(versie1).png', 'foto', 0);
/*!40000 ALTER TABLE `file` ENABLE KEYS */;

-- Dumping structure for table dotcasting.layout
CREATE TABLE IF NOT EXISTS `layout` (
  `layout_id` int(11) NOT NULL AUTO_INCREMENT,
  `font` varchar(45) NOT NULL,
  `font_color` varchar(45) NOT NULL,
  `background_color` varchar(45) NOT NULL,
  `default_background` int(11) NOT NULL,
  `logo` int(11) NOT NULL,
  PRIMARY KEY (`layout_id`),
  KEY `FK_layout_file` (`default_background`),
  KEY `FK_layout_file_2` (`logo`),
  CONSTRAINT `FK_layout_file` FOREIGN KEY (`default_background`) REFERENCES `file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_layout_file_2` FOREIGN KEY (`logo`) REFERENCES `file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.layout: ~1 rows (approximately)
/*!40000 ALTER TABLE `layout` DISABLE KEYS */;
INSERT INTO `layout` (`layout_id`, `font`, `font_color`, `background_color`, `default_background`, `logo`) VALUES
	(1, 'arial', '#00000', '', 1, 4);
/*!40000 ALTER TABLE `layout` ENABLE KEYS */;

-- Dumping structure for table dotcasting.location
CREATE TABLE IF NOT EXISTS `location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL,
  `theme_id` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal_code` varchar(45) NOT NULL,
  `main_number` varchar(45) NOT NULL,
  `intern_number` int(11) NOT NULL,
  PRIMARY KEY (`location_id`),
  KEY `FK_location_layout` (`layout_id`),
  KEY `FK_location_theme` (`theme_id`),
  FULLTEXT KEY `name` (`name`),
  CONSTRAINT `FK_location_layout` FOREIGN KEY (`layout_id`) REFERENCES `layout` (`layout_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_location_theme` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`theme_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.location: ~6 rows (approximately)
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` (`location_id`, `layout_id`, `theme_id`, `name`, `address`, `postal_code`, `main_number`, `intern_number`) VALUES
	(1, 1, 2, 'Zwolle', '', '', '', 0),
	(2, 1, 2, 'Nunspeet', '', '', '', 0),
	(3, 1, 2, 'Nieuwleusen', '', '', '', 0),
	(4, 1, 2, 'Den Haag', '', '', '', 0),
	(5, 1, 2, 'Amsterdam', '', '', '', 0),
	(6, 1, 2, 'Hoogeveen', '', '', '', 0);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;

-- Dumping structure for table dotcasting.news_article
CREATE TABLE IF NOT EXISTS `news_article` (
  `news_article_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `category_id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `display_from` datetime NOT NULL,
  `display_till` datetime NOT NULL,
  `priority` int(11) NOT NULL DEFAULT '0',
  `description` longtext,
  PRIMARY KEY (`news_article_id`),
  KEY `FK_nieuwsbericht_categorie` (`category_id`),
  KEY `FK_nieuwsbericht_bestand` (`file_id`),
  FULLTEXT KEY `title` (`title`),
  FULLTEXT KEY `description` (`description`),
  CONSTRAINT `FK_nieuwsbericht_bestand` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_nieuwsbericht_categorie` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.news_article: ~6 rows (approximately)
/*!40000 ALTER TABLE `news_article` DISABLE KEYS */;
INSERT INTO `news_article` (`news_article_id`, `title`, `category_id`, `file_id`, `date`, `display_from`, `display_till`, `priority`, `description`) VALUES
	(1, 'Test 1', 5, 2, '2017-12-08 13:53:54', '2017-10-05 13:27:29', '2117-10-05 13:27:29', 1, 'Lorem ipsum dolor sit amet, veri corpora in sea. Veri summo ea nam, et omnis habemus lucilius nec. Per ex accusam facilisi patrioque, facete feugait te vis. Pri ne sumo vulputate. Latine accusam fabellas cu mei. Cum eros consul accusamus ea, mei idque feugiat prodesset te, latine nominavi nominati ut pro. Et sint legere similique has, eum te luptatum democritum consectetuer, solet incorrupte vim at. An eum diam legimus offendit, te nec ipsum eligendi constituto. Cum ea electram sapientem adipiscing. Ea eros essent cum.'),
	(2, 'Test 2', 5, 2, '2017-12-01 13:30:33', '2017-10-05 13:27:29', '2117-12-01 13:27:31', 0, 'Lorem ipsum dolor sit amet, veri corpora in sea. Veri summo ea nam, et omnis habemus lucilius nec. Per ex accusam facilisi patrioque, facete feugait te vis. Pri ne sumo vulputate. Latine accusam fabellas cu mei. Cum eros consul accusamus ea, mei idque feugiat prodesset te, latine nominavi nominati ut pro. Et sint legere similique has, eum te luptatum democritum consectetuer, solet incorrupte vim at. An eum diam legimus offendit, te nec ipsum eligendi constituto. Cum ea electram sapientem adipiscing. Ea eros essent cum.'),
	(3, 'Test 3', 5, 3, '2017-12-06 12:00:07', '2017-10-05 13:27:29', '2117-12-01 13:27:31', 0, 'Lorem ipsum dolor sit amet, veri corpora in sea. Veri summo ea nam, et omnis habemus lucilius nec. Per ex accusam facilisi patrioque, facete feugait te vis. Pri ne sumo vulputate. Latine accusam fabellas cu mei. Cum eros consul accusamus ea, mei idque feugiat prodesset te, latine nominavi nominati ut pro. Et sint legere similique has, eum te luptatum democritum consectetuer, solet incorrupte vim at. An eum diam legimus offendit, te nec ipsum eligendi constituto. Cum ea electram sapientem adipiscing. Ea eros essent cum.'),
	(4, 'test', 1, NULL, '2017-12-06 14:19:51', '2017-12-06 00:00:00', '2017-12-22 00:00:00', 0, 'asdasd'),
	(5, 'test', 1, 5, '2017-12-06 14:20:56', '2017-12-06 00:00:00', '2017-12-22 00:00:00', 0, 'asdasd'),
	(6, 'testing', 2, 6, '2017-12-07 14:20:59', '2017-12-07 00:00:00', '2017-12-15 00:00:00', 0, '');
/*!40000 ALTER TABLE `news_article` ENABLE KEYS */;

-- Dumping structure for table dotcasting.news_article_has_location
CREATE TABLE IF NOT EXISTS `news_article_has_location` (
  `news_article_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`news_article_id`,`location_id`),
  KEY `FK_location_id` (`location_id`) USING BTREE,
  CONSTRAINT `news_article_has_location_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `news_article_has_location_ibfk_2` FOREIGN KEY (`news_article_id`) REFERENCES `news_article` (`news_article_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.news_article_has_location: ~9 rows (approximately)
/*!40000 ALTER TABLE `news_article_has_location` DISABLE KEYS */;
INSERT INTO `news_article_has_location` (`news_article_id`, `location_id`) VALUES
	(1, 1),
	(1, 2),
	(2, 1),
	(2, 3),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 5),
	(6, 6);
/*!40000 ALTER TABLE `news_article_has_location` ENABLE KEYS */;

-- Dumping structure for table dotcasting.right
CREATE TABLE IF NOT EXISTS `right` (
  `right_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` longtext,
  PRIMARY KEY (`right_id`),
  FULLTEXT KEY `name` (`name`),
  FULLTEXT KEY `description` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.right: ~3 rows (approximately)
/*!40000 ALTER TABLE `right` DISABLE KEYS */;
INSERT INTO `right` (`right_id`, `name`, `description`) VALUES
	(1, 'Aanmaken nieuwsbericht', 'Aanmaken van een nieuwsbericht'),
	(2, 'Bewerken nieuwsbericht', 'Voor het bewerken van een nieuwsbericht'),
	(3, 'Verwijderen nieuwsbericht', 'Voor het verwijderen van een nieuwsbericht');
/*!40000 ALTER TABLE `right` ENABLE KEYS */;

-- Dumping structure for table dotcasting.theme
CREATE TABLE IF NOT EXISTS `theme` (
  `theme_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `background_file` int(11) NOT NULL,
  PRIMARY KEY (`theme_id`),
  KEY `FK__bestand` (`background_file`),
  FULLTEXT KEY `name` (`name`),
  CONSTRAINT `FK__bestand` FOREIGN KEY (`background_file`) REFERENCES `file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.theme: ~1 rows (approximately)
/*!40000 ALTER TABLE `theme` DISABLE KEYS */;
INSERT INTO `theme` (`theme_id`, `name`, `background_file`) VALUES
	(2, 'test', 1);
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
  FULLTEXT KEY `email` (`email`),
  FULLTEXT KEY `first_name` (`first_name`),
  FULLTEXT KEY `last_name` (`last_name`),
  CONSTRAINT `FK_persoon_locaties` FOREIGN KEY (`location`) REFERENCES `location` (`location_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COMMENT='Alle informatie van de medewerkers maar ook admins';

-- Dumping data for table dotcasting.user: ~3 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `first_name`, `insertion`, `last_name`, `birthday`, `email`, `password`, `admin`, `location`) VALUES
	(3, 'Admin', NULL, 'admin', '1998-05-14', 'admin@dotcasting.nl', 'test', 1, 1),
	(6, 'Medewerker', NULL, 'medewerker', '1978-10-10', 'medewerker@dotcasting.nl', 'test', 0, 1),
	(8, 'Test', NULL, 'test', '2017-12-06', 'test@gmail.com', 'test', 0, 2);
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

-- Dumping data for table dotcasting.user_has_right: ~4 rows (approximately)
/*!40000 ALTER TABLE `user_has_right` DISABLE KEYS */;
INSERT INTO `user_has_right` (`user_id`, `right_id`) VALUES
	(6, 1),
	(6, 2),
	(8, 1),
	(8, 2),
	(8, 3);
/*!40000 ALTER TABLE `user_has_right` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
