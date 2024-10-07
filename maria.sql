/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50739 (5.7.39)
 Source Host           : localhost:3306
 Source Schema         : maria

 Target Server Type    : MySQL
 Target Server Version : 50739 (5.7.39)
 File Encoding         : 65001

 Date: 07/10/2024 12:37:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cagar_budaya
-- ----------------------------
DROP TABLE IF EXISTS `cagar_budaya`;
CREATE TABLE `cagar_budaya` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `sejarah` text,
  `lokasi` varchar(255) DEFAULT NULL,
  `senin` varchar(255) DEFAULT NULL,
  `selasa` varchar(255) DEFAULT NULL,
  `rabu` varchar(255) DEFAULT NULL,
  `kamis` varchar(255) DEFAULT NULL,
  `jumat` varchar(255) DEFAULT NULL,
  `sabtu` varchar(255) DEFAULT NULL,
  `minggu` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foto` text,
  `kategori_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cagar_budaya
-- ----------------------------
BEGIN;
INSERT INTO `cagar_budaya` (`id`, `nama`, `sejarah`, `lokasi`, `senin`, `selasa`, `rabu`, `kamis`, `jumat`, `sabtu`, `minggu`, `created_at`, `updated_at`, `foto`, `kategori_id`) VALUES (1, 'Mesjid Sabilal', '<p>kj1</p>', 'link map', '12:00 wita', '12:00 wita', '12:00 wita', '12:00 wita', '12:00 wita', '12:00 wita', '12:00 wita', '2024-10-01 15:33:52', '2024-10-07 12:07:21', 'zLcZQj66fba808cd83d.jpg', 3);
COMMIT;

-- ----------------------------
-- Table structure for jadwal
-- ----------------------------
DROP TABLE IF EXISTS `jadwal`;
CREATE TABLE `jadwal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cagar_id` int(11) DEFAULT NULL,
  `petugas_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pengunjung_pria` varchar(255) DEFAULT NULL,
  `pengunjung_wanita` varchar(255) DEFAULT NULL,
  `hasil` text,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jadwal
-- ----------------------------
BEGIN;
INSERT INTO `jadwal` (`id`, `cagar_id`, `petugas_id`, `tanggal`, `created_at`, `updated_at`, `pengunjung_pria`, `pengunjung_wanita`, `hasil`, `foto`) VALUES (1, 1, 3, '2024-10-08', '2024-10-07 11:09:56', '2024-10-07 12:31:54', '10', '20', '<p>ewfrwdqsewfrfde</p>', 'iymYkH6703643a340fd.png');
INSERT INTO `jadwal` (`id`, `cagar_id`, `petugas_id`, `tanggal`, `created_at`, `updated_at`, `pengunjung_pria`, `pengunjung_wanita`, `hasil`, `foto`) VALUES (2, 1, 4, '2024-10-07', '2024-10-07 12:13:25', '2024-10-07 12:13:25', NULL, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kategori
-- ----------------------------
BEGIN;
INSERT INTO `kategori` (`id`, `nama`) VALUES (1, 'Mesjid');
INSERT INTO `kategori` (`id`, `nama`) VALUES (2, 'Makam');
INSERT INTO `kategori` (`id`, `nama`) VALUES (3, 'Tugu');
INSERT INTO `kategori` (`id`, `nama`) VALUES (5, 'sdf');
COMMIT;

-- ----------------------------
-- Table structure for petugas
-- ----------------------------
DROP TABLE IF EXISTS `petugas`;
CREATE TABLE `petugas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nip` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jkel` varchar(255) DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of petugas
-- ----------------------------
BEGIN;
INSERT INTO `petugas` (`id`, `nip`, `nama`, `jkel`, `telp`, `created_at`, `updated_at`) VALUES (3, '123', 'udin', NULL, '09876543456789', NULL, NULL);
INSERT INTO `petugas` (`id`, `nip`, `nama`, `jkel`, `telp`, `created_at`, `updated_at`) VALUES (4, '321', 'andi', NULL, '1234554', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for role_users
-- ----------------------------
DROP TABLE IF EXISTS `role_users`;
CREATE TABLE `role_users` (
  `user_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  UNIQUE KEY `role_users_user_id_role_id_unique` (`user_id`,`role_id`) USING BTREE,
  KEY `role_users_role_id_foreign` (`role_id`) USING BTREE,
  CONSTRAINT `role_users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of role_users
-- ----------------------------
BEGIN;
INSERT INTO `role_users` (`user_id`, `role_id`) VALUES (1, 1);
INSERT INTO `role_users` (`user_id`, `role_id`) VALUES (4, 2);
INSERT INTO `role_users` (`user_id`, `role_id`) VALUES (12, 2);
INSERT INTO `role_users` (`user_id`, `role_id`) VALUES (13, 2);
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES (1, 'superadmin', '2020-12-23 23:17:35', '2020-12-23 23:17:35');
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES (2, 'user', '2024-10-01 14:51:49', '2024-10-01 14:51:49');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(255) NOT NULL,
  `password_superadmin` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `api_token` varchar(255) DEFAULT NULL,
  `last_session` varchar(255) DEFAULT NULL,
  `change_password` int(1) unsigned DEFAULT '0' COMMENT '0: belum, 1: sudah',
  `petugas_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `users_username_unique` (`username`) USING BTREE,
  UNIQUE KEY `users_email_unique` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `password_superadmin`, `remember_token`, `created_at`, `updated_at`, `api_token`, `last_session`, `change_password`, `petugas_id`) VALUES (1, 'admin', NULL, 'admin', '2023-04-29 07:57:56', '$2y$10$E9xG1OtIFvBRbHqlwHCC3u48vO5eBf2OQ9wFNpi.qKOAzVqNDUdW2', NULL, NULL, '2023-04-29 07:57:56', '2023-04-29 07:57:56', '$2y$10$tjMANlV25IUwvKuPxEODW.3qE3zPSKjwhmgTcZUgsPDZRGcpgGAN.', NULL, 0, NULL);
INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `password_superadmin`, `remember_token`, `created_at`, `updated_at`, `api_token`, `last_session`, `change_password`, `petugas_id`) VALUES (4, 'budi', NULL, 'budi', '2023-05-15 20:58:28', '$2y$10$RxhAbRImcouzNE31XoRS9e13HIIyYxHHoLqx22jOnFI1BdkcMpqKq', NULL, NULL, '2023-05-15 20:58:28', '2023-05-15 20:58:28', NULL, NULL, 0, NULL);
INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `password_superadmin`, `remember_token`, `created_at`, `updated_at`, `api_token`, `last_session`, `change_password`, `petugas_id`) VALUES (12, 'asrani', NULL, '123', '2024-10-01 14:53:05', '$2y$10$zCwTEGoux2PsELHVHtM.5uAGg15oGnNyNyveJSu4OrWc9SUBUOGca', NULL, NULL, '2024-10-01 14:53:05', '2024-10-01 14:53:05', NULL, NULL, 0, 3);
INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `password_superadmin`, `remember_token`, `created_at`, `updated_at`, `api_token`, `last_session`, `change_password`, `petugas_id`) VALUES (13, 'andi', NULL, '321', '2024-10-07 12:07:44', '$2y$10$PMJ2VtDWtyKV643IJRxXkOe37D3wRkctrtkoCc2s4wCUNMeL/DaBq', NULL, NULL, '2024-10-07 12:07:44', '2024-10-07 12:07:44', NULL, NULL, 0, 4);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
