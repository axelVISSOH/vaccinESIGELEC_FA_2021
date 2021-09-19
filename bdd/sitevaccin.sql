-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 19 sep. 2021 à 12:46
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sitevaccin`
--

-- --------------------------------------------------------

--
-- Structure de la table `appointment_aptm`
--

DROP TABLE IF EXISTS `appointment_aptm`;
CREATE TABLE IF NOT EXISTS `appointment_aptm` (
  `aptm_id` int(20) NOT NULL AUTO_INCREMENT,
  `aptm_nch_id` int(20) NOT NULL,
  `aptm_vst_mail` varchar(255) CHARACTER SET utf8 NOT NULL,
  `aptm_state` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`aptm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `certificate_crft`
--

DROP TABLE IF EXISTS `certificate_crft`;
CREATE TABLE IF NOT EXISTS `certificate_crft` (
  `crft_id` int(11) NOT NULL AUTO_INCREMENT,
  `crft_aptm_id` int(11) NOT NULL,
  `crft_nbdose` int(11) NOT NULL,
  PRIMARY KEY (`crft_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `demand_dmd`
--

DROP TABLE IF EXISTS `demand_dmd`;
CREATE TABLE IF NOT EXISTS `demand_dmd` (
  `dmd_id` int(20) NOT NULL AUTO_INCREMENT,
  `dmd_vst_mail` varchar(255) CHARACTER SET utf8 NOT NULL,
  `dmd_doc` varchar(255) CHARACTER SET utf8 NOT NULL,
  `dmd_date` date NOT NULL,
  `dmd_info` varchar(255) CHARACTER SET utf8 NOT NULL,
  `dmd_state` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`dmd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `niche_nch`
--

DROP TABLE IF EXISTS `niche_nch`;
CREATE TABLE IF NOT EXISTS `niche_nch` (
  `nch_id` int(11) NOT NULL AUTO_INCREMENT,
  `nch_vst_mail` int(11) NOT NULL,
  `nch_hour` int(11) NOT NULL,
  `nch_date` date NOT NULL,
  `nch_vcn` varchar(255) NOT NULL,
  PRIMARY KEY (`nch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vaccine_vcn`
--

DROP TABLE IF EXISTS `vaccine_vcn`;
CREATE TABLE IF NOT EXISTS `vaccine_vcn` (
  `vcn_id` int(20) NOT NULL AUTO_INCREMENT,
  `vcn_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vcn_nbdose` int(20) NOT NULL,
  `vcn_info` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`vcn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `visitor_vst`
--

DROP TABLE IF EXISTS `visitor_vst`;
CREATE TABLE IF NOT EXISTS `visitor_vst` (
  `vst_mail` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vst_pass` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vst_phone` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vst_birthDate` date NOT NULL,
  `vst_type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vst_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vst_surname` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`vst_mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `visitor_vst`
--

INSERT INTO `visitor_vst` (`vst_mail`, `vst_pass`, `vst_phone`, `vst_birthDate`, `vst_type`, `vst_name`, `vst_surname`) VALUES
('axel@gmail.com', '$2y$10$/B1iej1NkvRCFNfNI7mTJeuuRf/adYUXNTquv6M80Mv9gEQHhnZZi', '075834', '2001-09-29', 'student', 'V', 'A'),
('axela@gmail.com', '$2y$10$edF5Mux4n0GgEpFPDyGiWOecEW6mDUjUCurbmKl5Ub3TES0Tv/HSq', '4325364', '2001-09-29', 'medecin', 'Axel VISSOH', 'SZA'),
('axelav@gmail.com', '$2y$10$J.a81UTQRjxLtxDQGwA8rO87QGWL/uft9dg8Z/EigY.m2H4DSd2Gm', '0758316040', '2001-09-29', 'student', 'Axel ', 'Axel'),
('axelva@gmail.com', '$2y$10$5dgazp.kAfWZyR45GcNQB.tZ4wMVHIf8jE1SjZNqTA74FwwJBB3zm', '923443298', '2001-09-29', 'student', 'Axel ', 'vv'),
('axelvis@gmail.com', '$2y$10$QM7pco2x1dQq5sFoEp33eu6WKqMuw7toENpw9ptC1d0asEmNRj4mu', '0758316040', '2001-09-29', 'student', 'VISSOH', 'Axel'),
('axelvissoh@gmail.com', 'baba', '0758316040', '2001-09-29', '', 'VISSOH', 'Axel');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
