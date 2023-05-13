/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 5.7.24 : Database - laramerce
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`laramerce` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `laramerce`;

/*Table structure for table `carts` */

DROP TABLE IF EXISTS `carts`;

CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `carts` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2019_12_14_000001_create_personal_access_tokens_table',1),
(3,'2021_12_20_135554_create_products_table',1),
(4,'2021_12_20_135801_create_carts_table',1),
(5,'2021_12_20_135845_create_transactions_table',1),
(6,'2021_12_20_140015_create_transaction_items_table',1);

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(10,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`name`,`price`,`image`,`created_at`,`updated_at`) values 
(1,'Apple',7000.00,'product/lwSAsRY4pRiXqvX3whKrKgycWaqL3MUvwh0duHnT.jpg','2022-12-21 09:20:33','2021-12-21 14:55:49'),
(2,'Avocado',9000.00,NULL,'2022-12-21 09:20:37','2022-12-21 09:20:53'),
(3,'Watermelon',11000.00,'product/hfQK9HkMqwuzVHUo5cj2sP3wrm90VIuwAWTE7Oox.jpg','2022-12-21 09:20:40','2021-12-21 14:56:18'),
(5,'Banana',15000.00,NULL,'2022-12-21 09:20:47','2022-12-21 09:20:55'),
(6,'Strawberry',17000.00,'product/zs9MmK7mdAcuy0xsKHdSRTpLkYaqhsQCTSkEp0Xa.jpg','2022-12-21 09:20:50','2021-12-21 14:56:43'),
(8,'orange',8500.00,'product/JKcPEbyTp7cy7wxBc1qTYSUaXiGrOkTuRM05PpNI.jpg','2022-12-21 09:21:02','2021-12-21 14:53:51'),
(10,'pineapple',12000.00,'product/KOz20g4VsKHNpOxBKnU8tc34zDu7QIvsV3dPk9Js.jpg','2022-12-21 09:21:05','2022-12-21 09:14:33'),
(11,'cerry',11000.00,'product/D5Eej9nwBqJCUlbXdwt383OVPIV3qb3yaQQdrST9.jpg','2022-12-21 09:15:46','2022-12-21 09:15:46'),
(12,'guava',18000.00,'product/q6tncNeDd4Z67iSx46cjWtAA7BxOiiK6cfk2xMZW.jpg','2022-12-21 09:54:58','2022-12-21 09:55:31');

/*Table structure for table `transaction_items` */

DROP TABLE IF EXISTS `transaction_items`;

CREATE TABLE `transaction_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transaction_items` */

insert  into `transaction_items`(`id`,`transaction_id`,`product_id`,`quantity`,`created_at`,`updated_at`) values 
(1,1,4,1,'2022-12-21 09:21:14','2022-12-21 09:21:21'),
(2,2,3,2,'2022-12-21 09:21:17','2022-12-21 09:21:23'),
(3,3,1,1,'2022-12-20 09:58:36','2022-12-20 09:58:36'),
(4,4,2,2,'2022-12-21 09:05:15','2022-12-21 09:05:15'),
(5,7,2,2,'2022-12-21 09:51:46','2022-12-21 09:51:46'),
(6,8,3,2,'2022-12-21 17:28:51','2022-12-21 17:28:51');

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `total` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `number` (`number`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transactions` */

insert  into `transactions`(`id`,`number`,`date`,`user_id`,`total`,`created_at`,`updated_at`) values 
(1,'TR00000001','2022-12-20',2,13000.00,'2022-12-21 09:21:34','2021-12-22 09:48:38'),
(2,'TR00000002','2022-12-21',4,22000.00,'2022-12-21 09:21:37','2021-12-24 14:38:53'),
(3,'TR00000003','2022-12-21',2,7000.00,'2022-12-21 09:21:39','2022-12-20 09:58:36'),
(4,'TR00000004','2022-12-20',6,18000.00,'2022-12-21 09:05:15','2022-12-21 09:05:15'),
(7,'TR00000005','2022-12-21',2,18000.00,'2022-12-21 09:51:46','2022-12-21 09:51:46'),
(8,'TR00000006','2022-12-21',2,22000.00,'2022-12-21 17:28:51','2022-12-21 17:28:51');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`roles`,`created_at`,`updated_at`) values 
(1,'admin','admin@email.com','$2y$10$CLraGKE5n32f8oHIFhaySOjtbOLXNeUx0Z1lO3.8oST6ykjDfCAdK','admin',NULL,NULL),
(2,'moscow','moscow@email.com','$2y$10$PYoaYuywxvTPOLOmwGQAJuRbRUaBLaCrMnCQphJTnzd3pvhQZ.IxS','user','2021-12-22 09:48:06','2021-12-22 09:48:06'),
(3,'abc','abc@email.com','$2y$10$RbYZ81BUl7Uqi02uBJ/zX.QJpnZef3qL6pPYJbYZwVfseCGZ3pqRS','user','2021-12-23 13:34:34','2021-12-23 13:34:34'),
(4,'Haekal','mhgibran@gmail.com','$2y$10$4ndBa3/iz/HFCiWC6IdXVebT5fO7A7IYxBGCqz3aFgJIs0j5ZFD9a','user','2021-12-24 14:36:35','2021-12-24 14:36:35'),
(5,'Abi','abi@email.com','$2y$10$wASx.wFTIZhuEfgWeyugYe/e9.8IDSjm3VAubeinRDlAmSRKO1vJG','user','2022-12-16 15:27:48','2022-12-16 15:27:48'),
(6,'Vincent','vincent@email.com','$2y$10$01eQoxvmyuZeFtqp.LamSe0DLrniIcjG1RZWP74HYEP2hpwWwlmNC','user','2022-12-21 09:01:21','2022-12-21 09:01:21');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
