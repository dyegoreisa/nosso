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
-- Table structure for table `base_imc`
--

DROP TABLE IF EXISTS `base_imc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `base_imc` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sexo` enum('Masculino','Feminino') NOT NULL,
  `tipo_osseo` enum('fino','médio','largo') NOT NULL,
  `imc` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `base_imc`
--

LOCK TABLES `base_imc` WRITE;
/*!40000 ALTER TABLE `base_imc` DISABLE KEYS */;
/*!40000 ALTER TABLE `base_imc` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medida`
--

LOCK TABLES `medida` WRITE;
/*!40000 ALTER TABLE `medida` DISABLE KEYS */;
INSERT INTO `medida` VALUES (3,1,'2011-03-23',1.73,122),(4,1,'2011-03-20',1.73,123),(5,1,'2011-03-21',1.73,124),(6,1,'2011-03-22',1.73,122),(7,1,'2011-03-25',1.73,120),(8,1,'2011-04-05',1.73,119),(9,5,'2011-04-08',1.81,102),(10,6,'2011-04-08',1.68,55),(11,7,'2011-04-08',1.66,83),(12,8,'2011-04-08',1.78,120),(13,4,'2011-04-10',1.5,100),(14,4,'2011-04-11',1.5,90),(15,4,'2011-04-12',1.5,80),(16,4,'2011-04-13',1.5,70),(17,4,'2011-04-14',1.5,60),(18,4,'2011-04-15',1.5,50),(19,1,'2011-04-15',1.73,112);
/*!40000 ALTER TABLE `medida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meta`
--

DROP TABLE IF EXISTS `meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(10) unsigned NOT NULL,
  `data` date NOT NULL,
  `altura` float NOT NULL,
  `peso` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_meta_1` (`pessoa_id`),
  CONSTRAINT `fk_meta_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meta`
--

LOCK TABLES `meta` WRITE;
/*!40000 ALTER TABLE `meta` DISABLE KEYS */;
INSERT INTO `meta` VALUES (1,1,'2011-12-24',1.73,95),(3,4,'2011-04-16',1.5,50);
/*!40000 ALTER TABLE `meta` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operacao_contabil`
--

LOCK TABLES `operacao_contabil` WRITE;
/*!40000 ALTER TABLE `operacao_contabil` DISABLE KEYS */;
INSERT INTO `operacao_contabil` VALUES (1,16,15,'2011-03-01',''),(2,15,1,'2011-03-07',''),(3,15,2,'2011-03-09',''),(4,16,15,'2011-04-01',''),(5,15,2,'2011-04-05',''),(6,15,1,'2011-04-07','');
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
  `nome` varchar(45) NOT NULL,
  `sobrenome` varchar(45) DEFAULT NULL,
  `sexo` enum('Masculino','Feminino') NOT NULL,
  `tipo_osseo` enum('fino','médio','largo') NOT NULL DEFAULT 'largo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa`
--

LOCK TABLES `pessoa` WRITE;
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` VALUES (1,'Dyego','Reis de Azevedo','Masculino','largo'),(2,'Vanessa','Azevedo','Feminino','largo'),(3,'Beatriz','Azevedo','Feminino','largo'),(4,'palermo','foo','Masculino','largo'),(5,'William','Machado','Masculino','largo'),(6,'Luciana','Pinna','Feminino','fino'),(7,'Sherman','Gray','Masculino','largo'),(8,'Allen','Franco','Masculino','largo');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pressao_arterial`
--

LOCK TABLES `pressao_arterial` WRITE;
/*!40000 ALTER TABLE `pressao_arterial` DISABLE KEYS */;
INSERT INTO `pressao_arterial` VALUES (1,1,'2011-03-23','00:31:56',121,90,'Sentado',1),(2,1,'2011-03-23','00:57:43',110,85,'Sentado',1),(3,1,'2011-03-23','01:02:17',111,86,'Em pé',0),(4,1,'2011-03-24','17:51:02',135,80,'Sentado',0),(5,1,'2011-03-22','17:51:25',120,75,'Sentado',0),(6,1,'2011-04-05','18:10:32',140,90,'Em pé',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_operacao_contabil`
--

LOCK TABLES `status_operacao_contabil` WRITE;
/*!40000 ALTER TABLE `status_operacao_contabil` DISABLE KEYS */;
INSERT INTO `status_operacao_contabil` VALUES (1,1,4,2000,'2011-04-29 18:01:18','2011-04-29 18:04:47'),(2,2,1,100,'2011-04-29 18:01:41',NULL),(3,3,1,150,'2011-04-29 18:01:56','2011-04-29 18:05:24'),(4,4,4,2000,'2011-04-29 18:02:15','2011-04-29 18:05:13'),(5,5,1,120,'2011-04-29 18:02:33',NULL),(6,6,1,90,'2011-04-29 18:02:47',NULL),(7,1,5,2000,'2011-04-29 18:04:47',NULL),(8,4,5,2000,'2011-04-29 18:05:13','2011-04-29 18:08:21'),(9,3,2,150,'2011-04-29 18:05:24',NULL),(10,4,4,2000,'2011-04-29 18:08:21','2011-04-29 18:08:26'),(11,4,5,2000,'2011-04-29 18:08:26','2011-04-29 18:12:02'),(12,4,4,2000,'2011-04-29 18:12:02','2011-04-29 18:12:13'),(13,4,5,2000,'2011-04-29 18:12:13','2011-04-29 18:14:19'),(14,4,5,2000,'2011-04-29 18:14:19','2011-04-29 18:14:23'),(15,4,4,2000,'2011-04-29 18:14:23','2011-04-29 18:14:26'),(16,4,5,2000,'2011-04-29 18:14:26',NULL);
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

-- Dump completed on 2011-05-13 18:43:26
