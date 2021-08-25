-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-08-2021 a las 00:39:23
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `solecon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_permisos`
--

CREATE TABLE `tbl_permisos` (
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

CREATE TABLE `tbl_usuarios` (
  `u_id` int(11) NOT NULL,
  `u_nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `u_usuario` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `u_contra` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `u_permiso` int(11) NOT NULL,
  `u_estado` int(11) NOT NULL DEFAULT 1,
  `u_empleado` int(11) NOT NULL DEFAULT 0,
  `u_crear` datetime NOT NULL DEFAULT current_timestamp(),
  `u_actualizar` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Esta tabla almacenara los usuarios del sistema';

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`u_id`, `u_nombre`, `u_usuario`, `u_contra`, `u_permiso`, `u_estado`, `u_empleado`, `u_crear`, `u_actualizar`) VALUES
(1, ' Gema Rocio Guadalupe Sanabria de Ochoa', '@rocio', '$2y$10$S/jGQ7vvW/juF2pQIe7NCuMpE9IyfDS5N/2vJFLaDlrihzyuB4Rii', 1, 1, 0, '2021-07-29 17:42:33', '2021-07-29 17:42:33');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_permisos`
--
ALTER TABLE `tbl_permisos`
  ADD PRIMARY KEY (`p_id`);

--
-- Indices de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_permisos`
--
ALTER TABLE `tbl_permisos`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
