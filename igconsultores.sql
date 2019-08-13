-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-08-2019 a las 02:03:49
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `igconsultores`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acreedor`
--

CREATE TABLE `acreedor` (
  `id` int(11) NOT NULL,
  `tipo_documento` varchar(5) NOT NULL,
  `documento` varchar(20) NOT NULL,
  `razon_social` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `acreedor`
--

INSERT INTO `acreedor` (`id`, `tipo_documento`, `documento`, `razon_social`) VALUES
(20, 'cc', '25520841', 'Ramon Sanchez Cartera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartera`
--

CREATE TABLE `cartera` (
  `id` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `id_acreedor` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cartera`
--

INSERT INTO `cartera` (`id`, `token`, `id_acreedor`, `fecha`) VALUES
(14, '7e752605-90ac-40fb-95a1-c5a4e2995465', 20, '2019-08-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartera_deudor_codeudor`
--

CREATE TABLE `cartera_deudor_codeudor` (
  `id` int(11) NOT NULL,
  `id_cartera` int(11) DEFAULT NULL,
  `id_deudor` int(11) DEFAULT NULL,
  `id_codeudor` int(11) DEFAULT NULL,
  `id_gestor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cartera_deudor_codeudor`
--

INSERT INTO `cartera_deudor_codeudor` (`id`, `id_cartera`, `id_deudor`, `id_codeudor`, `id_gestor`) VALUES
(10, 14, 8, NULL, 1),
(11, 14, 8, 5, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codeudor`
--

CREATE TABLE `codeudor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `tipodocumento` varchar(3) NOT NULL,
  `documento` varchar(15) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `codeudor`
--

INSERT INTO `codeudor` (`id`, `nombre`, `apellido`, `tipodocumento`, `documento`, `telefono`, `direccion`) VALUES
(5, 'Ramon', 'Codeudor', 'cc', '25520874', '04245024077', 'Mesa de Guanare');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deudor`
--

CREATE TABLE `deudor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `tipodocumento` varchar(3) NOT NULL,
  `documento` varchar(15) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `deudor`
--

INSERT INTO `deudor` (`id`, `nombre`, `apellido`, `tipodocumento`, `documento`, `telefono`, `direccion`) VALUES
(8, 'Ramon', 'Deudor', 'cc', '25520836', '04245024077', 'Mesa de Guanare');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_cartera`
--

CREATE TABLE `documentos_cartera` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `ruta` text NOT NULL,
  `id_cartera` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documentos_cartera`
--

INSERT INTO `documentos_cartera` (`id`, `nombre`, `ruta`, `id_cartera`) VALUES
(11, 'ceudla', '/igconsultores/media/c7e722f1c75a2e80.pdf', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `capital` varchar(30) NOT NULL,
  `interes` varchar(10) NOT NULL,
  `honorarios` varchar(10) NOT NULL,
  `gastos` varchar(10) NOT NULL,
  `descuento` varchar(30) NOT NULL,
  `sancion` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  `id_deudor` int(11) NOT NULL,
  `id_cartera` int(11) NOT NULL,
  `estado` int(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`id`, `titulo`, `capital`, `interes`, `honorarios`, `gastos`, `descuento`, `sancion`, `total`, `id_deudor`, `id_cartera`, `estado`) VALUES
(1, 'wefwef', '23', '23', '23%', '12%', '23', '20', '46.23', 8, 14, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion`
--

CREATE TABLE `gestion` (
  `id_gestion` int(11) NOT NULL,
  `gestion` int(11) NOT NULL,
  `fecha_gestion` int(11) NOT NULL,
  `monto_gestion` int(11) NOT NULL,
  `estado_gestion` int(11) NOT NULL,
  `recordatorio` int(11) NOT NULL,
  `id_ficha` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestor`
--

CREATE TABLE `gestor` (
  `id` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `identificacion` varchar(15) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gestor`
--

INSERT INTO `gestor` (`id`, `codigo`, `identificacion`, `nombre`, `apellido`) VALUES
(1, '65445y45y', '25520800', 'Ramon Grstor', 'Sanchez Gestor'),
(2, '132wefwe', '25520877', 'Ramon Gestor 1', 'Ramon Gestor 1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones_ficha`
--

CREATE TABLE `observaciones_ficha` (
  `id` int(11) NOT NULL,
  `id_ficha` int(11) NOT NULL,
  `observacion` varchar(350) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `observaciones_ficha`
--

INSERT INTO `observaciones_ficha` (`id`, `id_ficha`, `observacion`) VALUES
(1, 1, 'wefwef'),
(2, 1, 'wefwef');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_contabilidad`
--

CREATE TABLE `pagos_contabilidad` (
  `id_pagos` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `numero_recibo` varchar(30) NOT NULL,
  `valor` double NOT NULL,
  `id_gestion` int(11) NOT NULL,
  `estado_pago` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nivel` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `password`, `nivel`) VALUES
(1, 'jysa', '73a22c28d279ff107cf8ce992ebc3cada6623b6170b38271e6024ca4bd2029995c126b0e9e2004a5f1d11cf36ef01812413ea18e33105f608d752797107fa81a', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acreedor`
--
ALTER TABLE `acreedor`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `documento` (`documento`);

--
-- Indices de la tabla `cartera`
--
ALTER TABLE `cartera`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token_unique` (`token`);

--
-- Indices de la tabla `cartera_deudor_codeudor`
--
ALTER TABLE `cartera_deudor_codeudor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `codeudor`
--
ALTER TABLE `codeudor`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `documento` (`documento`);

--
-- Indices de la tabla `deudor`
--
ALTER TABLE `deudor`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `UNIQUE` (`documento`) USING BTREE;

--
-- Indices de la tabla `documentos_cartera`
--
ALTER TABLE `documentos_cartera`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD UNIQUE KEY `id_ficha` (`id`);

--
-- Indices de la tabla `gestion`
--
ALTER TABLE `gestion`
  ADD UNIQUE KEY `id_gestion` (`id_gestion`);

--
-- Indices de la tabla `gestor`
--
ALTER TABLE `gestor`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `observaciones_ficha`
--
ALTER TABLE `observaciones_ficha`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `unique` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acreedor`
--
ALTER TABLE `acreedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `cartera`
--
ALTER TABLE `cartera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `cartera_deudor_codeudor`
--
ALTER TABLE `cartera_deudor_codeudor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `codeudor`
--
ALTER TABLE `codeudor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `deudor`
--
ALTER TABLE `deudor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `documentos_cartera`
--
ALTER TABLE `documentos_cartera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `ficha`
--
ALTER TABLE `ficha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `gestion`
--
ALTER TABLE `gestion`
  MODIFY `id_gestion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gestor`
--
ALTER TABLE `gestor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `observaciones_ficha`
--
ALTER TABLE `observaciones_ficha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
