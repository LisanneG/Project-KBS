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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.file: ~6 rows (approximately)
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` (`file_id`, `location`, `type`, `muted`) VALUES
	(1, '../bestanden/media/foto/kerst.jpg', 'foto', 0),
	(4, '../bestanden/media/foto/bolcom.png', 'foto', 0),
	(7, '/KBS/Project-KBS/bestanden/media/foto/4393rutte-haalt-schaamteloze-orban.jpg', 'foto', 0),
	(8, '/KBS/Project-KBS/bestanden/media/foto/0517dader-verliest-beroep-tbs-verlenging-in-zaak-meisje-van-nulde.jpg', 'foto', 0),
	(9, '/KBS/Project-KBS/bestanden/media/foto/9056kamer-verontwaardigd-nieuwe-blunder-belastingdienst.jpg', 'foto', 0),
	(10, '/KBS/Project-KBS/bestanden/media/foto/9039herdenkingsdienst-slachtoffers-brand-woontoren-londen.jpg', 'foto', 0);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table dotcasting.news_article: ~4 rows (approximately)
/*!40000 ALTER TABLE `news_article` DISABLE KEYS */;
INSERT INTO `news_article` (`news_article_id`, `title`, `category_id`, `file_id`, `date`, `display_from`, `display_till`, `priority`, `description`) VALUES
	(7, 'Rutte haalt uit naar \'schaamteloze\' Orban', 5, 7, '2017-12-14 15:18:28', '2017-12-13 00:00:00', '2018-01-06 00:00:00', 0, 'Premier Mark Rutte heeft woensdag hard uitgehaald naar zijn Hongaarse collega Viktor Orban. Die hoopt het verplicht opnemen van asielzoekers af te kunnen kopen. "En dan niet meer bijdragen aan de solidariteit? Een schaamteloos verhaal", zei Rutte. "Come on, dan zou Nederland ook kunnen zeggen: we doen niets meer."\r\nOrban en zijn collegaâ€™s uit Polen, TsjechiÃ« en Slowakije boden eerder op de dag 35 miljoen euro aan voor het Afrika-fonds, dat ervoor moet zorgen dat Afrikanen niet naar Europa komen. "Prachtig", zei Rutte, "maar Nederland geeft ook heel veel, dat fonds gaat over de grondoorzaken van migratie."\r\n\r\n"En wat ga je dan doen als er een SyriÃ«r is of EritreÃ«r die echt vlucht voor oorlog en geweld en probeert in Europa een veilig heenkomen te zoeken, en iedereen zegt: je kunt hier niet meer terecht?\'\', aldus Rutte.\r\n\r\nDe kwestie wordt donderdagavond besproken tijdens het diner. "Het zou heftig kunnen worden", aldus de premier. Hij erkende het recht van Orban om zich te verzetten tegen een verplicht verdelingsmechanisme. "Maar dan zeggen de andere landen, ik verwacht vanavond een grote meerderheid, dat we dat wel willen."\r\n\r\nRutte benadrukte dat afspraken zoals die eerder zijn gemaakt over een tijdelijke verplichte herverdeling van asielzoekers uit ItaliÃ« en Griekenland moeten worden nagekomen. De vier landen blijven dat echter weigeren. "Orban zal zich moeten realiseren dat dit niet een plek is waar je alleen iets haalt\'\', aldus Rutte.\r\n\r\nEen besluit over een permanent verplicht verdelingssysteem voor toekomstige vluchtelingencrises wordt overigens nog niet genomen.'),
	(8, 'Dader verliest beroep tegen tbs-verlenging in', 5, 8, '2017-12-14 15:19:22', '2017-12-12 00:00:00', '2017-12-30 00:00:00', 1, 'Mike J., de veroordeelde stiefvader van het â€˜meisje van Nuldeâ€™, blijft voorlopig nog in de tbs-kliniek. Zijn beroep tegen de verlenging van zijn tbs-behandeling met twee jaar werd donderdag afgewezen.\r\nJ. (48) werd in 2003 tot twaalf jaar cel en tbs veroordeeld voor de gewelddadige dood van kleuter Rowena Rikkers in 2001. De dochter van zijn vriendin kwam door stelselmatige mishandeling om het leven en haar lichaamsdelen werden teruggevonden bij onder meer Hoek van Holland en Strand Nulde. Ook haar moeder werd veroordeeld.\r\n\r\nDe rechtbank verlengde zijn tbs-behandeling eerder dit jaar met twee jaar. Deskundigen uit de kliniek vinden verlenging van de maatregel nodig, omdat de problematiek rond de persoonlijkheid van J. nog onverminderd groot is. Ook wordt de kans op herhaling groot geacht, vooral als hij weer in een relatie met een kwetsbare vrouw belandt.\r\n\r\nHoger beroep\r\nJ. is het daar niet mee eens. Hij denkt dat hij klaar is voor een voorwaardelijke beÃ«indiging van de behandeling en ging daarom in hoger beroep bij het gerechtshof in Arnhem.\r\n\r\nEen voorwaardelijke beÃ«indiging van de behandeling vindt het hof te vroeg. Het hof gaat er ook van uit dat de behandeling van J. niet binnen een jaar is afgerond. Zijn gedrag is weliswaar stabiel maar nog onvoldoende veranderd, aldus de uitspraak.\r\n\r\nProefverlof\r\nGedurende de tbs-periode is het wel mogelijk dat J. geleidelijk oefent met proefverloven, ook met onbegeleid verlof. Naar verwachting wordt in de loop van volgend jaar verlof buiten de muren aangevraagd bij de minister van Veiligheid en Justitie.'),
	(9, 'Kamer verontwaardigd over nieuwe blunder Bela', 4, 9, '2017-12-14 15:19:54', '2017-12-13 00:00:00', '2018-01-05 00:00:00', 0, 'De problemen met de systemen van de schenk- en erfbelasting bij de Belastingdienst hebben tot veel ergenis geleid bij meerdere partijen in de Tweede Kamer. De ambtelijke top wachtte lang met het delen van belangrijke informatie aan hun politieke bazen. De Kamer wil nu minutieus geÃ¯nformeerd worden.\r\n"Ik val nu echt van mijn stoel", zei CDA-Kamerlid Pieter Omtzigt donderdag tijdens een debat over de Belastingdienst.\r\n\r\n"De voorganger heeft de Belastingdienst nog problematischer achtergelaten dan ik al dacht", vulde Steven van Weyenberg (D66) aan.\r\n\r\nDe Kamer had zojuist te horen gekregen dat staatssecretaris Menno Snel (FinanciÃ«n) in oktober op de hoogte werd gesteld door zijn ambtenaren over het feit dat een nieuw systeem om de schenk- en erfbelasting te innen niet werkte. Daardoor liep de fiscus dit jaar 450 miljoen euro aan belastinginkomsten mis. Dat wordt later alsnog geÃ¯nd.\r\n\r\nHet nieuwe systeem had dit jaar in werking moeten treden, maar door technische problemen lukte dat niet. Ondertussen werd de oude inningsmethode stop gezet en trad vertraging op omdat de medewerkers handmatig aan de slag moesten gaan.\r\n\r\nAl die tijd bleef de politieke top, die verantwoordelijk is voor de Belastingdienst, in het ongewisse. Snel, pas zes weken in funcctie, liet daarom weten "onaangenaam verrast" te zijn.\r\n\r\n"Dat is een slecht besluit. Ik kan niet anders zeggen", zei de bewindsman. "Men dacht, het komt wel goed, maar het kwam niet goed."'),
	(10, 'Herdenkingsdienst voor slachtoffers brand woo', 4, 10, '2017-12-14 15:20:25', '2017-12-13 00:00:00', '2017-12-30 00:00:00', 0, 'In Londen is donderdagmiddag een herdenkingsdienst gehouden voor de slachtoffers van de brand in de Londense Grenfell Tower. Een half jaar geleden kwamen 71 mensen om toen de woontoren in het westen van de stad vlam vatte. \r\nDe herdenkingsdienst vond plaats in St Paul\'s Cathedral in Londen. Onder de ongeveer vijftienhonderd genodigden waren overlevenden van de brand, nabestaanden van de slachtoffers en reddingswerkers die hebben geholpen toen de brand uitbrak.\r\n\r\nOok waren diverse leden van het Britse koningshuis aanwezig, waaronder prins Charles en zijn zonen William en Harry. Ook de Briitse premier Teresa May woonde de dienst bij. ');
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
	(7, 1),
	(8, 1),
	(8, 2),
	(8, 5),
	(9, 1),
	(9, 2),
	(9, 3),
	(10, 1),
	(10, 2),
	(10, 3);
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
	(3, 'Admin', NULL, 'admin', '1998-05-14', 'admin@dotcasting.nl', 'test', 1, 1, NULL),
	(6, 'Medewerker', NULL, 'medewerker', '1978-10-10', 'medewerker@dotcasting.nl', 'test', 0, 1, NULL),
	(8, 'Test', NULL, 'test', '2017-12-06', 'test@gmail.com', 'test', 0, 2, NULL);
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
