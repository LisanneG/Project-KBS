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
  PRIMARY KEY (`category_id`)
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
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.file: ~0 rows (approximately)
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` (`file_id`, `location`, `type`) VALUES
	(1, '\\img\\kerst.png', 'afbeelding'),
	(2, '\\img\\test.jpg', 'afbeelding');
/*!40000 ALTER TABLE `file` ENABLE KEYS */;

-- Dumping structure for table dotcasting.layout
CREATE TABLE IF NOT EXISTS `layout` (
  `layout_id` int(11) NOT NULL AUTO_INCREMENT,
  `font` varchar(45) NOT NULL,
  `font_color` varchar(45) NOT NULL,
  `default_background` int(11) NOT NULL,
  `logo` int(11) NOT NULL,
  PRIMARY KEY (`layout_id`),
  KEY `FK_layout_file` (`default_background`),
  KEY `FK_layout_file_2` (`logo`),
  CONSTRAINT `FK_layout_file` FOREIGN KEY (`default_background`) REFERENCES `file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_layout_file_2` FOREIGN KEY (`logo`) REFERENCES `file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.layout: ~1 rows (approximately)
/*!40000 ALTER TABLE `layout` DISABLE KEYS */;
INSERT INTO `layout` (`layout_id`, `font`, `font_color`, `default_background`, `logo`) VALUES
	(1, 'arial', '#00000', 1, 1);
/*!40000 ALTER TABLE `layout` ENABLE KEYS */;

-- Dumping structure for table dotcasting.location
CREATE TABLE IF NOT EXISTS `location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal_code` varchar(45) NOT NULL,
  `main_number` varchar(45) NOT NULL,
  `intern_number` int(11) NOT NULL,
  PRIMARY KEY (`location_id`),
  KEY `FK_location_layout` (`layout_id`),
  CONSTRAINT `FK_location_layout` FOREIGN KEY (`layout_id`) REFERENCES `layout` (`layout_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.location: ~6 rows (approximately)
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` (`location_id`, `layout_id`, `name`, `address`, `postal_code`, `main_number`, `intern_number`) VALUES
	(1, 1, 'Zwolle', '', '', '', 0),
	(2, 1, 'Nunspeet', '', '', '', 0),
	(3, 1, 'Nieuwleusen', '', '', '', 0),
	(4, 1, 'Den Haag', '', '', '', 0),
	(5, 1, 'Amsterdam', '', '', '', 0),
	(6, 1, 'Hoogeveen', '', '', '', 0);
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
  CONSTRAINT `FK_nieuwsbericht_bestand` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_nieuwsbericht_categorie` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.news_article: ~3 rows (approximately)
/*!40000 ALTER TABLE `news_article` DISABLE KEYS */;
INSERT INTO `news_article` (`news_article_id`, `title`, `category_id`, `file_id`, `date`, `display_from`, `display_till`, `priority`, `description`) VALUES
	(1, 'Test 1', 5, 2, '2017-12-01 13:30:31', '2017-10-05 13:27:29', '2117-12-01 13:27:31', 0, 'Lorem ipsum dolor sit amet, veri corpora in sea. Veri summo ea nam, et omnis habemus lucilius nec. Per ex accusam facilisi patrioque, facete feugait te vis. Pri ne sumo vulputate. Latine accusam fabellas cu mei. Cum eros consul accusamus ea, mei idque feugiat prodesset te, latine nominavi nominati ut pro. Et sint legere similique has, eum te luptatum democritum consectetuer, solet incorrupte vim at. An eum diam legimus offendit, te nec ipsum eligendi constituto. Cum ea electram sapientem adipiscing. Ea eros essent cum.'),
	(2, 'Test 2', 5, 2, '2017-12-01 13:30:33', '2017-10-05 13:27:29', '2117-12-01 13:27:31', 0, 'Lorem ipsum dolor sit amet, veri corpora in sea. Veri summo ea nam, et omnis habemus lucilius nec. Per ex accusam facilisi patrioque, facete feugait te vis. Pri ne sumo vulputate. Latine accusam fabellas cu mei. Cum eros consul accusamus ea, mei idque feugiat prodesset te, latine nominavi nominati ut pro. Et sint legere similique has, eum te luptatum democritum consectetuer, solet incorrupte vim at. An eum diam legimus offendit, te nec ipsum eligendi constituto. Cum ea electram sapientem adipiscing. Ea eros essent cum.'),
	(3, 'Test 3', 5, 2, '2017-12-01 13:30:34', '2017-10-05 13:27:29', '2117-12-01 13:27:31', 0, 'Lorem ipsum dolor sit amet, veri corpora in sea. Veri summo ea nam, et omnis habemus lucilius nec. Per ex accusam facilisi patrioque, facete feugait te vis. Pri ne sumo vulputate. Latine accusam fabellas cu mei. Cum eros consul accusamus ea, mei idque feugiat prodesset te, latine nominavi nominati ut pro. Et sint legere similique has, eum te luptatum democritum consectetuer, solet incorrupte vim at. An eum diam legimus offendit, te nec ipsum eligendi constituto. Cum ea electram sapientem adipiscing. Ea eros essent cum.');
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

-- Dumping data for table dotcasting.news_article_has_location: ~0 rows (approximately)
/*!40000 ALTER TABLE `news_article_has_location` DISABLE KEYS */;
INSERT INTO `news_article_has_location` (`news_article_id`, `location_id`) VALUES
	(1, 1),
	(1, 2),
	(2, 1),
	(2, 3),
	(3, 1);
/*!40000 ALTER TABLE `news_article_has_location` ENABLE KEYS */;

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

-- Dumping structure for table dotcasting.theme
CREATE TABLE IF NOT EXISTS `theme` (
  `theme_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `background_file` int(11) NOT NULL,
  PRIMARY KEY (`theme_id`),
  KEY `FK__bestand` (`background_file`),
  CONSTRAINT `FK__bestand` FOREIGN KEY (`background_file`) REFERENCES `file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.theme: ~0 rows (approximately)
/*!40000 ALTER TABLE `theme` DISABLE KEYS */;
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
