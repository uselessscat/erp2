CREATE DATABASE  IF NOT EXISTS `erp` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `erp`;
-- MySQL dump 10.16  Distrib 10.1.21-MariaDB, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: 127.0.0.1
-- ------------------------------------------------------
-- Server version	10.1.21-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `afp`
--

DROP TABLE IF EXISTS `afp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `afp` (
  `idAfp` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(135) NOT NULL,
  `Rut` int(11) NOT NULL,
  `Porcentaje` double NOT NULL,
  `Estado` int(11) NOT NULL,
  PRIMARY KEY (`idAfp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `causafiniquito`
--

DROP TABLE IF EXISTS `causafiniquito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `causafiniquito` (
  `idCausaFiniquito` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(135) NOT NULL,
  PRIMARY KEY (`idCausaFiniquito`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `centrocosto`
--

DROP TABLE IF EXISTS `centrocosto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `centrocosto` (
  `idCentroCosto` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(135) NOT NULL,
  `CentroCostoPadre` int(11) DEFAULT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`idCentroCosto`),
  KEY `fk_centrocosto_centrocosto1_idx` (`CentroCostoPadre`),
  CONSTRAINT `fk_centrocosto_centrocostopadre` FOREIGN KEY (`CentroCostoPadre`) REFERENCES `centrocosto` (`idCentroCosto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciudad` (
  `idCiudad` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(765) NOT NULL,
  `Region_idRegion` int(11) NOT NULL,
  PRIMARY KEY (`idCiudad`),
  KEY `fk_ciudad_region1_idx` (`Region_idRegion`),
  CONSTRAINT `fk_ciudad_region1` FOREIGN KEY (`Region_idRegion`) REFERENCES `region` (`idRegion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contrato`
--

DROP TABLE IF EXISTS `contrato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contrato` (
  `idContrato` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpleado` int(11) NOT NULL,
  `idCiudad` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Cargo` varchar(120) NOT NULL,
  `DiaInicioTrabajo` int(11) NOT NULL,
  `DiaFinTrabajo` int(11) NOT NULL,
  `HoraInicio` time NOT NULL,
  `HoraFin` time NOT NULL,
  `DescansoInicio` int(11) NOT NULL,
  `DescansoFin` int(11) NOT NULL,
  `Sueldo` int(11) NOT NULL,
  `Finiquito_idFiniquito` int(11) DEFAULT NULL,
  `TipoContrato` varchar(135) NOT NULL,
  PRIMARY KEY (`idContrato`),
  KEY `fk_contrato_empleado1_idx` (`idEmpleado`),
  KEY `fk_contrato_finiquito1_idx` (`Finiquito_idFiniquito`),
  CONSTRAINT `fk_contrato_empleado1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contrato_finiquito1` FOREIGN KEY (`Finiquito_idFiniquito`) REFERENCES `finiquito` (`idFiniquito`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamento` (
  `idDepartamento` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(135) NOT NULL,
  `Direccion` varchar(300) NOT NULL,
  PRIMARY KEY (`idDepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `descuento`
--

DROP TABLE IF EXISTS `descuento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `descuento` (
  `iddescuento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(90) NOT NULL,
  `valordefecto` double DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`iddescuento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleado` (
  `idEmpleado` int(11) NOT NULL AUTO_INCREMENT,
  `Login` varchar(135) NOT NULL,
  `Contrasena` varchar(96) NOT NULL,
  `DocumentoIdentidad` int(11) NOT NULL,
  `Nombres` varchar(135) NOT NULL,
  `ApellidoPaterno` varchar(135) NOT NULL,
  `ApellidoMaterno` varchar(135) NOT NULL,
  `Sexo` int(11) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Direccion` varchar(180) NOT NULL,
  `TelefonoMovil` varchar(60) DEFAULT NULL,
  `TelefonoFijo` varchar(60) DEFAULT NULL,
  `EstadoCivil` int(11) NOT NULL,
  `Pais_idPais` int(11) NOT NULL,
  `Ciudad_idCiudad` int(11) NOT NULL,
  `Email` varchar(180) DEFAULT NULL,
  `OtroContacto` varchar(135) DEFAULT NULL,
  `Fotografia` varchar(150) DEFAULT NULL,
  `Estado` int(11) NOT NULL,
  `NivelAdministrativo` int(11) NOT NULL,
  PRIMARY KEY (`idEmpleado`),
  UNIQUE KEY `Login_UNIQUE` (`Login`),
  UNIQUE KEY `DocumentoIdentidad_UNIQUE` (`DocumentoIdentidad`),
  KEY `fk_empleado_pais1_idx` (`Pais_idPais`),
  KEY `fk_empleado_ciudad1_idx` (`Ciudad_idCiudad`),
  CONSTRAINT `fk_empleado_ciudad1` FOREIGN KEY (`Ciudad_idCiudad`) REFERENCES `ciudad` (`idCiudad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empleado_pais1` FOREIGN KEY (`Pais_idPais`) REFERENCES `pais` (`idPais`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `empleado2`
--

DROP TABLE IF EXISTS `empleado2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleado2` (
  `idEmpleado` int(11) NOT NULL,
  `Contrato_idContrato` int(11) DEFAULT NULL,
  `Afp_idAfp` int(11) DEFAULT NULL,
  `PrevisionSalud_idPrevision` int(11) DEFAULT NULL,
  `PrevisionPorcentage` double DEFAULT NULL,
  `Departamento_idDepartamento` int(11) DEFAULT NULL,
  `CentroCosto_idCentroCosto` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEmpleado`),
  UNIQUE KEY `idEmpleado_UNIQUE` (`idEmpleado`),
  KEY `fk_empleado2_afp1_idx` (`Afp_idAfp`),
  KEY `fk_empleado2_previsionsalud1_idx` (`PrevisionSalud_idPrevision`),
  KEY `fk_empleado2_centrocosto1_idx` (`CentroCosto_idCentroCosto`),
  KEY `fk_empleado2_departamento1_idx` (`Departamento_idDepartamento`),
  CONSTRAINT `fk_empleado2_afp1` FOREIGN KEY (`Afp_idAfp`) REFERENCES `afp` (`idAfp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empleado2_centrocosto1` FOREIGN KEY (`CentroCosto_idCentroCosto`) REFERENCES `centrocosto` (`idCentroCosto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empleado2_departamento1` FOREIGN KEY (`Departamento_idDepartamento`) REFERENCES `departamento` (`idDepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empleado2_empleado` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empleado2_previsionsalud1` FOREIGN KEY (`PrevisionSalud_idPrevision`) REFERENCES `previsionsalud` (`idPrevision`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `finiquito`
--

DROP TABLE IF EXISTS `finiquito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `finiquito` (
  `idFiniquito` int(11) NOT NULL AUTO_INCREMENT,
  `Contrato_idContrato` int(11) NOT NULL,
  `FechaTerminoContrato` date NOT NULL,
  `FechaPagoFiniquito` date NOT NULL,
  `Total` double NOT NULL,
  `CausaFiniquito_idCausaFiniquito` int(11) NOT NULL,
  `Conceptos` text,
  PRIMARY KEY (`idFiniquito`),
  KEY `fk_finiquito_causafiniquito1_idx` (`CausaFiniquito_idCausaFiniquito`),
  CONSTRAINT `fk_finiquito_causafiniquito1` FOREIGN KEY (`CausaFiniquito_idCausaFiniquito`) REFERENCES `causafiniquito` (`idCausaFiniquito`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `haber`
--

DROP TABLE IF EXISTS `haber`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `haber` (
  `idhaber` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(90) NOT NULL,
  `imponible` tinyint(1) NOT NULL,
  `valordefecto` double DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idhaber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `liquidacion`
--

DROP TABLE IF EXISTS `liquidacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `liquidacion` (
  `idLiquidacion` int(11) NOT NULL AUTO_INCREMENT,
  `Contrato_idContrato` int(11) NOT NULL,
  `Haberes` text,
  `Descuentos` text,
  `Total` double NOT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`idLiquidacion`),
  KEY `fk_Liquidacion_Contrato1_idx` (`Contrato_idContrato`),
  CONSTRAINT `fk_liquidacion_contrato1` FOREIGN KEY (`Contrato_idContrato`) REFERENCES `contrato` (`idContrato`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pais` (
  `idPais` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(135) NOT NULL,
  PRIMARY KEY (`idPais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `previsionsalud`
--

DROP TABLE IF EXISTS `previsionsalud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `previsionsalud` (
  `idPrevision` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(135) NOT NULL,
  `Rut` int(11) NOT NULL,
  `Porcentaje` double NOT NULL,
  `Estado` int(11) NOT NULL,
  PRIMARY KEY (`idPrevision`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `region` (
  `idRegion` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(765) NOT NULL,
  `Pais_idPais` int(11) NOT NULL,
  PRIMARY KEY (`idRegion`),
  KEY `fk_region_pais1_idx` (`Pais_idPais`),
  CONSTRAINT `fk_region_pais1` FOREIGN KEY (`Pais_idPais`) REFERENCES `pais` (`idPais`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-17  2:03:40
