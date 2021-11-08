-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 14 mai 2020 à 09:55
-- Version du serveur :  10.3.16-MariaDB
-- Version de PHP : 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `id12901849_parinfofds`
--
CREATE DATABASE IF NOT EXISTS `id12901849_parinfofds` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id12901849_parinfofds`;

-- --------------------------------------------------------

--
-- Structure de la table `CentreResponsable`
--

CREATE TABLE `CentreResponsable` (
  `IdCR` int(15) NOT NULL,
  `NomCR` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `typeStructure` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CodeCR` decimal(4,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `CentreResponsable`
--

INSERT INTO `CentreResponsable` (`IdCR`, `NomCR`, `typeStructure`, `CodeCR`) VALUES
(1, 'LIRMM', 'RECHERCHE', 2023),
(2, 'DRED', 'DIRECTION', 1866),
(3, 'LMGC', 'RECHERCHE', 2024),
(4, 'FDS', 'UFR INSTITUT ECOLE', 1890);

--
-- Déclencheurs `CentreResponsable`
--
DELIMITER $$
CREATE TRIGGER `before_insert_CentreResponsable` BEFORE INSERT ON `CentreResponsable` FOR EACH ROW BEGIN
      IF NEW.NomCR IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le nom du Centre Responsable ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le nom du Centre Responsable ne doit pas être NULL';
    END IF;
 END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_CentreResponsable` BEFORE UPDATE ON `CentreResponsable` FOR EACH ROW BEGIN
      IF NEW.NomCR IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le nom du Centre Responsable ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le nom du Centre Responsable ne doit pas être NULL';
    END IF;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `Commande`
--

CREATE TABLE `Commande` (
  `NumCommande` int(10) NOT NULL,
  `IdCommandeSIFAC` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fournisseur` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `DateDebutGarantie` date NOT NULL,
  `IdCR` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `Commande`
--

INSERT INTO `Commande` (`NumCommande`, `IdCommandeSIFAC`, `Fournisseur`, `DateDebutGarantie`, `IdCR`) VALUES
(1, '4500112396', 'ECONOCOM', '2016-01-07', 4),
(2, '45001120212', 'ECONOCOM', '2017-04-24', 4),
(3, '4500112397', 'ECONOCOM', '2019-09-08', 1),
(4, '4500112017', 'ECONOCOM', '2017-12-04', 1),
(5, '777', 'T', '2020-03-31', 1),
(6, NULL, 'Dell', '2020-04-20', 4),
(7, NULL, 'Dell', '2020-04-13', 4),
(8, NULL, 'Dell', '2020-04-14', 4),
(9, NULL, 'Dell', '2020-04-18', 4),
(10, NULL, 'Dell', '2020-04-17', 4),
(11, NULL, 'Dell', '2020-04-18', 4),
(12, NULL, 'Dell', '2020-04-16', 4),
(13, NULL, 'Dell', '2020-04-17', 4),
(14, NULL, 'Dell', '2020-04-16', 4),
(15, NULL, 'Dell', '2020-04-14', 4),
(16, NULL, 'ECONOCOM', '2020-04-17', 2),
(17, NULL, 'Dell', '2020-04-06', 4),
(18, NULL, 'ECONOCOM', '2020-04-10', 1),
(19, NULL, 'Dell', '2020-04-18', 4),
(20, NULL, 'ECONOCOM', '2020-04-01', 1),
(21, NULL, 'Dell', '2020-04-07', 4),
(22, NULL, 'Dell', '2020-04-15', 4),
(23, NULL, 'ECONOCOM', '2020-04-01', 1),
(24, NULL, 'Dell', '2020-04-06', 4),
(25, NULL, 'dell ', '2020-04-16', 2),
(26, NULL, 'ECONOCOM', '2020-04-08', 1),
(27, NULL, 'ECONOCOM', '2020-04-08', 1),
(28, NULL, 'ECONOCOM', '2020-04-09', 1),
(29, NULL, 'dell', '2020-04-29', 1),
(30, NULL, 'Dell', '2020-04-15', 4),
(31, NULL, 'Dell', '2020-04-14', 4),
(32, NULL, 'Dell', '2020-03-31', 4),
(33, NULL, 'Dell', '2020-03-31', 4),
(34, NULL, 'Dell', '2020-04-13', 4),
(35, NULL, 'dell', '2020-04-08', 1),
(36, NULL, 'ECONOCOM', '2020-04-09', 3),
(37, NULL, 'Dell', '2018-02-28', 4);

--
-- Déclencheurs `Commande`
--
DELIMITER $$
CREATE TRIGGER `before_insert_Commande` BEFORE INSERT ON `Commande` FOR EACH ROW BEGIN
      IF NEW.Fournisseur IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le fournisseur ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le fournisseur ne doit pas être NULL';
    END IF;
     IF NEW.DateDebutGarantie IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : La DateDebutGarantie  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : La DateDebutGarantie ne doit pas être NULL';
    END IF;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_Commande` BEFORE UPDATE ON `Commande` FOR EACH ROW BEGIN
      IF NEW.Fournisseur IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le fournisseur ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le fournisseur ne doit pas être NULL';
    END IF;
     IF NEW.DateDebutGarantie IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : La DateDebutGarantie  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : La DateDebutGarantie ne doit pas être NULL';
    END IF;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `Compte`
--

CREATE TABLE `Compte` (
  `Login` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `IdPersonne` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `Compte`
--

INSERT INTO `Compte` (`Login`, `password`, `IdPersonne`) VALUES
('bessystefan', '8cb2237d0679ca88db6464eac60da96345513964', 4),
('gallpascale', '8cb2237d0679ca88db6464eac60da96345513964', 3),
('kernnorbert', '8cb2237d0679ca88db6464eac60da96345513964', 2),
('MarcRolland', '8cb2237d0679ca88db6464eac60da96345513964', 1);

--
-- Déclencheurs `Compte`
--
DELIMITER $$
CREATE TRIGGER `before_insert_Compte` BEFORE INSERT ON `Compte` FOR EACH ROW BEGIN
IF NEW.Login IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le login ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le login ne doit pas être NULL';
    END IF;
    IF New.password IS NULL
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR : Le mot de passe ne doit pas être NULL'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le mot de passe ne doit pas être NULL';
    END IF;
    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_Compte` BEFORE UPDATE ON `Compte` FOR EACH ROW BEGIN
IF NEW.Login IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le login ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le login ne doit pas être NULL';
    END IF;
    IF New.password IS NULL
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR : Le mot de passe ne doit pas être NULL'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le mot de passe ne doit pas être NULL';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `Dirige`
--

CREATE TABLE `Dirige` (
  `IdPersonne` int(10) NOT NULL,
  `IdCR` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `Dirige`
--

INSERT INTO `Dirige` (`IdPersonne`, `IdCR`) VALUES
(1, 3),
(2, 1),
(3, 4),
(4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `Gerer`
--

CREATE TABLE `Gerer` (
  `IdPersonne` int(10) NOT NULL,
  `IdLieu` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `fonction` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `Gerer`
--

INSERT INTO `Gerer` (`IdPersonne`, `IdLieu`, `fonction`) VALUES
(1, '01/6/00/6.02', 'ResponsableSI'),
(1, '01/6/00/6.03', 'ResponsableSI'),
(4, '01/36/02/36.204', 'ResponsableSI');

-- --------------------------------------------------------

--
-- Structure de la table `Gere_Par_Hist`
--

CREATE TABLE `Gere_Par_Hist` (
  `IdCR` int(15) NOT NULL,
  `NumSerie` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dateDebutGestion` datetime NOT NULL,
  `dateFinGestion` datetime DEFAULT NULL,
  `InfoFicheInventaire` text COLLATE utf8_unicode_ci NOT NULL,
  `compteurModification` int(50) NOT NULL,
  `typefiche` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `Gere_Par_Hist`
--

INSERT INTO `Gere_Par_Hist` (`IdCR`, `NumSerie`, `dateDebutGestion`, `dateFinGestion`, `InfoFicheInventaire`, `compteurModification`, `typefiche`) VALUES
(1, '1FRMH5K', '1900-01-01 00:00:00', '2020-05-03 21:01:13', 'Gall-Borut;Pascale;777072536;Pascale.Gall-Borut@umontpellier.fr;FDS UFR INSTITUT ECOLE;4500112396;OptiPlex 790;Workstation;Dell;ECONOCOM;1FRMH5K;;01;36;02;36.204;2016-01-07;57M4HG12;UM000001;;;;;;;bessy;stefan;637459812;stefan.bessy@umontpellier.fr', 1, 'Entrée'),
(1, '1FRMH5K', '2016-02-12 00:00:00', '2020-05-03 21:03:55', ';;;;;;OptiPlex 790;Workstation;Dell;;1FRMH5K;01;36;02;36.204;01;6;00;6.02;;57M4HG12;UM000001;2020-05-03 21:03:55;Kern;Norbert;767253736;Norbert.Kern@umontpellier.fr;Kern;Norbert;767253736;Norbert.Kern@umontpellier.fr', 2, 'Modification'),
(1, '1FRMH5K', '2020-05-03 21:03:55', '2020-05-03 21:35:35', ';;;;;;OptiPlex 790;Workstation;Dell;;1FRMH5K;01;6;00;6.02;;;57M4HG12;UM000001;NULL;2020-05-03 21:35:35;;;;;Kern;Norbert;767253736;Norbert.Kern@umontpellier.fr', 3, 'Sortie'),
(1, '8CRMH5J', '1900-01-01 00:00:00', '2020-04-25 16:43:52', 'Gall-Borut;Pascale;777072536;Pascale.Gall-Borut@umontpellier.fr;FDS UFR INSTITUT ECOLE;4500112396;OptiPlex 790;Workstation;Dell;ECONOCOM;8CRMH5J;;01;36;02;36.204;2016-01-07;57M4HG12;UM000001;;;;;;;bessy;stefan;637459812;stefan.bessy@umontpellier.fr', 1, 'Entrée'),
(1, '8CRMH5J', '2016-02-12 00:00:00', '2020-04-29 17:42:58', ';;;;;;OptiPlex 790;Workstation;Dell;;8CRMH5J;01;36;02;36.204;01;6;00;6.02;;57M4HG12;UM000001;2020-04-29 17:42:58;Kern;Norbert;767253736;Norbert.Kern@umontpellier.fr;Kern;Norbert;767253736;Norbert.Kern@umontpellier.fr', 2, 'Modification'),
(1, '8CRMH5J', '2020-04-29 17:42:58', '2020-05-03 15:30:12', ';;;;;;optiplex;work;Dell;;8CRMH5J;01;6;00;6.02;;;57M4HG13;UM000002;;2020-05-03 15:30:12;;;;;Kern;Norbert;767253736;Norbert.Kern@umontpellier.fr', 3, 'Sortie'),
(1, 'FCRMH5J', '1900-01-01 00:00:00', '2020-04-25 15:43:51', 'Gall-Borut;Pascale;777072536;Pascale.Gall-Borut@umontpellier.fr;FDS UFR INSTITUT ECOLE;45001120212;OptiPlex 790;Workstation;Dell;ECONOCOM;FCRMH5J;;01;6;00;6.02;2017-04-24;10LFH472;UM004000;;;;;;;Rolland;Marc;754788911;Marc.Rolland@umontpellier.fr', 1, 'Entrée'),
(3, '11AZ45ER', '1900-01-01 00:00:00', '2020-04-30 13:07:09', 'Kern;Norbert;767253736;Norbert.Kern@umontpellier.fr;LIRMM RECHERCHE;4500112397;Optiplex;Workstation;Dell;ECONOCOM;11AZ45ER;;01;6;00;6.02;2019-09-08;NULL;NULL;;;;;;;Rolland;Marc;754788911;Marc.Rolland@umontpellier.fr', 1, 'Entrée'),
(3, '11AZ45ER', '2020-04-19 00:00:00', '2020-04-30 13:09:27', ';;;;;;Optiplex;Workstation;Dell;;11AZ45ER;01;6;00;6.02;;;NULL;NULL;NULL;2020-04-30 13:09:27;;;;;Rolland;Marc;754788911;Marc.Rolland@umontpellier.fr', 2, 'Sortie'),
(3, '87DF5RY1', '1900-01-01 00:00:00', '2020-05-07 03:54:55', 'Kern;Norbert;767253736;Norbert.Kern@umontpellier.fr;LIRMM RECHERCHE;4500112397;Optiplex;Workstation;Dell;ECONOCOM;87DF5RY1;;01;6;00;6.03;2019-09-08;NULL;NULL;;;;;;;Rolland;Marc;754788911;Marc.Rolland@umontpellier.fr', 1, 'Entrée'),
(4, '3DRMH5J', '1900-01-01 00:00:00', '2020-04-25 15:33:51', 'Kern;Norbert;767253736;Norbert.Kern@umontpellier.fr;LIRMM RECHERCHE;4500112017;OptiPlex 790;Workstation;Dell;ECONOCOM;3DRMH5J;;01;6;00;6.02;2017-12-04;89SQW032;UM005000;;;;;;;Rolland;Marc;754788911;Marc.Rolland@umontpellier.fr', 1, 'Entrée'),
(4, '3DRMH5J', '2019-05-15 00:00:00', '2020-04-30 12:57:30', ';;;;;;OptiPlex 790;Workstation;Dell;;3DRMH5J;01;6;00;6.02;01;6;00;6.03;;89SQW032;UM005000;2020-04-30 12:57:30;Gall-Borut;Pascale;777072536;Pascale.Gall-Borut@umontpellier.fr;Gall-Borut;Pascale;777072536;Pascale.Gall-Borut@umontpellier.fr', 2, 'Modification'),
(4, '3DRMH5J', '2020-04-30 12:57:30', '2020-04-30 12:58:04', ';;;;;;OptiPlex 790;Workstation;Dell;;3DRMH5J;01;6;00;6.03;01;6;00;6.03;;89SQW032;UM005000;2020-04-30 12:58:04;Gall-Borut;Pascale;777072536;Pascale.Gall-Borut@umontpellier.fr;Gall-Borut;Pascale;777072536;Pascale.Gall-Borut@umontpellier.fr', 3, 'Modification'),
(4, '4FRMH5J', '1900-01-01 00:00:00', '2020-04-25 10:43:51', 'Kern;Norbert;767253736;Norbert.Kern@umontpellier.fr;LIRMM RECHERCHE;4500112397;OptiPlex 790;Workstation;Dell;ECONOCOM;4FRMH5J;;01;6;00;6.03;2019-09-08;35D7PE45;UM004200;;;;;;;Rolland;Marc;754788911;Marc.Rolland@umontpellier.fr', 1, 'Entrée'),
(4, '4FRMH5J', '2020-02-12 00:00:00', '2020-05-03 15:35:48', ';;;;;;OptiPlex 790;Workstation;Dell;;4FRMH5J;01;6;00;6.03;;;35D7PE45;UM004200;commentaire ;2020-05-03 15:35:48;;;;;Gall-Borut;Pascale;777072536;Pascale.Gall-Borut@umontpellier.fr', 2, 'Sortie'),
(4, 'AZ12FG56', '1900-01-01 00:00:00', '2020-04-25 16:34:47', 'Rolland;Marc;754788911;Marc.Rolland@umontpellier.fr;LMGC RECHERCHE;NULL;Optiplex;Workstation;Dell;ECONOCOM;AZ12FG56;;01;36;02;36.204;2020-04-09;NULL;NULL;;;;;;;bessy;stefan;637459812;stefan.bessy@umontpellier.fr', 1, 'Entrée'),
(4, 'AZ12FG56', '2020-04-25 00:00:00', '2020-04-25 16:35:49', ';;;;;;Optiplex;Workstation;Dell;;AZ12FG56;01;36;02;36.204;01;6;00;6.02;;NULL;NULL;2020-04-25 16:35:49;Gall-Borut;Pascale;777072536;Pascale.Gall-Borut@umontpellier.fr;Gall-Borut;Pascale;777072536;Pascale.Gall-Borut@umontpellier.fr', 2, 'Modification'),
(4, 'AZ12FG56', '2020-04-25 16:35:49', '2020-04-25 16:40:18', ';;;;;;Optiplex;Workstation;Dell;;AZ12FG56;01;6;00;6.02;01;6;00;6.03;;NULL;NULL;2020-04-25 16:40:18;Gall-Borut;Pascale;777072536;Pascale.Gall-Borut@umontpellier.fr;Gall-Borut;Pascale;777072536;Pascale.Gall-Borut@umontpellier.fr', 3, 'Modification'),
(4, 'AZ12FG56', '2020-04-25 16:40:18', '2020-04-30 13:11:13', ';;;;;;Optiplex;Workstation;Dell;;AZ12FG56;01;6;00;6.03;;;NULL;NULL;NULL;2020-04-30 13:11:13;;;;;Gall-Borut;Pascale;777072536;Pascale.Gall-Borut@umontpellier.fr', 4, 'Sortie'),
(4, 'TGIJ542J3', '1900-01-01 00:00:00', '2020-05-03 18:19:03', 'Gall-Borut;Pascale;777072536;Pascale.Gall-Borut@umontpellier.fr;FDS UFR INSTITUT ECOLE;NULL;Optiplex 70;Workstation;Dell;Dell;TGIJ542J3;;01;36;02;36.204;2018-02-28;NULL;NULL;;;;;;;bessy;stefan;637459812;stefan.bessy@umontpellier.fr', 1, 'Entrée');

-- --------------------------------------------------------

--
-- Structure de la table `Lieu`
--

CREATE TABLE `Lieu` (
  `IdLieu` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `NumSalle` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `NomSalle` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NumBatiment` decimal(2,0) NOT NULL,
  `NomBatiment` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NumCampus` decimal(2,0) NOT NULL,
  `NomCampus` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NumNiveau` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `CapaciteTheorique` decimal(3,0) NOT NULL,
  `IdCR` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `Lieu`
--

INSERT INTO `Lieu` (`IdLieu`, `NumSalle`, `NomSalle`, `NumBatiment`, `NomBatiment`, `NumCampus`, `NomCampus`, `NumNiveau`, `CapaciteTheorique`, `IdCR`) VALUES
('01/36/02/36.204', '36.204', 'salle info', 36, 'bat 36', 1, 'Triolet', '02', 40, 4),
('01/6/00/6.02', '6.02', 'salle info', 6, 'bat 6', 1, 'Triolet', '00', 30, 4),
('01/6/00/6.03', '6.03', 'salle info', 6, 'bat 6', 1, 'Triolet', '00', 30, 4),
('02/04/01/27.4', '24.4', 'St Priest Bât. 4 (Halle Maore LIRMM)', 4, 'bat 4', 2, 'St Priest', '01', 50, 1);

--
-- Déclencheurs `Lieu`
--
DELIMITER $$
CREATE TRIGGER `before_insert_Lieu` BEFORE INSERT ON `Lieu` FOR EACH ROW BEGIN
  IF NEW.NumSalle IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le numero de la salle ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le numero de la salle ne doit pas être NULL';
    END IF;
IF NEW.NumBatiment IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le numero du batiment  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le numero du batiment ne doit pas être NULL';
    END IF;
IF NEW.NumCampus IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le numero du campus  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le numero du campus ne doit pas être NULL';
    END IF;
IF NEW.NumNiveau IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le numero d"étage(NumNiveau)  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le numero d"etage(NumNiveau) ne doit pas être NULL';
    END IF;

IF NEW.CapaciteTheorique IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : La capacité ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : La capacité ne doit pas être NULL';
    END IF;
    IF New.CapaciteTheorique < 0
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR : La capacité de passe ne doit pas être negative'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : La capacité de passe ne doit pas être negative';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_Lieu` BEFORE UPDATE ON `Lieu` FOR EACH ROW BEGIN
IF NEW.NumSalle IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le numero de la salle ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le numero de la salle ne doit pas être NULL';
    END IF;
IF NEW.NumBatiment IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le numero du batiment  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le numero du batiment ne doit pas être NULL';
    END IF;
IF NEW.NumCampus IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le numero du campus  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le numero du campus ne doit pas être NULL';
    END IF;
IF NEW.NumNiveau IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le numero d"étage(NumNiveau)  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le numero d"etage(NumNiveau) ne doit pas être NULL';
    END IF;
IF NEW.CapaciteTheorique IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : La capacité ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : La capacité ne doit pas être NULL';
    END IF;
    IF New.CapaciteTheorique < 0
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR : La capacité de passe ne doit pas être negative'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : La capacité de passe ne doit pas être negative';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `LOGERROR`
--

CREATE TABLE `LOGERROR` (
  `ID` int(11) NOT NULL,
  `MESSAGE` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Ordinateur`
--

CREATE TABLE `Ordinateur` (
  `NumSerie` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Typee` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Modele` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `NumImmobilisation` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fabricant` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `NumInventaire` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Etat` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Statut` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `detailSortieInventaire` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Remarque` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NbrAnneGarantie` decimal(2,0) NOT NULL DEFAULT 0,
  `dateDebutGestion` datetime NOT NULL,
  `IdCR` int(15) NOT NULL,
  `NumCommande` int(10) NOT NULL,
  `IdLieu` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `Ordinateur`
--

INSERT INTO `Ordinateur` (`NumSerie`, `Typee`, `Modele`, `NumImmobilisation`, `Fabricant`, `NumInventaire`, `Etat`, `Statut`, `detailSortieInventaire`, `Remarque`, `NbrAnneGarantie`, `dateDebutGestion`, `IdCR`, `NumCommande`, `IdLieu`) VALUES
('11AZ45ER', 'Workstation', 'Optiplex', NULL, 'Dell', NULL, 'Fonctionnel', 'Hors inventaire UM', NULL, NULL, 4, '2020-04-19 00:00:00', 3, 3, '01/6/00/6.02'),
('1FRMH5K', 'Workstation', 'OptiPlex 790', '57M4HG12', 'Dell', 'UM000001', 'Fonctionnel', 'Hors inventaire UM', NULL, NULL, 2, '2020-05-03 21:03:55', 1, 1, '01/6/00/6.02'),
('3DRMH5J', 'workstation', 'optiplex', '89SQW032', 'Dell', 'UM005000', 'En panne', 'Dans inventaire FDS', NULL, 'manque ', 5, '2020-04-30 12:58:04', 3, 4, '01/6/00/6.03'),
('4FRMH5J', 'Workstation', 'OptiPlex 790', '35D7PE45', 'Dell', 'UM004200', 'En panne', 'Hors inventaire UM', 'commentaire ', 'remarque', 2, '2020-02-12 00:00:00', 4, 3, '01/6/00/6.03'),
('87DF5RY1', 'Workstation', 'Optiplex', NULL, 'Dell', NULL, 'En reparation', 'Hors inventaire UM', NULL, NULL, 4, '2020-04-19 00:00:00', 3, 3, '01/6/00/6.03'),
('8CRMH5J', 'work', 'optiplex', '57M4HG13', 'Dell', 'UM000002', 'En panne', 'Hors inventaire UM', '', 'manque ', 5, '2020-04-29 17:42:58', 1, 1, '01/6/00/6.02'),
('AZ12FG56', 'Workstation', 'Optiplex', NULL, 'Dell', NULL, 'Fonctionnel', 'Hors inventaire UM', NULL, NULL, 3, '2020-04-25 16:40:18', 4, 36, '01/6/00/6.03'),
('FCRMH5J', 'work', 'OptiPlex 790', '10LFH472', 'Dell', 'UM004000', 'En panne', 'Dans inventaire FDS', NULL, 'manque ', 3, '2018-02-12 00:00:00', 1, 2, '01/6/00/6.02'),
('TGIJ542J3', 'Workstation', 'Optiplex 70', NULL, 'Dell', NULL, 'Fonctionnel', 'Dans inventaire FDS', NULL, NULL, 1, '2020-05-03 00:00:00', 4, 37, '01/36/02/36.204');

--
-- Déclencheurs `Ordinateur`
--
DELIMITER $$
CREATE TRIGGER `after_insert_Ordinateur` AFTER INSERT ON `Ordinateur` FOR EACH ROW BEGIN
DECLARE IdLieuNew,NumInv,NumImmo,nom,prenom,tel,mail,NomCR,typeStructure,sifac,fournisseur,nomResp,prenomResp,mailResp,telResp,dateGarantie VARCHAR(100);
SET NumInv=New.NumInventaire;
SET NumImmo=New.NumImmobilisation;
SET IdLieuNew=REPLACE(New.IdLieu,'/',';');

IF NumInv IS NULL
THEN SET NumInv='NULL';
END IF;
IF NumImmo IS NULL
THEN SET NumImmo='NULL';
END IF;

SELECT P1.Nom,P1.Prenom,P1.NumTelephone,P1.email,CentreResponsable.NomCR,CentreResponsable.typeStructure,Commande.IdCommandeSIFAC,Commande.Fournisseur,P2.Nom,P2.Prenom,P2.email,P2.NumTelephone,Commande.DateDebutGarantie INTO nom,prenom,tel,mail,NomCR,typeStructure,sifac,fournisseur,nomResp,prenomResp,mailResp,telResp,dateGarantie
FROM Personne P1,Personne P2,Commande,CentreResponsable,Gerer,Dirige
WHERE Gerer.IdPersonne=P2.IdPersonne AND Gerer.IdLieu=New.IdLieu AND Commande.NumCommande=New.NumCommande AND Commande.IdCR=CentreResponsable.IdCR AND Commande.IdCR=Dirige.IdCR AND P1.IdPersonne=Dirige.IdPersonne;

IF sifac IS NULL
THEN SET sifac='NULL';
END IF;
IF tel IS NULL
THEN SET tel='NULL';
END IF;
IF telResp IS NULL
THEN SET telResp='NULL';
END IF;


  	INSERT INTO Gere_Par_Hist(IdCR,NumSerie,dateDebutGestion,dateFinGestion,InfoFicheInventaire,compteurModification,typefiche) VALUES (New.IdCR,New.NumSerie,'1900-01-01',SYSDATE(),CONCAT(nom,';',prenom,';',tel,';',mail,';',NomCR,' ',typeStructure,';',sifac,';',New.Modele,';',New.Typee,';',New.Fabricant,';',fournisseur,';',New.NumSerie,';','',';',IdLieuNew,';',dateGarantie,';',NumImmo,';',NumInv,';','',';','',';','',';','',';','',';','',';',nomResp,';',prenomResp,';',telResp,';',mailResp),1,'Entrée'); 
    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_insert_Ordinateur` BEFORE INSERT ON `Ordinateur` FOR EACH ROW BEGIN

 IF New.Etat != 'En panne'
   AND New.Etat != 'Fonctionnel'
   AND New.Etat != 'En reparation'
      THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : L''etat doit être soit "En panne" ou "Fonctionnel" ou bien "En reparation"'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : L''etat doit être soit "En panne" ou "Fonctionnel" ou bien "En reparation"';
    END IF;
 IF New.Statut != 'Dans inventaire FDS'
   AND New.Statut != 'Hors FDS dans inventaire UM'
   AND New.Statut != 'Hors inventaire UM'
      THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le statut doit être soit "Dans inventaire FDS" ou "Hors FDS dans inventaire UM" ou bien "Hors inventaire UM"'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le statut doit être soit "Dans inventaire FDS" ou "Hors FDS dans inventaire UM" ou bien "Hors inventaire UM"';
    END IF;
   
    IF NEW.Modele IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le modele  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le modele ne doit pas être NULL';
    END IF;
IF NEW.Fabricant IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le fabricant  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le fabricant ne doit pas être NULL';
    END IF;
IF NEW.Typee IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le type  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le type ne doit pas être NULL';
    END IF;
IF NEW.Etat IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : L"etat de l"ordinateur ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : L"etat de l"ordinateur ne doit pas être NULL';
    END IF;
IF NEW.Statut IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le statut d"un ordinateur ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le statut d"un ordinateur ne doit pas être NULL';
    END IF;
IF NEW.dateDebutGestion IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR:La date debut gestion d"un ordinateur par un centre responsable ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR:La date debut gestion d"un ordinateur par un centre responsable ne doit pas être NULL';
    END IF;
    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_Ordinateur` BEFORE UPDATE ON `Ordinateur` FOR EACH ROW BEGIN
DECLARE CPT INTEGER;
DECLARE detailSortieInv,IdLieuNew,IdLieuOld,NumInv,NumImmo,nomAncien,prenomAncien,telAncien,mailAncien,nomNouveau,prenomNouveau,mailNouveau,telNouveau VARCHAR(100);

SET NumInv=New.NumInventaire;
SET NumImmo=New.NumImmobilisation;
SET IdLieuNew=REPLACE(New.IdLieu,'/',';');
SET IdLieuOld=REPLACE(Old.IdLieu,'/',';');
SET detailSortieInv=New.detailSortieInventaire;

IF NumInv IS NULL
THEN SET NumInv='NULL';
END IF;
IF NumImmo IS NULL
THEN SET NumImmo='NULL';
END IF;

IF telAncien IS NULL
THEN SET telAncien='NULL';
END IF;
IF telNouveau IS NULL
THEN SET telNouveau='NULL';
END IF;


IF New.IdCR <> Old.IdCR OR Old.IdLieu <> New.IdLieu
    THEN
    SET New.dateDebutGestion=SYSDATE();
    END IF;
IF New.IdCR <> Old.IdCR OR  Old.IdLieu <> New.IdLieu
THEN

SELECT P1.Nom,P1.Prenom,P1.NumTelephone,P1.email,P2.Nom,P2.Prenom,P2.email,P2.NumTelephone
INTO nomAncien,prenomAncien,telAncien,mailAncien,nomNouveau,prenomNouveau,mailNouveau,telNouveau 
FROM Personne P1,Personne P2,Dirige D1, Dirige D2
WHERE D1.IdCR=old.IdCR AND D1.IdPersonne=P1.IdPersonne AND D2.IdCR=old.IdCR AND  P2.IdPersonne=D2.IdPersonne ;

 SELECT compteurModification INTO CPT FROM Gere_Par_Hist WHERE Gere_Par_Hist.NumSerie=Old.NumSerie AND Gere_Par_Hist.compteurModification>=ALL(SELECT compteurModification FROM Gere_Par_Hist WHERE Gere_Par_Hist.NumSerie=Old.NumSerie);
         



	INSERT INTO Gere_Par_Hist(IdCR,NumSerie,dateDebutGestion,dateFinGestion,InfoFicheInventaire,compteurModification,typefiche) VALUES (Old.IdCR,Old.NumSerie,Old.DateDebutGestion,SYSDATE(),CONCAT("",';','',';','',';','',';','',';','',';',Old.Modele,';',Old.Typee,';',Old.Fabricant,';','',';',Old.NumSerie,';',IdLieuOld,';',IdLieuNew,';','',';',NumImmo,';',NumInv,';','',SYSDATE(),';',nomAncien,';',prenomAncien,';',telAncien,';',mailAncien,';',nomNouveau,';',prenomNouveau,';',telNouveau,';',mailNouveau),CPT+1,'Modification');

END IF;

 IF new.Etat != 'En panne'
   AND new.Etat != 'Fonctionnel'
   AND new.Etat != 'En reparation'
      THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : L''etat doit être soit "En panne" ou "Fonctionnel" ou bien "En reparation"'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : L''etat doit être soit "En panne" ou "Fonctionnel" ou bien "En reparation"';
    END IF;
 IF new.Statut != 'Dans inventaire FDS'
   AND new.Statut != 'Hors FDS dans inventaire UM'
   AND new.Statut != 'Hors inventaire UM'
      THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le statut doit être soit "Dans inventaire FDS" ou "Hors FDS dans inventaire UM" ou bien "Hors inventaire UM"'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le statut doit être soit "Dans inventaire FDS" ou "Hors FDS dans inventaire UM" ou bien "Hors inventaire UM"';
    END IF;
    IF NEW.Statut='Hors inventaire UM'
    THEN
SELECT P1.Nom,P1.Prenom,P1.email,P1.NumTelephone
INTO nomNouveau,prenomNouveau,mailNouveau,telNouveau 
FROM Personne P1,Dirige D1 
WHERE D1.IdCR=Old.IdCR AND D1.IdPersonne=P1.IdPersonne;
 SELECT compteurModification INTO CPT FROM Gere_Par_Hist WHERE Gere_Par_Hist.NumSerie=Old.NumSerie AND Gere_Par_Hist.compteurModification>=ALL(SELECT compteurModification FROM Gere_Par_Hist WHERE Gere_Par_Hist.NumSerie=Old.NumSerie);


IF detailSortieInv IS NULL
THEN SET detailSortieInv='NULL';
END IF;
 INSERT INTO Gere_Par_Hist(IdCR,NumSerie,dateDebutGestion,dateFinGestion,InfoFicheInventaire,compteurModification,typefiche) VALUES (Old.IdCR,Old.NumSerie,Old.DateDebutGestion,SYSDATE(),CONCAT("",';','',';','',';','',';','',';','',';',Old.Modele,';',Old.Typee,';',Old.Fabricant,';','',';',Old.NumSerie,';',IdLieuOld,';','',';','',';',NumImmo,';',NumInv,';',detailSortieInv,';',SYSDATE(),';','',';','',';','',';','',';',nomNouveau,';',prenomNouveau,';',telNouveau,';',mailNouveau),CPT+1,'Sortie');

END IF; 
IF NEW.Modele IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le modele  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le modele ne doit pas être NULL';
    END IF;
IF NEW.Fabricant IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le fabricant  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le fabricant ne doit pas être NULL';
    END IF;
IF NEW.Typee IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le type  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le type ne doit pas être NULL';
    END IF;
IF NEW.Etat IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : L"etat de l"ordinateur ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : L"etat de l"ordinateur ne doit pas être NULL';
    END IF;
IF NEW.Statut IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le statut d"un ordinateur ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le statut d"un ordinateur ne doit pas être NULL';
    END IF;
IF NEW.dateDebutGestion IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR:La date debut gestion d"un ordinateur par un centre responsable ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR:La date debut gestion d"un ordinateur par un centre responsable ne doit pas être NULL';
    END IF;
   
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `Personne`
--

CREATE TABLE `Personne` (
  `IdPersonne` int(10) NOT NULL,
  `Nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Prenom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NumTelephone` decimal(10,0) DEFAULT NULL,
  `Qualite` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `Personne`
--

INSERT INTO `Personne` (`IdPersonne`, `Nom`, `Prenom`, `email`, `NumTelephone`, `Qualite`) VALUES
(1, 'Rolland', 'Marc', 'Marc.Rolland@umontpellier.fr', 754788911, 'enseignant'),
(2, 'Kern', 'Norbert', 'Norbert.Kern@umontpellier.fr', 767253736, 'chercheur'),
(3, 'Gall-Borut', 'Pascale', 'Pascale.Gall-Borut@umontpellier.fr', 777072536, 'enseignant'),
(4, 'bessy', 'stefan', 'stefan.bessy@umontpellier.fr', 637459812, 'chercheur');

--
-- Déclencheurs `Personne`
--
DELIMITER $$
CREATE TRIGGER `before_insert_Personne` BEFORE INSERT ON `Personne` FOR EACH ROW BEGIN
    IF New.Nom IS NULL
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR : Le nom ne doit pas être NULL'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le nom ne doit pas être NULL';
    END IF;
    IF New.Prenom IS NULL
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR : Le prenom ne doit pas être NULL'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le prenom ne doit pas être NULL';
    END IF;
    IF NEW.email NOT REGEXP '^[A-Z0-9._%-]+@umontpellier.fr$'
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR : Votre email n"est pas valide , doit etre sous la forme "text@umontpellier.fr"'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Votre email n"est pas valide, doit etre sous la forme "text@umontpellier.fr"';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_Personne` BEFORE UPDATE ON `Personne` FOR EACH ROW BEGIN
    IF New.Nom IS NULL
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR : Le nom ne doit pas être NULL'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le nom ne doit pas être NULL';
    END IF;
     IF New.Prenom IS NULL
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR : Le prenom ne doit pas être NULL'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le prenom ne doit pas être NULL';
    END IF;
    IF NEW.email NOT REGEXP '^[A-Z0-9._%-]+@umontpellier.fr$'
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR :Votre email n"est pas valide,doit etre sous la forme "text@umontpellier.fr"'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Votre email n"est pas valide,doit etre sous la forme "text@umontpellier.fr"';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `nom_utilisateur` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mot_de_passe` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`nom_utilisateur`, `mot_de_passe`) VALUES
('admin', 'admin'),
('test', 'test1234');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `CentreResponsable`
--
ALTER TABLE `CentreResponsable`
  ADD PRIMARY KEY (`IdCR`);

--
-- Index pour la table `Commande`
--
ALTER TABLE `Commande`
  ADD PRIMARY KEY (`NumCommande`),
  ADD KEY `fk_Commande` (`IdCR`);

--
-- Index pour la table `Compte`
--
ALTER TABLE `Compte`
  ADD PRIMARY KEY (`Login`),
  ADD KEY `fk_Compte` (`IdPersonne`);

--
-- Index pour la table `Dirige`
--
ALTER TABLE `Dirige`
  ADD PRIMARY KEY (`IdPersonne`,`IdCR`),
  ADD KEY `fk2_Dirige` (`IdCR`);

--
-- Index pour la table `Gerer`
--
ALTER TABLE `Gerer`
  ADD PRIMARY KEY (`IdPersonne`,`IdLieu`),
  ADD KEY `fk2_Gerer` (`IdLieu`);

--
-- Index pour la table `Gere_Par_Hist`
--
ALTER TABLE `Gere_Par_Hist`
  ADD PRIMARY KEY (`IdCR`,`NumSerie`,`dateDebutGestion`);

--
-- Index pour la table `Lieu`
--
ALTER TABLE `Lieu`
  ADD PRIMARY KEY (`IdLieu`),
  ADD KEY `fk_Lieu` (`IdCR`);

--
-- Index pour la table `LOGERROR`
--
ALTER TABLE `LOGERROR`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `Ordinateur`
--
ALTER TABLE `Ordinateur`
  ADD PRIMARY KEY (`NumSerie`),
  ADD UNIQUE KEY `NumImmobilisation` (`NumImmobilisation`),
  ADD UNIQUE KEY `NumInventaire` (`NumInventaire`),
  ADD KEY `fk1_Ordinateur` (`IdCR`),
  ADD KEY `fk2_Ordinateur` (`IdLieu`),
  ADD KEY `fk3_Ordinateur` (`NumCommande`);

--
-- Index pour la table `Personne`
--
ALTER TABLE `Personne`
  ADD PRIMARY KEY (`IdPersonne`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `CentreResponsable`
--
ALTER TABLE `CentreResponsable`
  MODIFY `IdCR` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Commande`
--
ALTER TABLE `Commande`
  MODIFY `NumCommande` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `LOGERROR`
--
ALTER TABLE `LOGERROR`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Personne`
--
ALTER TABLE `Personne`
  MODIFY `IdPersonne` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Commande`
--
ALTER TABLE `Commande`
  ADD CONSTRAINT `fk_Commande` FOREIGN KEY (`IdCR`) REFERENCES `CentreResponsable` (`IdCR`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Compte`
--
ALTER TABLE `Compte`
  ADD CONSTRAINT `fk_Compte` FOREIGN KEY (`IdPersonne`) REFERENCES `Personne` (`IdPersonne`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Dirige`
--
ALTER TABLE `Dirige`
  ADD CONSTRAINT `fk1_Dirige` FOREIGN KEY (`IdPersonne`) REFERENCES `Personne` (`IdPersonne`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk2_Dirige` FOREIGN KEY (`IdCR`) REFERENCES `CentreResponsable` (`IdCR`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Gerer`
--
ALTER TABLE `Gerer`
  ADD CONSTRAINT `fk1_Gerer` FOREIGN KEY (`IdPersonne`) REFERENCES `Personne` (`IdPersonne`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk2_Gerer` FOREIGN KEY (`IdLieu`) REFERENCES `Lieu` (`IdLieu`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Lieu`
--
ALTER TABLE `Lieu`
  ADD CONSTRAINT `fk_Lieu` FOREIGN KEY (`IdCR`) REFERENCES `CentreResponsable` (`IdCR`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Ordinateur`
--
ALTER TABLE `Ordinateur`
  ADD CONSTRAINT `fk1_Ordinateur` FOREIGN KEY (`IdCR`) REFERENCES `CentreResponsable` (`IdCR`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk2_Ordinateur` FOREIGN KEY (`IdLieu`) REFERENCES `Lieu` (`IdLieu`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk3_Ordinateur` FOREIGN KEY (`NumCommande`) REFERENCES `Commande` (`NumCommande`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
