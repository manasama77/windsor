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

 Date: 11/10/2022 22:18:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `admins` VALUES (1, 'Amelia Zulaika', 'lazuardi.tira@example.org', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `admins` VALUES (2, 'Jinawi Candrakanta Hidayat', 'suci.anggraini@example.org', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `admins` VALUES (3, 'Restu Puspita', 'isalahudin@example.net', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `admins` VALUES (4, 'Teguh Simbolon', 'bahuraksa41@example.com', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `admins` VALUES (5, 'Farah Purnawati S.T.', 'zkuswoyo@example.net', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `admins` VALUES (6, 'Ibun Hutagalung', 'bprasetyo@example.com', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `admins` VALUES (7, 'Cahyanto Ramadan', 'cengkir.hutagalung@example.net', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `admins` VALUES (8, 'Dadi Santoso M.TI.', 'riyanti.lidya@example.com', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `admins` VALUES (9, 'Febi Novitasari', 'pwinarno@example.org', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `admins` VALUES (10, 'Mahdi Galih Pradipta', 'puspasari.galiono@example.org', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `admins` VALUES (11, 'Adam PM', 'adam.pm77@gmail.com', NULL, '$2y$10$1RAst.fHZDtwzOSrwKaQPO6AwktWcI2SbK8aQieZqGBQ99ET9PDbi', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);

-- ----------------------------
-- Table structure for attendances
-- ----------------------------
DROP TABLE IF EXISTS `attendances`;
CREATE TABLE `attendances`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `meeting_id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `status_presence` enum('hadir','sakit','ijin','tidak hadir') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
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
-- Table structure for chats
-- ----------------------------
DROP TABLE IF EXISTS `chats`;
CREATE TABLE `chats`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_id` bigint UNSIGNED NOT NULL,
  `user_type` enum('teacher','student') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `chats_meeting_id_foreign`(`meeting_id` ASC) USING BTREE,
  CONSTRAINT `chats_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of chats
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
INSERT INTO `class_room_students` VALUES ('be66c25e-8df4-498f-a389-eccf7bb31763', 1, 1, 9, '2022-09-14 17:46:31', '2022-09-14 17:46:31');
INSERT INTO `class_room_students` VALUES ('796cbaa1-ad14-4828-a710-8f9dc7246e84', 1, 1, 7, '2022-09-14 17:46:31', '2022-09-14 17:46:31');
INSERT INTO `class_room_students` VALUES ('65b52848-2eff-46bd-ad9f-9065617d619e', 1, 1, 2, '2022-09-14 17:46:31', '2022-09-14 17:46:31');
INSERT INTO `class_room_students` VALUES ('06bf5359-580b-4af6-b9db-4320c05c16c0', 1, 1, 10, '2022-09-14 17:46:31', '2022-09-14 17:46:31');
INSERT INTO `class_room_students` VALUES ('dc5749d5-5ead-4afc-b07a-1761234a548f', 1, 1, 1, '2022-09-14 17:46:31', '2022-09-14 17:46:31');
INSERT INTO `class_room_students` VALUES ('001dedd9-147c-49ae-a36e-867512dc23c6', 2, 2, 3, '2022-09-14 17:46:51', '2022-09-14 17:46:51');
INSERT INTO `class_room_students` VALUES ('cc9591b5-990f-450c-9297-f653bafead9b', 2, 2, 6, '2022-09-14 17:46:51', '2022-09-14 17:46:51');
INSERT INTO `class_room_students` VALUES ('00303584-6804-4b9a-9149-029aeca78962', 2, 2, 8, '2022-09-14 17:46:51', '2022-09-14 17:46:51');
INSERT INTO `class_room_students` VALUES ('d4602e4e-802f-48af-bfeb-854b922cd838', 2, 2, 5, '2022-09-14 17:46:51', '2022-09-14 17:46:51');
INSERT INTO `class_room_students` VALUES ('59092f5d-7ab3-4a63-8f60-4ab6ab704ee6', 2, 2, 4, '2022-09-14 17:46:51', '2022-09-14 17:46:51');

-- ----------------------------
-- Table structure for class_rooms
-- ----------------------------
DROP TABLE IF EXISTS `class_rooms`;
CREATE TABLE `class_rooms`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `class_rooms` VALUES (1, '1A - IPA - Mandiri', 1, 'mandiri', 'ipa', '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `class_rooms` VALUES (2, '1A - IPS - Mandiri', 1, 'mandiri', 'ips', '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `homeroom_teachers` VALUES (1, 1, 1, 1, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `homeroom_teachers` VALUES (2, 1, 2, 2, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);

-- ----------------------------
-- Table structure for meeting_attachments
-- ----------------------------
DROP TABLE IF EXISTS `meeting_attachments`;
CREATE TABLE `meeting_attachments`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `meeting_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `meeting_attachments_meeting_id_foreign`(`meeting_id` ASC) USING BTREE,
  CONSTRAINT `meeting_attachments_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of meeting_attachments
-- ----------------------------

-- ----------------------------
-- Table structure for meeting_link_externals
-- ----------------------------
DROP TABLE IF EXISTS `meeting_link_externals`;
CREATE TABLE `meeting_link_externals`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `meeting_id` bigint UNSIGNED NOT NULL,
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `meeting_link_externals_meeting_id_foreign`(`meeting_id` ASC) USING BTREE,
  CONSTRAINT `meeting_link_externals_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of meeting_link_externals
-- ----------------------------

-- ----------------------------
-- Table structure for meetings
-- ----------------------------
DROP TABLE IF EXISTS `meetings`;
CREATE TABLE `meetings`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `homeroom_teacher_id` bigint UNSIGNED NOT NULL,
  `active_date` date NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_task` tinyint(1) NOT NULL DEFAULT 0,
  `from_period` datetime NULL DEFAULT NULL,
  `to_period` datetime NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `meetings_teacher_id_foreign`(`teacher_id` ASC) USING BTREE,
  INDEX `meetings_subject_id_foreign`(`subject_id` ASC) USING BTREE,
  INDEX `meetings_homeroom_teacher_id_foreign`(`homeroom_teacher_id` ASC) USING BTREE,
  CONSTRAINT `meetings_homeroom_teacher_id_foreign` FOREIGN KEY (`homeroom_teacher_id`) REFERENCES `homeroom_teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `meetings_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `meetings_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of meetings
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 76 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (51, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (52, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (53, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (54, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (55, '2022_04_07_192947_create_teachers_table', 1);
INSERT INTO `migrations` VALUES (56, '2022_04_08_131425_create_students_table', 1);
INSERT INTO `migrations` VALUES (57, '2022_04_09_195741_create_admins_table', 1);
INSERT INTO `migrations` VALUES (58, '2022_04_13_155947_create_school_years_table', 1);
INSERT INTO `migrations` VALUES (59, '2022_04_15_200000_create_subject_groups_table', 1);
INSERT INTO `migrations` VALUES (60, '2022_04_15_231234_create_subjects_table', 1);
INSERT INTO `migrations` VALUES (61, '2022_04_16_170504_create_setup_teachers_table', 1);
INSERT INTO `migrations` VALUES (62, '2022_04_16_192725_create_class_rooms_table', 1);
INSERT INTO `migrations` VALUES (63, '2022_04_16_193403_create_homeroom_teachers_table', 1);
INSERT INTO `migrations` VALUES (64, '2022_04_17_132609_create_class_room_students_table', 1);
INSERT INTO `migrations` VALUES (65, '2022_04_19_185424_create_meetings_table', 1);
INSERT INTO `migrations` VALUES (66, '2022_04_26_190302_create_meeting_attachments_table', 1);
INSERT INTO `migrations` VALUES (67, '2022_04_26_202020_create_meeting_link_externals_table', 1);
INSERT INTO `migrations` VALUES (68, '2022_04_28_022209_create_attendances_table', 1);
INSERT INTO `migrations` VALUES (69, '2022_05_01_042740_create_student_works_table', 1);
INSERT INTO `migrations` VALUES (70, '2022_05_09_183043_update_meetings_table', 1);
INSERT INTO `migrations` VALUES (71, '2022_05_21_025920_create_student_evaluations_table', 1);
INSERT INTO `migrations` VALUES (72, '2022_05_28_173111_create_chats_table', 1);
INSERT INTO `migrations` VALUES (73, '2022_05_28_231453_create_user_onlines_table', 1);
INSERT INTO `migrations` VALUES (74, '2022_07_26_225342_create_report_cards_table', 1);
INSERT INTO `migrations` VALUES (75, '2022_07_26_225733_create_report_card_students_table', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for report_card_students
-- ----------------------------
DROP TABLE IF EXISTS `report_card_students`;
CREATE TABLE `report_card_students`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `report_card_id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `kkm` int NOT NULL,
  `pengetahuan_nilai` int NOT NULL,
  `pengetahuan_predikat` int NOT NULL,
  `keterampilan_nilai` int NOT NULL,
  `keterampilan_predikat` int NOT NULL,
  `keterangan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `report_card_students_report_card_id_foreign`(`report_card_id` ASC) USING BTREE,
  INDEX `report_card_students_student_id_foreign`(`student_id` ASC) USING BTREE,
  INDEX `report_card_students_subject_id_foreign`(`subject_id` ASC) USING BTREE,
  CONSTRAINT `report_card_students_report_card_id_foreign` FOREIGN KEY (`report_card_id`) REFERENCES `report_cards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `report_card_students_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `report_card_students_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of report_card_students
-- ----------------------------

-- ----------------------------
-- Table structure for report_cards
-- ----------------------------
DROP TABLE IF EXISTS `report_cards`;
CREATE TABLE `report_cards`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `school_year_id` bigint UNSIGNED NOT NULL,
  `period` enum('odd','even') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_room_student_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `report_cards_school_year_id_foreign`(`school_year_id` ASC) USING BTREE,
  CONSTRAINT `report_cards_school_year_id_foreign` FOREIGN KEY (`school_year_id`) REFERENCES `school_years` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of report_cards
-- ----------------------------

-- ----------------------------
-- Table structure for school_years
-- ----------------------------
DROP TABLE IF EXISTS `school_years`;
CREATE TABLE `school_years`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `odd_period_from` date NOT NULL,
  `odd_period_to` date NOT NULL,
  `even_period_from` date NOT NULL,
  `even_period_to` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of school_years
-- ----------------------------
INSERT INTO `school_years` VALUES (1, '2021-2022', '2021-07-01', '2021-12-31', '2022-01-01', '2022-06-30', 1, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);

-- ----------------------------
-- Table structure for setup_teachers
-- ----------------------------
DROP TABLE IF EXISTS `setup_teachers`;
CREATE TABLE `setup_teachers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `school_year_id` bigint UNSIGNED NOT NULL,
  `teacher_id` bigint UNSIGNED NOT NULL,
  `class_room_id` bigint UNSIGNED NOT NULL,
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
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of setup_teachers
-- ----------------------------
INSERT INTO `setup_teachers` VALUES (1, 1, 1, 1, 1, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `setup_teachers` VALUES (2, 1, 2, 1, 2, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `setup_teachers` VALUES (3, 1, 3, 1, 3, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `setup_teachers` VALUES (4, 1, 4, 1, 4, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `setup_teachers` VALUES (5, 1, 5, 1, 5, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `setup_teachers` VALUES (6, 1, 6, 1, 6, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `setup_teachers` VALUES (7, 1, 7, 1, 7, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `setup_teachers` VALUES (8, 1, 8, 1, 8, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `setup_teachers` VALUES (9, 1, 9, 1, 9, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `setup_teachers` VALUES (10, 1, 10, 1, 10, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `setup_teachers` VALUES (11, 1, 1, 2, 1, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `setup_teachers` VALUES (12, 1, 2, 2, 2, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `setup_teachers` VALUES (13, 1, 3, 2, 3, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `setup_teachers` VALUES (14, 1, 4, 2, 4, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `setup_teachers` VALUES (15, 1, 5, 2, 5, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `setup_teachers` VALUES (16, 1, 6, 2, 6, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `setup_teachers` VALUES (17, 1, 7, 2, 7, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `setup_teachers` VALUES (18, 1, 8, 2, 8, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `setup_teachers` VALUES (19, 1, 9, 2, 9, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `setup_teachers` VALUES (20, 1, 10, 2, 10, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);

-- ----------------------------
-- Table structure for student_evaluations
-- ----------------------------
DROP TABLE IF EXISTS `student_evaluations`;
CREATE TABLE `student_evaluations`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `meeting_id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `value` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_evaluations_meeting_id_foreign`(`meeting_id` ASC) USING BTREE,
  INDEX `student_evaluations_student_id_foreign`(`student_id` ASC) USING BTREE,
  CONSTRAINT `student_evaluations_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `student_evaluations_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of student_evaluations
-- ----------------------------

-- ----------------------------
-- Table structure for student_works
-- ----------------------------
DROP TABLE IF EXISTS `student_works`;
CREATE TABLE `student_works`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `meeting_id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `file_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `students_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of students
-- ----------------------------
INSERT INTO `students` VALUES (1, 'Jessica Mulyani S.Farm', 'suci.puspasari@example.net', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0841 3160 2982', 'Dk. Salatiga No. 364, Administrasi Jakarta Pusat 69672, NTB', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `students` VALUES (2, 'Elon Tamba', 'lasmono75@example.org', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0573 1345 1888', 'Ds. Baabur Royan No. 559, Cirebon 73326, Sumut', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `students` VALUES (3, 'Kuncara Sihombing M.TI.', 'labuh.waskita@example.org', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '(+62) 437 9814 8683', 'Gg. Sukabumi No. 638, Bukittinggi 78845, Kaltara', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `students` VALUES (4, 'Yusuf Pangestu', 'sakura93@example.net', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0236 2897 0707', 'Jln. Jagakarsa No. 116, Lubuklinggau 52380, DIY', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `students` VALUES (5, 'Warta Sihotang S.Psi', 'capa17@example.net', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '(+62) 749 6109 9742', 'Gg. Otto No. 527, Pagar Alam 43302, DKI', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `students` VALUES (6, 'Purwa Banara Marbun', 'shakila12@example.com', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '(+62) 445 3266 0430', 'Jr. Bhayangkara No. 208, Pariaman 61035, Bengkulu', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `students` VALUES (7, 'Ella Natalia Laksita', 'ana81@example.net', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '(+62) 251 0948 2396', 'Jln. Abdul. Muis No. 662, Prabumulih 70004, Riau', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `students` VALUES (8, 'Respati Gadang Mustofa M.Pd', 'asmianto.pradipta@example.com', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0898 1373 650', 'Ds. Abang No. 374, Langsa 88815, DKI', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `students` VALUES (9, 'Dina Belinda Lestari', 'narji57@example.com', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0771 3506 999', 'Jr. Bazuka Raya No. 610, Probolinggo 46498, Kepri', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `students` VALUES (10, 'Himawan Hutasoit', 'adinata69@example.com', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0512 5295 3382', 'Jln. Baranangsiang No. 234, Makassar 97749, Maluku', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);

-- ----------------------------
-- Table structure for subject_groups
-- ----------------------------
DROP TABLE IF EXISTS `subject_groups`;
CREATE TABLE `subject_groups`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subject_groups
-- ----------------------------
INSERT INTO `subject_groups` VALUES (1, 'Kelompok A (Umum)', '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `subject_groups` VALUES (2, 'Kelompok B (Peminatan IPS)', '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `subject_groups` VALUES (3, 'Kelompok B (Peminatan IPA)', '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `subject_groups` VALUES (4, 'Kelompok C (Pemberdayaan)', '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `subject_groups` VALUES (5, 'Kelompok D (Keterampilan Wajib)', '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `subject_groups` VALUES (6, 'Kelompok E (Keterampilan Pilihan)', '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);

-- ----------------------------
-- Table structure for subjects
-- ----------------------------
DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject_group_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `subjects_subject_group_id_foreign`(`subject_group_id` ASC) USING BTREE,
  CONSTRAINT `subjects_subject_group_id_foreign` FOREIGN KEY (`subject_group_id`) REFERENCES `subject_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subjects
-- ----------------------------
INSERT INTO `subjects` VALUES (1, 1, 'Pendidikan Agama dan Budi Pekerti', 1, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `subjects` VALUES (2, 1, 'Pendidikan Pancasila dan Kewarganegaraan (PPKn)', 1, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `subjects` VALUES (3, 1, 'Bahasa Indonesia', 1, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `subjects` VALUES (4, 1, 'Matematika', 1, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `subjects` VALUES (5, 1, 'Sejarah Indonesia', 1, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `subjects` VALUES (6, 1, 'Bahasa Inggris', 1, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `subjects` VALUES (7, 2, 'Geografi', 1, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `subjects` VALUES (8, 2, 'Sejarah', 1, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `subjects` VALUES (9, 2, 'Sosiologi', 1, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `subjects` VALUES (10, 2, 'Ekonomi', 1, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `subjects` VALUES (11, 3, 'Public Speaking', 1, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `subjects` VALUES (12, 3, 'Teknologi Infromasi dan Komunikasi', 1, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `subjects` VALUES (13, 4, 'Seni dan Budaya', 1, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `subjects` VALUES (14, 4, 'Pendidikan Jasmani dan Olah Raga', 1, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `subjects` VALUES (15, 4, 'Prakarya dan Kewirausahaan', 1, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `subjects` VALUES (16, 5, 'English For IELTS', 1, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);

-- ----------------------------
-- Table structure for teachers
-- ----------------------------
DROP TABLE IF EXISTS `teachers`;
CREATE TABLE `teachers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `teachers_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of teachers
-- ----------------------------
INSERT INTO `teachers` VALUES (1, 'Violet Susanti', 'fitriani.prakasa@example.org', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0937 3010 3094', 'Jr. BKR No. 664, Ambon 66314, Malut', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `teachers` VALUES (2, 'Widya Zulaika', 'indra22@example.org', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0398 1790 810', 'Kpg. Bank Dagang Negara No. 389, Pekalongan 12442, NTB', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `teachers` VALUES (3, 'Kenari Gara Sinaga S.E.', 'rahmawati.mala@example.org', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '(+62) 366 7982 973', 'Jln. Gremet No. 656, Manado 19123, Gorontalo', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `teachers` VALUES (4, 'Tina Wahyuni S.Pd', 'viman.hidayat@example.com', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0646 0658 1102', 'Ki. Kartini No. 134, Langsa 48326, Bengkulu', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `teachers` VALUES (5, 'Bakianto Simbolon M.Kom.', 'xsihombing@example.org', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0885 3577 7107', 'Ki. Badak No. 115, Tarakan 48258, Gorontalo', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `teachers` VALUES (6, 'Viktor Suryono', 'fitriani49@example.net', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '(+62) 680 7678 372', 'Dk. Gegerkalong Hilir No. 549, Bekasi 21396, Riau', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `teachers` VALUES (7, 'Wardaya Danuja Iswahyudi', 'fgunarto@example.com', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0980 0891 5999', 'Ds. Dipenogoro No. 380, Pasuruan 11295, DKI', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `teachers` VALUES (8, 'Zalindra Handayani', 'usyi19@example.org', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '(+62) 604 6452 3937', 'Ki. Wahid No. 508, Tebing Tinggi 10793, Kepri', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `teachers` VALUES (9, 'Cindy Permata S.E.I', 'laksmiwati.dadap@example.com', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '(+62) 557 1960 256', 'Psr. HOS. Cjokroaminoto (Pasirkaliki) No. 586, Metro 69244, Kalbar', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `teachers` VALUES (10, 'Ifa Puspasari', 'jasmani.hariyah@example.org', '2022-09-14 17:31:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '(+62) 265 1790 637', 'Jr. Bazuka Raya No. 568, Gorontalo 18889, Sulut', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);
INSERT INTO `teachers` VALUES (11, 'Adam PM', 'adam.pm77@gmail.com', NULL, '$2y$10$hFZ.y.J2WfFDPLDnWLFhHOfDN6L6X3q/ea/SBtCV2zr9kx1Yjw3RS', '082114578976', 'test alamat', NULL, '2022-09-14 17:31:01', '2022-09-14 17:31:01', NULL);

-- ----------------------------
-- Table structure for user_onlines
-- ----------------------------
DROP TABLE IF EXISTS `user_onlines`;
CREATE TABLE `user_onlines`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `meeting_id` bigint UNSIGNED NOT NULL,
  `user_type` enum('teacher','student') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_onlines_meeting_id_foreign`(`meeting_id` ASC) USING BTREE,
  CONSTRAINT `user_onlines_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_onlines
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
