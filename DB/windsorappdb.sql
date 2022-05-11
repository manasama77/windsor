/*
 Navicat Premium Data Transfer

 Source Server         : MySql Local
 Source Server Type    : MySQL
 Source Server Version : 100424
 Source Host           : localhost:3306
 Source Schema         : windsorappdb

 Target Server Type    : MySQL
 Target Server Version : 100424
 File Encoding         : 65001

 Date: 12/05/2022 00:08:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admins_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (1, 'Mr. Giovanni Pagac', 'trantow.carissa@example.org', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `admins` VALUES (2, 'Albertha Haley', 'fay01@example.net', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `admins` VALUES (3, 'Miss Estel Kunde MD', 'beau.fadel@example.org', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `admins` VALUES (4, 'Ebony Von', 'lamont14@example.org', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `admins` VALUES (5, 'Prof. Mireya Stanton', 'scrooks@example.net', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `admins` VALUES (6, 'Dr. Ernestine Wuckert', 'lenna.gaylord@example.net', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `admins` VALUES (7, 'Dave Buckridge', 'douglas.jordan@example.net', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `admins` VALUES (8, 'Mr. Kelvin Koelpin', 'bode.anthony@example.org', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `admins` VALUES (9, 'Mrs. Mozell DuBuque I', 'maximus72@example.org', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `admins` VALUES (10, 'Sage Schoen', 'marcel30@example.org', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `admins` VALUES (11, 'Adam PM', 'adam.pm77@gmail.com', NULL, '$2y$10$ggNi9hlBPnWInPpS8uiBOesqLkKVh/ZaMQbaKVN274GFgH77xlTtG', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);

-- ----------------------------
-- Table structure for attendances
-- ----------------------------
DROP TABLE IF EXISTS `attendances`;
CREATE TABLE `attendances`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `meeting_id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `status_presence` enum('hadir','sakit','ijin','tidak hadir') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `attendances_meeting_id_foreign`(`meeting_id` ASC) USING BTREE,
  INDEX `attendances_student_id_foreign`(`student_id` ASC) USING BTREE,
  CONSTRAINT `attendances_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `attendances_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of attendances
-- ----------------------------

-- ----------------------------
-- Table structure for class_room_students
-- ----------------------------
DROP TABLE IF EXISTS `class_room_students`;
CREATE TABLE `class_room_students`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `homeroom_teacher_id` bigint UNSIGNED NOT NULL,
  `class_room_id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  INDEX `class_room_students_homeroom_teacher_id_foreign`(`homeroom_teacher_id` ASC) USING BTREE,
  INDEX `class_room_students_class_room_id_foreign`(`class_room_id` ASC) USING BTREE,
  INDEX `class_room_students_student_id_foreign`(`student_id` ASC) USING BTREE,
  CONSTRAINT `class_room_students_class_room_id_foreign` FOREIGN KEY (`class_room_id`) REFERENCES `class_rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `class_room_students_homeroom_teacher_id_foreign` FOREIGN KEY (`homeroom_teacher_id`) REFERENCES `homeroom_teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `class_room_students_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of class_room_students
-- ----------------------------
INSERT INTO `class_room_students` VALUES ('eab45b21-759e-4f4a-9fe6-f7bbb7b0595e', 2, 2, 1, '2022-05-06 03:59:01', '2022-05-06 03:59:01');
INSERT INTO `class_room_students` VALUES ('a791419c-4fed-4b73-a8a0-c0181692578d', 2, 2, 5, '2022-05-06 03:59:01', '2022-05-06 03:59:01');
INSERT INTO `class_room_students` VALUES ('a994b0aa-7262-4487-9101-69338b0e5dde', 2, 2, 2, '2022-05-06 03:59:01', '2022-05-06 03:59:01');
INSERT INTO `class_room_students` VALUES ('53c294a8-8490-4e59-b822-5ff1ebaeb85a', 2, 2, 8, '2022-05-06 03:59:01', '2022-05-06 03:59:01');
INSERT INTO `class_room_students` VALUES ('76867363-16de-4f96-b743-82695d0a96b7', 2, 2, 3, '2022-05-06 03:59:01', '2022-05-06 03:59:01');
INSERT INTO `class_room_students` VALUES ('66ab6d36-c342-4645-9eeb-f41029f2c532', 2, 2, 7, '2022-05-06 03:59:01', '2022-05-06 03:59:01');
INSERT INTO `class_room_students` VALUES ('403c5660-880d-4a84-8772-1151bc843b49', 1, 1, 9, '2022-05-09 18:10:21', '2022-05-09 18:10:21');
INSERT INTO `class_room_students` VALUES ('3f12e84b-53c2-45e3-9b0e-6a9360865b39', 1, 1, 16, '2022-05-09 18:10:21', '2022-05-09 18:10:21');
INSERT INTO `class_room_students` VALUES ('2968f42b-a1c7-4a81-a46c-35901b9e599d', 1, 1, 10, '2022-05-09 18:10:21', '2022-05-09 18:10:21');
INSERT INTO `class_room_students` VALUES ('10e77b1d-2139-4fc3-a3bb-3b9faca4cc4d', 1, 1, 4, '2022-05-09 18:10:21', '2022-05-09 18:10:21');
INSERT INTO `class_room_students` VALUES ('f77d7e06-3cbd-4436-80d0-a7ff3fd5453c', 1, 1, 6, '2022-05-09 18:10:21', '2022-05-09 18:10:21');

-- ----------------------------
-- Table structure for class_rooms
-- ----------------------------
DROP TABLE IF EXISTS `class_rooms`;
CREATE TABLE `class_rooms`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `classroom_type` enum('mandiri','komunitas','tutorial') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vocational_type` enum('ipa','ips') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of class_rooms
-- ----------------------------
INSERT INTO `class_rooms` VALUES (1, '1A - IPA - Mandiri', 1, 'mandiri', 'ipa', '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `class_rooms` VALUES (2, '1A - IPS - Mandiri', 1, 'mandiri', 'ips', '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for homeroom_teachers
-- ----------------------------
DROP TABLE IF EXISTS `homeroom_teachers`;
CREATE TABLE `homeroom_teachers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `school_year_id` bigint UNSIGNED NOT NULL,
  `class_room_id` bigint UNSIGNED NOT NULL,
  `teacher_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `homeroom_teachers_school_year_id_foreign`(`school_year_id` ASC) USING BTREE,
  INDEX `homeroom_teachers_class_room_id_foreign`(`class_room_id` ASC) USING BTREE,
  INDEX `homeroom_teachers_teacher_id_foreign`(`teacher_id` ASC) USING BTREE,
  CONSTRAINT `homeroom_teachers_class_room_id_foreign` FOREIGN KEY (`class_room_id`) REFERENCES `class_rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `homeroom_teachers_school_year_id_foreign` FOREIGN KEY (`school_year_id`) REFERENCES `school_years` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `homeroom_teachers_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of homeroom_teachers
-- ----------------------------
INSERT INTO `homeroom_teachers` VALUES (1, 1, 1, 1, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `homeroom_teachers` VALUES (2, 1, 2, 2, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);

-- ----------------------------
-- Table structure for meeting_attachments
-- ----------------------------
DROP TABLE IF EXISTS `meeting_attachments`;
CREATE TABLE `meeting_attachments`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `meeting_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `meeting_attachments_meeting_id_foreign`(`meeting_id` ASC) USING BTREE,
  CONSTRAINT `meeting_attachments_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of meeting_attachments
-- ----------------------------
INSERT INTO `meeting_attachments` VALUES (1, 1, 'Kong kee tofu jepun putih 250gr pak.png', '1-Dr. Derick Cremin MD/y3m0U2xpXKnCd6dmdZtT5hmFvbPGxR8tmStUB2Cd.png', 'image/png', '2022-05-09 20:09:26', '2022-05-09 20:09:26');
INSERT INTO `meeting_attachments` VALUES (2, 1, 'format_upload_siswaSSS.csv', '1-Dr. Derick Cremin MD/Y2aIu3WIvkTpfJ5LOfxjSl81TJw9kpjaELKcH4Xb.txt', 'text/plain', '2022-05-09 20:09:26', '2022-05-09 20:09:26');
INSERT INTO `meeting_attachments` VALUES (3, 2, 'Kong kee tofu jepun putih 250gr pak.png', '12-raihan/SqC4XgZ3Ljrwu0d234q7ov8PeCK0Ga391ypZfyPS.png', 'image/png', '2022-05-09 21:10:50', '2022-05-09 21:10:50');
INSERT INTO `meeting_attachments` VALUES (4, 2, 'format_upload_siswaSSS.csv', '12-raihan/7T5XqIlsV3X1djcKymR2ror6c5iPKOvoGHmGK9hX.txt', 'text/plain', '2022-05-09 21:10:50', '2022-05-09 21:10:50');

-- ----------------------------
-- Table structure for meeting_link_externals
-- ----------------------------
DROP TABLE IF EXISTS `meeting_link_externals`;
CREATE TABLE `meeting_link_externals`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `meeting_id` bigint UNSIGNED NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `meeting_link_externals_meeting_id_foreign`(`meeting_id` ASC) USING BTREE,
  CONSTRAINT `meeting_link_externals_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of meeting_link_externals
-- ----------------------------
INSERT INTO `meeting_link_externals` VALUES (2, 1, 'https://google.com', '2022-05-09 21:05:31', '2022-05-09 21:05:31');
INSERT INTO `meeting_link_externals` VALUES (5, 2, 'http://google.com', '2022-05-09 21:17:02', '2022-05-09 21:17:02');

-- ----------------------------
-- Table structure for meetings
-- ----------------------------
DROP TABLE IF EXISTS `meetings`;
CREATE TABLE `meetings`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `homeroom_teacher_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_task` tinyint(1) NOT NULL DEFAULT 0,
  `from_period` datetime NULL DEFAULT NULL,
  `to_period` datetime NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `meetings_teacher_id_foreign`(`teacher_id` ASC) USING BTREE,
  INDEX `meetings_homeroom_teacher_id_foreign`(`homeroom_teacher_id` ASC) USING BTREE,
  INDEX `meetings_subject_id_foreign`(`subject_id` ASC) USING BTREE,
  CONSTRAINT `meetings_homeroom_teacher_id_foreign` FOREIGN KEY (`homeroom_teacher_id`) REFERENCES `homeroom_teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `meetings_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `meetings_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of meetings
-- ----------------------------
INSERT INTO `meetings` VALUES (1, 1, 2, 1, 'Test', 'test', 0, '2022-05-09 20:00:00', '2022-05-16 20:00:00', '2022-05-09 20:09:26', '2022-05-09 21:05:31', NULL);
INSERT INTO `meetings` VALUES (2, 12, 10, 1, 'TEST', 'KGNKDANGKL\r\nDHDKHND\r\n\r\nDDHKNDKHND\r\n\r\n\r\nDHKKDHNDK', 0, '2022-05-09 21:00:00', '2022-05-16 21:00:00', '2022-05-09 21:10:50', '2022-05-09 21:16:29', NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 452 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (432, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (433, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (434, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (435, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (436, '2022_04_07_192947_create_teachers_table', 1);
INSERT INTO `migrations` VALUES (437, '2022_04_08_131425_create_students_table', 1);
INSERT INTO `migrations` VALUES (438, '2022_04_09_195741_create_admins_table', 1);
INSERT INTO `migrations` VALUES (439, '2022_04_13_155947_create_school_years_table', 1);
INSERT INTO `migrations` VALUES (440, '2022_04_15_203000_create_subjects_table', 1);
INSERT INTO `migrations` VALUES (441, '2022_04_16_170504_create_setup_teachers_table', 1);
INSERT INTO `migrations` VALUES (442, '2022_04_16_192725_create_class_rooms_table', 1);
INSERT INTO `migrations` VALUES (443, '2022_04_16_193403_create_homeroom_teachers_table', 1);
INSERT INTO `migrations` VALUES (444, '2022_04_17_132609_create_class_room_students_table', 1);
INSERT INTO `migrations` VALUES (445, '2022_04_19_185424_create_meetings_table', 1);
INSERT INTO `migrations` VALUES (446, '2022_04_26_190302_create_meeting_attachments_table', 1);
INSERT INTO `migrations` VALUES (447, '2022_04_26_202020_create_meeting_link_externals_table', 1);
INSERT INTO `migrations` VALUES (448, '2022_04_28_022209_create_attendances_table', 1);
INSERT INTO `migrations` VALUES (449, '2022_05_01_042740_create_student_works_table', 1);
INSERT INTO `migrations` VALUES (451, '2022_05_09_183043_update_meetings_table', 2);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for school_years
-- ----------------------------
DROP TABLE IF EXISTS `school_years`;
CREATE TABLE `school_years`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `even_period_from` date NOT NULL,
  `even_period_to` date NOT NULL,
  `odd_period_from` date NOT NULL,
  `odd_period_to` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of school_years
-- ----------------------------
INSERT INTO `school_years` VALUES (1, '2022-2023', '2022-07-01', '2022-12-31', '2023-01-01', '2023-06-30', 1, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);

-- ----------------------------
-- Table structure for setup_teachers
-- ----------------------------
DROP TABLE IF EXISTS `setup_teachers`;
CREATE TABLE `setup_teachers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `school_year_id` bigint UNSIGNED NOT NULL,
  `teacher_id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `setup_teachers_school_year_id_foreign`(`school_year_id` ASC) USING BTREE,
  INDEX `setup_teachers_teacher_id_foreign`(`teacher_id` ASC) USING BTREE,
  INDEX `setup_teachers_subject_id_foreign`(`subject_id` ASC) USING BTREE,
  CONSTRAINT `setup_teachers_school_year_id_foreign` FOREIGN KEY (`school_year_id`) REFERENCES `school_years` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `setup_teachers_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `setup_teachers_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of setup_teachers
-- ----------------------------
INSERT INTO `setup_teachers` VALUES (1, 1, 11, 1, '2022-05-01 16:42:54', '2022-05-01 16:48:48', NULL);
INSERT INTO `setup_teachers` VALUES (2, 1, 2, 2, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `setup_teachers` VALUES (3, 1, 3, 3, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `setup_teachers` VALUES (4, 1, 4, 4, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `setup_teachers` VALUES (5, 1, 5, 5, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `setup_teachers` VALUES (6, 1, 6, 6, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `setup_teachers` VALUES (7, 1, 7, 7, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `setup_teachers` VALUES (8, 1, 8, 8, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `setup_teachers` VALUES (9, 1, 9, 9, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `setup_teachers` VALUES (10, 1, 10, 10, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `setup_teachers` VALUES (11, 1, 1, 2, '2022-05-09 11:30:02', '2022-05-09 18:12:19', NULL);
INSERT INTO `setup_teachers` VALUES (12, 1, 12, 10, '2022-05-09 21:07:02', '2022-05-09 21:07:02', NULL);
INSERT INTO `setup_teachers` VALUES (13, 1, 12, 10, '2022-05-09 21:09:30', '2022-05-09 21:09:42', '2022-05-09 21:09:42');

-- ----------------------------
-- Table structure for student_works
-- ----------------------------
DROP TABLE IF EXISTS `student_works`;
CREATE TABLE `student_works`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `meeting_id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_works_meeting_id_foreign`(`meeting_id` ASC) USING BTREE,
  INDEX `student_works_student_id_foreign`(`student_id` ASC) USING BTREE,
  CONSTRAINT `student_works_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `student_works_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of student_works
-- ----------------------------

-- ----------------------------
-- Table structure for students
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `students_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of students
-- ----------------------------
INSERT INTO `students` VALUES (1, 'Adam Siswa', 'adam.pm77@gmail.com', '2022-05-01 16:42:54', '$2y$10$fGd6GKFNufZEbojAJGF73.RRsmquFoOMSm5mhPB553KcQpNGTGaYy', '(480) 457-0005', '645 Kemmer Plains Suite 964\r\nSouth Dillan, MN 38719-9816', NULL, '2022-05-01 16:42:54', '2022-05-01 16:48:13', NULL);
INSERT INTO `students` VALUES (2, 'Noah Rolfson', 'feeney.dorothea@example.org', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+14137826925', '9370 Brock Course\nPort Aileen, HI 46508', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `students` VALUES (3, 'Weston Gerlach', 'gohara@example.com', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '682.666.7417', '68697 Reinger Well Suite 515\nJaimehaven, NY 42480', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `students` VALUES (4, 'Miss Ashly Reinger', 'oprice@example.com', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '(718) 904-4852', '91029 Trudie Trail Suite 092\nEast Baron, MN 27798-7333', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `students` VALUES (5, 'Neha Weber', 'elwin.mitchell@example.com', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+16578348033', '3680 Schmeler Station\nNorth Kayleyville, LA 83170-7286', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `students` VALUES (6, 'Miss Carolyn Ledner', 'sadye54@example.net', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '726.226.8577', '95262 Kurtis Mission\nWest Bailee, HI 58568-6201', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `students` VALUES (7, 'Zaria Kulas V', 'ortiz.dasia@example.com', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+19205557585', '62422 Fredrick Divide\nNew Crystel, PA 72848-1294', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `students` VALUES (8, 'Ozella Ernser', 'volkman.tess@example.net', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+1 (984) 662-1145', '7975 Holly Street Apt. 272\nSouth Dylanmouth, NH 74184', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `students` VALUES (9, 'Alanis Steuber II', 'aniya41@example.org', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '906.297.6086', '845 Steve Springs\nOpaltown, AZ 83352-5119', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `students` VALUES (10, 'Dr. Freddy Morissette', 'veum.ryann@example.net', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+1-209-366-3522', '3450 Reymundo Causeway Suite 496\nQuigleyville, ME 05145', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `students` VALUES (11, 'raihan', 'raihan2@gmail.com', NULL, '$2y$10$vvI//ERjxGsbAT45HAbCg.MMCTzRTzIhTqTBHQuhpMbWQB.C7X5Jq', '123456', 'asdas', NULL, '2022-05-06 03:38:35', '2022-05-06 03:38:35', NULL);
INSERT INTO `students` VALUES (12, 'raihan', 'asd@gmail.com', NULL, '$2y$10$XjGLrKuKLRUk.Bt.9/1YS./OxiQUi2JoRSey6C6nXvTygdTW3ef0O', '123456', 'ASDAS', NULL, '2022-05-06 03:51:12', '2022-05-06 03:53:12', NULL);
INSERT INTO `students` VALUES (13, 'udin', 'manasama968@gmail.com', NULL, '$2y$10$He1GLy4eSf2hb1fHQnFXfOSULmTaErRBQTefONS8j1cfXtT7qD4Ce', '123456', 'asdas', NULL, '2022-05-06 03:53:44', '2022-05-06 03:53:57', NULL);
INSERT INTO `students` VALUES (14, 'raihan', 'aderaihan939@gmail.com', NULL, '$2y$10$JN2OvU5KI/mX/tD3zic6cunMwIXexqhE4vwItB8g6YKML.yBJMlA.', '123456', 'asd', NULL, '2022-05-06 04:02:38', '2022-05-06 04:02:38', NULL);
INSERT INTO `students` VALUES (15, 'asdasdas', 'raihan123@gmail.com', NULL, '$2y$10$HFS4a6KfKGJdLb5HnYb0Yus8apAWnYRztksMaZXtj/4x7OTeLN2/a', '123213213', 'asdasdas', NULL, '2022-05-06 04:03:38', '2022-05-06 07:49:54', NULL);
INSERT INTO `students` VALUES (16, 'bambang', 'bambang@gmail.com', NULL, '$2y$10$jfBq5RWFpnI44fLtAkv0ZOt.owr9OEprtNFsvIsZnPQDD8FoEmezq', '123412331213', 'asdasd', NULL, '2022-05-09 11:26:48', '2022-05-09 18:10:32', NULL);

-- ----------------------------
-- Table structure for subjects
-- ----------------------------
DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subjects
-- ----------------------------
INSERT INTO `subjects` VALUES (1, 'Matematika', 1, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `subjects` VALUES (2, 'Biologi', 1, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `subjects` VALUES (3, 'Kimia', 1, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `subjects` VALUES (4, 'Fisika', 1, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `subjects` VALUES (5, 'Bahasa Indonesia', 1, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `subjects` VALUES (6, 'Bahasa Inggris', 1, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `subjects` VALUES (7, 'PKN', 1, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `subjects` VALUES (8, 'Agama', 1, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `subjects` VALUES (9, 'Kesenian', 1, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `subjects` VALUES (10, 'Komputer', 1, '2022-05-01 16:42:54', '2022-05-11 22:58:13', NULL);

-- ----------------------------
-- Table structure for teachers
-- ----------------------------
DROP TABLE IF EXISTS `teachers`;
CREATE TABLE `teachers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `teachers_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of teachers
-- ----------------------------
INSERT INTO `teachers` VALUES (1, 'Dr. Derick Cremin MD', 'flo.bartoletti@example.com', '2022-05-01 16:42:54', '$2y$10$lr8sOGx9LXVATO/amJdRDePeXXiF33vNe8c5z.VULxFEqPhO9V2Nu', '984.273.3319', '35032 Leonel Estates Suite 404\nLangmouth, MD 91415', NULL, '2022-05-01 16:42:54', '2022-05-09 18:11:22', NULL);
INSERT INTO `teachers` VALUES (2, 'Leilani Nitzsche', 'wilford00@example.org', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+1-820-701-4955', '54997 Ernestina Summit\nPort Constancefurt, RI 41690-8284', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `teachers` VALUES (3, 'Dr. Elnora Mraz Jr.', 'theresa07@example.com', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '854.721.2211', '746 Morissette Brook Apt. 364\nNew Nathanaeltown, AZ 42619-4634', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `teachers` VALUES (4, 'Cheyanne McLaughlin I', 'ctillman@example.com', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1-843-509-9426', '25523 Monroe Manors\nSouth Luigishire, WI 56902-6661', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `teachers` VALUES (5, 'Adelbert Feeney', 'terence10@example.com', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+1 (862) 318-7650', '6418 Torp Flat Apt. 281\nEast Haskellville, DC 38290', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `teachers` VALUES (6, 'Dr. Jess Will DVM', 'archibald.homenick@example.org', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+1 (626) 395-1747', '2784 Nienow Ville Apt. 935\nBriannechester, MT 60903-3348', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `teachers` VALUES (7, 'Clement Johnston', 'april26@example.com', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1-760-991-9329', '8867 Viviane Ridge Apt. 321\nWest Brannonside, MS 66598-4012', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `teachers` VALUES (8, 'Ms. Estella Conn DDS', 'hermann.marcelle@example.com', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '(747) 384-0537', '9979 Harris Shoals Suite 306\nJonatanton, NC 74619', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `teachers` VALUES (9, 'Ressie O\'Reilly', 'mozell86@example.org', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '(740) 903-1401', '38131 Lysanne Divide Apt. 568\nBarrowsbury, NH 85868-5226', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `teachers` VALUES (10, 'Ms. Minnie Mills I', 'sydnee.miller@example.net', '2022-05-01 16:42:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+1.520.887.9013', '23301 Champlin Streets Suite 526\nShaniyastad, NY 01883-0382', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `teachers` VALUES (11, 'Adam PM', 'adam.pm77@gmail.com', NULL, '$2y$10$O20hNT8vX3qw5S5CJynU1eGRmu3V3ePyJruPxJO/100dmxD8pLUzC', '082114578976', 'test alamat', NULL, '2022-05-01 16:42:54', '2022-05-01 16:42:54', NULL);
INSERT INTO `teachers` VALUES (12, 'raihan', 'raihan@gmail.com', NULL, '$2y$10$KGEUSfVYrT0BvndWisjsSuhU9ROQcAnXulmQqZFDIthVFsqSsRgSS', '41234', 'test', NULL, '2022-05-09 11:28:32', '2022-05-09 21:08:08', NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
