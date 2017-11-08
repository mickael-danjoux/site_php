-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 08 nov. 2017 à 10:48
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `site_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `achat`
--

DROP TABLE IF EXISTS `achat`;
CREATE TABLE IF NOT EXISTS `achat` (
  `login` varchar(50) NOT NULL,
  `id_image` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `achat`
--

INSERT INTO `achat` (`login`, `id_image`) VALUES
('Jean', 1),
('Jean', 2),
('Jean', 5),
('mi', 1),
('mi', 2),
('Jean', 7);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `lieu` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `evenement` varchar(50) NOT NULL,
  `mot_cle` varchar(100) NOT NULL,
  `url` varchar(256) NOT NULL,
  `url_min` varchar(256) NOT NULL,
  `url_copyright` varchar(256) NOT NULL,
  `lien_page` varchar(256) NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `nom`, `lieu`, `date`, `evenement`, `mot_cle`, `url`, `url_min`, `url_copyright`, `lien_page`, `prix`) VALUES
(1, 'Voyage en Ecosse', 'Aberdeen', '2017-02-11', 'Voyage', 'Voyage, Ecosse, Lac', 'images/reelle/1_Voyage.jpg', 'images/miniature/1_Voyage.jpg', 'images/copyright/1_Voyage.jpg', 'pagesImages/1_Voyage.php', 10),
(2, 'Lac Gentau', 'France', '2015-05-22', 'Marche', 'Lac, Paysage', 'images/reelle/2_lac.jpg', 'images/miniature/2_lac.jpg', 'images/copyright/2_lac.jpg', 'pagesImages/2_lac.php', 15),
(5, 'Paysage', 'Ecosse', '2011-05-12', 'Visite', 'visite, gris', 'images/reelle/5_Paysage.jpg', 'images/miniature/5_Paysage.jpg', 'images/copyright/5_Paysage.jpg', 'pagesImages/5_Paysage.php', 7.79),
(7, 'Voiture', 'Ecosse', '1200-05-12', 'Visite', 'visite', 'images/reelle/7_Voiture.jpg', 'images/miniature/7_Voiture.jpg', 'images/copyright/7_Voiture.jpg', 'pagesImages/7_Voiture.php', 12.99);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `mail` varchar(250) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`login`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`mail`, `login`, `password`, `admin`) VALUES
('', 'Mael', '15af14gha665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3654ighj5', 1),
('', 'Jean', '15af14ghb3a8e0e1f9ab1bfe3a36f231f676f78bb30a519d2b21e6c530c0eee8ebb4a5d0654ighj5', 0),
('zetg@hotmail.fr', 'mi', '15af14gh86c528e8fad7b916cfb21e1bf6f341e9fcc84462dce9fc69286a613e1a730284654ighj5', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
