-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: kiwi
-- ------------------------------------------------------
-- Server version	5.7.11-log

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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `fullname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rentalId` int(11) DEFAULT NULL,
  `gender` varchar(45) DEFAULT 'N/A',
  `referral` varchar(45) DEFAULT 'N/A',
  `timeSum` int(11) DEFAULT '0',
  `costSum` int(11) DEFAULT '0',
  `dateRegistered` date DEFAULT NULL,
  `emailNotifications` tinyint(4) DEFAULT '0',
  `profilePic` varchar(100) DEFAULT 'uploads/default.png',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `rental_idx` (`rentalId`),
  CONSTRAINT `rental` FOREIGN KEY (`rentalId`) REFERENCES `rental` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'ioannis','Ioannis John','ioannis@.','$2y$10$TD7fObHyb00YInb0/jX30uuvk4svSSb0p5lzllQbLgxFFWGablgIO',NULL,'N/A','N/A',330750,312,'2019-05-27',0,'uploads/default.png'),(4,'malamas','Malamas Dianisios','malamas@.','$2y$10$tKzL/u35SHjK5yhFMakOPuDVwh7pVruvPdAHzvQ6YXTWYokG.41na',NULL,'female','sas',259082,228,'2019-05-29',0,'uploads/4.png'),(5,'FanisD','Fanaros Kostakis','mcfanis@gmail.com','$2y$10$G5e4gS8EXnhb2OapseuwNOitDJzJM6nDPtQl9rTs2UUWSTt4nfQju',NULL,'Male','N/A',71,12,'2019-06-01',0,'uploads/default.png'),(6,'rompas','Ioannis Daniil','malamas@rr.com','$2y$10$VY0PxI04ZpAHf4j3kZj01u2AMwatuglVMvRwfEFju8Suttg4TNnne',NULL,'female','NO',37,7,'2019-06-01',0,'uploads/6.jpg'),(7,'asd','asdasd','sada.@dd','$2y$10$vxFULsjiRClcDr.kVgnR6eQyW7nloMHnI3Iv3/ICCXUIn9LH5HtN6',NULL,'N/A','N/A',0,0,'2019-06-01',1,'uploads/default.png'),(8,'mimikos','Mikos Mimikos','mikos@mimikos.com','$2y$10$Sgg/lKB2K9PK4/L5oaQJhehdAXz9BrrQJP1tcI5bOd/zp3m6etCBe',NULL,'N/A','N/A',0,0,'2019-06-01',0,'uploads/8.png'),(9,'faliro','faliro','fa.@liro','$2y$10$jczPfZSD5Cw58NgaotD0BewKYY.Kp34pbxxW3LCx98iNx.Pv.6otm',NULL,'Female','N/A',34,14,'2019-06-03',0,'uploads/9.jpg'),(10,'damalas','Mike Damalas','mike@damalas.com','$2y$10$yFdmkxgIxspkIzBHfuzSVesKiUNS4dl5Hm1ndP3FLUPDWO3Iykpx6',NULL,'N/A','N/A',0,0,'2019-06-04',1,'uploads/default.png'),(11,'mcjohn1','John Daniil','mcjohn@windowslive.com','$2y$10$h2RXmfnzafv38OM4yETKK.1FmdPG2tsEu1tVN3lXDgB4pX2SZ.Ota',NULL,'N/A','N/A',0,0,'2019-06-03',1,'uploads/default.png'),(12,'awawytaw','asfasf','as.g@tasty','$2y$10$YRziPiLkXF6IUCO3teWBluxUZnkAPMFm8.gyb.cVuQb/RXDxFf78O',NULL,'N/A','N/A',0,0,'2019-06-03',0,'uploads/default.png'),(13,'faker1','Fake Account','fake@account.com','$2y$10$QglfPvMx2bMjXXt6LPbAnu99IIuW3kiMgOpfRMq.QdzQjs.2vczwa',NULL,'female','Not really',0,0,'2019-06-03',1,'uploads/default.png');
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

-- Dump completed on 2019-06-04  1:09:24
