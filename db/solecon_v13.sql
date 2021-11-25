-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2021 a las 05:01:51
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.25

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
(1, 'GRANOS BÁSICOS', 'PRODUCTO DE PRIMERA NECESIDAD', '2021-11-24 20:16:09', '2021-11-24 20:16:09'),
(2, 'LECHE EN POLVO', 'PRODUCTOS DE PRIMERA NECESIDAD', '2021-11-24 20:17:03', '2021-11-24 20:17:03');

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
(1, 'CLIENTES', 'VARIOS', 'SIN DIRECCIÓN', 'Sin teléf', 'infocliente@info.com'),
(2, 'MIGUEL MAURICIO', 'CABALLERO MONTERROSA', 'LOS ALAMOS, KANSAS', '74889966', 'caballerommm@gmail.com'),
(3, 'ELENA SARAÍ', 'GONZÁLEZ MORN', '9 CALLE, ARKANSAS', '74889966', 'elenagm@hotmail.com');

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
(1, '2021-11-24', 2, 'FACTURA', '000000C1', '1', '100.00', '200.00', '26.00', '226.00'),
(2, '2021-11-25', 1, 'FACTURA', '0000C2', '2', '20.00', '500.00', '65.00', '565.00'),
(3, '2021-11-25', 2, 'FACTURA', 'ARZ0001', '3', '24.00', '36.00', '0.00', '36.00');

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
(1, 1, 1, '100.00', '2.00', '4.00', '200.00'),
(2, 2, 2, '20.00', '25.00', '55.00', '500.00'),
(3, 3, 3, '12.00', '1.00', '2.00', '12.00'),
(4, 3, 4, '12.00', '2.00', '3.00', '24.00');

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
(1, 'EMPRESA DEMO, NO SE SU NOMBRE 33 Y CON TÍLDE 222', 'HAS LA PAZ Y NO LA GUERRA X2', '2661-3333', '2663-3333', '7455-3333', '7566-3333', 'NO TENGO DIRECCIÓN PORQUE ES UNA EMPRESA FICTICIA 73', 'noname@outlook.com', 'PUES NO SABEMOS CUAL ES AHORA', '1-99-8899133', '101-187596-125-433', 'IMG-61918a4aed2957.48188621.jpeg');

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
(1, 6, '::1', '2021-11-24 20:06:08', '2021-11-24 20:06:08');

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
(1, 'CAFE EL PADRINO', 'CAFE SABORIZADO CON VAINILLA', 1, '110.00', '2.00', '4.00', 'CF001', NULL, NULL, 5, 'IMG-619ef271af1b36.77352321.png'),
(2, 'CAFE EL MOROS', 'CAFE TOSTADO EN GRANO', 1, '20.00', '25.00', '55.00', 'CF002', NULL, NULL, 5, 'IMG-619ef2a5e066d3.97806458.png'),
(3, 'ARROZ SANTA MARIA', 'ARROZ PRECOCIDO', 1, '14.00', '1.00', '2.00', '14EEE', NULL, NULL, 4, 'IMG-619effd17370d1.86026163.jpg'),
(4, 'ARROZ SANTA MARIA', 'ARROZ BLANCO', 1, '24.00', '2.00', '3.00', '15EEE', NULL, NULL, 5, 'IMG-619f000f6ffc45.65124901.jpg');

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
(1, 'P0001', '12310785299101', 'SERPENZA GRANOS BASICOS S.A DE C.V.', 'SAN MIGUEL, SAN MIGUEL, 8 CALLE PONIENTE', '74123388', 'serpenza.info@gmail.com', 'GRANOS BÁSICOS'),
(2, 'P0002', '7891047896', 'SUM GRANOS BÁSICOS Y HORTALIZAS S.A. DE C.V.', 'USULUTÁN, 2 CALLE ORIENTE, JUNTO OCLEAND JEANS BOUTIQUE', '74125547', 'sum.info@outlook.com', 'GRANOS BÁSICOS Y HORTALIZAS');

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
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  MODIFY `cliente_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_compra`
--
ALTER TABLE `tbl_compra`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_compra_detalle`
--
ALTER TABLE `tbl_compra_detalle`
  MODIFY `cd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_empleados`
--
ALTER TABLE `tbl_empleados`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_ip`
--
ALTER TABLE `tbl_ip`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_permisos`
--
ALTER TABLE `tbl_permisos`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_proveedores`
--
ALTER TABLE `tbl_proveedores`
  MODIFY `prv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
