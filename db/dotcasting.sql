-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2017 at 08:55 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

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
  `category_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `birthday`
--

INSERT INTO `birthday` (`birthday_id`, `user_id`, `date`, `category_id`, `file_id`) VALUES
(1, 3, '2017-11-27', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `color`) VALUES
(1, 'Test', '#AD1919'),
(2, 'Financieel', 'grey'),
(3, 'Administratie', 'green'),
(4, 'Wereldnieuws', 'blue'),
(5, 'Evenement', 'orange');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `file_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `type` varchar(45) NOT NULL COMMENT 'afbeelding, video'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`file_id`, `location`, `type`) VALUES
(1, '\\img\\kerst.png', 'afbeelding');

-- --------------------------------------------------------

--
-- Table structure for table `layout`
--

CREATE TABLE `layout` (
  `layout_id` int(11) NOT NULL,
  `font` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL,
  `font_size` varchar(45) NOT NULL,
  `default_background` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layout`
--

INSERT INTO `layout` (`layout_id`, `font`, `color`, `font_size`, `default_background`) VALUES
(1, 'arial', '#000000', '15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal_code` varchar(45) NOT NULL,
  `main_number` varchar(45) NOT NULL,
  `intern_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `name`, `address`, `postal_code`, `main_number`, `intern_number`) VALUES
(1, 'Zwolle', '', '', '', 0),
(2, 'Nunspeet', '', '', '', 0),
(3, 'Nieuwleusen', '', '', '', 0),
(4, 'Den Haag', '', '', '', 0),
(5, 'Amsterdam', '', '', '', 0),
(6, 'Hoogeveen', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news_article`
--

CREATE TABLE `news_article` (
  `news_article_id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `category_id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `location_id` int(11) NOT NULL,
  `display_from` datetime NOT NULL,
  `display_till` datetime NOT NULL,
  `priority` int(11) NOT NULL DEFAULT '0',
  `description` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `news_article_has_location`
--

CREATE TABLE `news_article_has_location` (
  `news_article_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Aanmaken nieuwsbericht', 'Aanmaken van een nieuwsbericht');

-- --------------------------------------------------------

--
-- Table structure for table `screen`
--

CREATE TABLE `screen` (
  `screen_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `orientation` varchar(45) NOT NULL,
  `theme_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `screen`
--

INSERT INTO `screen` (`screen_id`, `location_id`, `orientation`, `theme_id`) VALUES
(2, 1, 'verticaal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE `theme` (
  `theme_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `file_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`theme_id`, `name`, `file_id`, `layout_id`) VALUES
(1, 'Kerst', 1, 1);

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
  `location` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Alle informatie van de medewerkers maar ook admins';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `insertion`, `last_name`, `birthday`, `email`, `password`, `admin`, `location`) VALUES
(3, 'Admin', NULL, 'admin', '1998-05-14', 'admin@dotcasting.nl', 'test', 1, 1),
(6, 'Medewerker', NULL, 'medewerker', '1978-10-10', 'medewerker@dotcasting.nl', 'test', 0, 1);

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
(6, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `birthday`
--
ALTER TABLE `birthday`
  ADD PRIMARY KEY (`birthday_id`),
  ADD KEY `FK_verjaardag_persoon` (`user_id`),
  ADD KEY `FK_verjaardag_categorie` (`category_id`),
  ADD KEY `FK_verjaardag_bestand` (`file_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `layout`
--
ALTER TABLE `layout`
  ADD PRIMARY KEY (`layout_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `news_article`
--
ALTER TABLE `news_article`
  ADD PRIMARY KEY (`news_article_id`),
  ADD KEY `FK_nieuwsbericht_categorie` (`category_id`),
  ADD KEY `FK_nieuwsbericht_bestand` (`file_id`),
  ADD KEY `FK_nieuwsbericht_locaties` (`location_id`);

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

--
-- Indexes for table `screen`
--
ALTER TABLE `screen`
  ADD PRIMARY KEY (`screen_id`),
  ADD KEY `FK__locaties` (`location_id`),
  ADD KEY `FK__thema` (`theme_id`);

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`theme_id`),
  ADD KEY `FK__bestand` (`file_id`),
  ADD KEY `FK_thema_layout` (`layout_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `FK_persoon_locaties` (`location`);

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
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `news_article_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `right`
--
ALTER TABLE `right`
  MODIFY `right_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `screen`
--
ALTER TABLE `screen`
  MODIFY `screen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `theme`
--
ALTER TABLE `theme`
  MODIFY `theme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `birthday`
--
ALTER TABLE `birthday`
  ADD CONSTRAINT `FK_verjaardag_bestand` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_verjaardag_categorie` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_verjaardag_persoon` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `news_article`
--
ALTER TABLE `news_article`
  ADD CONSTRAINT `FK_nieuwsbericht_bestand` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_nieuwsbericht_categorie` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_nieuwsbericht_locaties` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `news_article_has_location`
--
ALTER TABLE `news_article_has_location`
  ADD CONSTRAINT `news_article_has_location_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `news_article_has_location_ibfk_2` FOREIGN KEY (`news_article_id`) REFERENCES `news_article` (`news_article_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `screen`
--
ALTER TABLE `screen`
  ADD CONSTRAINT `FK__locaties` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK__thema` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`theme_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `theme`
--
ALTER TABLE `theme`
  ADD CONSTRAINT `FK__bestand` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_thema_layout` FOREIGN KEY (`layout_id`) REFERENCES `layout` (`layout_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_persoon_locaties` FOREIGN KEY (`location`) REFERENCES `location` (`location_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_has_right`
--
ALTER TABLE `user_has_right`
  ADD CONSTRAINT `FK__persoon` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_persoon_has_recht_recht` FOREIGN KEY (`right_id`) REFERENCES `right` (`right_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
