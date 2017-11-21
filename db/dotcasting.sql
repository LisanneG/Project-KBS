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

-- Dumping structure for table dotcasting.persoon
CREATE TABLE IF NOT EXISTS `persoon` (
  `persoon_id` int(11) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(255) NOT NULL,
  `tussenvoegsel` varchar(255) DEFAULT NULL,
  `achternaam` varchar(255) NOT NULL,
  `geboortedatum` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT '0',
  `locatie` int(11) DEFAULT NULL,
  PRIMARY KEY (`persoon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='Alle informatie van de medewerkers maar ook admins';

-- Dumping data for table dotcasting.persoon: ~0 rows (approximately)
/*!40000 ALTER TABLE `persoon` DISABLE KEYS */;
INSERT INTO `persoon` (`persoon_id`, `voornaam`, `tussenvoegsel`, `achternaam`, `geboortedatum`, `email`, `wachtwoord`, `admin`, `locatie`) VALUES
	(1, 'Lisanne', NULL, 'Gerrits', '1998-05-14', 'lisannegerrits@gmail.com', 'test', 1, NULL),
	(2, 'Test', NULL, 'Test', '1998-04-25', 'test@gmail.com', '', 0, NULL);
/*!40000 ALTER TABLE `persoon` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
