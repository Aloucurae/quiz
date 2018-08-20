-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 192.168.15.9    Database: quiz
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.34-MariaDB-0ubuntu0.18.04.1
CREATE Database `quiz`;
use `quiz`;
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
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `clie_codi` int(11) NOT NULL AUTO_INCREMENT,
  `clie_mail` varchar(150) COLLATE utf8_swedish_ci DEFAULT NULL,
  `clie_nome` varchar(150) COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`clie_codi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'alexj.desantanna@gmail.com','Alex');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz` (
  `quiz_codi` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_titu` varchar(250) COLLATE utf8_swedish_ci DEFAULT NULL,
  `quiz_desc` text COLLATE utf8_swedish_ci,
  `quiz_date` datetime DEFAULT NULL,
  `quiz_usua` int(11) NOT NULL,
  `quiz_ativ` varchar(1) COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`quiz_codi`),
  KEY `fk_quiz_usuarios_idx` (`quiz_usua`),
  CONSTRAINT `fk_quiz_usuarios` FOREIGN KEY (`quiz_usua`) REFERENCES `usuarios` (`usua_codi`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz`
--

LOCK TABLES `quiz` WRITE;
/*!40000 ALTER TABLE `quiz` DISABLE KEYS */;
INSERT INTO `quiz` VALUES (13,'Conhecimentos Gerais','Teste de conhecimento Geral','2018-08-19 12:09:42',1,NULL),(14,'teste de qi','é so um teste mesmo','2018-08-19 12:30:29',1,NULL);
/*!40000 ALTER TABLE `quiz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_clintes`
--

DROP TABLE IF EXISTS `quiz_clintes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz_clintes` (
  `qucl_codi` int(11) NOT NULL AUTO_INCREMENT,
  `qucl_clie` int(11) NOT NULL,
  `qucl_quiz` int(11) NOT NULL,
  `qucl_dini` datetime DEFAULT NULL,
  `qucl_dfim` datetime DEFAULT NULL,
  PRIMARY KEY (`qucl_codi`),
  KEY `fk_quiz_clintes_clientes1_idx` (`qucl_clie`),
  KEY `fk_quiz_clintes_quiz1_idx` (`qucl_quiz`),
  CONSTRAINT `fk_quiz_clintes_clientes1` FOREIGN KEY (`qucl_clie`) REFERENCES `clientes` (`clie_codi`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_quiz_clintes_quiz1` FOREIGN KEY (`qucl_quiz`) REFERENCES `quiz` (`quiz_codi`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_clintes`
--

LOCK TABLES `quiz_clintes` WRITE;
/*!40000 ALTER TABLE `quiz_clintes` DISABLE KEYS */;
INSERT INTO `quiz_clintes` VALUES (2,1,13,'2018-08-19 17:11:55','2018-08-19 17:12:02'),(3,1,14,'2018-08-19 17:12:55','2018-08-19 17:12:58'),(4,1,13,'2018-08-19 17:15:23','2018-08-19 17:15:38');
/*!40000 ALTER TABLE `quiz_clintes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_perguntas`
--

DROP TABLE IF EXISTS `quiz_perguntas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz_perguntas` (
  `qupe_codi` int(11) NOT NULL AUTO_INCREMENT,
  `qupe_desc` varchar(150) COLLATE utf8_swedish_ci DEFAULT NULL,
  `qupe_quiz` int(11) NOT NULL,
  `qupe_ativ` varchar(1) COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`qupe_codi`),
  KEY `fk_quiz_respostas_quiz1_idx` (`qupe_quiz`),
  CONSTRAINT `fk_quiz_respostas_quiz1` FOREIGN KEY (`qupe_quiz`) REFERENCES `quiz` (`quiz_codi`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_perguntas`
--

LOCK TABLES `quiz_perguntas` WRITE;
/*!40000 ALTER TABLE `quiz_perguntas` DISABLE KEYS */;
INSERT INTO `quiz_perguntas` VALUES (21,'Qual é a ultima Versão do Android?',13,'A'),(22,'Qual era a cor original do Hulk',13,'A'),(23,'Quais são as engines para rodar o PHP?',13,'A'),(24,'Quanto é 15*2',14,'A');
/*!40000 ALTER TABLE `quiz_perguntas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respostas`
--

DROP TABLE IF EXISTS `respostas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `respostas` (
  `resp_codi` int(11) NOT NULL AUTO_INCREMENT,
  `resp_qupe` int(11) NOT NULL,
  `resp_desc` varchar(150) COLLATE utf8_swedish_ci DEFAULT NULL,
  `resp_verd` int(11) DEFAULT NULL COMMENT 'resposta verdaddeira 1 falsa 0',
  `resp_ativ` varchar(1) COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`resp_codi`),
  KEY `fk_respostas_quiz_perguntas1_idx` (`resp_qupe`),
  CONSTRAINT `fk_respostas_quiz_perguntas1` FOREIGN KEY (`resp_qupe`) REFERENCES `quiz_perguntas` (`qupe_codi`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respostas`
--

LOCK TABLES `respostas` WRITE;
/*!40000 ALTER TABLE `respostas` DISABLE KEYS */;
INSERT INTO `respostas` VALUES (118,21,'Picolé',0,'A'),(119,21,'Smore',0,'A'),(120,21,'Oreo',1,'A'),(121,21,'Marshmallow',0,'A'),(122,22,'Laranja',0,'A'),(123,22,'Vermelho',0,'A'),(124,22,'Cinza',1,'A'),(125,22,'Verde',0,'A'),(126,23,'Anguar',0,'A'),(127,23,'Jquery',0,'A'),(128,23,'Apache',1,'A'),(129,23,'Nginx',1,'A'),(130,23,'NodeJS',0,'A'),(131,24,'50',0,'A'),(132,24,'95',0,'A'),(133,24,'32',0,'A'),(134,24,'30',1,'A');
/*!40000 ALTER TABLE `respostas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respostas_clientes`
--

DROP TABLE IF EXISTS `respostas_clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `respostas_clientes` (
  `recl_resp` int(11) NOT NULL,
  `recl_codi` int(11) NOT NULL AUTO_INCREMENT,
  `recl_qucl` int(11) NOT NULL,
  PRIMARY KEY (`recl_codi`),
  KEY `fk_respostas_clientes_respostas1_idx` (`recl_resp`),
  KEY `fk_respostas_clientes_quiz_clintes1_idx` (`recl_qucl`),
  CONSTRAINT `fk_respostas_clientes_respostas1` FOREIGN KEY (`recl_resp`) REFERENCES `respostas` (`resp_codi`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respostas_clientes`
--

LOCK TABLES `respostas_clientes` WRITE;
/*!40000 ALTER TABLE `respostas_clientes` DISABLE KEYS */;
INSERT INTO `respostas_clientes` VALUES (120,36,2),(124,37,2),(128,38,2),(129,39,2),(134,40,3),(120,41,4),(124,42,4),(126,43,4);
/*!40000 ALTER TABLE `respostas_clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `usua_codi` int(11) NOT NULL AUTO_INCREMENT,
  `usua_nome` varchar(150) COLLATE utf8_swedish_ci DEFAULT NULL,
  `usua_logi` varchar(150) COLLATE utf8_swedish_ci DEFAULT NULL,
  `usua_senh` varchar(150) COLLATE utf8_swedish_ci DEFAULT NULL,
  `usua_mail` varchar(150) COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`usua_codi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Trezo','trezo','trezo',NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-19 23:04:08
