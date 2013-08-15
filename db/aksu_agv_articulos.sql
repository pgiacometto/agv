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
-- Table structure for table `articulos`
--

DROP TABLE IF EXISTS `articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articulos` (
  `idarticulo` int(11) NOT NULL AUTO_INCREMENT,
  `cod` varchar(45) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `unidad` varchar(45) DEFAULT NULL,
  `idcategoria` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idarticulo`,`cod`),
  UNIQUE KEY `cod_UNIQUE` (`cod`),
  KEY `fk_articulos_articulos_categorias1_idx` (`idcategoria`),
  CONSTRAINT `fk_articulos_articulos_categorias1` FOREIGN KEY (`idcategoria`) REFERENCES `articulos_categorias` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos`
--

LOCK TABLES `articulos` WRITE;
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
INSERT INTO `articulos` VALUES (2,'AMB-01','Ambientador Toyota',NULL,1,'2013-08-15 03:46:44'),(6,'AMB-04','Ambientador Mercedez',NULL,1,'2013-08-15 03:52:52'),(7,'AMB-05','Ambientador Nisan',NULL,1,'2013-08-15 03:52:52'),(8,'AMB-02','Ambientador Mazda',NULL,1,'2013-08-15 03:52:52'),(9,'ATP-01','Tapa valvula Toyota',NULL,2,'2013-08-15 03:57:34'),(10,'ATP-02','Tapa valvula Mercedez',NULL,2,'2013-08-15 03:57:34'),(11,'ATP-03','Tapa valvula BMW',NULL,2,'2013-08-15 03:57:34'),(12,'ATP-04','Tapa valvula Audi',NULL,2,'2013-08-15 03:57:34');
/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;
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
