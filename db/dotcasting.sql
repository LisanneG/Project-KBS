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
  PRIMARY KEY (`birthday_id`),
  KEY `FK_verjaardag_persoon` (`user_id`),
  KEY `FK_verjaardag_categorie` (`category_id`),
  CONSTRAINT `FK_verjaardag_categorie` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_verjaardag_persoon` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.birthday: ~1 rows (approximately)
/*!40000 ALTER TABLE `birthday` DISABLE KEYS */;
INSERT INTO `birthday` (`birthday_id`, `user_id`, `date`, `category_id`) VALUES
	(3, 3, '2017-12-22', 1);
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
	(1, 'Verjaardag', '#AD1919'),
	(2, 'Financieel', 'grey'),
	(3, 'Administratie', 'green'),
	(4, 'Wereldnieuws', '#259488'),
	(5, 'Evenement', '#EE9A3B');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping structure for table dotcasting.file
CREATE TABLE IF NOT EXISTS `file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(255) NOT NULL,
  `type` varchar(45) NOT NULL COMMENT 'afbeelding, video',
  `muted` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.file: ~15 rows (approximately)
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` (`file_id`, `location`, `type`, `muted`) VALUES
	(4, '/KBS/Project-KBS/bestanden/media/photo/bolcom.png', 'photo', NULL),
	(11, '/KBS/Project-KBS/bestanden/media/video/test.mp4', 'video', 0),
	(12, '/KBS/Project-KBS/bestanden/media/photo/dotsolutions.jpg', 'photo', NULL),
	(17, '/KBS/Project-KBS/bestanden/media/photo/0588ERD(versie1).png', 'photo', NULL),
	(19, '/KBS/Project-KBS/bestanden/media/photo/1390bob.jpg', 'photo', NULL),
	(26, '/KBS/Project-KBS/bestanden/media/photo/3495bob.jpg', 'photo', NULL),
	(27, '/KBS/Project-KBS/bestanden/media/photo/6460bob.jpg', 'photo', NULL),
	(28, '/KBS/Project-KBS/bestanden/media/photo/6917test.jpg', 'photo', NULL),
	(31, '/KBS/Project-KBS/bestanden/media/photo/7534test.jpg', 'photo', NULL),
	(33, '/KBS/Project-KBS/bestanden/media/photo/4133bob.jpg', 'photo', NULL),
	(36, '/KBS/Project-KBS/bestanden/media/photo/6158bolcom.png', 'photo', NULL),
	(37, '/KBS/Project-KBS/bestanden/media/photo/3040dotsolutions.jpg', 'photo', NULL),
	(38, '/KBS/Project-KBS/bestanden/media/photo/3484bg.png', 'photo', NULL),
	(39, '/KBS/Project-KBS/bestanden/media/photo/2015jumbo.png', 'photo', NULL),
	(40, '/KBS/Project-KBS/bestanden/media/photo/1082apple-krijgt-8-miljoen-dollar-compensatie-in-rechtszaak-monster.jpg', 'photo', NULL),
	(41, '/KBS/Project-KBS/bestanden/media/photo/4299youtube-gaat-verticale-videos-correct-tonen-smartphones.jpg', 'photo', NULL),
	(42, '/KBS/Project-KBS/bestanden/media/photo/5142google-topman-eric-schmidt-doet-stap-terug-moederbedrijf.jpg', 'photo', NULL),
	(43, '/KBS/Project-KBS/bestanden/media/video/bolcomvid.mp4', 'video', 0),
	(44, '/KBS/Project-KBS/bestanden/media/photo/6210kerstbg.jpg', 'photo', NULL),
	(45, '/KBS/Project-KBS/bestanden/media/photo/4664apple-werkt-geavanceerdere-hartmonitor-apple-watch.jpg', 'photo', NULL),
	(46, '/KBS/Project-KBS/bestanden/media/photo/0441instagram-laat-gebruikers-live-videos-delen-via-priveberichten.jpg', 'photo', NULL),
	(47, '/KBS/Project-KBS/bestanden/media/photo/1142google-topman-eric-schmidt-doet-stap-terug-moederbedrijf.jpg', 'photo', NULL),
	(48, '/KBS/Project-KBS/bestanden/media/photo/4456hackers-probeerden-790000-euro-stelen-van-russische-bank.jpg', 'photo', NULL),
	(49, '/KBS/Project-KBS/bestanden/media/photo/5178bob.jpg', 'photo', NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.layout: ~1 rows (approximately)
/*!40000 ALTER TABLE `layout` DISABLE KEYS */;
INSERT INTO `layout` (`layout_id`, `font`, `font_color`, `background_color`, `default_background`, `logo`) VALUES
	(1, 'arial', '#FFFFFF', '#5d7b41', 37, 36),
	(2, 'calibri', '#000000', '#809a74', 38, 39);
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
	(5, 2, NULL, 'Amsterdam', '', '', '', 0),
	(6, 1, 2, 'Hoogeveen', '', '', '', 0);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;

-- Dumping structure for table dotcasting.news_article
CREATE TABLE IF NOT EXISTS `news_article` (
  `news_article_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.news_article: ~5 rows (approximately)
/*!40000 ALTER TABLE `news_article` DISABLE KEYS */;
INSERT INTO `news_article` (`news_article_id`, `title`, `category_id`, `file_id`, `date`, `display_from`, `display_till`, `priority`, `description`) VALUES
	(12, 'Apple krijgt 8 miljoen dollar compensatie in rechtszaak tegen Monster', 5, 40, '2017-12-22 11:43:22', '2017-12-14 00:00:00', '2017-12-29 00:00:00', 0, 'De Amerikaanse audiofabrikant Monster moet 7,9 miljoen dollar aan Apple betalen. De iPhone-maker krijgt de compensatie voor de rechtszaak tussen Beats en Monster uit 2015.\r\nDat heeft een jury in de zaak bepaald, aldus Law360.\r\n\r\nBeats kreeg in 2016 al gelijk van de rechter in de zaak tegen Monster. Het bedrijf startte daarna een nieuwe zaak om de kosten voor de rechtszaak te verhalen.'),
	(13, 'YouTube gaat verticale videoâ€™s correct tonen op smartphones', 5, 41, '2017-12-22 11:44:22', '2017-12-09 00:00:00', '2017-12-30 00:00:00', 0, 'Videodienst YouTube speelt verticale videoâ€™s voortaan in volledig scherm af op smartphones, mits het toestel ook in portretmodus wordt vastgehouden.\r\nMet de update worden er niet langer zwarte balken rond verticale videoâ€™s getoond, aldus YouTube. Dat was lange tijd wel het geval, omdat de app enkel was geoptimaliseerd voor horizontale videoformaten.'),
	(14, 'Bol.com heeft een nieuwe video geupload', 5, 43, '2017-12-22 11:49:10', '2017-12-15 00:00:00', '2017-12-30 00:00:00', 0, ''),
	(15, 'Google-topman Eric Schmidt doet stap terug uit moederbedrijf', 5, 42, '2017-12-22 11:47:00', '2017-12-14 00:00:00', '2017-12-28 00:00:00', 0, 'Eric Schmidt verlaat in januari zijn positie als bestuursvoorzitter bij Google-moederbedrijf Alphabet.\r\nDat zegt Schmidt in een verklaring. Alphabet verwacht dat de raad van bestuur een nieuwe voorzitter zonder een managementpositie binnen het bedrijf zal selecteren.'),
	(16, 'Apple werkt aan geavanceerdere hartmonitor voor Apple Watch', 4, 45, '2017-12-22 12:02:08', '2017-12-15 00:00:00', '2017-12-29 00:00:00', 0, 'Apple zou aan een geavanceerdere hartmonitor voor de toekomstige versies van zijn Apple Watch werken. Het gaat om een ECG-monitor, die kan helpen bij het ontdekken van hartritmestoornissen.'),
	(17, 'Instagram laat gebruikers live video&#039;s delen via privÃ©berichten', 5, 46, '2017-12-22 12:02:36', '2017-12-15 00:00:00', '2017-12-29 00:00:00', 1, 'Instagram laat gebruikers voortaan live video&#039;s delen met vrienden via privÃ©berichten. \r\nDat heeft Instagram donderdag bekendgemaakt in een blogbericht.\r\n\r\nBinnen een live video staat nu een icoon voor privÃ©berichten. Door daar op te klikken, kunnen gebruikers de video doorsturen naar een contact of naar een groep mensen. Dit kan zowel met live video&#039;s van de gebruiker zelf als met die van anderen.'),
	(18, 'Google moet gebruiker meer duidelijkheid geven over bewaren zoekgegevens', 2, 47, '2017-12-22 12:03:05', '2017-12-08 00:00:00', '2017-12-30 00:00:00', 0, 'Google heeft ten onrechte de suggestie gewekt dat gebruikers de mogelijkheid hebben om het bewaren van zoekgegevens uit te schakelen. \r\nDat oordeel heeft het College van Beroep van de Reclame Code Commissie geveld in een zaak die was aangespannen door advocaat Otto Volgenant. Hij ergerde zich er naar eigen zeggen aan dat Google &#039;&#039;beloftes doet over privacy die ze vervolgens niet waarmaakt&#039;&#039;.'),
	(19, 'Hackers probeerden 790.000 euro te stelen van Russische bank', 4, 48, '2017-12-22 12:03:31', '2017-12-15 00:00:00', '2017-12-30 00:00:00', 0, 'Hackers hebben vorige week geprobeerd 55 miljoen roebels (790.000 euro) te stelen van de Russische staatsbank Globex, via het banksysteem SWIFT.\r\nDat stellen ingewijden tegenover de Russische krant Kommersant, meldt Reuters donderdag. Het SWIFT-systeem wordt gebruikt voor internationale transacties tussen banken.');
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

-- Dumping data for table dotcasting.news_article_has_location: ~8 rows (approximately)
/*!40000 ALTER TABLE `news_article_has_location` DISABLE KEYS */;
INSERT INTO `news_article_has_location` (`news_article_id`, `location_id`) VALUES
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 5),
	(17, 5),
	(18, 5),
	(19, 5);
/*!40000 ALTER TABLE `news_article_has_location` ENABLE KEYS */;

-- Dumping structure for table dotcasting.right
CREATE TABLE IF NOT EXISTS `right` (
  `right_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` longtext,
  PRIMARY KEY (`right_id`),
  FULLTEXT KEY `name` (`name`),
  FULLTEXT KEY `description` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.right: ~11 rows (approximately)
/*!40000 ALTER TABLE `right` DISABLE KEYS */;
INSERT INTO `right` (`right_id`, `name`, `description`) VALUES
	(1, 'Aanmaken nieuwsbericht', 'Aanmaken van een nieuwsbericht'),
	(2, 'Bewerken nieuwsbericht', 'Voor het bewerken van een nieuwsbericht'),
	(3, 'Verwijderen nieuwsbericht', 'Voor het verwijderen van een nieuwsbericht'),
	(4, 'Aanmaken locatie', 'Voor het aanmaken van een locatie'),
	(5, 'Bewerken locatie', 'Voor het bewerken van een locatie'),
	(6, 'Verwijderen locatie', 'Voor het verwijderen van een locatie'),
	(7, 'Aanmaken thema', 'Voor het aanmaken van een thema'),
	(8, 'Bewerken thema', 'Voor het bewerken van een thema'),
	(9, 'Verwijderen thema', 'Voor het verwijderen van een thema'),
	(10, 'Aanmaken opmaak', 'Voor het aanmaken van een opmaak'),
	(11, 'Bewerken opmaak', 'Voor het bewerken van een opmaak'),
	(12, 'Verwijderen opmaak', 'Voor het verwijderen van een opmaak');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.theme: ~1 rows (approximately)
/*!40000 ALTER TABLE `theme` DISABLE KEYS */;
INSERT INTO `theme` (`theme_id`, `name`, `background_file`) VALUES
	(2, 'kerst', 44);
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
  `file_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `FK_persoon_locaties` (`location`),
  KEY `FK_user_file` (`file_id`),
  FULLTEXT KEY `email` (`email`),
  FULLTEXT KEY `first_name` (`first_name`),
  FULLTEXT KEY `last_name` (`last_name`),
  CONSTRAINT `FK_persoon_locaties` FOREIGN KEY (`location`) REFERENCES `location` (`location_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_user_file` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COMMENT='Alle informatie van de medewerkers maar ook admins';

-- Dumping data for table dotcasting.user: ~3 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `first_name`, `insertion`, `last_name`, `birthday`, `email`, `password`, `admin`, `location`, `file_id`) VALUES
	(3, 'Bob', NULL, 'Hendrik', '1998-12-22', 'admin@dotcasting.nl', '$2y$10$2s6UHgHTRw29brfVBnyM5eZc8piAkjJk/wcnue3aEGoBAvgxNJmvi', 1, 1, 49),
	(6, 'Jan', 'van der', 'Hans', '1978-10-10', 'medewerker@dotcasting.nl', '$2y$10$MTIvUZjhz2P0Vna4qbnpJ.ntAcDYT.Ocqh.v.hwMCK54KasnPt2dO', 0, 5, NULL);
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

-- Dumping data for table dotcasting.user_has_right: ~7 rows (approximately)
/*!40000 ALTER TABLE `user_has_right` DISABLE KEYS */;
INSERT INTO `user_has_right` (`user_id`, `right_id`) VALUES
	(6, 1),
	(6, 2),
	(6, 3),
	(6, 4),
	(6, 5),
	(6, 6),
	(6, 7),
	(6, 8),
	(6, 9),
	(6, 10),
	(6, 11),
	(6, 12);
/*!40000 ALTER TABLE `user_has_right` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;