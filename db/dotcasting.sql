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

-- Dumping structure for table dotcasting.bestand
CREATE TABLE IF NOT EXISTS `bestand` (
  `bestand_id` int(11) NOT NULL AUTO_INCREMENT,
  `locatie` varchar(255) NOT NULL,
  `type` varchar(45) NOT NULL COMMENT 'afbeelding, video',
  PRIMARY KEY (`bestand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.bestand: ~0 rows (approximately)
/*!40000 ALTER TABLE `bestand` DISABLE KEYS */;
INSERT INTO `bestand` (`bestand_id`, `locatie`, `type`) VALUES
	(1, '\\img\\kerst.png', 'afbeelding');
/*!40000 ALTER TABLE `bestand` ENABLE KEYS */;

-- Dumping structure for table dotcasting.categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `categorie_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) NOT NULL,
  `kleur` varchar(45) NOT NULL,
  PRIMARY KEY (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.categorie: ~1 rows (approximately)
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`categorie_id`, `naam`, `kleur`) VALUES
	(1, 'Test', '#AD1919');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;

-- Dumping structure for table dotcasting.layout
CREATE TABLE IF NOT EXISTS `layout` (
  `layout_id` int(11) NOT NULL AUTO_INCREMENT,
  `lettertype` varchar(45) NOT NULL,
  `kleur` varchar(45) NOT NULL,
  `lettergrootte` varchar(45) NOT NULL,
  `standaard_achtergrond` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`layout_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.layout: ~1 rows (approximately)
/*!40000 ALTER TABLE `layout` DISABLE KEYS */;
INSERT INTO `layout` (`layout_id`, `lettertype`, `kleur`, `lettergrootte`, `standaard_achtergrond`) VALUES
	(1, 'arial', '#000000', '15', NULL);
/*!40000 ALTER TABLE `layout` ENABLE KEYS */;

-- Dumping structure for table dotcasting.locatie
CREATE TABLE IF NOT EXISTS `locatie` (
  `locatie_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) NOT NULL,
  PRIMARY KEY (`locatie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.locatie: ~0 rows (approximately)
/*!40000 ALTER TABLE `locatie` DISABLE KEYS */;
INSERT INTO `locatie` (`locatie_id`, `naam`) VALUES
	(1, 'Zwolle');
/*!40000 ALTER TABLE `locatie` ENABLE KEYS */;

-- Dumping structure for table dotcasting.nieuwsbericht
CREATE TABLE IF NOT EXISTS `nieuwsbericht` (
  `nieuwsbericht_id` int(11) NOT NULL AUTO_INCREMENT,
  `titel` varchar(45) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `bestand_id` int(11) DEFAULT NULL,
  `datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `locatie_id` int(11) NOT NULL,
  `weergave_van` datetime NOT NULL,
  `weergave_tot` datetime NOT NULL,
  `prioriteit` int(11) NOT NULL DEFAULT '0',
  `beschrijving` longtext,
  PRIMARY KEY (`nieuwsbericht_id`),
  KEY `FK_nieuwsbericht_categorie` (`categorie_id`),
  KEY `FK_nieuwsbericht_bestand` (`bestand_id`),
  KEY `FK_nieuwsbericht_locaties` (`locatie_id`),
  CONSTRAINT `FK_nieuwsbericht_bestand` FOREIGN KEY (`bestand_id`) REFERENCES `bestand` (`bestand_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_nieuwsbericht_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`categorie_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_nieuwsbericht_locaties` FOREIGN KEY (`locatie_id`) REFERENCES `locatie` (`locatie_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.nieuwsbericht: ~0 rows (approximately)
/*!40000 ALTER TABLE `nieuwsbericht` DISABLE KEYS */;
/*!40000 ALTER TABLE `nieuwsbericht` ENABLE KEYS */;

-- Dumping structure for table dotcasting.persoon
CREATE TABLE IF NOT EXISTS `persoon` (
  `persoon_id` int(11) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(255) NOT NULL,
  `tussenvoegsel` varchar(255) DEFAULT NULL,
  `achternaam` varchar(255) NOT NULL,
  `geboortedatum` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `locatie` int(11) NOT NULL,
  PRIMARY KEY (`persoon_id`),
  KEY `FK_persoon_locaties` (`locatie`),
  CONSTRAINT `FK_persoon_locaties` FOREIGN KEY (`locatie`) REFERENCES `locatie` (`locatie_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='Alle informatie van de medewerkers maar ook admins';

-- Dumping data for table dotcasting.persoon: ~2 rows (approximately)
/*!40000 ALTER TABLE `persoon` DISABLE KEYS */;
INSERT INTO `persoon` (`persoon_id`, `voornaam`, `tussenvoegsel`, `achternaam`, `geboortedatum`, `email`, `wachtwoord`, `admin`, `locatie`) VALUES
	(3, 'Admin', NULL, 'admin', '1998-05-14', 'admin@dotcasting.nl', 'test', 1, 1),
	(6, 'Medewerker', NULL, 'medewerker', '1978-10-10', 'medewerker@dotcasting.nl', 'test', 0, 1);
/*!40000 ALTER TABLE `persoon` ENABLE KEYS */;

-- Dumping structure for table dotcasting.persoon_has_recht
CREATE TABLE IF NOT EXISTS `persoon_has_recht` (
  `persoon_id` int(11) NOT NULL,
  `recht_id` int(11) NOT NULL,
  PRIMARY KEY (`persoon_id`,`recht_id`),
  KEY `FK_persoon_has_recht_recht` (`recht_id`),
  CONSTRAINT `FK__persoon` FOREIGN KEY (`persoon_id`) REFERENCES `persoon` (`persoon_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_persoon_has_recht_recht` FOREIGN KEY (`recht_id`) REFERENCES `recht` (`recht_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tussentabel voor rechten en personen';

-- Dumping data for table dotcasting.persoon_has_recht: ~0 rows (approximately)
/*!40000 ALTER TABLE `persoon_has_recht` DISABLE KEYS */;
INSERT INTO `persoon_has_recht` (`persoon_id`, `recht_id`) VALUES
	(6, 1);
/*!40000 ALTER TABLE `persoon_has_recht` ENABLE KEYS */;

-- Dumping structure for table dotcasting.recht
CREATE TABLE IF NOT EXISTS `recht` (
  `recht_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(255) NOT NULL,
  `beschrijving` longtext,
  PRIMARY KEY (`recht_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.recht: ~1 rows (approximately)
/*!40000 ALTER TABLE `recht` DISABLE KEYS */;
INSERT INTO `recht` (`recht_id`, `naam`, `beschrijving`) VALUES
	(1, 'Aanmaken nieuwsbericht', 'Aanmaken van een nieuwsbericht');
/*!40000 ALTER TABLE `recht` ENABLE KEYS */;

-- Dumping structure for table dotcasting.scherm
CREATE TABLE IF NOT EXISTS `scherm` (
  `scherm_id` int(11) NOT NULL AUTO_INCREMENT,
  `locatie_id` int(11) NOT NULL,
  `orientatie` varchar(45) NOT NULL,
  `thema_id` int(11) NOT NULL,
  PRIMARY KEY (`scherm_id`),
  KEY `FK__locaties` (`locatie_id`),
  KEY `FK__thema` (`thema_id`),
  CONSTRAINT `FK__locaties` FOREIGN KEY (`locatie_id`) REFERENCES `locatie` (`locatie_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK__thema` FOREIGN KEY (`thema_id`) REFERENCES `thema` (`thema_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.scherm: ~0 rows (approximately)
/*!40000 ALTER TABLE `scherm` DISABLE KEYS */;
INSERT INTO `scherm` (`scherm_id`, `locatie_id`, `orientatie`, `thema_id`) VALUES
	(2, 1, 'verticaal', 1);
/*!40000 ALTER TABLE `scherm` ENABLE KEYS */;

-- Dumping structure for table dotcasting.thema
CREATE TABLE IF NOT EXISTS `thema` (
  `thema_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) NOT NULL,
  `bestand_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`thema_id`),
  KEY `FK__bestand` (`bestand_id`),
  KEY `FK_thema_layout` (`layout_id`),
  CONSTRAINT `FK__bestand` FOREIGN KEY (`bestand_id`) REFERENCES `bestand` (`bestand_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_thema_layout` FOREIGN KEY (`layout_id`) REFERENCES `layout` (`layout_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.thema: ~0 rows (approximately)
/*!40000 ALTER TABLE `thema` DISABLE KEYS */;
INSERT INTO `thema` (`thema_id`, `naam`, `bestand_id`, `layout_id`) VALUES
	(1, 'Kerst', 1, 1);
/*!40000 ALTER TABLE `thema` ENABLE KEYS */;

-- Dumping structure for table dotcasting.verjaardag
CREATE TABLE IF NOT EXISTS `verjaardag` (
  `verjaardag_id` int(11) NOT NULL AUTO_INCREMENT,
  `persoon_id` int(11) NOT NULL,
  `datum` date DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `bestand_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`verjaardag_id`),
  KEY `FK_verjaardag_persoon` (`persoon_id`),
  KEY `FK_verjaardag_categorie` (`categorie_id`),
  KEY `FK_verjaardag_bestand` (`bestand_id`),
  CONSTRAINT `FK_verjaardag_bestand` FOREIGN KEY (`bestand_id`) REFERENCES `bestand` (`bestand_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_verjaardag_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`categorie_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_verjaardag_persoon` FOREIGN KEY (`persoon_id`) REFERENCES `persoon` (`persoon_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.verjaardag: ~0 rows (approximately)
/*!40000 ALTER TABLE `verjaardag` DISABLE KEYS */;
INSERT INTO `verjaardag` (`verjaardag_id`, `persoon_id`, `datum`, `categorie_id`, `bestand_id`) VALUES
	(1, 3, '2017-11-27', 1, NULL);
/*!40000 ALTER TABLE `verjaardag` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
