-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-11-2013 a las 17:39:16
-- Versión del servidor: 5.1.44
-- Versión de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `prepanet2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Administrador`
--

CREATE TABLE IF NOT EXISTS `Administrador` (
  `Nomina` varchar(9) CHARACTER SET latin1 DEFAULT NULL,
  `Password` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `Nombre` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `ApellidoP` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `ApellidoM` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `Mail` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `Administrador`
--

INSERT INTO `Administrador` (`Nomina`, `Password`, `Nombre`, `ApellidoP`, `ApellidoM`, `Mail`) VALUES
('L01224787', '99632baa4675ca84043ae5bb7c0fcfe4', 'Antonio', 'Hernández', 'Campos', 'antonio.hdez93@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alumno`
--

CREATE TABLE IF NOT EXISTS `Alumno` (
  `Matricula` varchar(9) NOT NULL DEFAULT '',
  `Nombre` varchar(25) DEFAULT NULL,
  `ApellidoP` varchar(15) DEFAULT NULL,
  `ApellidoM` varchar(15) DEFAULT NULL,
  `Telefono` varchar(15) NOT NULL,
  `PBeca` int(11) DEFAULT NULL,
  `Convenio` varchar(35) DEFAULT NULL,
  `Mail` varchar(50) NOT NULL,
  `Password` varchar(32) DEFAULT NULL,
  `Incubadora` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Matricula`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `Alumno`
--

INSERT INTO `Alumno` (`Matricula`, `Nombre`, `ApellidoP`, `ApellidoM`, `Telefono`, `PBeca`, `Convenio`, `Mail`, `Password`, `Incubadora`) VALUES
('A01224955', 'Antonio', 'Reyes', 'Espinoza', '3314091133', 40, 'Telmex', 'antonioreyes002@gmail.com', 'b2cc61954ebcfc4a8bf82175ac073b12', 'Incubadora Social Jocotan'),
('A01224787', 'Antonio', 'Hernández', 'Campos', '3311030405', 20, 'Bimbo', 'elcorreo@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', 'Incubadora Social Jocotan');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cursadas`
--

CREATE TABLE IF NOT EXISTS `Cursadas` (
  `Matricula` varchar(9) DEFAULT NULL,
  `Clave` varchar(8) DEFAULT NULL,
  `Periodo` varchar(17) NOT NULL,
  KEY `mrequisito_1_fk` (`Matricula`),
  KEY `mrequisito_2_fk` (`Clave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `Cursadas`
--

INSERT INTO `Cursadas` (`Matricula`, `Clave`, `Periodo`) VALUES
('A01224787', 'PS-2000L', 'DIC2013'),
('A01224787', 'PH-3017L', 'DIC2013'),
('A01224787', 'PD-1015L', 'DIC2013'),
('A01224787', 'PD-1014L', 'DIC2013'),
('A01224787', 'PS-1009L', 'DIC2013'),
('A01224787', 'PL-1008L', 'DIC2013');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Materia`
--

CREATE TABLE IF NOT EXISTS `Materia` (
  `Clave` varchar(8) NOT NULL DEFAULT '',
  `Nombre` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`Clave`),
  UNIQUE KEY `Nombre` (`Nombre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `Materia`
--

INSERT INTO `Materia` (`Clave`, `Nombre`) VALUES
('PD-1014L', 'Desarrollo de habilidades básicas para el aprendizaje en línea'),
('PD-1015L', 'Pensamiento crítico'),
('PL-1008L', 'Taller de lectura y redacción I'),
('PM-1011L', 'Matemáticas I'),
('PS-1009L', 'Informática I'),
('PC-2000L', 'Química I'),
('PH-2008L', 'Historia universal contemporánea'),
('PL-2000L', 'Taller de lectura y redacción II'),
('PM-2000L', 'Matemática II'),
('PS-2000L', 'Informática II'),
('PI-2005L', 'Inglés I'),
('PC-3014L', 'Química II'),
('PH-3017L', 'Historia de México'),
('PI-3007L', 'Inglés II'),
('PM-3000L', 'Matemáticas III'),
('PS-3004L', 'Informática III'),
('PL-3006L', 'Lenguaje y comunicación'),
('PC-4018L', 'Métodos de investigación'),
('PC-4019L', 'Biología'),
('PD-4010L', 'Ética ciudadana'),
('PL-4006L', 'Literatura'),
('PM-4000L', 'Matemáticas IV'),
('PS-4003L', 'Informática IV'),
('PC-5032L', 'Física I'),
('PC-5033L', 'Ciencias de la salud'),
('PH-5030L', 'Introducción a la administración'),
('PH-5029L', 'Introducción a las ciencias sociales'),
('PH-5031L', 'Economía y estado'),
('PC-6040L', 'Física II'),
('PD-6012L', 'Historia y apreciación del arte'),
('PH-6032L', 'Administración de proyectos'),
('PD-6013L', 'Filosofía'),
('PH-6033L', 'Estructura socioeconómica de Mexico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Materia_Requisito`
--

CREATE TABLE IF NOT EXISTS `Materia_Requisito` (
  `Clave` varchar(8) NOT NULL DEFAULT '',
  `Requisito` varchar(8) NOT NULL DEFAULT '',
  PRIMARY KEY (`Clave`,`Requisito`),
  KEY `requisito` (`Requisito`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `Materia_Requisito`
--

INSERT INTO `Materia_Requisito` (`Clave`, `Requisito`) VALUES
('PC-2000L', 'PM-1011L'),
('PC-3014L', 'PC-2000L'),
('PC-4018L', 'PD-1014L'),
('PC-4019L', 'PC-3014L'),
('PC-5032L', 'PM-4000L'),
('PC-5033L', 'PC-4018L'),
('PC-6040L', 'PC-5032L'),
('PH-2008L', 'PD-1014L'),
('PH-3017L', 'PH-2008L'),
('PH-5029L', 'PH-3017L'),
('PH-5031L', 'PH-3017L'),
('PH-6032L', 'PH-5030L'),
('PH-6033L', 'PH-5031L'),
('PI-3007L', 'PI-2005L'),
('PL-2000L', 'PL-1008L'),
('PL-3006L', 'PL-2000L'),
('PL-4006L', 'PL3006L'),
('PM-2000L', 'PM-1011L'),
('PM-3000L', 'PM-2000L'),
('PM-4000L', 'PM3000L'),
('PS-2000L', 'PS-1009L'),
('PS-3004L', 'PS-2000L'),
('PS-4003L', 'PS3004L');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PlanEstudios`
--

CREATE TABLE IF NOT EXISTS `PlanEstudios` (
  `Nombre` varchar(80) NOT NULL,
  `Unidades` int(11) NOT NULL,
  `Cuatrimestre` int(11) DEFAULT NULL,
  PRIMARY KEY (`Nombre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `PlanEstudios`
--

INSERT INTO `PlanEstudios` (`Nombre`, `Unidades`, `Cuatrimestre`) VALUES
('Desarrollo de habilidades básicas para el aprendizaje en línea', 10, 1),
('Pensamiento crítico', 6, 1),
('Taller de lectura y redacción I', 6, 1),
('Matemáticas I', 11, 1),
('Informática I', 4, 1),
('Química I', 10, 2),
('Historia universal contemporánea', 8, 2),
('Taller de lectura y redacción II', 6, 2),
('Matemática II', 11, 2),
('Informática II', 4, 2),
('Inglés I', 4, 2),
('Química II', 8, 3),
('Historia de México', 8, 3),
('Inglés II', 4, 3),
('Matemáticas III', 11, 3),
('Informática III', 4, 3),
('Lenguaje y comunicación', 6, 3),
('Métodos de investigación', 11, 4),
('Biología', 10, 4),
('Ética ciudadana', 6, 4),
('Literatura', 3, 4),
('Matemáticas IV', 11, 4),
('Informática IV', 4, 4),
('Física I', 10, 5),
('Ciencias de la salud', 7, 5),
('Introducción a la administración', 7, 5),
('Introducción a las ciencias sociales', 10, 5),
('Economía y estado', 7, 5),
('Física II', 10, 6),
('Historia y apreciación del arte', 7, 6),
('Administración de proyectos', 7, 6),
('Filosofía', 7, 6),
('Estructura socioeconómica de Mexico', 7, 6);
