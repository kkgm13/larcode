-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 20, 2021 at 08:04 AM
-- Server version: 5.7.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `larafsharp`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'aspernatur qui eos', '2021-08-20 06:54:33', '2021-08-20 06:54:33'),
(2, 'aliquam qui et', '2021-08-20 06:54:33', '2021-08-20 06:54:33'),
(3, 'in quia officiis', '2021-08-20 06:54:33', '2021-08-20 06:54:33'),
(4, 'et enim id', '2021-08-20 06:54:33', '2021-08-20 06:54:33'),
(5, 'in earum perspiciatis', '2021-08-20 06:54:33', '2021-08-20 06:54:33'),
(6, 'ab quod et', '2021-08-20 06:54:33', '2021-08-20 06:54:33'),
(7, 'saepe modi ut', '2021-08-20 06:54:33', '2021-08-20 06:54:33'),
(8, 'rerum perferendis rerum', '2021-08-20 06:54:33', '2021-08-20 06:54:33'),
(9, 'in provident rerum', '2021-08-20 06:54:33', '2021-08-20 06:54:33'),
(10, 'atque ipsum laudantium', '2021-08-20 06:54:33', '2021-08-20 06:54:33');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '2014_10_12_000000_create_users_table', 1),
(7, '2014_10_12_100000_create_password_resets_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2021_04_23_082236_create_meetings_table', 1),
(10, '2021_07_27_103910_create_schedules_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meetId` bigint(20) UNSIGNED NOT NULL COMMENT 'Meeting ID RELATION',
  `isRepeat` tinyint(1) NOT NULL COMMENT 'Repeating Meeting',
  `start` datetime NOT NULL COMMENT 'Meeting Date',
  `duration` time NOT NULL COMMENT 'Meeting Duration',
  `repDays` int(11) DEFAULT NULL COMMENT 'Repeated Days',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `meetId`, `isRepeat`, `start`, `duration`, `repDays`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-02-08 05:41:59', '00:00:00', 7, '2021-08-20 06:54:34', '2021-08-20 06:54:34'),
(2, 2, 1, '2021-09-04 22:08:00', '05:00:00', 26, '2021-08-20 06:54:34', '2021-08-20 06:54:34'),
(3, 3, 0, '2021-11-19 14:05:08', '05:00:00', NULL, '2021-08-20 06:54:34', '2021-08-20 06:54:34'),
(4, 4, 0, '2022-04-10 19:56:37', '03:00:00', NULL, '2021-08-20 06:54:34', '2021-08-20 06:54:34'),
(5, 5, 1, '2022-07-12 19:55:42', '05:00:00', 11, '2021-08-20 06:54:34', '2021-08-20 06:54:34'),
(6, 6, 0, '2021-10-31 15:10:00', '00:50:00', NULL, '2021-08-20 07:58:56', '2021-08-20 07:58:56'),
(7, 7, 1, '2022-01-03 14:30:00', '01:00:00', 30, '2021-08-20 07:59:50', '2021-08-20 07:59:50'),
(8, 8, 0, '2021-12-10 10:00:00', '01:00:00', NULL, '2021-08-20 08:00:25', '2021-08-20 08:00:25'),
(9, 9, 0, '2022-04-28 13:50:00', '00:30:00', NULL, '2021-08-20 08:01:13', '2021-08-20 08:01:13'),
(10, 10, 1, '2021-10-29 18:00:00', '00:10:00', 30, '2021-08-20 08:01:57', '2021-08-20 08:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedules_meetid_foreign` (`meetId`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_meetid_foreign` FOREIGN KEY (`meetId`) REFERENCES `meetings` (`id`);