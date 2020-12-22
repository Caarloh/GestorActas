-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-12-2020 a las 03:11:48
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestoractas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion`
--

CREATE TABLE `accion` (
  `nombre` varchar(50) NOT NULL,
  `refreunion` int(11) NOT NULL,
  `reftema` int(11) NOT NULL,
  `refinvitado` varchar(50) DEFAULT NULL,
  `fechatermino` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `refeditor` varchar(50) DEFAULT NULL,
  `comentario` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acta`
--

CREATE TABLE `acta` (
  `titulo` int(11) NOT NULL,
  `refreunion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `acta`
--

INSERT INTO `acta` (`titulo`, `refreunion`) VALUES
(0, 2101812214),
(0, 1466521181),
(0, 1466521181),
(0, 1169736797),
(0, 341969361),
(0, 1620250233),
(0, 1158382682);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `correo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`correo`) VALUES
('danmoreno@utalca.cl');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistenciacomite`
--

CREATE TABLE `asistenciacomite` (
  `refcorreo` varchar(50) NOT NULL,
  `refid` int(11) NOT NULL,
  `asistencia` varchar(50) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consejo`
--

CREATE TABLE `consejo` (
  `correo` varchar(300) NOT NULL,
  `nombre` varchar(400) NOT NULL,
  `apellidos` varchar(400) NOT NULL,
  `contrasena` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `consejo`
--

INSERT INTO `consejo` (`correo`, `nombre`, `apellidos`, `contrasena`) VALUES
('danmoreno@utalca.cl', 'Daniel', 'Moreno', 'danmoreno123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invitado`
--

CREATE TABLE `invitado` (
  `correo` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `codigoAcceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacionreunioninvitado`
--

CREATE TABLE `relacionreunioninvitado` (
  `refcorreo` varchar(50) NOT NULL,
  `refid` int(11) NOT NULL,
  `asistencia` varchar(50) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `linkReunion` varchar(500) DEFAULT NULL,
  `estado` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `horaInicio` varchar(50) NOT NULL,
  `horaTermino` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tema`
--

CREATE TABLE `tema` (
  `tag` varchar(50) NOT NULL,
  `refreunion` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accion`
--
ALTER TABLE `accion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkreuniontema` (`refreunion`),
  ADD KEY `fktema` (`reftema`);

--
-- Indices de la tabla `acta`
--
ALTER TABLE `acta`
  ADD KEY `fk_reunion` (`refreunion`);

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`correo`);

--
-- Indices de la tabla `asistenciacomite`
--
ALTER TABLE `asistenciacomite`
  ADD KEY `fkasistenciacorreo` (`refcorreo`),
  ADD KEY `fkasistenciareunion` (`refid`);

--
-- Indices de la tabla `consejo`
--
ALTER TABLE `consejo`
  ADD PRIMARY KEY (`correo`);

--
-- Indices de la tabla `invitado`
--
ALTER TABLE `invitado`
  ADD PRIMARY KEY (`correo`);

--
-- Indices de la tabla `relacionreunioninvitado`
--
ALTER TABLE `relacionreunioninvitado`
  ADD KEY `fkrelacioninvitado` (`refcorreo`),
  ADD KEY `fkrelacionreunion` (`refid`);

--
-- Indices de la tabla `reunion`
--
ALTER TABLE `reunion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkreunion` (`refreunion`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accion`
--
ALTER TABLE `accion`
  ADD CONSTRAINT `fkreuniontema` FOREIGN KEY (`refreunion`) REFERENCES `reunion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fktema` FOREIGN KEY (`reftema`) REFERENCES `tema` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fkadmin` FOREIGN KEY (`correo`) REFERENCES `consejo` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asistenciacomite`
--
ALTER TABLE `asistenciacomite`
  ADD CONSTRAINT `fkasistenciacorreo` FOREIGN KEY (`refcorreo`) REFERENCES `consejo` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkasistenciareunion` FOREIGN KEY (`refid`) REFERENCES `reunion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `relacionreunioninvitado`
--
ALTER TABLE `relacionreunioninvitado`
  ADD CONSTRAINT `fkrelacioninvitado` FOREIGN KEY (`refcorreo`) REFERENCES `invitado` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkrelacionreunion` FOREIGN KEY (`refid`) REFERENCES `reunion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tema`
--
ALTER TABLE `tema`
  ADD CONSTRAINT `fkreunion` FOREIGN KEY (`refreunion`) REFERENCES `reunion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
