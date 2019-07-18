-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: medicitas
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.18.04.1

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
-- Table structure for table `analisis`
--

DROP TABLE IF EXISTS `analisis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `analisis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL DEFAULT '0',
  `patient_id` int(10) unsigned NOT NULL,
  `arrived_analysis_date` datetime NOT NULL,
  `type_analisis_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `analisis_type_analisis_id_foreign` (`type_analisis_id`),
  KEY `analisis_patient_id_foreign` (`patient_id`),
  CONSTRAINT `analisis_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `analisis_type_analisis_id_foreign` FOREIGN KEY (`type_analisis_id`) REFERENCES `type_analisis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `analisis`
--

LOCK TABLES `analisis` WRITE;
/*!40000 ALTER TABLE `analisis` DISABLE KEYS */;
INSERT INTO `analisis` VALUES (17,0,5,'2019-05-31 00:00:00',6,'2019-05-30 00:04:55','2019-05-30 00:04:55'),(18,0,5,'2019-05-31 00:00:00',5,'2019-05-30 01:25:32','2019-05-30 01:25:32');
/*!40000 ALTER TABLE `analisis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conversations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversations`
--

LOCK TABLES `conversations` WRITE;
/*!40000 ALTER TABLE `conversations` DISABLE KEYS */;
/*!40000 ALTER TABLE `conversations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor_patient`
--

DROP TABLE IF EXISTS `doctor_patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor_patient` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` int(10) unsigned NOT NULL,
  `patient_id` int(10) unsigned NOT NULL,
  `accepted` tinyint(1) DEFAULT NULL,
  `send_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_patient_doctor_id_foreign` (`doctor_id`),
  KEY `doctor_patient_patient_id_foreign` (`patient_id`),
  CONSTRAINT `doctor_patient_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `doctor_patient_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor_patient`
--

LOCK TABLES `doctor_patient` WRITE;
/*!40000 ALTER TABLE `doctor_patient` DISABLE KEYS */;
INSERT INTO `doctor_patient` VALUES (2,1,7,1,4,'2019-05-14 22:41:38','2019-05-14 22:42:04'),(3,1,5,1,5,'2019-05-20 23:33:53','2019-05-20 23:34:33'),(4,1,3,1,3,'2019-05-29 15:13:05','2019-05-29 15:13:47'),(5,3,7,1,4,'2019-05-29 22:42:29','2019-05-29 22:44:09'),(6,1,11,1,9,'2019-05-29 22:46:41','2019-05-29 22:47:54'),(7,2,7,1,4,'2019-05-29 23:18:11','2019-05-29 23:18:49'),(8,3,5,1,5,'2019-05-30 00:02:23','2019-05-30 00:02:58'),(9,2,5,1,5,'2019-05-30 01:22:24','2019-05-30 01:28:15'),(10,4,12,0,10,'2019-05-30 05:07:26','2019-05-30 05:07:26');
/*!40000 ALTER TABLE `doctor_patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `medical_speciality_id` int(10) unsigned DEFAULT NULL,
  `medical_consultant_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doctors_user_id_foreign` (`user_id`),
  KEY `doctors_medical_speciality_id_foreign` (`medical_speciality_id`),
  KEY `doctors_medical_consultant_id_foreign` (`medical_consultant_id`),
  CONSTRAINT `doctors_medical_consultant_id_foreign` FOREIGN KEY (`medical_consultant_id`) REFERENCES `medical_consultants` (`id`) ON DELETE SET NULL,
  CONSTRAINT `doctors_medical_speciality_id_foreign` FOREIGN KEY (`medical_speciality_id`) REFERENCES `medical_specialties` (`id`) ON DELETE SET NULL,
  CONSTRAINT `doctors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctors`
--

LOCK TABLES `doctors` WRITE;
/*!40000 ALTER TABLE `doctors` DISABLE KEYS */;
INSERT INTO `doctors` VALUES (1,2,1,NULL,'2019-05-14 22:25:08','2019-05-14 22:25:08'),(2,7,24,NULL,'2019-05-29 22:37:59','2019-05-29 22:37:59'),(3,8,28,NULL,'2019-05-29 22:38:19','2019-05-29 22:38:19'),(4,6,3,NULL,'2019-05-29 22:39:13','2019-05-29 22:39:13');
/*!40000 ALTER TABLE `doctors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `guid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `local_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`guid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medical_appointment_states`
--

DROP TABLE IF EXISTS `medical_appointment_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medical_appointment_states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medical_appointment_states`
--

LOCK TABLES `medical_appointment_states` WRITE;
/*!40000 ALTER TABLE `medical_appointment_states` DISABLE KEYS */;
INSERT INTO `medical_appointment_states` VALUES (1,'Agendado',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(2,'Pendiente',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(3,'En Curso',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(4,'Finalizada',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43');
/*!40000 ALTER TABLE `medical_appointment_states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medical_appointments`
--

DROP TABLE IF EXISTS `medical_appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medical_appointments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `patient_id` int(10) unsigned NOT NULL,
  `doctor_id` int(10) unsigned NOT NULL,
  `medical_consultant_id` int(10) unsigned DEFAULT NULL,
  `medical_appointment_status_id` int(10) unsigned NOT NULL,
  `comments` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `medical_appointments_patient_id_foreign` (`patient_id`),
  KEY `medical_appointments_doctor_id_foreign` (`doctor_id`),
  KEY `medical_appointments_medical_consultant_id_foreign` (`medical_consultant_id`),
  KEY `medical_appointments_medical_appointment_status_id_foreign` (`medical_appointment_status_id`),
  CONSTRAINT `medical_appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `medical_appointments_medical_appointment_status_id_foreign` FOREIGN KEY (`medical_appointment_status_id`) REFERENCES `medical_appointment_states` (`id`),
  CONSTRAINT `medical_appointments_medical_consultant_id_foreign` FOREIGN KEY (`medical_consultant_id`) REFERENCES `medical_consultants` (`id`) ON DELETE SET NULL,
  CONSTRAINT `medical_appointments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medical_appointments`
--

LOCK TABLES `medical_appointments` WRITE;
/*!40000 ALTER TABLE `medical_appointments` DISABLE KEYS */;
INSERT INTO `medical_appointments` VALUES (7,'2019-05-20','07:00:00','07:30:00',5,1,NULL,1,NULL,'2019-05-20 23:37:51','2019-05-20 23:37:51'),(8,'2019-05-21','18:30:00','19:00:00',5,1,NULL,1,NULL,'2019-05-20 23:39:22','2019-05-20 23:39:22'),(9,'2019-05-29','02:10:00','04:20:00',5,1,NULL,1,NULL,'2019-05-29 01:38:35','2019-05-29 01:38:35'),(10,'2019-05-30','06:30:00','07:31:00',7,1,NULL,1,NULL,'2019-05-29 01:41:46','2019-05-29 01:41:46'),(11,'2019-05-31','06:31:00','03:16:00',7,1,NULL,1,NULL,'2019-05-29 02:22:14','2019-05-29 02:22:14'),(12,'2019-06-30','06:30:00','07:30:00',7,1,NULL,1,NULL,'2019-05-29 04:09:32','2019-05-29 04:09:32'),(13,'2019-06-01','06:00:00','06:30:00',7,3,NULL,1,NULL,'2019-05-29 22:45:52','2019-05-29 22:45:52'),(14,'2019-05-30','14:00:00','15:00:00',5,1,NULL,1,NULL,'2019-05-30 00:01:06','2019-05-30 00:01:06'),(15,'2019-06-05','17:00:00','19:00:00',5,3,NULL,1,NULL,'2019-05-30 00:06:07','2019-05-30 00:06:07'),(16,'2019-05-31','13:59:00','15:00:00',5,1,NULL,1,NULL,'2019-05-30 01:23:37','2019-05-30 01:23:37'),(17,'2019-06-02','14:00:00','15:00:00',5,1,NULL,1,NULL,'2019-05-30 01:26:44','2019-05-30 01:26:44');
/*!40000 ALTER TABLE `medical_appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medical_consultants`
--

DROP TABLE IF EXISTS `medical_consultants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medical_consultants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medical_consultants`
--

LOCK TABLES `medical_consultants` WRITE;
/*!40000 ALTER TABLE `medical_consultants` DISABLE KEYS */;
/*!40000 ALTER TABLE `medical_consultants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medical_specialties`
--

DROP TABLE IF EXISTS `medical_specialties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medical_specialties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medical_specialties`
--

LOCK TABLES `medical_specialties` WRITE;
/*!40000 ALTER TABLE `medical_specialties` DISABLE KEYS */;
INSERT INTO `medical_specialties` VALUES (1,'Alergología',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(2,'Anestesiología y reanimación',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(3,'Cardiología',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(4,'Gastroenterología',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(5,'Endocrinología',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(6,'Geriatría',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(7,'Hematología y hemoterapia',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(8,'Infectología',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(9,'Medicina aeroespacial',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(10,'Medicina del deporte',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(11,'Medicina del trabajo',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(12,'Medicina de urgencias',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(13,'Medicina familiar y comunitaria',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(14,'Medicina física y rehabilitación',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(15,'Medicina intensiva',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(16,'Medicina interna',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(17,'Medicina legal y forense',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(18,'Medicina preventiva y salud pública',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(19,'Medicina veterinaria',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(20,'Nefrología',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(21,'Neumología',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(22,'Neurología',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(23,'Nutriología',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(24,'Oftalmología',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(25,'Oncología médica',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(26,'Oncología radioterápica',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(27,'Pediatría',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(28,'Psiquiatría',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(29,'Rehabilitación',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(30,'Reumatología',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(31,'Toxicología',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(32,'Urología',NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43');
/*!40000 ALTER TABLE `medical_specialties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_seen` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_from_sender` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_from_receiver` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2015_10_05_110608_create_messages_table',1),(4,'2015_10_05_110622_create_conversations_table',1),(5,'2018_10_20_225249_create_files_table',1),(6,'2018_10_20_225250_create_user_details_table',1),(7,'2018_10_20_225251_create_medical_specialties_table',1),(8,'2018_10_20_225353_create_medical_consultants_table',1),(9,'2018_10_20_225418_create_medical_appointment_states_table',1),(10,'2018_10_20_225441_create_medical_doctors_table',1),(11,'2018_10_20_225521_create_patients_table',1),(12,'2018_10_20_225543_create_medical_appointments_table',1),(13,'2018_10_20_225544_create_doctor_patient_table',1),(14,'2018_10_21_193032_create_permission_tables',1),(15,'2018_11_30_043744_create_notifications_table',1),(16,'2019_04_11_005513_create_laboratory_type_analisis_table',1),(17,'2019_04_11_005900_create_laboratory_analisis_table',1),(18,'2019_05_29_033626_create_raitings_doctors_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `model_has_roles` VALUES (1,'App\\User',1),(2,'App\\User',2),(3,'App\\User',3),(3,'App\\User',4),(3,'App\\User',5),(2,'App\\User',6),(2,'App\\User',7),(2,'App\\User',8),(3,'App\\User',9),(3,'App\\User',10);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `user_id` int(10) unsigned NOT NULL,
  `is_seen` tinyint(1) NOT NULL,
  `redirect` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect_param_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect_param_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect_param_3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'El paciente Ana Isabel te envio una solicitud','',2,1,'patients.index',NULL,NULL,NULL,'2019-05-14 22:26:50','2019-05-14 22:27:07'),(2,'El doctor Mariela acepto tu solicitud','',4,1,'profile.show','2',NULL,NULL,'2019-05-14 22:27:20','2019-05-14 22:41:28'),(3,'¿Agendar Cita?','Analisis listos para 2019-05-17',2,1,'schedulePatient.index',NULL,NULL,NULL,'2019-05-14 22:32:25','2019-05-14 22:32:38'),(4,'¿Agendar Cita?','Analisis listos para 2019-05-20',2,1,'schedulePatient.index',NULL,NULL,NULL,'2019-05-14 22:34:00','2019-05-14 22:34:07'),(5,'El paciente Ana Isabel te envio una solicitud','',2,1,'patients.index',NULL,NULL,NULL,'2019-05-14 22:41:38','2019-05-14 22:41:57'),(6,'El doctor Mariela acepto tu solicitud','',4,1,'profile.show','2',NULL,NULL,'2019-05-14 22:42:04','2019-05-14 22:42:35'),(7,'¿Agendar Cita?','Analisis listos para 2019-05-18',2,1,'schedulePatient.index',NULL,NULL,NULL,'2019-05-14 22:49:22','2019-05-14 22:49:29'),(8,'¿Agendar Cita?','Analisis listos para 2019-05-17',2,1,'schedulePatient.index',NULL,NULL,NULL,'2019-05-14 23:09:24','2019-05-14 23:09:43'),(9,'El paciente Daniel te envio una solicitud','',2,1,'patients.index',NULL,NULL,NULL,'2019-05-20 23:33:53','2019-05-20 23:34:26'),(10,'El doctor Mariela acepto tu solicitud','',5,1,'profile.show','2',NULL,NULL,'2019-05-20 23:34:33','2019-05-20 23:36:56'),(11,'¿Agendar Cita?','Analisis listos para 2019-05-26',2,1,'schedulePatient.index',NULL,NULL,NULL,'2019-05-20 23:40:08','2019-05-20 23:40:21'),(12,'¿Agendar Cita?','Analisis listos para 2019-05-26',2,1,'schedulePatient.index',NULL,NULL,NULL,'2019-05-23 01:24:14','2019-05-23 01:24:27'),(13,'¿Agendar Cita?','Analisis listos para 2019-06-03',2,1,'schedulePatient.index',NULL,NULL,NULL,'2019-05-29 02:34:09','2019-05-29 02:57:33'),(14,'¿Agendar Cita?','Analisis listos para 2019-05-26',2,1,'schedulePatient.index',NULL,NULL,NULL,'2019-05-29 02:48:47','2019-05-29 04:09:12'),(15,'¿Agendar Cita?','Analisis listos para 2019-06-01',2,1,'schedulePatient.index',NULL,NULL,NULL,'2019-05-29 02:55:45','2019-05-29 23:06:00'),(16,'¿Agendar Cita?','Analisis listos para 2019-06-01',2,1,'schedulePatient.index',NULL,NULL,NULL,'2019-05-29 04:08:54','2019-05-29 23:06:02'),(17,'El paciente Eduardo te envio una solicitud','',2,1,'patients.index',NULL,NULL,NULL,'2019-05-29 15:13:05','2019-05-29 15:13:41'),(18,'El doctor Mariela acepto tu solicitud','',3,1,'profile.show','2',NULL,NULL,'2019-05-29 15:13:47','2019-05-29 23:51:52'),(19,'El paciente Ana Isabel te envio una solicitud','',8,1,'patients.index',NULL,NULL,NULL,'2019-05-29 22:42:29','2019-05-29 22:43:54'),(20,'El doctor Erica acepto tu solicitud','',4,1,'profile.show','8',NULL,NULL,'2019-05-29 22:44:09','2019-05-29 23:14:18'),(21,'¿Agendar Cita?','Analisis listos para 2019-06-01',8,1,'schedulePatient.index',NULL,NULL,NULL,'2019-05-29 22:44:53','2019-05-29 22:45:15'),(22,'El paciente Juan Antonio te envio una solicitud','',2,1,'patients.index',NULL,NULL,NULL,'2019-05-29 22:46:41','2019-05-29 22:47:49'),(23,'El doctor Mariela acepto tu solicitud','',9,0,'profile.show','2',NULL,NULL,'2019-05-29 22:47:54','2019-05-29 22:47:54'),(24,'¿Agendar Cita?','Analisis listos para 2019-06-04',2,1,'schedulePatient.index',NULL,NULL,NULL,'2019-05-29 23:07:25','2019-05-29 23:07:45'),(25,'¿Agendar Cita?','Analisis listos para 2019-06-01',2,1,'schedulePatient.index',NULL,NULL,NULL,'2019-05-29 23:09:41','2019-05-29 23:10:03'),(26,'El paciente Ana Isabel te envio una solicitud','',7,1,'patients.index',NULL,NULL,NULL,'2019-05-29 23:18:11','2019-05-29 23:18:37'),(27,'El doctor Abraham acepto tu solicitud','',4,1,'profile.show','7',NULL,NULL,'2019-05-29 23:18:49','2019-05-29 23:20:22'),(28,'El paciente Daniel te envio una solicitud','',8,1,'patients.index',NULL,NULL,NULL,'2019-05-30 00:02:23','2019-05-30 00:02:52'),(29,'El doctor Erica acepto tu solicitud','',5,1,'profile.show','8',NULL,NULL,'2019-05-30 00:02:58','2019-05-30 00:06:47'),(30,'¿Agendar Cita?','Analisis listos para 2019-06-05',8,1,'schedulePatient.index',NULL,NULL,NULL,'2019-05-30 00:04:55','2019-05-30 00:05:23'),(31,'El paciente Daniel te envio una solicitud','',7,1,'patients.index',NULL,NULL,NULL,'2019-05-30 01:22:24','2019-05-30 01:28:02'),(32,'¿Agendar Cita?','Analisis listos para 2019-06-02',2,1,'schedulePatient.index',NULL,NULL,NULL,'2019-05-30 01:25:32','2019-05-30 01:26:16'),(33,'El doctor Abraham acepto tu solicitud','',5,0,'profile.show','7',NULL,NULL,'2019-05-30 01:28:15','2019-05-30 01:28:15'),(34,'El paciente Armando te envio una solicitud','',6,0,'patients.index',NULL,NULL,NULL,'2019-05-30 05:07:26','2019-05-30 05:07:26');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `observations` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patients_user_id_foreign` (`user_id`),
  CONSTRAINT `patients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (3,3,NULL,'2019-05-14 22:22:47','2019-05-14 22:22:47'),(5,5,NULL,'2019-05-14 22:24:20','2019-05-14 22:24:20'),(7,4,NULL,'2019-05-14 22:41:05','2019-05-14 22:41:05'),(11,9,NULL,'2019-05-29 22:46:33','2019-05-29 22:46:33'),(12,10,NULL,'2019-05-30 05:05:07','2019-05-30 05:05:07');
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'permission-read','web','2019-05-14 22:15:42','2019-05-14 22:15:42'),(2,'permission-create','web','2019-05-14 22:15:42','2019-05-14 22:15:42'),(3,'permission-edit','web','2019-05-14 22:15:42','2019-05-14 22:15:42'),(4,'permission-delete','web','2019-05-14 22:15:42','2019-05-14 22:15:42'),(5,'role-read','web','2019-05-14 22:15:42','2019-05-14 22:15:42'),(6,'role-create','web','2019-05-14 22:15:42','2019-05-14 22:15:42'),(7,'role-edit','web','2019-05-14 22:15:42','2019-05-14 22:15:42'),(8,'role-delete','web','2019-05-14 22:15:42','2019-05-14 22:15:42'),(9,'user-read','web','2019-05-14 22:15:42','2019-05-14 22:15:42'),(10,'user-create','web','2019-05-14 22:15:42','2019-05-14 22:15:42'),(11,'user-edit','web','2019-05-14 22:15:42','2019-05-14 22:15:42'),(12,'user-delete','web','2019-05-14 22:15:42','2019-05-14 22:15:42');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings_doctors`
--

DROP TABLE IF EXISTS `ratings_doctors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratings_doctors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `doctor_id` int(10) unsigned NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ratings_doctors_user_id_foreign` (`user_id`),
  KEY `ratings_doctors_doctor_id_foreign` (`doctor_id`),
  CONSTRAINT `ratings_doctors_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ratings_doctors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings_doctors`
--

LOCK TABLES `ratings_doctors` WRITE;
/*!40000 ALTER TABLE `ratings_doctors` DISABLE KEYS */;
INSERT INTO `ratings_doctors` VALUES (2,3,1,5,'2019-05-29 21:13:18','2019-05-29 21:59:11'),(3,4,1,3,'2019-05-29 23:43:16','2019-05-29 23:43:16'),(4,4,2,4,'2019-05-29 23:43:17','2019-05-29 23:43:17'),(5,4,3,5,'2019-05-29 23:43:19','2019-05-29 23:43:19'),(6,5,1,5,'2019-05-30 00:01:51','2019-05-30 01:22:10'),(7,5,3,5,'2019-05-30 00:07:02','2019-05-30 00:07:02');
/*!40000 ALTER TABLE `ratings_doctors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
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
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'administrator','web','2019-05-14 22:15:42','2019-05-14 22:15:42'),(2,'doctor','web','2019-05-14 22:15:43','2019-05-14 22:15:43'),(3,'patient','web','2019-05-14 22:15:43','2019-05-14 22:15:43');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_analisis`
--

DROP TABLE IF EXISTS `type_analisis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_analisis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_delay` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_analisis`
--

LOCK TABLES `type_analisis` WRITE;
/*!40000 ALTER TABLE `type_analisis` DISABLE KEYS */;
INSERT INTO `type_analisis` VALUES (1,'Prueba de embarazo','Sangre, orina',2,'2019-05-14 22:29:54','2019-05-14 22:29:54'),(2,'Ácidos Biliares','Sangre',3,'2019-05-14 22:30:10','2019-05-14 22:30:10'),(3,'Ácidos grados fraccionados','Heces',4,'2019-05-14 22:31:06','2019-05-14 22:31:06'),(4,'Aminoácidos','Sangre',1,'2019-05-14 22:31:19','2019-05-14 22:31:19'),(5,'Glucosa','Sangre',2,'2019-05-14 22:31:28','2019-05-14 22:31:28'),(6,'Hemoglobina','Sangre',5,'2019-05-14 22:31:40','2019-05-14 22:31:40');
/*!40000 ALTER TABLE `type_analisis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_details` (
  `user_id` int(10) unsigned NOT NULL,
  `image_guid` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_details_image_guid_foreign` (`image_guid`),
  CONSTRAINT `user_details_image_guid_foreign` FOREIGN KEY (`image_guid`) REFERENCES `files` (`guid`) ON DELETE SET NULL,
  CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_details`
--

LOCK TABLES `user_details` WRITE;
/*!40000 ALTER TABLE `user_details` DISABLE KEYS */;
INSERT INTO `user_details` VALUES (1,NULL,NULL,NULL,NULL,'2019-05-14 22:15:43','2019-05-14 22:15:43'),(2,NULL,NULL,NULL,NULL,'2019-05-14 22:21:51','2019-05-14 22:21:51'),(3,NULL,NULL,NULL,NULL,'2019-05-14 22:22:47','2019-05-14 22:22:47'),(4,NULL,NULL,NULL,NULL,'2019-05-14 22:23:39','2019-05-14 22:23:39'),(5,NULL,NULL,NULL,NULL,'2019-05-14 22:24:20','2019-05-14 22:24:20'),(6,NULL,NULL,NULL,NULL,'2019-05-29 22:13:55','2019-05-29 22:13:55'),(7,NULL,NULL,NULL,NULL,'2019-05-29 22:32:08','2019-05-29 22:32:08'),(8,NULL,NULL,NULL,NULL,'2019-05-29 22:32:56','2019-05-29 22:32:56'),(9,NULL,NULL,NULL,NULL,'2019-05-29 22:46:33','2019-05-29 22:46:33'),(10,NULL,NULL,NULL,NULL,'2019-05-30 05:05:07','2019-05-30 05:05:07');
/*!40000 ALTER TABLE `user_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '1',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin','2019-05-14',1,'admin@admin.com',NULL,'$2y$10$LwVXgBuSkKmFdQO/B2FHjed3YWVAunglEKGnuUT588OB6L8fDQXGK','DNLqcltPHjxKfZNAZqQPNMLyoYTN4KXy1PUKvNhbCLNT4HDBR0w7G8N7h4nI','2019-05-14 22:15:43','2019-05-14 22:15:43'),(2,'Mariela','Aguilar','1995-03-28',0,'mariela@gmail.com',NULL,'$2y$10$h3CcOeOsqGAEJcj61JfXduye0zDiaD0kCZBC7avAA3leXz/jKH8Jy','0XZsYnYe7uyxna9e1uTFrKdpHs5Y3STzrtuvEmLE3FKtQ2STKyQiGTjv5lYO','2019-05-14 22:21:51','2019-05-14 22:21:51'),(3,'Eduardo','Quiroz','1995-07-06',1,'eduardo@gmail.com',NULL,'$2y$10$3LEyfwazgvpyzjQP4uK4sembAFQUq2P8lC8tQA374Fn17jnxwEy0u','W50t0VCwk8xrczKnA4SSu52q6UabYBoDUq1UrrlAKhElEkgKNMlnDq14ZAW1','2019-05-14 22:22:47','2019-05-14 22:22:47'),(4,'Ana Isabel','Jasso','1996-08-24',0,'anaisabel@gmail.com',NULL,'$2y$10$uTj38RiEpitFJFQS3PppSuVHM/t3tybmTjVezAMjuOismEbwtP1ya','VRSvuqEYsVqepCPVHbUTAp3SKcptmQyRVGPGFe7lEOJfQYZt4HjeRiSBRZyi','2019-05-14 22:23:39','2019-05-14 22:23:39'),(5,'Daniel','Camacho','1990-03-12',1,'daniel@gmail.com',NULL,'$2y$10$6vtMdxnEwD867/.L7JBEFOqURPJv6brOd4VPLVhSu9yP7dMpsZGL.','B3gOgZt6yc4ri2VnNVpgS9eaICzMK7LR30NZDbRihcF07DgTpv88GmQIhyPu','2019-05-14 22:24:20','2019-05-14 22:24:20'),(6,'Luis Alberto','Villalobos Palacios','1994-05-29',1,'luisalberto@gmail.com',NULL,'$2y$10$4.n87Kn5Gm5/zdxccmO10.GILHIs142pZyq6Mj5Ta1OCaq5P0uS6m','f3BAb9tEPcklsNVNmIOnVigijxHxhXHvn5KcJdXElH0iXmTieFq3crfGl5PA','2019-05-29 22:13:55','2019-05-29 22:13:55'),(7,'Abraham','Martinez','1960-03-16',1,'abraham@gmail.com',NULL,'$2y$10$vQGA6D4JoYf9mOr8tPIUh.OgNtQ.wJHF0cvS8aQ6UI3yunovqdXyu','2Ub9r5UXIHEshrxDNlxBBE5yovlr39njHeQnHzRL5skrat6mvIYVaPmDHe8M','2019-05-29 22:32:08','2019-05-29 22:32:08'),(8,'Erica','Rodriguez','1970-08-13',0,'erica@gmail.com',NULL,'$2y$10$p0E97wELTpFIEZwCv/rifumiiMY/IgUsTTbxJPV.Oig2o4CEGPztC','9GQTFyaswWY6VmbiCvFi0zu1mlezxIj8PlCXllztd3eKq0tqooQ2z26WPqSZ','2019-05-29 22:32:56','2019-05-29 22:32:56'),(9,'Juan Antonio','Villalobos Palacios','1995-05-15',1,'juanantonio@gmail.com',NULL,'$2y$10$1nnKR6mR8czYtbvinFGiFuvLESLMCViVQx50UOVncIVvtkjEKw6Om',NULL,'2019-05-29 22:46:33','2019-05-29 22:46:33'),(10,'Armando','Ramirez','1993-05-17',1,'armando.12@hotmail.com',NULL,'$2y$10$xfLVdsPHfb2hh1xRRaPewOo3aO0D5nUEOUtYvNBHVGqEqSR1b7CA.','u7XN7z3SasyQdEMJkJGIoIJW8eFf8cVnyonLYioZKl8osP18ijnaIUQLqBoA','2019-05-30 05:05:07','2019-05-30 05:05:07');
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

-- Dump completed on 2019-05-30 18:35:49
