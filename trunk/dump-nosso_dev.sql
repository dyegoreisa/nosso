-- MySQL dump 10.13  Distrib 5.1.41, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: nosso_dev
-- ------------------------------------------------------
-- Server version	5.1.41-3ubuntu12.10-log

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
-- Table structure for table `categoria_operacao_contabil`
--

DROP TABLE IF EXISTS `categoria_operacao_contabil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_operacao_contabil` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_operacao_contabil`
--

LOCK TABLES `categoria_operacao_contabil` WRITE;
/*!40000 ALTER TABLE `categoria_operacao_contabil` DISABLE KEYS */;
INSERT INTO `categoria_operacao_contabil` VALUES (1,'Luz'),(2,'Água'),(3,'Telefone'),(4,'Aluguel'),(5,'Cartão - Dyego'),(6,'Cartão - Vanessa'),(8,'Celular claro'),(9,'Colégio'),(10,'Mercado'),(11,'Fisk'),(12,'Farmácia'),(13,'Condomínio'),(14,'Banco'),(15,'Salário');
/*!40000 ALTER TABLE `categoria_operacao_contabil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medida`
--

DROP TABLE IF EXISTS `medida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medida` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(10) unsigned NOT NULL,
  `data` date NOT NULL,
  `altura` float DEFAULT NULL,
  `peso` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_medida_1` (`pessoa_id`),
  CONSTRAINT `fk_medida_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medida`
--

LOCK TABLES `medida` WRITE;
/*!40000 ALTER TABLE `medida` DISABLE KEYS */;
INSERT INTO `medida` VALUES (3,1,'2011-03-23',1.73,122);
/*!40000 ALTER TABLE `medida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operacao_contabil`
--

DROP TABLE IF EXISTS `operacao_contabil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operacao_contabil` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_operacao_contabil_id` int(10) unsigned NOT NULL,
  `categoria_operacao_contabil_id` int(10) NOT NULL,
  `vencimento` date NOT NULL,
  `protocolo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_operacao_contabil_3` (`tipo_operacao_contabil_id`),
  KEY `fk_operacao_contabil_1` (`categoria_operacao_contabil_id`),
  CONSTRAINT `fk_operacao_contabil_1` FOREIGN KEY (`categoria_operacao_contabil_id`) REFERENCES `categoria_operacao_contabil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_operacao_contabil_3` FOREIGN KEY (`tipo_operacao_contabil_id`) REFERENCES `tipo_operacao_contabil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operacao_contabil`
--

LOCK TABLES `operacao_contabil` WRITE;
/*!40000 ALTER TABLE `operacao_contabil` DISABLE KEYS */;
INSERT INTO `operacao_contabil` VALUES (35,15,4,'2011-03-10',''),(36,15,2,'2011-03-26',''),(37,15,6,'2011-03-16',''),(38,15,5,'2011-03-17',''),(39,15,3,'2011-03-15','Débito'),(40,15,3,'2011-03-06','Boleto'),(41,15,3,'2011-03-17','Celular Claro'),(42,15,9,'2011-03-10','Apostila'),(43,15,9,'2011-03-10','Mensalidade'),(44,15,10,'2011-03-07',''),(45,15,11,'2011-03-15',''),(46,15,1,'2011-03-15',''),(48,15,12,'2011-03-11',''),(49,15,14,'2011-03-21','Composição de dívida'),(50,15,14,'2011-03-14','Taxa'),(51,16,15,'2011-03-07',''),(52,15,1,'2011-03-24',''),(53,15,13,'2011-03-24','Luz'),(54,15,4,'2011-03-18','Cartão'),(55,15,4,'2011-03-13','Tela'),(56,15,5,'2011-03-18','Mensalidade');
/*!40000 ALTER TABLE `operacao_contabil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pessoa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `sobrenome` varchar(45) DEFAULT NULL,
  `sexo` enum('Masculino','Feminino') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa`
--

LOCK TABLES `pessoa` WRITE;
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` VALUES (1,'Dyego','Reis de Azevedo','Masculino'),(2,'Vanessa','Azevedo','Feminino'),(3,'Beatriz','Azevedo','Feminino');
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pressao_arterial`
--

DROP TABLE IF EXISTS `pressao_arterial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pressao_arterial` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(10) unsigned NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `sistolica` int(11) NOT NULL,
  `diastolica` int(11) NOT NULL,
  `posicao` enum('Em pé','Sentado','Deitado') NOT NULL DEFAULT 'Sentado',
  `em_atividade` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_pressao_arterial_1` (`pessoa_id`),
  CONSTRAINT `fk_pressao_arterial_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pressao_arterial`
--

LOCK TABLES `pressao_arterial` WRITE;
/*!40000 ALTER TABLE `pressao_arterial` DISABLE KEYS */;
INSERT INTO `pressao_arterial` VALUES (1,1,'2011-03-23','00:31:56',121,90,'Sentado',1),(2,1,'2011-03-23','00:57:43',110,85,'Sentado',1),(3,1,'2011-03-23','01:02:17',111,86,'Em pé',0);
/*!40000 ALTER TABLE `pressao_arterial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_operacao_contabil`
--

DROP TABLE IF EXISTS `status_operacao_contabil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_operacao_contabil` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `operacao_contabil_id` int(10) unsigned NOT NULL,
  `tipo_status_operacao_contabil_id` int(10) unsigned NOT NULL,
  `valor` double NOT NULL,
  `data_inicio` datetime NOT NULL,
  `data_fim` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_status_operacao_contabil_2` (`operacao_contabil_id`),
  KEY `fk_status_operacao_contabil_3` (`tipo_status_operacao_contabil_id`),
  CONSTRAINT `fk_status_operacao_contabil_2` FOREIGN KEY (`operacao_contabil_id`) REFERENCES `operacao_contabil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_status_operacao_contabil_3` FOREIGN KEY (`tipo_status_operacao_contabil_id`) REFERENCES `tipo_status_operacao_contabil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_operacao_contabil`
--

LOCK TABLES `status_operacao_contabil` WRITE;
/*!40000 ALTER TABLE `status_operacao_contabil` DISABLE KEYS */;
INSERT INTO `status_operacao_contabil` VALUES (43,35,1,0,'2011-03-13 00:35:48',NULL),(44,36,1,0,'2011-03-13 00:36:02','2011-03-13 00:36:07'),(45,36,3,69.7,'2011-03-13 00:36:07','2011-03-20 16:45:28'),(46,37,1,0,'2011-03-13 00:36:30','2011-03-13 00:36:37'),(47,37,3,350,'2011-03-13 00:36:37','2011-03-20 16:26:39'),(48,38,3,151.7,'2011-03-13 02:04:38','2011-03-20 16:26:32'),(49,39,3,284.45,'2011-03-13 02:05:46','2011-03-20 16:28:17'),(50,40,1,0,'2011-03-13 02:06:15','2011-03-13 02:06:48'),(51,40,2,83.21,'2011-03-13 02:06:48','2011-03-20 16:28:42'),(52,41,1,83.89,'2011-03-13 02:30:55','2011-03-20 16:29:05'),(53,42,1,25,'2011-03-13 02:32:11','2011-03-20 16:29:26'),(54,43,1,177,'2011-03-13 02:32:46','2011-03-20 16:29:53'),(55,44,3,120,'2011-03-13 02:34:50',NULL),(56,45,1,0,'2011-03-13 02:35:45','2011-03-13 03:00:39'),(57,46,1,0,'2011-03-13 02:36:37','2011-03-13 03:00:57'),(59,48,3,90,'2011-03-13 02:38:47',NULL),(60,49,1,98.01,'2011-03-13 02:39:38',NULL),(61,50,1,19.9,'2011-03-13 02:40:36',NULL),(62,45,2,150,'2011-03-13 03:00:39','2011-03-20 16:30:45'),(63,46,2,163.41,'2011-03-13 03:00:57',NULL),(64,51,4,0,'2011-03-13 03:03:38','2011-03-13 03:03:51'),(65,51,5,0,'2011-03-13 03:03:51','2011-03-19 16:10:23'),(66,53,3,7.3,'2011-03-19 15:21:26','2011-03-20 16:31:25'),(70,51,5,2446.64,'2011-03-19 16:10:23',NULL),(71,54,1,131.73,'2011-03-19 23:04:38','2011-03-19 23:04:58'),(72,54,2,131.73,'2011-03-19 23:04:58','2011-03-19 23:06:56'),(73,54,2,131.73,'2011-03-19 23:06:56','2011-03-19 23:07:10'),(74,54,2,131.73,'2011-03-19 23:07:10',NULL),(75,55,1,210,'2011-03-20 16:10:18','2011-03-20 16:10:28'),(76,55,2,210,'2011-03-20 16:10:28',NULL),(77,56,1,14,'2011-03-20 16:24:50','2011-03-20 16:25:20'),(78,56,2,14,'2011-03-20 16:25:20',NULL),(79,38,2,151.7,'2011-03-20 16:26:32',NULL),(80,37,2,350,'2011-03-20 16:26:39',NULL),(81,39,2,284.45,'2011-03-20 16:28:17',NULL),(82,40,2,83.21,'2011-03-20 16:28:42',NULL),(83,41,2,83.89,'2011-03-20 16:29:05',NULL),(84,42,2,25,'2011-03-20 16:29:26',NULL),(85,43,2,177,'2011-03-20 16:29:53',NULL),(86,45,2,150,'2011-03-20 16:30:45',NULL),(87,53,1,7.3,'2011-03-20 16:31:25',NULL),(88,36,1,69.7,'2011-03-20 16:45:28',NULL);
/*!40000 ALTER TABLE `status_operacao_contabil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_operacao_contabil`
--

DROP TABLE IF EXISTS `tipo_operacao_contabil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_operacao_contabil` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_operacao_contabil`
--

LOCK TABLES `tipo_operacao_contabil` WRITE;
/*!40000 ALTER TABLE `tipo_operacao_contabil` DISABLE KEYS */;
INSERT INTO `tipo_operacao_contabil` VALUES (15,'Saída'),(16,'Entrada');
/*!40000 ALTER TABLE `tipo_operacao_contabil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_status_operacao_contabil`
--

DROP TABLE IF EXISTS `tipo_status_operacao_contabil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_status_operacao_contabil` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_operacao_contabil_id` int(10) unsigned NOT NULL,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tipo_status_operacao_contabil_tipo_operacao_contabil1` (`tipo_operacao_contabil_id`),
  CONSTRAINT `fk_tipo_status_operacao_contabil_tipo_operacao_contabil1` FOREIGN KEY (`tipo_operacao_contabil_id`) REFERENCES `tipo_operacao_contabil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_status_operacao_contabil`
--

LOCK TABLES `tipo_status_operacao_contabil` WRITE;
/*!40000 ALTER TABLE `tipo_status_operacao_contabil` DISABLE KEYS */;
INSERT INTO `tipo_status_operacao_contabil` VALUES (1,15,'A pagar'),(2,15,'Pago'),(3,15,'Estimativa'),(4,16,'A receber'),(5,16,'Recebido');
/*!40000 ALTER TABLE `tipo_status_operacao_contabil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(10) unsigned NOT NULL,
  `login` varchar(45) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  KEY `fk_usuario_pessoa` (`pessoa_id`),
  CONSTRAINT `fk_usuario_pessoa` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,1,'dyego','202cb962ac59075b964b07152d234b70');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-03-23  1:11:14
