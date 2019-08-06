-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 06-08-2019 a las 03:38:35
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
  `id_acreedor` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_documento` varchar(5) NOT NULL,
  `numero_documento` varchar(20) NOT NULL,
  `acreedor` varchar(50) NOT NULL,
  `razon_social` varchar(50) NOT NULL,
  UNIQUE KEY `id_acreedor` (`id_acreedor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartera`
--

DROP TABLE IF EXISTS `cartera`;
CREATE TABLE IF NOT EXISTS `cartera` (
  `id_cartera` int(11) NOT NULL AUTO_INCREMENT,
  `id_acreedor` int(11) NOT NULL,
  `id_deudor` int(11) NOT NULL,
  `id_documento` int(11) NOT NULL,
  `fecha_cartera` date NOT NULL,
  PRIMARY KEY (`id_cartera`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codeudor`
--

DROP TABLE IF EXISTS `codeudor`;
CREATE TABLE IF NOT EXISTS `codeudor` (
  `id_codeudor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_codeudor` varchar(30) NOT NULL,
  `apellido_codeudor` varchar(30) NOT NULL,
  `tipodocumento_codeudor` varchar(30) NOT NULL,
  `documento_codeudor` varchar(30) NOT NULL,
  `telefono_codeudor` varchar(15) NOT NULL,
  `direccion_codeudor` varchar(100) NOT NULL,
  `id_deudor` int(11) NOT NULL,
  UNIQUE KEY `id_codeudor` (`id_codeudor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deudor`
--

DROP TABLE IF EXISTS `deudor`;
CREATE TABLE IF NOT EXISTS `deudor` (
  `id_deudor` int(11) NOT NULL AUTO_INCREMENT,
  `id_acreedor` int(11) NOT NULL,
  `nombre_deudor` varchar(30) NOT NULL,
  `apellido_deudor` varchar(30) NOT NULL,
  `tipodocumento_deudor` varchar(30) NOT NULL,
  `documento_deudor` varchar(30) NOT NULL,
  `telefono_deudor` varchar(15) NOT NULL,
  `direccion_deudor` varchar(100) NOT NULL,
  UNIQUE KEY `id_deudor` (`id_deudor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_cartera`
--

DROP TABLE IF EXISTS `documentos_cartera`;
CREATE TABLE IF NOT EXISTS `documentos_cartera` (
  `id_documento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_documento` varchar(50) NOT NULL,
  `ruta_documento` text NOT NULL,
  `id_cartera` int(11) NOT NULL,
  UNIQUE KEY `id_documento` (`id_documento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

DROP TABLE IF EXISTS `ficha`;
CREATE TABLE IF NOT EXISTS `ficha` (
  `id_ficha` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_ficha` varchar(100) NOT NULL,
  `capital_ficha` varchar(30) NOT NULL,
  `interes` varchar(10) NOT NULL,
  `honorarios` varchar(10) NOT NULL,
  `gastos` varchar(10) NOT NULL,
  `descuento` varchar(30) NOT NULL,
  `sancion` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  `id_deudor` int(11) NOT NULL,
  `estado` int(15) NOT NULL,
  UNIQUE KEY `id_ficha` (`id_ficha`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion`
--

DROP TABLE IF EXISTS `gestion`;
CREATE TABLE IF NOT EXISTS `gestion` (
  `id_gestion` int(11) NOT NULL AUTO_INCREMENT,
  `gestion` int(11) NOT NULL,
  `fecha_gestion` int(11) NOT NULL,
  `monto_gestion` int(11) NOT NULL,
  `estado_gestion` int(11) NOT NULL,
  `recordatorio` int(11) NOT NULL,
  `id_ficha` varchar(11) NOT NULL,
  UNIQUE KEY `id_gestion` (`id_gestion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestor`
--

DROP TABLE IF EXISTS `gestor`;
CREATE TABLE IF NOT EXISTS `gestor` (
  `id_gestor` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_gestor` varchar(10) NOT NULL,
  `identificacion_gestor` varchar(15) NOT NULL,
  `nombre_gestor` varchar(10) NOT NULL,
  `apellido_gestor` varchar(10) NOT NULL,
  UNIQUE KEY `id_gestor` (`id_gestor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones_ficha`
--

DROP TABLE IF EXISTS `observaciones_ficha`;
CREATE TABLE IF NOT EXISTS `observaciones_ficha` (
  `id_observacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_ficha` int(11) NOT NULL,
  `observacion` varchar(350) NOT NULL,
  UNIQUE KEY `id_observacion` (`id_observacion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `nivel` int(5) NOT NULL,
  UNIQUE KEY `id_usuario` (`id_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
