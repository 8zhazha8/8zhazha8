/*
Navicat MySQL Data Transfer

Source Server         : 本地MYSQL
Source Server Version : 50726
Source Host           : 127.0.0.1:3306
Source Database       : newbank04

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2021-12-13 16:13:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for accountinfo
-- ----------------------------
DROP TABLE IF EXISTS `accountinfo`;
CREATE TABLE `accountinfo` (
  `AccountId` int(11) NOT NULL AUTO_INCREMENT COMMENT '账户ID',
  `AccountCode` varchar(20) NOT NULL COMMENT '账号',
  `AccountPhone` varchar(20) NOT NULL COMMENT '手机号码',
  `RealName` varchar(20) NOT NULL COMMENT '真实姓名',
  `OpenTime` datetime DEFAULT NULL COMMENT '开户时间',
  PRIMARY KEY (`AccountId`) USING BTREE,
  KEY `accounts` (`AccountCode`,`AccountPhone`) USING BTREE,
  KEY `IX_AccountInfo` (`OpenTime`) USING BTREE,
  KEY `index_code` (`AccountCode`) USING BTREE,
  KEY `index_name` (`AccountPhone`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of accountinfo
-- ----------------------------
INSERT INTO `accountinfo` VALUES ('2', '420107199602034138', '13859003393', '刘备', '2021-08-10 16:00:00');
INSERT INTO `accountinfo` VALUES ('3', '420107199602034139', '13859003394', '关羽', '2021-08-10 16:02:00');
INSERT INTO `accountinfo` VALUES ('4', '420107199602034140', '13859003395', '张飞', '2021-08-10 16:02:00');
INSERT INTO `accountinfo` VALUES ('5', '420107199602034145', '18769001180', '赵云', '2021-08-10 17:24:00');
INSERT INTO `accountinfo` VALUES ('6', '420107199602034190', '18769001190', '曹操', '2021-08-10 17:25:00');
INSERT INTO `accountinfo` VALUES ('8', '420107199602034199', '13859003394', '周瑜', '2021-08-10 21:00:00');
INSERT INTO `accountinfo` VALUES ('19', '420107199602034146', '13859003395', '周瑜', '2021-12-13 08:41:02');
INSERT INTO `accountinfo` VALUES ('22', '420107199602034146', '13859003395', '周瑜', '2021-12-13 09:11:42');
INSERT INTO `accountinfo` VALUES ('27', '420107199602034149', '13859803395', '孙权', '2021-12-13 15:02:57');
INSERT INTO `accountinfo` VALUES ('28', '420107199602034149', '13859803395', '孙权', '2021-12-13 15:03:48');
INSERT INTO `accountinfo` VALUES ('29', '420107199602034149', '13859803395', '孙权', '2021-12-13 15:05:14');

-- ----------------------------
-- Table structure for bankcard
-- ----------------------------
DROP TABLE IF EXISTS `bankcard`;
CREATE TABLE `bankcard` (
  `CardId` int(11) NOT NULL AUTO_INCREMENT COMMENT '卡号ID',
  `CardNo` varchar(30) NOT NULL COMMENT '卡号码',
  `AccountId` int(11) NOT NULL COMMENT '账户ID',
  `CardPwd` varchar(32) NOT NULL COMMENT '卡密码',
  `CardMoney` decimal(19,4) NOT NULL COMMENT '余额',
  `CardState` tinyint(4) NOT NULL COMMENT '卡状态\r\n0 正常\r\n1.异常\r\n-1 注销',
  `CardTime` datetime DEFAULT NULL COMMENT '开卡时间',
  PRIMARY KEY (`CardId`) USING BTREE,
  KEY `FK__BankCard__Accoun__267ABA7A` (`AccountId`) USING BTREE,
  CONSTRAINT `bankcard_ibfk_1` FOREIGN KEY (`AccountId`) REFERENCES `accountinfo` (`AccountId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of bankcard
-- ----------------------------
INSERT INTO `bankcard` VALUES ('1', '6225098134285', '3', '21218cca77804d2ba1922c33e0151105', '0.1000', '0', '2021-08-10 21:09:00');
INSERT INTO `bankcard` VALUES ('2', '6225098234146', '4', '444444', '90.8900', '0', '2021-08-13 10:35:00');
INSERT INTO `bankcard` VALUES ('3', '6225098234196', '4', '444444', '90.8900', '0', '2021-08-13 10:35:00');
INSERT INTO `bankcard` VALUES ('4', '6225098234234', '2', '123456', '101800.0000', '0', '2021-08-10 16:04:00');
INSERT INTO `bankcard` VALUES ('5', '6225098234235', '3', '123456', '3000.0000', '0', '2021-08-10 16:05:00');
INSERT INTO `bankcard` VALUES ('6', '6225098234236', '4', '123456', '400000.0000', '0', '2021-08-10 16:05:00');
INSERT INTO `bankcard` VALUES ('7', '6225098234260', '5', '888888', '0.0000', '0', '2021-08-10 17:24:00');
INSERT INTO `bankcard` VALUES ('8', '6225098234285', '3', '123456', '400000.0000', '0', '2021-08-10 20:58:00');
INSERT INTO `bankcard` VALUES ('9', '6225098234290', '6', '888888', '0.0000', '0', '2021-08-10 17:25:00');
INSERT INTO `bankcard` VALUES ('10', '6225098234296', '4', '444444', '90.8900', '0', '2021-08-13 10:33:00');
INSERT INTO `bankcard` VALUES ('11', '6225098234299', '8', '123456', '0.1000', '0', '2021-08-10 21:00:00');
INSERT INTO `bankcard` VALUES ('12', '6235098234146', '4', '444444', '90.8900', '0', '2021-08-25 23:59:59');

-- ----------------------------
-- Table structure for cardexchange
-- ----------------------------
DROP TABLE IF EXISTS `cardexchange`;
CREATE TABLE `cardexchange` (
  `ExchangeId` int(11) NOT NULL COMMENT 'ID',
  `CardId` int(11) DEFAULT NULL COMMENT '卡号ID',
  `MoneyInBank` decimal(19,4) NOT NULL COMMENT '存款金额',
  `MoneyOutBank` decimal(19,4) NOT NULL COMMENT '取款金额',
  `ExchangeTime` datetime DEFAULT NULL COMMENT '操作时间',
  PRIMARY KEY (`ExchangeId`) USING BTREE,
  KEY `CardId` (`CardId`) USING BTREE,
  CONSTRAINT `cardexchange_ibfk_1` FOREIGN KEY (`CardId`) REFERENCES `bankcard` (`CardId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of cardexchange
-- ----------------------------
INSERT INTO `cardexchange` VALUES ('2', '1', '2000.0000', '0.0000', '2021-08-10 16:13:00');
INSERT INTO `cardexchange` VALUES ('3', '2', '8000.0000', '0.0000', '2021-08-10 16:15:00');
INSERT INTO `cardexchange` VALUES ('4', '3', '500000.0000', '0.0000', '2021-08-10 16:15:00');
INSERT INTO `cardexchange` VALUES ('5', '2', '0.0000', '5000.0000', '2021-08-10 21:41:00');
INSERT INTO `cardexchange` VALUES ('8', '4', '0.0000', '100.0000', '2021-08-11 20:55:00');
INSERT INTO `cardexchange` VALUES ('9', '1', '0.0000', '100.0000', '2021-08-11 20:57:00');

-- ----------------------------
-- Table structure for cardtransfer
-- ----------------------------
DROP TABLE IF EXISTS `cardtransfer`;
CREATE TABLE `cardtransfer` (
  `TransferId` int(11) NOT NULL,
  `CardIdOut` int(11) DEFAULT NULL COMMENT '转出卡号ID',
  `CardIdIn` int(11) DEFAULT NULL COMMENT '转入卡号ID',
  `TransferMoney` decimal(19,4) DEFAULT NULL COMMENT '转账金额',
  `TransferTime` datetime DEFAULT NULL COMMENT '转账时间',
  PRIMARY KEY (`TransferId`) USING BTREE,
  KEY `CardIdOut` (`CardIdOut`) USING BTREE,
  KEY `CardIdIn` (`CardIdIn`) USING BTREE,
  CONSTRAINT `cardtransfer_ibfk_1` FOREIGN KEY (`CardIdIn`) REFERENCES `bankcard` (`CardId`),
  CONSTRAINT `cardtransfer_ibfk_2` FOREIGN KEY (`CardIdOut`) REFERENCES `bankcard` (`CardId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of cardtransfer
-- ----------------------------
INSERT INTO `cardtransfer` VALUES ('1', '1', '3', '1000.0000', '2021-08-10 16:18:00');
INSERT INTO `cardtransfer` VALUES ('2', '3', '4', '1000.0000', '2021-08-11 21:06:00');
INSERT INTO `cardtransfer` VALUES ('3', '2', '5', '100000.0000', '2021-08-11 21:06:00');
