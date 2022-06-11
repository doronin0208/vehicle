/*
 Navicat Premium Data Transfer

 Source Server         : postgres
 Source Server Type    : PostgreSQL
 Source Server Version : 130004
 Source Host           : localhost:5432
 Source Catalog        : vdb
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 130004
 File Encoding         : 65001

 Date: 05/04/2022 15:38:03
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
INSERT INTO "public"."tbl_account" VALUES (1, 'BMW', 'BMW BMW', 0, NULL);
INSERT INTO "public"."tbl_account" VALUES (2, 'BENZ', 'BENZ', 0, '');
INSERT INTO "public"."tbl_account" VALUES (5, 'Toyota', 'Toyota', 1, 'upload/avatar/alison-wang-mou0S7ViElQ-unsplash.jpg');

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
INSERT INTO "public"."tbl_device" VALUES (2, '2345234', 2, 3, '2022-04-05 02:37:40', 0);

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
INSERT INTO "public"."tbl_location" VALUES (2, 'Warshawa', 15, 0, '2022-04-03', 5);
INSERT INTO "public"."tbl_location" VALUES (1, 'Berlin', 2, 0, '2022-04-02', 2);
INSERT INTO "public"."tbl_location" VALUES (3, 'Nagoya', 2, 0, '2022-04-04', 2);

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
INSERT INTO "public"."tbl_server" VALUES (1, 'server1', 'http://www.vehicle.com/', 'bucket1', '234wsdf123', 'asd912432', '2022-04-02', 0, 'f');
INSERT INTO "public"."tbl_server" VALUES (2, 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', '2022-04-04', 0, 't');

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
INSERT INTO "public"."tbl_snapshot" VALUES (1, '234235233', '2022-02-01 05:23:24', 3, 'upload/gallery/modal_car.png');
INSERT INTO "public"."tbl_snapshot" VALUES (8, '234235235', '2022-02-10 05:21:10', 1, 'upload/gallery/car2.png');
INSERT INTO "public"."tbl_snapshot" VALUES (10, '234235234', '2022-02-18 05:25:41', 3, 'upload/gallery/car2.png');
INSERT INTO "public"."tbl_snapshot" VALUES (20, '234235235', '2022-03-17 05:22:19', 2, 'upload/gallery/car2.png');
INSERT INTO "public"."tbl_snapshot" VALUES (13, '234235233', '2022-02-18 05:25:41', 3, 'upload/gallery/car2.png');
INSERT INTO "public"."tbl_snapshot" VALUES (12, '234235234', '2022-02-01 05:23:24', 2, 'upload/gallery/modal_car.png');
INSERT INTO "public"."tbl_snapshot" VALUES (14, '234235235', '2022-01-01 05:23:24', 3, 'upload/gallery/modal_car.png');
INSERT INTO "public"."tbl_snapshot" VALUES (25, '234235235', '2022-01-11 05:24:33', 2, 'upload/gallery/modal_car0.png');
INSERT INTO "public"."tbl_snapshot" VALUES (7, '234235234', '2022-01-11 05:24:33', 1, 'upload/gallery/modal_car0.png');
INSERT INTO "public"."tbl_snapshot" VALUES (28, '234235234', '2022-02-24 05:26:29', 2, 'upload/gallery/car3.png');
INSERT INTO "public"."tbl_snapshot" VALUES (22, '234235235', '2022-02-17 05:21:47', 3, 'upload/gallery/car3.png');
INSERT INTO "public"."tbl_snapshot" VALUES (11, '234235235', '2022-02-24 05:26:29', 2, 'upload/gallery/car3.png');
INSERT INTO "public"."tbl_snapshot" VALUES (9, '234235233', '2022-03-17 05:27:05', 2, 'upload/gallery/car4.png');
INSERT INTO "public"."tbl_snapshot" VALUES (21, '234235233', '2022-03-18 05:22:59', 3, 'upload/gallery/car4.png');
INSERT INTO "public"."tbl_snapshot" VALUES (29, '234235235', '2022-01-17 05:27:05', 3, 'upload/gallery/car4.png');
INSERT INTO "public"."tbl_snapshot" VALUES (15, '234235235', '2022-02-17 05:27:05', 1, 'upload/gallery/car4.png');
INSERT INTO "public"."tbl_snapshot" VALUES (6, '234235234', '2022-03-18 05:22:59', 3, 'upload/gallery/car4.png');
INSERT INTO "public"."tbl_snapshot" VALUES (5, '234235235', '2022-02-07 05:17:49', 1, 'upload/gallery/car1.png');
INSERT INTO "public"."tbl_snapshot" VALUES (26, '234235233', '2022-02-17 05:25:02', 1, 'upload/gallery/car1.png');
INSERT INTO "public"."tbl_snapshot" VALUES (23, '234235234', '2022-02-07 05:17:49', 3, 'upload/gallery/car1.png');
INSERT INTO "public"."tbl_snapshot" VALUES (27, '234235235', '2022-02-17 05:25:02', 1, 'upload/gallery/car1.png');
INSERT INTO "public"."tbl_snapshot" VALUES (16, '234235234', '2022-02-01 05:27:05', 5, 'upload/gallery/car4.png');
INSERT INTO "public"."tbl_snapshot" VALUES (18, '234235234', '2022-03-17 05:27:05', 1, 'upload/gallery/car4.png');
INSERT INTO "public"."tbl_snapshot" VALUES (3, '234235235', '2022-03-17 05:23:19', 2, 'upload/gallery/car2.png');
INSERT INTO "public"."tbl_snapshot" VALUES (24, '234235235', '2022-02-10 05:20:10', 3, 'upload/gallery/car2.png');
INSERT INTO "public"."tbl_snapshot" VALUES (19, '234235233', '2022-02-01 05:22:24', 3, 'upload/gallery/modal_car.png');
INSERT INTO "public"."tbl_snapshot" VALUES (17, '234235233', '2022-02-01 06:23:24', 2, 'upload/gallery/modal_car.png');
INSERT INTO "public"."tbl_snapshot" VALUES (4, '234235235', '2022-02-17 05:22:47', 3, 'upload/gallery/car3.png');
INSERT INTO "public"."tbl_snapshot" VALUES (2, '234235235', '2022-03-17 05:21:19', 2, 'upload/gallery/car4.png');

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
INSERT INTO "public"."tbl_user" VALUES (1, 'sysadmin', 'sysadmin', 1, NULL, NULL, 0, 100, '2022-04-01 16:31:18', 0, '96e79218965eb72c92a549dd5a330112', 'sysadmin@gmail.com');
INSERT INTO "public"."tbl_user" VALUES (3, 'Vlady', 'Vlady Slave', 1, NULL, NULL, 0, 200, '2022-04-02 04:40:52', 1, '96e79218965eb72c92a549dd5a330112', 'vladyslave@gmail.com');
INSERT INTO "public"."tbl_user" VALUES (2, 'Chris', 'Chris Chalance', 2, NULL, NULL, 0, 300, '2022-04-01 17:11:29', 1, '96e79218965eb72c92a549dd5a330112', 'chris@gmail.com');
INSERT INTO "public"."tbl_user" VALUES (6, 'Chris12', 'Chris Chalance', 2, NULL, 1, 0, 500, '2022-04-02 08:28:50', 2, '96e79218965eb72c92a549dd5a330112', 'chris12@gmail.com');
INSERT INTO "public"."tbl_user" VALUES (15, 'Anna', 'Anna Pablob', 5, NULL, NULL, 1, 300, '2022-04-03 04:30:06', 3, '96e79218965eb72c92a549dd5a330112', 'annapabloba@gmail.com');
INSERT INTO "public"."tbl_user" VALUES (16, 'asdf', 'asdf', 5, NULL, NULL, 1, 400, '2022-04-03 04:38:16', 15, NULL, 'asdf@asdf.com');
INSERT INTO "public"."tbl_user" VALUES (17, 'wer', 'wer', 5, NULL, 2, 1, 500, '2022-04-03 04:39:03', 15, NULL, 'wer@wer.com');
INSERT INTO "public"."tbl_user" VALUES (18, 'qwe', 'qwe', 5, NULL, 2, 1, 500, '2022-04-03 04:39:27', 15, NULL, 'qwe@qwe.com');
INSERT INTO "public"."tbl_user" VALUES (19, 'asdf', 'asdf', 1, NULL, NULL, 0, 400, '2022-04-03 04:57:05', 1, NULL, 'asdf@gmail.com');
INSERT INTO "public"."tbl_user" VALUES (12, 'Andrei', 'Andrei Yacheslav', 2, NULL, NULL, 0, 400, '2022-04-03 04:18:46', 2, NULL, 'andreiyacheslave@gmail.com');
INSERT INTO "public"."tbl_user" VALUES (10, 'Andrei', 'Andrei Yacheslav', 2, NULL, 2, 0, 500, '2022-04-03 04:15:31', 2, '96e79218965eb72c92a549dd5a330112', 'andreiyacheslave1@gmail.com');
INSERT INTO "public"."tbl_user" VALUES (20, 'Irina', 'Irina Yacheslavar', 2, NULL, 1, 1, 500, '2022-04-05 07:22:44', 2, NULL, 'irina@gmail.com');

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."tbl_account_id_seq"
OWNED BY "public"."tbl_account"."id";
SELECT setval('"public"."tbl_account_id_seq"', 5, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."tbl_device_id_seq"
OWNED BY "public"."tbl_device"."id";
SELECT setval('"public"."tbl_device_id_seq"', 2, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."tbl_location_id_seq"
OWNED BY "public"."tbl_location"."id";
SELECT setval('"public"."tbl_location_id_seq"', 3, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."tbl_server_id_seq"
OWNED BY "public"."tbl_server"."id";
SELECT setval('"public"."tbl_server_id_seq"', 2, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."tbl_snapshot_id_seq"
OWNED BY "public"."tbl_snapshot"."id";
SELECT setval('"public"."tbl_snapshot_id_seq"', 29, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."tbl_user_id_seq"
OWNED BY "public"."tbl_user"."id";
SELECT setval('"public"."tbl_user_id_seq"', 20, true);

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
-- Uniques structure for table tbl_user
-- ----------------------------
ALTER TABLE "public"."tbl_user" ADD CONSTRAINT "un" UNIQUE ("email");

-- ----------------------------
-- Primary Key structure for table tbl_user
-- ----------------------------
ALTER TABLE "public"."tbl_user" ADD CONSTRAINT "tbl_user_pkey" PRIMARY KEY ("id");
