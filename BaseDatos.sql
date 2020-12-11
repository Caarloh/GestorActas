SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gestoractas`
--

-- --------------------------------------------------------

--
-- Table structure for table `accion`
--

CREATE TABLE `accion` (
  `nombre` varchar(50) NOT NULL,
  `refreunion` int(11) NOT NULL,
  `reftema` int(11) NOT NULL,
  `refinvitado` varchar(50) NOT NULL,
  `fechatermino` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acta`
--

CREATE TABLE `acta` (
  `titulo` int(11) NOT NULL,
  `refreunion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `consejo`
--

CREATE TABLE `consejo` (
  `correo` varchar(300) NOT NULL,
  `nombre` varchar(400) NOT NULL,
  `apellidos` varchar(400) NOT NULL,
  `contrasena` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invitado`
--

CREATE TABLE `invitado` (
  `correo` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `codigoAcceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `relacionreunioninvitado`
--

CREATE TABLE `relacionreunioninvitado` (
  `refcorreo` varchar(50) NOT NULL,
  `refid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reunion`
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
  `horaInicio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reunion`
--

INSERT INTO `reunion` (`id`, `tipoPredefinido`, `fecha`, `hora`, `duracion`, `tipoDuracion`, `linkReunion`, `estado`, `nombre`, `horaInicio`) VALUES
(1124387998, 'Extraordinaria', '2020-11-20', '09:00', 3, 'Horas', '', 'En Proceso', 'Reu2', '09:01'),
(1238353639, 'Regular', '2020-11-20', '09:00', 2, 'Horas', 'https://reuna.zoom.us/j/9975784070?pwd=dmQwMk1MWWFzME1FMWoxalZGUHQxQT09', '', '', ''),
(2106383345, 'Extraordinaria', '2020-12-20', '02:00', 3, 'Horas', '', 'En Espera', 'Hola', '');

-- --------------------------------------------------------

--
-- Table structure for table `tema`
--

CREATE TABLE `tema` (
  `tag` varchar(50) NOT NULL,
  `refreunion` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tema`
--

INSERT INTO `tema` (`tag`, `refreunion`, `nombre`, `id`) VALUES
('', 1124387998, 'Problemas Internos', 663380190);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accion`
--
ALTER TABLE `accion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkreuniontema` (`refreunion`),
  ADD KEY `fkinvitado` (`refinvitado`),
  ADD KEY `fktema` (`reftema`);

--
-- Indexes for table `acta`
--
ALTER TABLE `acta`
  ADD KEY `fk_reunion` (`refreunion`);

--
-- Indexes for table `consejo`
--
ALTER TABLE `consejo`
  ADD PRIMARY KEY (`correo`);

--
-- Indexes for table `invitado`
--
ALTER TABLE `invitado`
  ADD PRIMARY KEY (`correo`);

--
-- Indexes for table `relacionreunioninvitado`
--
ALTER TABLE `relacionreunioninvitado`
  ADD KEY `fkrelacioninvitado` (`refcorreo`),
  ADD KEY `fkrelacionreunion` (`refid`);

--
-- Indexes for table `reunion`
--
ALTER TABLE `reunion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkreunion` (`refreunion`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accion`
--
ALTER TABLE `accion`
  ADD CONSTRAINT `fkreuniontema` FOREIGN KEY (`refreunion`) REFERENCES `reunion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fktema` FOREIGN KEY (`reftema`) REFERENCES `tema` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `relacionreunioninvitado`
--
ALTER TABLE `relacionreunioninvitado`
  ADD CONSTRAINT `fkrelacioninvitado` FOREIGN KEY (`refcorreo`) REFERENCES `invitado` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkrelacionreunion` FOREIGN KEY (`refid`) REFERENCES `reunion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tema`
--
ALTER TABLE `tema`
  ADD CONSTRAINT `fkreunion` FOREIGN KEY (`refreunion`) REFERENCES `reunion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
