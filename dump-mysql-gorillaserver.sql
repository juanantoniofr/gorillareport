-- MySQL dump 10.19  Distrib 10.3.38-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: gorillareport
-- ------------------------------------------------------
-- Server version	10.3.38-MariaDB-0ubuntu0.20.04.1

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
-- Current Database: `gorillareport`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `gorillareport` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `gorillareport`;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `information` text NOT NULL,
  `api_token` varchar(60) DEFAULT NULL,
  `huid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_huid_unique` (`huid`),
  UNIQUE KEY `clients_api_token_unique` (`api_token`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'2023-03-09 08:19:48','2023-03-09 09:05:24','px-pstman-testing','192.168.2.3','{}',NULL,'asdasd3423asdad'),(2,'2023-03-09 09:37:57','2023-03-09 09:37:57','pc101_IntelH310','10.1.21.50','{}',NULL,'90D73018-128A-30EE-868F-3C7C3F292A95');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_12_14_000001_create_personal_access_tokens_table',1),(2,'2022_06_07_090507_create_users_table',2),(3,'2023_02_06_163146_add_remember_token_to_users',3),(4,'2022_06_07_092824_add_password_to_users_table',4),(5,'2014_10_12_100000_create_password_resets_table',5),(6,'2014_10_12_200000_add_two_factor_columns_to_users_table',6),(7,'2022_06_01_102656_create_clients_table',7),(8,'2022_06_02_100102_adds_api_token_toclients_table',8),(9,'2023_02_07_134416_create_permission_tables',9),(10,'2023_03_09_074715_add_unique_column_to_table_clients',10);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(1,'App\\Models\\User',4);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'role-list','web','2023-02-23 09:29:09','2023-02-23 09:29:09'),(2,'role-create','web','2023-02-23 09:29:09','2023-02-23 09:29:09'),(3,'role-edit','web','2023-02-23 09:29:09','2023-02-23 09:29:09'),(4,'role-delete','web','2023-02-23 09:29:09','2023-02-23 09:29:09');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'App\\Models\\User',5,'api','cd9e78a1ff6b9b584d37b33de8e0434fcefb7cfa9ff680c9f2128b6eaded6f53','[\"api-access\"]',NULL,'2023-03-02 08:32:12','2023-03-02 08:32:12','2024-03-02 10:42:13'),(2,'App\\Models\\User',7,'auth_token','d1ad2c53d1053986b7e5d40013e5021d60047ebf6c3c6e4abace2d500fc39c9e','[\"*\"]',NULL,'2023-03-02 09:40:21','2023-03-02 09:40:21',NULL),(3,'App\\Models\\User',6,'auth_token','e2fd3eb727646e74d53e4fb2a9d3c008e02e658b5fb8a0260f2a7778da645aab','[\"*\"]',NULL,'2023-03-02 11:29:08','2023-03-02 11:29:08',NULL),(4,'App\\Models\\User',6,'auth_token','3c7fa9d2157c2f7d40465a0d06dcfe32cf4030aad2fad4391e9511887fd59b63','[\"*\"]',NULL,'2023-03-08 08:04:10','2023-03-08 08:04:10',NULL),(5,'App\\Models\\User',6,'auth_token','277e73689e339e26a69fd3d7e72909a24fa4a03f510aee993a9c08a0517b2ba0','[\"*\"]',NULL,'2023-03-08 08:09:10','2023-03-08 08:09:10',NULL),(6,'App\\Models\\User',6,'auth_token','95868318c371bb4e07949b4832df31e71553e726557ab9c675b98f96bd296490','[\"*\"]',NULL,'2023-03-08 08:14:23','2023-03-08 08:14:23',NULL),(7,'App\\Models\\User',6,'auth_token','1f1d845f735a48f5202ffd77f4850871cfc5603812048db125939d00b554106b','[\"*\"]',NULL,'2023-03-08 08:18:28','2023-03-08 08:18:28',NULL),(8,'App\\Models\\User',6,'auth_token','f573f098dcef9cfc818f479073069e9112a9ba816d3d6b9c230fcdab8ae3935b','[\"*\"]',NULL,'2023-03-08 08:19:09','2023-03-08 08:19:09',NULL),(9,'App\\Models\\User',6,'auth_token','84fd5dd759f6e67a9dd58e7b5d0fffe52b70eca707c4a84bb362ac8ad2463f80','[\"*\"]',NULL,'2023-03-08 08:21:15','2023-03-08 08:21:15',NULL),(10,'App\\Models\\User',6,'auth_token','03e7b8841a5aebfd61ab15fa5b1355f83d50c94bb1223d0a82d713571619c375','[\"*\"]',NULL,'2023-03-08 08:23:44','2023-03-08 08:23:44',NULL),(11,'App\\Models\\User',6,'auth_token','94ccc102e8395b29c7b408d03cddafdc04801bc9b027dfb5ae33220b53b58bdc','[\"*\"]',NULL,'2023-03-08 08:25:30','2023-03-08 08:25:30',NULL),(12,'App\\Models\\User',6,'auth_token','fe50707ddbd9b2020e078f6b54a57ce76a2d35be5dc0db57140c7efbaf054cbc','[\"*\"]',NULL,'2023-03-08 08:26:03','2023-03-08 08:26:03',NULL),(13,'App\\Models\\User',6,'auth_token','cd423e09ec30bf4f6f3225b245d2c42e967df96b006ead2bb31a9d454035e62a','[\"*\"]',NULL,'2023-03-08 08:28:58','2023-03-08 08:28:58',NULL),(14,'App\\Models\\User',6,'auth_token','8e7c76f961f7224208049e3ab82848aebfd401331729fcc99a78f8dce05062d0','[\"*\"]',NULL,'2023-03-08 08:29:10','2023-03-08 08:29:10',NULL),(15,'App\\Models\\User',6,'auth_token','5acd4e6d89dae49cafa61a5530e80822d63c1aaddcb0ea3db24781e6d4da4886','[\"*\"]',NULL,'2023-03-08 08:31:28','2023-03-08 08:31:28',NULL),(16,'App\\Models\\User',6,'auth_token','c0790bb2e5c5c72c656946ec396e1ddbf5c09378275e4294111879e1e459d81a','[\"*\"]',NULL,'2023-03-08 08:36:59','2023-03-08 08:36:59',NULL),(17,'App\\Models\\User',6,'auth_token','2366da2de4ac5614169da2d8855cdf5b0bc39956155a3e296ba24ec31adf356a','[\"*\"]',NULL,'2023-03-08 08:39:09','2023-03-08 08:39:09',NULL),(18,'App\\Models\\User',6,'auth_token','1faec2f6afc4e291533d624cbc9ec4052e57491de7b0cd6d9b70215d236dc8c1','[\"*\"]',NULL,'2023-03-08 08:42:13','2023-03-08 08:42:13',NULL),(19,'App\\Models\\User',6,'auth_token','71886088a61f8dd83074a3031bfde228e525c91156e37a3e574795d091ceed51','[\"*\"]',NULL,'2023-03-08 08:47:10','2023-03-08 08:47:10',NULL),(20,'App\\Models\\User',6,'auth_token','10d62054998cfa8d96e07170d3645176207e3dd205472572d2ba971a5b018426','[\"*\"]',NULL,'2023-03-08 08:49:09','2023-03-08 08:49:09',NULL),(21,'App\\Models\\User',6,'auth_token','06c144548c8e75373b07f6604e3fe028e6c3c62c39e2c9e883a38e77e0689be4','[\"*\"]',NULL,'2023-03-08 08:55:30','2023-03-08 08:55:30',NULL),(22,'App\\Models\\User',6,'auth_token','10c16af102460616c091838b48266262d7fe8d85c7bb57a4509927809d499782','[\"*\"]',NULL,'2023-03-08 08:56:39','2023-03-08 08:56:39',NULL),(23,'App\\Models\\User',6,'auth_token','5eedf5c8ca0b10c02819f64ac89691e05345b589799da5f1f667129e98c5c072','[\"*\"]',NULL,'2023-03-08 08:57:00','2023-03-08 08:57:00',NULL),(24,'App\\Models\\User',6,'auth_token','23e0a009e48dc287daa587c3a90f7a7b09510e0bce844c310a8a1581b858f1c1','[\"*\"]',NULL,'2023-03-08 08:57:07','2023-03-08 08:57:07',NULL),(25,'App\\Models\\User',6,'auth_token','54d4410fabb2a61f30790fdb3a29f5aa61b1ef130a0c998ee5c749de58e412fc','[\"*\"]',NULL,'2023-03-08 08:59:09','2023-03-08 08:59:09',NULL),(26,'App\\Models\\User',6,'auth_token','c87905854f7639203263fb75eb0cd21f93cdeb3b5630fadd93ce94c688a4668e','[\"*\"]',NULL,'2023-03-08 09:03:50','2023-03-08 09:03:50',NULL),(27,'App\\Models\\User',6,'auth_token','f00da19528064faae8f42de1a73351ba521f6025d6d76e06e921d737c8d6f50f','[\"*\"]',NULL,'2023-03-08 09:04:48','2023-03-08 09:04:48',NULL),(28,'App\\Models\\User',6,'auth_token','1a3675b2ea2ac3aa1d917fe488c89270ed7a98270b2f2f29b091489903883b77','[\"*\"]',NULL,'2023-03-08 09:05:44','2023-03-08 09:05:44',NULL),(29,'App\\Models\\User',6,'auth_token','3401f3a9ad4b544273948db5e4d032774738486c3b7b1b811e082e44aa2848d6','[\"*\"]',NULL,'2023-03-08 09:09:09','2023-03-08 09:09:09',NULL),(30,'App\\Models\\User',6,'auth_token','67bdc058b3f2518ac25073a95cf24f49f8eaa3d79165782477d7b1e087ddccc8','[\"*\"]',NULL,'2023-03-09 08:13:19','2023-03-09 08:13:19',NULL),(31,'App\\Models\\User',6,'auth_token','386a0c8bb43b942e6a872b5b5ff00f25984cd57c1f90fdbe6d72782711b625c4','[\"*\"]',NULL,'2023-03-09 08:27:40','2023-03-09 08:27:40',NULL),(32,'App\\Models\\User',6,'auth_token','e6846e7f851886eb12f6406b63fe46856f9289d2e6091ec2cd06f5f04b06cdf9','[\"*\"]',NULL,'2023-03-09 08:31:29','2023-03-09 08:31:29',NULL),(33,'App\\Models\\User',6,'auth_token','35c94b14be8ffdf4a3d5ab939d049508ace1efb4ad05de05421098326f5f15fb','[\"*\"]',NULL,'2023-03-09 08:32:22','2023-03-09 08:32:22',NULL),(34,'App\\Models\\User',6,'auth_token','c89f8f81f81a2f06779927150ef4ae956b3793a4add33a85e2a3b239d29ee97d','[\"*\"]',NULL,'2023-03-09 08:32:58','2023-03-09 08:32:58',NULL),(35,'App\\Models\\User',6,'auth_token','d8550ca83dc1ccf1cf30c08638af90c952e51a461dcfd2848209fe841f20c1ac','[\"*\"]',NULL,'2023-03-09 08:33:48','2023-03-09 08:33:48',NULL),(36,'App\\Models\\User',6,'auth_token','781051b24ed5aa67100fbee3d59406ce1ba3a8a77b4408aa27342a29a0b6ad68','[\"*\"]',NULL,'2023-03-09 08:35:15','2023-03-09 08:35:15',NULL),(37,'App\\Models\\User',6,'auth_token','fcfcbb8daf533e6510503d5f068a279780717d13f230d95b98e7b5e66f0d3272','[\"*\"]',NULL,'2023-03-09 08:36:21','2023-03-09 08:36:21',NULL),(38,'App\\Models\\User',6,'auth_token','810e8a3f3c6ba1fb022e550e1cdfba43d97ca6ccfb9da363e6c93754bff584ad','[\"*\"]',NULL,'2023-03-09 08:36:43','2023-03-09 08:36:43',NULL),(39,'App\\Models\\User',6,'auth_token','600fa218c831eb7ef062da85ccbad4a29b594ef405c9ef3eaf976622d44f8745','[\"*\"]',NULL,'2023-03-09 08:38:17','2023-03-09 08:38:17',NULL),(40,'App\\Models\\User',6,'auth_token','fba0b35592b82b325a4bd34b41b7155da0d9bde6cd233210182d1ea6b86c385e','[\"*\"]',NULL,'2023-03-09 08:39:08','2023-03-09 08:39:08',NULL),(41,'App\\Models\\User',6,'auth_token','bf5a8d348a48467bce3e8f0caa6890f0f631eaeafd4ab0deba181ccdad90cff0','[\"*\"]',NULL,'2023-03-09 08:41:08','2023-03-09 08:41:08',NULL),(42,'App\\Models\\User',6,'auth_token','a8cde7479ca728f2ef3ce9ebcf14293f7af00229f308b0b9a8bab48cc41c6d0e','[\"*\"]',NULL,'2023-03-09 08:43:14','2023-03-09 08:43:14',NULL),(43,'App\\Models\\User',6,'auth_token','e5e4ca711d8260c2d0f03a1e1bffeb455a306b054d0fe9e8a67be39d6233f3dd','[\"*\"]',NULL,'2023-03-09 08:43:38','2023-03-09 08:43:38',NULL),(44,'App\\Models\\User',6,'auth_token','b0cbe3dee58ce80a33c4bbea83ef1987e7687bca6c97b57b747b3b4f63ad96f1','[\"*\"]',NULL,'2023-03-09 08:48:06','2023-03-09 08:48:06',NULL),(45,'App\\Models\\User',6,'auth_token','798f5d52e32c7594ff268b0a4248500ac1221efe7d49af3e0ccd020d6d61c017','[\"*\"]',NULL,'2023-03-09 08:52:54','2023-03-09 08:52:54',NULL),(46,'App\\Models\\User',6,'auth_token','eb2ec7aea2c7d8fa475730252f7d6b0d3f936c49da3d5e4ec834c07249f0e166','[\"*\"]',NULL,'2023-03-09 08:53:57','2023-03-09 08:53:57',NULL),(47,'App\\Models\\User',6,'auth_token','f3ba9edca306e9d3439641dee7ffd6c29b5bd7264173673172f39ae242ee608e','[\"*\"]',NULL,'2023-03-09 09:03:30','2023-03-09 09:03:30',NULL),(48,'App\\Models\\User',6,'auth_token','0d0d4f42a59688fa8f64c29e236f4300bf9eea7b54bc5b35c79914e4debf6c21','[\"*\"]',NULL,'2023-03-09 09:05:16','2023-03-09 09:05:16',NULL),(49,'App\\Models\\User',6,'auth_token','ed233651ccd8c8ee343b862807a3a09c1d978be66671859308fc5dbeb2256404','[\"*\"]',NULL,'2023-03-09 09:09:38','2023-03-09 09:09:38',NULL),(50,'App\\Models\\User',6,'auth_token','faeb9f04704a4a47fa0ba2ee6e4f3ee7a1dc174dd5445556aca915a51f0f48a5','[\"*\"]',NULL,'2023-03-09 09:10:11','2023-03-09 09:10:11',NULL),(51,'App\\Models\\User',6,'auth_token','d0d123edd99726c6b47acceb78172a1d2d53f7e310aaf4006efb9df53a9fb55c','[\"*\"]',NULL,'2023-03-09 09:12:15','2023-03-09 09:12:15',NULL),(52,'App\\Models\\User',6,'auth_token','426f7a09f141576e6d9b9ca40b0d1d3519d076a8842d6bab8aa4d3c3f5af9baf','[\"*\"]',NULL,'2023-03-09 09:13:56','2023-03-09 09:13:56',NULL),(53,'App\\Models\\User',6,'auth_token','1b470b29d317d7a9f0be83025e2d45b051b6a99efd766236fd9209fe423e91dd','[\"*\"]',NULL,'2023-03-09 09:14:23','2023-03-09 09:14:23',NULL),(54,'App\\Models\\User',6,'auth_token','d07a8163abd2e90bb1c578e7d7f7ffa76971a2adbfdb64ec36d2c7e65eeb53a9','[\"*\"]',NULL,'2023-03-09 09:14:34','2023-03-09 09:14:34',NULL),(55,'App\\Models\\User',6,'auth_token','6dea789df92c328cde8a0d188798259369593ee0707c234b666e5b2512715c4f','[\"*\"]',NULL,'2023-03-09 09:14:47','2023-03-09 09:14:47',NULL),(56,'App\\Models\\User',6,'auth_token','df71bb5e1b1e888c72f5ebf0b6e0ea3656698801c35638555b8605e9531617f0','[\"*\"]',NULL,'2023-03-09 09:15:06','2023-03-09 09:15:06',NULL),(57,'App\\Models\\User',6,'auth_token','b7d54305f0e2ccc976b3dd6d33c517ababa82ed059cbb1ddb4bd63749cda508e','[\"*\"]',NULL,'2023-03-09 09:15:22','2023-03-09 09:15:22',NULL),(58,'App\\Models\\User',6,'auth_token','46dfedc05744aaf1ba8580dceb351e74afc4dca24dbd71820759fa9ba7f50195','[\"*\"]',NULL,'2023-03-09 09:15:39','2023-03-09 09:15:39',NULL),(59,'App\\Models\\User',6,'auth_token','e424acc75f0e75e6d87878fe9576c949c663a428adaf43de5d30885c9f4338b5','[\"*\"]',NULL,'2023-03-09 09:17:54','2023-03-09 09:17:54',NULL),(60,'App\\Models\\User',6,'auth_token','fe8a617e12a978c28b94ce4ec39c2af0957948ec29c068ecd0ea021e9b6ce194','[\"*\"]',NULL,'2023-03-09 09:18:44','2023-03-09 09:18:44',NULL),(61,'App\\Models\\User',6,'auth_token','d20d607e75907072eb5dd191e11536c4c8857b12f6424b9bc6dde615bdb39331','[\"*\"]',NULL,'2023-03-09 09:19:13','2023-03-09 09:19:13',NULL),(62,'App\\Models\\User',6,'auth_token','f13989bd78e7080794e04a36d23b2863546f510718525bc0ce07981dac801e01','[\"*\"]',NULL,'2023-03-09 09:19:47','2023-03-09 09:19:47',NULL),(63,'App\\Models\\User',6,'auth_token','bb20ba4904701fe477445bb8969a5d199c90f049c73a2371df6c8d071a8469be','[\"*\"]',NULL,'2023-03-09 09:20:05','2023-03-09 09:20:05',NULL),(64,'App\\Models\\User',6,'auth_token','1b1d30510636722503b4382d61da9a9c09aad21bf9921fc2c57a8cd86dbb7d9e','[\"*\"]',NULL,'2023-03-09 09:20:29','2023-03-09 09:20:29',NULL),(65,'App\\Models\\User',6,'auth_token','3c1fabc46c5ccfefb7009fd7df51c43a12d680d53974f3b7236daed57c253505','[\"*\"]',NULL,'2023-03-09 09:22:01','2023-03-09 09:22:01',NULL),(66,'App\\Models\\User',6,'auth_token','c4044c501106104b031b06990c356c159d167b3fd5ae9115b47964daca0494c4','[\"*\"]',NULL,'2023-03-09 09:27:01','2023-03-09 09:27:01',NULL),(67,'App\\Models\\User',6,'auth_token','507aa1b6b94e1f1b0522f14f8d76d829b83eae51d3878bede3f3ddb4b1d382e8','[\"*\"]',NULL,'2023-03-09 09:27:39','2023-03-09 09:27:39',NULL),(68,'App\\Models\\User',6,'auth_token','1b3fcd092168b0763b40a5dd777fd504c7dda6fa2e1d7e5b7fd447dc80d811f7','[\"*\"]',NULL,'2023-03-09 09:31:10','2023-03-09 09:31:10',NULL),(69,'App\\Models\\User',6,'auth_token','53642bdb8ea0d461846c836b0119b1e389241e465e59496ea5e98898e35f1294','[\"*\"]',NULL,'2023-03-09 09:31:50','2023-03-09 09:31:50',NULL),(70,'App\\Models\\User',6,'auth_token','4239ea743dbcc6a05d5672b1c3935f1a6ecea7c966bb709f9bde5d459f44b144','[\"*\"]',NULL,'2023-03-09 09:36:19','2023-03-09 09:36:19',NULL),(71,'App\\Models\\User',6,'auth_token','bdee2a5d7fa72c7f263eba095201bcc16d1b697c0a90bfaa999a61085e7402f6','[\"*\"]',NULL,'2023-03-09 09:36:58','2023-03-09 09:36:58',NULL),(72,'App\\Models\\User',6,'auth_token','adc113e6d3fabd11b3b8fc841c1d77c6704a065396f79d0b7b4c48ac3dccb998','[\"*\"]',NULL,'2023-03-09 09:37:24','2023-03-09 09:37:24',NULL),(73,'App\\Models\\User',6,'auth_token','216da1dfe1ec2ac490aa5e527a5c9fec3b609eaa32b91e59166c793632b137c5','[\"*\"]',NULL,'2023-03-09 09:37:55','2023-03-09 09:37:55',NULL),(74,'App\\Models\\User',6,'auth_token','e79ba8b0ad4394922210bc1d11793e4b6be8dc93e14796ad63b838909ea9dca5','[\"*\"]',NULL,'2023-03-09 09:38:32','2023-03-09 09:38:32',NULL),(75,'App\\Models\\User',6,'auth_token','137b60af118676adbb194858ba05bbe9b4eb32eaff4ba7c689534dc2298ac105','[\"*\"]',NULL,'2023-03-09 09:40:38','2023-03-09 09:40:38',NULL),(76,'App\\Models\\User',6,'auth_token','501198168d66979d2317aaffc7aaad8218e1cf628ae5f8e29fac1742045428ce','[\"*\"]',NULL,'2023-03-09 09:40:53','2023-03-09 09:40:53',NULL),(77,'App\\Models\\User',6,'auth_token','dccfaa4024faa2d58ead5f2ac6f9c2ef9bc49d5af60e31f48d25c3a4a5185815','[\"*\"]',NULL,'2023-03-09 09:42:41','2023-03-09 09:42:41',NULL),(78,'App\\Models\\User',6,'auth_token','e25450f887c5070b67680c2cbd17ecee819fee431546b2a3acea27524f9b9b79','[\"*\"]',NULL,'2023-03-09 09:42:59','2023-03-09 09:42:59',NULL),(79,'App\\Models\\User',6,'auth_token','ab4348cbead73117e1a4bf3f651cc62e8b9dd500f0cc910af7bcc38e5e3a8f73','[\"*\"]',NULL,'2023-03-09 09:47:27','2023-03-09 09:47:27',NULL),(80,'App\\Models\\User',6,'auth_token','eebdd5b6479e182a5dbb927f379a00d0cbe215e9a0a5220f3975aa78a1cfb1e7','[\"*\"]',NULL,'2023-03-09 09:49:09','2023-03-09 09:49:09',NULL),(81,'App\\Models\\User',6,'auth_token','9834342355c0cf8b337c273e2a3ddfc0ce38d51774d2f6ac1729954a69dffd74','[\"*\"]',NULL,'2023-03-09 09:59:07','2023-03-09 09:59:07',NULL),(82,'App\\Models\\User',6,'auth_token','82544cbcd4d88b7e89b94726ea013d7b5b03aeaf9ae54883935bf86636513261','[\"*\"]',NULL,'2023-03-09 10:09:07','2023-03-09 10:09:07',NULL),(83,'App\\Models\\User',6,'auth_token','3091046395a81a218f27671370e004ef97e42adc259105a7e7c21aaa820a78ad','[\"*\"]',NULL,'2023-03-09 10:19:07','2023-03-09 10:19:07',NULL),(84,'App\\Models\\User',6,'auth_token','bd554c93546b881c0bed15be6a0289a0cea42ac119e509983b80113c2bfd6e32','[\"*\"]',NULL,'2023-03-09 10:29:07','2023-03-09 10:29:07',NULL),(85,'App\\Models\\User',6,'auth_token','5768191b23bd0ab30cb5fccba87a175919ce2b80f511a15bc876f0d8219f5745','[\"*\"]',NULL,'2023-03-09 10:39:07','2023-03-09 10:39:07',NULL),(86,'App\\Models\\User',6,'auth_token','50338e6fe38fec0385a58b2f4e3189d233ce12cf34e56d4b03827225acfb63f6','[\"*\"]',NULL,'2023-03-09 10:49:07','2023-03-09 10:49:07',NULL),(87,'App\\Models\\User',6,'auth_token','1e8cacb40d70c4ab628877ea8183c173214794440f6a03ed3299cf17056379fc','[\"*\"]',NULL,'2023-03-09 10:59:07','2023-03-09 10:59:07',NULL),(88,'App\\Models\\User',6,'auth_token','d67ff9c1b89bcea4ddb790f2435ee1b22300737c970a9915583d73df31f08bf3','[\"*\"]',NULL,'2023-03-09 11:09:07','2023-03-09 11:09:07',NULL),(89,'App\\Models\\User',6,'auth_token','01674151ea2288cc961ff76e6c30ada4ef3a6965a3a2660e7ebde0e113a29d1b','[\"*\"]',NULL,'2023-03-09 11:19:07','2023-03-09 11:19:07',NULL),(90,'App\\Models\\User',6,'auth_token','fd8f4b503f72c64c64bd85cddd2e5a0a001245fbc3778a53ce4807ac10391718','[\"*\"]',NULL,'2023-03-09 11:29:07','2023-03-09 11:29:07',NULL),(91,'App\\Models\\User',6,'auth_token','a79a8e6f2fa0052ec848ec9353451074a70e10696231136ef3d874a54f7e47eb','[\"*\"]',NULL,'2023-03-09 11:39:07','2023-03-09 11:39:07',NULL),(92,'App\\Models\\User',6,'auth_token','f66ad31efb8f4f7300b55190ca67aaaada8b8f68798d997267202b68f855a159','[\"*\"]',NULL,'2023-03-09 11:49:07','2023-03-09 11:49:07',NULL),(93,'App\\Models\\User',6,'auth_token','14b1606364c9366fbfa7f18d30a2712c88fcd04853a8de2fdf0383d921409320','[\"*\"]',NULL,'2023-03-22 09:19:44','2023-03-22 09:19:44',NULL),(94,'App\\Models\\User',6,'auth_token','6790251ef863f9e188b2fb99d2a48f8fad40bcd66a48c3ae582c40ce0815c58c','[\"*\"]',NULL,'2023-03-22 09:29:07','2023-03-22 09:29:07',NULL),(95,'App\\Models\\User',6,'auth_token','fe3c399ac79cd2d99ddd37d5e215be6facd349f2aebf00c5b8b0017deeac7b29','[\"*\"]',NULL,'2023-03-22 09:39:09','2023-03-22 09:39:09',NULL),(96,'App\\Models\\User',6,'auth_token','79db99872e5bc3b6a370904c2b71ec81360b6d7f2d86dd07981278b3aee7c1f2','[\"*\"]',NULL,'2023-03-22 09:49:09','2023-03-22 09:49:09',NULL),(97,'App\\Models\\User',6,'auth_token','28bcf37b8d0c6fcd6e0bb40bbef8fa01c43df0e0c48888df1d5c33bf7a2ba52e','[\"*\"]',NULL,'2023-03-22 09:59:09','2023-03-22 09:59:09',NULL),(98,'App\\Models\\User',6,'auth_token','b336b19e604055aaa46b17145589bf960212f2e9f52e09a3c48603ae10e34527','[\"*\"]',NULL,'2023-03-22 10:09:09','2023-03-22 10:09:09',NULL),(99,'App\\Models\\User',6,'auth_token','dcc71e7d99ce686b25d5a2c36984b51a90b1f45de909648f4fc44beb68757e37','[\"*\"]',NULL,'2023-03-22 10:19:09','2023-03-22 10:19:09',NULL),(100,'App\\Models\\User',6,'auth_token','33de1b2a16a7d4e730c67ca7ca8ba734e512381423e1ce535261fb2ea987f287','[\"*\"]',NULL,'2023-03-22 10:29:09','2023-03-22 10:29:09',NULL),(101,'App\\Models\\User',6,'auth_token','0d2176df14537c9971e6cedec1afc9bae31c3693c61932df5bc0a2b76bd0f9f1','[\"*\"]',NULL,'2023-03-22 10:39:09','2023-03-22 10:39:09',NULL),(102,'App\\Models\\User',6,'auth_token','243eba15d37cc6c3f36711891dfe165e730ba7098a4dd923bbd4567f0a545f5a','[\"*\"]',NULL,'2023-03-22 10:49:09','2023-03-22 10:49:09',NULL),(103,'App\\Models\\User',6,'auth_token','53c7ad93514d1791c9b1e98971b7dfd35fcbf2d7ab4e0545e5c362b22f5e181f','[\"*\"]',NULL,'2023-03-22 10:59:09','2023-03-22 10:59:09',NULL),(104,'App\\Models\\User',6,'auth_token','efb4a44c33d173ba16da912c1c68c6a14c8514f53cacea8d11b192a2ca65e52d','[\"*\"]',NULL,'2023-03-22 10:59:57','2023-03-22 10:59:57',NULL),(105,'App\\Models\\User',6,'auth_token','721e98343fc6e51697d773ffe618149c5986c86590a5ee9a49504d193edac240','[\"*\"]',NULL,'2023-03-22 11:02:36','2023-03-22 11:02:36',NULL),(106,'App\\Models\\User',6,'auth_token','b7c411da7c4f6739f0df277fd6f5b9398c9394bfe38fa5c7afb14b9d2260bc39','[\"*\"]',NULL,'2023-03-22 11:09:09','2023-03-22 11:09:09',NULL),(107,'App\\Models\\User',6,'auth_token','60886e7718befe1a96e6752baf004fe2ccd469b57025ca19acaebbbd9fdf015e','[\"*\"]',NULL,'2023-03-22 11:19:09','2023-03-22 11:19:09',NULL),(108,'App\\Models\\User',6,'auth_token','149b00b5c6cc9f8643ae68048e67e0866b3e63b7e138c55b739ec821b6f8779e','[\"*\"]',NULL,'2023-03-22 11:20:42','2023-03-22 11:20:42',NULL),(109,'App\\Models\\User',6,'auth_token','26065c996fdc961f23f5f8624148fd65ea23335e00d6c090ab9be82d60c52e1d','[\"*\"]',NULL,'2023-03-22 11:25:31','2023-03-22 11:25:31',NULL);
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','web','2023-02-23 09:34:29','2023-02-23 09:34:29');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT curdate(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'tecnico','tecnico@us.es','2023-02-06 17:22:17','2023-03-01 06:49:34','d9DzLkd2A0b3cTEiX9aXFfjiqfuAxwUVzIL94ZBJzL7XbLiGc2QLKOfKH2ki','$2y$10$jNVLTWn4xEvhoZTvo4EFveZCtCSSjYUYqAbq9u6eF7/2Wqqyo8ydS',NULL,NULL,NULL),(2,'admin','admin@us.es','2023-02-07 11:55:43','2023-02-07 11:55:51','qJTi1hQziFAgmG4sgLVy0wTxVB6gH9vkZsOd1aNbBTFtQ6r37on3v8eIUqtB','$2y$10$/dZz3Qu37A2qWG4lqh6MDOhj.nZKOQ8nWGuL6UKewPR9kVD0DeWom',NULL,NULL,NULL),(4,'Admin','admin@gorillareport.lc','2023-02-23 10:04:25','2023-02-23 10:04:25','urAOK2RiOf5jYzmDMW4IJ2JFgyckquqLtCKEsvopwY02ZHMIUqjogU3lGbqQ','$2y$10$/dZz3Qu37A2qWG4lqh6MDOhj.nZKOQ8nWGuL6UKewPR9kVD0DeWom',NULL,NULL,NULL),(5,'user','user@email.com','2023-03-02 08:32:12','2023-03-02 08:32:12','','$2y$10$fhtJQYN44FSVWo6vszcsq..IRHlQzUoabO4tObSbHWFUwU529bGAG',NULL,NULL,NULL),(6,'apiuser','apiuser@email.com','2023-03-02 09:33:22','2023-03-02 09:33:22',NULL,'$2y$10$UULKUZhKNnaYDOtV3cIyxux/PMIZbp1Ze.cJJsAoDsMncO0E/2pzW',NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-31 10:49:47
