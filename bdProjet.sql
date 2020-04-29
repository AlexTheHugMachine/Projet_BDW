-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 07 Février 2018 à 16:00
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `chat`
--

-- --------------------------------------------------------

--
-- Structure de la table `Categorie`
--

CREATE TABLE IF NOT EXISTS Categorie (
  catId INT NOT NULL,
  nomCat varchar(255) NOT NULL,
  PRIMARY KEY(catId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `Categorie` (`catId`, `nomCat`) VALUES ('1', 'Coronavirus');
INSERT INTO `Categorie` (`catId`, `nomCat`) VALUES ('2', 'Anime');
-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE IF NOT EXISTS Photo (
  photoId int NOT NULL AUTO_INCREMENT,
  nomFich varchar(250) NOT NULL,
  description varchar(250) NOT NULL,
  catId int NOT NULL,
  PRIMARY KEY (photoId),
  FOREIGN KEY (catId) REFERENCES Categorie(catId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `Photo` (`photoId`, `nomFich`, `description`, `catId`) VALUES ('1', 'topmemecoronavirus.jpg', 'Entre nous... C est pas si faux que ça', '1');
INSERT INTO `Photo` (`photoId`, `nomFich`, `description`, `catId`) VALUES ('2', 'anime1.jpg', 'un grand classique des memes sur les animes !', '2');


CREATE TABLE IF NOT EXISTS utilisateur (
  pseudo varchar(255) NOT NULL,
  mdp varchar(255) NOT NULL,
  etat varchar(255) NOT NULL,
  PRIMARY KEY (pseudo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `utilisateur` (`pseudo`, `mdp`, `etat`) VALUES ('admin', '21232f297a57a5a743894a0e4a801fc3', 'disconnected');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
