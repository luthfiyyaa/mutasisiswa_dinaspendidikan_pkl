/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 80018
Source Host           : localhost:3306
Source Database       : mutasi_dikpora

Target Server Type    : MYSQL
Target Server Version : 80018
File Encoding         : 65001

Date: 2021-03-29 10:18:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for jenjang
-- ----------------------------
DROP TABLE IF EXISTS `jenjang`;
CREATE TABLE `jenjang` (
  `jenjang_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenjang_nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pejabat_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`jenjang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of jenjang
-- ----------------------------
INSERT INTO `jenjang` VALUES ('1', 'PAUD', '7', '2021-03-25 09:54:38', '2021-03-08 10:26:12');
INSERT INTO `jenjang` VALUES ('2', 'SD', '4', '2021-03-04 16:27:21', '2021-03-04 16:27:21');
INSERT INTO `jenjang` VALUES ('3', 'SMP', '1', '2021-03-25 09:54:28', null);

-- ----------------------------
-- Table structure for kecamatan
-- ----------------------------
DROP TABLE IF EXISTS `kecamatan`;
CREATE TABLE `kecamatan` (
  `kecamatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `kecamatan_kode_wilayah` char(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kecamatan_nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kecamatan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of kecamatan
-- ----------------------------
INSERT INTO `kecamatan` VALUES ('1', '051701', 'Kec. Panggul', null, null);
INSERT INTO `kecamatan` VALUES ('2', '051702', 'Kec. Munjungan', null, null);
INSERT INTO `kecamatan` VALUES ('3', '051703', 'Kec. Watulimo', null, null);
INSERT INTO `kecamatan` VALUES ('4', '051704', 'Kec. Kampak', null, null);
INSERT INTO `kecamatan` VALUES ('5', '051705', 'Kec. Dongko', null, null);
INSERT INTO `kecamatan` VALUES ('6', '051706', 'Kec. Pule', null, null);
INSERT INTO `kecamatan` VALUES ('7', '051707', 'Kec. Karangan', null, null);
INSERT INTO `kecamatan` VALUES ('8', '051708', 'Kec. Gandusari', null, null);
INSERT INTO `kecamatan` VALUES ('9', '051709', 'Kec. Durenan', null, null);
INSERT INTO `kecamatan` VALUES ('10', '051710', 'Kec. Pogalan', null, null);
INSERT INTO `kecamatan` VALUES ('11', '051711', 'Kec. Trenggalek', null, null);
INSERT INTO `kecamatan` VALUES ('12', '051712', 'Kec. Tugu', null, null);
INSERT INTO `kecamatan` VALUES ('13', '051713', 'Kec. Bendungan', null, null);
INSERT INTO `kecamatan` VALUES ('14', '051714', 'Kec. Suruh', null, null);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');

-- ----------------------------
-- Table structure for mutasi
-- ----------------------------
DROP TABLE IF EXISTS `mutasi`;
CREATE TABLE `mutasi` (
  `mutasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `mutasi_jenis` enum('1','2') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mutasi_nama_siswa` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mutasi_sekolah_asal_id` int(11) DEFAULT NULL,
  `mutasi_sekolah_asal_nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mutasi_sekolah_asal_alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mutasi_sekolah_asal_no_surat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mutasi_tanggal_mutasi` date DEFAULT NULL,
  `mutasi_nisn` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mutasi_noinduk` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mutasi_tempat_lahir` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mutasi_tanggal_lahir` date DEFAULT NULL,
  `mutasi_tingkat_kelas` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mutasi_nama_wali` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mutasi_alamat` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mutasi_sekolah_tujuan_id` int(11) DEFAULT NULL,
  `mutasi_sekolah_tujuan_nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mutasi_sekolah_tujuan_alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mutasi_sekolah_tujuan_no_surat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mutasi_tanggal_surat_diterima` date DEFAULT NULL,
  `jenjang_id` int(11) DEFAULT NULL,
  `mutasi_luar_kota` enum('0','1') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mutasi_kode_scan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mutasi_pejabat_nip` char(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mutasi_pejabat_nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mutasi_pejabat_pangkat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mutasi_pejabat_jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`mutasi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of mutasi
-- ----------------------------

-- ----------------------------
-- Table structure for nomor_surat_mutasi
-- ----------------------------
DROP TABLE IF EXISTS `nomor_surat_mutasi`;
CREATE TABLE `nomor_surat_mutasi` (
  `no_id` int(11) NOT NULL AUTO_INCREMENT,
  `mutasi_id` int(11) DEFAULT NULL,
  `nomor` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `nomor_surat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`no_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of nomor_surat_mutasi
-- ----------------------------
INSERT INTO `nomor_surat_mutasi` VALUES ('3', '10', '2', '2021-03-12', '421.2/2/406.009/2021', null, null);
INSERT INTO `nomor_surat_mutasi` VALUES ('4', '9', '3', '2021-03-12', '421.2/3/406.009/2021', null, null);
INSERT INTO `nomor_surat_mutasi` VALUES ('5', '8', '4', '2021-03-12', '421.2/4/406.009/2021', null, null);
INSERT INTO `nomor_surat_mutasi` VALUES ('6', '2', '5', '2021-03-12', '421.2/5/406.009/2021', null, null);
INSERT INTO `nomor_surat_mutasi` VALUES ('7', '1', '6', '2021-03-12', '421.2/6/406.009/2021', null, null);
INSERT INTO `nomor_surat_mutasi` VALUES ('11', '16', '7', '2021-03-22', '421.2/7/406.009/2021', null, null);
INSERT INTO `nomor_surat_mutasi` VALUES ('12', '17', '8', '2021-03-22', '421.2/8/406.009/2021', null, null);
INSERT INTO `nomor_surat_mutasi` VALUES ('13', '18', '9', '2021-03-22', '421.2/9/406.009/2021', null, null);
INSERT INTO `nomor_surat_mutasi` VALUES ('17', '26', '11', '2021-03-22', '421.2/11/406.009/2021', null, null);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for pejabat
-- ----------------------------
DROP TABLE IF EXISTS `pejabat`;
CREATE TABLE `pejabat` (
  `pejabat_id` int(11) NOT NULL AUTO_INCREMENT,
  `pejabat_nip` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pejabat_nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pejabat_pangkat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pejabat_jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pejabat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of pejabat
-- ----------------------------
INSERT INTO `pejabat` VALUES ('1', '196605041991031008', 'SUNARYA, S.Pd,M.Pd', 'Pembina', 'Kepala Bidang Pembinaan Sekolah Menengah Pertama', null, null);
INSERT INTO `pejabat` VALUES ('4', '196705031994032011', 'Dra. SITI ZAENAB, M.Si', 'Pembina', 'Kepala Bidang Pembinaan Sekolah Dasar', '2021-03-04 14:58:52', '2021-03-04 14:58:52');
INSERT INTO `pejabat` VALUES ('7', '198009092006042029', 'RULIK TRI ANGGRAINI, S.KM., M.Kes', 'Penata Tingkat I', 'Kepala Bidang Pembinaan Pendidikan Anak Usia Dini dan Pendidikan Masyarakat', '2021-03-08 10:25:49', '2021-03-08 10:25:49');

-- ----------------------------
-- Table structure for sekolah
-- ----------------------------
DROP TABLE IF EXISTS `sekolah`;
CREATE TABLE `sekolah` (
  `sekolah_id` int(11) NOT NULL AUTO_INCREMENT,
  `kecamatan_id` int(11) DEFAULT NULL,
  `jenjang_id` int(11) DEFAULT NULL,
  `sekolah_npsn` char(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sekolah_nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sekolah_alamat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sekolah_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1774 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of sekolah
-- ----------------------------
INSERT INTO `sekolah` VALUES ('1', '1', '1', '69744107', 'RA/BA/TA NURUL HIDAYAH SAWAHAN', 'RT 06 RW 03 DESA SAWAHAN  KEC.PANGGUL', null, null);
INSERT INTO `sekolah` VALUES ('2', '1', '1', '69897983', 'Sabilul Huda Barang', 'RT. 18 RW. 06 Dusun Tompe', null, null);
INSERT INTO `sekolah` VALUES ('3', '1', '1', '20574358', 'TK PERTIWI WONOCOYO', 'RT 12 RW 05 Dusun Bioro', null, null);
INSERT INTO `sekolah` VALUES ('4', '1', '1', '69948937', 'KB TUNAS BANGSA', 'RT. 31 RW. 10', null, null);
INSERT INTO `sekolah` VALUES ('5', '1', '1', '69776990', 'KB MUTIARA BUNDA', 'RT.15 RW.06', null, null);
INSERT INTO `sekolah` VALUES ('6', '1', '1', '69878180', 'KB AL-IKHLAS', 'RT.14 RW.02 DUSUN PAGERSARI', null, null);
INSERT INTO `sekolah` VALUES ('7', '1', '1', '20574352', 'TK DHARMA WANITA 1 KARANGTENGAH', 'RT 20 RW 06 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('8', '1', '1', '69905921', 'KB PERMATA BUNDA', 'RT. 06 RW. 02', null, null);
INSERT INTO `sekolah` VALUES ('9', '1', '3', '20542420', 'SMP ISLAM PANGGUL', 'JL. RAYA DESA PANGGUL', null, null);
INSERT INTO `sekolah` VALUES ('10', '1', '1', '69957405', 'TK DHARMA WANITA 3 NGRAMBINGAN', 'RT. 13 RW. 03 Dusun. Krajan', null, null);
INSERT INTO `sekolah` VALUES ('11', '1', '3', '20542450', 'SMP NEGERI 2 PANGGUL', 'Jalan Ki Hajar Dewantoro No. 1', null, null);
INSERT INTO `sekolah` VALUES ('12', '1', '1', '69744106', 'RA/BA/TA FATKHUL HUDA NGRENCAK', 'RT.19 RW.O7 DUSUN KASIHAN', null, null);
INSERT INTO `sekolah` VALUES ('13', '1', '1', '69744103', 'RA/BA/TA ALHIDAYAH PANGGUL', 'RT/RW 17/04 DSN MADATAN DS PANGGUL', null, null);
INSERT INTO `sekolah` VALUES ('14', '1', '1', '20574347', 'TK NEGERI PEMBINA PANGGUL', 'JL. PANGLIMA SUDIRMAN DS. GAYAM KEC. PANGGUL', null, null);
INSERT INTO `sekolah` VALUES ('15', '1', '1', '69776976', 'KB DEWI SARTIKA', 'RT 10 RW 04 DSN. NOREJO', null, null);
INSERT INTO `sekolah` VALUES ('16', '1', '1', '69982382', 'KB AL AMIN', 'RT. 17 RW. 04 ', null, null);
INSERT INTO `sekolah` VALUES ('17', '1', null, 'P2964907', 'PKBM DARUL FALAH', '-', null, null);
INSERT INTO `sekolah` VALUES ('18', '1', '2', '20541972', 'SD NEGERI 1 KARANGTENGAH', 'RT 20 RW O6', null, null);
INSERT INTO `sekolah` VALUES ('19', '1', '1', '69744108', 'RA/BA/TA PERWANIDA NGRENCAK', 'RT.03 RW.01 DSN WONOGONDO DESA NGRENCAK', null, null);
INSERT INTO `sekolah` VALUES ('20', '1', null, '60714425', 'MIS KKKKKKKKKKKK', '-', null, null);
INSERT INTO `sekolah` VALUES ('21', '1', '2', '20542320', 'SD NEGERI 4 NGLEBENG', 'RT 01 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('22', '1', '2', '20541979', 'SD NEGERI 1 KERTOSONO', 'RT 09 RW 04', null, null);
INSERT INTO `sekolah` VALUES ('23', '1', null, '20542511', 'SMKS ISLAM PANGGUL', 'Jl. Raya Panggul - Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('24', '1', '1', '69776988', 'KB AN NUR', 'RT 16 RW 04 DSN. KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('25', '1', '2', '20541931', 'SD NEGERI 1 BANJAR', 'RT. 06 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('26', '1', '1', '20574357', 'TK DHARMA WANITA SAWAHAN', 'RT 05 RW 03 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('27', '1', '1', '20574350', 'TK DHARMA WANITA 1 BODAG', 'RT 04 RW 01 Dusun. Krajan', null, null);
INSERT INTO `sekolah` VALUES ('28', '1', '2', '20542001', 'SD NEGERI 1 NGRAMBINGAN', 'RT. 01 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('29', '1', '1', '69905739', 'KB LESTARI', 'RT. 08 RW. 03', null, null);
INSERT INTO `sekolah` VALUES ('30', '1', '2', '20542261', 'SD NEGERI SATU ATAP 2 PANGGUL', 'Jl. Jogadi', null, null);
INSERT INTO `sekolah` VALUES ('31', '1', '1', '69979354', 'TK DHARMA WANITA 2 SAWAHAN', 'RT. 24 RW. 12', null, null);
INSERT INTO `sekolah` VALUES ('32', '1', '1', '20574360', 'TK DHARMA WANITA 3 WONOCOYO', 'RT 40 RW 11 Dusun Bendogolor', null, null);
INSERT INTO `sekolah` VALUES ('33', '1', null, '20584748', 'MAN 2 TRENGGALEK', 'JL. RAYA PANGGUL TRENGGALEK DESA WONOCOYO KEC. PANGGUL KAB. TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('34', '1', '1', '20574361', 'TK DHARMA WANITA 1 NGLEBENG', 'RT 13 RW 04 Dusun Nglebeng', null, null);
INSERT INTO `sekolah` VALUES ('35', '1', '1', '20574355', 'TK DHARMA WANITA 2 BANJAR', 'RT 19 RW 03 Dusun Nambak', null, null);
INSERT INTO `sekolah` VALUES ('36', '1', '1', '20574362', 'TK DHARMA WANITA 2 NGLEBENG', 'RT 10 RW 03 Dusun Slorok', null, null);
INSERT INTO `sekolah` VALUES ('37', '1', '1', '20574374', 'TK DHARMA WANITA TANGKIL', 'RT 09 RW 03 Dusun Belangan', null, null);
INSERT INTO `sekolah` VALUES ('38', '1', '1', '20574363', 'TK DHARMA WANITA 3 NGLEBENG', 'RT 25 RW 09 Dusun Joketro', null, null);
INSERT INTO `sekolah` VALUES ('39', '1', '2', '60714395', 'MIS DARUL ULUM SAWAHAN', 'RT.06 / RW.03 KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('40', '1', '3', '20542470', 'SMP PGRI 1 PANGGUL', 'Jl. Raya Panggul', null, null);
INSERT INTO `sekolah` VALUES ('41', '1', '2', '20542191', 'SD NEGERI 2 TERBIS', 'RT. 10 RW. 05', null, null);
INSERT INTO `sekolah` VALUES ('42', '1', '2', '20542298', 'SD NEGERI 4 BANJAR', 'RT. 33 RW. 04', null, null);
INSERT INTO `sekolah` VALUES ('43', '1', '1', '69776971', 'KB AL FALAH', 'RT 15 RW 03 DSN. TANGGUNG', null, null);
INSERT INTO `sekolah` VALUES ('44', '1', '2', '20541981', 'SD NEGERI 1 MANGGIS', 'RT 01 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('45', '1', null, '69972067', 'SMK NEGERI 1 PANGGUL', 'Desa Nglebeng', null, null);
INSERT INTO `sekolah` VALUES ('46', '1', '3', '20542471', 'SMP PGRI 2 PANGGUL', 'Dusun Wonocoyo Utara RT 10 RW 4', null, null);
INSERT INTO `sekolah` VALUES ('47', '1', '1', '20574371', 'TK DHARMA WANITA 2 NGRENCAK', 'RT 28 RW 11 Dusun Kasihan', null, null);
INSERT INTO `sekolah` VALUES ('48', '1', '2', '20542068', 'SD NEGERI 2 BANJAR', 'Jalan Lintas Selatan Dsn. Nambak RT. 19  RW. 03', null, null);
INSERT INTO `sekolah` VALUES ('49', '1', '2', '20542356', 'SD NEGERI 5 NGLEBENG', 'RT.24 RW. 08', null, null);
INSERT INTO `sekolah` VALUES ('50', '1', '1', '20574351', 'TK DHARMA WANITA 2 BODAG', 'RT 11 RW 03 Dusun Pasur', null, null);
INSERT INTO `sekolah` VALUES ('51', '1', '1', '69776730', 'SPS DARUL FALAH', 'RT 30 RW 14', null, null);
INSERT INTO `sekolah` VALUES ('52', '1', '1', '20574650', 'TK DHARMA WANITA 2 NGRAMBINGAN', 'RT 29 RW 06 Dusun Ngajaran', null, null);
INSERT INTO `sekolah` VALUES ('53', '1', '1', '20574364', 'TK PERTIWI KERTOSONO', 'RT 09 RW 04 Dusun Norejo', null, null);
INSERT INTO `sekolah` VALUES ('54', '1', '1', '20574348', 'TK PERTIWI 1 PANGGUL', 'RT 01 RW 01 Dusun Bakalan', null, null);
INSERT INTO `sekolah` VALUES ('55', '1', '2', '60729155', 'MIS PLUS SUNAN KALIJAGA', 'RT. 07 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('56', '1', '2', '20541996', 'SD NEGERI 1 NGLEBENG', 'RT13 RW 04', null, null);
INSERT INTO `sekolah` VALUES ('57', '1', '1', '20574651', 'TK DHARMA WANITA 4 NGLEBENG', 'RT 01 RW 01 Dusun slorok', null, null);
INSERT INTO `sekolah` VALUES ('58', '1', '2', '20542187', 'SD NEGERI 2 TANGKIL', 'RT 20 RW. 07', null, null);
INSERT INTO `sekolah` VALUES ('59', '1', '1', '20574375', 'TK DHARMA WANITA TERBIS', 'RT 19 RW 09 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('60', '1', null, '20542507', 'SMAN 1 PANGGUL', 'JL. P.SUDIRMAN 87 PANGGUL', null, null);
INSERT INTO `sekolah` VALUES ('61', '1', '2', '20542052', 'SD NEGERI 1 TANGKIL', 'RT 01 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('62', '1', '2', '20554645', 'SD NEGERI 1 WONOCOYO', 'RT. 12 RW. 05 Desa Wonocoyo', null, null);
INSERT INTO `sekolah` VALUES ('63', '1', '2', '20542011', 'SD NEGERI 1 PANGGUL', 'RT 01 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('64', '1', '3', '20542482', 'SMP NEGERI SATU ATAP 1 PANGGUL', 'Rt.29 / Rw.06', null, null);
INSERT INTO `sekolah` VALUES ('65', '1', '2', '20542202', 'SD NEGERI 3 BANJAR', 'RT. 26 RW. 04', null, null);
INSERT INTO `sekolah` VALUES ('66', '1', '1', '20574366', 'TK DHARMA WANITA 1 DEPOK', 'RT 01 RW 01 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('67', '1', '1', '69982436', 'KB AL-HIDAYAH', 'RT. 20 RW. 07', null, null);
INSERT INTO `sekolah` VALUES ('68', '1', '1', '69744105', 'RA/BA/TA EKA SARI BANJAR', 'RT/RW 12/02 DSN PAGER SARI DS BANJAR', null, null);
INSERT INTO `sekolah` VALUES ('69', '1', '2', '20542304', 'SD NEGERI 4 DEPOK', 'RT.14 RW.07 DS.Depok Kec.Panggul Kab.Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('70', '1', '2', '20542297', 'SD NEGERI 3 WONOCOYO', 'RT 40 RW 11', null, null);
INSERT INTO `sekolah` VALUES ('71', '1', '1', '20574365', 'TK DHARMA WANITA KERTOSONO', 'RT 24 RW 08 Dusun Gebang', null, null);
INSERT INTO `sekolah` VALUES ('72', '1', '1', '69781216', 'TK NEGERI PEMBINA', 'JL. PANGLIMA SUDIRMAN NO. 87', null, null);
INSERT INTO `sekolah` VALUES ('73', '1', '2', '60714397', 'MIS MIFTAHUL ULUM PANGGUL', 'RT 16 / RW 04 DSN MADATAN DS PANGGUL KEC PANGGUL', null, null);
INSERT INTO `sekolah` VALUES ('74', '1', '1', '20542076', 'SD NEGERI 2 BODAG', 'RT 10 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('75', '1', '2', '20542213', 'SD NEGERI 3 DEPOK', 'RT. 20 RW. 09 Dusun Warakan', null, null);
INSERT INTO `sekolah` VALUES ('76', '1', '2', '20542149', 'SD NEGERI 2 PANGGUL', 'Dusun Panggul, RT 14 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('77', '1', '1', '20574370', 'TK DHARMA WANITA 1 NGRENCAK', 'RT 09 RW 04 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('78', '1', '2', '20542084', 'SD NEGERI 2 DEPOK', 'RT 033 RW 015', null, null);
INSERT INTO `sekolah` VALUES ('79', '1', '1', '20574349', 'TK PERTIWI 2 PANGGUL', 'RT 14 RW 03  Dusun Panggul', null, null);
INSERT INTO `sekolah` VALUES ('80', '1', '1', '69744102', 'RA/BA/TA BA AISYIYAH PANGGUL', 'RT.07 RW.02 DUSUN KEBONAGUNG', null, null);
INSERT INTO `sekolah` VALUES ('81', '1', '2', '20542258', 'SD NEGERI 3 NGLEBENG', 'RT. 25 RW. 09 Dusun Joketro', null, null);
INSERT INTO `sekolah` VALUES ('82', '1', null, 'T2969195', 'TBM CAHAYA ILMU', '-', null, null);
INSERT INTO `sekolah` VALUES ('83', '1', '2', '60714396', 'MIS DARUSSALAM BARANG', 'RT/RW. 18/06 DUSUN TOMPE', null, null);
INSERT INTO `sekolah` VALUES ('84', '1', '2', '20542163', 'SD NEGERI 2 SAWAHAN', 'RT. 24 RW. 12 Dusun Jati', null, null);
INSERT INTO `sekolah` VALUES ('85', '1', '2', '20542137', 'SD NEGERI 2 NGLEBENG', 'RT 10 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('86', '1', '1', '69905553', 'KB PERMATA HATI', 'RT. 09 RW. 03', null, null);
INSERT INTO `sekolah` VALUES ('87', '1', null, '20542520', 'SMKS PGRI IR SUTAMI PANGGUL', 'JL. RAYA PANGGUL NO. 98', null, null);
INSERT INTO `sekolah` VALUES ('88', '1', '2', '20541936', 'SD NEGERI 1 BESUKI', 'RT. 27 RW. 04', null, null);
INSERT INTO `sekolah` VALUES ('89', '1', null, 'T2969194', 'TBM DARUL FALAH', '-', null, null);
INSERT INTO `sekolah` VALUES ('90', '1', '1', '69776979', 'KB PELANGI', 'RT 41 RW 11 DESA. WONOCOYO', null, null);
INSERT INTO `sekolah` VALUES ('91', '1', '1', '20574373', 'TK DHARMA WANITA 2 BARANG', 'RT 08 RW 03 Dusun Sembon', null, null);
INSERT INTO `sekolah` VALUES ('92', '1', '1', '69905924', 'KB HARAPAN BUNDA', 'RT. 23 RW. 11', null, null);
INSERT INTO `sekolah` VALUES ('93', '1', '2', '20542004', 'SD NEGERI 1 NGRENCAK', 'RT.09 RW.04 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('94', '1', '2', '60714398', 'MIS MUHAMMADIYAH PANGGUL', 'RT.07 RW.02 ', null, null);
INSERT INTO `sekolah` VALUES ('95', '1', '1', '20574353', 'TK DHARMA WANITA 2 KARANGTENGAH', 'RT 21 RW 06 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('96', '1', '1', '69982387', 'KB MENTARI', 'RT. 08 RW. 03', null, null);
INSERT INTO `sekolah` VALUES ('97', '1', '1', '69982435', 'KB FAJAR', 'RT. 11 RW. 03', null, null);
INSERT INTO `sekolah` VALUES ('98', '1', '1', '20574369', 'TK DHARMA WANITA 1 NGRAMBINGAN', 'RT 07 RW 02 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('99', '1', '1', '69958268', 'TK DHARMA WANITA 3 KARANGTENGAH', 'RT. 37 RW. 11 Dusun Nginjen', null, null);
INSERT INTO `sekolah` VALUES ('100', '1', null, 'P2969194', 'PKBM BINA KARYA', '-', null, null);
INSERT INTO `sekolah` VALUES ('101', '1', '1', '69982225', 'KB ANUGERAH BUNDA', 'RT. 23 RW. 07', null, null);
INSERT INTO `sekolah` VALUES ('102', '1', '2', '60714399', 'MIS NURUL HUDA NGRENCAK I', 'RT.03 / RW.01 DSN. WONOGONDO  DESA NGRENCAK KEC. PANGGUL  KAB. TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('103', '1', '2', '20542291', 'SD NEGERI 3 TERBIS', 'RT 23 RW 11', null, null);
INSERT INTO `sekolah` VALUES ('104', '1', '3', '20542464', 'SMP NEGERI 4 PANGGUL', 'Jalan  Depok Tangkil No. 04', null, null);
INSERT INTO `sekolah` VALUES ('105', '1', '2', '20541932', 'SD NEGERI 1 BARANG', 'RT 01 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('106', '1', '3', '20542461', 'SMP NEGERI 3 PANGGUL', 'Jl.Raya Sawahan - Panggul', null, null);
INSERT INTO `sekolah` VALUES ('107', '1', '2', '20542140', 'SD NEGERI SATU ATAP 1 PANGGUL', 'RT. 29 RW. 06 Dusun Ngajaran', null, null);
INSERT INTO `sekolah` VALUES ('108', '1', '2', '20542259', 'SD NEGERI 3 NGRAMBINGAN', 'RT. 13 RW. 03', null, null);
INSERT INTO `sekolah` VALUES ('109', '1', '2', '20542075', 'SD NEGERI 2 BESUKI', 'RT. 16 RW. 06', null, null);
INSERT INTO `sekolah` VALUES ('110', '1', '2', '20542376', 'SD NEGERI GAYAM', 'RT 12 RW 04', null, null);
INSERT INTO `sekolah` VALUES ('111', '1', '2', '20541938', 'SD NEGERI 1 BODAG', 'RT04 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('112', '1', '1', '20574359', 'TK DHARMA WANITA 1 WONOCOYO', 'RT 27 RW 08 Dusun Karang', null, null);
INSERT INTO `sekolah` VALUES ('113', '1', '2', '20542199', 'SD NEGERI 2 WONOCOYO', 'RT. 27 RW.08 Desa Wonocoyo', null, null);
INSERT INTO `sekolah` VALUES ('114', '1', '2', '20542056', 'SD NEGERI 1 TERBIS', 'RT19 RW 09', null, null);
INSERT INTO `sekolah` VALUES ('115', '1', '2', '20554624', 'SD NEGERI 3 BESUKI', 'RT. 05 RW. 02 Desa Besuki', null, null);
INSERT INTO `sekolah` VALUES ('116', '1', '2', '60714400', 'MIS AL HIDAYAH NGRENCAK 2', 'RT.19 RW.07 DUSUN.KASIHAN DESA NGRENCAK', null, null);
INSERT INTO `sekolah` VALUES ('117', '1', '2', '60714394', 'MIS MIFTAHUL HUDA KERTOSONO', 'RT 19/ RW 06 DUSUN NANGGUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('118', '1', '2', '20542110', 'SD NEGERI 2 KARANGTENGAH', 'RT 28 RW 08', null, null);
INSERT INTO `sekolah` VALUES ('119', '1', '1', '69982441', 'KB ARUM DALU', 'RT. 16 RW. 05', null, null);
INSERT INTO `sekolah` VALUES ('120', '1', '1', '20574367', 'TK DHARMA WANITA 2 DEPOK', 'RT 20 RW 08 Dusun Warakan', null, null);
INSERT INTO `sekolah` VALUES ('121', '1', '1', '69781225', 'KB BINA BALITA', 'DESA TANGKIL', null, null);
INSERT INTO `sekolah` VALUES ('122', '1', null, 'P2969195', 'PKBM MARSUDI UTOMO', '-', null, null);
INSERT INTO `sekolah` VALUES ('123', '1', '2', '20542120', 'SD NEGERI 2 MANGGIS', 'RT. 23 RW. 06', null, null);
INSERT INTO `sekolah` VALUES ('124', '1', '1', '69982432', 'KB NUSA INDAH', 'RT. 30 RW. 08', null, null);
INSERT INTO `sekolah` VALUES ('125', '1', '1', '20574376', 'TK DHARMA WANITA 1 BESUKI', 'RT 27 RW 04 Dusun Sanggar', null, null);
INSERT INTO `sekolah` VALUES ('126', '1', '2', '20542288', 'SD NEGERI 3 TANGKIL', 'RT 09 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('127', '1', '1', '69906358', 'KB ABUNAYYA', 'RT. 01 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('128', '1', '2', '20542245', 'SD NEGERI 3 MANGGIS', 'RT 13 RW 04', null, null);
INSERT INTO `sekolah` VALUES ('129', '1', '2', '20542026', 'SD NEGERI 1 SAWAHAN', 'Dusun Krajan RT. 05, RW. 03', null, null);
INSERT INTO `sekolah` VALUES ('130', '1', '2', '20542312', 'SD NEGERI 4 KARANGTENGAH', 'Dsn. Nginjen RT. 37 RW. 11', null, null);
INSERT INTO `sekolah` VALUES ('131', '1', '2', '20542069', 'SD NEGERI 2 BARANG', 'RT 08 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('132', '1', '1', '69776984', 'KB AL-HIKMAH', 'RT. 14 RW. 07 Ds. Depok Kec. Panggul', null, null);
INSERT INTO `sekolah` VALUES ('133', '1', '2', '20542142', 'SD NEGERI 2 NGRENCAK', 'RT 28 RW 11', null, null);
INSERT INTO `sekolah` VALUES ('134', '1', '2', '20542240', 'SD NEGERI 3 KARANGTENGAH', 'RT 21 RW 06', null, null);
INSERT INTO `sekolah` VALUES ('135', '1', '3', '20584934', 'MTSN 5 TRENGGALEK', 'JL. RAYA PANGGUL TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('136', '1', '1', '69781226', 'KB AR RAHMAD', 'RT 09 RW 02 DSN. KEBONAGUNG', null, null);
INSERT INTO `sekolah` VALUES ('137', '1', '2', '20542118', 'SD NEGERI 2 KERTOSONO', 'RT 24 RW 08', null, null);
INSERT INTO `sekolah` VALUES ('138', '1', '3', '20566346', 'SMP NEGERI SATU ATAP 2 PANGGUL', 'RT 33 RW 13 Dusun Pucung', null, null);
INSERT INTO `sekolah` VALUES ('139', '1', '1', '69776974', 'KB HARAPAN UMAT', 'JL. RAYA WONOCOYO', null, null);
INSERT INTO `sekolah` VALUES ('140', '1', null, '69776724', 'SPS MELATI', 'RT 07 RW 04 DSN. KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('141', '1', '3', '20542435', 'SMP NEGERI 1 PANGGUL', 'Jl. MT. Haryana No. 02 Panggul', null, null);
INSERT INTO `sekolah` VALUES ('142', '1', '2', '20541946', 'SD NEGERI 1 DEPOK', 'RT. 02 RW. 01 Dusun Krajan Desa Depok', null, null);
INSERT INTO `sekolah` VALUES ('143', '1', '1', '20574356', 'TK DHARMA WANITA 3 BANJAR', 'RT 26 RW 04 Dusun Sambeng', null, null);
INSERT INTO `sekolah` VALUES ('144', '1', '2', '60714401', 'MIS MAMBAUL ULUM', 'DSN.PAGERSARI RT 12/02 DS.BANJAR KEC.PANGGUL KAB.TRENGGALEK PROP. JAWA TIMUR', null, null);
INSERT INTO `sekolah` VALUES ('145', '1', '1', '69744104', 'RA/BA/TA DARUSSALAM KERTOSONO', 'RT 19/RW 06 DUSUN NANGGUNGAN DESA KERTOSONO', null, null);
INSERT INTO `sekolah` VALUES ('146', '1', '1', '20574372', 'TK DHARMA WANITA 1 BARANG', 'RT 01 RW 01 Dusun Barang', null, null);
INSERT INTO `sekolah` VALUES ('147', '1', '1', '20574368', 'TK DHARMA WANITA MANGGIS', 'RT 01 RW 01 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('148', '1', '1', '20574354', 'TK DHARMA WANITA 1 BANJAR', 'RT 06 RW 01 Dusun Pagerwatu', null, null);
INSERT INTO `sekolah` VALUES ('149', '1', '2', '20542304', 'SD NEGERI 4 DEPOK', 'RT. 14 RW. 07 Dusun Pegat', null, null);
INSERT INTO `sekolah` VALUES ('150', '1', null, '69995600', 'Nurul Hidayah', 'Dusun Weru  RT  05  RW  01', null, null);
INSERT INTO `sekolah` VALUES ('151', '1', '1', '69993350', 'RA MUSLIMAT NU BANGUN', 'DSN. NGRAMPAL', null, null);
INSERT INTO `sekolah` VALUES ('152', '1', '1', '69990360', 'KB TUNAS MULIA', 'RT. 09 RW. 04 DESA. NGRENCAK', null, null);
INSERT INTO `sekolah` VALUES ('153', '1', '1', '69989662', 'KB KASIH BUNDA', 'RT. 03 RW. 01 DESA. MANGGIS', null, null);
INSERT INTO `sekolah` VALUES ('154', '1', '3', '69993640', 'MTs SATU ATAP DARUNNAJAH', 'JL. SOEKARNO HATTA GG.DURIAN', null, null);
INSERT INTO `sekolah` VALUES ('155', '1', null, '69993765', 'MA UMMUL QURO', 'JALAN SUKORAME GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('156', '1', '1', '69993523', 'RA NURUL FATTAH', 'RT : 12 RW : 04 DUSUN KAYUJARAN, DESA GEMBLEB, KEC. POGALAN, KAB. TRENGGAL', null, null);
INSERT INTO `sekolah` VALUES ('157', '2', '1', '20574404', 'TK DHARMA WANITA 2 BESUKI', 'RT 16 RW 03 DS. BESUKI KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('158', '2', '2', '20542073', 'SD NEGERI 2 BENDOROTO', 'RT. 02 RW. 01 Desa Bendoroto', null, null);
INSERT INTO `sekolah` VALUES ('159', '2', '2', '20542168', 'SD NEGERI 2 SOBO', 'RT. 03 RW. 01 Desa Sobo', null, null);
INSERT INTO `sekolah` VALUES ('160', '2', '1', '20574408', 'TK DHARMA WANITA 2 SOBO', 'RT 08 RW 02 DS. SOBO KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('161', '2', '1', '20574412', 'TK DHARMA WANITA 2 NGULUNGWETAN', 'RT 01 RW 01 DS. NGULUNGWETAN KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('162', '2', '1', '20574397', 'TK DHARMA WANITA 3 TAWING', 'RT 42 RW 09 DS. TAWING KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('163', '2', null, '20542504', 'SMAS PGRI MUNJUNGAN', 'JL. MUNJUNGAN WATULIMO', null, null);
INSERT INTO `sekolah` VALUES ('164', '2', '2', '20542126', 'SD NEGERI 2 MUNJUNGAN', 'RT 26 RW 07 Desa Munjungan', null, null);
INSERT INTO `sekolah` VALUES ('165', '2', '1', '69777008', 'KB HANDAYANI', 'RT.19 RW.04 DUSUN KEBON', null, null);
INSERT INTO `sekolah` VALUES ('166', '2', '2', '20542007', 'SD NEGERI 1 NGULUNGWETAN', 'RT 10 RW 02 Desa Ngulungwetan', null, null);
INSERT INTO `sekolah` VALUES ('167', '2', '1', '69744101', 'RA/BA/TA TA AL HIDAYAH TAWING III', 'DSN. GUNUNG KEMBAR RT. 39 RW. 09', null, null);
INSERT INTO `sekolah` VALUES ('168', '2', '1', '69744099', 'RA/BA/TA NURUL JADID BESUKI', 'DSN. KAYUPUTIH RT. 27 RW. 05', null, null);
INSERT INTO `sekolah` VALUES ('169', '2', '1', '69777000', 'KB MARDI TRESNO', 'RT.09 RW.03', null, null);
INSERT INTO `sekolah` VALUES ('170', '2', '1', '20574386', 'TK DHARMA WANITA 4 MUNJUNGAN', 'RT 08 RW 02 Dsn. Krajan', null, null);
INSERT INTO `sekolah` VALUES ('171', '2', '1', '69777010', 'KB SUMMI', 'KARANGTURI', null, null);
INSERT INTO `sekolah` VALUES ('172', '2', null, '20542498', 'SMAN 1 MUNJUNGAN', 'JL. TERUSAN SOLODIPO', null, null);
INSERT INTO `sekolah` VALUES ('173', '2', '1', '69777028', 'KB TUNAS BANGSA', 'RT.41 RW.10', null, null);
INSERT INTO `sekolah` VALUES ('174', '2', '2', '20542124', 'SDN 2 MASARAN', 'RT 22 RW 06 DSN SINGGIHAN DS MASARAN', null, null);
INSERT INTO `sekolah` VALUES ('175', '2', '2', '20542290', 'SD NEGERI 2 TAWING', 'RT. 02 RW. 01 Dusun Tawing Krajan', null, null);
INSERT INTO `sekolah` VALUES ('176', '2', '2', '20541984', 'SD NEGERI 1 MASARAN', 'RT. 35 RW. 08 Desa Masaran', null, null);
INSERT INTO `sekolah` VALUES ('177', '2', '2', '20542006', 'SD NEGERI 1 NGULUNGKULON', 'RT. 18 RW. 01 Desa Ngulungkulon', null, null);
INSERT INTO `sekolah` VALUES ('178', '2', '2', '60714382', 'MIS MUNJUNGAN II', 'DSN. BUNGUR RT.30  RW.08', null, null);
INSERT INTO `sekolah` VALUES ('179', '2', '3', '20572004', 'SMP ISLAM MUNJUNGAN', 'jl. Raya Munjungan-Dongko Km2 RT. 46 RW. 11 Dsn. Gembes', null, null);
INSERT INTO `sekolah` VALUES ('180', '2', '2', '20542032', 'SD NEGERI 1 SOBO', 'RT. 08 RW. 02 Desa Sobo', null, null);
INSERT INTO `sekolah` VALUES ('181', '2', '3', '20542449', 'SMP NEGERI 2 MUNJUNGAN', 'RT 18 RW 01 Dusun Weru', null, null);
INSERT INTO `sekolah` VALUES ('182', '2', '2', '20584933', 'MTsN 3 TRENGGALEK', 'RT.05 RW.01 DUSUN KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('183', '2', null, 'P2964904', 'PKBM AL HUDA GALIH', '-', null, null);
INSERT INTO `sekolah` VALUES ('184', '2', '1', '69777014', 'KB AL HUDA', 'RT.27 RW.06', null, null);
INSERT INTO `sekolah` VALUES ('185', '2', null, '69776743', 'SPS SUMBER ILMU', 'RT.32 RW.07 DUSUN DOMERTO', null, null);
INSERT INTO `sekolah` VALUES ('186', '2', '1', '20574423', 'TK AL HIDAYAH 3 TAWING', 'RT 39 RW 09 DS. TAWING KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('187', '2', '1', '20574406', 'TK DHARMA WANITA 2 CRAKEN', 'RT 12 RW 04 DS. CRAKEN KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('188', '2', '2', '60714389', 'MIS MASARAN I', 'DSN. GALIH RT.22 RW.06', null, null);
INSERT INTO `sekolah` VALUES ('189', '2', '1', '69744093', 'RA/BA/TA MASARAN II', 'RT.46 RW.11 DSN.GEMBES DS.MASARAN', null, null);
INSERT INTO `sekolah` VALUES ('190', '2', '2', '20542249', 'SD NEGERI 3 MUNJUNGAN', 'RT 22 RW 05 Desa Munjungan', null, null);
INSERT INTO `sekolah` VALUES ('191', '2', '1', '69744091', 'RA/BA/TA AL HUDA MASARAN I', 'DSN. GALIH RT. 22 RW. 06', null, null);
INSERT INTO `sekolah` VALUES ('192', '2', '1', '20574390', 'TK DHARMA WANITA 3 KARANGTURI', 'RT 17 RW 04 DS. KARANGTURI KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('193', '2', null, 'P2969006', 'PKBM Nur Hidayah', 'Jln. Lumba-Lumba No. 06', null, null);
INSERT INTO `sekolah` VALUES ('194', '2', null, '20584747', 'MAS NURUL ULUM', 'DS. / KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('195', '2', '2', '60714392', 'MIS GUPPI KALIBENING', 'DSN KALIBENING RT.27 RW.05', null, null);
INSERT INTO `sekolah` VALUES ('196', '2', '2', '60714393', 'MIS MIFTAHUL HUDA', 'KEBONSARI RT. 17 RW. 04  KARANGTURI', null, null);
INSERT INTO `sekolah` VALUES ('197', '2', '2', '20542145', 'SD NEGERI 2 NGULUNGWETAN', 'RT 01 RW Desa Ngulanwetan', null, null);
INSERT INTO `sekolah` VALUES ('198', '2', '1', '69744094', 'RA/BA/TA MIFTAHUL HUDA', 'RT. 17 RW. 04', null, null);
INSERT INTO `sekolah` VALUES ('199', '2', '2', '60714385', 'MIS TAWING III GUPPI', 'DSN. GUNUNG KEMBAR RT.39 RW.09', null, null);
INSERT INTO `sekolah` VALUES ('200', '2', '2', '60714390', 'MIS MASARAN II', 'DSN. GEMBES RT.46 RW.11', null, null);
INSERT INTO `sekolah` VALUES ('201', '2', '2', '69947312', 'SD NEGERI 5 BESUKI', 'Desa Besuki', null, null);
INSERT INTO `sekolah` VALUES ('202', '2', '2', '20541937', 'SD NEGERI 1 BESUKI', 'RT. 07 RW. 02 Desa Besuki', null, null);
INSERT INTO `sekolah` VALUES ('203', '2', null, '69776750', 'SPS FAJAR INSANI', 'RT.10 RW.02', null, null);
INSERT INTO `sekolah` VALUES ('204', '2', '2', '60714388', 'MIS KARANGTURI', 'DSN. KRAJAN RT.03 RW.01', null, null);
INSERT INTO `sekolah` VALUES ('205', '2', null, '69776746', 'SPS JABAL NOOR', 'RT.01 RW.01', null, null);
INSERT INTO `sekolah` VALUES ('206', '2', null, 'T2969008', 'TBM PEMBINA ILMU', '-', null, null);
INSERT INTO `sekolah` VALUES ('207', '2', '2', '60714387', 'MIS BESUKI', 'DSN. KAYUPUTIH RT.27 RW.05', null, null);
INSERT INTO `sekolah` VALUES ('208', '2', null, '69896652', 'SMK PGRI KI HADJAR DEWANTARA', 'Jl. Raya Munjungan-Watulimo Km. 1', null, null);
INSERT INTO `sekolah` VALUES ('209', '2', '1', '69744097', 'RA/BA/TA MUNJUNGAN II', 'DUSUN BUNGUR RT. 30 RW. 08', null, null);
INSERT INTO `sekolah` VALUES ('210', '2', '1', '20574383', 'TK DHARMA WANITA 1 MUNJUNGAN', 'RT 08 RW 02 DS. MUNJUNGAN KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('211', '2', '2', '60714383', 'MIS TAWING I', 'DSN. GUNUNG KEMBAR RT.48 RW.10', null, null);
INSERT INTO `sekolah` VALUES ('212', '2', '1', '20574384', 'TK DHARMA WANITA 2 MUNJUGAN', 'RT 26 RW 07 DS. MUNJUNGAN KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('213', '2', '1', '69777027', 'KB ARGO WENING', 'RT.25 RW.05', null, null);
INSERT INTO `sekolah` VALUES ('214', '2', '1', '69744092', 'RA/BA/TA GUNUNG KEMBAR TAWING I', 'DSN. GUNUNG KEMBAR RT. 48 RW. 10', null, null);
INSERT INTO `sekolah` VALUES ('215', '2', '1', '69744098', 'RA/BA/TA NURUL HIDAYAH NGULUNGKULON', 'Dususn Weru RT. 05 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('216', '2', '2', '20541930', 'SD NEGERI 1 BANGUN', 'RT. 25 RW. 02 Desa Bangun', null, null);
INSERT INTO `sekolah` VALUES ('217', '2', '1', '20574411', 'TK DHARMA WANITA 2 NGULUNGKULON', 'RT. 10 RW. 03', null, null);
INSERT INTO `sekolah` VALUES ('218', '2', null, 'T2969007', 'TBM AL HUDA GALIH', '-', null, null);
INSERT INTO `sekolah` VALUES ('219', '2', '1', '20574385', 'TK DHARMA WANITA 3 MUNJUNGAN', 'RT. 22 RW. 05 ', null, null);
INSERT INTO `sekolah` VALUES ('220', '2', '1', '20574407', 'TK DHARMA WANITA 1 SOBO', 'RT 03 RW 01 DS. SOBO KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('221', '2', '1', '69777030', 'KB AL MUJAHIDIN', 'RT. 04 RW. 02', null, null);
INSERT INTO `sekolah` VALUES ('222', '2', '1', '69744089', 'RA/BA/TA BA AISYIYAH BANGUN', 'RT.31 RW.03 DSN. JAJAR', null, null);
INSERT INTO `sekolah` VALUES ('223', '2', null, '69776751', 'SPS TAMAN SISWA', 'RT.02 RW.01 DUSUN KATIATAL', null, null);
INSERT INTO `sekolah` VALUES ('224', '2', '2', '20542241', 'SD NEGERI 2 KARANGTURI', 'RT 17 RW 04 Dusun Kebonsari', null, null);
INSERT INTO `sekolah` VALUES ('225', '2', '1', '20574403', 'TK DHARMA WANITA 1 BESUKI', 'RT. 07 RW. 02', null, null);
INSERT INTO `sekolah` VALUES ('226', '2', '1', '69777034', 'KB SEKAR ARUM', 'RT.22 RW.06', null, null);
INSERT INTO `sekolah` VALUES ('227', '2', null, 'P2969007', 'PKBM DAMARJATI ', 'Gabus - Tlogoayu KM. 1', null, null);
INSERT INTO `sekolah` VALUES ('228', '2', '1', '69777025', 'KB OSAKA', 'RT.52 RW.12', null, null);
INSERT INTO `sekolah` VALUES ('229', '2', '1', '20574402', 'TK DHARMA WANITA 2 BANGUN', 'RT 06 RW 03 DS. BANGUN KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('230', '2', '1', '20574410', 'TK DHARMA WANITA 1 NGULUNGWETAN', 'RT 05 RW 02 DS. NGULUNGWETAN KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('231', '2', '1', '20574392', 'TK DHARMA WANITA 2 MASARAN', 'RT 22 RW 06 DS. MASARAN KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('232', '2', null, 'P2969008', 'PKBM Mina Nurul Jannah', 'Jln. Kembung', null, null);
INSERT INTO `sekolah` VALUES ('233', '2', '1', '20574398', 'TK DHARMA WANITA 1 BENDOROTO', 'RT 02 RW 01 DS. BENDOROTO KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('234', '2', '1', '20574387', 'TK DHARMA WANITA 5 MUNJUNGAN', 'RT. 41 RW. 09 ', null, null);
INSERT INTO `sekolah` VALUES ('235', '2', '2', '60714381', 'MIS MUNJUNGAN I', 'DSN. KRAJAN RT.07 RW.02', null, null);
INSERT INTO `sekolah` VALUES ('236', '2', '2', '20542313', 'SD NEGERI 3 KARANGTURI', 'RT 25 RW 05 Desa Karangturi', null, null);
INSERT INTO `sekolah` VALUES ('237', '2', '1', '20574399', 'TK DHARMA WANITA 2 BENDOROTO', 'RT 14 RW 03 DS. BENDOROTO KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('238', '2', '1', '69777022', 'KB PUTRA HARAPAN', 'RT.08 RW.03', null, null);
INSERT INTO `sekolah` VALUES ('239', '2', '2', '20542300', 'SD NEGERI 4 BESUKI', 'RT 02 RW 01 Desa Besuki', null, null);
INSERT INTO `sekolah` VALUES ('240', '2', '2', '20542205', 'SD NEGERI 3 BESUKI', ' RT. 16 RW. 03 Dusun Ponggok Desa Besuki Kecamatan Munjungan', null, null);
INSERT INTO `sekolah` VALUES ('241', '2', '1', '69744090', 'RA/BA/TA AL HIDAYAH KALIBENING', 'DUSUN KALIBENING RT. 27 RW. 05', null, null);
INSERT INTO `sekolah` VALUES ('242', '2', null, 'P2964903', 'PKBM OSAKA', '-', null, null);
INSERT INTO `sekolah` VALUES ('243', '2', '1', '20574413', 'TK KUSUMA BANGSA MUNJUNGAN', 'RT. 11 RW. 03 ', null, null);
INSERT INTO `sekolah` VALUES ('244', '2', null, 'T2969006', 'TBM OSAKA', '-', null, null);
INSERT INTO `sekolah` VALUES ('245', '2', '1', '20574391', 'TK DHARMA WANITA 1 MASARAN', 'RT 35 RW 08 DS. MASARAN KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('246', '2', '1', '69878181', 'KB  PERMATA BUNDA', 'BESUKI RT 13 RW O3', null, null);
INSERT INTO `sekolah` VALUES ('247', '2', '2', '20542334', 'SD NEGERI 3 TAWING', 'RT. 42 RW. 09 Desa Tawing', null, null);
INSERT INTO `sekolah` VALUES ('248', '2', '1', '69744096', 'RA/BA/TA MUNJUNGAN I', 'RT. 07 RW. 02 DUSUN KRAJAN DESA MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('249', '2', '2', '20541917', 'SD ISLAM KUSUMA BANGSA', 'Rt. 11 Rw. 03', null, null);
INSERT INTO `sekolah` VALUES ('250', '2', null, '69777003', 'MELATI', 'RT.48 RW.11 DUSUN GEMBES', null, null);
INSERT INTO `sekolah` VALUES ('251', '2', '2', '20542054', 'SD NEGERI 1 TAWING', 'RT. 04 RW. 01 Desa Tawing', null, null);
INSERT INTO `sekolah` VALUES ('252', '2', '1', '20574405', 'TK DHARMA WANITA 1 CRAKEN', 'RT 02 RW 01 DS. CRAKEN KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('253', '2', '2', '20542124', 'SD NEGERI 2 MASARAN', 'RT 22 RW 06 Desa Masaran', null, null);
INSERT INTO `sekolah` VALUES ('254', '2', '2', '20542067', 'SD NEGERI 2 BANGUN', 'RT. 06 RW. 03 Desa Bangun', null, null);
INSERT INTO `sekolah` VALUES ('255', '2', '1', '20574409', 'TK DHARMA WANITA 1 NGULUNGKULON', 'RT 18 RW 01 DS. NGULUNGKULON KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('256', '2', '1', '20574394', 'TK DHARMA WANITA 4 MASARAN', 'RT 06 RW 02 DS. MASARAN KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('257', '2', '2', '20542081', 'SD NEGERI 2 CRAKEN', 'RT. 12 RW. 04 Desa Craken', null, null);
INSERT INTO `sekolah` VALUES ('258', '2', '2', '20541935', 'SD NEGERI 1 BENDOROTO', 'RT. 14 RW. 03 Desa Bendoroto', null, null);
INSERT INTO `sekolah` VALUES ('259', '2', '1', '69777047', 'KB MUTIARA INSANI', 'RT.12 RW.03', null, null);
INSERT INTO `sekolah` VALUES ('260', '2', '1', '20574396', 'TK DHARMA WANITA 2 TAWING', 'RT. 02 RW. 01 Dsn. Tawing Krajan Ds. Tawing', null, null);
INSERT INTO `sekolah` VALUES ('261', '2', '2', '20542315', 'SD NEGERI 4 MASARAN', 'RT. 06 RW. 02 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('262', '2', '1', '69744100', 'RA/BA/TA TAWING II', 'DSN. GABAHAN RT. 19 RW. 05', null, null);
INSERT INTO `sekolah` VALUES ('263', '2', '2', '69977690', 'MI NAHDLATUL ULAMA BANGUN', 'DSN. NGRAMPAL', null, null);
INSERT INTO `sekolah` VALUES ('264', '2', '2', '60714386', 'MIS MUHAMMADIYAH BANGUN', 'DSN. JAJAR RT.31 RW.03', null, null);
INSERT INTO `sekolah` VALUES ('265', '2', '3', '20542529', 'SMPN TERBUKA MUNJUNGAN', 'JL. RA. KARATINI DS. MASARAN', null, null);
INSERT INTO `sekolah` VALUES ('266', '2', '1', '69776996', 'KB MARGO RUKUN', 'RT.03 RW.01 KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('267', '2', '3', '20542460', 'SMP NEGERI 3 MUNJUNGAN', 'Jl. Raya Munjungan Watulimo', null, null);
INSERT INTO `sekolah` VALUES ('268', '2', '2', '20541943', 'SD NEGERI 1 CRAKEN', ' RT. 02 RW. 01 Desa Craken', null, null);
INSERT INTO `sekolah` VALUES ('269', '2', '2', '20574401', 'TK DHARMA WANITA 1 BANGUN', 'RT 25 RW 02 DS. BANGUN KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('270', '2', '2', '20542074', 'SD NEGERI 2 BESUKI', 'RT. 19 RW. 04 Desa Besuki', null, null);
INSERT INTO `sekolah` VALUES ('271', '2', '1', '20574389', 'TK DHARMA WANITA 2 KARANGTURI', 'RT 01 RW 01 DS. KARANGTURI KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('272', '2', '1', '20574395', 'TK DHARMA WANITA 1 TAWING', 'RT 04 RW 01 DS. TAWING KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('273', '2', '2', '20541973', 'SD NEGERI 1 KARANGTURI', 'RT 01 RW 01 Desa Karangturi', null, null);
INSERT INTO `sekolah` VALUES ('274', '2', '1', '20574388', 'TK DHARMA WANITA 1 KARANGTURI', 'RT 01 RW 01 DS. KARANGTURI KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('275', '2', '2', '20542210', 'SD NEGERI 3 CRAKEN', 'RT. 15  RW. 05 Desa Craken', null, null);
INSERT INTO `sekolah` VALUES ('276', '2', '2', '20542247', 'SD NEGERI 3 MASARAN', 'RT. 52 RW. 12 Desa Masaran', null, null);
INSERT INTO `sekolah` VALUES ('277', '2', null, '69776737', 'SPS MARDI UTOMO', 'RT.14 RW.03', null, null);
INSERT INTO `sekolah` VALUES ('278', '2', '3', '20542434', 'SMP NEGERI 1 MUNJUNGAN', 'Jl. Ra. Kartini No. 3 Munjungan', null, null);
INSERT INTO `sekolah` VALUES ('279', '2', '1', '69744095', 'RA/BA/TA MIFTAHUL ULUM KARANGTURI', 'Dusun Krajan RT. 03 RW. 01 Desa Karangturi', null, null);
INSERT INTO `sekolah` VALUES ('280', '2', '2', '20542144', 'SD NEGERI 2 NGULUNGKULON', 'RT 10 RW 03 Desa Ngulungkulon', null, null);
INSERT INTO `sekolah` VALUES ('281', '2', '2', '20542355', 'SD NEGERI 4 MUNJUNGAN', 'RT 41  RW 09 Desa Munjungan', null, null);
INSERT INTO `sekolah` VALUES ('282', '2', '2', '60714384', 'MIS TAWING II', 'DSN. GABAHAN RT.19 / RW.05', null, null);
INSERT INTO `sekolah` VALUES ('283', '2', '2', '60714391', 'MIS NGULUNGKULON', 'Dusn Weru RT.05 RW.01', null, null);
INSERT INTO `sekolah` VALUES ('284', '2', '1', '20574393', 'TK DHARMA WANITA 3 MASARAN', 'RT 52 RW 12 DS. MASARAN KEC. MUNJUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('285', '2', '2', '20541986', 'SD NEGERI 1 MUNJUNGAN', 'RT. 08 RW. 02 Desa Munjungan', null, null);
INSERT INTO `sekolah` VALUES ('286', '3', '1', '20574182', 'TK AL HIDAYAH 9 GEMAHARJO', 'RT. 02 RW. 01 Dusun Karangtuwo', null, null);
INSERT INTO `sekolah` VALUES ('287', '3', '1', '20574196', 'TK KARTIKA SARI KARANGGANDU', 'RT. 19 RW. 06 Dusun Gandu', null, null);
INSERT INTO `sekolah` VALUES ('288', '3', '1', '69780717', 'PERTIWI GEMAHARJO', 'JL. RAYA PANTAI PRIGI RT 20 RW 06 DSN. KOJUR', null, null);
INSERT INTO `sekolah` VALUES ('289', '3', null, 'K5660491', 'LKP Imam saian', 'Jl.P.Diponegoro', null, null);
INSERT INTO `sekolah` VALUES ('290', '3', '1', '20574167', 'TK DHARMA WANITA KARANGGANDU', 'RT . 12 RW. 04 Dusun Gading', null, null);
INSERT INTO `sekolah` VALUES ('291', '3', null, '69780686', 'LPIT AL MANAR', 'PASIR PUTIH DSN. GARES', null, null);
INSERT INTO `sekolah` VALUES ('292', '3', '2', '20542237', 'SD NEGERI 3 KARANGGANDU', 'RT. 27  RW. 09 Desa Karanggandu', null, null);
INSERT INTO `sekolah` VALUES ('293', '3', '2', '20542246', 'SD NEGERI 3 MARGOMULYO', 'RT.11 RW.02', null, null);
INSERT INTO `sekolah` VALUES ('294', '3', '1', '69744144', 'RA Ra Nurul Huda', 'Jl. Raya Pantai Prigi Gg. Glendeng Rt.24 Rw.08', null, null);
INSERT INTO `sekolah` VALUES ('295', '3', '2', '60714439', 'MIS MARGOMULYO', 'RT.09 RW.05 DS. MARGOMULYO KEC. WATULIMO KAB. TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('296', '3', '2', '60714451', 'MIS MUHAMMADIYAH WATUAGUNG', 'RT. 36/10 DS. WATUAGUNG', null, null);
INSERT INTO `sekolah` VALUES ('297', '3', '1', '20574168', 'TK DHARMA WANITA 1 SAWAHAN', 'RT. 04 RW. 02 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('298', '3', '1', '20574189', 'TK AISYIYAH SLAWE', 'RT. 05 RW. 02 Dusun Tumbal', null, null);
INSERT INTO `sekolah` VALUES ('299', '3', '1', '69784742', 'TUNAS BANGSA WATULIMO', 'DUSUN PLAPAR RT. 16 RW. 06', null, null);
INSERT INTO `sekolah` VALUES ('300', '3', '1', '20574201', 'TK AL MUSLIMUN GEMAHARJO', 'RT 18 RW 02 DS. GEMAHARJO KEC. WATULIMO', null, null);
INSERT INTO `sekolah` VALUES ('301', '3', '2', '20542362', 'SD NEGERI 3 TASIKMADU', 'Jalan Raya Pantai Karanggongso Ds. Tasikmadu Kec. Watulimo', null, null);
INSERT INTO `sekolah` VALUES ('302', '3', '2', '20541956', 'SD NEGERI 1 GEMAHARJO', 'Rt.03  Rw. 01', null, null);
INSERT INTO `sekolah` VALUES ('303', '3', '2', '20542132', 'SD NEGERI 2 NGEMBEL', 'RT. 08  RW. 02 Desa Ngembel Kec. Watulimo', null, null);
INSERT INTO `sekolah` VALUES ('304', '3', '1', '20577140', 'TK DHARMA WANITA GEMAHARJO', 'RT. 11 RW. 03 Dsun Kojur', null, null);
INSERT INTO `sekolah` VALUES ('305', '3', '1', '20574193', 'TK PERMATA BUNDA WATUAGUNG', 'RT. 05 RW. 02 Dusun Sambi', null, null);
INSERT INTO `sekolah` VALUES ('306', '3', '2', '20542383', 'SD NEGERI PAKEL', 'Rt. 11  Rw. 02 Desa Pakel Kec. Watulimo', null, null);
INSERT INTO `sekolah` VALUES ('307', '3', '2', '20542310', 'SD NEGERI 4 KARANGGANDU', 'RT. 08  RW. 03 Desa Karanggandu', null, null);
INSERT INTO `sekolah` VALUES ('308', '3', '3', '20542441', 'SMP NEGERI 1 WATULIMO', 'Desa Margomulyo Kecamatan Watulimo Kabupaten Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('309', '3', null, 'P2970007', 'PKBM Hijratul Rasul', 'Jl Senopati Raya No 25 Karang Bata', null, null);
INSERT INTO `sekolah` VALUES ('310', '3', '1', '69777054', 'KB KARYA MANDIRI', 'DSN. KETAWANG RT 13 RW 02', null, null);
INSERT INTO `sekolah` VALUES ('311', '3', '2', '60714438', 'MIS MUHAMMADIYAH DUKUH', 'DS. DUKUH KEC.WATULIMO', null, null);
INSERT INTO `sekolah` VALUES ('312', '3', '1', '69906777', 'TK PGRI WATUAGUNG', 'RT. 31 RW. 09 DUSUN KRECEK', null, null);
INSERT INTO `sekolah` VALUES ('313', '3', '3', '20542427', 'SMP MUHAMMADIYAH WATULIMO', 'Jl. Raya Pantai Prigi', null, null);
INSERT INTO `sekolah` VALUES ('314', '3', '1', '69908641', 'KB NUURUL FIKRI', 'RT. 21 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('315', '3', '1', '20574174', 'TK PERTIWI PRIGI', 'Dusun Prigi, RT. 27 RW. 06', null, null);
INSERT INTO `sekolah` VALUES ('316', '3', '1', '69744145', 'RA/BA/TA TA AL MUSLIMUN', 'DSN. KOJUR RT. 18 RW. 02 DS. GEMAHARJO KEC. WATULIMO', null, null);
INSERT INTO `sekolah` VALUES ('317', '3', null, 'K5660493', 'LKP Pundised', 'Jl.Ahmad Yani 27 Trenggalek Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('318', '3', null, 'P9948370', 'PKBM TUNAS BANGSA', 'RT. 18 RW. 05', null, null);
INSERT INTO `sekolah` VALUES ('319', '3', '1', '20574170', 'TK DHARMA WANITA PAKEL', 'RT. 11 RW. 03 Dusun Glatik', null, null);
INSERT INTO `sekolah` VALUES ('320', '3', '1', '20574169', 'TK DHARMA WANITA 2 SAWAHAN', 'RT . 07 RW. 03 DUSUN SINGGAHAN', null, null);
INSERT INTO `sekolah` VALUES ('321', '3', '2', '20584944', 'MTsN 4 TRENGGALEK', 'RT.30 RW.06 DS.PRIGI KEC.WATULIMO TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('322', '3', '2', '20542094', 'SD NEGERI 2 GEMAHARJO', 'RT. 20  RW. 06 Desa Gemaharjo', null, null);
INSERT INTO `sekolah` VALUES ('323', '3', null, 'K5660499', 'LKP Brawijaya teknik', 'Jl.Lapangan Durenan No.01 Pandean Durenan Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('324', '3', null, 'K5660501', 'LKP Beds', 'Jl.Dusun Kamulan RT.23/04 Kamulan Durenan  Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('325', '3', '2', '69905928', 'SDIT NUURUL FIKRI WATULIMO', 'Jl. Pantai Prigi RT. 21 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('326', '3', '2', '60714440', 'MIS PRIGI II', 'Jalan Raya Pantai Prigi, RT 17 RW 04 DS. PRIGI KEC. WATULIMO', null, null);
INSERT INTO `sekolah` VALUES ('327', '3', '2', '20542060', 'SD NEGERI 1 WATULIMO', 'RT 06 RW 02 Desa Watulimo Kec. Watulimo', null, null);
INSERT INTO `sekolah` VALUES ('328', '3', '1', '69744141', 'RA/BA/TA MIFTAHUL HUDA', 'RT.25 RW.08 DUSUN SUWUR DS. WATUAGUNG KEC. WATULIMO', null, null);
INSERT INTO `sekolah` VALUES ('329', '3', '1', '20542294', 'SD NEGERI 2 WATULIMO', 'Rt. 16  Rw. 06 Pringapus Desa Watulimo', null, null);
INSERT INTO `sekolah` VALUES ('330', '3', '1', '20542388', 'SD NEGERI SLAWE', 'RT 11 RW 01 Desa Slawe', null, null);
INSERT INTO `sekolah` VALUES ('331', '3', '3', '20542423', 'SMP ISLAM WATULIMO', 'Jl. Raya Pantai Prigi', null, null);
INSERT INTO `sekolah` VALUES ('332', '3', '1', '69785821', 'AL HIDAYAH PRIGI', 'RAYA PANTAI PRIGI', null, null);
INSERT INTO `sekolah` VALUES ('333', '3', null, 'K5660526', 'LKP Iin Fadhila', 'Jl. C. Simanjuntak No.39A Rt/Rw. 002/001 Kel. Surodakan, Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('334', '3', '1', '20574183', 'TK SUNU PINARDI MARGOMULYO', 'RT. 01 RW. 02 Dusun Margo', null, null);
INSERT INTO `sekolah` VALUES ('335', '3', '1', '20574178', 'TK AL HIDAYAH PRIGI', 'Dusun Gendingan RT. 17 RW. 04', null, null);
INSERT INTO `sekolah` VALUES ('336', '3', null, 'K5660514', 'LKP Anak Bangsa', 'Jl. Desa Gondang Rt 06/01 Kec.Tugu  Kab. Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('337', '3', '2', '60714445', 'MIS GEMAHARJO II', 'RT.12 / RW.03 Dusun Kojur', null, null);
INSERT INTO `sekolah` VALUES ('338', '3', null, '69776769', 'SPS MUTIARA INSANI', 'Kajar', null, null);
INSERT INTO `sekolah` VALUES ('339', '3', null, 'K5660518', 'LPK Home of English', 'Jl. Desa Karangsoko Perumnas Asa BRI Blok D Rt.25/06 no.9  Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('340', '3', null, 'P2964899', 'PKBM KARYA MANDIRI', '-', null, null);
INSERT INTO `sekolah` VALUES ('341', '3', '1', '69780811', 'AISYIYAH SAWAHAN', 'RT 05 RW 02 DSN. KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('342', '3', '1', '20574190', 'TK MUKTI ASRI DUKUH', 'RT. 02 RW. 01 DUSUN PONGGOK', null, null);
INSERT INTO `sekolah` VALUES ('343', '3', '1', '69744140', 'RA/BA/TA GUPPI AL JANNAH', 'RT 08/RW 05 DSN. KARANGTUWO DS. GEMAHARJO KEC. WATULIMO', null, null);
INSERT INTO `sekolah` VALUES ('344', '3', '1', '69744137', 'RA/BA/TA AL HIKMAH', 'RT.01 RW.04 DS. PAKEL KEC. WATULIMO', null, null);
INSERT INTO `sekolah` VALUES ('345', '3', '1', '20574192', 'TK SRI MULYA DUKUH', 'RT. 22 RW. 06 Dusun Kajar', null, null);
INSERT INTO `sekolah` VALUES ('346', '3', '1', '20574171', 'TK DHARMA WANITA WATULIMO', 'RT. 06 RW. 02 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('347', '3', null, '69776783', 'SPS AL ATIQ', 'KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('348', '3', null, '20542492', 'SMAS ISLAM WATULIMO', 'JL. Pantai Prigi Gg. Masjid Jami', null, null);
INSERT INTO `sekolah` VALUES ('349', '3', '1', '69780602', 'AL HIDAYAH PRIGI', 'RAYA PANTAI PRIGI', null, null);
INSERT INTO `sekolah` VALUES ('350', '3', null, '69780690', 'SPS KASIH IBU', 'RT 13 RW 04 DSN. GADING JL. RAYA PANTAI DAMAS', null, null);
INSERT INTO `sekolah` VALUES ('351', '3', null, 'K5668123', 'LKP MITRA SMART COURSE', 'RT. 10 RW. 02', null, null);
INSERT INTO `sekolah` VALUES ('352', '3', '2', '60714443', 'MIS MUHAMMADIYAH GEMAHARJO', 'JL.RAYA PANTAI PRIGI,RT/RW.01/01,DS. GEMAHARJO KEC. WATULIMO', null, null);
INSERT INTO `sekolah` VALUES ('353', '3', '1', '20574199', 'TK HIDAYATUL ATFAL WATULIMO', 'RT. 09 RW. 03 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('354', '3', '1', '69744136', 'RA AL HIDAYAH MARGOMULYO', 'RT. 09, RW. 05 DS. MARGOMULYO', null, null);
INSERT INTO `sekolah` VALUES ('355', '3', '1', '20574175', 'TK PERTIWI MARGOMULYO', 'RT. 08 RW. 05 Dusun Ketok', null, null);
INSERT INTO `sekolah` VALUES ('356', '3', '1', '69780812', 'AL HIDAYAH 1 SAWAHAN', 'RT 16 RW 06 DSN. NGERANCAH', null, null);
INSERT INTO `sekolah` VALUES ('357', '3', '1', '69780715', 'PERTIWI NGEMBEL', 'RT 11 RW 03 DSN. AMPALGADING', null, null);
INSERT INTO `sekolah` VALUES ('358', '3', '1', '20574186', 'TK TAMAN PUTRA PRIGI', 'RT. 044 RW. 09 Dusun Sumber', null, null);
INSERT INTO `sekolah` VALUES ('359', '3', null, 'K5660505', 'LKP Tripa mandiri computer', 'Jl. Jati Rt.28/08 Kec.Karangan Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('360', '3', '2', '20541982', 'SD NEGERI 1 MARGOMULYO', 'RT 15 RW 06 Desa Margomulyo', null, null);
INSERT INTO `sekolah` VALUES ('361', '3', '1', '69780716', 'AISYIYAH WATUAGUNG', 'RT 36 RW 10 DSN. KRECEK', null, null);
INSERT INTO `sekolah` VALUES ('362', '3', null, '69882665', 'SPS  HARAPAN INSANI', 'JALAN RAYA NGEMBEL RT. 11 RW. 03', null, null);
INSERT INTO `sekolah` VALUES ('363', '3', null, 'T2970006', 'TBM KARYA MANDIRI', '-', null, null);
INSERT INTO `sekolah` VALUES ('364', '3', '2', '20542018', 'SD NEGERI 1 PRIGI', 'RT. 27  RW. 06 Desa Prigi', null, null);
INSERT INTO `sekolah` VALUES ('365', '3', '2', '20542218', 'SD NEGERI 3 GEMAHARJO', 'RT 11  RW  03 Desa Gemaharjo', null, null);
INSERT INTO `sekolah` VALUES ('366', '3', null, 'K5660519', 'LKP Inovatif', 'Jl. Desa/Kel.Watulimo Rt.11/4 Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('367', '3', '2', '20542188', 'SD NEGERI 2 TASIKMADU', 'RT.  22  RW. 04 Desa Tasikmadu', null, null);
INSERT INTO `sekolah` VALUES ('368', '3', '1', '69932922', 'KB AL HIDAYAH PRIGI', 'RT. 17 RW. 04 ', null, null);
INSERT INTO `sekolah` VALUES ('369', '3', '1', '69777079', 'KB AL HIDAYAH IX', 'RT 02 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('370', '3', '2', '60714446', 'MIS GUPPI GEMAHARJO III', 'RT 08/05 DSN. KARANGTUWO DS. GEMAHARJO KEC. WATULIMO', null, null);
INSERT INTO `sekolah` VALUES ('371', '3', '1', '20574173', 'TK PERTIWI TASIKMADU', 'RT. 23 RW. 04 Dusun Gares', null, null);
INSERT INTO `sekolah` VALUES ('372', '3', null, 'P2964911', 'PKBM BHAKTI SAMURIH', 'Dusun Kojur RT. 12 RW. 03', null, null);
INSERT INTO `sekolah` VALUES ('373', '3', '1', '20574197', 'TK KARTINI TASIKMADU', 'RT. 01 RW. 01 DUSUN KETAWANG', null, null);
INSERT INTO `sekolah` VALUES ('374', '3', '1', '20574166', 'TK DHARMA WANITA TASIKMADU', 'RT. 35 RW. 06 DUSUN KARANGGONGSO', null, null);
INSERT INTO `sekolah` VALUES ('375', '3', '1', '69780805', 'DHARMA WANITA 1 SAWAHAN', 'RT 04 RW 02 DSN. KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('376', '3', '1', '69780604', 'KB AR RAHMAN', 'RT 25 RW 04 TASIKMADU', null, null);
INSERT INTO `sekolah` VALUES ('377', '3', null, '69776774', 'SPS PUTRA BERLIAN', 'DSN. GANDU', null, null);
INSERT INTO `sekolah` VALUES ('378', '3', '1', '69780813', 'AL HIDAYAH 2 SAWAHAN', 'RT 07 RW 03 DSN. SINGGAHAN', null, null);
INSERT INTO `sekolah` VALUES ('379', '3', '2', '60714444', 'MIS GUPPI GEMAHARJO I', 'Jln. Raya Thukul Pantai Prigi RT/RW : 02/01', null, null);
INSERT INTO `sekolah` VALUES ('380', '3', '1', '69780724', 'AISYIYAH SLAWE', 'RT 05 RW 02 DSN. TUMBAL', null, null);
INSERT INTO `sekolah` VALUES ('381', '3', '1', '69785832', 'KARTIKA SARI KARANGGANDU', 'RT. 19 RW. 06', null, null);
INSERT INTO `sekolah` VALUES ('382', '3', '2', '60714450', 'MIS PAKEL', 'RT.01 RW.04 DUKUH TAMANAN  DESA PAKEL KEC.WATULIMO', null, null);
INSERT INTO `sekolah` VALUES ('383', '3', '2', '60714436', 'MIS SAWAHAN II', 'RT.07 / RW.03 DS. SAWAHAN', null, null);
INSERT INTO `sekolah` VALUES ('384', '3', '3', '20566314', 'SMP NEGERI 3 WATULIMO', 'Ds. Watuagung Rt.19 Rw.05', null, null);
INSERT INTO `sekolah` VALUES ('385', '3', '3', '20584946', 'MTSS ALBURHAN WATULIMO', 'RT:017 RW:006 DESA MARGOMULYO, KECAMATAN WATULIMO', null, null);
INSERT INTO `sekolah` VALUES ('386', '3', '1', '69744134', 'RA/BA/TA BA AISYIYAH GEMAHARJO', 'RT 001/RW 001 DS. GEMAHARJO', null, null);
INSERT INTO `sekolah` VALUES ('387', '3', '2', '20542293', 'SD NEGERI 3 WATUAGUNG', 'RT. 06  RW. 02 Desa Watuagung', null, null);
INSERT INTO `sekolah` VALUES ('388', '3', '1', '69908667', 'KB AL-HIKAM', 'RT. 09 RW. 03', null, null);
INSERT INTO `sekolah` VALUES ('389', '3', '1', '69744138', 'RA/BA/TA AL HUDA WATULIMO', 'RT. 22 RW. 08 DESA WATULIMO', null, null);
INSERT INTO `sekolah` VALUES ('390', '3', null, 'P2970006', 'PKBM Sintung', 'JL RAGI GENEP GG DAHLIA IV', null, null);
INSERT INTO `sekolah` VALUES ('391', '3', null, 'K5660489', 'LKP Webster Course Indonesia', 'Jl.DR.Sutomo 42 Rt.01/1 ngantru Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('392', '3', '1', '69780718', 'AL HIDAYAH IX GEMAHARJO', 'RT 02 RW 01 DSN. KARANGTUWO', null, null);
INSERT INTO `sekolah` VALUES ('393', '3', null, 'K5660509', 'LKP Ichwan informatic training centre', 'Jl. Krajan Munjungan RT 06/02 Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('394', '3', '2', '69794685', 'SD ISLAM TERPADU AR-RAHMAN', 'Desa Tasikmadu RT. 25 RW. 04 Kec. Watulimo', null, null);
INSERT INTO `sekolah` VALUES ('395', '3', '2', '20542289', 'SD NEGERI 3 TASIKMADU', 'Jalan Raya Pantai Prigi', null, null);
INSERT INTO `sekolah` VALUES ('396', '3', null, 'K5660512', 'LKP Karya Citra Busana ', 'Jl. Desa Tasik Madu Rt.12/02 Kec. Watulimo Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('397', '3', '1', '69744143', 'RA/BA/TA NURUL HUDA', 'DUSUN GADING RT 08 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('398', '3', '1', '20574180', 'TK AL HIDAYAH 1 SAWAHAN', 'RT. 16 RW. 06 Dusun Ngrancah', null, null);
INSERT INTO `sekolah` VALUES ('399', '3', '2', '60714437', 'MIS MUHAMMADIYAH SAWAHAN', 'RT05/RW02 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('400', '3', '1', '20574195', 'TK TUNAS BANGSA WATULIMO', 'RT. 16 RW. 06 Dusun Plapar', null, null);
INSERT INTO `sekolah` VALUES ('401', '3', '1', '69777084', 'ARRAHMAN', 'TASIKMADU', null, null);
INSERT INTO `sekolah` VALUES ('402', '3', '2', '20542107', 'SD NEGERI 2 KARANGGANDU', 'RT 19  RW 06 Dusun Gandu', null, null);
INSERT INTO `sekolah` VALUES ('403', '3', '2', '60714442', 'MIS KARANGGANDU', 'DUSUN GADING RT 08 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('404', '3', '2', '60714453', 'MIS GUPPI AL MUSLIMUN GEMAHARJO', 'DUSUN KOJUR   RT.18 / RW.02', null, null);
INSERT INTO `sekolah` VALUES ('405', '3', '2', '20554623', 'SD NEGERI 2 SAWAHAN', 'RT 07 RW 03,Dusun Singgahan', null, null);
INSERT INTO `sekolah` VALUES ('406', '3', '2', '60714434', 'MIN 1 TRENGGALEK', 'RT. 38 RW. 08 DS. PRIGI KEC. WATULIMO KAB. TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('407', '3', '2', '60714435', 'MADRASAH IBTIDAIYAH SAWAHAN I', 'RT.16 RW.06 Dsn. Ngrancah', null, null);
INSERT INTO `sekolah` VALUES ('408', '3', '1', '69777082', 'KB TUNAS BANGSA SAWAHAN', 'RT 05 RW 02', null, null);
INSERT INTO `sekolah` VALUES ('409', '3', null, '20542494', 'SMAS MUHAMMADIYAH 2 WATULIMO', 'JL. RAYA PANTAI PRIGI', null, null);
INSERT INTO `sekolah` VALUES ('410', '3', '1', '69780714', 'DHARMA WANITA PAKEL', 'RT 11 RW 02 DSN. GLATIK', null, null);
INSERT INTO `sekolah` VALUES ('411', '3', '1', '69780725', 'MUKTI ASRI DUKUH', 'RT 02 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('412', '3', '2', '20542088', 'SD NEGERI 2 DUKUH', 'RT 22 RW 06 Desa Dukuh', null, null);
INSERT INTO `sekolah` VALUES ('413', '3', '2', '20541991', 'SD NEGERI 1 NGEMBEL', 'RT. 11  RW. 03 Desa Ngembel', null, null);
INSERT INTO `sekolah` VALUES ('414', '3', null, 'K5660521', 'LPK EMMY Salon', 'Jl. Hos Cokroaminoto no.33B Surodakan Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('415', '3', '2', '69784748', 'DHARMA WANITA PERMATA BUNDA', 'RT. 05 RW. 02 SAMBI', null, null);
INSERT INTO `sekolah` VALUES ('416', '3', null, '69790205', 'SPS NUANSA CERIA', 'RT 22 RW 04', null, null);
INSERT INTO `sekolah` VALUES ('417', '3', '1', '69780684', 'KB HIDAYATURROHMAN', 'PANTAI DAMAS', null, null);
INSERT INTO `sekolah` VALUES ('418', '3', null, 'K5660522', 'LKP Vitarina', 'Desa Ngrayung Gandusari Rt.11/05 Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('419', '3', '1', '20574181', 'TK AL HIDAYAH 2 GEMAHARJO', 'RT. 12 RW 03 Dusun Kojur', null, null);
INSERT INTO `sekolah` VALUES ('420', '3', '1', '69744144', 'RA Ra Nurul Huda', 'Jl. Raya Pantai Prigi Gg. Glendeng Rt.24 Rw.08', null, null);
INSERT INTO `sekolah` VALUES ('421', '3', '1', '20574188', 'TK MARDI UTAMA SLAWE', 'RT. 11 RW. 01 DUSUN SEBO', null, null);
INSERT INTO `sekolah` VALUES ('422', '3', '1', '20574194', 'TK AISYIYAH WATUAGUNG', 'RT. 36 RW. 10 DUSUN KRECEK', null, null);
INSERT INTO `sekolah` VALUES ('423', '3', null, 'K5660502', 'LKP Swasana', 'Jl.Kendalrejo RT 01/01 Durenan', null, null);
INSERT INTO `sekolah` VALUES ('424', '3', '2', '20542455', 'SMP NEGERI 2 WATULIMO', 'Jl.Ds/Kec. Watulimo', null, null);
INSERT INTO `sekolah` VALUES ('425', '3', null, 'P2964901', 'PKBM MARGO RUKUN', '-', null, null);
INSERT INTO `sekolah` VALUES ('426', '3', '1', '20574184', 'TK MARDISIWI MARGOMULYO', 'Dusun Margo', null, null);
INSERT INTO `sekolah` VALUES ('427', '3', '1', '69780809', 'DHARMA WANITA 2 SAWAHAN', 'RT 07 RW 03 DSN. SINGGAHAN', null, null);
INSERT INTO `sekolah` VALUES ('428', '3', '2', '20542335', 'SD NEGERI 4 WATUAGUNG', 'RT 31 RW 09 Desa Watuagung Kec. Watulimo', null, null);
INSERT INTO `sekolah` VALUES ('429', '3', null, 'K5660510', 'LKP Jaya Raya Driving Course', 'Jl. Brigjen Setran Kios Bukit Hijau No. 8-9', null, null);
INSERT INTO `sekolah` VALUES ('430', '3', '3', '20542415', 'SMP GOTONG ROYONG 1 WATULIMO', 'Jalan Durenan - Prigi', null, null);
INSERT INTO `sekolah` VALUES ('431', '3', '2', '60714452', 'MIS WATUAGUNG', 'DS. WATUAGUNG KEC. WATULIMO', null, null);
INSERT INTO `sekolah` VALUES ('432', '3', '1', '69780825', 'DHARMA WANITA KARANGGANDU', 'RT 12 RW 04 DSN. GADING', null, null);
INSERT INTO `sekolah` VALUES ('433', '3', '1', '69744135', 'RA/BA/TA AL-HIDAYAH DUKUH', 'RT. 06 RW. 02 DUSUN KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('434', '3', '1', '20574198', 'TK ISLAM TERPADU NUURUL FIKRI MARGOMULYO', 'RT. 21 RW. 01 ', null, null);
INSERT INTO `sekolah` VALUES ('435', '3', '1', '69934292', 'KB TUNAS BANGSA WATUAGUNG', 'RT. 12 RW. 03 ', null, null);
INSERT INTO `sekolah` VALUES ('436', '3', '1', '69780726', 'SITI KHOTIJAH DUKUH', 'RT 16 RW 04 DSN. KETRO', null, null);
INSERT INTO `sekolah` VALUES ('437', '3', '1', '69934296', 'KB DINAR NASYIAH', 'RT. 01 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('438', '3', null, 'K5660503', 'LKP Vita modelling school', 'Jl. Desa Ngrayung Rt.11/05 Kec.Gandusari Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('439', '3', null, 'T2970008', 'TBM SUKA MAJU', '-', null, null);
INSERT INTO `sekolah` VALUES ('440', '3', '1', '69744139', 'RA/BA/TA GUPPI TASIKMADU', 'RT 24 RW 04 DS. TASIKMADU', null, null);
INSERT INTO `sekolah` VALUES ('441', '3', '1', '20574187', 'TK AISYIYAH SAWAHAN', 'RT. 05 RW. 02 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('442', '3', '1', '20574177', 'TK PERTIWI GEMAHARJO', 'RT. 20 RW. 06 Dusun Kojur', null, null);
INSERT INTO `sekolah` VALUES ('443', '3', '1', '20574172', 'TK DHARMA WANITA WATUAGUNG', 'RT. 18 RW. 05 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('444', '3', null, '20584746', 'MAS MUHAMMADIYAH WATULIMO', 'JL. RAYA PANTAI PRIGI, DESA GEMAHARJO', null, null);
INSERT INTO `sekolah` VALUES ('445', '3', null, 'P2964897', 'PKBM SUKA MAJU', 'RT.11 RW.02 DESA PAKEL', null, null);
INSERT INTO `sekolah` VALUES ('446', '3', null, 'K5660504', 'LKP English guide centre', 'Jl.Desa margomulyo RT 21/01 Kec>watulimo', null, null);
INSERT INTO `sekolah` VALUES ('447', '3', null, '69780818', 'SUNU PINARDI MARGOMULYO', 'RT 01 RW 02 DSN. MARGO', null, null);
INSERT INTO `sekolah` VALUES ('448', '3', '2', '20542121', 'SD NEGERI 2 MARGOMULYO', 'RT 08  RW 05 Desa Margomulyo', null, null);
INSERT INTO `sekolah` VALUES ('449', '3', '1', '69744142', 'RA/BA/TA MIN PRIGI', 'DS. PRIGI KEC. WATULIMO RT 38 RW 08', null, null);
INSERT INTO `sekolah` VALUES ('450', '3', '1', '69780816', 'MARDI SIWI MARGOMULYO', 'RT 12 RW 01 DSN. MARGO', null, null);
INSERT INTO `sekolah` VALUES ('451', '3', '1', '20574179', 'TK AL HIDAYAH 2 SAWAHAN', 'RT. 07 RW. 03 Dusun Singgahan', null, null);
INSERT INTO `sekolah` VALUES ('452', '3', '2', '20542155', 'SD NEGERI 2 PRIGI', 'Desa Prigi Kec. Watulimo', null, null);
INSERT INTO `sekolah` VALUES ('453', '3', '2', '69908827', 'SD ISLAM AL-MANAR', 'Jl. Raya Pasir Putih RT. 18 RW. 03', null, null);
INSERT INTO `sekolah` VALUES ('454', '3', null, 'T2970007', 'TBM AL HIDAYAH IX', '-', null, null);
INSERT INTO `sekolah` VALUES ('455', '3', null, 'K5660523', 'LKP Husna School', 'Rt. 08 Rw. 04 Ds. Bendorejo Kec. Pogalan Kab. Trenggalek Jawa Timur 66371', null, null);
INSERT INTO `sekolah` VALUES ('456', '3', '2', '20541950', 'SD NEGERI 1 DUKUH', 'RT 02  RW 01 Desa Dukuh', null, null);
INSERT INTO `sekolah` VALUES ('457', '3', '2', '20554629', 'SD NEGERI 2 WATUAGUNG', 'Dusun Krajan RT.18 RW.05', null, null);
INSERT INTO `sekolah` VALUES ('458', '3', '2', '20541969', 'SD NEGERI 1 KARANGGANDU', 'RT 13  RW 04 Desa Karanggandu', null, null);
INSERT INTO `sekolah` VALUES ('459', '3', '2', '20542059', 'SD NEGERI 1 WATUAGUNG', 'Jln. Watuagung - Ngembel', null, null);
INSERT INTO `sekolah` VALUES ('460', '3', '3', '20584945', 'MTSS MUHAMMADIYAH WATULIMO', 'JL. RAYA PANTAI PRIGI, DS. GEMAHARJO, KEC.WATULIMO', null, null);
INSERT INTO `sekolah` VALUES ('461', '3', null, 'K5660527', 'LKP Dewa Dewi', 'Jl. Pantai Prigi Rt/Rw. 010/003 Ds/Kec.Watulimo, Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('462', '3', '2', '20542053', 'SD NEGERI 1 TASIKMADU', 'RT 01  RW 01 Desa Tasikmadu', null, null);
INSERT INTO `sekolah` VALUES ('463', '3', '2', '60714449', 'MIS Dukuh', 'RT. 06  RW. 02 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('464', '3', '2', '60714448', 'MIS WATULIMO', 'JL.RAYA PANTAI PRIGI, RT. 09, RW. 03, DSN.KRAJAN DS./ KEC. WATULIMO', null, null);
INSERT INTO `sekolah` VALUES ('465', '3', null, '69776761', 'SPS RESTU BUNDA', 'JLN RAYA PRIGI NO.1', null, null);
INSERT INTO `sekolah` VALUES ('466', '3', '2', '60714441', 'MIS GUPPI TASIKMADU', 'RT 24 RW 04 DS. TASIKMADU KEC. WATULIMO', null, null);
INSERT INTO `sekolah` VALUES ('467', '3', '1', '69777083', 'KB AL HIDAYAH MARGOMULYO', 'DKH. KETOK DS. MARGOMULYO RT 09 RW 05', null, null);
INSERT INTO `sekolah` VALUES ('468', '3', null, 'K5660500', 'LKP Johanta', 'Jl.Kendalrejo RT 03/01 Kec.Durenan', null, null);
INSERT INTO `sekolah` VALUES ('469', '3', null, 'K5660494', 'LKP Duta ayu', 'Jl.R.A.Karitni no.75 Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('470', '3', '2', '20542027', 'SD NEGERI 1 SAWAHAN', 'RT. 04 RW. 02 Desa Sawahan', null, null);
INSERT INTO `sekolah` VALUES ('471', '3', null, '20542515', 'SMK MUHAMMADIYAH WATULIMO', 'JL. RAYA PRIGI DESA MARGOMULYO - WATULIMO - TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('472', '3', '1', '69780855', 'NURUL FIKRI MARGOMULYO', 'RT 21 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('473', '3', null, '20542516', 'SMK NEGERI 1 WATULIMO', 'JLN GAJAH OYO NO. 1', null, null);
INSERT INTO `sekolah` VALUES ('474', '3', '2', '60714447', 'MIS MUHAMMADIYAH SLAWE', 'DSN TUMBAL RT.05 / RW.02', null, null);
INSERT INTO `sekolah` VALUES ('475', '3', '1', '69780824', 'TAMAN PUTRA PRIGI', 'RT 44 RW 09 DSN. SUMBER', null, null);
INSERT INTO `sekolah` VALUES ('476', '3', null, 'P2970008', 'PKBM SERUNI', 'Jl AK Gani No 14 Guguk Randah', null, null);
INSERT INTO `sekolah` VALUES ('477', '3', '1', '69777049', 'KB SUKA MAJU', 'GLATIK', null, null);
INSERT INTO `sekolah` VALUES ('478', '3', '1', '69780815', 'PERTIWI MARGOMULYO', 'RT 08 RW 05 DSN KRUBYAK', null, null);
INSERT INTO `sekolah` VALUES ('479', '3', '1', '20574176', 'TK PERTIWI NGEMBEL', 'RT. 11 RW. 03 Dusun Ampel Gading', null, null);
INSERT INTO `sekolah` VALUES ('480', '3', '1', '20574191', 'TK SITI KHOTIJAH DUKUH', 'RT. 16 RW. 04 Dusun Ketro', null, null);
INSERT INTO `sekolah` VALUES ('481', '4', '1', '69876666', 'KB JABAL ROHMAH', 'RT. 21 RW. 06', null, null);
INSERT INTO `sekolah` VALUES ('482', '4', '2', '20577127', 'SD ISLAM AZ ZAHRO', 'Ponpes Nailul Ulum', null, null);
INSERT INTO `sekolah` VALUES ('483', '4', '1', '69777089', 'KB DHARMA WANITA', 'RT.12 RW.04 DUSUN BANARAN', null, null);
INSERT INTO `sekolah` VALUES ('484', '4', '2', '60714367', 'MIS SUGIHAN', 'JL. KARANGANOM NO.6 SUGIHAN  KAMPAK', null, null);
INSERT INTO `sekolah` VALUES ('485', '4', '2', '20542238', 'SD NEGERI 3 KARANGREJO', 'RT. 49 RW. 15', null, null);
INSERT INTO `sekolah` VALUES ('486', '4', '2', '20542207', 'SD NEGERI 3 BOGORAN', 'RT. 09 RW. 05', null, null);
INSERT INTO `sekolah` VALUES ('487', '4', '1', '20573751', 'TK DHARMA WANITA 2 NGADIMULYO', 'JL. Raya Kampak Munjungan KM. 12 RT. 33 RW. 08 ', null, null);
INSERT INTO `sekolah` VALUES ('488', '4', '2', '20542250', 'SD NEGERI 3 NGADIMULYO', 'RT. 40 RW. 10', null, null);
INSERT INTO `sekolah` VALUES ('489', '4', '1', '20573750', 'TK DHARMA WANITA 2 TIMAHAN', 'Dusun Genuk RT. 20 RW. 06 ', null, null);
INSERT INTO `sekolah` VALUES ('490', '4', '2', '20542057', 'SD NEGERI 1 TIMAHAN', 'Dusun Krajan, RT. 02 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('491', '4', '1', '20573741', 'TK PERTIWI 4 SUGIHAN', 'Jl. Karanganom RT. 11 RW. 11 ', null, null);
INSERT INTO `sekolah` VALUES ('492', '4', '1', '69777086', 'KB AL-FALAH', 'RT.20 RW.04', null, null);
INSERT INTO `sekolah` VALUES ('493', '4', '1', '20573745', 'TK DHARMA WANITA SUGIHAN', 'DSN NGIMER RT 23 RW 10 DS. SUGIHAN KEC. KAMPAK', null, null);
INSERT INTO `sekolah` VALUES ('494', '4', '2', '20542203', 'SD NEGERI 3 BENDOAGUNG', 'Jl. Raya Kampak-munjungan', null, null);
INSERT INTO `sekolah` VALUES ('495', '4', '2', '20542292', 'SD NEGERI 3 TIMAHAN', 'RT 13 RW  04', null, null);
INSERT INTO `sekolah` VALUES ('496', '4', '1', '69776788', 'KB BUNGA PERTIWI', 'JL. RAYA KAMPAK - MUNJUNGAN RT.31 RW.07', null, null);
INSERT INTO `sekolah` VALUES ('497', '4', '3', '20542458', 'SMP NEGERI 3 KAMPAK', 'Jl. Bukit Permai No. 1', null, null);
INSERT INTO `sekolah` VALUES ('498', '4', '2', '20542318', 'SD NEGERI 4 NGADIMULYO', 'RT. 20 RW. 04', null, null);
INSERT INTO `sekolah` VALUES ('499', '4', '1', '20573746', 'TK DHARMA WANITA 1 TIMAHAN', 'Dusun Krajan RT. 02 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('500', '4', '1', '20573752', 'TK DHARMA WANITA BENDOAGUNG', 'JL. Raya Kampak - Munjungan RT. 16 RW. 05 ', null, null);
INSERT INTO `sekolah` VALUES ('501', '4', '1', '69778976', 'TK DHARMA WANITA 3 KARANGREJO', 'RT.49 RW.15 Dusun Pesu', null, null);
INSERT INTO `sekolah` VALUES ('502', '4', '2', '60714369', 'MIS SENDEN', 'JL. TENGGAR NO.03', null, null);
INSERT INTO `sekolah` VALUES ('503', '4', '1', '20573744', 'TK DHARMA WANITA 2 KARANGREJO', 'Jl. Manikoro No. 5 RT. 23 RW. 07 ', null, null);
INSERT INTO `sekolah` VALUES ('504', '4', '1', '20573742', 'TK PERTIWI 5 BOGORAN', 'Jl. Mliwis Dsn. Ndringo RT. 04 RW. 02 ', null, null);
INSERT INTO `sekolah` VALUES ('505', '4', '2', '20542192', 'SD NEGERI 2 TIMAHAN', 'RT. 21 RW. 06', null, null);
INSERT INTO `sekolah` VALUES ('506', '4', '2', '20542108', 'SD NEGERI 2 KARANGREJO', 'RT 23 RW. 08 Jln. Manikoro', null, null);
INSERT INTO `sekolah` VALUES ('507', '4', '2', '20541939', 'SD NEGERI 1 BOGORAN', 'RT. 04 RW. 02 Dusun Krajan Desa Bogoran Kec. Kampak', null, null);
INSERT INTO `sekolah` VALUES ('508', '4', null, '69900711', 'SEKOLAH LUAR BIASA NEGERI KAMPAK', 'JL. Anggrek No. 09 RT. 10 RW. 02', null, null);
INSERT INTO `sekolah` VALUES ('509', '4', '1', '69988893', 'KB AZ - ZAHWA', 'RT. 23 RW. 10', null, null);
INSERT INTO `sekolah` VALUES ('510', '4', '2', '60714368', 'MIS KARANGREJO', 'JL MANIKORO NO 03 DS. KARANGREJO', null, null);
INSERT INTO `sekolah` VALUES ('511', '4', '1', '20573749', 'TK DHARMA WANITA 1 BOGORAN', 'Jalan Kampak-Dongko Dsn. Gambar RT. 33 RW. 10 ', null, null);
INSERT INTO `sekolah` VALUES ('512', '4', '1', '20573740', 'TK PERTIWI 3 SENDEN', 'Jl. Kampak Watulimo RT. 02 RW. 01 ', null, null);
INSERT INTO `sekolah` VALUES ('513', '4', '2', '20542028', 'SD NEGERI SENDEN', 'Jln.Raya Kampak-Watulimo RT.02 RW.01 Desa Senden Kec.Kampak Kab.Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('514', '4', '1', '69778965', 'TK DHARMA WANITA SUGIHAN', 'RT.23 RW.10 Dusun Ngimer', null, null);
INSERT INTO `sekolah` VALUES ('515', '4', '2', '20541934', 'SD NEGERI 1 BENDOAGUNG', 'Jl. Raya Kampak - Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('516', '4', '3', '20542447', 'SMP NEGERI 2 KAMPAK', 'RT 13 RW 04', null, null);
INSERT INTO `sekolah` VALUES ('517', '4', null, '69776786', 'SPS AZ ZAHRO', 'RT.19 RW.05 DSN. KEMIRI', null, null);
INSERT INTO `sekolah` VALUES ('518', '4', null, 'T2968519', 'TBM AL HUDA', '-', null, null);
INSERT INTO `sekolah` VALUES ('519', '4', '2', '20542127', 'SD NEGERI SATU ATAP 1 KAMPAK', 'Jl. Raya Kampak-munjungan km.12', null, null);
INSERT INTO `sekolah` VALUES ('520', '4', '3', '20554109', 'SMP NEGERI SATU ATAP 1 KAMPAK', 'Jl.Raya Kampak-Munjungan Km12', null, null);
INSERT INTO `sekolah` VALUES ('521', '4', '1', '69744077', 'RA/BA/TA AL HIDAYAH KARANGREJO', 'JL. MANIKORO NO:03 DESA KARANGREJO', null, null);
INSERT INTO `sekolah` VALUES ('522', '4', '2', '69863261', 'SD ISLAM TERPADU NUURUL FIKRI KAMPAK', 'Jl. Kampak-Watulimo, Rt. 10, Rw. 03', null, null);
INSERT INTO `sekolah` VALUES ('523', '4', '1', '69778738', 'KB NUURUL FIKRI KAMPAK', 'JL. KAMPAK - WATULIMO', null, null);
INSERT INTO `sekolah` VALUES ('524', '4', '1', '20573748', 'TK DHARMA WANITA 3 KARANGREJO', 'DSN. TULANG RT 49 RW 15 DS. KARANGREJO KEC. KAMPAK', null, null);
INSERT INTO `sekolah` VALUES ('525', '4', '3', '20542419', 'SMP ISLAM KAMPAK', 'PP. Nailul Ulum ', null, null);
INSERT INTO `sekolah` VALUES ('526', '4', '2', '20541987', 'SD NEGERI 1 NGADIMULYO', 'Jl. Raya Kampak-munjungan RT. 09 RW. 02', null, null);
INSERT INTO `sekolah` VALUES ('527', '4', '1', '20573743', 'TK DHARMA WANITA 1 KARANGREJO', 'Jl. Manikoro Nomor 20 RT. 06 RW. 02', null, null);
INSERT INTO `sekolah` VALUES ('528', '4', '1', '69778981', 'TK DHARMA WANITA 1 NGADIMULYO', 'Jl. Raya Kampak - Munjungan KM 05 RT.09 RW.02 ', null, null);
INSERT INTO `sekolah` VALUES ('529', '4', '1', '20573747', 'TK DHARMA WANITA 1 NGADIMULYO', 'DSN. TANJUNG RT 09 RW 02 DS. NGADIMULYO KEC. KAMPAK', null, null);
INSERT INTO `sekolah` VALUES ('530', '4', '1', '20573738', 'TK PERTIWI 1 BENDOAGUNG', 'Jl. Raya Kampak-Trenggalek No. 415 RT. 01 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('531', '4', '2', '20542170', 'SD NEGERI 2 SUGIHAN', 'RT. 23 RW. 10', null, null);
INSERT INTO `sekolah` VALUES ('532', '4', '2', '20541970', 'SD NEGERI 1 KARANGREJO', 'Jln. Manikoro No. 01, RT. 06 RW. 02', null, null);
INSERT INTO `sekolah` VALUES ('533', '4', '1', '69744078', 'RA/BA/TA AL- HIDAYAH SENDEN', 'JL.TENGGAR NO.03 RT:01 RW:01', null, null);
INSERT INTO `sekolah` VALUES ('534', '4', '1', '69777090', 'KB SAHILLA INSANI', 'RT.02 RW.01 DUSUN KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('535', '4', '1', '69876665', 'KB AZ-ZAITUN', 'Dusun Buluroto RT 40 RW 10', null, null);
INSERT INTO `sekolah` VALUES ('536', '4', null, 'P2968519', 'PKBM PADASALAMA', 'JL.PERSATUAN RAYA NO. 17 C', null, null);
INSERT INTO `sekolah` VALUES ('537', '4', null, '20542506', 'SMAN 1 KAMPAK', 'Jl. Raya Bendoagung No. 92', null, null);
INSERT INTO `sekolah` VALUES ('538', '4', '2', '20542034', 'SD NEGERI 1 SUGIHAN', 'RT. 12 RW. 06', null, null);
INSERT INTO `sekolah` VALUES ('539', '4', '3', '20584931', 'MTsN 2 TRENGGALEK', 'JL.RAYA SUGIHAN KAMPAK TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('540', '4', null, 'P2964898', 'PKBM AL-HUDA', '-', null, null);
INSERT INTO `sekolah` VALUES ('541', '4', '1', '69744079', 'RA/BA/TA AL HIDAYAH SUGIHAN', 'JLN.KARANGANOM NO.06', null, null);
INSERT INTO `sekolah` VALUES ('542', '4', '1', '20573739', 'TK PERTIWI 2 BENDOAGUNG', 'Jl. Raya Kampak-Munjungan RT. 31 RW. 07', null, null);
INSERT INTO `sekolah` VALUES ('543', '4', '3', '20542432', 'SMP NEGERI 1 KAMPAK', 'Jln. Anggrek No. 1 Kampak', null, null);
INSERT INTO `sekolah` VALUES ('544', '4', '1', '69777087', 'KB AL HUDA', 'RT.38 RW.11 DUSUN NGASEM', null, null);
INSERT INTO `sekolah` VALUES ('545', '4', '2', '20542071', 'SD NEGERI 2 BENDOAGUNG', 'Jl. Raya Kampak-Munjungan RT : 16 RW : 05', null, null);
INSERT INTO `sekolah` VALUES ('546', '4', '2', '20542077', 'SD NEGERI 2 BOGORAN', 'Jln.Raya Kampak Dongko Km 4 RT. 13 RW. 08', null, null);
INSERT INTO `sekolah` VALUES ('547', '5', '3', '20542468', 'SMP NEGERI SATU ATAP 1 DONGKO', 'Dsn. Sobo RT 17 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('548', '5', '3', '20541994', 'SD NEGERI 1 NGERDANI', 'Krajan, RT 1 RW 1 Desa Ngerdani ', null, null);
INSERT INTO `sekolah` VALUES ('549', '5', '1', '69780624', 'DHARMA WANITA 4 PANDEAN', 'RT 47 RW 17 DUSUN TALUN', null, null);
INSERT INTO `sekolah` VALUES ('550', '5', '1', '20574339', 'TK DHARMA WANITA 4 SALAMWATES', 'RT 44 RW 12 DS. SALAMWATES KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('551', '5', '2', '60714339', 'MIS DARUL ILMI', 'Dusun Ngleban RT.15 / RW.03 ', null, null);
INSERT INTO `sekolah` VALUES ('552', '5', '1', '69897980', 'TA GUPPI Baitul Izzah', 'Dusun Talun RT. 52 RW. 19', null, null);
INSERT INTO `sekolah` VALUES ('553', '5', '2', '20542015', 'SD NEGERI 1 PETUNG', 'RT.01 RW.01 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('554', '5', '2', '20542326', 'SD NEGERI 4 SALAMWATES', 'Rt 45 Rw 12 Dusun Kori', null, null);
INSERT INTO `sekolah` VALUES ('555', '5', '1', '20574307', 'TK NEGERI PEMBINA DONGKO', 'RT 02 RW 01 DS. DONGKO KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('556', '5', '2', '69950776', 'SD ISLAM TERPADU AN-NAFI', 'RT. 04 RW. 01 Desa Dongko', null, null);
INSERT INTO `sekolah` VALUES ('557', '5', '2', '20542087', 'SD NEGERI 2 DONGKO', 'Desa Dongko', null, null);
INSERT INTO `sekolah` VALUES ('558', '5', '3', '20542457', 'SMP NEGERI 3 DONGKO', 'Rt/rw.02/01', null, null);
INSERT INTO `sekolah` VALUES ('559', '5', '2', '20542135', 'SD NEGERI SATU ATAP 1 DONGKO', 'RT 17 RW 03 Dsn. Sobo Desa Ngerdani', null, null);
INSERT INTO `sekolah` VALUES ('560', '5', '2', '20542040', 'SD NEGERI 1 SUMBERBENING', 'RT.28  RW.06 Desa Sumberbening', null, null);
INSERT INTO `sekolah` VALUES ('561', '5', '1', '69996244', 'KB MIFTAHUL HUDA', 'RT. 20 RW. 05 DESA. SIKI', null, null);
INSERT INTO `sekolah` VALUES ('562', '5', '1', '69897981', 'Hidayatut Tholab', 'Jln. Raya Dongko-Munjungan', null, null);
INSERT INTO `sekolah` VALUES ('563', '5', '2', '20542176', 'SD NEGERI 2 SUMBERBENING', 'RT 12  RW 03 Desa Sumberbening', null, null);
INSERT INTO `sekolah` VALUES ('564', '5', '2', '20542209', 'SD NEGERI 3 CAKUL', 'RT 17  RW 09 Desa Cakul', null, null);
INSERT INTO `sekolah` VALUES ('565', '5', '1', '20574321', 'TK DHARMA WANITA 2 SIKI', 'RT 26 RW 06 DS. SIKI KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('566', '5', '2', '20542080', 'SD NEGERI 2 CAKUL', 'Dusun Karangsudo', null, null);
INSERT INTO `sekolah` VALUES ('567', '5', '2', '20541942', 'SD NEGERI 1 CAKUL', 'RT 28  RW 14 Desa Cakul', null, null);
INSERT INTO `sekolah` VALUES ('568', '5', '1', '69780607', 'DHARMA WANITA 2 NGERDANI', 'RT 21 RW 03 DUSUN SOBO', null, null);
INSERT INTO `sekolah` VALUES ('569', '5', '1', '20574311', 'TK DHARMA WANITA 1 NGERDANI', 'RT 17 RW 03 DS. NGERDANI KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('570', '5', '1', '20574315', 'TK DHARMA WANITA 2 PRINGAPUS', 'RT 24 RW 06 DS. PRINGAPUS KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('571', '5', '1', '69780615', 'DHARMA WANITA 1 SUMBERBENING', 'RT  RW 06 DUSUN MLOKO', null, null);
INSERT INTO `sekolah` VALUES ('572', '5', '2', '20542272', 'SD NEGERI 3 SALAMWATES', ' RT 13 RW 05 DUSUN SOBO', null, null);
INSERT INTO `sekolah` VALUES ('573', '5', '1', '20574312', 'TK DHARMA WANITA 2 NGERDANI', 'RT 21 RW 03 DS. NGERDANI KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('574', '5', '2', '20542363', 'SD NEGERI SATU ATAP 2 DONGKO', 'RT. 33 RW. 17 Desa Cakul', null, null);
INSERT INTO `sekolah` VALUES ('575', '5', '2', '20542370', 'SD NEGERI 7 DONGKO', 'Dusun Jajar ', null, null);
INSERT INTO `sekolah` VALUES ('576', '5', '2', '20542323', 'SD NEGERI 4 PRINGAPUS', 'RT 16 RW 04 Desa Pringapus', null, null);
INSERT INTO `sekolah` VALUES ('577', '5', '3', '20542472', 'SMP PGRI DONGKO', 'Raya Dongko-Munjungan KM-5 Rt 08 Rw 03 Dsn. Krajan', null, null);
INSERT INTO `sekolah` VALUES ('578', '5', '1', '69744049', 'RA/BA/TA AL AMIN', 'RT.020 RW.005 DUSUN KOJAN', null, null);
INSERT INTO `sekolah` VALUES ('579', '5', '1', '20574319', 'TK DHARMA WANITA 3 SUMBERBENING', 'RT 12 RW 03 DS. SUMBERBENING KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('580', '5', '2', '20542031', 'SD NEGERI 1 SIKI', 'RT 26  RW 06 Desa Siki', null, null);
INSERT INTO `sekolah` VALUES ('581', '5', '1', '20574316', 'TK DHARMA WANITA 3 PRINGAPUS', 'RT 39 RW 08 DS. PRINGAPUS KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('582', '5', '1', '20574313', 'TK DHARMA WANITA 3 NGERDANI', 'RT 01 RW 01 DS. NGERDANI KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('583', '5', '2', '60714342', 'MIS MIFTAHUL HUDA', 'RT 020 RW 005 DUSUN KOJAN', null, null);
INSERT INTO `sekolah` VALUES ('584', '5', '2', '60714336', 'MIS NURUL HUDA CAKUL', 'RT 06 RW 03 KARANGSUDO', null, null);
INSERT INTO `sekolah` VALUES ('585', '5', '1', '69980038', 'KB BINTANG', 'RT. 08 RW. 02 ', null, null);
INSERT INTO `sekolah` VALUES ('586', '5', null, '69776813', 'SPS MUTIARA INSANI', 'RT 58 RW 13 DUSUN NGANDONG', null, null);
INSERT INTO `sekolah` VALUES ('587', '5', null, 'P2964902', 'PKBM DARUSSALAM', 'RT. 01 RW. 01 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('588', '5', '2', '20542357', 'SD NEGERI 4 PANDEAN', ' RT. 47   RW. 17 Dusun Talun', null, null);
INSERT INTO `sekolah` VALUES ('589', '5', '2', '20542167', 'SD NEGERI 2 SIKI', 'RT.02  RW.01 DUSUN KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('590', '5', '1', '20574326', 'TK DHARMA WANITA 1 CAKUL', 'RT 28 RW 14 DS. CAKUL KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('591', '5', '1', '69780618', 'DHARMA WANITA 3 PETUNG', 'RT 09 RW 02 DUSUN KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('592', '5', '1', '69776794', 'RESTU IBU', 'RT 04 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('593', '5', null, '20542495', 'SMAN 1 DONGKO', 'JL. RAYA DONGKO NO. 99', null, null);
INSERT INTO `sekolah` VALUES ('594', '5', '2', '20542351', 'SD NEGERI 5 DONGKO', 'RT 26 RW 07 Dusun Karang Tengah', null, null);
INSERT INTO `sekolah` VALUES ('595', '5', '1', '20577173', 'TK PERTIWI DONGKO', 'RT. 02 RW. 01 ', null, null);
INSERT INTO `sekolah` VALUES ('596', '5', '2', '20541949', 'SD NEGERI 1 DONGKO', 'Jln Panglima Sudirman Desa Dongko', null, null);
INSERT INTO `sekolah` VALUES ('597', '5', '1', '69780627', 'DHARMA WANITA 4 SALAMWATES', 'RT 44 RW 12 DUSUN KORI', null, null);
INSERT INTO `sekolah` VALUES ('598', '5', '2', '20542364', 'SD NEGERI 6 DONGKO', 'RT 39 RW 09 Dusun Kasihan', null, null);
INSERT INTO `sekolah` VALUES ('599', '5', '1', '69777091', 'KB LESTARI', 'RT 14 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('600', '5', '1', '20574310', 'TK ISLAM TERPADU MUTIARA HARAPAN', 'RT 08 RW 02 DS. DONGKO KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('601', '5', '1', '69780616', 'DHARMA WANITA 1 PETUNG', 'RT 01 RW 01 DUSUN KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('602', '5', '1', '69776791', 'LESTARI SATU', 'RT 51 RW 12 DUSUN JAJAR', null, null);
INSERT INTO `sekolah` VALUES ('603', '5', '2', '20584929', 'MTSS NURUL HUDA CAKUL', 'RT 27 RW 14 DS CAKUL, KEC DONGKO, KAB.TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('604', '5', null, '69882666', 'SPS AZ-ZAHRO', 'RT 02 RW 01 DSN JAJAR', null, null);
INSERT INTO `sekolah` VALUES ('605', '5', null, 'K5660524', 'LKP Java Education', 'Rt. 43 Rw. 10 Ds. Dongko', null, null);
INSERT INTO `sekolah` VALUES ('606', '5', '2', '20542274', 'SD NEGERI 3 SIKI', 'RT 41  RW 09 Dusun Nguluh Desa Siki', null, null);
INSERT INTO `sekolah` VALUES ('607', '5', '2', '20542193', 'SD NEGERI 2 WATUAGUNG', 'RT. 24 RW. 04 Dusun Ngleban', null, null);
INSERT INTO `sekolah` VALUES ('608', '5', '1', '69777093', 'KB TUNAS MUDA', 'RT 21 RW 05 DUSUN MLOKO', null, null);
INSERT INTO `sekolah` VALUES ('609', '5', '2', '20542024', 'SD NEGERI 1 SALAMWATES', 'Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('610', '5', '1', '69780620', 'DHARMA WANITA 2 CAKUL', 'RT 33 RW 17', null, null);
INSERT INTO `sekolah` VALUES ('611', '5', '3', '20542443', 'SMP NEGERI 2 DONGKO', 'Ds. Pandean', null, null);
INSERT INTO `sekolah` VALUES ('612', '5', '2', '20570744', 'SD NEGERI 3 PANDEAN', 'RT 41 RW 16 Desa Pandean', null, null);
INSERT INTO `sekolah` VALUES ('613', '5', '1', '69780691', 'DHARMA WANITA 3 SUMBERBENING', 'RT 12 RW 03 DUSUN PELEM', null, null);
INSERT INTO `sekolah` VALUES ('614', '5', '1', '20574331', 'TK DHARMA WANITA 3 WATUAGUNG', 'RT 01 RW 01 DS. WATUAGUNG KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('615', '5', '2', '20584928', 'MTSS GUPPI DONGKO', 'JL.PB.J.SUDIRMAN GG.BLIMBING NO. 1 DESA/KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('616', '5', '1', '20577142', 'TK DHARMA WANITA 2 WATUAGUNG', 'RT. 24 RW. 04 NGLEBAN DS. WATUAGUNG KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('617', '5', '1', '20574332', 'TK DHARMA WANITA 1 PANDEAN', 'RT 17 RW 06 DS. PANDEAN KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('618', '5', '2', '60714344', 'MIS AL HIKMAH GUPPI DONGKO', 'RT.034 / RW.008', null, null);
INSERT INTO `sekolah` VALUES ('619', '5', '1', '20574320', 'TK DHARMA WANITA 1 SIKI', 'RT 02 RW 01 DS. SIKI KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('620', '5', '2', '20542269', 'SD NEGERI 3 PRINGAPUS', 'RT 07 RW 02 Dusun Krajan ', null, null);
INSERT INTO `sekolah` VALUES ('621', '5', '2', '69894640', 'MI GUPPI Baitul Izzah', 'Dusun Talun RT. 52 RW. 19', null, null);
INSERT INTO `sekolah` VALUES ('622', '5', '2', '20577141', 'TK DHARMA WANITA 2 CAKUL', 'RT. 33 RW. 17 DS. CAKUL KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('623', '5', null, '69776801', 'SPS ANUGERAH', 'RT 02 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('624', '5', '1', '20574325', 'TK DHARMA WANITA 3 PETUNG', 'RT 09 RW 02 DS. PETUNG KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('625', '5', '1', '69780626', 'DHARMA WANITA 2 SALAMWATES', 'RT 15 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('626', '5', '3', '20571151', 'SMP NEGERI SATU ATAP 3 DONGKO', 'RT 24 RW 06 Dusun Dawung', null, null);
INSERT INTO `sekolah` VALUES ('627', '5', '1', '69882668', 'POS PAUD MUTIARA INSANI SATU', 'RT 50 RW 11 DUSUN SENULI', null, null);
INSERT INTO `sekolah` VALUES ('628', '5', '1', '69744050', 'RA/BA/TA AL MUTTAQIN', 'RT 08 RW 02 DSN. KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('629', '5', '1', '69777092', 'KB MUTIARA', 'RT 08 RW 02 DUSUN KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('630', '5', '1', '69780617', 'DHARMA WANITA 2 PETUNG', 'RT 19 RW 04 BANAR', null, null);
INSERT INTO `sekolah` VALUES ('631', '5', '1', '69780625', 'DHARMA WANITA 1 SALAMWATES', 'RT08 RW 03 DUSUN KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('632', '5', '1', '20574308', 'TK IDHATA DONGKO', 'RT 69 RW 04 BLIMBING DS. DONGKO KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('633', '5', '1', '20574337', 'TK DHARMA WANITA 2 SALAMWATES', 'RT 15 RW 03 DS. SALAMWATES KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('634', '5', '2', '20542263', 'SD NEGERI 2 PANDEAN', 'RT. 55 RW. 20 Desa Pandean', null, null);
INSERT INTO `sekolah` VALUES ('635', '5', null, '69930152', 'PPS PP Darussalam', ' RT. 01 RW. 01 Dsn. Krajan', null, null);
INSERT INTO `sekolah` VALUES ('636', '5', '1', '20574338', 'TK DHARMA WANITA 3 SALAMWATES', 'DS. SALAMWATES KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('637', '5', '1', '20574322', 'TK DHARMA WANITA 4 SIKI', 'RT 034 RW 008 Dusun Jagul', null, null);
INSERT INTO `sekolah` VALUES ('638', '5', '2', '60714338', 'MIS MIFTAHUL HUDA', 'RT 014 RW 005 DUSUN JOGADI', null, null);
INSERT INTO `sekolah` VALUES ('639', '5', '1', '20577175', 'TK DHARMA WANITA 1 SUMBERBENING', 'RT. 28 RW. 06 Dusun Mloko', null, null);
INSERT INTO `sekolah` VALUES ('640', '5', '2', '20542278', 'SD NEGERI 3 SUMBERBENING', 'Desa Sumberbening', null, null);
INSERT INTO `sekolah` VALUES ('641', '5', null, 'P9954217', 'PKBM BAITUL IZZAH', 'RT. 05 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('642', '5', '1', '20574323', 'TK DHARMA WANITA 1 PETUNG', 'DS. PETUNG KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('643', '5', '1', '69776816', 'PERMATA BUNDA', 'RT 37 RW 19', null, null);
INSERT INTO `sekolah` VALUES ('644', '5', '1', '69780613', 'IDHATA DONGKO', 'RT 69 RW 04 DUSUN BLIMBING', null, null);
INSERT INTO `sekolah` VALUES ('645', '5', '1', '69913305', 'KB BAITUL IZZAH', 'RT. 52 RW. 19', null, null);
INSERT INTO `sekolah` VALUES ('646', '5', '2', '20542328', 'SD NEGERI 4 SIKI', 'RT 58 Dusun Ngandong', null, null);
INSERT INTO `sekolah` VALUES ('647', '5', '1', '20574327', 'TK DHARMA WANITA 3 CAKUL', 'RT 17 RW 09 DS. CAKUL KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('648', '5', '2', '20542161', 'SD NEGERI 2 SALAMWATES', ' RT 29  RW 09 Dusun Belang', null, null);
INSERT INTO `sekolah` VALUES ('649', '5', '2', '20542302', 'SD NEGERI 4 CAKUL', 'Dusun Juron', null, null);
INSERT INTO `sekolah` VALUES ('650', '5', '1', '20574330', 'TK DHARMA WANITA 1 WATUAGUNG', 'RT 15 RW 03 Dudun Ngleban Desa Watuagung Kecamatan Dongko Kabupaten Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('651', '5', null, '69785155', 'SPS LESTARI SATU', 'RT 51 RW 12', null, null);
INSERT INTO `sekolah` VALUES ('652', '5', '1', '20574314', 'TK DHARMA WANITA 1 PRINGAPUS', 'RT 05 RW 02 DS. PRINGAPUS KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('653', '5', '3', '20554491', 'SMP NEGERI SATU ATAP 2 DONGKO', 'RT/RW  33/17 Dsn. Juron', null, null);
INSERT INTO `sekolah` VALUES ('654', '5', '1', '69882278', 'KB DHARMA WANITA 1 PANDEAN', 'RT 17 RW 06', null, null);
INSERT INTO `sekolah` VALUES ('655', '5', '1', '20574329', 'TK DHARMA WANITA 5 CAKUL', 'RT 37 RW 19 DS. CAKUL KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('656', '5', '2', '20542350', 'SD NEGERI 5 CAKUL', 'Jln Gerilya Sudirman Desa Cakul', null, null);
INSERT INTO `sekolah` VALUES ('657', '5', '2', '20542010', 'SD NEGERI 1 PANDEAN ', 'RT. 17 RW. 06 Desa Pandean ', null, null);
INSERT INTO `sekolah` VALUES ('658', '5', '2', '20542257', 'SD NEGERI 3 NGERDANI', 'RT. 21 RW.03 Desa Ngerdani', null, null);
INSERT INTO `sekolah` VALUES ('659', '5', '2', '20542215', 'SD NEGERI 3 DONGKO', 'Jln. Panglima Sudirman Desa Dongko', null, null);
INSERT INTO `sekolah` VALUES ('660', '5', '1', '20574334', 'TK DHARMA WANITA 2 PANDEAN', 'RT 55 RW 20 DS. PANDEAN KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('661', '5', '1', '69780610', 'DHARMA WANITA 1 PRINGAPUS', 'RT 05 RW 02 DUSUN KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('662', '5', '2', '20542322', 'SD NEGERI 3 PANDEAN ', 'JL. RAYA PANDEAN KM.3', null, null);
INSERT INTO `sekolah` VALUES ('663', '5', '1', '20574309', 'TK DHARMA WANITA 1 DONGKO', 'JL. RAYA DONGKO PULE 500 M DS. DONGKO KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('664', '5', null, '69908624', 'SPS HIDAYATUT THOLIBIN', 'RT. 06 RW. 01 ', null, null);
INSERT INTO `sekolah` VALUES ('665', '5', '1', '20574336', 'TK DHARMA WANITA 1 SALAMWATES', 'RT 08 RW 03 DS. SALAMWATES KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('666', '5', null, '69812081', 'SMK ISLAM GUPPI DONGKO', 'Rt. 71 Rw. 04 Dusun Blimbing Desa Dongko', null, null);
INSERT INTO `sekolah` VALUES ('667', '5', '1', '20577174', 'TK DHARMA WANITA 3 SIKI', 'RT. 41 RW. 09 Dusun Nguluh ', null, null);
INSERT INTO `sekolah` VALUES ('668', '5', '2', '20542058', 'SD NEGERI 1 WATUAGUNG', 'RT. 01 RW. 01 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('669', '5', '2', '20542265', 'SD NEGERI 3 PETUNG', 'RT 19 RW 04 Dusun Banar', null, null);
INSERT INTO `sekolah` VALUES ('670', '5', '1', '69744054', 'RA/BA/TA MIFTAHUL HUDA', 'RT. 14 RW. 05 DSN. JOGADI', null, null);
INSERT INTO `sekolah` VALUES ('671', '5', '1', '69785149', 'TK DARMA WANITA 1 SUMBER BENING', 'DSN MLOKO', null, null);
INSERT INTO `sekolah` VALUES ('672', '5', '1', '69780623', 'DHARMA WANITA 2 PANDEAN', 'PANDEAN', null, null);
INSERT INTO `sekolah` VALUES ('673', '5', '1', '20574328', 'TK DHARMA WANITA 4 CAKUL', 'RT 08 RW 04 DS. CAKUL KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('674', '5', null, '69776800', 'SPS NAWA KARTIKA 6', 'RT 06 RW 03 DUSUN KARANGSUDO', null, null);
INSERT INTO `sekolah` VALUES ('675', '5', null, 'P9926301', 'PKBM MARGI MANDIRI', 'RT. 23 RW. 05 DS.SUMBERBENING, KEC.DONGKO, KAB.TRENGGALEK, PROV.JAWA TIMUR 66363', null, null);
INSERT INTO `sekolah` VALUES ('676', '5', '1', '69744051', 'RA/BA/TA AR RAHMAH', 'RT.51 RW.12 DUSUN SENULI', null, null);
INSERT INTO `sekolah` VALUES ('677', '5', '1', '69780619', 'DHARMA WANITA 1 CAKUL', 'RT 28 RW 14 DUSUN NGLARAH', null, null);
INSERT INTO `sekolah` VALUES ('678', '5', '1', '69780622', 'DHARMA WANITA 4 CAKUL', 'RT 08 RW 04', null, null);
INSERT INTO `sekolah` VALUES ('679', '5', '3', '20542429', 'SMP NEGERI 1 DONGKO', 'Jl. P. SUDIRMAN NO. 9 ', null, null);
INSERT INTO `sekolah` VALUES ('680', '5', '2', '60714340', 'MIS GUPPI PANDEAN', 'DSN. SAMBI RT. 036 RW. 14 ', null, null);
INSERT INTO `sekolah` VALUES ('681', '5', '1', '20574335', 'TK DHARMA WANITA 4 PANDEAN', 'RT 47 RW 17 DS. PANDEAN KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('682', '5', null, '69776803', 'SPS KARTIKA', 'RT 16 RW 03 DUSUN NGLEBAN', null, null);
INSERT INTO `sekolah` VALUES ('683', '5', '2', '69982998', 'MIS PLUS HIDAYATUL MUBTADIIN', 'RT.28 RW.09 DUSUN BELANG', null, null);
INSERT INTO `sekolah` VALUES ('684', '5', '1', '20574317', 'TK DHARMA WANITA 4 PRINGAPUS', 'RT 16 RW 04 DS. PRINGAPUS KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('685', '5', '1', '69744052', 'RA/BA/TA HIDAYATUL MUBTADIIN', 'RT.034 RW.008 DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('686', '5', '2', '60714341', 'MIS HIDAYATUT THOLAB', 'RT 28 RW 11 DSN BONSARI', null, null);
INSERT INTO `sekolah` VALUES ('687', '5', '2', '60714337', 'MIS AL HIDAYAH SIKI', 'RT.051 / RW.012', null, null);
INSERT INTO `sekolah` VALUES ('688', '5', '1', '20574318', 'TK DHARMA WANITA 2 SUMBERBENING', 'RT 34 RW 07 DS. SUMBERBENING KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('689', '5', '1', '20574324', 'TK DHARMA WANITA 2 PETUNG', 'RT 19 RW 04 DS. PETUNG KEC. DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('690', '5', '1', '69780614', 'DHARMA WANITA 3 SIKI', 'DSN. NGULUH RT 41 RW 09', null, null);
INSERT INTO `sekolah` VALUES ('691', '5', '1', '69744053', 'RA/BA/TA HIDAYATUL MUSLIMIN', 'RT 06 RW 03 DSN. KARANGSUDO', null, null);
INSERT INTO `sekolah` VALUES ('692', '5', '2', '20542156', 'SD NEGERI 2 PRINGAPUS', 'Desa Pringapus', null, null);
INSERT INTO `sekolah` VALUES ('693', '5', '1', '69780612', 'PERTIWI', 'RT 02 RW 01 DUSUN KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('694', '5', null, '20584745', 'MAS NURUL HUDA CAKUL', 'RT 27 RW 14 DSN NGLARAN DS.CAKUL KEC.DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('695', '5', '2', '20542306', 'SD NEGERI 4 DONGKO', 'RT 22 RW  6 Dusun Klangsur Desa Dongko', null, null);
INSERT INTO `sekolah` VALUES ('696', '5', '1', '69780621', 'DHARMA WANITA 3 CAKUL', 'RT 17 RW 09 DUSUN NGLANGON', null, null);
INSERT INTO `sekolah` VALUES ('697', '5', '2', '60714343', 'MIS AL MUTTAQIN GUPPI NGERDANI', 'DSN.KRAJAN RT.08  RW.O2  DESA NGERDANI', null, null);
INSERT INTO `sekolah` VALUES ('698', '5', null, '69894641', 'Ma arif Plus Nasyith An-Nahl', 'Jl. Dongko - Kampak KM. 6 RT. 44/01 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('699', '5', '2', '20542152', 'SD NEGERI 2 PETUNG', 'RT 09  RW 02 Desa Petung', null, null);
INSERT INTO `sekolah` VALUES ('700', '5', null, '69897982', 'GUPPI Pandean', 'RT. 36 RW. 14 Dusun Sambi', null, null);
INSERT INTO `sekolah` VALUES ('701', '5', '2', '20542019', 'SD NEGERI SATU ATAP 3 DONGKO', 'RT 24 RW 06 Dusun Dawung', null, null);
INSERT INTO `sekolah` VALUES ('702', '5', '1', '69776822', 'PUTRA NUSANTARA', 'WATUAGUNG', null, null);
INSERT INTO `sekolah` VALUES ('703', '5', '3', '20574648', 'SMP ISLAM DARUSSALAM DONGKO', 'Dongko', null, null);
INSERT INTO `sekolah` VALUES ('704', '5', '2', '20542361', 'SD NEGERI 5 SIKI', ' RT. 34 RW. 08 Dusun Jagul', null, null);
INSERT INTO `sekolah` VALUES ('705', '5', '1', '69990315', 'TK DHARMA WANITA 3 DONGKO', 'RT. 26 RW. 07 ', null, null);
INSERT INTO `sekolah` VALUES ('706', '5', '1', '69991889', 'KB AL-AZHAR', 'RT. 13 RW. 02 Desa. Ngerdani', null, null);
INSERT INTO `sekolah` VALUES ('707', '5', '1', '69994108', 'RA HIDAYATUL MUBTADIIN', 'RT.28 RW.09 DUSUN BELANG', null, null);
INSERT INTO `sekolah` VALUES ('708', '5', '1', '69992781', 'KB MUTIARA BUNDA', 'RT. 03 RW. 01 DESA. PETUNG', null, null);
INSERT INTO `sekolah` VALUES ('709', '5', '1', '69995819', 'KB NUSANTARA NGERDANI', 'RT. 18 RW. 03 Desa. ngerdani', null, null);
INSERT INTO `sekolah` VALUES ('710', '6', '1', '69776834', 'SPS KASIH IBU', 'DSN. TIRISAN RT 59 RW 28', null, null);
INSERT INTO `sekolah` VALUES ('711', '6', '2', '20542236', 'SD NEGERI 3 KARANGANYAR', 'RT. 30 RW. 04', null, null);
INSERT INTO `sekolah` VALUES ('712', '6', '1', '20574220', 'TK AL HIDAYAH 4 JOMBOK', 'RT 56 RW 16 DS. JOMBOK KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('713', '6', '2', '20542352', 'SD NEGERI 4 JOHO', 'RT 25 RW 10 Desa Joho', null, null);
INSERT INTO `sekolah` VALUES ('714', '6', '1', '20574232', 'TK PERTIWI PULE', 'RT 01 RW 01 DS. PULE KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('715', '6', '2', '20541962', 'SD NEGERI 1 JOHO', 'Joho', null, null);
INSERT INTO `sekolah` VALUES ('716', '6', '1', '69776841', 'DHARMA BHAKTI', 'PUYUNG', null, null);
INSERT INTO `sekolah` VALUES ('717', '6', '1', '69785112', 'SPS  DARMA BHAKTI', 'RT 06 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('718', '6', null, 'P2969404', 'PKBM Trunojoyo', 'Jl. Pertahanan Kel. Bancaran', null, null);
INSERT INTO `sekolah` VALUES ('719', '6', '1', '69810628', 'KB HARAPAN INSANI', 'GLADAK', null, null);
INSERT INTO `sekolah` VALUES ('720', '6', '2', '20542273', 'SD NEGERI 3 SIDOMULYO', 'RT.23 RW.09 Dusun Ngepring', null, null);
INSERT INTO `sekolah` VALUES ('721', '6', '2', '20542262', 'SD NEGERI 3 PAKEL', 'Pakel', null, null);
INSERT INTO `sekolah` VALUES ('722', '6', '1', '20574221', 'TK DHARMA WANITA 3 JOMBOK', 'RT 40 RW 11 DS. JOMBOK KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('723', '6', '1', '20574226', 'TK DHARMA WANITA 2 PUYUNG', 'RT. 13 RW. 07 DESA PUYUNG', null, null);
INSERT INTO `sekolah` VALUES ('724', '6', '1', '20574236', 'TK DHARMA WANITA 2 PAKEL', 'RT 15 RW 06 DS. PAKEL KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('725', '6', '1', '69776831', 'KB PESONA', 'RT 18 RW 10', null, null);
INSERT INTO `sekolah` VALUES ('726', '6', '2', '20542101', 'SD NEGERI 2 JOMBOK', 'Jombok', null, null);
INSERT INTO `sekolah` VALUES ('727', '6', '2', '20542035', 'SD NEGERI SATU ATAP 1 PULE', 'RT. 14 RW. 05 DS. SUKOKIDUL, KEC PULE', null, null);
INSERT INTO `sekolah` VALUES ('728', '6', '2', '20541911', 'SD NEGERI 1 PUYUNG', 'Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('729', '6', '1', '20574228', 'TK DHARMA WANITA 1 KARANGANYAR', 'RT 16 RW 03 DS. KARANGANYAR KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('730', '6', '2', '20542327', 'SD NEGERI 4 SIDOMULYO', 'Dusun Donosari', null, null);
INSERT INTO `sekolah` VALUES ('731', '6', '2', '20542035', 'SD-SMPN SATU ATAP 1 PULE', 'RT. 14 RW.05 Desa Sukokidul Kecamatan Pule Kab. Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('732', '6', '1', '20574217', 'TK DARUSSALAM SIDOMULYO', 'RT. 08 RW. 03 DESA SIDOMULYO', null, null);
INSERT INTO `sekolah` VALUES ('733', '6', '1', '69776830', 'KB FAJAR HARAPAN BANGSA', 'RT 53 RW 26 DUSUN TIRISAN', null, null);
INSERT INTO `sekolah` VALUES ('734', '6', '2', '20541912', 'SD NEGERI 2 PUYUNG', 'RT 23 RW 12', null, null);
INSERT INTO `sekolah` VALUES ('735', '6', '1', '69954695', 'SPS TERPADU AISYIYAH', 'RT. 30 RW. 03 ', null, null);
INSERT INTO `sekolah` VALUES ('736', '6', '1', '69777097', 'KB LAKSA', 'RAYA KASREPAN', null, null);
INSERT INTO `sekolah` VALUES ('737', '6', '1', '69785139', 'KB PERTIWI', 'RT 01 RW 02 DUSUN KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('738', '6', '1', '20574229', 'TK DHARMA WANITA 2 KARANGANYAR', 'RT 01 RW 01 DS. KARANGANYAR KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('739', '6', '1', '20574237', 'TK DHARMA WANITA 3 PAKEL', 'RT. 10 RW. 04 Desa Pakel', null, null);
INSERT INTO `sekolah` VALUES ('740', '6', '2', '20542378', 'SD NEGERI KEMBANGAN', 'Dusun Turi RT 01 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('741', '6', '1', '20574216', 'TK DHARMA WANITA 1 PAKEL', 'RT 04 RW 02 DS. PAKEL KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('742', '6', '2', '20542100', 'SD NEGERI 2 JOHO', 'Joho', null, null);
INSERT INTO `sekolah` VALUES ('743', '6', '2', '20542271', 'SD NEGERI 3 PULE', 'Dsn. Bangunsari RT 45 RW 22', null, null);
INSERT INTO `sekolah` VALUES ('744', '6', '1', '69810631', 'KB MUTIARA BUNDA', 'DUSUN KRAJAN RT 01 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('745', '6', '2', '20542166', 'SD NEGERI 2 SIDOMULYO', 'DUSUN KARANGREJO RT.34 / RW.14', null, null);
INSERT INTO `sekolah` VALUES ('746', '6', '1', '69744114', 'BA AISYIYAH', 'RT. 04 RW. 01, DUSUN KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('747', '6', '1', '69777095', 'KB INSAN MULIA ABADI', 'TANGGARAN', null, null);
INSERT INTO `sekolah` VALUES ('748', '6', '2', '20542051', 'SD NEGERI 1 TANGGARAN', 'Tanggaran', null, null);
INSERT INTO `sekolah` VALUES ('749', '6', '1', '20574214', 'TK AL HIDAYAH 3 KARANGANYAR', 'RT 25 RW 03 DS. KARANGANYAR KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('750', '6', '2', '20542308', 'SD NEGERI 3 JOHO', 'Joho', null, null);
INSERT INTO `sekolah` VALUES ('751', '6', '3', '20572005', 'SMP NEGERI SATU ATAP 1 PULE', 'RT14 RW05 Desa Sukokidul', null, null);
INSERT INTO `sekolah` VALUES ('752', '6', '1', '20574241', 'TK DHARMA WANITA 1 JOHO', 'RT 04 RW 02 DS. JOHO KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('753', '6', '1', '69744116', 'RA/BA/TA BA MUTIAUMMAT', 'RT. 45 RW 18 DUSUN SIDEM DS.  JOMBOK, PULE  TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('754', '6', '2', '20542287', 'SD NEGERI 3 TANGGARAN', 'RT 21 RW O2 DUSUN NGLEDOK', null, null);
INSERT INTO `sekolah` VALUES ('755', '6', '2', '20542309', 'SD NEGERI 4 JOMBOK', 'Jombok', null, null);
INSERT INTO `sekolah` VALUES ('756', '6', '2', '20541968', 'SD NEGERI 1 KARANGANYAR', 'RT. 10 RW. 02', null, null);
INSERT INTO `sekolah` VALUES ('757', '6', null, 'P2964889', 'PKBM KHARISMA', 'Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('758', '6', '2', '20541915', 'SD NEGERI 4 PUYUNG', 'RT. 09 RW. 05', null, null);
INSERT INTO `sekolah` VALUES ('759', '6', '1', '69810626', 'SPS TUNAS BANGSA', 'KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('760', '6', '2', '20542009', 'SD NEGERI 1 PAKEL', 'Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('761', '6', '2', '20542353', 'SD NEGERI 5 JOMBOK', 'Jombok', null, null);
INSERT INTO `sekolah` VALUES ('762', '6', '1', '69912344', 'KB IDHATA 1 PULE', 'Dusun Gugur RT. 17 RW. 09', null, null);
INSERT INTO `sekolah` VALUES ('763', '6', '2', '20542321', 'SD NEGERI 4 PAKEL', 'RT 22 RW 07,Dusun Gladak', null, null);
INSERT INTO `sekolah` VALUES ('764', '6', '1', '69776846', 'KB ABDI MULYA', 'DUSUN KARANGREJO RT 30 RW 12', null, null);
INSERT INTO `sekolah` VALUES ('765', '6', null, 'P2964908', 'PKBM LAKSA', 'RT.49 RW.14 Dsn.SidemDs.Jombok Kec.Pule Kab.Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('766', '6', '1', '20574243', 'TK DHARMA WANITA 1 SIDOMULYO', 'RT 12 RW 05 DS. SIDOMULYO KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('767', '6', '2', '20542325', 'SD NEGERI 4 PULE', 'RT. 13 RW. 07 Dsn. Gugur', null, null);
INSERT INTO `sekolah` VALUES ('768', '6', '1', '20574225', 'TK DHARMA WANITA 1 TANGGARAN', 'RT 09 RW 01 DS. TANGGARAN KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('769', '6', '1', '20574235', 'TK AL HIDAYAH 2 JOMBOK', 'RT 50 RW 14 DS. JOMBOK KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('770', '6', '2', '20542171', 'SD NEGERI 2 SUKOKIDUL', 'RT. 004 RW. 002', null, null);
INSERT INTO `sekolah` VALUES ('771', '6', null, 'T2969405', 'TBM PUTRA PESONA', '-', null, null);
INSERT INTO `sekolah` VALUES ('772', '6', '1', '20574238', 'TK DHARMA WANITA 2 JOMBOK', 'DS. JOMBOK KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('773', '6', '2', '20542030', 'SD NEGERI 1 SIDOMULYO', 'RT 08 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('774', '6', '1', '69777096', 'KB TAMAN INDRIA KURNIA', 'JOHO', null, null);
INSERT INTO `sekolah` VALUES ('775', '6', '2', '20541910', 'SD ISLAM JOMBOK', 'RT/36 RW/10 Ds.Jombok', null, null);
INSERT INTO `sekolah` VALUES ('776', '6', null, '69930151', 'PPS PP Hidayatulloh', 'RT. 10 RW. 10 Dsn. Bakalan', null, null);
INSERT INTO `sekolah` VALUES ('777', '6', '3', '20542528', 'SMP PGRI PULE', 'Sidomulyo', null, null);
INSERT INTO `sekolah` VALUES ('778', '6', '1', '20574233', 'TK IDHATA 3 PULE', 'RT 45 RW 22 DS. PULE KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('779', '6', '1', '20574245', 'TK DHARMA WANITA KEMBANGAN', 'RT 01 RW 01 DS. KEMBANGAN KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('780', '6', '1', '69776854', 'SPS PERMATA HATI', 'DSN WERU RT 19 RW 06', null, null);
INSERT INTO `sekolah` VALUES ('781', '6', '1', '69785138', 'KB TUNAS MUDA', 'DSN. NGRANDU RT 35 RW 10', null, null);
INSERT INTO `sekolah` VALUES ('782', '6', '3', '20542452', 'SMP NEGERI 2 PULE', 'RT 02 RW 01 Dusun Turi', null, null);
INSERT INTO `sekolah` VALUES ('783', '6', '2', '20542158', 'SD NEGERI 2 PULE', 'Dusun Tirisan', null, null);
INSERT INTO `sekolah` VALUES ('784', '6', '1', '69777099', 'KB NAWA KARTIKA VII', 'RT 39 RW 20', null, null);
INSERT INTO `sekolah` VALUES ('785', '6', '1', '69776857', 'SPS KUSUMA SAKTI', 'DUSUN DONOSARI RT 09 RW 04', null, null);
INSERT INTO `sekolah` VALUES ('786', '6', '3', '20569042', 'SMP NEGERI 3 PULE', 'RT/RW 08/04', null, null);
INSERT INTO `sekolah` VALUES ('787', '6', '2', '20542360', 'SD NEGERI 5 SIDOMULYO', 'RT. 37 RW. 16 DUSUN KARANGREJO', null, null);
INSERT INTO `sekolah` VALUES ('788', '6', '1', '20574244', 'TK DHARMA WANITA 1 PULE', 'RT 44 RW 22 DS. PULE KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('789', '6', '2', '20541963', 'SD NEGERI 1 JOMBOK', 'Jombok RT 28 RW 08', null, null);
INSERT INTO `sekolah` VALUES ('790', '6', '3', '20542473', 'SMP SORE PULE', 'Dusun Krajan Rt.08, Rw.02', null, null);
INSERT INTO `sekolah` VALUES ('791', '6', '2', '60714414', 'MIS BAHRUL ULUM GUPPI', 'DS. KEMBANGAN', null, null);
INSERT INTO `sekolah` VALUES ('792', '6', '3', '20584937', 'MTSS NURUL HUDA PULE', 'RT. 06 RW. 03 DUSUN KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('793', '6', null, '20569651', 'SMKS HIDAYATULLOH PULE', 'JL.RAYA TRENGGALEK-PULE KM.22', null, null);
INSERT INTO `sekolah` VALUES ('794', '6', '2', '20542106', 'SD NEGERI 2 KARANGANYAR', 'RT 15 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('795', '6', null, 'T2969404', 'TBM ANUGERAH MANDIRI', '-', null, null);
INSERT INTO `sekolah` VALUES ('796', '6', '1', '20574242', 'TK DHARMA WANITA 1 JOMBOK', 'RT 27 RW 08 DS. JOMBOK KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('797', '6', '2', '20542147', 'SD NEGERI 2 PAKEL', 'RT 15 RW 06', null, null);
INSERT INTO `sekolah` VALUES ('798', '6', '1', '69776837', 'SPS FAJAR BERSINAR', 'JALAN DESA SUKOKIDUL', null, null);
INSERT INTO `sekolah` VALUES ('799', '6', '2', '20541914', 'SD NEGERI 3 PUYUNG', 'RT 13 RW 07 Dusun Ponggok Desa Puyung Kecamatan Pule Kabupaten Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('800', '6', '3', '20542437', 'SMP NEGERI 1 PULE', 'Jln. Watugelang Depok', null, null);
INSERT INTO `sekolah` VALUES ('801', '6', '1', '20574227', 'TK PRINGGODANI SIDOMULYO', 'RT. 23 RW. 09 DESA SIDOMULYO', null, null);
INSERT INTO `sekolah` VALUES ('802', '6', '2', '20542368', 'SD NEGERI 6 PULE', 'RT. 53 RW 26', null, null);
INSERT INTO `sekolah` VALUES ('803', '6', '2', '20542373', 'SD NEGERI 8 PULE', 'Desa Pule', null, null);
INSERT INTO `sekolah` VALUES ('804', '6', null, '20542499', 'SMAN 1 PULE', 'JL. Raya Jombok gang Sidem No. 03', null, null);
INSERT INTO `sekolah` VALUES ('805', '6', null, 'P2964910', 'PKBM ANUGERAH MANDIRI', '-', null, null);
INSERT INTO `sekolah` VALUES ('806', '6', '1', '20574240', 'TK DHARMA WANITA 1 PUYUNG', 'RT 23 RW 12 DS. PUYUNG KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('807', '6', '1', '69912341', 'SPS TIRISAN 3', 'RT. 53 RW. 26', null, null);
INSERT INTO `sekolah` VALUES ('808', '6', '2', '20542365', 'SD NEGERI 6 JOMBOK', 'Jombok', null, null);
INSERT INTO `sekolah` VALUES ('809', '6', '1', '20574231', 'TK PERTIWI JOHO', 'RT 10 RW 03 DS. JOHO KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('810', '6', '3', '20542421', 'SMP ISLAM PULE', 'Jl. PP Hidayatulloh', null, null);
INSERT INTO `sekolah` VALUES ('811', '6', '2', '20542372', 'SD NEGERI 7 PULE', 'RT. 30 RW. 16', null, null);
INSERT INTO `sekolah` VALUES ('812', '6', '2', '20541913', 'SD NEGERI 3 PUYUNG', 'Rt 23 Dusun Sendang', null, null);
INSERT INTO `sekolah` VALUES ('813', '6', '1', '20574230', 'TK DHARMA WANITA 2 JOHO', 'RT 35 RW 10 DS. JOHO KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('814', '6', '2', '60714412', 'MIS MUHAMMADIYAH JOMBOK', 'RT. 14/04 DSN. GADING', null, null);
INSERT INTO `sekolah` VALUES ('815', '6', '2', '60714413', 'MIS BAHRUL ULUM GUPPI', 'RT 09/05 DESA KEMBANGAN', null, null);
INSERT INTO `sekolah` VALUES ('816', '6', '3', '20542426', 'SMP MUHAMMADIYAH 6 PULE', 'Jl. Amd Manunggal XXVIII', null, null);
INSERT INTO `sekolah` VALUES ('817', '6', '1', '20574239', 'TK IDHATA 1 PULE', 'RT 14  RW 07 DS. PULE KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('818', '6', '1', '69777098', 'KB NAWA KARTIKA V', 'RT 56 RW 16', null, null);
INSERT INTO `sekolah` VALUES ('819', '6', '1', '69810625', 'SPS PERMATA KASIH BUNDA', 'PONGGOK RT 23 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('820', '6', '2', '20542233', 'SD NEGERI 3 JOMBOK', 'SIDEM RT 50 RW 14', null, null);
INSERT INTO `sekolah` VALUES ('821', '6', '2', '20542359', 'SD NEGERI 5 PULE', 'RT. 45 RW. 22', null, null);
INSERT INTO `sekolah` VALUES ('822', '6', '1', '69907360', 'KB PESONA 2', 'RT. 37 RW. 16', null, null);
INSERT INTO `sekolah` VALUES ('823', '6', '1', '20574219', 'TK AL HIDAYAH 1 JOMBOK', 'RT 36 RW 10 DS. JOMBOK KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('824', '6', '1', '69777094', 'KB TUNAS HARAPAN', 'Rt 34 RW 14 Desa Sidomulyo Kecamatan Pule Kabupaten Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('825', '6', '1', '20574215', 'TK IDHATA 2 PULE', 'RT 30 RW 16 DS. PULE KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('826', '6', null, '20574246', 'TA Bahrul Ulum GUPPI Kembangan', 'RT 09 RW 05 Ds. Kembangan Kec. Pule', null, null);
INSERT INTO `sekolah` VALUES ('827', '6', '3', '69895125', 'MTsS Hidayatulloh Pule', 'RT. 25/RW.03 Dusun Ponggok', null, null);
INSERT INTO `sekolah` VALUES ('828', '6', '2', '20542021', 'SD NEGERI 1 PULE', 'RT. 01 RW. 01 Desa Pule', null, null);
INSERT INTO `sekolah` VALUES ('829', '6', '1', '20574223', 'TK DHARMA WANITA SUKOKIDUL', 'RT 10 RW 04 DS. SUKOKIDUL KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('830', '6', '1', '20574218', 'TK AL HIDAYAH 5 JOMBOK', 'RT 67 RW 19 ', null, null);
INSERT INTO `sekolah` VALUES ('831', '6', null, '69977806', 'MA HIDAYATULLOH', 'RT. 36 RW. 10 DUSUN BAKALAN DESA JOMBOK KECAMATAN PULE', null, null);
INSERT INTO `sekolah` VALUES ('832', '6', '1', '69778821', 'SPS ANUGERAH MANDIRI', 'SIDOMULYO RT 17 RW 07', null, null);
INSERT INTO `sekolah` VALUES ('833', '6', '1', '69744117', 'RA/BA/TA TA BAHRUL ULUM GUPPI', 'RT 09 RW 05 DUSUN KRAJAN DESA KEMBANGAN PULE TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('834', '6', '1', '69744115', 'RA/BA/TA BA MELATI JOMBOK', 'RT 14 RW 04 DESA JOMBOK', null, null);
INSERT INTO `sekolah` VALUES ('835', '6', '2', '20542186', 'SD NEGERI 2 TANGGARAN', 'Dsn. Ngremang RT. 33 RW. 03', null, null);
INSERT INTO `sekolah` VALUES ('836', '6', '1', '20574224', 'TK DHARMA WANITA 2 TANGGARAN', 'RT 33 RW 03 DS. TANGGARAN KEC. PULE', null, null);
INSERT INTO `sekolah` VALUES ('837', '6', '2', '20542371', 'SD NEGERI 7 JOMBOK', 'RT 68 RW 19', null, null);
INSERT INTO `sekolah` VALUES ('838', '7', '3', '69964408', 'SMP - GLOBAL', 'Jl. Karangan-Tugu No. 40', null, null);
INSERT INTO `sekolah` VALUES ('839', '7', '1', '69744083', 'RA DARUL MUTTAQIN', 'Jl.Budi Utomo Gg Rajek wesi RT 18/RW 01', null, null);
INSERT INTO `sekolah` VALUES ('840', '7', '2', '20542103', 'SD NEGERI 2 KARANGAN', 'RT. 31 / RW. 08 ', null, null);
INSERT INTO `sekolah` VALUES ('841', '7', '1', '20574155', 'TK DHARMA WANITA KAYEN', 'RT 02 RW 01 DS. KAYEN KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('842', '7', '2', '60714377', 'MIS ROUDLATUSY SYARIF', 'Jl.Budi Utomo Gg Rajek wesi RT 18/RW 01', null, null);
INSERT INTO `sekolah` VALUES ('843', '7', null, 'K5660520', 'Primedia Computer Course', ' Rt. 19 RT. 05 Ds. Karangan', null, null);
INSERT INTO `sekolah` VALUES ('844', '7', '1', '20574135', 'TK DHARMA WANITA 2 JATI', 'RT 17 RW 05 DS. JATI KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('845', '7', '1', '20574141', 'TK DHARMA WANITA 1 SUMBERINGIN', 'RT 05 RW 02 DS. SUMBERINGIN KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('846', '7', null, 'P2968546', 'PKBM SAMATURU II', 'JL. MARTANDU ', null, null);
INSERT INTO `sekolah` VALUES ('847', '7', '1', '69777113', 'KB THORIQUL HUDA', 'RT.19 RW.04', null, null);
INSERT INTO `sekolah` VALUES ('848', '7', '2', '60714376', 'MIS MIFTAHUL HUDA', 'RT.08 RW.02 DS. SUMBERINGIN', null, null);
INSERT INTO `sekolah` VALUES ('849', '7', '1', '69777106', 'KB HIMMATANA', 'RT.16 RW.05 ', null, null);
INSERT INTO `sekolah` VALUES ('850', '7', '2', '60714372', 'MIS MUHAMMADIYAH SALAMREJO', 'Dusun Rejosari RT. 007/ RW. 003', null, null);
INSERT INTO `sekolah` VALUES ('851', '7', null, '20542491', 'SMAS HASAN MUNAHIR', 'JL.RAYA KARANGAN-SURUH', null, null);
INSERT INTO `sekolah` VALUES ('852', '7', '2', '20542099', 'SD NEGERI 2 JATIPRAHU', 'Desa Jatiprahu', null, null);
INSERT INTO `sekolah` VALUES ('853', '7', '2', '20542098', 'SD NEGERI 2 JATI', 'Jl.Raya Karangan - Panggul', null, null);
INSERT INTO `sekolah` VALUES ('854', '7', '2', '60714373', 'MIS NGINGAS', 'RT 13 RW 05 SALAMREJO', null, null);
INSERT INTO `sekolah` VALUES ('855', '7', '2', '60714370', 'MIN 2 TRENGGALEK', 'DS. KAYEN KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('856', '7', '1', '20574140', 'TK DHARMA WANITA 3 JATIPRAHU', 'RT 06 RW 01 DS. JATIPRAHU KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('857', '7', '1', '20574150', 'TK DHARMA WANITA 1 BULUAGUNG', 'RT 07 RW 03 DS. BULUAGUNG KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('858', '7', null, '20542497', 'SMAN 1 KARANGAN', 'Jl. Raya Trenggalek - Ponorogo Km. 3', null, null);
INSERT INTO `sekolah` VALUES ('859', '7', '2', '20542180', 'SD NEGERI 2 SUMBERINGIN', 'Jalan Raya Karangan RT. 21 RW.06', null, null);
INSERT INTO `sekolah` VALUES ('860', '7', '1', '20574134', 'TK DHARMA WANITA 1 JATI', 'RT 34 RW 09 DS. JATI KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('861', '7', '1', '69744088', 'RA/BA/TA THORIQUL HUDA', 'RT.10/02 DS. KERJO.KC.KARANGAN.KABUPATEN.TRENGGALEK.66361.JAWA TIMUR', null, null);
INSERT INTO `sekolah` VALUES ('862', '7', '2', '60714375', 'MIS TARBIYATUL BANIN WALBANAT', 'RT.10 RW.02 DESA KEDUNGSIGIT', null, null);
INSERT INTO `sekolah` VALUES ('863', '7', '2', '20542023', 'SD NEGERI 1 SALAMREJO', 'RT. 19 / RW.07', null, null);
INSERT INTO `sekolah` VALUES ('864', '7', null, '20584751', 'MAS PLUS ISTIQOMAH', 'KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('865', '7', '1', '20574151', 'TK DHARMA WANITA 2 BULUAGUNG', 'RT 16 RW 06 DS. BULUAGUNG KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('866', '7', '2', '20584932', 'MTSS MA`ARIF KARANGAN', 'RT. 22/06 JAYAN KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('867', '7', '1', '69777102', 'KB INSAN CENDEKIA', 'RT.30 RW.08 CANGKRING', null, null);
INSERT INTO `sekolah` VALUES ('868', '7', '1', '69776900', 'SPS PERMATA HATI', 'RT.13 RW.05', null, null);
INSERT INTO `sekolah` VALUES ('869', '7', '1', '69744084', 'RA DARUL ULUM', 'RT. 014/ RW. 006 Desa Sukowetan', null, null);
INSERT INTO `sekolah` VALUES ('870', '7', '1', '69744087', 'RA/BA/TA TARBIYATUL BANIN WALBANAT', 'RT. 10 RW. 02 DESA KEDUNGSIGIT.', null, null);
INSERT INTO `sekolah` VALUES ('871', '7', null, 'T2968545', 'TBM AL HIKMAH', '-', null, null);
INSERT INTO `sekolah` VALUES ('872', '7', null, 'T2968544', 'TBM SUMBER ILMU', 'JATI PRAHU KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('873', '7', null, 'K5660506', 'LKP Tatik modes', ' Rt.01/01 Salamrejo  ', null, null);
INSERT INTO `sekolah` VALUES ('874', '7', '3', '20542481', 'SMP MUHAMMADIYAH 5 KARANGAN', 'Rt. 20 Rw. 05', null, null);
INSERT INTO `sekolah` VALUES ('875', '7', '1', '69744085', 'RA/BA/TA MAQOMUL HIDAYAH', 'RT 08 RW 02 DSN NGLONGAH DS SUMBERINGIN', null, null);
INSERT INTO `sekolah` VALUES ('876', '7', '1', '20574136', 'TK DHARMA WANITA 1 SUKOWETAN', 'RT 17 RW 08 DS. SUKOWETAN KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('877', '7', '2', '20542039', 'SD NEGERI 1 SUKOWETAN', 'RT. 17 - RW. 08, Desa Sukowetan', null, null);
INSERT INTO `sekolah` VALUES ('878', '7', '1', '20574146', 'TK DHARMA WANITA 3 KEDUNGSIGIT', 'RT 25 RW 04 DS. KEDUNGSIGIT KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('879', '7', '2', '20542377', 'SD NEGERI KAYEN', 'Kayen', null, null);
INSERT INTO `sekolah` VALUES ('880', '7', '1', '69884945', 'RA. Miftahul Husna', 'Dusun Cetok RT 022/06', null, null);
INSERT INTO `sekolah` VALUES ('881', '7', '1', '20574133', 'TK DHARMA WANITA 3 KARANGAN', 'RT 31 RW 08 DS. KARANGAN KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('882', '7', null, 'P2968545', 'PKBM \"Ki Hajar Dewantara\"', 'Jl. Manggis 13 Perumnas Kamal', null, null);
INSERT INTO `sekolah` VALUES ('883', '7', '1', '20574153', 'TK DHARMA WANITA 2 NGENTRONG', 'RT 08 RW 02 DS. NGENTRONG KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('884', '7', '2', '60714371', 'MIS JAYAN', 'KARANGAN RT. 22 RW.06', null, null);
INSERT INTO `sekolah` VALUES ('885', '7', '1', '69744086', 'RA/BA/TA MIFTAHUL HUDA JATI', 'RT 20 RW 06 DSN. PONGGOK', null, null);
INSERT INTO `sekolah` VALUES ('886', '7', '2', '20542175', 'SD NEGERI 2 SUKOWETAN', 'RT 26 RW 12', null, null);
INSERT INTO `sekolah` VALUES ('887', '7', '2', '20542160', 'SD NEGERI 2 SALAMREJO', 'Desa Salamrejo', null, null);
INSERT INTO `sekolah` VALUES ('888', '7', '1', '69744082', 'RA/BA/TA AWALLUL HUDA', 'RT.02 RW.01 DS. KAYEN KEC. KARANGAN KAB. TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('889', '7', '1', '69779947', 'KB MIFTAHUL MUSLIM', 'RT.35 RW.09 DESA. JATI', null, null);
INSERT INTO `sekolah` VALUES ('890', '7', '1', '20574131', 'TK DHARMA WANITA 1 KARANGAN', 'RT 19 RW 05 DS. KARANGAN KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('891', '7', '2', '20541978', 'SD NEGERI 1 KERJO', 'Desa Kerjo', null, null);
INSERT INTO `sekolah` VALUES ('892', '7', '2', '20541961', 'SD NEGERI 1 JATIPRAHU', 'Desa Jatiprahu', null, null);
INSERT INTO `sekolah` VALUES ('893', '7', '1', '69810627', 'KB PERINTIS', 'JL. KARANGAN - TUGU NO 40', null, null);
INSERT INTO `sekolah` VALUES ('894', '7', '2', '20541965', 'SD NEGERI 1 KARANGAN', 'Jl. Raya Karangan - Panggul', null, null);
INSERT INTO `sekolah` VALUES ('895', '7', '2', '20542079', 'SD NEGERI 2 BULUAGUNG', 'Dsn Buret', null, null);
INSERT INTO `sekolah` VALUES ('896', '7', '2', '60714378', 'MIS DARUL ULUM', 'RT.18 RW.08 DS. SUKOWETAN', null, null);
INSERT INTO `sekolah` VALUES ('897', '7', '1', '20574144', 'TK DHARMA WANITA 1 KEDUNGSIGIT', 'RT 08 RW 02 DS. KEDUNGSIGIT KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('898', '7', '2', '20542235', 'SD NEGERI 3 KARANGAN', 'DUSUN CETOK RT 19 RW 05', null, null);
INSERT INTO `sekolah` VALUES ('899', '7', null, '69744080', 'BA AISYIYAH SALAMREJO', 'Dusun Rejosari RT. 002 / RW. 001 ', null, null);
INSERT INTO `sekolah` VALUES ('900', '7', '3', '20542448', 'SMP NEGERI 2 KARANGAN', 'Jl. Raya Buluagung', null, null);
INSERT INTO `sekolah` VALUES ('901', '7', '2', '20541992', 'SD NEGERI 1 NGENTRONG', 'RT. 15 / RW. 03', null, null);
INSERT INTO `sekolah` VALUES ('902', '7', '2', '20542281', 'SD NEGERI 3 SUMBERINGIN', 'RT. 21 / RW. 06', null, null);
INSERT INTO `sekolah` VALUES ('903', '7', '2', '20541941', 'SD NEGERI 1 BULUAGUNG', 'Jl. Raya Ponorogo Km 3', null, null);
INSERT INTO `sekolah` VALUES ('904', '7', '3', '20542469', 'SMP PERSATUAN KARANGAN', 'Jalan Ngelo 1/2 Karangan', null, null);
INSERT INTO `sekolah` VALUES ('905', '7', '2', '20542231', 'SD NEGERI 3 JATIPRAHU', 'RT.06- RW.01, Dukuh Krajan', null, null);
INSERT INTO `sekolah` VALUES ('906', '7', '3', '20542416', 'SMP HASAN MUNAHIR', 'Rt 08 Rw 02', null, null);
INSERT INTO `sekolah` VALUES ('907', '7', '3', '20542433', 'SMP NEGERI 1 KARANGAN', 'Jl. Raya Karangan', null, null);
INSERT INTO `sekolah` VALUES ('908', '7', '1', '69744081', 'RA/BA/TA AL HIDAYAH', 'RT 25 RW 09 SALAMREJO KEC. KARANGAN KAB. TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('909', '7', '1', '20574152', 'TK DHARMA WANITA 1 NGENTRONG', 'RT 15 RW 03 DS. NGENTRONG KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('910', '7', '1', '69777109', 'KB CAHAYA INSAN', 'RT 04 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('911', '7', '1', '20574165', 'TK AL HIDAYAH 6 KARANGAN', 'RT 22 RW 06 DS. KARANGAN KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('912', '7', '2', '20541975', 'SD NEGERI 1 KEDUNGSIGIT', 'RT 25 / RW 4 Kedungwaru', null, null);
INSERT INTO `sekolah` VALUES ('913', '7', '1', '20574138', 'TK DHARMA WANITA 1 JATIPRAHU', 'RT 28 RW 05 DS. JATIPRAHU KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('914', '7', null, 'T2968546', 'TBM MUTIARA ILMU', '-', null, null);
INSERT INTO `sekolah` VALUES ('915', '7', '1', '20574154', 'TK DHARMA WANITA SUMBER', 'RT 03 RW 01 DS. SUMBER KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('916', '7', '2', '20542114', 'SD NEGERI 2 KEDUNGSIGIT', 'Desa Kedungsigit', null, null);
INSERT INTO `sekolah` VALUES ('917', '7', '1', '20574148', 'TK DHARMA WANITA 2 SALAMREJO', 'RT 09 RW 03 DS. SALAMREJO KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('918', '7', '2', '20542242', 'SD NEGERI 3 KEDUNGSIGIT', 'Jl. Raya Trenggalek - Panggul Km.05', null, null);
INSERT INTO `sekolah` VALUES ('919', '7', null, 'P2964909', 'PKBM PERINTIS', 'JL.RAYA KARANGAN TUGU TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('920', '7', '2', '20542133', 'SD NEGERI 2 NGENTRONG', 'RT. 08 / RW. 02', null, null);
INSERT INTO `sekolah` VALUES ('921', '7', '1', '69776901', 'SPS AL KAUTSAR', 'RT.14 RW.04', null, null);
INSERT INTO `sekolah` VALUES ('922', '7', '1', '69776898', 'KB NAWA KARTIKA 4', 'RT 13 RW 05', null, null);
INSERT INTO `sekolah` VALUES ('923', '7', '1', '20574143', 'TK DHARMA WANITA 3 SUMBERINGIN', 'RT 21 RW 06 DS. SUMBERINGIN KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('924', '7', '1', '20574149', 'TK DHARMA WANITA KERJO', 'RT 03 RW 01 DS. KERJO KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('925', '7', '1', '20574139', 'TK DHARMA WANITA 2 JATIPRAHU', 'RT 14 RW 06 DS. JATIPRAHU KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('926', '7', null, '20584750', 'MAS PLUS AL ISTIQOMAH', 'JL. NGELO 1 / 2 KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('927', '7', '2', '20541908', 'SD CREATIVE', 'Jl. Raya Karangan Tugu No. 40 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('928', '7', null, '20542518', 'SMK PERSATUAN KARANGAN', 'JL. NGELO 1/2 KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('929', '7', '1', '20574145', 'TK DHARMA WANITA 2 KEDUNGSIGIT', 'RT 21 RW 04 DS. KEDUNGSIGIT KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('930', '7', '1', '69777100', 'KB DARUL ULUM', 'RT 14 RW 06', null, null);
INSERT INTO `sekolah` VALUES ('931', '7', '1', '20574147', 'TK DHARMA WANITA 1 SALAMREJO', 'RT 19 RW 07 DS. SALAMREJO KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('932', '7', '2', '60714379', 'MIS MIFTAHUL HUDA JATI', 'RT.20 / RW.06 DS. JATI KEC KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('933', '7', '1', '69777101', 'KB AISYIYAH', 'RT 02 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('934', '7', '1', '20541960', 'SD NEGERI 1 JATI', 'RT 34 RW 9', null, null);
INSERT INTO `sekolah` VALUES ('935', '7', '1', '20542117', 'SD NEGERI 2 KERJO', 'Dsn. Krajan', null, null);
INSERT INTO `sekolah` VALUES ('936', '7', '1', '20574132', 'TK DHARMA WANITA 2 KARANGAN', 'RT 14 RW 04 DS. KARANGAN KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('937', '7', '2', '60714374', 'MIS THORIQUL HUDA', 'Dsn. Krandon RT.10/02 Desa Kerjo', null, null);
INSERT INTO `sekolah` VALUES ('938', '7', null, '20542502', 'SMAN 2 KARANGAN', 'JL PALM RAJA  1', null, null);
INSERT INTO `sekolah` VALUES ('939', '7', '3', '20542459', 'SMP NEGERI 3 KARANGAN', 'RT/RW 13/06 Desa Sukowetan, Karangan', null, null);
INSERT INTO `sekolah` VALUES ('940', '7', '2', '60714380', 'MIS TARBIYATUL BANIN WAL BANAT', 'DS. KEDUNG SIGIT', null, null);
INSERT INTO `sekolah` VALUES ('941', '7', '1', '20574142', 'TK DHARMA WANITA 2 SUMBERINGIN', 'RT 21 RW 06 DS. SUMBERINGIN KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('942', '7', '2', '20542390', 'SD NEGERI SUMBER', 'RT. 03 / RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('943', '7', '2', '20542045', 'SD NEGERI 1 SUMBERINGIN', 'RT 05 / RW 02', null, null);
INSERT INTO `sekolah` VALUES ('944', '7', '1', '20574137', 'TK DHARMA WANITA 2 SUKOWETAN', 'RT 26 RW 12 DS. SUKOWETAN KEC. KARANGAN', null, null);
INSERT INTO `sekolah` VALUES ('945', '8', '2', '20542003', 'SD NEGERI 1 NGRAYUNG', 'RT 11 RW 05', null, null);
INSERT INTO `sekolah` VALUES ('946', '8', '1', '69777124', 'KB AL AZHAAR', 'RT 13 RW 07', null, null);
INSERT INTO `sekolah` VALUES ('947', '8', '1', '69744064', 'RA/BA/TA HIDAYATUL MUBTADIIN', 'RT :15 RW : 07 NGELO', null, null);
INSERT INTO `sekolah` VALUES ('948', '8', '1', '20573628', 'TK DHARMA WANITA 2 NGRAYUNG', 'RT. 08 RW. 04 DS. NGRAYUNG ', null, null);
INSERT INTO `sekolah` VALUES ('949', '8', '1', '20573626', 'TK DHARMA WANITA 1 JAJAR', 'DS. JAJAR KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('950', '8', '1', '69744062', 'RA/BA/TA BA AISIYAH SUKOREJO', 'RT 33 RW 16  DS. SUKOREJO', null, null);
INSERT INTO `sekolah` VALUES ('951', '8', '1', '20573653', 'TK ISLAM TERPADU NUURUL FIKRI SUKOREJO', 'RT 29 RW 14 DS. SUKOREJO KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('952', '8', null, 'T2968249', 'TBM NUURUL FIKRI', '-', null, null);
INSERT INTO `sekolah` VALUES ('953', '8', '3', '20542431', 'SMP NEGERI 1 GANDUSARI', 'Jalan Raya Gandusari - Kampak', null, null);
INSERT INTO `sekolah` VALUES ('954', '8', '1', '69744072', 'RA/BA/TA INGANATUL MUSLIMIN', 'RT 20 RW 09 DESA NGRAYUNG', null, null);
INSERT INTO `sekolah` VALUES ('955', '8', '2', '20542037', 'SD NEGERI 1 SUKOREJO', 'Jln. RA Kartini  Nomor  1', null, null);
INSERT INTO `sekolah` VALUES ('956', '8', '2', '20542061', 'SD NEGERI 1 WIDORO', 'RT. 09 RW. 04 Dusun Krajankulon', null, null);
INSERT INTO `sekolah` VALUES ('957', '8', '1', '20573621', 'TK DHARMA WANITA 3 SUKOREJO', 'RT 30 RW 14 DS. SUKOREJO KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('958', '8', '2', '20542141', 'SD NEGERI 2 NGRAYUNG', 'RT 21 RW 10', null, null);
INSERT INTO `sekolah` VALUES ('959', '8', null, 'P2964891', 'PKBM DARUL FALAH', 'DUSUN MELIS', null, null);
INSERT INTO `sekolah` VALUES ('960', '8', '2', '60714363', 'MIS AL HIKMAH MELIS', 'RT. 05 RW. 02 MELIS', null, null);
INSERT INTO `sekolah` VALUES ('961', '8', '1', '20573637', 'TK DHARMA WANITA 1 KARANGANYAR', 'DS. KARANGANYAR KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('962', '8', '3', '20542446', 'SMP NEGERI 2 GANDUSARI', 'Dsn. Krajan Wetan RT. 02 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('963', '8', '2', '20542379', 'SD NEGERI KRANDEGAN', 'RT 09  RW 04', null, null);
INSERT INTO `sekolah` VALUES ('964', '8', '2', '20541955', 'SD NEGERI 1 GANDUSARI', 'Jl.Raya Gandusari Kedunglurah no 38', null, null);
INSERT INTO `sekolah` VALUES ('965', '8', '1', '20573639', 'TK DHARMA WANITA 1 WIDORO', 'DS. WIDORO KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('966', '8', '2', '20542105', 'SD NEGERI 2 KARANGANYAR', 'RT 08  RW 03  Ds.Karanganyar', null, null);
INSERT INTO `sekolah` VALUES ('967', '8', '1', '20573625', 'TK DHARMA WANITA 2 JAJAR', 'RT 17 RW 05 DK. BELIK DS. JAJAR KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('968', '8', '1', '20573623', 'TK DHARMA WANITA 2 WONOREJO', 'DS. WONOREJO KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('969', '8', '1', '69744068', 'RA/BA/TA AL HIKMAH GUMELAR', 'RT.51 RW. 16 DUSUN GUMELAR', null, null);
INSERT INTO `sekolah` VALUES ('970', '8', '1', '20573656', 'TK PKK WONOANTI', 'DS. WONOANTI KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('971', '8', '1', '20573620', 'TK DHARMA WANITA 4 SUKOREJO', 'DS. SUKOREJO KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('972', '8', '2', '20542036', 'SD NEGERI 1 SUKORAME', 'RT. 10  RW. 05 Sukorame', null, null);
INSERT INTO `sekolah` VALUES ('973', '8', '2', '60714352', 'MIS MUHAMMADIYAH GANDUSARI', 'RT 05 RW 02  DS. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('974', '8', '2', '60714359', 'MIS INGANATUL MUSLIMIN', 'RT 20 RW 09 DESA NGRAYUNG', null, null);
INSERT INTO `sekolah` VALUES ('975', '8', '2', '60714356', 'MIS NURUL HUDA BANDUNG', 'RT.10 RW.05 BANDUNG DESA SUKOREJO, KECAMATAN GANDUSARI KABUPATEN TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('976', '8', '2', '60714366', 'MIS HIDAYATUL MUBTADIIN', 'RT.15 / RW.7 DS. SUKORAME', null, null);
INSERT INTO `sekolah` VALUES ('977', '8', '2', '20542201', 'SD NEGERI 2 WONOREJO', 'RT. 11 RW. 03 Desa Wonorejo', null, null);
INSERT INTO `sekolah` VALUES ('978', '8', '1', '69878179', 'SPS AZ-ZAHRO 1', 'RT. 56 RW. 26 Ds. Sukorejo', null, null);
INSERT INTO `sekolah` VALUES ('979', '8', null, 'P2968247', 'PKBM RADEN INTAN', 'Jl. Poros Karya Bhakti', null, null);
INSERT INTO `sekolah` VALUES ('980', '8', '2', '20542380', 'SD NEGERI MELIS', 'RT 14 RW 07', null, null);
INSERT INTO `sekolah` VALUES ('981', '8', '2', '60714355', 'MIS HASYIM ASYARI', 'DSN. KEDEKAN RT 09 RW 04', null, null);
INSERT INTO `sekolah` VALUES ('982', '8', '1', '20573619', 'TK DHARMA WANITA 5 SUKOREJO', 'DS. SUKOREJO KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('983', '8', '2', '60714365', 'MIS NURUZH ZHOLAM', 'RT 18 RW 09 DS KRANDEGAN', null, null);
INSERT INTO `sekolah` VALUES ('984', '8', '1', '20573616', 'TK DHARMA WANITA 3 GANDUSARI', 'DS. GANDUSARI KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('985', '8', '2', '20541919', 'SDIT AL AZHAAR SUKOREJO', 'RT 19 RW 09', null, null);
INSERT INTO `sekolah` VALUES ('986', '8', '1', '20573627', 'TK DHARMA WANITA 3 NGRAYUNG', 'DS. NGRAYUNG KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('987', '8', '2', '60729490', 'MIS MI PLUS SUNAN KALIJAGA', 'RT. 07 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('988', '8', null, 'T2968248', 'TBM AL AZHAR', '-', null, null);
INSERT INTO `sekolah` VALUES ('989', '8', '1', '20573617', 'TK DHARMA WANITA 4 GANDUSARI', 'DS. GANDUSARI KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('990', '8', '2', '20542307', 'SD NEGERI 4 GANDUSARI', 'RT 49 RW 15', null, null);
INSERT INTO `sekolah` VALUES ('991', '8', '1', '69776905', 'SPS TSAMROTUL HIDAYAH', 'RT.    RW .', null, null);
INSERT INTO `sekolah` VALUES ('992', '8', '2', '20542277', 'SD NEGERI 3 SUKOREJO', 'RT. 30 RW. 14', null, null);
INSERT INTO `sekolah` VALUES ('993', '8', '2', '20541958', 'SD NEGERI 1 JAJAR', 'RT.14 RW.04 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('994', '8', '1', '69780865', 'DHARMA WANITA MELIS', 'MELIS', null, null);
INSERT INTO `sekolah` VALUES ('995', '8', '1', '20573618', 'TK DHARMA WANITA 1 WONOANTI', 'DS. WONOANTI KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('996', '8', '1', '20573634', 'TK DHARMA WANITA KRANDEGAN', 'DS. KRANDEGAN KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('997', '8', '1', '69744069', 'RA/BA/TA AL HIKMAH MELIS', 'RT.05 RW.02 DS. MELIS', null, null);
INSERT INTO `sekolah` VALUES ('998', '8', '1', '69744076', 'RA HIMMATUL ULUM', 'RT. 42. RW. 20 DSn. NGLAYUR DESA SUKoREJO', null, null);
INSERT INTO `sekolah` VALUES ('999', '8', '1', '20573631', 'TK DHARMA WANITA 3 SUKORAME', 'RT 10 RW 05 DS. SUKORAME KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('1000', '8', '2', '20542276', 'SD NEGERI 2 SUKORAME', 'RT.16, RW. 08 /Jln.Raya Kedunglurah Gandusari', null, null);
INSERT INTO `sekolah` VALUES ('1001', '8', '1', '20573615', 'TK DHARMA WANITA 2 GANDUSARI', 'RT 44 RW 14 DS. GANDUSARI KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('1002', '8', '2', '60714364', 'MIS KRANDEGAN 1', 'RT.05 RW.03 KRANDEGAN', null, null);
INSERT INTO `sekolah` VALUES ('1003', '8', '1', '69918463', 'SPS TUNAS BANGSA ', 'RT. 22 RW. 09', null, null);
INSERT INTO `sekolah` VALUES ('1004', '8', '1', '20573635', 'TK DHARMA WANITA MELIS', 'DS. MELIS KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('1005', '8', '2', '20542329', 'SD NEGERI 3 SUKORAME', 'Desa Sukorame', null, null);
INSERT INTO `sekolah` VALUES ('1006', '8', '1', '69744065', 'RA MIFTAHUL HUDA KRANDEGAN 1', 'RT.05 RW.03 Krandegan Kec.Gandusari Kab. Trenggalek Jawa Timur 66372', null, null);
INSERT INTO `sekolah` VALUES ('1007', '8', '2', '60714357', 'MIS HIDAYATUL MUBTADIIN', 'RT.22 / RW.11 DESA SUKOREJO KEC. GANDUSARI KAB. TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1008', '8', null, 'K5660525', 'LKP AL Amanah ', 'RT. 011 RW. 05 Ds. Melis ', null, null);
INSERT INTO `sekolah` VALUES ('1009', '8', '1', '69744063', 'RA/BA/TA BA. AISYIYAH GANDUSARI', 'RT 05 RW 02 DS/KEC.GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('1010', '8', '1', '20573638', 'TK DHARMA WANITA 2 WIDORO', 'DS. WIDORO KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('1011', '8', '2', '20542096', 'SD NEGERI 2 JAJAR', 'RT 17 RW 5  Dusun Belik  SD. Kecil', null, null);
INSERT INTO `sekolah` VALUES ('1012', '8', '1', '69744067', 'RA/BA/TA AL HIDAYAH', 'RT 16 RW 05 DS. WONOREJO KEC. GANDUSARI KAB. TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1013', '8', '1', '20573633', 'TK DHARMA WANITA 1 SUKORAME', 'DS. SUKORAME KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('1014', '8', null, 'T2968252', 'TBM DARUL FALAH', '-', null, null);
INSERT INTO `sekolah` VALUES ('1015', '8', '2', '60714353', 'MIS GUMELAR GANDUSARI', 'RT. 51 RW. 16 DSN. GUMELAR', null, null);
INSERT INTO `sekolah` VALUES ('1016', '8', '1', '69777126', 'KB NUURUL FIKRI', 'SUKOREJO', null, null);
INSERT INTO `sekolah` VALUES ('1017', '8', '2', '20542173', 'SD NEGERI 2 SUKOREJO', 'Desa Sukorejo', null, null);
INSERT INTO `sekolah` VALUES ('1018', '8', '1', '69876667', 'KB AZ-ZAHRO 2', 'JL. GANDUSARI - KAMPAK', null, null);
INSERT INTO `sekolah` VALUES ('1019', '8', '1', '20573629', 'TK DHARMA WANITA 1 NGRAYUNG', 'DS. NGRAYUNG KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('1020', '8', '2', '20542260', 'SD NEGERI 3 NGRAYUNG', 'Ngrayung', null, null);
INSERT INTO `sekolah` VALUES ('1021', '8', '1', '69776907', 'SPS QUEEN', 'RT 03 RW 02', null, null);
INSERT INTO `sekolah` VALUES ('1022', '8', '2', '60714362', 'MIS AL HUDA', 'RT.15 RW.05 SOKO TENGAH', null, null);
INSERT INTO `sekolah` VALUES ('1023', '8', '1', '69744066', 'RA/BA/TA NURUL HUDA SUKOREJO', 'RT.10 RW.05 BANDUNG', null, null);
INSERT INTO `sekolah` VALUES ('1024', '8', '1', '69906752', 'KB MIJI RAHAYU', 'RT. 11 RW. 05', null, null);
INSERT INTO `sekolah` VALUES ('1025', '8', '2', '20541967', 'SD NEGERI 1 KARANGANYAR', 'RT.06 RW.02 Dsn. Jedung Kec. Gandusari Kab. Trenggalek Prov. Jawa Timur', null, null);
INSERT INTO `sekolah` VALUES ('1026', '8', null, 'T2968247', 'TBM AZ ZAHRO` II', '-', null, null);
INSERT INTO `sekolah` VALUES ('1027', '8', null, 'K9980871', 'LKP AJIJAYA EDUCATION', 'RT. 04 RW. 02', null, null);
INSERT INTO `sekolah` VALUES ('1028', '8', '2', '20542330', 'SD NEGERI 4 SUKOREJO', 'Dusun Nglayur RT. 42 RW.20', null, null);
INSERT INTO `sekolah` VALUES ('1029', '8', '1', '69780856', 'KB DARUL FALAH', 'RT. 003 RW. 001 DSN. MELIS', null, null);
INSERT INTO `sekolah` VALUES ('1030', '8', '2', '60714354', 'MIS MUHAMMADIYAH SUKOREJO', 'RT33 RW 16 DUSUN TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1031', '8', '2', '60714360', 'MIS JAJAR', 'DSN.KRAJAN RT 21 RW 04', null, null);
INSERT INTO `sekolah` VALUES ('1032', '8', null, 'P2964892', 'PKBM SUBULUS SALAM', 'DUSUN GEBANG', null, null);
INSERT INTO `sekolah` VALUES ('1033', '8', '1', '69777121', 'SUBULUS SALAM', 'MELIS', null, null);
INSERT INTO `sekolah` VALUES ('1034', '8', '3', '20542480', 'SMP ISLAM TERPADU AL AZHAAR', 'Rt.19 Rw.09', null, null);
INSERT INTO `sekolah` VALUES ('1035', '8', '2', '20542066', 'SD NEGERI 1 WONOREJO', 'Jl. Raya Jrsn. Gandusari-kampak', null, null);
INSERT INTO `sekolah` VALUES ('1036', '8', '1', '20573640', 'TK DHARMA WANITA 2 WONOANTI', 'DS. WONOANTI KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('1037', '8', null, '69728749', 'SMK - IT NURUL FIKRI', 'DESA SUKOREJO RT. 29 RW. 14', null, null);
INSERT INTO `sekolah` VALUES ('1038', '8', '2', '20542063', 'SD NEGERI 1 WONOANTI', 'RT 01 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('1039', '8', '1', '69744075', 'RA/BA/TA NURUZH ZHOLAM', 'RT 18 RW 09 DS. KRANDEGAN', null, null);
INSERT INTO `sekolah` VALUES ('1040', '8', '1', '20573630', 'TK DHARMA WANITA 4 SUKORAME', 'DS. SUKORAME KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('1041', '8', '1', '20573654', 'TK ISLAM TERPADU AL-AZHAR SUKOREJO', 'RT 13 RW 07 DS. SUKOREJO KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('1042', '8', '1', '20573622', 'TK DHARMA WANITA 1 SUKOREJO', 'DS. SUKOREJO KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('1043', '8', '2', '20542198', 'SD NEGERI 2 WONOANTI', 'Wonoanti', null, null);
INSERT INTO `sekolah` VALUES ('1044', '8', '1', '20573636', 'TK DHARMA WANITA 2 KARANGANYAR', 'DS. KARANGANYAR KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('1045', '8', null, '20584755', 'MAS TERPADU AL FALAH', 'RT 14 RW 05 DESA WONOANTI KECAMATAN GANDUSARI KABUPATEN TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1046', '8', '2', '20542296', 'SD NEGERI 3 WONOANTI', 'RT 23 RW 09', null, null);
INSERT INTO `sekolah` VALUES ('1047', '8', '2', '20573041', 'SDI FAJAR INSANI', 'Dusun Dawuhan', null, null);
INSERT INTO `sekolah` VALUES ('1048', '8', '1', '69777129', 'KB FAJAR INSANI', 'RT 02 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('1049', '8', '1', '69744070', 'RA/BA/TA HASYIM ASYARI', 'RT 09 RW 04 DSN.KEDEKAN DS.WONOANTI', null, null);
INSERT INTO `sekolah` VALUES ('1050', '8', '2', '60714358', 'MIS HIMMATUL ULUM', 'DSN. NGLAYUR, RT.42, RW.20', null, null);
INSERT INTO `sekolah` VALUES ('1051', '8', '2', '20541920', 'SDIT NUURUL FIKRI SUKOREJO', 'RT 29 RW 14 Ds. Sukorejo', null, null);
INSERT INTO `sekolah` VALUES ('1052', '8', '2', '60714361', 'MIS MIFTAHUL HUDA', 'RT 16 RW 05 DS. WONOREJO', null, null);
INSERT INTO `sekolah` VALUES ('1053', '8', '1', '69777128', 'KB ALIEF KUSUMA', 'RT 06 RW 03 DUSUN KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('1054', '8', '1', '69744074', 'RA/BA/TA MIFTAHUL HUDA', 'RT.15 RW. 05 SOKO TENGAH', null, null);
INSERT INTO `sekolah` VALUES ('1055', '8', null, 'T2968250', 'TBM CAHAYA ILMU', '-', null, null);
INSERT INTO `sekolah` VALUES ('1056', '8', '1', '69744073', 'RA/BA/TA KARANG', 'JL GANDUSARI WATULIMO RT 02 RW 01 DESA JAJAR', null, null);
INSERT INTO `sekolah` VALUES ('1057', '8', null, 'T2968251', 'TBM SUBULUS SALAM', '-', null, null);
INSERT INTO `sekolah` VALUES ('1058', '8', '2', '20542217', 'SD NEGERI 3 GANDUSARI', 'RT 44 RW 14 Dsn.Pundensari', null, null);
INSERT INTO `sekolah` VALUES ('1059', '8', '2', '20542093', 'SD NEGERI 2 GANDUSARI', 'Dusun Karangrejo', null, null);
INSERT INTO `sekolah` VALUES ('1060', '8', '1', '20573624', 'TK DHARMA WANITA 1 WONOREJO', 'DS. WONOREJO KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('1061', '8', '1', '69744071', 'RA/BA/TA HIDAYATUL MUBTADIIN', 'RT.22 RW.11 DS. SUKOREJO', null, null);
INSERT INTO `sekolah` VALUES ('1062', '8', '1', '20573614', 'TK DHARMA WANITA 1 GANDUSARI', 'RT 21 RW 07 JATIREJO KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('1063', '8', null, '20574799', 'SMKS BUDI UTOMO', 'JL. GANDUSARI- KEDUNGLURAH', null, null);
INSERT INTO `sekolah` VALUES ('1064', '8', null, 'P2968252', 'Matahari Terbit', 'JL Aries 3 No 18', null, null);
INSERT INTO `sekolah` VALUES ('1065', '8', '2', '20584930', 'MTSS MUHAMMADIYAH 2 GANDUSARI', 'JALAN GANDUSARI-KEDUNGLURAH', null, null);
INSERT INTO `sekolah` VALUES ('1066', '8', null, '69988779', 'SMK SULAIMAN TRENGGALEK', 'Jl. Pondok Pesantren Sulaiman', null, null);
INSERT INTO `sekolah` VALUES ('1067', '8', '1', '69780864', 'DHARMA WANITA 1 JAJAR', 'RT 14 RW 04', null, null);
INSERT INTO `sekolah` VALUES ('1068', '8', '1', '69776911', 'SPS TUNAS BANGSA', 'RT. 14 RW. 04', null, null);
INSERT INTO `sekolah` VALUES ('1069', '8', '3', '20542418', 'SMP ISLAM GANDUSARI', 'Jl. Raya Melis Gandusari', null, null);
INSERT INTO `sekolah` VALUES ('1070', '8', '2', '20542295', 'SD NEGERI 3 WIDORO', 'Bukit Dusun Banyon', null, null);
INSERT INTO `sekolah` VALUES ('1071', '8', '2', '20542196', 'SD NEGERI 2 WIDORO', 'Tambakboyo', null, null);
INSERT INTO `sekolah` VALUES ('1072', '8', '3', '20542422', 'SMP ISLAM TERPADU NUURUL FIKRI', 'Dusun Tugu Rt 29 Rw 14', null, null);
INSERT INTO `sekolah` VALUES ('1073', '8', null, 'P2968251', 'PKBM PADAIDI', 'DUSUN ATTIRONGE', null, null);
INSERT INTO `sekolah` VALUES ('1074', '8', '1', '20573632', 'TK DHARMA WANITA 2 SUKORAME', 'DS. SUKORAME KEC. GANDUSARI', null, null);
INSERT INTO `sekolah` VALUES ('1075', '9', '2', '20542091', 'SD NEGERI 2 GADOR', 'RT.11 RW.03', null, null);
INSERT INTO `sekolah` VALUES ('1076', '9', '1', '20574081', 'TK DHARMA WANITA KARANGANOM', 'RT. 09 RW. 02 DS. KARANGANOM KEC. DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1077', '9', null, '69776914', 'ULIL ALBAB', 'RT 07 RW 04', null, null);
INSERT INTO `sekolah` VALUES ('1078', '9', '1', '20574071', 'TK DHARMA WANITA 2 SUMBEREJO', 'RT 14 RW 03 DS. SUMBEREJO KEC. DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1079', '9', '1', '20574083', 'TK DHARMA WANITA 1 DURENAN', 'Jl. Lapangan Durenan No. 40 RT. 06 RW. 03', null, null);
INSERT INTO `sekolah` VALUES ('1080', '9', '3', '20516435', 'SMPLBS DURENAN', 'DS. PANGGUNGSARI', null, null);
INSERT INTO `sekolah` VALUES ('1081', '9', '2', '20542104', 'SD NEGERI 2 KARANGANOM', 'Karanganom', null, null);
INSERT INTO `sekolah` VALUES ('1082', '9', '1', '20574076', 'TK DHARMA WANITA PANGGUNGSARI', 'RT. 05 RW. 02 DS. PANGGUNGSARI KEC. DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1083', '9', null, '69983515', 'MAS AL KAUTSAR', 'JL. DESA DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1084', '9', '2', '20542384', 'SD NEGERI PAKIS', 'Jalan Perempatan Sumberagung-Pakis', null, null);
INSERT INTO `sekolah` VALUES ('1085', '9', '2', '20541964', 'SD NEGERI 1 KAMULAN', 'Desa Kamulan', null, null);
INSERT INTO `sekolah` VALUES ('1086', '9', '2', '60714347', 'MIS WAJIB BELAJAR HIDAYATUT THULLAB', 'JL. Pondok Tengah NO. 01 RT.22 RW.04 Kamulan Durenan Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1087', '9', null, '20542510', 'SMK ISLAM 2 DURENAN', 'JL. RAYA KENDALREJO DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1088', '9', null, '69947030', 'SMK TERPADU ASSALAM DURENAN', 'Jl. Raya Karangrejo-Sumbergayam Durenan', null, null);
INSERT INTO `sekolah` VALUES ('1089', '9', '1', '69776912', 'KB DHARMA WANITA', 'RT 08 RW 04', null, null);
INSERT INTO `sekolah` VALUES ('1090', '9', null, 'P2964906', 'PKBM HIDAYATUT THULLAB', 'RT.022, RW.04 Kamulan Durenan Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1091', '9', '1', '69744060', 'RA NURUL ULUM KENDALREJO', 'Dusun Randu RT 10 RW 04 Kendalrejo', null, null);
INSERT INTO `sekolah` VALUES ('1092', '9', '1', '20574086', 'TK DHARMA WANITA 1 NGADISUKO', 'RT. 13 RW. 05 DS. NGADISUKO KEC. DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1093', '9', '2', '20542253', 'SD NEGERI 3 NGADISUKO', 'Jl. Raya Kendalrejo No.52', null, null);
INSERT INTO `sekolah` VALUES ('1094', '9', '2', '20542070', 'SD NEGERI 2 BARUHARJO', 'Dusun. Baruklinting  RT. 07  RW. 02', null, null);
INSERT INTO `sekolah` VALUES ('1095', '9', '2', '60714351', 'MIS NURUL ULUM KENDALREJO', 'DUSUN RANDU RT. 11 RW. 05 ', null, null);
INSERT INTO `sekolah` VALUES ('1096', '9', '1', '20574084', 'TK DHARMA WANITA 2 DURENAN', 'RT 08 RW 04 DS. DURENAN KEC. DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1097', '9', '1', '69882279', 'KB AISIYAH', 'JL. MIM KAMULAN RT 06 RW 02', null, null);
INSERT INTO `sekolah` VALUES ('1098', '9', null, '69774783', 'SMK BRAWIJAYA DURENAN', 'Jl. Lapangan Durenan Nomor 01  ', null, null);
INSERT INTO `sekolah` VALUES ('1099', '9', '1', '20574068', 'TK DHARMA WANITA 1 GADOR', 'RT 06 RW 01 DS. GADOR KEC. DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1100', '9', '2', '20554107', 'SD ISLAM BABUSSALAM', 'Jl. Kota Baru No. 03 Pandean Durenan Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1101', '9', '1', '69744059', 'RA NURUL IMAN GADOR', 'Jl. Pingit Rt.16 Rw.04', null, null);
INSERT INTO `sekolah` VALUES ('1102', '9', null, '20574093', 'Bustanul Athfal Aisyiyah Kamulan', 'RT 06 RW 02 Ds. Kamulan Kec. Durenan', null, null);
INSERT INTO `sekolah` VALUES ('1103', '9', '1', '69780534', 'DHARMA WANITA 2 KAMULAN', 'RT.      RW.', null, null);
INSERT INTO `sekolah` VALUES ('1104', '9', '2', '20541980', 'SD NEGERI 1 MALASAN', 'Dusun Compok, RT. 18/ RW. 05', null, null);
INSERT INTO `sekolah` VALUES ('1105', '9', '2', '20542387', 'SD NEGERI SEMARUM', 'Desa Semarum', null, null);
INSERT INTO `sekolah` VALUES ('1106', '9', '1', '69778913', 'KB MUTIARA UMMAT', 'RT. 24 RW. 07', null, null);
INSERT INTO `sekolah` VALUES ('1107', '9', null, '20566377', 'SMK GIRI ARUM KUSUMA', 'JL. RAYA MASJID JOGLO', null, null);
INSERT INTO `sekolah` VALUES ('1108', '9', '2', '20542119', 'SD NEGERI 2 MALASAN', 'Dusun Nglandean', null, null);
INSERT INTO `sekolah` VALUES ('1109', '9', '2', '20541989', 'SD NEGERI 1 NGADISUKO', 'RT. 13  RW. 05', null, null);
INSERT INTO `sekolah` VALUES ('1110', '9', '2', '20542116', 'SD NEGERI 2 KENDALREJO', 'Jln. Raya Kendalrejo No. 58', null, null);
INSERT INTO `sekolah` VALUES ('1111', '9', '1', '69779126', 'SPS ULUL ALBAB', 'RT. 10 RW. 04 KEDUNGBAJUL', null, null);
INSERT INTO `sekolah` VALUES ('1112', '9', '1', '69780531', 'DHARMA WANITA 1 KAMULAN', 'DESA. KAMULAN', null, null);
INSERT INTO `sekolah` VALUES ('1113', '9', '1', '20574079', 'TK DHARMA WANITA PANDEAN', 'RT 15 RW 03 DS. PANDEAN KEC. DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1114', '9', '1', '69744055', 'BA AISYIYAH KAMULAN', 'Jl.MIM Kamulan RT 06 RW 02 ', null, null);
INSERT INTO `sekolah` VALUES ('1115', '9', null, '20541923', 'SLB NEGERI PANGGUNGSARI TRENGGALEK', 'Kecamatan Durenan', null, null);
INSERT INTO `sekolah` VALUES ('1116', '9', '1', '20574077', 'TK DHARMA WANITA SEMARUM', 'RT 07 RW 03 DS. SEMARUM KEC. DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1117', '9', '2', '20541922', 'SD IT MUTIARA UMMAT', 'RT. 24 RW. 07 Dusun Tawing', null, null);
INSERT INTO `sekolah` VALUES ('1118', '9', '2', '20542314', 'SD NEGERI 4 MALASAN', 'Desa Malasan RT 4 RW.1', null, null);
INSERT INTO `sekolah` VALUES ('1119', '9', '2', '20541923', 'SDLBN PANGUNGGSARI', 'RT. 02, RW. 04 DS. PANGGUNGSARI, DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1120', '9', '2', '60714346', 'MIS MUHAMMADIYAH KAMULAN', 'JL. MIM KAMULAN RT.006 RW.002', null, null);
INSERT INTO `sekolah` VALUES ('1121', '9', '1', '69778788', 'KB BABUSSALAM', 'RT. 006 RW. 002 Desa Pandean Kecamatan Durenan Kabupaten Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1122', '9', '1', '20574082', 'TK DHARMA WANITA 2 NGADISUKO', 'RT. 01 RW. 01  Ds. Ngadisuko, Kec. Durenan', null, null);
INSERT INTO `sekolah` VALUES ('1123', '9', null, '69900694', 'SMA ISLAM DURENAN', 'Jl. Kota Baru No. 17 RT. 06 RW. 02 ', null, null);
INSERT INTO `sekolah` VALUES ('1124', '9', '1', '60714350', 'MIS TASMIRIT TARBIYAH SUMBERGAYAM', 'JL. SOEKARNO-HATTA NO. 99  SUMBERGAYAM, KEC.DURENAN KAB. TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1125', '9', null, '20584754', 'MAS TERPADU AL ANWAR DURENAN', 'JL. RAYA BARUHARJO - DURENAN - TRENGGALEK - JAWA TIMUR', null, null);
INSERT INTO `sekolah` VALUES ('1126', '9', '1', '69949003', 'KB SUNAN KALIJOGO', 'RT. 09 RW. 04', null, null);
INSERT INTO `sekolah` VALUES ('1127', '9', '1', '69744061', 'RA HIDAYATUT THULLAB', 'Jl. Pondok Tengah No.01 RT 22 RW 04 ', null, null);
INSERT INTO `sekolah` VALUES ('1128', '9', '2', '20542013', 'SD NEGERI PANGGUNGSARI', 'Panggungsari', null, null);
INSERT INTO `sekolah` VALUES ('1129', '9', '1', '69744057', 'RA AL HUDA PAKIS', 'RT 13 RW 04 Dsn. Sumberagung Ds. Pakis Kec. Durenan Kab. Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1130', '9', null, '20542496', 'SMAN 1 DURENAN', 'JL. RAYA KENDAL REJO NO. 82', null, null);
INSERT INTO `sekolah` VALUES ('1131', '9', '3', '20542430', 'SMP NEGERI 1 DURENAN', 'Jl. Raya Durenan No.10 - Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1132', '9', '2', '60714348', 'MIS MIFTAHUL HUDA PAKIS', 'RT.13 RW.04 DUSUN SUMBERAGUNG', null, null);
INSERT INTO `sekolah` VALUES ('1133', '9', '3', '20516435', 'SMPLB HARAPAN MULYA', 'Ds. Panggungsari', null, null);
INSERT INTO `sekolah` VALUES ('1134', '9', '2', '20542243', 'SD NEGERI 3 KENDALREJO', 'RT. 15 RW. 06 ', null, null);
INSERT INTO `sekolah` VALUES ('1135', '9', '1', '20574085', 'TK DHARMA WANITA 3 DURENAN', 'RT 17 RW 07 Dsn. Baran', null, null);
INSERT INTO `sekolah` VALUES ('1136', '9', null, 'K5660498', 'LKP Sanida', 'Jl.Dewi sri 06 RT 07/04 Ds/Kec.Durenan Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('1137', '9', null, '69794676', 'SMK TERPADU AL ANWAR DURENAN', 'Jl. Raya Baruharjo Durenan Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1138', '9', '1', '20574074', 'TK DHARMA WANITA 1 KENDALREJO', 'JL. RAYA KENDALREJO NO. 01 DS. KENDALREJO KEC. DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1139', '9', '1', '20574073', 'TK DHARMA WANITA 2 BARUHARJO', 'RT. 12 RW. 03 DS. BARUHARJO KEC. DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1140', '9', '3', '69900880', 'SMP TAHFIDZ AL KAUTSAR', 'RT. 02 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('1141', '9', '1', '20574078', 'TK DHARMA WANITA SUMBERGAYAM', 'RT 01 RW 01 DS. SUMBERGAYAM KEC. DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1142', '9', '1', '69779083', 'KB AL IKHLAS', 'RT. 02 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('1143', '9', '2', '20542042', 'SD NEGERI 1 SUMBEREJO', 'RT.04 RW.01', null, null);
INSERT INTO `sekolah` VALUES ('1144', '9', null, 'T2968239', 'TBM HIDAYATUT THULLAB', '-', null, null);
INSERT INTO `sekolah` VALUES ('1145', '9', '1', '69779156', 'KB MIFTAHUL ULUM', 'RT. 14 RW. 04 DSN. DEMPOK', null, null);
INSERT INTO `sekolah` VALUES ('1146', '9', '1', '69744056', 'RA NURUL HIDAYAH SUMBERGAYAM', 'JL. SOEKARNO-HATTA NO. 99 SUMBERGAYAM KEC.DURENAN KAB. TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1147', '9', '1', '20574075', 'TK DHARMA WANITA 2 KENDALREJO', 'RT. 15 RW. 06 DS. KENDALREJO KEC. DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1148', '9', '1', '20574064', 'TK DHARMA WANITA 1 MALASAN', 'RT 13 RW 04 DS. MALASAN KEC. DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1149', '9', null, '20542509', 'SMK ISLAM 1 DURENAN', 'JL. RAYA KENDALREJO DURENAN TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1150', '9', '3', '20542445', 'SMP NEGERI 2 DURENAN', 'Jl. Raya Kamulan', null, null);
INSERT INTO `sekolah` VALUES ('1151', '9', '2', '20542013', 'SDN PANGGUNGSARI', 'RT. 07, RW. 03 DS. PANGGUNGSARI, DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1152', '9', null, 'K5660497', 'LKP Berlian komputer', 'Jl.Raya kedalrejo 21 Durenan  Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('1153', '9', '1', '69776913', 'SPS AL QOYYUM', 'RT 13 RW 04', null, null);
INSERT INTO `sekolah` VALUES ('1154', '9', null, 'P2968239', 'PKBM  HASANAH', 'Lingkungan Tinggar', null, null);
INSERT INTO `sekolah` VALUES ('1155', '9', '1', '20574839', 'TK DHARMA WANITA 2 KAMULAN', 'RT O7 RW 02 DUSUN GUYANG GAJAH DESA KAMULAN KECAMATAN DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1156', '9', '1', '20574072', 'TK DHARMA WANITA 1 BARUHARJO', 'RT. 07 RW. 02 DS. BARUHARJO KEC. DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1157', '9', '2', '60714345', 'MIS NURUL IMAN GADOR', 'JLN PINGIT 080 RT.16 RW.04 DS.GADOR', null, null);
INSERT INTO `sekolah` VALUES ('1158', '9', '1', '69744058', 'RA NURUL HUDA SEMARUM', 'JLN. MASJID DARUL ULUM NO.13 RT.04, RW.02 SEMARUM DURENAN TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1159', '9', '1', '20574070', 'TK DHARMA WANITA 1 SUMBEREJO', 'RT 04 RW 01 DS. SUMBEREJO KEC. DURENAN ', null, null);
INSERT INTO `sekolah` VALUES ('1160', '9', '2', '20542090', 'SD NEGERI 2 DURENAN', 'Jl. Lapangan No. 46 Durenan', null, null);
INSERT INTO `sekolah` VALUES ('1161', '9', '2', '20542178', 'SD NEGERI 2 SUMBEREJO', 'Dusun. Ngrejo RT. 14 RW. 03', null, null);
INSERT INTO `sekolah` VALUES ('1162', '9', null, '69772542', 'SMK DARISSULAIMANIYYAH', 'Jln. Kedung Banteng RT. 11 RW. 02 Ds. Kamulan ', null, null);
INSERT INTO `sekolah` VALUES ('1163', '9', '1', '20574069', 'TK DHARMA WANITA 2 GADOR', 'RT 11 RW 03 DS. GADOR KEC. DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1164', '9', '2', '20542384', 'SDN PAKIS', 'RT. 13, RW. 04 DS. PAKIS, DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1165', '9', '2', '20541952', 'SDN 1 DURENAN', 'RT. 12, RW. 05 DS. DURENAN, DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1166', '9', '1', '69779132', 'KB AR - ROHMAH', 'RT. 24 RW. 09 DSN TUGU BANCANG', null, null);
INSERT INTO `sekolah` VALUES ('1167', '9', '1', '20574080', 'TK DHARMA WANITA PAKIS', 'RT 13 RW 04 DS. PAKIS KEC. DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1168', '9', '1', '20574067', 'TK DHARMA WANITA 4 MALASAN', 'RT. 29 RW. 08 Desa. Malasan', null, null);
INSERT INTO `sekolah` VALUES ('1169', '9', '2', '20541953', 'SD NEGERI 1 GADOR', 'RT.06  RW.01 Gador', null, null);
INSERT INTO `sekolah` VALUES ('1170', '9', '1', '69778914', 'KB AZ ZAHRO', 'RT. 09 RW. 03', null, null);
INSERT INTO `sekolah` VALUES ('1171', '9', null, '69894642', 'Ar Rohmah Durenan', 'RT. 24/09 Dsn. Tugu Bancang', null, null);
INSERT INTO `sekolah` VALUES ('1172', '9', '2', '69812094', 'SD ISLAM GIRI ARUM KUSUMA', 'Jl. Raya Masjid Joglo, Semarum 2, Semarum, Durenan, Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1173', '9', '2', '20542043', 'SD NEGERI SUMBERGAYAM', 'Sumbergayam RT 4 RW 2', null, null);
INSERT INTO `sekolah` VALUES ('1174', '9', '1', '69778910', 'KB MARDI SIWI', 'LAPANGAN DURENAN RT. 03 RW. 02', null, null);
INSERT INTO `sekolah` VALUES ('1175', '9', '2', '20541977', 'SD NEGERI 1 KENDALREJO', 'RT. 08  RW.04  Dusun Ngrandu', null, null);
INSERT INTO `sekolah` VALUES ('1176', '9', '1', '20574840', 'TK DHARMA WANITA 1 KAMULAN', 'RT. 27 RW. 04 Desa. Kamulan', null, null);
INSERT INTO `sekolah` VALUES ('1177', '9', '2', '60714349', 'MIS NURUL HUDA SEMARUM', 'JLN. MASJID DARUL ULUM NO.13 RT.04, RW.02 SEMARUM DURENAN TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1178', '9', '1', '20574087', 'TK DHARMA WANITA 3 NGADISUKO', 'RT 34 RW 10 DS. NGADISUKO KEC. DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1179', '9', '1', '69790204', 'KB HIDAYATUT THULLAB', 'RT. 22 RW. 04', null, null);
INSERT INTO `sekolah` VALUES ('1180', '9', '3', '20542417', 'SMP ISLAM DURENAN', 'Kendalrejo Durenan', null, null);
INSERT INTO `sekolah` VALUES ('1181', '9', '2', '20542102', 'SD NEGERI 2 KAMULAN', 'RT.07, RW. 02 ,Kamulan', null, null);
INSERT INTO `sekolah` VALUES ('1182', '9', '2', '20541933', 'SD NEGERI 1 BARUHARJO', 'RT 12 RW 3 Baruharjo', null, null);
INSERT INTO `sekolah` VALUES ('1183', '9', '2', '20542129', 'SD NEGERI 2 NGADISUKO', 'RT. 34 RW. 10', null, null);
INSERT INTO `sekolah` VALUES ('1184', '9', '1', '20574066', 'TK DHARMA WANITA 3 MALASAN', 'RT 04 RW 01 DS. MALASAN KEC. DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1185', '9', '2', '20541966', 'SD NEGERI 1 KARANGANOM', 'RT.14 RW.03 Desa Karanganom', null, null);
INSERT INTO `sekolah` VALUES ('1186', '9', '2', '20542244', 'SD NEGERI 3 MALASAN', 'RT 34 RW 09', null, null);
INSERT INTO `sekolah` VALUES ('1187', '9', '2', '20542385', 'SD NEGERI PANDEAN', 'Desa Pandean', null, null);
INSERT INTO `sekolah` VALUES ('1188', '9', '1', '20574065', 'TK DHARMA WANITA 2 MALASAN', 'RT 36 RW 09 DS. MALASAN KEC. DURENAN', null, null);
INSERT INTO `sekolah` VALUES ('1189', '9', '3', '20542479', 'SMP TERPADU AL ANWAR', 'Rt. 06 Rw. 02', null, null);
INSERT INTO `sekolah` VALUES ('1190', '9', '3', '60727597', 'MTSS DARISSULAIMANIYYAH', 'JL KEDUNGBANTENG NO. 12 RT. 11 RW. 02', null, null);
INSERT INTO `sekolah` VALUES ('1191', '9', '3', '69965760', 'SMP DARUSSALAM DURENAN', 'Jl. Raya Durenan-Trenggalek No. 5', null, null);
INSERT INTO `sekolah` VALUES ('1192', '9', '2', '20541952', 'SD NEGERI 1 DURENAN', 'RT. 12  RW. 05', null, null);
INSERT INTO `sekolah` VALUES ('1193', '9', '1', '69989603', 'KB PLUS WAHIDIYAH', 'RT. 19 RW. 06 Desa Pakis', null, null);
INSERT INTO `sekolah` VALUES ('1194', '10', null, '69963389', 'Al Ahsan', 'Dsn. Karangtengah', null, null);
INSERT INTO `sekolah` VALUES ('1195', '10', '2', '20542319', 'SD NEGERI 4 NGADIRENGGO', 'Ngadirenggo', null, null);
INSERT INTO `sekolah` VALUES ('1196', '10', '1', '20573723', 'TK DHARMA WANITA 1 WONOCOYO', 'RT. 08 RW. 04 Dusun Wonocoyo', null, null);
INSERT INTO `sekolah` VALUES ('1197', '10', '2', '20542204', 'SD NEGERI 3 BENDOREJO', 'Desa Bendorejo', null, null);
INSERT INTO `sekolah` VALUES ('1198', '10', '2', '69785014', 'MISBAHUL HUDA (TPA)', 'RT. 24 RW. 12', null, null);
INSERT INTO `sekolah` VALUES ('1199', '10', null, '69785016', 'POS PAUD MARDI SIWI', 'BENDOREJO RT 16 RW 06', null, null);
INSERT INTO `sekolah` VALUES ('1200', '10', '3', '20584936', 'MTSS AS SYAFIIYAH POGALAN', 'JL. MENARA NGETAL,POGALAN TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1201', '10', '1', '69790202', 'KB AZ ZAHRO I', 'Rt 07 Rw. 03', null, null);
INSERT INTO `sekolah` VALUES ('1202', '10', '1', '20573730', 'TK DHARMA WANITA 4 NGADIRENGGO', 'RT. 01 RW. 01 Dusun Grojogan', null, null);
INSERT INTO `sekolah` VALUES ('1203', '10', '2', '20541988', 'SD NEGERI 1 NGADIREJO', 'Ds. Ngadirejo', null, null);
INSERT INTO `sekolah` VALUES ('1204', '10', '1', '69790200', 'KB JAUHARUL ULUM', 'KEDUNGLURAH', null, null);
INSERT INTO `sekolah` VALUES ('1205', '10', null, '20542523', 'SMK NEGERI 1 POGALAN', 'JL.TULUNGAGUNG NO. 3 Tlp.(0355)-791371', null, null);
INSERT INTO `sekolah` VALUES ('1206', '10', '3', '20574185', 'SMP PLUS SUNAN KALIJAGA', 'RT. 26 RW. 12 Dsn. Ceme Ds Ngadirenggo Kec Pogalan', null, null);
INSERT INTO `sekolah` VALUES ('1207', '10', '1', '20573705', 'TK DHARMA WANITA 3 NGADIREJO', 'RT. 48 RW. 11 Dusun Gebang', null, null);
INSERT INTO `sekolah` VALUES ('1208', '10', '1', '20573717', 'TK MARDI PUTRA KEDUNGLURAH', 'JL. RAYA KEDUNGLURAH TRENGGALEK KM. 12', null, null);
INSERT INTO `sekolah` VALUES ('1209', '10', '1', '20573706', 'TK DHARMA WANITA 1 NGULANKULON', 'RT 20 RW 05 DS. NGULANKULON KEC. POGALAN', null, null);
INSERT INTO `sekolah` VALUES ('1210', '10', '2', '20542251', 'SD NEGERI 3 NGADIREJO', 'SDN 3 Ngadirejo', null, null);
INSERT INTO `sekolah` VALUES ('1211', '10', '2', '60714410', 'MIS MABDAUL ULUM', 'RT. 28, RW. 12 DUSUN GONDANGREJO DESA NGADIRENGGO', null, null);
INSERT INTO `sekolah` VALUES ('1212', '10', null, 'T2969352', 'TBM MISBAHUL HUDA', '-', null, null);
INSERT INTO `sekolah` VALUES ('1213', '10', '2', '20542136', 'SD NEGERI 2 NGETAL', 'Desa  Ngetal', null, null);
INSERT INTO `sekolah` VALUES ('1214', '10', '1', '69744109', 'RA/BA/TA AL HIDAYAH NGADIRENGGO', 'RT. 28 RW. 12 GONDANGREJO DESA NGADIRENGGO', null, null);
INSERT INTO `sekolah` VALUES ('1215', '10', '1', '20573718', 'TK DHARMA WANITA 1 GEMBLEB', 'RT. 09 RW. 03 Dusun Kayujaran', null, null);
INSERT INTO `sekolah` VALUES ('1216', '10', '2', '60714405', 'MIS YAPENDAWA', 'RT.13 / RT. 07 DAWUNG BENDOREJO', null, null);
INSERT INTO `sekolah` VALUES ('1217', '10', '2', '20541925', 'SD NEGERI 1 GEMBLEB', 'Desa Gembleb', null, null);
INSERT INTO `sekolah` VALUES ('1218', '10', '3', '69980579', 'SMP ISLAM PLUS JABAL NOOR POGALAN', 'Jl. Raya Ngetal Km. 5 Pogalan Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1219', '10', '1', '20573721', 'TK DHARMA WANITA 1 NGULANWETAN', 'RT. 03 RW. 02 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('1220', '10', '1', '20573712', 'TK DHARMA WANITA 1 BENDOREJO', 'Dusun Nglembu Desa Bendorejo', null, null);
INSERT INTO `sekolah` VALUES ('1221', '10', '1', '20573716', 'TK DHARMA WANITA KEDUNGLURAH', 'RT. 26 RW. 09 Dusun Kedunglurah', null, null);
INSERT INTO `sekolah` VALUES ('1222', '10', '2', '20542153', 'SD NEGERI 2 POGALAN', 'Jln.Raya Pogalan', null, null);
INSERT INTO `sekolah` VALUES ('1223', '10', '1', '20573709', 'TK DHARMA WANITA 1 NGETAL', 'RT. 17 RW. 06 Dusun Duwet', null, null);
INSERT INTO `sekolah` VALUES ('1224', '10', '2', '20541974', 'SD NEGERI 1 KEDUNGLURAH', 'Kedunglurah', null, null);
INSERT INTO `sekolah` VALUES ('1225', '10', '3', '69946873', 'SMP QURAN AL KARIM', 'RT. 10 RW. 04 Dusun Duwet', null, null);
INSERT INTO `sekolah` VALUES ('1226', '10', null, '20584744', 'MAS NURUL FALAH', 'JL RAYA KEDUNGLURAH TULUNGAGUNG', null, null);
INSERT INTO `sekolah` VALUES ('1227', '10', '2', '20542339', 'SD NEGERI 5 BENDOREJO', 'Jln.Raya Trenggalek - Tulungagung Km 10', null, null);
INSERT INTO `sekolah` VALUES ('1228', '10', '1', '20573724', 'TK DHARMA WANITA 2 WONOCOYO', 'RT. 24 RW. 11 Dusun Blengok', null, null);
INSERT INTO `sekolah` VALUES ('1229', '10', null, '69963464', 'Qur an Nurul Falah', 'Jl.Raya Trenggalek Tulungagung, Dusun Brongkah RT 15 RW 05', null, null);
INSERT INTO `sekolah` VALUES ('1230', '10', '1', '69785015', 'KB MISBAHUL HUDA', 'KALISUKUN', null, null);
INSERT INTO `sekolah` VALUES ('1231', '10', '1', '69776920', 'TUNAS BANGSA', 'RT 26 RW 09', null, null);
INSERT INTO `sekolah` VALUES ('1232', '10', '1', '69776918', 'SPS FIRDAUS', 'RT 17 RW 03 DUSUN Wates', null, null);
INSERT INTO `sekolah` VALUES ('1233', '10', '1', '69779311', 'DHARMA WANITA 1 BENDOREJO', 'RT.19 RW.09', null, null);
INSERT INTO `sekolah` VALUES ('1234', '10', '3', '20542413', 'SMP AL IKHSAN POGALAN', 'RT. 06 RW. 03 Dsn. Alasmalang', null, null);
INSERT INTO `sekolah` VALUES ('1235', '10', null, '20542519', 'SMKS PGRI 1 POGALAN', 'JL. Raya Trenggalek-Tulungagung Ngetal Pogalan Trenggalek ', null, null);
INSERT INTO `sekolah` VALUES ('1236', '10', '2', '20542266', 'SD NEGERI 3 POGALAN', 'Dsn.Secang Ds.Pogalan Kab. Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1237', '10', '1', '69907935', 'KB KANJENG JIMAT', 'RT. 24 RW. 08', null, null);
INSERT INTO `sekolah` VALUES ('1238', '10', '1', '69785021', 'SPS  TUNAS HARAPAN', 'RT 01 RW 01 Dusun Karangtengah', null, null);
INSERT INTO `sekolah` VALUES ('1239', '10', '1', '69776916', 'SPS MARDI SIWI ', 'RT 16 RW 06 ', null, null);
INSERT INTO `sekolah` VALUES ('1240', '10', '2', '20542113', 'SD NEGERI 2 KEDUNGLURAH', 'RT. 26, RW.09', null, null);
INSERT INTO `sekolah` VALUES ('1241', '10', null, '69785012', 'POS PAUD FIRDAUS', 'DSN KRAJAN RT 16 RW 06', null, null);
INSERT INTO `sekolah` VALUES ('1242', '10', '1', '20573726', 'TK DHARMA WANITA 2 POGALAN', 'RT. 15 RW. 08 Dusun Oro Oro Ombo Jalan Raya Pogalan', null, null);
INSERT INTO `sekolah` VALUES ('1243', '10', '2', '69903082', 'SDIT NUURUL FIKRI POGALAN', 'RT. 34 RW. 14 Desa Bendorejo ', null, null);
INSERT INTO `sekolah` VALUES ('1244', '10', '1', '20573711', 'TK AL-HIDAYAH 5 NGETAL', 'JL. MENARA AS-SYAFIIYAH NGETAL POGALAN', null, null);
INSERT INTO `sekolah` VALUES ('1245', '10', '2', '20542382', 'SD NEGERI NGULANWETAN', 'Ds. Ngulanwetan', null, null);
INSERT INTO `sekolah` VALUES ('1246', '10', '1', '69744111', 'RA/BA/TA PERWANIDA', 'RT. 20 RW. 09 DUSUN BENDIL', null, null);
INSERT INTO `sekolah` VALUES ('1247', '10', '1', '69779550', 'KB  PERMATA', 'RT.23 RW.11', null, null);
INSERT INTO `sekolah` VALUES ('1248', '10', null, '69954646', 'SMK GAJAH MADA', 'Jl. Raya Trenggalek-Pogalan Km. 5 RT.18 RW. 09 ', null, null);
INSERT INTO `sekolah` VALUES ('1249', '10', '1', '20573732', 'TK DHARMA WANITA 3 POGALAN', 'RT 02 RW 01 DS. POGALAN KEC. POGALAN', null, null);
INSERT INTO `sekolah` VALUES ('1250', '10', '1', '20573729', 'TK DHARMA WANITA 3 NGADIRENGGO', 'RT. 26 RW. 12 Dusun Gondangrejo', null, null);
INSERT INTO `sekolah` VALUES ('1251', '10', '1', '20573715', 'TK DHARMA BAKTI BENDOREJO', 'RT 03 RW 02 BENDOREJO POGALAN', null, null);
INSERT INTO `sekolah` VALUES ('1252', '10', null, 'K5660511', 'LKP Kartika KOmputer', ' Rt.05/03 Desa. Bendorejo', null, null);
INSERT INTO `sekolah` VALUES ('1253', '10', '1', '20573719', 'TK DHARMA WANITA 2 GEMBLEB', 'RT. 26 RW. 09 Dusun Talun', null, null);
INSERT INTO `sekolah` VALUES ('1254', '10', '1', '20573720', 'TK IDHATA GEMBLEB', 'RT. 33 RW. 12 Dusun Suren', null, null);
INSERT INTO `sekolah` VALUES ('1255', '10', '1', '20573710', 'TK IDHATA NGETAL', 'RT 08 RW 03 DS. NGETAL KEC. POGALAN', null, null);
INSERT INTO `sekolah` VALUES ('1256', '10', '1', '20573728', 'TK DHARMA WANITA 2 NGADIRENGGO', 'RT. 10 RW. 04 Dusun Ngrayung Jalan Diponegoro', null, null);
INSERT INTO `sekolah` VALUES ('1257', '10', null, 'K5660515', 'LKP Lestari', 'Ds. Ngetal Rt.18/06 ', null, null);
INSERT INTO `sekolah` VALUES ('1258', '10', null, 'K5660496', 'LKP Andalas', 'Jl.Dsn. Duwet Rt.11/04 Desa ngetal Kec.Pogalan Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('1259', '10', '1', '20573727', 'TK DHARMA WANITA 1 NGADIRENGGO', 'RT 15 RW 06 DSN. WADI KIDUL DS. NGADIRENGGO KEC. POGALAN', null, null);
INSERT INTO `sekolah` VALUES ('1260', '10', '1', '69776923', 'SPS AL FAISHOL', 'RT 12 RW 05 BANDULAN', null, null);
INSERT INTO `sekolah` VALUES ('1261', '10', '2', '60714407', 'MIS PLUS MISHBAHUL HUDA', 'RT. 23 RW. 11', null, null);
INSERT INTO `sekolah` VALUES ('1262', '10', '1', '20573714', 'TK DHARMA WANITA 4 BENDOREJO', 'RT 27 RW 12 DSN. TENGGONG DS. BENDOREJO KEC. POGALAN', null, null);
INSERT INTO `sekolah` VALUES ('1263', '10', '1', '69776922', 'TUNAS HARAPAN', 'RT 04 RW 02', null, null);
INSERT INTO `sekolah` VALUES ('1264', '10', '1', '69779525', 'KB AL - HIKMAH POGALAN', 'JL. RAYA TRENGGALEK - TULUNGAGUNG KM.07 RT.19 RW.7', null, null);
INSERT INTO `sekolah` VALUES ('1265', '10', '2', '20542005', 'SD NEGERI 1 NGULANKULON', 'Ds Ngulankulon', null, null);
INSERT INTO `sekolah` VALUES ('1266', '10', '2', '20542252', 'SD NEGERI 3 NGADIRENGGO', 'Ds Ngadirenggo', null, null);
INSERT INTO `sekolah` VALUES ('1267', '10', '1', '69779528', 'KB NUURUL FIKRI POGALAN', 'RT.34 RW.14 DUSUN KRANDING', null, null);
INSERT INTO `sekolah` VALUES ('1268', '10', '1', '69744110', 'RA/BA/TA AL HIDAYAH', 'DS. NGADIREJO', null, null);
INSERT INTO `sekolah` VALUES ('1269', '10', '2', '20541926', 'SD NEGERI 1 NGADIRENGGO', 'Jln. Diponegoro-Ngadirenggo', null, null);
INSERT INTO `sekolah` VALUES ('1270', '10', null, '69954651', 'SMK GAJAH MADA', 'Jl. Raya Trenggalek-Pogalan Km. 5 RT.18 RW. 09 ', null, null);
INSERT INTO `sekolah` VALUES ('1271', '10', '2', '69982999', 'MIS NURUL HUDA', 'JL. AMPEL GADING DSN. NGRAYUNG', null, null);
INSERT INTO `sekolah` VALUES ('1272', '10', '2', '60714408', 'MIS HIDAYATUL MUSTAFIDZ', 'RT.17/06 DESA KEDUNGLURAH KEC. POGALAN KAB. TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1273', '10', '2', '20542016', 'SD NEGERI 1 POGALAN', 'Jln.Raya Pogalan Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1274', '10', '1', '20573713', 'TK DHARMA WANITA 2 BENDOREJO', 'JL. RAYA TRENGGALEK - TULUNGAGUNG DS. BENDOREJO KEC. POGALAN', null, null);
INSERT INTO `sekolah` VALUES ('1275', '10', null, '69894845', 'MA PLUS SUNAN KALIJOGO', 'Kampung Ngadirenggo RT 26/12', null, null);
INSERT INTO `sekolah` VALUES ('1276', '10', '1', '20573703', 'TK DHARMA WANITA 1 NGADIREJO', 'RT. 26 RW. 08 Dusun Gambang', null, null);
INSERT INTO `sekolah` VALUES ('1277', '10', '2', '20542128', 'SD NEGERI 2 NGADIREJO', 'Jl. Raya Kedung No.01', null, null);
INSERT INTO `sekolah` VALUES ('1278', '10', '2', '20541924', 'SD NEGERI 1 BENDOREJO', 'RT 19 RW 09 DESA BENDOREJO KECAMATAN POGALAN KABUPATEN TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1279', '10', '2', '60714409', 'MIS JAMIATUL ULUM', 'JL.MENARA NGETAL POGALAN TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1280', '10', '2', '20541995', 'SD NEGERI 1 NGETAL', 'Jln.raya Trenggalek-Tulungagung', null, null);
INSERT INTO `sekolah` VALUES ('1281', '10', '2', '20542143', 'SD NEGERI 2 NGULANKULON', 'RT 20 RW 05 Ds Ngulankulon', null, null);
INSERT INTO `sekolah` VALUES ('1282', '10', '1', '69790203', 'KB AZ ZAHRO II', 'NGULAN WETAN', null, null);
INSERT INTO `sekolah` VALUES ('1283', '10', '2', '60714411', 'MIS RIYADLATUL ULUM', 'RT 20 RW 09 DESA WONOCOYO', null, null);
INSERT INTO `sekolah` VALUES ('1284', '10', '1', '69776925', 'SPS AL KAUTSAR', 'RT 19 RW 07 KEDUNGLURAH', null, null);
INSERT INTO `sekolah` VALUES ('1285', '10', null, '69928141', 'MASUnggulan Jabal Noor', 'Jl. RAYA NGETAL KM 5 ', null, null);
INSERT INTO `sekolah` VALUES ('1286', '10', '1', '69776712', 'MISBAHUL HUDA POGALAN', 'RT.24 RW.12', null, null);
INSERT INTO `sekolah` VALUES ('1287', '10', '1', '20573708', 'TK DHARMA WANITA 3 NGULANKULON', 'RT 20 RW 05 DS. NGULANKULON KEC. POGALAN', null, null);
INSERT INTO `sekolah` VALUES ('1288', '10', '1', '69783677', 'KB MISBAHUL HUDA ', 'RT.24 RW.12', null, null);
INSERT INTO `sekolah` VALUES ('1289', '10', '3', '20542451', 'SMP NEGERI 2 POGALAN', 'Ngulankulon', null, null);
INSERT INTO `sekolah` VALUES ('1290', '10', null, '69941732', 'MAS Unggulan Jabal Noor', 'Jl. RAYA NGETAL KM 5', null, null);
INSERT INTO `sekolah` VALUES ('1291', '10', '2', '20542200', 'SD NEGERI 2 WONOCOYO ', 'RT 24 RW 11', null, null);
INSERT INTO `sekolah` VALUES ('1292', '10', null, 'P2964893', 'PKBM MISBAHUL HUDA', 'JALAN KALISUKUN', null, null);
INSERT INTO `sekolah` VALUES ('1293', '10', '1', '20573725', 'TK DHARMA WANITA 1 POGALAN', 'JL. RAYA POGALAN TULUNGAGUNG DS. POGALAN KEC. POGALAN', null, null);
INSERT INTO `sekolah` VALUES ('1294', '10', null, 'K5660495', 'LKP Sanita', 'Jl.Raya Perempatan Selatan no.4 Bendorejo,pogalan Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('1295', '10', '2', '20542065', 'SD NEGERI 1 WONOCOYO', 'RT 06 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('1296', '10', '2', '60714406', 'MIS NGADIREJO', 'RT.06 RW.03 DS.NGADIREJO', null, null);
INSERT INTO `sekolah` VALUES ('1297', '10', '1', '69744113', 'RA/BA/TA YAPENDAWA', 'RT.13 RW.07 DS.BENDOREJO', null, null);
INSERT INTO `sekolah` VALUES ('1298', '10', '2', '20541928', 'SD NEGERI 2 NGADIRENGGO', 'Desa Ngadirenggo', null, null);
INSERT INTO `sekolah` VALUES ('1299', '10', '2', '20542072', 'SD NEGERI 2 BENDOREJO', 'Ds Bendorejo', null, null);
INSERT INTO `sekolah` VALUES ('1300', '10', '2', '20542299', 'SD NEGERI 4 BENDOREJO', 'Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1301', '10', '1', '69785023', 'POS PAUD TUNAS BANGSA', 'GEMBLEB', null, null);
INSERT INTO `sekolah` VALUES ('1302', '10', '1', '69744112', 'RA/BA/TA HIDAYATUL MUSTAFIDZ', 'RT 16 RW 05 DUSUN BRONGKAH DESA KEDUNGLURAH', null, null);
INSERT INTO `sekolah` VALUES ('1303', '10', '2', '20541929', 'SD NEGERI 3 GEMBLEB', 'Dusun Suren RT.33 RW.12', null, null);
INSERT INTO `sekolah` VALUES ('1304', '10', '2', '20541927', 'SD NEGERI 2 GEMBLEB', 'Jln. Talun No.25 Gembleb', null, null);
INSERT INTO `sekolah` VALUES ('1305', '10', '3', '20584935', 'MTSS GUPPI POGALAN', 'JL. RAYA KEDUNGLURAH RT.17 RW.06 KEC.POGALAN POGALAN KAB. TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1306', '10', '3', '20542436', 'SMP NEGERI 1 POGALAN', 'Jln. Raya Tulungagung - Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1307', '10', '1', '20573704', 'TK DHARMA WANITA 2 NGADIREJO', 'RT. 07 RW. 03 Dusun Alas Malang Jalan Raya Kedung No. 1', null, null);
INSERT INTO `sekolah` VALUES ('1308', '10', '1', '20573707', 'TK DHARMA WANITA 2 NGULANKULON', 'RT. 20 RW. 05 Dusun Krajan', null, null);
INSERT INTO `sekolah` VALUES ('1309', '10', '1', '20573722', 'TK DHARMA WANITA 2 NGULANWETAN', 'RT. 21 RW. 09 Dusun Winong', null, null);
INSERT INTO `sekolah` VALUES ('1310', '10', '1', '20573731', 'TK AL-JIHAD NGULANKULON', 'RT. 13 RW. 7 Dusun Pojok', null, null);
INSERT INTO `sekolah` VALUES ('1311', '10', null, '69990890', 'SMK AL KARIM', 'RT 10 RW 04 NGETAL POGALAN TRENGGAALEK', null, null);
INSERT INTO `sekolah` VALUES ('1312', '10', '1', '69996246', 'TK PLUS WAHIDIYAH POGALAN', 'RT. 15 RW. 06 DESA. NGULANWETAN', null, null);
INSERT INTO `sekolah` VALUES ('1313', '11', '3', '20584941', 'MTSS MIFTAHUL JANNAH', 'JL. MASTRIP NO.150 PARAKAN', null, null);
INSERT INTO `sekolah` VALUES ('1314', '11', '1', '20573660', 'TK DHARMA WANITA 1 SUKOSARI', 'JL. Mastrip RT. 02 RW. 01 ', null, null);
INSERT INTO `sekolah` VALUES ('1315', '11', '2', '60714424', 'MIS PLUS DARUNNAJAH', 'JALAN SOEKARNO HATTA NO. 22 RT.14 RW.05', null, null);
INSERT INTO `sekolah` VALUES ('1316', '11', null, 'K5660492', 'LKP Dinasty', 'Jl.Soekarno Hatta Gg. Menak Sopal RT 022 RW 005 Dsn. Jarakan', null, null);
INSERT INTO `sekolah` VALUES ('1317', '11', '1', '20573695', 'TK AISYIYAH 2 SUMBERGEDONG', 'JL. KH. Ahmad Dahlan No. 3 Trenggalek ', null, null);
INSERT INTO `sekolah` VALUES ('1318', '11', '2', '20542131', 'SD NEGERI 2 NGARES', 'RT 03 RW 01 Ngares Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1319', '11', '2', '20542048', 'SD NEGERI 1 SURODAKAN', 'Jl. Rw. Monginsidi No. 1 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1320', '11', null, '20516337', 'SDLB C KEMALA BHAYANGKARI', 'Jl. Hos. Cokroaminoto No. 7', null, null);
INSERT INTO `sekolah` VALUES ('1321', '11', '1', '69779291', 'KB PERMATA BANGSA', 'JL. Menur RT. 010 RW. 003 No.08, Kel. Tamanan, Kec. Trenggalek, Kab. Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1322', '11', null, '69779313', 'TPA AISYIYAH', 'P.HIDAYATULLAH', null, null);
INSERT INTO `sekolah` VALUES ('1323', '11', '1', '20573694', 'TK AISYIYAH 1 SURODAKAN', 'JL. Jaksa Agung Suprapto No. 28 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1324', '11', '1', '69779279', 'KB NURFADHILAH', 'RT 13 RW 05', null, null);
INSERT INTO `sekolah` VALUES ('1325', '11', '2', '60714421', 'MIS NURUL ULUM', 'JL. MASTRIP DESA PARAKAN KABUPATEN TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1326', '11', '1', '69779319', 'TK PERTIWI', 'P.DIPONEGORO NO. 92', null, null);
INSERT INTO `sekolah` VALUES ('1327', '11', '3', '20542467', 'SMP NEGERI 6 TRENGGALEK', 'Jalan Imam Bonjol No. 5', null, null);
INSERT INTO `sekolah` VALUES ('1328', '11', null, '69851867', 'SMK WAHID HASYIM TRENGGALEK', 'JL. KIMANGUN SARKORO NO 17 B', null, null);
INSERT INTO `sekolah` VALUES ('1329', '11', null, 'T2969936', 'TBM AL AMIN', '-', null, null);
INSERT INTO `sekolah` VALUES ('1330', '11', '1', '69778826', 'KB AL HIDAYAH 1', 'JL. BASUKI RAHMAD NO. 28', null, null);
INSERT INTO `sekolah` VALUES ('1331', '11', null, 'K5660490', 'LKP Modes setyowati', 'jl. Siwalan Perum Kelutan Permai C3 Kelutan Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('1332', '11', '1', '69779295', 'KB KASIH BUNDA', 'RT 17 RW 04', null, null);
INSERT INTO `sekolah` VALUES ('1333', '11', '2', '20542284', 'SD NEGERI 2 SURODAKAN', 'Surodakan', null, null);
INSERT INTO `sekolah` VALUES ('1334', '11', '1', '69779277', 'KB MUTIARA INSANI', 'TAMBAK MENUR NO.4 RT 07 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('1335', '11', null, 'P2969937', 'PKBM ANANDA', 'Jln.Lalu Mesir Gg.Persatuan No.7', null, null);
INSERT INTO `sekolah` VALUES ('1336', '11', '1', '20573659', 'TK NEGERI TRENGGALEK', 'JL. Ronggowarsito No. 10 A Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1337', '11', '1', '20573658', 'TK DHARMA WANITA 1 SUMBERDADI', 'RT. 06 RW. 03 ', null, null);
INSERT INTO `sekolah` VALUES ('1338', '11', null, 'T2969939', 'TBM NGUDI KAWERUH', 'Supriyadi ', null, null);
INSERT INTO `sekolah` VALUES ('1339', '11', '2', '20542151', 'SD NEGERI 2 PARAKAN', 'Jl. Mastrip No. 149A', null, null);
INSERT INTO `sekolah` VALUES ('1340', '11', '2', '20542264', 'SD NEGERI 3 PARAKAN', 'Jl. Mastrip Gg II', null, null);
INSERT INTO `sekolah` VALUES ('1341', '11', '2', '20542162', 'SD NEGERI 2 SAMBIREJO', 'Jl. Sukonandi No.43 RT 05 RW 02 ', null, null);
INSERT INTO `sekolah` VALUES ('1342', '11', '2', '60714419', 'MI WAJIB BELAJAR NGARES', 'Jl. Supriyadi RT 19 RW 05', null, null);
INSERT INTO `sekolah` VALUES ('1343', '11', '2', '20542050', 'SD NEGERI 1 TAMANAN', 'Jl. Mayjen Sungkono No. 70', null, null);
INSERT INTO `sekolah` VALUES ('1344', '11', '2', '60714423', 'MI PLUS WALISONGO', 'Jl. KH. Hasyim Asy`ari No. 70 Surodakan Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1345', '11', '1', '20573696', 'TK TRISULA PERWARI TRENGGALEK', 'JL. Hayam Wuruk RT 16 / RW 05', null, null);
INSERT INTO `sekolah` VALUES ('1346', '11', '1', '20573664', 'TK DHARMA WANITA 1 PARAKAN', 'JL. Mastrip RT. 10 RW. 04  Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1347', '11', '1', '20573682', 'TK KASIH NGANTRU', 'JL. Yos Sudarso No. 2 ', null, null);
INSERT INTO `sekolah` VALUES ('1348', '11', '1', '20573683', 'TK ISLAM TERPADU PERMATA UMMAT ', 'JL. P. Hidayatullah Gg. Sedap Malam No. 10 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1349', '11', null, '69903029', 'SMK AR-RIDLWAN', 'JL. Soekarno-Hatta RT/RW 014/005 Kelutan Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1350', '11', '2', '20516436', 'SDLBAD KEMALA BHAYANGKARI', 'Jl. Hos Cokroaminoto No. 07 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1351', '11', '1', '20573685', 'TK BINA ANAPRASA', 'JL. Kanjeng Jimat RT.26 RW.08', null, null);
INSERT INTO `sekolah` VALUES ('1352', '11', '2', '20541909', 'SD INTEGRAL LUQMAN AL HAKIM', 'Jl. dr. Soetomo Gg. Yaa Bunayya RT 003 RW 001', null, null);
INSERT INTO `sekolah` VALUES ('1353', '11', '1', '69778824', 'KBIT PERMATA UMAT', 'JL. P. HIDAYATULLOH GG. SEDAP MALAM NO. 10', null, null);
INSERT INTO `sekolah` VALUES ('1354', '11', '2', '20542331', 'SD NEGERI 4 SUMBERDADI', 'RT. 11 RW. 06 Dusun Mojo', null, null);
INSERT INTO `sekolah` VALUES ('1355', '11', '2', '20542174', 'SD NEGERI 2 SUKOSARI', 'Jl Mastrip No.168 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1356', '11', null, '69776719', 'AL HIDAYAH I', 'JL. BASUKI RAHMAT 28', null, null);
INSERT INTO `sekolah` VALUES ('1357', '11', '1', '20573675', 'TK DHARMA WIRAWAN KARANGSUKO', 'Perumnas ASABRI Karangsoko', null, null);
INSERT INTO `sekolah` VALUES ('1358', '11', '1', '69779734', 'TK NEGERI PEMBINA', 'JL RONGGOWARSITO NO. 10A', null, null);
INSERT INTO `sekolah` VALUES ('1359', '11', '1', '69882272', 'KB ANAK SHOLEH', 'RT 11 RW 06 DUSUN MOJO', null, null);
INSERT INTO `sekolah` VALUES ('1360', '11', '2', '20570804', 'SD MUHAMMADIYAH 1 TRENGGALEK', 'Jln. KH Agus Salim No. 11', null, null);
INSERT INTO `sekolah` VALUES ('1361', '11', null, '20542517', 'SMK NEGERI 2 TRENGGALEK', 'Jln. Ronggo warsito Gg Sidomukti No. 01', null, null);
INSERT INTO `sekolah` VALUES ('1362', '11', null, '69822693', 'SMAS KARYA DHARMA', 'JL. KAWAK', null, null);
INSERT INTO `sekolah` VALUES ('1363', '11', '2', '20542286', 'SD NEGERI 3 TAMANAN', 'Jl.Dr.Soetomo Gg.Ngamarto ', null, null);
INSERT INTO `sekolah` VALUES ('1364', '11', null, '69752163', 'SMALBS KEMALA BHAYANGKARI 1 TRENGGALEK', 'JL. HOS. COKROAMINOTO NO 7 TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1365', '11', '3', '20542465', 'SMP NEGERI 4 TRENGGALEK', 'Jl. Pahlawan Gg. 6 Karangsoko', null, null);
INSERT INTO `sekolah` VALUES ('1366', '11', null, 'P2964894', 'PKBM AL AMIN', 'RT. 23 RW. 05 ', null, null);
INSERT INTO `sekolah` VALUES ('1367', '11', '2', '20542014', 'SD NEGERI 1 PARAKAN', 'Jl Mastrip 73 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1368', '11', '1', '69779289', 'KB CERIA', 'RT 11 RW 02', null, null);
INSERT INTO `sekolah` VALUES ('1369', '11', '2', '20541976', 'SD NEGERI 1 KELUTAN', 'Jl Soekarno Hatta Gg. Langsep No. 02', null, null);
INSERT INTO `sekolah` VALUES ('1370', '11', '2', '20584938', 'MTsN 1 TRENGGALEK', 'BARAT TMP KARANGSOKO', null, null);
INSERT INTO `sekolah` VALUES ('1371', '11', null, 'P9962692', 'SKB TRENGGALEK', 'Jl. Supriadi No. 37 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1372', '11', '1', '20573668', 'TK DHARMA WANITA 2 DAWUHAN', 'JL. Mastrip RT. 09 RW. 03', null, null);
INSERT INTO `sekolah` VALUES ('1373', '11', '2', '20542041', 'SD NEGERI 1 SUMBERDADI', 'RT 06 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('1374', '11', '3', '20584939', 'MTSS PLUS RADEN PAKU', 'JL. KI MANGUN SARKORO NO.17 B', null, null);
INSERT INTO `sekolah` VALUES ('1375', '11', null, '20542514', 'SMK MUHAMMADIYAH 1 TRENGGALEK', 'JL. SUNAN KALIJAGA NO.01', null, null);
INSERT INTO `sekolah` VALUES ('1376', '11', '1', '69779294', 'KB KEMALA BHAYANGKARI', 'KH. HASYIM ASHARI NO. 04', null, null);
INSERT INTO `sekolah` VALUES ('1377', '11', null, '20584753', 'MAS RADEN PAKU', 'JL. KIMANGUN SARKORO. 17-B', null, null);
INSERT INTO `sekolah` VALUES ('1378', '11', '3', '20542453', 'SMP NEGERI 2 TRENGGALEK', 'Jl. Mastrip Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1379', '11', null, '20542527', 'SMK SINAR BAKTI TRENGGALEK', 'Jl. Pahlawan Gg. 6', null, null);
INSERT INTO `sekolah` VALUES ('1380', '11', null, 'K5660517', 'LKP Natuna', 'Jl.Abdul Rachman Saleh no.56 Surodakan Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('1381', '11', null, 'T2969937', 'TBM MUTIARA INSANI', '-', null, null);
INSERT INTO `sekolah` VALUES ('1382', '11', '1', '69744121', 'RA/BA/TA NURUL ULUM', 'JLN.MASTRIP DS.PARAKAN', null, null);
INSERT INTO `sekolah` VALUES ('1383', '11', null, '69734064', 'SMK PLUS NURUL HIKMAH', 'JL. KANJENG JIMAT RT 06 RW 02 DES.REJOWINANGUN KEC.TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1384', '11', '2', '20542044', 'SD NEGERI 1 SUMBERGEDONG', 'Jln. Ra Kartini No 72 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1385', '11', null, '20542513', 'SMK KARYA DHARMA 2 TRENGGALEK', 'JL. KAWAK KARANGSOKO', null, null);
INSERT INTO `sekolah` VALUES ('1386', '11', null, '20516423', 'SLBS B KEMALA BHAYANGKARI 1', 'JL. HOS COKROAMINOTO NO. 7', null, null);
INSERT INTO `sekolah` VALUES ('1387', '11', '1', '69790201', 'KB RIDLO THOLIBATUL ULUM', 'RT 14 RW 05', null, null);
INSERT INTO `sekolah` VALUES ('1388', '11', '1', '20573663', 'TK PERTIWI SUMBERGEDONG', 'JL. P. DIPONEGORO NO. 92 TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1389', '11', '2', '20542115', 'SD NEGERI 2 KELUTAN', 'Jl. Soekarno-Hatta Gg. Apel No. 170', null, null);
INSERT INTO `sekolah` VALUES ('1390', '11', '1', '69779282', 'KB ALMUBAROK', 'SUMBERDADI', null, null);
INSERT INTO `sekolah` VALUES ('1391', '11', '1', '69779280', 'KB AL HIDAYAH 2 KELUTAN', 'RT 12 RW 05 JL. SOEKARNO HATTA GG. LANGSEP NO. 16', null, null);
INSERT INTO `sekolah` VALUES ('1392', '11', '3', '20542424', 'SMP MAARIF TRENGGALEK', 'Jl Panglima Sudirman No 26', null, null);
INSERT INTO `sekolah` VALUES ('1393', '11', '1', '69779286', 'KB RUMAH BERMAIN LEBAH', 'VETERAN NO. 30', null, null);
INSERT INTO `sekolah` VALUES ('1394', '11', '1', '20573671', 'TK DHARMA WANITA PERSATUAN 2 KARANGSUKO', 'JL. Pahlawan Gang 5 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1395', '11', '2', '20542254', 'SD NEGERI 3 NGANTRU', 'Jl. Kh. Wakhid Hasyim No. 01', null, null);
INSERT INTO `sekolah` VALUES ('1396', '11', '1', '20573662', 'TK DHARMA WANITA SAMBIREJO', 'RT 05 RW 02 Dusun. Ngepoh', null, null);
INSERT INTO `sekolah` VALUES ('1397', '11', '2', '20542179', 'SD NEGERI 2 SUMBERGEDONG', 'Jl. Raden Saleh Gang I No. 5', null, null);
INSERT INTO `sekolah` VALUES ('1398', '11', '2', '20542025', 'SD NEGERI 1 SAMBIREJO', 'Sambirejo', null, null);
INSERT INTO `sekolah` VALUES ('1399', '11', '11', '69882277', 'KB. PEMBINA INTAN PERSADA', 'JALAN RONGGOWARSITO NO. 10A', null, null);
INSERT INTO `sekolah` VALUES ('1400', '11', null, '69775790', 'SMK KESEHATAN WIJAYA HUSADA', 'Jl. Soekarno-Hatta Gg. I No. 15 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1401', '11', null, 'K5660488', 'LKP Gazebo English Course', 'Jl.Mayjen sungkono no.18 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1402', '11', null, '20542512', 'SMK KARYA DHARMA 1 TRENGGALEK', 'JL. KAWAK', null, null);
INSERT INTO `sekolah` VALUES ('1403', '11', '1', '20573702', 'TK PERTIWI DHARMA WANITA PERSATUAN SETDA', 'JL. KH. Hasyim Ashari Nomor 1 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1404', '11', '1', '69744122', 'RA/BA/TA AL HUDA', 'JL. MASTRIP NO 09 REJOWINANGUN', null, null);
INSERT INTO `sekolah` VALUES ('1405', '11', '1', '69779275', 'KB AISYIYAH', 'P. HIDAYATULLOH NO. 20', null, null);
INSERT INTO `sekolah` VALUES ('1406', '11', '3', '20566595', 'SMP ISLAM PLUS NURUL HIKMAH', 'Jln. Kanjeng Jimat RT. 06 Rejowinangun', null, null);
INSERT INTO `sekolah` VALUES ('1407', '11', '2', '20541921', 'SDIT PERMATA UMMAT', 'Jl. P. Hidayatulloh Gg. Sedap Malam No. 10', null, null);
INSERT INTO `sekolah` VALUES ('1408', '11', '2', '20542177', 'SD NEGERI 2 SUMBERDADI', 'RT 02 RW 01 Sumberdadi Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1409', '11', '2', '20541990', 'SD NEGERI 1 NGANTRU', 'Jl K. Patimura No.27 A Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1410', '11', '2', '20542239', 'SD NEGERI 3 KARANGSOKO', 'Karangsoko Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1411', '11', '2', '20542279', 'SD NEGERI 3 SUMBERDADI', 'Desa Sumberdadi Kec. Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1412', '11', '1', '20573699', 'TK KEMALA BHAYANGKARI 52 TRENGGALEK', 'JL. HOS. COKROAMINOTO NO. 5 TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1413', '11', '2', '20542185', 'SD NEGERI 2 TAMANAN', 'Jl. Menur No. 8', null, null);
INSERT INTO `sekolah` VALUES ('1414', '11', '1', '20573688', 'TK DHARMA WANITA PERSATUAN 1 NGARES', 'JL. Supriadi RT. 07 RW. 02', null, null);
INSERT INTO `sekolah` VALUES ('1415', '11', '2', '20516423', 'SDLB B KEMALA BHAYANGKARI', 'Jl Hos Cokroaminoto No 7', null, null);
INSERT INTO `sekolah` VALUES ('1416', '11', '1', '69776931', 'SPS AN NABILA', 'JL. MAYJEN SUNGKONO', null, null);
INSERT INTO `sekolah` VALUES ('1417', '11', '1', '20573684', 'TK YAA BUNAYYA TRENGGALEK', 'Jl. dr. Soetomo Gg. Yaa Bunayya RT. 03 RW. 01 Tamanan Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1418', '11', '1', '20573687', 'TK AL HIDAYAH VII KELUTAN', 'RT. 08 RW. 03 Dusun. Gebangan', null, null);
INSERT INTO `sekolah` VALUES ('1419', '11', '3', '20542462', 'SMP NEGERI 3 TRENGGALEK', 'Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1420', '11', null, '20541473', 'STKIP PGRI TRENGGALEK', 'SUPRIADI 22', null, null);
INSERT INTO `sekolah` VALUES ('1421', '11', null, '69778807', 'TPA TUNAS BANGSA', 'RW. MONGINSIDI NO. 2', null, null);
INSERT INTO `sekolah` VALUES ('1422', '11', '2', '20541944', 'SD NEGERI 1 DAWUHAN', 'Jl. Mastrip 320 Dawuhan', null, null);
INSERT INTO `sekolah` VALUES ('1423', '11', '1', '69778818', 'SPS ABDI PERTIWI', 'JL. MASTRIP NO. 189', null, null);
INSERT INTO `sekolah` VALUES ('1424', '11', null, 'K5660513', 'LKP Teratai', 'Kel. Tamanan Rt.01/01 ', null, null);
INSERT INTO `sekolah` VALUES ('1425', '11', '1', '20573691', 'TK AL HIDAYAH 3 SURODAKAN', 'JL. Ahmad Yani GG. Wijaya Kusuma No. 6 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1426', '11', '1', '69778827', 'KB YAA BUNAYYA', 'DR. SOETOMO', null, null);
INSERT INTO `sekolah` VALUES ('1427', '11', '1', '20573689', 'TK DHARMA WANITA 2 NGARES', 'RT 17 RW 04 DS. NGARES KEC. TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1428', '11', null, 'K5660528', 'LKP Brawijaya', 'Jl. Soekarno Hatta No.17, Rt/Rw. 001/001 Kel.Ngantru, Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1429', '11', '1', '20573693', 'TK AL HIDAYAH 1 NGANTRU', 'JL. Basuki Rahmat 28 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1430', '11', null, '20542500', 'SMA NEGERI 1 TRENGGALEK', 'JL. SOEKARNO - HATTA NO.13', null, null);
INSERT INTO `sekolah` VALUES ('1431', '11', '3', '20542439', 'SMP NEGERI 1 TRENGGALEK', 'Jl.Dr.sutomo No.10', null, null);
INSERT INTO `sekolah` VALUES ('1432', '11', '3', '20542503', 'SMA NEGERI 2 TRENGGALEK', 'JL. SOEKARNO - HATTA', null, null);
INSERT INTO `sekolah` VALUES ('1433', '11', '1', '69776932', 'POS PAUD NAWA KARTIKA 3', 'JL. SOEKARNO-HATTA', null, null);
INSERT INTO `sekolah` VALUES ('1434', '11', null, 'K5668119', 'LKP ENY S TAILOR', 'RT. 06 RW. 02', null, null);
INSERT INTO `sekolah` VALUES ('1435', '11', null, 'P2964896', 'PKBM BINA UMAT CENDEKIA', '-', null, null);
INSERT INTO `sekolah` VALUES ('1436', '11', null, '69894846', 'MA DARUNNAJAH', 'Jl.SOEKARNO HATTA RT.14 RW.05', null, null);
INSERT INTO `sekolah` VALUES ('1437', '11', null, '69778797', 'TPAIT PERMATA UMAT', 'P, HIDAYATULLAH GG SEDAP MALAM NO. 10', null, null);
INSERT INTO `sekolah` VALUES ('1438', '11', '1', '20573680', 'TK TUNAS KASIH', 'JL. Dr. Soetomo Nomor 39 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1439', '11', '1', '69882273', 'KB AISYIYAH 1 MELATI', 'JALAN JAKSA AGUNG SUPRAPTO NO. 28', null, null);
INSERT INTO `sekolah` VALUES ('1440', '11', '3', '69947571', 'SMP MUHAMMADIYAH 1 TRENGGALEK', 'Jln. Ronggo Warsito No. 04 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1441', '11', '3', '20584940', 'MTSS MIFTAHUL JANNAH', 'JL. MASTRIP NO.150 PARAKAN', null, null);
INSERT INTO `sekolah` VALUES ('1442', '11', null, '20542493', 'SMAS KARYA DHARMA', 'JL. KAWAK', null, null);
INSERT INTO `sekolah` VALUES ('1443', '11', '3', '20542466', 'SMP NEGERI 5 TRENGGALEK', 'Jl. R.A. Kartini No.98 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1444', '11', null, '20542508', 'SMKS BINA PUTRA', 'JL. SOEKARNO-HATTA G.I/15', null, null);
INSERT INTO `sekolah` VALUES ('1445', '11', null, '20539003', 'SLB KEMALA BHAYANGKARI 1', 'Jl Hos Cokroaminoto No 07', null, null);
INSERT INTO `sekolah` VALUES ('1446', '11', '1', '69776927', 'SPS AZ ZAHRO', 'DSN TELASIH', null, null);
INSERT INTO `sekolah` VALUES ('1447', '11', '1', '20573669', 'TK DHARMA WANITA 3 DAWUHAN', 'JL. MASTRIP RT 16 RW 4 DS. DAWUHAN KEC. TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1448', '11', '1', '20573698', 'TK ADHYAKSA IX ', 'JL. Dewi Sartika No. 10 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1449', '11', null, 'P2964895', 'PKBM MUTIARA BINA INSANI', '-', null, null);
INSERT INTO `sekolah` VALUES ('1450', '11', '1', '20573667', 'TK DHARMA WANITA 1 DAWUHAN', 'JL. MASTRIP RT 11 RW 03 DAWUHAN KEC. TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1451', '11', '2', '20542280', 'SD NEGERI 3 SUMBERGEDONG', 'Jl. Ronggowarsito No. 02 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1452', '11', '1', '69779285', 'KB AL AMIN', 'RT 23 RW 05 JARAKAN', null, null);
INSERT INTO `sekolah` VALUES ('1453', '11', '2', '20542002', 'SD NEGERI 1 NGARES', 'Jl Supriadi No 56 Ngares Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1454', '11', null, 'P2969939', 'PKBM BABUL KHAER', '-', null, null);
INSERT INTO `sekolah` VALUES ('1455', '11', '2', '20542130', 'SD NEGERI 2 NGANTRU', 'JL. HAYAM WURUK NO. 1', null, null);
INSERT INTO `sekolah` VALUES ('1456', '11', null, '20542493', 'SMA KARYA DHARMA', 'JL. KAWAK', null, null);
INSERT INTO `sekolah` VALUES ('1457', '11', '1', '69744123', 'RA AL HIDAYAH NGARES', 'RT 19 RW 05 DESA NGARES KEC./KAB. TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1458', '11', '1', '69744124', 'RA NURUL HUDA DAWUHAN', 'JL.MASTRIP NO. 360 RT 007 RW 002', null, null);
INSERT INTO `sekolah` VALUES ('1459', '11', '3', '20564092', 'SMP ISLAM AL MARIFAH DARUNNAJAH', 'Jln. Soekarno Hatta Kelutan No. 22 A', null, null);
INSERT INTO `sekolah` VALUES ('1460', '11', '1', '20573674', 'TK DHARMA WANITA PERSATUAN 1 TAMANAN', 'JL. Mayjend Sungkono Nomor 78', null, null);
INSERT INTO `sekolah` VALUES ('1461', '11', '1', '20573686', 'TK DHARMA WANITA 2 SUKOSARI', 'JL. Mastrip RT. 06 RW. 02', null, null);
INSERT INTO `sekolah` VALUES ('1462', '11', null, '69983514', 'MAS TERPADU PERMATA UMMAT', 'JL. PANGERAN HIDAYATULLAH GANG SEDAP MALAM NO 10', null, null);
INSERT INTO `sekolah` VALUES ('1463', '11', '1', '20573672', 'TK DHARMA WANITA PERSATUAN 3 KARANGSUKO', 'JL. Pahlawan No. 68 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1464', '11', '1', '20573665', 'TK DHARMA WANITA 2 PARAKAN', 'JL. MASTRIP NO. 149A RT 18 RW 07 DS. PARAKAN KEC. TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1465', '11', '2', '20542211', 'SD NEGERI 3 DAWUHAN', 'RT.16 RW.04 Desa Dawuhan', null, null);
INSERT INTO `sekolah` VALUES ('1466', '11', '1', '69882667', 'KB DHARMA WIRAWAN', 'MERAK BLOK W NO. 01', null, null);
INSERT INTO `sekolah` VALUES ('1467', '11', '1', '69779735', 'KB TUNAS KASIH', 'JL. Dr. SOETOMO NO.39 TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1468', '11', null, 'K5660516', 'LKP Putra Jaya', 'Jl. MT. Haryono 12 Trenggalek-Jatim', null, null);
INSERT INTO `sekolah` VALUES ('1469', '11', '2', '20542082', 'SD NEGERI 2 DAWUHAN', 'Jl Mastrip Gg Menur No 04', null, null);
INSERT INTO `sekolah` VALUES ('1470', '11', '1', '69778819', 'KB KASIH', 'JL. YOS SUDARSO', null, null);
INSERT INTO `sekolah` VALUES ('1471', '11', '1', '69776926', 'KASIH IBU', 'JL. MAYJEN SUNGKONO78', null, null);
INSERT INTO `sekolah` VALUES ('1472', '11', '1', '20573697', 'TK PERTIWI NGANTRU', 'JL. K. PATIMURA NO. 39 NGANTRU - TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1473', '11', '1', '20577131', 'TK DHARMA WANITA PERSATUAN 2 SUMBERDADI', 'RT. 08 RW. 04  ', null, null);
INSERT INTO `sekolah` VALUES ('1474', '11', '1', '20573692', 'TK AL HIDAYAH II KELUTAN', 'JL. Soekarno Hatta GG. Langsep No. 16 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1475', '11', '1', '20573673', 'TK DHARMA WANITA PERSATUAN KELUTAN', 'JL. Soekarno Hatta GG. Duku Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1476', '11', '2', '20542038', 'SD NEGERI 1 SUKOSARI', 'Jalan Mastrip Nomor 188', null, null);
INSERT INTO `sekolah` VALUES ('1477', '11', '1', '69779288', 'PAUD TUNAS KASIH', 'DR. SOETOMO NO. 39', null, null);
INSERT INTO `sekolah` VALUES ('1478', '11', '1', '20573661', 'TK DHARMA WANITA PERSATUAN 2 TAMANAN', 'JL. Manur No. 08/ RT. 10 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1479', '11', '1', '20573670', 'TK DHARMA WANITA PERSATUAN 1 KARANGSUKO', 'JL. Merdeka Nomor 22', null, null);
INSERT INTO `sekolah` VALUES ('1480', '11', '1', '69779281', 'KB MUTIARA BUNDA', 'RT 06 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('1481', '11', '2', '60714422', 'MI NURUL HUDA DAWUHAN', 'JL. MASTRIP NO. 360 RT 007 RW 002', null, null);
INSERT INTO `sekolah` VALUES ('1482', '11', '2', '20542109', 'SD NEGERI 2 KARANGSOKO', 'Jl. Pahlawan No. 68', null, null);
INSERT INTO `sekolah` VALUES ('1483', '11', '1', '69779737', 'TK DWP 2 SUMBERDADI', 'SUMBERDADI', null, null);
INSERT INTO `sekolah` VALUES ('1484', '11', '1', '20573690', 'TK DHARMA WANITA PERSATUAN REJOWINANGUN', 'JL. Kanjeng Jimat RT. 02 RW. 01  ', null, null);
INSERT INTO `sekolah` VALUES ('1485', '11', null, '20542524', 'SMK NEGERI 1 TRENGGALEK', 'JL. BRIGJEN SUTRAN NOMOR 3', null, null);
INSERT INTO `sekolah` VALUES ('1486', '11', null, 'T2969938', 'TBM AL HIDAYAH', '-', null, null);
INSERT INTO `sekolah` VALUES ('1487', '11', '1', '69896128', 'TK WAHIDIYAH PLUS KELUTAN', 'Jl. Soekarno Hatta RT. 02 RW. 01 Kelutan Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1488', '11', '1', '69779283', 'KB TARAM', 'JL SUPRIYADI NO. 37 RT 01 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('1489', '11', '2', '20542386', 'SD NEGERI REJOWINANGUN', 'Jl Kanjeng Jimat Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1490', '11', '3', '69897255', 'SMPIT PERMATA UMMAT TRENGGALEK', 'Jl. P. Hidayatullah Gg. Sedap Malam No. 10', null, null);
INSERT INTO `sekolah` VALUES ('1491', '11', '2', '20541971', 'SD NEGERI 1 KARANGSOKO', 'Jl Pahlawan No 36 Karangsoko', null, null);
INSERT INTO `sekolah` VALUES ('1492', '11', '1', '20573701', 'TK KARTIKA IV - 27 ', 'JL. KH Agus Salim Nomor 5A Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1493', '11', '1', '69790197', 'TK PERTIWI NGANTRU', 'JL. K. Patimura Nomor 39 Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1494', '11', null, '20584756', 'MAN TRENGGALEK', 'JL. SOEKARNO HATTA GG APEL NO. 12', null, null);
INSERT INTO `sekolah` VALUES ('1495', '11', null, '60714420', 'AL HUDA REJOWINANGUN', 'JL. MASTRIP NO. 09  RT 03 RW. 02 REJOWINANGUN', null, null);
INSERT INTO `sekolah` VALUES ('1496', '11', '1', '69778803', 'AISYIYAH', 'P. HIDAYATULLOH', null, null);
INSERT INTO `sekolah` VALUES ('1497', '11', '3', '69993641', 'MTs MUALLIMIN MUALLIMAT AR-RIDLWAN', 'JL. SOEKARNO-HATTA ', null, null);
INSERT INTO `sekolah` VALUES ('1498', '12', null, 'T2969951', 'TBM FASTABIQUL KHOIROT', '-', null, null);
INSERT INTO `sekolah` VALUES ('1499', '12', '1', '69937581', 'KB FASTABIQUL KHOIROT', 'RT. 05 RW. 02', null, null);
INSERT INTO `sekolah` VALUES ('1500', '12', '2', '20542154', 'SD NEGERI 2 PRAMBON', 'Jln Pakel Lor RT 31 RW 06', null, null);
INSERT INTO `sekolah` VALUES ('1501', '12', null, 'P2964900', 'PKBM FASTABIQUL KHOIROT', '-', null, null);
INSERT INTO `sekolah` VALUES ('1502', '12', '1', '20574253', 'TK DHARMA WANITA WINONG', 'RT 07 RW 03 DS. WINONG KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1503', '12', '1', '69780611', 'AISYIYAH', 'RT.10 RW.04', null, null);
INSERT INTO `sekolah` VALUES ('1504', '12', '2', '20542062', 'SD NEGERI WINONG', 'Dusun Benggle RT. 007 RW. 003 ', null, null);
INSERT INTO `sekolah` VALUES ('1505', '12', '1', '69932266', 'KB AISYIYAH TUMPUK', 'RT. 10 RW. 04', null, null);
INSERT INTO `sekolah` VALUES ('1506', '12', '1', '20574273', 'TK DHARMA WANITA 3 JAMBU', 'RT 19 RW 07 DS. JAMBU KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1507', '12', '2', '60714431', 'MIS JUMOG', 'RT. 09 RW. 04 DSN. JUMOG', null, null);
INSERT INTO `sekolah` VALUES ('1508', '12', '2', '20542270', 'SD NEGERI 2 PUCANGANAK', 'RT 04 RW 02', null, null);
INSERT INTO `sekolah` VALUES ('1509', '12', '1', '20574265', 'TK DHARMA WANITA 1 PUCANGANAK', 'Jln. Raya 12 KM Trenggalek-Ponorogo RT. 14 RW.05 Desa Pucanganak', null, null);
INSERT INTO `sekolah` VALUES ('1510', '12', '1', '69776955', 'KB AL MUNAWAROH', 'RT. 01 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('1511', '12', '2', '60714428', 'MIS MUHAMMADIYAH DERMOSARI', 'JL. RAYA TRENGGALEK-PONOROGO KM. 10', null, null);
INSERT INTO `sekolah` VALUES ('1512', '12', '2', '20542017', 'SD NEGERI 1 PRAMBON', 'Desa Prambon, Kec. Tugu, Kab. Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1513', '12', '1', '69744126', 'RA Ba Aisyiyah', 'Rt 07 Rw 03 Ds. Dermosari', null, null);
INSERT INTO `sekolah` VALUES ('1514', '12', '2', '20541959', 'SD NEGERI 1 JAMBU', 'Jln. Raya Trenggalek-Ponorogo Km. 09,RT.02 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('1515', '12', '1', '20577130', 'TK WAHIDIYAH PLUS GONDANG', 'RT. 33 RW. 08 DS. GONDANG KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1516', '12', '3', '20542440', 'SMP NEGERI 1 TUGU', 'Jl. Ponorogo, Dermosari', null, null);
INSERT INTO `sekolah` VALUES ('1517', '12', null, '20542522', 'SMKS QOMARUL HIDAYAH 2', 'JL. RAYA PONOROGO TRENGGALEK KM. 06 GONDANG - TUGU - TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1518', '12', '1', '69776938', 'SPS NAWA KARTIKA 1', 'RT.12 RW.03', null, null);
INSERT INTO `sekolah` VALUES ('1519', '12', '2', '20542454', 'SMP NEGERI 2 TUGU', 'Jl.Corah Mulyo 89', null, null);
INSERT INTO `sekolah` VALUES ('1520', '12', null, '20584752', 'MAS QOMARUL HIDAYAH', 'JL. PONOROGO-TRENGGALEK, KM. 07 GONDANG, TUGU, TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1521', '12', '1', '69954758', 'KB ROHMATUL UMMAT', 'RT 12 RW 05 Desa Ngepeh Kec. Tugu  ', null, null);
INSERT INTO `sekolah` VALUES ('1522', '12', '1', '69780597', 'KB AL MUNAJAH', 'RT.16 RW.04', null, null);
INSERT INTO `sekolah` VALUES ('1523', '12', '2', '20542358', 'SD NEGERI 4 PRAMBON', 'Rt 03 Rw 01 ', null, null);
INSERT INTO `sekolah` VALUES ('1524', '12', '1', '69744131', 'RA/BA/TA ISLAMIYAH', 'RT.05 RW.02 DUSUN PACAR', null, null);
INSERT INTO `sekolah` VALUES ('1525', '12', '2', '20541951', 'SD NEGERI 1 DUREN', 'RT. 05 RW. 02 Desa Duren', null, null);
INSERT INTO `sekolah` VALUES ('1526', '12', '1', '69882280', 'KB BUNGA ISLAM', 'RT 044 RW 009', null, null);
INSERT INTO `sekolah` VALUES ('1527', '12', '2', '20555395', 'SD NEGERI 5 PRAMBON', 'RT 49 RW 10 Dusun Sooko', null, null);
INSERT INTO `sekolah` VALUES ('1528', '12', '2', '20542085', 'SD NEGERI 2 DERMOSARI', 'Rt 22 / Rw 08, Dusun Nglengkong, Desa Dermosari, Kec. Tugu, Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1529', '12', '2', '20542020', 'SD NEGERI 1 PUCANGANAK', 'Jln. Raya Trenggalek - Ponorogo Km.12', null, null);
INSERT INTO `sekolah` VALUES ('1530', '12', '1', '69882276', 'TK AL - MUNAWAROH', 'RT. 01 RW. 01 Dusun. Corah Mulyo', null, null);
INSERT INTO `sekolah` VALUES ('1531', '12', '1', '20574272', 'TK DHARMA WANITA 2 JAMBU', 'RT 14 RW 05 DS. JAMBU KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1532', '12', '1', '69882270', 'TK TUNAS BANGSA', 'RT. 01 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('1533', '12', '1', '69781007', 'PELITA HARAPAN', 'JL. PAKEL LOR RT.15 RW.03', null, null);
INSERT INTO `sekolah` VALUES ('1534', '12', null, '20542521', 'SMKS QOMARUL HIDAYAH 1', 'JL. RAYA PONOROGO GONDANG TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1535', '12', '1', '69784767', 'PAUD NAWA KARTIKA I', 'DS. GONDANG KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1536', '12', '2', '60714427', 'MIS ISLAMIYAH NGLINGGIS', 'RT.05 RW.02 DUSUN PACAR', null, null);
INSERT INTO `sekolah` VALUES ('1537', '12', '1', '69955361', 'KB CEMARA', 'RT. 22 RW. 08 Ds. Dermosari Kec. Tugu Kab. Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1538', '12', '1', '20574259', 'TK DHARMA WANITA BANARAN', 'RT 03 RW 01 DS. BANARAN KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1539', '12', '1', '20574254', 'TK NEGERI PEMBINA TUGU', 'JL. RAYA TRENGGALEK PONOROGO KM 8 DS. SUKOREJO KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1540', '12', '1', '20574270', 'TK DHARMA WANITA 2 DUREN', 'RT 18 RW 07 DS. DUREN KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1541', '12', '2', '20542367', 'SD NEGERI 4 PRAMBON', 'RT 56 RW 12 DUSUN MLOKO', null, null);
INSERT INTO `sekolah` VALUES ('1542', '12', '1', '69776948', 'KB NURUL HIDAYAH', 'RT.14 RW.06 KLAMPISAN, Ds.Pucanganak', null, null);
INSERT INTO `sekolah` VALUES ('1543', '12', '1', '69780599', 'KB TUNAS BANGSA', 'RT.01 RW.01 DSN, CORAH MULYO DS. NGLONGSOR', null, null);
INSERT INTO `sekolah` VALUES ('1544', '12', '1', '69744129', 'RA/BA/TA FASTABIQUL KHOIROT', 'RT 001 RW 001 DSN. KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('1545', '12', '1', '69780828', 'DHARMA WANITA 1 GONDANG', 'JL. RAYA TRENGGALEK - PONOROGO KM.1', null, null);
INSERT INTO `sekolah` VALUES ('1546', '12', '3', '20542463', 'SMP NEGERI 3 TUGU', 'Jl. Pakel Lor', null, null);
INSERT INTO `sekolah` VALUES ('1547', '12', '1', '20574261', 'TK DHARMA WANITA 2 PRAMBON', 'RT 31 RW 06 DS. PRAMBON KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1548', '12', '1', '20574271', 'TK DHARMA WANITA 1 JAMBU', 'Jl.Raya Trenggalek-Ponorogo KM 9 RT 02 RW 01 DS. JAMBU KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1549', '12', '1', '20574268', 'TK DHARMA WANITA GADING', 'RT 001 RW 001 DS. GADING KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1550', '12', '1', '20574256', 'TK DHARMA WANITA 1 NGEPEH', 'RT. 04 RW. 02  DS. NGEPEH KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1551', '12', '1', '20574266', 'TK DHARMA WANITA 2 PUCANGANAK', 'RT 04 RW 02 DS. PUCANGANAK KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1552', '12', '1', '69790199', 'DHARMA WANITA 2 GONDANG', 'RT.20 RW.08', null, null);
INSERT INTO `sekolah` VALUES ('1553', '12', null, 'T2969952', 'TBM MENTARI DUNIA', '-', null, null);
INSERT INTO `sekolah` VALUES ('1554', '12', '1', '20574263', 'TK DHARMA WANITA 4 PRAMBON', 'RT 56 RW 12 DS. PRAMBON KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1555', '12', '2', '60714429', 'MIS FASTABIQUL KHOIROT', 'RT 001 RW 001 DSN. KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('1556', '12', '1', '20574251', 'TK DHARMA WANITA 2 GONDANG', 'RT 20 RW 08 Dusun. Kalipinggir', null, null);
INSERT INTO `sekolah` VALUES ('1557', '12', null, 'K5660508', 'LKP Modes aneka', ' Rt.07/02 Desa. Nglongsor', null, null);
INSERT INTO `sekolah` VALUES ('1558', '12', '2', '20542381', 'SD NEGERI NGLINGGIS', 'RT. 01 RW. 01 Desa Nglinggis', null, null);
INSERT INTO `sekolah` VALUES ('1559', '12', '2', '20542391', 'SD NEGERI TUMPUK ', 'RT. 11 RW. 04 Desa Tumpuk', null, null);
INSERT INTO `sekolah` VALUES ('1560', '12', '2', '20542139', 'SD NEGERI 2 NGLONGSOR', 'Ds. Nglongsor Kec. Tugu, Kab. Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1561', '12', '2', '20542190', 'SD NEGERI 2 TEGAREN', 'RT 09 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('1562', '12', '2', '20541959', 'SDN 1 Jambu', 'JL RAYA TRENGGALEK-PONOROGO', null, null);
INSERT INTO `sekolah` VALUES ('1563', '12', '3', '20584943', 'MTSS MUHAMMADIYAH 3', 'JL. RAYA TRENGGALEK - PONOROGO KM 7 DS. GONDANG TUGU TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1564', '12', '1', '69744132', 'RA/BA/TA JUMOG', 'RT.09 RW.04 DS. TUMPUK', null, null);
INSERT INTO `sekolah` VALUES ('1565', '12', '2', '20541916', 'SD ISLAM AL BADAR TUGU', 'Kebonsari', null, null);
INSERT INTO `sekolah` VALUES ('1566', '12', '1', '20574260', 'TK DHARMA WANITA 1 PRAMBON', 'RT 03 RW 01 DS. PRAMBON KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1567', '12', '2', '60714432', 'MIS MOJO', 'RT 18 RW 07', null, null);
INSERT INTO `sekolah` VALUES ('1568', '12', '1', '20574255', 'TK DHARMA WANITA TUMPUK', 'RT 11 RW 04 DS. TUMPUK KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1569', '12', '1', '69744130', 'RA/BA/TA QOMARUL HIDAYAH', 'RT:12 RW:02 DESA: GONDANG  KEC: TUGU KAB:TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1570', '12', '3', '20542425', 'SMP MUHAMMADIYAH 3 TUGU', 'Jl. Raya Gondang', null, null);
INSERT INTO `sekolah` VALUES ('1571', '12', '2', '20542267', 'SD NEGERI 3 PRAMBON', 'RT 47  RW 09  Dsn Kendal', null, null);
INSERT INTO `sekolah` VALUES ('1572', '12', '1', '69776950', 'KB TUNAS MULYA', 'RT.04 RW.02', null, null);
INSERT INTO `sekolah` VALUES ('1573', '12', '2', '20554622', 'SD NEGERI 2 NGEPEH', 'Ds. Ngepeh Kec. Tugu Kab. Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1574', '12', '2', '20541947', 'SD NEGERI 1 DERMOSARI', 'Jl Raya Trenggalek Ponorogo Km  10', null, null);
INSERT INTO `sekolah` VALUES ('1575', '12', '3', '20584942', 'MTSS QOMARUL HIDAYAH', 'Jl. Trenggalek - Ponorogo KM. 07, RT. 09 RW. 02 Desa Gondang', null, null);
INSERT INTO `sekolah` VALUES ('1576', '12', '1', '20574257', 'TK DHARMA WANITA 2 NGEPEH', 'RT 15 RW 06 DS. NGEPEH KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1577', '12', '2', '60714430', 'MIS MUHAMMADIYAH TUMPUK', 'RT 11 RW 04 DESA TUMPUK', null, null);
INSERT INTO `sekolah` VALUES ('1578', '12', '1', '69882275', 'TK ISLAM AL MUNAJAH', 'JLN. RAYA NGLONGSOR - KARANGAN, RT.16 RW.04', null, null);
INSERT INTO `sekolah` VALUES ('1579', '12', '1', '69954759', 'KB ROHMATUL UMMAT', 'RT 12 RW 05 Desa Ngepeh Kec. Tugu  ', null, null);
INSERT INTO `sekolah` VALUES ('1580', '12', '1', '20574250', 'TK DHARMA WANITA 1 GONDANG', 'RT. 18 RW. 05 DS.GONDANG', null, null);
INSERT INTO `sekolah` VALUES ('1581', '12', '1', '69744127', 'RA/BA/TA BA AISYIYAH', 'JL. RAYA PONOROGO TRENGGALEK KM.15', null, null);
INSERT INTO `sekolah` VALUES ('1582', '12', '1', '20574258', 'TK DHARMA WANITA NGLONGSOR', 'RT 14 RW 14 DS. NGLONGSOR KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1583', '12', '1', '69776942', 'SPS TUNAS HARAPAN', 'RT.18 RW.08 SUMBER MADUH', null, null);
INSERT INTO `sekolah` VALUES ('1584', '12', '1', '69882271', 'TK NURUL HIDAYAH', 'RT:14 RW. 06', null, null);
INSERT INTO `sekolah` VALUES ('1585', '12', '2', '60714433', 'MIS QOMARUL HIDAYAH', 'TUGU  RT:12 RW:03', null, null);
INSERT INTO `sekolah` VALUES ('1586', '12', '1', '20574262', 'TK DHARMA WANITA 3 PRAMBON', 'JL. PAKEL LOR DS. PRAMBON KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1587', '12', '2', '20542055', 'SD NEGERI 1 TEGAREN', 'Desa Tegaren Kec. Tugu Kab. Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1588', '12', '1', '20574264', 'TK DHARMA WANITA 5 PRAMBON', 'RT 49 RW 10 DS. PRAMBON KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1589', '12', '1', '69780681', 'PAUD AL MUNAWWAROH', 'RT.01 RW.01', null, null);
INSERT INTO `sekolah` VALUES ('1590', '12', '1', '69780596', 'KB AL HASANAH', 'RT.14 RW.03 DUSUN SETONO', null, null);
INSERT INTO `sekolah` VALUES ('1591', '12', '2', '20541957', 'SD NEGERI 1 GONDANG', 'RT 18 RW 05 Jln. Trenggalek-ponorogo', null, null);
INSERT INTO `sekolah` VALUES ('1592', '12', '1', '69780601', 'KB MUTIARA KASIH', 'RT.19 RW.05', null, null);
INSERT INTO `sekolah` VALUES ('1593', '12', '2', '20542219', 'SD NEGERI 3 JAMBU', 'RT 02 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('1594', '12', '2', '20541993', 'SD NEGERI 1 NGEPEH', 'RT.15 RW.06', null, null);
INSERT INTO `sekolah` VALUES ('1595', '12', '2', '20542097', 'SD NEGERI 2 JAMBU', 'RT.19 RW.07 Jambu, Tugu, Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1596', '12', '1', '69776945', 'SPS HARAPAN BUNDA', 'RT.28 RW.05 NGEPOH', null, null);
INSERT INTO `sekolah` VALUES ('1597', '12', '2', '20542375', 'SD NEGERI GADING', 'RT.01 RW.01Desa Gading ', null, null);
INSERT INTO `sekolah` VALUES ('1598', '12', '2', '20542095', 'SD NEGERI 2 GONDANG', 'Desa Gondang', null, null);
INSERT INTO `sekolah` VALUES ('1599', '12', '1', '20574275', 'TK DHARMA WANITA 2 TEGAREN', 'RT 09 RW 03 DS. TEGAREN KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1600', '12', null, 'K5660507', 'LKP BECC Fasco', 'RT. 09 RW. 02 Desa. Gondang Kec. Tugu Kab. Trenggalek Jawa Timur', null, null);
INSERT INTO `sekolah` VALUES ('1601', '12', '1', '69887614', 'RA. Al-Jaylani', 'Dusun Sanggrahan RT 06 RW 02', null, null);
INSERT INTO `sekolah` VALUES ('1602', '12', null, '69930150', 'PPS PP Azzuhadaa`', 'RT. 23 RW. 06 Dsn. Kebonsari', null, null);
INSERT INTO `sekolah` VALUES ('1603', '12', '2', '20542374', 'SD NEGERI BANARAN', 'RT 03 RW 02 Desa Banaran Ke. Tugu Kab. Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1604', '12', '1', '20574267', 'TK DHARMA WANITA NGLINGGIS', 'RT 10 RW 03 DS. NGLINGGIS KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1605', '12', '1', '69780661', 'KB AISYIYAH', 'RT.04 RW.02', null, null);
INSERT INTO `sekolah` VALUES ('1606', '12', '1', '69744128', 'RA/BA/TA AL BADAR', 'RT.26 RW.06 GONDANG- TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1607', '12', '2', '60714426', 'MIS MUHAMMADIYAH PUCANGANAK', 'JLN. RAYA TRENGGALEK PONOROGO KM.15', null, null);
INSERT INTO `sekolah` VALUES ('1608', '12', '1', '20574252', 'TK DHARMA WANITA DERMOSARI', 'RT 04 RW 01 DS. DERMOSARI KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1609', '12', '1', '69781263', 'TK WAHIDIYAH PLUS', 'RT. 33 RW. 08  Desa Gondang', null, null);
INSERT INTO `sekolah` VALUES ('1610', '12', '1', '69744125', 'RA/BA/TA BA AISIYAH', 'RT 10 RW 04 TUMPUK TUGU TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1611', '12', '1', '20574269', 'TK DHARMA WANITA 1 DUREN', 'RT 05 RW 02 DS. DUREN KEC. TUGU', null, null);
INSERT INTO `sekolah` VALUES ('1612', '12', '2', '20542089', 'SD NEGERI 2 DUREN', 'RT. 18 RW. 07 Desa Duren', null, null);
INSERT INTO `sekolah` VALUES ('1613', '12', '2', '20542389', 'SD NEGERI SUKOREJO', 'Jl. Trenggalek - Ponorogo RT.12 RW. 04', null, null);
INSERT INTO `sekolah` VALUES ('1614', '12', '1', '20574274', 'TK DHARMA WANITA 1 TEGAREN', 'RT. 07 RW. 02 Desa Tegaren', null, null);
INSERT INTO `sekolah` VALUES ('1615', '12', '2', '20541998', 'SD NEGERI 1 NGLONGSOR', 'Desa Nglongsor', null, null);
INSERT INTO `sekolah` VALUES ('1616', '12', '1', '69932262', 'TK TUNAS BANGSA', 'RT. 01 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('1617', '12', '1', '69780666', 'KB AL HIDAYAH', 'RT.27 RW.11', null, null);
INSERT INTO `sekolah` VALUES ('1618', '12', '1', '69744133', 'RA/BA/TA NURUL HIDAYAH', 'DUSUN MOJO KIDUL RT. 18  RW. 07', null, null);
INSERT INTO `sekolah` VALUES ('1619', '12', '1', '69744126', 'RA Ba Aisyiyah', 'Rt 07 Rw 03 Ds. Dermosari', null, null);
INSERT INTO `sekolah` VALUES ('1620', '12', null, '20542501', 'SMAN 1 TUGU', 'JL. LAPANGAN BARAT NGLONGSOR', null, null);
INSERT INTO `sekolah` VALUES ('1621', '12', '2', '69994610', 'MI PUDJI HARDJO PRAMBON', 'RT.12 RW. 03 DSN. KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('1622', '12', '1', '69994611', 'RA PUDJI HARDJO PRAMBON', 'RT.12 RW. 03 DSN. KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('1623', '13', '1', '20573762', 'TK DHARMA WANITA SRABAH', 'RT 02 RW 01 DS. SRABAH KEC. BENDUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('1624', '13', null, 'P2967907', 'PKBM AL-REZKY', 'JL. H.BANAULA SINAPOY ', null, null);
INSERT INTO `sekolah` VALUES ('1625', '13', '2', '20542033', 'SD NEGERI 1 SRABAH', 'RT 02 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('1626', '13', '1', '20573756', 'TK PERTIWI DOMPYONG', 'RT 1 RW 01 DS. DOMPYONG KEC. BENDUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('1627', '13', '2', '20542086', 'SD NEGERI 2 DOMPYONG', 'Dusun Pakel, RT.22  RW. 06', null, null);
INSERT INTO `sekolah` VALUES ('1628', '13', '2', '20542181', 'SD NEGERI 2 SUMURUP', 'Desa Sumurup', null, null);
INSERT INTO `sekolah` VALUES ('1629', '13', '3', '20571150', 'SMP NEGERI SATU ATAP 1 BENDUNGAN', 'Rt 21 Rw O8 Dusun Banaran', null, null);
INSERT INTO `sekolah` VALUES ('1630', '13', '1', '69780290', 'KB TUNAS HARAPAN', 'RT.03 RW.01', null, null);
INSERT INTO `sekolah` VALUES ('1631', '13', '2', '20542122', 'SD NEGERI 2 MASARAN', 'RT. 03 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('1632', '13', '2', '20542208', 'SD NEGERI 3 BOTOPUTIH', 'Botoputih', null, null);
INSERT INTO `sekolah` VALUES ('1633', '13', null, 'P2964890', 'PKBM BUMI RAHAYU', 'DUSUN PAKEL', null, null);
INSERT INTO `sekolah` VALUES ('1634', '13', '2', '20542214', 'SD NEGERI 3 DOMPYONG', 'Dsn.Bedungan RT.06 RW.02 Ds.Dompyong Kec.Bendungan Kab.Trenggalek', null, null);
INSERT INTO `sekolah` VALUES ('1635', '13', '2', '20542305', 'SD NEGERI 4 DOMPYONG', 'Dompyong RT.14, RW. 04, Dusun Tumpak Aren', null, null);
INSERT INTO `sekolah` VALUES ('1636', '13', '1', '69780337', 'KB KARTIKA', 'DUSUN GARON', null, null);
INSERT INTO `sekolah` VALUES ('1637', '13', '1', '69780336', 'KB KEJORA', 'RT.03 RW.01', null, null);
INSERT INTO `sekolah` VALUES ('1638', '13', null, '69904110', 'SMK ISLAM GUPPI BENDUNGAN', 'Jl. Raya Sumurup Bendungan RT. 18 RW. 06', null, null);
INSERT INTO `sekolah` VALUES ('1639', '13', '2', '20542283', 'SD NEGERI 3 SURENLOR', 'RT 07 RW 03 DSN.SUREN', null, null);
INSERT INTO `sekolah` VALUES ('1640', '13', '2', '20542047', 'SD NEGERI 1 SURENLOR', 'Desa Surenlor RT14 RW 05', null, null);
INSERT INTO `sekolah` VALUES ('1641', '13', '3', '20584927', 'MTSS GUPPI BENDUNGAN', 'JL. RAYA BENDUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('1642', '13', '1', '69784414', 'SPS AL-MUBTADIIN', 'MASARAN', null, null);
INSERT INTO `sekolah` VALUES ('1643', '13', '1', '69780389', 'KB TIARA', 'RT.01 RW.01', null, null);
INSERT INTO `sekolah` VALUES ('1644', '13', null, 'P2967906', 'PKBM NURUL IMAN', 'H.Mesir Suryadi', null, null);
INSERT INTO `sekolah` VALUES ('1645', '13', '2', '20542275', 'SD NEGERI 3 SRABAH', 'RT 04 RW 02', null, null);
INSERT INTO `sekolah` VALUES ('1646', '13', '2', '20541940', 'SD NEGERI 1 BOTOPUTIH', 'Dusun Gangsan RT. 14 RW. 05', null, null);
INSERT INTO `sekolah` VALUES ('1647', '13', '2', '20542301', 'SD NEGERI 4 BOTOPUTIH', 'Dsn. Krapyak', null, null);
INSERT INTO `sekolah` VALUES ('1648', '13', '1', '69780298', 'KB BUMI RAHAYU', 'RT.21 RW.06', null, null);
INSERT INTO `sekolah` VALUES ('1649', '13', null, 'T2967907', 'TBM BUMI RAHAYU', '-', null, null);
INSERT INTO `sekolah` VALUES ('1650', '13', '1', '69780329', 'KB AISYIYAH', 'RT. 27 RW. 09 DESA SUMURUP KEC. BENDUNGAN KAB. TRENGGALEK', null, null);
INSERT INTO `sekolah` VALUES ('1651', '13', '2', '20541948', 'SD NEGERI 1 DOMPYONG', 'Dompyong', null, null);
INSERT INTO `sekolah` VALUES ('1652', '13', '2', '69860511', 'SD NEGERI 4 DEPOK', 'RT. 12 RW. 05', null, null);
INSERT INTO `sekolah` VALUES ('1653', '13', '1', '69780296', 'KB RETNO', 'DEPOK', null, null);
INSERT INTO `sekolah` VALUES ('1654', '13', '1', '20573766', 'TK DHARMA WANITA 2 TUNAS BANGSA DEPOK', 'DSN. BANARAN RT 21 RW 8 DS. DEPOK KEC. BENDUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('1655', '13', '3', '20542428', 'SMP NEGERI 1 BENDUNGAN', 'Jl.Raya Surenlor - Masaran No.06 RT:03 RW:01', null, null);
INSERT INTO `sekolah` VALUES ('1656', '13', '2', '20542083', 'SD NEGERI 2 DEPOK', 'RT. 29 RW. 11', null, null);
INSERT INTO `sekolah` VALUES ('1657', '13', '1', '20573761', 'TK DHARMA WANITA 1 DEPOK', 'RT 12 RW 05 DS. DEPOK KEC. BENDUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('1658', '13', '1', '20573760', 'TK PERTIWI DEPOK', 'RT 03 RW 01 DS. DEPOK KEC. BENDUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('1659', '13', '1', '69776957', 'SPS MELATI WANGI I', 'DUSUN JAMBE', null, null);
INSERT INTO `sekolah` VALUES ('1660', '13', '2', '20542169', 'SD NEGERI 2 SRABAH', 'RT 07 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('1661', '13', '1', '69780338', 'KB LENTERA HATI 1', 'RT.07 RW.03', null, null);
INSERT INTO `sekolah` VALUES ('1662', '13', '2', '60714335', 'MIS MIFTAHUL ULUM GUPPI', 'RT. 19 RW. 06 DESA SUMURUP KEC. BENDUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('1663', '13', '2', '20542182', 'SD NEGERI 2 SURENLOR', 'Surenlor', null, null);
INSERT INTO `sekolah` VALUES ('1664', '13', null, '69780331', 'HIDAYATULLOH', 'SUMURUP', null, null);
INSERT INTO `sekolah` VALUES ('1665', '13', '1', '69780332', 'KB AZ-ZAHRO', 'TUMPAK AREN', null, null);
INSERT INTO `sekolah` VALUES ('1666', '13', '1', '20573764', 'TK DHARMA WANITA 1 SENGON', 'RT 09 RW 03 DS. SENGON KEC. BENDUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('1667', '13', '1', '69780340', 'KB LENTERA HATI 2', 'RT.07 RW.03', null, null);
INSERT INTO `sekolah` VALUES ('1668', '13', '1', '69780294', 'KB ARUM DALU', 'RT.21 RW.07 DUSUN KRAPYAK', null, null);
INSERT INTO `sekolah` VALUES ('1669', '13', '1', '20573757', 'TK PGRI 1 SUMURUP', 'RT. 01 RW. 01 ', null, null);
INSERT INTO `sekolah` VALUES ('1670', '13', '3', '20542442', 'SMP NEGERI 2 BENDUNGAN', 'Dusun Bendungan', null, null);
INSERT INTO `sekolah` VALUES ('1671', '13', '2', '20542165', 'SD NEGERI 2 SENGON', 'Jl Sengon Trenggalek Dk Beji RT 04 RW 02', null, null);
INSERT INTO `sekolah` VALUES ('1672', '13', '1', '69780334', 'KB MELATI WANGI II', 'RT.14 RW.05 DUSUN GANGSAN', null, null);
INSERT INTO `sekolah` VALUES ('1673', '13', '1', '20573767', 'TK MIFTAHUL HUDA SUMURUP', 'RT 19 RW 06 DS. SUMURUP KEC. BENDUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('1674', '13', '1', '69744048', 'RA/BA/TA TA MIFTAHUL HUDA', 'RT. 19 RW. 06', null, null);
INSERT INTO `sekolah` VALUES ('1675', '13', '2', '20542029', 'SD NEGERI 1 SENGON', 'RT 21 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('1676', '13', null, 'T2967906', 'TBM RETNO', '-', null, null);
INSERT INTO `sekolah` VALUES ('1677', '13', '1', '20573765', 'TK DHARMA WANITA 2 SENGON', 'RT 04 RW 02 DS. SENGON KEC. BENDUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('1678', '13', '2', '20541945', 'SD NEGERI SATU ATAP 1 BENDUNGAN', 'RT. 21 RW. 08 Dusun Banaran', null, null);
INSERT INTO `sekolah` VALUES ('1679', '13', '1', '69780385', 'KB AZ-ZAHRA', 'RT.14 RW.05 DUSUN WINONG', null, null);
INSERT INTO `sekolah` VALUES ('1680', '13', '1', '20573763', 'TK DHARMA WANITA 3 SURENLOR', 'RT 09 RW 03 DS. SURENLOR KEC. BENDUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('1681', '13', '2', '20542282', 'SD NEGERI 3 SUMURUP', 'Dusun Winong', null, null);
INSERT INTO `sekolah` VALUES ('1682', '13', '1', '20573759', 'TK DHARMA WANITA 1 SURENLOR', 'RT 14 RW 06 DS. SURENLOR KEC. BENDUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('1683', '13', null, '20542505', 'SMA NEGERI 1 BENDUNGAN', 'JL. RAYA TRENGGALEK - BENDUNGAN KM. 12', null, null);
INSERT INTO `sekolah` VALUES ('1684', '13', '1', '69780392', 'KB BINTANG KEJORA', 'DEPOK', null, null);
INSERT INTO `sekolah` VALUES ('1685', '13', '1', '69780341', 'KB THORIQUL MUTTAQIN', 'RT.16 RW.06', null, null);
INSERT INTO `sekolah` VALUES ('1686', '13', '2', '20542078', 'SD NEGERI 2 BOTOPUTIH', 'Botoputih', null, null);
INSERT INTO `sekolah` VALUES ('1687', '13', '1', '69776960', 'KB AN NUUR', 'DUSUN WATES', null, null);
INSERT INTO `sekolah` VALUES ('1688', '13', '1', '20573758', 'TK PGRI 2 SUMURUP', 'RT 12 RW 04 DSN. WINONG DS. SUMURUP KEC. BENDUNGAN', null, null);
INSERT INTO `sekolah` VALUES ('1689', '13', '2', '20541983', 'SD NEGERI 1 MASARAN', 'RT. 09 RW. 04', null, null);
INSERT INTO `sekolah` VALUES ('1690', '13', '2', '20542046', 'SD NEGERI 1 SUMURUP', 'RT 01 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('1691', '13', '1', '69776961', 'SPS NURANI IBU', 'DEPOK', null, null);
INSERT INTO `sekolah` VALUES ('1692', '13', '2', '20542212', 'SD NEGERI 3 DEPOK', 'RT 04 RW. 02', null, null);
INSERT INTO `sekolah` VALUES ('1693', '13', '1', '69991891', 'SPS AL HUDA', 'RT. 26 RW. 08 Desa. Sumurup', null, null);
INSERT INTO `sekolah` VALUES ('1694', '13', '1', '69991125', 'KB BUNGA MAWAR', 'RT. 04 RW. 02 Desa. Sengon', null, null);
INSERT INTO `sekolah` VALUES ('1695', '14', '1', '20574302', 'TK DHARMA WANITA 5 MLINJON', 'RT 30 RW 07 DS. MLINJON KEC. SURUH', null, null);
INSERT INTO `sekolah` VALUES ('1696', '14', '1', '69780878', 'DHARMA WANITA 3 MLINJON', 'RT 35 RW 09 DKH. MIRI', null, null);
INSERT INTO `sekolah` VALUES ('1697', '14', '2', '20541954', 'SD NEGERI 1 GAMPING', 'RT 22 RW 03', null, null);
INSERT INTO `sekolah` VALUES ('1698', '14', '1', '69780879', 'TK DHARMA WANITA 4 MLINJON', 'RT. 20 RW. 04', null, null);
INSERT INTO `sekolah` VALUES ('1699', '14', '2', '20542159', 'SD NEGERI 2 PURU', ' Jalan Raya Trenggalek-Panggul Dusun Jajar RT.15 RW.05', null, null);
INSERT INTO `sekolah` VALUES ('1700', '14', '2', '20541997', 'SD NEGERI 1 NGLEBO', 'RT 04 RW 01 Dsn. Jajar Ds. Nglebo', null, null);
INSERT INTO `sekolah` VALUES ('1701', '14', '1', '20574286', 'TK DHARMA WANITA 2 SURUH', 'RT 16 RW 06 DS. SURUH KEC. SURUH', null, null);
INSERT INTO `sekolah` VALUES ('1702', '14', '3', '20542438', 'SMP NEGERI 1 SURUH', 'Jl. Semboja', null, null);
INSERT INTO `sekolah` VALUES ('1703', '14', '2', '20542216', 'SD NEGERI 3 GAMPING', 'Dsn Gempolan RT 10 RW 02', null, null);
INSERT INTO `sekolah` VALUES ('1704', '14', '1', '69780875', 'DHARMA WANITA 1 PURU', 'RT 18 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('1705', '14', '1', '20574299', 'TK DHARMA WANITA 2 MLINJON', 'RT 10 RW 03 Dusun. Kedungmaron', null, null);
INSERT INTO `sekolah` VALUES ('1706', '14', '1', '69780881', 'DHARMA WANITA 6 MLINJON', 'RT 07 RW 02', null, null);
INSERT INTO `sekolah` VALUES ('1707', '14', '2', '20542316', 'SD NEGERI 4 MLINJON', 'Mlinjon', null, null);
INSERT INTO `sekolah` VALUES ('1708', '14', '3', '20542414', 'SMPS G R SURUH', 'DS. WONOKERTO', null, null);
INSERT INTO `sekolah` VALUES ('1709', '14', null, 'P2969774', 'PKBM HARAPAN BANGSA', 'Suka Bhakti', null, null);
INSERT INTO `sekolah` VALUES ('1710', '14', '1', '20574292', 'TK DHARMA WANITA 2 NGLEBO', 'RT. 15 RW. 04 Dusun. Mojo', null, null);
INSERT INTO `sekolah` VALUES ('1711', '14', '2', '20541985', 'SD NEGERI 1 MLINJON', 'Mlinjon', null, null);
INSERT INTO `sekolah` VALUES ('1712', '14', '1', '69780873', 'DHARMA WANITA 2 NGLEBO', 'RT 15 RW 04', null, null);
INSERT INTO `sekolah` VALUES ('1713', '14', '1', '69780867', 'DHARMA WANITA 2 SURUH', 'RT 16 RW 06', null, null);
INSERT INTO `sekolah` VALUES ('1714', '14', '1', '20574288', 'TK DHARMA WANITA 1 GAMPING', 'RT 22 RW 03 DS. GAMPING KEC. SURUH', null, null);
INSERT INTO `sekolah` VALUES ('1715', '14', '1', '69780876', 'DHARMA WANITA 2 PURU', 'RT 15 RW 05 DSN. JAJAR', null, null);
INSERT INTO `sekolah` VALUES ('1716', '14', '2', '60714416', 'MIS MIM SURUH', 'RT. 08 RW. 03 SURUH', null, null);
INSERT INTO `sekolah` VALUES ('1717', '14', '1', '69744119', 'RA/BA/TA AWWALUL HUDA', 'RT. 28 RW. 03', null, null);
INSERT INTO `sekolah` VALUES ('1718', '14', '1', '69882274', 'KB BAITUL ULUM', 'RT 15 RW 05 DSN. JAJAR', null, null);
INSERT INTO `sekolah` VALUES ('1719', '14', '2', '60714417', 'MIS GAMPING', 'RT 28 RW 03 DESA GAMPING', null, null);
INSERT INTO `sekolah` VALUES ('1720', '14', '1', '69780872', 'DHARMA WANITA 1 NGLEBO', 'NGLEBO SURUH', null, null);
INSERT INTO `sekolah` VALUES ('1721', '14', '1', '20574291', 'TK DHARMA WANITA 1 NGLEBO', 'RT 04 RW 01 Dusun. Tawang', null, null);
INSERT INTO `sekolah` VALUES ('1722', '14', '1', '69780866', 'DHARMA WANITA 1 SURUH', 'RAYA DONGKO', null, null);
INSERT INTO `sekolah` VALUES ('1723', '14', '3', '20566337', 'SMP NEGERI SATU ATAP 2 SURUH', 'RT.15 RW.04 Dusun Mojo', null, null);
INSERT INTO `sekolah` VALUES ('1724', '14', '1', '20574295', 'TK DHARMA WANITA 2 PURU', 'RT 15 RW 05 DS. PURU KEC. SURUH', null, null);
INSERT INTO `sekolah` VALUES ('1725', '14', '1', '69780868', 'DHARMA WANITA 3 SURUH', 'RT 31 RW 11', null, null);
INSERT INTO `sekolah` VALUES ('1726', '14', '1', '69744120', 'RA/BA/TA TA AL- HIDAYAH GUPPI', 'RT.27 RW.06 DS.MLINJON', null, null);
INSERT INTO `sekolah` VALUES ('1727', '14', '1', '69780871', 'DHARMA WANITA 2 GAMPING', 'RT 01 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('1728', '14', '1', '69780874', 'DHARMA WANITA WONOKERTO', 'RT 10 RW 01 DSN. KRAJAN', null, null);
INSERT INTO `sekolah` VALUES ('1729', '14', '1', '69780860', 'KB ATMAJA', 'RT 04 RW 01 DSN. TAWANG', null, null);
INSERT INTO `sekolah` VALUES ('1730', '14', '2', '60714418', 'MIS DARUSSALAM GUPPI', 'RT.27 / RW.06 MLINJON', null, null);
INSERT INTO `sekolah` VALUES ('1731', '14', '1', '69780880', 'DHARMA WANITA 5 MLINJON', 'RT 30 RW 07', null, null);
INSERT INTO `sekolah` VALUES ('1732', '14', '1', '69780877', 'DHARMA WANITA 1 MLINJON', 'RT 16 RW 05 DSN. SONO', null, null);
INSERT INTO `sekolah` VALUES ('1733', '14', '1', '69790198', 'Dharma Wanita 3 Gamping', 'RT 10 Rw 02 Dsn. GEmpolan', null, null);
INSERT INTO `sekolah` VALUES ('1734', '14', '2', '20542008', 'SD NEGERI SATU ATAP 1 SURUH', 'RT.10 RW.03 Dsn. Crabak', null, null);
INSERT INTO `sekolah` VALUES ('1735', '14', '1', '20574290', 'TK DHARMA WANITA 3 GAMPING', 'RT 10 RW 02 DS. GAMPING KEC. SURUH', null, null);
INSERT INTO `sekolah` VALUES ('1736', '14', '1', '69776966', 'SPS BUDI MULIA', 'DKH KRAJAN RT 01 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('1737', '14', '1', '69780859', 'KB WIDODO', 'RAYA PANGGUL SURUH', null, null);
INSERT INTO `sekolah` VALUES ('1738', '14', '2', '20542392', 'SD NEGERI WONOKERTO', 'Dsn Krajan RT 10 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('1739', '14', '2', '20542138', 'SD NEGERI SATU ATAP 2 SURUH', 'Rt. 15 Rw.04 Dusun Mojo', null, null);
INSERT INTO `sekolah` VALUES ('1740', '14', '1', '69780858', 'KB MITRA', 'RT 03 RW 01', null, null);
INSERT INTO `sekolah` VALUES ('1741', '14', '2', '20542049', 'SD NEGERI 1 SURUH', 'RT.15 RW.06 Suruh', null, null);
INSERT INTO `sekolah` VALUES ('1742', '14', '2', '69810629', 'KB PELANGI', 'Dsn. Crabak', null, null);
INSERT INTO `sekolah` VALUES ('1743', '14', null, 'T2969774', 'TBM MITRA', '-', null, null);
INSERT INTO `sekolah` VALUES ('1744', '14', '1', '69744118', 'RA/BA/TA BA AISYIYAH SURUH', 'RT 08 RW 03 DUSUN PANJEN', null, null);
INSERT INTO `sekolah` VALUES ('1745', '14', '2', '20542092', 'SD NEGERI 2 GAMPING', 'RT 01 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('1746', '14', '2', '20542146', 'SD NEGERI 2 NGRANDU', 'Dusun Babadan RT 21 RW 05', null, null);
INSERT INTO `sekolah` VALUES ('1747', '14', '2', '20542248', 'SD NEGERI 3 MLINJON', 'RT. 35 RW. 09 Dusun Miri', null, null);
INSERT INTO `sekolah` VALUES ('1748', '14', '1', '20574296', 'TK DHARMA WANITA 1 NGRANDU', 'RT 10 RW 03 DS. NGRANDU KEC. SURUH', null, null);
INSERT INTO `sekolah` VALUES ('1749', '14', null, 'P9908353', 'PKBM BHAKTI', 'RT.10 RW.01 ', null, null);
INSERT INTO `sekolah` VALUES ('1750', '14', '1', '20574297', 'TK DHARMA WANITA 2 NGRANDU', 'RT 21 RW 05', null, null);
INSERT INTO `sekolah` VALUES ('1751', '14', '1', '20574285', 'TK DHARMA WANITA 1 SURUH', 'RT 15 RW 06 DS. SURUH KEC. SURUH', null, null);
INSERT INTO `sekolah` VALUES ('1752', '14', '1', '69780869', 'DHARMA WANITA 1 GAMPING', 'RAYA PULE RT 22 RW 03 DSN. KARANGTURI', null, null);
INSERT INTO `sekolah` VALUES ('1753', '14', '2', '20542125', 'SD NEGERI 2 MLINJON', 'Mlinjon', null, null);
INSERT INTO `sekolah` VALUES ('1754', '14', '1', '20574289', 'TK DHARMA WANITA 2 GAMPING', 'RT 01 RW 01 DS. GAMPING KEC. SURUH', null, null);
INSERT INTO `sekolah` VALUES ('1755', '14', '1', '20574298', 'TK DHARMA WANITA 1 MLINJON', 'RT 16 RW 04 Dusun.Soho', null, null);
INSERT INTO `sekolah` VALUES ('1756', '14', '3', '20566344', 'SMP NEGERI SATU ATAP 1 SURUH', 'Desa Ngrandu', null, null);
INSERT INTO `sekolah` VALUES ('1757', '14', '1', '20574293', 'TK DHARMA WANITA WONOKERTO', 'RT. 10 RW. 01', null, null);
INSERT INTO `sekolah` VALUES ('1758', '14', '2', '20542366', 'SD NEGERI 6 MLINJON', 'Mlinjon', null, null);
INSERT INTO `sekolah` VALUES ('1759', '14', '1', '69810630', 'KB Putra Lingga', 'RT 15 RW 04', null, null);
INSERT INTO `sekolah` VALUES ('1760', '14', '2', '20542022', 'SD NEGERI 1 PURU', 'RT.18 RW.01 Dusun Krajan Banaran', null, null);
INSERT INTO `sekolah` VALUES ('1761', '14', '1', '20574301', 'TK DHARMA WANITA 3 MLINJON', 'RT 35 RW 09 Dusun. Miri', null, null);
INSERT INTO `sekolah` VALUES ('1762', '14', '3', '20542414', 'SMP GOTONG ROYONG 2 SURUH', 'Jl. Trenggalek-Panggul km.19', null, null);
INSERT INTO `sekolah` VALUES ('1763', '14', '1', '69776965', 'SPS ANANDA', 'DSN. GEMPOLAN', null, null);
INSERT INTO `sekolah` VALUES ('1764', '14', '2', '20542285', 'SD NEGERI 3 SURUH', 'Gading', null, null);
INSERT INTO `sekolah` VALUES ('1765', '14', '1', '69776963', 'SPS TUNAS BANGSA', 'RT 10 RW 03 DSN. PONGGOK', null, null);
INSERT INTO `sekolah` VALUES ('1766', '14', '1', '20574287', 'TK DHARMA WANITA 3 SURUH', 'RT. 31 RW. 11', null, null);
INSERT INTO `sekolah` VALUES ('1767', '14', null, '20554366', 'SMK NEGERI 1 SURUH', 'NGUSMAN', null, null);
INSERT INTO `sekolah` VALUES ('1768', '14', '2', '20542354', 'SD NEGERI 5 MLINJON', 'Dusun Soho RT 07 RW 02', null, null);
INSERT INTO `sekolah` VALUES ('1769', '14', '1', '20574303', 'TK DHARMA WANITA 6 MLINJON', 'RT 07 RW 02 DS. MLINJON KEC. SURUH', null, null);
INSERT INTO `sekolah` VALUES ('1770', '14', '1', '20574306', 'TA Al HIdayah Mlinjon', 'RT 27 RW 06 Ds. Mlinjon Kec. Suruh', null, null);
INSERT INTO `sekolah` VALUES ('1771', '14', null, 'P2964905', 'PKBM MITRA', '-', null, null);
INSERT INTO `sekolah` VALUES ('1772', '14', '1', '20574294', 'TK DHARMA WANITA 1 PURU', 'RT 18 RW 01 DS. PURU KEC. SURUH', null, null);
INSERT INTO `sekolah` VALUES ('1773', '14', '2', '20542184', 'SD NEGERI 2 SURUH', 'RT16 RW 6 Jatirejo', null, null);

-- ----------------------------
-- Table structure for tbl_group
-- ----------------------------
DROP TABLE IF EXISTS `tbl_group`;
CREATE TABLE `tbl_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_nama` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_group
-- ----------------------------
INSERT INTO `tbl_group` VALUES ('1', 'Administrator', '2019-08-08 04:26:39', '2019-08-08 05:26:15');
INSERT INTO `tbl_group` VALUES ('3', 'Pengguna', '2019-08-08 05:26:15', '2019-08-08 05:26:15');
INSERT INTO `tbl_group` VALUES ('4', 'Operator', '2019-08-12 06:31:24', '2019-08-12 06:31:24');

-- ----------------------------
-- Table structure for tbl_menu
-- ----------------------------
DROP TABLE IF EXISTS `tbl_menu`;
CREATE TABLE `tbl_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_nama` varchar(200) NOT NULL,
  `menu_link` varchar(200) DEFAULT NULL,
  `menu_id_parent` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_menu
-- ----------------------------
INSERT INTO `tbl_menu` VALUES ('11', 'Manajemen User', 'manajemen_user', '0', '2019-08-13 02:08:33', '2019-08-13 02:08:33');
INSERT INTO `tbl_menu` VALUES ('12', 'Group', 'group', '11', '2019-08-13 02:08:56', '2019-08-13 02:08:56');
INSERT INTO `tbl_menu` VALUES ('13', 'Users', 'master_user', '11', '2019-08-13 02:09:19', '2019-08-13 02:09:19');
INSERT INTO `tbl_menu` VALUES ('14', 'Menu', 'menu', '11', '2019-08-13 02:09:36', '2019-08-13 02:09:36');
INSERT INTO `tbl_menu` VALUES ('25', 'Master', '-', '0', '2021-02-26 09:34:46', '2021-02-26 09:34:46');
INSERT INTO `tbl_menu` VALUES ('26', 'Kecamatan', 'kecamatan', '25', '2021-02-26 09:35:06', '2021-02-26 09:35:06');
INSERT INTO `tbl_menu` VALUES ('28', 'Pejabat', 'pejabat', '25', '2021-03-04 09:41:43', '2021-03-04 09:41:43');
INSERT INTO `tbl_menu` VALUES ('29', 'Jenjang', 'jenjang', '25', '2021-03-04 09:49:27', '2021-03-04 09:49:27');
INSERT INTO `tbl_menu` VALUES ('30', 'Sekolah', 'sekolah', '25', '2021-03-04 09:54:23', '2021-03-04 09:54:23');
INSERT INTO `tbl_menu` VALUES ('31', 'Mutasi Siswa', '-', '0', '2021-03-04 09:55:15', '2021-03-04 09:55:15');
INSERT INTO `tbl_menu` VALUES ('32', 'Mutasi Masuk', 'mutasi_masuk', '31', '2021-03-04 10:42:29', '2021-03-04 10:42:29');
INSERT INTO `tbl_menu` VALUES ('33', 'Mutasi Keluar', 'mutasi_keluar', '31', '2021-03-04 10:42:48', '2021-03-04 10:42:48');
INSERT INTO `tbl_menu` VALUES ('34', 'Laporan', '-', '0', '2021-03-04 11:02:34', '2021-03-04 11:02:34');
INSERT INTO `tbl_menu` VALUES ('35', 'Laporan Mutasi Masuk', 'laporan_mutasi_masuk', '34', '2021-03-04 11:03:11', '2021-03-04 11:03:11');
INSERT INTO `tbl_menu` VALUES ('36', 'Laporan Mutasi Keluar', 'laporan_mutasi_keluar', '34', '2021-03-04 11:03:39', '2021-03-04 11:03:39');

-- ----------------------------
-- Table structure for tbl_t_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_t_user`;
CREATE TABLE `tbl_t_user` (
  `t_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`t_user_id`),
  KEY `t_user__group_relation` (`group_id`),
  KEY `t_user__menu_relation` (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=222 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_t_user
-- ----------------------------
INSERT INTO `tbl_t_user` VALUES ('196', '1', '11', '2021-03-04 11:04:31', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('197', '1', '12', '2021-03-04 11:04:31', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('198', '1', '13', '2021-03-04 11:04:32', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('199', '1', '14', '2021-03-04 11:04:32', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('200', '1', '25', '2021-03-04 11:04:32', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('201', '1', '26', '2021-03-04 11:04:32', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('202', '1', '28', '2021-03-04 11:04:32', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('203', '1', '29', '2021-03-04 11:04:32', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('204', '1', '30', '2021-03-04 11:04:32', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('205', '1', '31', '2021-03-04 11:04:32', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('206', '1', '32', '2021-03-04 11:04:32', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('207', '1', '33', '2021-03-04 11:04:33', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('208', '1', '34', '2021-03-04 11:04:33', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('209', '1', '35', '2021-03-04 11:04:33', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('210', '1', '36', '2021-03-04 11:04:33', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('211', '4', '25', '2021-03-04 11:37:06', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('212', '4', '26', '2021-03-04 11:37:06', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('213', '4', '28', '2021-03-04 11:37:06', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('214', '4', '29', '2021-03-04 11:37:07', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('215', '4', '30', '2021-03-04 11:37:07', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('216', '4', '31', '2021-03-04 11:37:07', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('217', '4', '32', '2021-03-04 11:37:07', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('218', '4', '33', '2021-03-04 11:37:07', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('219', '4', '34', '2021-03-04 11:37:07', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('220', '4', '35', '2021-03-04 11:37:07', '0000-00-00 00:00:00');
INSERT INTO `tbl_t_user` VALUES ('221', '4', '36', '2021-03-04 11:37:07', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `group_relation` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('2', '1', 'harif', 'harif', '$2y$10$JPGfkEr1GA1JYIVXjfr3Nef5maDnYwogLvJpyVPvPelxF0M2qO/Ry', 'harif@gmail.com', 'jw557VVc2EJEbuwsGfxO0MU9jJEEKNqcko62P5hTj9bGybIcWlIla4pz7S1G', null, '2021-02-23 03:15:31');
INSERT INTO `users` VALUES ('3', '4', 'operator', 'operator', '$2y$10$ChwjhPcoAGSJOoYbXyB6c.N8FZxInYcyFjvZ1gKYbS5oYebUmn1Xm', 'operator@gmail.com', 'SVZOUxDIpquQYe6CcKh7leM1uUmPTJfVu0vhQLnZ6WkkS8DPl9eYyYMGbZ0D', '2019-08-08 07:16:08', '2021-03-04 11:36:32');
