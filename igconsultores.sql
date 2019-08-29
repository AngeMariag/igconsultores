-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 29-08-2019 a las 03:51:56
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.1.26

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

DROP TABLE IF EXISTS `acreedor`;
CREATE TABLE IF NOT EXISTS `acreedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_documento` varchar(5) NOT NULL,
  `documento` varchar(20) NOT NULL,
  `razon_social` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `documento` (`documento`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `acreedor`
--

INSERT INTO `acreedor` (`id`, `tipo_documento`, `documento`, `razon_social`) VALUES
(23, 'cc', '25520841', 'Junuir Sanchez'),
(24, 'cc', '24615505', 'ANGELICA GUTIERREZ'),
(25, 'cc', '10721093', 'GREGORIO'),
(26, 'nit', '9876876-3', 'ANA LOPÉZ'),
(27, 'ce', '14747710', 'GHERZARI AÑEZ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartera`
--

DROP TABLE IF EXISTS `cartera`;
CREATE TABLE IF NOT EXISTS `cartera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `id_acreedor` int(11) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token_unique` (`token`),
  KEY `FK_ACREEDOR` (`id_acreedor`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cartera`
--

INSERT INTO `cartera` (`id`, `token`, `id_acreedor`, `fecha`) VALUES
(1, 'b1a5103fb8ce4a4a4dd6d45ec13a0d14', 27, '2019-08-01'),
(2, '6ea7de0d0dd2af8ae431cd39230bc491', 27, '2019-08-04'),
(3, 'e9be516d645a404a08edb3dde7091e36', 27, '2019-08-05'),
(4, '64e9f254fa059a7c45193b0ac58f504c', 27, '2019-08-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartera_deudor_codeudor`
--

DROP TABLE IF EXISTS `cartera_deudor_codeudor`;
CREATE TABLE IF NOT EXISTS `cartera_deudor_codeudor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cartera` int(11) DEFAULT NULL,
  `id_deudor` int(11) DEFAULT NULL,
  `id_codeudor` int(11) DEFAULT NULL,
  `id_gestor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cartera_deudor_codeudor`
--

INSERT INTO `cartera_deudor_codeudor` (`id`, `id_cartera`, `id_deudor`, `id_codeudor`, `id_gestor`) VALUES
(1, 1, 1, NULL, 4),
(2, 1, 1, 1, NULL),
(3, 1, 1, 2, NULL),
(4, 1, 2, NULL, 4),
(5, 1, 2, 3, NULL),
(6, 1, 2, 4, NULL),
(7, 1, 2, NULL, 4),
(8, 1, 2, 3, NULL),
(9, 1, 2, 4, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codeudor`
--

DROP TABLE IF EXISTS `codeudor`;
CREATE TABLE IF NOT EXISTS `codeudor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `tipodocumento` varchar(3) NOT NULL,
  `documento` varchar(15) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` text NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `documento` (`documento`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `codeudor`
--

INSERT INTO `codeudor` (`id`, `nombre`, `apellido`, `tipodocumento`, `documento`, `telefono`, `direccion`) VALUES
(1, 'PRUEBA DOCUMENTO', 'PRUEBA DOCUMENTO', 'cc', '51234', '3456764', 'PRUEBA DOCUMENTO'),
(2, 'PRUEBA DOCUMENTO', 'PRUEBA DOCUMENTO', 'cc', '238987', '123976', 'PRUEBA DOCUMENTO'),
(3, 'DOCUMENTO 2', 'DOCUMENTO 2', 'cc', '763027', '65454', 'DOCUMENTO 2'),
(4, 'DOCUMENTO 2', 'DOCUMENTO 2', 'ce', '6578692', '2342329', 'DOCUMENTO 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deudor`
--

DROP TABLE IF EXISTS `deudor`;
CREATE TABLE IF NOT EXISTS `deudor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(25) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `tipodocumento` varchar(3) NOT NULL,
  `documento` varchar(15) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` text NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `UNIQUE` (`documento`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `deudor`
--

INSERT INTO `deudor` (`id`, `codigo`, `nombre`, `apellido`, `tipodocumento`, `documento`, `telefono`, `direccion`) VALUES
(1, 'PRUEBA DOCUMENTO', 'PRUEBA DOCUMENTO', 'PRUEBA DOCUMENTO', 'cc', '23456723', '23416', 'PRUEBA DOCUMENTO'),
(2, 'documento 2', 'DOCUMENTO 2', 'DOCUMENTO 2', 'cc', '676345', '4353423', 'cra 11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_cartera`
--

DROP TABLE IF EXISTS `documentos_cartera`;
CREATE TABLE IF NOT EXISTS `documentos_cartera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `ruta` text NOT NULL,
  `id_ficha` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documentos_cartera`
--

INSERT INTO `documentos_cartera` (`id`, `nombre`, `ruta`, `id_ficha`) VALUES
(1, 'PRUEBA DOCUMENTO', 'documentos/bolsa clap.pdf', 1),
(2, 'DOCUMENTO 2', 'documentosbolsa clap.pdf', 2),
(3, 'DOCUMENTO 2', 'documentosbolsa clap.pdf', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

DROP TABLE IF EXISTS `ficha`;
CREATE TABLE IF NOT EXISTS `ficha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `capital` varchar(30) NOT NULL,
  `interes` varchar(10) NOT NULL,
  `honorarios` varchar(10) NOT NULL,
  `gastos` varchar(10) NOT NULL,
  `descuento` varchar(30) NOT NULL,
  `sancion` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  `id_deudor` int(11) NOT NULL,
  `id_cartera` int(11) NOT NULL,
  `estado` int(15) NOT NULL,
  UNIQUE KEY `id_ficha` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`id`, `titulo`, `capital`, `interes`, `honorarios`, `gastos`, `descuento`, `sancion`, `total`, `id_deudor`, `id_cartera`, `estado`) VALUES
(1, 'PRUEBA DOCUMENTO', '450000', '0', '23', '12', '0', '0', '607500.00', 1, 1, 1),
(2, 'DOCUMENTO 2', '350000', '0', '23', '12', '0', '0', '472500.00', 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion`
--

DROP TABLE IF EXISTS `gestion`;
CREATE TABLE IF NOT EXISTS `gestion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acuerdo` varchar(300) NOT NULL,
  `gestion` varchar(300) NOT NULL,
  `fecha` date NOT NULL,
  `monto` float NOT NULL,
  `estado` varchar(300) NOT NULL,
  `id_ficha` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestor`
--

DROP TABLE IF EXISTS `gestor`;
CREATE TABLE IF NOT EXISTS `gestor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) NOT NULL,
  `identificacion` varchar(15) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gestor`
--

INSERT INTO `gestor` (`id`, `codigo`, `identificacion`, `nombre`, `apellido`) VALUES
(4, '25520842', '564ew56f', 'Ramon', 'Gestor'),
(5, '1234567', '24615506', 'ANGELIC', 'LOPEZ'),
(6, 'gestor1-c', '26932305', 'Antonio', 'Garcia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones_ficha`
--

DROP TABLE IF EXISTS `observaciones_ficha`;
CREATE TABLE IF NOT EXISTS `observaciones_ficha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ficha` int(11) NOT NULL,
  `observacion` varchar(350) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `observaciones_ficha`
--

INSERT INTO `observaciones_ficha` (`id`, `id_ficha`, `observacion`) VALUES
(1, 1, 'vvvvv'),
(2, 2, 'DOCUMENTO 2'),
(3, 3, 'DOCUMENTO 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_contabilidad`
--

DROP TABLE IF EXISTS `pagos_contabilidad`;
CREATE TABLE IF NOT EXISTS `pagos_contabilidad` (
  `id_pagos` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `numero_recibo` varchar(30) NOT NULL,
  `valor` double NOT NULL,
  `id_gestion` int(11) NOT NULL,
  `estado_pago` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recordatorios`
--

DROP TABLE IF EXISTS `recordatorios`;
CREATE TABLE IF NOT EXISTS `recordatorios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recordatorio` varchar(300) NOT NULL,
  `fecha` date NOT NULL,
  `id_ficha` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nivel` int(5) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `unique` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `password`, `nivel`) VALUES
(1, 'jysa', '73a22c28d279ff107cf8ce992ebc3cada6623b6170b38271e6024ca4bd2029995c126b0e9e2004a5f1d11cf36ef01812413ea18e33105f608d752797107fa81a', 1),
(4, 'contabilidad', 'contador', 3),
(9, 'gestor1-c', '123456', 2),
(5, 'admin', '123456', 1),
(6, 'administrador', 'administrador', 0),
(7, 'gestor', '12345', 2),
(8, '1234567', '123456', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
