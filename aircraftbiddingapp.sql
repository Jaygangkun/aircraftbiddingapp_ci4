/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : aircraftbiddingapp

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-08-01 18:22:57
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `trips`
-- ----------------------------
DROP TABLE IF EXISTS `trips`;
CREATE TABLE `trips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) DEFAULT NULL,
  `customer` int(11) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `pax` varchar(255) DEFAULT NULL,
  `aircraft_category` int(11) DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of trips
-- ----------------------------
INSERT INTO `trips` VALUES ('3', '', '6', null, null, '3', null);
INSERT INTO `trips` VALUES ('4', 'Settled', '5', null, null, '4', null);
INSERT INTO `trips` VALUES ('5', 'Quoted & Pending', '4', null, null, '5', null);
INSERT INTO `trips` VALUES ('6', 'In Work', '3', null, null, '6', null);
INSERT INTO `trips` VALUES ('8', 'Booked', '8', null, null, '7', null);
INSERT INTO `trips` VALUES ('9', 'In Work', '1', '07/31/2022', '12', '0', null);
INSERT INTO `trips` VALUES ('10', 'In Work', '8', '07/31/2022', null, null, null);
INSERT INTO `trips` VALUES ('11', 'In Work', '1', '08/01/2022', '2', '1', null);
INSERT INTO `trips` VALUES ('12', '', '1', '08/01/2022', 'qwe', '1', 'adwer');
INSERT INTO `trips` VALUES ('13', 'Quoted & Pending', '1', '08/01/2022', '123', '3', 'adwerwer');
