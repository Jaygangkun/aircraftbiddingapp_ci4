/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : aircraftbiddingapp

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-07-29 05:04:23
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of aircraft_categories
-- ----------------------------
INSERT INTO `aircraft_categories` VALUES ('1', 'aircat1_1');
INSERT INTO `aircraft_categories` VALUES ('3', 'aircat2');
INSERT INTO `aircraft_categories` VALUES ('4', 'cat331');
INSERT INTO `aircraft_categories` VALUES ('5', 'cat33');
INSERT INTO `aircraft_categories` VALUES ('6', 'newcat1');

-- ----------------------------
-- Table structure for `aircrafts`
-- ----------------------------
DROP TABLE IF EXISTS `aircrafts`;
CREATE TABLE `aircrafts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

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

-- ----------------------------
-- Table structure for `bids`
-- ----------------------------
DROP TABLE IF EXISTS `bids`;
CREATE TABLE `bids` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` int(11) DEFAULT NULL,
  `trip` int(11) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `pax` varchar(255) DEFAULT NULL,
  `cost` varchar(255) DEFAULT NULL,
  `aircraft` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bids
-- ----------------------------
INSERT INTO `bids` VALUES ('1', '4', '5', null, '123', '444', '2', 'pending');
INSERT INTO `bids` VALUES ('2', '5', '5', null, '11133', null, '4', 'new');
INSERT INTO `bids` VALUES ('4', '1', '6', null, '555', null, '3', 'Closed');
INSERT INTO `bids` VALUES ('5', '1', '3', null, '123', null, '3', 'pending');
INSERT INTO `bids` VALUES ('6', '1', '3', null, '1233333', null, '3', 'new');
INSERT INTO `bids` VALUES ('7', '5', '5', null, '777', null, '2', 'Booked – Flight Pending');
INSERT INTO `bids` VALUES ('8', '4', '5', null, '12', null, '12', 'new');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('1', 'customer1', 'company1', 'telephone1', 'email1');
INSERT INTO `customers` VALUES ('3', 'cust3', 'com3', 'tel3', 'emial3');
INSERT INTO `customers` VALUES ('4', 'cust4', 'comp4', 'tel4', 'email4');
INSERT INTO `customers` VALUES ('5', 'cust6', 'com5', 'tele5', 'email5');
INSERT INTO `customers` VALUES ('6', 'wer', '', '', '');
INSERT INTO `customers` VALUES ('7', 'newcust1', '', '', '');

-- ----------------------------
-- Table structure for `operator_bids`
-- ----------------------------
DROP TABLE IF EXISTS `operator_bids`;
CREATE TABLE `operator_bids` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid` int(11) DEFAULT NULL,
  `operator` int(11) DEFAULT NULL,
  `pax` varchar(255) DEFAULT NULL,
  `cost` varchar(255) DEFAULT NULL,
  `aircraft` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of operator_bids
-- ----------------------------
INSERT INTO `operator_bids` VALUES ('1', '1', '2', '12_', '234_', '3', 'bid');
INSERT INTO `operator_bids` VALUES ('2', '1', '8', '111', '222', '3', 'bid');
INSERT INTO `operator_bids` VALUES ('4', '1', '7', '666', '777', '3', 'won');
INSERT INTO `operator_bids` VALUES ('5', '4', '4', '1231', '4345', '2', 'won');
INSERT INTO `operator_bids` VALUES ('6', '5', '4', '2', '3', '2', 'bid');
INSERT INTO `operator_bids` VALUES ('7', '9', '4', '12', '33', '11', 'won');
INSERT INTO `operator_bids` VALUES ('8', '9', '8', '123', '342', '13', 'won');

-- ----------------------------
-- Table structure for `operators`
-- ----------------------------
DROP TABLE IF EXISTS `operators`;
CREATE TABLE `operators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of operators
-- ----------------------------
INSERT INTO `operators` VALUES ('2', 'op2_1', 'tel2_1', 'cont2_1');
INSERT INTO `operators` VALUES ('4', 'op4', 'tel4', 'contact4');
INSERT INTO `operators` VALUES ('6', 'op6', 'tel6', 'cont6');
INSERT INTO `operators` VALUES ('7', 'op7', 'tel7', 'con7');
INSERT INTO `operators` VALUES ('8', 'op8', 'tel8', 'contact8');
INSERT INTO `operators` VALUES ('9', 'asd', 'wera', 'werwer');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of trip_legs
-- ----------------------------
INSERT INTO `trip_legs` VALUES ('12', '6', 'we', 'we', '07/14/2022', '19:42');
INSERT INTO `trip_legs` VALUES ('15', '4', 'e', 'e', '07/06/2022', '19:44');
INSERT INTO `trip_legs` VALUES ('16', '5', 'bb', 'ee', '06/29/2022', '19:43');
INSERT INTO `trip_legs` VALUES ('17', '5', 'ee', 'ff', '07/29/2022', '19:25');

-- ----------------------------
-- Table structure for `trips`
-- ----------------------------
DROP TABLE IF EXISTS `trips`;
CREATE TABLE `trips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of trips
-- ----------------------------
INSERT INTO `trips` VALUES ('2', 'trip2', null);
INSERT INTO `trips` VALUES ('3', 'trip3', null);
INSERT INTO `trips` VALUES ('4', 'trip4', 'Settled');
INSERT INTO `trips` VALUES ('5', 'trip5', 'Quoted & Pending');
INSERT INTO `trips` VALUES ('6', 'trip6', 'In Work');
INSERT INTO `trips` VALUES ('8', 'newtrip1', 'Quoting');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
