-- MySQL dump 10.13  Distrib 5.1.41, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: nosso
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
-- Table structure for table `cardapio`
--

DROP TABLE IF EXISTS `cardapio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cardapio` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(10) unsigned NOT NULL,
  `nome` varchar(45) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cardapio_1` (`pessoa_id`),
  CONSTRAINT `fk_cardapio_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cardapio`
--

LOCK TABLES `cardapio` WRITE;
/*!40000 ALTER TABLE `cardapio` DISABLE KEYS */;
/*!40000 ALTER TABLE `cardapio` ENABLE KEYS */;
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
  `cardapio_id` int(10) unsigned NOT NULL,
  `data` date NOT NULL,
  `altura` float DEFAULT NULL,
  `peso` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_medida_1` (`pessoa_id`),
  KEY `fk_medida_2` (`cardapio_id`),
  CONSTRAINT `fk_medida_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_medida_2` FOREIGN KEY (`cardapio_id`) REFERENCES `cardapio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medida`
--

LOCK TABLES `medida` WRITE;
/*!40000 ALTER TABLE `medida` DISABLE KEYS */;
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
  `valor` double NOT NULL,
  `vencimento` date NOT NULL,
  `protocolo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_operacao_contabil_3` (`tipo_operacao_contabil_id`),
  CONSTRAINT `fk_operacao_contabil_3` FOREIGN KEY (`tipo_operacao_contabil_id`) REFERENCES `tipo_operacao_contabil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operacao_contabil`
--

LOCK TABLES `operacao_contabil` WRITE;
/*!40000 ALTER TABLE `operacao_contabil` DISABLE KEYS */;
INSERT INTO `operacao_contabil` VALUES (7,4,450,'2011-10-03',''),(8,11,150,'2011-03-18','Março/2011'),(11,12,111,'2011-03-10',''),(12,9,178,'2011-03-10','Março/2011'),(13,10,6,'2011-03-25','teste');
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
-- Table structure for table `prato`
--

DROP TABLE IF EXISTS `prato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prato` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(10) unsigned NOT NULL,
  `nome` varchar(45) NOT NULL,
  `descricao` text NOT NULL,
  `caloria` float DEFAULT NULL,
  `carboidrato` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_prato_1` (`pessoa_id`),
  CONSTRAINT `fk_prato_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prato`
--

LOCK TABLES `prato` WRITE;
/*!40000 ALTER TABLE `prato` DISABLE KEYS */;
/*!40000 ALTER TABLE `prato` ENABLE KEYS */;
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
  `data_inicio` datetime NOT NULL,
  `data_fim` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_status_operacao_contabil_2` (`operacao_contabil_id`),
  KEY `fk_status_operacao_contabil_3` (`tipo_status_operacao_contabil_id`),
  CONSTRAINT `fk_status_operacao_contabil_2` FOREIGN KEY (`operacao_contabil_id`) REFERENCES `operacao_contabil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_status_operacao_contabil_3` FOREIGN KEY (`tipo_status_operacao_contabil_id`) REFERENCES `tipo_status_operacao_contabil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_operacao_contabil`
--

LOCK TABLES `status_operacao_contabil` WRITE;
/*!40000 ALTER TABLE `status_operacao_contabil` DISABLE KEYS */;
INSERT INTO `status_operacao_contabil` VALUES (2,7,1,'2011-03-08 00:00:00',NULL),(3,8,1,'2011-03-08 00:00:00',NULL),(6,11,1,'2011-03-08 00:00:00','2011-03-09 23:45:07'),(7,12,1,'2011-03-08 00:00:00','2011-03-09 23:45:56'),(8,13,1,'2011-03-09 23:07:05','2011-03-09 23:45:41'),(9,11,3,'2011-03-09 23:45:07',NULL),(10,13,3,'2011-03-09 23:45:41',NULL),(11,12,2,'2011-03-09 23:45:56',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_operacao_contabil`
--

LOCK TABLES `tipo_operacao_contabil` WRITE;
/*!40000 ALTER TABLE `tipo_operacao_contabil` DISABLE KEYS */;
INSERT INTO `tipo_operacao_contabil` VALUES (1,'Luz'),(2,'Água'),(3,'Telefone'),(4,'Aluguel'),(5,'Cartão - Dyego'),(6,'Cartão - Vanessa'),(7,'Telefone'),(8,'Celular claro'),(9,'Colégio'),(10,'Mercado'),(11,'Fisk'),(12,'Farmácia'),(13,'Condomínio - Luz');
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
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_status_operacao_contabil`
--

LOCK TABLES `tipo_status_operacao_contabil` WRITE;
/*!40000 ALTER TABLE `tipo_status_operacao_contabil` DISABLE KEYS */;
INSERT INTO `tipo_status_operacao_contabil` VALUES (1,'A pagar'),(2,'Pago'),(3,'Estimativa');
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
  CONSTRAINT `fk_usuario_pessoa` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
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

-- Dump completed on 2011-03-09 23:50:56
