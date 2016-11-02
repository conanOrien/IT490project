-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 11 Octobre 2016 à 11:01
-- Version du serveur :  5.6.16
-- Version de PHP :  5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `cargo_system`
--

-- --------------------------------------------------------

--
-- Structure de la table `aircraft_info`
--

CREATE TABLE IF NOT EXISTS `aircraft_info` (
  `TailNumber` int(11) NOT NULL,
  `Type` varchar(4) NOT NULL,
  `FuelCount` int(11) NOT NULL,
  PRIMARY KEY (`TailNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `aircraft_info`
--

INSERT INTO `aircraft_info` (`TailNumber`, `Type`, `FuelCount`) VALUES
(10000, 'b1', 360),
(12500, 'ab9', 1300),
(20000, 'b5', 500);

-- --------------------------------------------------------

--
-- Structure de la table `aircrew`
--

CREATE TABLE IF NOT EXISTS `aircrew` (
  `CrewID` int(11) NOT NULL,
  `PilotName` varchar(40) NOT NULL,
  `NavigatorName` varchar(40) NOT NULL,
  PRIMARY KEY (`CrewID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `aircrew`
--

INSERT INTO `aircrew` (`CrewID`, `PilotName`, `NavigatorName`) VALUES
(100, 'Pilote Name 1', 'Navigator Name 1'),
(200, 'Pilote Name 2', 'Navigator Name 2'),
(256, 'pilote 256', 'navigator 256');

-- --------------------------------------------------------

--
-- Structure de la table `airport`
--

CREATE TABLE IF NOT EXISTS `airport` (
  `Code` varchar(3) NOT NULL DEFAULT '',
  `FullName` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `airport`
--

INSERT INTO `airport` (`Code`, `FullName`) VALUES
('a01', 'AirPort 1'),
('a02', 'AirPort 2'),
('a03', 'AirPort 3');

-- --------------------------------------------------------

--
-- Structure de la table `cargo`
--

CREATE TABLE IF NOT EXISTS `cargo` (
  `SkidNum` int(11) NOT NULL,
  `Weight` int(11) NOT NULL,
  `Content` varchar(60) NOT NULL,
  PRIMARY KEY (`SkidNum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cargo`
--

INSERT INTO `cargo` (`SkidNum`, `Weight`, `Content`) VALUES
(1000, 15, ' cell phones'),
(1253, 52, 'tvs vtvs tvs'),
(2000, 100, 'TVs');

-- --------------------------------------------------------

--
-- Structure de la table `flight`
--

CREATE TABLE IF NOT EXISTS `flight` (
  `FlightNum` int(11) NOT NULL DEFAULT '0',
  `TailNum` int(11) DEFAULT NULL,
  `CrewID` int(11) DEFAULT NULL,
  `DepartureFrom` varchar(3) DEFAULT NULL,
  `DepartureTo` varchar(3) DEFAULT NULL,
  `DepartureTime` datetime DEFAULT NULL,
  `ArrivalTime` datetime DEFAULT NULL,
  `SkidNum` int(11) DEFAULT NULL,
  PRIMARY KEY (`FlightNum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `flight`
--

INSERT INTO `flight` (`FlightNum`, `TailNum`, `CrewID`, `DepartureFrom`, `DepartureTo`, `DepartureTime`, `ArrivalTime`, `SkidNum`) VALUES
(1000, 10000, 100, 'AA1', 'BB1', '2016-10-06 23:10:10', '2016-10-07 05:10:10', 1000),
(1250, 20000, 100, 'TX', 'FL', '2016-10-06 21:10:10', '2016-10-07 03:10:10', NULL),
(1256, 12500, 256, 'FL', 'NY', '2016-10-11 07:06:00', '2016-10-12 07:06:00', 1253),
(1257, 12500, 256, 'FL', 'NY', '2016-10-11 07:06:00', '2016-10-12 07:06:00', 1253),
(1258, 12500, 100, 'FL', 'NY', '2016-10-11 06:06:00', '2016-10-15 06:06:00', NULL),
(1460, 30000, 300, 'NY', 'FL', '2016-10-06 23:10:10', '2016-10-07 01:10:10', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
