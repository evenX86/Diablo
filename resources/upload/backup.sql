/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : gmsdb

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-05-01 02:20:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `Admin_ID` varchar(8) NOT NULL,
  `Admin_passwd` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Admin_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('admin', 'admin');

-- ----------------------------
-- Table structure for shenfei_message
-- ----------------------------
DROP TABLE IF EXISTS `shenfei_message`;
CREATE TABLE `shenfei_message` (
  `M_ID` int(11) NOT NULL AUTO_INCREMENT,
  `M_title` varchar(30) NOT NULL,
  `M_content` varchar(5000) DEFAULT NULL,
  `M_from` varchar(8) NOT NULL,
  `M_to` varchar(8) NOT NULL,
  `M_read` varchar(8) NOT NULL,
  `M_time` date NOT NULL,
  `M_upfilename` varchar(30) DEFAULT NULL,
  `M_upfilepath` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`M_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shenfei_message
-- ----------------------------

-- ----------------------------
-- Table structure for shenfei_message_1
-- ----------------------------
DROP TABLE IF EXISTS `shenfei_message_1`;
CREATE TABLE `shenfei_message_1` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `send_user` varchar(255) DEFAULT NULL,
  `receive_user` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `insert_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shenfei_message_1
-- ----------------------------

-- ----------------------------
-- Table structure for shenfei_news
-- ----------------------------
DROP TABLE IF EXISTS `shenfei_news`;
CREATE TABLE `shenfei_news` (
  `id` bigint(20) NOT NULL DEFAULT '0',
  `title` varchar(200) DEFAULT NULL,
  `content` text,
  `date` date DEFAULT NULL,
  `type` enum('admin','teacher','student','all') DEFAULT 'student' COMMENT '新闻是哪种类型只能谁看或者谁都能看',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shenfei_news
-- ----------------------------

-- ----------------------------
-- Table structure for shenfei_paper
-- ----------------------------
DROP TABLE IF EXISTS `shenfei_paper`;
CREATE TABLE `shenfei_paper` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(50) DEFAULT NULL,
  `teacher_id` varchar(50) DEFAULT NULL,
  `paper_name` varchar(255) DEFAULT NULL,
  `paper_addr` varchar(255) DEFAULT NULL,
  `insert_date` date DEFAULT NULL,
  `ensure_teacher` varchar(255) DEFAULT NULL,
  `suggestion` text COMMENT '教师意见',
  `level_college` varchar(255) DEFAULT NULL,
  `ensure_prof` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='论文\r\n';

-- ----------------------------
-- Records of shenfei_paper
-- ----------------------------
INSERT INTO `shenfei_paper` VALUES ('2', '2', '3', '电子商务的现状与研究', 'D:\\bishe\\Diablo\\resources\\upload\\startr\\practice_summary_paper_20125641030_shengfei.rar', '2015-04-30', 'true', '6666', '优', 'true');
INSERT INTO `shenfei_paper` VALUES ('3', '2', '3', '电子商务的现状与研究', null, '2015-04-30', null, null, null, 'true');
INSERT INTO `shenfei_paper` VALUES ('4', '2', '3', '电子商务的现状与研究', null, '2015-04-30', null, null, null, 'true');

-- ----------------------------
-- Table structure for shenfei_practice_process
-- ----------------------------
DROP TABLE IF EXISTS `shenfei_practice_process`;
CREATE TABLE `shenfei_practice_process` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(50) DEFAULT NULL,
  `teacher_id` varchar(50) DEFAULT NULL,
  `report_name` varchar(255) DEFAULT NULL,
  `report_addr` varchar(255) DEFAULT NULL,
  `insert_date` date DEFAULT NULL,
  `ensure_teacher` varchar(255) DEFAULT NULL,
  `suggestion` text COMMENT '教师意见',
  `level_college` varchar(255) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='开题报告表\r\n';

-- ----------------------------
-- Records of shenfei_practice_process
-- ----------------------------
INSERT INTO `shenfei_practice_process` VALUES ('1', '2', '3', '电子商务的现状与研究', 'D:\\bishe\\Diablo\\resources\\upload\\startr\\practice_20125641030_shengfei.doc', '2015-04-27', 'true', '1111111111111111', null, 'D:\\bishe\\Diablo\\resources\\upload\\startr\\20125641030shenfei.doc');

-- ----------------------------
-- Table structure for shenfei_start_report
-- ----------------------------
DROP TABLE IF EXISTS `shenfei_start_report`;
CREATE TABLE `shenfei_start_report` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(50) DEFAULT NULL,
  `teacher_id` varchar(50) DEFAULT NULL,
  `report_name` varchar(255) DEFAULT NULL,
  `report_addr` varchar(255) DEFAULT NULL,
  `insert_date` date DEFAULT NULL,
  `ensure_teacher` varchar(255) DEFAULT NULL,
  `ensure_prof` varchar(255) DEFAULT NULL,
  `level_college` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='开题报告表\r\n';

-- ----------------------------
-- Records of shenfei_start_report
-- ----------------------------
INSERT INTO `shenfei_start_report` VALUES ('1', '2', '3', '电子商务的现状与研究', 'D:\\bishe\\Diablo\\resources\\upload\\startr', '2015-04-20', '', '', '');
INSERT INTO `shenfei_start_report` VALUES ('2', '2', '3', '电子商务的现状与研究', 'D:\\bishe\\Diablo\\resources\\upload\\startr', '2015-04-20', null, null, null);
INSERT INTO `shenfei_start_report` VALUES ('3', '2', '3', '电子商务的现状与研究', 'D:\\bishe\\Diablo\\resources\\upload\\startr\\20125641030shenfei.doc', '2015-04-20', null, null, null);
INSERT INTO `shenfei_start_report` VALUES ('4', '2', '3', '电子商务的现状与研究', 'D:\\bishe\\Diablo\\resources\\upload\\startr\\20125641030shenfei.doc', '2015-04-23', 'true', 'true', '及格');
INSERT INTO `shenfei_start_report` VALUES ('5', '11', '3', '123456', 'D:\\bishe\\Diablo\\resources\\upload\\startr\\124.doc', '2015-04-25', 'true', 'true', null);
INSERT INTO `shenfei_start_report` VALUES ('6', '2', '3', '电子商务的现状与研究', 'D:\\bishe\\Diablo\\resources\\upload\\startr\\practice_20125641030_shengfei.doc', '2015-04-27', null, null, null);

-- ----------------------------
-- Table structure for shenfei_student_task
-- ----------------------------
DROP TABLE IF EXISTS `shenfei_student_task`;
CREATE TABLE `shenfei_student_task` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(255) DEFAULT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `student_major` varchar(255) DEFAULT NULL,
  `student_task_name` varchar(255) DEFAULT NULL,
  `student_task_content` text,
  `college_ensure` varchar(20) DEFAULT 'false',
  `college_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='学生实习任务书表';

-- ----------------------------
-- Records of shenfei_student_task
-- ----------------------------
INSERT INTO `shenfei_student_task` VALUES ('1', 'student', '2', '计算机科学与技术', '121213232', '32432432423', 'true', '计算机学院');
INSERT INTO `shenfei_student_task` VALUES ('2', 'xuyifei', '2010', '计算机科学与技术', '23123123123', '4324234234234', 'true', '计算机学院');
INSERT INTO `shenfei_student_task` VALUES ('3', 'shenxinyan', '03', '计算机科学与技术', '1111', '222222222', 'true', '计算机学院');
INSERT INTO `shenfei_student_task` VALUES ('4', 'student', '2', '计算机科学与技术', '2121312', '1231231231', 'false', '计算机学院');
INSERT INTO `shenfei_student_task` VALUES ('5', '沈鑫焱', '11', '计算机科学与技术', '12234', '124543345', 'true', '计算机学院');

-- ----------------------------
-- Table structure for shenfei_subject
-- ----------------------------
DROP TABLE IF EXISTS `shenfei_subject`;
CREATE TABLE `shenfei_subject` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `subject_title` varchar(50) DEFAULT NULL COMMENT '课题标题',
  `subject_descripe` text,
  `teacher_id` varchar(100) DEFAULT NULL,
  `teacher_name` varchar(100) DEFAULT NULL,
  `prof_audit` enum('true','false') DEFAULT NULL COMMENT '专业负责人审核意见',
  `prof_comment` varchar(200) DEFAULT NULL,
  `college_audit` enum('true','false') DEFAULT NULL COMMENT '学院负责人审核意见',
  `college_comment` varchar(200) DEFAULT NULL,
  `create_time` date DEFAULT NULL COMMENT '课题创建时间',
  `update_time` date DEFAULT NULL COMMENT '课题更新时间',
  `major` varchar(100) DEFAULT NULL COMMENT '专业',
  `ensure_teacher` enum('true','false') DEFAULT 'false',
  `ensure_student` enum('true','false') DEFAULT 'false',
  `ensure_prof` enum('true','false') DEFAULT 'false',
  `select` enum('true','false') DEFAULT 'false',
  `student_id` varchar(255) DEFAULT NULL,
  `task` varchar(255) DEFAULT NULL COMMENT '实习任务',
  `start_report` varchar(255) DEFAULT NULL,
  `college` varchar(255) DEFAULT NULL,
  `practice_process` varchar(255) DEFAULT NULL COMMENT '实习进程安排是否提交',
  `paper` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shenfei_subject
-- ----------------------------
INSERT INTO `shenfei_subject` VALUES ('1', '111', '111', 'teacher', 'teacher', 'false', '这么差也好意思拿上来审核?', null, null, '2015-03-29', '2015-03-29', '计算机科学与技术', 'false', 'false', 'false', 'false', null, null, null, null, null, '');
INSERT INTO `shenfei_subject` VALUES ('2', '四月是你的谎言', '四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言四月是你的谎言', 'teacher', 'teacher', 'false', null, null, null, '2015-03-29', null, '计算机科学与技术', 'false', 'false', 'false', 'false', null, null, null, null, null, null);
INSERT INTO `shenfei_subject` VALUES ('3', '寄生兽', '口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟口舌米黄色精辟', '7', '钟锋', 'true', '你做的很好，祥哥很满意', 'true', '学院意见:很好', '2015-03-29', '2015-03-29', '计算机科学与技术', 'false', 'false', 'false', 'false', '3', 'true', null, null, null, null);
INSERT INTO `shenfei_subject` VALUES ('4', '妄想学生会', '哈哈哈', '7', '钟锋', null, null, null, null, '2015-03-29', '2015-03-29', '计算机科学与技术', 'false', 'false', 'false', 'false', null, null, null, null, null, null);
INSERT INTO `shenfei_subject` VALUES ('5', '记录的地平线', 'になろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろうになろう', '7', '钟锋', null, null, null, null, '2015-03-29', '2015-03-29', '计算机科学与技术', 'false', 'false', 'false', 'false', null, null, null, null, null, null);
INSERT INTO `shenfei_subject` VALUES ('6', '七大罪', 'duang长！', '7', '钟锋', null, null, null, null, '2015-03-29', '2015-03-29', '计算机科学与技术', 'false', 'false', 'false', 'false', null, null, null, null, null, null);
INSERT INTO `shenfei_subject` VALUES ('7', '电子商务研究', '电子商务研究电子商务研究电子商务研究电子商务研究电子商务研究电子商务研究电子商务研究电子商务研究电子商务研究电子商务研究电子商务研究', '7', '钟锋', 'true', 'h很好', 'true', 'heh ', '2015-03-29', '2015-03-29', '计算机科学与技术', 'false', 'false', 'false', 'false', null, null, null, null, null, null);
INSERT INTO `shenfei_subject` VALUES ('8', '电子商务研究', '电子商务研究电子商务研究电子商务研究', '3', 'teacher', 'true', '同意', 'true', '1', '2015-03-29', '2015-03-31', '计算机科学与技术', 'false', 'false', 'false', 'false', null, null, null, null, null, null);
INSERT INTO `shenfei_subject` VALUES ('9', 'app界面设计', 'app界面设计app界面设计app界面设计', '3', 'teacher', 'true', '同意', 'true', '同意', '2015-03-30', '2015-03-30', '计算机科学与技术', 'false', 'false', 'false', 'false', null, null, null, null, null, null);
INSERT INTO `shenfei_subject` VALUES ('10', '电子商务的现状与研究', '哈哈哈', '3', 'teacher', 'true', '', 'true', '', '2015-03-30', '2015-03-30', '计算机科学与技术', 'true', 'false', 'false', 'true', '2', 'true', 'true', '计算机学院', 'true', 'true');
INSERT INTO `shenfei_subject` VALUES ('11', 'C2C电子商务研究', 'C2C电子商务研究C2C电子商务研究C2C电子商务研究', '3', 'teacher', 'true', '同意', 'true', '同意', '2015-03-31', '2015-03-31', '计算机科学与技术', 'false', 'false', 'false', 'false', null, null, null, null, null, null);
INSERT INTO `shenfei_subject` VALUES ('12', 'OCO电子商务市场研究', 'OCO电子商务市场研究OCO电子商务市场研究OCO电子商务市场研究', '3', 'teacher', 'true', '同意', 'true', '同意', '2015-03-31', '2015-03-31', '计算机科学与技术', 'false', 'false', 'false', 'false', null, null, null, null, null, null);
INSERT INTO `shenfei_subject` VALUES ('13', 'hello world', 'hello worldhello worldhello worldhello world', '3', 'teacher', 'true', 'tongyi', 'true', 'tongyi', '2015-03-31', '2015-03-31', '计算机科学与技术', 'false', 'false', 'false', 'false', null, null, null, null, null, null);
INSERT INTO `shenfei_subject` VALUES ('14', '123', '123455', '3', 'teacher', 'true', '1', 'true', '1', '2015-03-31', '2015-03-31', '计算机科学与技术', 'false', 'false', 'false', 'false', null, null, null, null, null, null);
INSERT INTO `shenfei_subject` VALUES ('15', '你好', '你好你好', '3', 'teacher', 'true', '1', 'true', '1', '2015-03-31', '2015-03-31', '计算机科学与技术', 'false', 'false', 'false', 'false', null, null, null, null, null, null);
INSERT INTO `shenfei_subject` VALUES ('16', '再见不如不见', '再见不如不见再见不如不见再见不如不见', '3', 'teacher', 'true', '同意', 'true', '通过', '2015-03-31', '2015-03-31', '计算机科学与技术', 'false', 'false', 'false', 'false', null, null, null, null, null, null);
INSERT INTO `shenfei_subject` VALUES ('17', '12345', '234555', '3', 'teacher', null, null, null, null, '2015-04-01', '2015-04-01', '计算机科学与技术', 'false', 'false', 'false', 'false', null, null, null, null, null, null);
INSERT INTO `shenfei_subject` VALUES ('18', '电子商务的研究', '123', '3', 'teacher', 'true', '同意', 'true', '同意', '2015-04-11', '2015-04-11', '计算机科学与技术', 'true', 'false', 'true', 'true', '2010', '', null, null, null, null);
INSERT INTO `shenfei_subject` VALUES ('19', '电子商务', '1223', '3', 'teacher', 'true', '同意', 'true', '同意', '2015-04-12', '2015-04-12', '计算机科学与技术', 'false', 'false', 'false', 'false', null, null, null, null, null, null);
INSERT INTO `shenfei_subject` VALUES ('20', '网购的现状', '111111', '3', 'teacher', 'true', '1', 'true', '1', '2015-04-18', '2015-04-18', '计算机科学与技术', 'true', 'false', 'true', 'true', '03', '', null, null, null, null);
INSERT INTO `shenfei_subject` VALUES ('21', '对中国应试教育的想法', '对中国应试教育的想法对中国应试教育的想法对中国应试教育的想法对中国应试教育的想法', '3', 'teacher', 'true', '同意', 'true', '同意', '2015-04-25', '2015-04-25', '计算机科学与技术', 'false', 'false', 'false', 'false', null, null, null, null, null, null);
INSERT INTO `shenfei_subject` VALUES ('22', '123456', '123456', '3', 'teacher', 'true', '1', 'true', '11', '2015-04-25', '2015-04-25', '计算机科学与技术', 'true', 'false', 'true', 'true', '11', 'true', 'true', null, null, null);
INSERT INTO `shenfei_subject` VALUES ('23', '111111111', '111111111111111111111111111111111111111111111111', '3', 'teacher', null, null, null, null, '2015-04-25', '2015-04-25', '计算机科学与技术', 'false', 'false', 'false', 'false', null, null, null, null, null, null);
INSERT INTO `shenfei_subject` VALUES ('24', '1225555555', 'wwwwwwww', '3', 'teacher', null, null, null, null, '2015-04-25', '2015-04-25', '计算机科学与技术', 'false', 'false', 'false', 'false', null, null, null, null, null, null);

-- ----------------------------
-- Table structure for shenfei_subject_ensure
-- ----------------------------
DROP TABLE IF EXISTS `shenfei_subject_ensure`;
CREATE TABLE `shenfei_subject_ensure` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `subject_id` bigint(20) DEFAULT NULL,
  `subject_name` varchar(255) DEFAULT NULL,
  `subject_teacher` enum('false','true') DEFAULT NULL,
  `subject_student` enum('true','false') DEFAULT NULL,
  `subject_prof` enum('true','false') DEFAULT NULL,
  `time` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shenfei_subject_ensure
-- ----------------------------

-- ----------------------------
-- Table structure for shenfei_user
-- ----------------------------
DROP TABLE IF EXISTS `shenfei_user`;
CREATE TABLE `shenfei_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL COMMENT '学号或者教师ID，唯一',
  `user_passwd` varchar(100) NOT NULL,
  `question` varchar(400) DEFAULT NULL,
  `answer` varchar(400) DEFAULT NULL,
  `sex` enum('男','女') NOT NULL DEFAULT '男',
  `email` varchar(30) NOT NULL,
  `tel_num` varchar(11) NOT NULL,
  `college` varchar(30) NOT NULL,
  `major` varchar(30) NOT NULL,
  `degree` enum('student','teacher','dean','college','prof') NOT NULL DEFAULT 'student' COMMENT 'student学生;teacher指导教师;dean教务处;college学院负责人;prof专业负责人',
  `address` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shenfei_user
-- ----------------------------
INSERT INTO `shenfei_user` VALUES ('1', 'admin', '1', '21232f297a57a5a743894a0e4a801fc3', '', '', '', '87104757＠qq.com', '15071399087', '计算机学院', '计算机科学与技术', 'prof', '27#512');
INSERT INTO `shenfei_user` VALUES ('2', 'student', '2', 'e10adc3949ba59abbe56e057f20f883e', '123', '456', '', '87104757＠qq.com', '15071399087', '计算机学院', '计算机科学与技术', 'student', '27#512');
INSERT INTO `shenfei_user` VALUES ('3', 'teacher', '3', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '87104757＠qq.com', '15071399087', '计算机学院', '计算机科学与技术', 'teacher', '9号楼312室');
INSERT INTO `shenfei_user` VALUES ('4', 'xuyifei', '4', 'e10adc3949ba59abbe56e057f20f883e', null, null, '男', '', '', '', '计算机科学与技术', 'student', '');
INSERT INTO `shenfei_user` VALUES ('5', 'wang', '5', 'd41d8cd98f00b204e9800998ecf8427e', null, null, '男', '', '', '', '计算机科学与技术', 'teacher', '');
INSERT INTO `shenfei_user` VALUES ('6', 'pro', '6', 'e10adc3949ba59abbe56e057f20f883e', null, null, '男', '', '', '计算机学院', '计算机科学与技术', 'prof', '');
INSERT INTO `shenfei_user` VALUES ('7', '钟锋', '7', 'e10adc3949ba59abbe56e057f20f883e', null, null, '男', '', '', '', '计算机科学与技术', 'teacher', '');
INSERT INTO `shenfei_user` VALUES ('8', '徐依飞', '20105641030', 'e10adc3949ba59abbe56e057f20f883e', null, null, '男', '', '', '', '计算机科学与技术', 'student', '');
INSERT INTO `shenfei_user` VALUES ('9', '沈菲', '123', 'd41d8cd98f00b204e9800998ecf8427e', null, null, '男', '', '', '', '计算机科学与技术', 'student', '');
INSERT INTO `shenfei_user` VALUES ('10', 'college', 'college', 'e10adc3949ba59abbe56e057f20f883e', null, null, '男', '', '', '计算机学院', '计算机科学与技术', 'college', '');
INSERT INTO `shenfei_user` VALUES ('11', '陶加恩', 'tje', 'd41d8cd98f00b204e9800998ecf8427e', null, null, '男', '', '', '', '计算机科学与技术', 'student', '');
INSERT INTO `shenfei_user` VALUES ('12', '沈菲', '201105017106', 'd41d8cd98f00b204e9800998ecf8427e', null, null, '男', '', '', '', '计算机科学与技术', 'student', '');
INSERT INTO `shenfei_user` VALUES ('13', '陈文', '201105017102', 'd41d8cd98f00b204e9800998ecf8427e', null, null, '男', '', '', '', '', 'student', '');
INSERT INTO `shenfei_user` VALUES ('14', '张三', '201105017103', 'd41d8cd98f00b204e9800998ecf8427e', null, null, '男', '', '', '', '', 'student', '');
INSERT INTO `shenfei_user` VALUES ('15', 'lisi', '00001', 'd41d8cd98f00b204e9800998ecf8427e', null, null, '男', '', '', '', '', 'student', '');
INSERT INTO `shenfei_user` VALUES ('16', 'xiaowang', '1234', 'd41d8cd98f00b204e9800998ecf8427e', null, null, '男', '', '', '', '', 'student', '');
INSERT INTO `shenfei_user` VALUES ('17', 'xiaoming', '1111', 'e10adc3949ba59abbe56e057f20f883e', null, null, '男', '', '', '', '', 'student', '');
INSERT INTO `shenfei_user` VALUES ('18', 'we', '122', '202cb962ac59075b964b07152d234b70', null, null, '男', '', '', '', '', 'student', '');
INSERT INTO `shenfei_user` VALUES ('19', 'xuyifei', '2010', 'e10adc3949ba59abbe56e057f20f883e', null, null, '男', '', '', '', '计算机科学与技术', 'student', '');
INSERT INTO `shenfei_user` VALUES ('20', 'shenxinyan', '03', 'e10adc3949ba59abbe56e057f20f883e', null, null, '男', '', '', '', '计算机科学与技术', 'student', '');
INSERT INTO `shenfei_user` VALUES ('21', 'beibei', '09', 'e10adc3949ba59abbe56e057f20f883e', null, null, '男', '', '', '信息科技学院', '计算机与科学技术', 'student', '');
INSERT INTO `shenfei_user` VALUES ('22', '沈鑫焱', '11', 'e10adc3949ba59abbe56e057f20f883e', null, null, '男', '', '', '', '计算机科学与技术', 'student', '');

-- ----------------------------
-- Table structure for shenfei_xiaoyou
-- ----------------------------
DROP TABLE IF EXISTS `shenfei_xiaoyou`;
CREATE TABLE `shenfei_xiaoyou` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(50) DEFAULT NULL,
  `teacher_id` varchar(50) DEFAULT NULL,
  `paper_name` varchar(255) DEFAULT NULL,
  `insert_date` date DEFAULT NULL,
  `ensure_prof` varchar(255) DEFAULT NULL,
  `suggest_prof` varchar(255) DEFAULT NULL,
  `ensure_college` varchar(255) DEFAULT NULL,
  `suggest_college` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='校优表\r\n';

-- ----------------------------
-- Records of shenfei_xiaoyou
-- ----------------------------
INSERT INTO `shenfei_xiaoyou` VALUES ('3', '2', '3', '电子商务的现状与研究', '2015-04-30', 'true', '666666', 'true', '6666');

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `student_ID` varchar(8) NOT NULL DEFAULT '',
  `student_name` varchar(10) NOT NULL,
  `sex` enum('ç”·','å¥³') NOT NULL,
  `college` varchar(30) NOT NULL,
  `major` varchar(30) NOT NULL,
  `class` varchar(20) NOT NULL,
  PRIMARY KEY (`student_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('student', '蓝艺杉', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061132', '马睿', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061105', '樊志强', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061106', '许武', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061107', '蓝庆祥', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061108', '曹景磊', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061109', '王韬', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061110', '王朝旺', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061111', '赵俊', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061117', '张成林', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061118', '张媛媛', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061119', '张春艳', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061120', '陈芳', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061121', '郭春明', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061122', '马超林', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061123', '闫氷亮', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061124', '蓝新华', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061125', '张龙', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061126', '汤云强', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061127', '蓝燕洲', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061128', '黄金龙', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061129', '吴昊政', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061130', '张宏亮', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061131', '代尊富', '', '计算机科学学院', '计算机科学与技术专业', '06级5班');
INSERT INTO `student` VALUES ('06061134', '沙国威', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061135', '李继刚', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061136', '昌伟', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061137', '杨金华', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061139', '李忠文', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061140', '任神龙', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061141', '石佳', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061142', '费鹰', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061143', '丁柳村', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061144', '薛红红', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061145', '余丽', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061146', '雷丽萍', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061147', '王帆', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061148', '谭谧', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061149', '王可', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061150', '张燕', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061151', '梅振隆', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061152', '陶磊', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061153', '王贝', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061154', '马庆华', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061155', '杨斐', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061156', '刘斌', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061157', '罗珍俊', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061158', '汤海毅', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061281', '林晨', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');
INSERT INTO `student` VALUES ('06061159', '韦整', '', '计算机科学学院', '计算机科学与技术专业', '06级6班');

-- ----------------------------
-- Table structure for teacher
-- ----------------------------
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `teacher_ID` varchar(8) NOT NULL,
  `teacher_name` varchar(10) NOT NULL,
  `sex` enum('ç”·','å¥³') NOT NULL,
  `college` varchar(30) NOT NULL,
  `major` varchar(30) NOT NULL,
  `degree` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`teacher_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teacher
-- ----------------------------
INSERT INTO `teacher` VALUES ('teacher', '帖军', '', '计算机科学学院', '计算机科学与技术专业', '副教授');
INSERT INTO `teacher` VALUES ('41709834', '罗铁祥', '', '计算机科学学院', '计算机科学与技术专业', '副教授');
INSERT INTO `teacher` VALUES ('admin', 'Admin', '', '计算机科学学院', '计算机科学与技术专业', '院长');
INSERT INTO `teacher` VALUES ('', '', '', '计算机科学学院', '计算机科学与技术专业', '');
