-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Vært: localhost:3306
-- Genereringstid: 14. 01 2019 kl. 11:00:21
-- Serverversion: 5.7.24-0ubuntu0.18.04.1
-- PHP-version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SDEBookingsystem`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `category`
--

CREATE TABLE `status_report` (
  `id` int(11) NOT NULL,
  `status_name` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
-- Struktur-dump for tabellen `location_room`
--

CREATE TABLE `location_room` (
  `id` int(11) NOT NULL,
  `room` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `product_location_type_svf`
--

CREATE TABLE `product_location_type_svf` (
  `id` int(11) NOT NULL,
  `type` varchar(45) COLLATE utf8_bin NOT NULL,
  `nr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `product_location_type_thp`
--

CREATE TABLE `product_location_type_thp` (
  `id` int(11) NOT NULL,
  `type` varchar(45) COLLATE utf8_bin NOT NULL,
  `nr` int(11) NOT NULL
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




-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `school_address_short`
--

CREATE TABLE `school_address_short` (
  `id` int(11) NOT NULL,
  `company_name_short` varchar(45) COLLATE utf8_bin NOT NULL,
  `product_school_address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `supplier_company`
--

CREATE TABLE `supplier_company` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `call_number` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `usergroup_rank` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `wish_list`
--

CREATE TABLE `wish_list` (
  `id` int(11) NOT NULL,
  `godkendt` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `product_rentals`
--

CREATE TABLE `product_rentals` (
  `id` int(11) NOT NULL,
  `reserved_date` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reminder_date` date NOT NULL,
  `wish_list_id` int(11) NOT NULL,
  `available` tinyint(1) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `connection_product_wishlist`
--

CREATE TABLE `connection_product_wishlist` (
  `wish_list_id` int(11) NOT NULL,
  `school_products_id` int(11) NOT NULL, 
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


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

--
-- Begrænsninger for dumpede tabeller
--
ALTER TABLE worker_info
ADD PRIMARY KEY (id);

ALTER TABLE connection_product_rentals
ADD PRIMARY KEY (id);
--
-- status_report
--
ALTER TABLE `status_report`
ADD PRIMARY KEY (`id`);
--
-- Indeks for tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `product_school_address`
--
ALTER TABLE `product_school_address`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `product_unit_e`
--
ALTER TABLE `product_unit_e`
  ADD PRIMARY KEY (`id`);


--
-- Indeks for tabel `school_address_short`
--
ALTER TABLE `school_address_short`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `school_products`
--
ALTER TABLE `school_products`
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
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `wish_list`
--
ALTER TABLE `wish_list`
  ADD PRIMARY KEY (`id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--
ALTER TABLE worker_info
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `connection_product_rentals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- status_report
--
ALTER TABLE `status_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tilføj AUTO_INCREMENT i tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
--
-- school_address_short
--
ALTER TABLE `school_address_short`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tilføj AUTO_INCREMENT i tabel `location_room`
--
ALTER TABLE `location_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tilføj AUTO_INCREMENT i tabel `product_location_type_svf`
--
ALTER TABLE `product_location_type_svf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tilføj AUTO_INCREMENT i tabel `product_location_type_thp`
--
ALTER TABLE `product_location_type_thp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  --
  -- product_rentals
  --
  ALTER TABLE `product_rentals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
-- 
-- Tilføj AUTO_INCREMENT i tabel `product_school_address`
--
ALTER TABLE `product_school_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tilføj AUTO_INCREMENT i tabel `product_unit_e`
--
ALTER TABLE `product_unit_e`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Indeks for tabel `school_products`
--
ALTER TABLE `school_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tilføj AUTO_INCREMENT i tabel `supplier_company`
--
ALTER TABLE `supplier_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tilføj AUTO_INCREMENT i tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
--
-- Indeks for tabel `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Indeks for tabel `wish_list`
--
ALTER TABLE `wish_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  --
-- Foreign keys for Tables
--
ALTER TABLE connection_product_rentals
ADD FOREIGN KEY (product_rentals_id) REFERENCES product_rentals(id);

ALTER TABLE connection_product_rentals
ADD FOREIGN KEY (product_unit_e_id) REFERENCES product_unit_e(id);

ALTER TABLE worker_info
ADD FOREIGN KEY (supplier_company_id) REFERENCES supplier_company(id);

ALTER TABLE wish_list
ADD FOREIGN KEY (user_id) REFERENCES users(id);

ALTER TABLE users
ADD FOREIGN KEY (user_group_id) REFERENCES user_group(id);


ALTER TABLE product_rentals
ADD FOREIGN KEY (wish_list_id) REFERENCES wish_list(id);

ALTER TABLE connection_product_wishlist
ADD FOREIGN KEY (wish_list_id) REFERENCES wish_list(id);

ALTER TABLE connection_product_wishlist
ADD FOREIGN KEY (school_products_id) REFERENCES school_products(id);

ALTER TABLE school_products
ADD FOREIGN KEY (category_id) REFERENCES category(id);

ALTER TABLE school_products
ADD FOREIGN KEY (supplier_company_id) REFERENCES supplier_company(id);

ALTER TABLE school_products
ADD FOREIGN KEY (school_name_short_id) REFERENCES school_address_short(id);

ALTER TABLE school_address_short
ADD FOREIGN KEY (product_school_address_id) REFERENCES product_school_address(id);

ALTER TABLE product_unit_e
ADD FOREIGN KEY (location_room_id) REFERENCES location_room(id);

ALTER TABLE product_unit_e
ADD FOREIGN KEY (products_id) REFERENCES school_products(id);

ALTER TABLE product_unit_e
ADD FOREIGN KEY (product_location_type_svf_id) REFERENCES product_location_type_svf(id);

ALTER TABLE product_unit_e
ADD FOREIGN KEY (product_location_type_thp_id) REFERENCES product_location_type_thp(id);

ALTER TABLE product_unit_e
ADD FOREIGN KEY (current_status_id) REFERENCES status_report(id);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
