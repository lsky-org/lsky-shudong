-- MySQL dump 10.13  Distrib 5.5.53, for Win32 (AMD64)
--
-- Host: localhost    Database: test
-- ------------------------------------------------------
-- Server version	5.5.53

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
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` char(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '名字',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别，1：男，2：女，0：未知',
  `qq` char(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'QQ',
  `content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '树洞内容',
  `ip` char(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'IP',
  `is_anonymous` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否匿名',
  `send_time` int(11) NOT NULL COMMENT '发布时间',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,'男演员',1,'1591788658','这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录','0.0.0.0',1,0,0),(2,'女演员',2,'1591788658','这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录','0.0.0.0',0,0,0),(3,'未知演员',0,'1591788658','这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录这是一条测试记录','0.0.0.0',0,0,0),(4,'WispX',1,'1591788658','WispX','127.0.0.1',0,1509028908,0),(5,'WispX',1,'1591788658','卧槽','127.0.0.1',0,1509029261,0),(6,'WispX',1,'1591788658','卧槽','127.0.0.1',0,1509029309,0),(7,'WispX',1,'1591788658','卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽卧槽','127.0.0.1',0,1509029424,0),(8,'WispX',2,'1591788658','测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试','127.0.0.1',0,1509029711,0);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-26 22:56:06
