-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-10-2021 a las 06:18:12
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
-- Estructura de tabla para la tabla `tbl_categorias`
--

CREATE TABLE `tbl_categorias` (
  `c_id` int(11) NOT NULL,
  `c_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `c_desc` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `c_crear` datetime NOT NULL DEFAULT current_timestamp(),
  `c_actualizar` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla encargada de almacenar las categorias del producto';

--
-- Volcado de datos para la tabla `tbl_categorias`
--

INSERT INTO `tbl_categorias` (`c_id`, `c_nombre`, `c_desc`, `c_crear`, `c_actualizar`) VALUES
(2, 'OTRA CATEOGIRÍA', 'ASDASAADSSDSDADAS', '2021-08-30 17:26:25', '2021-10-10 21:38:52'),
(4, 'SI HAY CATEGORÍA', 'PERO SI HAY', '2021-10-10 21:38:37', '2021-10-10 21:38:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_clientes`
--

CREATE TABLE `tbl_clientes` (
  `cliente_Id` int(11) NOT NULL,
  `cliente_Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cliente_Apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cliente_Direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cliente_Telefono` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `cliente_Correo` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla encargada de almacenar los datos del cliente';

--
-- Volcado de datos para la tabla `tbl_clientes`
--

INSERT INTO `tbl_clientes` (`cliente_Id`, `cliente_Nombre`, `cliente_Apellido`, `cliente_Direccion`, `cliente_Telefono`, `cliente_Correo`) VALUES
(1, 'GEMA GUADALUPE', 'ORTIZ CRUZ', 'COL 9. DE NOVIEMBRE CALLE PRINCIPAL CASA #77', '7122-9456', 'gemaortiz@gmail.com'),
(4, 'ALGUIÉN', 'DFGFDFSGDS1ADÚ', 'DGDFGSDFGDFSGDSF1ÚUUU', '12312323', 'asdsadadssadds111a@live.c'),
(6, 'ERAESÚ', 'ADASDASDA', 'ASDADSDASDAS', '12312', 'asadasd121@live.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_empleados`
--

CREATE TABLE `tbl_empleados` (
  `e_id` int(11) NOT NULL,
  `e_codigo` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `e_nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `e_telefono` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `e_correo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `e_direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `e_cargo` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla encargada de almacenar la información de los empleados';

--
-- Volcado de datos para la tabla `tbl_empleados`
--

INSERT INTO `tbl_empleados` (`e_id`, `e_codigo`, `e_nombre`, `e_telefono`, `e_correo`, `e_direccion`, `e_cargo`) VALUES
(2, '789-12', 'GEMA ROCÍO ORTÍZ', '7489-8899', 'gemarocio_12@gmail.com', 'SANTIAGO DE MARIA, USULUTAN', 'ADMINISTRADOR DEL SISTEMA'),
(3, '780-13', 'JUAN PERÉZ', '7458-8998', 'juancito@live.com', 'SIN DIRECCION', 'VENDEDOR'),
(4, '781-14', 'ROBERTO GOMÉZ', '7458-8448', 'roberto_g@gmail.com', 'LOS ALAMOS, CALIFORNIA', 'GERENTE'),
(5, '782-16', 'RAÚL MAURICIO PORTILLO MUÑOZ', '7989-6680', 'raul-mauricio@live.com', 'SANTIAGO DE MARÍA, USULUTÁN, EL SALVADOR', 'ADMINISTRADOR DE SISTEMAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_empresa`
--

CREATE TABLE `tbl_empresa` (
  `identificador` int(11) NOT NULL,
  `e_nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `e_eslogan` text COLLATE utf8_spanish_ci NOT NULL,
  `e_telefonofijo1` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `e_telefonofijo2` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `e_movil1` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `e_movil2` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `e_direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `e_correo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `e_razonsocial` text COLLATE utf8_spanish_ci NOT NULL,
  `e_nrc` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `e_nit` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `e_logo` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_empresa`
--

INSERT INTO `tbl_empresa` (`identificador`, `e_nombre`, `e_eslogan`, `e_telefonofijo1`, `e_telefonofijo2`, `e_movil1`, `e_movil2`, `e_direccion`, `e_correo`, `e_razonsocial`, `e_nrc`, `e_nit`, `e_logo`) VALUES
(1, 'EMPRESA DEMO, NO SE SU NOMBRE 33 Y CON TÍLDE', 'HAS LA PAZ Y NO LA GUERRA X2', '2661-3333', '2663-3333', '7455-3333', '7566-3333', 'NO TENGO DIRECCIÓN PORQUE ES UNA EMPRESA FICTICIA 73', 'noname@outlook.com', 'PUES NO SABEMOS CUAL ES AHORA', '1-99-8899133', '101-187596-125-433', 'IMG-6163b8af4e81b7.42703230.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ip`
--

CREATE TABLE `tbl_ip` (
  `i_id` int(11) NOT NULL,
  `i_id_user` int(11) NOT NULL,
  `i_ip` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `i_crear` datetime NOT NULL DEFAULT current_timestamp(),
  `i_actualizar` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_ip`
--

INSERT INTO `tbl_ip` (`i_id`, `i_id_user`, `i_ip`, `i_crear`, `i_actualizar`) VALUES
(1, 1, '::1', '2021-10-08 08:42:36', '2021-10-08 08:43:20'),
(2, 1, '::1', '2021-10-08 08:43:41', '2021-10-08 09:24:54'),
(3, 1, '::1', '2021-10-08 09:25:03', '2021-10-08 09:25:24'),
(4, 1, '::1', '2021-10-08 09:25:33', '2021-10-08 09:26:16'),
(5, 1, '::1', '2021-10-08 09:26:25', '2021-10-08 21:55:41'),
(6, 1, '::1', '2021-10-10 18:42:38', '2021-10-10 18:42:38');

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
(1, 'SUPER ADMINISTRADOR', 'ENCARGADO DE LA ADMINISTRACIÓN DEL SISTEMA.', '2021-08-25 15:18:23', '2021-10-10 22:03:53'),
(2, 'GERENTE', 'ENCARGADO DE SUPERVISAR LOS PROCESOS DE VENTAS Y COMPRAS DE LA EMPRESA.', '2021-08-25 15:18:23', '2021-10-10 22:03:47'),
(3, 'VENDEDOR', 'VENDEDOR PUNTO DE VENTA', '2021-08-25 16:01:07', '2021-10-10 22:03:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_proveedores`
--

CREATE TABLE `tbl_proveedores` (
  `prv_id` int(11) NOT NULL,
  `prv_codigo` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `prv_nit` varchar(17) COLLATE utf8_spanish_ci NOT NULL,
  `prv_nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `prv_direccion` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `prv_telefono` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `prv_correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `prv_razonsocial` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla encargada de almacenar la información del proveedor';

--
-- Volcado de datos para la tabla `tbl_proveedores`
--

INSERT INTO `tbl_proveedores` (`prv_id`, `prv_codigo`, `prv_nit`, `prv_nombre`, `prv_direccion`, `prv_telefono`, `prv_correo`, `prv_razonsocial`) VALUES
(5, 'BD02', '1122-150970-103-5', 'BOQUITAS DIANA', 'SOYAPANGO', '2226-8945', 'sin correo', 'BOQUITAS'),
(4, 'ILC01', '1121-280569-101-3', 'INDUSTRIAS LA CONSTANCIA', 'SAN SALVADOR', '7125-9632', 'ilc64@gmail.coma', 'BEBIDAS');

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
(1, 'GEMA ROCÍO ORTÍZ', '@rocio', '$2y$10$8MQXKFN6wzDoxfJMu/sJj.Fl/y9TuzRlMeIaboxa6gdgDPpMiaioa', 1, 1, 2, '2021-07-29 17:42:33', '2021-07-29 17:42:33'),
(6, 'RAUL PORTILLO', '@ral16', '$2y$10$ewFLZzP/f9hYjgT/Ur4ykeHs1AGABuDj0uZ5A.HdbII1nLk.bKtPu', 1, 1, 5, '2021-10-10 21:29:16', '2021-10-10 21:29:16');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  ADD PRIMARY KEY (`c_id`);

--
-- Indices de la tabla `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  ADD PRIMARY KEY (`cliente_Id`);

--
-- Indices de la tabla `tbl_empleados`
--
ALTER TABLE `tbl_empleados`
  ADD PRIMARY KEY (`e_id`);

--
-- Indices de la tabla `tbl_empresa`
--
ALTER TABLE `tbl_empresa`
  ADD UNIQUE KEY `identificador` (`identificador`);

--
-- Indices de la tabla `tbl_ip`
--
ALTER TABLE `tbl_ip`
  ADD PRIMARY KEY (`i_id`);

--
-- Indices de la tabla `tbl_permisos`
--
ALTER TABLE `tbl_permisos`
  ADD PRIMARY KEY (`p_id`);

--
-- Indices de la tabla `tbl_proveedores`
--
ALTER TABLE `tbl_proveedores`
  ADD PRIMARY KEY (`prv_id`);

--
-- Indices de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  MODIFY `cliente_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_empleados`
--
ALTER TABLE `tbl_empleados`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_ip`
--
ALTER TABLE `tbl_ip`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_permisos`
--
ALTER TABLE `tbl_permisos`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_proveedores`
--
ALTER TABLE `tbl_proveedores`
  MODIFY `prv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
