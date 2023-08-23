-- MySQL dump 10.13  Distrib 8.0.34, for Linux (x86_64)
--
-- Host: localhost    Database: otrs
-- ------------------------------------------------------
-- Server version	8.0.34-0ubuntu0.22.04.1

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
  `phone` varchar(13) DEFAULT NULL,
  `place_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`),
  KEY `place_id` (`place_id`),
  CONSTRAINT `client_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (18,'Петров В.И.','905-726-68-25',49),(22,'Сазонов В.И.',NULL,50),(23,'Фиронова Е.В.',NULL,51),(24,'Александр',NULL,54),(25,'Петросян И.В',NULL,50),(26,'Мещерин М.Д.','909-777-55-55',55),(27,'Ганеива Т.В.',NULL,56),(32,'Пупкин З.З.',NULL,59),(33,'Петров П.П.','905-463-33-34',64),(34,'Петросян И.В',NULL,61),(35,'Сазонов В.И.',NULL,58),(37,'Вржещ П.В.',NULL,68),(38,'Губастый Г.Ф.',NULL,63),(39,'Оразова М.Х.',NULL,69),(40,'Сазонова Я.И.',NULL,55);
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departament`
--

LOCK TABLES `departament` WRITE;
/*!40000 ALTER TABLE `departament` DISABLE KEYS */;
INSERT INTO `departament` VALUES (18,'ВВВ'),(17,'ВУС'),(19,'ЖЕЖ'),(14,'ЗВО'),(13,'ПВТ'),(16,'УКиТР'),(21,'УпОВ'),(22,'УПР'),(20,'ЦУЗЯР');
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
INSERT INTO `departament_place` VALUES (13,48),(13,50),(14,49),(14,51),(16,54),(17,56),(13,55),(19,61),(17,58),(13,62),(19,59),(16,64),(18,63),(18,60),(18,53),(18,63),(21,68),(20,66),(22,69);
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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device`
--

LOCK TABLES `device` WRITE;
/*!40000 ALTER TABLE `device` DISABLE KEYS */;
INSERT INTO `device` VALUES (17,'',NULL,6),(18,'',NULL,4),(19,'',NULL,3),(20,'',NULL,6),(21,'',NULL,1),(22,'',NULL,1),(23,'',NULL,1),(24,'',NULL,1),(25,'',NULL,1),(26,'',NULL,3),(27,'',NULL,1),(28,'hp layzerjet 1200',NULL,1),(29,'hp layzerjet 1200',NULL,1),(30,'',NULL,7),(31,'LENOVO',NULL,3),(32,'Бутылка палпи',NULL,1),(33,'Бутылка палпи',NULL,1),(34,'',NULL,6),(35,'',NULL,1),(36,'',NULL,4),(37,'',NULL,2),(38,'',NULL,2),(39,'',NULL,6),(40,'',NULL,2),(41,'',NULL,3),(42,'',NULL,7),(43,'',NULL,7),(44,'',NULL,4),(45,'',NULL,1),(46,'',NULL,2),(47,'',NULL,1),(48,'',NULL,2),(49,'',NULL,6),(50,'',NULL,5),(51,'Печатная машинка',NULL,1),(52,'Печатная машинка',NULL,1),(53,'',NULL,1),(54,'',NULL,1),(55,'',NULL,3),(56,'',NULL,3),(57,'',NULL,1),(58,'',NULL,2),(59,'',NULL,2),(60,'',NULL,6);
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
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `place`
--

LOCK TABLES `place` WRITE;
/*!40000 ALTER TABLE `place` DISABLE KEYS */;
INSERT INTO `place` VALUES (48,'ГЗ, кабинет 1107','33-15'),(49,'ГЗ, кабинет 1303','45-12'),(50,'ГЗ ж-107','67-87'),(51,'2ой ГУМ, 866 к.','12-34'),(53,'ГЗ, кабинет 999','66-89'),(54,'ГЗ, к.1124','28-89'),(55,'2ой ГУМ, к. 923','11-11'),(56,'ГЗ, В-118','17-40'),(58,'ГЗ, 1108','12-12'),(59,'ГЗ, 1109','32-23'),(60,'ГЗ, кабинет 134562','33-53'),(61,'ГЗ, 1141','41-41'),(62,'2ой ГУМ, 777','77-79'),(63,'ГЗ, кабинет 1333','77-13'),(64,'ГЗ, 456','31-13'),(66,'ГЗ, 11111','33-33'),(68,'ГЗ, 1031','50-04'),(69,'ГЗ, 1028','56-00');
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
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (80,'не работает блок питания','wdwdwdwdwdwdwd','Выполнена успешно',25,3,'2023-08-14 11:02:34','2023-08-14 11:09:56','2023-08-22 13:00:58',50,NULL),(82,'Не сканирует в папку scan','Включил SMB','Выполнена успешно',24,1,'2023-08-14 11:21:08','2023-08-14 11:49:42','2023-08-14 11:52:23',54,NULL),(83,'Отьебнуло','Не получилось починить','Не выполнена',24,3,'2023-08-14 11:53:27','2023-08-14 11:54:15','2023-08-14 11:54:31',54,NULL),(97,'Выключается экран','Переустановили видеодрайвера','Выполнена успешно',27,3,'2023-08-15 15:24:31','2023-08-15 15:24:38','2023-08-15 15:31:53',56,NULL),(99,'Нет Интернета','qqqqqqqqqqqqqqqqqqqqqq','Выполнена успешно',35,4,'2023-08-15 16:09:12','2023-08-16 15:48:37','2023-08-18 14:56:57',58,NULL),(102,'Мышь сдохла','fqfwfqwfqwfqfwq','Выполнена успешно',34,6,'2023-08-16 14:28:33','2023-08-16 15:47:20','2023-08-18 14:42:17',61,NULL),(104,'не работает кулер','ццццццццццццццццц','Выполнена успешно',40,6,'2023-08-16 15:28:01','2023-08-16 15:46:35','2023-08-22 13:02:18',55,NULL),(105,'Не работает видеокамера','qqqqqqqqqqqqqqqqqqq','Выполнена успешно',26,7,'2023-08-16 16:06:16','2023-08-16 16:06:20','2023-08-18 14:56:42',55,NULL),(107,'не работает кулер','wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww','Выполнена успешно',26,2,'2023-08-17 10:04:55','2023-08-18 14:57:23','2023-08-18 14:57:33',55,NULL),(108,'не работает сканнер','ddddwdwwdw','Не выполнена',38,1,'2023-08-17 12:47:43','2023-08-21 13:06:16','2023-08-22 13:01:20',63,NULL),(111,'не работает сканнер',NULL,'В работе',NULL,1,'2023-08-17 14:58:18','2023-08-22 11:48:26',NULL,62,NULL),(112,'Нет роутера','аоааа','Выполнена успешно',32,4,'2023-08-17 16:06:46','2023-08-17 16:07:40','2023-08-17 16:07:50',59,NULL),(113,'Проблемы с Б/П','аглоб','Не выполнена',33,2,'2023-08-17 16:10:52','2023-08-17 16:11:30','2023-08-17 16:11:57',64,NULL),(115,'не работает кулер','wqwqwqwqwqwqwqwqwvvxvxcvxcvxcvcx','Выполнена успешно',23,2,'2023-08-18 14:45:32','2023-08-18 14:45:37','2023-08-18 14:58:21',51,103),(116,'не работает блок питания','wwwwwwwww','Выполнена успешно',26,5,'2023-08-18 14:55:58','2023-08-18 14:57:39','2023-08-18 14:58:53',55,NULL),(117,'не работает блок питания',NULL,'В работе',26,5,'2023-08-21 10:46:07','2023-08-21 10:46:21',NULL,55,NULL),(120,'не работает хрень','fwfwfwfwfwfwf','Не выполнена',26,3,'2023-08-21 11:17:29','2023-08-21 12:04:23','2023-08-21 15:28:20',55,NULL),(122,'Не печатает, не сканирует','Добавил в настройках порта новый IP-адрес','Выполнена успешно',37,1,'2023-08-21 11:53:29','2023-08-21 11:54:33','2023-08-21 11:55:12',68,NULL),(123,'не работает блок питания',NULL,'В работе',33,2,'2023-08-21 12:21:05','2023-08-22 11:29:34',NULL,64,113),(124,'не печатает, не сканирует','Восстановил соединение путём назначения нового IP-адреса ','Выполнена успешно',39,1,'2023-08-21 14:37:24','2023-08-21 14:38:56','2023-08-21 14:39:41',69,NULL),(125,'не работает блок питания','цйвйцйцвйцвййцвй','Выполнена успешно',40,2,'2023-08-22 11:26:02','2023-08-22 11:45:19','2023-08-22 13:02:00',55,NULL),(126,'не работает блок питания',NULL,'В работе',26,3,'2023-08-22 11:45:49','2023-08-22 15:25:17',NULL,55,120),(127,'не работает кулер',NULL,'Новая заявка',NULL,5,'2023-08-22 11:46:49',NULL,NULL,50,NULL),(128,'не работает хрень',NULL,'Новая заявка',NULL,5,'2023-08-22 14:42:20',NULL,NULL,48,NULL);
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
INSERT INTO `ticket_device` VALUES (82,25),(83,26),(97,31),(104,34),(112,36),(113,37),(102,39),(105,42),(105,43),(99,44),(107,46),(115,48),(116,50),(122,53),(124,54),(120,55),(80,56),(108,57),(125,58),(125,59),(104,60);
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
INSERT INTO `ticket_user` VALUES (80,2),(82,4),(83,4),(NULL,2),(97,18),(99,18),(102,18),(104,16),(105,18),(107,4),(107,18),(108,2),(111,4),(112,18),(113,18),(115,4),(116,2),(116,4),(116,16),(116,18),(117,18),(120,2),(122,18),(123,2),(123,4),(124,18),(125,4),(126,2),(126,18),(127,4),(128,4),(128,18);
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
INSERT INTO `user` VALUES (1,1,'root','root','Рутов','Рут','8(999)555-55-55'),(2,2,'max','12345','Мещерин','Максим','8(916)404-11-57'),(4,2,'vlad','19950200','Беляков','Владислав','8(915)323-47-57'),(16,2,'dfggasqwer','1234567890','Сурков','павел','8(915)323-47-66'),(18,2,'emajorov','2429','Майоров','Емельян','8(967)069-22-25');
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

-- Dump completed on 2023-08-23 11:43:37
