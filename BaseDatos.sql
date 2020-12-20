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
  `refinvitado` varchar(50) DEFAULT NULL,
  `fechatermino` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `refeditor` varchar(50) DEFAULT NULL,
  `comentario` varchar(1000) NOT NULL
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `correo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `asistenciacomite`
--

CREATE TABLE `asistenciacomite` (
  `refcorreo` varchar(50) NOT NULL,
  `refid` int(11) NOT NULL,
  `asistencia` varchar(50) NOT NULL DEFAULT 'NO'
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
  `refid` int(11) NOT NULL,
  `asistencia` varchar(50) NOT NULL DEFAULT 'NO'
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
  `horaInicio` varchar(50) NOT NULL,
  `horaTermino` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Indexes for dumped tables
--

--
-- Indexes for table `accion`
--
ALTER TABLE `accion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkreuniontema` (`refreunion`),
  ADD KEY `fktema` (`reftema`),
  ADD KEY `fkinvitado` (`refinvitado`);

--
-- Indexes for table `acta`
--
ALTER TABLE `acta`
  ADD KEY `fk_reunion` (`refreunion`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`correo`);

--
-- Indexes for table `asistenciacomite`
--
ALTER TABLE `asistenciacomite`
  ADD KEY `fkasistenciacorreo` (`refcorreo`),
  ADD KEY `fkasistenciareunion` (`refid`);

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
  ADD CONSTRAINT `fkinvitado` FOREIGN KEY (`refinvitado`) REFERENCES `invitado` (`correo`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkreuniontema` FOREIGN KEY (`refreunion`) REFERENCES `reunion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fktema` FOREIGN KEY (`reftema`) REFERENCES `tema` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fkadmin` FOREIGN KEY (`correo`) REFERENCES `consejo` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `asistenciacomite`
--
ALTER TABLE `asistenciacomite`
  ADD CONSTRAINT `fkasistenciacorreo` FOREIGN KEY (`refcorreo`) REFERENCES `consejo` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkasistenciareunion` FOREIGN KEY (`refid`) REFERENCES `reunion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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