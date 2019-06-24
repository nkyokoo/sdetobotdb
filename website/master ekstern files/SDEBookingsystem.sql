-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 18. 03 2019 kl. 12:38:00
-- Serverversion: 10.1.37-MariaDB
-- PHP-version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sdebookingsystem`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data dump for tabellen `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'PC'),
(2, 'PC');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `connection_product_rentals`
--

CREATE TABLE `connection_product_rentals` (
  `id` int(11) NOT NULL,
  `product_rentals_id` int(11) NOT NULL,
  `product_unit_e_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `connection_product_wishlist`
--

CREATE TABLE `connection_product_wishlist` (
  `wish_list_id` int(11) NOT NULL,
  `school_products_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `location_room`
--

CREATE TABLE `location_room` (
  `id` int(11) NOT NULL,
  `room` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data dump for tabellen `location_room`
--

INSERT INTO `location_room` (`id`, `room`) VALUES
(1, 'L1'),
(2, 'L1');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `product_location_type_svf`
--

CREATE TABLE `product_location_type_svf` (
  `id` int(11) NOT NULL,
  `type` varchar(45) COLLATE utf8_bin NOT NULL,
  `nr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data dump for tabellen `product_location_type_svf`
--

INSERT INTO `product_location_type_svf` (`id`, `type`, `nr`) VALUES
(1, 'S', 1);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `product_location_type_thp`
--

CREATE TABLE `product_location_type_thp` (
  `id` int(11) NOT NULL,
  `type` varchar(45) COLLATE utf8_bin NOT NULL,
  `nr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data dump for tabellen `product_location_type_thp`
--

INSERT INTO `product_location_type_thp` (`id`, `type`, `nr`) VALUES
(1, 'H', 1),
(2, 'H', 1);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `product_rentals`
--

CREATE TABLE `product_rentals` (
  `id` int(11) NOT NULL,
  `wish_list_id` int(11) NOT NULL,
  `available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `product_school_address`
--

CREATE TABLE `product_school_address` (
  `id` int(11) NOT NULL,
  `school_name` varchar(45) COLLATE utf8_bin NOT NULL,
  `city` varchar(45) COLLATE utf8_bin NOT NULL,
  `zip_code` int(4) NOT NULL,
  `address` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data dump for tabellen `product_school_address`
--

INSERT INTO `product_school_address` (`id`, `school_name`, `city`, `zip_code`, `address`) VALUES
(1, 'hed ', 'hed', 5252, 'hed'),
(2, 'hedd', 'hedda', 5252, 'hedfsf');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `product_unit_e`
--

CREATE TABLE `product_unit_e` (
  `id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `location_room_id` int(11) NOT NULL,
  `product_location_type_svf_id` int(11) NOT NULL,
  `product_location_type_thp_id` int(11) NOT NULL,
  `unit_number` varchar(20) COLLATE utf8_bin NOT NULL,
  `current_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `school_address_short`
--

CREATE TABLE `school_address_short` (
  `id` int(11) NOT NULL,
  `company_name_short` varchar(45) COLLATE utf8_bin NOT NULL,
  `product_school_address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data dump for tabellen `school_address_short`
--

INSERT INTO `school_address_short` (`id`, `company_name_short`, `product_school_address_id`) VALUES
(1, 'hed', 1),
(2, 'hedee', 2);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `school_products`
--

CREATE TABLE `school_products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(45) COLLATE utf8_bin NOT NULL,
  `category_id` int(11) NOT NULL,
  `movable` varchar(3) COLLATE utf8_bin NOT NULL,
  `supplier_company_id` int(11) NOT NULL,
  `school_name_short_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data dump for tabellen `school_products`
--

INSERT INTO `school_products` (`id`, `product_name`, `category_id`, `movable`, `supplier_company_id`, `school_name_short_id`, `description`) VALUES
(1, 'Computer 1', 1, 'ja', 1, 1, 'Det er en pc.'),
(2, 'Computer 1', 2, 'ja', 2, 2, 'Det er en pc.');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `status_report`
--

CREATE TABLE `status_report` (
  `id` int(11) NOT NULL,
  `status_name` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `supplier_company`
--

CREATE TABLE `supplier_company` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_bin NOT NULL,
  `address` varchar(45) COLLATE utf8_bin NOT NULL,
  `call_number` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data dump for tabellen `supplier_company`
--

INSERT INTO `supplier_company` (`id`, `name`, `address`, `call_number`) VALUES
(1, 'hej', 'hekj', 23232323),
(2, 'hej', 'hekj', 23232323);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE `users` (
  `id` varchar(255) NOT NULL,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data dump for tabellen `users`
--


-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `user_group`
--

CREATE TABLE `user_group` (
  `id` varchar(255) NOT NULL,
  `user_rank` varchar(15) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data dump for tabellen `user_group`
--

INSERT INTO `user_group` (`id`, `user_rank`) VALUES
(1, 'Administrator'),
(2, 'Superuser'),
(3, 'User');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `wish_list`
--

CREATE TABLE `wish_list` (
  `id` int(11) NOT NULL,
  `rerserved_date` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reminder_date` date NOT NULL,
  `godkendt` tinyint(4) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `project_products_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `worker_info`
--

CREATE TABLE `worker_info` (
  `id` int(11) NOT NULL,
  `firstname` varchar(45) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(45) COLLATE utf8_bin NOT NULL,
  `phone_number` int(8) NOT NULL,
  `supplier_company_id` int(11) NOT NULL,
  `email` varchar(45) COLLATE utf8_bin DEFAULT 'Ingen Email'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `connection_product_rentals`
--
ALTER TABLE `connection_product_rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_rentals_id` (`product_rentals_id`),
  ADD KEY `product_unit_e_id` (`product_unit_e_id`);

--
-- Indeks for tabel `connection_product_wishlist`
--
ALTER TABLE `connection_product_wishlist`
  ADD KEY `wish_list_id` (`wish_list_id`),
  ADD KEY `school_products_id` (`school_products_id`);

--
-- Indeks for tabel `location_room`
--
ALTER TABLE `location_room`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `product_location_type_svf`
--
ALTER TABLE `product_location_type_svf`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `product_location_type_thp`
--
ALTER TABLE `product_location_type_thp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `product_rentals`
--
ALTER TABLE `product_rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wish_list_id` (`wish_list_id`);

--
-- Indeks for tabel `product_school_address`
--
ALTER TABLE `product_school_address`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `product_unit_e`
--
ALTER TABLE `product_unit_e`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_room_id` (`location_room_id`),
  ADD KEY `products_id` (`products_id`),
  ADD KEY `product_location_type_svf_id` (`product_location_type_svf_id`),
  ADD KEY `product_location_type_thp_id` (`product_location_type_thp_id`),
  ADD KEY `current_status_id` (`current_status_id`);

--
-- Indeks for tabel `school_address_short`
--
ALTER TABLE `school_address_short`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_school_address_id` (`product_school_address_id`);

--
-- Indeks for tabel `school_products`
--
ALTER TABLE `school_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `supplier_company_id` (`supplier_company_id`),
  ADD KEY `school_name_short_id` (`school_name_short_id`);

--
-- Indeks for tabel `status_report`
--
ALTER TABLE `status_report`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `supplier_company`
--
ALTER TABLE `supplier_company`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_group_id` (`user_group_id`);

--
-- Indeks for tabel `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `wish_list`
--
ALTER TABLE `wish_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks for tabel `worker_info`
--
ALTER TABLE `worker_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_company_id` (`supplier_company_id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tilføj AUTO_INCREMENT i tabel `connection_product_rentals`
--
ALTER TABLE `connection_product_rentals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tilføj AUTO_INCREMENT i tabel `location_room`
--
ALTER TABLE `location_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tilføj AUTO_INCREMENT i tabel `product_location_type_svf`
--
ALTER TABLE `product_location_type_svf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tilføj AUTO_INCREMENT i tabel `product_location_type_thp`
--
ALTER TABLE `product_location_type_thp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tilføj AUTO_INCREMENT i tabel `product_rentals`
--
ALTER TABLE `product_rentals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tilføj AUTO_INCREMENT i tabel `product_school_address`
--
ALTER TABLE `product_school_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tilføj AUTO_INCREMENT i tabel `product_unit_e`
--
ALTER TABLE `product_unit_e`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tilføj AUTO_INCREMENT i tabel `school_address_short`
--
ALTER TABLE `school_address_short`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tilføj AUTO_INCREMENT i tabel `school_products`
--
ALTER TABLE `school_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tilføj AUTO_INCREMENT i tabel `status_report`
--
ALTER TABLE `status_report`
  MODIFY `id` int(11) NOT NULL;

--
-- Tilføj AUTO_INCREMENT i tabel `supplier_company`
--
ALTER TABLE `supplier_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tilføj AUTO_INCREMENT i tabel `users`
--

--
-- Tilføj AUTO_INCREMENT i tabel `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tilføj AUTO_INCREMENT i tabel `wish_list`
--
ALTER TABLE `wish_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tilføj AUTO_INCREMENT i tabel `worker_info`
--
ALTER TABLE `worker_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Begrænsninger for dumpede tabeller
--

--
-- Begrænsninger for tabel `connection_product_rentals`
--
ALTER TABLE `connection_product_rentals`
  ADD CONSTRAINT `connection_product_rentals_ibfk_1` FOREIGN KEY (`product_rentals_id`) REFERENCES `product_rentals` (`id`),
  ADD CONSTRAINT `connection_product_rentals_ibfk_2` FOREIGN KEY (`product_unit_e_id`) REFERENCES `product_unit_e` (`id`);

--
-- Begrænsninger for tabel `connection_product_wishlist`
--
ALTER TABLE `connection_product_wishlist`
  ADD CONSTRAINT `connection_product_wishlist_ibfk_1` FOREIGN KEY (`wish_list_id`) REFERENCES `wish_list` (`id`),
  ADD CONSTRAINT `connection_product_wishlist_ibfk_2` FOREIGN KEY (`school_products_id`) REFERENCES `school_products` (`id`);

--
-- Begrænsninger for tabel `product_rentals`
--
ALTER TABLE `product_rentals`
  ADD CONSTRAINT `product_rentals_ibfk_1` FOREIGN KEY (`wish_list_id`) REFERENCES `wish_list` (`id`);

--
-- Begrænsninger for tabel `product_unit_e`
--
ALTER TABLE `product_unit_e`
  ADD CONSTRAINT `product_unit_e_ibfk_1` FOREIGN KEY (`location_room_id`) REFERENCES `location_room` (`id`),
  ADD CONSTRAINT `product_unit_e_ibfk_2` FOREIGN KEY (`products_id`) REFERENCES `school_products` (`id`),
  ADD CONSTRAINT `product_unit_e_ibfk_3` FOREIGN KEY (`product_location_type_svf_id`) REFERENCES `product_location_type_svf` (`id`),
  ADD CONSTRAINT `product_unit_e_ibfk_4` FOREIGN KEY (`product_location_type_thp_id`) REFERENCES `product_location_type_thp` (`id`),
  ADD CONSTRAINT `product_unit_e_ibfk_5` FOREIGN KEY (`current_status_id`) REFERENCES `status_report` (`id`);

--
-- Begrænsninger for tabel `school_address_short`
--
ALTER TABLE `school_address_short`
  ADD CONSTRAINT `school_address_short_ibfk_1` FOREIGN KEY (`product_school_address_id`) REFERENCES `product_school_address` (`id`);

--
-- Begrænsninger for tabel `school_products`
--
ALTER TABLE `school_products`
  ADD CONSTRAINT `school_products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `school_products_ibfk_2` FOREIGN KEY (`supplier_company_id`) REFERENCES `supplier_company` (`id`),
  ADD CONSTRAINT `school_products_ibfk_3` FOREIGN KEY (`school_name_short_id`) REFERENCES `school_address_short` (`id`);

--
-- Begrænsninger for tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_group_id`) REFERENCES `user_group` (`id`);

--
-- Begrænsninger for tabel `wish_list`
--
ALTER TABLE `wish_list`
  ADD CONSTRAINT `wish_list_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Begrænsninger for tabel `worker_info`
--
ALTER TABLE `worker_info`
  ADD CONSTRAINT `worker_info_ibfk_1` FOREIGN KEY (`supplier_company_id`) REFERENCES `supplier_company` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
