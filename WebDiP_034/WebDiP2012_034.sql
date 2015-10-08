-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 31, 2013 at 01:40 PM
-- Server version: 5.0.51
-- PHP Version: 5.3.3-7+squeeze15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `WebDiP2012_034`
--

-- --------------------------------------------------------

--
-- Table structure for table `direktorij`
--

CREATE TABLE IF NOT EXISTS `direktorij` (
  `id` int(11) NOT NULL auto_increment,
  `kategorija` int(11) NOT NULL,
  `naziv` varchar(45) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_direktorij_kategorija1_idx` (`kategorija`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `direktorij`
--

INSERT INTO `direktorij` (`id`, `kategorija`, `naziv`) VALUES
(1, 1, 'transferi'),
(2, 1, 'RK CO Zagreb'),
(3, 5, 'html5'),
(4, 4, 'c#'),
(5, 3, 'kavice'),
(6, 1, 'trofeji'),
(7, 3, 'chillanje'),
(8, 5, 'budućnost'),
(9, 4, 'paradigme'),
(10, 2, 'rekreativnost');

-- --------------------------------------------------------

--
-- Table structure for table `direktorij_dokumenta`
--

CREATE TABLE IF NOT EXISTS `direktorij_dokumenta` (
  `dokument` int(11) NOT NULL,
  `direktorij` int(11) NOT NULL,
  PRIMARY KEY  (`dokument`,`direktorij`),
  KEY `fk_dokument_has_direktorij_direktorij1_idx` (`direktorij`),
  KEY `fk_dokument_has_direktorij_dokument1_idx` (`dokument`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `direktorij_dokumenta`
--

INSERT INTO `direktorij_dokumenta` (`dokument`, `direktorij`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(4, 2),
(5, 2),
(7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `dokument`
--

CREATE TABLE IF NOT EXISTS `dokument` (
  `id` int(11) NOT NULL auto_increment,
  `slika` int(11) NOT NULL,
  `ekstenzija` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_dokument_slika1_idx` (`slika`),
  KEY `fk_dokument_ekstenzija1_idx` (`ekstenzija`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `dokument`
--

INSERT INTO `dokument` (`id`, `slika`, `ekstenzija`) VALUES
(1, 1, 8),
(2, 1, 8),
(3, 1, 8),
(4, 1, 8),
(5, 1, 8),
(6, 1, 8),
(7, 1, 8),
(8, 1, 8),
(9, 1, 8),
(10, 1, 8),
(11, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `ekstenzija`
--

CREATE TABLE IF NOT EXISTS `ekstenzija` (
  `id` int(11) NOT NULL auto_increment,
  `naziv` varchar(45) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `ekstenzija`
--

INSERT INTO `ekstenzija` (`id`, `naziv`) VALUES
(1, '.jpeg'),
(2, '.png'),
(3, '.html'),
(4, '.css'),
(5, '.docx'),
(6, '.mp3'),
(7, '.mp4'),
(8, '.txt'),
(9, '.pdf'),
(10, '.exe');

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE IF NOT EXISTS `kategorija` (
  `id` int(11) NOT NULL auto_increment,
  `naziv` varchar(45) collate utf8_unicode_ci NOT NULL,
  `slika` int(11) NOT NULL,
  `voditelj` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_kategorija_slika1_idx` (`slika`),
  KEY `fk_kategorija_korisnik1_idx` (`voditelj`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`id`, `naziv`, `slika`, `voditelj`) VALUES
(1, 'rukomet', 5, 6),
(2, 'sport', 3, 7),
(3, 'uživanje', 9, 5),
(4, 'programiranje', 7, 3),
(5, 'web', 8, 3),
(6, 'obrazovanje', 5, 3),
(7, 'aktivnosti', 5, 3),
(8, 'svijet', 5, 3),
(9, 'glazba', 5, 3),
(10, 'filmovi', 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int(11) NOT NULL auto_increment,
  `tekst` varchar(45) collate utf8_unicode_ci NOT NULL,
  `vrijeme` datetime NOT NULL,
  `korisnik` int(11) NOT NULL,
  `verzija_dokumenta` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_komentar_korisnik1_idx` (`korisnik`),
  KEY `fk_komentar_verzija_dokumenta1_idx` (`verzija_dokumenta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `tekst`, `vrijeme`, `korisnik`, `verzija_dokumenta`) VALUES
(1, 'hvala!', '2013-05-28 14:56:50', 14, 3),
(2, 'korisno je bilo..', '2013-05-28 14:57:03', 6, 3),
(3, 'interesantno, koja ti je najdraža?', '2013-05-28 14:57:21', 4, 6),
(4, 'pa...mislim da machiato:)', '2013-05-28 14:58:04', 7, 6),
(5, 'današnja liga uefa..eh to bi bilo lijepo..', '2013-05-28 14:58:44', 15, 4),
(6, 'čestitke!!', '2013-05-28 14:58:34', 2, 5),
(7, 'Dinamo! BBB', '2013-05-28 14:59:11', 21, 5),
(8, ':)', '2013-05-28 14:59:41', 15, 7),
(9, 'fora:)', '2013-05-28 15:00:08', 14, 7),
(10, 'ovo je lijepo..', '2013-05-28 15:00:31', 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
  `id` int(11) NOT NULL auto_increment,
  `korime` varchar(45) collate utf8_unicode_ci NOT NULL,
  `lozinka` varchar(45) collate utf8_unicode_ci NOT NULL,
  `ime` varchar(45) collate utf8_unicode_ci NOT NULL,
  `prezime` varchar(45) collate utf8_unicode_ci NOT NULL,
  `email` varchar(45) collate utf8_unicode_ci NOT NULL,
  `prava` int(11) NOT NULL,
  `tip` int(11) NOT NULL,
  `nopomena` int(11) NOT NULL,
  `nprijava` int(11) NOT NULL,
  `grad` varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_korisnik_tip_korisnika_idx` (`tip`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `korime`, `lozinka`, `ime`, `prezime`, `email`, `prava`, `tip`, `nopomena`, `nprijava`, `grad`) VALUES
(1, 'nogometas2', 'nogoLoL123', 'Luka', 'Modrić', 'modric@gmail.com', 1, 1, 0, 0, ''),
(2, 'nogometas13', 'football12M', 'Ivica', 'Olić', 'iolic@net.hr', 1, 1, 0, 0, ''),
(3, 'rukometas9', 'novaloza', 'Matija', 'Knežević', 'mknezevi1@foi.hr', 1, 3, 0, 0, 'Karlovac'),
(4, 'Sunny', 'MloolZ145', 'Mirko', 'Horvat', 'sunny@gmail.com', 1, 2, 0, 0, ''),
(5, 'shestheone', 'lozinka1', 'Ivana', 'Ninčević', 'plavusa123@net.hr', 0, 2, 0, 3, ''),
(6, 'handball123', 'lijevivanjski', 'Tonči', 'Valčić', 'tvalcic@gmail.com', 1, 2, 0, 0, ''),
(7, 'amisura', 'loza123!', 'Antonija', 'Mišura', 'amisura1@net.hr', 1, 2, 0, 0, ''),
(8, 'dinamo4ever', 'dinamo', 'Domagoj', 'Vida', 'dvida@gmail.com', 1, 1, 0, 0, ''),
(9, 'lijevo_krilo', 'sprint123', 'Manuel', 'Štrlek', 'mstrlek@gmail.com', 1, 1, 0, 0, ''),
(10, 'tenisac123', 'servis123', 'Goran', 'Ivanišević', 'goranivanisevic@foi.hr', 1, 1, 0, 0, ''),
(11, 'ante95', 'oluja95', 'Ante', 'Gotovina', 'antegotovina@foi.hr', 1, 1, 0, 0, ''),
(12, 'zpervan', 'sasasasa', 'Željko', 'Pervan', 'zpervan@foi.hr', 1, 1, 0, 0, ''),
(13, 'kjurcic_dinamo', 'dinamo', 'Krunoslav', 'Jurčić', 'kjurcic@foi.hr', 1, 1, 0, 0, ''),
(14, 'josip123', '123456', 'Josip', 'Šimunić', 'jozo123@foi.hr', 1, 1, 0, 0, ''),
(15, 'skivica', 'skijanje', 'Ivica', 'Kostelić', 'ivek@foi.hr', 1, 1, 0, 0, ''),
(16, 'ivanisevic', 'KZy0Z7xh', 'Goran', 'Ivanišević', 'goran@foi.hr', 1, 1, 2, 0, 'Split'),
(17, 'megan_', 'movies', 'Megan', 'Fox', 'meganfox@foi.hr', 1, 1, 0, 0, ''),
(18, 'miro123', 'Karlovac123', 'Miroslav', 'Knežević', 'miro123@karlovac.hr', 1, 1, 0, 0, 'Karlovac'),
(19, 'mkovacic', 'dinamo123', 'Mateo', 'Kovačić', 'mateo_bbb@foi.hr', 1, 1, 0, 0, 'Zagreb'),
(20, 'webdip', 'webdip', 'webdip', 'webdip', 'webdip@webdip', 1, 1, 0, 0, ''),
(21, 'admin', 'admin', 'admin', 'admin', 'admin@admin', 1, 3, 0, 0, ''),
(22, 'mjurisi', 'mjurisic', 'Markos', 'Jurisic', 'mjurisic@foi.hr', 1, 2, 0, 0, ''),
(23, 'mandžo', 'ligaprvaka', 'Mario', 'Mandžukić', 'mario.bayern@foi.hr', 1, 1, 0, 0, 'Vinkovci'),
(24, 'ivana.m', '0109992', 'Ivana', 'Mance', 'ivana.mance0109@gmail.com', 1, 1, 0, 1, 'Karlovac');

-- --------------------------------------------------------

--
-- Table structure for table `ocjena`
--

CREATE TABLE IF NOT EXISTS `ocjena` (
  `id` int(11) NOT NULL auto_increment,
  `vrijednost` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `ocjena`
--

INSERT INTO `ocjena` (`id`, `vrijednost`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `ocjena_dokumenta`
--

CREATE TABLE IF NOT EXISTS `ocjena_dokumenta` (
  `korisnik` int(11) NOT NULL,
  `verzija_dokumenta` int(11) NOT NULL,
  `ocjena` int(11) NOT NULL,
  PRIMARY KEY  (`korisnik`,`verzija_dokumenta`),
  KEY `fk_korisnik_has_verzija_dokumenta_verzija_dokumenta1_idx` (`verzija_dokumenta`),
  KEY `fk_korisnik_has_verzija_dokumenta_korisnik1_idx` (`korisnik`),
  KEY `fk_ocjena_dokumenta_ocjena1_idx` (`ocjena`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocjena_dokumenta`
--

INSERT INTO `ocjena_dokumenta` (`korisnik`, `verzija_dokumenta`, `ocjena`) VALUES
(13, 6, 4),
(5, 3, 5),
(4, 4, 6),
(6, 3, 7),
(7, 9, 7),
(4, 8, 8),
(7, 3, 9),
(16, 6, 10),
(17, 8, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pristup_dokumentu`
--

CREATE TABLE IF NOT EXISTS `pristup_dokumentu` (
  `korisnik` int(11) NOT NULL,
  `dokument` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY  (`korisnik`,`dokument`),
  KEY `fk_pristup_dokumentu_korisnik1_idx` (`korisnik`),
  KEY `fk_pristup_dokumentu_dokument1_idx` (`dokument`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pristup_dokumentu`
--

INSERT INTO `pristup_dokumentu` (`korisnik`, `dokument`, `status`) VALUES
(3, 4, 1),
(4, 7, 1),
(5, 5, 1),
(6, 7, 1),
(7, 4, 1),
(14, 7, 1),
(15, 7, 1),
(16, 4, 1),
(17, 2, 1),
(18, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pristup_kategoriji`
--

CREATE TABLE IF NOT EXISTS `pristup_kategoriji` (
  `korisnik` int(11) NOT NULL,
  `kategorija` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY  (`korisnik`,`kategorija`),
  KEY `fk_pristup_kategoriji_korisnik1_idx` (`korisnik`),
  KEY `fk_pristup_kategoriji_kategorija1_idx` (`kategorija`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pristup_kategoriji`
--

INSERT INTO `pristup_kategoriji` (`korisnik`, `kategorija`, `status`) VALUES
(1, 2, 1),
(2, 5, 1),
(3, 4, 1),
(4, 6, 1),
(5, 4, 1),
(6, 6, 1),
(7, 1, 1),
(7, 4, 0),
(8, 2, 1),
(9, 10, 1),
(10, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slika`
--

CREATE TABLE IF NOT EXISTS `slika` (
  `id` int(11) NOT NULL auto_increment,
  `naziv` varchar(45) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `slika`
--

INSERT INTO `slika` (`id`, `naziv`) VALUES
(1, 'more'),
(2, 'skijanje'),
(3, 'surfanje'),
(4, 'nogomet'),
(5, 'rukomet'),
(6, 'fakultet'),
(7, 'programiranje'),
(8, 'web'),
(9, 'sunce'),
(10, 'pomoc');

-- --------------------------------------------------------

--
-- Table structure for table `tip_korisnika`
--

CREATE TABLE IF NOT EXISTS `tip_korisnika` (
  `id` int(11) NOT NULL auto_increment,
  `naziv` varchar(45) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tip_korisnika`
--

INSERT INTO `tip_korisnika` (`id`, `naziv`) VALUES
(1, 'registrirani korisnik'),
(2, 'voditelj kategorije'),
(3, 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `verzija_dokumenta`
--

CREATE TABLE IF NOT EXISTS `verzija_dokumenta` (
  `id` int(11) NOT NULL auto_increment,
  `dokument` int(11) NOT NULL,
  `naziv` varchar(45) collate utf8_unicode_ci NOT NULL,
  `autor` int(11) NOT NULL,
  `komentiranje` tinyint(1) NOT NULL,
  `vrijeme` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_verzija_dokumenta_dokument1_idx` (`dokument`),
  KEY `fk_verzija_dokumenta_korisnik1_idx` (`autor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `verzija_dokumenta`
--

INSERT INTO `verzija_dokumenta` (`id`, `dokument`, `naziv`, `autor`, `komentiranje`, `vrijeme`) VALUES
(1, 1, 'Pozdrav', 21, 0, '2013-05-28 13:58:29'),
(2, 2, 'pgql', 3, 0, '2013-05-28 14:11:13'),
(3, 2, 'pgql_v2', 3, 0, '2013-05-28 14:11:56'),
(4, 3, 'dinamovi trofeji', 13, 0, '2013-05-28 14:25:19'),
(5, 3, 'dinamovi trofeji_v2', 13, 0, '2013-05-28 14:25:43'),
(6, 4, 'kava', 7, 0, '2013-05-28 14:27:35'),
(7, 5, 'timer', 3, 0, '2013-05-28 14:31:49'),
(8, 6, 'Otvori oči', 4, 0, '2013-05-28 14:33:58'),
(9, 4, 'kava_v2', 7, 0, '2013-05-28 14:37:08'),
(10, 7, 'cocktail', 17, 0, '2013-05-28 14:39:51'),
(11, 8, 'dinamo_k_monteno', 3, 0, '2013-05-29 09:36:24'),
(12, 9, 'tradicije i običaji Lopara', 18, 0, '2013-05-29 09:39:10'),
(13, 10, 'vicevi', 21, 0, '2013-05-29 09:47:23'),
(14, 11, 'Samojed', 24, 0, '2013-05-30 19:25:03');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `direktorij`
--
ALTER TABLE `direktorij`
  ADD CONSTRAINT `fk_direktorij_kategorija1` FOREIGN KEY (`kategorija`) REFERENCES `kategorija` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `direktorij_dokumenta`
--
ALTER TABLE `direktorij_dokumenta`
  ADD CONSTRAINT `fk_dokument_has_direktorij_direktorij1` FOREIGN KEY (`direktorij`) REFERENCES `direktorij` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dokument_has_direktorij_dokument1` FOREIGN KEY (`dokument`) REFERENCES `dokument` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dokument`
--
ALTER TABLE `dokument`
  ADD CONSTRAINT `fk_dokument_ekstenzija1` FOREIGN KEY (`ekstenzija`) REFERENCES `ekstenzija` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dokument_slika1` FOREIGN KEY (`slika`) REFERENCES `slika` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD CONSTRAINT `fk_kategorija_korisnik1` FOREIGN KEY (`voditelj`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kategorija_slika1` FOREIGN KEY (`slika`) REFERENCES `slika` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `fk_komentar_korisnik1` FOREIGN KEY (`korisnik`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_komentar_verzija_dokumenta1` FOREIGN KEY (`verzija_dokumenta`) REFERENCES `verzija_dokumenta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `fk_korisnik_tip_korisnika` FOREIGN KEY (`tip`) REFERENCES `tip_korisnika` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ocjena_dokumenta`
--
ALTER TABLE `ocjena_dokumenta`
  ADD CONSTRAINT `fk_korisnik_has_verzija_dokumenta_korisnik1` FOREIGN KEY (`korisnik`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_korisnik_has_verzija_dokumenta_verzija_dokumenta1` FOREIGN KEY (`verzija_dokumenta`) REFERENCES `verzija_dokumenta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ocjena_dokumenta_ocjena1` FOREIGN KEY (`ocjena`) REFERENCES `ocjena` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pristup_dokumentu`
--
ALTER TABLE `pristup_dokumentu`
  ADD CONSTRAINT `fk_pristup_dokumentu_dokument1` FOREIGN KEY (`dokument`) REFERENCES `dokument` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pristup_dokumentu_korisnik1` FOREIGN KEY (`korisnik`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pristup_kategoriji`
--
ALTER TABLE `pristup_kategoriji`
  ADD CONSTRAINT `fk_pristup_kategoriji_kategorija1` FOREIGN KEY (`kategorija`) REFERENCES `kategorija` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pristup_kategoriji_korisnik1` FOREIGN KEY (`korisnik`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `verzija_dokumenta`
--
ALTER TABLE `verzija_dokumenta`
  ADD CONSTRAINT `fk_verzija_dokumenta_dokument1` FOREIGN KEY (`dokument`) REFERENCES `dokument` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_verzija_dokumenta_korisnik1` FOREIGN KEY (`autor`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
