-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 27-09-2021 a las 03:10:00
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_solecon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_empresa`
--

DROP TABLE IF EXISTS `tbl_empresa`;
CREATE TABLE IF NOT EXISTS `tbl_empresa` (
  `e_nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `e_eslogan` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `e_telefonofijo1` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `e_telefonofijo2` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `e_movil1` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `e_movil2` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `e_direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `e_correo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `e_razonsocial` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `e_nrc` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `e_nit` varchar(17) COLLATE utf8_spanish_ci NOT NULL,
  `e_logo` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
