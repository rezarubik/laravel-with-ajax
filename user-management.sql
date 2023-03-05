-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 05 Mar 2023 pada 18.59
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user-management`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_06_10_112011_add_is_verify_to_users_table', 2),
(6, '2022_06_10_192152_create_permission_tables', 4),
(7, '2022_03_28_090711_create_user_role_table', 5),
(10, '2022_06_11_034408_add_validation_code_in_users_table', 6),
(11, '2023_03_05_112429_add_image_to_users_table', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 4),
(2, 'App\\User', 4),
(2, 'App\\User', 7),
(2, 'App\\User', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view settings menus', 'web', '2022-06-10 12:41:46', '2022-06-10 12:41:46'),
(2, 'view form create user', 'web', '2022-06-10 12:41:58', '2022-06-10 12:41:58'),
(3, 'view users', 'web', '2022-06-10 12:42:11', '2022-06-10 12:42:11'),
(4, 'view roles', 'web', '2022-06-10 12:42:16', '2022-06-10 12:42:16'),
(5, 'view permissions', 'web', '2022-06-10 12:42:22', '2022-06-10 12:42:22'),
(6, 'view operationals', 'web', '2022-06-10 12:58:43', '2022-06-10 12:58:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2022-06-10 12:38:47', '2022-06-10 12:38:47'),
(2, 'Operational', 'web', '2022-06-10 12:56:23', '2022-06-10 12:56:23'),
(21, 'Admin', 'web', '2022-06-11 04:29:21', '2022-06-11 04:29:21'),
(22, 'Sales', 'web', '2022-06-11 04:29:21', '2022-06-11 04:29:21'),
(23, 'Sales Admin', 'web', '2022-06-11 04:29:21', '2022-06-11 04:29:21'),
(24, 'Finance', 'web', '2022-06-11 04:29:21', '2022-06-11 04:29:21'),
(25, 'Purchasing', 'web', '2022-06-11 04:29:21', '2022-06-11 04:29:21'),
(26, 'Warehouse', 'web', '2022-06-11 04:29:21', '2022-06-11 04:29:21'),
(27, 'Sales Manager', 'web', '2022-06-11 04:29:21', '2022-06-11 04:29:21'),
(28, 'COO', 'web', '2022-06-11 04:29:21', '2022-06-11 04:29:21'),
(29, 'QC', 'web', '2022-06-11 04:29:21', '2022-06-11 04:29:21'),
(30, 'Manager', 'web', '2022-06-11 04:29:21', '2022-06-11 04:29:21'),
(31, 'Technician', 'web', '2022-06-11 04:29:21', '2022-06-11 04:29:21'),
(32, 'Web Developer', 'web', '2022-06-11 04:29:21', '2022-06-11 04:29:21'),
(33, 'Dev Ops', 'web', '2022-06-11 04:29:21', '2022-06-11 04:29:21'),
(34, 'Surveyor', 'web', '2022-06-11 04:29:21', '2022-06-11 04:29:21'),
(35, 'Courier', 'web', '2022-06-11 04:29:21', '2022-06-11 04:29:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(6, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validation_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verify` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `email_verified_at`, `password`, `image`, `validation_code`, `is_verify`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Reza', 'Pahlevi update', 'reza@gmail.com', NULL, '$2y$10$xM2b71DfcFLrjUhutgyc.ut64pcZ6IrYVJwmscnllAbPS8BodsF9a', NULL, NULL, 0, NULL, '2022-06-10 04:18:50', '2023-03-05 10:02:58'),
(2, 'Reza', 'Pahlevi', 'rezaa@gmail.com', NULL, '12345678', NULL, NULL, 0, NULL, '2022-06-10 04:22:32', '2022-06-10 04:22:32'),
(3, 'Reza', 'Phaasd', 'test@gmail.com', NULL, '$2y$10$NqLUQ.akSjf7lC94A81e2u05qyyLKwmXHAFGp9cYsHtiifcoFqFK.', NULL, NULL, 1, NULL, '2022-06-10 04:24:47', '2022-06-10 04:24:47'),
(4, 'Super', 'Admin', 'superadmin@gmail.com', NULL, '$2y$10$wd7EgDZZi.6r4CDE0oxdR.XGq4rinGfYHvY5K2lBi4gtYrFzKn5yK', NULL, NULL, 1, NULL, '2022-06-10 04:54:25', '2022-06-10 04:54:25'),
(7, 'Muhammad Reza', 'Pahlevi Y update', 'rezarubik@gmail.com', NULL, '$2y$10$qzmrmHgyRkTWMcU0mY2dqO1ElgLHual29wgcQQq3zK1CdlJ13znYi', NULL, NULL, 1, NULL, '2022-06-10 12:00:33', '2023-03-05 03:36:32'),
(8, 'Operationals 1', 'Test', 'operational@gmail.com', NULL, '$2y$10$5eQ9uK5lsMjJu3N2UUQzx.2.cbUgm5DhWLViUA.LQ.lXa27vT3XsK', NULL, NULL, 0, NULL, '2022-06-10 13:02:58', '2022-06-10 13:02:58'),
(11, 'Reza', 'Pahlevi', 'rezapahlevi@gmail.com', NULL, '$2y$10$AabB5tB/nEvo1EtIcjwyJ.jBmYT3eiGJDgYFg.HaFZexm.54M/dTi', NULL, NULL, 0, NULL, '2022-06-10 20:29:08', '2022-06-10 20:29:08'),
(12, 'Reza', 'Pahlevi', 'asd@gmail.com', NULL, '$2y$10$lE0tQm5EPVNijCBsJuw12O2UjBR9iDw536EuFo.//6z1e9ecJ0I3G', NULL, NULL, 0, NULL, '2022-06-10 20:37:16', '2022-06-10 20:37:16'),
(13, 'Reza', 'Pahlevi', 'qwe@gmail.com', NULL, '$2y$10$Ugg9rRFJ.rguZVzXxtSyJ.0QiQFjnyG1IEzE8SJq3PKVpa.J3.ipO', NULL, NULL, 0, NULL, '2022-06-10 20:39:50', '2022-06-10 20:39:50'),
(15, 'Reza', 'Pahlevi', 'john@gmail.com', NULL, '$2y$10$150vltZRo0aSXyRfnVlKE.mKsN7zH4NalGtSB7AFr.IsgGYBPPQkG', NULL, 't9pMtqFnBTZFa0HSMr4GaFaRoABg4aCaCJ45ZWmzvUnmn1vIQUKcJHHc6ML5GY5kf0p9uGwrkOXqmZNDr05XXqXEuGQFZIDSd3oYguvqqHdUnyax3P7EYTn1FP8BiJt4qx3P6qcCQcHNjFMxnl4cTxgnrcyzHE6fc8SaWsi2DaDTFDkoHTBDGHoo68TVt0ntTn6pbyV24J2awdECJzmqYMvPL3aCTLD4ziLO8O7x0BDSr30F22Tw1AmJqdwjPbh', 0, NULL, '2022-06-10 20:46:57', '2022-06-10 20:46:57'),
(21, 'Muhammad Reza', 'Pahlevi Y', 'rezarubik17@gmail.com', '2022-06-10 21:10:10', '$2y$10$YbiqFi1kPGzapFpRGi6W5.1Jtv07sB6rng/9W7YlKm7A7u4tO6LO6', NULL, 'PSXF4uMzpkLuxxr9XgbEHSOogGGHyG8VAdKYLYUPKrr9ECRyspWRt4zdVXSQyLN5W29yjHrR5Y2OHkPkpuYF24bSP3IcQvtTwcMkCLXnf69Oh543xwBlcPfWqtcj0BinFUg5ZmeonnoZ1GOBJcRTnZmwiDYh2lEpd6qhqMhuaSIkUOBo4faUEF0k0S8CFV3hndUgTOCMhEmTgtPPcUy4m3uJgRKqAM4zM96RtW75CG5dbjL3VzIqCxKE0j7gBFp', 1, NULL, '2022-06-10 21:09:17', '2022-06-10 21:10:10'),
(22, 'Reza', 'Pahlevi', 'rezap@gmail.com', NULL, '$2y$10$kC/XJu3/zGVD06NOSBnsGu/YwqjyU47zwV255L3k00ZGoXIBV3Hiq', NULL, NULL, 0, NULL, '2023-03-05 02:10:41', '2023-03-05 02:10:41'),
(23, 'Tes', '', 'aselole@gmail.com', NULL, '$2y$10$Ru/DQzfokclGGdF31.uAquI6lwAnWxsV45GVMdzRd1FIxKJkSAtT2', '', NULL, 0, NULL, '2023-03-05 05:46:59', '2023-03-05 05:46:59'),
(24, 'Muhammad Reza', 'Pahlevi Y', 'haha@gmail.com', NULL, '$2y$10$1vZXOZbqhuWBsYsGMPl/6ulju8nRYZUkY4stTB24XtqakVjRPONOy', 'sckAMqW2GSL7RkH8-2023-03-05-photo-.png', NULL, 0, NULL, '2023-03-05 09:19:33', '2023-03-05 10:04:32'),
(25, 'Muhammad Reza', 'Pahlevi Y', 'hehe@gmail.com', NULL, '$2y$10$1Y3Q/fIBlO5i0mEvK3R.JukxmveLO680dGOWhRE0WlE2ToXhZjEr2', '4ZnsPNFYgXthJzCk-2023-03-05-photo-.png', NULL, 0, NULL, '2023-03-05 10:01:53', '2023-03-05 10:01:53'),
(26, 'aldkajd', 'lkajdslj', 'lol@gmail.com', NULL, '$2y$10$8YynmGtBf7orrQ79FZENY.Lp/zGfVu0yVrpl1QSbSo7zb3.4TKCh.', 'zcsDRUB8kSu3vyvp-2023-03-05-photo-.png', NULL, 0, NULL, '2023-03-05 10:05:57', '2023-03-05 10:08:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
