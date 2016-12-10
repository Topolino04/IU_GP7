SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `IU2016`
--

--
-- Creación de la base de datos que usará el programa y creación del usuario que la usará.
--

DROP DATABASE IF EXISTS `IU2016`;
CREATE DATABASE IF NOT EXISTS `IU2016` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `IU2016`;


GRANT ALL PRIVILEGES ON `IU2016`.* TO 'iu2016'@'localhost' IDENTIFIED BY 'iu2016';

-- --------------------------------------------------------

--
-- Table structure for table `HORARIO`
--
CREATE TABLE IF NOT EXISTS `HORARIO` (
`BLOQUE_ID` int(3) NOT NULL,
  `BLOQUE_FECHA` date NOT NULL,
  `BLOQUE_DIA` int(1) NOT NULL,
  `BLOQUE_HORAI` time NOT NULL,
  `BLOQUE_HORAF` time NOT NULL,
  `BLOQUE_LUGAR` int(100) NOT NULL,
  `BLOQUE_ACT1` int(100) DEFAULT NULL,
  `BLOQUE_ACT2` int(100) DEFAULT NULL,
  `BLOQUE_ACT3` int(100) DEFAULT NULL,
  `BLOQUE_EV1` int(100) DEFAULT NULL,
  `BLOQUE_EV2` int(100) DEFAULT NULL,
  `BLOQUE_EV3` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE `HORARIO`
 ADD PRIMARY KEY (`BLOQUE_ID`);

INSERT INTO `HORARIO` (`BLOQUE_ID`, `BLOQUE_FECHA`, `BLOQUE_DIA`, `BLOQUE_HORAI`, `BLOQUE_HORAF`, `BLOQUE_LUGAR`, `BLOQUE_ACT1`, `BLOQUE_ACT2`, `BLOQUE_ACT3`, `BLOQUE_EV1`, `BLOQUE_EV2`, `BLOQUE_EV3`) VALUES
(1, '2016-11-28', 1, '02:00:00', '03:00:00', 1, 2, 1, 0, 0, 0, 0),
(2, '2016-11-28', 1, '03:00:00', '04:00:00', 2, 2, 1, 0, 0, 0, 0),
(3, '2016-11-28', 1, '08:00:00', '09:00:00', 1, 2, 0, 0, 0, 0, 0),
(4, '2016-11-29', 2, '04:00:00', '05:00:00', 3, 3, 0, 0, 1, 0, 0),
(5, '2016-11-29', 2, '05:00:00', '05:30:00', 2, 3, 0, 0, 0, 0, 0),
(6, '2016-11-29', 2, '05:30:00', '07:00:00', 1, 2, 0, 0, 0, 0, 0),
(7, '2016-11-30', 3, '09:00:00', '09:30:00', 3, 4, 1, 0, 0, 0, 0),
(8, '2016-11-30', 3, '09:30:00', '10:00:00', 2, 4, 0, 0, 0, 0, 0),
(9, '2016-11-30', 3, '10:00:00', '11:00:00', 2, 4, 2, 0, 0, 0, 0),
(10, '2016-12-01', 4, '11:00:00', '12:00:00', 2, 0, 0, 0, 2, 0, 0),
(11, '2016-12-01', 4, '12:00:00', '13:00:00', 2, 3, 0, 0, 1, 0, 0),
(12, '2016-12-01', 4, '13:00:00', '13:30:00', 2, 1, 0, 0, 0, 0, 0),
(13, '2016-12-02', 5, '04:00:00', '07:00:00', 3, 0, 0, 0, 1, 0, 0),
(14, '2016-12-02', 5, '07:00:00', '07:30:00', 3, 0, 0, 0, 1, 0, 0),
(15, '2016-12-02', 5, '15:00:00', '16:00:00', 2, 0, 0, 0, 1, 0, 0),
(16, '2016-12-03', 6, '00:00:00', '01:00:00', 1, 2, 0, 0, 0, 0, 0),
(17, '2016-12-03', 6, '00:00:00', '01:00:00', 1, 2, 0, 0, 0, 0, 0),
(18, '2016-12-05', 1, '10:00:00', '13:00:00', 2, 3, 0, 0, 0, 0, 0),
(19, '2016-12-05', 1, '14:00:00', '15:00:00', 3, 3, 0, 0, 0, 0, 0),
(20, '2016-12-05', 1, '16:00:00', '17:00:00', 2, 1, 0, 0, 2, 0, 0),
(21, '2016-12-06', 2, '10:00:00', '11:00:00', 1, 1, 0, 0, 0, 0, 0),
(22, '2016-12-06', 2, '11:00:00', '12:00:00', 1, 1, 0, 0, 0, 0, 0),
(23, '2016-12-06', 2, '12:00:00', '13:00:00', 2, 2, 0, 0, 0, 0, 0),
(24, '2016-12-07', 3, '09:00:00', '09:30:00', 3, 4, 1, 0, 0, 0, 0),
(25, '2016-12-07', 3, '09:30:00', '10:00:00', 2, 4, 0, 0, 0, 0, 0),
(26, '2016-12-07', 3, '10:00:00', '11:00:00', 2, 4, 2, 0, 0, 0, 0),
(27, '2016-12-08', 4, '11:00:00', '12:00:00', 2, 0, 0, 0, 2, 0, 0),
(28, '2016-12-08', 4, '12:00:00', '13:00:00', 2, 3, 0, 0, 1, 0, 0),
(29, '2016-12-08', 4, '13:00:00', '13:30:00', 2, 1, 0, 0, 0, 0, 0),
(30, '2016-12-09', 5, '04:00:00', '07:00:00', 3, 0, 0, 0, 1, 0, 0),
(31, '2016-12-09', 5, '07:00:00', '07:30:00', 3, 0, 0, 0, 1, 0, 0),
(32, '2016-12-09', 5, '15:00:00', '16:00:00', 2, 0, 0, 0, 1, 0, 0),
(33, '2016-12-10', 6, '00:00:00', '01:00:00', 1, 2, 0, 0, 0, 0, 0),
(34, '2016-12-10', 6, '00:00:00', '01:00:00', 1, 2, 0, 0, 0, 0, 0),
(35, '2016-12-12', 1, '10:00:00', '13:00:00', 2, 3, 0, 0, 0, 0, 0),
(36, '2016-12-12', 1, '14:00:00', '15:00:00', 3, 3, 0, 0, 0, 0, 0),
(37, '2016-12-12', 1, '16:00:00', '17:00:00', 2, 1, 0, 0, 2, 0, 0),
(38, '2016-12-13', 2, '10:00:00', '11:00:00', 1, 1, 0, 0, 0, 0, 0),
(39, '2016-12-13', 2, '11:00:00', '12:00:00', 1, 1, 0, 0, 0, 0, 0),
(40, '2016-12-13', 2, '12:00:00', '13:00:00', 2, 2, 0, 0, 0, 0, 0),
(41, '2016-12-14', 3, '09:00:00', '09:30:00', 3, 4, 1, 0, 0, 0, 0),
(42, '2016-12-14', 3, '09:30:00', '10:00:00', 2, 4, 0, 0, 0, 0, 0),
(43, '2016-12-14', 3, '10:00:00', '11:00:00', 2, 4, 2, 0, 0, 0, 0),
(44, '2016-12-15', 4, '11:00:00', '12:00:00', 2, 0, 0, 0, 2, 0, 0),
(45, '2016-12-15', 4, '12:00:00', '13:00:00', 2, 3, 0, 0, 1, 0, 0),
(46, '2016-12-15', 4, '13:00:00', '13:30:00', 2, 1, 0, 0, 0, 0, 0),
(47, '2016-12-16', 5, '04:00:00', '07:00:00', 3, 0, 0, 0, 1, 0, 0),
(48, '2016-12-16', 5, '07:00:00', '07:30:00', 3, 0, 0, 0, 1, 0, 0),
(49, '2016-12-16', 5, '15:00:00', '16:00:00', 2, 0, 0, 0, 1, 0, 0),
(50, '2016-12-17', 6, '00:00:00', '01:00:00', 1, 2, 0, 0, 0, 0, 0),
(51, '2016-12-17', 6, '00:00:00', '01:00:00', 1, 2, 0, 0, 0, 0, 0),
(52, '2016-12-19', 1, '10:00:00', '13:00:00', 2, 3, 0, 0, 0, 0, 0),
(53, '2016-12-19', 1, '14:00:00', '15:00:00', 3, 3, 0, 0, 0, 0, 0),
(54, '2016-12-19', 1, '16:00:00', '17:00:00', 2, 1, 0, 0, 2, 0, 0),
(55, '2016-12-20', 2, '10:00:00', '11:00:00', 1, 1, 0, 0, 0, 0, 0),
(56, '2016-12-20', 2, '11:00:00', '12:00:00', 1, 1, 0, 0, 0, 0, 0),
(57, '2016-12-20', 2, '12:00:00', '13:00:00', 2, 2, 0, 0, 0, 0, 0),
(58, '2016-12-21', 3, '09:00:00', '09:30:00', 3, 4, 1, 0, 0, 0, 0),
(59, '2016-12-21', 3, '09:30:00', '10:00:00', 2, 4, 0, 0, 0, 0, 0),
(60, '2016-12-21', 3, '10:00:00', '11:00:00', 2, 4, 2, 0, 0, 0, 0),
(61, '2016-12-22', 4, '11:00:00', '12:00:00', 2, 0, 0, 0, 2, 0, 0),
(62, '2016-12-22', 4, '12:00:00', '13:00:00', 2, 3, 0, 0, 1, 0, 0),
(63, '2016-12-22', 4, '13:00:00', '13:30:00', 2, 1, 0, 0, 0, 0, 0),
(64, '2016-12-23', 5, '04:00:00', '07:00:00', 3, 0, 0, 0, 1, 0, 0),
(65, '2016-12-23', 5, '07:00:00', '07:30:00', 3, 0, 0, 0, 1, 0, 0),
(66, '2016-12-23', 5, '15:00:00', '16:00:00', 2, 0, 0, 0, 1, 0, 0),
(67, '2016-12-24', 6, '00:00:00', '01:00:00', 1, 2, 0, 0, 0, 0, 0),
(68, '2016-12-24', 6, '00:00:00', '01:00:00', 1, 2, 0, 0, 0, 0, 0),
(69, '2016-12-26', 1, '10:00:00', '13:00:00', 2, 3, 0, 0, 0, 0, 0),
(70, '2016-12-26', 1, '14:00:00', '15:00:00', 3, 3, 0, 0, 0, 0, 0),
(71, '2016-12-26', 1, '16:00:00', '17:00:00', 2, 1, 0, 0, 2, 0, 0),
(72, '2016-12-27', 2, '10:00:00', '11:00:00', 1, 1, 0, 0, 0, 0, 0),
(73, '2016-12-27', 2, '11:00:00', '12:00:00', 1, 1, 0, 0, 0, 0, 0),
(74, '2016-12-27', 2, '12:00:00', '13:00:00', 2, 2, 0, 0, 0, 0, 0),
(75, '2016-12-28', 3, '09:00:00', '09:30:00', 3, 4, 1, 0, 0, 0, 0),
(76, '2016-12-28', 3, '09:30:00', '10:00:00', 2, 4, 0, 0, 0, 0, 0),
(77, '2016-12-28', 3, '10:00:00', '11:00:00', 2, 4, 2, 0, 0, 0, 0),
(78, '2016-12-29', 4, '11:00:00', '12:00:00', 2, 0, 0, 0, 2, 0, 0),
(79, '2016-12-29', 4, '12:00:00', '13:00:00', 2, 3, 0, 0, 1, 0, 0),
(80, '2016-12-29', 4, '13:00:00', '13:30:00', 2, 1, 0, 0, 0, 0, 0),
(81, '2016-12-30', 5, '04:00:00', '07:00:00', 3, 0, 0, 0, 1, 0, 0),
(82, '2016-12-30', 5, '07:00:00', '07:30:00', 3, 0, 0, 0, 1, 0, 0),
(83, '2016-12-30', 5, '15:00:00', '16:00:00', 2, 0, 0, 0, 1, 0, 0),
(84, '2016-12-31', 6, '00:00:00', '01:00:00', 1, 2, 0, 0, 0, 0, 0),
(85, '2016-12-31', 6, '00:00:00', '01:00:00', 1, 2, 0, 0, 0, 0, 0);


ALTER TABLE `HORARIO`
MODIFY `BLOQUE_ID` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=86;
-- --------------------------------------------------------

--
-- Table structure for table `ACTIVIDAD`
--

CREATE TABLE IF NOT EXISTS `ACTIVIDAD` (
`ACTIVIDAD_ID` int(100) NOT NULL,
  `ACTIVIDAD_NOMBRE` varchar(50) NOT NULL,
  `ACTIVIDAD_PRECIO` decimal(10,2) NOT NULL,
  `ACTIVIDAD_DESCRIPCION` varchar(200) DEFAULT NULL,
  `CATEGORIA_ID` int(100) NOT NULL,
  `ACTIVO` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ACTIVIDAD`
--

INSERT INTO `ACTIVIDAD` (`ACTIVIDAD_ID`, `ACTIVIDAD_NOMBRE`, `ACTIVIDAD_PRECIO`, `ACTIVIDAD_DESCRIPCION`, `CATEGORIA_ID`,`ACTIVO`) VALUES
(1, 'Splash', 25.00, 'Con musica', 2, 0),
(2, 'Maquinas', 15.00, 'Con maquinas', 4, 0),
(3, 'Baile regional', 9.00, 'Bailes regionales', 2, 0),
(4, 'Bachata', 12.90, 'Bachata', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ACTIVIDAD_ALBERGA_LUGAR`
--

CREATE TABLE IF NOT EXISTS `ACTIVIDAD_ALBERGA_LUGAR` (
  `ACTIVIDAD_ID` int(100) NOT NULL,
  `LUGAR_ID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ACTIVIDAD_ALBERGA_LUGAR`
--

INSERT INTO `ACTIVIDAD_ALBERGA_LUGAR` (`ACTIVIDAD_ID`, `LUGAR_ID`) VALUES
(3, 1),
(4, 1),
(1, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `CAJA`
--

CREATE TABLE IF NOT EXISTS `CAJA` (
  `CAJA_ID` int(100) NOT NULL,
  `CAJA_FECHA` date NOT NULL,
  `CAJA_INGRESOS` decimal(65,2) NOT NULL,
  `CAJA_GASTOS` decimal(65,2) NOT NULL,
  `CAJA_BALANCE` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CAJA`
--

INSERT INTO `CAJA` (`CAJA_ID`, `CAJA_FECHA`, `CAJA_INGRESOS`, `CAJA_GASTOS`, `CAJA_BALANCE`) VALUES
(1, '2016-11-18', 1000.00, 500.00, 500),
(2, '2016-11-17', 2000.00, 1000.00, 1000),
(3, '2016-11-19', 1500.00, 1000.00, 500),
(4, '2016-11-20', 2000.00, 500.00, 1500);

-- --------------------------------------------------------

--
-- Table structure for table `CATEGORIA`
--

CREATE TABLE IF NOT EXISTS `CATEGORIA` (
`CATEGORIA_ID` int(100) NOT NULL,
  `CATEGORIA_NOMBRE` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CATEGORIA`
--

INSERT INTO `CATEGORIA` (`CATEGORIA_ID`, `CATEGORIA_NOMBRE`) VALUES
(1, 'Actividad 3º Edad'),
(2, 'Bailes de Salon'),
(3, 'Bailes Comtemporaneos'),
(4, 'Gimnasio - Pesas');

-- --------------------------------------------------------

--
-- Table structure for table `CLIENTE`
--


CREATE TABLE IF NOT EXISTS `CLIENTE` (
`CLIENTE_ID` int(100) NOT NULL,
  `CLIENTE_DNI` varchar(10) NOT NULL,
  `CLIENTE_NOMBRE` varchar(30) NOT NULL,
  `CLIENTE_APELLIDOS` varchar(50) DEFAULT NULL,
  `CLIENTE_DIRECCION` varchar(60) DEFAULT NULL,
  `CLIENTE_CORREO` varchar(70) DEFAULT NULL,
  `CLIENTE_FECH_NAC` date DEFAULT NULL,
  `CLIENTE_PROFESION` varchar(50) DEFAULT NULL,
  `CLIENTE_COMENTARIOS` varchar(1000) DEFAULT NULL,
  `CLIENTE_ESTADO` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `CLIENTE_DOM` varchar(500) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `CLIENTE_LOPD` varchar(500) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `CLIENTE_TELEFONO1` int(15) DEFAULT NULL,
  `CLIENTE_TELEFONO2` int(15) DEFAULT NULL,
  `CLIENTE_TELEFONO3` int(15) DEFAULT NULL,
  `CLIENTE_TIPO` char(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=313 DEFAULT CHARSET=latin1;
ALTER TABLE `CLIENTE`
 ADD PRIMARY KEY (`CLIENTE_ID`);


--
-- Dumping data for table `CLIENTE`
--

INSERT INTO `CLIENTE` (`CLIENTE_ID`, `CLIENTE_DNI`, `CLIENTE_NOMBRE`, `CLIENTE_APELLIDOS`, `CLIENTE_DIRECCION`, `CLIENTE_CORREO`, `CLIENTE_FECH_NAC`,`CLIENTE_PROFESION`,`CLIENTE_COMENTARIOS`, `CLIENTE_ESTADO`, `CLIENTE_DOM`,  `CLIENTE_LOPD`,`CLIENTE_TELEFONO1`,`CLIENTE_TELEFONO2`,`CLIENTE_TELEFONO3`, `CLIENTE_TIPO`) VALUES
(1, '11378328K', 'Javier', 'Ibarra Ramos', 'Avenida de la Pola 3', 'ivanddf1994@hotmail.com', '1996-11-01', 'panadero', '','Activo','','',999999999,666666666,0,'1'  ),
(2, '15953592X', 'Marcos', 'Rodriguez Fernandez', ' Avenida de Marín 4', 'ivanddf1994@hotmail.com', '1994-08-01',  'médico', '','Activo','','', 99999998,0,0,'1' ),
(3, '35248369H', 'Raquel', 'Iglesias Iglesias', 'Plaza San Juan 22', 'rigle@hotmail.com', '1991-08-01','','','Activo','','', 999399999, 0, 0, '0'),
(4, '36559850Q', 'Martin', 'Puga Egea', 'Avda. Buenos Aires', 'mpugaeg@gmail.com', '1995-01-24','ingeniero',  'Karateka',   'Activo','','', 666668862,989898989,656656656,'1');

 ALTER TABLE `CLIENTE`
MODIFY `CLIENTE_ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
-- --------------------------------------------------------

--
-- Table structure for table `CLIENTE_ASISTE_ACTIVIDAD`
--

CREATE TABLE IF NOT EXISTS `CLIENTE_ASISTE_ACTIVIDAD` (
  `CLIENTE_ID` int(100) NOT NULL,
  `ACTIVIDAD_ID` int(100) NOT NULL,
  `FECHA_ASISTENCIA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CLIENTE_ASISTE_ACTIVIDAD`
--

INSERT INTO `CLIENTE_ASISTE_ACTIVIDAD` (`CLIENTE_ID`, `ACTIVIDAD_ID`, `FECHA_ASISTENCIA`) VALUES
(1, 2, '2016-11-15'),
(1, 4, '2016-11-16'),
(2, 2, '2016-11-02'),
(3, 2, '2016-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `CLIENTE_INSCRIPCION_ACTIVIDAD`
--

CREATE TABLE IF NOT EXISTS `CLIENTE_INSCRIPCION_ACTIVIDAD` (
  `CLIENTE_ID` int(100) NOT NULL,
  `ACTIVIDAD_ID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CLIENTE_INSCRIPCION_ACTIVIDAD`
--

INSERT INTO `CLIENTE_INSCRIPCION_ACTIVIDAD` (`CLIENTE_ID`, `ACTIVIDAD_ID`) VALUES
(1, 2),
(2, 2),
(3, 2),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `CLIENTE_PARTICIPA_EVENTO`
--

CREATE TABLE IF NOT EXISTS `CLIENTE_PARTICIPA_EVENTO` (
  `CLIENTE_ID` int(100) NOT NULL,
  `EVENTO_ID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CLIENTE_PARTICIPA_EVENTO`
--

INSERT INTO `CLIENTE_PARTICIPA_EVENTO` (`CLIENTE_ID`, `EVENTO_ID`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `DESCUENTO`
--

CREATE TABLE IF NOT EXISTS `DESCUENTO` (
`DESCUENTO_ID` int(100) NOT NULL,
  `DESCUENTO_VALOR` int(100) NOT NULL,
  `DESCUENTO_DESCRIPCION` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
ALTER TABLE `DESCUENTO`
 ADD PRIMARY KEY (`DESCUENTO_ID`);
--
-- Dumping data for table `DESCUENTO`
--

INSERT INTO `DESCUENTO` (`DESCUENTO_ID`, `DESCUENTO_VALOR`, `DESCUENTO_DESCRIPCION`) VALUES
(1, 10, NULL),
(2, 15, 'Mas de 3 Actividades');

-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Table structure for table `CLIENTE_TIENE_DESCUENTO`
--

CREATE TABLE IF NOT EXISTS `CLIENTE_TIENE_DESCUENTO` (
  `CLIENTE_ID` int(100) NOT NULL,
  `DESCUENTO_ID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `CLIENTE_TIENE_DESCUENTO`
 ADD PRIMARY KEY (`CLIENTE_ID`,`DESCUENTO_ID`), ADD KEY `DESCUENTO_ID` (`DESCUENTO_ID`);

ALTER TABLE `CLIENTE_TIENE_DESCUENTO`
ADD CONSTRAINT `CLIENTE_TIENE_DESCUENTO_ibfk_2` FOREIGN KEY (`DESCUENTO_ID`) REFERENCES `DESCUENTO` (`DESCUENTO_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `CLIENTE_TIENE_DESCUENTO_ibfk_1` FOREIGN KEY (`CLIENTE_ID`) REFERENCES `CLIENTE` (`CLIENTE_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;


--
-- Dumping data for table `CLIENTE_TIENE_DESCUENTO`
--

INSERT INTO `CLIENTE_TIENE_DESCUENTO` (`CLIENTE_ID`, `DESCUENTO_ID`) VALUES
(1, 1),
(2, 2),
(4, 1),
(4, 2);




--
-- Table structure for table `DOCUMENTO`
--

CREATE TABLE IF NOT EXISTS `DOCUMENTO` (
`DOCUMENTO_ID` int(100) NOT NULL,
  `DOCUMENTO_NOMBRE` varchar(50) NOT NULL,
  `CLIENTE_ID` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DOCUMENTO`
--

INSERT INTO `DOCUMENTO` (`DOCUMENTO_ID`, `DOCUMENTO_NOMBRE`, `CLIENTE_ID`) VALUES
(1, 'Documento relativo a.....', 1),
(2, 'Documento relativo a cosas', 2),
(3, 'Documento firmado LOPD', 3);

-- --------------------------------------------------------

--
-- Table structure for table `EMPLEADOS`
--

CREATE TABLE IF NOT EXISTS `EMPLEADOS` (
  `EMP_USER` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `EMP_PASSWORD` varchar(128) COLLATE latin1_spanish_ci NOT NULL,
  `EMP_NOMBRE` varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
  `EMP_APELLIDO` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `EMP_DNI` varchar(10) COLLATE latin1_spanish_ci DEFAULT NULL,
  `EMP_FECH_NAC` date DEFAULT NULL,
  `EMP_EMAIL` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `EMP_TELEFONO` int(15) DEFAULT NULL,
  `EMP_CUENTA` varchar(60) COLLATE latin1_spanish_ci DEFAULT NULL,
  `EMP_DIRECCION` varchar(80) COLLATE latin1_spanish_ci DEFAULT NULL,
  `EMP_COMENTARIOS` varchar(1000) COLLATE latin1_spanish_ci DEFAULT NULL,
  `EMP_TIPO` int(10) DEFAULT NULL,
  `EMP_ESTADO` enum('Activo','Inactivo') COLLATE latin1_spanish_ci DEFAULT NULL,
  `EMP_FOTO` varchar(500) COLLATE latin1_spanish_ci DEFAULT NULL,
  `EMP_NOMINA` varchar(500) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `EMPLEADOS`
--

INSERT INTO `EMPLEADOS` (`EMP_USER`, `EMP_PASSWORD`, `EMP_NOMBRE`, `EMP_APELLIDO`, `EMP_DNI`, `EMP_FECH_NAC`, `EMP_EMAIL`, `EMP_TELEFONO`, `EMP_CUENTA`, `EMP_DIRECCION`, `EMP_COMENTARIOS`, `EMP_TIPO`, `EMP_ESTADO`, `EMP_FOTO`, `EMP_NOMINA`) VALUES
('ADMIN', '73acd9a5972130b75066c82595a1fae3', 'Juan Manuel', 'Fernandez Novoa', '65938568Y', '1984-03-08', 'ivanddf1994@hotmail.com', 678987543, NULL, 'Avenida de la Palmera 8, 1I', NULL, 1, 'Activo', NULL, NULL),
('monit', 'd9cfd4af77e33817de2160e0c1c7607c', 'Pepe', 'Perez', '70561875Z', '1957-10-31', 'ivanddf1994@gmail.com', 627345678, NULL, 'Plaza Santiago Carillo, 3', NULL, 3, 'Activo', NULL, NULL),
('secret', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'Luis', 'Gomez', '44841787K', '1957-10-31', 'idfernandez@esei.uvigo.es', 678965321, NULL, 'Calle de la Rosa 5, 6B', NULL, 2, 'Activo', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `EMPLEADOS_CAMBIOHORA_ACTIVIDAD`
--

CREATE TABLE IF NOT EXISTS `EMPLEADOS_CAMBIOHORA_ACTIVIDAD` (
  `EMP_USER` varchar(25) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `FECHA_CAMBIO` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ACTIVIDAD_ID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `EMPLEADOS_CAMBIOHORA_ACTIVIDAD`
--

INSERT INTO `EMPLEADOS_CAMBIOHORA_ACTIVIDAD` (`EMP_USER`, `FECHA_CAMBIO`, `ACTIVIDAD_ID`) VALUES
('monit', '2016-11-08 07:28:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `EMPLEADOS_IMPARTE_ACTIVIDAD`
--

CREATE TABLE IF NOT EXISTS `EMPLEADOS_IMPARTE_ACTIVIDAD` (
  `EMP_USER` varchar(25) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `ACTIVIDAD_ID` int(100) NOT NULL,
  `FECHA_IMPARTE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `EMPLEADOS_IMPARTE_ACTIVIDAD`
--

INSERT INTO `EMPLEADOS_IMPARTE_ACTIVIDAD` (`EMP_USER`, `ACTIVIDAD_ID`, `FECHA_IMPARTE`) VALUES
('monit', 1, '2016-11-10 13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `EMPLEADOS_PAGINA`
--

CREATE TABLE IF NOT EXISTS `EMPLEADOS_PAGINA` (
  `EMP_USER` varchar(25) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `PAGINA_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `EMPLEADOS_PAGINA`
--

INSERT INTO `EMPLEADOS_PAGINA` (`EMP_USER`, `PAGINA_ID`) VALUES
('ADMIN', 1),
('ADMIN', 2),
('ADMIN', 3),
('ADMIN', 4),
('secret', 4),
('ADMIN', 5),
('secret', 5),
('ADMIN', 6),
('secret', 6),
('ADMIN', 7),
('ADMIN', 8),
('ADMIN', 9),
('ADMIN', 10),
('ADMIN', 11),
('ADMIN', 12),
('ADMIN', 13),
('ADMIN', 14),
('ADMIN', 15),
('ADMIN', 16),
('ADMIN', 17),
('ADMIN', 18),
('ADMIN', 19),
('ADMIN', 20),
('ADMIN', 21),
('ADMIN', 22),
('ADMIN', 23),
('ADMIN', 106),
('ADMIN', 107),
('ADMIN', 108),
('ADMIN', 109),
('ADMIN', 200),
('ADMIN', 201),
('ADMIN', 202),
('ADMIN', 203),
('ADMIN', 204),
('ADMIN', 205),
('secret', 200),
('secret', 201),
('secret', 202),
('secret', 203),
('secret', 204),
('secret', 205),
('monit', 200),
('monit', 201),
('monit', 202),
('monit', 203),
('monit', 204),
('monit', 205),
('ADMIN', 300),
('ADMIN', 301),
('ADMIN', 302),
('ADMIN', 303),
('ADMIN', 304),
('secret', 300),
('secret', 301),
('secret', 302),
('secret', 303),
('secret', 304),
('ADMIN', 400),
('secret', 400),
('ADMIN', 401),
('secret', 401),
('ADMIN', 402),
('secret', 402),
('ADMIN', 403),
('secret', 403),
('ADMIN', 404),
('secret', 404),
('ADMIN', 405),
('secret', 405),
('ADMIN', 406),
('secret', 406),
('ADMIN', 407),
('secret', 407),
('ADMIN', 408),
('secret', 408),
('ADMIN', 409),
('secret', 409),
('ADMIN', 410),
('secret', 410),
('ADMIN', 700),
('secret', 700),
('ADMIN', 701),
('secret', 701),
('ADMIN', 702),
('secret', 702),
('ADMIN', 703),
('monit', 703),
('secret', 703),
('ADMIN', 704),
('monit', 704),
('secret', 704),
('ADMIN', 705),
('secret', 705),
('monit', 705),
('ADMIN', 706),
('monit', 706),
('ADMIN', 707),
('secret', 707),
('ADMIN', 708),
('secret', 708),
('ADMIN', 709),
('secret', 709),
('monit', 709),
('ADMIN', 710),
('secret', 710),
('ADMIN', 711),
('secret', 711),
('monit', 711),
('ADMIN', 712),
('secret', 712),
('monit', 712),
('ADMIN', 713),
('secret', 713),
('monit', 713),
('ADMIN', 714),
('secret', 714),
('ADMIN', 715),
('secret', 715),
('ADMIN', 716),
('secret', 716),
('ADMIN', 717),
('secret', 717),
('ADMIN', 800),
('ADMIN', 801),
('ADMIN', 802),
('ADMIN', 803),
('ADMIN', 804),
('ADMIN', 805),
('ADMIN', 806),
('ADMIN', 807),
('ADMIN', 808),
('ADMIN', 809),
('ADMIN', 810),
('ADMIN', 811),
('ADMIN', 812),
('ADMIN', 813),
('ADMIN', 814),
('ADMIN', 815),
('secret', 800),
('secret', 801),
('secret', 802),
('secret', 803),
('secret', 804),
('secret', 805),
('secret', 806),
('secret', 807),
('secret', 808);



-- --------------------------------------------------------

--
-- Table structure for table `EVENTO`
--

CREATE TABLE IF NOT EXISTS `EVENTO` (
`EVENTO_ID` int(100) NOT NULL,
  `EVENTO_NOMBRE` varchar(100) NOT NULL,
  `EVENTO_ORGANIZADOR` varchar(100) NOT NULL,
  `EVENTO_DESCRIPCION` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `EVENTO`
--

INSERT INTO `EVENTO` (`EVENTO_ID`, `EVENTO_NOMBRE`, `EVENTO_ORGANIZADOR`, `EVENTO_DESCRIPCION`) VALUES
(1, 'Charla con ...', 'Manuel do Miñio', NULL),
(2, 'Coloquio sobre...', 'Ramon Espinar', NULL),
(3, 'Taller de....', 'Juan Sanchez', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `EVENTO_ALBERGA_LUGAR`
--

CREATE TABLE IF NOT EXISTS `EVENTO_ALBERGA_LUGAR` (
  `EVENTO_ID` int(100) NOT NULL,
  `LUGAR_ID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `EVENTO_ALBERGA_LUGAR`
--

INSERT INTO `EVENTO_ALBERGA_LUGAR` (`EVENTO_ID`, `LUGAR_ID`) VALUES
(1, 1),
(2, 3),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `FACTURA`
--

CREATE TABLE IF NOT EXISTS `FACTURA` (
`FACTURA_ID` int(100) NOT NULL,
  `CLIENTE_ID` int(100) NOT NULL,
  `FACTURA_FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CLIENTE_NIF` varchar(9) NOT NULL,
  `CLIENTE_NOMBRE` varchar(50) NOT NULL,
  `CLIENTE_APELLIDOS` varchar(100) DEFAULT NULL,
  `FACTURA_ESTADO` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
--
-- Dumping data for table `FACTURA`
--

INSERT INTO `FACTURA` (`FACTURA_ID`, `CLIENTE_ID`, `FACTURA_FECHA`, `CLIENTE_NIF`, `CLIENTE_NOMBRE`, `CLIENTE_APELLIDOS`, `FACTURA_ESTADO`) VALUES
(1, 1, '2016-12-08 18:58:48', '12365487Z', 'Javier', 'Ibarra Ramos', 'COBRADA'),
(2, 1, '2016-12-08 18:58:58', '12365487Z', 'Javier', 'Ibarra Ramos', 'PENDIENTE'),
(3, 3, '2016-12-08 18:59:15', '89765644R', 'Raquel', 'Iglesias Iglesias', 'COBRADA'),
(4, 3, '2016-12-08 18:59:28', '89765644R', 'Raque', 'Iglesias Iglesias', 'PENDIENTE');

-- --------------------------------------------------------

--
-- Table structure for table `FUNCIONALIDAD`
--

CREATE TABLE IF NOT EXISTS `FUNCIONALIDAD` (
`FUNCIONALIDAD_ID` int(10) NOT NULL,
  `FUNCIONALIDAD_NOM` varchar(80) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `FUNCIONALIDAD`
--

INSERT INTO `FUNCIONALIDAD` (`FUNCIONALIDAD_ID`, `FUNCIONALIDAD_NOM`) VALUES
(1, 'GESTION EMPLEADOS'),
(2, 'GESTION ROLES'),
(3, 'GESTION FUNCIONALIDADES'),
(4, 'GESTION PAGINAS'),
(5, 'CONSULTA EMPLEADOS'),
(101, 'Gestion de Descuentos'),
(200, 'GESTION ACTIVIDADES'),
(300, 'GESTION PAGOS'),
(400, 'HACER CAJA'),
(401, 'GESTION FACTURAS'),
(700, 'GESTION LESIONES'),
(701, 'ENVIAR NOTIFICACION'),
(800, 'GESTION HORARIO'),
(801, 'GESTION CLIENTES');

-- --------------------------------------------------------

--
-- Table structure for table `FUNCIONALIDAD_PAGINA`
--

CREATE TABLE IF NOT EXISTS `FUNCIONALIDAD_PAGINA` (
  `FUNCIONALIDAD_ID` int(10) NOT NULL,
  `PAGINA_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `FUNCIONALIDAD_PAGINA`
--

INSERT INTO `FUNCIONALIDAD_PAGINA` (`FUNCIONALIDAD_ID`, `PAGINA_ID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(5, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(4, 13),
(4, 14),
(4, 15),
(4, 16),
(4, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(101,106),
(101,107),
(101,108),
(101,109),
(200,200),
(200,201),
(200,202),
(200,203),
(200,204),
(200,205),
(300, 300),
(300, 301),
(300, 302),
(300, 303),
(300, 304),
(400, 400), 
(400, 401), 
(400, 402),
(401, 403), 
(401, 404), 
(401, 405), 
(401, 406), 
(401, 407), 
(401, 408), 
(401,409),
(401,410),
(700, 700),
(700, 701),
(700, 702),
(700, 703),
(700, 704),
(700, 705),
(700, 706),
(700, 707),
(700, 708),
(701, 709),
(701, 710),
(701, 711),
(701, 712),
(701, 713),
(701, 714),
(701, 715),
(700, 716),
(701, 717),
(800, 800),
(800, 801),
(800, 802),
(800, 803),
(800, 804),
(800, 805),
(800, 806),
(800, 807),
(800, 808),
(801, 809),
(801, 810),
(801, 811),
(801, 812),
(801, 813),
(801, 814),
(801, 815);


-- --------------------------------------------------------

--
-- Table structure for table `LESION`
--

CREATE TABLE IF NOT EXISTS `LESION` (
`LESION_ID` int(100) NOT NULL,
  `LESION_NOM` varchar(100) NOT NULL,
  `LESION_DESC` varchar(200) DEFAULT NULL,
  `LESION_ESTADO` varchar(15) NOT NULL,
  `EMP_USER` varchar(25) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `CLIENTE_ID` int(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LESION`
--

INSERT INTO `LESION` (`LESION_ID`, `LESION_NOM`, `LESION_DESC`, `LESION_ESTADO`, `EMP_USER`, `CLIENTE_ID`) VALUES
(1, 'Rotura de Ligamento cruzado anterior', 'Trabajo para fortalecer la zona afectada','Superada', 'ADMIN', NULL),
(2, 'Pubalgia', 'Estiramientos 15min antes de empezar la sesion','Cronica', 'ADMIN', NULL),
(3, 'Esguince grado II rodilla derecha', 'Ejercicios movilidad articular antes de empezar la sesion','Pendiente', 'ADMIN', NULL),
(4, 'Fractura del quinto metatarsiano', 'Pendientes de alta medica','Pendiente', 'monit', NULL),
(5, 'Desgarro muscular biceps', 'Carga de trabajo controlada. Estiramientos al finalizar la sesion','Superada', 'monit', NULL),
(7, 'Condropatia rotuliana', 'Fortalecimiento del cuadriceps','Pendiente', 'secret', NULL),
(8, 'Contusion vertebra C15', 'Trabajo para fortalecer la zona afectada. Peso maximo 15kg','Pendiente', NULL, 1),
(9, 'Pubalgia', 'Estiramientos 15min antes de empezar la sesion','Cronica', NULL, 1),
(10, 'Esguince grado I codo izquierdo', 'Ejercicios movilidad articular antes de empezar la sesion','Pendiente', NULL, 2),
(11, 'Distension tendon rotuliano', 'Pendientes de alta medica','Superada', NULL, 3),
(12, 'Desgarro muscular cuadriceps', 'Carga de trabajo controlada. Estiramientos al finalizar la sesion','Superada', NULL, 3),
(13, 'Condropatia rotuliana', 'Fortalecimiento del cuadriceps','Pendiente', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `LINEA_FACTURA`
--

CREATE TABLE IF NOT EXISTS `LINEA_FACTURA` (
  `LINEA_FACTURA_ID` int(100) NOT NULL,
  `FACTURA_ID` int(100) NOT NULL,
  `LINEA_FACTURA_CONCEPTO` varchar(500) NOT NULL,
  `LINEA_FACTURA_UNIDADES` int(100) NOT NULL,
  `LINEA_FACTURA_PRECIOUD` decimal(65,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LINEA_FACTURA`
--

INSERT INTO `LINEA_FACTURA` (`LINEA_FACTURA_ID`, `FACTURA_ID`, `LINEA_FACTURA_CONCEPTO`, `LINEA_FACTURA_UNIDADES`, `LINEA_FACTURA_PRECIOUD`) VALUES
(1, 1, 'Proteinas', 5, 25.00),
(2, 2, 'Videojuegos', 3, 70.00),
(3, 3, 'Mancuernas', 10, 20.00),
(4, 4, 'Material escolar', 50, 10.00),
(5, 1, 'Botellas agua', 200, 1.00),
(6, 2, 'Bocadillos', 100, 2.00),
(7, 3, 'Bicicletas', 10, 100.00),
(8, 4, 'Zapatillas', 20, 50.00),
(9, 1, 'Camisetas', 20, 10.00),
(10, 2, 'Pantalones', 20, 30.00),
(11, 4, 'Chaquetas', 20, 50.00),
(12, 4, 'Calcetines', 30, 2.00);

-- --------------------------------------------------------

--
-- Table structure for table `LUGAR`
--

CREATE TABLE IF NOT EXISTS `LUGAR` (
  `LUGAR_ID` int(100) NOT NULL,
  `LUGAR_NOMBRE` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LUGAR`
--

INSERT INTO `LUGAR` (`LUGAR_ID`, `LUGAR_NOMBRE`) VALUES
(1, 'Sala1'),
(2, 'Piscina'),
(3, 'Sala3');

-- --------------------------------------------------------
--
-- Table structure for table `NOTIFICACION`
--

CREATE TABLE IF NOT EXISTS `NOTIFICACION` (
  `NOTIFICACION_ID` int(100) NOT NULL,
  `NOTIFICACION_REMITENTE` varchar(100) NOT NULL,
  `NOTIFICACION_FECHAHORA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `NOTIFICACION_DESTINATARIO` varchar(10000) NOT NULL,
  `EMP_USER` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `PAGINA`
--

CREATE TABLE IF NOT EXISTS `PAGINA` (
`PAGINA_ID` int(10) NOT NULL,
  `PAGINA_LINK` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `PAGINA_NOM` varchar(80) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `PAGINA`
--

INSERT INTO `PAGINA` (`PAGINA_ID`, `PAGINA_LINK`, `PAGINA_NOM`) VALUES
(1, '../Views/EMPLEADO_ADD_Vista.php', 'EMPLEADO ADD'),
(2, '../Views/EMPLEADO_DELETE_Vista.php', 'EMPLEADO DELETE'),
(3, '../Views/EMPLEADO_EDIT_Vista.php', 'EMPLEADO EDIT'),
(4, '../Views/EMPLEADO_SHOW_ALL_Vista.php', 'EMPLEADO SHOW ALL'),
(5, '../Views/EMPLEADO_SHOW_CONSULT_Vista.php', 'EMPLEADO SHOW CONSULT'),
(6, '../Views/EMPLEADO_SHOW_Vista.php', 'EMPLEADO SHOW'),
(7, '../Views/FUNCIONALIDAD_ADD_Vista.php', 'FUNCIONALIDAD ADD'),
(8, '../Views/FUNCIONALIDAD_DELETE_Vista.php', 'FUNCIONALIDAD DELETE'),
(9, '../Views/FUNCIONALIDAD_EDIT_Vista.php', 'FUNCIONALIDAD EDIT'),
(10, '../Views/FUNCIONALIDAD_SHOW_ALL_Vista.php', 'FUNCIONALIDAD SHOW ALL'),
(11, '../Views/FUNCIONALIDAD_SHOW_PAGINAS_Vista.php', 'FUNCIONALIDAD SHOW PAGINAS'),
(12, '../Views/FUNCIONALIDAD_SHOW_Vista.php', 'FUNCIONALIDAD SHOW'),
(13, '../Views/PAGINA_ADD_Vista.php', 'PAGINA ADD'),
(14, '../Views/PAGINA_DELETE_Vista.php', 'PAGINA DELETE'),
(15, '../Views/PAGINA_EDIT_Vista.php', 'PAGINA EDIT'),
(16, '../Views/PAGINA_SHOW_ALL_Vista.php', 'PAGINA SHOW ALL'),
(17, '../Views/PAGINA_SHOW_Vista.php', 'PAGINA SHOW'),
(18, '../Views/ROL_ADD_Vista.php', 'ROL ADD'),
(19, '../Views/ROL_DELETE_Vista.php', 'ROL DELETE'),
(20, '../Views/ROL_EDIT_Vista.php', 'ROL EDIT'),
(21, '../Views/ROL_SHOW_ALL_Vista.php', 'ROL SHOW ALL'),
(22, '../Views/ROL_SHOW_FUNCIONES_Vista.php', 'ROL SHOW FUNCIONES'),
(23, '../Views/ROL_SHOW_Vista.php', 'ROL SHOW'),
(106, '../Views/DESCUENTO_ADD_Vista.php', 'DESCUENTO ADD'),
(107, '../Views/DESCUENTO_DELETE_Vista.php', 'DESCUENTO DELETE'),
(108, '../Views/DESCUENTO_EDIT_Vista.php', 'DESCUENTO EDIT'),
(109, '../Views/DESCUENTO_SHOW_ALL_Vista.php', 'DESCUENTO SHOW ALL'),
(200, '../Views/ACTIVIDAD_ADD_Vista.php', 'ACTIVIDAD ADD'),
(201, '../Views/ACTIVIDAD_DELETE_Vista.php', 'ACTIVIDAD DELETE'),
(202, '../Views/ACTIVIDAD_SHOW_Vista.php', 'ACTIVIDAD SHOW'),
(203, '../Views/ACTIVIDAD_SHOW_ALL_Vista.php', 'ACTIVIDAD SHOW ALL'),
(204, '../Views/ACTIVIDAD_EDIT_Vista.php', 'ACTIVIDAD EDIT'),
(205, '../Views/ACTIVIDAD_OCULTAS_Vista.php', 'ACTIVIDAD OCULTAS'),
(300, '../Views/PAGO_ADD_Vista.php', 'PAGO ADD'),
(301, '../Views/PAGO_DELETE_Vista.php', 'PAGO DELETE'),
(302, '../Views/PAGO_EDIT_Vista.php', 'PAGO EDIT'),
(303, '../Views/PAGO_SHOW_ALL_Vista.php', 'PAGO SHOW ALL'),
(304, '../Views/PAGO_SHOW_Vista.php', 'PAGO SHOW'),
(400, '../Views/CAJA_ADD_Vista.php', 'CAJA ADD'),
(401, '../Views/CAJA_SHOW_Vista.php', 'CAJA SHOW'),
(402, '../Views/CAJA_SHOW_ALL_Vista.php', 'CAJA SHOW ALL'),
(403, '../Views/FACTURA_SHOW_ALL_Vista.php', 'FACTURA SHOW ALL'),
(404, '../Views/FACTURA_ADD_Vista.php', 'FACTURA ADD'),
(405, '../Views/FACTURA_DELETE_Vista.php', 'FACTURA DELETE'),
(406, '../Views/FACTURA_SHOW_LINEA_FACTURA_Vista.php', 'FACTURA SHOW LINEA FACTURA'),
(407, '../Views/FACTURA_EDIT_Vista.php', 'FACTURA EDIT'),
(408, '../Views/LINEA_FACTURA_ADD_Vista.php', 'LINEA FACTURA ADD'),
(409, '../Views/LINEA_FACTURA_EDIT_Vista.php', 'LINEA FACTURA EDIT'),
(410, '../Views/LINEA_FACTURA_SHOW_ALL_Vista.php', 'LINEA FACTURA SHOW ALL'),
(700, '../Views/LESION_ADD_Vista.php', 'LESION ADD'),
(701, '../Views/LESION_DELETE_Vista.php', 'LESION DELETE'),
(702, '../Views/LESION_EDIT_Vista.php', 'LESION EDIT'),
(703, '../Views/LESION_SHOW_ALL_Vista.php', 'LESION SHOW ALL'),
(704, '../Views/LESION_SHOW_Vista.php', 'LESION SHOW'),
(705, '../Views/LESION_CONSULT_Vista.php', 'LESION CONSULT'),
(706, '../Views/LESION_SHOW_REGISTRO_Vista.php', 'LESION REGISTRO'),
(707, '../Views/LESION_CONSULT_REGISTRO_Vista.php', 'REGISTRO CONSULT'),
(708, '../Views/LESION_REGISTRO_SELECT_Vista.php', 'REGISTRO SELECT'),
(709, '../Views/NOTIFICACION_SHOW_ALL_Vista.php', 'SHOW ALL NOTIFICACION'),
(710, '../Views/NOTIFICACION_SELECT_USER_Vista.php', 'SELECT CLIENTE'),
(711, '../Views/NOTIFICACION_EMAIL_Vista.php', 'SEND EMAIL'),
(712, '../Views/NOTIFICACION_SELECT_ACTIVIDAD_Vista.php', 'SHOW ACTIVIDAD'),
(713, '../Views/NOTIFICACION_CLIENTE_ACTIVIDAD_Vista.php', 'SHOW CLIENTE ACTIVIDAD'),
(714, '../Views/NOTIFICACION_CONSULT_Vista.php', 'NOTIFICACION CONSULT'),
(715, '../Views/NOTIFICACION_SHOW_Vista.php', 'NOTIFICACION SHOW'),
(716, '../Views/VER_REGISTRO_Vista.php', 'SHOW TXT'),
(717, '../Views/NOTIFICACION_SELECT_EVENTO_Vista.php', 'SELECT EVENTO'),
(800, '../Views/CLIENTE_ADD_Vista.php', 'CLIENTE ADD'),
(801, '../Views/CLIENTE_ADD_EXTERNO_Vista.php', 'CLIENTE ADD EXTERNO'),
(802, '../Views/CLIENTE_DELETE_Vista.php', 'CLIENTE DELETE'),
(803, '../Views/CLIENTE_EDIT_Vista.php', 'CLIENTE EDIT'),
(804, '../Views/CLIENTE_SHOW_ACTIVIDADES_Vista.php', 'CLIENTE SHOW ACTIVIDADES'),
(805, '../Views/CLIENTE_SHOW_ALL_Vista.php', 'CLIENTE SHOW ALL'),
(806, '../Views/CLIENTE_SHOW_CONSULT_Vista.php', 'CLIENTE SHOW CONSULT'),
(807, '../Views/CLIENTE_SHOW_LESIONES_Vista.php', 'CLIENTE SHOW LESIONES'),
(808, '../Views/CLIENTE_SHOW_Vista.php', 'CLIENTE SHOW'),
(809, '../Views/BLOQUE_ADD_Vista.php', 'BLOQUE ADD'),
(810, '../Views/BLOQUE_DELETE_Vista.php', 'BLOQUE DELETE'),
(811, '../Views/BLOQUE_EDIT_Vista.php', 'BLOQUE EDIT'),
(812, '../Views/BLOQUE_SHOW_ACTEV_Vista.php', 'BLOQUE SHOW'),
(813, '../Views/BLOQUE_SHOW_ALL_Vista.php', 'BLOQUE SHOW ALL'),
(814, '../Views/BLOQUE_SHOW_Vista.php', 'BLOQUE SHOW'),
(815, '../Views/CLASE_Vista.php', 'CLASE');


-- --------------------------------------------------------

--
-- Table structure for table `PAGO`
--

CREATE TABLE IF NOT EXISTS `PAGO` (
`PAGO_ID` int(100) NOT NULL,
`CLIENTE_ID` int(100) NOT NULL,
`PAGO_FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`PAGO_CONCEPTO` varchar(200) DEFAULT NULL,
`PAGO_METODO` varchar(35) NOT NULL,

-- `PAGO_IMPORTE` varchar(10) NOT NULL,
`PAGO_ESTADO` varchar(10) NOT NULL,
`PAGO_IMPORTE` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PAGO`
--
INSERT INTO `PAGO` (`PAGO_ID`, `CLIENTE_ID`, `PAGO_FECHA`, `PAGO_CONCEPTO`, `PAGO_METODO`, `PAGO_ESTADO`, `PAGO_IMPORTE`) VALUES
(1, 4, '2016-11-20 10:26:36', 'Curso de Karate','Contado',  'PAGADO', 500.00),
(2, 4, '2016-11-21 11:00:12', 'Master en Meditacion', 'Tarjeta de Credito/Debito', 'PENDIENTE', 270.90 ),
(3, 4, '2016-12-24 12:30:15', 'Chandal oficial Moovett', 'Transferencia Bancaria', 'PAGADO', 217.95),
(4, 4, '2016-12-24 17:02:01', 'Curso de Yoga Avanzado', 'Ingreso en Cuenta', 'PENDIENTE', 1000.00);

-- --------------------------------------------------------

--
-- Table structure for table `REGISTRO_CONSULTA_LESION`
--

CREATE TABLE IF NOT EXISTS `REGISTRO_CONSULTA_LESION` (
  `REGISTRO_CONSULTA_LESION_ID` int(100) NOT NULL,
  `REGISTRO_CONSULTA_LESION_FECHAHORA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `USUARIO` varchar(25) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `CLIENTE_ID` int(100) DEFAULT NULL,
  `EMP_USER` varchar(25) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------



--
-- Table structure for table `ROL`
--

CREATE TABLE IF NOT EXISTS `ROL` (
`ROL_ID` int(10) NOT NULL,
  `ROL_NOM` varchar(80) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `ROL`
--

INSERT INTO `ROL` (`ROL_ID`, `ROL_NOM`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'SECRETARIO'),
(3, 'MONITOR');

-- --------------------------------------------------------

--
-- Table structure for table `ROL_FUNCIONALIDAD`
--

CREATE TABLE IF NOT EXISTS `ROL_FUNCIONALIDAD` (
  `ROL_ID` int(10) NOT NULL,
  `FUNCIONALIDAD_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `ROL_FUNCIONALIDAD`
--

INSERT INTO `ROL_FUNCIONALIDAD` (`ROL_ID`, `FUNCIONALIDAD_ID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 5),
(1, 101),
(1, 200),
(2,200),
(3,200),
(1, 300),
(2, 300),
(1, 400), 
(1, 401),
(2, 400), 
(2, 401),
(1, 700),
(2, 700),
(3, 700),
(1, 701),
(2, 701),
(3, 701),
(1,800),
(1,801),
(2,800);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ACTIVIDAD`
--
ALTER TABLE `ACTIVIDAD`
 ADD PRIMARY KEY (`ACTIVIDAD_ID`), ADD KEY `CATEGORIA_ID` (`CATEGORIA_ID`);

--
-- Indexes for table `ACTIVIDAD_ALBERGA_LUGAR`
--
ALTER TABLE `ACTIVIDAD_ALBERGA_LUGAR`
 ADD PRIMARY KEY (`ACTIVIDAD_ID`,`LUGAR_ID`), ADD KEY `LUGAR_ID` (`LUGAR_ID`);

--
-- Indexes for table `CAJA`
--
ALTER TABLE `CAJA`
 ADD PRIMARY KEY (`CAJA_ID`);

--
-- Indexes for table `CATEGORIA`
--
ALTER TABLE `CATEGORIA`
 ADD PRIMARY KEY (`CATEGORIA_ID`);

--


--
-- Indexes for table `CLIENTE_ASISTE_ACTIVIDAD`
--
ALTER TABLE `CLIENTE_ASISTE_ACTIVIDAD`
 ADD PRIMARY KEY (`CLIENTE_ID`,`ACTIVIDAD_ID`), ADD KEY `ACTIVIDAD_ID` (`ACTIVIDAD_ID`);



--
-- Indexes for table `CLIENTE_INSCRIPCION_ACTIVIDAD`
--
ALTER TABLE `CLIENTE_INSCRIPCION_ACTIVIDAD`
 ADD PRIMARY KEY (`CLIENTE_ID`,`ACTIVIDAD_ID`), ADD KEY `ACTIVIDAD_ID` (`ACTIVIDAD_ID`);

--
-- Indexes for table `CLIENTE_PARTICIPA_EVENTO`
--
ALTER TABLE `CLIENTE_PARTICIPA_EVENTO`
 ADD PRIMARY KEY (`CLIENTE_ID`,`EVENTO_ID`), ADD KEY `EVENTO_ID` (`EVENTO_ID`);

--
-- Indexes for table `CLIENTE_TIENE_DESCUENTO`
--

--
-- Indexes for table `DESCUENTO`
--


--
-- Indexes for table `DOCUMENTO`
--
ALTER TABLE `DOCUMENTO`
 ADD PRIMARY KEY (`DOCUMENTO_ID`), ADD KEY `CLIENTE_ID` (`CLIENTE_ID`);

--
-- Indexes for table `EMPLEADOS`
--
ALTER TABLE `EMPLEADOS`
 ADD PRIMARY KEY (`EMP_USER`), ADD KEY `EMP_TIPO` (`EMP_TIPO`);

--
-- Indexes for table `EMPLEADOS_CAMBIOHORA_ACTIVIDAD`
--
ALTER TABLE `EMPLEADOS_CAMBIOHORA_ACTIVIDAD`
 ADD PRIMARY KEY (`EMP_USER`,`ACTIVIDAD_ID`), ADD KEY `ACTIVIDAD_ID` (`ACTIVIDAD_ID`);

--
-- Indexes for table `EMPLEADOS_IMPARTE_ACTIVIDAD`
--
ALTER TABLE `EMPLEADOS_IMPARTE_ACTIVIDAD`
 ADD PRIMARY KEY (`EMP_USER`,`ACTIVIDAD_ID`), ADD KEY `ACTIVIDAD_ID` (`ACTIVIDAD_ID`);

--
-- Indexes for table `EMPLEADOS_PAGINA`
--
ALTER TABLE `EMPLEADOS_PAGINA`
 ADD PRIMARY KEY (`EMP_USER`,`PAGINA_ID`), ADD KEY `EMPLEADOS__PAGINA_ID_fk` (`PAGINA_ID`);

--
-- Indexes for table `EVENTO`
--
ALTER TABLE `EVENTO`
 ADD PRIMARY KEY (`EVENTO_ID`);

--
-- Indexes for table `EVENTO_ALBERGA_LUGAR`
--
ALTER TABLE `EVENTO_ALBERGA_LUGAR`
 ADD PRIMARY KEY (`EVENTO_ID`,`LUGAR_ID`), ADD KEY `LUGAR_ID` (`LUGAR_ID`);

--
-- Indexes for table `FACTURA`
--
ALTER TABLE `FACTURA`
 ADD PRIMARY KEY (`FACTURA_ID`), ADD KEY `CLIENTE_ID` (`CLIENTE_ID`);

--
-- Indexes for table `FUNCIONALIDAD`
--
ALTER TABLE `FUNCIONALIDAD`
 ADD PRIMARY KEY (`FUNCIONALIDAD_ID`);

--
-- Indexes for table `FUNCIONALIDAD_PAGINA`
--
ALTER TABLE `FUNCIONALIDAD_PAGINA`
 ADD PRIMARY KEY (`FUNCIONALIDAD_ID`,`PAGINA_ID`), ADD KEY `PAGINA_ID` (`PAGINA_ID`);

--
-- Indexes for table `LESION`
--
ALTER TABLE `LESION`
 ADD PRIMARY KEY (`LESION_ID`), ADD KEY `EMP_USER` (`EMP_USER`), ADD KEY `CLIENTE_ID` (`CLIENTE_ID`);

--
-- Indexes for table `LINEA_FACTURA`
--
ALTER TABLE `LINEA_FACTURA`
 ADD PRIMARY KEY (`LINEA_FACTURA_ID`), ADD KEY `FACTURA_ID` (`FACTURA_ID`);

--
-- Indexes for table `LUGAR`
--
ALTER TABLE `LUGAR`
 ADD PRIMARY KEY (`LUGAR_ID`);

--
-- Indexes for table `NOTIFICACION`
--
ALTER TABLE `NOTIFICACION`
 ADD PRIMARY KEY (`NOTIFICACION_ID`), ADD KEY `EMP_USER` (`EMP_USER`);

--
-- Indexes for table `PAGINA`
--
ALTER TABLE `PAGINA`
 ADD PRIMARY KEY (`PAGINA_ID`);

--
-- Indexes for table `PAGO`
--
ALTER TABLE `PAGO`
 ADD PRIMARY KEY (`PAGO_ID`), ADD KEY `CLIENTE_ID` (`CLIENTE_ID`);

--
-- Indexes for table `REGISTRO_CONSULTA_LESION`
--
ALTER TABLE `REGISTRO_CONSULTA_LESION`
 ADD PRIMARY KEY (`REGISTRO_CONSULTA_LESION_ID`), ADD KEY `CLIENTE_ID` (`CLIENTE_ID`), ADD KEY `EMP_USER` (`EMP_USER`),  ADD KEY `USUARIO` (`USUARIO`);


--
-- Indexes for table `ROL`
--
ALTER TABLE `ROL`
 ADD PRIMARY KEY (`ROL_ID`);

--
-- Indexes for table `ROL_FUNCIONALIDAD`
--
ALTER TABLE `ROL_FUNCIONALIDAD`
 ADD PRIMARY KEY (`ROL_ID`,`FUNCIONALIDAD_ID`), ADD KEY `FUNCIONALIDAD_ID` (`FUNCIONALIDAD_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ACTIVIDAD`
--
ALTER TABLE `ACTIVIDAD`
MODIFY `ACTIVIDAD_ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `CATEGORIA`
--
ALTER TABLE `CATEGORIA`
MODIFY `CATEGORIA_ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `CLIENTE`
--

--

--
-- AUTO_INCREMENT for table `DESCUENTO`
--
ALTER TABLE `DESCUENTO`
MODIFY `DESCUENTO_ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `DOCUMENTO`
--
ALTER TABLE `DOCUMENTO`
MODIFY `DOCUMENTO_ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `EVENTO`
--
ALTER TABLE `EVENTO`
MODIFY `EVENTO_ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `FACTURA`
--
ALTER TABLE `FACTURA`
MODIFY `FACTURA_ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `FUNCIONALIDAD`
--
ALTER TABLE `FUNCIONALIDAD`
MODIFY `FUNCIONALIDAD_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=900;
--
-- AUTO_INCREMENT for table `LESION`
--
ALTER TABLE `LESION`
MODIFY `LESION_ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `LUGAR`
--
ALTER TABLE `LUGAR`
MODIFY `LUGAR_ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `NOTIFICACION`
--
ALTER TABLE `NOTIFICACION`
MODIFY `NOTIFICACION_ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `PAGINA`
--
ALTER TABLE `PAGINA`
MODIFY `PAGINA_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=900;
--
-- AUTO_INCREMENT for table `PAGO`
--
ALTER TABLE `PAGO`
MODIFY `PAGO_ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `REGISTRO_CONSULTA_LESION`
--
ALTER TABLE `REGISTRO_CONSULTA_LESION`
MODIFY `REGISTRO_CONSULTA_LESION_ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ROL`
--
ALTER TABLE `ROL`
MODIFY `ROL_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ACTIVIDAD`
--
ALTER TABLE `ACTIVIDAD`
ADD CONSTRAINT `ACTIVIDAD_ibfk_1` FOREIGN KEY (`CATEGORIA_ID`) REFERENCES `CATEGORIA` (`CATEGORIA_ID`);

--
-- Constraints for table `ACTIVIDAD_ALBERGA_LUGAR`
--
ALTER TABLE `ACTIVIDAD_ALBERGA_LUGAR`
ADD CONSTRAINT `ACTIVIDAD_ALBERGA_LUGAR_ibfk_2` FOREIGN KEY (`LUGAR_ID`) REFERENCES `LUGAR` (`LUGAR_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `ACTIVIDAD_ALBERGA_LUGAR_ibfk_1` FOREIGN KEY (`ACTIVIDAD_ID`) REFERENCES `ACTIVIDAD` (`ACTIVIDAD_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `CLIENTE_ASISTE_ACTIVIDAD`
--
ALTER TABLE `CLIENTE_ASISTE_ACTIVIDAD`
ADD CONSTRAINT `CLIENTE_ASISTE_ACTIVIDAD_ibfk_2` FOREIGN KEY (`ACTIVIDAD_ID`) REFERENCES `ACTIVIDAD` (`ACTIVIDAD_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `CLIENTE_ASISTE_ACTIVIDAD_ibfk_1` FOREIGN KEY (`CLIENTE_ID`) REFERENCES `CLIENTE` (`CLIENTE_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `CLIENTE_INSCRIPCION_ACTIVIDAD`
--
ALTER TABLE `CLIENTE_INSCRIPCION_ACTIVIDAD`
ADD CONSTRAINT `CLIENTE_INSCRIPCION_ACTIVIDAD_ibfk_2` FOREIGN KEY (`ACTIVIDAD_ID`) REFERENCES `ACTIVIDAD` (`ACTIVIDAD_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `CLIENTE_INSCRIPCION_ACTIVIDAD_ibfk_1` FOREIGN KEY (`CLIENTE_ID`) REFERENCES `CLIENTE` (`CLIENTE_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `CLIENTE_PARTICIPA_EVENTO`
--
ALTER TABLE `CLIENTE_PARTICIPA_EVENTO`
ADD CONSTRAINT `CLIENTE_PARTICIPA_EVENTO_ibfk_2` FOREIGN KEY (`EVENTO_ID`) REFERENCES `EVENTO` (`EVENTO_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `CLIENTE_PARTICIPA_EVENTO_ibfk_1` FOREIGN KEY (`CLIENTE_ID`) REFERENCES `CLIENTE` (`CLIENTE_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `CLIENTE_TIENE_DESCUENTO`
--


--
-- Constraints for table `DOCUMENTO`
--
ALTER TABLE `DOCUMENTO`
ADD CONSTRAINT `DOCUMENTO_ibfk_1` FOREIGN KEY (`CLIENTE_ID`) REFERENCES `CLIENTE` (`CLIENTE_ID`);

--
-- Constraints for table `EMPLEADOS`
--
ALTER TABLE `EMPLEADOS`
ADD CONSTRAINT `EMPLEADOS_ibfk_1` FOREIGN KEY (`EMP_TIPO`) REFERENCES `ROL` (`ROL_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `EMPLEADOS_CAMBIOHORA_ACTIVIDAD`
--
ALTER TABLE `EMPLEADOS_CAMBIOHORA_ACTIVIDAD`
ADD CONSTRAINT `EMPLEADOS_CAMBIOHORA_ACTIVIDAD_ibfk_1` FOREIGN KEY (`EMP_USER`) REFERENCES `EMPLEADOS` (`EMP_USER`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `EMPLEADOS_CAMBIOHORA_ACTIVIDAD_ibfk_2` FOREIGN KEY (`ACTIVIDAD_ID`) REFERENCES `ACTIVIDAD` (`ACTIVIDAD_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `EMPLEADOS_IMPARTE_ACTIVIDAD`
--
ALTER TABLE `EMPLEADOS_IMPARTE_ACTIVIDAD`
ADD CONSTRAINT `EMPLEADOS_IMPARTE_ACTIVIDAD_ibfk_2` FOREIGN KEY (`ACTIVIDAD_ID`) REFERENCES `ACTIVIDAD` (`ACTIVIDAD_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `EMPLEADOS_IMPARTE_ACTIVIDAD_ibfk_1` FOREIGN KEY (`EMP_USER`) REFERENCES `EMPLEADOS` (`EMP_USER`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `EMPLEADOS_PAGINA`
--
ALTER TABLE `EMPLEADOS_PAGINA`
ADD CONSTRAINT `EMPLEADOS_PAGINA_EMPLEADOS_EMP_USER_fk` FOREIGN KEY (`EMP_USER`) REFERENCES `EMPLEADOS` (`EMP_USER`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `EMPLEADOS_PAGINA_PAGINA_PAGINA_ID_fk` FOREIGN KEY (`PAGINA_ID`) REFERENCES `PAGINA` (`PAGINA_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `EVENTO_ALBERGA_LUGAR`
--
ALTER TABLE `EVENTO_ALBERGA_LUGAR`
ADD CONSTRAINT `EVENTO_ALBERGA_LUGAR_ibfk_2` FOREIGN KEY (`LUGAR_ID`) REFERENCES `LUGAR` (`LUGAR_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `EVENTO_ALBERGA_LUGAR_ibfk_1` FOREIGN KEY (`EVENTO_ID`) REFERENCES `EVENTO` (`EVENTO_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `FACTURA`
--
ALTER TABLE `FACTURA`
ADD CONSTRAINT `FACTURA_ibfk_1` FOREIGN KEY (`CLIENTE_ID`) REFERENCES `CLIENTE` (`CLIENTE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `FUNCIONALIDAD_PAGINA`
--
ALTER TABLE `FUNCIONALIDAD_PAGINA`
ADD CONSTRAINT `FUNCIONALIDAD_PAGINA_ibfk_1` FOREIGN KEY (`FUNCIONALIDAD_ID`) REFERENCES `FUNCIONALIDAD` (`FUNCIONALIDAD_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FUNCIONALIDAD_PAGINA_ibfk_2` FOREIGN KEY (`PAGINA_ID`) REFERENCES `PAGINA` (`PAGINA_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `LESION`
--
ALTER TABLE `LESION`
ADD CONSTRAINT `LESION_ibfk_1` FOREIGN KEY (`EMP_USER`) REFERENCES `EMPLEADOS` (`EMP_USER`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `LESION_ibfk_2` FOREIGN KEY (`CLIENTE_ID`) REFERENCES `CLIENTE` (`CLIENTE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `LINEA_FACTURA`
--
ALTER TABLE `LINEA_FACTURA`
ADD CONSTRAINT `LINEA_FACTURA_ibfk_1` FOREIGN KEY (`FACTURA_ID`) REFERENCES `FACTURA` (`FACTURA_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `NOTIFICACION`
--
ALTER TABLE `NOTIFICACION`
ADD CONSTRAINT `NOTIFICACION_ibfk_1` FOREIGN KEY (`EMP_USER`) REFERENCES `EMPLEADOS` (`EMP_USER`);

--
-- Constraints for table `PAGO`
--
ALTER TABLE `PAGO`
ADD CONSTRAINT `PAGO_ibfk_1` FOREIGN KEY (`CLIENTE_ID`) REFERENCES `CLIENTE` (`CLIENTE_ID`);

--
-- Constraints for table`REGISTRO_CONSULTA_LESION`
--
ALTER TABLE `REGISTRO_CONSULTA_LESION`
ADD CONSTRAINT `REGISTRO_CONSULTA_LESION_ibfk1` FOREIGN KEY (`EMP_USER`) REFERENCES `EMPLEADOS` (`EMP_USER`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `REGISTRO_CONSULTA_LESION_ibfk2` FOREIGN KEY (`CLIENTE_ID`) REFERENCES `CLIENTE` (`CLIENTE_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `REGISTRO_CONSULTA_LESION_ibfk3` FOREIGN KEY (`USUARIO`) REFERENCES `EMPLEADOS` (`EMP_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ROL_FUNCIONALIDAD`
--
ALTER TABLE `ROL_FUNCIONALIDAD`
ADD CONSTRAINT `ROL_FUNCIONALIDAD_ibfk_1` FOREIGN KEY (`ROL_ID`) REFERENCES `ROL` (`ROL_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ROL_FUNCIONALIDAD_ibfk_2` FOREIGN KEY (`FUNCIONALIDAD_ID`) REFERENCES `FUNCIONALIDAD` (`FUNCIONALIDAD_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
