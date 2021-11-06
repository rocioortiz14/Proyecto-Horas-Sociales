-- phpMyAdmin SQL Dump
-- version 4.9.7deb1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 06-11-2021 a las 02:52:53
-- Versión del servidor: 10.5.12-MariaDB-0ubuntu0.21.04.1
-- Versión de PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Estructura de tabla para la tabla `tbl_compra`
--

CREATE TABLE `tbl_compra` (
  `c_id` int(11) NOT NULL,
  `c_fecha` date NOT NULL,
  `c_proveedor` int(11) NOT NULL,
  `c_comprobante` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `c_serie` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `c_numero` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `c_qty` decimal(9,2) NOT NULL,
  `c_stot` decimal(9,2) NOT NULL,
  `c_iva` decimal(9,2) NOT NULL,
  `c_ttl` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_compra`
--

INSERT INTO `tbl_compra` (`c_id`, `c_fecha`, `c_proveedor`, `c_comprobante`, `c_serie`, `c_numero`, `c_qty`, `c_stot`, `c_iva`, `c_ttl`) VALUES
(2, '2021-11-11', 4, 'FACTURA', 'DEA556', '8859', '60.00', '2500.00', '325.00', '2825.00'),
(8, '2021-11-11', 5, 'FACTURA', 'ASS56', '56', '6.00', '90.00', '11.70', '101.70');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_compra_detalle`
--

CREATE TABLE `tbl_compra_detalle` (
  `cd_id` int(11) NOT NULL,
  `cd_compra` int(11) NOT NULL,
  `cd_producto` int(11) NOT NULL,
  `cd_qty` decimal(9,2) NOT NULL,
  `cd_pc` decimal(9,2) NOT NULL,
  `cd_pv` decimal(9,2) NOT NULL,
  `cd_stot` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_compra_detalle`
--

INSERT INTO `tbl_compra_detalle` (`cd_id`, `cd_compra`, `cd_producto`, `cd_qty`, `cd_pc`, `cd_pv`, `cd_stot`) VALUES
(2, 2, 4, '20.00', '25.00', '30.00', '500.00'),
(3, 2, 5, '15.00', '40.00', '55.00', '600.00'),
(4, 2, 6, '25.00', '56.00', '68.00', '1400.00'),
(10, 8, 4, '6.00', '15.00', '25.00', '90.00');

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
(1, 'EMPRESA DEMO, NO SE SU NOMBRE 33 Y CON TÍLDE 222', 'HAS LA PAZ Y NO LA GUERRA X2', '2661-3333', '2663-3333', '7455-3333', '7566-3333', 'NO TENGO DIRECCIÓN PORQUE ES UNA EMPRESA FICTICIA 73', 'noname@outlook.com', 'PUES NO SABEMOS CUAL ES AHORA', '1-99-8899133', '101-187596-125-433', 'IMG-61861d5023ea86.79078396.png');

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
(6, 1, '::1', '2021-10-10 18:42:38', '2021-10-10 22:25:00'),
(7, 1, '::1', '2021-10-10 22:25:16', '2021-10-10 22:25:26'),
(8, 6, '::1', '2021-10-10 22:25:39', '2021-10-10 22:26:34'),
(9, 6, '::1', '2021-10-11 14:29:07', '2021-10-11 21:39:02'),
(10, 6, '::1', '2021-10-12 14:05:23', '2021-10-12 14:05:23'),
(11, 6, '::1', '2021-10-19 19:26:17', '2021-10-19 19:38:06'),
(12, 6, '::1', '2021-10-19 19:38:14', '2021-10-19 19:38:14'),
(13, 6, '::1', '2021-10-20 11:39:00', '2021-10-20 18:34:36'),
(14, 1, '::1', '2021-10-30 16:42:41', '2021-10-30 16:42:41'),
(15, 6, '::1', '2021-11-03 21:05:02', '2021-11-03 21:05:02'),
(16, 6, '127.0.0.1', '2021-11-04 19:06:29', '2021-11-04 19:06:29'),
(17, 6, '127.0.0.1', '2021-11-04 20:10:43', '2021-11-04 20:10:43'),
(18, 6, '127.0.0.1', '2021-11-04 22:02:23', '2021-11-04 22:02:23'),
(19, 6, '127.0.0.1', '2021-11-05 09:54:53', '2021-11-05 09:54:53'),
(20, 6, '127.0.0.1', '2021-11-05 21:01:53', '2021-11-05 21:01:53'),
(21, 6, '192.168.1.120', '2021-11-05 21:04:05', '2021-11-05 21:04:05'),
(22, 1, '127.0.0.1', '2021-11-05 22:57:07', '2021-11-05 23:06:49'),
(23, 6, '127.0.0.1', '2021-11-05 23:07:20', '2021-11-05 23:07:59'),
(24, 1, '127.0.0.1', '2021-11-05 23:09:21', '2021-11-05 23:10:37'),
(25, 1, '127.0.0.1', '2021-11-05 23:15:46', '2021-11-05 23:15:46'),
(26, 1, '127.0.0.1', '2021-11-06 00:13:27', '2021-11-06 00:13:27');

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
-- Estructura de tabla para la tabla `tbl_productos`
--

CREATE TABLE `tbl_productos` (
  `p_id` int(11) NOT NULL,
  `p_producto` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `p_desc` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `p_categoria` int(11) NOT NULL,
  `p_stock` decimal(9,2) NOT NULL,
  `p_pc` decimal(9,2) NOT NULL,
  `p_pv` decimal(9,2) NOT NULL,
  `p_codigo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `p_perecedero` tinyint(4) DEFAULT NULL,
  `p_perecedero_p` date DEFAULT NULL,
  `p_presentacion` int(11) NOT NULL,
  `p_imagen` varchar(250) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_productos`
--

INSERT INTO `tbl_productos` (`p_id`, `p_producto`, `p_desc`, `p_categoria`, `p_stock`, `p_pc`, `p_pv`, `p_codigo`, `p_perecedero`, `p_perecedero_p`, `p_presentacion`, `p_imagen`) VALUES
(4, 'MAIZ QUEBRADO', ' MAIZ EN QUINTAL QUEBRADO', 2, '66.00', '15.00', '25.00', 'MQ001', NULL, NULL, 7, 'IMG-618607a7d95229.50993607.jpg'),
(5, 'FRIJOL ROJO DE SEDA', 'FRIJOL DE SEDA EN QUINTALES', 4, '95.00', '0.00', '0.00', 'FRQ001', NULL, NULL, 7, 'IMG-61860818ecec43.57459652.jpg'),
(6, 'FRIJOL BLANCO', 'QUINTALES S', 4, '81.00', '0.00', '0.00', '055Z', NULL, NULL, 7, 'IMG-61860887e82f49.28522612.jpg');

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
(6, 'RAÚL PORTILLO', '@ral16', '$2y$10$Sfdc/W6FX76U/DfSiHRfK.ObttXjNi0LFLAEy7g/RbM7ER1.2Rhiq', 1, 1, 5, '2021-10-10 21:29:16', '2021-10-10 21:29:16');

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
-- Indices de la tabla `tbl_compra`
--
ALTER TABLE `tbl_compra`
  ADD PRIMARY KEY (`c_id`);

--
-- Indices de la tabla `tbl_compra_detalle`
--
ALTER TABLE `tbl_compra_detalle`
  ADD PRIMARY KEY (`cd_id`);

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
-- Indices de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
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
-- AUTO_INCREMENT de la tabla `tbl_compra`
--
ALTER TABLE `tbl_compra`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tbl_compra_detalle`
--
ALTER TABLE `tbl_compra_detalle`
  MODIFY `cd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tbl_empleados`
--
ALTER TABLE `tbl_empleados`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_ip`
--
ALTER TABLE `tbl_ip`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `tbl_permisos`
--
ALTER TABLE `tbl_permisos`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
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
