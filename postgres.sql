/*
 Navicat Premium Data Transfer

 Source Server         : postgre
 Source Server Type    : PostgreSQL
 Source Server Version : 130004
 Source Host           : localhost:5432
 Source Catalog        : db2
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 130004
 File Encoding         : 65001

 Date: 30/03/2022 14:16:52
*/


-- ----------------------------
-- Sequence structure for tbl_account_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_account_id_seq";
CREATE SEQUENCE "public"."tbl_account_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for tbl_device_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_device_id_seq";
CREATE SEQUENCE "public"."tbl_device_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for tbl_location_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_location_id_seq";
CREATE SEQUENCE "public"."tbl_location_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for tbl_server_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_server_id_seq";
CREATE SEQUENCE "public"."tbl_server_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for tbl_snapshot_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_snapshot_id_seq";
CREATE SEQUENCE "public"."tbl_snapshot_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for tbl_user_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_user_id_seq";
CREATE SEQUENCE "public"."tbl_user_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Table structure for tbl_account
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_account";
CREATE TABLE "public"."tbl_account" (
  "id" int4 NOT NULL DEFAULT nextval('tbl_account_id_seq'::regclass),
  "account_name" varchar(255) COLLATE "pg_catalog"."default",
  "account_fullname" varchar(255) COLLATE "pg_catalog"."default",
  "flag_del" int2,
  "avatar_name" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of tbl_account
-- ----------------------------
INSERT INTO "public"."tbl_account" VALUES (1, 'BMW', 'BMW BMW', 0, 'null');
INSERT INTO "public"."tbl_account" VALUES (3, 'BENZ', 'BENZ', 0, 'upload/skypeAvatar.jpg');

-- ----------------------------
-- Table structure for tbl_device
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_device";
CREATE TABLE "public"."tbl_device" (
  "id" int4 NOT NULL DEFAULT nextval('tbl_device_id_seq'::regclass),
  "serial_num" varchar(255) COLLATE "pg_catalog"."default",
  "account_id" int4,
  "location_id" int4,
  "created_at" timestamp(6),
  "flag_del" int4 NOT NULL
)
;

-- ----------------------------
-- Records of tbl_device
-- ----------------------------
INSERT INTO "public"."tbl_device" VALUES (2, '23412324', NULL, 1, '2022-03-14 11:08:03', 0);
INSERT INTO "public"."tbl_device" VALUES (5, '23412326', NULL, NULL, '2022-03-19 11:08:50', 0);
INSERT INTO "public"."tbl_device" VALUES (1, '23412323', 1, NULL, '2022-03-15 11:07:32', 0);
INSERT INTO "public"."tbl_device" VALUES (4, '23412325', 3, 2, '2022-03-20 11:08:29', 0);

-- ----------------------------
-- Table structure for tbl_location
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_location";
CREATE TABLE "public"."tbl_location" (
  "id" int4 NOT NULL DEFAULT nextval('tbl_location_id_seq'::regclass),
  "location_name" varchar(255) COLLATE "pg_catalog"."default",
  "creator_id" int4 NOT NULL,
  "flag_del" int4 NOT NULL,
  "created_at" date,
  "account_id" int4 NOT NULL
)
;

-- ----------------------------
-- Records of tbl_location
-- ----------------------------
INSERT INTO "public"."tbl_location" VALUES (1, 'Warshawa', 7, 0, '2022-03-30', 3);
INSERT INTO "public"."tbl_location" VALUES (2, 'Berlin', 7, 0, '2022-03-30', 3);

-- ----------------------------
-- Table structure for tbl_server
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_server";
CREATE TABLE "public"."tbl_server" (
  "id" int4 NOT NULL DEFAULT nextval('tbl_server_id_seq'::regclass),
  "server_name" varchar(255) COLLATE "pg_catalog"."default",
  "server_url" varchar(255) COLLATE "pg_catalog"."default",
  "bucket_name" varchar(255) COLLATE "pg_catalog"."default",
  "access_key" varchar(255) COLLATE "pg_catalog"."default",
  "secret_access_key" varchar(255) COLLATE "pg_catalog"."default",
  "created_at" date NOT NULL,
  "flag_del" int4 NOT NULL,
  "writtable" bool
)
;

-- ----------------------------
-- Records of tbl_server
-- ----------------------------
INSERT INTO "public"."tbl_server" VALUES (1, 'server1', 'https://www.vehicle.com', 'bucket', '234lksdf123', 'asdf323jfs13', '2022-03-30', 0, 't');
INSERT INTO "public"."tbl_server" VALUES (3, 'server3', 'https://www.vehicle.com', 'bucket2', 'oudf89sdf34', 'sdif234ksdfsd', '2022-03-30', 1, 't');
INSERT INTO "public"."tbl_server" VALUES (2, 'server2', 'https://www.vehicle.com', 'bucket1', 'fjos3e4sdf52d', '90sdfkwsdf0sdf', '2022-03-30', 1, 't');
INSERT INTO "public"."tbl_server" VALUES (4, 'server4', 'https://www.vehicle.com', 'bucket3', 'a9d0sfl234', 'df0sdf934', '2022-03-30', 0, 't');
INSERT INTO "public"."tbl_server" VALUES (5, 'server5', 'https://www.vehicle.com', 'bucket4', 's0dfkaser234', 'aisf0s9324ks', '2022-03-30', 0, 't');

-- ----------------------------
-- Table structure for tbl_snapshot
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_snapshot";
CREATE TABLE "public"."tbl_snapshot" (
  "id" int4 NOT NULL DEFAULT nextval('tbl_snapshot_id_seq'::regclass),
  "license_plate" varchar(255) COLLATE "pg_catalog"."default",
  "upload_time" timestamp(6),
  "location_id" int4,
  "path" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of tbl_snapshot
-- ----------------------------
INSERT INTO "public"."tbl_snapshot" VALUES (8, '234235235', '2022-02-10 05:21:10', 1, 'views/images/user/gallery/car2.png');
INSERT INTO "public"."tbl_snapshot" VALUES (24, '234235235', '2022-02-10 05:21:10', 5, 'views/images/user/gallery/car2.png');
INSERT INTO "public"."tbl_snapshot" VALUES (1, '234235233', '2022-02-01 05:23:24', 1, 'views/images/user/gallery/modal_car.png');
INSERT INTO "public"."tbl_snapshot" VALUES (2, '234235235', '2022-03-17 05:22:19', 1, 'views/images/user/gallery/car2.png');
INSERT INTO "public"."tbl_snapshot" VALUES (3, '234235235', '2022-03-17 05:22:19', 1, 'views/images/user/gallery/car2.png');
INSERT INTO "public"."tbl_snapshot" VALUES (4, '234235235', '2022-02-17 05:21:47', 1, 'views/images/user/gallery/car3.png');
INSERT INTO "public"."tbl_snapshot" VALUES (5, '234235235', '2022-02-07 05:17:49', 1, 'views/images/user/gallery/car1.png');
INSERT INTO "public"."tbl_snapshot" VALUES (6, '234235234', '2022-03-18 05:22:59', 1, 'views/images/user/gallery/car4.png');
INSERT INTO "public"."tbl_snapshot" VALUES (7, '234235234', '2022-01-11 05:24:33', 1, 'views/images/user/gallery/modal_car0.png');
INSERT INTO "public"."tbl_snapshot" VALUES (9, '234235233', '2022-03-17 05:27:05', 1, 'views/images/user/gallery/car4.png');
INSERT INTO "public"."tbl_snapshot" VALUES (10, '234235234', '2022-02-18 05:25:41', 1, 'views/images/user/gallery/car2.png');
INSERT INTO "public"."tbl_snapshot" VALUES (11, '234235235', '2022-02-24 05:26:29', 1, 'views/images/user/gallery/car3.png');
INSERT INTO "public"."tbl_snapshot" VALUES (12, '234235234', '2022-02-01 05:23:24', 1, 'views/images/user/gallery/modal_car.png');
INSERT INTO "public"."tbl_snapshot" VALUES (13, '234235233', '2022-02-18 05:25:41', 2, 'views/images/user/gallery/car2.png');
INSERT INTO "public"."tbl_snapshot" VALUES (14, '234235235', '2022-01-01 05:23:24', 2, 'views/images/user/gallery/modal_car.png');
INSERT INTO "public"."tbl_snapshot" VALUES (15, '234235235', '2022-02-17 05:27:05', 2, 'views/images/user/gallery/car4.png');
INSERT INTO "public"."tbl_snapshot" VALUES (16, '234235234', '2022-02-01 05:27:05', 2, 'views/images/user/gallery/car4.png');
INSERT INTO "public"."tbl_snapshot" VALUES (17, '234235233', '2022-02-01 05:23:24', 2, 'views/images/user/gallery/modal_car.png');
INSERT INTO "public"."tbl_snapshot" VALUES (18, '234235234', '2022-03-17 05:27:05', 2, 'views/images/user/gallery/car4.png');
INSERT INTO "public"."tbl_snapshot" VALUES (19, '234235233', '2022-02-01 05:23:24', 2, 'views/images/user/gallery/modal_car.png');
INSERT INTO "public"."tbl_snapshot" VALUES (20, '234235235', '2022-03-17 05:22:19', 2, 'views/images/user/gallery/car2.png');
INSERT INTO "public"."tbl_snapshot" VALUES (21, '234235233', '2022-03-18 05:22:59', 2, 'views/images/user/gallery/car4.png');
INSERT INTO "public"."tbl_snapshot" VALUES (22, '234235235', '2022-02-17 05:21:47', 2, 'views/images/user/gallery/car3.png');
INSERT INTO "public"."tbl_snapshot" VALUES (23, '234235234', '2022-02-07 05:17:49', 2, 'views/images/user/gallery/car1.png');
INSERT INTO "public"."tbl_snapshot" VALUES (25, '234235235', '2022-01-11 05:24:33', 2, 'views/images/user/gallery/modal_car0.png');
INSERT INTO "public"."tbl_snapshot" VALUES (26, '234235233', '2022-02-17 05:25:02', 2, 'views/images/user/gallery/car1.png');
INSERT INTO "public"."tbl_snapshot" VALUES (27, '234235235', '2022-02-17 05:25:02', 2, 'views/images/user/gallery/car1.png');
INSERT INTO "public"."tbl_snapshot" VALUES (28, '234235234', '2022-02-24 05:26:29', 2, 'views/images/user/gallery/car3.png');
INSERT INTO "public"."tbl_snapshot" VALUES (29, '234235235', '2022-01-17 05:27:05', 2, 'views/images/user/gallery/car4.png');

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_user";
CREATE TABLE "public"."tbl_user" (
  "id" int4 NOT NULL DEFAULT nextval('tbl_user_id_seq'::regclass),
  "user_name" varchar(255) COLLATE "pg_catalog"."default",
  "user_fullname" varchar(255) COLLATE "pg_catalog"."default",
  "account_id" int4 NOT NULL,
  "device_id" int4,
  "location_id" int4,
  "flag_del" int4 NOT NULL,
  "role" int4,
  "created_at" timestamp(0),
  "creator_id" int4,
  "password" varchar(255) COLLATE "pg_catalog"."default",
  "email" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO "public"."tbl_user" VALUES (1, 'sysadmin', 'sysadmin', 1, NULL, NULL, 0, 100, '2022-03-30 02:51:56', 0, '96e79218965eb72c92a549dd5a330112', 'sysadmin@gmail.com');
INSERT INTO "public"."tbl_user" VALUES (5, 'Vlady', 'Vlady Slav', 1, NULL, NULL, 0, 400, '2022-03-30 03:26:19', 1, NULL, 'valdyslav@gmail.com');
INSERT INTO "public"."tbl_user" VALUES (6, 'Andrei', 'Andrei Bebchenco', 1, NULL, NULL, 0, 400, '2022-03-30 03:27:17', 1, NULL, 'andrei@gmail.com');
INSERT INTO "public"."tbl_user" VALUES (3, 'Maxim', 'Maxim Lazarev', 1, NULL, NULL, 0, 200, '2022-03-30 03:25:31', 1, '96e79218965eb72c92a549dd5a330112', 'codemaster0208@gmail.com');
INSERT INTO "public"."tbl_user" VALUES (7, 'Hiroshi', 'Hiroshi Dakeshi', 3, NULL, NULL, 0, 300, '2022-03-30 03:36:32', 1, '96e79218965eb72c92a549dd5a330112', 'hiroshi@gmail.com');
INSERT INTO "public"."tbl_user" VALUES (9, 'Ebgeni', 'Ebgeni Yacheslav', 3, NULL, 2, 0, 500, '2022-03-30 04:21:00', 7, '96e79218965eb72c92a549dd5a330112', 'ebgeniyacheslav@gmail.com');
INSERT INTO "public"."tbl_user" VALUES (8, 'Anna', 'AnaYacheslavar', 3, NULL, 1, 0, 500, '2022-03-30 03:52:56', 7, '96e79218965eb72c92a549dd5a330112', 'yacheslavar@gmail.com');

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."tbl_account_id_seq"
OWNED BY "public"."tbl_account"."id";
SELECT setval('"public"."tbl_account_id_seq"', 3, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."tbl_device_id_seq"
OWNED BY "public"."tbl_device"."id";
SELECT setval('"public"."tbl_device_id_seq"', 5, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."tbl_location_id_seq"
OWNED BY "public"."tbl_location"."id";
SELECT setval('"public"."tbl_location_id_seq"', 2, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."tbl_server_id_seq"
OWNED BY "public"."tbl_server"."id";
SELECT setval('"public"."tbl_server_id_seq"', 5, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."tbl_snapshot_id_seq"
OWNED BY "public"."tbl_snapshot"."id";
SELECT setval('"public"."tbl_snapshot_id_seq"', 58, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."tbl_user_id_seq"
OWNED BY "public"."tbl_user"."id";
SELECT setval('"public"."tbl_user_id_seq"', 9, true);

-- ----------------------------
-- Primary Key structure for table tbl_account
-- ----------------------------
ALTER TABLE "public"."tbl_account" ADD CONSTRAINT "tbl_account_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table tbl_device
-- ----------------------------
ALTER TABLE "public"."tbl_device" ADD CONSTRAINT "tbl_device_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table tbl_location
-- ----------------------------
ALTER TABLE "public"."tbl_location" ADD CONSTRAINT "tbl_location_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table tbl_server
-- ----------------------------
ALTER TABLE "public"."tbl_server" ADD CONSTRAINT "tbl_server_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table tbl_snapshot
-- ----------------------------
ALTER TABLE "public"."tbl_snapshot" ADD CONSTRAINT "tbl_snapshot_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table tbl_user
-- ----------------------------
ALTER TABLE "public"."tbl_user" ADD CONSTRAINT "tbl_user_pkey" PRIMARY KEY ("id");
