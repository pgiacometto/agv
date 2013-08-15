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

--
-- Table structure for table `articulos_categorias`
--

DROP TABLE IF EXISTS `articulos_categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articulos_categorias` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos_categorias`
--

LOCK TABLES `articulos_categorias` WRITE;
/*!40000 ALTER TABLE `articulos_categorias` DISABLE KEYS */;
INSERT INTO `articulos_categorias` VALUES (1,'Air LiFe'),(2,'Auto Accesorios'),(3,'Filters'),(4,'Energy');
/*!40000 ALTER TABLE `articulos_categorias` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `cod` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcliente`,`cod`),
  UNIQUE KEY `cod_UNIQUE` (`cod`),
  KEY `fk_clientes_usuarios1_idx` (`idusuario`),
  CONSTRAINT `fk_clientes_usuarios1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'CL-01','Inversiones JJK C.A',NULL,'2013-08-15 04:00:03'),(2,'CL-04','KAKRI C.A',NULL,'2013-08-15 04:00:03'),(3,'CL-05','Corporacion FQ',NULL,'2013-08-15 04:00:41'),(4,'CL-07','Latino C.A',NULL,'2013-08-15 04:00:59'),(5,'CL-06','PEPGANGA S.A',NULL,'2013-08-15 04:02:53'),(7,'CL-09','MAXIN FR C.A',NULL,'2013-08-15 04:04:55');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `condicion_pago`
--

DROP TABLE IF EXISTS `condicion_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `condicion_pago` (
  `idcondicion_pago` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcondicion_pago`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `condicion_pago`
--

LOCK TABLES `condicion_pago` WRITE;
/*!40000 ALTER TABLE `condicion_pago` DISABLE KEYS */;
INSERT INTO `condicion_pago` VALUES (1,'CONTADO'),(2,'CREDITO'),(3,'15 DIAS');
/*!40000 ALTER TABLE `condicion_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `idpedido` int(11) NOT NULL AUTO_INCREMENT,
  `idcondicion_pago` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idvendedor` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `comentario` text,
  `status` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `iva` int(11) DEFAULT NULL,
  `monto_total` int(11) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idpedido`),
  KEY `fk_pedido_condicion_pago1_idx` (`idcondicion_pago`),
  KEY `fk_pedidos_clientes1_idx` (`idcliente`),
  KEY `fk_pedidos_vendedores1_idx` (`idvendedor`),
  CONSTRAINT `fk_pedido_condicion_pago1` FOREIGN KEY (`idcondicion_pago`) REFERENCES `condicion_pago` (`idcondicion_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedidos_clientes1` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedidos_vendedores1` FOREIGN KEY (`idvendedor`) REFERENCES `vendedores` (`idvendedor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos_has_articulos`
--

DROP TABLE IF EXISTS `pedidos_has_articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos_has_articulos` (
  `idpedido` int(11) NOT NULL,
  `idarticulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `desc` int(11) NOT NULL DEFAULT '0',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idpedido`,`idarticulo`),
  KEY `fk_detalle_pedido_has_articulos_articulos1_idx` (`idarticulo`),
  KEY `fk_detalle_pedido_has_articulos_detalle_pedido_idx` (`idpedido`),
  CONSTRAINT `fk_detalle_pedido_has_articulos_detalle_pedido` FOREIGN KEY (`idpedido`) REFERENCES `pedidos` (`idpedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_pedido_has_articulos_articulos1` FOREIGN KEY (`idarticulo`) REFERENCES `articulos` (`idarticulo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos_has_articulos`
--

LOCK TABLES `pedidos_has_articulos` WRITE;
/*!40000 ALTER TABLE `pedidos_has_articulos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos_has_articulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) NOT NULL,
  `clave` varchar(45) NOT NULL DEFAULT '123456',
  `activo` int(11) NOT NULL DEFAULT '0',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendedores` (
  `idvendedor` int(11) NOT NULL AUTO_INCREMENT,
  `cod` varchar(45) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idvendedor`,`cod`),
  UNIQUE KEY `cod_UNIQUE` (`cod`),
  KEY `fk_vendedores_usuarios1_idx` (`idusuario`),
  CONSTRAINT `fk_vendedores_usuarios1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedores`
--

LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` VALUES (1,'V-01','Pedro Giacometto',NULL,'2013-08-15 04:06:04'),(2,'V-02','JaimeGonzales',NULL,'2013-08-15 04:06:27'),(3,'V-66','Oscar Serrano',NULL,'2013-08-15 04:06:39'),(4,'V-44','Javier Boullosa',NULL,'2013-08-15 04:07:33'),(7,'V-55','Humberto Humba',NULL,'2013-08-15 04:09:08'),(8,'V-48','Jose Pepe',NULL,'2013-08-15 04:09:08');
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-08-15  1:26:54
