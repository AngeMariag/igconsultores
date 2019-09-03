-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-09-2019 a las 23:01:05
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `acreedor`
--

INSERT INTO `acreedor` (`id`, `tipo_documento`, `documento`, `razon_social`) VALUES
(1, 'cc', '80262608', 'DANIEL IBAÑEZ'),
(2, 'ce', '320041', 'AURORA GUTIÉRREZ'),
(3, 'cc', '101432015', 'OMAIRA DÍAZ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acuerdo`
--

DROP TABLE IF EXISTS `acuerdo`;
CREATE TABLE IF NOT EXISTS `acuerdo` (
  `id_acuerdo` int(11) NOT NULL AUTO_INCREMENT,
  `acuerdo` varchar(500) NOT NULL,
  `porcentaje` varchar(10) NOT NULL,
  `total_pagar` varchar(30) NOT NULL,
  `id_ficha` int(11) NOT NULL,
  PRIMARY KEY (`id_acuerdo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cartera`
--

INSERT INTO `cartera` (`id`, `token`, `id_acreedor`, `fecha`) VALUES
(1, '77fe4a73b59991bff12d2a92688defa5', 1, '2019-08-20'),
(2, 'a1310c897e41c70baa9f36b9434d454b', 1, '2019-08-12'),
(3, '4799f001daab9e62464e8171a977d2ee', 1, '2019-08-30'),
(4, '26e69d997e94db088acc0cdb53580e3c', 2, '2019-08-01'),
(5, 'f33d527d2d21d89de8ed8151a498a7e7', 1, '2019-08-17'),
(6, 'dd9fef8f6811d86e40e0d3ec86086682', 1, '2019-08-01'),
(7, 'd4560bee402906847f3e0a4a9a5cf798', 3, '2019-08-14'),
(8, 'a4666fd804a6fc7519c27333ecc14692', 2, '2019-09-24');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cartera_deudor_codeudor`
--

INSERT INTO `cartera_deudor_codeudor` (`id`, `id_cartera`, `id_deudor`, `id_codeudor`, `id_gestor`) VALUES
(1, 1, 1, NULL, 7),
(2, 1, 1, 1, NULL),
(3, 4, 2, NULL, 7),
(4, 4, 2, 2, NULL),
(5, 7, 3, NULL, 7),
(6, 7, 3, 3, NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `codeudor`
--

INSERT INTO `codeudor` (`id`, `nombre`, `apellido`, `tipodocumento`, `documento`, `telefono`, `direccion`) VALUES
(1, 'ANA ', 'GALINDÉZ', 'cc', '33345686', '318343434', 'CALLE 6'),
(2, 'melany', 'moncada', 'cc', '12012013', '3173434', 'calle 45 # 76-43'),
(3, 'MARIANA', 'GONZALES', 'cc', '98989843', '4754065', 'CRA 21 #156-87');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `deudor`
--

INSERT INTO `deudor` (`id`, `codigo`, `nombre`, `apellido`, `tipodocumento`, `documento`, `telefono`, `direccion`) VALUES
(1, 'cv-123', 'ricardo', 'GRANADOS', 'cc', '80262108', '315597879', 'CRA 11'),
(2, '345-978', 'gregorio', 'gutiérrez', 'cc', '10721093', '3134564546', 'Carrera 11 '),
(3, '444-5', 'ANA', 'ZAMBRANO', 'cc', '1238097', '3453434', 'CRA 11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_cartera`
--

DROP TABLE IF EXISTS `documentos_cartera`;
CREATE TABLE IF NOT EXISTS `documentos_cartera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `ruta` text NOT NULL,
  `ubicacion_documento` varchar(350) NOT NULL,
  `id_ficha` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documentos_cartera`
--

INSERT INTO `documentos_cartera` (`id`, `nombre`, `ruta`, `ubicacion_documento`, `id_ficha`) VALUES
(1, 'DOCUMENTO 1', 'documentos/acta0001.pdf', '', 1),
(2, 'DOCUEMNTO DE RESPALDO DE X Y Z #10988', 'documentos/titulo20001.pdf', '', 1),
(3, 'documento1de ange', 'documentos/acta0001.pdf', 'folio x ', 2),
(4, 'DOCUMENTO DE PRUEBA', 'documentos/cedula0001.pdf', 'FOLIO X2', 3);

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
(1, 'PAGRÉ, LETRA, XX', '1400000', '0', '23', '12', '', '0', '1.000.000', 1, 1, 1),
(2, 'pagaré, factura 2, factura 3', '1.000.000', '2', '23', '12', '', '0', '1.485.000', 2, 4, 1),
(3, 'PAGARÉ, FACTURA, XXX, XXXXXX', '1.000.000', '3', '23', '12', '', '0', '1512000', 3, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion`
--

DROP TABLE IF EXISTS `gestion`;
CREATE TABLE IF NOT EXISTS `gestion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gestion` varchar(500) NOT NULL,
  `fecha` date NOT NULL,
  `monto` float NOT NULL,
  `estado` varchar(300) NOT NULL,
  `id_ficha` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gestion`
--

INSERT INTO `gestion` (`id`, `gestion`, `fecha`, `monto`, `estado`, `id_ficha`) VALUES
(1, 'xxxxxxxxxxxx', '2019-09-05', 89, 'estado', 3),
(2, 'zzzzzz', '2019-09-05', 0, 'estado', 1),
(3, 'zzzzzz', '2019-09-05', 0, 'estado', 1),
(4, 'zzzzzz', '2019-09-05', 0, 'estado', 1),
(5, 'zzzzzz', '2019-09-05', 0, 'estado', 1),
(6, 'zzzzzz', '2019-09-05', 0, 'estado', 1),
(7, 'zzzzzz', '2019-09-05', 0, 'estado', 1),
(8, 'mi gestion de prueba', '2019-09-10', 500000, '0', 3),
(9, 'mi gestion de prueba', '2019-09-03', 500000, '0', 3),
(10, 'otra gestion', '2019-09-03', 345000, '5', 2),
(11, 'otra gestion', '2019-09-03', 345000, '5', 2),
(12, 'otra gestion', '2019-09-03', 345000, '5', 2),
(13, 'otra gestion', '2019-09-03', 345000, '5', 2),
(14, 'otra gestion', '2019-09-03', 345000, '5', 2),
(15, 'otra gestion', '2019-09-03', 345000, '5', 2),
(16, 'otra gestion', '2019-09-03', 345000, '5', 2),
(17, 'otra gestion', '2019-09-03', 345000, '5', 2),
(18, 'defi', '2019-09-30', 450000, '7', 2);

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gestor`
--

INSERT INTO `gestor` (`id`, `codigo`, `identificacion`, `nombre`, `apellido`) VALUES
(8, '1010106', '8335221', 'ORLANDO', 'ANGULO'),
(7, 'ANGE-45', '24615505', 'ANGÉLICA', 'GUTIÉRREZ');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `observaciones_ficha`
--

INSERT INTO `observaciones_ficha` (`id`, `id_ficha`, `observacion`) VALUES
(1, 1, 'OBSERVACIONES '),
(2, 2, 'cuenta con problemas de xxxxx'),
(3, 3, 'UNO '),
(4, 3, 'DOS');

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
  `saldo` double NOT NULL,
  `observaciones_pago` varchar(500) NOT NULL,
  `id_gestion` int(11) NOT NULL,
  `id_ficha` int(11) NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `password`, `nivel`) VALUES
(4, 'contabilidad', 'contador', 3),
(5, 'admin', '123456', 1),
(6, 'administrador', 'administrador', 0),
(11, '1010106', '8335221', 2),
(10, 'ANGE-45', '101010', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
