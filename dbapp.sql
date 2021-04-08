-- MariaDB dump 10.18  Distrib 10.4.17-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: dbapp
-- ------------------------------------------------------
-- Server version	10.4.17-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointment` (
  `empid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(7) NOT NULL,
  KEY `pid` (`pid`),
  KEY `empid` (`empid`),
  CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `patient` (`pid`),
  CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`empid`) REFERENCES `employee` (`empid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointment`
--

LOCK TABLES `appointment` WRITE;
/*!40000 ALTER TABLE `appointment` DISABLE KEYS */;
INSERT INTO `appointment` VALUES (185,61,'August 8th, 2020','13:30'),(284,21,'August 7th, 2020','15:30'),(252,34,'August 14th, 2020','17:00'),(975,74,'August 9th, 2020','09:00'),(883,98,'August 8th, 2020','13:30'),(284,77,'August 8th, 2020','10:30'),(185,12,'August 8th, 2020','11:30'),(927,43,'August 10th, 2020','13:30');
/*!40000 ALTER TABLE `appointment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assign_room`
--

DROP TABLE IF EXISTS `assign_room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assign_room` (
  `room_number` int(3) NOT NULL,
  `pid` int(11) NOT NULL,
  KEY `room_number` (`room_number`),
  KEY `pid` (`pid`),
  CONSTRAINT `assign_room_ibfk_1` FOREIGN KEY (`room_number`) REFERENCES `room` (`room_number`),
  CONSTRAINT `assign_room_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `patient` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assign_room`
--

LOCK TABLES `assign_room` WRITE;
/*!40000 ALTER TABLE `assign_room` DISABLE KEYS */;
INSERT INTO `assign_room` VALUES (234,61),(211,34),(202,98),(211,43);
/*!40000 ALTER TABLE `assign_room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `empid` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `birthday` varchar(20) NOT NULL,
  `gender` char(1) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `job_title` varchar(20) NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `hire_date` varchar(20) NOT NULL,
  PRIMARY KEY (`empid`)
) ENGINE=InnoDB AUTO_INCREMENT=976 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (185,'Kelly','Sierra','October 25th, 1988','F','1032 W 91st St, Los Angeles, California, 90044','(323) 933-1126','Doctor',199852.00,'November 22nd, 2014'),(252,'Calvin','Lareina','November 8th, 1985','M','1219 W 54th St, Los Angeles, California, 90037','(310) 836-1558','Doctor',114436.00,'August 8th, 2013'),(284,'Hugo','Middleton','August 8th, 1962','M','10425 Tabor St, Los Angeles, California, 90034','(310) 207-1320','Doctor',182700.00,'June 12th, 1992'),(457,'Keira','Ramsey','November 8th, 1985','F','1000 S Westgate Ave, Los Angeles, California, 90049','(323) 834-1703','Nurse',98531.00,'January 16th, 2011'),(883,'Katherine','Holt','May 4th, 1997','F','1209 W 121st St, Los Angeles, California, 90044','(909) 391-6202','Nurse',75235.00,'May 19th, 2017'),(923,'Harry','Kennedy','October 25th, 1998','M','1262 S Longwood Ave, Los Angeles, California, 90019','(323) 754-3804','Nurse',64189.00,'August 8th, 2018'),(927,'Lewis','Reilly','November 9th, 1990','M','1051 S Sherbourne Dr #1, Los Angeles, California, 90035','(323) 451-3058','Doctor',153521.00,'August 14th, 2015'),(975,'Spencer','Graham','February 22nd, 1981','M','11643 Ruthelen St, Los Angeles, California, 90047','(661) 664-6428','Nurse',100956.00,'December 3rd, 2014');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medication`
--

DROP TABLE IF EXISTS `medication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medication` (
  `medname` varchar(30) NOT NULL,
  `price` float NOT NULL,
  `count` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`medname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medication`
--

LOCK TABLES `medication` WRITE;
/*!40000 ALTER TABLE `medication` DISABLE KEYS */;
INSERT INTO `medication` VALUES ('Amoxicillin',12.88,'30 Tablets','250 Mg Cap Nort'),('Cozaar',177.56,'30 Tablets','100 Mg Tab Merc'),('Crestor',298.42,'30 Tablets','10 Mg Tab Astr'),('Cymbalta',295.44,'30 Tablets','30 Mg Cap Lill'),('Fluoxetine',12.88,'30 Tablets','10 Mg Cap Auro'),('Norvasc',233.18,'30 Tablets','5 Mg Tab Pfiz');
/*!40000 ALTER TABLE `medication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient` (
  `pid` int(11) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `birthday` varchar(20) NOT NULL,
  `gender` char(1) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES (12,'Suzannah','Villa','December 26, 1995','F','(951) 326-9893','4212 Denver Avenue, Los Angeles, California 90017'),(21,'Elin','Humphrey','August 30, 2013','F','(323) 294-3170','5723 Morgan Ave, Los Angeles, California, 90011'),(34,'Glyn','Thornton','October 15, 2012','M','(323) 661-3956','6736 S Sherbourne Dr, Los Angeles, California, 90056'),(43,'Zhane','Padilla','May 6, 1997','M','(213) 430-9190','909-1/2 E 49th St, Los Angeles, California, 90011'),(61,'Alby','Greig','May 25, 2017','F','(323) 294-9917','400 S Main St, Los Angeles, California, 90013'),(74,'Bill','Nelson','January 19, 2010','M','(213) 626-2432','7609 Mckinley Ave, Los Angeles, California, 90001'),(77,'Athena','Graves','January 1, 1998','F','(323) 651-3408','680 E 47th St, Los Angeles, California, 90011'),(98,'Molly','Rios','April 20, 2007','F','(213) 747-0819','9400 S Normandie Ave #14, Los Angeles, California, 90044');
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prescriptions`
--

DROP TABLE IF EXISTS `prescriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prescriptions` (
  `medname` varchar(30) NOT NULL,
  `pid` int(11) NOT NULL,
  `empid` int(11) NOT NULL,
  KEY `medname` (`medname`),
  KEY `pid` (`pid`),
  KEY `empid` (`empid`),
  CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`medname`) REFERENCES `medication` (`medname`),
  CONSTRAINT `prescriptions_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `patient` (`pid`),
  CONSTRAINT `prescriptions_ibfk_3` FOREIGN KEY (`empid`) REFERENCES `employee` (`empid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prescriptions`
--

LOCK TABLES `prescriptions` WRITE;
/*!40000 ALTER TABLE `prescriptions` DISABLE KEYS */;
INSERT INTO `prescriptions` VALUES ('Amoxicillin',61,883),('Fluoxetine',34,923),('Cozaar',98,883),('Crestor',12,975),('Fluoxetine',98,975),('Amoxicillin',43,185);
/*!40000 ALTER TABLE `prescriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room` (
  `room_number` int(3) NOT NULL,
  `room_type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`room_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (103,'Intensive Care'),(111,'Intensive Care'),(202,'Intensive Care'),(211,'Ward'),(222,'Ward'),(234,'Operating Room'),(301,'Operating Room'),(312,'Ward');
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-08  3:06:13
