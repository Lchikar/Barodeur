-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 10 avr. 2019 à 18:26
-- Version du serveur :  5.7.24
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bars_a_gogo`
--

-- --------------------------------------------------------

--
-- Structure de la table `Bar`
--

DROP TABLE IF EXISTS `Bar`;
CREATE TABLE IF NOT EXISTS `Bar` (
  `id_bar` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(124) NOT NULL,
  `numStreet` varchar(10) NOT NULL,
  `street` varchar(256) NOT NULL,
  `postalCode` int(11) NOT NULL,
  `website` varchar(256) NOT NULL,
  `numPhone` varchar(12) NOT NULL,
  `infos` text NOT NULL,
  PRIMARY KEY (`id_bar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `BarType`
--

DROP TABLE IF EXISTS `BarType`;
CREATE TABLE IF NOT EXISTS `BarType` (
  `id_barType` int(11) NOT NULL,
  `barType` varchar(124) DEFAULT NULL,
  PRIMARY KEY (`id_barType`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `City`
--

DROP TABLE IF EXISTS `City`;
CREATE TABLE IF NOT EXISTS `City` (
  `id_city` int(11) NOT NULL,
  `postalCode` int(11) DEFAULT NULL,
  `cityName` varchar(124) DEFAULT NULL,
  PRIMARY KEY (`id_city`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Comment`
--

DROP TABLE IF EXISTS `Comment`;
CREATE TABLE IF NOT EXISTS `Comment` (
  `id_comment` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `text` text,
  PRIMARY KEY (`id_comment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Mark`
--

DROP TABLE IF EXISTS `Mark`;
CREATE TABLE IF NOT EXISTS `Mark` (
  `id_mark` int(11) NOT NULL,
  `id_markType` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mark`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `markType`
--

DROP TABLE IF EXISTS `markType`;
CREATE TABLE IF NOT EXISTS `markType` (
  `id_markType` int(11) NOT NULL,
  `markType` varchar(124) DEFAULT NULL,
  PRIMARY KEY (`id_markType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

DROP TABLE IF EXISTS `User`;
CREATE TABLE IF NOT EXISTS `User` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(124) DEFAULT NULL,
  `password` varchar(124) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
