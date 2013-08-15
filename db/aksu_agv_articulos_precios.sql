CREATE DATABASE  IF NOT EXISTS `aksu_agv` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `aksu_agv`;
-- MySQL dump 10.13  Distrib 5.6.11, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: aksu_agv
-- ------------------------------------------------------
-- Server version	5.5.24-log

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
-- Table structure for table `articulos_precios`
--

DROP TABLE IF EXISTS `articulos_precios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articulos_precios` (
  `precio1` int(11) DEFAULT NULL,
  `precio2` int(11) DEFAULT NULL,
  `articulo_cod` varchar(45) NOT NULL,
  PRIMARY KEY (`articulo_cod`),
  KEY `fk_articulos_precios_articulos1_idx` (`articulo_cod`),
  CONSTRAINT `fk_articulos_precios_articulos1` FOREIGN KEY (`articulo_cod`) REFERENCES `articulos` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos_precios`
--

LOCK TABLES `articulos_precios` WRITE;
/*!40000 ALTER TABLE `articulos_precios` DISABLE KEYS */;
INSERT INTO `articulos_precios` VALUES (12000,14000,'AMB-01'),(15000,16000,'AMB-02'),(28000,25542,'AMB-04'),(12000,25000,'AMB-05'),(25,36,'ATP-01'),(36,28,'ATP-02'),(250,360,'ATP-03'),(400,450,'ATP-04');
/*!40000 ALTER TABLE `articulos_precios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-08-15  0:21:41
