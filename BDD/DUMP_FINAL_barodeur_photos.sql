-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 12 mai 2019 à 11:52
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
-- Base de données :  `barodeur`
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
  `photo` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id_bar`),
  UNIQUE KEY `photo_UNIQUE` (`photo`),
  KEY `postalCode` (`postalCode`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Bar`
--

INSERT INTO `Bar` (`id_bar`, `name`, `numStreet`, `street`, `postalCode`, `website`, `numPhone`, `infos`, `photo`) VALUES
(1, 'Mil\'s Pub', '193', 'avenue Daumesnil', 75012, 'https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=2&cad=rja&uact=8&ved=2ahUKEwil5-KL6srhAhXN8OAKHQWSAcUQFjABegQIARAB&url=https%3A%2F%2Ffr-fr.facebook.com%2FMILS-PUB-2004580669866645%2F&usg=AOvVaw0-c61c_F5FJUsOCTiDB1fV', '0766526551', 'La baaase du jeudimac', 'mils.jpg'),
(2, 'L\'Absinthe', '54', 'Rue de Turbigo', 75003, 'https://www.youshould.eu/l/labsinthe', '0175850125', ' Du vin au cocktail ou encore une intéressante sélection de bières pressions.', 'absinthe.jpg'),
(3, 'Le Falstaff', '42', 'Rue de Montparnasse', 75014, 'http://www.barsparis.com/bar-paris/le-falstaff/', '0143353829', 'Bière et bonne ambiance !', 'Falstaff.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `BarBelongsType`
--

DROP TABLE IF EXISTS `BarBelongsType`;
CREATE TABLE IF NOT EXISTS `BarBelongsType` (
  `id_bar` int(11) NOT NULL,
  `id_barType` int(11) NOT NULL,
  PRIMARY KEY (`id_bar`,`id_barType`),
  KEY `id_barType` (`id_barType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `BarBelongsType`
--

INSERT INTO `BarBelongsType` (`id_bar`, `id_barType`) VALUES
(1, 3),
(2, 3),
(2, 4),
(3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `BarType`
--

DROP TABLE IF EXISTS `BarType`;
CREATE TABLE IF NOT EXISTS `BarType` (
  `id_barType` int(11) NOT NULL,
  `barType` varchar(124) DEFAULT NULL,
  PRIMARY KEY (`id_barType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `BarType`
--

INSERT INTO `BarType` (`id_barType`, `barType`) VALUES
(1, 'lounge'),
(2, 'shooter'),
(3, 'cocktail'),
(4, 'biere'),
(5, 'geek'),
(6, 'irlandais'),
(7, 'dansant'),
(8, 'punk'),
(9, 'kawaii');

-- --------------------------------------------------------

--
-- Structure de la table `City`
--

DROP TABLE IF EXISTS `City`;
CREATE TABLE IF NOT EXISTS `City` (
  `postalCode` int(11) NOT NULL,
  `cityName` varchar(124) DEFAULT NULL,
  PRIMARY KEY (`postalCode`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `City`
--

INSERT INTO `City` (`postalCode`, `cityName`) VALUES
(75001, 'Paris 1er'),
(75002, 'Paris 2e'),
(75003, 'Paris 3e'),
(75004, 'Paris 4e'),
(75005, 'Paris 5e'),
(75006, 'Paris 6e'),
(75007, 'Paris 7e'),
(75008, 'Paris 8e'),
(75009, 'Paris 9e'),
(75010, 'Paris 10e'),
(75011, 'Paris 11e'),
(75012, 'Paris 12e'),
(75013, 'Paris 13e'),
(75014, 'Paris 14e'),
(75015, 'Paris 15e'),
(75016, 'Paris 16e'),
(75017, 'Paris 17e'),
(75018, 'Paris 18e'),
(75019, 'Paris 19e'),
(75020, 'Paris 20e'),
(77420, 'Champs-sur-Marne'),
(94230, 'Cachan');

-- --------------------------------------------------------

--
-- Structure de la table `Comment`
--

DROP TABLE IF EXISTS `Comment`;
CREATE TABLE IF NOT EXISTS `Comment` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_bar` int(11) DEFAULT NULL,
  `text` text,
  PRIMARY KEY (`id_comment`),
  KEY `id_user` (`id_user`),
  KEY `FK_id_bar` (`id_bar`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Comment`
--

INSERT INTO `Comment` (`id_comment`, `id_user`, `id_bar`, `text`) VALUES
(1, 1, 1, 'LA BAAAASE'),
(2, 2, 3, 'Super ambiance et bonne musique');

-- --------------------------------------------------------

--
-- Structure de la table `Mark`
--

DROP TABLE IF EXISTS `Mark`;
CREATE TABLE IF NOT EXISTS `Mark` (
  `id_mark` int(11) NOT NULL AUTO_INCREMENT,
  `id_markType` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_bar` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mark`),
  KEY `id_markType` (`id_markType`,`id_user`),
  KEY `FK_id_bar` (`id_bar`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Mark`
--

INSERT INTO `Mark` (`id_mark`, `id_markType`, `id_user`, `id_bar`, `value`) VALUES
(1, 1, 1, 1, 5),
(2, 2, 2, 1, 5),
(3, 2, 2, 2, 3),
(4, 2, 2, 3, 2),
(5, 3, 2, 3, 5),
(6, 3, 2, 2, 3),
(7, 3, 2, 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `MarkType`
--

DROP TABLE IF EXISTS `MarkType`;
CREATE TABLE IF NOT EXISTS `MarkType` (
  `id_markType` int(11) NOT NULL,
  `markType` varchar(124) DEFAULT NULL,
  PRIMARY KEY (`id_markType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `MarkType`
--

INSERT INTO `MarkType` (`id_markType`, `markType`) VALUES
(1, 'generale'),
(2, 'prix'),
(3, 'ambiance'),
(4, 'distance');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `User`
--

INSERT INTO `User` (`id_user`, `pseudo`, `password`) VALUES
(1, 'louisa', 'root'),
(2, 'Mélissande', 'test');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Bar`
--
ALTER TABLE `Bar`
  ADD CONSTRAINT `bar_ibfk_1` FOREIGN KEY (`postalCode`) REFERENCES `City` (`postalCode`);

--
-- Contraintes pour la table `BarBelongsType`
--
ALTER TABLE `BarBelongsType`
  ADD CONSTRAINT `barbelongstype_ibfk_1` FOREIGN KEY (`id_bar`) REFERENCES `Bar` (`id_bar`),
  ADD CONSTRAINT `barbelongstype_ibfk_2` FOREIGN KEY (`id_barType`) REFERENCES `BarType` (`id_barType`);

--
-- Contraintes pour la table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `FK_id_bar` FOREIGN KEY (`id_bar`) REFERENCES `Bar` (`id_bar`),
  ADD CONSTRAINT `FK_id_user` FOREIGN KEY (`id_user`) REFERENCES `User` (`id_user`);

--
-- Contraintes pour la table `Mark`
--
ALTER TABLE `Mark`
  ADD CONSTRAINT `FK_id_markType` FOREIGN KEY (`id_markType`) REFERENCES `MarkType` (`id_markType`),
  ADD CONSTRAINT `mark_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `User` (`id_user`),
  ADD CONSTRAINT `mark_ibfk_2` FOREIGN KEY (`id_bar`) REFERENCES `Bar` (`id_bar`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
