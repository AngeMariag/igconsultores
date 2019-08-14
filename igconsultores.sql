-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 14-08-2019 a las 22:44:55
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
  `razon_social` varchar(50) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `documento` (`documento`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `acreedor`
--

INSERT INTO `acreedor` (`id`, `tipo_documento`, `documento`, `razon_social`) VALUES
(20, 'cc', '25520841', 'Ramon Sanchez Cartera'),
(21, 'nit', '123456789-0', 'VALOIRA SAS');

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
  UNIQUE KEY `token_unique` (`token`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cartera`
--

INSERT INTO `cartera` (`id`, `token`, `id_acreedor`, `fecha`) VALUES
(14, '7e752605-90ac-40fb-95a1-c5a4e2995465', 20, '2019-08-12'),
(15, '86334b5d-8960-4b14-879b-f826e29348b5', 21, '2019-06-05');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cartera_deudor_codeudor`
--

INSERT INTO `cartera_deudor_codeudor` (`id`, `id_cartera`, `id_deudor`, `id_codeudor`, `id_gestor`) VALUES
(10, 14, 8, NULL, 1),
(11, 14, 8, 5, NULL),
(12, 15, 9, NULL, 1),
(13, 15, NULL, 6, NULL),
(14, 14, 10, NULL, 3),
(15, 14, NULL, 7, NULL),
(16, 15, 11, NULL, 3),
(17, 15, NULL, 8, NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `codeudor`
--

INSERT INTO `codeudor` (`id`, `nombre`, `apellido`, `tipodocumento`, `documento`, `telefono`, `direccion`) VALUES
(5, 'Ramon', 'Codeudor', 'cc', '25520874', '04245024077', 'Mesa de Guanare'),
(6, 'MARIA ', 'PINZÓN', 'ce', '320041', '324567', 'CARRERA 1 '),
(7, 'RICARDO', 'GRANADOS', 'cc', '808089', '2342324', 'CARRERA5'),
(8, 'MARIA ', 'ORJUELA', 'cc', '787878', '343434', 'CRA 71');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deudor`
--

DROP TABLE IF EXISTS `deudor`;
CREATE TABLE IF NOT EXISTS `deudor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `tipodocumento` varchar(3) NOT NULL,
  `documento` varchar(15) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` text NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `UNIQUE` (`documento`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `deudor`
--

INSERT INTO `deudor` (`id`, `nombre`, `apellido`, `tipodocumento`, `documento`, `telefono`, `direccion`) VALUES
(8, 'Ramon', 'Deudor', 'cc', '25520836', '04245024077', 'Mesa de Guanare'),
(9, 'CARMEN ', 'GARCIA', 'cc', '12012016', '45655657', 'BARRIO MARSELLA'),
(10, 'AURORA ', 'GUTIERREZ', 'ce', '320041', '4754027', 'BOGOTÁ'),
(11, 'MARIA', 'PERÉZ', 'cc', '656565', '454545', 'BARRIO LAS MARIAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_cartera`
--

DROP TABLE IF EXISTS `documentos_cartera`;
CREATE TABLE IF NOT EXISTS `documentos_cartera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `ruta` text NOT NULL,
  `id_cartera` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documentos_cartera`
--

INSERT INTO `documentos_cartera` (`id`, `nombre`, `ruta`, `id_cartera`) VALUES
(11, 'ceudla', '/igconsultores/media/c7e722f1c75a2e80.pdf', 14),
(12, 'CERTIFICADO 1', '/igconsultores/media/ecde3eda37325ffe.pdf', 15),
(13, 'CERTIFICADO 2', '/igconsultores/media/90183298cc00a382.pdf', 15),
(14, 'CERTIFICACIÓN BANCARIA', '/igconsultores/media/20ae9936cb2e5bfe.pdf', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

DROP TABLE IF EXISTS `ficha`;
CREATE TABLE IF NOT EXISTS `ficha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `estado` int(15) NOT NULL,
  UNIQUE KEY `id_ficha` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`id`, `titulo`, `capital`, `interes`, `honorarios`, `gastos`, `descuento`, `sancion`, `total`, `id_deudor`, `id_cartera`, `estado`) VALUES
(1, 'wefwef', '23', '23', '23%', '12%', '23', '20', '46.23', 8, 14, 0),
(2, 'CAPITAL DE APARTAMENTO', '5.000.000', '4', '23', '12', '2', '0', '7.049999999999999', 9, 15, 0),
(3, 'PROPIEDAD UNICA', '600', '12', '23', '12', '2', '20', '1014', 10, 14, 0),
(4, 'PROPIEDAD DE INTERES', '676767', '1', '23', '12', '0', '0', '920403.1200000001', 11, 15, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion`
--

DROP TABLE IF EXISTS `gestion`;
CREATE TABLE IF NOT EXISTS `gestion` (
  `id_gestion` int(11) NOT NULL AUTO_INCREMENT,
  `acuerdo` varchar(300) NOT NULL,
  `gestion` int(11) NOT NULL,
  `fecha_gestion` int(11) NOT NULL,
  `monto_gestion` int(11) NOT NULL,
  `estado_gestion` int(11) NOT NULL,
  `id_ficha` varchar(11) NOT NULL,
  UNIQUE KEY `id_gestion` (`id_gestion`)
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gestor`
--

INSERT INTO `gestor` (`id`, `codigo`, `identificacion`, `nombre`, `apellido`) VALUES
(1, '65445y45y', '25520800', 'Ramon Grstor', 'Sanchez Gestor'),
(2, '132wefwe', '25520877', 'Ramon Gestor 1', 'Ramon Gestor 1'),
(3, '24615505', '24615505', 'ANGELICA', 'GUTIERREZ');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `observaciones_ficha`
--

INSERT INTO `observaciones_ficha` (`id`, `id_ficha`, `observacion`) VALUES
(1, 1, 'wefwef'),
(2, 1, 'wefwef'),
(3, 2, 'PAGO SIN REALIZAR'),
(4, 3, 'PAGO POR EFECTUAR'),
(5, 4, 'OBSERVACIÓN ');

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
  `id_recordatorio` int(11) NOT NULL AUTO_INCREMENT,
  `recordatorio` varchar(300) NOT NULL,
  `fecha_recordatorio` date NOT NULL,
  `id_gestion` int(11) NOT NULL,
  PRIMARY KEY (`id_recordatorio`)
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `password`, `nivel`) VALUES
(1, 'jysa', '73a22c28d279ff107cf8ce992ebc3cada6623b6170b38271e6024ca4bd2029995c126b0e9e2004a5f1d11cf36ef01812413ea18e33105f608d752797107fa81a', 1),
(2, '65445y45y', '123456', 3),
(3, '24615505', '73a22c28d279ff107cf8ce992ebc3cada6623b6170b38271e6024ca4bd2029995c126b0e9e2004a5f1d11cf36ef01812413ea18e33105f608d752797107fa81a', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
