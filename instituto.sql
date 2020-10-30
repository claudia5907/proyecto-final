-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-10-2020 a las 19:00:20
-- Versión del servidor: 5.7.21
-- Versión de PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `instituto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE IF NOT EXISTS `alumno` (
  `ID_PRS` int(11) NOT NULL AUTO_INCREMENT,
  `NOMB_PRS` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `APELLIDO_PATERNO` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `APELLIDO_MATERNO` varchar(50) COLLATE utf8_bin NOT NULL,
  `CI_PRS` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `DIR_PRS` text COLLATE utf8_bin,
  `FECHA_INSCRIPCION` datetime DEFAULT CURRENT_TIMESTAMP,
  `EMAIL_ALUMNO` text COLLATE utf8_bin,
  `FOTO_NOMB` varchar(100) COLLATE utf8_bin NOT NULL,
  `TAMANIO` float(10,2) NOT NULL,
  `FECHA_NACIMIENTO` date DEFAULT NULL,
  `ESTADO_ALUMNO` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID_PRS`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`ID_PRS`, `NOMB_PRS`, `APELLIDO_PATERNO`, `APELLIDO_MATERNO`, `CI_PRS`, `DIR_PRS`, `FECHA_INSCRIPCION`, `EMAIL_ALUMNO`, `FOTO_NOMB`, `TAMANIO`, `FECHA_NACIMIENTO`, `ESTADO_ALUMNO`) VALUES
(3, 'Leticia', 'Solis', '0', '55465', 'villa granado ', '2020-10-06 14:29:47', 'davids@gmail.com', 'ec9c490_20201006.jpg', 23791.00, NULL, 1),
(4, 'Fernando', 'Mandiola Ferer', '0', '1525411', 'villa mexixo', '2020-10-06 15:10:04', 'davids@gmail.com', '37f6ff7_20201006.jpg', 52075.00, '1990-03-10', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_mat_doc`
--

DROP TABLE IF EXISTS `asignacion_mat_doc`;
CREATE TABLE IF NOT EXISTS `asignacion_mat_doc` (
  `ID_ASIG` int(11) NOT NULL AUTO_INCREMENT,
  `ID_AULA` int(11) NOT NULL,
  `ID_MATERIA` int(11) NOT NULL,
  `ID_NIVEL` int(11) NOT NULL,
  `ID_PRS` int(11) NOT NULL,
  `ID_HORARIO` int(11) NOT NULL,
  `GRUPO` varchar(50) COLLATE utf8_bin NOT NULL,
  `CUPO` int(11) NOT NULL,
  `FECHA_ASIG` datetime DEFAULT CURRENT_TIMESTAMP,
  `GESTION` int(11) DEFAULT NULL,
  `DESC_ASIG` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID_ASIG`),
  KEY `FK_TIENE_AULA` (`ID_AULA`),
  KEY `FK_TIENE_DICTA` (`ID_PRS`),
  KEY `FK_TIENE_MATERIA_DICTA` (`ID_MATERIA`),
  KEY `FK_TIENE_NIVEL` (`ID_NIVEL`),
  KEY `ID_HORARIO` (`ID_HORARIO`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `asignacion_mat_doc`
--

INSERT INTO `asignacion_mat_doc` (`ID_ASIG`, `ID_AULA`, `ID_MATERIA`, `ID_NIVEL`, `ID_PRS`, `ID_HORARIO`, `GRUPO`, `CUPO`, `FECHA_ASIG`, `GESTION`, `DESC_ASIG`) VALUES
(1, 1, 3, 3, 1, 8, 'AACC', 2, '2020-10-28 02:43:42', NULL, NULL),
(2, 1, 3, 3, 1, 6, 'Grupo B', 15, '2020-10-28 13:44:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

DROP TABLE IF EXISTS `aula`;
CREATE TABLE IF NOT EXISTS `aula` (
  `ID_AULA` int(11) NOT NULL AUTO_INCREMENT,
  `NOMB_AULA` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `DESC_AULA` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID_AULA`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `aula`
--

INSERT INTO `aula` (`ID_AULA`, `NOMB_AULA`, `DESC_AULA`) VALUES
(1, '171 B', 'hola'),
(2, '175C', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

DROP TABLE IF EXISTS `docente`;
CREATE TABLE IF NOT EXISTS `docente` (
  `ID_PRS` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRES_DOC` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `APELLIDO_PATERNO` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `APELLIDO_MATERNO` varchar(150) COLLATE utf8_bin NOT NULL,
  `CI_PRS` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `DIR_PRS` text COLLATE utf8_bin,
  `EMAIL_DOCENTE` varchar(100) COLLATE utf8_bin NOT NULL,
  `FECHA_NACIMIENTO` date NOT NULL,
  `FOTO_NOMB` varchar(100) COLLATE utf8_bin NOT NULL,
  `TAMANIO` float(10,2) NOT NULL,
  `CODIGO_DOC` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `FECHA_INGRESO` datetime DEFAULT CURRENT_TIMESTAMP,
  `ESPECIALIDAD` text COLLATE utf8_bin,
  `ESTADO_DOCENTE` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID_PRS`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`ID_PRS`, `NOMBRES_DOC`, `APELLIDO_PATERNO`, `APELLIDO_MATERNO`, `CI_PRS`, `DIR_PRS`, `EMAIL_DOCENTE`, `FECHA_NACIMIENTO`, `FOTO_NOMB`, `TAMANIO`, `CODIGO_DOC`, `FECHA_INGRESO`, `ESPECIALIDAD`, `ESTADO_DOCENTE`) VALUES
(1, 'Fatima', 'Espinoza', 'Espinoza', '5317214', 'VALLE HERMOSO', 'rouse471@gmail.com', '2020-10-28', 'cd1d90f_20201027.jpg', 4446.00, NULL, '2020-10-27 05:55:37', 'Pedagoga', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen`
--

DROP TABLE IF EXISTS `examen`;
CREATE TABLE IF NOT EXISTS `examen` (
  `ID_EXA` int(11) NOT NULL,
  `ID_ASIG` int(11) NOT NULL,
  `FECHA_EXA` date DEFAULT NULL,
  `DESC_EXA` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID_EXA`),
  KEY `FK_TIENE_EXA` (`ID_ASIG`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_tema`
--

DROP TABLE IF EXISTS `foro_tema`;
CREATE TABLE IF NOT EXISTS `foro_tema` (
  `ID_FORO` int(11) NOT NULL,
  `ID_USR` int(11) NOT NULL,
  `TEMA` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `FECHA_FORO` date DEFAULT NULL,
  PRIMARY KEY (`ID_FORO`),
  KEY `FK_ES_CREADO` (`ID_USR`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

DROP TABLE IF EXISTS `horario`;
CREATE TABLE IF NOT EXISTS `horario` (
  `ID_HORARIO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_TURNO` int(11) NOT NULL,
  `HORARIO_INI` time DEFAULT NULL,
  `HORARIO_FIN` time DEFAULT NULL,
  PRIMARY KEY (`ID_HORARIO`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`ID_HORARIO`, `ID_TURNO`, `HORARIO_INI`, `HORARIO_FIN`) VALUES
(5, 1, '08:00:00', '09:00:00'),
(6, 1, '09:00:00', '10:00:00'),
(7, 1, '11:00:00', '12:00:00'),
(8, 2, '14:00:00', '15:00:00'),
(9, 2, '15:00:00', '16:00:00'),
(10, 2, '16:00:00', '17:00:00'),
(11, 2, '17:00:00', '18:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

DROP TABLE IF EXISTS `inscripcion`;
CREATE TABLE IF NOT EXISTS `inscripcion` (
  `ID_INSC` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ASIG` int(11) NOT NULL,
  `ID_PRS` int(11) NOT NULL,
  `FECHA_INICIO` date NOT NULL,
  `FECHA_INSC` datetime DEFAULT CURRENT_TIMESTAMP,
  `GESTION_INS` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_INSC`),
  KEY `FK_TIENE_INCRIPCION` (`ID_PRS`),
  KEY `FK_TIENE_INSC` (`ID_ASIG`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`ID_INSC`, `ID_ASIG`, `ID_PRS`, `FECHA_INICIO`, `FECHA_INSC`, `GESTION_INS`) VALUES
(1, 1, 4, '2020-10-28', '2020-10-28 14:36:40', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

DROP TABLE IF EXISTS `materia`;
CREATE TABLE IF NOT EXISTS `materia` (
  `ID_MATERIA` int(11) NOT NULL AUTO_INCREMENT,
  `COD_MATERIA` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NOMB_MATERIA` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `DESC_MATERIA` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID_MATERIA`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`ID_MATERIA`, `COD_MATERIA`, `NOMB_MATERIA`, `DESC_MATERIA`) VALUES
(3, 'C-1014', 'Calculo ', 'Calculo 1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

DROP TABLE IF EXISTS `nivel`;
CREATE TABLE IF NOT EXISTS `nivel` (
  `ID_NIVEL` int(11) NOT NULL AUTO_INCREMENT,
  `NOMB_NIVEL` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `COSTO_HORA` float(10,2) NOT NULL,
  `DESC_NIVEL` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID_NIVEL`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `nivel`
--

INSERT INTO `nivel` (`ID_NIVEL`, `NOMB_NIVEL`, `COSTO_HORA`, `DESC_NIVEL`) VALUES
(1, 'Primaria', 250.00, NULL),
(2, 'Secundaria', 250.00, NULL),
(3, 'Pre Universitario', 450.00, NULL),
(4, 'Curso Extra', 250.00, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE IF NOT EXISTS `persona` (
  `ID_PRS` int(11) NOT NULL AUTO_INCREMENT,
  `NOMB_PRS` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `APELLIDO_PRS` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `CI_PRS` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `DIR_PRS` text COLLATE utf8_bin,
  `ESTADO` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID_PRS`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`ID_PRS`, `NOMB_PRS`, `APELLIDO_PRS`, `CI_PRS`, `DIR_PRS`, `ESTADO`) VALUES
(1, 'Claudia', 'Negretti', '124567', 'villa loreto', 1),
(2, 'Jhon', 'Vasquez Negretti', '123456', 'Villa mexico', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_examen`
--

DROP TABLE IF EXISTS `preguntas_examen`;
CREATE TABLE IF NOT EXISTS `preguntas_examen` (
  `ID_PREG_EXA` int(11) NOT NULL,
  `ID_EXA` int(11) NOT NULL,
  `PREGUNTA` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID_PREG_EXA`),
  KEY `FK_TIENE_PREG` (`ID_EXA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta_foro`
--

DROP TABLE IF EXISTS `respuesta_foro`;
CREATE TABLE IF NOT EXISTS `respuesta_foro` (
  `ID_RESP_FORO` int(11) NOT NULL,
  `ID_USR` int(11) NOT NULL,
  `ID_FORO` int(11) NOT NULL,
  `RESP_FORO` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `FECHA_REG` datetime DEFAULT NULL,
  `DESC_RESP_FORO` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID_RESP_FORO`),
  KEY `FK_QUIEN_RESPONDE` (`ID_USR`),
  KEY `FK_RESP_TEMA` (`ID_FORO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resp_pregunta`
--

DROP TABLE IF EXISTS `resp_pregunta`;
CREATE TABLE IF NOT EXISTS `resp_pregunta` (
  `ID_RESP_PREG` int(11) NOT NULL,
  `ID_PREG_EXA` int(11) NOT NULL,
  `ID_INSC` int(11) NOT NULL,
  `RESP_PREG` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `DESC_RESP` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `FECHA_RESP` date DEFAULT NULL,
  PRIMARY KEY (`ID_RESP_PREG`),
  KEY `FK_TIENE_RESP` (`ID_PREG_EXA`),
  KEY `FK_TIENE_RESP_INS` (`ID_INSC`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `ID_TIPO_USR` int(11) NOT NULL AUTO_INCREMENT,
  `TIPO_USR` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `DESCRIPCION` varchar(150) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID_TIPO_USR`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`ID_TIPO_USR`, `TIPO_USR`, `DESCRIPCION`) VALUES
(1, 'Administrador', ''),
(2, 'Encargado Registro', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

DROP TABLE IF EXISTS `turno`;
CREATE TABLE IF NOT EXISTS `turno` (
  `ID_TURNO` int(11) NOT NULL AUTO_INCREMENT,
  `TURNO` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID_TURNO`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`ID_TURNO`, `TURNO`) VALUES
(1, 'Mañana'),
(2, 'Tarde'),
(3, 'Noche');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `ID_USR` int(11) NOT NULL AUTO_INCREMENT,
  `ID_TIPO_USR` int(11) NOT NULL,
  `ID_PRS` int(11) NOT NULL,
  `LOGIN` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `ESTADO_USUARIO` int(11) NOT NULL DEFAULT '1',
  `CONTRASENIA` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID_USR`),
  KEY `FK_TIENE_CUENTA` (`ID_PRS`),
  KEY `FK_TIENE_TIPO` (`ID_TIPO_USR`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_USR`, `ID_TIPO_USR`, `ID_PRS`, `LOGIN`, `ESTADO_USUARIO`, `CONTRASENIA`) VALUES
(1, 1, 1, 'admin', 1, '202cb962ac59075b964b07152d234b70'),
(3, 2, 2, 'jhon', 1, '202cb962ac59075b964b07152d234b70');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
