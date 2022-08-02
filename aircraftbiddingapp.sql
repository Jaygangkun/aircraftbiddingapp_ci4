/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : aircraftbiddingapp

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-08-02 13:50:02
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `aircraft_categories`
-- ----------------------------
DROP TABLE IF EXISTS `aircraft_categories`;
CREATE TABLE `aircraft_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of aircraft_categories
-- ----------------------------
INSERT INTO `aircraft_categories` VALUES ('1', 'aircat1_1');
INSERT INTO `aircraft_categories` VALUES ('3', 'aircat2');
INSERT INTO `aircraft_categories` VALUES ('4', 'cat331');
INSERT INTO `aircraft_categories` VALUES ('5', 'cat33');
INSERT INTO `aircraft_categories` VALUES ('6', 'newcat1');
INSERT INTO `aircraft_categories` VALUES ('7', 'newcart');

-- ----------------------------
-- Table structure for `aircrafts`
-- ----------------------------
DROP TABLE IF EXISTS `aircrafts`;
CREATE TABLE `aircrafts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of aircrafts
-- ----------------------------
INSERT INTO `aircrafts` VALUES ('2', 'aircrafttype2', null);
INSERT INTO `aircrafts` VALUES ('3', 'aircrafttype3_', null);
INSERT INTO `aircrafts` VALUES ('4', 'aircrafttype4', null);
INSERT INTO `aircrafts` VALUES ('7', 'airplane3', '1');
INSERT INTO `aircrafts` VALUES ('10', 'awerwer', '3');
INSERT INTO `aircrafts` VALUES ('11', 'brrte', '3');
INSERT INTO `aircrafts` VALUES ('12', 'we', '5');
INSERT INTO `aircrafts` VALUES ('13', 'naeciar1', '6');
INSERT INTO `aircrafts` VALUES ('14', 'cat3323', '5');
INSERT INTO `aircrafts` VALUES ('15', 'werwer', '7');

-- ----------------------------
-- Table structure for `customers`
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('1', 'customer1', 'company1', 'telephone1', 'email1');
INSERT INTO `customers` VALUES ('3', 'cust3', 'com3', 'tel3', 'emial3');
INSERT INTO `customers` VALUES ('4', 'cust4', 'comp4', 'tel4', 'email4');
INSERT INTO `customers` VALUES ('5', 'cust6', 'com5', 'tele5', 'email5');
INSERT INTO `customers` VALUES ('6', 'wer', '', '', '');
INSERT INTO `customers` VALUES ('7', 'newcust1', '', '', '');
INSERT INTO `customers` VALUES ('8', 'cust8', 'a', 'h', 'we');

-- ----------------------------
-- Table structure for `operators`
-- ----------------------------
DROP TABLE IF EXISTS `operators`;
CREATE TABLE `operators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of operators
-- ----------------------------
INSERT INTO `operators` VALUES ('2', 'op2_1', 'tel2_1', 'cont2_1', null);
INSERT INTO `operators` VALUES ('4', 'op4', 'tel4', 'contact4', null);
INSERT INTO `operators` VALUES ('6', 'op6', 'tel6', 'cont6', null);
INSERT INTO `operators` VALUES ('7', 'op7', 'tel7', 'con7', null);
INSERT INTO `operators` VALUES ('8', 'op8', 'tel8', 'contact8', null);
INSERT INTO `operators` VALUES ('9', 'asd', 'wera', 'werwer', 'cc@');
INSERT INTO `operators` VALUES ('10', 'op9', 'we', 'wr', null);
INSERT INTO `operators` VALUES ('11', 'dd', 'ee', 'cc', '123@ea');
INSERT INTO `operators` VALUES ('12', 'newcust8', 'we', 'adw', '4234');

-- ----------------------------
-- Table structure for `trip_legs`
-- ----------------------------
DROP TABLE IF EXISTS `trip_legs`;
CREATE TABLE `trip_legs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trip` int(11) DEFAULT NULL,
  `from` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of trip_legs
-- ----------------------------
INSERT INTO `trip_legs` VALUES ('12', '6', 'we', 'we', '07/14/2022', '19:42');
INSERT INTO `trip_legs` VALUES ('15', '4', 'e', 'e', '07/06/2022', '19:44');
INSERT INTO `trip_legs` VALUES ('16', '5', 'bb', 'ee', '06/29/2022', '19:43');
INSERT INTO `trip_legs` VALUES ('17', '5', 'ee', 'ff', '07/29/2022', '19:25');
INSERT INTO `trip_legs` VALUES ('19', '10', 'aa', 'cc', '07/26/2022', '23:25');
INSERT INTO `trip_legs` VALUES ('20', '10', 'bb', 'cc', '07/19/2022', '23:25');
INSERT INTO `trip_legs` VALUES ('23', '8', 'cc', 'dd', '08/01/2022', '23:33');
INSERT INTO `trip_legs` VALUES ('28', '9', 'aa', 'bb', '07/31/2022', '23:16');
INSERT INTO `trip_legs` VALUES ('31', '11', 'aa', 'bb', '08/09/2022', '17:11');
INSERT INTO `trip_legs` VALUES ('34', '12', 'a', 'd', '08/02/2022', '18:07');
INSERT INTO `trip_legs` VALUES ('35', '13', 'ad', 'wer', '08/10/2022', '18:12');
INSERT INTO `trip_legs` VALUES ('37', '3', 'aa', 'aa1', '08/01/2022', '23:31');

-- ----------------------------
-- Table structure for `trip_operators`
-- ----------------------------
DROP TABLE IF EXISTS `trip_operators`;
CREATE TABLE `trip_operators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trip` int(11) DEFAULT NULL,
  `operator` int(11) DEFAULT NULL,
  `pax` varchar(255) DEFAULT NULL,
  `cost` varchar(255) DEFAULT NULL,
  `aircraft` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of trip_operators
-- ----------------------------
INSERT INTO `trip_operators` VALUES ('1', '1', '2', '12_', '234_', '3', 'bid');
INSERT INTO `trip_operators` VALUES ('2', '1', '8', '111', '222', '3', 'bid');
INSERT INTO `trip_operators` VALUES ('4', '1', '7', '666', '777', '3', 'won');
INSERT INTO `trip_operators` VALUES ('5', '4', '4', '1231', '4345', '2', 'won');
INSERT INTO `trip_operators` VALUES ('6', '5', '4', '2', '3', '2', 'bid');
INSERT INTO `trip_operators` VALUES ('7', '9', '4', '12', '33', '11', 'won');
INSERT INTO `trip_operators` VALUES ('8', '9', '8', '123', '342', '13', 'won');
INSERT INTO `trip_operators` VALUES ('9', '6', '7', '11', '23', '4', 'Bid');
INSERT INTO `trip_operators` VALUES ('11', '6', '10', '123', '345', '15', 'Bid');
INSERT INTO `trip_operators` VALUES ('12', '6', '12', '123', '234', '12', 'Bid');

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
INSERT INTO `trips` VALUES ('3', '', '6', null, '123', '1', '');
INSERT INTO `trips` VALUES ('4', 'Settled', '5', null, null, '4', null);
INSERT INTO `trips` VALUES ('5', 'Quoted & Pending', '4', null, null, '5', null);
INSERT INTO `trips` VALUES ('6', 'In Work', '3', null, null, '6', null);
INSERT INTO `trips` VALUES ('8', 'Booked', '8', null, null, '7', null);
INSERT INTO `trips` VALUES ('9', 'In Work', '1', '07/31/2022', '12', '0', null);
INSERT INTO `trips` VALUES ('10', 'In Work', '8', '07/31/2022', null, null, null);
INSERT INTO `trips` VALUES ('11', 'In Work', '1', '08/01/2022', '2', '1', null);
INSERT INTO `trips` VALUES ('12', '', '1', '08/01/2022', 'qwe', '1', 'adwer');
INSERT INTO `trips` VALUES ('13', 'Quoted & Pending', '1', '08/01/2022', '123', '3', 'adwerwer');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', 'admin', 'admin', '', 'superadmin');
INSERT INTO `users` VALUES ('2', 'test1', 'test1@email.com', 'test1', 'active', 'admin');
