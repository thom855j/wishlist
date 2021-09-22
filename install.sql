-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 22. 09 2021 kl. 22:26:38
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
-- Struktur-dump for tabellen `wish_gifts`
--

CREATE TABLE `wish_gifts` (
  `gift_id` bigint(20) NOT NULL,
  `gift_image` varchar(255) DEFAULT NULL,
  `gift_name` varchar(255) DEFAULT NULL,
  `gift_qty` int(11) NOT NULL DEFAULT 1,
  `gift_reservations` int(11) NOT NULL DEFAULT 0,
  `gift_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `gift_note` varchar(255) DEFAULT NULL,
  `gift_link` varchar(255) DEFAULT NULL,
  `gift_list` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `wish_gifts`
--

INSERT INTO `wish_gifts` (`gift_id`, `gift_image`, `gift_name`, `gift_qty`, `gift_reservations`, `gift_price`, `gift_note`, `gift_link`, `gift_list`) VALUES
(9, '', 'Kaffekande', 6, 2, '200.00', '', '', 2),
(10, '', 'Briller', 2, 1, '500.00', '', '', 2),
(11, '', 'Vase', 5, 1, '9999.95', '', '', 4);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `wish_lists`
--

CREATE TABLE `wish_lists` (
  `list_id` bigint(20) NOT NULL,
  `list_date` datetime DEFAULT NULL,
  `list_title` text DEFAULT NULL,
  `list_subtitle` text DEFAULT NULL,
  `list_link` varchar(255) DEFAULT NULL,
  `list_user` bigint(20) DEFAULT NULL,
  `list_code` varchar(255) NOT NULL,
  `list_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `wish_lists`
--

INSERT INTO `wish_lists` (`list_id`, `list_date`, `list_title`, `list_subtitle`, `list_link`, `list_user`, `list_code`, `list_active`) VALUES
(2, '2022-08-13 00:05:36', 'Bryllup', 'Caroline & Thomas', 'c81e728d9d4c2f636f067f89cc14862c', 1, '', 1),
(4, '2021-12-10 19:00:50', 'Min fødselsdag', 'Thomas', 'a87ff679a2f3e71d9181a67b7542122c', 1, '123', 1);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `wish_sessions`
--

CREATE TABLE `wish_sessions` (
  `session_id` bigint(20) NOT NULL,
  `session_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `session_list` bigint(20) NOT NULL,
  `session_hash` varchar(255) DEFAULT NULL,
  `session_gifts` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `wish_sessions`
--

INSERT INTO `wish_sessions` (`session_id`, `session_date`, `session_list`, `session_hash`, `session_gifts`) VALUES
(19, '2021-09-22 19:32:09', 2, '1f0e3dad99908345f7439f8ffabdffc4', '{\"9\":\"1\"}'),
(20, '2021-09-22 19:39:21', 4, '1f0e3dad99908345f7439f8ffabdffc4', '{\"11\":\"1\"}');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `wish_users`
--

CREATE TABLE `wish_users` (
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_reset` varchar(255) NOT NULL,
  `user_session` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `wish_users`
--

INSERT INTO `wish_users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_reset`, `user_session`) VALUES
(1, 'john', '1a1dc91c907325c69271ddf0c944bc72', 'john@example.com', '', 'c4ca4238a0b923820dcc509a6f75849b');

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `wish_gifts`
--
ALTER TABLE `wish_gifts`
  ADD PRIMARY KEY (`gift_id`);

--
-- Indeks for tabel `wish_lists`
--
ALTER TABLE `wish_lists`
  ADD PRIMARY KEY (`list_id`);

--
-- Indeks for tabel `wish_sessions`
--
ALTER TABLE `wish_sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indeks for tabel `wish_users`
--
ALTER TABLE `wish_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `wish_gifts`
--
ALTER TABLE `wish_gifts`
  MODIFY `gift_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tilføj AUTO_INCREMENT i tabel `wish_lists`
--
ALTER TABLE `wish_lists`
  MODIFY `list_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tilføj AUTO_INCREMENT i tabel `wish_sessions`
--
ALTER TABLE `wish_sessions`
  MODIFY `session_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tilføj AUTO_INCREMENT i tabel `wish_users`
--
ALTER TABLE `wish_users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
