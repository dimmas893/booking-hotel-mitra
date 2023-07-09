-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2023 at 01:29 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking_mitra`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `id_user`, `photo`, `token`, `created_at`, `updated_at`) VALUES
(8, 23, 'foto-admin2Lvix.jpg', NULL, '2023-04-11 21:46:19', '2023-04-11 21:46:19');

-- --------------------------------------------------------

--
-- Table structure for table `booking_pool`
--

CREATE TABLE `booking_pool` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `booking_date` text NOT NULL,
  `link_pembayaran` varchar(255) DEFAULT NULL,
  `batas_bayar` date DEFAULT NULL,
  `order_no` text NOT NULL,
  `idfasilkolam` int(11) NOT NULL,
  `status` varchar(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` text NOT NULL,
  `phone` text DEFAULT NULL,
  `country` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` text DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `id_user`, `name`, `phone`, `country`, `address`, `city`, `photo`, `created_at`, `updated_at`) VALUES
(8, 17, 'sd', 'sddsd', NULL, 'ds', 'dsd', NULL, '2023-04-07 13:10:08', '2023-04-07 13:10:08'),
(9, 18, 'customor', '089329396892', NULL, 'sadasda', 'blora', NULL, '2023-04-07 13:14:57', '2023-04-07 13:14:57'),
(10, 19, 'dimmas', '089098890098', NULL, 'sdwasdwas', 'kota', NULL, '2023-04-09 14:06:55', '2023-04-09 14:06:55'),
(11, 21, 'hani', '0980980989089080', NULL, 'jkljklj', 'jljlkjkl', NULL, '2023-04-11 21:29:41', '2023-04-11 21:29:41');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'Website Question 1', '<p>Lorem ipsum dolor sit amet, ut has quidam prodesset, eos sumo ipsum civibus ea, vel quas nusquam ei. Et sea doming quodsi audire. No vim ornatus scaevola disputando, qui stet ceteros ad. Ad his choro appetere mnesarchum, no duo accusata incorrupte, vel essent fabulas ut.</p><p>Ne nam soluta libris. Cu sea utamur adipiscing, convenire patrioque dignissim et nec. Accusam incorrupte vituperatoribus vix ad, ei clita omnium mentitum pro. Est ad duis perpetua recteque, in autem posidonium qui. Illum nulla dolor mea an.<br></p><p>Officiis disputationi ne pri, libris malorum eam id. Molestie principes vix no. Ut velit iudicabit inciderint mea. Malorum mediocrem deseruisse nam ne, tale imperdiet vim ut. Aperiri splendide cu eos, vis in alia laoreet aliquando.<br></p>', '2022-06-26 23:48:59', '2022-06-26 23:48:59'),
(2, 'Website Question 2', '<p>Lorem ipsum dolor sit amet, ut has quidam prodesset, eos sumo ipsum civibus ea, vel quas nusquam ei. Et sea doming quodsi audire. No vim ornatus scaevola disputando, qui stet ceteros ad. Ad his choro appetere mnesarchum, no duo accusata incorrupte, vel essent fabulas ut.</p><p>Ne nam soluta libris. Cu sea utamur adipiscing, convenire patrioque dignissim et nec. Accusam incorrupte vituperatoribus vix ad, ei clita omnium mentitum pro. Est ad duis perpetua recteque, in autem posidonium qui. Illum nulla dolor mea an.<br></p><p>Officiis disputationi ne pri, libris malorum eam id. Molestie principes vix no. Ut velit iudicabit inciderint mea. Malorum mediocrem deseruisse nam ne, tale imperdiet vim ut. Aperiri splendide cu eos, vis in alia laoreet aliquando.</p>', '2022-06-26 23:50:18', '2022-06-26 23:50:18'),
(3, 'Website Question 3', '<p>Lorem ipsum dolor sit amet, ut has quidam prodesset, eos sumo ipsum civibus ea, vel quas nusquam ei. Et sea doming quodsi audire. No vim ornatus scaevola disputando, qui stet ceteros ad. Ad his choro appetere mnesarchum, no duo accusata incorrupte, vel essent fabulas ut.</p><p>Ne nam soluta libris. Cu sea utamur adipiscing, convenire patrioque dignissim et nec. Accusam incorrupte vituperatoribus vix ad, ei clita omnium mentitum pro. Est ad duis perpetua recteque, in autem posidonium qui. Illum nulla dolor mea an.<br></p><p>Officiis disputationi ne pri, libris malorum eam id. Molestie principes vix no. Ut velit iudicabit inciderint mea. Malorum mediocrem deseruisse nam ne, tale imperdiet vim ut. Aperiri splendide cu eos, vis in alia laoreet aliquando.</p>', '2022-06-26 23:50:33', '2022-06-26 23:50:33'),
(4, 'Website Question 4', '<p>Lorem ipsum dolor sit amet, ut has quidam prodesset, eos sumo ipsum civibus ea, vel quas nusquam ei. Et sea doming quodsi audire. No vim ornatus scaevola disputando, qui stet ceteros ad. Ad his choro appetere mnesarchum, no duo accusata incorrupte, vel essent fabulas ut.</p><p>Ne nam soluta libris. Cu sea utamur adipiscing, convenire patrioque dignissim et nec. Accusam incorrupte vituperatoribus vix ad, ei clita omnium mentitum pro. Est ad duis perpetua recteque, in autem posidonium qui. Illum nulla dolor mea an.<br></p><p>Officiis disputationi ne pri, libris malorum eam id. Molestie principes vix no. Ut velit iudicabit inciderint mea. Malorum mediocrem deseruisse nam ne, tale imperdiet vim ut. Aperiri splendide cu eos, vis in alia laoreet aliquando.</p>', '2022-06-26 23:50:48', '2022-06-26 23:50:48');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int(11) NOT NULL,
  `idjenisfasilitas` int(11) NOT NULL,
  `namafasilitas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `idjenisfasilitas`, `namafasilitas`, `created_at`, `updated_at`) VALUES
(1, 2, 'Kolam Renang', NULL, NULL),
(2, 2, 'Restoran', NULL, NULL),
(4, 1, 'gratis kolam renang', '2023-04-10 20:51:01', '2023-04-10 20:51:01');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitasmitra`
--

CREATE TABLE `fasilitasmitra` (
  `id` int(11) NOT NULL,
  `idperjanjianmitra` int(11) DEFAULT NULL,
  `idmitra` int(11) NOT NULL,
  `idfasilitas` int(11) NOT NULL,
  `deskrispsifasilitas` text NOT NULL,
  `specfasilitasi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fasilkolamrenang`
--

CREATE TABLE `fasilkolamrenang` (
  `id` int(11) NOT NULL,
  `idperjanjianmitra` int(11) DEFAULT NULL,
  `idfasilmitra` int(11) NOT NULL,
  `idmitra` int(11) DEFAULT NULL,
  `idsepakatmitra` int(11) NOT NULL,
  `biayaperorang` int(11) NOT NULL,
  `idunit` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hargasepakatmitra`
--

CREATE TABLE `hargasepakatmitra` (
  `id` int(11) NOT NULL,
  `idperjanjianmitra` int(11) NOT NULL,
  `idfasilitas` int(11) DEFAULT NULL,
  `hargaperorang` int(11) NOT NULL,
  `idunit` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwalfasilkolam`
--

CREATE TABLE `jadwalfasilkolam` (
  `id` int(11) NOT NULL,
  `idfasilmitra` int(11) NOT NULL,
  `idmitra` int(11) NOT NULL,
  `tanggalbuka` date NOT NULL,
  `jambuka` time NOT NULL,
  `jamtutup` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenisfasilitas`
--

CREATE TABLE `jenisfasilitas` (
  `id` int(11) NOT NULL,
  `namajenisfasilitas` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenisfasilitas`
--

INSERT INTO `jenisfasilitas` (`id`, `namajenisfasilitas`, `created_at`, `updated_at`) VALUES
(1, 'Kamar', NULL, NULL),
(2, 'Non Kamar', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenismitra`
--

CREATE TABLE `jenismitra` (
  `id` int(11) NOT NULL,
  `namajenismitra` varchar(30) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenismitra`
--

INSERT INTO `jenismitra` (`id`, `namajenismitra`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Hotel', 'deskripsi hotel', NULL, '2023-04-01 11:27:37'),
(2, 'Apartment', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2023_04_14_030347_create_pencarians_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `idjenismitra` int(11) NOT NULL,
  `namamitra` varchar(200) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `alamatmitralengkap` text NOT NULL,
  `foto` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`id`, `id_user`, `idjenismitra`, `namamitra`, `longitude`, `latitude`, `alamatmitralengkap`, `foto`, `created_at`, `updated_at`) VALUES
(5, 22, 1, 'mitra', 'usdiuaoiusd', 'iauisudiw', 'Jl. Semarang 5 Malang 65145 Jawa Timur Indonesia', 'foto-mitra-M0TWQ.jpg', '2023-04-11 21:45:45', '2023-04-11 21:45:45');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_no` text NOT NULL,
  `payment_method` text NOT NULL,
  `bukti_pembayaran` text DEFAULT NULL,
  `paid_amount` text NOT NULL,
  `booking_date` text NOT NULL,
  `status` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idfasilmitra` int(11) NOT NULL,
  `order_no` text NOT NULL,
  `checkin_date` text NOT NULL,
  `timein` time NOT NULL,
  `adult` text NOT NULL,
  `subtotal` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pencarians`
--

CREATE TABLE `pencarians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mitra_id` int(11) NOT NULL,
  `pencarian` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pencarians`
--

INSERT INTO `pencarians` (`id`, `mitra_id`, `pencarian`, `created_at`, `updated_at`) VALUES
(1, 5, 4, '2023-07-09 23:26:45', '2023-07-09 23:27:41');

-- --------------------------------------------------------

--
-- Table structure for table `pendapatanmitra`
--

CREATE TABLE `pendapatanmitra` (
  `id` int(11) NOT NULL,
  `idmitra` int(11) NOT NULL,
  `periodeawal` date NOT NULL,
  `periodeakhir` date NOT NULL,
  `nilaiuang` int(11) NOT NULL,
  `tglditerima` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perjanjianmitra`
--

CREATE TABLE `perjanjianmitra` (
  `id` int(11) NOT NULL,
  `idmitra` int(11) NOT NULL,
  `noperjanjian` varchar(200) NOT NULL,
  `tglawalberlaku` date NOT NULL,
  `tglakhirberlaku` date NOT NULL,
  `tglditandatangani` date NOT NULL,
  `namapihakowner1` varchar(200) NOT NULL,
  `namapihakowner2` varchar(200) NOT NULL,
  `namapihakmitra1` varchar(200) NOT NULL,
  `namapihakmitra2` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perjanjianmitra`
--

INSERT INTO `perjanjianmitra` (`id`, `idmitra`, `noperjanjian`, `tglawalberlaku`, `tglakhirberlaku`, `tglditandatangani`, `namapihakowner1`, `namapihakowner2`, `namapihakmitra1`, `namapihakmitra2`, `created_at`, `updated_at`) VALUES
(10, 5, 'perjanjianJLkjC', '2023-07-09', '2023-07-14', '2023-07-14', 'ssd', 'hjh', 'jhj', 'hj', '2023-07-09 23:27:27', '2023-07-09 23:27:27');

-- --------------------------------------------------------

--
-- Table structure for table `rekeningowner`
--

CREATE TABLE `rekeningowner` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `atas_nama` varchar(255) NOT NULL,
  `no_rekening` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekeningowner`
--

INSERT INTO `rekeningowner` (`id`, `bank_name`, `atas_nama`, `no_rekening`, `created_at`, `updated_at`) VALUES
(6, 'BRI', 'Ananda Dimmas Budiarto', '898909090', '2023-04-02 05:37:08', '2023-04-02 05:38:21');

-- --------------------------------------------------------

--
-- Table structure for table `sopmitra`
--

CREATE TABLE `sopmitra` (
  `id` int(11) NOT NULL,
  `idfasilmitra` int(11) NOT NULL,
  `namasop` text NOT NULL,
  `deskripsisop` text NOT NULL,
  `tglawalberlakusop` date NOT NULL,
  `tglakhirsop` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `idfasilmitra` int(11) NOT NULL,
  `photo` text NOT NULL,
  `name` text NOT NULL,
  `designation` text NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `customer_id`, `idfasilmitra`, `photo`, `name`, `designation`, `comment`, `created_at`, `updated_at`) VALUES
(1, 0, 0, '1656215578.jpg', 'Robert Peter', 'CEO, AA Company', 'Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has. Latine propriae quo no, unum ridens. Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has. Latine propriae quo no, unum ridens.', '2022-06-25 21:52:58', '2022-06-25 21:52:58'),
(2, 0, 0, '1665930645.jpg', 'Nasrul Kurniawan', 'Dinas Sosial', 'Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has. Latine propriae quo no, unum ridens. Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has. Latine propriae quo no, unum ridens.', '2022-06-25 21:54:48', '2022-10-16 07:30:45');

-- --------------------------------------------------------

--
-- Table structure for table `unitsewafasilitas`
--

CREATE TABLE `unitsewafasilitas` (
  `id` int(11) NOT NULL,
  `namaunit` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unitsewafasilitas`
--

INSERT INTO `unitsewafasilitas` (`id`, `namaunit`, `created_at`, `updated_at`) VALUES
(1, 'Hari', NULL, NULL),
(2, 'Jam', NULL, NULL),
(3, 'Satuan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(19, 'admin', 'nama mitra', 'dimmas@gmail.com', NULL, '$2y$10$2MkmK9eLeQ0qNPpt8pmHh.9a7bX0wxpqE7LisXb6dPk12VRDUCO1a', NULL, '2023-04-09 14:06:55', '2023-04-11 19:07:49'),
(22, 'mitra', 'mitra', 'mitra@gmail.com', NULL, '$2y$10$QTngjQow1SeQ0z6uGxp3Aeilsfttf6cwKEgDNHON8gEdK1RbGDghm', NULL, '2023-04-11 21:45:45', '2023-04-11 21:45:45'),
(23, 'admin', 'admin', 'admin@gmail.com', NULL, '$2y$10$sd6ZzOQ..sEDDvbpKgw5i.cRhmRRkkf31BfdabTGm.U4o61kfoL12', NULL, '2023-04-11 21:46:19', '2023-04-11 21:46:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_pool`
--
ALTER TABLE `booking_pool`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fasilitasmitra`
--
ALTER TABLE `fasilitasmitra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fasilkolamrenang`
--
ALTER TABLE `fasilkolamrenang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hargasepakatmitra`
--
ALTER TABLE `hargasepakatmitra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwalfasilkolam`
--
ALTER TABLE `jadwalfasilkolam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenisfasilitas`
--
ALTER TABLE `jenisfasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenismitra`
--
ALTER TABLE `jenismitra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pencarians`
--
ALTER TABLE `pencarians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendapatanmitra`
--
ALTER TABLE `pendapatanmitra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perjanjianmitra`
--
ALTER TABLE `perjanjianmitra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekeningowner`
--
ALTER TABLE `rekeningowner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sopmitra`
--
ALTER TABLE `sopmitra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unitsewafasilitas`
--
ALTER TABLE `unitsewafasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `booking_pool`
--
ALTER TABLE `booking_pool`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fasilitasmitra`
--
ALTER TABLE `fasilitasmitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `fasilkolamrenang`
--
ALTER TABLE `fasilkolamrenang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `hargasepakatmitra`
--
ALTER TABLE `hargasepakatmitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jadwalfasilkolam`
--
ALTER TABLE `jadwalfasilkolam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jenisfasilitas`
--
ALTER TABLE `jenisfasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jenismitra`
--
ALTER TABLE `jenismitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pencarians`
--
ALTER TABLE `pencarians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pendapatanmitra`
--
ALTER TABLE `pendapatanmitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `perjanjianmitra`
--
ALTER TABLE `perjanjianmitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rekeningowner`
--
ALTER TABLE `rekeningowner`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sopmitra`
--
ALTER TABLE `sopmitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unitsewafasilitas`
--
ALTER TABLE `unitsewafasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
