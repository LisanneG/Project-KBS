-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2017 at 10:49 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dotcasting`
--

-- --------------------------------------------------------

--
-- Table structure for table `birthday`
--

CREATE TABLE `birthday` (
  `birthday_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `birthday`
--

INSERT INTO `birthday` (`birthday_id`, `user_id`, `date`, `category_id`) VALUES
(1, 3, '2017-11-27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `background_color` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `background_color`) VALUES
(1, 'Verjaardag', '#AD1919'),
(2, 'Financieel', 'grey'),
(3, 'Administratie', 'green'),
(4, 'Wereldnieuws', '#259488'),
(5, 'Evenement', '#EE9A3B');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `file_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `type` varchar(45) NOT NULL COMMENT 'afbeelding, video',
  `muted` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`file_id`, `location`, `type`, `muted`) VALUES
(1, '/KBS/Project-KBS/bestanden/media/photo/kerst.jpg', 'photo', NULL),
(4, '/KBS/Project-KBS/bestanden/media/photo/bolcom.png', 'photo', NULL),
(7, '/KBS/Project-KBS/bestanden/media/photo/4393rutte-haalt-schaamteloze-orban.jpg', 'photo', NULL),
(8, '/KBS/Project-KBS/bestanden/media/photo/0517dader-verliest-beroep-tbs-verlenging-in-zaak-meisje-van-nulde.jpg', 'photo', NULL),
(9, '/KBS/Project-KBS/bestanden/media/photo/9056kamer-verontwaardigd-nieuwe-blunder-belastingdienst.jpg', 'photo', NULL),
(10, '/KBS/Project-KBS/bestanden/media/photo/9039herdenkingsdienst-slachtoffers-brand-woontoren-londen.jpg', 'photo', NULL),
(11, '/KBS/Project-KBS/bestanden/media/video/test.mp4', 'video', 0),
(12, '/KBS/Project-KBS/bestanden/media/photo/dotsolutions.jpeg', 'photo', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `layout`
--

CREATE TABLE `layout` (
  `layout_id` int(11) NOT NULL,
  `font` varchar(45) NOT NULL,
  `font_color` varchar(45) NOT NULL,
  `background_color` varchar(45) NOT NULL,
  `default_background` int(11) NOT NULL,
  `logo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layout`
--

INSERT INTO `layout` (`layout_id`, `font`, `font_color`, `background_color`, `default_background`, `logo`) VALUES
(1, 'arial', '#FFFFFF', '#639833', 12, 4);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  `theme_id` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal_code` varchar(45) NOT NULL,
  `main_number` varchar(45) NOT NULL,
  `intern_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `layout_id`, `theme_id`, `name`, `address`, `postal_code`, `main_number`, `intern_number`) VALUES
(1, 1, 2, 'Zwolle', '', '', '', 0),
(2, 1, 2, 'Nunspeet', '', '', '', 0),
(3, 1, 2, 'Nieuwleusen', '', '', '', 0),
(4, 1, 2, 'Den Haag', '', '', '', 0),
(5, 1, 2, 'Amsterdam', '', '', '', 0),
(6, 1, 2, 'Hoogeveen', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news_article`
--

CREATE TABLE `news_article` (
  `news_article_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `display_from` datetime NOT NULL,
  `display_till` datetime NOT NULL,
  `priority` int(11) NOT NULL DEFAULT '0',
  `description` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_article`
--

INSERT INTO `news_article` (`news_article_id`, `title`, `category_id`, `file_id`, `date`, `display_from`, `display_till`, `priority`, `description`) VALUES
(7, 'Rutte haalt uit naar \'schaamteloze\' Orban', 5, 7, '2017-12-14 15:18:28', '2017-12-13 00:00:00', '2018-01-06 00:00:00', 0, 'Premier Mark Rutte heeft woensdag hard uitgehaald naar zijn Hongaarse collega Viktor Orban. Die hoopt het verplicht opnemen van asielzoekers af te kunnen kopen. \"En dan niet meer bijdragen aan de solidariteit? Een schaamteloos verhaal\", zei Rutte. \"Come on, dan zou Nederland ook kunnen zeggen: we doen niets meer.\"\r\nOrban en zijn collegaâ€™s uit Polen, TsjechiÃ« en Slowakije boden eerder op de dag 35 miljoen euro aan voor het Afrika-fonds, dat ervoor moet zorgen dat Afrikanen niet naar Europa komen. \"Prachtig\", zei Rutte, \"maar Nederland geeft ook heel veel, dat fonds gaat over de grondoorzaken van migratie.\"\r\n\r\n\"En wat ga je dan doen als er een SyriÃ«r is of EritreÃ«r die echt vlucht voor oorlog en geweld en probeert in Europa een veilig heenkomen te zoeken, en iedereen zegt: je kunt hier niet meer terecht?\'\', aldus Rutte.\r\n\r\nDe kwestie wordt donderdagavond besproken tijdens het diner. \"Het zou heftig kunnen worden\", aldus de premier. Hij erkende het recht van Orban om zich te verzetten tegen een verplicht verdelingsmechanisme. \"Maar dan zeggen de andere landen, ik verwacht vanavond een grote meerderheid, dat we dat wel willen.\"\r\n\r\nRutte benadrukte dat afspraken zoals die eerder zijn gemaakt over een tijdelijke verplichte herverdeling van asielzoekers uit ItaliÃ« en Griekenland moeten worden nagekomen. De vier landen blijven dat echter weigeren. \"Orban zal zich moeten realiseren dat dit niet een plek is waar je alleen iets haalt\'\', aldus Rutte.\r\n\r\nEen besluit over een permanent verplicht verdelingssysteem voor toekomstige vluchtelingencrises wordt overigens nog niet genomen.'),
(8, 'Dader verliest beroep tegen tbs-verlenging in', 5, 8, '2017-12-14 15:19:22', '2017-12-12 00:00:00', '2017-12-30 00:00:00', 1, 'Mike J., de veroordeelde stiefvader van het â€˜meisje van Nuldeâ€™, blijft voorlopig nog in de tbs-kliniek. Zijn beroep tegen de verlenging van zijn tbs-behandeling met twee jaar werd donderdag afgewezen.\r\nJ. (48) werd in 2003 tot twaalf jaar cel en tbs veroordeeld voor de gewelddadige dood van kleuter Rowena Rikkers in 2001. De dochter van zijn vriendin kwam door stelselmatige mishandeling om het leven en haar lichaamsdelen werden teruggevonden bij onder meer Hoek van Holland en Strand Nulde. Ook haar moeder werd veroordeeld.\r\n\r\nDe rechtbank verlengde zijn tbs-behandeling eerder dit jaar met twee jaar. Deskundigen uit de kliniek vinden verlenging van de maatregel nodig, omdat de problematiek rond de persoonlijkheid van J. nog onverminderd groot is. Ook wordt de kans op herhaling groot geacht, vooral als hij weer in een relatie met een kwetsbare vrouw belandt.\r\n\r\nHoger beroep\r\nJ. is het daar niet mee eens. Hij denkt dat hij klaar is voor een voorwaardelijke beÃ«indiging van de behandeling en ging daarom in hoger beroep bij het gerechtshof in Arnhem.\r\n\r\nEen voorwaardelijke beÃ«indiging van de behandeling vindt het hof te vroeg. Het hof gaat er ook van uit dat de behandeling van J. niet binnen een jaar is afgerond. Zijn gedrag is weliswaar stabiel maar nog onvoldoende veranderd, aldus de uitspraak.\r\n\r\nProefverlof\r\nGedurende de tbs-periode is het wel mogelijk dat J. geleidelijk oefent met proefverloven, ook met onbegeleid verlof. Naar verwachting wordt in de loop van volgend jaar verlof buiten de muren aangevraagd bij de minister van Veiligheid en Justitie.'),
(9, 'Kamer verontwaardigd over nieuwe blunder Bela', 4, 9, '2017-12-14 15:19:54', '2017-12-13 00:00:00', '2018-01-05 00:00:00', 0, 'De problemen met de systemen van de schenk- en erfbelasting bij de Belastingdienst hebben tot veel ergenis geleid bij meerdere partijen in de Tweede Kamer. De ambtelijke top wachtte lang met het delen van belangrijke informatie aan hun politieke bazen. De Kamer wil nu minutieus geÃ¯nformeerd worden.\r\n\"Ik val nu echt van mijn stoel\", zei CDA-Kamerlid Pieter Omtzigt donderdag tijdens een debat over de Belastingdienst.\r\n\r\n\"De voorganger heeft de Belastingdienst nog problematischer achtergelaten dan ik al dacht\", vulde Steven van Weyenberg (D66) aan.\r\n\r\nDe Kamer had zojuist te horen gekregen dat staatssecretaris Menno Snel (FinanciÃ«n) in oktober op de hoogte werd gesteld door zijn ambtenaren over het feit dat een nieuw systeem om de schenk- en erfbelasting te innen niet werkte. Daardoor liep de fiscus dit jaar 450 miljoen euro aan belastinginkomsten mis. Dat wordt later alsnog geÃ¯nd.\r\n\r\nHet nieuwe systeem had dit jaar in werking moeten treden, maar door technische problemen lukte dat niet. Ondertussen werd de oude inningsmethode stop gezet en trad vertraging op omdat de medewerkers handmatig aan de slag moesten gaan.\r\n\r\nAl die tijd bleef de politieke top, die verantwoordelijk is voor de Belastingdienst, in het ongewisse. Snel, pas zes weken in funcctie, liet daarom weten \"onaangenaam verrast\" te zijn.\r\n\r\n\"Dat is een slecht besluit. Ik kan niet anders zeggen\", zei de bewindsman. \"Men dacht, het komt wel goed, maar het kwam niet goed.\"'),
(10, 'Herdenkingsdienst voor slachtoffers brand woo', 4, 10, '2017-12-14 15:20:25', '2017-12-13 00:00:00', '2017-12-30 00:00:00', 0, 'In Londen is donderdagmiddag een herdenkingsdienst gehouden voor de slachtoffers van de brand in de Londense Grenfell Tower. Een half jaar geleden kwamen 71 mensen om toen de woontoren in het westen van de stad vlam vatte. \r\nDe herdenkingsdienst vond plaats in St Paul\'s Cathedral in Londen. Onder de ongeveer vijftienhonderd genodigden waren overlevenden van de brand, nabestaanden van de slachtoffers en reddingswerkers die hebben geholpen toen de brand uitbrak.\r\n\r\nOok waren diverse leden van het Britse koningshuis aanwezig, waaronder prins Charles en zijn zonen William en Harry. Ook de Briitse premier Teresa May woonde de dienst bij. ');

-- --------------------------------------------------------

--
-- Table structure for table `news_article_has_location`
--

CREATE TABLE `news_article_has_location` (
  `news_article_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_article_has_location`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `right`
--

CREATE TABLE `right` (
  `right_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `right`
--

INSERT INTO `right` (`right_id`, `name`, `description`) VALUES
(1, 'Aanmaken nieuwsbericht', 'Aanmaken van een nieuwsbericht'),
(2, 'Bewerken nieuwsbericht', 'Voor het bewerken van een nieuwsbericht'),
(3, 'Verwijderen nieuwsbericht', 'Voor het verwijderen van een nieuwsbericht'),
(4, 'Aanmaken locatie', 'Voor het aanmaken van een locatie'),
(5, 'Bewerken locatie', 'Voor het bewerken van een locatie'),
(6, 'Verwijderen locatie', 'Voor het verwijderen van een locatie'),
(7, 'Aanmaken thema', 'Voor het aanmaken van een thema'),
(8, 'Bewerken thema', 'Voor het bewerken van een thema'),
(9, 'Verwijderen thema', 'Voor het verwijderen van een thema');

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE `theme` (
  `theme_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `background_file` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`theme_id`, `name`, `background_file`) VALUES
(2, 'kerst', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `insertion` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `location` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Alle informatie van de medewerkers maar ook admins';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `insertion`, `last_name`, `birthday`, `email`, `password`, `admin`, `location`, `file_id`) VALUES
(3, 'Bob', NULL, 'Hendrik', '1998-05-14', 'admin@dotcasting.nl', 'test', 1, 1, NULL),
(6, 'Jan', 'van der', 'Hans', '1978-10-10', 'medewerker@dotcasting.nl', 'test', 0, 2, NULL),
(8, 'Test', NULL, 'test', '1978-10-10', 'test@gmail.com', 'test', 0, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_right`
--

CREATE TABLE `user_has_right` (
  `user_id` int(11) NOT NULL,
  `right_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tussentabel voor rechten en personen';

--
-- Dumping data for table `user_has_right`
--

INSERT INTO `user_has_right` (`user_id`, `right_id`) VALUES
(6, 1),
(6, 2),
(6, 5),
(6, 7),
(6, 8),
(6, 9),
(8, 1),
(8, 2),
(8, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `birthday`
--
ALTER TABLE `birthday`
  ADD PRIMARY KEY (`birthday_id`),
  ADD KEY `FK_verjaardag_persoon` (`user_id`),
  ADD KEY `FK_verjaardag_categorie` (`category_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);
ALTER TABLE `category` ADD FULLTEXT KEY `name` (`name`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `layout`
--
ALTER TABLE `layout`
  ADD PRIMARY KEY (`layout_id`),
  ADD KEY `FK_layout_file` (`default_background`),
  ADD KEY `FK_layout_file_2` (`logo`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `FK_location_layout` (`layout_id`),
  ADD KEY `FK_location_theme` (`theme_id`);
ALTER TABLE `location` ADD FULLTEXT KEY `name` (`name`);

--
-- Indexes for table `news_article`
--
ALTER TABLE `news_article`
  ADD PRIMARY KEY (`news_article_id`),
  ADD KEY `FK_nieuwsbericht_categorie` (`category_id`),
  ADD KEY `FK_nieuwsbericht_bestand` (`file_id`);
ALTER TABLE `news_article` ADD FULLTEXT KEY `title` (`title`);
ALTER TABLE `news_article` ADD FULLTEXT KEY `description` (`description`);

--
-- Indexes for table `news_article_has_location`
--
ALTER TABLE `news_article_has_location`
  ADD PRIMARY KEY (`news_article_id`,`location_id`),
  ADD KEY `FK_location_id` (`location_id`) USING BTREE;

--
-- Indexes for table `right`
--
ALTER TABLE `right`
  ADD PRIMARY KEY (`right_id`);
ALTER TABLE `right` ADD FULLTEXT KEY `name` (`name`);
ALTER TABLE `right` ADD FULLTEXT KEY `description` (`description`);

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`theme_id`),
  ADD KEY `FK__bestand` (`background_file`);
ALTER TABLE `theme` ADD FULLTEXT KEY `name` (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `FK_persoon_locaties` (`location`),
  ADD KEY `FK_user_file` (`file_id`);
ALTER TABLE `user` ADD FULLTEXT KEY `email` (`email`);
ALTER TABLE `user` ADD FULLTEXT KEY `first_name` (`first_name`);
ALTER TABLE `user` ADD FULLTEXT KEY `last_name` (`last_name`);

--
-- Indexes for table `user_has_right`
--
ALTER TABLE `user_has_right`
  ADD PRIMARY KEY (`user_id`,`right_id`),
  ADD KEY `FK_persoon_has_recht_recht` (`right_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `birthday`
--
ALTER TABLE `birthday`
  MODIFY `birthday_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `layout`
--
ALTER TABLE `layout`
  MODIFY `layout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news_article`
--
ALTER TABLE `news_article`
  MODIFY `news_article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `right`
--
ALTER TABLE `right`
  MODIFY `right_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `theme`
--
ALTER TABLE `theme`
  MODIFY `theme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `birthday`
--
ALTER TABLE `birthday`
  ADD CONSTRAINT `FK_verjaardag_categorie` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_verjaardag_persoon` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `layout`
--
ALTER TABLE `layout`
  ADD CONSTRAINT `FK_layout_file` FOREIGN KEY (`default_background`) REFERENCES `file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_layout_file_2` FOREIGN KEY (`logo`) REFERENCES `file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `FK_location_layout` FOREIGN KEY (`layout_id`) REFERENCES `layout` (`layout_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_location_theme` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`theme_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `news_article`
--
ALTER TABLE `news_article`
  ADD CONSTRAINT `FK_nieuwsbericht_bestand` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_nieuwsbericht_categorie` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `news_article_has_location`
--
ALTER TABLE `news_article_has_location`
  ADD CONSTRAINT `news_article_has_location_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `news_article_has_location_ibfk_2` FOREIGN KEY (`news_article_id`) REFERENCES `news_article` (`news_article_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `theme`
--
ALTER TABLE `theme`
  ADD CONSTRAINT `FK__bestand` FOREIGN KEY (`background_file`) REFERENCES `file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_persoon_locaties` FOREIGN KEY (`location`) REFERENCES `location` (`location_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_user_file` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_has_right`
--
ALTER TABLE `user_has_right`
  ADD CONSTRAINT `FK__persoon` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_persoon_has_recht_recht` FOREIGN KEY (`right_id`) REFERENCES `right` (`right_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
