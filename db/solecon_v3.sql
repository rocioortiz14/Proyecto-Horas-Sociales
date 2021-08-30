-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 30-08-2021 a las 23:40:18
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
-- Estructura de tabla para la tabla `tbl_categorias`
--

DROP TABLE IF EXISTS `tbl_categorias`;
CREATE TABLE IF NOT EXISTS `tbl_categorias` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `c_desc` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `c_crear` datetime NOT NULL DEFAULT current_timestamp(),
  `c_actualizar` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla encargada de almacenar las categorias del producto';

--
-- Volcado de datos para la tabla `tbl_categorias`
--

INSERT INTO `tbl_categorias` (`c_id`, `c_nombre`, `c_desc`, `c_crear`, `c_actualizar`) VALUES
(2, '6666', 'asdasaadssdsd', '2021-08-30 17:26:25', '2021-08-30 17:29:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_permisos`
--

DROP TABLE IF EXISTS `tbl_permisos`;
CREATE TABLE IF NOT EXISTS `tbl_permisos` (
  `p_id` int(11) NOT NULL,
  `p_permiso` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `p_descripcion` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `p_crear` datetime NOT NULL DEFAULT current_timestamp(),
  `p_actualizar` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Esta tabla almacenara los permisos del sistema';

--
-- Volcado de datos para la tabla `tbl_permisos`
--

INSERT INTO `tbl_permisos` (`p_id`, `p_permiso`, `p_descripcion`, `p_crear`, `p_actualizar`) VALUES
(1, 'Administrador', 'Encargado de la administración del sistema.', '2021-08-25 15:18:23', '2021-08-25 15:18:23'),
(2, 'Gerente', 'Encargado de supervisar los procesos de ventas y compras de la empresa.', '2021-08-25 15:18:23', '2021-08-25 15:18:23'),
(3, 'Vendedor Rutero', 'Vendedor de ruta SM', '2021-08-25 16:01:07', '2021-08-25 16:30:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

DROP TABLE IF EXISTS `tbl_usuarios`;
CREATE TABLE IF NOT EXISTS `tbl_usuarios` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `u_usuario` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `u_contra` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `u_permiso` int(11) NOT NULL,
  `u_estado` int(11) NOT NULL DEFAULT 1,
  `u_empleado` int(11) NOT NULL DEFAULT 0,
  `u_crear` datetime NOT NULL DEFAULT current_timestamp(),
  `u_actualizar` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Esta tabla almacenara los usuarios del sistema';

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`u_id`, `u_nombre`, `u_usuario`, `u_contra`, `u_permiso`, `u_estado`, `u_empleado`, `u_crear`, `u_actualizar`) VALUES
(1, ' Gema Rocio Guadalupe Sanabria de Ochoa', '@rocio', '$2y$10$S/jGQ7vvW/juF2pQIe7NCuMpE9IyfDS5N/2vJFLaDlrihzyuB4Rii', 1, 1, 0, '2021-07-29 17:42:33', '2021-07-29 17:42:33');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
