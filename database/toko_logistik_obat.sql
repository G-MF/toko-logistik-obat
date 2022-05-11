/*
 Navicat Premium Data Transfer

 Source Server         : Connection MySQL
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : toko_logistik_obat

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 10/05/2022 12:48:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `level` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_admin`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

-- ----------------------------
-- Table structure for detail_transaksi_penjualan
-- ----------------------------
DROP TABLE IF EXISTS `detail_transaksi_penjualan`;
CREATE TABLE `detail_transaksi_penjualan`  (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `no_nota` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kode_obat` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_obat` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga_pembelian` int(11) NULL DEFAULT NULL,
  `harga_jual` int(11) NULL DEFAULT NULL,
  `jenis_obat` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `banyak_beli` int(11) NULL DEFAULT NULL,
  `sub_total` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_detail`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_transaksi_penjualan
-- ----------------------------
INSERT INTO `detail_transaksi_penjualan` VALUES (14, 'N-20220510-120446-001', 'Ob001', 'CTM', 2000, 3000, 'Tablet', 65, 195000);
INSERT INTO `detail_transaksi_penjualan` VALUES (15, 'N-20220510-120446-001', 'Ob002', 'Paracetamol', 1500, 3000, 'Tablet', 10, 30000);

-- ----------------------------
-- Table structure for karyawan
-- ----------------------------
DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE `karyawan`  (
  `kode_karyawan` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_karyawan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jenis_kelamin` enum('Laki - laki','Perempuan') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_hp` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`kode_karyawan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of karyawan
-- ----------------------------
INSERT INTO `karyawan` VALUES ('K001', 'Gusti Fahrubi', 'Laki - laki', '08121212123', 'Banjarmasin Utara');

-- ----------------------------
-- Table structure for pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan`  (
  `kode_pelanggan` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_pelanggan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jenis_kelamin` enum('Laki - laki','Perempuan') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_hp` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`kode_pelanggan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pelanggan
-- ----------------------------
INSERT INTO `pelanggan` VALUES ('Plg001', 'aluh ketuyung', 'Perempuan', '12345', 'Kayu tangi II');
INSERT INTO `pelanggan` VALUES ('Plg002', 'Anang Warung', 'Laki - laki', '09897656', 'Banjarbaru');

-- ----------------------------
-- Table structure for pembelian_obat
-- ----------------------------
DROP TABLE IF EXISTS `pembelian_obat`;
CREATE TABLE `pembelian_obat`  (
  `no_pembelian_obat` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal_pembelian` date NULL DEFAULT NULL,
  `kode_supplier` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_supplier` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kode_obat` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_obat` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga_pembelian` int(11) NULL DEFAULT NULL,
  `jumlah_obat` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`no_pembelian_obat`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pembelian_obat
-- ----------------------------
INSERT INTO `pembelian_obat` VALUES ('PO001', '2022-05-01', 'Spl001', 'Pt. Obat Madju', 'Ob001', 'CTM', 2000, 15);

-- ----------------------------
-- Table structure for perhitungan_laba_rugi
-- ----------------------------
DROP TABLE IF EXISTS `perhitungan_laba_rugi`;
CREATE TABLE `perhitungan_laba_rugi`  (
  `no_perhitungan` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_perhitungan` date NULL DEFAULT NULL,
  `keuntungan_penjualan` int(11) NULL DEFAULT NULL,
  `total_pembelian` int(11) NULL DEFAULT NULL,
  `gajih_karyawan` int(11) NULL DEFAULT NULL,
  `biaya_listrik` int(11) NULL DEFAULT NULL,
  `biaya_pdam` int(11) NULL DEFAULT NULL,
  `total_keuntungan_bersih` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`no_perhitungan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of perhitungan_laba_rugi
-- ----------------------------
INSERT INTO `perhitungan_laba_rugi` VALUES ('Pl001', '2022-05-10', 80000, 30000, 10000, 20000, 10000, 10000);

-- ----------------------------
-- Table structure for stok_obat
-- ----------------------------
DROP TABLE IF EXISTS `stok_obat`;
CREATE TABLE `stok_obat`  (
  `kode_obat` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_obat` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga_pembelian` int(11) NULL DEFAULT NULL,
  `harga_jual` int(11) NULL DEFAULT NULL,
  `jenis_obat` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `gambar_obat` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jumlah_stok` int(11) NULL DEFAULT NULL,
  `dosis_obat` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ket_obat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`kode_obat`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stok_obat
-- ----------------------------
INSERT INTO `stok_obat` VALUES ('Ob001', 'CTM', 2000, 3000, 'Tablet', '309690230120152.JPG', 100, '3 x sehari', '-');
INSERT INTO `stok_obat` VALUES ('Ob002', 'Paracetamol', 1500, 3000, 'Tablet', '5045432694.jpg', 90, '3 x sehari', '-');
INSERT INTO `stok_obat` VALUES ('Ob003', 'Amoxilin', 1500, 3000, 'Tablet', 'bibit_lidah_buaya___tanaman_aloevera-768x56429870.jpg', 150, '3 x sehari', '-');
INSERT INTO `stok_obat` VALUES ('Ob004', 'Ampicilin', 1000, 1500, 'Tablet', 'inilah-tanaman-herbal-yang-dapat-meningkatkan-daya-tahan-tubuh80384.jpg', 100, '3 x sehari', '-');
INSERT INTO `stok_obat` VALUES ('Ob005', 'Bodrex1', 2500, 5000, 'Tablet', '880160319.jpg', 100, '3 x sehari', '-');

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier`  (
  `kode_supplier` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_supplier` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_hp` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`kode_supplier`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES ('Spl001', 'Pt. Obat Madju', '65479887921', 'Pelaihari Tanah laut');

-- ----------------------------
-- Table structure for transaksi_penjualan
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_penjualan`;
CREATE TABLE `transaksi_penjualan`  (
  `no_nota` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal_transaksi` date NULL DEFAULT NULL,
  `kode_pelanggan` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_pelanggan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_hp` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `total_bayar` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`no_nota`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaksi_penjualan
-- ----------------------------
INSERT INTO `transaksi_penjualan` VALUES ('N-20220510-120446-001', '2022-05-10', 'Plg002', 'Anang Warung', '09897656', 'Banjarbaru', 225000);

SET FOREIGN_KEY_CHECKS = 1;
