-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-11-2019 a las 11:42:44
-- Versión del servidor: 10.1.41-MariaDB-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cardiocentro_manta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `Id_Area` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`Id_Area`, `Descripcion`) VALUES
(23, 'ADMINISTRACIÓN'),
(24, 'ANESTESIOLOGÍA'),
(25, 'CARDIOLOGÍA INTERVENCIONISTA'),
(26, 'CIRUGÍA CARDIOVASCULAR'),
(27, 'CIRUGÍA VASCULAR E INTERVENCIONISTA'),
(28, 'CARDIOLOGÍA CLÍNICA'),
(29, 'CIRUGÍA VASCULAR'),
(30, 'ELECTROCARDIOGRAMA'),
(31, 'TICS'),
(39, 'kl'),
(40, 'GDF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_roles`
--

CREATE TABLE `area_roles` (
  `Id_Area_Roles` int(11) NOT NULL,
  `Id_Area` int(11) DEFAULT NULL,
  `Id_Roles` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `area_roles`
--

INSERT INTO `area_roles` (`Id_Area_Roles`, `Id_Area`, `Id_Roles`) VALUES
(44, 23, 13),
(45, 31, 16),
(46, 31, 15),
(47, 31, 17),
(50, 30, 17),
(51, 30, 19),
(53, 30, 14),
(56, 23, 18),
(57, 28, 19),
(58, 28, 18),
(61, 24, 19),
(62, 24, 17),
(63, 29, 18),
(64, 25, 15),
(65, 25, 16),
(66, 23, 19),
(67, 39, 19),
(68, 39, 18),
(69, 39, 17),
(70, 25, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `Id_asistencia` int(11) NOT NULL,
  `Id_Usuario` int(11) DEFAULT NULL,
  `asistencia` int(11) DEFAULT NULL,
  `IdReunion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`Id_asistencia`, `Id_Usuario`, `asistencia`, `IdReunion`) VALUES
(1, 120, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conclusion`
--

CREATE TABLE `conclusion` (
  `Id_Conclusion` int(11) NOT NULL,
  `Conclusion` varchar(2000) NOT NULL,
  `Id_Itinerario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `Id_Documento` int(11) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Ruta` varchar(500) NOT NULL,
  `Id_Tarea` int(11) DEFAULT NULL,
  `Id_Usuario` int(11) DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`Id_Documento`, `Descripcion`, `Ruta`, `Id_Tarea`, `Id_Usuario`, `Fecha`) VALUES
(1, 'Evidencia 1', 'fds', 71, 120, NULL),
(2, 'Evidencia 2', 'fsd', 71, 120, NULL),
(3, 'kjl', 'WhatsApp Image 2019-08-04 at 4.32.21 PM.jpeg', 101, 120, '2019-11-03 00:46:55'),
(4, 'kj', 'solicitud beca.docx', 101, 120, '2019-11-03 00:47:06'),
(5, 'prbando', 'SOLICITUD.docx', 101, 120, '2019-11-03 01:26:43'),
(6, 'prbando', 'cargando-loading-037.gif', 101, 120, '2019-11-03 01:27:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_tarea`
--

CREATE TABLE `documento_tarea` (
  `IdDocumento_Tarea` int(11) NOT NULL,
  `Id_Documento` int(11) NOT NULL,
  `Id_Tarea` int(11) NOT NULL,
  `Id_Usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_tarea`
--

CREATE TABLE `estado_tarea` (
  `Id_Estado_Tarea` int(11) NOT NULL,
  `Descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado_tarea`
--

INSERT INTO `estado_tarea` (`Id_Estado_Tarea`, `Descripcion`) VALUES
(1, 'ACTIVA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `Id_Evento` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `FechaEvento` date NOT NULL,
  `Descripcion` varchar(300) NOT NULL,
  `FechaCreacion` date NOT NULL,
  `Id_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itinerario`
--

CREATE TABLE `itinerario` (
  `Id_Itinerario` int(11) NOT NULL,
  `Descripcion` varchar(500) NOT NULL,
  `Id_Reunion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observacion`
--

CREATE TABLE `observacion` (
  `Id_Observacion` int(11) NOT NULL,
  `Descripcion` varchar(5000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Id_Tarea` int(11) DEFAULT NULL,
  `Id_Usuario` int(11) DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL,
  `ObservacionID` int(11) DEFAULT NULL,
  `tipo` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `observacion`
--

INSERT INTO `observacion` (`Id_Observacion`, `Descripcion`, `Id_Tarea`, `Id_Usuario`, `Fecha`, `ObservacionID`, `tipo`) VALUES
(47, 'Cuales son los campos de la base de datos', 77, 120, '2019-10-17 00:00:00', NULL, 'C'),
(48, 'Quien diseña la interfaz', 77, 120, '2019-10-17 00:00:00', NULL, 'C'),
(49, 'Se encuentra en git hub', 77, 120, '2019-10-17 00:00:00', 47, 'S'),
(50, 'Jose', 72, 120, '2019-10-17 00:00:00', NULL, 'C'),
(51, 'Que paso', 72, 120, '2019-10-17 00:00:00', 50, 'S'),
(52, 'fsdf', 72, 120, '2019-10-17 00:00:00', 50, 'S'),
(53, 'se vaaaaaaa', 72, 120, '2019-10-17 00:00:00', NULL, 'C'),
(54, 'kjfskd', 75, 120, '2019-10-17 00:00:00', NULL, 'C'),
(55, 'kjfskd', 75, 120, '2019-10-17 00:00:00', NULL, 'C'),
(56, 'kjfskd', 75, 120, '2019-10-17 00:00:00', NULL, 'C'),
(57, 'fd', 75, 120, '2019-10-17 00:00:00', 54, 'S'),
(58, 'kjfskd', 75, 120, NULL, NULL, NULL),
(59, 'vdbvgbvgd', 75, 120, '2019-10-17 00:00:00', NULL, 'C'),
(60, 'vdbvgbvgd', 75, 120, NULL, NULL, NULL),
(61, 'hhhh', 72, 120, '2019-10-17 00:00:00', 53, 'S'),
(62, 'jjjj', 72, 117, '2019-10-17 00:00:00', NULL, 'C'),
(63, 'jjjj', 72, 117, '2019-10-17 00:00:00', NULL, 'C'),
(64, 'si se va', 72, 117, '2019-10-17 00:00:00', 53, 'S'),
(65, 'kkkk', 75, 117, '2019-10-17 00:00:00', NULL, 'C'),
(66, 'yoo', 77, 117, '2019-10-17 00:00:00', 48, 'S'),
(67, 'git', 77, 117, '2019-10-17 00:00:00', NULL, 'C'),
(68, 'kfjdkfdfdkj', 72, 120, '2019-10-17 00:00:00', NULL, 'C'),
(69, 'jskfd', 72, 120, '2019-10-17 00:00:00', NULL, 'C'),
(70, 'bjhkl', 72, 120, '2019-10-17 00:00:00', NULL, 'C'),
(71, 'jklfd', 72, 120, '2019-10-17 00:00:00', NULL, 'C'),
(72, 'kjs', 72, 120, '2019-10-17 00:00:00', 50, 'S'),
(73, 'fs,fj', 72, 120, '2019-10-17 00:00:00', 50, 'S'),
(74, 'kldksldskdkls', 72, 120, '2019-10-27 12:42:53', NULL, 'C'),
(75, 'gfhdfghf', 86, 120, '2019-10-31 12:20:15', NULL, 'C'),
(76, 'cfghjk', 76, 120, '2019-10-31 17:12:55', NULL, 'C'),
(77, 'cgfvhjn', 76, 120, '2019-10-31 17:13:00', NULL, 'C'),
(78, 'soy edwin', 76, 117, '2019-10-31 17:28:29', NULL, 'C'),
(79, 'soy jose', 76, 120, '2019-10-31 17:28:52', NULL, 'C'),
(80, 'hjhjh', 76, 117, '2019-10-31 17:29:06', NULL, 'C'),
(81, 'jhghj', 76, 116, '2019-11-01 10:01:52', NULL, 'C'),
(82, 'jjj', 76, 116, '2019-11-01 10:02:01', NULL, 'C'),
(83, 'kjhgf', 98, 116, '2019-11-01 13:37:28', NULL, 'C'),
(84, 'grdgdfs', 101, 116, '2019-11-01 13:44:42', NULL, 'C'),
(85, 'siii el codigo q ya voy a completar el manual del programador', 104, 117, '2019-11-03 02:38:09', NULL, 'C'),
(86, 'SI YA MISMO TE SUBO LOS CAMBIOS DEJAME CORREGIR CIERTAS COSITAS Y YA', 104, 120, '2019-11-03 02:52:41', 85, 'S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observacion_reunion`
--

CREATE TABLE `observacion_reunion` (
  `Id_observacion_reunion` int(11) NOT NULL,
  `Descripcion` varchar(5000) DEFAULT NULL,
  `Id_Reunion` int(11) DEFAULT NULL,
  `Id_Usuario` int(11) DEFAULT NULL,
  `Observacion_ID` int(11) DEFAULT NULL,
  `Tipo` varchar(10) DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `observacion_reunion`
--

INSERT INTO `observacion_reunion` (`Id_observacion_reunion`, `Descripcion`, `Id_Reunion`, `Id_Usuario`, `Observacion_ID`, `Tipo`, `Fecha`) VALUES
(1, 'fdsfdsfdsfdsa', 11, 120, NULL, 'C', '2019-10-31 00:00:00'),
(2, 'lllllllllll', 11, 120, 1, 'S', '2019-10-31 00:00:00'),
(3, 'fdsdfasdfsadfas', 11, 120, NULL, 'C', '2019-10-31 09:46:52'),
(4, 'ESTE ES MI COMENTARIOS', 11, 120, NULL, 'C', '2019-10-31 09:48:09'),
(5, 'ESTE TAMBIEN', 11, 120, NULL, 'C', '2019-10-31 09:48:20'),
(6, 'PROBANDO', 11, 120, NULL, 'C', '2019-10-31 09:54:28'),
(7, '123', 11, 120, 6, 'S', '2019-10-31 09:54:39'),
(8, '54', 11, 120, 6, 'S', '2019-10-31 09:54:46'),
(9, NULL, 11, 120, NULL, 'C', '2019-10-31 09:58:11'),
(10, 'PUEDO HACER UNA PREGUNTA', 12, 120, NULL, 'C', '2019-10-31 10:33:33'),
(11, 'SI DIGAME CON TODO GUSTO', 12, 120, 10, 'S', '2019-10-31 10:33:46'),
(12, 'QUE ES LA POO', 12, 120, 10, 'S', '2019-10-31 10:34:02'),
(13, 'BUENO PUES ES UNA PROGRAMACION ORIENTADA A OBJETOS', 12, 120, 10, 'S', '2019-10-31 10:34:24'),
(14, 'nbmnbvcx', 12, 120, NULL, 'C', '2019-10-31 10:38:11'),
(15, 'fds', 1, 120, NULL, 'C', '2019-10-31 11:31:52'),
(16, 'fsd', 1, 120, NULL, 'C', '2019-10-31 11:31:53'),
(17, 'lkjghfds', 9, 120, NULL, 'C', '2019-10-31 12:30:13'),
(18, 'gfds', 9, 120, NULL, 'C', '2019-10-31 12:30:17'),
(19, 'gdf', 9, 120, NULL, 'C', '2019-10-31 12:30:19'),
(20, 'gdfsgdfsg', 9, 120, 19, 'S', '2019-10-31 12:30:26'),
(21, NULL, 16, 117, NULL, 'C', '2019-11-03 01:46:47'),
(22, 'GFD', 1, 120, NULL, 'C', '2019-11-03 03:25:25'),
(23, 'GDGDF', 1, 120, 22, 'S', '2019-11-03 03:25:39'),
(24, 'yaaa', 16, 117, NULL, 'C', '2019-11-03 03:26:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observador_usuario`
--

CREATE TABLE `observador_usuario` (
  `IdObservador_Usuario` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Id_Tarea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `observador_usuario`
--

INSERT INTO `observador_usuario` (`IdObservador_Usuario`, `Id_Usuario`, `Id_Tarea`) VALUES
(34, 117, 68),
(35, 120, 69),
(36, 117, 70),
(37, 118, 71),
(39, 119, 73),
(59, 116, 75),
(60, 120, 75),
(61, 120, 72),
(62, 116, 94),
(63, 119, 74),
(66, 118, 97),
(68, 118, 77),
(69, 118, 76),
(70, 120, 76),
(71, 116, 98),
(72, 117, 98),
(73, 120, 99),
(74, 120, 100),
(76, 119, 101),
(77, 120, 101),
(78, 117, 102);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante_reunion_usuario`
--

CREATE TABLE `participante_reunion_usuario` (
  `Id_participante_reunion_usuario` int(11) NOT NULL,
  `Id_Usuario` int(11) DEFAULT NULL,
  `Id_Reunion` int(11) DEFAULT NULL,
  `asistencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `participante_reunion_usuario`
--

INSERT INTO `participante_reunion_usuario` (`Id_participante_reunion_usuario`, `Id_Usuario`, `Id_Reunion`, `asistencia`) VALUES
(2, 120, 1, 1),
(3, 116, 1, 1),
(4, 117, 1, 1),
(5, 117, 8, 0),
(6, 119, 8, 0),
(7, 117, 9, 0),
(8, 120, 9, 0),
(9, 118, 10, 2),
(10, 119, 10, 1),
(11, 120, 10, 1),
(12, 116, 11, 1),
(13, 117, 11, 1),
(14, 118, 11, 1),
(15, 119, 11, 1),
(16, 120, 11, 1),
(17, 116, 12, 1),
(18, 117, 12, 1),
(19, 118, 12, 1),
(20, 119, 12, 1),
(21, 120, 12, 1),
(22, 116, 16, 1),
(23, 117, 16, 1),
(24, 116, 17, 2),
(25, 118, 17, 1),
(26, 119, 17, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante_usuario`
--

CREATE TABLE `participante_usuario` (
  `Id_Particpanteusuario` int(11) NOT NULL,
  `Id_Tarea` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `participante_usuario`
--

INSERT INTO `participante_usuario` (`Id_Particpanteusuario`, `Id_Tarea`, `Id_Usuario`) VALUES
(47, 68, 119),
(48, 69, 117),
(49, 69, 119),
(50, 70, 118),
(51, 70, 119),
(52, 70, 120),
(53, 71, 120),
(57, 73, 120),
(62, 78, 119),
(68, 75, 117),
(69, 75, 118),
(70, 72, 117),
(71, 72, 118),
(72, 72, 119),
(76, 94, 118),
(77, 74, 119),
(81, 97, 117),
(84, 77, 116),
(85, 77, 119),
(86, 76, 117),
(87, 76, 119),
(88, 98, 117),
(89, 98, 118),
(90, 98, 120),
(91, 99, 120),
(92, 100, 119),
(94, 101, 120),
(95, 102, 120),
(96, 104, 117),
(97, 104, 120);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsableusuario`
--

CREATE TABLE `responsableusuario` (
  `IdResponsableUsuario` int(11) NOT NULL,
  `Id_Tarea` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `responsableusuario`
--

INSERT INTO `responsableusuario` (`IdResponsableUsuario`, `Id_Tarea`, `Id_Usuario`) VALUES
(52, 68, 118),
(53, 69, 118),
(54, 70, 117),
(55, 71, 119),
(57, 73, 117),
(61, 78, 118),
(68, 75, 120),
(69, 72, 120),
(74, 82, 117),
(75, 81, 117),
(76, 92, 120),
(77, 93, 120),
(78, 94, 120),
(79, 86, 120),
(80, 74, 117),
(81, 74, 120),
(82, 87, 120),
(86, 97, 120),
(88, 77, 117),
(89, 77, 120),
(90, 76, 120),
(91, 98, 119),
(92, 98, 120),
(93, 99, 119),
(94, 99, 120),
(95, 100, 117),
(97, 101, 120),
(98, 102, 118),
(99, 104, 120);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsable_reunion_usuario`
--

CREATE TABLE `responsable_reunion_usuario` (
  `Id_responsable_reunion_usuario` int(11) NOT NULL,
  `Id_Reunion` int(11) DEFAULT NULL,
  `Id_Usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `responsable_reunion_usuario`
--

INSERT INTO `responsable_reunion_usuario` (`Id_responsable_reunion_usuario`, `Id_Reunion`, `Id_Usuario`) VALUES
(1, 1, 120),
(2, 8, 116),
(3, 9, 118),
(4, 10, 119),
(5, 11, 118),
(6, 12, 119),
(7, 16, 116),
(8, 17, 117),
(9, 18, 116),
(10, 19, 119);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restauracionclave`
--

CREATE TABLE `restauracionclave` (
  `Id_RestaruracionClave` int(11) NOT NULL,
  `Token_Email` varchar(100) NOT NULL,
  `Id_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reunion`
--

CREATE TABLE `reunion` (
  `Id_Reunion` int(11) NOT NULL,
  `Tema` varchar(450) NOT NULL,
  `Orden_del_Dia` text NOT NULL,
  `Estado` varchar(450) NOT NULL,
  `FechaCreacion` datetime DEFAULT NULL,
  `Lugar` varchar(450) DEFAULT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `FechadeReunion` date DEFAULT NULL,
  `HoraReunion` time DEFAULT NULL,
  `Conclusion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reunion`
--

INSERT INTO `reunion` (`Id_Reunion`, `Tema`, `Orden_del_Dia`, `Estado`, `FechaCreacion`, `Lugar`, `Id_Usuario`, `FechadeReunion`, `HoraReunion`, `Conclusion`) VALUES
(1, 'Hola', 'kjdsfhgijdf', 'Terminada', '0000-00-00 00:00:00', 'fds', 120, '0000-00-00', '00:00:00', 'si fiodsjfljasldkjfadskonfads\nfadsf\nadsf\nasd\nfsd\nf\nds'),
(2, 'jfnd', 'fsd', 'Pendiente', NULL, NULL, 120, NULL, NULL, ''),
(3, 'fadsf', 'fsadf', 'Pendiente', '2019-10-30 00:00:00', 'fasdf', 120, '2019-10-30', '01:12:00', ''),
(4, 'fsd', 'fsd', 'Pendiente', '2019-10-30 01:16:20', 'fsd', 120, '2019-10-30', '01:16:00', ''),
(5, 'nbjhk', 'kj', 'Pendiente', '2019-10-30 01:22:40', 'kj', 120, '2019-10-30', '01:56:00', ''),
(6, 'jklkjlk', 'kj', 'Pendiente', '2019-10-30 01:23:32', 'kk', 120, '2019-10-30', '02:06:00', ''),
(7, 'fdsg', 'fsd', 'Pendiente', '2019-10-30 01:25:30', 'fdsf', 120, '2019-10-30', '01:25:00', ''),
(8, 'kjl', 'kl', 'Pendiente', '2019-10-30 01:28:21', 'lk', 120, '2019-10-30', '01:45:00', ''),
(9, 'SUSTENTACION', 'PRESENTAR\nEXPONER\nPREGUNTAS', 'Pendiente', '2019-10-30 03:54:40', 'ESPAM MEFL', 120, '2019-10-30', '03:56:51', ''),
(10, 'esta si', 'fhas\ngsdfg\ngs\ngsd', 'Pendiente', '2019-10-30 21:30:48', 'calceta', 120, '2019-10-30', '21:30:28', ''),
(11, 'kl', 'k', 'Pendiente', '2019-10-30 22:59:51', 'k', 120, '2019-10-30', '22:59:34', ''),
(12, 'REUNION DE DOCENTES', '1. Presentarse\n2. Exponer\n3. Cantar\n4. IR a comer', 'Pendiente', '2019-10-31 10:03:13', 'ESPAM', 120, '2019-10-31', '10:03:15', ''),
(13, 'dsa', 'dasd\ndasd', 'Pendiente', '2019-10-31 10:12:18', 'das', 120, '2019-10-31', '10:12:09', ''),
(14, 'gdfs', 'gdfs\ngds\ngdsf', 'Pendiente', '2019-10-31 10:12:38', 'gds', 120, '2019-10-31', '10:12:33', ''),
(15, 'ter', 'gfd\ngdf\ngdf\ng\ndfg', 'Pendiente', '2019-10-31 10:19:21', 't', 120, '2019-10-31', '10:19:14', ''),
(16, 'Nueva reunion', 'Revisar tesis con el Ing. Joffre', 'Pendiente', '2019-11-03 01:43:50', 'Portoviejo', 117, '2019-11-04', '01:45:08', ''),
(17, 'Otra reunion', 'nueva fecha de reunion', 'Pendiente', '2019-11-03 01:48:55', 'Calceta', 117, '2019-11-04', '01:48:14', ''),
(18, 'jj', 'h', 'Pendiente', '2019-11-03 03:34:11', 'n', 120, '2019-11-04', '02:33:41', ''),
(19, 'SD', 'FDS', 'Pendiente', '2019-11-03 03:37:09', 'FSD', 120, '2019-11-03', '03:37:31', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `Id_Roles` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `nivel` int(11) DEFAULT NULL,
  `Id_Sub_Area` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`Id_Roles`, `Descripcion`, `nivel`, `Id_Sub_Area`) VALUES
(13, 'Enfermero', 1, 2),
(14, 'Secretario', 2, 1),
(15, 'Técnico', 5, 1),
(16, 'Programador', 5, 1),
(17, 'Tester', 5, 1),
(18, 'Cardiólogo', 6, 2),
(19, 'Neurólogo', 5, 2),
(27, 'jjh', 6, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_area`
--

CREATE TABLE `sub_area` (
  `Id_Sub_Area` int(11) NOT NULL,
  `Descripcion` varchar(450) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Id_Area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sub_area`
--

INSERT INTO `sub_area` (`Id_Sub_Area`, `Descripcion`, `Id_Area`) VALUES
(1, 'SubAdmin2', 23),
(2, 'OtherSubArea', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE `tarea` (
  `Id_tarea` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Estado_Tarea` varchar(450) COLLATE latin1_danish_ci NOT NULL,
  `Id_Tipo_Tarea` int(11) DEFAULT NULL,
  `Nombre` varchar(100) CHARACTER SET latin1 NOT NULL,
  `FechaInicio` date NOT NULL,
  `Hora_Inicio` time DEFAULT NULL,
  `FechaFin` date NOT NULL,
  `Hora_Fin` time DEFAULT NULL,
  `FechaCreacion` date NOT NULL,
  `Descripcion` varchar(60000) CHARACTER SET latin1 NOT NULL,
  `tareaFavorita` int(11) DEFAULT NULL,
  `tareasIdTareas` int(11) DEFAULT NULL,
  `tip_tar` varchar(1) COLLATE latin1_danish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_danish_ci;

--
-- Volcado de datos para la tabla `tarea`
--

INSERT INTO `tarea` (`Id_tarea`, `Id_Usuario`, `Estado_Tarea`, `Id_Tipo_Tarea`, `Nombre`, `FechaInicio`, `Hora_Inicio`, `FechaFin`, `Hora_Fin`, `FechaCreacion`, `Descripcion`, `tareaFavorita`, `tareasIdTareas`, `tip_tar`) VALUES
(68, 120, 'Vencida', 5, 'Realizar Organigram', '2019-09-30', '16:59:00', '2019-10-05', '16:59:00', '2019-09-06', 'Deben incluir las áreas y subareas en la APP MOVIL', 1, NULL, 'T'),
(69, 120, 'Terminada', 5, 'Sub Organigrama', '2019-09-30', '05:01:00', '2019-09-30', '05:01:00', '2019-09-06', 'Trabajar', 1, 68, 'S'),
(70, 120, 'Vencida', 4, 'Tarea2', '2019-09-30', '17:02:00', '2019-09-30', '17:02:00', '2019-09-06', 'Trabajar', 1, NULL, 'T'),
(71, 120, 'Terminada', 5, 'hgff', '2019-10-10', '10:39:00', '2019-10-10', '10:39:00', '2019-09-06', 'fds', 1, 70, 'S'),
(72, 120, 'Vencida', 5, 'REUNION CON EL EQUIPO', '2019-10-17', '02:31:00', '2019-10-24', '15:22:00', '2019-09-06', 'REUNIRSE EL LUNES', 1, NULL, 'T'),
(73, 120, 'Vencida', 5, 'Roles', '2019-10-14', '11:08:00', '2019-10-14', '11:08:00', '2019-09-06', 'Tratar los roles de los empleados', 1, 72, 'S'),
(74, 120, 'Terminada', 5, 'ree', '2019-10-14', '11:10:00', '2019-10-14', '11:10:00', '2019-09-06', 'fds', 1, 73, 'S'),
(75, 120, 'Terminada', 5, 'x', '2019-10-14', '11:13:00', '2019-10-14', '11:13:00', '2019-09-06', 'x', 1, 74, 'S'),
(76, 120, 'Terminada', 5, 'LIMPIAR AIRE ACONDICIONADOS', '2019-10-15', '18:00:00', '2019-11-16', '18:00:00', '2019-09-06', 'El area de docentes', 1, NULL, 'T'),
(77, 120, 'Terminada', 5, 'PROGRAMAR EL MODULO DE REUNION', '2019-10-17', '08:00:00', '2019-10-30', '18:00:00', '2019-09-06', 'PRESENTARLE A JOFFRE EL DIA 30 DE OCTUBRE', 1, NULL, 'T'),
(78, 120, 'Pendiente', 5, 'kldfdkld', '2019-10-26', '03:42:00', '2019-11-26', '03:02:00', '2019-09-06', 'kjd', 1, NULL, 'T'),
(79, 117, 'Vencida', 4, 'tarea personal', '2019-10-25', '12:27:00', '2019-10-27', '13:00:00', '2019-09-06', 'hhhh', 1, NULL, 'T'),
(80, 117, 'Vencida', 2, 'tarea personal', '2019-10-25', '12:27:00', '2019-10-27', '13:00:00', '2019-09-06', 'hhhh', 1, NULL, 'T'),
(81, 117, 'Terminada', 4, 'PROBANDO TAREAS', '2019-01-20', '03:01:00', '2019-01-30', '16:01:00', '2019-09-06', 'aki probando esto', 1, 79, 'S'),
(82, 117, 'Vencida', 2, 'NUEVA TAREA', '2019-02-20', '07:04:00', '2019-03-21', '05:02:00', '2019-09-06', 'FSDFDF', 1, NULL, 'T'),
(83, 117, 'Pendiente', 2, 'fdgfd', '2019-10-27', '12:39:00', '2019-10-27', '12:39:00', '2019-09-06', 'gdfg', 1, 82, 'S'),
(84, 117, 'Pendiente', 2, 'ggg', '2019-10-27', '12:41:00', '2019-10-27', '12:41:00', '2019-09-06', 'gggg', 1, 83, 'S'),
(85, 120, 'Vencida', 5, 'KNJ', '2019-10-27', '02:01:00', '2019-10-27', '15:32:00', '2019-09-06', 'KJKJ', 1, 76, 'S'),
(86, 120, 'Terminada', 5, 'KKKKKKKK', '2019-10-27', '05:06:00', '2019-10-27', '18:07:00', '2019-09-06', 'KKKKKK', 1, 72, 'S'),
(87, 120, 'Vencida', 5, 'kjhjhkj', '2019-10-27', '12:19:00', '2019-10-27', '12:19:00', '2019-09-06', 'nmk', 1, 77, 'S'),
(88, 120, 'Vencida', 5, 'nose q pone', '2019-10-27', '03:21:00', '2019-01-27', '03:02:00', '2019-10-27', 'kfmdlk', 1, NULL, 'T'),
(89, 120, 'Vencida', 5, 'hgfh', '2019-07-27', '14:20:05', '2019-10-27', '14:20:05', '2019-10-27', 'gdfg', 1, NULL, 'T'),
(90, 120, 'Vencida', 5, 'j', '2019-10-27', '15:33:00', '2019-10-27', '15:33:27', '2019-10-27', 'j', 1, NULL, 'T'),
(91, 120, 'Pendiente', 5, 'fds', '2019-10-27', '15:36:00', '2019-11-27', '15:36:00', '2019-10-27', 'fs', 1, NULL, 'T'),
(92, 117, 'Terminada', 4, 'fds', '2019-10-28', '00:41:04', '2019-10-28', '00:41:04', '2019-10-28', 'fds', 1, 81, 'S'),
(93, 117, 'Terminada', 4, 'fsdf', '2019-10-28', '00:42:55', '2019-10-28', '00:42:55', '2019-10-28', 'fsdf', 1, 81, 'S'),
(94, 117, 'Terminada', 4, 'fdsfdsfs', '2019-10-28', '00:45:37', '2019-10-28', '00:45:37', '2019-10-28', 'fsdf', 1, 81, 'S'),
(95, 117, 'Pendiente', 5, 'tarea vencida', '2019-10-28', '12:10:15', '2019-10-28', '12:21:15', '2019-10-28', 'fdsfdf', 1, 82, 'S'),
(96, 117, 'Vencida', 5, 'tareaaaaaa  vencida 2', '2019-10-28', '11:24:18', '2019-10-29', '11:24:18', '2019-10-28', 'cdcdsdf', 1, NULL, 'T'),
(97, 120, 'Terminada', 5, 'nnn', '2019-10-31', '16:20:57', '2019-10-31', '16:20:57', '2019-10-31', 'nk', 1, 72, 'S'),
(98, 116, 'Vencida', 5, 'jhgfdss', '2019-11-01', '13:34:52', '2019-11-01', '13:43:52', '2019-11-01', 'gfds', 1, NULL, 'T'),
(99, 116, 'Vencida', 5, 'jose nose', '2019-11-01', '13:38:40', '2019-11-01', '13:38:40', '2019-11-01', 'fsadfasdf', 1, NULL, 'T'),
(100, 116, 'Vencida', 5, 'jhgfds', '2019-11-01', '13:39:20', '2019-11-01', '13:39:20', '2019-11-01', 'gdgd', 1, NULL, 'T'),
(101, 116, 'Pendiente', 5, 'esta si vale', '2019-11-03', '13:59:26', '2019-11-04', '13:41:26', '2019-11-01', 'hgfdd', 1, NULL, 'T'),
(102, 116, 'Pendiente', 5, 'sub', '2019-11-01', '13:59:44', '2019-11-01', '13:59:44', '2019-11-01', 'fsfs', 1, 101, 'S'),
(103, 120, 'Pendiente', 5, 'fds', '2019-11-04', '01:17:08', '2019-11-06', '01:17:08', '2019-11-03', 'fds', 1, NULL, 'T'),
(104, 120, 'Pendiente', 5, 'PROBANDO CON EDWIN', '2019-11-04', '02:34:52', '2019-11-05', '02:34:52', '2019-11-03', 'ESTA TAREA ES DE PRUEBA YA MISMO TE SUBO LOS CAMBIOS PILAS EDWIN', 1, NULL, 'T'),
(105, 120, 'Vencida', 4, 'psaraj', '2019-11-03', '04:19:08', '2019-11-03', '04:19:08', '2019-11-03', 'fds', 1, NULL, 'T'),
(106, 120, 'Terminada', 4, 'tarea personal jose', '2019-11-04', '04:20:23', '2019-11-05', '04:20:23', '2019-11-03', 'jfkdfjsd', 1, NULL, 'T'),
(107, 120, 'Terminada', 4, 'ew', '2019-11-04', '04:31:56', '2019-12-03', '04:31:56', '2019-11-03', 'ds', 1, NULL, 'T');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_tarea`
--

CREATE TABLE `tipo_tarea` (
  `Id_Tipo_Tarea` int(11) NOT NULL,
  `Descripcion` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_tarea`
--

INSERT INTO `tipo_tarea` (`Id_Tipo_Tarea`, `Descripcion`) VALUES
(1, 'Tarea'),
(2, 'Proyecto'),
(3, 'Reunión'),
(4, 'Personal'),
(5, 'Laboral');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuarios`
--

CREATE TABLE `tipo_usuarios` (
  `Id_Tipo_Usuario` int(11) NOT NULL,
  `Descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_usuarios`
--

INSERT INTO `tipo_usuarios` (`Id_Tipo_Usuario`, `Descripcion`) VALUES
(1, 'Empleado'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id_Usuario` int(11) NOT NULL,
  `Nombre` varchar(500) DEFAULT NULL,
  `Apellido` varchar(500) DEFAULT NULL,
  `Cedula` varchar(10) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Celular` varchar(11) DEFAULT NULL,
  `Sexo` varchar(10) DEFAULT NULL,
  `Id_tipo_Usuarios` int(11) DEFAULT NULL,
  `Password` varchar(450) NOT NULL,
  `Instagram` varchar(450) NOT NULL,
  `Twitter` varchar(450) NOT NULL,
  `Facebook` varchar(450) NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Intereses` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id_Usuario`, `Nombre`, `Apellido`, `Cedula`, `email`, `Direccion`, `Celular`, `Sexo`, `Id_tipo_Usuarios`, `Password`, `Instagram`, `Twitter`, `Facebook`, `Fecha_Nacimiento`, `Intereses`) VALUES
(116, 'José Leonardo', 'Sabando Valencia', '0000000001', 'leonardosabando@gmail.com', 'Calceta', '0979932503', 'M', 2, 'am9zZTE5OTU=', '@joseleonardo', '@joseleonardodsas', 'leonardosabandofacebook.com', '2019-11-01', 'me gusta programar'),
(117, 'Edwin', 'Moreira', '000000002', 'edwin@gmail.com', 'Calceta', '0000000000', 'M', 1, 'MTIz', '', '', 'ed', '0000-00-00', ''),
(118, 'JC', 'Solorzano', '0000000003', 'jc@gmail.com', 'Chone', '000000000', 'M', 1, 'MTIz', '', '', '', '0000-00-00', ''),
(119, 'Tito', 'Barreiro', '0000000004', 'tito@gmail.com', 'Chone', '00000000', 'M', 1, 'MTIz', '', '', '', '0000-00-00', ''),
(120, 'Leonardo', 'Sabando', '1315221563', 'leonardo@gmail.com', 'Calceta', '0979932503', 'M', 1, 'MTIz', '@jose', '', '', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_roles`
--

CREATE TABLE `usuario_roles` (
  `Id_Usuario_Roles` int(11) NOT NULL,
  `Id_Usuario` int(11) DEFAULT NULL,
  `Id_Roles` int(11) DEFAULT NULL,
  `Id_Area` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_roles`
--

INSERT INTO `usuario_roles` (`Id_Usuario_Roles`, `Id_Usuario`, `Id_Roles`, `Id_Area`) VALUES
(76, 116, 16, 23),
(77, 117, 18, 24),
(78, 118, 18, 24),
(79, 119, 18, 24),
(80, 120, 15, 23);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`Id_Area`);

--
-- Indices de la tabla `area_roles`
--
ALTER TABLE `area_roles`
  ADD PRIMARY KEY (`Id_Area_Roles`),
  ADD KEY `AreaFK_idx` (`Id_Area`),
  ADD KEY `RolesFK_idx` (`Id_Roles`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`Id_asistencia`),
  ADD KEY `AsistenciaFkUsuario_idx` (`Id_Usuario`),
  ADD KEY `AsistenciaReunionFk_idx` (`IdReunion`);

--
-- Indices de la tabla `conclusion`
--
ALTER TABLE `conclusion`
  ADD PRIMARY KEY (`Id_Conclusion`),
  ADD UNIQUE KEY `Id_Itinerario` (`Id_Itinerario`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`Id_Documento`),
  ADD KEY `TareaFKDoc_idx` (`Id_Tarea`),
  ADD KEY `UsuarioFkDoc_idx` (`Id_Usuario`);

--
-- Indices de la tabla `documento_tarea`
--
ALTER TABLE `documento_tarea`
  ADD PRIMARY KEY (`IdDocumento_Tarea`),
  ADD KEY `DocumentoFK_idx` (`Id_Documento`),
  ADD KEY `TareaFK_idx` (`Id_Tarea`),
  ADD KEY `UsuariosFkDoc_idx` (`Id_Usuario`);

--
-- Indices de la tabla `estado_tarea`
--
ALTER TABLE `estado_tarea`
  ADD PRIMARY KEY (`Id_Estado_Tarea`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`Id_Evento`),
  ADD KEY `UsuarioFk_idx` (`Id_Usuario`);

--
-- Indices de la tabla `itinerario`
--
ALTER TABLE `itinerario`
  ADD PRIMARY KEY (`Id_Itinerario`),
  ADD KEY `ReunionFK_idx` (`Id_Reunion`);

--
-- Indices de la tabla `observacion`
--
ALTER TABLE `observacion`
  ADD PRIMARY KEY (`Id_Observacion`),
  ADD KEY `TareaFKObser_idx` (`Id_Tarea`),
  ADD KEY `UsuarioFKObser_idx` (`Id_Usuario`),
  ADD KEY `ObservacionFk_idx` (`ObservacionID`);

--
-- Indices de la tabla `observacion_reunion`
--
ALTER TABLE `observacion_reunion`
  ADD PRIMARY KEY (`Id_observacion_reunion`),
  ADD KEY `ObserUserFk_idx` (`Id_Usuario`),
  ADD KEY `OBserreunionFk_idx` (`Id_Reunion`),
  ADD KEY `ObserObseFK_idx` (`Observacion_ID`);

--
-- Indices de la tabla `observador_usuario`
--
ALTER TABLE `observador_usuario`
  ADD PRIMARY KEY (`IdObservador_Usuario`),
  ADD KEY `UserFk_idx` (`Id_Usuario`),
  ADD KEY `Task_idx` (`Id_Tarea`);

--
-- Indices de la tabla `participante_reunion_usuario`
--
ALTER TABLE `participante_reunion_usuario`
  ADD PRIMARY KEY (`Id_participante_reunion_usuario`),
  ADD KEY `participante_reunion_usuario_FK_Usuario_idx` (`Id_Usuario`),
  ADD KEY `participante_reunion_usuario_FK_Reuniones_idx` (`Id_Reunion`);

--
-- Indices de la tabla `participante_usuario`
--
ALTER TABLE `participante_usuario`
  ADD PRIMARY KEY (`Id_Particpanteusuario`),
  ADD KEY `Usuario_idx` (`Id_Usuario`),
  ADD KEY `TareaFK_idx` (`Id_Tarea`);

--
-- Indices de la tabla `responsableusuario`
--
ALTER TABLE `responsableusuario`
  ADD PRIMARY KEY (`IdResponsableUsuario`),
  ADD KEY `UserReFK_idx` (`Id_Usuario`),
  ADD KEY `TareaReFK_idx` (`Id_Tarea`);

--
-- Indices de la tabla `responsable_reunion_usuario`
--
ALTER TABLE `responsable_reunion_usuario`
  ADD PRIMARY KEY (`Id_responsable_reunion_usuario`),
  ADD KEY `responsable_reunion_usuario_FKUser_idx` (`Id_Usuario`),
  ADD KEY `responsable_reunion_usuario_FK_Reunion_idx` (`Id_Reunion`);

--
-- Indices de la tabla `restauracionclave`
--
ALTER TABLE `restauracionclave`
  ADD PRIMARY KEY (`Id_RestaruracionClave`),
  ADD KEY `ResCFK_idx` (`Id_Usuario`);

--
-- Indices de la tabla `reunion`
--
ALTER TABLE `reunion`
  ADD PRIMARY KEY (`Id_Reunion`),
  ADD KEY `UserReunionFK_idx` (`Id_Usuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id_Roles`),
  ADD KEY `IdSubAreaFK_idx` (`Id_Sub_Area`);

--
-- Indices de la tabla `sub_area`
--
ALTER TABLE `sub_area`
  ADD PRIMARY KEY (`Id_Sub_Area`,`Id_Area`),
  ADD KEY `AreaFKSubArea_idx` (`Id_Area`);

--
-- Indices de la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD PRIMARY KEY (`Id_tarea`),
  ADD KEY `UserTFk_idx` (`Id_Usuario`),
  ADD KEY `TipoTaskFK_idx` (`Id_Tipo_Tarea`),
  ADD KEY `tareaIDRecursi_idx` (`tareasIdTareas`);

--
-- Indices de la tabla `tipo_tarea`
--
ALTER TABLE `tipo_tarea`
  ADD PRIMARY KEY (`Id_Tipo_Tarea`);

--
-- Indices de la tabla `tipo_usuarios`
--
ALTER TABLE `tipo_usuarios`
  ADD PRIMARY KEY (`Id_Tipo_Usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id_Usuario`),
  ADD KEY `TipoUsuariosFK_idx` (`Id_tipo_Usuarios`);

--
-- Indices de la tabla `usuario_roles`
--
ALTER TABLE `usuario_roles`
  ADD PRIMARY KEY (`Id_Usuario_Roles`),
  ADD KEY `RolesFK_idx` (`Id_Roles`),
  ADD KEY `UsuariosFK_idx` (`Id_Usuario`),
  ADD KEY `AreaFKRol_idx` (`Id_Area`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `Id_Area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT de la tabla `area_roles`
--
ALTER TABLE `area_roles`
  MODIFY `Id_Area_Roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `Id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `conclusion`
--
ALTER TABLE `conclusion`
  MODIFY `Id_Conclusion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `Id_Documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `documento_tarea`
--
ALTER TABLE `documento_tarea`
  MODIFY `IdDocumento_Tarea` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estado_tarea`
--
ALTER TABLE `estado_tarea`
  MODIFY `Id_Estado_Tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `Id_Evento` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `observacion`
--
ALTER TABLE `observacion`
  MODIFY `Id_Observacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT de la tabla `observacion_reunion`
--
ALTER TABLE `observacion_reunion`
  MODIFY `Id_observacion_reunion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `observador_usuario`
--
ALTER TABLE `observador_usuario`
  MODIFY `IdObservador_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT de la tabla `participante_reunion_usuario`
--
ALTER TABLE `participante_reunion_usuario`
  MODIFY `Id_participante_reunion_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `participante_usuario`
--
ALTER TABLE `participante_usuario`
  MODIFY `Id_Particpanteusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT de la tabla `responsableusuario`
--
ALTER TABLE `responsableusuario`
  MODIFY `IdResponsableUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT de la tabla `responsable_reunion_usuario`
--
ALTER TABLE `responsable_reunion_usuario`
  MODIFY `Id_responsable_reunion_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `restauracionclave`
--
ALTER TABLE `restauracionclave`
  MODIFY `Id_RestaruracionClave` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `reunion`
--
ALTER TABLE `reunion`
  MODIFY `Id_Reunion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `Id_Roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `sub_area`
--
ALTER TABLE `sub_area`
  MODIFY `Id_Sub_Area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `tarea`
--
ALTER TABLE `tarea`
  MODIFY `Id_tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT de la tabla `tipo_tarea`
--
ALTER TABLE `tipo_tarea`
  MODIFY `Id_Tipo_Tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tipo_usuarios`
--
ALTER TABLE `tipo_usuarios`
  MODIFY `Id_Tipo_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT de la tabla `usuario_roles`
--
ALTER TABLE `usuario_roles`
  MODIFY `Id_Usuario_Roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `area_roles`
--
ALTER TABLE `area_roles`
  ADD CONSTRAINT `AreaFK` FOREIGN KEY (`Id_Area`) REFERENCES `area` (`Id_Area`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `RolFK` FOREIGN KEY (`Id_Roles`) REFERENCES `roles` (`Id_Roles`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `AsistenciaFkUsuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `AsistenciaReunionFk` FOREIGN KEY (`IdReunion`) REFERENCES `reunion` (`Id_Reunion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `conclusion`
--
ALTER TABLE `conclusion`
  ADD CONSTRAINT `conclusion_ibfk_1` FOREIGN KEY (`Id_Itinerario`) REFERENCES `itinerario` (`Id_Itinerario`);

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `TareaFKDoc` FOREIGN KEY (`Id_Tarea`) REFERENCES `tarea` (`Id_tarea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `UsuarioFkDoc` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `documento_tarea`
--
ALTER TABLE `documento_tarea`
  ADD CONSTRAINT `DocumentoFK` FOREIGN KEY (`Id_Documento`) REFERENCES `documento` (`Id_Documento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `TareaFK` FOREIGN KEY (`Id_Tarea`) REFERENCES `tarea` (`Id_tarea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `UsuariosFkDoc` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `UsuarioFk` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `itinerario`
--
ALTER TABLE `itinerario`
  ADD CONSTRAINT `ReunionFK` FOREIGN KEY (`Id_Reunion`) REFERENCES `reunion` (`Id_Reunion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `observacion`
--
ALTER TABLE `observacion`
  ADD CONSTRAINT `ObservacionFk` FOREIGN KEY (`ObservacionID`) REFERENCES `observacion` (`Id_Observacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `TareaFKObser` FOREIGN KEY (`Id_Tarea`) REFERENCES `tarea` (`Id_tarea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `UsuarioFKObser` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `observacion_reunion`
--
ALTER TABLE `observacion_reunion`
  ADD CONSTRAINT `OBserreunionFk` FOREIGN KEY (`Id_Reunion`) REFERENCES `reunion` (`Id_Reunion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ObserObseFK` FOREIGN KEY (`Observacion_ID`) REFERENCES `observacion_reunion` (`Id_observacion_reunion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ObserUserFk` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `observador_usuario`
--
ALTER TABLE `observador_usuario`
  ADD CONSTRAINT `Task` FOREIGN KEY (`Id_Tarea`) REFERENCES `tarea` (`Id_tarea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `UserFk` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `participante_reunion_usuario`
--
ALTER TABLE `participante_reunion_usuario`
  ADD CONSTRAINT `participante_reunion_usuario_FK_Reuniones` FOREIGN KEY (`Id_Reunion`) REFERENCES `reunion` (`Id_Reunion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `participante_reunion_usuario_FK_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `participante_usuario`
--
ALTER TABLE `participante_usuario`
  ADD CONSTRAINT `TareaPFK` FOREIGN KEY (`Id_Tarea`) REFERENCES `tarea` (`Id_tarea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `UserPFK` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `responsableusuario`
--
ALTER TABLE `responsableusuario`
  ADD CONSTRAINT `TareaReFK` FOREIGN KEY (`Id_Tarea`) REFERENCES `tarea` (`Id_tarea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `UserReFK` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `responsable_reunion_usuario`
--
ALTER TABLE `responsable_reunion_usuario`
  ADD CONSTRAINT `responsable_reunion_usuario_FKUser` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `responsable_reunion_usuario_FK_Reunion` FOREIGN KEY (`Id_Reunion`) REFERENCES `reunion` (`Id_Reunion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `restauracionclave`
--
ALTER TABLE `restauracionclave`
  ADD CONSTRAINT `ResCFK` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reunion`
--
ALTER TABLE `reunion`
  ADD CONSTRAINT `UserReunionFK` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `IdSubAreaFK` FOREIGN KEY (`Id_Sub_Area`) REFERENCES `sub_area` (`Id_Sub_Area`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sub_area`
--
ALTER TABLE `sub_area`
  ADD CONSTRAINT `AreaFKSubArea` FOREIGN KEY (`Id_Area`) REFERENCES `area` (`Id_Area`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD CONSTRAINT `TipoTaskFK` FOREIGN KEY (`Id_Tipo_Tarea`) REFERENCES `tipo_tarea` (`Id_Tipo_Tarea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tareaIDRecursi` FOREIGN KEY (`tareasIdTareas`) REFERENCES `tarea` (`Id_tarea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `TipoUsuariosFK` FOREIGN KEY (`Id_tipo_Usuarios`) REFERENCES `tipo_usuarios` (`Id_Tipo_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_roles`
--
ALTER TABLE `usuario_roles`
  ADD CONSTRAINT `AreaFKRol` FOREIGN KEY (`Id_Area`) REFERENCES `area` (`Id_Area`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `RolesFK` FOREIGN KEY (`Id_Roles`) REFERENCES `roles` (`Id_Roles`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `UsuariosFK` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
