-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: covinova
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `agendas`
--

DROP TABLE IF EXISTS `agendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agendas` (
  `id_agenda` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_agendada` date NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `estado_agenda` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `hora` time NOT NULL,
  `CI` varchar(9) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_agenda`),
  UNIQUE KEY `uc_fecha_agendada` (`fecha_agendada`,`hora`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agendas`
--

LOCK TABLES `agendas` WRITE;
/*!40000 ALTER TABLE `agendas` DISABLE KEYS */;
INSERT INTO `agendas` VALUES (19,'2025-07-28','pepe','pepito','realizada','2006-12-10','11:00:00','11221432','111111111','pepito@gmail.com');
/*!40000 ALTER TABLE `agendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asignada`
--

DROP TABLE IF EXISTS `asignada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asignada` (
  `CI` varchar(20) NOT NULL,
  `id_unidad` int(11) NOT NULL,
  PRIMARY KEY (`CI`,`id_unidad`),
  KEY `fk_asig_unidad` (`id_unidad`),
  CONSTRAINT `fk_asig_socio` FOREIGN KEY (`CI`) REFERENCES `socio` (`CI`) ON DELETE CASCADE,
  CONSTRAINT `fk_asig_unidad` FOREIGN KEY (`id_unidad`) REFERENCES `unidadhabitacional` (`id_unidad`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asignada`
--

LOCK TABLES `asignada` WRITE;
/*!40000 ALTER TABLE `asignada` DISABLE KEYS */;
/*!40000 ALTER TABLE `asignada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metodopago`
--

DROP TABLE IF EXISTS `metodopago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `metodopago` (
  `id_pago` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  `es_tarjeta` tinyint(1) NOT NULL,
  `tipo_tarjeta` varchar(20) DEFAULT NULL,
  `propietario_tarjeta` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metodopago`
--

LOCK TABLES `metodopago` WRITE;
/*!40000 ALTER TABLE `metodopago` DISABLE KEYS */;
/*!40000 ALTER TABLE `metodopago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obra`
--

DROP TABLE IF EXISTS `obra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obra` (
  `id_trabajo` int(11) NOT NULL AUTO_INCREMENT,
  `solicitud_exoneracion` text DEFAULT NULL,
  `pago_compensatorio_comprobante` varchar(255) DEFAULT NULL,
  `validado_administrativo` tinyint(1) DEFAULT 0,
  `causa_inasistencia` text DEFAULT NULL,
  `tipo_tarea` varchar(255) DEFAULT NULL,
  `horas_trabajadas` decimal(10,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id_trabajo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obra`
--

LOCK TABLES `obra` WRITE;
/*!40000 ALTER TABLE `obra` DISABLE KEYS */;
/*!40000 ALTER TABLE `obra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pago`
--

DROP TABLE IF EXISTS `pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pago` (
  `id_pago` int(11) NOT NULL,
  `CI` varchar(20) NOT NULL,
  `fecha_pago` date DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_límite` date DEFAULT NULL,
  `plazo` int(11) DEFAULT NULL,
  `comprobante` varchar(255) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `pago_a_tiempo` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id_pago`),
  KEY `fk_pago_socio` (`CI`),
  CONSTRAINT `fk_pago_metodo` FOREIGN KEY (`id_pago`) REFERENCES `metodopago` (`id_pago`),
  CONSTRAINT `fk_pago_socio` FOREIGN KEY (`CI`) REFERENCES `socio` (`CI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pago`
--

LOCK TABLES `pago` WRITE;
/*!40000 ALTER TABLE `pago` DISABLE KEYS */;
/*!40000 ALTER TABLE `pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sanciones`
--

DROP TABLE IF EXISTS `sanciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sanciones` (
  `id_sancion` int(11) NOT NULL AUTO_INCREMENT,
  `CI_socio` varchar(20) NOT NULL,
  `motivo` text DEFAULT NULL,
  `estado_sancion` varchar(50) DEFAULT NULL,
  `importe_sancion` decimal(10,2) DEFAULT NULL,
  `tipo_sancion` varchar(50) DEFAULT NULL,
  `fecha_emisión` date DEFAULT NULL,
  `comprobante` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_sancion`),
  KEY `fk_sanc_socio` (`CI_socio`),
  CONSTRAINT `fk_sanc_socio` FOREIGN KEY (`CI_socio`) REFERENCES `socio` (`CI`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sanciones`
--

LOCK TABLES `sanciones` WRITE;
/*!40000 ALTER TABLE `sanciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `sanciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socio`
--

DROP TABLE IF EXISTS `socio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `socio` (
  `CI` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contraseña` varchar(255) NOT NULL,
  `estado_pago` varchar(50) DEFAULT NULL,
  `comprobante_pago_inicial` varchar(255) DEFAULT NULL,
  `pago_mensual` decimal(10,2) DEFAULT NULL,
  `rol` varchar(50) NOT NULL DEFAULT 'socio',
  `imagen` blob DEFAULT NULL,
  PRIMARY KEY (`CI`),
  UNIQUE KEY `telefono` (`telefono`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `socio`
--

LOCK TABLES `socio` WRITE;
/*!40000 ALTER TABLE `socio` DISABLE KEYS */;
INSERT INTO `socio` VALUES ('11221432','pepe','pepito','2025-07-28','a','111111111','pepito@gmail.com','$2y$10$/Nxp44gkko/G4uPnp4h2Y.nHU9/gH0ZK.jU/V.6ZIU36kCrTn1Rem','Pendiente',NULL,111.00,'Socio',_binary 'profile_11221432_image.jpg'),('42151235','santiago','miraglia','2025-07-28','as','093314212','santiagoluccaasdmiraglia8@gmail.com','$2y$10$ddwe5GoSk3kLSMnNyMlYGeeH6jbTfB5MEExVupLwF37jucFWkqLhq','Pendiente',NULL,123123.00,'Socio',NULL),('56278194','Santiago','Miraglia','2025-07-29','Av. PrincipalNS','093395215','santiagoluccamiraglia8@gmail.com','$2y$10$cA72/RiT7jh/9M/iWNBTJ.w1bDWlF50uB8Pvtg1X9RrHgc5rQwMdi','Pendiente',NULL,15000.00,'Tesorero',_binary 'profile_56278194_image.jpg');
/*!40000 ALTER TABLE `socio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trabaja_en`
--

DROP TABLE IF EXISTS `trabaja_en`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trabaja_en` (
  `CI` varchar(20) NOT NULL,
  `id_trabajo` int(11) NOT NULL,
  PRIMARY KEY (`CI`,`id_trabajo`),
  KEY `fk_trab_obra` (`id_trabajo`),
  CONSTRAINT `fk_trab_obra` FOREIGN KEY (`id_trabajo`) REFERENCES `obra` (`id_trabajo`) ON DELETE CASCADE,
  CONSTRAINT `fk_trab_socio` FOREIGN KEY (`CI`) REFERENCES `socio` (`CI`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trabaja_en`
--

LOCK TABLES `trabaja_en` WRITE;
/*!40000 ALTER TABLE `trabaja_en` DISABLE KEYS */;
/*!40000 ALTER TABLE `trabaja_en` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidadhabitacional`
--

DROP TABLE IF EXISTS `unidadhabitacional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unidadhabitacional` (
  `id_unidad` int(11) NOT NULL AUTO_INCREMENT,
  `bloque` varchar(50) DEFAULT NULL,
  `nro_de_puerta` varchar(20) DEFAULT NULL,
  `cant_dormitorios` int(11) DEFAULT NULL,
  `cant_baños` int(11) DEFAULT NULL,
  `superficie_total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_unidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidadhabitacional`
--

LOCK TABLES `unidadhabitacional` WRITE;
/*!40000 ALTER TABLE `unidadhabitacional` DISABLE KEYS */;
/*!40000 ALTER TABLE `unidadhabitacional` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-29 14:32:49
