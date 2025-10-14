/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.14-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: finanza
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

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
-- Table structure for table `bollette`
--

DROP TABLE IF EXISTS `bollette`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `bollette` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `ref_year` int(11) DEFAULT NULL,
  `ref_month` int(11) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `referral_period` text DEFAULT NULL,
  `consumption` text DEFAULT NULL,
  `unit_cost` float GENERATED ALWAYS AS (case when `consumption` regexp '^[0-9]+(\\.[0-9]+)?$' and `consumption` is not null and `consumption` <> '0' then `amount` / cast(`consumption` as decimal(15,6)) else NULL end) STORED,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bollette`
--

LOCK TABLES `bollette` WRITE;
/*!40000 ALTER TABLE `bollette` DISABLE KEYS */;
INSERT INTO `bollette` VALUES
(1,'Luce',2025,1,'2025-01-12',NULL,104.19,'Novembre 2024 – Dicembre 2024','310',0.336097,'[ CC ]','2025-01-16 12:29:03','2025-07-18 06:22:13'),
(2,'Internet',2025,1,'2025-01-25',NULL,29.95,'Gennaio',NULL,NULL,'\r\n                                 Fastweb [ CC ]                            ','2025-01-16 12:30:56','2025-08-27 07:01:47'),
(3,'Netflix',2025,1,'2025-01-08',NULL,13.99,'Gennaio',NULL,NULL,'[ Virtual gennaioMarzo ]','2025-01-16 12:32:15','2025-01-16 12:32:15'),
(4,'Alleanza',2025,1,'2025-01-10',NULL,104,NULL,NULL,NULL,'[ CC ]','2025-01-16 12:34:20','2025-01-16 12:34:36'),
(5,'Unipol',2025,1,'2025-01-13',NULL,136.76,NULL,NULL,NULL,'[ Virtual gennaioMarzo ]','2025-01-16 12:34:20','2025-01-16 12:34:36'),
(6,'Luce',2025,3,'2025-03-11',NULL,117.61,'Gennaio - Febbraio','322',0.365248,NULL,'2025-07-02 10:02:53','2025-07-18 06:21:51'),
(7,'Luce',2025,5,'2025-05-21',NULL,119.43,'Marzo - Aprile','336',0.355446,NULL,'2025-07-02 10:03:33','2025-07-18 06:21:31'),
(8,'Gas',2025,3,'2025-03-11',NULL,345.67,'Dicembre 2024 - Gennaio 2025','314',1.10086,NULL,'2025-07-02 10:04:12','2025-07-02 10:04:37'),
(9,'Gas',2025,5,'2025-05-14',NULL,219.92,'Febbraio - Marzo','175',1.25669,NULL,'2025-07-02 10:04:48','2025-07-02 10:11:38'),
(10,'Gas',2025,6,'2025-06-30',NULL,69.23,'Aprile - Maggio','29',2.38724,NULL,'2025-07-02 10:05:33','2025-07-02 10:05:51'),
(11,'Internet',2025,2,'2025-02-25',NULL,29.95,'Febbraio',NULL,NULL,NULL,'2025-07-02 10:13:13','2025-07-02 10:14:17'),
(12,'Internet',2025,3,'2025-03-25',NULL,29.95,'Marzo',NULL,NULL,NULL,'2025-07-02 10:13:20','2025-07-02 10:14:20'),
(13,'Internet',2025,4,'2025-04-25',NULL,29.95,'Aprile',NULL,NULL,NULL,'2025-07-02 10:13:37','2025-07-02 10:14:25'),
(14,'Internet',2025,5,'2025-05-25',NULL,29.95,'Maggio',NULL,NULL,NULL,'2025-07-02 10:13:44','2025-07-02 10:14:29'),
(15,'Internet',2025,6,'2025-06-25',NULL,29.95,'Guigno',NULL,NULL,NULL,'2025-07-02 10:13:50','2025-07-02 10:14:34'),
(16,'Internet',2025,7,'2025-07-25',NULL,29.95,'Luglio',NULL,NULL,NULL,'2025-07-02 10:14:31','2025-07-21 06:26:11'),
(17,'Netflix',2025,2,'2025-02-08',NULL,13.99,'Febbraio',NULL,NULL,NULL,'2025-07-02 11:43:24','2025-07-02 11:44:08'),
(18,'Netflix',2025,3,'2025-03-08',NULL,13.99,'Marzo',NULL,NULL,NULL,'2025-07-02 11:43:27','2025-07-02 11:44:12'),
(19,'Netflix',2025,4,'2025-04-08',NULL,13.99,'Aprile',NULL,NULL,NULL,'2025-07-02 11:43:28','2025-07-02 11:44:17'),
(20,'Netflix',2025,5,'2025-05-08',NULL,13.99,'Maggio',NULL,NULL,NULL,'2025-07-02 11:43:30','2025-07-02 11:44:21'),
(21,'Netflix',2025,6,'2025-06-08',NULL,13.99,'Giugno',NULL,NULL,NULL,'2025-07-02 11:43:33','2025-07-02 11:44:25'),
(22,'Amazon Prime',2025,8,'2025-08-08',NULL,49.9,NULL,NULL,NULL,NULL,'2025-07-02 11:47:01','2025-08-25 09:56:28'),
(23,'Siti web',2025,1,'2025-01-29',NULL,73.19,NULL,NULL,NULL,'pdtsilatbrianza.com \r\n                                                            ','2025-07-02 11:48:00','2025-07-02 11:48:24'),
(24,'Siti web',2025,4,'2025-04-16',NULL,45.13,NULL,NULL,NULL,'robertodegaetano.it \r\n                                                            ','2025-07-02 11:48:36','2025-07-02 11:48:54'),
(25,'Spazzatura',2025,6,'2025-06-09',NULL,88,NULL,NULL,NULL,NULL,'2025-07-15 10:08:14','2025-07-15 10:08:17'),
(26,'Unipol Assicurazioni',2025,1,'2025-01-13',NULL,136.76,'annuale',NULL,NULL,NULL,'2025-07-15 10:08:46','2025-07-15 10:09:12'),
(27,'Alleanza',2025,2,'2025-01-31',NULL,104,NULL,NULL,NULL,NULL,'2025-07-15 10:09:35','2025-07-15 10:10:26'),
(28,'Alleanza',2025,3,'2025-02-28',NULL,104,NULL,NULL,NULL,NULL,'2025-07-15 10:09:43','2025-07-15 10:10:28'),
(29,'Alleanza',2025,4,'2025-03-31',NULL,104,NULL,NULL,NULL,NULL,'2025-07-15 10:09:50','2025-07-15 10:10:30'),
(30,'Alleanza',2025,5,'2025-04-30',NULL,104,NULL,NULL,NULL,NULL,'2025-07-15 10:09:59','2025-07-15 10:10:32'),
(31,'Alleanza',2025,6,'2025-05-31',NULL,104,NULL,NULL,NULL,NULL,'2025-07-15 10:10:07','2025-07-15 10:10:36'),
(32,'Alleanza',2025,7,'2025-06-30',NULL,104,NULL,NULL,NULL,NULL,'2025-07-15 10:10:15','2025-07-15 10:10:39'),
(33,'Alleanza',2025,8,'2025-07-31',NULL,104,NULL,NULL,NULL,NULL,'2025-07-15 10:10:21','2025-07-15 10:10:42'),
(34,'Netflix',2025,7,'2025-07-08',NULL,13.99,'Luglio',NULL,NULL,NULL,'2025-07-17 13:28:51','2025-07-17 13:29:00'),
(35,'Luce',2025,7,'2025-07-31',NULL,113.51,'Maggio - Giugno','310',0.366161,NULL,'2025-07-18 06:17:29','2025-08-01 15:01:37'),
(36,'Netflix',2025,8,'2025-08-08',NULL,13.99,'Agosto',NULL,NULL,NULL,'2025-07-30 13:17:17','2025-07-30 13:17:25'),
(37,'Alleanza',2025,9,'2025-08-31',NULL,104,NULL,NULL,NULL,NULL,'2025-08-04 13:31:58','2025-08-04 13:32:04'),
(38,'Alleanza',2025,10,'2025-09-30',NULL,104,NULL,NULL,NULL,NULL,'2025-08-04 13:33:10','2025-08-04 13:33:13'),
(39,'Alleanza',2025,11,'2025-10-31',NULL,104,NULL,NULL,NULL,NULL,'2025-08-04 13:33:21','2025-08-04 13:33:24'),
(40,'Alleanza',2025,12,'2025-11-30',NULL,104,NULL,NULL,NULL,NULL,'2025-08-04 13:33:34','2025-08-04 13:33:37'),
(41,'Internet',2025,8,'2025-08-26',NULL,29.95,'Agosto',NULL,NULL,NULL,'2025-08-27 07:01:23','2025-08-27 07:01:33'),
(42,'Gas',2025,9,'2025-09-15',NULL,55.71,'Giugno - Luglio','15',3.714,NULL,'2025-09-01 11:30:00','2025-09-01 11:31:34'),
(43,'Netflix',2025,9,'2025-09-09',NULL,13.99,'Settembre',NULL,NULL,NULL,'2025-09-11 06:53:46','2025-09-11 06:53:58'),
(44,'Internet',2025,9,'2025-09-25',NULL,30.49,'Settembre',NULL,NULL,NULL,'2025-09-11 06:55:00','2025-09-11 06:55:12'),
(45,'Luce',2025,9,'2025-09-11',NULL,108.2,'Luglio - Agosto','262',0.412977,NULL,'2025-09-16 12:15:23','2025-09-16 12:15:57'),
(46,'Luce',2025,10,NULL,NULL,NULL,NULL,'\r\n                                                            ',NULL,NULL,'2025-09-16 12:15:54','2025-09-16 12:15:54'),
(47,'Netflix',2025,10,'2025-10-10',NULL,13.99,'Ottobre',NULL,NULL,'[ Ottobre_2025 ]','2025-10-09 06:39:58','2025-10-09 06:40:58');
/*!40000 ALTER TABLE `bollette` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bollette_acqua`
--

DROP TABLE IF EXISTS `bollette_acqua`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `bollette_acqua` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_year` int(11) DEFAULT NULL,
  `ref_month` int(11) DEFAULT NULL,
  `cons_amount` float DEFAULT NULL,
  `tot_consumption` int(11) DEFAULT NULL,
  `unit_amount` float GENERATED ALWAYS AS (case when `tot_consumption` is not null and `tot_consumption` <> 0 then `cons_amount` / `tot_consumption` else NULL end) STORED,
  `tot_amount` float DEFAULT NULL,
  `common_amount` float GENERATED ALWAYS AS (`tot_amount` - `cons_amount`) STORED,
  `unit_common_amount` float GENERATED ALWAYS AS (case when `common_amount` is not null then `common_amount` / 3 else NULL end) STORED,
  `payment_date` date DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `read_month` text DEFAULT NULL,
  `read_consumption` int(11) DEFAULT NULL,
  `difference_consumption` int(11) DEFAULT NULL,
  `unit_cons_amount` float DEFAULT NULL,
  `unit_tot_amount` float DEFAULT NULL,
  `referral_period` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bollette_acqua`
--

LOCK TABLES `bollette_acqua` WRITE;
/*!40000 ALTER TABLE `bollette_acqua` DISABLE KEYS */;
INSERT INTO `bollette_acqua` VALUES
(1,2024,11,20.03,40,0.50075,72.5,52.47,17.49,'2025-01-20','2024-09-21','Novembre 2024',102,102,51.08,68.57,'Aprile 2024 - Luglio 2024',NULL,'2025-07-04 07:55:08','2025-07-15 10:13:09'),
(2,2025,1,22.03,40,0.55075,94,71.97,23.99,'2025-01-20','2024-12-05','Novembre 2024',144,42,23.13,47.12,'Agosto 2024 - Novembre 2024',NULL,'2025-07-04 07:55:08','2025-07-15 09:37:56'),
(3,2025,5,233.71,277,0.843718,391,157.29,52.43,'2025-05-20','2025-04-23','Marzo 2025',190,46,38.81,91.24,'Febbraio - Marzo',NULL,'2025-07-04 08:42:02','2025-09-05 06:02:20'),
(4,2025,9,127.22,131,0.971145,228.5,101.28,33.76,'2025-09-05','2025-08-20','Luglio 2025',232,42,0,76.16,'Febbraio - Luglio',NULL,'2025-08-01 09:25:41','2025-10-02 08:55:30');
/*!40000 ALTER TABLE `bollette_acqua` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contocorrente`
--

DROP TABLE IF EXISTS `contocorrente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `contocorrente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` float DEFAULT NULL,
  `ref_year` int(11) DEFAULT NULL,
  `ref_month` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contocorrente`
--

LOCK TABLES `contocorrente` WRITE;
/*!40000 ALTER TABLE `contocorrente` DISABLE KEYS */;
INSERT INTO `contocorrente` VALUES
(1,6274.38,2024,12,'2025-08-04 10:19:24','2025-08-04 10:19:24'),
(2,3339.84,2025,1,'2025-08-04 10:20:11','2025-08-04 10:20:11'),
(3,4021.1,2025,2,'2025-08-04 10:26:29','2025-08-04 10:26:29'),
(4,4128.7,2025,3,'2025-08-04 10:26:53','2025-08-04 10:26:53'),
(5,4642,2025,4,'2025-08-04 10:26:59','2025-08-04 10:26:59'),
(6,3896.87,2025,5,'2025-08-04 10:27:08','2025-08-04 10:27:08'),
(7,4121.43,2025,6,'2025-08-04 10:27:13','2025-08-04 10:27:13'),
(8,4312.91,2025,7,'2025-08-04 10:27:20','2025-08-04 10:27:20'),
(9,3933.97,2025,8,'2025-08-04 10:27:28','2025-08-29 12:58:32'),
(10,4411.7,2025,9,'2025-09-05 08:24:23','2025-09-26 06:13:42'),
(11,2692.06,2025,10,'2025-10-02 08:49:43','2025-10-12 16:24:31');
/*!40000 ALTER TABLE `contocorrente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loggedusers`
--

DROP TABLE IF EXISTS `loggedusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `loggedusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loggedusers`
--

LOCK TABLES `loggedusers` WRITE;
/*!40000 ALTER TABLE `loggedusers` DISABLE KEYS */;
INSERT INTO `loggedusers` VALUES
(1,'roby','$2y$10$iCWaAZkQZDRsXJdW/WpWWueUTzldCXYZxlwrA34LtRiUC12YMMKoG');
/*!40000 ALTER TABLE `loggedusers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mutuo`
--

DROP TABLE IF EXISTS `mutuo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `mutuo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_year` int(11) DEFAULT NULL,
  `ref_month` int(11) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `amount` float DEFAULT 0,
  `interests` float DEFAULT 0,
  `capital` float DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mutuo`
--

LOCK TABLES `mutuo` WRITE;
/*!40000 ALTER TABLE `mutuo` DISABLE KEYS */;
INSERT INTO `mutuo` VALUES
(1,2022,9,'2022-09-01',1230.3,835.7,390.6,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(2,2022,10,'2022-10-01',805.6,409.83,391.77,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(3,2022,11,'2022-11-01',805.6,408.65,392.95,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(4,2022,12,'2022-12-01',805.6,407.47,394.13,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(5,2023,1,'2023-01-01',805.6,406.29,395.31,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(6,2023,2,'2023-02-01',805.61,405.11,396.5,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(7,2023,3,'2023-03-01',805.61,403.92,397.69,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(8,2023,4,'2023-04-01',805.6,402.72,398.88,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(9,2023,5,'2023-05-01',805.61,401.53,400.08,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(10,2023,6,'2023-06-01',805.61,400.33,401.28,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(11,2023,7,'2023-07-01',805.6,399.12,402.48,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(12,2023,8,'2023-08-01',805.6,397.91,403.69,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(13,2023,9,'2023-09-01',805.6,396.7,404.9,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(14,2023,10,'2023-10-01',805.6,395.49,406.11,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(15,2023,11,'2023-11-01',805.6,394.27,407.33,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(16,2023,12,'2023-12-01',805.6,393.05,408.55,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(17,2024,1,'2024-01-01',805.6,391.82,409.78,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(18,2024,2,'2024-02-01',805.6,390.59,411.01,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(19,2024,3,'2024-03-01',805.6,389.36,412.24,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(20,2024,4,'2024-04-01',805.6,388.12,413.48,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(21,2024,5,'2024-05-01',805.6,386.88,414.72,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(22,2024,6,'2024-06-01',805.6,385.64,415.96,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(23,2024,7,'2024-07-01',805.6,384.39,417.21,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(24,2024,8,'2024-08-01',805.6,383.14,418.46,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(25,2024,9,'2024-09-01',805.6,381.88,419.72,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(26,2024,10,'2024-10-01',805.6,380.63,420.98,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(27,2024,11,'2024-11-01',805.6,379.36,422.24,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(28,2024,12,'2024-12-01',805.61,378.1,423.51,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(29,2025,1,'2025-12-01',805.61,376.83,424.78,'2025-01-16 12:09:10','2025-01-16 12:09:10'),
(30,2025,2,'2025-02-01',805.6,375.55,426.05,'2025-08-01 15:37:29','2025-08-04 08:04:13'),
(31,2025,3,'2025-03-01',805.6,374.27,427.33,'2025-08-01 15:37:40','2025-08-04 08:04:48'),
(32,2025,4,'2025-04-01',805.6,372.99,428.61,'2025-08-04 07:31:43','2025-08-04 08:05:14'),
(33,2025,5,'2025-05-01',805.61,371.71,429.9,'2025-08-04 07:31:48','2025-08-04 08:05:43'),
(34,2025,6,'2025-06-01',805.61,370.42,431.19,'2025-08-04 07:31:53','2025-08-04 08:06:07'),
(35,2025,7,'2025-07-01',805.6,369.12,432.48,'2025-08-04 07:31:58','2025-08-04 08:06:31'),
(36,2025,8,'2025-08-01',805.6,367.82,433.78,'2025-08-04 07:32:03','2025-08-04 08:42:57'),
(37,2025,9,'2025-09-01',805.6,366.52,435.08,'2025-09-25 06:25:05','2025-09-25 06:25:33'),
(38,2025,10,'2025-10-01',805.6,365.22,436.38,'2025-10-02 08:50:19','2025-10-02 08:50:46');
/*!40000 ALTER TABLE `mutuo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `overview`
--

DROP TABLE IF EXISTS `overview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `overview` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ref_year` varchar(255) NOT NULL,
  `ref_month` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `overview`
--

LOCK TABLES `overview` WRITE;
/*!40000 ALTER TABLE `overview` DISABLE KEYS */;
INSERT INTO `overview` VALUES
(1,'Bollo','2025','03',0,'2025-01-07 04:25:09','2025-07-15 10:17:59'),
(2,'Assicurazione','2025','10',410.12,'2025-01-07 04:27:57','2025-10-02 08:52:18'),
(3,'Gomme','2025','05',587,'2025-01-07 04:29:21','2025-06-05 12:53:41'),
(4,'Gomme','2025','11',40,'2025-01-07 04:29:29','2025-06-05 12:54:10'),
(5,'Sporting','2025','05',250,'2025-01-07 04:29:29','2025-01-23 12:18:37'),
(6,'Sporting','2025','11',35,'2025-01-07 04:29:29','2025-01-07 04:29:29'),
(7,'Mike','2025','06',1500,'2025-01-07 04:29:29','2025-07-01 08:32:31'),
(8,'Carburante','2025','05',85.29,'2025-06-05 12:54:22','2025-06-05 12:54:22'),
(9,'Carburante','2025','06',80.62,'2025-07-15 10:17:29','2025-07-15 10:17:29'),
(10,'Bollo','2025','06',224.67,'2025-07-15 10:18:09','2025-07-15 10:18:09'),
(11,'Bollo','2025','08',236.92,'2025-08-06 12:33:15','2025-08-06 12:33:15'),
(12,'Carburante','2025','08',76.51,'2025-08-11 08:41:10','2025-08-11 08:41:10'),
(13,'Mike','2025','07',0,'2025-08-23 12:54:00','2025-08-23 12:54:00');
/*!40000 ALTER TABLE `overview` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stipendio`
--

DROP TABLE IF EXISTS `stipendio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `stipendio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lordo` float DEFAULT NULL,
  `netto` float DEFAULT NULL,
  `ticket_value` float DEFAULT NULL,
  `ticket_n` int(11) DEFAULT NULL,
  `ref_year` int(11) DEFAULT NULL,
  `ref_month` varchar(255) NOT NULL,
  `data_bonifico` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stipendio`
--

LOCK TABLES `stipendio` WRITE;
/*!40000 ALTER TABLE `stipendio` DISABLE KEYS */;
INSERT INTO `stipendio` VALUES
(1,2903.24,2045,7.6,19,2025,'01','2025-07-18 08:46:27','2025-07-15 13:22:06','2025-07-18 08:46:27'),
(2,2903.24,2041,7.6,18,2025,'02','2025-07-18 08:46:32','2025-07-15 13:22:06','2025-07-18 08:46:32'),
(3,2943.82,2051,7.6,19,2025,'03','2025-07-18 08:46:39','2025-07-15 13:22:06','2025-07-18 08:46:39'),
(4,2943.82,2050,7.6,21,2025,'04','2025-07-18 08:46:44','2025-07-15 13:22:06','2025-07-18 08:46:44'),
(5,2943.82,1970,7.6,16,2025,'05','2025-07-18 08:46:47','2025-07-15 13:22:06','2025-07-18 08:46:47'),
(6,5962.64,3746,7.6,20,2025,'06','2025-07-30 12:10:19','2025-07-15 13:22:06','2025-07-30 12:10:19'),
(7,3180.55,2212,7.6,20,2025,'07','2025-08-04 08:43:30','2025-07-30 12:09:43','2025-08-04 08:43:30'),
(8,2943.82,2053,7.6,18,2025,'08','2025-08-27 06:56:14','2025-07-30 12:09:52','2025-08-27 06:56:14'),
(9,4063.87,2693,7.6,9,2025,'09','2025-09-26 06:16:25','2025-07-30 12:09:55','2025-09-26 06:16:25'),
(10,NULL,NULL,0,NULL,2025,'10','2025-07-30 12:13:26','2025-07-30 12:09:58','2025-07-30 12:13:26'),
(11,NULL,NULL,0,NULL,2025,'11','2025-07-30 12:14:32','2025-07-30 12:10:00','2025-07-30 12:14:32'),
(12,NULL,NULL,0,NULL,2025,'12','2025-07-30 12:24:56','2025-07-30 12:10:01','2025-07-30 12:24:56');
/*!40000 ALTER TABLE `stipendio` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-12 18:24:33
