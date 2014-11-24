-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 24 Novembre 2014 à 21:33
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `paiements_prof`
--

-- --------------------------------------------------------

--
-- Structure de la table `etablissements`
--

CREATE TABLE IF NOT EXISTS `etablissements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `id_univ` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `libelle` (`libelle`),
  KEY `id_univ` (`id_univ`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `etablissements`
--

INSERT INTO `etablissements` (`id`, `libelle`, `id_univ`) VALUES
(1, 'ENSA Khouribga', 1);

-- --------------------------------------------------------

--
-- Structure de la table `grades`
--

CREATE TABLE IF NOT EXISTS `grades` (
  `id` varchar(3) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `indemnite` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `libelle` (`libelle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `grades`
--

INSERT INTO `grades` (`id`, `libelle`, `indemnite`) VALUES
('A', 'Assistant', 120),
('AP', 'Attachés pédagogiques', 50),
('MA', 'Maitre assistant', 150),
('PA', 'Professeur de l''enseignement supérieur assistant', 180),
('PES', 'Professeur de l''enseignement superieur', 300),
('PH', 'Professeur habilité', 230);

-- --------------------------------------------------------

--
-- Structure de la table `heures`
--

CREATE TABLE IF NOT EXISTS `heures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_jour` date NOT NULL,
  `nbre_heure` int(11) NOT NULL,
  `type` enum('sup','vac') NOT NULL,
  `tranches` varchar(100) NOT NULL,
  `id_prof` int(11) NOT NULL,
  `id_eta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_prof` (`id_prof`),
  KEY `id_eta` (`id_eta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `heures`
--

INSERT INTO `heures` (`id`, `date_jour`, `nbre_heure`, `type`, `tranches`, `id_prof`, `id_eta`) VALUES
(6, '2014-11-19', 3, 'sup', ' 8h - 9h, 9h - 10h, 14h - 15h,', 1, 1),
(7, '2014-11-20', 4, 'vac', ' 8h - 9h, 9h - 10h, 14h - 15h, 15h - 16h,', 2, 1),
(8, '2014-11-22', 2, 'sup', ' 14h - 15h, 15h - 16h,', 1, 1),
(9, '2014-11-19', 2, 'sup', ' 8h - 9h, 9h - 10h,', 1, 1),
(10, '2014-11-23', 3, 'sup', ' 8h - 9h, 9h - 10h, 15h - 16h,', 1, 1),
(11, '2014-11-25', 4, 'sup', ' 8h - 9h, 9h - 10h, 16h - 17h, 17h - 18h,', 1, 1),
(12, '2014-12-09', 2, 'sup', ' 14h - 15h, 15h - 16h,', 1, 1),
(13, '2015-01-06', 2, 'sup', ' 14h - 15h, 15h - 16h,', 1, 1),
(14, '2015-10-13', 4, 'sup', ' 14h - 15h, 15h - 16h, 16h - 17h, 17h - 18h,', 1, 1),
(15, '2015-02-04', 4, 'sup', ' 14h - 15h, 15h - 16h, 16h - 17h, 17h - 18h,', 1, 1),
(16, '2014-11-24', 4, 'vac', ' 8h - 9h, 9h - 10h, 10h - 11h, 11h - 12h,', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `logins`
--

CREATE TABLE IF NOT EXISTS `logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_resp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  KEY `id_resp` (`id_resp`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `logins`
--

INSERT INTO `logins` (`id`, `login`, `password`, `id_resp`) VALUES
(1, 'hamza', 'hamza', 1);

-- --------------------------------------------------------

--
-- Structure de la table `mois`
--

CREATE TABLE IF NOT EXISTS `mois` (
  `id` int(11) NOT NULL,
  `libelle` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `mois`
--

INSERT INTO `mois` (`id`, `libelle`) VALUES
(1, 'Janvier'),
(2, 'Fevrier'),
(3, 'Mars'),
(4, 'Avril'),
(5, 'Mai'),
(6, 'Juin'),
(7, 'Juillet'),
(8, 'Août'),
(9, 'Septembre'),
(10, 'Octobre'),
(11, 'Novembre'),
(12, 'Decembre');

-- --------------------------------------------------------

--
-- Structure de la table `professeurs`
--

CREATE TABLE IF NOT EXISTS `professeurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cin` varchar(10) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `grade` varchar(3) NOT NULL,
  `id_eta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `grade` (`grade`),
  KEY `id_eta` (`id_eta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `professeurs`
--

INSERT INTO `professeurs` (`id`, `cin`, `nom`, `prenom`, `grade`, `id_eta`) VALUES
(1, 'BK275058', 'Morabit', 'Mouad', 'PES', 1),
(2, 'WA242424', 'Ouasmine', 'Amine', 'A', 1);

-- --------------------------------------------------------

--
-- Structure de la table `professeurs_activite`
--

CREATE TABLE IF NOT EXISTS `professeurs_activite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_som` varchar(7) NOT NULL,
  `id_prof` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_prof` (`id_prof`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `professeurs_activite`
--

INSERT INTO `professeurs_activite` (`id`, `num_som`, `id_prof`) VALUES
(1, '123456', 1);

-- --------------------------------------------------------

--
-- Structure de la table `responsables`
--

CREATE TABLE IF NOT EXISTS `responsables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `type` enum('admin','secretaire') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `responsables`
--

INSERT INTO `responsables` (`id`, `nom`, `prenom`, `type`) VALUES
(1, 'Kacimi', 'Hamza', 'admin'),
(2, 'Mohamed', 'Bounajma', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `universite`
--

CREATE TABLE IF NOT EXISTS `universite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `libelle` (`libelle`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `universite`
--

INSERT INTO `universite` (`id`, `libelle`) VALUES
(1, 'Universite Hassan 1er');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `etablissements`
--
ALTER TABLE `etablissements`
  ADD CONSTRAINT `etablissements_ibfk_1` FOREIGN KEY (`id_univ`) REFERENCES `universite` (`id`);

--
-- Contraintes pour la table `heures`
--
ALTER TABLE `heures`
  ADD CONSTRAINT `heures_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `professeurs` (`id`),
  ADD CONSTRAINT `heures_ibfk_2` FOREIGN KEY (`id_eta`) REFERENCES `etablissements` (`id`);

--
-- Contraintes pour la table `logins`
--
ALTER TABLE `logins`
  ADD CONSTRAINT `logins_ibfk_1` FOREIGN KEY (`id_resp`) REFERENCES `responsables` (`id`);

--
-- Contraintes pour la table `professeurs`
--
ALTER TABLE `professeurs`
  ADD CONSTRAINT `professeurs_ibfk_1` FOREIGN KEY (`grade`) REFERENCES `grades` (`id`),
  ADD CONSTRAINT `professeurs_ibfk_2` FOREIGN KEY (`id_eta`) REFERENCES `etablissements` (`id`);

--
-- Contraintes pour la table `professeurs_activite`
--
ALTER TABLE `professeurs_activite`
  ADD CONSTRAINT `professeurs_activite_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `professeurs` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
