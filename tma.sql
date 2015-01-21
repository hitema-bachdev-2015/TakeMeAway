-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 21 Janvier 2015 à 13:44
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `tma`
--

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE IF NOT EXISTS `historique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `date_h` timestamp NOT NULL,
  `adresse_depart` varchar(255) NOT NULL,
  `latitude_depart` varchar(30) NOT NULL,
  `longitude_depart` varchar(30) NOT NULL,
  `adresse_arrive` varchar(255) NOT NULL,
  `latitude_arrive` varchar(30) NOT NULL,
  `longitude_arrive` varchar(30) NOT NULL,
  `id_vehicule` int(11) NOT NULL,
  `favori` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `historique`
--

INSERT INTO `historique` (`id`, `id_utilisateur`, `date`, `adresse_depart`, `Latitude_depart`, `longitude_depart`, `adresse_arrive`, `latitude_arrive`, `longitude_arrive`, `id_vehicule`, `favori`) VALUES
(1, 1, '2015-01-19 21:43:48', 'rue de Saint Prix', '81', '95320', 'Rue Chateaudun', '27', '75009', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tchat`
--

CREATE TABLE IF NOT EXISTS `tchat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `date_envoi` timestamp NOT NULL,
  `msg` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `tchat`
--

INSERT INTO `tchat` (`id`, `id_utilisateur`, `date_envoi`, `msg`) VALUES
(1, 1, '2015-01-19 21:43:32', 'Yo !\r\nCa va ?');

-- --------------------------------------------------------

--
-- Structure de la table `type_vehicule`
--

CREATE TABLE IF NOT EXISTS `type_vehicule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `type_vehicule`
--

INSERT INTO `type_vehicule` (`id`, `libelle`) VALUES
(1, 'voiture'),
(2, 'camion');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `connecte` int(11) NOT NULL DEFAULT '0',
  `date_subscrib` date NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `mdp`, `connecte`, `date_subscrib`, `adresse`, `cp`, `ville`, `token`) VALUES
(1, 'Riverain', 'Jeremy', 'jeremyriverain@hotmail.fr', 'bretagne', 0, '2015-01-19', '81 rue de Saint Prix', '95320', 'Saint Leu la Forêt', 'ksldhgqfqkshgdueygrfbxnkqbkbviouvb');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE IF NOT EXISTS `vehicule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `modele` varchar(255) NOT NULL,
  `consommation` float NOT NULL,
  `type_moteur` int(11) NOT NULL,
  `type_vehicule` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `id_utilisateur`, `marque`, `modele`, `consommation`, `type_moteur`, `type_vehicule`) VALUES
(1, 1, 'Audi', 'TT', 10, 1, 1),
(2, 1, 'Peugeot', '106', 10, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
