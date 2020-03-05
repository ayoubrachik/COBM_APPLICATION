-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 02, 2020 at 07:54 AM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cobm`
--

-- --------------------------------------------------------

--
-- Table structure for table `abonnement`
--

CREATE TABLE `abonnement` (
  `ID` int(11) NOT NULL,
  `type_Abonnement` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `abonnement`
--

INSERT INTO `abonnement` (`ID`, `type_Abonnement`) VALUES
(1, 'Annuelle'),
(2, 'Semestrielle'),
(3, 'Trimestrielle');

-- --------------------------------------------------------

--
-- Table structure for table `activite`
--

CREATE TABLE `activite` (
  `id_activite` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `intitule` varchar(50) DEFAULT NULL,
  `montant` float DEFAULT NULL,
  `paiment` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `activite`
--

INSERT INTO `activite` (`id_activite`, `type`, `intitule`, `montant`, `paiment`) VALUES
(1, 'Ecole de Tennis', 'Mini tennis', 300, 'Mensuel'),
(2, 'Ecole de Tennis', 'Initiation', 300, 'Mensuel'),
(3, 'Ecole de Tennis', 'Espoir', 400, 'Mensuel'),
(4, 'Ecole de Tennis', 'Centre B', 500, 'Mensuel'),
(5, 'Ecole de Tennis', 'Elite', 650, 'Mensuel'),
(6, 'Ecole de Tennis', 'Licence fédérale', 400, 'Annuel'),
(7, 'Ecole de Equitation', 'Enfant', 250, 'Mensuel'),
(8, 'Ecole de Equitation', 'Adulte +18 ans', 400, 'Mensuel'),
(9, 'Ecole de Equitation', 'Assurance annuelle equitation', 220, 'Annuel'),
(10, 'Salle de sport', 'Aérobic et fitness', 150, 'Mensuel'),
(11, 'Ecole de football', 'Football', 100, 'Mensuel'),
(12, 'Salle de sport passager', 'Sauna', 150, 'Séance'),
(13, 'Ecole de Equitation passager', 'Passager non inscrit', 200, 'Mensuel'),
(14, 'Ecole de Equitation passager', 'Tournée Poney', 20, 'Séance'),
(15, 'Ecole de Equitation passager', 'Randonné adhérent', 200, 'Mensuel'),
(16, 'Ecole de Equitation passager', 'Randonné invité', 300, 'Séance'),
(17, 'Salle de sport passager', 'Piscine', 50, 'Séance'),
(18, 'Ecole de Equitation passager', 'Pension cheval', 1500, 'Mensuel');

-- --------------------------------------------------------

--
-- Table structure for table `adhesion`
--

CREATE TABLE `adhesion` (
  `CIN` varchar(50) NOT NULL,
  `ID_adhesion` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `date_adhesion` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `ID_pack` int(11) DEFAULT NULL,
  `ID_abonnement` int(11) DEFAULT NULL,
  `montant_avance` float DEFAULT NULL,
  `montant_recete` float DEFAULT NULL,
  `tele` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nbenfant` int(11) DEFAULT NULL,
  `mode_paiment` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `adhesion`
--

INSERT INTO `adhesion` (`CIN`, `ID_adhesion`, `nom`, `prenom`, `date_adhesion`, `date_fin`, `ID_pack`, `ID_abonnement`, `montant_avance`, `montant_recete`, `tele`, `email`, `nbenfant`, `mode_paiment`) VALUES
('0', 0, 'passager', 'passager', '0000-00-00', '0000-00-00', 4, 1, 0, 0, '', '', 0, ''),
('AK5454', 5, 'RACHIK', 'FATIMAO', '2000-06-23', '2001-06-23', 2, 1, 4500, 0, '0673392085', '', 2, 'Cheque'),
('HJ55554', 10, 'ASMAE', 'HAMID', '2021-01-01', '2022-01-01', 1, 1, 3500, 0, '0613595956', '', 0, 'Cheque'),
('HJ55554', 12, 'ASMAE', 'HAMID', '2021-01-01', '2022-01-01', 1, 1, 3500, 0, '0613595956', '', 0, 'Cheque'),
('I54541', 13, 'AYOUB', 'HAMID', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('I54541', 14, 'AYOUB', 'HAMID', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('I54541', 15, 'AYOUB', 'HAMID', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('I54541', 16, 'AYOUB', 'HAMID', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('I54541', 17, 'AYOUB', 'HAMID', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('I54541', 18, 'AYOUB', 'HAMID', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('I54541', 19, 'AYOUB', 'HAMID', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('I54541', 20, 'AYOUB', 'HAMID', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('I54541', 21, 'AYOUB', 'HAMID', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('I54541', 22, 'AYOUB', 'HAMID', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('I54541', 23, 'AYOUB', 'HAMID', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('I54541', 24, 'AYOUB', 'HAMID', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('I54541', 25, 'AYOUB', 'HAMID', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('I54541', 26, 'AYOUB', 'HAMID', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('I54541', 27, 'AYOUB', 'HAMID', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('I54541', 28, 'AYOUB', 'HAMID', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('I54541', 29, 'AYOUB', 'HAMID', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('I54541', 30, 'AYOUB', 'HAMID', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('I548748', 31, 'ASMAE', 'RACHIFO', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '00000000000', '', 0, 'Cheque'),
('I6545641', 32, 'ASMAE', 'AYOUB', '2021-01-01', '2022-01-01', 1, 1, 3500, 0, '00000000000', '', 0, 'Cheque'),
('S5454', 33, 'ASMAE', 'AYOUB', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('S5454', 34, 'ASMAE', 'AYOUB', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('S5454', 35, 'ASMAE', 'AYOUB', '2020-01-01', '2021-01-01', 1, 1, 3500, 0, '0610949237', '', 0, 'Cheque'),
('I548748', 36, 'AYOUB', 'AVEC', '2020-06-23', '2021-06-23', 2, 1, 5000, 0, '0610956895', '', 1, 'Cheque'),
('I548748', 37, 'AYOUB', 'AVEC', '2020-06-23', '2021-06-23', 2, 1, 5000, 0, '0610956895', '', 1, 'Cheque');

-- --------------------------------------------------------

--
-- Table structure for table `cotisation`
--

CREATE TABLE `cotisation` (
  `ID_cotisation` int(11) NOT NULL,
  `ID_adhesion` int(11) NOT NULL,
  `ID_lien` int(11) DEFAULT NULL,
  `ID_activite` int(11) DEFAULT NULL,
  `montant` float DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cotisation`
--

INSERT INTO `cotisation` (`ID_cotisation`, `ID_adhesion`, `ID_lien`, `ID_activite`, `montant`, `date_debut`, `date_fin`) VALUES
(30, 5, 2, 10, 150, '2020-06-23', '2020-07-23'),
(31, 5, 0, 6, 400, '1970-01-01', '1970-02-01'),
(32, 5, 0, 8, 400, '1970-01-01', '1970-02-01'),
(33, 5, 2, 10, 150, '1970-01-01', '1970-02-01'),
(34, 5, 0, 6, 400, '1970-01-01', '1970-02-01'),
(35, 5, 0, 8, 400, '1970-01-01', '1970-02-01'),
(36, 5, 2, 10, 150, '1970-01-01', '1970-02-01'),
(37, 5, 0, 2, 300, '1970-01-01', '1970-02-01'),
(38, 5, 0, 2, 300, '1970-01-01', '1970-02-01'),
(39, 5, 0, 2, 300, '1970-01-01', '1970-02-01'),
(40, 5, 0, 2, 300, '1970-01-01', '1970-02-01'),
(41, 5, 0, 5, 650, '1970-01-01', '1970-02-01'),
(42, 5, 0, 8, 400, '1970-01-01', '1970-02-01'),
(43, 5, 2, 10, 150, '1970-01-01', '1970-02-01'),
(44, 5, 3, 11, 100, '1970-01-01', '1970-02-01');

-- --------------------------------------------------------

--
-- Table structure for table `depense`
--

CREATE TABLE `depense` (
  `ID_depense` int(11) NOT NULL,
  `ID_type` int(11) DEFAULT NULL,
  `Mode_p` varchar(50) DEFAULT NULL,
  `num_cheque` varchar(50) DEFAULT NULL,
  `date_depense` date DEFAULT NULL,
  `montant` float DEFAULT NULL,
  `Description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `depense`
--

INSERT INTO `depense` (`ID_depense`, `ID_type`, `Mode_p`, `num_cheque`, `date_depense`, `montant`, `Description`) VALUES
(1, 3, 'Cheque', '7846', '2020-06-23', 250, 'zhygv nhfd htf vugv gjfyjv ');

-- --------------------------------------------------------

--
-- Table structure for table `lien`
--

CREATE TABLE `lien` (
  `ID_lien` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `ID_adhesion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lien`
--

INSERT INTO `lien` (`ID_lien`, `nom`, `prenom`, `type`, `date_naissance`, `ID_adhesion`) VALUES
(0, 'de famaille ', 'CHEF', 'chef', NULL, 0),
(2, 'SALIT', 'CHAIMA', 'époux', '0000-00-00', 5),
(3, 'RACHIK', 'ADAM', 'enfant', '2018-06-26', 5),
(11, 'passager', 'passager', 'passager', NULL, NULL),
(12, 'ASAAAA', 'HAMID', 'pére', '0000-00-00', 36),
(13, 'AYOUB', 'ANAS', 'enfant', '2000-06-23', 36),
(14, 'ASAAAA', 'HAMID', 'pére', '0000-00-00', 37),
(15, 'AYOUB', 'ANAS', 'enfant', '2000-06-23', 37);

-- --------------------------------------------------------

--
-- Table structure for table `packs`
--

CREATE TABLE `packs` (
  `ID` int(11) NOT NULL,
  `type_pack` varchar(50) DEFAULT NULL,
  `prix` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `packs`
--

INSERT INTO `packs` (`ID`, `type_pack`, `prix`) VALUES
(1, 'Particulier-Single', 3500),
(2, 'Particulier-Couple', 4000),
(3, 'Single avec enfants', 3500),
(4, 'Adherent honneur', 0),
(5, 'Pack A : (Fonctionnaire)', 1000),
(6, 'Pack B :  (Magistrat)', 2500),
(7, 'Pack C : (Agent autorité)', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `recette`
--

CREATE TABLE `recette` (
  `ID_recette` int(11) NOT NULL,
  `ID_type` int(50) DEFAULT NULL,
  `Mode_p` varchar(50) NOT NULL,
  `num_cheque` varchar(50) NOT NULL,
  `date_recette` date DEFAULT NULL,
  `montant` float DEFAULT NULL,
  `Description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `recette`
--

INSERT INTO `recette` (`ID_recette`, `ID_type`, `Mode_p`, `num_cheque`, `date_recette`, `montant`, `Description`) VALUES
(1, 7, '', '', '1970-01-01', 650, 'ACTIVITE : Ecole de Tennis : Elite NOM ET PRENOM : RACHIK FATIMAO'),
(2, 7, '', '', '1970-01-01', 400, 'ACTIVITE : Ecole de Equitation : Adulte +18 ans NOM ET PRENOM : RACHIK FATIMAO'),
(3, 6, 'Cheque', '', '2000-06-23', 3500, 'CIN : I54546 NOM ET PRENOM : RACHIK AYOUB'),
(4, 6, 'Cheque', '', '2000-06-23', 3500, 'CIN : I54546 NOM ET PRENOM : RACHIK AYOUB'),
(5, 6, 'Cheque', '', '2000-06-23', 3500, 'CIN : I54546 NOM ET PRENOM : RACHIK AYOUB'),
(6, 6, 'Cheque', '', '2021-01-01', 3500, 'CIN : HJ55554 NOM ET PRENOM : ASMAE HAMID'),
(7, 6, 'Cheque', '', '2021-01-01', 3500, 'CIN : HJ55554 NOM ET PRENOM : ASMAE HAMID'),
(8, 6, 'Cheque', '', '2021-01-01', 3500, 'CIN : HJ55554 NOM ET PRENOM : ASMAE HAMID'),
(9, 6, 'Cheque', '', '2021-01-01', 3500, 'CIN : HJ55554 NOM ET PRENOM : ASMAE HAMID'),
(10, 6, 'Cheque', '', '2021-01-01', 3500, 'CIN : HJ55554 NOM ET PRENOM : ASMAE HAMID'),
(11, 6, 'Cheque', '', '2021-01-01', 3500, 'CIN : HJ55554 NOM ET PRENOM : ASMAE HAMID'),
(12, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I54541 NOM ET PRENOM : AYOUB HAMID'),
(13, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I54541 NOM ET PRENOM : AYOUB HAMID'),
(14, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I54541 NOM ET PRENOM : AYOUB HAMID'),
(15, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I54541 NOM ET PRENOM : AYOUB HAMID'),
(16, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I54541 NOM ET PRENOM : AYOUB HAMID'),
(17, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I54541 NOM ET PRENOM : AYOUB HAMID'),
(18, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I54541 NOM ET PRENOM : AYOUB HAMID'),
(19, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I54541 NOM ET PRENOM : AYOUB HAMID'),
(20, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I54541 NOM ET PRENOM : AYOUB HAMID'),
(21, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I54541 NOM ET PRENOM : AYOUB HAMID'),
(22, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I54541 NOM ET PRENOM : AYOUB HAMID'),
(23, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I54541 NOM ET PRENOM : AYOUB HAMID'),
(24, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I54541 NOM ET PRENOM : AYOUB HAMID'),
(25, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I54541 NOM ET PRENOM : AYOUB HAMID'),
(26, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I54541 NOM ET PRENOM : AYOUB HAMID'),
(27, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I54541 NOM ET PRENOM : AYOUB HAMID'),
(28, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I54541 NOM ET PRENOM : AYOUB HAMID'),
(29, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I54541 NOM ET PRENOM : AYOUB HAMID'),
(30, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I54541 NOM ET PRENOM : AYOUB HAMID'),
(31, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I54541 NOM ET PRENOM : AYOUB HAMID'),
(32, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : I548748 NOM ET PRENOM : ASMAE RACHIFO'),
(33, 6, 'Cheque', '', '2021-01-01', 3500, 'CIN : I6545641 NOM ET PRENOM : ASMAE AYOUB'),
(34, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : S5454 NOM ET PRENOM : ASMAE AYOUB'),
(35, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : S5454 NOM ET PRENOM : ASMAE AYOUB'),
(36, 6, 'Cheque', '', '2020-01-01', 3500, 'CIN : S5454 NOM ET PRENOM : ASMAE AYOUB'),
(37, 6, 'Cheque', '', '2020-06-23', 5000, 'CIN : I548748 NOM ET PRENOM : AYOUB AVEC'),
(38, 6, 'Cheque', '', '2020-06-23', 5000, 'CIN : I548748 NOM ET PRENOM : AYOUB AVEC');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `recu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`recu_id`) VALUES
(57);

-- --------------------------------------------------------

--
-- Table structure for table `type_depense`
--

CREATE TABLE `type_depense` (
  `ID_type` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `type_depense`
--

INSERT INTO `type_depense` (`ID_type`, `type`) VALUES
(1, 'Salaires'),
(2, 'Indemnites'),
(3, 'Assurance'),
(4, 'CNSS'),
(5, 'Consommation Elec'),
(6, 'Carburant'),
(7, 'Fourniture bureau'),
(8, 'Réparations'),
(9, 'Tel flotte'),
(10, 'Tel Administration'),
(11, 'Droguerie'),
(12, 'Equipement'),
(13, 'Imprimerie'),
(14, 'Produit entretien'),
(15, 'Entretien piscine'),
(16, 'Tel residence'),
(17, 'Divers');

-- --------------------------------------------------------

--
-- Table structure for table `type_recette`
--

CREATE TABLE `type_recette` (
  `ID_type` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `type_recette`
--

INSERT INTO `type_recette` (`ID_type`, `type`) VALUES
(1, 'Loyer restaurant'),
(2, 'Loyer salle formation'),
(3, 'Tickets eclairage tennis'),
(4, 'Salle GYM'),
(5, 'Divers'),
(6, 'Adhesion'),
(7, 'Cotisation');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `passwordd` varchar(50) DEFAULT NULL,
  `permission` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `passwordd`, `permission`) VALUES
(1, 'admin', 'admin2020', 'admin'),
(2, 'root', 'ayoubgtavbm0610', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abonnement`
--
ALTER TABLE `abonnement`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `activite`
--
ALTER TABLE `activite`
  ADD PRIMARY KEY (`id_activite`);

--
-- Indexes for table `adhesion`
--
ALTER TABLE `adhesion`
  ADD PRIMARY KEY (`ID_adhesion`),
  ADD KEY `ID_pack` (`ID_pack`),
  ADD KEY `ID_abonnement` (`ID_abonnement`);

--
-- Indexes for table `cotisation`
--
ALTER TABLE `cotisation`
  ADD PRIMARY KEY (`ID_cotisation`),
  ADD KEY `fk_act` (`ID_activite`),
  ADD KEY `fk_lien` (`ID_lien`),
  ADD KEY `fk_adhession` (`ID_adhesion`);

--
-- Indexes for table `depense`
--
ALTER TABLE `depense`
  ADD PRIMARY KEY (`ID_depense`),
  ADD KEY `fk_idd` (`ID_type`);

--
-- Indexes for table `lien`
--
ALTER TABLE `lien`
  ADD PRIMARY KEY (`ID_lien`),
  ADD KEY `fk_chefff` (`ID_adhesion`);

--
-- Indexes for table `packs`
--
ALTER TABLE `packs`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `recette`
--
ALTER TABLE `recette`
  ADD PRIMARY KEY (`ID_recette`),
  ADD KEY `fk_id` (`ID_type`);

--
-- Indexes for table `type_depense`
--
ALTER TABLE `type_depense`
  ADD PRIMARY KEY (`ID_type`);

--
-- Indexes for table `type_recette`
--
ALTER TABLE `type_recette`
  ADD PRIMARY KEY (`ID_type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abonnement`
--
ALTER TABLE `abonnement`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `activite`
--
ALTER TABLE `activite`
  MODIFY `id_activite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `cotisation`
--
ALTER TABLE `cotisation`
  MODIFY `ID_cotisation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `depense`
--
ALTER TABLE `depense`
  MODIFY `ID_depense` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `packs`
--
ALTER TABLE `packs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `recette`
--
ALTER TABLE `recette`
  MODIFY `ID_recette` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `type_depense`
--
ALTER TABLE `type_depense`
  MODIFY `ID_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `type_recette`
--
ALTER TABLE `type_recette`
  MODIFY `ID_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adhesion`
--
ALTER TABLE `adhesion`
  ADD CONSTRAINT `adhesion_ibfk_1` FOREIGN KEY (`ID_pack`) REFERENCES `packs` (`ID`),
  ADD CONSTRAINT `adhesion_ibfk_2` FOREIGN KEY (`ID_abonnement`) REFERENCES `abonnement` (`ID`);

--
-- Constraints for table `cotisation`
--
ALTER TABLE `cotisation`
  ADD CONSTRAINT `fk_act` FOREIGN KEY (`ID_activite`) REFERENCES `activite` (`id_activite`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_adhession` FOREIGN KEY (`ID_adhesion`) REFERENCES `adhesion` (`ID_adhesion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_lien` FOREIGN KEY (`ID_lien`) REFERENCES `lien` (`ID_lien`) ON DELETE CASCADE;

--
-- Constraints for table `depense`
--
ALTER TABLE `depense`
  ADD CONSTRAINT `fk_idd` FOREIGN KEY (`ID_type`) REFERENCES `type_depense` (`ID_type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lien`
--
ALTER TABLE `lien`
  ADD CONSTRAINT `fk_chefff` FOREIGN KEY (`ID_adhesion`) REFERENCES `adhesion` (`ID_adhesion`) ON DELETE CASCADE;

--
-- Constraints for table `recette`
--
ALTER TABLE `recette`
  ADD CONSTRAINT `fk_id` FOREIGN KEY (`ID_type`) REFERENCES `type_recette` (`ID_type`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
