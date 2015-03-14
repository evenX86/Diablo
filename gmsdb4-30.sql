-- MySQL dump 10.11
--
-- Host: localhost    Database: gmsdb
-- ------------------------------------------------------
-- Server version	5.0.51a-3ubuntu5.4

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
-- Table structure for table `Admin`
--

DROP TABLE IF EXISTS `Admin`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `Admin` (
  `Admin_ID` varchar(8) NOT NULL,
  `Admin_passwd` varchar(20) default NULL,
  PRIMARY KEY  (`Admin_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `Admin`
--

LOCK TABLES `Admin` WRITE;
/*!40000 ALTER TABLE `Admin` DISABLE KEYS */;
INSERT INTO `Admin` VALUES ('19870717','xinxiang');
/*!40000 ALTER TABLE `Admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Message`
--

DROP TABLE IF EXISTS `Message`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `Message` (
  `M_ID` int(11) NOT NULL auto_increment,
  `M_title` varchar(30) NOT NULL,
  `M_content` varchar(5000) default NULL,
  `M_from` varchar(8) NOT NULL,
  `M_to` varchar(8) NOT NULL,
  `M_read` varchar(8) NOT NULL,
  `M_time` date NOT NULL,
  `M_upfilename` varchar(30) default NULL,
  `M_upfilepath` varchar(30) default NULL,
  PRIMARY KEY  (`M_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `Message`
--

LOCK TABLES `Message` WRITE;
/*!40000 ALTER TABLE `Message` DISABLE KEYS */;
/*!40000 ALTER TABLE `Message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Student`
--

DROP TABLE IF EXISTS `Student`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `Student` (
  `student_ID` varchar(8) NOT NULL default '',
  `student_name` varchar(10) NOT NULL,
  `sex` enum('ç”·','å¥³') NOT NULL,
  `college` varchar(30) NOT NULL,
  `major` varchar(30) NOT NULL,
  `class` varchar(20) NOT NULL,
  PRIMARY KEY  (`student_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `Student`
--

LOCK TABLES `Student` WRITE;
/*!40000 ALTER TABLE `Student` DISABLE KEYS */;
INSERT INTO `Student` VALUES ('05061049','蓝艺杉','男','计算机科学学院','计算机科学与技术专业','06级5班'),('06061132','马睿','男','计算机科学学院','计算机科学与技术专业','06级6班'),('06061105','樊志强','男','计算机科学学院','计算机科学与技术专业','06级5班'),('06061106','许武','男','计算机科学学院','计算机科学与技术专业','06级5班'),('06061107','蓝庆祥','男','计算机科学学院','计算机科学与技术专业','06级5班'),('06061108','曹景磊','男','计算机科学学院','计算机科学与技术专业','06级5班'),('06061109','王韬','男','计算机科学学院','计算机科学与技术专业','06级5班'),('06061110','王朝旺','男','计算机科学学院','计算机科学与技术专业','06级5班'),('06061111','赵俊','男','计算机科学学院','计算机科学与技术专业','06级5班'),('06061117','张成林','女','计算机科学学院','计算机科学与技术专业','06级5班'),('06061118','张媛媛','女','计算机科学学院','计算机科学与技术专业','06级5班'),('06061119','张春艳','女','计算机科学学院','计算机科学与技术专业','06级5班'),('06061120','陈芳','女','计算机科学学院','计算机科学与技术专业','06级5班'),('06061121','郭春明','男','计算机科学学院','计算机科学与技术专业','06级5班'),('06061122','马超林','男','计算机科学学院','计算机科学与技术专业','06级5班'),('06061123','闫氷亮','男','计算机科学学院','计算机科学与技术专业','06级5班'),('06061124','蓝新华','男','计算机科学学院','计算机科学与技术专业','06级5班'),('06061125','张龙','男','计算机科学学院','计算机科学与技术专业','06级5班'),('06061126','汤云强','男','计算机科学学院','计算机科学与技术专业','06级5班'),('06061127','蓝燕洲','男','计算机科学学院','计算机科学与技术专业','06级5班'),('06061128','黄金龙','男','计算机科学学院','计算机科学与技术专业','06级5班'),('06061129','吴昊政','男','计算机科学学院','计算机科学与技术专业','06级5班'),('06061130','张宏亮','男','计算机科学学院','计算机科学与技术专业','06级5班'),('06061131','代尊富','男','计算机科学学院','计算机科学与技术专业','06级5班'),('06061134','沙国威','男','计算机科学学院','计算机科学与技术专业','06级6班'),('06061135','李继刚','男','计算机科学学院','计算机科学与技术专业','06级6班'),('06061136','昌伟','男','计算机科学学院','计算机科学与技术专业','06级6班'),('06061137','杨金华','男','计算机科学学院','计算机科学与技术专业','06级6班'),('06061139','李忠文','男','计算机科学学院','计算机科学与技术专业','06级6班'),('06061140','任神龙','男','计算机科学学院','计算机科学与技术专业','06级6班'),('06061141','石佳','男','计算机科学学院','计算机科学与技术专业','06级6班'),('06061142','费鹰','女','计算机科学学院','计算机科学与技术专业','06级6班'),('06061143','丁柳村','女','计算机科学学院','计算机科学与技术专业','06级6班'),('06061144','薛红红','女','计算机科学学院','计算机科学与技术专业','06级6班'),('06061145','余丽','女','计算机科学学院','计算机科学与技术专业','06级6班'),('06061146','雷丽萍','女','计算机科学学院','计算机科学与技术专业','06级6班'),('06061147','王帆','女','计算机科学学院','计算机科学与技术专业','06级6班'),('06061148','谭谧','女','计算机科学学院','计算机科学与技术专业','06级6班'),('06061149','王可','女','计算机科学学院','计算机科学与技术专业','06级6班'),('06061150','张燕','女','计算机科学学院','计算机科学与技术专业','06级6班'),('06061151','梅振隆','男','计算机科学学院','计算机科学与技术专业','06级6班'),('06061152','陶磊','男','计算机科学学院','计算机科学与技术专业','06级6班'),('06061153','王贝','男','计算机科学学院','计算机科学与技术专业','06级6班'),('06061154','马庆华','男','计算机科学学院','计算机科学与技术专业','06级6班'),('06061155','杨斐','男','计算机科学学院','计算机科学与技术专业','06级6班'),('06061156','刘斌','男','计算机科学学院','计算机科学与技术专业','06级6班'),('06061157','罗珍俊','男','计算机科学学院','计算机科学与技术专业','06级6班'),('06061158','汤海毅','男','计算机科学学院','计算机科学与技术专业','06级6班'),('06061281','林晨','男','计算机科学学院','计算机科学与技术专业','06级6班'),('06061159','韦整','男','计算机科学学院','计算机科学与技术专业','06级6班');
/*!40000 ALTER TABLE `Student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Subject`
--

DROP TABLE IF EXISTS `Subject`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `Subject` (
  `subject_ID` char(8) NOT NULL,
  `subject_title` varchar(50) default NULL,
  `teacher_ID` char(8) NOT NULL,
  `student_ID` char(8) default NULL,
  `status` char(10) NOT NULL,
  `audit` varchar(8) default 'å®¡æ ¸',
  PRIMARY KEY  (`subject_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `Subject`
--

LOCK TABLES `Subject` WRITE;
/*!40000 ALTER TABLE `Subject` DISABLE KEYS */;
INSERT INTO `Subject` VALUES ('50736073','基于WEB的毕业设计管理系统','87104757','06061153','已选','通过'),('50736074','autoCAD的二次开发','41709834','','未选','通过');
/*!40000 ALTER TABLE `Subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Teacher`
--

DROP TABLE IF EXISTS `Teacher`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `Teacher` (
  `teacher_ID` varchar(8) NOT NULL,
  `teacher_name` varchar(10) NOT NULL,
  `sex` enum('ç”·','å¥³') NOT NULL,
  `college` varchar(30) NOT NULL,
  `major` varchar(30) NOT NULL,
  `degree` varchar(10) default NULL,
  PRIMARY KEY  (`teacher_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `Teacher`
--

LOCK TABLES `Teacher` WRITE;
/*!40000 ALTER TABLE `Teacher` DISABLE KEYS */;
INSERT INTO `Teacher` VALUES ('87104757','帖军','男','计算机科学学院','计算机科学与技术专业','副教授'),('41709834','罗铁祥','男','计算机科学学院','计算机科学与技术专业','副教授'),('19870717','Admin','男','计算机科学学院','计算机科学与技术专业','院长'),('','','男','计算机科学学院','计算机科学与技术专业','');
/*!40000 ALTER TABLE `Teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `User` (
  `user_ID` varchar(8) NOT NULL,
  `user_passwd` varchar(20) NOT NULL,
  `question` varchar(40) default NULL,
  `answer` varchar(40) default NULL,
  `sex` enum('ç”·','å¥³') NOT NULL,
  `email` varchar(30) NOT NULL,
  `tel_num` varchar(11) NOT NULL,
  `college` varchar(30) NOT NULL,
  `major` varchar(30) NOT NULL,
  `degree` varchar(10) NOT NULL,
  `address` varchar(30) NOT NULL,
  PRIMARY KEY  (`user_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES ('06061153','xinxiang','123','456','男','87104757＠qq.com','15071399087','计算机科学学院','计算机科学与技术专业','学生','27#512'),('87104757','xinxiang','','','男','87104757＠qq.com','15071399087','计算机科学学院','计算机科学与技术专业','教师','9号楼312室'),('06061155','xinxiang','','','男','87104757＠qq.com','15071399087','计算机科学学院','计算机科学与技术专业','学生','27#512');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-04-30  2:02:52
