-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Temps de generació: 14-12-2018 a les 11:59:11
-- Versió del servidor: 5.7.24-0ubuntu0.18.04.1
-- Versió de PHP: 7.1.25-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `myweb`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `tbl_usuaris`
--

CREATE TABLE `tbl_usuaris` (
  `id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL,
  `tipusIdent` varchar(10) NOT NULL,
  `numeroIdent` varchar(15) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `cognoms` varchar(30) NOT NULL,
  `sexe` varchar(4) NOT NULL,
  `datanaixement` varchar(10) NOT NULL,
  `adreca` varchar(100) DEFAULT NULL,
  `codiPostal` varchar(5) DEFAULT NULL,
  `poblacio` varchar(40) DEFAULT NULL,
  `provincia` varchar(40) DEFAULT NULL,
  `telefon` int(9) DEFAULT NULL,
  `imatge` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT ' 0: pendent 1:confirmat 2:administradors',
  `navegador` varchar(50) NOT NULL,
  `plataforma` varchar(50) NOT NULL,
  `dataCreacio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dataDarrerAcces` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexos per taules bolcades
--

--
-- Index de la taula `tbl_usuaris`
--
ALTER TABLE `tbl_usuaris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `tbl_usuaris`
--
ALTER TABLE `tbl_usuaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
