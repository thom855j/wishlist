-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 21. 09 2021 kl. 14:49:47
-- Serverversion: 10.4.21-MariaDB
-- PHP-version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `whish_gifts`
--

CREATE TABLE `whish_gifts` (
  `gift_id` bigint(20) NOT NULL,
  `gift_image` varchar(255) DEFAULT NULL,
  `gift_name` varchar(255) DEFAULT NULL,
  `gift_qty` int(11) NOT NULL DEFAULT 1,
  `gift_reservations` int(11) NOT NULL DEFAULT 0,
  `gift_price` int(11) NOT NULL DEFAULT 0,
  `gift_note` varchar(255) DEFAULT NULL,
  `gift_link` varchar(255) DEFAULT NULL,
  `gift_list` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `whish_gifts`
--

INSERT INTO `whish_gifts` (`gift_id`, `gift_image`, `gift_name`, `gift_qty`, `gift_reservations`, `gift_price`, `gift_note`, `gift_link`, `gift_list`) VALUES
(1, 'https://y-design.dk/wp-content/uploads/2020/06/20-RC912-royal-copenhagen-kande-med-laag-stemning-600x600.jpg', 'Royal copenhagen middagstallerken nr. 19', 1, 0, 250, NULL, NULL, 1),
(2, '', 'Medisterpølse', 2, 0, 300, '', '', 3),
(3, '', 'Kande', 2, 0, 200, '', '', 1),
(4, '', 'Kande', 2, 0, 200, '', '', 1);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `whish_lists`
--

CREATE TABLE `whish_lists` (
  `list_id` bigint(20) NOT NULL,
  `list_date` datetime DEFAULT NULL,
  `list_title` text DEFAULT NULL,
  `list_subtitle` text DEFAULT NULL,
  `list_link` varchar(255) DEFAULT NULL,
  `list_user` bigint(20) DEFAULT NULL,
  `list_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `whish_lists`
--

INSERT INTO `whish_lists` (`list_id`, `list_date`, `list_title`, `list_subtitle`, `list_link`, `list_user`, `list_code`) VALUES
(1, '2021-09-21 12:00:42', 'Min fødselsdag i morgen', '2022', NULL, 1, '12345'),
(2, '2021-09-21 12:00:42', 'Mit bryllup', '2022', NULL, NULL, '54321'),
(3, '2022-05-19 12:31:35', 'Test1234', 'test', NULL, 1, '192133');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `whish_sessions`
--

CREATE TABLE `whish_sessions` (
  `session_id` bigint(20) NOT NULL,
  `session_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `session_list` bigint(20) NOT NULL,
  `session_hash` varchar(255) DEFAULT NULL,
  `session_products` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `whish_users`
--

CREATE TABLE `whish_users` (
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_reset` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `whish_users`
--

INSERT INTO `whish_users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_reset`) VALUES
(1, 'john', 'fb469d7ef430b0baf0cab6c436e70375', 'john@example.com', '');

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `whish_gifts`
--
ALTER TABLE `whish_gifts`
  ADD PRIMARY KEY (`gift_id`);

--
-- Indeks for tabel `whish_lists`
--
ALTER TABLE `whish_lists`
  ADD PRIMARY KEY (`list_id`);

--
-- Indeks for tabel `whish_sessions`
--
ALTER TABLE `whish_sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indeks for tabel `whish_users`
--
ALTER TABLE `whish_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `whish_gifts`
--
ALTER TABLE `whish_gifts`
  MODIFY `gift_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tilføj AUTO_INCREMENT i tabel `whish_lists`
--
ALTER TABLE `whish_lists`
  MODIFY `list_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tilføj AUTO_INCREMENT i tabel `whish_sessions`
--
ALTER TABLE `whish_sessions`
  MODIFY `session_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Tilføj AUTO_INCREMENT i tabel `whish_users`
--
ALTER TABLE `whish_users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
