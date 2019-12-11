-- MySQL dump 10.13  Distrib 8.0.17, for Win64 (x86_64)
--
-- Host: localhost    Database: hms
-- ------------------------------------------------------
-- Server version	8.0.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `user_id` int(11) NOT NULL,
  `reserveNum` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (21,0),(23,0),(27,0),(28,0),(29,0),(30,0),(31,0),(32,0),(33,0),(34,0),(35,0),(36,0),(37,0),(38,0),(39,0),(40,0);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee` (
  `userId` int(11) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (26,1,134786);
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `has`
--

DROP TABLE IF EXISTS `has`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `has` (
  `hotelID` tinyint(4) DEFAULT NULL,
  `userID` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `has`
--

LOCK TABLES `has` WRITE;
/*!40000 ALTER TABLE `has` DISABLE KEYS */;
INSERT INTO `has` VALUES (1,2),(2,13),(3,5),(4,20),(5,8),(6,22),(7,4),(8,8),(9,30),(10,3),(11,9),(12,7),(13,1),(14,23),(15,6),(16,8),(11,26);
/*!40000 ALTER TABLE `has` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `have`
--

DROP TABLE IF EXISTS `have`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `have` (
  `userId` int(11) NOT NULL,
  `cardNum` varchar(128) NOT NULL,
  PRIMARY KEY (`userId`,`cardNum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `have`
--

LOCK TABLES `have` WRITE;
/*!40000 ALTER TABLE `have` DISABLE KEYS */;
INSERT INTO `have` VALUES (21,'UWRSanN3WEtUNStoYzRicUZ4b0JuVzRzZkNoTnFlbDllcHVUL21zTm1taz06OpjJbkWBUzkZUfxIqi3PVAk='),(27,'ZWxQVWZqOGtMZFAyYktWbEFSVVRtSE9mbUEzM1M2UmF6ci9EeCtYSUNFQT06OjEN/CEdsHnuhqx4gsC8cBk='),(28,'alFvY0RCVjdVS040b0Q4RjdXaWlDZUNRYzFiUmVSQWxCUDFFOXUzRVFZQT06OvYAy7LWhRoUOPTzwz3jcOc='),(29,'bWttcHZYSVBTb3JlS0VUd0s1RE42MHJkTGpWbXlhSXpUclJYQnRxbW4xTT06OpKVdvVlF86BNPcFQNMoaPU='),(30,'dW9GZ1pwSXcwa1FSSGEyeUdDNnVhWDRxSXJPSjlnMUhJVVpqeGE4bVZCbz06Oj4N2YCSvrrfOVKkl3N8KII='),(31,'WFZGRUJkR3RnWG1aVG5TbjBJd002ZmNBTDNXSUU3V0Roa1V4YVpnUjhQZz06OktORylGKDT4WWNpKkBj7QY='),(32,'bzdCUTlacmtHd3cwVjk2V2tnMVJyc1c5NTlocjRjSUZWR1F0cTFBMm00cz06OpjhWpjUS4XODsPz4PoDQhA='),(33,'b2VGck1tRmVKOTBZeU1tOXBwOVJBNW1lVG1QY0YwOE5hSlFZaEJaM1hTbz06OlubZEQG4Cc6ssjvroRc12E='),(34,'M3M0NHkydTdwUnAzY3JGcit3d1paUGRJNlpIWXhxYzRPK1lYS0UzWkVDbz06OllECjqKn2vNKxLMAVx56Kw='),(35,'dG95a2hzQmEvZnVmSkNTTENxQzR4TjhJQkJmQUtRbElYMDV4T2FQWElydz06Ooq3yf2MIkHRoV/+29mspOE='),(36,'WUdwajFWM2JDNldzeXhlbktjQlJUNUsybi9JZHQrT2t5NFhKUXhyTGdqND06OmGmfnKNnT6DNQiIAVfbzKM='),(37,'N2V6VVp5UFVvTWZNRzVUZXNhNHB0K3RPOGZWbjZ1bytVMnZncUNBSW5rRT06Otxtag80yVF+KXxQoHTk9IQ='),(38,'dmRJV2M1TVFIaXY4TG8rWDJOZjl6L09xSVFHK29nTTNwNU5QRHNlYzlRaz06OrJ2yOK2ZGldvADl/8CT060='),(39,'cmkwc2dabkppV0FibmJOck5LZzJUY1RsZGErd1hpdlZBbyt0ekFuWW1wST06OmZwICGiNKZBnTW5z6Rh/UA='),(40,'ZndJT1QxeUFwSVNvWlJQbmRnMWpvSjhNeDU1SUZlTXNDUHdxQk4rdHBuUT06Ok+Y2t/h3VLOkt7fJ1xAk24=');
/*!40000 ALTER TABLE `have` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel`
--

LOCK TABLES `hotel` WRITE;
/*!40000 ALTER TABLE `hotel` DISABLE KEYS */;
INSERT INTO `hotel` VALUES (1,'Hotel De Anza','233 W Santa Clara St, San Jose, CA 95113'),(2,'Hyatt Place San Jose/Downtown','282 S Almaden Blvd, San Jose, CA 95113'),(3,'Hotel Fairmont San Jose','170 S Market St, San Jose, CA 95113'),(4,'Four Points by Sheraton San Jose Downtown','211 S 1st St, San Jose, CA 95113'),(5,'Holiday Inn San Jose - Silicon Valley','1350 N 1st St, San Jose, CA 95112'),(6,'Wyndham Garden San Jose Airport','1355 N 4th St, San Jose, CA 95112'),(7,'Staybridge Suites San Jose','1602 Crane Ct, San Jose, CA 95112'),(8,'Hyatt Place San Jose Airport','82 Karina Ct, San Jose, CA 95131'),(9,'DoubleTree by Hilton Hotel San Jose','2050 Gateway Pl, San Jose, CA 95110'),(10,'Hampton Inn & Suites San Jose Airport','2088 N 1st St, San Jose, CA 95131'),(11,'Avatar Hotel','4200 Great America Pkwy, Santa Clara, CA 95054'),(12,'Best Western University Inn Santa Clara','1655 El Camino Real, Santa Clara, CA 95050'),(13,'Hilton Garden Inn San Jose/Milpitas','30 Ranch Dr, Milpitas, CA 95035'),(14,'Hilton Santa Clara','4949 Great America Pkwy, Santa Clara, CA 95054'),(15,'Hyatt Regency Santa Clara','5101 Great America Pkwy, Santa Clara, CA 95054'),(16,'Hyatt House San Jose/Silicon Valley','75 Headquarters Dr, San Jose, CA 95134');
/*!40000 ALTER TABLE `hotel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventory` (
  `itemId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`itemId`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
INSERT INTO `inventory` VALUES (1,'Dishes','Needed for kitchens and restaurants',4999),(2,'Chair','Needed by various rooms and lobby',2500),(3,'Couch','Needed by various rooms and lobby',2000),(4,'Table','Needed by various rooms and lobby',1000),(5,'Bed','Needed for rooms',1000),(6,'TV','Needed for various rooms',800),(7,'Silverware','Needed for kitchens and restaurants',8000),(8,'Towel','Needed for rooms and restaurants',15000),(9,'Steak','Needed for kitchen',3000),(10,'Chicken','Needed for kitchen',3000),(11,'Shrimp','Needed for kitchen',1500),(12,'Vegetable','Needed for kitchen',1500),(13,'Potato','Needed for kitchen',4000),(14,'Mirror','Needed for various rooms',1000),(15,'Hairdryer','Needed for rooms',1000);
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keep`
--

DROP TABLE IF EXISTS `keep`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `keep` (
  `hotelId` int(11) NOT NULL,
  `inventoryItemId` int(11) NOT NULL,
  PRIMARY KEY (`hotelId`,`inventoryItemId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keep`
--

LOCK TABLES `keep` WRITE;
/*!40000 ALTER TABLE `keep` DISABLE KEYS */;
INSERT INTO `keep` VALUES (1,2),(1,3),(1,5),(2,1),(2,4),(3,6),(4,7),(5,10),(6,8),(7,9),(8,11),(9,13),(12,12),(12,15),(14,14);
/*!40000 ALTER TABLE `keep` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment` (
  `name` varchar(64) DEFAULT NULL,
  `cardNum` varchar(128) NOT NULL,
  `cvv` varchar(128) DEFAULT NULL,
  `expDate` date DEFAULT NULL,
  PRIMARY KEY (`cardNum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES ('Sample NameOne','alFvY0RCVjdVS040b0Q4RjdXaWlDZUNRYzFiUmVSQWxCUDFFOXUzRVFZQT06OvYAy7LWhRoUOPTzwz3jcOc=','VXYwaXIwdkErNW5SNi8yMWMzZ2NZQT09OjoQbOgGZnxnRZxWgbI1ipic','2022-02-08'),('Sample NameSix','b2VGck1tRmVKOTBZeU1tOXBwOVJBNW1lVG1QY0YwOE5hSlFZaEJaM1hTbz06OlubZEQG4Cc6ssjvroRc12E=','UHNwMDdPWlVMMVpld09IZXQ4WmJKdz09OjpL75JQrHyAy94Z0/nsAy5O','2021-10-08'),('Sample NameTwo','bWttcHZYSVBTb3JlS0VUd0s1RE42MHJkTGpWbXlhSXpUclJYQnRxbW4xTT06OpKVdvVlF86BNPcFQNMoaPU=','L0k1WjF2cG1QL1JtYjE3NDRKRi8wdz09OjqhaqH0ZFUfJX1zHfvSOaso','2022-12-13'),('Sample NameFive','bzdCUTlacmtHd3cwVjk2V2tnMVJyc1c5NTlocjRjSUZWR1F0cTFBMm00cz06OpjhWpjUS4XODsPz4PoDQhA=','UEhDSC9VLzBqeVZvWll5d2IxcXZFdz09OjptpEXN96lCVf31YDk0ZIpE','2022-09-04'),('Sample NameTwelve','cmkwc2dabkppV0FibmJOck5LZzJUY1RsZGErd1hpdlZBbyt0ekFuWW1wST06OmZwICGiNKZBnTW5z6Rh/UA=','a21UcmlycWhTcTA2RndBSlZJZ0tjQT09OjrMZc0+vQowNPM1nE4a/fwz','2019-12-20'),('Sample NameEight','dG95a2hzQmEvZnVmSkNTTENxQzR4TjhJQkJmQUtRbElYMDV4T2FQWElydz06Ooq3yf2MIkHRoV/+29mspOE=','aHZVUXFtVjRQQWhxUVhlMlgyVG1mdz09Ojr0ZaNfoY0HJW4wKlLYTeQd','2023-12-08'),('Sample NameEleven','dmRJV2M1TVFIaXY4TG8rWDJOZjl6L09xSVFHK29nTTNwNU5QRHNlYzlRaz06OrJ2yOK2ZGldvADl/8CT060=','SlppSjYvT0IyWW80Q0oybDVGcU9Ldz09OjqQxIrjDtd5e8e9i0eb8Wk6','2024-12-08'),('Sample NameThree','dW9GZ1pwSXcwa1FSSGEyeUdDNnVhWDRxSXJPSjlnMUhJVVpqeGE4bVZCbz06Oj4N2YCSvrrfOVKkl3N8KII=','TUN1UUhLL1FZZDg5Ynh1VThzQlZ4UT09OjoMBESQ+biu301IPIKRKs5Y','2022-12-08'),('Sample NameSeven','M3M0NHkydTdwUnAzY3JGcit3d1paUGRJNlpIWXhxYzRPK1lYS0UzWkVDbz06OllECjqKn2vNKxLMAVx56Kw=','K2gxY2FrRE4wNlczbDI2eHZRRjYrQT09Ojp6WwsGZFsHdCLPTEFJs8/d','2022-12-08'),('Sample NameTen','N2V6VVp5UFVvTWZNRzVUZXNhNHB0K3RPOGZWbjZ1bytVMnZncUNBSW5rRT06Otxtag80yVF+KXxQoHTk9IQ=','cVFlNldZOGV2bjZZS2ozS2RQM25PZz09Ojo9Ca37grHpeOy1SFOFiZlN','2023-12-08'),('Bronsin Benyamin Pouran','UWRSanN3WEtUNStoYzRicUZ4b0JuVzRzZkNoTnFlbDllcHVUL21zTm1taz06OpjJbkWBUzkZUfxIqi3PVAk=','YlJUNFdEYTRKZk1LZ1djY015N0Fwdz09OjoMCMtDq+2irbRyhlVxsbik','2022-11-29'),('Sample NameFour','WFZGRUJkR3RnWG1aVG5TbjBJd002ZmNBTDNXSUU3V0Roa1V4YVpnUjhQZz06OktORylGKDT4WWNpKkBj7QY=','U2lYWFpTZjhVMGNtak1jRzFZN1RVQT09OjrGmoRR/cOmyU+8pWM4f86v','2023-04-05'),('Sample NameNine','WUdwajFWM2JDNldzeXhlbktjQlJUNUsybi9JZHQrT2t5NFhKUXhyTGdqND06OmGmfnKNnT6DNQiIAVfbzKM=','R05PT2hNbFhLL1AwMzRMVEI4R214Zz09Ojp5HsEd3LmEgPkymT4ssdP4','2024-04-29'),('Sample Name','ZndJT1QxeUFwSVNvWlJQbmRnMWpvSjhNeDU1SUZlTXNDUHdxQk4rdHBuUT06Ok+Y2t/h3VLOkt7fJ1xAk24=','VzQwZitVSlNjOXoyKy8vNFJ4MGV4QT09OjpSvYyrnK0P+wvSnFEqwnDj','2023-03-12'),('Mike Wu','ZWxQVWZqOGtMZFAyYktWbEFSVVRtSE9mbUEzM1M2UmF6ci9EeCtYSUNFQT06OjEN/CEdsHnuhqx4gsC8cBk=','WFcvL3haUW8rOUVrUWhaWVI2aHJjQT09OjqKa4qatRf+5h1cjmH9JZYm','2021-02-06');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserve`
--

DROP TABLE IF EXISTS `reserve`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reserve` (
  `hotelId` int(11) NOT NULL,
  `RoomNum` int(11) NOT NULL,
  `Customerid` int(11) NOT NULL,
  `StartFrom` date NOT NULL,
  `EndTo` date NOT NULL,
  `adults` tinyint(4) NOT NULL,
  `children` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`hotelId`,`RoomNum`,`Customerid`,`StartFrom`,`EndTo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserve`
--

LOCK TABLES `reserve` WRITE;
/*!40000 ALTER TABLE `reserve` DISABLE KEYS */;
INSERT INTO `reserve` VALUES (2,653,21,'2019-12-08','2019-12-13',1,2),(2,653,21,'2020-05-08','2020-05-13',1,0),(4,721,21,'2019-12-08','2019-12-13',2,2),(5,613,21,'2019-12-08','2019-12-13',1,0),(7,24,21,'2019-12-08','2019-12-13',1,0),(7,24,21,'2020-03-08','2020-03-13',1,0),(9,811,21,'2019-12-08','2019-12-13',4,2),(9,811,27,'2020-01-06','2020-02-11',1,0),(10,240,21,'2019-12-19','2019-12-22',2,2),(10,240,21,'2020-01-08','2020-01-13',1,0),(11,456,21,'2019-12-08','2019-12-13',1,0),(12,491,21,'2019-12-12','2019-12-20',2,1),(13,564,21,'2019-12-08','2019-12-13',2,3),(14,124,21,'2019-12-06','2019-12-11',1,0),(14,124,21,'2019-12-11','2019-12-22',3,0);
/*!40000 ALTER TABLE `reserve` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `room` (
  `hotelID` int(11) DEFAULT NULL,
  `roomNum` smallint(6) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `price` float DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (14,124,'Single',0,145.43),(2,653,'Double',0,252.72),(12,491,'Triple',0,312.49),(9,811,'Suite',0,682.99),(7,24,'Regular',0,422.99),(10,240,'Double',0,242.99),(11,456,'Suite',0,542.99),(11,349,'Single',0,135.87),(13,564,'Regular',0,346.45),(4,721,'Triple',0,316.75),(11,271,'Single',0,156.25),(17,419,'Double',0,262.63),(12,879,'Suite',0,722.49),(3,329,'Regular',0,362.62),(5,613,'Double',0,272.61);
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(32) DEFAULT NULL,
  `firstName` varchar(32) DEFAULT NULL,
  `lastName` varchar(32) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `passHash` char(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (21,'bronsinb','Bronsin','Benyamin Pouran','test@email.com','12dc0b90380f7fa531704e72507d9d63'),(26,'bronsin','Bronsin','Pouran','test@i.com','12dc0b90380f7fa531704e72507d9d63'),(27,'Mike.Wu','Mike','WU','mike.wu@sjsu.edu','35c2ebff598d117b8a32909b0ed77e3a'),(28,'username1','FirstSample1','LastSample1','user1@email.com','86660f58332f52cd49e72b0b41d39597'),(29,'username2','FirstSample2','LastSample2','user2@email.com','cc4cb6a5a09c342d9f7f22882685d2a8'),(30,'username3','FirstSample3','LastSample3','user3@email.com','cdf26213a150dc3ecb610f18f6b38b46'),(31,'username4','FirstSample4','LastSample4','user4@email.com','031d6962b01029ec569472a1eb3a666c'),(32,'username5','FirstSample5','LastSample5','user5@email.com','04b2ae5a6df1c8ba3177349dc92dc366'),(33,'username6','FirstSample6','LastSample6','user6@email.com','a86da8b5d1a1d80790f13de5f9983a00'),(34,'username7','FirstSample7','LastSample7','user7@email.com','680f8186cdb149e69d55cc13102ae49b'),(35,'username8','FirstSample8','LastSample8','user8@email.com','c9e23e556d35bb3b033c3147ae01dd73'),(36,'username9','FirstSample9','LastSample9','user9@email.com','a822b5de3c383403657ba2ccefce32e9'),(37,'username10','FirstSample10','LastSample10','user10@email.com','92309be46df6f9cb090f10f2bc536b5b'),(38,'username11','FirstSample11','LastSample11','user11@email.com','5294422f1b98c553892b43c37a0b8eb1'),(39,'username12','FirstSample12','LastSample12','user12@email.com','e2a66d34975f5ee7ba73a974cb560c04'),(40,'username','FirstSample','LastSample','user@email.com','ffc70bb6ea80756034bbb0575fad4191');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-10 17:45:14
