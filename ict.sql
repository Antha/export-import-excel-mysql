/*
SQLyog Community v12.2.5 (32 bit)
MySQL - 10.4.20-MariaDB : Database - ict
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ict` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `ict`;

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(12) DEFAULT NULL,
  `ITEM` varchar(12) DEFAULT NULL,
  `PRICE` double DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;

/*Data for the table `customers` */

insert  into `customers`(`ID`,`NAME`,`ITEM`,`PRICE`) values 
(5,'Maria','Lamp',2000),
(6,'Nurul','Road',4000),
(7,'Indra','Clothes',1000),
(8,'Dewa','T-Shirt',2000),
(9,'Bekti','Road',4000),
(10,'Indra','Clothes',1000),
(11,'Dewa','T-Shirt',2000),
(13,'Indra','Clothes',1000),
(15,'Bekti','Road',4000),
(19,'Indra','Clothes',1000),
(20,'Dewa','T-Shirt',2000),
(21,'Bekti','Road',4000),
(22,'Indra','Clothes',1000),
(23,'Dewa','T-Shirt',2000),
(24,'Bekti','Road',4000),
(25,'Indra','Clothes',1000),
(26,'Dewa','T-Shirt',2000),
(27,'Bekti','Road',4000),
(28,'Indra','Clothes',1000),
(29,'Dewa','T-Shirt',2000),
(30,'Bekti','Road',4000),
(31,'Indra','Clothes',1000),
(32,'Dewa','T-Shirt',2000),
(33,'Bekti','Road',4000),
(34,'Indra','Clothes',1000),
(35,'Dewa','T-Shirt',2000),
(36,'Bekti','Road',4000),
(37,'Indra','Clothes',1000),
(38,'Dewa','T-Shirt',2000),
(39,'Bekti','Road',4000),
(40,'Indra','Clothes',1000),
(41,'Dewa','T-Shirt',2000),
(42,'Bekti','Road',4000),
(43,'Indra','Clothes',1000),
(44,'Dewa','T-Shirt',2000),
(45,'Bekti','Road',4000);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
