-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: solicitasi
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

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
-- Table structure for table `administradores`
--

DROP TABLE IF EXISTS `administradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `login` varchar(10) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `tipo` varchar(1) NOT NULL,
  `email` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administradores`
--

LOCK TABLES `administradores` WRITE;
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;
INSERT INTO `administradores` VALUES (1,'leonardo','leo','123','A','leo@dcc.ic.uff.br');
/*!40000 ALTER TABLE `administradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alunos`
--

DROP TABLE IF EXISTS `alunos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alunos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `matricula` varchar(10) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(10) DEFAULT NULL,
  `alterada` varchar(1) NOT NULL DEFAULT 'N',
  `obs` text,
  `telefone1` varchar(15) DEFAULT NULL,
  `telefone2` varchar(15) DEFAULT NULL,
  `endereco` varchar(120) DEFAULT NULL,
  `bairro` varchar(30) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `cpf` varchar(14) NOT NULL,
  `explica` text,
  `tcc_etapa1` varchar(1) NOT NULL DEFAULT 'I',
  `tcc_etapa2` varchar(1) DEFAULT 'I',
  `tcc_etapa3` varchar(1) NOT NULL DEFAULT 'I',
  `tcc_etapa4` varchar(1) NOT NULL DEFAULT 'I',
  `tcc_etapa5` varchar(1) NOT NULL DEFAULT 'I',
  `status` varchar(1) NOT NULL DEFAULT 'A',
  `empresa` varchar(30) DEFAULT NULL,
  `funcao` varchar(30) DEFAULT NULL,
  `depoimento` text,
  `codigo` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `matricula` (`matricula`),
  KEY `matricula_2` (`matricula`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alunos`
--

LOCK TABLES `alunos` WRITE;
/*!40000 ALTER TABLE `alunos` DISABLE KEYS */;
INSERT INTO `alunos` VALUES (1,'WILSON TELES MARCOLIN JUNIOR','114083045','wjmarcolin@hotmail.com','123','N','','','(21)8286-4044','RUA \nEXPEDICIONÁRIO RUBEN DE SOUZA','RIO DO OURO','SÃO GONÇALO','24752-340','RJ','160.258.367-60',NULL,'S','I','I','I','I','A',NULL,NULL,NULL,NULL),(2,'TESTE','123456789','teste@teste.com','123','N',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'275.518.640-24',NULL,'I','I','I','I','I','A',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `alunos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classroom`
--

DROP TABLE IF EXISTS `classroom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classroom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `campus` varchar(100) DEFAULT NULL,
  `building` varchar(100) DEFAULT NULL,
  `number` varchar(100) DEFAULT NULL,
  `maps_info` text,
  `address` varchar(100) DEFAULT NULL,
  `period_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `classroom_teacher_FK` (`teacher_id`),
  KEY `classroom_subject_FK` (`subject_id`),
  KEY `classroom_period_FK` (`period_id`),
  CONSTRAINT `classroom_period_FK` FOREIGN KEY (`period_id`) REFERENCES `period` (`id`),
  CONSTRAINT `classroom_subject_FK` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  CONSTRAINT `classroom_teacher_FK` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classroom`
--

LOCK TABLES `classroom` WRITE;
/*!40000 ALTER TABLE `classroom` DISABLE KEYS */;
INSERT INTO `classroom` VALUES (1,1,1,'Praia Vermelha','Instituto de Computação','302','<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3675.2396137396113!2d-43.1351176854005!3d-22.904531243548053!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x99817dce2f93eb%3A0x9e97773b91b93bba!2sUFF+-+Campus+Praia+Vermelha!5e0!3m2!1spt-BR!2sbr!4v1553959827250!5m2!1spt-BR!2sbr\" width=\"400\" height=\"300\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>','rua lele',1),(2,2,3,'Praia Vermelha','Instituto de Computação','306','<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3675.2396137396113!2d-43.1351176854005!3d-22.904531243548053!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x99817dce2f93eb%3A0x9e97773b91b93bba!2sUFF+-+Campus+Praia+Vermelha!5e0!3m2!1spt-BR!2sbr!4v1553959827250!5m2!1spt-BR!2sbr\" width=\"400\" height=\"300\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>','rua lele',1),(3,3,2,'Praia Vermelha','Instituto de Computação','202','<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3675.2396137396113!2d-43.1351176854005!3d-22.904531243548053!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x99817dce2f93eb%3A0x9e97773b91b93bba!2sUFF+-+Campus+Praia+Vermelha!5e0!3m2!1spt-BR!2sbr!4v1553959827250!5m2!1spt-BR!2sbr\" width=\"400\" height=\"300\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>','rua haha',1);
/*!40000 ALTER TABLE `classroom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classroom_week_day`
--

DROP TABLE IF EXISTS `classroom_week_day`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classroom_week_day` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classroom_id` int(11) NOT NULL,
  `week_day_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `classroom_week_day_classroom_FK` (`classroom_id`),
  KEY `classroom_week_day_week_day_FK` (`week_day_id`),
  CONSTRAINT `classroom_week_day_classroom_FK` FOREIGN KEY (`classroom_id`) REFERENCES `classroom` (`id`),
  CONSTRAINT `classroom_week_day_week_day_FK` FOREIGN KEY (`week_day_id`) REFERENCES `week_day` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classroom_week_day`
--

LOCK TABLES `classroom_week_day` WRITE;
/*!40000 ALTER TABLE `classroom_week_day` DISABLE KEYS */;
INSERT INTO `classroom_week_day` VALUES (24,2,4,'18:01:00','22:01:00'),(27,1,2,'18:00:00','20:00:00'),(28,1,4,'18:00:00','20:00:00'),(29,3,3,'18:00:00','20:00:00'),(30,3,5,'18:00:00','20:00:00');
/*!40000 ALTER TABLE `classroom_week_day` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `dt_final_ajuste` date DEFAULT NULL,
  `envia_email` varchar(1) NOT NULL DEFAULT 'S',
  `manutencao` varchar(1) NOT NULL,
  `semestreano` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES ('2019-03-31','S','N','12019');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disciplinas`
--

DROP TABLE IF EXISTS `disciplinas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disciplinas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_disc` varchar(8) NOT NULL,
  `tipo` varchar(3) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `periodo` int(11) NOT NULL DEFAULT '1',
  `curricular` varchar(1) NOT NULL DEFAULT 'C',
  `aprovada` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=225 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disciplinas`
--

LOCK TABLES `disciplinas` WRITE;
/*!40000 ALTER TABLE `disciplinas` DISABLE KEYS */;
INSERT INTO `disciplinas` VALUES (1,'GLC00292','O','LIBRAS I',0,'C','N'),(2,'TCC00245','O','TÓPICOS EM BANCO DE DADOS II',0,'C','N'),(3,'TCC00246','O','TÓPICOS EM BANCO DE DADOS III',0,'C','N'),(4,'TCC00247','O','TÓPICOS EM COMPILADORES I',0,'C','N'),(5,'TCC00248','O','TÓPICOS EM COMPILADORES II',0,'C','N'),(6,'TCC00249','O','TÓPICOS EM COMPILADORES III',0,'C','N'),(7,'TCC00250','O','TÓPICOS EM ENGENHARIA DE SOFWARE I',0,'C','N'),(8,'TCC00251','O','TÓPICOS EM ENGENHARIA DE SOFWARE II',0,'C','N'),(9,'TCC00252','O','TÓPICOS EM ENGENHARIA DE SOFWARE III',0,'C','N'),(10,'TCC00253','O','TÓPICOS ESPECIAIS EM SISTEMAS DE PROGRAMAÇÃO I',0,'C','N'),(11,'TCC00254','O','TÓPICOS ESPECIAIS EM SISTEMAS DE PROGRAMAÇÃO II',0,'C','N'),(12,'TCC00255','O','TÓPICOS ESPECIAIS EM SISTEMAS DE PROGRAMAÇÃO \nIII',0,'C','N'),(13,'TCC00256','O','TÓPICOS ESPECIAIS EM SISTEMAS DE PROGRAMAÇÃO IV',0,'C','N'),(14,'TCC00257','O','TÓPICOS ESPECIAIS EM SISTEMAS DE PROGRAMAÇÃO V',0,'C','N'),(15,'TCC00258','O','TÓPICOS ESPECIAIS EM SISTEMAS DE PROGRAMAÇÃO VI',0,'C','N'),(16,'TCC00259','O','TÓPICOS EM INTELIGÊNCIA ARTIFICIAL I',0,'C','N'),(17,'TCC00260','O','TÓPICOS EM INTELIGÊNCIA ARTIFICIAL II',0,'C','N'),(18,'TCC00261','O','TÓPICOS EM INTELIGÊNCIA ARTIFICIAL III',0,'C','N'),(19,'TCC00262','O','TÓPICOS EM INFORMÁTICA NA EDUCAÇÃO I',0,'C','N'),(20,'TCC00263','O','TÓPICOS EM INFORMÁTICA NA EDUCAÇÃO II',0,'C','N'),(21,'TCC00264','O','TÓPICOS EM INFORMÁTICA NA EDUCAÇÃO III',0,'C','N'),(22,'TCC00265','O','TÓPICOS EM INTERFACE HOMEM/MÁQUINA I',0,'C','N'),(23,'TCC00266','O','TÓPICOS EM INTERFACE HOMEM/MÁQUINA II',0,'C','N'),(24,'TCC00267','O','TÓPICOS EM INTERFACE HOMEM/MÁQUINA III',0,'C','N'),(25,'TCC00268','O','TÓPICOS EM MULTIMÍDIA',0,'C','N'),(26,'TCC00269','O','TÓPICOS EM MULTIMÍDIA II',0,'C','N'),(27,'TCC00270','O','TÓPICOS EM MULTIMÍDIA III',0,'C','N'),(28,'TCC00271','O','TÓPICOS LINGUAGEM DE PROGRAMAÇÃO I',0,'C','N'),(29,'TCC00273','O','TÓPICOS LINGUAGEM DE PROGRAMAÇÃO III',0,'C','N'),(30,'TCC00274','O','TÓPICOS EM REDES DE COMPUTADORES I',0,'C','N'),(31,'TCC00275','O','TÓPICOS EM REDES DE COMPUTADORES II',0,'C','N'),(32,'TCC00276','O','TÓPICOS EM REDES DE COMPUTADORES III',0,'C','N'),(33,'GCI00162','O','TÓPICOS ESPECIAIS DE INFORMAÇÃO IV',0,'C','N'),(34,'GCI00163','O','TÓPICOS ESPECIAIS DE INFORMAÇÃO V',0,'C','N'),(35,'TCC00272','O','TÓPICOS LINGUAGEM DE PROGRAMAÇÃO II',0,'C','N'),(36,'TCC00244','O','TÓPICOS EM BANCO DE DADOS I',0,'C','N'),(37,'TCC00234','O','TÓPICOS EM ARQUITETURAS DE COMPUTADORES I',0,'C','N'),(38,'TCC00235','O','TÓPICOS EM ARQUITETURAS DE COMPUTADORES II',0,'C','N'),(39,'TCC00236','O','TÓPICOS EM ARQUITETURAS DE COMPUTADORES III',0,'C','N'),(40,'TCC00237','O','TÓPICOS EM AUTOMAÇÃO I',0,'C','N'),(41,'TCC00238','O','TÓPICOS EM AUTOMAÇÃO II',0,'C','N'),(42,'TCC00239','O','TÓPICOS EM AUTOMAÇÃO III',0,'C','N'),(43,'TCC00240','O','TÓPICOS EM CIÊNCIA DA COMPUTAÇÃO',0,'C','N'),(44,'TCC00241','O','TÓPICOS EM COMPUTAÇÃO I',0,'C','N'),(45,'TCC00242','O','TÓPICOS EM COMPUTAÇÃO II',0,'C','N'),(46,'TCC00243','O','TÓPICOS EM COMPUTAÇÃO III',0,'C','N'),(47,'TCC00173','OB','PROGRAMAÇÃO DE COMPUTADORES I',1,'N','N'),(48,'GMA00108','OB','CÁLCULO I -A-',1,'N','N'),(49,'GAN00170','OB','MATEMÁTICA DISCRETA I',1,'N','N'),(50,'TCC00220','OB','ADMINISTRAÇÃO DE SISTEMAS DE INFORMAÇÃO',1,'N','N'),(51,'TCC00219','OB','INTRODUÇÃO A SISTEMAS DE INFORMAÇÃO',1,'N','N'),(52,'GSI00462','GPI','TÓPICOS ESPECIAIS EM COGNITIVISMO I',2,'C','N'),(53,'TCC00165','OB','FUNDAMENTOS DE ARQUITETURAS DE COMPUTADORES',2,'C','N'),(54,'GAN00171','OB','LÓGICA PARA CIÊNCIA DA COMPUTAÇÃO I',2,'N','N'),(55,'GSI00483','GPI','AMBIENTE,  SAÚDE E TRABALHO',2,'C','N'),(56,'GSI00485','GPI','ERGONOMIA E PSICOLOGIA DO TRABALHO',2,'C','N'),(57,'GSI00487','GPI','PROCESSOS DE PRODUÇÃO E SAÚDE',2,'C','N'),(58,'GSI00356','GPI','TEMAS ATUAIS EM PSICOLOGIA DO TRABALHO',2,'C','N'),(59,'GSI00433','GPI','COMPORTAMENTO ORGANIZACIONAL',2,'C','N'),(60,'GSI00440','GPI','PSICOLOGIA E GESTÃO DE PESSOAS',2,'C','N'),(61,'GSI00442','GPI','PSICOLOGIA E TECNOLOGIA',2,'C','N'),(62,'GSI00448','GPI','ESTUDOS AVANÇADOS EM COGNITIVISMO',2,'C','N'),(63,'GSI00443','GPI','PSICOLOGIA ORGANIZACIONAL',2,'C','N'),(64,'TCC00218','OB','PROGRAMAÇÃO DE COMPUTADORES II PARA SISTEMA DE \nINFORMAÇÃO',2,'C','N'),(65,'GSI00329','GPI','PERCEPÇÃO I',2,'C','N'),(66,'STA00141','OB','MODELOS DE GESTÃO',2,'N','N'),(67,'TCC00171','OB','ESTRUTURA DE DADOS I',3,'N','N'),(68,'GSO00096','O','SOCIOLOGIA DA COMUNICAÇÃO',0,'C','N'),(69,'GSO00097','O','SOCIOLOGIA DA ARTE',0,'C','N'),(70,'GSO00109','O','SOCIOLOGIA DO TRABALHO',0,'C','N'),(71,'GSO00111','O','SOCIOLOGIA DA PÓS-MODERNIDADE',0,'C','N'),(72,'TCC00224','OB','SISTEMAS OPERACIONAIS PARA SISTEMAS DE \nINFORMAÇÃO',3,'C','N'),(73,'GET00122','OB','PROBABILIDADE E ESTATÍSTICA',3,'C','N'),(74,'STA00191','OB','INTELIGÊNCIA DE NEGÓCIOS',3,'C','N'),(75,'TCC00215','OB','ESTRUTURA DE DADOS II',0,'C','N'),(76,'SDV00065','GDI','A JURIDICIDADE DO COMÉRCIO ELETRÔNICO',0,'C','N'),(77,'TCC00167','OB','ANÁLISE E PROJETOS DE ALGORITMOS',0,'C','N'),(78,'TCC00166','OB','BANCO DE DADOS',0,'N','N'),(79,'SDV00067','GDI','TUTELA DOS DIREITOS FUNDAMENTAIS E NOVAS \nTECNOLOGIAS DE INFORMAÇÃO',0,'C','N'),(80,'TCC00221','OB','RECURSOS HUMAMOS EM SISTEMAS DE INFORMAÇÃO',0,'N','N'),(81,'SDV00066','GDI','PROPRIEDADE IMATERIAL E INFORMÁTICA',0,'N','N'),(82,'STA00145','OB','ADMINISTRAÇÃO ESTRATÉGICA',0,'N','N'),(83,'TCC00227','OB','REDES DE COMPUTADORES I PARA SISTEMAS DE \nINFORMAÇÃO',0,'C','N'),(84,'TCC00225','OB','ENGENHARIA DE SOFTWARE',0,'C','N'),(85,'TCC00226','OB','DESENVOLVIMENTO WEB',0,'C','N'),(86,'GCI00126','OB','REPRESENTAÇÃO DA INFORMAÇÃO',0,'C','N'),(87,'TCC00184','OB','INTERFACE HOMEM-MÁQUINA',0,'N','N'),(88,'TCC00222','OB','COMPUTAÇÃO E SOCIEDADE PARA SISTEMAS DE \nINFORMAÇÃO',0,'C','N'),(89,'TCC00232','GSI','TÓPICOS ESPECIAIS EM PROJETO E IMPLEMENTAÇÃO DE \nSISTEMAS I',0,'C','N'),(90,'TCC00231','GSI','TÓPICOS ESPECIAIS EM GERÊNCIA DE REDES',0,'C','N'),(91,'TCC00230','GSI','TÓPICOS ESPECIAIS EM SEGURANÇA DA INFORMAÇÃO',0,'C','N'),(92,'TCC00229','GSI','TÓPICOS ESPECIAIS EM GESTÃO DO CONHECIMENTO',0,'C','N'),(93,'TCC00228','OB','REDES DE COMPUTADORES II PARA SISTEMAS DE \nINFORMAÇÃO',0,'C','N'),(94,'GCI00141','OB','LABORAT DE TRAT E RECUP DA INFORMAÇÃO',0,'C','N'),(95,'TCC00233','GSI','TÓPICOS ESPECIAIS EM PROJETO E IMPLEMENTAÇÃO DE \nSISTEMAS II',0,'C','N'),(96,'TCC00211','OB','METODOLOGIA DA PESQUISA CIENTÍFICA',0,'C','N'),(97,'TCC00223','OB','GERÊNCIA DE PROJETOS DE SOFTWARE',0,'N','N'),(98,'TCC00191','OB','PROJETO DE APLICAÇÃO I',0,'N','N'),(99,'TCC00212','OB','EMPREENDEDORISMO',0,'C','N'),(100,'TCC00176','GCI','ALGORITMOS EM GRAFOS',0,'C','N'),(101,'TCC00170','GCI','LINGUAGENS DE PROGRAMAÇÃO',0,'C','N'),(102,'TCC00182','GCI','INTELIGÊNCIA ARTIFICIAL',0,'C','N'),(103,'TCC00172','GCI','PROGRAMAÇÃO CIENTÍFICA',0,'C','N'),(104,'TCC00175','GCI','TÉCNICAS DE PROGRAMAÇÃO AVANÇADA',0,'N','N'),(105,'TCC00178','GCI','LINGUAGENS FORMAIS E TEORIA DA COMPUTAÇÃO',0,'C','N'),(106,'TCC00177','GCI','PROJETO DE BANCO DE DADOS',0,'C','N'),(107,'TCC00179','GCI','COMPUTAÇÃO GRÁFICA',0,'C','N'),(108,'TCC00192','OB','PROJETO DE APLICAÇÃO II',0,'N','N'),(109,'TCC00187','GCI','SISTEMAS DISTRIBUÍDOS',0,'C','N'),(110,'TCC00168','GCI','MÉTODOS NUMÉRICOS',0,'C','N'),(111,'TCC00183','GCI','COMPILADORES',0,'C','N'),(114,'TCC00280','OB','COMPUTAÇÃO E MEIO AMBIENTE',3,'C','N'),(115,'TCC00185','E','REDES DE COMPUTADORES I',0,'N','N'),(116,'GEF00026','E','MUSCULAÇÃO',0,'N','N'),(117,'GAN00167','E','MATEMÁTICA DISCRETA',0,'C','N'),(118,'GSO00190','E','SOCIOLOGIA DA EDUCAÇÃO',0,'N','N'),(119,'TCC00189','E','COMPUTAÇÃO E SOCIEDADE',0,'N','N'),(120,'TCC04135','O','TOP.EM MATEMATICA PARA COMPUTACAO I',0,'C','N'),(123,'GAP00158','E','ANTROPOLOGIA E IMAGEM',0,'N','N'),(126,'GEF00027','E','NATAO I ( APRENDIZAGEM)',1,'N','N'),(127,'TEP00111',NULL,'GERENCIAMENTO DE PROJETOS I',1,'C','N'),(128,'GAN00166','OB','LÓGICA PARA A CIÊNCIA DA COMPUTAÇÃO',1,'C','N'),(129,'TCC00180',NULL,'ENGENHARIA DE SOFTWARE I',1,'N','N'),(130,'TCC00186',NULL,'REDES DE COMPUTADORES II',1,'N','N'),(131,'GFI00158',NULL,'FISICA I',1,'C','N'),(132,'STT00098',NULL,'EMPREENDEDORISMO I',1,'C','N'),(133,'TCC00188',NULL,'SISTEMAS OPERACIONAIS',1,'N','N'),(134,'TCC00202',NULL,'VISUALIZAO, SIMULAO E JOGOS DIGITAIS',1,'C','N'),(135,'STA00147','OB','COMUNICAÇÃO',0,'N','N'),(136,'STA00165',NULL,'GESTO DE SISTEMA DE INFORMAO',1,'C','N'),(137,'STA00148',NULL,'MTODOS E TCNICAS DE ESTUDO',1,'C','N'),(138,'STA00175',NULL,'GESTO DE PROJETOS',1,'C','N'),(139,'STE00029','O','CRIATIVIDADE E ATITUDE EMPREENDEDORA',1,'C','N'),(140,'STE00035','OB','GESTÃO DE PESSOAS',1,'C','N'),(141,'SDV00093',NULL,'DIREITO E INFORMTICA',1,'C','N'),(142,'STE00038','OB','MODELOS DE GESTÃO CONTEMPORÂNEA',2,'C','N'),(143,'STE00037','OB','ADMINISTRAÇÃO ESTRATÉGICA CONTEMPORÂNEA',5,'C','N'),(144,'GMA00019','OB','CÁLCULO I-A',1,'N','N'),(145,'TCC00324','OB','GOVERNANÇA EM TECNOLOGIA DA INFORMAO',1,'C','N'),(146,'TCC00327',NULL,'QUALIDADE E TESTE',1,'C','N'),(147,'TCC00318',NULL,'PESQUISA OPERACIONAL',1,'C','N'),(148,'TCC00296',NULL,'FUNDAMENTOS DE ARQUITETURAS DE COMPUTADORES',1,'C','N'),(149,'GEF00025','OB','JUDO',1,'C','N'),(150,'TCC00320',NULL,'INTRODUO A PROJETO DE BANCO DE DADOS',1,'C','N'),(151,'TEC00209',NULL,'PROPRIEDADE INDUSTRIAL',1,'C','N'),(152,'TCC00303','OB','LABORATÓRIO DE PROGRAMAÇÃO WEB',1,'C','N'),(153,'STE00014','OB','INOVAÇÃO NAS ORGANIZAÇÕES',1,'C','N'),(154,'TCC00200','OB','MINERAÇAO DE DADOS',1,'C','N'),(155,'SPP00099',NULL,'PROCESSO ELETRNICO',1,'C','N'),(156,'GET00137',NULL,'METODOLOGIA DA PESQUISA CIENTFICA',1,'N','N'),(157,'TCC00322',NULL,'PROGRAMAO DE COMPUTADORES IV',1,'C','N'),(158,'TCC00330','O','MODELAGEM DE PROCESSO DE NEGÓCIO',0,'C','N'),(159,'TCC00329','O','FUNDAMENTOS MATEMÁTICOS PARA COMPUTAÇÃO',0,'C','N'),(160,'STA00216','O','NEGOCIAÇÃO',0,'C','N'),(161,'STA00186','O','GESTÃO DO CONHECIMENTO',0,'C','N'),(162,'STA00168','O','DESENVOLVIMENTO DE PESSOAS',0,'C','N'),(163,'TCC00308',NULL,'PROGRAMAO DE COMPUTADORES I',1,'C','N'),(164,'TCC00328',NULL,'PROGRAMAO ORIENTADA  OBJETOS',1,'C','N'),(165,'TCC00332','OB','FUNDAMENTOS DE SISTEMAS DE INFORMAÇÃO',1,'C','N'),(166,'CGI00004','OB','SEMINÁRIOS EM SISTEMAS DE INFORMAÇÃO',1,'C','N'),(167,'TCC00333','OB','TEORIA DA COMPUTAÇÃO PARA SISTEMAS DE \nINFORMAÇÃO',0,'C','N'),(168,'TCC00331','OB','ESTRUTURAS DE DADOS PARA SISTEMAS DE \nINFORMAÇÃO',3,'C','N'),(169,'SDV00143','OB','PROPRIEDADE INTELECTUAL',3,'C','N'),(170,'TCC00334','OB','PRINCÍPIOS DE BANCO DE DADOS',4,'C','N'),(171,'TCC00335','OB','PROJETO DE BANCO DE DADOS PARA SISTEMAS DE \nINFORMAÇÃO',5,'C','N'),(172,'TCC00336','OB','BANCOS DE DADOS NÃO CONVENCIONAIS',6,'C','N'),(173,'TCC00337','OB','INTRODUÇÃO A INTERAÇÃO HUMANO-COMPUTADOR',6,'C','N'),(174,'TCC00338','OB','PROJETO DE SOFTWARE',6,'C','N'),(175,'TCC00340','OB','DESENVOLVIMENTO DE APLICAÇÕES CORPORATIVAS',7,'C','N'),(176,'TCC00339','OB','GERÊNCIA DE PROJETOS E MANUTENÇÃO DE SOFTWARE',7,'C','N'),(177,'TCC00341','OB','SEGURANÇA DA INFORMAÇÃO',7,'C','N'),(178,'GAN00144','OB','COMPLEMENTOS DE MATEMATICA APLICADA',1,'C','N'),(179,'TCC00217','O','INTRODUCAO AOS MICROCONTROLADORES',1,'C','N'),(180,'TCC00287',NULL,'BANCO DE DADOS I',1,'C','N'),(181,'TEP00108','O','ADMINISTRACAO APLICADA A ENGENHARIA',1,'C','N'),(182,'TEP00124','O','CIENCIA E TECNOLOGIA',1,'C','N'),(183,'CGI00002','OB','PROJETO DE APLICACAO I',1,'N','N'),(184,'CGI00003','OB','PROJETO DE APLICACAO II',1,'N','N'),(185,'TCC00181',NULL,'ENGENHARIA DE SOFTWARE II',1,'N','N'),(186,'TEP00006',NULL,'EMPREENDEDORISMO',1,'C','N'),(187,'TCC00288',NULL,'BANCO DE DADOS II',1,'C','N'),(188,'TCC00292',NULL,'ENGENHARIA DE SOFTWARE I',1,'C','N'),(189,'TCC00313',NULL,'REDES DE COMPUTADORES I',1,'C','N'),(190,'TCC00300','O','LABORATÓRIO DE PROGRAMAÇÃO DE DISPOSITIVOS \nMÓVEIS',0,'C','N'),(191,'TCC00316','OB','SISTEMAS OPERACIONAIS',0,'C','N'),(192,'TCC00293',NULL,'ENGENHARIA DE SOFTWARE II',1,'C','N'),(193,'TCC00314',NULL,'REDES DE COMPUTADORES II',1,'C','N'),(194,'STE00039','O','MODELAGEM DE NEGÓCIOS',0,'N','N'),(195,'STE00041','O','PROCESSO DECISÓRIO NAS ORGANIZAÇÕES',0,'C','N'),(196,'STE00005','O','COMUNICAÇÃO EMPRESARIAL',0,'N','N'),(197,'TCC00312','OB','PROJETO DE SOFTWARE',0,'C','N'),(198,'TCC00349','O','AVALIAÇÃO DE DESEMPENHO',0,'C','N'),(199,'TCC00347','OB','PROGRAMAÇÃO ESTRUTURADA',0,'C','N'),(200,'TCC00348','OB','ESTRUTURAS DE DADOS E SEUS ALGORITIMOS',0,'C','N'),(201,'GEC00530','OB','HISTORIA E TEORIA DOS GAMES I',1,'C','N'),(203,'TEP00110','O','ENGENHARIA ECONOMICA',0,'N','N'),(204,'STE00016','O','AVALIAÇÃO DE INVESTIMENTOS',0,'N','N'),(205,'STE00023','O','CENÁRIOS E TENDÊNCIAS',0,'N','N'),(206,'STE00007','O','ECONOMIA',0,'C','N'),(207,'STE00028','O','GESTÃO DA MUDANÇA ORGANIZACIONAL',0,'N','N'),(208,'STE00018','O','GESTÃO DE PROJETOS',0,'C','N'),(209,'TCC00301','OB','LABORATÓRIO DE PROGRAMAÇÃO DE JOGOS',0,'C','N'),(210,'TCC00298',NULL,'INTERFACE HOMEM-MQUINA',1,'C','N'),(211,'TCC00297',NULL,'INTELIGNCIA ARTIFICIAL',1,'C','N'),(212,'GEF00020',NULL,'CONDICIONAMENTO FSICO',1,'C','N'),(213,'GEF00028',NULL,'NATAO II ( APERFEIOAMENTO)',1,'C','N'),(214,'TET00220',NULL,'GERENCIA E SEGURANCA DE REDES DE COMPUTADORES',1,'C','N'),(215,'GEC00359',NULL,'MUSICA NOS GAMES',1,'C','N'),(217,'CGI00006',NULL,'CONSTRUCAO DE PAGINA WEB',1,'C','N'),(218,'GMA00115',NULL,'MATEMÁTICA BÁSICA',1,'C','N'),(219,'CGI00000',NULL,'OPTATIVA',1,'C','N'),(220,'CGI00000',NULL,'OPTATIVA II',1,'C','N'),(221,'CGI00000',NULL,'OPTATIVA III',1,'C','N'),(222,'TET00210',NULL,'REDES DE COMPUTADORES II',1,'C','N'),(223,'GEF00038',NULL,'YOGA II',1,'C','N'),(224,'TCC00319',NULL,'ESTRUTURAS DE DADOS',1,'C','N');
/*!40000 ALTER TABLE `disciplinas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `period`
--

DROP TABLE IF EXISTS `period`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `period` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `period`
--

LOCK TABLES `period` WRITE;
/*!40000 ALTER TABLE `period` DISABLE KEYS */;
INSERT INTO `period` VALUES (1,'2018/2');
/*!40000 ALTER TABLE `period` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professores`
--

DROP TABLE IF EXISTS `professores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `professores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `img_url` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professores`
--

LOCK TABLES `professores` WRITE;
/*!40000 ALTER TABLE `professores` DISABLE KEYS */;
INSERT INTO `professores` VALUES (1,'Alexandre Plastino','plastino@ic.uff.br',NULL),(2,'Aline de Paula Nascimento','',NULL),(3,'Aline Marins Paes Carvalho','',NULL),(4,'Andréa Magalhães Magdaleno','',NULL),(5,'Anselmo Antunes Montenegro','',NULL),(6,'Antonio Augusto de Aragão Rocha','',NULL),(7,'Aura Conci','',NULL),(8,'Bruno Lopes','',NULL),(9,'Carlos Alberto de Jesus Martinhon','',NULL),(10,'Carlos Alberto Soares Ribeiro','',NULL),(11,'Celso da Cruz Carneiro Ribeiro','',NULL),(12,'Célio Vinicius Neves de Albuquerque','',NULL),(13,'Christiano de Oliveira Braga','',NULL),(14,'Cristina Nader Vasconcelos','',NULL),(15,'Daniel Cardoso Moraes de Oliveira','',NULL),(16,'Daniela Gorski Trevisan','',NULL),(17,'Dante Corbucci Filho','',NULL),(18,'Débora Christina Muchaluat Saade','',NULL),(19,'Diego Gimenez Passos','',NULL),(20,'Esteban Walter Gonzalez Clua','',NULL),(21,'Eugene Francis Vinod Rebello','',NULL),(22,'Fábio Protti','',NULL),(23,'Fernanda Passos','',NULL),(24,'Flávia Cristina Bernardini','',NULL),(25,'Flávio Seixas','',NULL),(26,'Helena Cristina da Gama Leitão','',NULL),(27,'Igor Monteiro Moraes','',NULL),(28,'Isabel Cristina Mello Rosset','',NULL),(29,'Isabel Leite Cafezeiro','',NULL),(30,'John Reed','',NULL),(31,'José Henrique Carneiro de Araújo','',NULL),(32,'José Raphael Bokehi','',NULL),(33,'José Ricardo de Almeida Torreão','',NULL),(34,'José Viterbo Filho','',NULL),(35,'Karina Mochetti','',NULL),(36,'Lauro Eduardo Kozovits','',NULL),(37,'Leandro Augusto Frata Fernandes','',NULL),(38,'Leonardo Cruz da Costa','leo@ic.uff.br',NULL),(39,'Leonardo Gresta Paulino Murta','',NULL),(40,'Loana Tito Nogueira','',NULL),(41,'Luciana Cardoso de Castro Salgado','',NULL),(42,'Luis Antonio Brasil Kowada','',NULL),(43,'Luis Martí Orosa','',NULL),(44,'Luiz André Portes Paes Leme','',NULL),(45,'Luiz Satoru Ochi','',NULL),(46,'Lúcia Maria de Assumpção Drummond','',NULL),(47,'Marcelo Fornazin','',NULL),(48,'Marco Antonio Monteiro Silva Ramos','',NULL),(49,'Marcos Kalinowski','',NULL),(50,'Marcos Lage','',NULL),(51,'Maria Cristina Silva Boeres','',NULL),(52,'Mauricio Kischinhevsky','',NULL),(53,'Milton Brown do Coutto Filho','',NULL),(54,'Otton Teixeira da Silveira Filho','',NULL),(55,'Raphael Pereira de Oliveira Guerra','',NULL),(56,'Raquel Bravo','',NULL),(57,'Regina Célia Paula Leal Toledo','',NULL),(58,'Ricardo Leiderman','',NULL),(59,'Rodrigo Salvador Monteiro','',NULL),(60,'Simone de Lima Martins','',NULL),(61,'Teresa Cristina de Aguiar','',NULL),(62,'Uéverton dos Santos Souza','',NULL),(63,'Vanessa Braganholo Murta','',NULL),(64,'Victor Teixeira de Almeida','',NULL),(65,'Yuri Abitbol de Menezes Frota','',NULL);
/*!40000 ALTER TABLE `professores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_classroom`
--

DROP TABLE IF EXISTS `student_classroom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_classroom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_classroom_user_FK` (`user_id`),
  KEY `student_classroom_classroom_FK` (`classroom_id`),
  CONSTRAINT `student_classroom_classroom_FK` FOREIGN KEY (`classroom_id`) REFERENCES `classroom` (`id`),
  CONSTRAINT `student_classroom_user_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_classroom`
--

LOCK TABLES `student_classroom` WRITE;
/*!40000 ALTER TABLE `student_classroom` DISABLE KEYS */;
INSERT INTO `student_classroom` VALUES (1,2,1),(11,1,3),(26,1,2),(28,1,3);
/*!40000 ALTER TABLE `student_classroom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` VALUES (1,'Engenharia De Software I','123123123'),(2,'Banco de Dados Não Convencionais','71936492'),(3,'Gestão de Processos e Manutenção de Software','826493632'),(4,'Tópicos Especiais','321654');
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `img_url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher`
--

LOCK TABLES `teacher` WRITE;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
INSERT INTO `teacher` VALUES (1,'Leonardo Murta','teacherimage/Leonardo_Murtadownload.jpg'),(2,'Andréa Magalhães',NULL),(3,'Victor Almeida',NULL),(5,'Leonardo Cruz',NULL);
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `enrollment_code` varchar(100) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `change_password` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Leo','Cruz','leocruz@id.uff.br','123',NULL,1,0),(2,'Vynicius','Morais Pontes','wilsonteles@id.uff.br','123','12421124',0,0),(3,'Wilson','Teles','wjmarcolin@hotmail.com','123','114083045',0,0),(4,'fafa','fafa','lala@lala.com','123','1234',0,0),(5,'wilson','marcolin','wilson.teles@exablack.com','123','98273',0,0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `week_day`
--

DROP TABLE IF EXISTS `week_day`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `week_day` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `week_day`
--

LOCK TABLES `week_day` WRITE;
/*!40000 ALTER TABLE `week_day` DISABLE KEYS */;
INSERT INTO `week_day` VALUES (1,'Segunda'),(2,'Terça'),(3,'Quarta'),(4,'Quinta'),(5,'Sexta'),(6,'Sábado');
/*!40000 ALTER TABLE `week_day` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'solicitasi'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-20 22:37:08
