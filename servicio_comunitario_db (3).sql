-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-04-2024 a las 04:06:17
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `servicio_comunitario_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `authorities`
--

CREATE TABLE `authorities` (
  `id` int(10) UNSIGNED NOT NULL,
  `sede_id` int(10) UNSIGNED DEFAULT NULL,
  `cargo_id` int(10) UNSIGNED NOT NULL,
  `autoridad` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `authorities`
--

INSERT INTO `authorities` (`id`, `sede_id`, `cargo_id`, `autoridad`) VALUES
(1, 1, 1, 'María Pérez'),
(2, 1, 2, 'Pedro Gómez'),
(3, 9, 3, 'prueba'),
(4, 1, 3, 'prueba3'),
(5, 2, 1, 'prueba 4'),
(6, 6, 1, 'par ve'),
(7, 3, 1, 'martaa'),
(8, 3, 2, 'martin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `cargo` varchar(60) NOT NULL,
  `alias` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id`, `cargo`, `alias`) VALUES
(1, 'Secretaria(o) del Instituto', 'secretaria'),
(2, 'Jefa(e) de Control de Estudios', 'control-estudio'),
(3, 'Coordinadora(or) Inst. Servicio Comunitario', 'coordinacion-sc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codes`
--

CREATE TABLE `codes` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `code` varchar(4) NOT NULL,
  `entity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `codes`
--

INSERT INTO `codes` (`id`, `code`, `entity`) VALUES
(1, '0287', 15),
(2, '0291', 15),
(3, '0292', 15),
(4, '0412', 0),
(5, '0414', 0),
(6, '0424', 0),
(7, '0416', 0),
(8, '0426', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `cod` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`cod`, `nombre`) VALUES
('BIO', 'Biología'),
('CTI', 'Ciencias de la Tierra'),
('ECO', 'Educación Comercial'),
('EDA', 'Educación Especial en Dificultades de Aprendizaje'),
('EFI', 'Educación Física'),
('EIN', 'Educación Integral'),
('EPR', 'Educación Preescolar'),
('FIS', 'Física'),
('GHI', 'Geografía e Historia'),
('INF', 'Informática'),
('ING', 'Inglés'),
('LLI', 'Lengua y Literatura'),
('MAT', 'Matemática'),
('QUI', 'Química');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id` int(10) UNSIGNED NOT NULL,
  `cod_sede` varchar(7) DEFAULT NULL,
  `cedula` varchar(8) DEFAULT NULL,
  `codespecialidad` varchar(5) DEFAULT NULL,
  `primernombre` varchar(25) DEFAULT NULL,
  `segundonombre` varchar(25) DEFAULT NULL,
  `primerapellido` varchar(25) NOT NULL,
  `segundoapellido` varchar(25) DEFAULT NULL,
  `sexo` varchar(1) DEFAULT NULL,
  `fecha_nac` varchar(10) DEFAULT NULL,
  `matricula` varchar(6) DEFAULT NULL,
  `tipo_estudiante` varchar(8) DEFAULT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `correo_secundario` varchar(50) DEFAULT NULL,
  `codigo_curso` varchar(7) DEFAULT NULL,
  `periodo_acad` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id`, `cod_sede`, `cedula`, `codespecialidad`, `primernombre`, `segundonombre`, `primerapellido`, `segundoapellido`, `sexo`, `fecha_nac`, `matricula`, `tipo_estudiante`, `direccion`, `telefono`, `correo_secundario`, `codigo_curso`, `periodo_acad`) VALUES
(1, '0100', '11777917', 'BIO', 'JESUS', NULL, 'RIVERO', NULL, 'M', '1972-10-17', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(2, '0100', '16517711', 'GHI', 'ANA', NULL, 'LOPEZ', NULL, 'F', '1983-08-10', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(3, '0100', '18267841', 'EDA', 'LUISANA', NULL, 'OLIVEROS', NULL, 'F', '1987-09-16', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(4, '0400', '19602604', 'BIO', 'HERLYS', NULL, 'FIGUEROA', NULL, 'F', '1989-11-25', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(5, '0400', '17548741', 'BIO', 'MILEIDYS', NULL, 'CATALANO', NULL, 'F', '1984-03-13', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(6, '0400', '18267493', 'BIO', 'LUISA', NULL, 'MATA', NULL, 'F', '1988-06-08', NULL, 'BCH', '.', '-', '', 'SC120', '2016-II'),
(7, '0400', '20376232', 'BIO', 'JANELLY', NULL, 'GONZALEZ', NULL, 'F', '1990-06-22', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(8, '0400', '21050059', 'BIO', 'YOSKARINA', NULL, 'CALZADILLA', NULL, 'F', '1988-11-14', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(9, '0400', '13655814', 'ECO', 'NINOSKA', NULL, 'MEJIAS', NULL, 'F', '1976-07-04', NULL, 'BCH', '.', '0414-0943390', '', 'SC120', '2016-II'),
(10, '0400', '18173791', 'EFI', 'LUIS', NULL, 'TABARE', NULL, 'M', '1987-05-25', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(11, '0400', '14506887', 'ECO', 'MARVIC', NULL, 'CARRION', NULL, 'F', '1980-05-28', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(12, '0400', '17090954', 'EIN', 'SAIDUVI', NULL, 'ROA', NULL, 'F', '1984-10-29', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(13, '0400', '18652614', 'ECO', 'GABRIELA', NULL, 'CARIPE', NULL, 'F', '1988-12-01', NULL, 'BCH', '.', '..', '', 'SC120', '2016-II'),
(14, '0400', '19746070', 'EDA', 'FRANCIS', NULL, 'GOMEZ', NULL, 'F', '1990-03-08', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(15, '0400', '20001292', 'ECO', 'YAREMIS', NULL, 'VELIZ', NULL, 'F', '1988-06-14', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(16, '0400', '15877613', 'EDA', 'YECENIA', NULL, 'CEDEÑO', NULL, 'F', '1981-12-01', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(17, '0400', '19876354', 'EDA', 'GENESIS', NULL, 'PADRON', NULL, 'F', '1990-03-25', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(18, '0400', '14077934', 'EDA', 'KELLY', NULL, 'LAREZ', NULL, 'F', '1978-10-19', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(19, '0400', '16939142', 'EDA', 'HILDREMARIEN', NULL, 'SALAS', NULL, 'F', '1984-07-06', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(20, '0400', '17721729', 'EDA', 'NOELIS', NULL, 'MARCANO', NULL, 'F', '1984-10-26', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(21, '0400', '18464740', 'EDA', 'NEOLYS', NULL, 'ZARAGOZA', NULL, 'F', '1989-05-05', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(22, '0400', '19415584', 'EDA', 'MONICA', NULL, 'DE LA PUENTE', NULL, 'F', '1988-05-23', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(23, '0400', '20001428', 'EDA', 'MARIANGELYS', NULL, 'LEONETT', NULL, 'F', '1990-07-28', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(24, '0400', '15323512', 'EDA', 'GREILYS', NULL, 'RENGEL', NULL, 'F', '1981-05-13', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(25, '0400', '15814941', 'EDA', 'YELITZA', NULL, 'ARCIA', NULL, 'F', '1983-02-11', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(26, '0400', '18268852', 'EDA', 'BEATRIZ', NULL, 'VALLENILLA', NULL, 'F', '1989-10-10', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(27, '0400', '18272272', 'EDA', 'ALEJANDRA', NULL, 'SILVA', NULL, 'F', '1987-07-23', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(28, '0400', '18652078', 'EDA', 'MARIA', NULL, 'CHALON', NULL, 'F', '1988-10-12', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(29, '0400', '19416667', 'EDA', 'LISBETH', NULL, 'FREITES', NULL, 'F', '1990-01-05', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(30, '0400', '19875942', 'EDA', 'ROCTCEH', NULL, 'SALAZAR', NULL, 'F', '1989-05-18', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(31, '0400', '20001785', 'EDA', 'ZORAIDA', NULL, 'GIRALDO', NULL, 'F', '1989-03-01', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(32, '0400', '20002452', 'EDA', 'WESTALIA', NULL, 'RIVAS', NULL, 'F', '1990-04-07', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(33, '0400', '20421123', 'EDA', 'MARIA', NULL, 'GONZALEZ', NULL, 'F', '1990-01-10', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(34, '0400', '22971631', 'EDA', 'MARIUXIS', NULL, 'CORVO', NULL, 'F', '1990-10-16', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(35, '0400', '20373219', 'EDA', 'KARELIA', NULL, 'LÓPEZ', NULL, 'F', '1991-09-02', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(36, '0400', '18172899', 'EDA', 'HILDREROSSI', NULL, 'SALAS', NULL, 'F', '1987-03-14', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(37, '0400', '18651159', 'EDA', 'JESSICA', NULL, 'YEGRES', NULL, 'F', '1988-10-20', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(38, '0400', '19746847', 'EDA', 'LAURA', NULL, 'RENGEL', NULL, 'F', '1990-06-22', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(39, '0400', '19781603', 'EDA', 'RUBEXI', NULL, 'HERNANDEZ', NULL, 'F', '1990-09-23', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(40, '0400', '19821907', 'EDA', 'GRETA', NULL, 'PARRA', NULL, 'F', '1991-09-18', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(41, '0400', '20139382', 'EDA', 'ARLENIS', NULL, 'BELLO', NULL, 'F', '1991-07-05', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(42, '0400', '20420972', 'EDA', 'KAREN', NULL, 'ROMERO', NULL, 'F', '1990-01-31', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(43, '0400', '16938426', 'EFI', 'EDWIN', NULL, 'RAMOS', NULL, 'M', '1983-05-05', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(44, '0400', '18462757', 'EFI', 'JOSE', NULL, 'HIDALGO', NULL, 'M', '1987-11-23', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(45, '0400', '17091223', 'EFI', 'CARLOS', NULL, 'MOYA', NULL, 'M', '1985-12-22', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(46, '0400', '17934342', 'EFI', 'EUSTACIO', NULL, 'ALMONTE', NULL, 'M', '1986-10-30', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(47, '0400', '18820077', 'EFI', 'YAINNES', NULL, 'RODRIGUEZ', NULL, 'F', '1988-01-21', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(48, '0400', '18586112', 'EFI', 'KAREN', NULL, 'RAMOS', NULL, 'F', '1989-06-02', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(49, '0400', '19415770', 'EFI', 'NESTOR', NULL, 'VALLEJO', NULL, 'M', '1988-06-08', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(50, '0400', '19746376', 'EFI', 'JOSUE', NULL, 'BRAVO', NULL, 'M', '1988-10-17', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(51, '0400', '20138629', 'EFI', 'ARQUIMEDES', NULL, 'ORTIS', NULL, 'M', '1989-11-30', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(52, '0400', '20422515', 'EFI', 'ARQUIMEDES', NULL, 'VILLAFRANCA', NULL, 'M', '1984-05-26', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(53, '0400', '20917743', 'FIS', 'HENSO', NULL, 'ARRIA', NULL, 'M', '1990-05-11', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(54, '0400', '16711563', 'EFI', 'YANIS', NULL, 'BASTARDO', NULL, 'F', '1981-05-20', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(55, '0400', '17403934', 'EFI', 'JUNIOR', NULL, 'GONZALEZ', NULL, 'M', '1986-09-10', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(56, '0400', '19538335', 'EDA', 'ROSIBEL', NULL, 'YANEZ', NULL, 'F', '1990-06-10', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(57, '0400', '19603861', 'EFI', 'FABIO', NULL, 'GONZALEZ', NULL, 'M', '1988-08-24', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(58, '0400', '19662069', 'EFI', 'JUAN', NULL, 'GARCIA', NULL, 'M', '1988-09-10', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(59, '0400', '19700064', 'EFI', 'LEOMAR', NULL, 'VALDEZ', NULL, 'M', '1987-01-17', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(60, '0400', '19781256', 'EFI', 'DANIEL', NULL, 'MOSQUEDA', NULL, 'M', '1990-02-12', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(61, '0400', '20202543', 'EFI', 'MARYOLI', NULL, 'GUERRA', NULL, 'F', '1990-07-09', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(62, '0400', '20403465', 'EFI', 'YENNIREE', NULL, 'SANCHEZ', NULL, 'F', '1989-11-27', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(63, '0400', '20421874', 'EIN', 'VICTOR', NULL, 'REYES', NULL, 'M', '1989-11-03', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(64, '0400', '20598759', 'FIS', 'LARRYS', NULL, 'SANCHEZ', NULL, 'M', '1990-08-31', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(65, '0400', '21050051', 'EFI', 'SAUL', NULL, 'RIVAS', NULL, 'M', '1991-01-08', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(66, '0400', '11012547', 'GHI', 'LUIS', NULL, 'GUILLEN', NULL, 'M', '1973-05-01', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(67, '0400', '17713085', 'EIN', 'MARIA', NULL, 'TORREALBA', NULL, 'F', '1985-11-22', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(68, '0400', '19781474', 'EIN', 'YENIREE', NULL, 'MENDOZA', NULL, 'F', '1987-01-16', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(69, '0400', '19876598', 'EIN', 'JENNIFER', NULL, 'RODRIGUEZ', NULL, 'F', '1989-11-16', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(70, '0400', '20645846', 'EIN', 'ANNYS', NULL, 'MARQUEZ', NULL, 'F', '1990-12-04', NULL, 'BCH', '.', '-', '', 'SC120', '2016-II'),
(71, '0400', '17242228', 'EIN', 'CARLA', NULL, 'MORAO', NULL, 'F', '1983-05-02', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(72, '0400', '20248085', 'EIN', 'ALEXANDER', NULL, 'GONZÁLEZ', NULL, 'M', '1991-02-07', NULL, 'BCH', '..', '4165878613', '', 'SC120', '2016-II'),
(73, '0400', '19125830', 'EIN', 'LEOMERIS', NULL, 'ROMERO', NULL, 'F', '1989-12-18', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(74, '0400', '17487674', 'EPR', 'MARIA', NULL, 'VILLANUEVA', NULL, 'F', '1985-10-19', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(75, '0400', '16518581', 'EFI', 'JESUS', NULL, 'LARA', NULL, 'M', '1982-10-27', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(76, '0400', '19090659', 'BIO', 'ADELA', NULL, 'CASTILLO', NULL, 'F', '1988-04-06', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(77, '0400', '20311804', 'FIS', 'RICARDO', NULL, 'GARCIA', NULL, 'M', '1981-07-02', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(78, '0400', '16517297', 'FIS', 'ELVIS', NULL, 'MENDOZA', NULL, 'M', '1982-09-16', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(79, '0400', '20915883', 'FIS', 'JORGE', NULL, 'RAMOS', NULL, 'M', '1989-09-02', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(80, '0400', '13655142', 'GHI', 'CRISTIAN', NULL, 'GARCIA', NULL, 'F', '1977-01-15', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(81, '0400', '14993065', 'GHI', 'SILVIA', NULL, 'CENTENO', NULL, 'F', '1976-11-30', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(82, '0400', '15030062', 'GHI', 'LEONARDO', NULL, 'SOLORZANO', NULL, 'M', '1981-05-20', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(83, '0400', '15116213', 'GHI', 'CAROLINA', NULL, 'YDROGO', NULL, 'F', '1981-09-08', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(84, '0400', '17526388', 'GHI', 'JOSELDYS', NULL, 'DAYAR', NULL, 'F', '1985-03-26', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(85, '0400', '13091097', 'GHI', 'SANDRA', NULL, 'PERALES', NULL, 'F', '1977-09-07', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(86, '0400', '19602758', 'FIS', 'ELI', NULL, 'RUIZ', NULL, 'M', '1989-08-30', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(87, '0400', '17723969', 'EFI', 'PEDRO', NULL, 'GIL', NULL, 'M', '1986-01-05', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(88, '0400', '18462489', 'GHI', 'RUTH', NULL, 'PADRON', NULL, 'F', '1987-03-09', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(89, '0400', '17403193', 'EFI', 'DANIEL', NULL, 'ALVAREZ', NULL, 'M', '1984-06-28', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(90, '0400', '17695790', 'GHI', 'MIRELYS', NULL, 'CORCEGA', NULL, 'F', '1986-09-04', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(91, '0400', '18585737', 'GHI', 'ARGENTINA', NULL, 'ROMERO', NULL, 'F', '1989-12-02', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(92, '0400', '18865695', 'GHI', 'MARIANNE', NULL, 'BASTARDO', NULL, 'F', '1985-05-21', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(93, '0400', '19875034', 'GHI', 'MANOLA', NULL, 'LUCES', NULL, 'F', '1990-11-12', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(94, '0400', '18653750', 'GHI', 'NOLIS', NULL, 'MARTINEZ', NULL, 'F', '1986-10-04', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(95, '0400', '20138746', 'GHI', 'JOSAY', NULL, 'MONTILLA', NULL, 'F', '1982-09-04', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(96, '0400', '20421103', 'GHI', 'BRIANNY', NULL, 'CORONADO', NULL, 'M', '1990-11-12', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(97, '0400', '16555615', 'INF', 'MARY', NULL, 'FLORES', NULL, 'F', '1985-05-20', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(98, '0400', '20421042', 'GHI', 'JOSE', NULL, 'FIGUEROA', NULL, 'M', '1991-04-09', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(99, '0400', '17090067', 'GHI', 'MAURO', NULL, 'LOPEZ', NULL, 'M', '1986-06-29', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(100, '0400', '18462410', 'GHI', 'ELIANNY', NULL, 'RODRIGUEZ', NULL, 'F', '1988-02-24', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(101, '0400', '20138297', 'GHI', 'ANDREINA', NULL, 'GARCIA', NULL, 'F', '1990-06-04', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(102, '0400', '20918210', 'GHI', 'MARIA', NULL, 'MEDINA', NULL, 'F', '1991-03-28', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(103, '0400', '11779547', 'EIN', 'ALEXIS', NULL, 'SANCHEZ', NULL, 'M', '1973-09-06', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(104, '0400', '14858305', 'ING', 'RAIDEL', NULL, 'NOGUERA', NULL, 'F', '1980-10-13', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(105, '0400', '15322884', 'ING', 'MARIA', NULL, 'MARTINEZ', NULL, 'F', '1981-12-21', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(106, '0400', '14508311', 'EIN', 'CRISTAR', NULL, 'MIRANDA', NULL, 'F', '1978-08-26', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(107, '0400', '18652972', 'LLI', 'MARIELYS', NULL, 'TOME', NULL, 'F', '1987-08-24', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(108, '0400', '16711908', 'ING', 'EDUARDO', NULL, 'BASTARDO', NULL, 'M', '1983-05-11', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(109, '0400', '14174574', 'LLI', 'YAQUELINE', NULL, 'CAMPOS', NULL, 'F', '1979-01-26', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(110, '0400', '19381108', 'GHI', 'ELIAZER', NULL, 'MENDEZ', NULL, 'M', '1987-03-19', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(111, '0400', '20935288', 'LLI', 'MARYELI', NULL, 'AZOCAR', NULL, 'F', '1990-09-05', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(112, '0400', '11005577', 'LLI', 'MARIA', NULL, 'MARTINEZ', NULL, 'F', '1972-07-22', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(113, '0400', '19718161', 'LLI', 'Gines', NULL, 'Campos', NULL, 'F', '1990-01-01', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(114, '0400', '20311074', 'LLI', 'NEUDIS', NULL, 'ESTABA', NULL, 'F', '1990-01-31', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(115, '0400', '15634250', 'INF', 'JENNY', NULL, 'BUENO', NULL, 'F', '1983-07-24', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(116, '0400', '15115362', 'MAT', 'FREDDY', NULL, 'SUBERO', NULL, 'M', '1980-06-03', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(117, '0400', '17713224', 'MAT', 'JESUS', NULL, 'MARCANO', NULL, 'M', '1984-08-09', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(118, '0400', '17723555', 'MAT', 'MARIAM', NULL, 'RODRIGUEZ', NULL, 'F', '1985-12-19', NULL, 'BCH', '.', '0416-2529945', '', 'SC120', '2016-II'),
(119, '0400', '19091695', 'MAT', 'EMPERATRIZ', NULL, 'TORRES', NULL, 'F', '1987-05-04', NULL, 'BCH', 'EL SILENCIO. CASA NUM 57. CARRERA 4. LAS COCUIZAS', '4266979660', '', 'SC120', '2016-II'),
(120, '0400', '20140592', 'MAT', 'YAMILETT', NULL, 'GONZALEZ', NULL, 'F', '1989-12-15', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(121, '0400', '16373029', 'EFI', 'JESUS', NULL, 'HERNANDEZ', NULL, 'M', '1981-10-27', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(122, '0400', '17546187', 'EFI', 'JORGE', NULL, 'APARISMO', NULL, 'M', '1986-06-12', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(123, '0400', '17464726', 'INF', 'LUZMARINA', NULL, 'CANDALLO', NULL, 'F', '1985-11-09', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(124, '0400', '6251973', 'INF', 'PASCUAL', NULL, 'BEJARANO', NULL, 'M', '1967-10-07', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(125, '0400', '20055057', 'INF', 'GRISBEL', NULL, 'MOREY', NULL, 'M', '1988-12-13', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(126, '0400', '18820804', 'INF', 'DURKIS', NULL, 'ARCIA', NULL, 'F', '1989-08-30', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(127, '0400', '13815588', 'INF', 'NEOMAR', NULL, 'ROJAS', NULL, 'M', '1979-12-07', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(128, '0400', '17721415', 'INF', 'JOSE', NULL, 'ANTUAREZ', NULL, 'M', '1983-01-21', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(129, '0400', '18820415', 'INF', 'CARLOS', NULL, 'RIVAS', NULL, 'M', '1987-10-05', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(130, '0400', '20916531', 'INF', 'ROSANGEL', NULL, 'REYES', NULL, 'F', '1990-12-31', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(131, '0400', '19415307', 'INF', 'GREGORIS', NULL, 'FLORES', NULL, 'M', '1989-08-11', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(132, '0400', '20000106', 'INF', 'OSWALDO', NULL, 'JIMENEZ', NULL, 'M', '1990-04-28', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(133, '0400', '20001471', 'INF', 'LUIS', NULL, 'FIGUEROA', NULL, 'M', '1988-02-18', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(134, '0400', '20310796', 'INF', 'JOSE', NULL, 'GARCIA', NULL, 'M', '1990-01-01', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(135, '0400', '21347421', 'INF', 'SILVANA', NULL, 'TOCUYO', NULL, 'F', '1991-04-05', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(136, '0400', '17548628', 'GHI', 'MIGUEL', NULL, 'SERRANO', NULL, 'M', '1986-12-10', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(137, '0400', '14858628', 'EIN', 'DAVID', NULL, 'RIVAS', NULL, 'F', '2010-02-28', NULL, 'BCH', 'SECTOR BRISAS DEL MORICHAL. CAICARA', '14858628', 'NULL', 'SC120', '2016-II'),
(138, '0400', '22725664', 'INF', 'JOSE', NULL, 'RICARDO', NULL, 'M', '1990-01-01', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(139, '0400', '19994531', 'LLI', 'JEISSON', NULL, 'POSSO', NULL, 'M', '1991-10-14', NULL, 'BCH', 'av jose maria vargas.', '2916521932', 'NULL', 'SC120', '2016-II'),
(140, '0400', '19092844', 'INF', 'ANDREINA', NULL, 'RODRIGUEZ', NULL, 'F', '1989-02-11', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(141, '0400', '20001410', 'EDA', 'DENICE', NULL, 'PEREZ', NULL, 'F', '1990-05-01', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(142, '0400', '19909932', 'EFI', 'ENRRY', NULL, 'FIGUERA', NULL, 'M', '1990-05-19', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(143, '0400', '20575614', 'EFI', 'ARGENIS', NULL, 'RODRIGUEZ', NULL, 'M', '1991-05-06', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(144, '0400', '19416711', 'ING', 'CRYSTAL', NULL, 'MATA', NULL, 'F', '1988-11-13', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(145, '0400', '16013209', 'ING', 'PEDRO', NULL, 'PARRELLA', NULL, 'M', '1983-09-19', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(146, '0400', '20917935', 'ING', 'ELIANNYS', NULL, 'GRANADO', NULL, 'F', '1991-09-09', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(147, '0400', '20312562', 'EIN', 'Jose', NULL, 'Cabello', NULL, 'M', '1991-06-16', NULL, 'BCH', 'Areo, Municipio Cedeño, Calle Bolivar, Casa N° 669. Estado Monagas.', '4249327268', 'NULL', 'SC120', '2016-II'),
(148, '0400', '20000428', 'EIN', 'Edinel', NULL, 'Diaz', NULL, 'M', '1990-03-17', NULL, 'BCH', 'Sabana Grande Sector 2 s/n', '2916510792', 'NULL', 'SC120', '2016-II'),
(149, '0400', '20598477', 'EIN', 'Mairelys', NULL, 'Sifontes', NULL, 'F', '1990-12-17', NULL, 'BCH', 'Punta de Mata', '4263993349', 'NULL', 'SC120', '2016-II'),
(150, '0400', '20918717', 'EIN', 'Juvislay', NULL, 'Gomez', NULL, 'F', '1991-09-15', NULL, 'BCH', 'Urbanizacion Jose Tadeo Monagas, calle 4 casa 354', '2916515822', 'NULL', 'SC120', '2016-II'),
(151, '0400', '18983670', 'EIN', 'Adriana', NULL, 'Garcia', NULL, 'F', '1987-09-11', NULL, 'BCH', 'San Felix - Estado Bolivar', '4269992264', 'NULL', 'SC120', '2016-II'),
(152, '0400', '20936552', 'EIN', 'Carmen', NULL, 'Dominguez', NULL, 'F', '1993-01-13', NULL, 'BCH', 'Sector Brisas de Ayacucho Calle La Alegria Casa s/n Jusepin', '2927444462', 'NULL', 'SC120', '2016-II'),
(153, '0400', '20001325', 'EIN', 'Elibeth', NULL, 'Jimenez', NULL, 'F', '1991-01-21', NULL, 'BCH', 'Prados del Sur, Calle 1, Casa S/N. Maturin, Estado Monagas.', '4147795577', 'NULL', 'SC120', '2016-II'),
(154, '0400', '20013673', 'EIN', 'Arlienes', NULL, 'Mussett', NULL, 'F', '1991-04-02', NULL, 'BCH', 'Calle El Tanque, Casa s/n. Puente Punceres, Vía Caripito, Edo. MOnagas', '0', 'NULL', 'SC120', '2016-II'),
(155, '0400', '20310967', 'FIS', 'Andry', NULL, 'Macuare', NULL, 'F', '1992-04-04', NULL, 'BCH', 'Carrera 2 nº19 los Rosales el Mereyal.', '2916418828', 'NULL', 'SC120', '2016-II'),
(156, '0400', '14859435', 'GHI', 'Yorgen', NULL, 'Centeno', NULL, 'M', '1979-01-20', NULL, 'BCH', 'calle#5, Casa#39, Sector El Mereyal los Rosales Parroquia las Cocuizas.', '2916418277', 'NULL', 'SC120', '2016-II'),
(157, '0400', '20915500', 'LLI', 'RONALD', NULL, 'URBANEJA', NULL, 'M', '1992-08-06', NULL, 'BCH', 'ALTOS LOS GODOS', '2916510658', 'NULL', 'SC120', '2016-II'),
(158, '0400', '23539007', 'LLI', 'Mercis', NULL, 'Figueroa', NULL, 'F', '1992-12-30', NULL, 'BCH', 'furrial', '4263110014', 'NULL', 'SC120', '2016-II'),
(159, '0400', '20918774', 'MAT', 'ROXANA', NULL, 'RODRIGUEZ', NULL, 'F', '1992-11-05', NULL, 'BCH', 'CALLE EL PARAISO/SECTOR EL PROGRESO/ LA TOSCANA-MUNICIPIO PIAR.', '2913143027', 'NULL', 'SC120', '2016-II'),
(160, '0400', '22701012', 'MAT', 'Genesis', NULL, 'Flores', NULL, 'F', '1991-11-28', NULL, 'BCH', 'Av. El Ejercito la Muralla casa # 21', '2916525173', 'NULL', 'SC120', '2016-II'),
(161, '0400', '22714927', 'BIO', 'HERVIN', NULL, 'ZAPATA', NULL, 'M', '1993-06-07', NULL, 'BCH', 'SECTOR CACHIPO, CASA S/N, MUNICIPIO PUNCERES, ESTADO MONAGAS.', '2918967112', 'NULL', 'SC120', '2016-II'),
(162, '0400', '20916423', 'EIN', 'Nelson', NULL, 'Gil', NULL, 'M', '1990-09-26', NULL, 'BCH', 'sector valenzuela valle verde nº51', '2916412136', 'NULL', 'SC120', '2016-II'),
(163, '0400', '24123214', 'LLI', 'blenda', NULL, 'lozada', NULL, 'F', '1993-11-30', NULL, 'BCH', 'las cayenas manzana 8 casa 67', '2916531968', 'NULL', 'SC120', '2016-II'),
(164, '0400', '13916525', 'INF', 'Rurik', NULL, 'Cabeza', NULL, 'F', '1978-07-31', NULL, 'BCH', 'Calle 10 vereda 36, casa N 2 Los godos Sector 2', '2916522847', 'NULL', 'SC120', '2016-II'),
(165, '0400', '21349347', 'BIO', 'Carmen', NULL, 'Tiapa', NULL, 'F', '1993-11-12', NULL, 'BCH', 'Carrera 2, Número 17, El Paraíso. Maturí - Monagas.', '2916423402', 'NULL', 'SC120', '2016-II'),
(166, '0400', '22702541', 'BIO', 'ROSENNY', NULL, 'VELÁSQUEZ', NULL, 'F', '1994-01-12', NULL, 'BCH', 'brisas de la floresta, calle san fe, casa 30', '2917722023', 'NULL', 'SC120', '2016-II'),
(167, '0400', '22724246', 'FIS', 'MARIEMILY', NULL, 'GOMEZ', NULL, 'F', '1993-11-08', NULL, 'BCH', 'LAS COCUIZAS, MATURIN', '2913276063', 'NULL', 'SC120', '2016-II'),
(168, '0400', '23917073', 'FIS', 'Karla', NULL, 'Quiñones', NULL, 'F', '1992-10-25', NULL, 'BCH', 'Carrera 9 numero 42 Sector II La Puente', '4269840885', 'NULL', 'SC120', '2016-II'),
(169, '0400', '22702941', 'GHI', 'Carlos', NULL, 'Rodriguez', NULL, 'M', '1993-05-05', NULL, 'BCH', 'Urb. Aves del paraiso Calle 8c casa 179', '4249102468', 'NULL', 'SC120', '2016-II'),
(170, '0400', '17935795', 'LLI', 'YESICA', NULL, 'BRITO', NULL, 'F', '1987-10-19', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(171, '0400', '7762403', 'ECO', 'GREYSA', NULL, 'LUGO', NULL, 'F', '1962-06-25', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(172, '0400', '15814234', 'INF', 'MERCEDES', NULL, 'CARDOZO', NULL, 'F', '1980-11-23', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(173, '0400', '20645354', 'GHI', 'MAYERLING', NULL, 'BASTARDO', NULL, 'F', '1989-08-14', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(174, '0400', '18274393', 'GHI', 'MARVIN', NULL, 'CAMPOS', NULL, 'M', '1987-09-17', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(175, '0400', '23917047', 'INF', 'LUIS', NULL, 'MARIANI', NULL, 'M', '1995-07-13', NULL, 'BCH', 'SECTOR VALENZUELA CALLE # 02 CASA 18', '0', 'NULL', 'SC120', '2016-II'),
(176, '0400', '18658653', 'BIO', 'NEURISMAR', NULL, 'MILANO', NULL, 'F', '1987-05-28', NULL, 'BCH', 'la cruz calle el valle al lado del preescolar marta lama rangel', '2916514964', 'NULL', 'SC120', '2016-II'),
(177, '0400', '19663264', 'BIO', 'GABRIEL', NULL, 'GUERRERO', NULL, 'M', '1989-10-13', NULL, 'BCH', 'Sector el Silencio, carrera 2, casa # 13', '4245837777', 'NULL', 'SC120', '2016-II'),
(178, '0400', '22710840', 'BIO', 'maria', NULL, 'medolphe', NULL, 'F', '1993-06-16', NULL, 'BCH', 'aguasay estado monagas', '2923471147', 'NULL', 'SC120', '2016-II'),
(179, '0400', '21237335', 'BIO', 'Frangelith', NULL, 'Villarroel', NULL, 'F', '1994-03-03', NULL, 'BCH', 'Sector centro', '4263973535', 'NULL', 'SC120', '2016-II'),
(180, '0400', '21010042', 'ECO', 'BETZABETH', NULL, 'ALVAREZ', NULL, 'F', '1992-01-28', NULL, 'BCH', 'CALLE LIBERTAD, BAJO GUARAPICHE', '2916412369', 'NULL', 'SC120', '2016-II'),
(181, '0400', '22620343', 'EFI', 'MARÍA', NULL, 'MARIN', NULL, 'F', '1992-04-21', NULL, 'BCH', 'los guaritos, vereda 5, n° 17', '2916517581', 'NULL', 'SC120', '2016-II'),
(182, '0400', '20935222', 'EFI', 'PAUL', NULL, 'ARRIOJAS', NULL, 'M', '1993-04-21', NULL, 'BCH', 'Caripito.Avenida Miranda.casa nº39 la Manga', '2917721124', 'NULL', 'SC120', '2016-II'),
(183, '0400', '20852645', 'EFI', 'Jesus', NULL, 'Rodríguez', NULL, 'M', '1992-09-25', NULL, 'BCH', 'avenida libertador, residencia vigen del valle', '4268978605', 'NULL', 'SC120', '2016-II'),
(184, '0400', '21347670', 'EFI', 'johan', NULL, 'ordosgoitti', NULL, 'M', '1991-11-25', NULL, 'BCH', 'carrera 3 #36-1 La Muralla', '2916520970', 'NULL', 'SC120', '2016-II'),
(185, '0400', '22968160', 'EFI', 'JESUS', NULL, 'GONZALEZ', NULL, 'M', '1993-04-20', NULL, 'BCH', 'CARRERA 5 CASA 31 EL SILENCIO', '4269974034', 'NULL', 'SC120', '2016-II'),
(186, '0400', '23535899', 'EIN', 'Erika', NULL, 'Gamboa', NULL, 'F', '1992-03-03', NULL, 'BCH', 'Calle principal, La cruz', '2916516730', 'NULL', 'SC120', '2016-II'),
(187, '0400', '23924749', 'EIN', 'ALBELIS', NULL, 'MARCANO', NULL, 'F', '1993-07-09', NULL, 'BCH', 'GUACARAPO, CASA S/N, CARIACO MUNICIPIO RIBERO ESTADO SUCRE.', '2943153430', 'NULL', 'SC120', '2016-II'),
(188, '0400', '22704543', 'FIS', 'anabel', NULL, 'guatarasma', NULL, 'F', '1993-09-12', NULL, 'BCH', 'sector morichal calle venezuela c/3', '2916427892', 'NULL', 'SC120', '2016-II'),
(189, '0400', '20420588', 'FIS', 'Rosa', NULL, 'Infante', NULL, 'F', '1989-10-20', NULL, 'BCH', 'Sector Valenzuela, Calle principal', '4168882392', 'NULL', 'SC120', '2016-II'),
(190, '0400', '22719288', 'FIS', 'Margaret', NULL, 'Berrios', NULL, 'F', '1994-09-30', NULL, 'BCH', 'urbanizacion las garzas calle 32 casa 19', '2917728467', 'NULL', 'SC120', '2016-II'),
(191, '0400', '24715945', 'INF', 'Cesar', NULL, 'Hernandez', NULL, 'M', '1993-02-21', NULL, 'BCH', 'urbanisacion la libertad', '2916526814', 'NULL', 'SC120', '2016-II'),
(192, '0400', '24122388', 'ING', 'SANDRA', NULL, 'FLORES', NULL, 'F', '1993-11-10', NULL, 'BCH', 'LOS GUARITOS 6 CALLE 7 CASA Nª33', '2916510529', 'NULL', 'SC120', '2016-II'),
(193, '0400', '22719330', 'LLI', 'JOSELYN', NULL, 'ZAPATA', NULL, 'F', '1993-05-15', NULL, 'BCH', 'CALLE BOMBONA', '4128345212', 'NULL', 'SC120', '2016-II'),
(194, '0400', '23818072', 'LLI', 'AZALEURY', NULL, 'ROCCA', NULL, 'F', '1994-11-19', NULL, 'BCH', 'CALLE 17, CASA 37, LOS COCOS, MATURIN', '2916421312', 'NULL', 'SC120', '2016-II'),
(195, '0400', '22974947', 'MAT', 'Jossmarys', NULL, 'Marcano', NULL, 'F', '1992-08-30', NULL, 'BCH', 'Antigua Artiga calle 7 nº5', '2916412952', 'NULL', 'SC120', '2016-II'),
(196, '0400', '20139520', 'MAT', 'MARIANA', NULL, 'DIAZ', NULL, 'F', '1991-06-23', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(197, '0400', '22616795', 'EFI', 'Alvin', NULL, 'Bruzual', NULL, 'M', '1993-04-22', NULL, 'BCH', 'Carrera Nº 3 Casa Nº 75 Sector La Muralla', '2916518528', 'NULL', 'SC120', '2016-II'),
(198, '0400', '20000429', 'EIN', 'cristobal', NULL, 'zurita', NULL, 'M', '1991-01-03', NULL, 'BCH', 'via la pica terrazas de campo alegre', '4148767584', 'NULL', 'SC120', '2016-II'),
(199, '0400', '20915958', 'LLI', 'Brenda', NULL, 'coa', NULL, 'F', '1993-08-07', NULL, 'BCH', 'Calle 4 casa#17 la puente sector la cañada', '2916523489', 'NULL', 'SC120', '2016-II'),
(200, '0400', '24037755', 'LLI', 'YINETZY', NULL, 'ABARULLO', NULL, 'F', '1992-12-29', NULL, 'BCH', 'SANTA INES', '2916514592', 'NULL', 'SC120', '2016-II'),
(201, '0400', '21608381', 'LLI', 'Caril', NULL, 'Aguinagalde', NULL, 'F', '1994-04-28', NULL, 'BCH', 'Avenida 1, sector Guaritos IV, casa numero 22, Maturín.Estado Monagas', '2916533142', 'NULL', 'SC120', '2016-II'),
(202, '0400', '22722299', 'LLI', 'JOSE', NULL, 'SALAMANCA', NULL, 'M', '1994-07-12', NULL, 'BCH', 'CHAPARRAL, CALLE PRINCIPAL, MUNICIPIO PIAR', '4263952543', 'NULL', 'SC120', '2016-II'),
(203, '0400', '22725753', 'EIN', 'Jennifer', NULL, 'Laya', NULL, 'F', '1994-02-19', NULL, 'BCH', 'boqueron de amana calle principal', '2912050103', 'NULL', 'SC120', '2016-II'),
(204, '0400', '22970525', 'LLI', 'Maydelin', NULL, 'serrano', NULL, 'F', '1993-03-13', NULL, 'BCH', 'Sector Aragua de Maturín Casa Numero sin Numero', '4264924644', 'NULL', 'SC120', '2016-II'),
(205, '0400', '25265131', 'FIS', 'Maria', NULL, 'Velásquez', NULL, 'F', '1994-07-22', NULL, 'BCH', 'Sector Guaritos 1 Casa sin Numero', '2916511586', 'NULL', 'SC120', '2016-II'),
(206, '0400', '17713043', 'EIN', 'ELOINA', NULL, 'GOMEZ', NULL, 'F', '1985-09-18', NULL, 'BCH', 'BRISAS DEL AEREOPUERTO. CASA NUM 114. MATURIN', '4268172616', '', 'SC120', '2016-II'),
(207, '0400', '20915517', 'INF', 'Jennifer', NULL, 'Salazar', NULL, 'F', '1992-10-09', NULL, 'BCH', 'La democracia, Calle 2, Casa 104. Maturín, Estado Monagas', '4262959497', 'NULL', 'SC120', '2016-II'),
(208, '0400', '20936591', 'LLI', 'Diana', NULL, 'Gomez', NULL, 'F', '1993-07-02', NULL, 'BCH', 'Tropical estado monagas', '2913276410', 'NULL', 'SC120', '2016-II'),
(209, '0400', '20936527', 'EFI', 'Andres', NULL, 'Arcia', NULL, 'M', '1992-08-06', NULL, 'BCH', 'Quiriquire Calle Principa, Casa 117', '2916458957', 'NULL', 'SC120', '2016-II'),
(210, '0400', '8353356', 'ECO', 'BETZAIDA', NULL, 'GARCIA', NULL, 'F', '1962-03-02', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(211, '0400', '20937082', 'ECO', 'keila', NULL, 'Aguiar', NULL, 'F', '1992-09-16', NULL, 'BCH', 'virgen del valle via principal punta de mata estado monagas', '2923411419', 'NULL', 'SC120', '2016-II'),
(212, '0400', '18386915', 'EDA', 'MARIA', NULL, 'MARTINEZ', NULL, 'F', '1988-01-25', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(213, '0400', '21050886', 'EFI', 'Nelson', NULL, 'Zaragoza', NULL, 'M', '1992-06-17', NULL, 'BCH', 'la pica, calle tranversal, vuelta larga, maturin estado monagas.', '4269920781', 'NULL', 'SC120', '2016-II'),
(214, '0400', '20936914', 'BIO', 'Erik', NULL, 'López', NULL, 'M', '1992-12-06', NULL, 'BCH', 'Campo alegre, la montañita, maturin estado monagas.', '4264923882', 'NULL', 'SC120', '2016-II'),
(215, '0400', '20140028', 'INF', 'CARLOS', NULL, 'FERMIN', NULL, 'M', '1987-02-17', NULL, 'BCH', 'Calle principal sector francisco de miranda casa 15', '2916523267', 'NULL', 'SC120', '2016-II'),
(216, '0400', '25576900', 'INF', 'anarian', NULL, 'fonseca', NULL, 'F', '1993-10-25', NULL, 'BCH', 'aragua maturin', '4249275893', 'NULL', 'SC120', '2016-II'),
(217, '0400', '25020592', 'BIO', 'maria', NULL, 'lizarazo', NULL, 'F', '1994-06-19', NULL, 'BCH', 'calle arriojas', '4167629292', 'NULL', 'SC120', '2016-II'),
(218, '0400', '21380556', 'INF', 'jhonnatan', NULL, 'Vallenilla', NULL, 'M', '1994-08-24', NULL, 'BCH', 'guarito 3', '4248708343', 'NULL', 'SC120', '2016-II'),
(219, '0400', '22723001', 'INF', 'ROSANGELA', NULL, 'RODRIGUEZ', NULL, 'F', '1994-02-12', NULL, 'BCH', 'PRADOSDEL SUR CALLE 1 CASA 19', '4267933978', 'NULL', 'SC120', '2016-II'),
(220, '0400', '22971922', 'INF', 'ana', NULL, 'sanchez', NULL, 'F', '1993-10-18', NULL, 'BCH', 'taguaya calle principal s/n municipio piar estado monagas', '2927446067', 'NULL', 'SC120', '2016-II'),
(221, '0400', '25028663', 'INF', 'erick', NULL, 'bellorin', NULL, 'M', '1993-11-16', NULL, 'BCH', 'brisas de la laguna', '2913156550', 'NULL', 'SC120', '2016-II'),
(222, '0400', '23729479', 'ING', 'maria', NULL, 'avila', NULL, 'F', '1994-10-05', NULL, 'BCH', 'urb laguna paraiso', '2916448123', 'NULL', 'SC120', '2016-II'),
(223, '0400', '21343307', 'EFI', 'LUIS', NULL, 'GOMEZ', NULL, 'M', '1990-05-07', NULL, 'BCH', 'urbanizacion los moriches II calle 5 casa 137', '2916449567', 'NULL', 'SC120', '2016-II'),
(224, '0400', '20018223', 'EFI', 'Elvis', NULL, 'Bolivar', NULL, 'M', '1990-10-07', NULL, 'BCH', 'brisas del aeropuerto', '2917722096', 'NULL', 'SC120', '2016-II'),
(225, '0400', '24868174', 'EFI', 'FRANK', NULL, 'BRITO', NULL, 'M', '1993-12-25', NULL, 'BCH', 'CALLE GUATAMARAL DE QUIRIQUIRE,MUNICIPIO PUNCERES.ESTADO MONAGAS.', '2915110702', 'NULL', 'SC120', '2016-II'),
(226, '0400', '21177784', 'EIN', 'Glorimar', NULL, 'Romero', NULL, 'F', '1991-08-21', NULL, 'BCH', 'Paramaconi avenida transversal 6', '2832353146', 'NULL', 'SC120', '2016-II'),
(227, '0400', '14704197', 'EIN', 'Aurys', NULL, 'Malave', NULL, 'F', '1980-04-12', NULL, 'BCH', 'El silencio de campo alegre calle 6 numero 8', '2919894971', 'NULL', 'SC120', '2016-II'),
(228, '0400', '21040891', 'LLI', 'VICLEIDYS', NULL, 'GUATARAMA', NULL, 'F', '1992-09-11', NULL, 'BCH', 'CALLE AZCUE, MATIRN', '2916422753', 'NULL', 'SC120', '2016-II'),
(229, '0400', '24842513', 'BIO', 'GENESIS', NULL, 'GONZALEZ', NULL, 'F', '1994-12-07', NULL, 'BCH', 'LA FLORESTA', '4163160186', 'NULL', 'SC120', '2016-II'),
(230, '0400', '22620559', 'INF', 'Billy', NULL, 'Amaya', NULL, 'M', '1994-05-02', NULL, 'BCH', 'Sector La Florida Via San Vicente Casa sin numero', '4166952948', 'NULL', 'SC120', '2016-II'),
(231, '0400', '20916277', 'FIS', 'Janekary', NULL, 'Requiz', NULL, 'F', '1991-08-07', NULL, 'BCH', 'urbanización Las Cayenas, manzana 7, calle 2, casa 137', '2916516128', 'NULL', 'SC120', '2016-II'),
(232, '0400', '25265757', 'MAT', 'CRISMAR', NULL, 'D ARTHENAY', NULL, 'F', '1995-08-28', NULL, 'BCH', 'LAS CAROLINAS, MATURIN', '2916529492', 'NULL', 'SC120', '2016-II'),
(233, '0400', '20310572', 'INF', 'Marianny', NULL, 'Bastardo', NULL, 'F', '1990-10-29', NULL, 'BCH', 'Urbnanizacion Alberto Ravel', '2918969592', 'NULL', 'SC120', '2016-II'),
(234, '0400', '18653767', 'INF', 'ALBANYS', NULL, 'OROZCO', NULL, 'F', '1988-11-25', NULL, 'BCH', 'VIA CARIPITO SECTOR ALTO SUCRE.', '2918085277', 'NULL', 'SC120', '2016-II'),
(235, '0400', '22720552', 'BIO', 'Alejandra', NULL, 'Flores', NULL, 'F', '1994-08-27', NULL, 'BCH', 'Tipuro, Palma Real, Tinajero manzana unica casa Número 15.', '2918085373', 'NULL', 'SC120', '2016-II'),
(236, '0400', '12192823', 'EIN', 'Ali', NULL, 'Rodriguez', NULL, 'M', '1975-07-13', NULL, 'BCH', 'Urbanización Doña Menca 2 vereda 8 casa numero 20', '2918963750', 'NULL', 'SC120', '2016-II'),
(237, '0400', '23895489', 'BIO', 'Maryoris', NULL, 'Aray', NULL, 'F', '1994-01-08', NULL, 'BCH', 'Costo arriba', '4249360662', 'NULL', 'SC120', '2016-II'),
(238, '0400', '20248418', 'INF', 'JOSELIN', NULL, 'GONZALEZ', NULL, 'F', '1990-03-21', NULL, 'BCH', 'URB. LOS TAPIALES II CALLE G CASA # 2', '2915119184', 'NULL', 'SC120', '2016-II'),
(239, '0400', '24658727', 'EFI', 'Mario', NULL, 'Pérez', NULL, 'M', '1995-07-11', NULL, 'BCH', 'San salvador calle principal Nº20 Estado sucre', '2934161651', 'NULL', 'SC120', '2016-II'),
(240, '0400', '22968177', 'EIN', 'Gleidys', NULL, 'Trujillo', NULL, 'F', '1993-06-07', NULL, 'BCH', 'calle 6 del Silencio de Campo Alegre, casa N°78', '2913154837', 'NULL', 'SC120', '2016-II'),
(241, '0400', '26212733', 'LLI', 'Erika', NULL, 'Manoche', NULL, 'F', '1995-11-28', NULL, 'BCH', 'La Manga', '4140970712', 'NULL', 'SC120', '2016-II'),
(242, '0400', '25503429', 'BIO', 'YACCENIS', NULL, 'MELENDEZ', NULL, 'F', '1995-04-16', NULL, 'BCH', 'SECTOR 01, CARRERA 01, SABANA GRANDE, MATURIN', '2919094256', 'NULL', 'SC120', '2016-II'),
(243, '0400', '22966873', 'BIO', 'xiolianny', NULL, 'bolivar', NULL, 'F', '1995-03-26', NULL, 'BCH', 'silencio campo alegre calle 12', '2916430015', 'NULL', 'SC120', '2016-II'),
(244, '0400', '24124829', 'BIO', 'Genesis', NULL, 'Guedez', NULL, 'F', '1995-06-22', NULL, 'BCH', 'municipio: Acosta parroquia: San Antonio calle: Valle verde', '2924154047', 'NULL', 'SC120', '2016-II'),
(245, '0400', '23895340', 'EIN', 'SONNYBEL', NULL, 'HERNANDEZ', NULL, 'F', '1993-03-12', NULL, 'BCH', 'CALLE PRINCIPAL DE BOQUERON, MATURIN', '2913163312', 'NULL', 'SC120', '2016-II'),
(246, '0400', '20084023', 'INF', 'Raul', NULL, 'Barberii', NULL, 'M', '1992-07-28', NULL, 'BCH', 'calle 14 casa numero 10 sector palo negro', '4249518987', 'NULL', 'SC120', '2016-II'),
(247, '0400', '24125009', 'ING', 'Jose', NULL, 'Rocca', NULL, 'M', '1993-11-23', NULL, 'BCH', 'Los Godos.Sector 2 Vereda 10 Casa Numero 1', '2916516836', 'NULL', 'SC120', '2016-II'),
(248, '0400', '24501212', 'INF', 'Daniel', NULL, 'Machado', NULL, 'M', '1994-10-14', NULL, 'BCH', 'ubrlas viergenes calle 2 la consolacion', '2919896525', 'NULL', 'SC120', '2016-II'),
(249, '0400', '19256437', 'EIN', 'YOSMAN', NULL, 'RAMIREZ', NULL, 'M', '1987-07-10', NULL, 'BCH', 'MATURIN ESTADO MONAGAS', '.', 'NULL', 'SC120', '2016-II'),
(250, '0400', '22705154', 'ECO', 'Katerine', NULL, 'Silveira', NULL, 'F', '1995-05-21', NULL, 'BCH', 'Sector Terrazas del Oeste Calle 4 N° 174', '2916534648', 'NULL', 'SC120', '2016-II'),
(251, '0400', '24868223', 'ECO', 'Estefanny', NULL, 'Jiménez', NULL, 'F', '1994-08-26', NULL, 'BCH', 'Calle La Convenca Casa Sin Número Parroquia Cachipo Municipio Quiriquire', '4167902124', 'NULL', 'SC120', '2016-II'),
(252, '0400', '23530835', 'EIN', 'ARIANNYS', NULL, 'ESPARRAGOZA', NULL, 'F', '1994-06-06', NULL, 'BCH', 'MUNICIPIO BOLIVAR ESTADO MONAGAS', '4264973785', 'NULL', 'SC120', '2016-II'),
(253, '0400', '23946625', 'EIN', 'MAYTE', NULL, 'ESPINOZA', NULL, 'F', '1995-10-02', NULL, 'BCH', 'GÜIRIA ESTADO SUCRE', '4168802647', 'NULL', 'SC120', '2016-II'),
(254, '0400', '23539627', 'MAT', 'LISMAR', NULL, 'RODRIGUEZ', NULL, 'F', '1995-10-05', NULL, 'BCH', 'URB LAS VIRGENES AV PRINCIPAL CARRERA 7 CASA # 85', '4264126161', 'NULL', 'SC120', '2016-II'),
(255, '0400', '25354659', 'INF', 'LEONEL', NULL, 'MAITA', NULL, 'M', '1994-10-20', NULL, 'BCH', 'SAN AGUSTIN URB LOS NARANJOS CALLE 1 # 12 CARIPE', '2924143579', 'NULL', 'SC120', '2016-II'),
(256, '0400', '15116781', 'ECO', 'NEREIDA', NULL, 'ESPINOZA', NULL, 'F', '1980-05-31', NULL, 'BCH', 'MATURÍN', '.', 'NULL', 'SC120', '2016-II'),
(257, '0400', '26158105', 'INF', 'NATASHA', NULL, 'LLAMOZAS', NULL, 'F', '2013-02-28', NULL, 'BCH', 'MATURÍN', '.', 'NULL', 'SC120', '2016-II'),
(258, '0400', '19909421', 'INF', 'PEDRO', NULL, 'MENCIAS', NULL, 'M', '1990-06-13', NULL, 'BCH', '.', '0426-8084891', '', 'SC120', '2016-II'),
(259, '0400', '25999967', 'LLI', 'adriana', NULL, 'medrano', NULL, 'F', '1995-03-14', NULL, 'BCH', 'la toscana, municipio piar.', '2913172599', 'NULL', 'SC120', '2016-II'),
(260, '0400', '25453798', 'EFI', 'Hector', NULL, 'Velasquez', NULL, 'M', '1996-02-12', NULL, 'BCH', 'sector el silencio casa 14', '2916432693', 'NULL', 'SC120', '2016-II'),
(261, '0400', '25372237', 'EDA', 'YEXABEL', NULL, 'GUAYARA', NULL, 'F', '1994-05-23', NULL, 'BCH', 'CALLE GUZMÁN BLANCO. SECTOR CONCHA DE COCO CASA 99', '4269992604', 'NULL', 'SC120', '2016-II'),
(262, '0400', '11336018', 'EIN', 'LORENZO', NULL, 'RENGEL', NULL, 'M', '1971-07-03', NULL, 'BCH', 'chaguaramal, calle leonardo infante , municipio piar estado monagas', '4264807449', 'NULL', 'SC120', '2016-II'),
(263, '0400', '25274448', 'EDA', 'ROISMER', NULL, 'PEREZ', NULL, 'F', '1995-11-03', NULL, 'BCH', 'CALLE PRINCIPAL DE BOQUERON CASA Nº 65 SECTOR EL ZORRO.', '2916419354', 'NULL', 'SC120', '2016-II'),
(264, '0400', '21380660', 'EDA', 'MARILYN', NULL, 'LUGO', NULL, 'F', '1992-10-04', NULL, 'BCH', 'LA MURALLA', '2946640034', 'NULL', 'SC120', '2016-II'),
(265, '0400', '21350694', 'ING', 'Juan', NULL, 'Morón', NULL, 'M', '1992-04-23', NULL, 'BCH', 'Av Libertador Res. Los Jardines Edif. Los Claveles Apto. 1-D', '2916519905', 'NULL', 'SC120', '2016-II'),
(266, '0400', '23538522', 'ECO', 'Yarima', NULL, 'Lanz', NULL, 'F', '1994-06-11', NULL, 'BCH', 'Boqueron, Doña menca, Calle 5, casa N° 30', '2913156240', 'NULL', 'SC120', '2016-II'),
(267, '0400', '20138690', 'EFI', 'José', NULL, 'Millan', NULL, 'M', '1988-03-19', NULL, 'BCH', 'El Furrial, via principal, casa número 1.', '2912052083', 'NULL', 'SC120', '2016-II'),
(268, '0400', '15323056', 'EFI', 'JULIO', NULL, 'GUERRERO', NULL, 'M', '1981-02-08', NULL, 'BCH', 'CALLE MIRANDA, SECTOR PALO NEGRO, MATURIN ESTADO MONAGAS.', '4262511105', 'NULL', 'SC120', '2016-II'),
(269, '0400', '27112732', 'EDA', 'Danyelis', NULL, 'Yeguez', NULL, 'F', '1994-10-20', NULL, 'BCH', 'Sector Gran Victoria, Nº 14B, Apto. 2-4, Los Iranies, Sector La Puente. Maturín,', '4128345077', 'NULL', 'SC120', '2016-II'),
(270, '0400', '22618897', 'INF', 'Roman', NULL, 'Villanueva', NULL, 'M', '1994-12-17', NULL, 'BCH', 'Campo Ayacucho, Calle Mata Siete, Casa Nº 280, Jusepin, Edo. Monagas', '4268916659', 'NULL', 'SC120', '2016-II'),
(271, '0400', '22716798', 'INF', 'Andres', NULL, 'Rojas', NULL, 'M', '1994-12-14', NULL, 'BCH', 'Calle Chimborazo, Nº 114, Maturin, Edo. Monagas', '2913172997', 'NULL', 'SC120', '2016-II'),
(272, '0400', '25453835', 'LLI', 'BRIGGITH', NULL, 'RENGEL', NULL, 'F', '1994-06-20', NULL, 'BCH', 'AV BELLA VISTA CALLEJON LIBERTADOR', '4164956177', 'NULL', 'SC120', '2016-II'),
(273, '0400', '23641156', 'FIS', 'emilson', NULL, 'carvajal', NULL, 'M', '1995-04-11', NULL, 'BCH', 'la gran victoria zono 2 bloque D apto 1-2', '2916535405', 'NULL', 'SC120', '2016-II'),
(274, '0400', '25943816', 'LLI', 'Angel', NULL, 'Torres', NULL, 'M', '1996-07-11', NULL, 'BCH', 'Teresén Municipio Caripe', '2925551106', 'NULL', 'SC120', '2016-II'),
(275, '0400', '25355602', 'LLI', 'SAMIRA', NULL, 'BUTTO', NULL, 'F', '1996-12-09', NULL, 'BCH', 'ALBERTO RAVEL CALLE 30 A # 13', '4165856529', 'NULL', 'SC120', '2016-II'),
(276, '0400', '25615656', 'ECO', 'Yecxyberth', NULL, 'Lanz', NULL, 'F', '1997-08-10', NULL, 'BCH', 'Calle principal el furrial, casa nro 32', '2922222259', 'NULL', 'SC120', '2016-II'),
(277, '0400', '26704322', 'BIO', 'YANMARYS', NULL, 'GUTIERREZ', NULL, 'F', '1997-01-15', NULL, 'BCH', 'urbanizacion ave del paraiso,calle 8 letra d , numero 201', '2934113393', 'NULL', 'SC120', '2016-II'),
(278, '0400', '22616908', 'EFI', 'YORDIN', NULL, 'JIMENEZ', NULL, 'M', '1995-12-20', NULL, 'bch', 'BAJO GUARAPICHE CALLE LIBERTAD', '4269971854', 'NULL', 'SC120', '2016-II'),
(279, '0400', '25782174', 'FIS', 'ALEXIS', NULL, 'ESPIN', NULL, 'M', '1996-09-10', NULL, 'bch', 'VIA LA PICA,PARARI ADENTRO', '2916423757', 'NULL', 'SC120', '2016-II'),
(280, '0400', '23895704', 'INF', 'Carlos', NULL, 'Espinoza', NULL, 'M', '1995-09-10', NULL, 'BCH', 'Boqueron, Godofredo gonzalez', '4147725466', 'NULL', 'SC120', '2016-II'),
(281, '0400', '24501129', 'INF', 'LILISBETH', NULL, 'MORALES', NULL, 'F', '1994-10-10', NULL, 'bch', 'VILLA ALTA CRUZ BRISA DEL SOL I # 50', '4163520466', 'NULL', 'SC120', '2016-II'),
(282, '0400', '25612008', 'INF', 'yeicer', NULL, 'chacon', NULL, 'F', '1995-12-01', NULL, 'bch', 'Doña Menca', '2918963135', 'NULL', 'SC120', '2016-II'),
(283, '0400', '25909010', 'ING', 'adolfo', NULL, 'ortuño', NULL, 'M', '1997-02-01', NULL, 'bch', 'Negro Primero', '2916420141', 'NULL', 'SC120', '2016-II'),
(284, '0400', '25782340', 'LLI', 'Roxanny', NULL, 'Peñalver', NULL, 'F', '1996-11-10', NULL, 'bch', 'Prados del Sur Calle 4 Casa 4', '2915112551', 'NULL', 'SC120', '2016-II'),
(285, '0400', '26625440', 'EDA', 'MARIANNY JOSE', NULL, 'PALMARES', NULL, 'F', '1996-03-19', NULL, 'BCH', 'CALLE JUNIN SUR N° 102 MATURIN ESTADO MONAGAS', '4162877061', 'NULL', 'SC120', '2016-II'),
(286, '0400', '26997872', 'BIO', 'DIATRIZ', NULL, 'ALVARADO', NULL, 'F', '1991-02-20', NULL, 'BCH', 'URBANIZACION JUANICO, CALLE PICHINCHA NUMERO 24 MATURIN ESTADO MONAGAS', '2916441903', 'NULL', 'SC120', '2016-II'),
(287, '0400', '16765946', 'LLI', 'YULIMAR', NULL, 'ILANJIAN', NULL, 'F', '1984-05-02', NULL, 'BCH', '.', '.', '', 'SC120', '2016-II'),
(288, '0400', '22618243', 'LLI', 'YAINIRIS', NULL, 'BETANCOURT', NULL, 'F', '1994-03-05', NULL, 'BCH', 'SABANA GRANDE, SECTOR II, CALLE 06, CASA NRO 10, MATURIN', '2919896754', 'NULL', 'SC120', '2016-II'),
(289, '0400', '23530698', 'EFI', 'michel', NULL, 'navarro', NULL, 'M', '1994-07-03', NULL, 'BCH', 'urb.villas de altamira, manzana 7, casa # 15', '2916449582', 'NULL', 'SC120', '2016-II'),
(290, '0400', '20919541', 'GHI', 'CAMILO', NULL, 'RODRIGUEZ', NULL, 'M', '1993-08-06', NULL, 'BCH', 'URBANIZACION LAS FLORES, CALLE 2 OESTE, CASA 04-25- MATURIN', '2916416753', 'NULL', 'SC120', '2016-II'),
(291, '0400', '21348765', 'ECO', 'Emma', NULL, 'Romero', NULL, 'F', '1993-11-14', NULL, 'BCH', 'Guayabal Via la Toscana Calle el esfuerzo Casa Nº32', '2913944848', 'NULL', 'SC120', '2016-II'),
(292, '0400', '22702220', 'ECO', 'Euclides', NULL, 'Palmares', NULL, 'M', '1992-12-11', NULL, 'BCH', 'Guarito 1, vereda 11 casa #38', '2874148498', 'NULL', 'SC120', '2016-II'),
(293, '0400', '22620563', 'ECO', 'yuletzy', NULL, 'rojas', NULL, 'F', '1994-09-15', NULL, 'BCH', 'brisas del aeropuerto casa #9 transv. 7 con calle 8 y 9', '2916441536', 'NULL', 'SC120', '2016-II'),
(294, '0400', '20138671', 'ECO', 'Carolina', NULL, 'Molinett', NULL, 'F', '1988-11-10', NULL, 'BCH', 'Boqueron, Calle Principal, Casa N|80. Maturín, Estado Monagas.', '4162971240', 'NULL', 'SC120', '2016-II'),
(295, '0400', '20915427', 'ECO', 'yetzy', NULL, 'garcia', NULL, 'F', '1991-01-20', NULL, 'BCH', 'carrera 2 manzana 9 sector 4 sabana grande', '2916434889', 'NULL', 'SC120', '2016-II'),
(296, '0400', '19037460', 'ING', 'ORLANDO', NULL, 'MARCANO', NULL, 'M', '1987-11-26', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(297, '0400', '24577855', 'EFI', 'Enderson', NULL, 'Maza', NULL, 'M', '1995-04-24', NULL, 'BCH', 'Matrurín Estado Monagas', '.', 'NULL', 'SC120', '2016-II'),
(298, '0400', '23538388', 'ECO', 'Naigler', NULL, 'Aguilera', NULL, 'F', '1993-12-09', NULL, 'BCH', 'Matuín Estado Monagas', '.', 'NULL', 'SC120', '2016-II'),
(299, '0400', '23818479', 'ECO', 'YANETZY', NULL, 'GARCIA', NULL, 'F', '1994-09-25', NULL, 'BCH', 'SECTOR 4 SABANA GRANDE CARRERA 3 NUMERO 20', '2916434889', 'NULL', 'SC120', '2016-II'),
(300, '0400', '23530696', 'EFI', 'maicor', NULL, 'navarro', NULL, 'M', '1994-07-03', NULL, 'BCH', 'urb.villas de altamira, manzana 7, casa # 7', '2916449582', 'NULL', 'SC120', '2016-II'),
(301, '0400', '14620378', 'EIN', 'ROSITA', NULL, 'ROJAS', NULL, 'F', '1979-05-29', NULL, 'BCH', '.', '2916522275', '', 'SC120', '2016-II'),
(302, '0400', '16375660', 'INF', 'Sandra', NULL, 'González', NULL, 'F', '1983-07-02', NULL, 'bch', 'calle las delicias, sector valenzuela, casa nª 79, Maturín estado monagas', '2913155644', 'NULL', 'SC120', '2016-II'),
(303, '0400', '22718167', 'BIO', 'Marianny', NULL, 'Guzman', NULL, 'F', '1993-07-19', NULL, 'BCH', 'Parari Adentro-Via La Pica Calle Las Flores N= De Casa: 46-14', '2915111312', 'NULL', 'SC120', '2016-II'),
(304, '0400', '18080755', 'ECO', 'SORIANYELIS', NULL, 'HERNANDEZ', NULL, 'F', '1988-09-16', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(305, '0400', '24519484', 'LLI', 'JOSE', NULL, 'CAÑA', NULL, 'M', '1993-08-14', NULL, 'BCH', 'JUANICO COUNTRY, MATURIN', '2819971541', 'NULL', 'SC120', '2016-II'),
(306, '0400', '16710436', 'INF', 'RUSMARY', NULL, 'CADENA', NULL, 'F', '1983-02-02', NULL, 'BCH', 'LA FLORECITA CARRERA 5 CASA #', '4264911165', 'NULL', 'SC120', '2016-II'),
(307, '0400', '22974989', 'ING', 'ARGENIS', NULL, 'BOADA', NULL, 'M', '1995-06-12', NULL, 'BCH', 'MATURÍN ESTADO MONAGAS', '-', 'NULL', 'SC120', '2016-II'),
(308, '0400', '24126876', 'ING', 'LEORDYS', NULL, 'TALY', NULL, 'F', '1995-08-08', NULL, 'BCH', 'ALTO DE LOS GODOS MATURÍN', '0', 'NULL', 'SC120', '2016-II'),
(309, '0400', '22720421', 'EFI', 'MELVÍN', NULL, 'MARTÍNEZ', NULL, 'M', '2013-02-28', NULL, 'BCH', 'MATURÍN', '.', 'NULL', 'SC120', '2016-II'),
(310, '0400', '24334015', 'EFI', 'Omar', NULL, 'Agreda', NULL, 'M', '1965-08-12', NULL, 'BCH', 'CARIPITO,ESTADO MONAGAS, LA TUBERIA, FRENTE AGUAS DE MONAGAS.', '2918968749', 'NULL', 'SC120', '2016-II'),
(311, '0400', '23539142', 'GHI', 'Elymar', NULL, 'Maestre', NULL, 'F', '1993-10-07', NULL, 'BCH', 'Antigua Prolongación Cedeño Carrera 4 Casa Numero #28 Sector Barrio Obrero', '2916422074', 'NULL', 'SC120', '2016-II'),
(312, '0400', '20420612', 'GHI', 'Norealis', NULL, 'Gómez', NULL, 'F', '1990-01-09', NULL, 'BCH', 'Brisas del Aeropuerto', '4267149055', 'NULL', 'SC120', '2016-II'),
(313, '0400', '20915045', 'GHI', 'ROSANYELIS', NULL, 'CALZADILLA', NULL, 'F', '1993-05-24', NULL, 'BCH', 'CARRERA 10, CALLE 05, LA PUENTE, NRO 19, MATURIN', '2916521528', 'NULL', 'SC120', '2016-II'),
(314, '0400', '18464783', 'LLI', 'adriana', NULL, 'reina', NULL, 'F', '1985-09-15', NULL, 'BCH', 'bocas de rio chiquito.municipio piar. estado monagas', '4163435431', 'NULL', 'SC120', '2016-II'),
(315, '0400', '20139683', 'MAT', 'YULIANNYS', NULL, 'JIMENEZ', NULL, 'F', '1990-11-06', NULL, 'BCH', '.', '', '', 'SC120', '2016-II'),
(316, '0400', '11449873', 'EIN', 'MIRLA', NULL, 'BRITO', NULL, 'F', '1973-11-28', NULL, 'BCH', '.', '..', '', 'SC120', '2016-II'),
(317, '0400', '13093355', 'EIN', 'rone', NULL, 'núñez', NULL, 'F', '1976-07-15', NULL, 'BCH', 'avenida rivas numero 166 carrera 3', '2916432556', 'NULL', 'SC120', '2016-II'),
(318, '0400', '25012944', 'EIN', 'Ricardo', NULL, 'Bermudez', NULL, 'M', '1995-06-09', NULL, 'BCH', 'calle trinidad numero 64', '2916440229', 'NULL', 'SC120', '2016-II'),
(319, '0400', '13815235', 'EIN', 'MARGARITA', NULL, 'CEDEÑO', NULL, 'F', '1978-10-24', NULL, 'BCH', 'GUARITO 3 CANAL 90', '4129448893', 'NULL', 'SC120', '2016-II');
INSERT INTO `estudiantes` (`id`, `cod_sede`, `cedula`, `codespecialidad`, `primernombre`, `segundonombre`, `primerapellido`, `segundoapellido`, `sexo`, `fecha_nac`, `matricula`, `tipo_estudiante`, `direccion`, `telefono`, `correo_secundario`, `codigo_curso`, `periodo_acad`) VALUES
(320, '0400', '20937888', 'INF', 'JAVIELYS', NULL, 'ZAPATA', NULL, 'F', '2013-02-28', NULL, 'BCH', 'MATURÍN', '.', 'NULL', 'SC120', '2016-II'),
(321, '0400', '26101092', 'GHI', 'Marielvis', NULL, 'Rodriguez', NULL, 'F', '1995-08-28', NULL, 'BCH', 'Dionicio Nuñez calle Nº02 casa Nº23', '2916530104', 'NULL', 'SC120', '2016-II'),
(322, '0400', '19446275', 'GHI', 'DANIEL', NULL, 'CORONADO', NULL, 'M', '1989-02-04', NULL, 'BCH', '.', '4249557764', '', 'SC120', '2016-II'),
(323, '0400', '24501926', 'ECO', 'JONATHAN', NULL, 'ROCA', NULL, 'M', '1994-11-23', NULL, 'BCH', 'MATURIN', '4148912600', 'NULL', 'SC120', '2016-II'),
(324, '0400', '21347815', 'EDA', 'indra', NULL, 'paez', NULL, 'F', '1992-03-07', NULL, 'BCH', 'calle principal santa elena de las piñas', '2916436425', 'NULL', 'SC120', '2016-II'),
(325, '0400', '22620659', 'EDA', 'Nailyn', NULL, 'Nieves', NULL, 'F', '1993-01-28', NULL, 'BCH', 'Alto Paramaconi 2 Transversal B casa numero 13', '2916514592', 'NULL', 'SC120', '2016-II');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institutos`
--

CREATE TABLE `institutos` (
  `id` int(11) NOT NULL,
  `CodSede` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `NombInstituto` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `VigenActua` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sede_id` int(11) NOT NULL,
  `sige_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `institutos`
--

INSERT INTO `institutos` (`id`, `CodSede`, `NombInstituto`, `VigenActua`, `sede_id`, `sige_id`) VALUES
(1, '100', 'Instituto Pedagógico de Caracas', '', 1, 1),
(2, '101', 'Instituto Pedagógico de Caracas - FVM', '', 1, 2),
(3, '200', 'Instituto Pedagógico de Barquisimeto \"Luis Beltrán Prieto Figueroa\"', '', 3, 1),
(4, '201', 'IPB - Sede Profesionalización', '', 3, 9),
(5, '202', 'IPB - El Tocuyo', '', 3, 3),
(6, '204', 'IPB - Sanare', '', 3, 4),
(7, '205', 'IPB - Quibor', '', 3, 10),
(8, '206', 'IPB - Duaca', '', 3, 5),
(9, '208', 'IPB - Santa Ines', '', 3, 6),
(10, '210', 'IPB - Urachiche', '', 3, 2),
(11, '212', 'IPB - Carora', '', 3, 7),
(12, '214', 'IPB - Coro', '', 3, 8),
(13, '300', 'Instituto Pedagógico de Maracay \"Rafael Alberto Escobar Lara\"', '', 13, 3),
(14, '301', 'Instituto Pedagógico de Maracay - IUTAR', '', 13, 5),
(15, '305', 'Instituto Pedagógico de Maracay - CUAM', '', 13, 7),
(16, '400', 'Instituto Pedagógico de Maturín \"Antonio Lira Alcalá\"', '', 16, 1),
(17, '401', 'IPM San Antonio de Capayacuar', '', 16, 2),
(18, '500', 'Instituto Pedagógico de Miranda \"José Manuel Siso Martínez\"', '', 18, 6),
(19, '501', 'IPMJMSM-Valles del Tuy', '', 18, 7),
(20, '502', 'IPMJMSM-Rio Chico', '', 18, 8),
(21, '504', 'Instituto Universitario Tomas Lander IUTTOL', '', 18, 9),
(22, '600', 'Instituto de Mejoramiento Profesional del Magisterio', '', 22, 9),
(23, '601', 'IMPM Amazonas', '', 22, 10),
(24, '602', 'IMPM Amazonas - Puerto Ayacucho', '', 22, 11),
(25, '604', 'IMPM Amazonas - San Fernando de Atabapo', '', 22, 12),
(26, '605', 'IMPM Anzoátegui', '', 22, 13),
(27, '606', 'IMPM Anzoátegui - Barcelona', '', 22, 14),
(28, '608', 'IMPM Anzoátegui - Anaco', '', 22, 15),
(29, '610', 'IMPM Anzoátegui - El Tigre', '', 22, 16),
(30, '611', 'IPRM Apure', '', 81, 0),
(31, '612', 'IPRM Apure - San Fernando de Apure', '', 81, 70),
(32, '614', 'IMPM Apure - Achaguas', '', 22, 19),
(33, '616', 'IMPM Apure - Bruzual', '', 22, 20),
(34, '618', 'IMPM Apure - Elorza', '', 22, 21),
(35, '620', 'IMPM Apure - Guasdualito', '', 22, 22),
(36, '622', 'IMPM Apure - El Nula', '', 22, 23),
(37, '624', 'IMPM Apure - Mantecal', '', 22, 24),
(38, '625', 'IMPM Barinas', '', 22, 25),
(39, '627', 'IMPM Bolívar', '', 22, 26),
(40, '628', 'IMPM Bolívar - Ciudad Bolívar', '', 22, 27),
(41, '630', 'IMPM Bolívar - Piar', '', 22, 28),
(42, '632', 'IMPM Bolívar - Puerto Ordaz', '', 22, 29),
(43, '633', 'IMPM Carabobo', '', 22, 30),
(44, '635', 'IMPM Cojedes - San Carlos', '', 22, 31),
(45, '637', 'IMPM Falcón', '', 22, 32),
(46, '638', 'IMPM Falcón - Coro', '', 22, 33),
(47, '640', 'IMPM Falcón - Puerto Cumarebo', '', 22, 34),
(48, '642', 'IMPM Falcón - Santa Cruz de Bucaral', '', 22, 35),
(49, '643', 'IMPM Punto Fijo', '', 22, 36),
(50, '645', 'IMPM Mérida', '', 22, 37),
(51, '646', 'IMPM Mérida - Mérida', '', 22, 38),
(52, '648', 'IMPM Mérida - El Vigía', '', 22, 39),
(53, '650', 'IMPM Mérida - Zea', '', 22, 40),
(54, '651', 'IMPM Miranda', '', 22, 41),
(55, '652', 'IMPM Miranda - Los Teques', '', 22, 42),
(56, '654', 'IMPM Miranda - Ocumare del Tuy', '', 22, 43),
(57, '656', 'IMPM La Guaira - La Guaira', '', 22, 44),
(58, '658', 'IMPM Miranda - Carayaca', '', 22, 45),
(59, '659', 'IMPM  Miranda - Centro Atención Caracas', '', 22, 46),
(60, '661', 'IMPM Miranda - Higuerote', '', 22, 47),
(61, '663', 'IMPM Nueva Esparta - La Asunción', '', 22, 48),
(62, '665', 'IMPM Portuguesa', '', 22, 49),
(63, '666', 'IMPM Portuguesa - Guanare', '', 22, 50),
(64, '668', 'IMPM Portuguesa - Biscucuy', '', 22, 51),
(65, '669', 'IMPM Acarigua', '', 22, 52),
(66, '671', 'IMPM Sucre - Cumaná', '', 22, 53),
(67, '673', 'IMPM Carúpano', '', 22, 54),
(68, '675', 'IMPM Táchira - San Cristobal', '', 22, 55),
(69, '677', 'IMPM Tucupita', '', 22, 56),
(70, '678', 'IMPM Tucupita - Tucupita', '', 22, 57),
(71, '680', 'IMPM Tucupita - Piacoa', '', 22, 58),
(72, '681', 'IMPM Trujillo - Valera', '', 22, 59),
(73, '683', 'IMPM Boconó', '', 22, 60),
(74, '685', 'IMPM Yaracuy - San Felipe', '', 22, 61),
(75, '687', 'IMPM Zulia', '', 22, 62),
(76, '688', 'IMPM Zulia - Maracaibo', '', 22, 63),
(77, '690', 'IMPM Zulia - Machiques', '', 22, 64),
(78, '700', 'Instituto Pedagógico Rural \"Gervasio Rubio\"', '', 78, 65),
(79, '701', 'IPRGR Encontrados', '', 78, 66),
(81, '800', 'Instituto Pedagógico Rural El Mácaro “Luis Fermin”', '', 81, 68),
(82, '801', 'IPRM Puerto Ayacucho', '', 81, 69),
(83, '802', 'IPRM San Fernando de Apure', '', 81, 70),
(84, '803', 'IPRM Santa Elena de Uairén', '', 81, 71),
(85, '804', 'IPRM Falcón - Yaracal', '', 81, 72),
(86, '806', 'IPRM Zulia', '', 81, 73),
(87, '807', 'IPRM Delta Amacuro - Tucupita - San Francisco de l', '', 81, 87),
(88, '812', 'IPRM Apure - Achaguas', '', 81, 74),
(89, '814', 'IPRM Falcón - Dabajuro', '', 81, 75),
(90, '815', 'IPRM Guárico - San Juan de los Morros', '', 81, 76),
(91, '816', 'IPRM Zulia - Machiques', '', 81, 88),
(92, '824', 'IPRM Falcón - Pueblo Nuevo de la Sierra', '', 81, 78),
(93, '825', 'IPRM Guárico - Valle de la Pascua', '', 81, 79),
(94, '834', 'IPRM Falcón - La Cruz de Taratara', '', 81, 76),
(95, '835', 'IPRM Guárico - Altagracia de Orituco', '', 81, 80),
(96, '691', 'IMPM Guárico - Camaguán', '', 22, 65),
(99, '', 'IMPM Trujillo-Sabana Mendoza', '', 22, 66),
(101, '691', 'IPRM Guárico - Camaguán', '', 81, 91),
(102, '001', 'Rectorado', '', 10, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localities`
--

CREATE TABLE `localities` (
  `id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `locality` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `localities`
--

INSERT INTO `localities` (`id`, `province_id`, `locality`) VALUES
(1, 1, 'Alto Orinoco'),
(2, 1, 'Huachamacare Acanaña'),
(3, 1, 'Marawaka Toky Shamanaña'),
(4, 1, 'Mavaka Mavaka'),
(5, 1, 'Sierra Parima Parimabé'),
(6, 2, 'Ucata Laja Lisa'),
(7, 2, 'Yapacana Macuruco'),
(8, 2, 'Caname Guarinuma'),
(9, 3, 'Fernando Girón Tovar'),
(10, 3, 'Luis Alberto Gómez'),
(11, 3, 'Pahueña Limón de Parhueña'),
(12, 3, 'Platanillal Platanillal'),
(13, 4, 'Samariapo'),
(14, 4, 'Sipapo'),
(15, 4, 'Munduapo'),
(16, 4, 'Guayapo'),
(17, 5, 'Alto Ventuari'),
(18, 5, 'Medio Ventuari'),
(19, 5, 'Bajo Ventuari'),
(20, 6, 'Victorino'),
(21, 6, 'Comunidad'),
(22, 7, 'Casiquiare'),
(23, 7, 'Cocuy'),
(24, 7, 'San Carlos de Río Negro'),
(25, 7, 'Solano'),
(26, 8, 'Anaco'),
(27, 8, 'San Joaquín'),
(28, 9, 'Cachipo'),
(29, 9, 'Aragua de Barcelona'),
(30, 11, 'Lechería'),
(31, 11, 'El Morro'),
(32, 12, 'Puerto Píritu'),
(33, 12, 'San Miguel'),
(34, 12, 'Sucre'),
(35, 13, 'Valle de Guanape'),
(36, 13, 'Santa Bárbara'),
(37, 14, 'El Chaparro'),
(38, 14, 'Tomás Alfaro'),
(39, 14, 'Calatrava'),
(40, 15, 'Guanta'),
(41, 15, 'Chorrerón'),
(42, 16, 'Mamo'),
(43, 16, 'Soledad'),
(44, 17, 'Mapire'),
(45, 17, 'Piar'),
(46, 17, 'Santa Clara'),
(47, 17, 'San Diego de Cabrutica'),
(48, 17, 'Uverito'),
(49, 17, 'Zuata'),
(50, 18, 'Puerto La Cruz'),
(51, 18, 'Pozuelos'),
(52, 19, 'Onoto'),
(53, 19, 'San Pablo'),
(54, 20, 'San Mateo'),
(55, 20, 'El Carito'),
(56, 20, 'Santa Inés'),
(57, 20, 'La Romereña'),
(58, 21, 'Atapirire'),
(59, 21, 'Boca del Pao'),
(60, 21, 'El Pao'),
(61, 21, 'Pariaguán'),
(62, 22, 'Cantaura'),
(63, 22, 'Libertador'),
(64, 22, 'Santa Rosa'),
(65, 22, 'Urica'),
(66, 23, 'Píritu'),
(67, 23, 'San Francisco'),
(68, 24, 'San José de Guanipa'),
(69, 25, 'Boca de Uchire'),
(70, 25, 'Boca de Chávez'),
(71, 26, 'Pueblo Nuevo'),
(72, 26, 'Santa Ana'),
(73, 27, 'Bergatín'),
(74, 27, 'Caigua'),
(75, 27, 'El Carmen'),
(76, 27, 'El Pilar'),
(77, 27, 'Naricual'),
(78, 27, 'San Crsitóbal'),
(79, 28, 'Edmundo Barrios'),
(80, 28, 'Miguel Otero Silva'),
(81, 29, 'Achaguas'),
(82, 29, 'Apurito'),
(83, 29, 'El Yagual'),
(84, 29, 'Guachara'),
(85, 29, 'Mucuritas'),
(86, 29, 'Queseras del medio'),
(87, 30, 'Biruaca'),
(88, 31, 'Bruzual'),
(89, 31, 'Mantecal'),
(90, 31, 'Quintero'),
(91, 31, 'Rincón Hondo'),
(92, 31, 'San Vicente'),
(93, 32, 'Guasdualito'),
(94, 32, 'Aramendi'),
(95, 32, 'El Amparo'),
(96, 32, 'San Camilo'),
(97, 32, 'Urdaneta'),
(98, 33, 'San Juan de Payara'),
(99, 33, 'Codazzi'),
(100, 33, 'Cunaviche'),
(101, 34, 'Elorza'),
(102, 34, 'La Trinidad'),
(103, 35, 'San Fernando'),
(104, 35, 'El Recreo'),
(105, 35, 'Peñalver'),
(106, 35, 'San Rafael de Atamaica'),
(107, 36, 'Pedro José Ovalles'),
(108, 36, 'Joaquín Crespo'),
(109, 36, 'José Casanova Godoy'),
(110, 36, 'Madre María de San José'),
(111, 36, 'Andrés Eloy Blanco'),
(112, 36, 'Los Tacarigua'),
(113, 36, 'Las Delicias'),
(114, 36, 'Choroní'),
(115, 37, 'Bolívar'),
(116, 38, 'Camatagua'),
(117, 38, 'Carmen de Cura'),
(118, 39, 'Santa Rita'),
(119, 39, 'Francisco de Miranda'),
(120, 39, 'Moseñor Feliciano González'),
(121, 40, 'Santa Cruz'),
(122, 41, 'José Félix Ribas'),
(123, 41, 'Castor Nieves Ríos'),
(124, 41, 'Las Guacamayas'),
(125, 41, 'Pao de Zárate'),
(126, 41, 'Zuata'),
(127, 42, 'José Rafael Revenga'),
(128, 43, 'Palo Negro'),
(129, 43, 'San Martín de Porres'),
(130, 44, 'El Limón'),
(131, 44, 'Caña de Azúcar'),
(132, 45, 'Ocumare de la Costa'),
(133, 46, 'San Casimiro'),
(134, 46, 'Güiripa'),
(135, 46, 'Ollas de Caramacate'),
(136, 46, 'Valle Morín'),
(137, 47, 'San Sebastían'),
(138, 48, 'Turmero'),
(139, 48, 'Arevalo Aponte'),
(140, 48, 'Chuao'),
(141, 48, 'Samán de Güere'),
(142, 48, 'Alfredo Pacheco Miranda'),
(143, 49, 'Santos Michelena'),
(144, 49, 'Tiara'),
(145, 50, 'Cagua'),
(146, 50, 'Bella Vista'),
(147, 51, 'Tovar'),
(148, 52, 'Urdaneta'),
(149, 52, 'Las Peñitas'),
(150, 52, 'San Francisco de Cara'),
(151, 52, 'Taguay'),
(152, 53, 'Zamora'),
(153, 53, 'Magdaleno'),
(154, 53, 'San Francisco de Asís'),
(155, 53, 'Valles de Tucutunemo'),
(156, 53, 'Augusto Mijares'),
(157, 54, 'Sabaneta'),
(158, 54, 'Juan Antonio Rodríguez Domínguez'),
(159, 55, 'El Cantón'),
(160, 55, 'Santa Cruz de Guacas'),
(161, 55, 'Puerto Vivas'),
(162, 56, 'Ticoporo'),
(163, 56, 'Nicolás Pulido'),
(164, 56, 'Andrés Bello'),
(165, 57, 'Arismendi'),
(166, 57, 'Guadarrama'),
(167, 57, 'La Unión'),
(168, 57, 'San Antonio'),
(169, 58, 'Barinas'),
(170, 58, 'Alberto Arvelo Larriva'),
(171, 58, 'San Silvestre'),
(172, 58, 'Santa Inés'),
(173, 58, 'Santa Lucía'),
(174, 58, 'Torumos'),
(175, 58, 'El Carmen'),
(176, 58, 'Rómulo Betancourt'),
(177, 58, 'Corazón de Jesús'),
(178, 58, 'Ramón Ignacio Méndez'),
(179, 58, 'Alto Barinas'),
(180, 58, 'Manuel Palacio Fajardo'),
(181, 58, 'Juan Antonio Rodríguez Domínguez'),
(182, 58, 'Dominga Ortiz de Páez'),
(183, 59, 'Barinitas'),
(184, 59, 'Altamira de Cáceres'),
(185, 59, 'Calderas'),
(186, 60, 'Barrancas'),
(187, 60, 'El Socorro'),
(188, 60, 'Mazparrito'),
(189, 61, 'Santa Bárbara'),
(190, 61, 'Pedro Briceño Méndez'),
(191, 61, 'Ramón Ignacio Méndez'),
(192, 61, 'José Ignacio del Pumar'),
(193, 62, 'Obispos'),
(194, 62, 'Guasimitos'),
(195, 62, 'El Real'),
(196, 62, 'La Luz'),
(197, 63, 'Ciudad Bolívia'),
(198, 63, 'José Ignacio Briceño'),
(199, 63, 'José Félix Ribas'),
(200, 63, 'Páez'),
(201, 64, 'Libertad'),
(202, 64, 'Dolores'),
(203, 64, 'Santa Rosa'),
(204, 64, 'Palacio Fajardo'),
(205, 65, 'Ciudad de Nutrias'),
(206, 65, 'El Regalo'),
(207, 65, 'Puerto Nutrias'),
(208, 65, 'Santa Catalina'),
(209, 66, 'Cachamay'),
(210, 66, 'Chirica'),
(211, 66, 'Dalla Costa'),
(212, 66, 'Once de Abril'),
(213, 66, 'Simón Bolívar'),
(214, 66, 'Unare'),
(215, 66, 'Universidad'),
(216, 66, 'Vista al Sol'),
(217, 66, 'Pozo Verde'),
(218, 66, 'Yocoima'),
(219, 66, '5 de Julio'),
(220, 67, 'Cedeño'),
(221, 67, 'Altagracia'),
(222, 67, 'Ascensión Farreras'),
(223, 67, 'Guaniamo'),
(224, 67, 'La Urbana'),
(225, 67, 'Pijiguaos'),
(226, 68, 'El Callao'),
(227, 69, 'Gran Sabana'),
(228, 69, 'Ikabarú'),
(229, 70, 'Catedral'),
(230, 70, 'Zea'),
(231, 70, 'Orinoco'),
(232, 70, 'José Antonio Páez'),
(233, 70, 'Marhuanta'),
(234, 70, 'Agua Salada'),
(235, 70, 'Vista Hermosa'),
(236, 70, 'La Sabanita'),
(237, 70, 'Panapana'),
(238, 71, 'Andrés Eloy Blanco'),
(239, 71, 'Pedro Cova'),
(240, 72, 'Raúl Leoni'),
(241, 72, 'Barceloneta'),
(242, 72, 'Santa Bárbara'),
(243, 72, 'San Francisco'),
(244, 73, 'Roscio'),
(245, 73, 'Salóm'),
(246, 74, 'Sifontes'),
(247, 74, 'Dalla Costa'),
(248, 74, 'San Isidro'),
(249, 75, 'Sucre'),
(250, 75, 'Aripao'),
(251, 75, 'Guarataro'),
(252, 75, 'Las Majadas'),
(253, 75, 'Moitaco'),
(254, 76, 'Padre Pedro Chien'),
(255, 76, 'Río Grande'),
(256, 77, 'Bejuma'),
(257, 77, 'Canoabo'),
(258, 77, 'Simón Bolívar'),
(259, 78, 'Güigüe'),
(260, 78, 'Carabobo'),
(261, 78, 'Tacarigua'),
(262, 79, 'Mariara'),
(263, 79, 'Aguas Calientes'),
(264, 80, 'Ciudad Alianza'),
(265, 80, 'Guacara'),
(266, 80, 'Yagua'),
(267, 81, 'Morón'),
(268, 81, 'Yagua'),
(269, 82, 'Tocuyito'),
(270, 82, 'Independencia'),
(271, 83, 'Los Guayos'),
(272, 84, 'Miranda'),
(273, 85, 'Montalbán'),
(274, 86, 'Naguanagua'),
(275, 87, 'Bartolomé Salóm'),
(276, 87, 'Democracia'),
(277, 87, 'Fraternidad'),
(278, 87, 'Goaigoaza'),
(279, 87, 'Juan José Flores'),
(280, 87, 'Unión'),
(281, 87, 'Borburata'),
(282, 87, 'Patanemo'),
(283, 88, 'San Diego'),
(284, 89, 'San Joaquín'),
(285, 90, 'Candelaria'),
(286, 90, 'Catedral'),
(287, 90, 'El Socorro'),
(288, 90, 'Miguel Peña'),
(289, 90, 'Rafael Urdaneta'),
(290, 90, 'San Blas'),
(291, 90, 'San José'),
(292, 90, 'Santa Rosa'),
(293, 90, 'Negro Primero'),
(294, 91, 'Cojedes'),
(295, 91, 'Juan de Mata Suárez'),
(296, 92, 'Tinaquillo'),
(297, 93, 'El Baúl'),
(298, 93, 'Sucre'),
(299, 94, 'La Aguadita'),
(300, 94, 'Macapo'),
(301, 95, 'El Pao'),
(302, 96, 'El Amparo'),
(303, 96, 'Libertad de Cojedes'),
(304, 97, 'Rómulo Gallegos'),
(305, 98, 'San Carlos de Austria'),
(306, 98, 'Juan Ángel Bravo'),
(307, 98, 'Manuel Manrique'),
(308, 99, 'General en Jefe José Laurencio Silva'),
(309, 100, 'Curiapo'),
(310, 100, 'Almirante Luis Brión'),
(311, 100, 'Francisco Aniceto Lugo'),
(312, 100, 'Manuel Renaud'),
(313, 100, 'Padre Barral'),
(314, 100, 'Santos de Abelgas'),
(315, 101, 'Imataca'),
(316, 101, 'Cinco de Julio'),
(317, 101, 'Juan Bautista Arismendi'),
(318, 101, 'Manuel Piar'),
(319, 101, 'Rómulo Gallegos'),
(320, 102, 'Pedernales'),
(321, 102, 'Luis Beltrán Prieto Figueroa'),
(322, 103, 'San José (Delta Amacuro)'),
(323, 103, 'José Vidal Marcano'),
(324, 103, 'Juan Millán'),
(325, 103, 'Leonardo Ruíz Pineda'),
(326, 103, 'Mariscal Antonio José de Sucre'),
(327, 103, 'Monseñor Argimiro García'),
(328, 103, 'San Rafael (Delta Amacuro)'),
(329, 103, 'Virgen del Valle'),
(330, 10, 'Clarines'),
(331, 10, 'Guanape'),
(332, 10, 'Sabana de Uchire'),
(333, 104, 'Capadare'),
(334, 104, 'La Pastora'),
(335, 104, 'Libertador'),
(336, 104, 'San Juan de los Cayos'),
(337, 105, 'Aracua'),
(338, 105, 'La Peña'),
(339, 105, 'San Luis'),
(340, 106, 'Bariro'),
(341, 106, 'Borojó'),
(342, 106, 'Capatárida'),
(343, 106, 'Guajiro'),
(344, 106, 'Seque'),
(345, 106, 'Zazárida'),
(346, 106, 'Valle de Eroa'),
(347, 107, 'Cacique Manaure'),
(348, 108, 'Norte'),
(349, 108, 'Carirubana'),
(350, 108, 'Santa Ana'),
(351, 108, 'Urbana Punta Cardón'),
(352, 109, 'La Vela de Coro'),
(353, 109, 'Acurigua'),
(354, 109, 'Guaibacoa'),
(355, 109, 'Las Calderas'),
(356, 109, 'Macoruca'),
(357, 110, 'Dabajuro'),
(358, 111, 'Agua Clara'),
(359, 111, 'Avaria'),
(360, 111, 'Pedregal'),
(361, 111, 'Piedra Grande'),
(362, 111, 'Purureche'),
(363, 112, 'Adaure'),
(364, 112, 'Adícora'),
(365, 112, 'Baraived'),
(366, 112, 'Buena Vista'),
(367, 112, 'Jadacaquiva'),
(368, 112, 'El Vínculo'),
(369, 112, 'El Hato'),
(370, 112, 'Moruy'),
(371, 112, 'Pueblo Nuevo'),
(372, 113, 'Agua Larga'),
(373, 113, 'El Paují'),
(374, 113, 'Independencia'),
(375, 113, 'Mapararí'),
(376, 114, 'Agua Linda'),
(377, 114, 'Araurima'),
(378, 114, 'Jacura'),
(379, 115, 'Tucacas'),
(380, 115, 'Boca de Aroa'),
(381, 116, 'Los Taques'),
(382, 116, 'Judibana'),
(383, 117, 'Mene de Mauroa'),
(384, 117, 'San Félix'),
(385, 117, 'Casigua'),
(386, 118, 'Guzmán Guillermo'),
(387, 118, 'Mitare'),
(388, 118, 'Río Seco'),
(389, 118, 'Sabaneta'),
(390, 118, 'San Antonio'),
(391, 118, 'San Gabriel'),
(392, 118, 'Santa Ana'),
(393, 119, 'Boca del Tocuyo'),
(394, 119, 'Chichiriviche'),
(395, 119, 'Tocuyo de la Costa'),
(396, 120, 'Palmasola'),
(397, 121, 'Cabure'),
(398, 121, 'Colina'),
(399, 121, 'Curimagua'),
(400, 122, 'San José de la Costa'),
(401, 122, 'Píritu'),
(402, 123, 'San Francisco'),
(403, 124, 'Sucre'),
(404, 124, 'Pecaya'),
(405, 125, 'Tocópero'),
(406, 126, 'El Charal'),
(407, 126, 'Las Vegas del Tuy'),
(408, 126, 'Santa Cruz de Bucaral'),
(409, 127, 'Bruzual'),
(410, 127, 'Urumaco'),
(411, 128, 'Puerto Cumarebo'),
(412, 128, 'La Ciénaga'),
(413, 128, 'La Soledad'),
(414, 128, 'Pueblo Cumarebo'),
(415, 128, 'Zazárida'),
(416, 113, 'Churuguara'),
(417, 129, 'Camaguán'),
(418, 129, 'Puerto Miranda'),
(419, 129, 'Uverito'),
(420, 130, 'Chaguaramas'),
(421, 131, 'El Socorro'),
(422, 132, 'Tucupido'),
(423, 132, 'San Rafael de Laya'),
(424, 133, 'Altagracia de Orituco'),
(425, 133, 'San Rafael de Orituco'),
(426, 133, 'San Francisco Javier de Lezama'),
(427, 133, 'Paso Real de Macaira'),
(428, 133, 'Carlos Soublette'),
(429, 133, 'San Francisco de Macaira'),
(430, 133, 'Libertad de Orituco'),
(431, 134, 'Cantaclaro'),
(432, 134, 'San Juan de los Morros'),
(433, 134, 'Parapara'),
(434, 135, 'El Sombrero'),
(435, 135, 'Sosa'),
(436, 136, 'Las Mercedes'),
(437, 136, 'Cabruta'),
(438, 136, 'Santa Rita de Manapire'),
(439, 137, 'Valle de la Pascua'),
(440, 137, 'Espino'),
(441, 138, 'San José de Unare'),
(442, 138, 'Zaraza'),
(443, 139, 'San José de Tiznados'),
(444, 139, 'San Francisco de Tiznados'),
(445, 139, 'San Lorenzo de Tiznados'),
(446, 139, 'Ortiz'),
(447, 140, 'Guayabal'),
(448, 140, 'Cazorla'),
(449, 141, 'San José de Guaribe'),
(450, 141, 'Uveral'),
(451, 142, 'Santa María de Ipire'),
(452, 142, 'Altamira'),
(453, 143, 'El Calvario'),
(454, 143, 'El Rastro'),
(455, 143, 'Guardatinajas'),
(456, 143, 'Capital Urbana Calabozo'),
(457, 144, 'Quebrada Honda de Guache'),
(458, 144, 'Pío Tamayo'),
(459, 144, 'Yacambú'),
(460, 145, 'Fréitez'),
(461, 145, 'José María Blanco'),
(462, 146, 'Catedral'),
(463, 146, 'Concepción'),
(464, 146, 'El Cují'),
(465, 146, 'Juan de Villegas'),
(466, 146, 'Santa Rosa'),
(467, 146, 'Tamaca'),
(468, 146, 'Unión'),
(469, 146, 'Aguedo Felipe Alvarado'),
(470, 146, 'Buena Vista'),
(471, 146, 'Juárez'),
(472, 147, 'Juan Bautista Rodríguez'),
(473, 147, 'Cuara'),
(474, 147, 'Diego de Lozada'),
(475, 147, 'Paraíso de San José'),
(476, 147, 'San Miguel'),
(477, 147, 'Tintorero'),
(478, 147, 'José Bernardo Dorante'),
(479, 147, 'Coronel Mariano Peraza '),
(480, 148, 'Bolívar'),
(481, 148, 'Anzoátegui'),
(482, 148, 'Guarico'),
(483, 148, 'Hilario Luna y Luna'),
(484, 148, 'Humocaro Alto'),
(485, 148, 'Humocaro Bajo'),
(486, 148, 'La Candelaria'),
(487, 148, 'Morán'),
(488, 149, 'Cabudare'),
(489, 149, 'José Gregorio Bastidas'),
(490, 149, 'Agua Viva'),
(491, 150, 'Sarare'),
(492, 150, 'Buría'),
(493, 150, 'Gustavo Vegas León'),
(494, 151, 'Trinidad Samuel'),
(495, 151, 'Antonio Díaz'),
(496, 151, 'Camacaro'),
(497, 151, 'Castañeda'),
(498, 151, 'Cecilio Zubillaga'),
(499, 151, 'Chiquinquirá'),
(500, 151, 'El Blanco'),
(501, 151, 'Espinoza de los Monteros'),
(502, 151, 'Lara'),
(503, 151, 'Las Mercedes'),
(504, 151, 'Manuel Morillo'),
(505, 151, 'Montaña Verde'),
(506, 151, 'Montes de Oca'),
(507, 151, 'Torres'),
(508, 151, 'Heriberto Arroyo'),
(509, 151, 'Reyes Vargas'),
(510, 151, 'Altagracia'),
(511, 152, 'Siquisique'),
(512, 152, 'Moroturo'),
(513, 152, 'San Miguel'),
(514, 152, 'Xaguas'),
(515, 179, 'Presidente Betancourt'),
(516, 179, 'Presidente Páez'),
(517, 179, 'Presidente Rómulo Gallegos'),
(518, 179, 'Gabriel Picón González'),
(519, 179, 'Héctor Amable Mora'),
(520, 179, 'José Nucete Sardi'),
(521, 179, 'Pulido Méndez'),
(522, 180, 'La Azulita'),
(523, 181, 'Santa Cruz de Mora'),
(524, 181, 'Mesa Bolívar'),
(525, 181, 'Mesa de Las Palmas'),
(526, 182, 'Aricagua'),
(527, 182, 'San Antonio'),
(528, 183, 'Canagua'),
(529, 183, 'Capurí'),
(530, 183, 'Chacantá'),
(531, 183, 'El Molino'),
(532, 183, 'Guaimaral'),
(533, 183, 'Mucutuy'),
(534, 183, 'Mucuchachí'),
(535, 184, 'Fernández Peña'),
(536, 184, 'Matriz'),
(537, 184, 'Montalbán'),
(538, 184, 'Acequias'),
(539, 184, 'Jají'),
(540, 184, 'La Mesa'),
(541, 184, 'San José del Sur'),
(542, 185, 'Tucaní'),
(543, 185, 'Florencio Ramírez'),
(544, 186, 'Santo Domingo'),
(545, 186, 'Las Piedras'),
(546, 187, 'Guaraque'),
(547, 187, 'Mesa de Quintero'),
(548, 187, 'Río Negro'),
(549, 188, 'Arapuey'),
(550, 188, 'Palmira'),
(551, 189, 'San Cristóbal de Torondoy'),
(552, 189, 'Torondoy'),
(553, 190, 'Antonio Spinetti Dini'),
(554, 190, 'Arias'),
(555, 190, 'Caracciolo Parra Pérez'),
(556, 190, 'Domingo Peña'),
(557, 190, 'El Llano'),
(558, 190, 'Gonzalo Picón Febres'),
(559, 190, 'Jacinto Plaza'),
(560, 190, 'Juan Rodríguez Suárez'),
(561, 190, 'Lasso de la Vega'),
(562, 190, 'Mariano Picón Salas'),
(563, 190, 'Milla'),
(564, 190, 'Osuna Rodríguez'),
(565, 190, 'Sagrario'),
(566, 190, 'El Morro'),
(567, 190, 'Los Nevados'),
(568, 191, 'Andrés Eloy Blanco'),
(569, 191, 'La Venta'),
(570, 191, 'Piñango'),
(571, 191, 'Timotes'),
(572, 192, 'Eloy Paredes'),
(573, 192, 'San Rafael de Alcázar'),
(574, 192, 'Santa Elena de Arenales'),
(575, 193, 'Santa María de Caparo'),
(576, 194, 'Pueblo Llano'),
(577, 195, 'Cacute'),
(578, 195, 'La Toma'),
(579, 195, 'Mucuchíes'),
(580, 195, 'Mucurubá'),
(581, 195, 'San Rafael'),
(582, 196, 'Gerónimo Maldonado'),
(583, 196, 'Bailadores'),
(584, 197, 'Tabay'),
(585, 198, 'Chiguará'),
(586, 198, 'Estánquez'),
(587, 198, 'Lagunillas'),
(588, 198, 'La Trampa'),
(589, 198, 'Pueblo Nuevo del Sur'),
(590, 198, 'San Juan'),
(591, 199, 'El Amparo'),
(592, 199, 'El Llano'),
(593, 199, 'San Francisco'),
(594, 199, 'Tovar'),
(595, 200, 'Independencia'),
(596, 200, 'María de la Concepción Palacios Blanco'),
(597, 200, 'Nueva Bolivia'),
(598, 200, 'Santa Apolonia'),
(599, 201, 'Caño El Tigre'),
(600, 201, 'Zea'),
(601, 223, 'Aragüita'),
(602, 223, 'Arévalo González'),
(603, 223, 'Capaya'),
(604, 223, 'Caucagua'),
(605, 223, 'Panaquire'),
(606, 223, 'Ribas'),
(607, 223, 'El Café'),
(608, 223, 'Marizapa'),
(609, 224, 'Cumbo'),
(610, 224, 'San José de Barlovento'),
(611, 225, 'El Cafetal'),
(612, 225, 'Las Minas'),
(613, 225, 'Nuestra Señora del Rosario'),
(614, 226, 'Higuerote'),
(615, 226, 'Curiepe'),
(616, 226, 'Tacarigua de Brión'),
(617, 227, 'Mamporal'),
(618, 228, 'Carrizal'),
(619, 229, 'Chacao'),
(620, 230, 'Charallave'),
(621, 230, 'Las Brisas'),
(622, 231, 'El Hatillo'),
(623, 232, 'Altagracia de la Montaña'),
(624, 232, 'Cecilio Acosta'),
(625, 232, 'Los Teques'),
(626, 232, 'El Jarillo'),
(627, 232, 'San Pedro'),
(628, 232, 'Tácata'),
(629, 232, 'Paracotos'),
(630, 233, 'Cartanal'),
(631, 233, 'Santa Teresa del Tuy'),
(632, 234, 'La Democracia'),
(633, 234, 'Ocumare del Tuy'),
(634, 234, 'Santa Bárbara'),
(635, 235, 'San Antonio de los Altos'),
(636, 236, 'Río Chico'),
(637, 236, 'El Guapo'),
(638, 236, 'Tacarigua de la Laguna'),
(639, 236, 'Paparo'),
(640, 236, 'San Fernando del Guapo'),
(641, 237, 'Santa Lucía del Tuy'),
(642, 238, 'Cúpira'),
(643, 238, 'Machurucuto'),
(644, 239, 'Guarenas'),
(645, 240, 'San Antonio de Yare'),
(646, 240, 'San Francisco de Yare'),
(647, 241, 'Leoncio Martínez'),
(648, 241, 'Petare'),
(649, 241, 'Caucagüita'),
(650, 241, 'Filas de Mariche'),
(651, 241, 'La Dolorita'),
(652, 242, 'Cúa'),
(653, 242, 'Nueva Cúa'),
(654, 243, 'Guatire'),
(655, 243, 'Bolívar'),
(656, 258, 'San Antonio de Maturín'),
(657, 258, 'San Francisco de Maturín'),
(658, 259, 'Aguasay'),
(659, 260, 'Caripito'),
(660, 261, 'El Guácharo'),
(661, 261, 'La Guanota'),
(662, 261, 'Sabana de Piedra'),
(663, 261, 'San Agustín'),
(664, 261, 'Teresen'),
(665, 261, 'Caripe'),
(666, 262, 'Areo'),
(667, 262, 'Capital Cedeño'),
(668, 262, 'San Félix de Cantalicio'),
(669, 262, 'Viento Fresco'),
(670, 263, 'El Tejero'),
(671, 263, 'Punta de Mata'),
(672, 264, 'Chaguaramas'),
(673, 264, 'Las Alhuacas'),
(674, 264, 'Tabasca'),
(675, 264, 'Temblador'),
(676, 265, 'Alto de los Godos'),
(677, 265, 'Boquerón'),
(678, 265, 'Las Cocuizas'),
(679, 265, 'La Cruz'),
(680, 265, 'San Simón'),
(681, 265, 'El Corozo'),
(682, 265, 'El Furrial'),
(683, 265, 'Jusepín'),
(684, 265, 'La Pica'),
(685, 265, 'San Vicente'),
(686, 266, 'Aparicio'),
(687, 266, 'Aragua de Maturín'),
(688, 266, 'Chaguamal'),
(689, 266, 'El Pinto'),
(690, 266, 'Guanaguana'),
(691, 266, 'La Toscana'),
(692, 266, 'Taguaya'),
(693, 267, 'Cachipo'),
(694, 267, 'Quiriquire'),
(695, 268, 'Santa Bárbara'),
(696, 269, 'Barrancas'),
(697, 269, 'Los Barrancos de Fajardo'),
(698, 270, 'Uracoa'),
(699, 271, 'Antolín del Campo'),
(700, 272, 'Arismendi'),
(701, 273, 'García'),
(702, 273, 'Francisco Fajardo'),
(703, 274, 'Bolívar'),
(704, 274, 'Guevara'),
(705, 274, 'Matasiete'),
(706, 274, 'Santa Ana'),
(707, 274, 'Sucre'),
(708, 275, 'Aguirre'),
(709, 275, 'Maneiro'),
(710, 276, 'Adrián'),
(711, 276, 'Juan Griego'),
(712, 276, 'Yaguaraparo'),
(713, 277, 'Porlamar'),
(714, 278, 'San Francisco de Macanao'),
(715, 278, 'Boca de Río'),
(716, 279, 'Tubores'),
(717, 279, 'Los Baleales'),
(718, 280, 'Vicente Fuentes'),
(719, 280, 'Villalba'),
(720, 281, 'San Juan Bautista'),
(721, 281, 'Zabala'),
(722, 283, 'Capital Araure'),
(723, 283, 'Río Acarigua'),
(724, 284, 'Capital Esteller'),
(725, 284, 'Uveral'),
(726, 285, 'Guanare'),
(727, 285, 'Córdoba'),
(728, 285, 'San José de la Montaña'),
(729, 285, 'San Juan de Guanaguanare'),
(730, 285, 'Virgen de la Coromoto'),
(731, 286, 'Guanarito'),
(732, 286, 'Trinidad de la Capilla'),
(733, 286, 'Divina Pastora'),
(734, 287, 'Monseñor José Vicente de Unda'),
(735, 287, 'Peña Blanca'),
(736, 288, 'Capital Ospino'),
(737, 288, 'Aparición'),
(738, 288, 'La Estación'),
(739, 289, 'Páez'),
(740, 289, 'Payara'),
(741, 289, 'Pimpinela'),
(742, 289, 'Ramón Peraza'),
(743, 290, 'Papelón'),
(744, 290, 'Caño Delgadito'),
(745, 291, 'San Genaro de Boconoito'),
(746, 291, 'Antolín Tovar'),
(747, 292, 'San Rafael de Onoto'),
(748, 292, 'Santa Fe'),
(749, 292, 'Thermo Morles'),
(750, 293, 'Santa Rosalía'),
(751, 293, 'Florida'),
(752, 294, 'Sucre'),
(753, 294, 'Concepción'),
(754, 294, 'San Rafael de Palo Alzado'),
(755, 294, 'Uvencio Antonio Velásquez'),
(756, 294, 'San José de Saguaz'),
(757, 294, 'Villa Rosa'),
(758, 295, 'Turén'),
(759, 295, 'Canelones'),
(760, 295, 'Santa Cruz'),
(761, 295, 'San Isidro Labrador'),
(762, 296, 'Mariño'),
(763, 296, 'Rómulo Gallegos'),
(764, 297, 'San José de Aerocuar'),
(765, 297, 'Tavera Acosta'),
(766, 298, 'Río Caribe'),
(767, 298, 'Antonio José de Sucre'),
(768, 298, 'El Morro de Puerto Santo'),
(769, 298, 'Puerto Santo'),
(770, 298, 'San Juan de las Galdonas'),
(771, 299, 'El Pilar'),
(772, 299, 'El Rincón'),
(773, 299, 'General Francisco Antonio Váquez'),
(774, 299, 'Guaraúnos'),
(775, 299, 'Tunapuicito'),
(776, 299, 'Unión'),
(777, 300, 'Santa Catalina'),
(778, 300, 'Santa Rosa'),
(779, 300, 'Santa Teresa'),
(780, 300, 'Bolívar'),
(781, 300, 'Maracapana'),
(782, 302, 'Libertad'),
(783, 302, 'El Paujil'),
(784, 302, 'Yaguaraparo'),
(785, 303, 'Cruz Salmerón Acosta'),
(786, 303, 'Chacopata'),
(787, 303, 'Manicuare'),
(788, 304, 'Tunapuy'),
(789, 304, 'Campo Elías'),
(790, 305, 'Irapa'),
(791, 305, 'Campo Claro'),
(792, 305, 'Maraval'),
(793, 305, 'San Antonio de Irapa'),
(794, 305, 'Soro'),
(795, 306, 'Mejía'),
(796, 307, 'Cumanacoa'),
(797, 307, 'Arenas'),
(798, 307, 'Aricagua'),
(799, 307, 'Cogollar'),
(800, 307, 'San Fernando'),
(801, 307, 'San Lorenzo'),
(802, 308, 'Villa Frontado (Muelle de Cariaco)'),
(803, 308, 'Catuaro'),
(804, 308, 'Rendón'),
(805, 308, 'San Cruz'),
(806, 308, 'Santa María'),
(807, 309, 'Altagracia'),
(808, 309, 'Santa Inés'),
(809, 309, 'Valentín Valiente'),
(810, 309, 'Ayacucho'),
(811, 309, 'San Juan'),
(812, 309, 'Raúl Leoni'),
(813, 309, 'Gran Mariscal'),
(814, 310, 'Cristóbal Colón'),
(815, 310, 'Bideau'),
(816, 310, 'Punta de Piedras'),
(817, 310, 'Güiria'),
(818, 341, 'Andrés Bello'),
(819, 342, 'Antonio Rómulo Costa'),
(820, 343, 'Ayacucho'),
(821, 343, 'Rivas Berti'),
(822, 343, 'San Pedro del Río'),
(823, 344, 'Bolívar'),
(824, 344, 'Palotal'),
(825, 344, 'General Juan Vicente Gómez'),
(826, 344, 'Isaías Medina Angarita'),
(827, 345, 'Cárdenas'),
(828, 345, 'Amenodoro Ángel Lamus'),
(829, 345, 'La Florida'),
(830, 346, 'Córdoba'),
(831, 347, 'Fernández Feo'),
(832, 347, 'Alberto Adriani'),
(833, 347, 'Santo Domingo'),
(834, 348, 'Francisco de Miranda'),
(835, 349, 'García de Hevia'),
(836, 349, 'Boca de Grita'),
(837, 349, 'José Antonio Páez'),
(838, 350, 'Guásimos'),
(839, 351, 'Independencia'),
(840, 351, 'Juan Germán Roscio'),
(841, 351, 'Román Cárdenas'),
(842, 352, 'Jáuregui'),
(843, 352, 'Emilio Constantino Guerrero'),
(844, 352, 'Monseñor Miguel Antonio Salas'),
(845, 353, 'José María Vargas'),
(846, 354, 'Junín'),
(847, 354, 'La Petrólea'),
(848, 354, 'Quinimarí'),
(849, 354, 'Bramón'),
(850, 355, 'Libertad'),
(851, 355, 'Cipriano Castro'),
(852, 355, 'Manuel Felipe Rugeles'),
(853, 356, 'Libertador'),
(854, 356, 'Doradas'),
(855, 356, 'Emeterio Ochoa'),
(856, 356, 'San Joaquín de Navay'),
(857, 357, 'Lobatera'),
(858, 357, 'Constitución'),
(859, 358, 'Michelena'),
(860, 359, 'Panamericano'),
(861, 359, 'La Palmita'),
(862, 360, 'Pedro María Ureña'),
(863, 360, 'Nueva Arcadia'),
(864, 361, 'Delicias'),
(865, 361, 'Pecaya'),
(866, 362, 'Samuel Darío Maldonado'),
(867, 362, 'Boconó'),
(868, 362, 'Hernández'),
(869, 363, 'La Concordia'),
(870, 363, 'San Juan Bautista'),
(871, 363, 'Pedro María Morantes'),
(872, 363, 'San Sebastián'),
(873, 363, 'Dr. Francisco Romero Lobo'),
(874, 364, 'Seboruco'),
(875, 365, 'Simón Rodríguez'),
(876, 366, 'Sucre'),
(877, 366, 'Eleazar López Contreras'),
(878, 366, 'San Pablo'),
(879, 367, 'Torbes'),
(880, 368, 'Uribante'),
(881, 368, 'Cárdenas'),
(882, 368, 'Juan Pablo Peñalosa'),
(883, 368, 'Potosí'),
(884, 369, 'San Judas Tadeo'),
(885, 370, 'Araguaney'),
(886, 370, 'El Jaguito'),
(887, 370, 'La Esperanza'),
(888, 370, 'Santa Isabel'),
(889, 371, 'Boconó'),
(890, 371, 'El Carmen'),
(891, 371, 'Mosquey'),
(892, 371, 'Ayacucho'),
(893, 371, 'Burbusay'),
(894, 371, 'General Ribas'),
(895, 371, 'Guaramacal'),
(896, 371, 'Vega de Guaramacal'),
(897, 371, 'Monseñor Jáuregui'),
(898, 371, 'Rafael Rangel'),
(899, 371, 'San Miguel'),
(900, 371, 'San José'),
(901, 372, 'Sabana Grande'),
(902, 372, 'Cheregüé'),
(903, 372, 'Granados'),
(904, 373, 'Arnoldo Gabaldón'),
(905, 373, 'Bolivia'),
(906, 373, 'Carrillo'),
(907, 373, 'Cegarra'),
(908, 373, 'Chejendé'),
(909, 373, 'Manuel Salvador Ulloa'),
(910, 373, 'San José'),
(911, 374, 'Carache'),
(912, 374, 'La Concepción'),
(913, 374, 'Cuicas'),
(914, 374, 'Panamericana'),
(915, 374, 'Santa Cruz'),
(916, 375, 'Escuque'),
(917, 375, 'La Unión'),
(918, 375, 'Santa Rita'),
(919, 375, 'Sabana Libre'),
(920, 376, 'El Socorro'),
(921, 376, 'Los Caprichos'),
(922, 376, 'Antonio José de Sucre'),
(923, 377, 'Campo Elías'),
(924, 377, 'Arnoldo Gabaldón'),
(925, 378, 'Santa Apolonia'),
(926, 378, 'El Progreso'),
(927, 378, 'La Ceiba'),
(928, 378, 'Tres de Febrero'),
(929, 379, 'El Dividive'),
(930, 379, 'Agua Santa'),
(931, 379, 'Agua Caliente'),
(932, 379, 'El Cenizo'),
(933, 379, 'Valerita'),
(934, 380, 'Monte Carmelo'),
(935, 380, 'Buena Vista'),
(936, 380, 'Santa María del Horcón'),
(937, 381, 'Motatán'),
(938, 381, 'El Baño'),
(939, 381, 'Jalisco'),
(940, 382, 'Pampán'),
(941, 382, 'Flor de Patria'),
(942, 382, 'La Paz'),
(943, 382, 'Santa Ana'),
(944, 383, 'Pampanito'),
(945, 383, 'La Concepción'),
(946, 383, 'Pampanito II'),
(947, 384, 'Betijoque'),
(948, 384, 'José Gregorio Hernández'),
(949, 384, 'La Pueblita'),
(950, 384, 'Los Cedros'),
(951, 385, 'Carvajal'),
(952, 385, 'Campo Alegre'),
(953, 385, 'Antonio Nicolás Briceño'),
(954, 385, 'José Leonardo Suárez'),
(955, 386, 'Sabana de Mendoza'),
(956, 386, 'Junín'),
(957, 386, 'Valmore Rodríguez'),
(958, 386, 'El Paraíso'),
(959, 387, 'Andrés Linares'),
(960, 387, 'Chiquinquirá'),
(961, 387, 'Cristóbal Mendoza'),
(962, 387, 'Cruz Carrillo'),
(963, 387, 'Matriz'),
(964, 387, 'Monseñor Carrillo'),
(965, 387, 'Tres Esquinas'),
(966, 388, 'Cabimbú'),
(967, 388, 'Jajó'),
(968, 388, 'La Mesa de Esnujaque'),
(969, 388, 'Santiago'),
(970, 388, 'Tuñame'),
(971, 388, 'La Quebrada'),
(972, 389, 'Juan Ignacio Montilla'),
(973, 389, 'La Beatriz'),
(974, 389, 'La Puerta'),
(975, 389, 'Mendoza del Valle de Momboy'),
(976, 389, 'Mercedes Díaz'),
(977, 389, 'San Luis'),
(978, 390, 'Caraballeda'),
(979, 390, 'Carayaca'),
(980, 390, 'Carlos Soublette'),
(981, 390, 'Caruao Chuspa'),
(982, 390, 'Catia La Mar'),
(983, 390, 'El Junko'),
(984, 390, 'La Guaira'),
(985, 390, 'Macuto'),
(986, 390, 'Maiquetía'),
(987, 390, 'Naiguatá'),
(988, 390, 'Urimare'),
(989, 391, 'Arístides Bastidas'),
(990, 392, 'Bolívar'),
(991, 407, 'Chivacoa'),
(992, 407, 'Campo Elías'),
(993, 408, 'Cocorote'),
(994, 409, 'Independencia'),
(995, 410, 'José Antonio Páez'),
(996, 411, 'La Trinidad'),
(997, 412, 'Manuel Monge'),
(998, 413, 'Salóm'),
(999, 413, 'Temerla'),
(1000, 413, 'Nirgua'),
(1001, 414, 'San Andrés'),
(1002, 414, 'Yaritagua'),
(1003, 415, 'San Javier'),
(1004, 415, 'Albarico'),
(1005, 415, 'San Felipe'),
(1006, 416, 'Sucre'),
(1007, 417, 'Urachiche'),
(1008, 418, 'El Guayabo'),
(1009, 418, 'Farriar'),
(1010, 441, 'Isla de Toas'),
(1011, 441, 'Monagas'),
(1012, 442, 'San Timoteo'),
(1013, 442, 'General Urdaneta'),
(1014, 442, 'Libertador'),
(1015, 442, 'Marcelino Briceño'),
(1016, 442, 'Pueblo Nuevo'),
(1017, 442, 'Manuel Guanipa Matos'),
(1018, 443, 'Ambrosio'),
(1019, 443, 'Carmen Herrera'),
(1020, 443, 'La Rosa'),
(1021, 443, 'Germán Ríos Linares'),
(1022, 443, 'San Benito'),
(1023, 443, 'Rómulo Betancourt'),
(1024, 443, 'Jorge Hernández'),
(1025, 443, 'Punta Gorda'),
(1026, 443, 'Arístides Calvani'),
(1027, 444, 'Encontrados'),
(1028, 444, 'Udón Pérez'),
(1029, 445, 'Moralito'),
(1030, 445, 'San Carlos del Zulia'),
(1031, 445, 'Santa Cruz del Zulia'),
(1032, 445, 'Santa Bárbara'),
(1033, 445, 'Urribarrí'),
(1034, 446, 'Carlos Quevedo'),
(1035, 446, 'Francisco Javier Pulgar'),
(1036, 446, 'Simón Rodríguez'),
(1037, 446, 'Guamo-Gavilanes'),
(1038, 448, 'La Concepción'),
(1039, 448, 'San José'),
(1040, 448, 'Mariano Parra León'),
(1041, 448, 'José Ramón Yépez'),
(1042, 449, 'Jesús María Semprún'),
(1043, 449, 'Barí'),
(1044, 450, 'Concepción'),
(1045, 450, 'Andrés Bello'),
(1046, 450, 'Chiquinquirá'),
(1047, 450, 'El Carmelo'),
(1048, 450, 'Potreritos'),
(1049, 451, 'Libertad'),
(1050, 451, 'Alonso de Ojeda'),
(1051, 451, 'Venezuela'),
(1052, 451, 'Eleazar López Contreras'),
(1053, 451, 'Campo Lara'),
(1054, 452, 'Bartolomé de las Casas'),
(1055, 452, 'Libertad'),
(1056, 452, 'Río Negro'),
(1057, 452, 'San José de Perijá'),
(1058, 453, 'San Rafael'),
(1059, 453, 'La Sierrita'),
(1060, 453, 'Las Parcelas'),
(1061, 453, 'Luis de Vicente'),
(1062, 453, 'Monseñor Marcos Sergio Godoy'),
(1063, 453, 'Ricaurte'),
(1064, 453, 'Tamare'),
(1065, 454, 'Antonio Borjas Romero'),
(1066, 454, 'Bolívar'),
(1067, 454, 'Cacique Mara'),
(1068, 454, 'Carracciolo Parra Pérez'),
(1069, 454, 'Cecilio Acosta'),
(1070, 454, 'Cristo de Aranza'),
(1071, 454, 'Coquivacoa'),
(1072, 454, 'Chiquinquirá'),
(1073, 454, 'Francisco Eugenio Bustamante'),
(1074, 454, 'Idelfonzo Vásquez'),
(1075, 454, 'Juana de Ávila'),
(1076, 454, 'Luis Hurtado Higuera'),
(1077, 454, 'Manuel Dagnino'),
(1078, 454, 'Olegario Villalobos'),
(1079, 454, 'Raúl Leoni'),
(1080, 454, 'Santa Lucía'),
(1081, 454, 'Venancio Pulgar'),
(1082, 454, 'San Isidro'),
(1083, 455, 'Altagracia'),
(1084, 455, 'Faría'),
(1085, 455, 'Ana María Campos'),
(1086, 455, 'San Antonio'),
(1087, 455, 'San José'),
(1088, 456, 'Donaldo García'),
(1089, 456, 'El Rosario'),
(1090, 456, 'Sixto Zambrano'),
(1091, 457, 'San Francisco'),
(1092, 457, 'El Bajo'),
(1093, 457, 'Domitila Flores'),
(1094, 457, 'Francisco Ochoa'),
(1095, 457, 'Los Cortijos'),
(1096, 457, 'Marcial Hernández'),
(1097, 458, 'Santa Rita'),
(1098, 458, 'El Mene'),
(1099, 458, 'Pedro Lucas Urribarrí'),
(1100, 458, 'José Cenobio Urribarrí'),
(1101, 459, 'Rafael Maria Baralt'),
(1102, 459, 'Manuel Manrique'),
(1103, 459, 'Rafael Urdaneta'),
(1104, 460, 'Bobures'),
(1105, 460, 'Gibraltar'),
(1106, 460, 'Heras'),
(1107, 460, 'Monseñor Arturo Álvarez'),
(1108, 460, 'Rómulo Gallegos'),
(1109, 460, 'El Batey'),
(1110, 461, 'Rafael Urdaneta'),
(1111, 461, 'La Victoria'),
(1112, 461, 'Raúl Cuenca'),
(1113, 447, 'Sinamaica'),
(1114, 447, 'Alta Guajira'),
(1115, 447, 'Elías Sánchez Rubio'),
(1116, 447, 'Guajira'),
(1117, 462, 'Altagracia'),
(1118, 462, 'Antímano'),
(1119, 462, 'Caricuao'),
(1120, 462, 'Catedral'),
(1121, 462, 'Coche'),
(1122, 462, 'El Junquito'),
(1123, 462, 'El Paraíso'),
(1124, 462, 'El Recreo'),
(1125, 462, 'El Valle'),
(1126, 462, 'La Candelaria'),
(1127, 462, 'La Pastora'),
(1128, 462, 'La Vega'),
(1129, 462, 'Macarao'),
(1130, 462, 'San Agustín'),
(1131, 462, 'San Bernardino'),
(1132, 462, 'San José'),
(1133, 462, 'San Juan'),
(1134, 462, 'San Pedro'),
(1135, 462, 'Santa Rosalía'),
(1136, 462, 'Santa Teresa'),
(1137, 462, 'Sucre (Catia)'),
(1138, 462, '23 de enero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2020_11_11_131510_add_username_to_users_table', 1),
(6, '2021_04_27_171833_create_posts_table', 1),
(7, '2021_05_05_001414_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 11),
(3, 'App\\Models\\User', 12),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 10),
(5, 'App\\Models\\User', 5),
(5, 'App\\Models\\User', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numcertificados`
--

CREATE TABLE `numcertificados` (
  `id` int(11) NOT NULL,
  `certificados` varchar(45) NOT NULL,
  `prestador_id` int(11) DEFAULT NULL,
  `sede_id` int(11) DEFAULT NULL,
  `Aprobado` enum('0','1') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `numcertificados`
--

INSERT INTO `numcertificados` (`id`, `certificados`, `prestador_id`, `sede_id`, `Aprobado`, `created_at`, `updated_at`) VALUES
(1, 'SC120-1016622017-2', 5, 1, '1', '2023-04-03 13:24:43', '2024-03-06 00:03:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@admin.com', '$2y$10$Nvt0YrjwT729sfYIQ7IGTeRy4Q6nPecaVxb3e2KpZVGbn5EA9j7bi', '2023-08-06 14:35:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'permission_index', 'web', '2023-03-14 15:20:04', '2023-03-14 15:20:04'),
(2, 'permission_create', 'web', '2023-03-14 15:20:04', '2023-03-14 15:20:04'),
(3, 'permission_show', 'web', '2023-03-14 15:20:04', '2023-03-14 15:20:04'),
(4, 'permission_edit', 'web', '2023-03-14 15:20:04', '2023-03-14 15:20:04'),
(5, 'permission_destroy', 'web', '2023-03-14 15:20:04', '2023-03-14 15:20:04'),
(6, 'role_index', 'web', '2023-03-14 15:20:04', '2023-03-14 15:20:04'),
(7, 'role_create', 'web', '2023-03-14 15:20:05', '2023-03-14 15:20:05'),
(8, 'role_show', 'web', '2023-03-14 15:20:05', '2023-03-14 15:20:05'),
(9, 'role_edit', 'web', '2023-03-14 15:20:05', '2023-03-14 15:20:05'),
(10, 'role_destroy', 'web', '2023-03-14 15:20:05', '2023-03-14 15:20:05'),
(11, 'user_index', 'web', '2023-03-14 15:20:05', '2023-03-14 15:20:05'),
(12, 'user_create', 'web', '2023-03-14 15:20:05', '2023-03-14 15:20:05'),
(13, 'user_show', 'web', '2023-03-14 15:20:05', '2023-03-14 15:20:05'),
(14, 'user_edit', 'web', '2023-03-14 15:20:06', '2023-03-14 15:20:06'),
(15, 'user_destroy', 'web', '2023-03-14 15:20:06', '2023-03-14 15:20:06'),
(16, 'post_index', 'web', '2023-03-14 15:20:06', '2023-03-14 15:20:06'),
(17, 'post_create', 'web', '2023-03-14 15:20:06', '2023-03-14 15:20:06'),
(18, 'post_show', 'web', '2023-03-14 15:20:06', '2023-03-14 15:20:06'),
(19, 'post_edit', 'web', '2023-03-14 15:20:06', '2023-03-14 15:20:06'),
(20, 'post_destroy', 'web', '2023-03-14 15:20:07', '2023-03-14 15:20:07'),
(21, 'proyecto_index', 'web', '2023-03-18 06:25:00', '2023-03-18 06:25:00'),
(22, 'proyecto_create', 'web', '2023-03-18 06:25:27', '2023-03-18 06:25:27'),
(23, 'proyecto_show', 'web', '2023-03-18 06:25:38', '2023-03-18 06:25:38'),
(24, 'proyecto_edit', 'web', '2023-03-18 06:25:45', '2023-03-18 06:25:45'),
(25, 'proyecto_delete', 'web', '2023-03-18 06:25:55', '2023-03-18 06:25:55'),
(26, 'Asignarproyect_index', 'web', '2023-03-18 06:29:34', '2023-03-18 06:29:34'),
(27, 'Asignarproyect_create', 'web', '2023-03-18 06:29:43', '2023-03-18 06:29:43'),
(28, 'Asignarproyect_show', 'web', '2023-03-18 06:29:50', '2023-03-18 06:29:50'),
(29, 'Asignarproyect_edit', 'web', '2023-03-18 06:29:58', '2023-03-18 06:29:58'),
(30, 'Asignarproyect_destroy', 'web', '2023-03-18 06:30:31', '2023-03-18 06:30:31'),
(31, 'prestadores_create', 'web', '2023-03-23 23:42:58', '2023-03-23 23:42:58'),
(32, 'prestadores_index', 'web', '2023-03-23 23:43:11', '2023-03-23 23:43:11'),
(33, 'actividades_index', 'web', '2023-03-27 03:57:03', '2023-03-27 03:57:03'),
(34, 'actividades_create', 'web', '2023-03-27 03:57:22', '2023-03-27 03:57:22'),
(35, 'actividades_show', 'web', '2023-03-27 03:57:34', '2023-03-27 03:57:34'),
(36, 'actividades_edit', 'web', '2023-03-27 03:57:46', '2023-03-27 03:57:46'),
(37, 'actividades_destroye', 'web', '2023-03-27 03:58:00', '2023-03-27 03:58:00'),
(38, 'autoridades_index', 'web', '2023-03-27 19:00:32', '2023-04-10 12:52:18'),
(39, 'autoridades_create', 'web', '2023-03-27 19:00:57', '2023-04-10 12:52:34'),
(40, 'autoridades_show', 'web', '2023-03-27 19:01:07', '2023-04-10 12:52:47'),
(41, 'autoridades_edit', 'web', '2023-03-27 19:01:13', '2023-04-10 12:52:57'),
(42, 'autoridades_destroy', 'web', '2023-03-27 19:01:25', '2023-04-10 12:53:08'),
(43, 'asesorcomunita_index', 'web', '2023-03-30 22:26:10', '2023-03-30 22:26:10'),
(44, 'asesorcomunita_create', 'web', '2023-03-30 22:26:10', '2023-03-30 22:26:10'),
(45, 'asesorcomunita_show', 'web', '2023-03-30 22:26:11', '2023-03-30 22:26:11'),
(46, 'asesorcomunita_edit', 'web', '2023-03-30 22:26:11', '2023-03-30 22:26:11'),
(47, 'asesorcomunita_destroy', 'web', '2023-03-30 22:26:11', '2023-03-30 22:26:11'),
(48, 'certificados_index', 'web', '2023-04-10 12:55:50', '2023-04-10 12:55:50'),
(49, 'certificados_create', 'web', '2023-04-10 12:55:50', '2023-04-10 12:55:50'),
(50, 'certificados_show', 'web', '2023-04-10 12:55:50', '2023-04-10 12:55:50'),
(51, 'certificados_edit', 'web', '2023-04-10 12:55:50', '2023-04-10 12:55:50'),
(52, 'certificados_destroy', 'web', '2023-04-10 12:55:50', '2023-04-10 12:55:50'),
(53, 'Periodo_index', 'web', '2023-07-26 08:45:00', '2023-07-26 08:45:00'),
(54, 'Periodo_show', 'web', '2023-07-26 08:45:00', '2023-07-26 08:45:00'),
(55, 'Periodo_edit', 'web', '2023-07-26 08:45:00', '2023-07-26 08:45:00'),
(56, 'Periodo_destroye', 'web', '2023-07-26 08:45:00', '2023-07-26 08:45:00'),
(57, 'Periodo_create', 'web', '2023-07-26 08:45:00', '2023-07-26 08:45:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `phones`
--

CREATE TABLE `phones` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `sc_asesor_id` int(10) UNSIGNED DEFAULT NULL,
  `code_id` tinyint(3) UNSIGNED NOT NULL,
  `number` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `phones`
--

INSERT INTO `phones` (`id`, `user_id`, `sc_asesor_id`, `code_id`, `number`) VALUES
(1, 1, NULL, 2, '1234567'),
(4, 4, NULL, 8, '4785455'),
(8, 8, NULL, 5, '2403477'),
(9, 9, NULL, 5, '2403478'),
(10, 10, NULL, 5, '2403479'),
(11, 11, NULL, 5, '2403496'),
(13, 13, NULL, 5, '0320759'),
(14, 14, NULL, 6, '7564173'),
(15, 15, NULL, 5, '4499692'),
(16, 16, NULL, 6, '3153653'),
(17, 17, NULL, 7, '5250007'),
(18, 18, NULL, 5, '5287965'),
(19, 19, NULL, 5, '0000001'),
(20, NULL, 1, 5, '4564564'),
(22, 21, NULL, 1, '1231231'),
(23, 14, NULL, 1, '8888888'),
(24, NULL, 2, 4, '9515413'),
(26, 15, NULL, 5, '0784859'),
(27, 2, NULL, 5, '0784859'),
(28, 3, NULL, 4, '1234567'),
(29, 4, NULL, 6, '5122966'),
(30, 5, NULL, 1, '123456'),
(31, 6, NULL, 1, '123456'),
(32, 7, NULL, 1, '123456'),
(33, 8, NULL, 2, '5555555'),
(35, NULL, 2, 1, '2547814'),
(36, NULL, 3, 1, '2547814'),
(37, NULL, 4, 5, '8769654'),
(38, NULL, 5, 1, '8769654'),
(39, NULL, 6, 1, '7856867'),
(41, NULL, 2, 4, '8769654'),
(42, NULL, 3, 2, '1114789'),
(43, NULL, 4, 3, '1114787'),
(44, 9, NULL, 1, '8515416'),
(45, 10, NULL, 4, '9515413'),
(46, 11, NULL, 3, '9515413'),
(47, 12, NULL, 1, '8529632'),
(48, 2, NULL, 1, '0258210'),
(49, 3, NULL, 1, '3330333'),
(50, 4, NULL, 4, '9515413'),
(51, 5, NULL, 5, '9515413'),
(52, 6, NULL, 7, '1234568'),
(53, NULL, 5, 1, '8515416'),
(54, 7, NULL, 1, '8515416');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'hola', '2023-03-14 15:27:49', '2023-03-14 15:27:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provinces`
--

CREATE TABLE `provinces` (
  `id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `province` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `provinces`
--

INSERT INTO `provinces` (`id`, `state_id`, `province`) VALUES
(1, 1, 'Alto Orinoco'),
(2, 1, 'Atabapo'),
(3, 1, 'Atures'),
(4, 1, 'Autana'),
(5, 1, 'Manapiare'),
(6, 1, 'Maroa'),
(7, 1, 'Río Negro'),
(8, 2, 'Anaco'),
(9, 2, 'Aragua'),
(10, 2, 'Manuel Ezequiel Bruzual'),
(11, 2, 'Diego Bautista Urbaneja'),
(12, 2, 'Fernando Peñalver'),
(13, 2, 'Francisco Del Carmen Carvajal'),
(14, 2, 'General Sir Arthur McGregor'),
(15, 2, 'Guanta'),
(16, 2, 'Independencia'),
(17, 2, 'José Gregorio Monagas'),
(18, 2, 'Juan Antonio Sotillo'),
(19, 2, 'Juan Manuel Cajigal'),
(20, 2, 'Libertad'),
(21, 2, 'Francisco de Miranda'),
(22, 2, 'Pedro María Freites'),
(23, 2, 'Píritu'),
(24, 2, 'San José de Guanipa'),
(25, 2, 'San Juan de Capistrano'),
(26, 2, 'Santa Ana'),
(27, 2, 'Simón Bolívar'),
(28, 2, 'Simón Rodríguez'),
(29, 3, 'Achaguas'),
(30, 3, 'Biruaca'),
(31, 3, 'Muñóz'),
(32, 3, 'Páez'),
(33, 3, 'Pedro Camejo'),
(34, 3, 'Rómulo Gallegos'),
(35, 3, 'San Fernando'),
(36, 4, 'Atanasio Girardot'),
(37, 4, 'Bolívar'),
(38, 4, 'Camatagua'),
(39, 4, 'Francisco Linares Alcántara'),
(40, 4, 'José Ángel Lamas'),
(41, 4, 'José Félix Ribas'),
(42, 4, 'José Rafael Revenga'),
(43, 4, 'Libertador'),
(44, 4, 'Mario Briceño Iragorry'),
(45, 4, 'Ocumare de la Costa de Oro'),
(46, 4, 'San Casimiro'),
(47, 4, 'San Sebastián'),
(48, 4, 'Santiago Mariño'),
(49, 4, 'Santos Michelena'),
(50, 4, 'Sucre'),
(51, 4, 'Tovar'),
(52, 4, 'Urdaneta'),
(53, 4, 'Zamora'),
(54, 5, 'Alberto Arvelo Torrealba'),
(55, 5, 'Andrés Eloy Blanco'),
(56, 5, 'Antonio José de Sucre'),
(57, 5, 'Arismendi'),
(58, 5, 'Barinas'),
(59, 5, 'Bolívar'),
(60, 5, 'Cruz Paredes'),
(61, 5, 'Ezequiel Zamora'),
(62, 5, 'Obispos'),
(63, 5, 'Pedraza'),
(64, 5, 'Rojas'),
(65, 5, 'Sosa'),
(66, 6, 'Caroní'),
(67, 6, 'Cedeño'),
(68, 6, 'El Callao'),
(69, 6, 'Gran Sabana'),
(70, 6, 'Heres'),
(71, 6, 'Piar'),
(72, 6, 'Angostura (Raúl Leoni)'),
(73, 6, 'Roscio'),
(74, 6, 'Sifontes'),
(75, 6, 'Sucre'),
(76, 6, 'Padre Pedro Chien'),
(77, 7, 'Bejuma'),
(78, 7, 'Carlos Arvelo'),
(79, 7, 'Diego Ibarra'),
(80, 7, 'Guacara'),
(81, 7, 'Juan José Mora'),
(82, 7, 'Libertador'),
(83, 7, 'Los Guayos'),
(84, 7, 'Miranda'),
(85, 7, 'Montalbán'),
(86, 7, 'Naguanagua'),
(87, 7, 'Puerto Cabello'),
(88, 7, 'San Diego'),
(89, 7, 'San Joaquín'),
(90, 7, 'Valencia'),
(91, 8, 'Anzoátegui'),
(92, 8, 'Tinaquillo'),
(93, 8, 'Girardot'),
(94, 8, 'Lima Blanco'),
(95, 8, 'Pao de San Juan Bautista'),
(96, 8, 'Ricaurte'),
(97, 8, 'Rómulo Gallegos'),
(98, 8, 'San Carlos'),
(99, 8, 'Tinaco'),
(100, 9, 'Antonio Díaz'),
(101, 9, 'Casacoima'),
(102, 9, 'Pedernales'),
(103, 9, 'Tucupita'),
(104, 10, 'Acosta'),
(105, 10, 'Bolívar'),
(106, 10, 'Buchivacoa'),
(107, 10, 'Cacique Manaure'),
(108, 10, 'Carirubana'),
(109, 10, 'Colina'),
(110, 10, 'Dabajuro'),
(111, 10, 'Democracia'),
(112, 10, 'Falcón'),
(113, 10, 'Federación'),
(114, 10, 'Jacura'),
(115, 10, 'José Laurencio Silva'),
(116, 10, 'Los Taques'),
(117, 10, 'Mauroa'),
(118, 10, 'Miranda'),
(119, 10, 'Monseñor Iturriza'),
(120, 10, 'Palmasola'),
(121, 10, 'Petit'),
(122, 10, 'Píritu'),
(123, 10, 'San Francisco'),
(124, 10, 'Sucre'),
(125, 10, 'Tocópero'),
(126, 10, 'Unión'),
(127, 10, 'Urumaco'),
(128, 10, 'Zamora'),
(129, 11, 'Camaguán'),
(130, 11, 'Chaguaramas'),
(131, 11, 'El Socorro'),
(132, 11, 'José Félix Ribas'),
(133, 11, 'José Tadeo Monagas'),
(134, 11, 'Juan Germán Roscio'),
(135, 11, 'Julián Mellado'),
(136, 11, 'Las Mercedes'),
(137, 11, 'Leonardo Infante'),
(138, 11, 'Pedro Zaraza'),
(139, 11, 'Ortíz'),
(140, 11, 'San Gerónimo de Guayabal'),
(141, 11, 'San José de Guaribe'),
(142, 11, 'Santa María de Ipire'),
(143, 11, 'Sebastián Francisco de Miranda'),
(144, 12, 'Andrés Eloy Blanco'),
(145, 12, 'Crespo'),
(146, 12, 'Iribarren'),
(147, 12, 'Jiménez'),
(148, 12, 'Morán'),
(149, 12, 'Palavecino'),
(150, 12, 'Simón Planas'),
(151, 12, 'Torres'),
(152, 12, 'Urdaneta'),
(179, 13, 'Alberto Adriani'),
(180, 13, 'Andrés Bello'),
(181, 13, 'Antonio Pinto Salinas'),
(182, 13, 'Aricagua'),
(183, 13, 'Arzobispo Chacón'),
(184, 13, 'Campo Elías'),
(185, 13, 'Caracciolo Parra Olmedo'),
(186, 13, 'Cardenal Quintero'),
(187, 13, 'Guaraque'),
(188, 13, 'Julio César Salas'),
(189, 13, 'Justo Briceño'),
(190, 13, 'Libertador'),
(191, 13, 'Miranda'),
(192, 13, 'Obispo Ramos de Lora'),
(193, 13, 'Padre Noguera'),
(194, 13, 'Pueblo Llano'),
(195, 13, 'Rangel'),
(196, 13, 'Rivas Dávila'),
(197, 13, 'Santos Marquina'),
(198, 13, 'Sucre'),
(199, 13, 'Tovar'),
(200, 13, 'Tulio Febres Cordero'),
(201, 13, 'Zea'),
(223, 14, 'Acevedo'),
(224, 14, 'Andrés Bello'),
(225, 14, 'Baruta'),
(226, 14, 'Brión'),
(227, 14, 'Buroz'),
(228, 14, 'Carrizal'),
(229, 14, 'Chacao'),
(230, 14, 'Cristóbal Rojas'),
(231, 14, 'El Hatillo'),
(232, 14, 'Guaicaipuro'),
(233, 14, 'Independencia'),
(234, 14, 'Lander'),
(235, 14, 'Los Salias'),
(236, 14, 'Páez'),
(237, 14, 'Paz Castillo'),
(238, 14, 'Pedro Gual'),
(239, 14, 'Plaza'),
(240, 14, 'Simón Bolívar'),
(241, 14, 'Sucre'),
(242, 14, 'Urdaneta'),
(243, 14, 'Zamora'),
(258, 15, 'Acosta'),
(259, 15, 'Aguasay'),
(260, 15, 'Bolívar'),
(261, 15, 'Caripe'),
(262, 15, 'Cedeño'),
(263, 15, 'Ezequiel Zamora'),
(264, 15, 'Libertador'),
(265, 15, 'Maturín'),
(266, 15, 'Piar'),
(267, 15, 'Punceres'),
(268, 15, 'Santa Bárbara'),
(269, 15, 'Sotillo'),
(270, 15, 'Uracoa'),
(271, 16, 'Antolín del Campo'),
(272, 16, 'Arismendi'),
(273, 16, 'García'),
(274, 16, 'Gómez'),
(275, 16, 'Maneiro'),
(276, 16, 'Marcano'),
(277, 16, 'Mariño'),
(278, 16, 'Península de Macanao'),
(279, 16, 'Tubores'),
(280, 16, 'Villalba'),
(281, 16, 'Díaz'),
(282, 17, 'Agua Blanca'),
(283, 17, 'Araure'),
(284, 17, 'Esteller'),
(285, 17, 'Guanare'),
(286, 17, 'Guanarito'),
(287, 17, 'Monseñor José Vicente de Unda'),
(288, 17, 'Ospino'),
(289, 17, 'Páez'),
(290, 17, 'Papelón'),
(291, 17, 'San Genaro de Boconoíto'),
(292, 17, 'San Rafael de Onoto'),
(293, 17, 'Santa Rosalía'),
(294, 17, 'Sucre'),
(295, 17, 'Turén'),
(296, 18, 'Andrés Eloy Blanco'),
(297, 18, 'Andrés Mata'),
(298, 18, 'Arismendi'),
(299, 18, 'Benítez'),
(300, 18, 'Bermúdez'),
(301, 18, 'Bolívar'),
(302, 18, 'Cajigal'),
(303, 18, 'Cruz Salmerón Acosta'),
(304, 18, 'Libertador'),
(305, 18, 'Mariño'),
(306, 18, 'Mejía'),
(307, 18, 'Montes'),
(308, 18, 'Ribero'),
(309, 18, 'Sucre'),
(310, 18, 'Valdéz'),
(341, 19, 'Andrés Bello'),
(342, 19, 'Antonio Rómulo Costa'),
(343, 19, 'Ayacucho'),
(344, 19, 'Bolívar'),
(345, 19, 'Cárdenas'),
(346, 19, 'Córdoba'),
(347, 19, 'Fernández Feo'),
(348, 19, 'Francisco de Miranda'),
(349, 19, 'García de Hevia'),
(350, 19, 'Guásimos'),
(351, 19, 'Independencia'),
(352, 19, 'Jáuregui'),
(353, 19, 'José María Vargas'),
(354, 19, 'Junín'),
(355, 19, 'Libertad'),
(356, 19, 'Libertador'),
(357, 19, 'Lobatera'),
(358, 19, 'Michelena'),
(359, 19, 'Panamericano'),
(360, 19, 'Pedro María Ureña'),
(361, 19, 'Rafael Urdaneta'),
(362, 19, 'Samuel Darío Maldonado'),
(363, 19, 'San Cristóbal'),
(364, 19, 'Seboruco'),
(365, 19, 'Simón Rodríguez'),
(366, 19, 'Sucre'),
(367, 19, 'Torbes'),
(368, 19, 'Uribante'),
(369, 19, 'San Judas Tadeo'),
(370, 20, 'Andrés Bello'),
(371, 20, 'Boconó'),
(372, 20, 'Bolívar'),
(373, 20, 'Candelaria'),
(374, 20, 'Carache'),
(375, 20, 'Escuque'),
(376, 20, 'José Felipe Márquez Cañizalez'),
(377, 20, 'Juan Vicente Campos Elías'),
(378, 20, 'La Ceiba'),
(379, 20, 'Miranda'),
(380, 20, 'Monte Carmelo'),
(381, 20, 'Motatán'),
(382, 20, 'Pampán'),
(383, 20, 'Pampanito'),
(384, 20, 'Rafael Rangel'),
(385, 20, 'San Rafael de Carvajal'),
(386, 20, 'Sucre'),
(387, 20, 'Trujillo'),
(388, 20, 'Urdaneta'),
(389, 20, 'Valera'),
(390, 21, 'Vargas'),
(391, 22, 'Arístides Bastidas'),
(392, 22, 'Bolívar'),
(407, 22, 'Bruzual'),
(408, 22, 'Cocorote'),
(409, 22, 'Independencia'),
(410, 22, 'José Antonio Páez'),
(411, 22, 'La Trinidad'),
(412, 22, 'Manuel Monge'),
(413, 22, 'Nirgua'),
(414, 22, 'Peña'),
(415, 22, 'San Felipe'),
(416, 22, 'Sucre'),
(417, 22, 'Urachiche'),
(418, 22, 'José Joaquín Veroes'),
(441, 23, 'Almirante Padilla'),
(442, 23, 'Baralt'),
(443, 23, 'Cabimas'),
(444, 23, 'Catatumbo'),
(445, 23, 'Colón'),
(446, 23, 'Francisco Javier Pulgar'),
(447, 23, 'Páez'),
(448, 23, 'Jesús Enrique Losada'),
(449, 23, 'Jesús María Semprún'),
(450, 23, 'La Cañada de Urdaneta'),
(451, 23, 'Lagunillas'),
(452, 23, 'Machiques de Perijá'),
(453, 23, 'Mara'),
(454, 23, 'Maracaibo'),
(455, 23, 'Miranda'),
(456, 23, 'Rosario de Perijá'),
(457, 23, 'San Francisco'),
(458, 23, 'Santa Rita'),
(459, 23, 'Simón Bolívar'),
(460, 23, 'Sucre'),
(461, 23, 'Valmore Rodríguez'),
(462, 24, 'Libertador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id` int(10) UNSIGNED NOT NULL,
  `sede_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `nombre_proyecto` varchar(300) NOT NULL,
  `linea_accion` varchar(1000) NOT NULL,
  `descripcion` text NOT NULL,
  `especialidad_cod` varchar(5) DEFAULT NULL,
  `autor` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `fundamentacion` text NOT NULL,
  `proposito` text NOT NULL,
  `competencia` text NOT NULL,
  `metodologia` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `sede_id`, `user_id`, `nombre_proyecto`, `linea_accion`, `descripcion`, `especialidad_cod`, `autor`, `fundamentacion`, `proposito`, `competencia`, `metodologia`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 1, 1, 'camarones', 'deborar', 'comer muchos camarones', 'BIO', NULL, 'sfdfsdf', 'sfdsdf', 'sfdsdf', 'sfsdf', '2023-10-04 08:27:38', '2024-03-09 17:10:11', NULL),
(7, 1, 1, 'Educando en valores', 'Estrategias de orientación', 'Proyecto destinado a la concientización y formación de valores y el conocimiento', 'EIN', NULL, 'Trabajo integral', 'Alcanzar el logro de proyectos educativos integrales', 'Educación', 'Análisis de la situación en la comunidad', '2023-10-04 08:29:38', '2023-10-31 19:52:43', NULL),
(8, 1, 1, 'ffffffffff', 'dddddddddddd', 'ffffffff', 'EFI', '8', 'ddddddddddd', 'dddddddd', 'dddddddd', 'ddddddd', '2023-10-04 08:29:38', '2023-10-04 12:01:29', NULL),
(9, 1, 1, 'probando', 'probando', 'probando', 'BIO', NULL, 'probando', 'probandoprobandoprobando', 'probandoprobando', 'probandoprobandoprobando', '2023-10-24 09:12:15', '2023-10-24 09:12:15', NULL),
(10, 1, 1, 'probando', 'probando', 'probando', 'ECO', NULL, 'probando', 'probandoprobandoprobando', 'probandoprobando', 'probandoprobandoprobando', '2023-10-24 09:12:15', '2023-10-24 09:12:15', NULL),
(14, 13, 2, 'chamba juvenilo', 'triunfar', 'trabajar', 'MAT', NULL, 'completar', 'ganar fortaleza', 'ninguna', 'trabajar en equipo', '2024-03-05 01:49:19', '2024-03-05 01:49:19', NULL),
(15, 13, 11, 'prueba 1', 'probandooooo prueba 1', 'probandooooo', 'ECO', NULL, 'prueba 1', 'prueba 1', 'prueba 1', 'prueba 1', '2024-03-05 18:56:24', '2024-03-05 18:56:24', NULL),
(17, 18, 1, 'demolicion 2024', 'limpieza', 'demoleer selva', 'EIN', NULL, 'trabajar', 'demoler todo lo que sea verde', 'ninguna', 'extrategia', '2024-03-09 19:14:16', '2024-03-09 19:14:16', NULL),
(19, NULL, 1, 'editadp', 'frghchfdt', 'dfghdfgdf', NULL, NULL, 'dhdfghrtyt', 'dghfdgtyfdt', 'fyufgjyi', 'dhcft', '2024-03-17 02:14:13', '2024-03-17 02:59:53', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referencias`
--

CREATE TABLE `referencias` (
  `id` int(10) UNSIGNED NOT NULL,
  `proyecto_id` int(10) UNSIGNED NOT NULL,
  `referencia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `referencias`
--

INSERT INTO `referencias` (`id`, `proyecto_id`, `referencia`) VALUES
(9, 6, 'refeeeeee'),
(10, 7, 'Educación en valores integrales'),
(11, 8, 'caaaass'),
(12, 9, 'probando'),
(13, 10, 'probando'),
(14, 11, 'fisica pruebas'),
(15, 12, 'fisica pruebas'),
(16, 13, 'Ultimo'),
(17, 14, 'realizar cambios en los habitantes de la comunidad'),
(18, 15, 'prueba 1'),
(19, 16, 'prueba de vintegrate'),
(20, 17, 'el final es desacer todoo'),
(21, 19, 'yuighjmhu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `special` enum('all-access','no-access') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `description`, `special`) VALUES
(1, 'SuperAdmin', 'web', '2023-03-14 15:20:07', '2023-03-14 15:20:07', '', NULL),
(2, 'Coordinador_Institucional', 'web', '2023-03-14 15:20:07', '2024-03-05 23:40:37', '', NULL),
(3, 'Profesor', 'web', '2023-03-15 09:34:11', '2023-03-15 09:34:11', '', NULL),
(4, 'Coordinador_Nacional', 'web', '2023-04-13 15:08:30', '2023-04-13 15:08:30', NULL, NULL),
(5, 'Informatica_administrador', 'web', '2023-04-13 15:35:15', '2023-04-13 15:35:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(21, 2),
(21, 4),
(22, 1),
(22, 4),
(23, 1),
(23, 2),
(23, 4),
(24, 1),
(24, 4),
(25, 1),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(29, 2),
(30, 1),
(30, 2),
(31, 1),
(31, 3),
(32, 1),
(32, 3),
(33, 1),
(33, 3),
(34, 1),
(34, 3),
(35, 1),
(35, 3),
(36, 1),
(36, 3),
(37, 1),
(38, 1),
(38, 4),
(38, 5),
(39, 1),
(39, 4),
(39, 5),
(40, 1),
(40, 4),
(40, 5),
(41, 1),
(41, 4),
(41, 5),
(42, 1),
(42, 4),
(43, 1),
(43, 3),
(44, 1),
(44, 3),
(45, 1),
(45, 3),
(46, 1),
(46, 3),
(47, 1),
(47, 3),
(48, 1),
(48, 3),
(49, 1),
(49, 3),
(50, 1),
(50, 3),
(51, 1),
(51, 3),
(52, 1),
(53, 1),
(53, 2),
(53, 5),
(54, 1),
(54, 2),
(54, 5),
(55, 1),
(55, 2),
(55, 5),
(56, 1),
(56, 2),
(57, 1),
(57, 2),
(57, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sc_actividades`
--

CREATE TABLE `sc_actividades` (
  `id` int(10) UNSIGNED NOT NULL,
  `sede_id` int(10) UNSIGNED NOT NULL,
  `sc_user_proyecto_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `proyecto_id` int(10) UNSIGNED NOT NULL,
  `sc_periodo_id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `actividad` varchar(300) NOT NULL,
  `detalle` text NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `hrs` decimal(3,1) UNSIGNED NOT NULL,
  `current_hrs` decimal(3,1) DEFAULT NULL,
  `hrs_temp` decimal(3,1) DEFAULT NULL,
  `impacto_gen` varchar(300) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sc_actividades`
--

INSERT INTO `sc_actividades` (`id`, `sede_id`, `sc_user_proyecto_id`, `user_id`, `proyecto_id`, `sc_periodo_id`, `fecha`, `actividad`, `detalle`, `direccion`, `hrs`, `current_hrs`, `hrs_temp`, `impacto_gen`, `created_at`, `updated_at`) VALUES
(1, 1, 8, 8, 8, 1, '2023-10-17', 'sadsd', 'asdad', 'charallave', '4.0', NULL, NULL, 'asda', '2023-10-24 11:50:08', '2023-10-24 11:50:08'),
(2, 1, 8, 8, 8, 1, '2023-10-24', 'nueva', 'dddd', 'charallave', '8.0', NULL, NULL, 'ddddd', '2023-10-24 12:10:25', '2023-10-24 12:10:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sc_asesores`
--

CREATE TABLE `sc_asesores` (
  `id` int(10) UNSIGNED NOT NULL,
  `sede_id` int(10) UNSIGNED NOT NULL,
  `ci` varchar(8) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `primary_lastname` varchar(50) NOT NULL,
  `second_lastname` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `sc_asesores`
--

INSERT INTO `sc_asesores` (`id`, `sede_id`, `ci`, `firstname`, `middlename`, `primary_lastname`, `second_lastname`, `created_at`, `updated_at`) VALUES
(1, 1, '24477557', 'jesus', 'perez', 'urbano', 'zamora', '2023-10-18 08:27:48', '2024-02-17 01:49:44'),
(3, 1, '22500247', 'cata', 'asas', 'asdas', 'safdasf', '2023-10-24 11:26:54', '2023-10-24 11:26:54'),
(4, 1, '9464305', 'isa', 'asas', 'asdas', 'safdasf', '2023-10-24 11:38:17', '2023-10-24 11:38:17'),
(5, 18, '2250024', 'Miguelina', 'hgrtrth', 'urbano', 'zamora', '2024-03-09 20:38:31', '2024-03-09 20:38:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sc_beneficiarios`
--

CREATE TABLE `sc_beneficiarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `sc_actividad_id` int(10) UNSIGNED NOT NULL,
  `num_beneficiarios` int(10) UNSIGNED NOT NULL,
  `genero` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: femenino, 1: masculino'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `sc_beneficiarios`
--

INSERT INTO `sc_beneficiarios` (`id`, `sc_actividad_id`, `num_beneficiarios`, `genero`) VALUES
(1, 1, 11, 2),
(2, 2, 11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sc_comunidades`
--

CREATE TABLE `sc_comunidades` (
  `id` int(10) UNSIGNED NOT NULL,
  `sede_id` int(10) UNSIGNED NOT NULL,
  `sc_user_proyecto_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `asesor_id` int(11) UNSIGNED NOT NULL,
  `proyecto_id` int(10) UNSIGNED NOT NULL,
  `sc_periodo_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `sector` varchar(150) DEFAULT NULL,
  `state` varchar(40) NOT NULL,
  `localidad` varchar(100) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `lugar_prestadores` varchar(50) DEFAULT NULL,
  `direccion_lugar` varchar(80) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `sc_comunidades`
--

INSERT INTO `sc_comunidades` (`id`, `sede_id`, `sc_user_proyecto_id`, `user_id`, `asesor_id`, `proyecto_id`, `sc_periodo_id`, `nombre`, `direccion`, `sector`, `state`, `localidad`, `provincia`, `lugar_prestadores`, `direccion_lugar`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 8, 1, 'charallave', 'chrallave', 'olivos', '13', '551', '189', 'en colombia', 'migue', '2023-10-18 08:27:48', '2024-02-20 01:11:38'),
(3, 1, 8, 8, 3, 8, 1, 'caracas', 'caracas', 'los olicos', '16', '644', '239', 'caracas', 'hola', '2023-10-24 11:26:54', '2023-10-24 11:26:54'),
(4, 1, 8, 8, 4, 8, 1, 'caracas', 'caracas', 'los olicos', '16', '700', '272', 'caracas', 'c sxzsx', '2023-10-24 11:38:17', '2023-10-24 11:38:17'),
(5, 18, 3, 3, 5, 17, 4, 'fdgdfg', 'dfgdgfdf', 'gfdgdfgdfg', '14', '643', '238', 'sdfsdfsdf', 'sdfsdfsdfsdf', '2024-03-09 20:38:32', '2024-03-09 20:38:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sc_grupos`
--

CREATE TABLE `sc_grupos` (
  `id` int(10) UNSIGNED NOT NULL,
  `sede_id` int(10) UNSIGNED NOT NULL,
  `sc_user_proyecto_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `proyecto_id` int(10) UNSIGNED NOT NULL,
  `sc_periodo_id` int(10) UNSIGNED NOT NULL,
  `sc_prestadores_id` int(10) UNSIGNED NOT NULL,
  `grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `sc_grupos`
--

INSERT INTO `sc_grupos` (`id`, `sede_id`, `sc_user_proyecto_id`, `user_id`, `proyecto_id`, `sc_periodo_id`, `sc_prestadores_id`, `grupo`) VALUES
(1, 1, 8, 8, 1, 1, 0, 12),
(2, 1, 8, 8, 1, 1, 0, 1),
(3, 1, 8, 8, 1, 1, 0, 2),
(4, 1, 8, 4, 7, 1, 0, 21),
(5, 1, 8, 8, 8, 1, 0, 11),
(6, 1, 4, 4, 7, 1, 9, 8),
(7, 1, 4, 4, 7, 1, 11, 9),
(8, 1, 4, 4, 7, 1, 15, 29),
(9, 1, 4, 4, 7, 1, 18, 31),
(10, 1, 4, 4, 7, 1, 19, 27),
(11, 19, 11, 11, 8, 4, 4, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sc_periodos`
--

CREATE TABLE `sc_periodos` (
  `id` int(10) UNSIGNED NOT NULL,
  `sede_id` int(10) NOT NULL,
  `corte` varchar(10) NOT NULL,
  `inicio` date NOT NULL,
  `fin` date NOT NULL,
  `estatus` varchar(45) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `sc_periodos`
--

INSERT INTO `sc_periodos` (`id`, `sede_id`, `corte`, `inicio`, `fin`, `estatus`, `user_id`) VALUES
(4, 18, '2024-I', '2024-03-05', '2024-03-26', 'Activo', 10),
(6, 3, '2024-II', '2024-03-12', '2024-03-19', 'Activo', 6),
(7, 13, '2023-II', '2024-03-09', '2024-03-20', 'Activo', 1),
(8, 13, '2017-II', '2024-04-15', '2024-04-24', 'Activo', 1),
(9, 3, '2020-U', '2024-04-17', '2024-04-18', 'Activo', 1),
(10, 18, '2023-I', '2024-04-17', '2024-04-18', 'Activo', 1),
(17, 18, '2020-U', '2024-04-13', '2024-04-25', 'Activo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sc_prestadores`
--

CREATE TABLE `sc_prestadores` (
  `id` int(10) UNSIGNED NOT NULL,
  `sede_id` int(11) NOT NULL,
  `sc_user_proyecto_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `proyecto_id` int(10) UNSIGNED NOT NULL,
  `sc_periodo_id` int(10) UNSIGNED NOT NULL,
  `grupo_id` int(10) DEFAULT NULL,
  `ci` varchar(8) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `primary_lastname` varchar(50) NOT NULL,
  `second_lastname` varchar(50) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `especialidad_cod` varchar(5) NOT NULL,
  `hrs_comunitarias` decimal(3,0) NOT NULL DEFAULT 0,
  `inasistencias` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `sc_prestadores`
--

INSERT INTO `sc_prestadores` (`id`, `sede_id`, `sc_user_proyecto_id`, `user_id`, `proyecto_id`, `sc_periodo_id`, `grupo_id`, `ci`, `firstname`, `middlename`, `primary_lastname`, `second_lastname`, `password`, `remember_token`, `especialidad_cod`, `hrs_comunitarias`, `inasistencias`) VALUES
(1, 1, 8, 8, 3, 1, 1, '11702924', 'RUTH', 'ESTHER', 'FLORES', 'RODRIGUEZ', '$2y$10$R317cAlacUwLiB0Z5MuhAeN0GqzYTvk0APiorvTMobd58iZ8SpdcO', NULL, 'EDA', '0', 0),
(2, 1, 8, 8, 5, 1, 2, '12958901', 'Ramón', 'Alberto', 'Roa', 'Yaspe', '$2y$10$EXwscHwcKcsEKfJqiNEcbe.8C.sle47zhx8AKrejWGE1/BkePOp5O', NULL, 'QUI', '0', 0),
(3, 1, 8, 8, 4, 1, 3, '10529717', 'Manuel', NULL, 'Perez', 'Quintero', '$2y$10$BqAIa.R4SuXC.YIZUzK6BuG/NSFjf/UtBTnXsMI8uhX2/M.86TwjG', NULL, 'BIO', '0', 0),
(4, 1, 4, 4, 7, 1, 4, '21108230', 'Felix', 'Alberto', 'Rosales', 'Reyes', '$2y$10$zSP.pg2ubP1S.hEaViJxeOVThqPamjOJItNZ2NLEcZmHGCNRfLaZ6', NULL, 'CTI', '0', 0),
(5, 1, 4, 4, 8, 1, 4, '22350364', 'Aismar', 'Aime', 'Teran', 'jimenez', '$2y$10$3cXsGps7wj17M0FRqD0Nxui30JSyNjhMVr8/xZ0Jv6pCc3qXtb.9i', NULL, 'CTI', '0', 0),
(6, 1, 8, 8, 9, 1, 5, '19478752', 'Fernando', 'Sebastian', 'Jimenez', 'Rojas', '$2y$10$hJXY2w6Nv29Nu01ARds7m.c.8eoU0T0hksRwCfWC5uPJP0xI4x4z.', NULL, 'BIO', '0', 0),
(7, 1, 4, 4, 7, 1, NULL, '20684387', 'Gabriela', 'Gigley', 'Mnetado', 'Vegas', '$2y$10$Uklj4G4g.nGpqkOdfBOYI.bnvYqEYA5bMC8hAWd/.Nb7mGFdIsOC.', NULL, 'CTI', '0', 0),
(8, 1, 4, 4, 7, 1, NULL, '23108144', 'monica', 'carolina', 'colina', 'guzman', '$2y$10$tJMz44vOCI2CpuEguDBhkufupr7A4UBVh5tvqsRNNmiXSURmhQve6', NULL, 'CTI', '0', 0),
(9, 1, 4, 4, 7, 1, NULL, '25329087', 'Loammi', 'Sarai', 'Suarez', 'Solorzano', '$2y$10$Dfga4RcIYLUHI5UYsweWW.tJ.58ANC/jJ00QAVuNY/09A4Q34g5ue', NULL, 'CTI', '0', 7),
(10, 1, 4, 4, 7, 1, NULL, '25625442', 'Kimberlym', 'Rossana', 'León', 'Hebert', '$2y$10$u17FzBfVTr5QWyGeMbO/re8J0iY8AJFXzr1vQfWf0fhr6HmCeBVQ.', NULL, 'CTI', '0', 7),
(11, 1, 4, 4, 7, 1, NULL, '25947799', 'yonaiker', 'rafael', 'liendo', 'colina', '$2y$10$fOlHqFxg6WMauKHAK0juZ.IVxgr4NYQAjhzqofWgnTiqOMmxZfH1m', NULL, 'CTI', '0', 7),
(12, 1, 4, 4, 7, 1, NULL, '26010209', 'Josue', 'Daniel', 'Milano', 'Cañizales', '$2y$10$qXzSA60xST/jjnVfG6USC.LZWwg82mqtfmOHu8cEaWQkU9CuD56yO', NULL, 'CTI', '0', 7),
(13, 1, 4, 4, 7, 1, NULL, '27020878', 'Daniella', 'Valentina', 'Morales', 'Lozano', '$2y$10$a5l20E3pvFzsk61ZXV4za.WwPaVNlzGg9w2gMLx.swC9Amn3GD/l2', NULL, 'CTI', '0', 7),
(14, 1, 4, 4, 7, 1, NULL, '27163489', 'wenddy', 'mayerlin', 'romero', 'mendoza', '$2y$10$FqZem6jkMmZonWYJcFRcoe8Gp80vQaCfZcmVxuBtMSS/T1vLRESue', NULL, 'CTI', '0', 7),
(15, 1, 4, 4, 7, 1, NULL, '27344272', 'Ramses', 'Samir', 'Mendoza', 'Ortega', '$2y$10$8IryAoc.CMkzLa8LPFNP9u9G3oCvr7T2dE1/d3ghzP89eSf0hJjom', NULL, 'CTI', '0', 7),
(16, 1, 4, 4, 7, 1, NULL, '27344996', 'romina', 'madeley', 'leiva', 'rodriguez', '$2y$10$L4bNYu8dl3k7Q.wuaTHIR.1YZ6ksAQvFuYENBVbQItBiMYAMH83hq', NULL, 'CTI', '0', 7),
(17, 1, 4, 4, 7, 1, NULL, '27376695', 'Leslie', 'Elizabeth', 'Solís', 'Martinez', '$2y$10$onyB4FZpCSLDd3M0g2ZsmuHYUdt5uWCdCzGqYeFf.fOV/7teYTADe', NULL, 'CTI', '0', 7),
(18, 1, 4, 4, 7, 1, NULL, '27498965', 'Arjhelys', 'Del Valle', 'Bolivar', 'Garcia', '$2y$10$2JsAXNk2hhRA64HkHsfHXemNgjrVOD80rdT.L4pfKQS3CUcGcWVke', NULL, 'CTI', '0', 7),
(19, 1, 4, 4, 7, 1, NULL, '27515117', 'Sharay', 'Daniela', 'Montenegro', 'Montiel', '$2y$10$XJD2e7OCv1t369wvFkYnOuR.au0ikI9JERstgIL0OloZWMWU/0yqC', NULL, 'CTI', '0', 7),
(21, 1, 1, 1, 8, 1, 28, '20413161', 'Paola', 'Josselyn', 'Pérez', 'Vieira', '$2y$10$uJh8hpPLqnf0s2NkFUtnD.h7zzftNLWJg04Pms7nkasGldmaBfWT6', NULL, 'EFI', '72', 0),
(22, 19, 11, 11, 15, 4, 11, '6392910', 'domingo', 'alfredo', 'alvarez', NULL, '$2y$10$5bOfchcOJBRx5nf2/unFzusjXylZTM0HZw.3G5ATJpFTpN5Lzx492', NULL, 'ECO', '72', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sc_prestador_sc_actividad`
--

CREATE TABLE `sc_prestador_sc_actividad` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sc_prestador_id` int(10) UNSIGNED NOT NULL,
  `sc_actividad_id` int(10) UNSIGNED NOT NULL,
  `grupo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `sc_prestador_sc_actividad`
--

INSERT INTO `sc_prestador_sc_actividad` (`id`, `sc_prestador_id`, `sc_actividad_id`, `grupo_id`) VALUES
(1, 5, 1, 4),
(2, 5, 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sc_recursos`
--

CREATE TABLE `sc_recursos` (
  `id` int(10) UNSIGNED NOT NULL,
  `sc_actividad_id` int(10) UNSIGNED NOT NULL,
  `recurso` varchar(255) NOT NULL,
  `tipo` tinyint(3) UNSIGNED NOT NULL COMMENT '(0: humano, 1: pedagogico, 2: financiero)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sc_recursos`
--

INSERT INTO `sc_recursos` (`id`, `sc_actividad_id`, `recurso`, `tipo`) VALUES
(1, 1, 'asdas', 0),
(2, 2, 'sdsds', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sc_user_proyecto`
--

CREATE TABLE `sc_user_proyecto` (
  `id` int(10) UNSIGNED NOT NULL,
  `sede_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `proyecto_id` int(10) UNSIGNED NOT NULL,
  `periodo_id` int(10) UNSIGNED NOT NULL,
  `total_hours` decimal(3,0) NOT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1: activo, 0: finalizado, 2: actividades especiales',
  `finalized_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_asignador_id` int(11) DEFAULT NULL,
  `especialidad_cod` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `sc_user_proyecto`
--

INSERT INTO `sc_user_proyecto` (`id`, `sede_id`, `user_id`, `proyecto_id`, `periodo_id`, `total_hours`, `status`, `finalized_at`, `created_at`, `updated_at`, `user_asignador_id`, `especialidad_cod`) VALUES
(4, 1, 1, 8, 1, '120', 1, '2023-09-20 13:42:00', '2023-09-28 11:42:48', '2023-09-28 11:42:48', 4, NULL),
(5, 1, 8, 9, 1, '120', 1, '2023-09-20 13:42:00', '2023-09-28 11:42:48', '2023-09-28 11:42:48', 4, NULL),
(6, 1, 8, 6, 1, '120', 1, '2024-02-14 20:02:00', '2023-09-28 11:42:48', '2024-02-15 00:02:38', 1, NULL),
(7, 1, 8, 13, 1, '120', 1, '2024-02-14 20:02:00', '2023-10-10 09:04:49', '2024-02-15 00:02:56', 1, NULL),
(8, 1, 8, 8, 1, '120', 0, '2024-03-12 21:36:00', '2024-03-05 01:36:49', '2024-03-05 01:36:49', 1, NULL),
(9, 19, 11, 8, 4, '120', 0, '2024-03-13 14:50:00', '2024-03-05 18:50:56', '2024-03-05 18:50:56', 10, NULL),
(10, 13, 6, 17, 6, '120', 0, '2024-03-27 15:50:00', '2024-03-09 19:50:10', '2024-03-09 19:50:10', 2, NULL),
(11, 18, 3, 17, 4, '120', 0, '2024-03-15 16:32:00', '2024-03-09 20:32:45', '2024-03-09 20:32:45', 2, NULL),
(13, 18, 7, 19, 4, '120', 0, '2024-03-27 23:27:00', '2024-03-17 03:27:33', '2024-03-17 03:27:33', 2, 'LLI'),
(14, 18, 3, 6, 10, '120', 0, '2024-04-16 21:44:00', '2024-04-16 01:44:09', '2024-04-16 01:44:09', 2, 'CTI'),
(15, 18, 3, 7, 10, '120', 0, '2024-04-16 21:44:00', '2024-04-16 01:44:09', '2024-04-16 01:44:09', 2, 'CTI'),
(16, 18, 3, 8, 10, '120', 0, '2024-04-16 21:44:00', '2024-04-16 01:44:09', '2024-04-16 01:44:09', 2, 'CTI'),
(17, 18, 7, 7, 4, '120', 0, '2024-04-17 21:55:00', '2024-04-16 01:55:54', '2024-04-16 01:55:54', 2, 'BIO'),
(18, 18, 7, 7, 4, '120', 0, '2024-04-17 21:55:00', '2024-04-16 01:55:54', '2024-04-16 01:55:54', 2, 'CTI'),
(19, 18, 7, 7, 4, '120', 0, '2024-04-17 21:55:00', '2024-04-16 01:55:54', '2024-04-16 01:55:54', 2, 'ECO'),
(20, 18, 3, 7, 17, '120', 0, '2024-04-23 22:04:00', '2024-04-16 02:04:04', '2024-04-16 02:04:04', 2, 'EDA'),
(21, 18, 3, 7, 17, '120', 0, '2024-04-23 22:04:00', '2024-04-16 02:04:04', '2024-04-16 02:04:04', 2, 'EFI'),
(22, 18, 3, 8, 17, '120', 0, '2024-04-23 22:04:00', '2024-04-16 02:04:04', '2024-04-16 02:04:04', 2, 'EDA'),
(23, 18, 3, 8, 17, '120', 0, '2024-04-23 22:04:00', '2024-04-16 02:04:04', '2024-04-16 02:04:04', 2, 'EFI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE `sede` (
  `id_sede` int(11) NOT NULL,
  `CodSede` int(11) NOT NULL,
  `NombSede` varchar(100) NOT NULL,
  `VigenActua` varchar(2) NOT NULL,
  `sige_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`id_sede`, `CodSede`, `NombSede`, `VigenActua`, `sige_id`) VALUES
(1, 100, 'Instituto Pedagógico de Caracas', '', 1),
(3, 200, 'Instituto Pedagógico de Barquisimeto \"Luis Beltrán Prieto Figueroa\"', '', 1),
(13, 300, 'Instituto Pedagógico de Maracay \"Rafael Alberto Escobar Lara\"', '', 1),
(16, 400, 'Instituto Pedagógico de Maturín \"Antonio Lira Alcalá\"', '', 1),
(18, 500, 'Instituto Pedagógico de Miranda \"José Manuel Siso Martínez\" Sede Urbina', '', 1),
(22, 600, 'Instituto de Mejoramiento Profesional del Magisterio', '', 1),
(78, 700, 'Instituto Pedagógico Rural \"Gervasio Rubio\" Sede Rubio', '', 1),
(81, 800, 'Instituto Pedagógico Rural El Mácaro \"Luis Fermin\" Sede Aragua', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `id` int(10) UNSIGNED NOT NULL,
  `cod_sede` int(4) UNSIGNED ZEROFILL NOT NULL,
  `nombsede` varchar(80) DEFAULT NULL,
  `nomcorto` varchar(50) DEFAULT NULL,
  `activo` varchar(1) DEFAULT NULL,
  `tipo` varchar(5) DEFAULT NULL,
  `ciudad` varchar(40) NOT NULL,
  `principalsede` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`id`, `cod_sede`, `nombsede`, `nomcorto`, `activo`, `tipo`, `ciudad`, `principalsede`) VALUES
(2, 0100, 'Instituto Pedagógico de Caracas', 'Sede: Barquisimeto', '1', 'SEDE', 'Caracas', 'Instituto Pedagógico de Caracas'),
(3, 0200, 'Instituto Pedagógico de Barquisimeto', 'Sede: Maracay', '1', 'SEDE', 'Barquisimeto', 'Instituto Pedagógico de Barquisimeto'),
(4, 0300, 'Instituto Pedagógico de Maracay', 'Sede: Maturín', '1', 'SEDE', 'Maracay', 'Instituto Pedagógico de Maracay'),
(5, 0400, 'Instituto Pedagógico de Maturín Antonio Lira Alcalá', 'Extensión Capayacuar', '1', 'EXT', 'Maturín', 'Instituto Pedagógico de Maturín Antonio Lira Alcalá'),
(6, 0401, 'IPM San Antonio de Capayacuar', 'Sede: La Urbina', '1', 'EXT', 'Maturín', 'Instituto Pedagógico de Maturín Antonio Lira Alcalá'),
(7, 0500, 'Instituto Pedagógico de Miranda José Manuel Siso Martínez ', 'Extensíon Valles del Tuy', '1', 'SEDE', 'La Urbina', 'Instituto Pedagógico de Miranda José Manuel Siso Martínez'),
(8, 0501, 'Instituto Pedagógico de Miranda José Manuel Siso Martínez. Valles del Tuy', 'Extensíon Rio Chico', '1', 'EXT', 'La Urbina', 'Instituto Pedagógico de Miranda José Manuel Siso Martínez'),
(9, 0502, 'Instituto Pedagógico de Miranda José Manuel Siso Martínez Rio chico', 'Conv. Profesionalización', '1', 'EXT', 'La Urbina', 'Instituto Pedagógico de Miranda José Manuel Siso Martínez'),
(10, 0503, 'Instituto Pedagógico de Miranda José Manuel Siso Martínez Prof.', '', '1', 'EXT', 'La Urbina', 'Instituto Pedagógico de Miranda José Manuel Siso Martínez'),
(11, 0600, 'Instituto de Mejoramiento Profesional del Magisterio', '', '1', 'SEDE', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(12, 0601, 'IMPM Amazonas', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(13, 0602, 'IMPM Amazonas - Puerto Ayacucho', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(14, 0604, 'IMPM Amazonas - San Fernando de Atabapo', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(15, 0605, 'IMPM Anzoátegui', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(16, 0606, 'IMPM Anzoátegui - Barcelona', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(17, 0608, 'IMPM Anzoátegui - Anaco', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(18, 0610, 'IMPM Anzoátegui - El Tigre', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(19, 0611, 'IMPM Apure', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(20, 0612, 'IMPM Apure - San Fernando de Apure', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(21, 0614, 'IMPM Apure - Achaguas', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(22, 0616, 'IMPM Apure - Bruzual', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(23, 0618, 'IMPM Apure - Elorza', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(24, 0620, 'IMPM Apure - Guasdualito', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(25, 0622, 'IMPM Apure - El Nula', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(26, 0624, 'IMPM Apure - Mantecal', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(27, 0625, 'IMPM Barinas', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(28, 0627, 'IMPM Bolivar', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(29, 0628, 'IMPM Bolivar - Ciudad Bolívar', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(30, 0630, 'IMPM Bolivar - Piar', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(31, 0632, 'IMPM Bolivar - Caroní', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(32, 0633, 'IMPM Carabobo', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(33, 0635, 'IMPM Cojedes - San Carlos', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(34, 0637, 'IMPM Falcón', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(35, 0638, 'IMPM Falcón - Coro', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(36, 0640, 'IMPM Falcón - Puerto Cumarebo', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(37, 0642, 'IMPM Falcón - Santa Cruz de Bucaral', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(38, 0643, 'IMPM Paraguaná', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(39, 0645, 'IMPM Mérida', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(40, 0646, 'IMPM Mérida - Mérida', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(41, 0648, 'IMPM Mérida - El Vigía', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(42, 0650, 'IMPM Mérida - El Candil', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(43, 0651, 'IMPM Miranda', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(44, 0652, 'IMPM Miranda - Los Teques', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(45, 0654, 'IMPM Miranda - Ocumare del Tuy', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(46, 0656, 'IMPM Vargas - La Guaira', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(47, 0658, 'IMPM Miranda - Carayaca', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(48, 0659, 'IMPM Miranda Centro Atención Caracas', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(49, 0661, 'IMPM Higuerote', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(50, 0663, 'IMPM Nueva Esparta - La Asunción', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(51, 0665, 'IMPM Portuguesa', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(52, 0666, 'IMPM Portuguesa - Guanare', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(53, 0668, 'IMPM Portuguesa - Biscucuy', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(54, 0683, 'IMPM Boconó', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(55, 0669, 'IMPM Acarigua', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(56, 0671, 'IMPM Sucre - Cumana', 'Cumana------------------', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(57, 0507, 'IPMJMSM CUMANA---------------------------------------------------', 'Convenio CEDEA', '0', 'EXT', 'La Urbina', 'Instituto Pedagógico de Miranda José Manuel Siso Martínez'),
(58, 0508, 'Instituto Pedagógico de Miranda José Manuel Siso Martínez  CEDEA', '', '1', 'EXT', 'La Urbina', 'Instituto Pedagógico de Miranda José Manuel Siso Martínez'),
(59, 0673, 'IMPM Carúpano', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(60, 0675, 'IMPM Táchira - San Cristobal', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(61, 0677, 'IMPM Tucupita', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(62, 0678, 'IMPM Tucupita - Tucupita', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(63, 0680, 'IMPM Tucupita - Piacoa', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(64, 0681, 'IMPM Trujillo - Valera', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(65, 0685, 'IMPM Yaracuy - San Felipe', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(66, 0687, 'IMPM Zulia', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(67, 0688, 'IMPM Zulia - Maracaibo', '', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(68, 0690, 'IMPM Zulia - Machiques', 'Sede: Rubio', '0', 'EXT', '', 'Instituto de Mejoramiento Profesional del Magisterio'),
(69, 0700, 'Instituto Pedagógico Rural \"Gervasio Rubio\"', 'Extensión: Encontrados', '1', 'SEDE', 'Rubio', 'Instituto Pedagógico Rural \"Gervasio Rubio\"'),
(70, 0701, 'Instituto Pedagógico Rural \"Gervasio Rubio\"  Encontrados', 'Extensión: Sabana Mendoza', '1', 'EXT', 'Rubio', 'Instituto Pedagógico Rural \"Gervasio Rubio\"'),
(71, 0702, 'Instituto Pedagógico Rural \"Gervasio Rubio\"  Sabana Mendoza', 'Sede: Aragua', '1', 'EXT', 'Rubio', 'Instituto Pedagógico Rural \"Gervasio Rubio\"'),
(72, 0800, 'Instituto Pedagógico Rural \"El Macaro\" Sede  Aragua', '', '1', 'SEDE', '', 'Instituto Pedagógico Rural \"El Macaro\" Sede  Aragua'),
(73, 0801, 'IPRM Amazonas', '', '0', 'EXT', '', 'Instituto Pedagógico Rural \"El Macaro\" Sede  Aragua'),
(74, 0802, 'IPRM Apure', '', '0', 'EXT', '', 'Instituto Pedagógico Rural \"El Macaro\" Sede  Aragua'),
(75, 0803, 'IPRM Bolivar', '', '0', 'EXT', '', 'Instituto Pedagógico Rural \"El Macaro\" Sede  Aragua'),
(76, 0804, 'IPRM Falcon - Yaracal', '', '0', 'EXT', '', 'Instituto Pedagógico Rural \"El Macaro\" Sede  Aragua'),
(77, 0806, 'IPRM Zulia', '', '0', 'EXT', '', 'Instituto Pedagógico Rural \"El Macaro\" Sede  Aragua'),
(78, 0814, 'IPRM Falcon - Dabajuro', '', '0', 'EXT', '', 'Instituto Pedagógico Rural \"El Macaro\" Sede  Aragua'),
(79, 0815, 'IPRM Guarico - San Juan de los Morros', '', '0', 'EXT', '', 'Instituto Pedagógico Rural \"El Macaro\" Sede  Aragua'),
(80, 0824, 'IPRM Falcon - Pueblo Nuevo de la Sierra', '', '0', 'EXT', '', 'Instituto Pedagógico Rural \"El Macaro\" Sede  Aragua'),
(81, 0825, 'IPRM Guarico - Valle de la Pascua', '', '0', 'EXT', '', 'Instituto Pedagógico Rural \"El Macaro\" Sede  Aragua'),
(82, 0835, 'IPRM Guarico - Altagracia de Orituco', 'Convenio  I.U.T.TOMAS LANDER', '0', 'EXT', '', 'Instituto Pedagógico Rural \"El Macaro\" Sede  Aragua'),
(83, 0504, 'Instituto Pedagógico de Miranda José Manuel Siso Martínez IUTTOL', 'Convenio  ESCUELA DE COMUNICACION', '1', 'Conve', 'La Urbina', 'Instituto Pedagógico de Miranda José Manuel Siso Martínez'),
(84, 0505, 'Instituto Pedagógico de Miranda José Manuel Siso Martínez ECOEFA', 'Convenio I.U.T. ELIAS CALIXTO ', '1', 'EXT', 'La Urbina', 'Instituto Pedagógico de Miranda José Manuel Siso Martínez'),
(85, 0506, 'Instituto Pedagógico de Miranda José Manuel Siso Martínez  IUTEC', 'Convenio Maracay (Valencia)', '1', 'EXT', 'La Urbina', 'Instituto Pedagógico de Miranda José Manuel Siso Martínez'),
(86, 0301, 'Instituto Pedagógico de Maracay (Valencia)', 'Convenio Maracay(IUTAR-CAGUA)', '1', 'EXT', 'Valencia', 'Instituto Pedagógico de Maracay'),
(87, 0302, 'Instituto Pedagógico de Maracay (Convenio IUTAR-CAGUA)', 'Convenio Maracay(IUTAR) ', '1', 'EXT', 'Maracay', 'Instituto Pedagógico de Maracay'),
(88, 0303, 'Instituto Pedagógico de Maracay (Convenio IUTAR)', 'Convenio Maracay (Bejuma)', '1', 'EXT', 'Maracay', 'Instituto Pedagógico de Maracay'),
(89, 0304, 'Instituto Pedagógico de Maracay (Bejuma)', 'Convenio Maracay (CUAM)', '1', 'EXT', 'Maracay', 'Instituto Pedagógico de Maracay'),
(90, 0305, 'Instituto Pedagógico de Maracay (CUAM)', 'IPB - El Tocuyo', '1', 'EXT', 'Maracay', 'Instituto Pedagógico de Maracay'),
(91, 0202, 'IPB - El Tocuyo', 'IPB - Sanare', '0', 'EXT', 'Barquisimeto', 'Instituto Pedagógico de Barquisimeto'),
(92, 0204, 'IPB - Sanare', 'IPB - Duaca', '0', 'EXT', 'Barquisimeto', 'Instituto Pedagógico de Barquisimeto'),
(93, 0206, 'IPB - Duaca', 'IPB - Santa Ines', '0', 'EXT', 'Barquisimeto', 'Instituto Pedagógico de Barquisimeto'),
(94, 0208, 'IPB - Santa Ines', 'IPB - Urachiche', '0', 'EXT', 'Barquisimeto', 'Instituto Pedagógico de Barquisimeto'),
(95, 0210, 'IPB - Urachiche', 'IPB - Carora', '0', 'EXT', 'Barquisimeto', 'Instituto Pedagógico de Barquisimeto'),
(96, 0212, 'IPB - Carora', 'IPB - Coro', '0', 'EXT', 'Barquisimeto', 'Instituto Pedagógico de Barquisimeto'),
(97, 0214, 'IPB - Coro', 'Convenio Maracay (Puerto Cabello)', '0', 'EXT', 'Barquisimeto', 'Instituto Pedagógico de Barquisimeto'),
(98, 0306, 'Instituto Pedagógico de Maracay (Puerto Cabello)', 'Maturin Profesionalizacion', '1', 'EXT', 'Maracay', 'Instituto Pedagógico de Maracay'),
(99, 0402, 'IPM-Profesionalización Maturin', 'Extensión Margarita', '1', 'EXT', 'Maturín', 'Instituto Pedagógico de Maturín Antonio Lira Alcalá'),
(100, 0403, 'IPM Margarita', 'Extensión Bolivar', '1', 'EXT', 'Margarita', 'Instituto Pedagógico de Maturín Antonio Lira Alcalá'),
(101, 0404, 'IPM Bolivar', 'Estensión Tucupita', '1', 'EXT', 'Bolivar', 'Instituto Pedagógico de Maturín Antonio Lira Alcalá'),
(102, 0405, 'IPM Tucupita', 'Maracay Profesionalizacion', '1', 'EXT', 'Tucupita', 'Instituto Pedagógico de Maturín Antonio Lira Alcalá'),
(103, 0307, 'IPMAR-Profesionalización Maracay', 'Profesionalización Caracas', '1', 'EXT', 'Maracay', 'Instituto Pedagógico de Maracay Profesionalización'),
(104, 0101, 'IPC-Profesionalización', 'Extensión  Barcelona', '1', 'EXT', 'Caracas', 'Instituto Pedagógico de Caracas'),
(105, 0406, 'IPM Barcelona', '', '1', 'EXT', 'Barcelona', 'Instituto Pedagógico de Maturín Antonio Lira Alcalá');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `state` varchar(250) NOT NULL,
  `iso_3166-2` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `states`
--

INSERT INTO `states` (`id`, `state`, `iso_3166-2`) VALUES
(1, 'Amazonas', 'VE-X'),
(2, 'Anzoátegui', 'VE-B'),
(3, 'Apure', 'VE-C'),
(4, 'Aragua', 'VE-D'),
(5, 'Barinas', 'VE-E'),
(6, 'Bolívar', 'VE-F'),
(7, 'Carabobo', 'VE-G'),
(8, 'Cojedes', 'VE-H'),
(9, 'Delta Amacuro', 'VE-Y'),
(10, 'Falcón', 'VE-I'),
(11, 'Guárico', 'VE-J'),
(12, 'Lara', 'VE-K'),
(13, 'Mérida', 'VE-L'),
(14, 'Miranda', 'VE-M'),
(15, 'Monagas', 'VE-N'),
(16, 'Nueva Esparta', 'VE-O'),
(17, 'Portuguesa', 'VE-P'),
(18, 'Sucre', 'VE-R'),
(19, 'Táchira', 'VE-S'),
(20, 'Trujillo', 'VE-T'),
(21, 'Vargas', 'VE-W'),
(22, 'Yaracuy', 'VE-U'),
(23, 'Zulia', 'VE-V'),
(24, 'Distrito Capital', 'VE-A'),
(25, 'Dependencias Federales', 'VE-Z');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`id`, `nombre`) VALUES
(1, 'Secretaria(o) del Instituto'),
(2, 'Jefa(e) de Control de Estudios'),
(3, 'Coordinadora(or) Inst. Servicio Comunitario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sede_id` int(10) UNSIGNED NOT NULL,
  `role_id` tinyint(3) UNSIGNED NOT NULL,
  `ci` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `primary_lastname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `second_lastname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `gender` tinyint(3) UNSIGNED NOT NULL COMMENT '0: woman, 1: man',
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `locality` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `province` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `state` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date_birth` date DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `especialidad_cod` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 activo, 1 pending, 2 suspended',
  `parent` tinyint(3) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `suspender` tinyint(1) DEFAULT 0,
  `instituto_id_creador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `sede_id`, `role_id`, `ci`, `firstname`, `middlename`, `primary_lastname`, `second_lastname`, `gender`, `address`, `locality`, `province`, `state`, `date_birth`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`, `username`, `especialidad_cod`, `status`, `parent`, `deleted_at`, `suspender`, `instituto_id_creador`) VALUES
(1, 5, 1, '24477561', 'Rafael', 'admin', 'perez', 'Urbano', 1, 'china', '', '', '', '1978-09-16', 'admin@admin.com', NULL, '$2y$10$oUsFKez/ZXK5ii6iLIoJ1etijOTNuU82q3fZeZSWd4aut5sRACHfq', NULL, NULL, NULL, '2023-03-14 15:20:10', '2023-03-14 15:20:10', 'admin', 'INF', 0, NULL, NULL, 0, NULL),
(2, 18, 2, '22202202', 'Coordinador Intitucional', 'cordinador', 'cordi', 'prueba', 0, 'caraas', '645', '240', '14', '2000-06-17', 'cordinador_intitucional@gmail.com', NULL, '$2y$10$GZLeFN5e2jmP4wf2iy3wAOaaMlIZex1zMnO6.Bfl2.OJqJpeR53om', NULL, NULL, NULL, '2024-03-05 19:50:29', '2024-03-05 19:50:29', NULL, NULL, 0, 0, NULL, 1, NULL),
(3, 18, 3, '33303303', 'Isaias', 'profesor', 'Tovar', 'profe', 0, 'caracas', '749', '292', '17', '1995-06-17', 'profesor@gmail.com', NULL, '$2y$10$H64Unj7NbbLu0NSWauU8HONlLoc99D96iBw/CfgDDqbQo9UTowNY6', NULL, NULL, NULL, '2024-03-05 19:53:18', '2024-03-05 19:53:18', NULL, NULL, 0, 0, NULL, 1, 18),
(4, 14, 4, '44404404', 'migue coordinador Nacional', 'cordinador Nacional', 'Tovar', 'prueba', 0, 'caracas', '712', '276', '16', '1995-02-07', 'cordinadornacional@gmail.com', NULL, '$2y$10$Y9.Bj6TeCGseM9.tXjr9qum.2WNk.pOMHnR0OZwdvyEi7RrkjAIBi', NULL, NULL, NULL, '2024-03-05 20:05:11', '2024-03-05 20:05:11', NULL, NULL, 0, 0, NULL, 1, NULL),
(5, 15, 5, '55505505', 'administrador Informatico', 'prueba 2', 'info', 'profe', 0, 'cARAcas', '750', '293', '17', '1993-02-05', 'administradorinformatico@gmail.com', NULL, '$2y$10$syUDSUAeCjLM/L/4tj.iOOUUSf/9xowBgLlLIWLguogI8GPhuJ.8W', NULL, NULL, NULL, '2024-03-05 20:13:14', '2024-03-05 20:13:14', NULL, NULL, 0, 0, NULL, 1, NULL),
(6, 14, 3, '22500561', 'guancho', 'roi', 'segundo', 'tercero', 1, 'charallave', '620', '230', '14', '1997-07-09', 'profeguancho@gmail.com', NULL, '$2y$10$AAwHskRQ9Z7ndzjAHs5WLeIKE66QZNZKhA2Vx1xLRYCPxOdhDs6A.', NULL, NULL, NULL, '2024-03-09 19:48:36', '2024-03-09 19:48:36', NULL, NULL, 0, 0, NULL, 1, 13),
(7, 19, 3, '8756534', 'Miguelina', 'migue', 'urbano', 'zamora', 0, 'charallave', '746', '291', '17', '2024-03-24', 'profesor2@gmail.com', NULL, '$2y$10$Fi6zhcr7Q2W/LF5ml9lo4OmMpxDKCzkHczwJN4yB7gwzEQHihJS4K', NULL, NULL, NULL, '2024-03-17 03:11:35', '2024-03-17 03:11:35', NULL, NULL, 0, 0, NULL, 1, 18);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `authorities`
--
ALTER TABLE `authorities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sede_id` (`sede_id`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entity` (`entity`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`cod`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `institutos`
--
ALTER TABLE `institutos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sede_id` (`sede_id`);

--
-- Indices de la tabla `localities`
--
ALTER TABLE `localities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_province_locality1_idx` (`province_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `numcertificados`
--
ALTER TABLE `numcertificados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code_id` (`code_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `phones_sc_asesor_id_index` (`sc_asesor_id`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_locality_states1_idx` (`state_id`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proyectos_especialidad_index` (`especialidad_cod`),
  ADD KEY `sede_id` (`sede_id`);

--
-- Indices de la tabla `referencias`
--
ALTER TABLE `referencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referencias_proyectos_proyecto_id_foreign` (`proyecto_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sc_actividades`
--
ALTER TABLE `sc_actividades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sc_actividades_sc_user_proyecto_id_index` (`sc_periodo_id`),
  ADD KEY `sede_id` (`sede_id`);

--
-- Indices de la tabla `sc_asesores`
--
ALTER TABLE `sc_asesores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sede_id` (`sede_id`);

--
-- Indices de la tabla `sc_beneficiarios`
--
ALTER TABLE `sc_beneficiarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sc_beneficiarios_sc_actividad_id_index` (`sc_actividad_id`);

--
-- Indices de la tabla `sc_comunidades`
--
ALTER TABLE `sc_comunidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sc_comunidades_sc_user_proyecto_id_index` (`user_id`),
  ADD KEY `sede_id` (`sede_id`);

--
-- Indices de la tabla `sc_grupos`
--
ALTER TABLE `sc_grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sc_grupos_user_id_index` (`user_id`),
  ADD KEY `sc_grupos_sc_user_proyecto_id_index` (`proyecto_id`),
  ADD KEY `sede_id` (`sede_id`);

--
-- Indices de la tabla `sc_periodos`
--
ALTER TABLE `sc_periodos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sede_id` (`sede_id`);

--
-- Indices de la tabla `sc_prestadores`
--
ALTER TABLE `sc_prestadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sc_prestadores_ci_unique` (`ci`),
  ADD KEY `sc_prestadores_sc_user_proyecto_id_index` (`proyecto_id`),
  ADD KEY `sc_prestadores_grupo_id_index` (`grupo_id`),
  ADD KEY `sc_prestadores_institutos` (`sede_id`);

--
-- Indices de la tabla `sc_prestador_sc_actividad`
--
ALTER TABLE `sc_prestador_sc_actividad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sc_prestador_prestador_actividad_sc_prestador_id_index` (`sc_prestador_id`),
  ADD KEY `sc_prestador_prestador_actividad_sc_actividad_id_index` (`sc_actividad_id`);

--
-- Indices de la tabla `sc_recursos`
--
ALTER TABLE `sc_recursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sc_recursos_sc_actividad_id_index` (`sc_actividad_id`);

--
-- Indices de la tabla `sc_user_proyecto`
--
ALTER TABLE `sc_user_proyecto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_proyecto_user_id_foreign` (`user_id`),
  ADD KEY `user_proyecto_proyecto_id_foreign` (`proyecto_id`),
  ADD KEY `user_proyecto_periodo_id_foreign` (`periodo_id`),
  ADD KEY `sede_id` (`sede_id`);

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`id_sede`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `authorities`
--
ALTER TABLE `authorities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `codes`
--
ALTER TABLE `codes`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `institutos`
--
ALTER TABLE `institutos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `localities`
--
ALTER TABLE `localities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1139;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `numcertificados`
--
ALTER TABLE `numcertificados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `phones`
--
ALTER TABLE `phones`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=463;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `referencias`
--
ALTER TABLE `referencias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sc_actividades`
--
ALTER TABLE `sc_actividades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sc_asesores`
--
ALTER TABLE `sc_asesores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sc_beneficiarios`
--
ALTER TABLE `sc_beneficiarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sc_comunidades`
--
ALTER TABLE `sc_comunidades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sc_grupos`
--
ALTER TABLE `sc_grupos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `sc_periodos`
--
ALTER TABLE `sc_periodos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `sc_prestadores`
--
ALTER TABLE `sc_prestadores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `sc_prestador_sc_actividad`
--
ALTER TABLE `sc_prestador_sc_actividad`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sc_recursos`
--
ALTER TABLE `sc_recursos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sc_user_proyecto`
--
ALTER TABLE `sc_user_proyecto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `sede`
--
ALTER TABLE `sede`
  MODIFY `id_sede` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de la tabla `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
