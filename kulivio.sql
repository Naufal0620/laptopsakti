-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2026 at 09:37 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kulivio`
--

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('percentage','fixed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int NOT NULL,
  `max_discount` int DEFAULT NULL,
  `min_order` int NOT NULL DEFAULT '0',
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `usage_limit` int DEFAULT NULL,
  `limit_per_user` int NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `type`, `value`, `max_discount`, `min_order`, `start_date`, `end_date`, `usage_limit`, `limit_per_user`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'HEMAT10', 'percentage', 10, 10000, 50000, '2026-05-21 09:33:16', '2026-06-21 09:33:16', 100, 1, 1, '2026-05-21 02:33:16', '2026-05-21 02:33:16'),
(2, 'DISKON5RB', 'fixed', 5000, NULL, 20000, NULL, NULL, NULL, 1, 1, '2026-05-21 02:33:16', '2026-05-21 02:33:16');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `discount_type` enum('none','percentage','fixed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `discount_value` int NOT NULL DEFAULT '0',
  `pre_order_days` int NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `discount_type`, `discount_value`, `pre_order_days`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Sayur Segar', 'Paket sayuran segar pilihan langsung dari petani lokal, cocok untuk masakan rumahan sehat.', 15000, 'none', 0, 1, 1, '2026-05-21 02:33:16', '2026-05-21 02:33:16'),
(2, 'Cookie Ice Cream Sandwich', 'Kombinasi sempurna antara soft cookie cokelat dan es krim vanilla premium di tengahnya.', 25000, 'percentage', 10, 2, 1, '2026-05-21 02:33:16', '2026-05-21 02:33:16'),
(3, 'Dorito Chips', 'Keripik jagung renyah dengan bumbu keju nacho yang melimpah dan gurih.', 12000, 'none', 0, 1, 1, '2026-05-21 02:33:16', '2026-05-21 02:33:16'),
(4, 'Sour Bread', 'Roti sourdough autentik dengan tekstur kenyal dan rasa sedikit asam yang khas, tanpa pengawet.', 30000, 'fixed', 5000, 2, 1, '2026-05-21 02:33:16', '2026-05-21 02:33:16'),
(5, 'Pizza', 'Pizza artisan dengan topping mozzarella lumer, daging pilihan, dan saus tomat rahasia.', 85000, 'none', 0, 1, 1, '2026-05-21 02:33:16', '2026-05-21 02:33:16'),
(6, 'Sugar Sour Bread', 'Varian sourdough dengan sentuhan gula karamel di bagian kulit luar yang renyah.', 35000, 'none', 0, 2, 1, '2026-05-21 02:33:16', '2026-05-21 02:33:16'),
(7, 'Kebab', 'Kebab isi daging sapi panggang melimpah, sayuran segar, dan saus spesial kulivio.', 22000, 'percentage', 15, 1, 1, '2026-05-21 02:33:16', '2026-05-21 02:33:16'),
(8, 'Sop Dumpling', 'Sop kaldu ayam bening dengan dumpling isi ayam udang yang lembut dan hangat.', 45000, 'none', 0, 2, 1, '2026-05-21 02:33:16', '2026-05-21 02:33:16'),
(9, 'Cheese Cake', 'New York style cheesecake yang creamy dan lembut dengan crust biskuit yang gurih.', 150000, 'fixed', 20000, 3, 1, '2026-05-21 02:33:16', '2026-05-21 02:33:16'),
(10, 'Ribs and Fries', 'Iga sapi panggang empuk dengan bumbu BBQ meresap, disajikan dengan kentang goreng renyah.', 125000, 'none', 0, 2, 1, '2026-05-21 02:33:16', '2026-05-21 02:33:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','customer','courier') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator Kulivio', 'admin@kulivio.com', '2026-05-21 02:33:16', '$2y$12$J8XZPsokEooH/qyOz9NCy.zDXqbzz9R7zQNmAt48OtitGURYePdBy', '628111111111', 'admin', 'rTS31S9nKO', '2026-05-21 02:33:17', '2026-05-21 02:33:17'),
(2, 'Budi Pelanggan', 'user@kulivio.com', '2026-05-21 02:33:17', '$2y$12$t2XcWTyhOcecW1EB.dfmgOSra1pPdzwCcl/VeWb.cpkESHtApICsy', '628222222222', 'customer', 'rDVsp5CXng', '2026-05-21 02:33:17', '2026-05-21 02:33:17'),
(3, 'Keyshawn Homenick', 'imedhurst@example.net', '2026-05-21 02:33:17', '$2y$12$Jdbq6brSEqpNYaC5K7TvP.CB7IOpMX/dpoutMd4bdEkE3D9nKV3R2', '1-864-864-1835', 'customer', 'oFCBAorCyL', '2026-05-21 02:33:18', '2026-05-21 02:33:18'),
(4, 'Marlen Kuhic', 'theidenreich@example.com', '2026-05-21 02:33:18', '$2y$12$eqwN0VRZQTLxrrWE7BzIleLYrNYwagWnIZS6wiGV8oHHYF5GQM21u', '321-667-8218', 'customer', 'Hwe5fC1Sh4', '2026-05-21 02:33:18', '2026-05-21 02:33:18'),
(5, 'Telly Lakin', 'herminio67@example.org', '2026-05-21 02:33:18', '$2y$12$x3hIKJOJDrsIYnOyWcr6RucRq.ukZM1fqL/xgHZQqhvw6sXJA27sK', '608.615.9679', 'customer', 'Un9WbLx3VT', '2026-05-21 02:33:19', '2026-05-21 02:33:19'),
(6, 'Mr. Jesse Hoppe', 'liana.lind@example.net', '2026-05-21 02:33:19', '$2y$12$XU6xrPPKZqawMnFxyTCvfeSElYVAembBKHmDYrDdf/OKhQ.BmYpNC', '+1-830-750-0981', 'customer', 'BIMDA07YUv', '2026-05-21 02:33:19', '2026-05-21 02:33:19'),
(7, 'Shania Wuckert', 'ohara.maverick@example.org', '2026-05-21 02:33:19', '$2y$12$VprIvSMRn2WlgCprxoISoeMZs.mqKZg69wdmP49VNZezbB75epZru', '+1-351-613-8383', 'customer', '6XcrZOc5AQ', '2026-05-21 02:33:19', '2026-05-21 02:33:19'),
(8, 'Anastacio Carter DDS', 'kane.gislason@example.net', '2026-05-21 02:33:19', '$2y$12$ktGxXMyOh8pAlDFAZOmbCucFMT81wnevB.VDV5XXxO2NJHG6woSc.', '253.902.0824', 'customer', '5u1Tt1Hiin', '2026-05-21 02:33:20', '2026-05-21 02:33:20'),
(9, 'Meggie Price', 'runolfsson.justyn@example.net', '2026-05-21 02:33:20', '$2y$12$zfYc0ghJCxpQo.Uv7.CyhOhf.CTHTjNwow7ms/P6L8MohPC9nOr1a', '(623) 788-5494', 'customer', 'GpM8xPefc1', '2026-05-21 02:33:20', '2026-05-21 02:33:20'),
(10, 'Dr. Santina Kunze II', 'macejkovic.floy@example.org', '2026-05-21 02:33:20', '$2y$12$A/5/a7vdsUvO4RyHKsy9cuDL3VNmjrYypxc8Urb3QBrLd1F3R7ad2', '(313) 507-5597', 'customer', '00YaBgToLw', '2026-05-21 02:33:20', '2026-05-21 02:33:20'),
(11, 'Modesto Zemlak II', 'hermann58@example.org', '2026-05-21 02:33:20', '$2y$12$AQx3Rv84pNAlxLGrCJfFxOZxACgXWPEpEMN9nDpqyCAiKcsnapkCa', '870.281.3696', 'customer', 'WqVrlcQutJ', '2026-05-21 02:33:21', '2026-05-21 02:33:21'),
(12, 'Wilson Buckridge', 'tillman.gage@example.com', '2026-05-21 02:33:21', '$2y$12$F5aETx9SBl2y4nwEuiYp.ueR.1Yj5VNhCnlsUmMlW5R9f/KLQlkY.', '(940) 616-9897', 'customer', 'y9GYllcBJp', '2026-05-21 02:33:21', '2026-05-21 02:33:21'),
(13, 'Kurir Ahmad', 'kurir1@kulivio.com', '2026-05-21 02:33:21', '$2y$12$j53BIb/yfe382OLGLhe2/O4Ih7/4EdvS7XeL99oBvzljCchx7siOC', '628333333333', 'courier', 'vYIgHwgi0A', '2026-05-21 02:33:22', '2026-05-21 02:33:22'),
(14, 'Kurir Siti', 'kurir2@kulivio.com', '2026-05-21 02:33:22', '$2y$12$3SDLDZNS.iRQ2mM8XlgZdOCY8r3ctLGdLooOnNgMA9pIZ1xF.e1DC', '628444444444', 'courier', 'QwfsbfMNNd', '2026-05-21 02:33:22', '2026-05-21 02:33:22'),
(15, 'Novella Abbott', 'tavares21@example.org', '2026-05-21 02:33:22', '$2y$12$j/Ozd4f4ILWE0yA1IzlwlelRqtSyHj2MhrcTWODIsIIQnGySZ1yiG', '+1-341-908-4284', 'courier', 'ERlCHuBpQa', '2026-05-21 02:33:22', '2026-05-21 02:33:22'),
(16, 'Wilson Yost', 'rjerde@example.com', '2026-05-21 02:33:22', '$2y$12$f2U4wODD.3LalNBBv0zcZOdeHFtoWNXAtn0rCbOFy82lntEBexklS', '831.929.0795', 'courier', 'xK5qaoZhi3', '2026-05-21 02:33:23', '2026-05-21 02:33:23'),
(17, 'Lester Jacobson', 'yasmine.adams@example.org', '2026-05-21 02:33:23', '$2y$12$L/gh2tLdtdo6i.PDdkPFReMz.o1F02eQ0BJ4iNWXnP7wp6KB55KKq', '(248) 991-5938', 'courier', 'zhAAfL6fzZ', '2026-05-21 02:33:23', '2026-05-21 02:33:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
