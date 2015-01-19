-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 19 Janvier 2015 à 14:08
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
  `date` timestamp NOT NULL,
  `rue_depart` varchar(255) NOT NULL,
  `num_depart` int(11) NOT NULL,
  `CP_depart` varchar(5) NOT NULL,
  `rue_arrive` varchar(255) NOT NULL,
  `num_arrive` int(11) NOT NULL,
  `CP_arrive` varchar(5) NOT NULL,
  `id_vehicule` int(11) NOT NULL,
  `duree` time NOT NULL,
  `favori` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `historique`
--

INSERT INTO `historique` (`id`, `id_utilisateur`, `date`, `rue_depart`, `num_depart`, `CP_depart`, `rue_arrive`, `num_arrive`, `CP_arrive`, `id_vehicule`, `duree`, `favori`) VALUES
(1, 0, '2015-01-19 13:04:21', 'rue de Saint Prix', 81, '95320', 'Rue Chateaudun', 27, '75009', 1, '00:14:56', 0);

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
(1, 0, '2015-01-19 13:05:24', 'Yo !\r\nCa va ?');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `MdP` varchar(255) NOT NULL,
  `connecte` int(11) NOT NULL DEFAULT '0',
  `token` varchar(255) NOT NULL,
  `date_subscrib` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `MdP`, `connecte`, `token`, `date_subscrib`) VALUES
(1, 'Riverain', 'Jeremy', 'jeremyriverain@hotmail.fr', 'bretagne', 0, 'klsgqkjsdgfqsdkjgfqsdjkhfqkjshdgerghjklm', '2015-01-19');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `id_utilisateur`, `marque`, `modele`, `consommation`, `type_moteur`) VALUES
(1, 0, 'Audi', 'TT', 10, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
