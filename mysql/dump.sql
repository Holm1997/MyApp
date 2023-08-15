-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: otrs
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.22.04.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'МФУ'),(2,'Системный блок'),(3,'Моноблок'),(4,'Роутер'),(5,'Свитч'),(6,'Периферийное устройство'),(7,'Видеокамера');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `place_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`),
  KEY `place_id` (`place_id`),
  CONSTRAINT `client_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (17,'Иванов И.И.',NULL,48),(18,'Петров В.И.',NULL,49),(22,'Сазонов В.И.',NULL,50),(23,'Фиронова Е.В.',NULL,51),(24,'Александр',NULL,54),(25,'Петросян И.В',NULL,50),(26,'Мещерин М.Д.',NULL,55);
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_device`
--

DROP TABLE IF EXISTS `client_device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_device` (
  `client_id` int unsigned NOT NULL,
  `device_id` int unsigned NOT NULL,
  KEY `client_id` (`client_id`),
  KEY `device_id` (`device_id`),
  CONSTRAINT `client_device_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE,
  CONSTRAINT `client_device_ibfk_2` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_device`
--

LOCK TABLES `client_device` WRITE;
/*!40000 ALTER TABLE `client_device` DISABLE KEYS */;
/*!40000 ALTER TABLE `client_device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departament`
--

DROP TABLE IF EXISTS `departament`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departament` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departament`
--

LOCK TABLES `departament` WRITE;
/*!40000 ALTER TABLE `departament` DISABLE KEYS */;
INSERT INTO `departament` VALUES (14,'ЗВО'),(13,'ПВТ'),(16,'УКиТР');
/*!40000 ALTER TABLE `departament` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departament_place`
--

DROP TABLE IF EXISTS `departament_place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departament_place` (
  `departament_id` int unsigned NOT NULL,
  `place_id` int unsigned NOT NULL,
  KEY `departament_id` (`departament_id`),
  KEY `place_id` (`place_id`),
  CONSTRAINT `departament_place_ibfk_1` FOREIGN KEY (`departament_id`) REFERENCES `departament` (`id`) ON DELETE CASCADE,
  CONSTRAINT `departament_place_ibfk_2` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departament_place`
--

LOCK TABLES `departament_place` WRITE;
/*!40000 ALTER TABLE `departament_place` DISABLE KEYS */;
INSERT INTO `departament_place` VALUES (13,48),(13,50),(14,49),(14,51),(16,54);
/*!40000 ALTER TABLE `departament_place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device`
--

DROP TABLE IF EXISTS `device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `device` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `inventory_number` varchar(100) DEFAULT NULL,
  `category_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `device_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device`
--

LOCK TABLES `device` WRITE;
/*!40000 ALTER TABLE `device` DISABLE KEYS */;
INSERT INTO `device` VALUES (17,'',NULL,6),(18,'',NULL,4),(19,'',NULL,3),(20,'',NULL,6),(21,'',NULL,1),(22,'',NULL,1),(23,'',NULL,1),(24,'',NULL,1),(25,'',NULL,1),(26,'',NULL,3),(27,'',NULL,1),(28,'hp layzerjet 1200',NULL,1),(29,'hp layzerjet 1200',NULL,1),(30,'',NULL,7);
/*!40000 ALTER TABLE `device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `place`
--

DROP TABLE IF EXISTS `place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `place` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `place`
--

LOCK TABLES `place` WRITE;
/*!40000 ALTER TABLE `place` DISABLE KEYS */;
INSERT INTO `place` VALUES (48,'ГЗ, кабинет 1107','33-15'),(49,'ГЗ, кабинет 1303','45-12'),(50,'ГЗ ж-107','67-87'),(51,'2ой ГУМ, 866 к.','12-34'),(52,'ГЗ, Ж 103','77-88'),(53,'ГЗ, кабинет 999','66-89'),(54,'ГЗ, к.1124','28-89'),(55,'2ой ГУМ, к. 923','11-11');
/*!40000 ALTER TABLE `place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(200) NOT NULL,
  `description` text,
  `ticket_status` enum('Новая заявка','В работе','Не выполнена','Выполнена успешно','Повторная заявка') NOT NULL,
  `client_id` int unsigned DEFAULT NULL,
  `category_id` int unsigned DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  `working_date` datetime DEFAULT NULL,
  `closing_date` datetime DEFAULT NULL,
  `place_id` int unsigned NOT NULL,
  `previous` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `category_id` (`category_id`),
  KEY `place_id` (`place_id`),
  CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (79,'не работает блок питания','Перегорел БП. нужна замена','Не выполнена',17,1,'2023-08-11 14:08:15','2023-08-11 14:11:43','2023-08-15 13:18:09',48,NULL),(80,'не работает блок питания',NULL,'В работе',25,3,'2023-08-14 11:02:34','2023-08-14 11:09:56',NULL,50,NULL),(81,'Нет отклика от сервера','Были проблемы с сетью, все устранил -работает','Выполнена успешно',17,7,'2023-08-14 11:10:36','2023-08-14 11:38:33','2023-08-15 14:50:23',48,NULL),(82,'Не сканирует в папку scan','Включил SMB','Выполнена успешно',24,1,'2023-08-14 11:21:08','2023-08-14 11:49:42','2023-08-14 11:52:23',54,NULL),(83,'Отьебнуло','Не получилось починить','Не выполнена',24,3,'2023-08-14 11:53:27','2023-08-14 11:54:15','2023-08-14 11:54:31',54,NULL),(84,'Замена блока питания',NULL,'Повторная заявка',17,1,'2023-08-15 13:19:45',NULL,NULL,48,79),(86,'Не работает мышка',NULL,'Новая заявка',NULL,6,'2023-08-15 13:45:23',NULL,NULL,50,NULL),(89,'Не печатает, не сканирует','Удалил МФУ из списка устройств, добавил его по IP-адресу, установил драйвера','Выполнена успешно',17,1,'2023-08-15 13:59:20','2023-08-15 14:00:02','2023-08-15 14:03:57',48,NULL),(96,'Принеси попить ))',NULL,'Новая заявка',26,1,'2023-08-15 14:41:11',NULL,NULL,55,NULL);
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_device`
--

DROP TABLE IF EXISTS `ticket_device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket_device` (
  `ticket_id` int unsigned NOT NULL,
  `device_id` int unsigned NOT NULL,
  KEY `ticket_id` (`ticket_id`),
  KEY `device_id` (`device_id`),
  CONSTRAINT `ticket_device_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ticket_device_ibfk_2` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_device`
--

LOCK TABLES `ticket_device` WRITE;
/*!40000 ALTER TABLE `ticket_device` DISABLE KEYS */;
INSERT INTO `ticket_device` VALUES (82,25),(83,26),(79,27),(89,28),(89,29),(81,30);
/*!40000 ALTER TABLE `ticket_device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_user`
--

DROP TABLE IF EXISTS `ticket_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket_user` (
  `ticket_id` int unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  KEY `ticket_id` (`ticket_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `ticket_user_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ticket_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_user`
--

LOCK TABLES `ticket_user` WRITE;
/*!40000 ALTER TABLE `ticket_user` DISABLE KEYS */;
INSERT INTO `ticket_user` VALUES (79,2),(80,2),(81,2),(82,4),(83,4),(84,2),(NULL,2),(86,2),(89,18),(96,18);
/*!40000 ALTER TABLE `ticket_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_roles_id` int unsigned DEFAULT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `phone` (`phone`),
  KEY `user_roles_id` (`user_roles_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_roles_id`) REFERENCES `user_roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,'root','root','Рутов','Рут','8(999)555-55-55'),(2,2,'max','12345','Мещерин','Максим','8(916)404-11-57'),(4,2,'vlad','19950200','Беляков','Владислав','8(915)323-47-57'),(16,2,'dfggasqwer','1234567890','Сурков','павел','8(915)323-47-66'),(18,2,'emajorov','1234567890','Майоров','Емельян','8(967)069-22-25');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (1,'Руководитель'),(2,'Мастер по тсп');
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-15 15:06:23
