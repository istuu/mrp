-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2018 at 07:20 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mrp`
--

-- --------------------------------------------------------

--
-- Table structure for table `diklat_penjenjangan`
--

CREATE TABLE `diklat_penjenjangan` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_diklat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_usulan` date DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_lulus` date DEFAULT NULL,
  `nilai` decimal(5,2) DEFAULT NULL,
  `grade` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_sertifikat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasil_nilai_assesment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pegawai_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `direktorat`
--

CREATE TABLE `direktorat` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pendek` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `direktorat`
--

INSERT INTO `direktorat` (`id`, `nama`, `nama_pendek`, `created_at`, `updated_at`) VALUES
('808e45f0-07e2-11e8-a451-651ae8092d06', 'Direktorat Pengadaan Strategis', 'DITDAN', '2018-02-01 23:30:03', '2018-02-01 23:30:03'),
('808f75e0-07e2-11e8-b5e9-e7005c1f2b4e', 'Direktorat Human Capital and Management', 'DITHCM', '2018-02-01 23:30:03', '2018-02-01 23:30:03'),
('808fe950-07e2-11e8-8c72-fbdefae0ebb9', 'Direktorat Keuangan', 'DITKEU', '2018-02-01 23:30:03', '2018-02-01 23:30:03'),
('80906240-07e2-11e8-bfcd-3d3422b785cf', 'DIREKTORAT BISNIS REGIONAL JAWA BAGIAN BARAT', 'DITREG-JBB', '2018-02-01 23:30:03', '2018-02-01 23:30:03'),
('8090e200-07e2-11e8-b790-9df35cc2086e', ' DIREKTORAT BISNIS REGIONAL JAWA BAGIAN TENGAH', 'DITREG-JBT', '2018-02-01 23:30:03', '2018-02-01 23:30:03'),
('80916340-07e2-11e8-aca9-d1481e3a838b', 'DIREKTORAT BISNIS REGIONAL JAWA BAGIAN TIMUR DAN BALI', 'DITREG-JBTB', '2018-02-01 23:30:03', '2018-02-01 23:30:03'),
('8091f940-07e2-11e8-8bc6-479ea832cdb1', 'DIREKTORAT BISNIS REGIONAL KALIMANTAN', 'DITREG-KAL', '2018-02-01 23:30:03', '2018-02-01 23:30:03'),
('80927250-07e2-11e8-8245-895699e946fe', 'DIREKTORAT BISNIS REGIONAL MALUKU DAN PAPUA', 'DITREG-MP', '2018-02-01 23:30:03', '2018-02-01 23:30:03'),
('8092f1e0-07e2-11e8-9825-d5d8b05000b8', 'DIREKTORAT BISNIS REGIONAL SULAWESI DAN NUSA TENGGARA', 'DITREG-SNT', '2018-02-01 23:30:03', '2018-02-01 23:30:03'),
('809371e0-07e2-11e8-b136-b7c94d9cc47e', 'DIREKTORAT BISNIS REGIONAL SUMATERA', 'DITREG-SUM', '2018-02-01 23:30:03', '2018-02-01 23:30:03'),
('8093f2b0-07e2-11e8-8e20-851e0472dadb', 'DIREKTORAT PERENCANAAN KORPORAT', 'DITREN', '2018-02-01 23:30:03', '2018-02-01 23:30:03'),
('80946820-07e2-11e8-ac94-c9f6fb10a4a6', '', 'SATUAN', '2018-02-01 23:30:03', '2018-02-01 23:30:03'),
('bea77980-2932-11e8-8b85-673afbff84ed', 'Direktorat Pengadaan Strategis', 'DITDAN', '2018-03-16 08:57:35', '2018-03-16 08:57:35'),
('beaa3ed0-2932-11e8-9ad4-31efa18dbb37', 'Direktorat Human Capital and Management', 'DITHCM', '2018-03-16 08:57:35', '2018-03-16 08:57:35'),
('beaac3b0-2932-11e8-86fe-b14c10026802', 'Direktorat Keuangan', 'DITKEU', '2018-03-16 08:57:35', '2018-03-16 08:57:35'),
('beab6c20-2932-11e8-a696-27ce3c5b0895', 'DIREKTORAT BISNIS REGIONAL JAWA BAGIAN BARAT', 'DITREG-JBB', '2018-03-16 08:57:35', '2018-03-16 08:57:35'),
('beacb3c0-2932-11e8-9b7c-a5083fd9dda3', ' DIREKTORAT BISNIS REGIONAL JAWA BAGIAN TENGAH', 'DITREG-JBT', '2018-03-16 08:57:35', '2018-03-16 08:57:35'),
('bead69d0-2932-11e8-b0ac-71ed8c1de142', 'DIREKTORAT BISNIS REGIONAL JAWA BAGIAN TIMUR DAN BALI', 'DITREG-JBTB', '2018-03-16 08:57:35', '2018-03-16 08:57:35'),
('beae1400-2932-11e8-9a81-7d987dfa5735', 'DIREKTORAT BISNIS REGIONAL KALIMANTAN', 'DITREG-KAL', '2018-03-16 08:57:35', '2018-03-16 08:57:35'),
('beaebe00-2932-11e8-9478-9b1ecaaac59a', 'DIREKTORAT BISNIS REGIONAL MALUKU DAN PAPUA', 'DITREG-MP', '2018-03-16 08:57:35', '2018-03-16 08:57:35'),
('beaf6460-2932-11e8-afbd-1dd3b8cbb2c7', 'DIREKTORAT BISNIS REGIONAL SULAWESI DAN NUSA TENGGARA', 'DITREG-SNT', '2018-03-16 08:57:35', '2018-03-16 08:57:35'),
('beb00a50-2932-11e8-af6c-3df23ab9a37e', 'DIREKTORAT BISNIS REGIONAL SUMATERA', 'DITREG-SUM', '2018-03-16 08:57:35', '2018-03-16 08:57:35'),
('beb0bca0-2932-11e8-bb8d-eb139fddce63', 'DIREKTORAT PERENCANAAN KORPORAT', 'DITREN', '2018-03-16 08:57:35', '2018-03-16 08:57:35'),
('beb16660-2932-11e8-833c-a1603eeec065', '', 'SATUAN', '2018-03-16 08:57:35', '2018-03-16 08:57:35');

-- --------------------------------------------------------

--
-- Table structure for table `formasi_jabatan`
--

CREATE TABLE `formasi_jabatan` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_olah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `legacy_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posisi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hgl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `formasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenjang_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenjang_txt` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pagu` int(11) NOT NULL,
  `spfj` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_fj` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personnel_area_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `formasi_jabatan`
--

INSERT INTO `formasi_jabatan` (`id`, `kode_olah`, `legacy_code`, `level`, `posisi`, `kelas_unit`, `hgl`, `formasi`, `jabatan`, `jenjang_id`, `jenjang_txt`, `pagu`, `spfj`, `status_fj`, `personnel_area_id`, `created_at`, `updated_at`) VALUES
('80d51660-07e2-11e8-ac9a-018e6113e7b8', 'DITDAN-15166401.MA', '15166401', 'KP', 'DIREKTORAT PENGADAAN PT PLN (PERSERO) KANTOR PUSAT', NULL, NULL, 'Kepala Divisi', 'Perijinan dan Pertanahan', 'MA', 'Manajemen Atas', 1, '0324.P/DIR/2016', '', '80a9a900-07e2-11e8-928e-29bb2abb4aac', '2018-02-01 23:30:04', '2018-02-01 23:30:04'),
('80d5a0a0-07e2-11e8-a3e9-33d8faa81855', 'DITDAN-151664020101.F04', '15166401', 'KP', 'SUB BIDANG PENGADAAN 1 BIDANG PELAKSANA PENGADAAN I DIVISI PENGADAAN STRATEGIS DIREKTORAT PENGADAAN PT PLN (PERSERO) KANTOR PUSAT', NULL, NULL, 'Analyst', 'Pengadaan', '04', 'Fungsional IV', 5, '0324.P/DIR/2016', '', '809fa0e0-07e2-11e8-b122-5d78987763c1', '2018-02-01 23:30:04', '2018-02-01 23:30:04'),
('80d631a0-07e2-11e8-a813-93f6e03a5ec2', 'DITREG-JBB-1516730101.MM', '1516730101', 'KP', 'DIVISI PENGEMBANGAN REGIONAL JAWA BAGIAN BARAT DIREKTORAT BISNIS REGIONAL JAWA BAGIAN BARAT PT PLN (PERSERO) KANTOR PUSAT', NULL, NULL, 'Manajer Senior', 'Perencanaan dan Pengendalian Regional Jawa Bagian Barat', 'MM', 'Manajemen Menengah', 5, '0037.P/DIR/2016', '', '80a9a900-07e2-11e8-928e-29bb2abb4aac', '2018-02-01 23:30:04', '2018-02-01 23:30:04'),
('80d6bbf0-07e2-11e8-b314-83e05bfe3e3b', 'DITREG-JBB-151673010101.MD', '151673010101', 'UI', 'BIDANG PERENCANAAN DAN PENGENDALIAN REGIONAL JAWA BAGIAN BARAT DIVISI PENGEMBANGAN REGIONAL JAWA BAGIAN BARAT DIREKTORAT BISNIS REGIONAL JAWA BAGIAN BARAT PT PLN (PERSERO) KANTOR PUSAT', NULL, NULL, 'Deputi Manajer', 'Perencanaan Regional', 'MD', 'Manajemen Dasar', 1, '0037.P/DIR/2016', '', '80a9a900-07e2-11e8-928e-29bb2abb4aac', '2018-02-01 23:30:04', '2018-02-01 23:30:04'),
('80d74400-07e2-11e8-b0d7-6987ce061962', 'DITHCM-1516650301.MM', '1516650301', 'KP', 'DIVISI PENGEMBANGAN TALENTA DIREKTORAT HUMAN CAPITAL MANAGEMENT PT PLN (PERSERO) KANTOR PUSAT', NULL, NULL, 'Manajer Senior', 'Rekrutmen dan Seleksi', 'MM', 'Manajemen Menengah', 1, '0032.P/DIR/2017', '', '80caca00-07e2-11e8-9a24-23ead6d49d24', '2018-02-01 23:30:04', '2018-02-01 23:30:04'),
('80d7cba0-07e2-11e8-85aa-0f3b6a12231b', 'DITHCM-151665030401.F05', '151665030401', 'KP', 'SUB BIDANG PENGELOLAAN KARIR DAN TALENTA BIDANG PENGELOLAAN KARIR DAN TALENTA II DIVISI PENGEMBANGAN TALENTA DIREKTORAT HUMAN CAPITAL MANAGEMENT PT PLN (PERSERO) KANTOR PUSAT', NULL, NULL, 'Assistant Analyst', 'Pengelolaan Karir', '05', 'Fungsional V', 1, '0032.P/DIR/2017', '', '80c0fba0-07e2-11e8-9809-7156e8703bce', '2018-02-01 23:30:04', '2018-02-01 23:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `frs`
--

CREATE TABLE `frs` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bidang_profesi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konsentrasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tindaklanjut` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lt` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasil_penjabatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_sk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pegawai_tetap` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_sk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instansi_akademik` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id` int(10) UNSIGNED NOT NULL,
  `kota` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id`, `kota`, `provinsi_id`, `created_at`, `updated_at`) VALUES
(1, 'Pandeglang', '1', '2018-02-01 23:30:04', '2018-02-01 23:30:04'),
(2, 'Serang', '1', '2018-02-01 23:30:04', '2018-02-01 23:30:04'),
(3, 'Tebet', '2', '2018-02-01 23:30:04', '2018-02-01 23:30:04'),
(4, 'Tanah Abang', '2', '2018-02-01 23:30:04', '2018-02-01 23:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_01_09_024336_create_direktorats_table', 1),
(2, '2018_01_09_024747_create_formasi_jabatans_table', 1),
(3, '2018_01_09_030403_create_personnel_areas_table', 1),
(4, '2018_01_09_031557_create_pegawais_table', 1),
(5, '2018_01_09_032509_create_f_r_s_table', 1),
(6, '2018_01_09_034317_create_s_k_s_tgs_table', 1),
(7, '2018_01_09_034703_create_diklat_penjenjangans_table', 1),
(8, '2018_01_09_040959_create_m_r_ps_table', 1),
(9, '2018_01_12_042615_create_penilaian_pegawais_table', 1),
(10, '2018_01_17_024759_create_table_provinsi', 1),
(11, '2018_01_17_025143_create_table_kota', 1),
(12, '2018_01_21_145439_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mrp`
--

CREATE TABLE `mrp` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registry_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_mutasi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mutasi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jalur_mutasi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alasan_mutasi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_pengusul` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fj_asal` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fj_tujuan` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_dokumen_unit_usul` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename_dokumen_unit_usul` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_dokumen_unit_usul` date DEFAULT NULL,
  `no_dokumen_unit_jawab` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename_dokumen_unit_jawab` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_dokumen_unit_jawab` date DEFAULT NULL,
  `no_dokumen_respon_sdm` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename_dokumen_respon_sdm` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_dokumen_mutasi` date DEFAULT NULL,
  `tgl_evaluasi` date DEFAULT NULL,
  `requested_tgl_aktivasi` date DEFAULT NULL,
  `tgl_pooling` date DEFAULT NULL,
  `tipe` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `tindak_lanjut` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skstg_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pegawai_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip_pengusul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_operator` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota_asal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_domisili` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pegawai` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_subgroup` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ps_group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `talent_pool_position` int(11) DEFAULT NULL,
  `tanggal_grade` date NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_capeg` date NOT NULL,
  `tanggal_pegawai` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `kali_jenjang` int(11) DEFAULT NULL,
  `tanggal_unit_induk_akhir` date DEFAULT NULL,
  `nip_sutri` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lc_atasan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `top_unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `top_0` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `top_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `top_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `top_3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `formasi_jabatan_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `perner`, `nip`, `no_hp`, `email`, `kota_asal`, `status_domisili`, `nama_pegawai`, `employee_subgroup`, `ps_group`, `talent_pool_position`, `tanggal_grade`, `tanggal_lahir`, `tanggal_masuk`, `tanggal_capeg`, `tanggal_pegawai`, `start_date`, `end_date`, `kali_jenjang`, `tanggal_unit_induk_akhir`, `nip_sutri`, `lc_atasan`, `top_unit`, `top_0`, `top_1`, `top_2`, `top_3`, `formasi_jabatan_id`, `created_at`, `updated_at`) VALUES
('80d8a7c0-07e2-11e8-ba1a-099cd304918f', '12345321', '5115100006', '082134343434', 'hero@gmail.com', 'Jember', NULL, 'Hero Akbar Ahmadi', 'Struktural', 'SYS04', NULL, '2017-12-10', '1995-08-01', '2010-07-07', '2010-07-09', '2010-07-10', '2010-07-10', '2051-08-01', 1, '2013-07-17', '5115115115', 'test', NULL, NULL, NULL, NULL, NULL, '80d631a0-07e2-11e8-a813-93f6e03a5ec2', '2018-02-01 23:30:04', '2018-02-01 23:30:04'),
('80da8230-07e2-11e8-a206-5bd514fd02ed', '123456', '123456SDM', '08943171282', 'sdm@gmail.com', 'Jakarta', NULL, 'AKU ORANG SDM', 'Struktural', 'SYS03', NULL, '2016-07-01', '1979-10-06', '2006-01-01', '2006-01-01', '2006-01-01', '2017-11-01', '2021-10-10', 2, '2017-11-01', '', 'test', NULL, NULL, NULL, NULL, NULL, '80d7cba0-07e2-11e8-85aa-0f3b6a12231b', '2018-02-01 23:30:04', '2018-02-01 23:30:04'),
('80db1800-07e2-11e8-bd70-372fffb68490', '1234562', 'karir2', '089431282', 'karir2@gmail.com', 'Jakarta', NULL, 'AKU ORANG karir2', 'Struktural', 'SYS03', NULL, '2016-07-01', '1979-10-06', '2006-01-01', '2006-01-01', '2006-01-01', '2017-11-01', '2021-10-10', 2, '2017-11-01', '', 'test', NULL, NULL, NULL, NULL, NULL, '80d74400-07e2-11e8-b0d7-6987ce061962', '2018-02-01 23:30:04', '2018-02-01 23:30:04'),
('80d9efa0-07e2-11e8-bc24-3f4e88e5f2d6', '79060600', '7906091Z', '081234567123', 'endahc@gmail.com', 'Jakarta', NULL, 'Y ENDAH CAHYANINGRUM', 'Struktural', 'SYS03', NULL, '2016-07-01', '1979-10-06', '2006-01-01', '2006-01-01', '2006-01-01', '2017-11-01', '2018-02-02', 2, '2017-11-01', '', 'test', NULL, NULL, NULL, NULL, NULL, '80d6bbf0-07e2-11e8-b314-83e05bfe3e3b', '2018-02-01 23:30:04', '2018-02-01 23:30:04'),
('80d94620-07e2-11e8-9a70-d75ff1ddf17a', '8176128', '5115115115', '0821343435514', 'dia@gmail.com', 'Sana', NULL, 'Istrinya Hero', 'Struktural', 'SYS04', NULL, '2017-12-10', '1995-08-01', '2010-07-07', '2010-07-09', '2010-07-10', '2010-07-10', '2051-08-01', 1, '2013-07-17', '5115100006', 'test', NULL, NULL, NULL, NULL, NULL, '80d5a0a0-07e2-11e8-a3e9-33d8faa81855', '2018-02-01 23:30:04', '2018-02-01 23:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_pegawai`
--

CREATE TABLE `penilaian_pegawai` (
  `id` int(10) UNSIGNED NOT NULL,
  `pegawai_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creative` int(11) NOT NULL,
  `enthusiastic` int(11) NOT NULL,
  `building` int(11) NOT NULL,
  `strategic` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `driving` int(11) NOT NULL,
  `visionary` int(11) NOT NULL,
  `empowering` int(11) NOT NULL,
  `komunikasi` int(11) NOT NULL,
  `team_work` int(11) NOT NULL,
  `bahasa_1_nilai` int(11) NOT NULL,
  `bahasa_2_nilai` int(11) NOT NULL,
  `bahasa_3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bahasa_3_nilai` int(11) DEFAULT NULL,
  `kesehatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `career_willingness` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `external_rediness` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hubungan_sesama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hubungan_atasan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mrp_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personnel_area`
--

CREATE TABLE `personnel_area` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pendek` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role` int(11) NOT NULL DEFAULT '3',
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direktorat_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personnel_area`
--

INSERT INTO `personnel_area` (`id`, `nama`, `nama_pendek`, `username`, `password`, `user_role`, `alamat`, `kota`, `provinsi`, `direktorat_id`, `created_at`, `updated_at`) VALUES
('80a9a900-07e2-11e8-928e-29bb2abb4aac', 'DISTRIBUSI JAWA BARAT', 'DISJABAR', 'disjabar', '$2y$10$AQgOTT53NdSeZNemtilA6OZvox7TrDxgPYkGGHsZ40Z9wskk1J6me', 1, NULL, NULL, NULL, '80906240-07e2-11e8-bfcd-3d3422b785cf', '2018-02-01 23:30:03', '2018-02-01 23:30:03'),
('809fa0e0-07e2-11e8-b122-5d78987763c1', 'DIVISI PENGADAAN STRATEGIS DIREKTORAT PENGADAAN PT PLN (PERSERO) KANTOR PUSAT', 'DIVDAS', 'divdas', '$2y$10$BWuYR91YRRNx2O8j11thYuDx3EobeM14XXrgOCPAinYIHm6XGvHDe', 1, NULL, NULL, NULL, '808e45f0-07e2-11e8-a451-651ae8092d06', '2018-02-01 23:30:03', '2018-02-01 23:30:03'),
('80955320-07e2-11e8-ac7e-7f625dfcb830', 'DIVISI PERIZINAN DAN PERTANAHAN DIREKTORAT PENGADAAN', 'DIVPPT', 'divppt1', '$2y$10$jM9dOoIoRywbDb.3E8sKTuXej5AK8UYEwlDubeOAmbYz6swJeYaOC', 1, NULL, NULL, NULL, '808e45f0-07e2-11e8-a451-651ae8092d06', '2018-02-01 23:30:03', '2018-02-01 23:30:03'),
('80b70920-07e2-11e8-b8a8-efa397d8e800', 'DIVISI PENGEMBANGAN TALENTA', 'DIVTLN', 'divtln', '$2y$10$IRSKL.9O8Gs9DdaiLuK8Y.F89QnLhnwgsoXgZxk2On3ZIBh7YjeLq', 1, NULL, NULL, NULL, '808f75e0-07e2-11e8-b5e9-e7005c1f2b4e', '2018-02-01 23:30:03', '2018-02-01 23:30:03'),
('80caca00-07e2-11e8-9a24-23ead6d49d24', 'Karir 2', 'Karir 2', 'karir2', '$2y$10$unNOeQ9zhUsMbL4vYeKuQelkxKUu/lnuZorbXsfPsiXM71egMrWOy', 2, NULL, NULL, NULL, '80906240-07e2-11e8-bfcd-3d3422b785cf', '2018-02-01 23:30:04', '2018-02-01 23:30:04'),
('80c0fba0-07e2-11e8-9809-7156e8703bce', 'SDM', 'SDM', 'sdm', '$2y$10$rENh/Cy3OU0rSpoeRp1O4.UXZlW0.7.JU0VAuTzZ6/Yu6EvrbwiNa', 3, NULL, NULL, NULL, '808fe950-07e2-11e8-8c72-fbdefae0ebb9', '2018-02-01 23:30:03', '2018-02-01 23:30:03');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id` int(10) UNSIGNED NOT NULL,
  `provinsi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id`, `provinsi`, `created_at`, `updated_at`) VALUES
(1, 'Banten', '2018-02-01 23:30:04', '2018-02-01 23:30:04'),
(2, 'DKI Jakarta', '2018-02-01 23:30:04', '2018-02-01 23:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `sk_stg`
--

CREATE TABLE `sk_stg` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_sk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_sk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_dokumen_kirim_sk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename_dokumen_sk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_kirim_sk` date NOT NULL,
  `tgl_aktivasi` date NOT NULL,
  `no_stg` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mrp_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diklat_penjenjangan`
--
ALTER TABLE `diklat_penjenjangan`
  ADD KEY `diklat_penjenjangan_pegawai_id_index` (`pegawai_id`);

--
-- Indexes for table `formasi_jabatan`
--
ALTER TABLE `formasi_jabatan`
  ADD KEY `formasi_jabatan_personnel_area_id_index` (`personnel_area_id`);

--
-- Indexes for table `frs`
--
ALTER TABLE `frs`
  ADD UNIQUE KEY `frs_nip_unique` (`nip`),
  ADD UNIQUE KEY `frs_perner_unique` (`perner`),
  ADD UNIQUE KEY `frs_no_sk_unique` (`no_sk`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kota_provinsi_id_index` (`provinsi_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mrp`
--
ALTER TABLE `mrp`
  ADD KEY `mrp_pegawai_id_index` (`pegawai_id`),
  ADD KEY `mrp_skstg_id_index` (`skstg_id`),
  ADD KEY `mrp_fj_asal_index` (`fj_asal`),
  ADD KEY `mrp_fj_tujuan_index` (`fj_tujuan`),
  ADD KEY `mrp_unit_pengusul_index` (`unit_pengusul`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD UNIQUE KEY `pegawai_perner_unique` (`perner`),
  ADD UNIQUE KEY `pegawai_nip_unique` (`nip`),
  ADD UNIQUE KEY `pegawai_no_hp_unique` (`no_hp`),
  ADD UNIQUE KEY `pegawai_email_unique` (`email`),
  ADD KEY `pegawai_formasi_jabatan_id_index` (`formasi_jabatan_id`);

--
-- Indexes for table `penilaian_pegawai`
--
ALTER TABLE `penilaian_pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaian_pegawai_pegawai_id_mrp_id_index` (`pegawai_id`,`mrp_id`);

--
-- Indexes for table `personnel_area`
--
ALTER TABLE `personnel_area`
  ADD UNIQUE KEY `personnel_area_username_unique` (`username`),
  ADD KEY `personnel_area_direktorat_id_index` (`direktorat_id`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sk_stg`
--
ALTER TABLE `sk_stg`
  ADD UNIQUE KEY `sk_stg_no_sk_unique` (`no_sk`),
  ADD UNIQUE KEY `sk_stg_no_dokumen_kirim_sk_unique` (`no_dokumen_kirim_sk`),
  ADD UNIQUE KEY `sk_stg_filename_dokumen_sk_unique` (`filename_dokumen_sk`),
  ADD UNIQUE KEY `sk_stg_no_stg_unique` (`no_stg`),
  ADD KEY `sk_stg_mrp_id_index` (`mrp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `penilaian_pegawai`
--
ALTER TABLE `penilaian_pegawai`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
