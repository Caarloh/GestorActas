-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-12-2020 a las 03:06:32
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

--
-- Volcado de datos para la tabla `accion`
--

INSERT INTO `accion` (`nombre`, `refreunion`, `reftema`, `refinvitado`, `fechatermino`, `estado`, `id`, `refeditor`, `comentario`) VALUES
('con caca con caca', 712741942, 406471310, 'evalenzuela17@alumnos.utalca.cl', '2020-12-23', 'Pendiente', 68467485, '', ''),
('sdadas', 1147321168, 197341747, 'sretamales17@alumnos.utalca.cl', '2021-01-01', 'Pendiente', 499980869, '', ''),
('asdasd', 664128748, 779814368, 'sretamales17@alumnos.utalca.cl', '2020-12-30', 'Pendiente', 1066221764, '', ''),
('asd', 664128748, 1106834048, 'evalenzuela17@alumnos.utalca.cl', '2021-01-07', 'Pendiente', 1232228186, '', ''),
('con caca con caca', 664128748, 779814368, 'pvalenzuela17@alumnos.utalca.cl', '2020-12-30', 'Pendiente', 1625569155, '', ''),
('con caca con caca', 985995937, 516003718, 'sretamales17@alumnos.utalca.cl', '2020-12-22', 'Terminado', 1758405846, 'sretamales17@alumnos.utalca.cl', 'me gustan me gustan'),
('poto', 664128748, 779814368, 'pvalenzuela17@alumnos.utalca.cl', '2021-01-06', 'Pendiente', 2027695564, '', '');

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
('pvalenzuela17@alumnos.utalca.cl');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistenciacomite`
--

CREATE TABLE `asistenciacomite` (
  `refcorreo` varchar(50) NOT NULL,
  `refid` int(11) NOT NULL,
  `asistencia` varchar(50) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asistenciacomite`
--

INSERT INTO `asistenciacomite` (`refcorreo`, `refid`, `asistencia`) VALUES
('pvalenzuela17@alumnos.utalca.cl', 678221694, 'NO'),
('pvalenzuela17@alumnos.utalca.cl', 1147321168, 'NO'),
('pvalenzuela17@alumnos.utalca.cl', 1950232597, 'NO'),
('pvalenzuela17@alumnos.utalca.cl', 664128748, 'NO');

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
('pvalenzuela17@alumnos.utalca.cl', 'Pablo', 'Valenzuela', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invitado`
--

CREATE TABLE `invitado` (
  `correo` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `codigoAcceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `invitado`
--

INSERT INTO `invitado` (`correo`, `nombre`, `codigoAcceso`) VALUES
('evalenzuela17@alumnos.utalca.cl', 'Edu', 85613421),
('sretamales17@alumnos.utalca.cl', 'Sea', 210915947),
('th3gr1ml0ck@gmail.com', 'Carlos2', 1227030944);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacionreunioninvitado`
--

CREATE TABLE `relacionreunioninvitado` (
  `refcorreo` varchar(50) NOT NULL,
  `refid` int(11) NOT NULL,
  `asistencia` varchar(50) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `relacionreunioninvitado`
--

INSERT INTO `relacionreunioninvitado` (`refcorreo`, `refid`, `asistencia`) VALUES
('th3gr1ml0ck@gmail.com', 992693321, 'NO'),
('sretamales17@alumnos.utalca.cl', 985995937, 'SI'),
('evalenzuela17@alumnos.utalca.cl', 712741942, 'SI'),
('sretamales17@alumnos.utalca.cl', 1147321168, 'NO'),
('sretamales17@alumnos.utalca.cl', 1950232597, 'NO'),
('evalenzuela17@alumnos.utalca.cl', 1950232597, 'NO'),
('sretamales17@alumnos.utalca.cl', 664128748, 'NO'),
('evalenzuela17@alumnos.utalca.cl', 664128748, 'NO');

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

--
-- Volcado de datos para la tabla `reunion`
--

INSERT INTO `reunion` (`id`, `tipoPredefinido`, `fecha`, `hora`, `duracion`, `tipoDuracion`, `linkReunion`, `estado`, `nombre`, `horaInicio`, `horaTermino`) VALUES
(664128748, 'Consejo de Escuela', '2020-12-21', '22:01', 1, 'Horas', 'asdasd', 'En Espera', 'asdasd (1)', '', ''),
(678221694, 'Regular', '2020-12-21', '19:26', 2, 'Horas', 'https://www.pcfactory.cl/producto/36317-gear-desktop-intel-core-i7-9700f-8gb-1tb', 'Terminado', 'Hola (1)', '16:11', '19:34'),
(712741942, 'Regular', '2020-12-21', '19:28', 2, 'Horas', 'https://www.pcfactory.cl/producto/36317-gear-desktop-intel-core-i7-9700f-8gb-1tb', 'Terminado', 'Hola (4)', '20:00', '19:29'),
(847421058, 'Regular', '2020-12-22', '10:50', 2, 'Horas', 'https://www.pcfactory.cl/producto/36317-gear-desktop-intel-core-i7-9700f-8gb-1tb', 'En Espera', 'Hola', '', ''),
(985995937, 'Regular', '2020-12-22', '12:30', 2, 'Horas', 'https://www.pcfactory.cl/producto/36317-gear-desktop-intel-core-i7-9700f-8gb-1tb', 'Terminado', 'Hola', '07:02', '19:19'),
(992693321, 'Regular', '2020-12-22', '12:30', 2, 'Horas', 'https://www.pcfactory.cl/producto/36317-gear-desktop-intel-core-i7-9700f-8gb-1tb', 'Terminado', 'Hola', '19:10', '19:14'),
(1147321168, 'Regular', '2020-12-21', '19:28', 2, 'Horas', 'https://www.pcfactory.cl/producto/36317-gear-desktop-intel-core-i7-9700f-8gb-1tb', 'En Espera', 'Hola (3)', '', ''),
(1294339821, 'Regular', '2021-01-06', '03:00', 2, 'Horas', 'asdasdas', 'En Espera', 'asdasdas', '', ''),
(1414508297, 'Regular', '2020-12-21', '19:28', 2, 'Horas', 'https://www.pcfactory.cl/producto/36317-gear-desktop-intel-core-i7-9700f-8gb-1tb', 'En Espera', 'Hola (2)', '', ''),
(1950232597, 'Consejo de Escuela', '2020-12-25', '07:05', 1, 'Horas', 'asdasd', 'En Espera', 'asdasd', '', '');

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
-- Volcado de datos para la tabla `tema`
--

INSERT INTO `tema` (`tag`, `refreunion`, `nombre`, `id`) VALUES
('Editado', 1147321168, 'José', 197341747),
('Editado', 712741942, 'José', 406471310),
('Editado', 678221694, 'José', 411345838),
('', 985995937, 'chrimoyas con caca', 516003718),
('', 664128748, 'asdasaswd', 779814368),
('', 1950232597, 'asdasaswd', 860977191),
('Editado', 1414508297, 'José', 1022869303),
('', 992693321, 'sadasd', 1060333636),
('', 664128748, 'asdqweqwed', 1106834048),
('', 664128748, 'dasdasd', 1265985176),
('Editado', 847421058, 'José', 1276659114),
('', 1294339821, 'asdasdas', 2017435351);

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
