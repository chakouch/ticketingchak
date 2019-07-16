-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 16 juil. 2019 à 19:43
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ticketing`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `cli_id` int(11) NOT NULL AUTO_INCREMENT,
  `cli_nom` varchar(255) NOT NULL,
  `cli_address` varchar(255) NOT NULL,
  `cli_email` varchar(255) NOT NULL,
  `cli_tel` varchar(50) NOT NULL,
  `cli_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cli_id`),
  UNIQUE KEY `cli_nom` (`cli_nom`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`cli_id`, `cli_nom`, `cli_address`, `cli_email`, `cli_tel`, `cli_del`) VALUES
(1, 'toto', '34 rue capitaine dreyfus 93100 montreuil', 'toto@gmail.com', '0622548796', 0);

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

DROP TABLE IF EXISTS `projet`;
CREATE TABLE IF NOT EXISTS `projet` (
  `prj_id` int(11) NOT NULL AUTO_INCREMENT,
  `prj_cli_nom` varchar(250) NOT NULL,
  `prj_usr_nom` varchar(250) NOT NULL,
  `prj_nom` varchar(255) NOT NULL,
  `prj_date` datetime NOT NULL,
  `prj_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`prj_id`),
  KEY `prj-cli` (`prj_cli_nom`),
  KEY `prj-usr` (`prj_usr_nom`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `projet`
--

INSERT INTO `projet` (`prj_id`, `prj_cli_nom`, `prj_usr_nom`, `prj_nom`, `prj_date`, `prj_del`) VALUES
(11, 'toto', 'dabo', 'Mohammed CHAKOUCH', '2019-07-16 08:50:03', 0),
(12, 'toto', 'DABO', 'proojet', '2019-07-16 09:21:55', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `tck_id` int(11) NOT NULL AUTO_INCREMENT,
  `tck_client` text NOT NULL,
  `tck_titre` varchar(100) NOT NULL DEFAULT '',
  `tck_description` varchar(500) NOT NULL,
  `tck_date` datetime NOT NULL,
  `tck_urgence` varchar(10) NOT NULL,
  `tck_createur` varchar(25) NOT NULL,
  `intervenant` varchar(30) NOT NULL,
  `intervenantCloture` varchar(4) NOT NULL,
  `intervention` varchar(500) DEFAULT NULL,
  `dateCloture` datetime DEFAULT NULL,
  `tck_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tck_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ticket`
--

INSERT INTO `ticket` (`tck_id`, `tck_client`, `tck_titre`, `tck_description`, `tck_date`, `tck_urgence`, `tck_createur`, `intervenant`, `intervenantCloture`, `intervention`, `dateCloture`, `tck_del`) VALUES
(2, 'toto', 'aze', 'dsfsdf', '2019-07-16 13:10:46', 'faible', '', 'DABO', 'oui', 'la base de donnÃ©e est changÃ©', '2019-07-16 13:10:46', 0),
(3, 'toto', 'nouveau ticket', 'test test', '2019-07-16 11:22:11', 'haute', 'chakouch', 'DABO', 'non', NULL, NULL, 0),
(5, 'toto', 'nouveau ticket', 'ordinateur cassÃ©', '2019-07-16 13:38:43', 'moyenne', '', 'DABO', 'oui', 'c est reglee', '2019-07-16 13:38:43', 0),
(6, 'toto', 'qsdlk', 'qsdmq', '2019-07-16 17:24:16', 'faible', 'chakouch', 'DABO', 'non', NULL, NULL, 0),
(7, 'toto', 'qsd', 'lmsdf', '2019-07-16 17:24:32', 'faible', 'chakouch', 'DABO', 'non', NULL, NULL, 0),
(8, 'toto', 'qsdl', 'qmlsdf', '2019-07-16 17:24:46', 'faible', 'chakouch', 'DABO', 'non', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_nom` varchar(255) NOT NULL,
  `usr_prenom` varchar(255) NOT NULL,
  `usr_role` varchar(20) NOT NULL,
  `usr_email` varchar(255) NOT NULL,
  `usr_login` varchar(255) NOT NULL,
  `usr_pwd` varchar(255) NOT NULL,
  `usr_address` varchar(255) NOT NULL,
  `usr_tel` varchar(50) NOT NULL,
  `usr_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`usr_id`),
  UNIQUE KEY `usr_nom` (`usr_nom`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`usr_id`, `usr_nom`, `usr_prenom`, `usr_role`, `usr_email`, `usr_login`, `usr_pwd`, `usr_address`, `usr_tel`, `usr_del`) VALUES
(1, 'DABO', 'Issaga', 'intervenant', 'issagadabo20@gmail.com', 'idabo', 'pass', '62 rue camille desmoulins 94230 cachan', '0645073778', 0),
(2, 'chakouch', 'mohammed', 'admin', 'mohammed.chakouch', 'mchakouch', 'pass', '62 rue camille desmoulins 94230 cacjan', '0645073778', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_intervention`
--

DROP TABLE IF EXISTS `user_intervention`;
CREATE TABLE IF NOT EXISTS `user_intervention` (
  `inter_id` int(11) NOT NULL AUTO_INCREMENT,
  `inter_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `technicien` varchar(20) NOT NULL,
  `intervention` text NOT NULL,
  PRIMARY KEY (`inter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `projet`
--
ALTER TABLE `projet`
  ADD CONSTRAINT `prj-cli` FOREIGN KEY (`prj_cli_nom`) REFERENCES `client` (`cli_nom`),
  ADD CONSTRAINT `prj-usr` FOREIGN KEY (`prj_usr_nom`) REFERENCES `user` (`usr_nom`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
