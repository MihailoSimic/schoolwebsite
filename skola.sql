-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 18, 2024 at 11:26 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skola`
--

-- --------------------------------------------------------

--
-- Table structure for table `admini`
--

DROP TABLE IF EXISTS `admini`;
CREATE TABLE IF NOT EXISTS `admini` (
  `username` varchar(20) COLLATE utf8mb3_bin NOT NULL,
  `password` varchar(20) COLLATE utf8mb3_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Dumping data for table `admini`
--

INSERT INTO `admini` (`username`, `password`) VALUES
('olga123', 'olga123');

-- --------------------------------------------------------

--
-- Table structure for table `casovi`
--

DROP TABLE IF EXISTS `casovi`;
CREATE TABLE IF NOT EXISTS `casovi` (
  `idC` int NOT NULL AUTO_INCREMENT,
  `naziv` varchar(20) COLLATE utf8mb3_bin NOT NULL,
  `nastavnik` varchar(20) COLLATE utf8mb3_bin NOT NULL,
  `ucenik` varchar(20) COLLATE utf8mb3_bin NOT NULL,
  `pocetak` datetime NOT NULL,
  `kraj` datetime NOT NULL,
  `porukaucenik` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `porukanastavnik` varchar(200) COLLATE utf8mb3_bin NOT NULL,
  `prihvacen` int NOT NULL,
  `odrzan` int NOT NULL,
  `link` varchar(200) COLLATE utf8mb3_bin NOT NULL,
  `ocenaucenik` int NOT NULL,
  `ocenanastavnik` int NOT NULL,
  `komentarucenik` varchar(200) COLLATE utf8mb3_bin NOT NULL,
  `komentarnastavnik` varchar(200) COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`idC`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Dumping data for table `casovi`
--

INSERT INTO `casovi` (`idC`, `naziv`, `nastavnik`, `ucenik`, `pocetak`, `kraj`, `porukaucenik`, `porukanastavnik`, `prihvacen`, `odrzan`, `link`, `ocenaucenik`, `ocenanastavnik`, `komentarucenik`, `komentarnastavnik`) VALUES
(10, 'Matematika', 'Sonja', 'dovla', '2024-02-13 12:00:00', '2024-02-13 13:00:00', ' Cas matematike', '', 1, 1, 'link2', 5, 4, 'Super nastavnica', 'Sve je znao'),
(11, 'Informatika', 'Zoki', 'dovla', '2024-01-21 16:00:00', '2024-01-21 17:00:00', 'Priprema za ispit', '', 1, 1, 'link3', 3, 0, '', 'Nije pratio na casu'),
(12, 'Informatika', 'Zoki', 'dovla', '2024-02-15 13:00:00', '2024-02-15 15:00:00', ' Dvocas iz C++', '', 1, 1, 'link1', 5, 5, 'Omiljeni nastavnik', 'Odlicno savladao gradivo'),
(13, 'Matematika', 'Zoki', 'dovla', '2024-02-20 10:00:00', '2024-02-20 11:00:00', ' Vektorski proizvod', 'Nemam vremena', -1, 1, '', 3, 0, '', 'Ponovo ne pratis'),
(14, 'Matematika', 'Zoki', 'tijana', '2024-02-20 11:00:00', '2024-02-20 12:00:00', ' Sabiranje i oduzimanje', '', 1, 0, 'link', 0, 0, '', ''),
(15, 'Informatika', 'Zoki', 'tijana', '2024-01-26 16:00:00', '2024-01-26 18:00:00', ' For i while petlje', '', 1, 1, 'link', 2, 0, '', 'Moramo odrzati jos jedan cas'),
(16, 'Matematika', 'Zoki', 'dovla', '2024-02-21 16:00:00', '2024-02-21 17:00:00', ' Analiza s algebrom', '', 1, 0, 'link72', 0, 0, '', ''),
(17, 'Matematika', 'Zoki', 'dovla', '2024-01-12 10:00:00', '2024-01-12 11:00:00', ' ', '', 1, 1, 'link3', 3, 0, '', 'Dobar'),
(18, 'Matematika', 'Zoki', 'mixa14', '2024-01-21 10:00:00', '2024-01-21 11:00:00', ' ', '', 1, 1, 'link44', 5, 0, '', 'Sve si znao'),
(20, 'Matematika', 'Zoki', 'mixa14', '2024-02-19 10:00:00', '2024-02-19 11:00:00', ' ', '', 1, 0, 'link33', 0, 0, '', ''),
(21, 'Matematika', 'Sonja', 'Oscar', '2024-01-28 10:00:00', '2024-01-28 11:00:00', ' ', '', 1, 1, 'link21', 0, 0, '', ''),
(22, 'Matematika', 'Sonja', 'Oscar', '2024-01-29 14:00:00', '2024-01-29 16:00:00', ' ', '', 1, 1, 'link41', 0, 0, '', ''),
(23, 'Matematika', 'Sonja', 'Oscar', '2024-02-19 11:00:00', '2024-02-19 13:00:00', ' ', '', 1, 0, 'link45', 0, 0, '', ''),
(27, 'Matematika', 'sandokan', 'Oscar', '2024-02-19 12:00:00', '2024-02-19 14:00:00', ' Priprema za kontrolni', '', 0, 0, '', 0, 0, '', ''),
(26, 'Matematika', 'sandokan', 'Oscar', '2024-02-21 10:00:00', '2024-02-21 11:00:00', ' ', '', 0, 0, '', 0, 0, '', ''),
(28, 'Srpski_jezik', 'marija', 'siske', '2024-02-20 10:00:00', '2024-02-20 12:00:00', ' Gramatika', 'Nemam vremena', -1, 0, '', 0, 0, '', ''),
(29, 'Nemacki_jezik', 'marija', 'siske', '2024-02-22 13:00:00', '2024-02-22 15:00:00', ' ', '', 0, 0, '', 0, 0, '', ''),
(30, 'Engleski_jezik', 'marija', 'siske', '2024-02-19 13:00:00', '2024-02-19 14:00:00', ' ', '', 0, 0, '', 0, 0, '', ''),
(31, 'Matematika', 'Zoki', 'siske', '2024-02-19 16:00:00', '2024-02-19 17:00:00', ' C#', '', 1, 0, 'Link122', 0, 0, '', ''),
(32, 'Informatika', 'Zoki', 'tijana', '2024-02-22 14:00:00', '2024-02-22 16:00:00', ' ', '', 1, 0, 'acd', 0, 0, '', ''),
(33, 'Informatika', 'Zoki', 'tijana', '2024-01-24 17:00:00', '2024-01-24 18:00:00', ' ', '', 1, 1, 'ccc', 0, 0, '', ''),
(34, 'Matematika', 'Zoki', 'tijana', '2024-02-23 12:00:00', '2024-02-23 13:00:00', ' ', '', 1, 0, 'zoom', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `nastavnici`
--

DROP TABLE IF EXISTS `nastavnici`;
CREATE TABLE IF NOT EXISTS `nastavnici` (
  `username` varchar(20) COLLATE utf8mb3_bin NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `ime` varchar(20) COLLATE utf8mb3_bin NOT NULL,
  `prezime` varchar(20) COLLATE utf8mb3_bin NOT NULL,
  `pol` varchar(20) COLLATE utf8mb3_bin NOT NULL,
  `telefon` varchar(20) COLLATE utf8mb3_bin NOT NULL,
  `mejl` varchar(30) COLLATE utf8mb3_bin NOT NULL,
  `razred` varchar(5) COLLATE utf8mb3_bin NOT NULL,
  `potvrdjen` tinyint(1) NOT NULL,
  `odbijen` varchar(2) COLLATE utf8mb3_bin DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Dumping data for table `nastavnici`
--

INSERT INTO `nastavnici` (`username`, `password`, `ime`, `prezime`, `pol`, `telefon`, `mejl`, `razred`, `potvrdjen`, `odbijen`) VALUES
('Deki', 'a4b72973c57f435e7c4a884ec15162e9', 'Dejan', 'Markovic', 'M', '062227223', 'dejandeki@gmail.com', '5-8', 0, '-1'),
('Laki', '78476f6899506bf077a0d8f2e99bd778', 'Lazar', 'Stanarevic', 'M', '+38162112642', 'lazarstan@hotmail.com', '1-8', 0, '-1'),
('Olgica', 'dd1738472337375b8d859eb8879519dd', 'Olga', 'Simic', 'M', '063656000', 'simicolga@yahoo.com', '1-4', 1, '0'),
('Sonja', '2ece618055c1744f14652fd45203f444', 'Sonja', 'Cukic', 'M', '0693222223', 'sonjacuk@hotmail.com', '5-8', 1, '0'),
('Zoki', '9f6d71585f579525bb3b6be27b1d9ee2', 'Zoran', 'Petric', 'M', '+38169202228', 'zokipetric@hotmail.com', '1-8', 1, '0'),
('marija', '81872b0f681e9781310227ad2b9e3bcf', 'Marija', 'Trajkovic', 'Z', '0623142883', 'trajkmar@gmail.com', '1-4', 1, '0'),
('nicsta', '7ed50cd0726634fdad557aa4629ebc30', 'Ivan', 'Stanic', 'M', '+38162332248', 'nicstaiv@gmail.com', '1-8', 0, '1'),
('sandokan', 'a73b47abd3c39da97810f0e5a7880352', 'Miomir', 'Stanivukovic', 'M', '0693142223', 'stanivuk@gmail.com', '5-8', 1, '0'),
('zmaj', 'b9c4f07d90a5b1b9db4df7889f35b4ef', 'Milorad', 'Radojevic', 'M', '063111333', 'radojevic@gmail.com', '1-8', 0, '-1'),
('zorica', '78aba0ae59d95fa3d2661efc7235b674', 'Zorica', 'Ajvaz', 'M', '0627742227', 'zoricaajvaz@gmail.com', '5-8', 0, '-1');

-- --------------------------------------------------------

--
-- Table structure for table `predmeti`
--

DROP TABLE IF EXISTS `predmeti`;
CREATE TABLE IF NOT EXISTS `predmeti` (
  `predmetID` int NOT NULL AUTO_INCREMENT,
  `naziv` varchar(30) COLLATE utf8mb3_bin NOT NULL,
  `username` varchar(20) COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`predmetID`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Dumping data for table `predmeti`
--

INSERT INTO `predmeti` (`predmetID`, `naziv`, `username`) VALUES
(7, 'Matematika', ''),
(8, 'Fizika', ''),
(9, 'Hemija', ''),
(10, 'Informatika', ''),
(11, 'Srpski_jezik', ''),
(12, 'Engleski_jezik', ''),
(13, 'Nemacki_jezik', ''),
(14, 'Italijanski_jezik', ''),
(15, 'Francuski_jezik', ''),
(16, 'Spanski_jezik', ''),
(17, 'Ruski_jezik', ''),
(18, 'Biologija', ''),
(19, 'Istorija', ''),
(20, 'Geografija', ''),
(21, 'Nesto_drugo', ''),
(137, 'Matematika', 'Zoki'),
(138, 'Informatika', 'Zoki'),
(139, 'Matematika', 'Sonja'),
(140, 'Fizika', 'Sonja'),
(141, 'Engleski_jezik', 'Sonja'),
(142, 'Fizika', 'nicsta'),
(143, 'Istorija', 'nicsta'),
(144, 'Geografija', 'nicsta'),
(145, 'Kvantna fizika', 'nicsta'),
(146, 'Kvantna fizika', ''),
(147, 'Srpski_jezik', 'Olgica'),
(148, 'Geografija', 'Olgica'),
(149, 'Matematika', 'sandokan'),
(150, 'Srpski_jezik', 'marija'),
(151, 'Engleski_jezik', 'marija'),
(152, 'Nemacki_jezik', 'marija'),
(153, 'Fizika', 'zmaj'),
(154, 'Informatika', 'zmaj'),
(155, 'Istorija', 'zmaj'),
(156, 'Geografija', 'zmaj'),
(157, 'Francuski_jezik', 'Deki'),
(158, 'Spanski_jezik', 'Deki'),
(159, 'Ruski_jezik', 'Deki'),
(160, 'Biologija', 'Laki'),
(161, 'Istorija', 'Laki'),
(162, 'Geografija', 'Laki'),
(163, 'Geografija', 'zorica');

-- --------------------------------------------------------

--
-- Table structure for table `ucenici`
--

DROP TABLE IF EXISTS `ucenici`;
CREATE TABLE IF NOT EXISTS `ucenici` (
  `username` varchar(10) COLLATE utf8mb3_bin NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `ime` varchar(20) COLLATE utf8mb3_bin NOT NULL,
  `prezime` varchar(20) COLLATE utf8mb3_bin NOT NULL,
  `pol` varchar(20) COLLATE utf8mb3_bin NOT NULL,
  `telefon` varchar(20) COLLATE utf8mb3_bin NOT NULL,
  `mejl` varchar(30) COLLATE utf8mb3_bin NOT NULL,
  `razred` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Dumping data for table `ucenici`
--

INSERT INTO `ucenici` (`username`, `password`, `ime`, `prezime`, `pol`, `telefon`, `mejl`, `razred`) VALUES
('dovla', 'ea2ed00146043e53391e97bc14cfaa9b', 'Vladimir', 'Potezica', 'M', '062451943', 'vladpotez@gmail.com', 6),
('tijana', '07a98ebc804416c6b4281f749572b53c', 'Tijana', 'Simic', 'M', '+38169222233', 'simictijana@hotmail.com', 3),
('peki', 'fd4eb7abc40b402aa9ebfcae33553306', 'Petar', 'Stanic', 'M', '062222311', 'pekistanic@gmail.com', 6),
('mixa14', '46ab2ecb2dd524406e09aece49404f7e', 'Mihailo', 'Simic', 'M', '+381692001148', 'simicmihailo@hotmail.com', 1),
('siske', 'c556a266ecfb5a24556a16ee6f14ffdc', 'Stara', 'Ekipa', 'M', '061112223', 'staraekipa@gmail.com', 4),
('Oscar', '1186016cb97aa81bbe6f474a1a945a49', 'Uros', 'Males', 'M', '062122332', 'oscarlesma@gmail.com', 6);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
