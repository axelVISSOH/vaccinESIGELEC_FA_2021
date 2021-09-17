-- phpMyAdmin SQL Dump
-- version 4.0.0
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 17 Septembre 2021 à 10:08
-- Version du serveur: 5.6.11-log
-- Version de PHP: 5.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `sitevaccin`
--

-- --------------------------------------------------------

--
-- Structure de la table `appointment_aptm`
--

CREATE TABLE IF NOT EXISTS `appointment_aptm` (
  `aptm_id` int(20) NOT NULL AUTO_INCREMENT,
  `aptm_nch_id` int(20) NOT NULL,
  `aptm_vst_mail` varchar(255) CHARACTER SET utf8 NOT NULL,
  `aptm_state` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`aptm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `certificate_crft`
--

CREATE TABLE IF NOT EXISTS `certificate_crft` (
  `crft_id` int(11) NOT NULL AUTO_INCREMENT,
  `crft_aptm_id` int(11) NOT NULL,
  `crft_nbdose` int(11) NOT NULL,
  PRIMARY KEY (`crft_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `demand_dmd`
--

CREATE TABLE IF NOT EXISTS `demand_dmd` (
  `dmd_id` int(20) NOT NULL AUTO_INCREMENT,
  `dmd_vst_mail` varchar(255) CHARACTER SET utf8 NOT NULL,
  `dmd_doc` varchar(255) CHARACTER SET utf8 NOT NULL,
  `dmd_date` date NOT NULL,
  `dmd_info` varchar(255) CHARACTER SET utf8 NOT NULL,
  `dmd_state` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`dmd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `niche_nch`
--

CREATE TABLE IF NOT EXISTS `niche_nch` (
  `nch_id` int(11) NOT NULL AUTO_INCREMENT,
  `nch_vst_mail` int(11) NOT NULL,
  `nch_hour` int(11) NOT NULL,
  `nch_date` date NOT NULL,
  `nch_vcn` varchar(255) NOT NULL,
  PRIMARY KEY (`nch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `vaccine_vcn`
--

CREATE TABLE IF NOT EXISTS `vaccine_vcn` (
  `vcn_id` int(20) NOT NULL AUTO_INCREMENT,
  `vcn_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vcn_nbdose` int(20) NOT NULL,
  `vcn_info` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`vcn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `visitor_vst`
--

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
