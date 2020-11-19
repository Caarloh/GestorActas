-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 19-11-2020 a las 20:08:11
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `gestoractas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reunion`
--

CREATE TABLE `reunion` (
  `id` int(11) NOT NULL,
  `tipoPredefinido` varchar(200) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `hora` varchar(50) NOT NULL,
  `duracion` int(11) NOT NULL,
  `tipoDuracion` varchar(100) NOT NULL,
  `linkReunion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reunion`
--

INSERT INTO `reunion` (`id`, `tipoPredefinido`, `fecha`, `hora`, `duracion`, `tipoDuracion`, `linkReunion`) VALUES
(1124387998, 'Extraordinaria', '2020-11-20', '09:00', 3, 'Horas', ''),
(1238353639, 'Regular', '2020-11-20', '09:00', 2, 'Horas', 'https://reuna.zoom.us/j/9975784070?pwd=dmQwMk1MWWFzME1FMWoxalZGUHQxQT09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reunion`
--
ALTER TABLE `reunion`
  ADD PRIMARY KEY (`id`);