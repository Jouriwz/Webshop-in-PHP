-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 26 jun 2018 om 17:08
-- Serverversie: 10.1.30-MariaDB
-- PHP-versie: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop2`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `amount` double(9,2) NOT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `mollie_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `orders`
--

INSERT INTO `orders` (`id`, `amount`, `payment_status`, `mollie_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 117.52, 'open', NULL, 1, NULL, NULL),
(2, 117.52, 'open', NULL, 2, NULL, NULL),
(3, 117.52, 'open', NULL, 3, NULL, NULL),
(4, 117.52, 'open', NULL, 4, NULL, NULL),
(5, 117.52, 'open', NULL, 5, NULL, NULL),
(6, 117.52, 'open', NULL, 6, NULL, NULL),
(7, 50.83, 'open', NULL, 7, NULL, NULL),
(8, 50.83, 'open', NULL, 8, NULL, NULL),
(9, 0.00, 'open', NULL, 9, NULL, NULL),
(10, 0.00, 'open', NULL, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders_products`
--

CREATE TABLE `orders_products` (
  `id` int(11) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` double(9,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `orders_products`
--

INSERT INTO `orders_products` (`id`, `order_id`, `product_id`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 6, 3, 1.99, 26, '2018-06-25 13:16:41', '2018-06-25 13:16:41'),
(2, 6, 2, 2.99, 22, '2018-06-25 13:16:41', '2018-06-25 13:16:41'),
(3, 7, 3, 1.99, 6, '2018-06-26 14:16:36', '2018-06-26 14:16:36'),
(4, 7, 2, 2.99, 5, '2018-06-26 14:16:36', '2018-06-26 14:16:36'),
(5, 7, 1, 3.99, 6, '2018-06-26 14:16:36', '2018-06-26 14:16:36'),
(6, 8, 3, 1.99, 6, '2018-06-26 14:35:44', '2018-06-26 14:35:44'),
(7, 8, 2, 2.99, 5, '2018-06-26 14:35:44', '2018-06-26 14:35:44'),
(8, 8, 1, 3.99, 6, '2018-06-26 14:35:44', '2018-06-26 14:35:44');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `price` double(9,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`id`, `slug`, `title`, `description`, `price`, `image`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(1, 'sheba-catfood', 'Sheba - catfood', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>', 3.99, 'catfood1.jpg', 'sheba catfood', 'sheba catfood', '2018-05-13 17:20:05', '2018-05-13 17:20:05'),
(2, 'felix-catfood', 'felix - catfood', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>', 2.99, 'catfood2.jpg', 'felix catfood', 'felix catfood', '2018-05-13 17:21:48', '2018-05-13 17:21:48'),
(3, 'whiskas-catfood', 'whiskas - catfood', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>', 1.99, 'catfood3.jpg', 'whiskas catfood', 'whiskas catfood', '2018-05-13 17:21:48', '2018-05-13 17:21:48');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT '',
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `suffix_name` varchar(255) DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `country` varchar(255) NOT NULL DEFAULT 'NL',
  `city` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `street_number` varchar(255) NOT NULL,
  `street_suffix` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `remember_token`, `first_name`, `suffix_name`, `last_name`, `country`, `city`, `street`, `street_number`, `street_suffix`, `zipcode`, `active`, `created_at`, `updated_at`) VALUES
(1, '186078@talnet.nl', '$2y$10$hZvl7HRtocdg108sNRfUSOjrU/V.uSKrF3918GBMWXKxVZrpwhvQ.', '', 'Jouri', 'Jouri Zevenhek', 'Zevenhek', 'NL', 'Amsterdam Zuidoost', 'Huntum', '22', 'c', '1102 JB ', 0, '2018-06-25 12:38:13', '2018-06-25 12:38:13'),
(2, '186078@talnet.nl', '$2y$10$ZjN0fdJvp77woSvngftXZeKfeN0T3xaaQSnj1aIkvW8q/N4p92tTa', '', 'Jouri', 'Jouri Zevenhek', 'Zevenhek', 'NL', 'Amsterdam Zuidoost', 'Huntum', '22', 'c', '1102 JB ', 0, '2018-06-25 12:43:26', '2018-06-25 12:43:26'),
(3, '186078@talnet.nl', '$2y$10$LsrbKfKjEnAOTLdlHRt7g.hOap/b4kJf7/3PGJ4/Dp8WicwD7cjIe', '', 'Jouri', 'Jouri Zevenhek', 'Zevenhek', 'NL', 'Amsterdam Zuidoost', 'Huntum', '22', 'c', '1102 JB ', 0, '2018-06-25 13:01:46', '2018-06-25 13:01:46'),
(4, '186078@talnet.nl', '$2y$10$79Bh/BcUBRv8X.i3qXqFi.rXOebM2QAsuuTMpeoEx1QfGpyK/ubz.', '', 'Jouri', 'Jouri Zevenhek', 'Zevenhek', 'NL', 'Amsterdam Zuidoost', 'Huntum', '22', 'c', '1102 JB ', 0, '2018-06-25 13:07:39', '2018-06-25 13:07:39'),
(5, '186078@talnet.nl', '$2y$10$fYbegnhA7kweV9bPWhKrsOTDqE3iF6LtjMALZ1veqLiVTwSv6aNke', '', 'Jouri', 'Jouri Zevenhek', 'Zevenhek', 'NL', 'Amsterdam Zuidoost', 'Huntum', '17', '16', '1102 JB ', 0, '2018-06-25 13:13:01', '2018-06-25 13:13:01'),
(6, '186078@talnet.nl', '$2y$10$0KfYIYAwfnTRgCZaRgN47.2d1uRiKzUHGPEAA/YjZ8lVdpe.2fu6u', '', 'Jouri', 'Jouri Zevenhek', 'Zevenhek', 'NL', 'Amsterdam Zuidoost', 'Huntum', '22', 'c', '1102 JB ', 0, '2018-06-25 13:16:41', '2018-06-25 13:16:41'),
(7, '186078@talnet.nl', '$2y$10$UfUauBPbDOkUvkysmATiSe/3Pp06Gh9REaaeO5J21kRNJdE3CpHKu', '', 'Jouri', 'Jouri Zevenhek', 'Zevenhek', 'DE', 'Amsterdam Zuidoost', 'Huntum', '22', 'c', '1102 JB ', 0, '2018-06-26 14:16:36', '2018-06-26 14:16:36'),
(8, '186078@talnet.nl', '$2y$10$e2vnu1e9aG4pi4PvOa/Mx.Md7B9Al3PHiMJdBle8YdUvlBDFhUBhC', '', 'Jouri', 'Jouri Zevenhek', 'Zevenhek', 'NL', 'Amsterdam Zuidoost', 'Huntum', '22', 'c', '1102 JB ', 0, '2018-06-26 14:35:44', '2018-06-26 14:35:44'),
(9, '186078@talnet.nl', '$2y$10$s.9IadE7XHNMMibeyYRBjOrmOtlsIIPxCRdmNF.b6FH2DWr8Z54Si', '', 'Jouri', 'Jouri Zevenhek', 'Zevenhek', 'NL', 'Amsterdam Zuidoost', 'Huntum', '22', 'c', '1102 JB ', 0, '2018-06-26 14:39:01', '2018-06-26 14:39:01'),
(10, '186078@talnet.nl', '$2y$10$ShF8x0uMkkpQwC/ygLNFHeAvv6ObQzinB/xanHbjh4OdKz8otH8M6', '', 'Jouri', 'Jouri Zevenhek', 'Zevenhek', 'DE', 'Amsterdam Zuidoost', 'Huntum', '22', 'c', '1102 JB ', 0, '2018-06-26 15:00:58', '2018-06-26 15:00:58');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
