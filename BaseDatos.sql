
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
-- Estructura de tabla para la tabla `invitado`
--

--
-- Estructura de tabla para la tabla `acta`
--

CREATE TABLE `acta` (  
  `titulo` int(11) NOT NULL,
  `refreunion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `invitado` (
  `correo` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `relacionreunioninvitado`
--

CREATE TABLE `relacionreunioninvitado` (
  `refcorreo` varchar(50) NOT NULL,
  `refid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Estructura de tabla para la tabla `accion`
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

--
-- Indices de la tabla `invitado`
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
-- Indexes for table `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkreunion` (`refreunion`);

--
-- Indexes for table `acta`
--
ALTER TABLE `acta`
  ADD PRIMARY KEY (`titulo`),
  ADD KEY `fk_reunion` (`refreunion`);

--
-- Indexes for table `accion`
--
ALTER TABLE `accion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkreuniontema` (`refreunion`),
  ADD KEY `fkinvitado` (`refinvitado`),
  ADD KEY `fktema` (`reftema`);
--
-- Constraints for dumped tables
--

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

--
-- Constraints for table `acta`
--
ALTER TABLE `acta`
  ADD CONSTRAINT `fk_reunion` FOREIGN KEY (`refreunion`) REFERENCES `reunion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `accion`
--
ALTER TABLE `accion`
  ADD CONSTRAINT `fkreuniontema` FOREIGN KEY (`refreunion`) REFERENCES `reunion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fktema` FOREIGN KEY (`reftema`) REFERENCES `tema` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

