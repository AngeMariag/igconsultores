-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 29-08-2019 a las 20:37:22
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
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `acreedor`
--

INSERT INTO `acreedor` (`id`, `tipo_documento`, `documento`, `razon_social`) VALUES
(23, 'cc', '25520841', 'Junuir Sanchez'),
(24, 'cc', '24615505', 'ANGELICA GUTIERREZ'),
(25, 'cc', '10721093', 'GREGORIO'),
(26, 'nit', '9876876-3', 'ANA LOPÉZ'),
(27, 'ce', '14747710', 'GHERZARI AÑEZ'),
(28, 'cc', '80262108', 'RICARDO GRANADOS');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cartera`
--

INSERT INTO `cartera` (`id`, `token`, `id_acreedor`, `fecha`) VALUES
(1, 'b9b13ca6e8077149781f8033b4d18d1c', 27, '2019-08-13'),
(2, '643eb890c4b062a4d998270f7d79da4f', 24, '2019-08-01'),
(3, 'e6fce55333baa059eab44d6a2d5ef47f', 24, '2019-08-12'),
(4, 'eb543735ba01bfd3d9f6ff002db42c1d', 26, '2019-08-02'),
(5, '4772bda75c3a257868b0c356a52bddf8', 28, '2019-08-02');

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cartera_deudor_codeudor`
--

INSERT INTO `cartera_deudor_codeudor` (`id`, `id_cartera`, `id_deudor`, `id_codeudor`, `id_gestor`) VALUES
(1, 1, 1, NULL, 5),
(2, 1, 1, 1, NULL),
(3, 1, 1, 2, NULL),
(4, 1, 2, NULL, 5),
(5, 1, 2, 3, NULL),
(6, 1, 2, NULL, 5),
(7, 1, 2, 3, NULL),
(8, 1, 2, NULL, 5),
(9, 1, 2, 3, NULL),
(10, 1, 2, NULL, 5),
(11, 1, 2, 3, NULL),
(12, 1, 2, NULL, 5),
(13, 1, 2, 3, NULL),
(14, 1, 2, NULL, 5),
(15, 1, 2, 3, NULL),
(16, 1, 3, NULL, 5),
(17, 1, 3, 4, NULL),
(18, 1, 3, NULL, 5),
(19, 1, 3, 4, NULL),
(20, 1, 3, NULL, 5),
(21, 1, 3, 4, NULL),
(22, 2, 4, NULL, 4),
(23, 3, 5, NULL, 5),
(24, 3, 5, 5, NULL),
(25, 3, 5, 6, NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `codeudor`
--

INSERT INTO `codeudor` (`id`, `nombre`, `apellido`, `tipodocumento`, `documento`, `telefono`, `direccion`) VALUES
(1, 'EDWIN', 'VALDEZ', 'cc', '566588', '1238976', 'CRA 7 #8-12'),
(2, 'EBLIMAR ', 'CARDONA', 'ce', '343936', '2345687', 'CALLE 11 #56-24 BARRIO MARSELLA'),
(3, 'ANGELICA', 'AAAA', 'cc', '659809', '8766767', 'CALLE 34'),
(4, 'JOSEFA', 'CAMEJO', 'cc', '45456754', '23456', 'JJJJJ'),
(5, 'MARIA', 'LOPEZ', 'cc', '3456578', '2323245', 'CRA11'),
(6, 'SOL', 'LUNA', 'cc', '10112389', '23477', 'L-O0');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `deudor`
--

INSERT INTO `deudor` (`id`, `codigo`, `nombre`, `apellido`, `tipodocumento`, `documento`, `telefono`, `direccion`) VALUES
(1, '101-an', 'ana', 'GIL', 'cc', '24615505', '3254567873', 'CRA 11-34-35'),
(2, '23432-AB', 'AURORA', 'GUTIERREZ', 'cc', '320041', '234567', 'CAR'),
(3, 'ASASDAS-123', 'MARINA ', 'DELGADO', 'cc', '7689', '345346', 'CRA 11'),
(4, '12-12-3e', 'carmen', 'GARCIA', 'cc', '12012012', '3453434', 'CAR 5'),
(5, '345-89c', 'aurora', 'GUTIERREZ', 'ce', '320042', '3158838787', 'CRA11');

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documentos_cartera`
--

INSERT INTO `documentos_cartera` (`id`, `nombre`, `ruta`, `id_ficha`) VALUES
(1, 'DOCUMENTO 1', 'documentosConfirmacion-Inscripcion-Diplomado-PC.pdf', 1),
(2, 'DOCUMENTO 2', 'documentosGuÃ­a del estudiante 1.pdf', 1),
(3, 'DOCUMENTO 4', 'documentos6576_15874.pdf', 1),
(4, 'MMM', 'documentosGuÃ­a del estudiante 1.pdf', 2),
(5, 'MMM', 'documentosGuÃ­a del estudiante 1.pdf', 3),
(6, 'MMM', 'documentosGuÃ­a del estudiante 1.pdf', 4),
(7, 'MMM', 'documentosGuÃ­a del estudiante 1.pdf', 5),
(8, 'MMM', 'documentosGuÃ­a del estudiante 1.pdf', 6),
(9, 'MMM', 'documentosGuÃ­a del estudiante 1.pdf', 7),
(10, 'RUTA', 'documentos6576_15874.pdf', 8),
(11, 'RUTA', 'documentos6576_15874.pdf', 9),
(12, 'RUTA', 'documentos6576_15874.pdf', 10),
(13, 'DOCUMENTO DE X', 'documentos/Cita.pdf', 11),
(14, 'DOCUMENTO Y', 'documentos/formato hoja de vida JOSEHIDD.pdf', 11),
(15, 'DOCUMENTO DEL AURI', 'documentos/Cita.pdf', 12);

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`id`, `titulo`, `capital`, `interes`, `honorarios`, `gastos`, `descuento`, `sancion`, `total`, `id_deudor`, `id_cartera`, `estado`) VALUES
(1, 'PROPIEDAD', '1200000', '10', '23', '12', '4', '0', '1670400.00', 1, 1, 1),
(2, 'PROPIEDAD X', '3000000', '4', '23', '12', '0', '0', '4170000.00', 2, 1, 1),
(3, 'PROPIEDAD X', '3000000', '4', '23', '12', '0', '0', '4170000.00', 2, 1, 1),
(4, 'PROPIEDAD X', '3000000', '4', '23', '12', '0', '0', '4170000.00', 2, 1, 1),
(5, 'PROPIEDAD X', '3000000', '4', '23', '12', '0', '0', '4170000.00', 2, 1, 1),
(6, 'PROPIEDAD X', '3000000', '4', '23', '12', '0', '0', '4170000.00', 2, 1, 1),
(7, 'PROPIEDAD X', '3000000', '4', '23', '12', '0', '0', '4170000.00', 2, 1, 1),
(8, 'PROPIEDAD 2', '40000', '0', '23', '12', '0', '0', '54000.00', 3, 1, 1),
(9, 'PROPIEDAD 2', '40000', '0', '23', '12', '0', '0', '54000.00', 3, 1, 1),
(10, 'PROPIEDAD 2', '40000', '0', '23', '12', '0', '0', '54000.00', 3, 1, 1),
(11, '45-PROPIEDAD', '400000', '2', '23', '12', '0', '0', '548000.00', 4, 2, 1),
(12, 'VALORIZACIÓN', '3000000', '1', '23', '12', '0', '0', '4080000.00', 5, 3, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `observaciones_ficha`
--

INSERT INTO `observaciones_ficha` (`id`, `id_ficha`, `observacion`) VALUES
(1, 1, 'EL DEUDOR X ES X EN X COSA '),
(2, 2, 'PRUEBA DE DOCUMENTO '),
(3, 3, 'PRUEBA DE DOCUMENTO '),
(4, 4, 'PRUEBA DE DOCUMENTO '),
(5, 5, 'PRUEBA DE DOCUMENTO '),
(6, 6, 'PRUEBA DE DOCUMENTO '),
(7, 7, 'PRUEBA DE DOCUMENTO '),
(8, 8, '343'),
(9, 9, '343'),
(10, 10, '343'),
(11, 11, 'DOCUEMNTOS CON /'),
(12, 12, 'PRUEBA ');

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
