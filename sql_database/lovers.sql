-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-09-2017 a las 04:51:38
-- Versión del servidor: 5.6.15-log
-- Versión de PHP: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `lovers`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigos_solicitud`
--

CREATE TABLE IF NOT EXISTS `amigos_solicitud` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `user_s` int(100) NOT NULL,
  `user_r` int(100) NOT NULL,
  `time` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `aprobado` int(1) NOT NULL DEFAULT '0',
  `time_aprobado` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE IF NOT EXISTS `mensajes` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `user_s` int(200) NOT NULL,
  `user_r` int(200) NOT NULL,
  `mensaje` varchar(400) COLLATE utf8_spanish_ci NOT NULL,
  `hora` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE IF NOT EXISTS `reportes` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `usuario_reportado` int(200) NOT NULL,
  `motivo_reporte` varchar(400) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_reportador` int(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `edad` int(3) NOT NULL,
  `nacimiento_fecha` varchar(13) COLLATE utf8_spanish_ci NOT NULL,
  `genero` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `interes` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `pais` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `facebook_reg` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'no',
  `facebook_id` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `permisos` int(1) NOT NULL DEFAULT '0',
  `keyReg` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `activado` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password_rec_key` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `profile_img` varchar(30) COLLATE utf8_spanish_ci DEFAULT 'default.jpg',
  `descripcion` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Esta es la tabla que contiene la informacion de los usuarios' AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `nombre`, `apellido`, `edad`, `nacimiento_fecha`, `genero`, `interes`, `pais`, `email`, `password`, `facebook_reg`, `facebook_id`, `permisos`, `keyReg`, `activado`, `password_rec_key`, `profile_img`, `descripcion`) VALUES
(1, 'Gamertod', 'Elvis', 'Garcia', 16, '21/04/2001', 'Hombre', 'Mujeres', 'Venezuela', 'cavesagarcia@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'no', NULL, 2, '', 'SI', NULL, 'default.jpg', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
