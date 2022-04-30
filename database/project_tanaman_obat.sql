/*
 Navicat Premium Data Transfer

 Source Server         : Connection MySQL
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : project_tanaman_obat

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 23/04/2021 11:09:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_admin`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- ----------------------------
-- Table structure for kelompok_tanaman
-- ----------------------------
DROP TABLE IF EXISTS `kelompok_tanaman`;
CREATE TABLE `kelompok_tanaman`  (
  `id_kelompok` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_kelompok`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kelompok_tanaman
-- ----------------------------
INSERT INTO `kelompok_tanaman` VALUES (1, 'Jenis Batang');
INSERT INTO `kelompok_tanaman` VALUES (2, 'Jenis Akar');
INSERT INTO `kelompok_tanaman` VALUES (3, 'Jenis Daun');

-- ----------------------------
-- Table structure for komposisi_obat
-- ----------------------------
DROP TABLE IF EXISTS `komposisi_obat`;
CREATE TABLE `komposisi_obat`  (
  `id_komposisi` int(11) NOT NULL AUTO_INCREMENT,
  `id_tanaman` int(11) NOT NULL,
  `komposisi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_komposisi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of komposisi_obat
-- ----------------------------

-- ----------------------------
-- Table structure for obat
-- ----------------------------
DROP TABLE IF EXISTS `obat`;
CREATE TABLE `obat`  (
  `id_obat` int(11) NOT NULL AUTO_INCREMENT,
  `kode_obat` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_obat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `indikasi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `aturan_pakai` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_tanaman` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `komposisi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_obat`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of obat
-- ----------------------------
INSERT INTO `obat` VALUES (1, 'B001', 'Paracetamol', '<ol><li>asddaad</li><li>dfasdfaf</li><li>dfafafasfaaf<br></li></ol>', 'Menurunkan panas dan demam', '3x sehari setelah makan', 'Lidah Buaya', '<p>lorem jkfsadfljsalkfj lkjfkas lkfjaslkfas faksjf safasjfa fjflkas aslfjas<br></p>');

-- ----------------------------
-- Table structure for tanaman_obat
-- ----------------------------
DROP TABLE IF EXISTS `tanaman_obat`;
CREATE TABLE `tanaman_obat`  (
  `id_tanaman` int(11) NOT NULL AUTO_INCREMENT,
  `kode_tanaman` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_tanaman` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `indikasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gambar_tanaman` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kelompok` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_tanaman`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tanaman_obat
-- ----------------------------
INSERT INTO `tanaman_obat` VALUES (1, 'T001', 'Lidah Buaya', '<p>kfadf fasdfasfa</p><p>adfafafafafasf<br></p>', 'dfnaskfjalkfjals', 'bibit_lidah_buaya___tanaman_aloevera-768x56485040.jpg', 'Jenis Batang');
INSERT INTO `tanaman_obat` VALUES (2, 'T002', 'Putri Malu', '<p>dsfasfjsdlkshahfjkahfjkasfhksfhkfhsfjkshafjksa<br></p>', 'dafafasfsafsa', 'inilah-tanaman-herbal-yang-dapat-meningkatkan-daya-tahan-tubuh67692.jpg', 'Jenis Daun');
INSERT INTO `tanaman_obat` VALUES (3, 'T003', 'Akar tanaman', '<p>fasjf;afl;kfjsanfnlks<br></p>', 'adfafasfsadfsaffas', '309690230196884.JPG', 'Jenis Akar');

SET FOREIGN_KEY_CHECKS = 1;
