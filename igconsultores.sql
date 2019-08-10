-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 11-08-2019 a las 00:08:12
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
(10, 'CC', '25520841', 'Ramon Sanchez');

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
(1, '48d7545d-bba5-11e9-94ce-7a04b3ab7f73', 10, '2019-08-01'),
(2, '102ac020-bbaf-11e9-94ce-7a04b3ab7f73', 10, '2019-08-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codeudor`
--

CREATE TABLE `codeudor` (
  `id_codeudor` int(11) NOT NULL,
  `nombre_codeudor` varchar(30) NOT NULL,
  `apellido_codeudor` varchar(30) NOT NULL,
  `tipodocumento_codeudor` varchar(30) NOT NULL,
  `documento_codeudor` varchar(30) NOT NULL,
  `telefono_codeudor` varchar(15) NOT NULL,
  `direccion_codeudor` varchar(100) NOT NULL,
  `id_deudor` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deudor`
--

CREATE TABLE `deudor` (
  `id_deudor` int(11) NOT NULL,
  `id_acreedor` int(11) NOT NULL,
  `nombre_deudor` varchar(30) NOT NULL,
  `apellido_deudor` varchar(30) NOT NULL,
  `tipodocumento_deudor` varchar(30) NOT NULL,
  `documento_deudor` varchar(30) NOT NULL,
  `telefono_deudor` varchar(15) NOT NULL,
  `direccion_deudor` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(1, 'nose', 'qwqwwqdqwd', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `id_ficha` int(11) NOT NULL,
  `titulo_ficha` varchar(100) NOT NULL,
  `capital_ficha` varchar(30) NOT NULL,
  `interes` varchar(10) NOT NULL,
  `honorarios` varchar(10) NOT NULL,
  `gastos` varchar(10) NOT NULL,
  `descuento` varchar(30) NOT NULL,
  `sancion` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  `id_deudor` int(11) NOT NULL,
  `estado` int(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `id_gestor` int(11) NOT NULL,
  `codigo_gestor` varchar(10) NOT NULL,
  `identificacion_gestor` varchar(15) NOT NULL,
  `nombre_gestor` varchar(10) NOT NULL,
  `apellido_gestor` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones_ficha`
--

CREATE TABLE `observaciones_ficha` (
  `id_observacion` int(11) NOT NULL,
  `id_ficha` int(11) NOT NULL,
  `observacion` varchar(350) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `cartera`
--
ALTER TABLE `cartera`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `codeudor`
--
ALTER TABLE `codeudor`
  ADD UNIQUE KEY `id_codeudor` (`id_codeudor`);

--
-- Indices de la tabla `deudor`
--
ALTER TABLE `deudor`
  ADD UNIQUE KEY `id_deudor` (`id_deudor`);

--
-- Indices de la tabla `documentos_cartera`
--
ALTER TABLE `documentos_cartera`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD UNIQUE KEY `id_ficha` (`id_ficha`);

--
-- Indices de la tabla `gestion`
--
ALTER TABLE `gestion`
  ADD UNIQUE KEY `id_gestion` (`id_gestion`);

--
-- Indices de la tabla `gestor`
--
ALTER TABLE `gestor`
  ADD UNIQUE KEY `id_gestor` (`id_gestor`);

--
-- Indices de la tabla `observaciones_ficha`
--
ALTER TABLE `observaciones_ficha`
  ADD UNIQUE KEY `id_observacion` (`id_observacion`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cartera`
--
ALTER TABLE `cartera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `codeudor`
--
ALTER TABLE `codeudor`
  MODIFY `id_codeudor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `deudor`
--
ALTER TABLE `deudor`
  MODIFY `id_deudor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos_cartera`
--
ALTER TABLE `documentos_cartera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ficha`
--
ALTER TABLE `ficha`
  MODIFY `id_ficha` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gestion`
--
ALTER TABLE `gestion`
  MODIFY `id_gestion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gestor`
--
ALTER TABLE `gestor`
  MODIFY `id_gestor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `observaciones_ficha`
--
ALTER TABLE `observaciones_ficha`
  MODIFY `id_observacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
