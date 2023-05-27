-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 27 mai 2023 à 15:08
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecolotri`
--

-- --------------------------------------------------------

--
-- Structure de la table `pesee`
--

DROP TABLE IF EXISTS `pesee`;
CREATE TABLE IF NOT EXISTS `pesee` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dateDepot` date DEFAULT NULL,
  `heure` varchar(25) DEFAULT NULL,
  `poidArrivee` int DEFAULT NULL,
  `poidDepart` int DEFAULT NULL,
  `immatriculationCamion` varchar(255) DEFAULT NULL,
  `idDechet` int NOT NULL,
  `idSyndicat` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idDechet` (`idDechet`),
  KEY `idSyndicat` (`idSyndicat`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `syndicat`
--

DROP TABLE IF EXISTS `syndicat`;
CREATE TABLE IF NOT EXISTS `syndicat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) DEFAULT NULL,
  `adresse` varchar(25) DEFAULT NULL,
  `cp` int DEFAULT NULL,
  `ville` varchar(25) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `telephone` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `syndicat`
--

INSERT INTO `syndicat` (`id`, `nom`, `adresse`, `cp`, `ville`, `mail`, `telephone`) VALUES
(1, 'Roess', '86 rue des jardins', 57000, 'Belfort', 'roess@gmail.com', 606060606),
(2, 'Bihry', '10 rue de mon coeur', 69000, 'lyon', 'guigui@gmail.com', 3630),
(6, 'Stephan', '1 rue haula', 68800, 'Roderen', 'leo.stephan68800@gmail.com', 782940549),
(7, 'Mey', '3 rue de la milice', 68376, 'Wittenheim', 'meytristan68@gmail.com', 36303630),
(8, 'EricFan2Windev', '3 rue des arbres', 68000, 'Colmar', 'ericfan2windev@gmail.com', 800059595);

-- --------------------------------------------------------

--
-- Structure de la table `typedechet`
--

DROP TABLE IF EXISTS `typedechet`;
CREATE TABLE IF NOT EXISTS `typedechet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `typedechet`
--

INSERT INTO `typedechet` (`id`, `libelle`) VALUES
(1, 'verre'),
(2, 'métal'),
(3, 'carton'),
(4, 'bois'),
(5, 'végétaux'),
(6, 'ménager');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
