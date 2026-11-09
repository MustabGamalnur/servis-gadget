-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 09, 2026 at 11:34 AM
-- Server version: 11.8.3-MariaDB-log
-- PHP Version: 8.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_servis`
--

-- --------------------------------------------------------

--
-- Table structure for table `servis`
--

CREATE TABLE `servis` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `tipe_gadget` varchar(100) NOT NULL,
  `no_wa` text NOT NULL,
  `kunci_layar` text NOT NULL,
  `keluhan` text NOT NULL,
  `status` varchar(50) DEFAULT 'Antre',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `servis`
--

INSERT INTO `servis` (`id`, `nama_pelanggan`, `tipe_gadget`, `no_wa`, `kunci_layar`, `keluhan`, `status`, `created_at`) VALUES
(1, 'Mustab', 'Vivo Y21s', '8YAYrgrP1WO1uQkkAfXK+A==', 'eDAbZc6c7nLMfc3BWDp5hg==', 'USjmDLRdnM82uetaDBd9vw==', 'Sedang Dikerjakan', '2026-11-09 11:14:37'),
(2, 'Ahmad', 'Oppo A9 2020', 'yyJqXixWGJYYHp0Wr+0VpA==', 'mnZUNmP8foVjCMB6brVUFw==', 'VGn3otESKz9IHlcBshlrKqRy7I572PUflBZatjQVK6mgzDTHPzL0ZeclH8aP+PkZ', 'Selesai', '2026-11-09 11:25:58'),
(3, 'Prima', 'Redmi Note 9 Pro', '77KSxbI4LkJtcsLC0q/opg==', 'VC21BqNpPSaWU1i5vzxqVg==', 'w3FL0Df0ENdD8G3apCrW2WLnDVsozNJ0CC3/qesEOQlEaD4Lhe6VCY/yY0bu6MmP', 'Sedang Dikerjakan', '2026-11-09 11:31:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `servis`
--
ALTER TABLE `servis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `servis`
--
ALTER TABLE `servis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
