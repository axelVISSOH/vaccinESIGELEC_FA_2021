-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 26 sep. 2021 à 18:44
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
  `aptm_hour` varchar(255) NOT NULL,
  PRIMARY KEY (`aptm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `appointment_aptm`
--

INSERT INTO `appointment_aptm` (`aptm_id`, `aptm_nch_id`, `aptm_vst_mail`, `aptm_state`, `aptm_hour`) VALUES
(1, 1, 'axelav@gmail.com', 'Waiting', ''),
(7, 4, 'axelav@gmail.com', 'Waiting', ''),
(9, 2, 'zozo@zozo.com', 'Past', ''),
(17, 7, 'zozo@zozo.com', 'Past', ''),
(18, 7, 'axelva@gmail.com', 'Waiting', ''),
(20, 2, 'axelva@gmail.com', 'Waiting', ''),
(21, 6, 'axelva@gmail.com', 'Waiting', ''),
(23, 11, 'peacegdn@gmail.com', 'Past', ''),
(26, 7, 'peacegdn@gmail.com', 'Past', ''),
(30, 10, 'peacegdn@gmail.com', 'Past', '12:0:12:15'),
(31, 12, 'peacegdn@gmail.com', 'Past', '13:0:13:15');

-- --------------------------------------------------------

--
-- Structure de la table `certificate_crft`
--

DROP TABLE IF EXISTS `certificate_crft`;
CREATE TABLE IF NOT EXISTS `certificate_crft` (
  `crft_id` int(11) NOT NULL AUTO_INCREMENT,
  `crft_aptm_id` int(11) NOT NULL,
  `crft_path` varchar(255) NOT NULL,
  PRIMARY KEY (`crft_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `certificate_crft`
--

INSERT INTO `certificate_crft` (`crft_id`, `crft_aptm_id`, `crft_path`) VALUES
(1, 9, 'zozo@zozo.com_certificate.pdf');

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
  `nch_vst_mail` varchar(255) NOT NULL,
  `nch_hour` varchar(255) NOT NULL,
  `nch_date` date NOT NULL,
  `nch_vcn` varchar(255) NOT NULL,
  PRIMARY KEY (`nch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `niche_nch`
--

INSERT INTO `niche_nch` (`nch_id`, `nch_vst_mail`, `nch_hour`, `nch_date`, `nch_vcn`) VALUES
(2, 'axela@gmail.com', '8:35:13:15', '2021-09-22', 'AstraZeneca'),
(5, 'axela@gmail.com', '1:32:0:3', '2021-09-25', 'Moderna'),
(8, 'axela@gmail.com', '08:30:12:00', '2021-09-29', 'AstraZeneca'),
(9, 'axela@gmail.com', '12:0:14:0', '2021-10-02', 'AstraZeneca'),
(10, 'axela@gmail.com', '12:15:15:0', '2021-10-03', 'Moderna'),
(12, 'peace2gdn@gmail.com', '13:15:14:0', '2021-09-30', 'AstraZeneca'),
(13, 'peace2gdn@gmail.com', '13:00:15:30', '2021-10-14', 'Moderna');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vaccine_vcn`
--

INSERT INTO `vaccine_vcn` (`vcn_id`, `vcn_name`, `vcn_nbdose`, `vcn_info`) VALUES
(1, 'BioNTech-Pfizer', 2, 'Injection dans l’organisme des molécules d’« ARN messager », fabriqué en laboratoire.'),
(2, 'Moderna', 2, 'Injection dans l’organisme des molécules d’« ARN messager », fabriqué en laboratoire.'),
(3, 'AstraZeneca', 2, 'Un « vecteur viral non réplicatif » : un virus inoffensif qui ne peut se reproduire dans les cellules est utilisé pour transporter le matériel génétique du coronavirus, fabriquant la protéine qui enclenchera une réponse immunitaire.');

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
('axelav@gmail.com', '$2y$10$J.a81UTQRjxLtxDQGwA8rO87QGWL/uft9dg8Z/EigY.m2H4DSd2Gm', '0758316040', '2001-09-29', 'medecin', 'Axel ', 'Axel'),
('axels@gmail.com', '$2y$10$zBb7vZVObojaoQsT0fpmiOdQmFOuel.6ar7CbyAuzTOdghr2IZLYm', '2354675', '2001-05-20', 'student', 'Axel ', 'ezf'),
('axelva@gmail.com', '$2y$10$5dgazp.kAfWZyR45GcNQB.tZ4wMVHIf8jE1SjZNqTA74FwwJBB3zm', '923443298', '2001-09-29', 'student', 'Axel ', 'vv'),
('axelvis@gmail.com', '$2y$10$QM7pco2x1dQq5sFoEp33eu6WKqMuw7toENpw9ptC1d0asEmNRj4mu', '0758316040', '2001-09-29', 'student', 'VISSOH', 'Axel'),
('axelvissoh@gmail.com', 'baba', '0758316040', '2001-09-29', '', 'VISSOH', 'Axel'),
('axje@visho.org', '$2y$10$I9C2Oi2o0xSgCVX9WRbECeOs8EjeR/ROvi/p51zab4upyjstl6vHa', '62927452', '2000-08-29', 'admin', 'axje', 'visho'),
('ea@eaa.com', '$2y$10$j4FV91BQz7BrVgksruvFAev7P.B1xRAezbpZgXrIG4pofBYz3O/tC', '12 88 77 22 40', '2021-09-01', 'student', 'ea', 'eaa'),
('jed@hous.fr', '$2y$10$fiS8lNMUUTlkVayEDq7ti.jNLUAi8XBSHAzBjU.jEjOtTVt6Ere5i', '13342112', '2000-08-02', 'student', 'HOUNS', 'jed'),
('jj@jjo.com', '$2y$10$BQQ1FT1onG8aX59HpWZcBeFEL2m/q4423O9Zy8Tq9KJBtGxeduROa', '07-31-31-31-31', '2021-09-08', 'student', 'jj', 'jjo'),
('peace2gdn@gmail.com', '$2y$10$8MpPKPdr1l2CKO1xQPyFme9xGu6/PzEeoTBlAkTCvKnPuNuMAsjTO', '07-31-31-30-30', '2009-09-06', 'medecin', 'GDN', 'peace2'),
('peacegdn@gmail.com', '$2y$10$.WHj2e3g.La8oIFkDRzoa.0RCc2nukfaLFnKSfU706MBRuTZ/8O5y', '09-09-46-34-78', '2001-09-18', 'student', 'GDN', 'peace1'),
('zozo@zozo.com', '$2y$10$6pJTgR/TX7vDgutokmyo.OGt1CZOcYFM4NAbbLalnnX1a6/pGUue2', '123444', '2001-12-05', 'student', 'zozor', 'zozozo'),
('zozo@zozo1.com', '$2y$10$eprPj3S1FzOBuMNXVZYL8u2MhsVulk4Z9JEqcuz8KvCVmoYS5Zp4y', '123333', '2000-09-15', 'medecin', 'zozo1', 'zozo'),
('zozo@zozo2.com', '$2y$10$r.7Rp.sRT8D0e3ZvU3RL6eJttktk.Q3rpKoSpVSybUeosUECyBNzO', 'd  d hdsc', '2010-08-03', 'medecin', 'zozo2', 'zozo'),
('zozo@zozo3.com', '$2y$10$lkAdN8/RnVS7MZWUqIfIcetAt5Sa7R.t1qZwXs23A5zwEZRSeCxmm', '2134543', '1999-08-22', 'student', 'zozo3', 'zozo'),
('zz@zza.com', '$2y$10$6EQrabYeHUFTn0gF8yhzOuDSgM9jv5rD5ubJHsWD6m0IuFrpPgmxS', 'esdfssf', '2008-07-13', 'student', 'zz', 'zza');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
