-- MySQL dump 10.13  Distrib 5.1.41, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: nosso
-- ------------------------------------------------------
-- Server version	5.1.41-3ubuntu12.10

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
-- Table structure for table `alimento`
--

DROP TABLE IF EXISTS `alimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alimento` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `marca` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `imagem`
--

DROP TABLE IF EXISTS `imagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagem` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imagem` longblob NOT NULL,
  `mime_type` varchar(45) NOT NULL,
  `data_atualizacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `medida`
--

DROP TABLE IF EXISTS `medida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medida` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(10) unsigned NOT NULL,
  `imagem_frente_id` int(10) unsigned DEFAULT NULL,
  `imagem_lado_id` int(10) unsigned DEFAULT NULL,
  `data` date NOT NULL,
  `altura` float DEFAULT NULL,
  `peso` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_medida_1` (`pessoa_id`),
  KEY `imagem_frente_id` (`imagem_frente_id`),
  KEY `imagem_lado_id` (`imagem_lado_id`),
  CONSTRAINT `medida_ibfk_2` FOREIGN KEY (`imagem_lado_id`) REFERENCES `imagem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_medida_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `medida_ibfk_1` FOREIGN KEY (`imagem_frente_id`) REFERENCES `imagem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  KEY `fk_meta_peso_1` (`pessoa_id`),
  CONSTRAINT `fk_meta_peso_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `parcelamento_id` char(32) DEFAULT NULL,
  `vencimento` date NOT NULL,
  `protocolo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_operacao_contabil_3` (`tipo_operacao_contabil_id`),
  KEY `fk_operacao_contabil_1` (`categoria_operacao_contabil_id`),
  CONSTRAINT `fk_operacao_contabil_1` FOREIGN KEY (`categoria_operacao_contabil_id`) REFERENCES `categoria_operacao_contabil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_operacao_contabil_3` FOREIGN KEY (`tipo_operacao_contabil_id`) REFERENCES `tipo_operacao_contabil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pessoa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imagem_id` int(10) unsigned DEFAULT NULL,
  `nome` varchar(45) NOT NULL,
  `sobrenome` varchar(45) DEFAULT NULL,
  `sexo` enum('Masculino','Feminino') NOT NULL,
  `tipo_osseo` enum('fino','médio','largo') NOT NULL DEFAULT 'largo',
  PRIMARY KEY (`id`),
  KEY `imagem_id` (`imagem_id`),
  CONSTRAINT `pessoa_ibfk_1` FOREIGN KEY (`imagem_id`) REFERENCES `imagem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `receituario`
--

DROP TABLE IF EXISTS `receituario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receituario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(10) unsigned NOT NULL,
  `sintomas` text NOT NULL,
  `data_sintoma` date NOT NULL,
  `medicacao` text,
  `data_melhora` date DEFAULT NULL,
  `funcionou` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_receita_1` (`pessoa_id`),
  CONSTRAINT `fk_receita_1` FOREIGN KEY (`pessoa_id`) REFERENCES `nosso_dev`.`pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-12-04 15:01:17
