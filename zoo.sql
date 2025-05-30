-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 30 mai 2025 à 13:17
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `zoo`
--

-- --------------------------------------------------------

--
-- Structure de la table `animals`
--

CREATE TABLE `animals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `species` varchar(255) NOT NULL,
  `habitat` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `animals`
--

INSERT INTO `animals` (`id`, `name`, `species`, `habitat`, `origin`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Lion', 'Panthera leo', 'Savane', 'Afrique', NULL, 'inactive', '2025-05-21 05:16:32', '2025-05-22 13:59:42'),
(2, 'Tigre', 'Panthera tigris', 'Forêt tropicale', 'Asie', NULL, 'active', '2025-05-21 05:16:32', '2025-05-21 05:16:32'),
(3, 'Éléphant', 'Loxodonta africana', 'Savane et forêt', 'Afrique', NULL, 'active', '2025-05-21 05:16:32', '2025-05-21 05:16:32'),
(4, 'Girafe', 'Giraffa camelopardalis', 'Savane', 'Afrique', NULL, 'active', '2025-05-21 05:16:32', '2025-05-21 05:16:32'),
(5, 'Zèbre', 'Equus quagga', 'Savane', 'Afrique', NULL, 'active', '2025-05-21 05:16:32', '2025-05-21 05:16:32'),
(6, 'Crocodile', 'Crocodylus niloticus', 'Rivières et lacs', 'Afrique', NULL, 'inactive', '2025-05-21 05:16:32', '2025-05-21 05:16:32'),
(7, 'Panda', 'Ailuropoda melanoleuca', 'Forêt de bambou', 'Chine', NULL, 'active', '2025-05-21 05:16:32', '2025-05-21 05:16:32'),
(8, 'Kangourou', 'Macropus rufus', 'Plaines et déserts', 'Australie', NULL, 'active', '2025-05-21 05:16:32', '2025-05-21 05:16:32'),
(9, 'Loup', 'Canis lupus', 'Forêts et montagnes', 'Eurasie, Amérique du Nord', NULL, 'active', '2025-05-21 05:16:32', '2025-05-21 05:16:32'),
(10, 'Ours brun', 'Ursus arctos', 'Forêts et montagnes', 'Eurasie, Amérique du Nord', NULL, 'inactive', '2025-05-21 05:16:32', '2025-05-21 05:16:32'),
(11, 'Renard', 'Vulpes vulpes', 'Forêts, zones urbaines', 'Hémisphère Nord', NULL, 'active', '2025-05-21 05:16:32', '2025-05-21 05:16:32'),
(12, 'Chèvre', 'Capra aegagrus hircus', 'Montagnes, fermes', 'Monde entier', NULL, 'active', '2025-05-21 05:16:32', '2025-05-21 05:16:32'),
(13, 'Dauphin', 'Delphinus delphis', 'Océans', 'Monde entier', NULL, 'active', '2025-05-21 05:16:32', '2025-05-21 05:16:32'),
(14, 'Aigle', 'Aquila chrysaetos', 'Montagnes, forêts', 'Hémisphère Nord', NULL, 'active', '2025-05-21 05:16:32', '2025-05-21 05:16:32'),
(15, 'Paon', 'Pavo cristatus', 'Forêts', 'Inde', NULL, 'inactive', '2025-05-21 05:16:32', '2025-05-21 05:16:32'),
(16, 'Hippopotame', 'Hippopotamus amphibius', 'Rivières et lacs', 'Afrique', NULL, 'active', '2025-05-21 05:16:32', '2025-05-21 05:16:32'),
(17, 'Rhinocéros', 'Rhinocerotidae', 'Savane, forêts', 'Afrique, Asie', NULL, 'active', '2025-05-21 05:16:32', '2025-05-21 05:16:32'),
(18, 'Chameau', 'Camelus dromedarius', 'Déserts', 'Afrique, Moyen-Orient', NULL, 'active', '2025-05-21 05:16:32', '2025-05-21 05:16:32'),
(19, 'Paresseux', 'Folivora', 'Forêts tropicales', 'Amérique Centrale et du Sud', NULL, 'inactive', '2025-05-21 05:16:32', '2025-05-21 05:16:32'),
(20, 'Flamant rose', 'Phoenicopterus roseus', 'Zones humides', 'Afrique, Europe, Asie', NULL, 'active', '2025-05-21 05:16:32', '2025-05-21 05:16:32');

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_05_13_161648_create_animals_table', 1),
(2, 'create_cache_table', 1),
(3, 'create_jobs_table', 1),
(4, 'create_orders_table', 1),
(5, 'create_tickets_table', 1),
(6, 'create_users_table', 1),
(7, '2025_05_20_135601_add_role_to_users_table', 2),
(8, '2025_05_20_184309_add_visit_date_to_order_tickets_table', 3);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `stripe_id` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `amount`, `status`, `stripe_id`, `created_at`, `updated_at`) VALUES
(1, 1, 470, 0, NULL, '2025-05-20 14:51:36', '2025-05-20 14:51:36'),
(2, 1, 470, 1, 'cs_test_a1r6ipepJzoNE9tJOfEyhq6r8eJvOLxnYi1J4UuYbrh3ejEukDYlF3LYWr', '2025-05-20 14:52:34', '2025-05-20 14:53:16'),
(3, 1, 120, 1, 'cs_test_a1xwBOgaOoInzPxbTXn14WTZuTP5ROIVWHOB2SA5Sp3xiGJjQgoEq7eizv', '2025-05-20 17:59:01', '2025-05-20 17:59:39'),
(4, 1, 70, 1, 'cs_test_a1e9Hg6XWlKbZWz4DkG9bqWYWnp9MQC6FcX6Puhu3eBIA6lJZa0vpmhQwu', '2025-05-20 18:10:32', '2025-05-20 18:10:58'),
(5, 3, 140, 1, 'cs_test_a1BUtCAqBI1uGv1suS1cYoWIYJW7Sj1sfYCjbWCLpkqVOlzMluHhL0YnGI', '2025-05-20 18:49:12', '2025-05-20 18:49:40'),
(6, 3, 200, 1, 'cs_test_a1x8LOLHkMBqXJrIf3MALAR439JlZQ47XetB3Def7IgWR5GrR9s8xik0wb', '2025-05-20 19:11:04', '2025-05-20 19:11:54'),
(7, 4, 210, 1, 'cs_test_a1CF883zMd9VyRaACjlayjBeH8rDkQd2PUm3KdWDnb3cIbr0xbjqZnGiII', '2025-05-20 20:13:16', '2025-05-20 20:14:04'),
(8, 2, 140, 0, NULL, '2025-05-21 07:24:24', '2025-05-21 07:24:24'),
(9, 2, 140, 0, NULL, '2025-05-21 07:31:44', '2025-05-21 07:31:44'),
(10, 6, 360, 1, 'cs_test_a1WMz1rGovKOtreWTqDTtiz3lRMDYMrxRcpWwhUxSoR53eGCMjOhWjevlp', '2025-05-22 13:57:44', '2025-05-22 13:58:25');

-- --------------------------------------------------------

--
-- Structure de la table `order_tickets`
--

CREATE TABLE `order_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `visit_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `order_tickets`
--

INSERT INTO `order_tickets` (`id`, `order_id`, `ticket_id`, `quantity`, `price`, `visit_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 70, NULL, '2025-05-20 14:51:36', '2025-05-20 14:51:36'),
(2, 1, 2, 2, 50, NULL, '2025-05-20 14:51:36', '2025-05-20 14:51:36'),
(3, 1, 3, 3, 100, NULL, '2025-05-20 14:51:36', '2025-05-20 14:51:36'),
(4, 2, 1, 1, 70, NULL, '2025-05-20 14:52:34', '2025-05-20 14:52:34'),
(5, 2, 2, 2, 50, NULL, '2025-05-20 14:52:34', '2025-05-20 14:52:34'),
(6, 2, 3, 3, 100, NULL, '2025-05-20 14:52:34', '2025-05-20 14:52:34'),
(7, 3, 1, 1, 70, NULL, '2025-05-20 17:59:01', '2025-05-20 17:59:01'),
(8, 3, 2, 1, 50, NULL, '2025-05-20 17:59:01', '2025-05-20 17:59:01'),
(9, 4, 1, 1, 70, NULL, '2025-05-20 18:10:32', '2025-05-20 18:10:32'),
(10, 5, 1, 2, 70, NULL, '2025-05-20 18:49:12', '2025-05-20 18:49:12'),
(11, 6, 3, 2, 100, '2025-05-25', '2025-05-20 19:11:04', '2025-05-20 19:11:04'),
(12, 7, 1, 1, 70, '2025-05-21', '2025-05-20 20:13:16', '2025-05-20 20:13:16'),
(13, 7, 1, 2, 70, '2025-05-22', '2025-05-20 20:13:16', '2025-05-20 20:13:16'),
(14, 8, 1, 1, 70, '2025-05-23', '2025-05-21 07:24:24', '2025-05-21 07:24:24'),
(15, 8, 1, 1, 70, '2025-05-30', '2025-05-21 07:24:24', '2025-05-21 07:24:24'),
(16, 9, 1, 1, 70, '2025-05-23', '2025-05-21 07:31:44', '2025-05-21 07:31:44'),
(17, 9, 1, 1, 70, '2025-05-30', '2025-05-21 07:31:44', '2025-05-21 07:31:44'),
(18, 10, 1, 3, 70, '2025-05-23', '2025-05-22 13:57:44', '2025-05-22 13:57:44'),
(19, 10, 2, 3, 50, '2025-05-23', '2025-05-22 13:57:44', '2025-05-22 13:57:44');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tickets`
--

INSERT INTO `tickets` (`id`, `type`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Adulte', 70.00, NULL, NULL),
(2, 'Enfant', 50.00, NULL, NULL),
(3, 'VIP', 100.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Hanan Gharibi', 'hanan.gharibi@gmail.com', NULL, '$2y$12$ZCEEcyTBIjeBrQwpnaUiBOnbQjbawZrdTBhTia.adE0GYiOppW..G', NULL, '2025-05-20 12:59:16', '2025-05-20 12:59:16', 'user'),
(2, 'admin', 'admin@gmail.com', NULL, '$2y$12$GX/CSR3fZFNazHw3.KRsoO13IXEAcoCbU2UbnzSdMCjzOWeNf3EWm', NULL, '2025-05-20 12:59:58', '2025-05-20 12:59:58', 'admin'),
(3, 'Maryam Ait El Mouden', 'maryam.ait@gmail.com', NULL, '$2y$12$fJ.VSy5T5eEfr3ux3ndb..qw2SmdmVJdUlnZkdCTnyIWUdZZaMgyS', NULL, '2025-05-20 16:11:27', '2025-05-20 16:11:27', 'user'),
(4, 'Nihad Achbout', 'nihad.achbout@gmail.com', NULL, '$2y$12$K1pn4rCB3hvDtdeqQQyute.gaTnog6FclifB3vnXBLifYXUOkatem', NULL, '2025-05-20 19:19:59', '2025-05-20 19:19:59', 'user'),
(6, 'Fatima Achbout', 'fatima.achbout@gmail.com', NULL, '$2y$12$t8z9trW0JHuprlGYiB2ThOKESrD/kE.te0J7Ejl.j/S9SRF5lZYiK', NULL, '2025-05-22 13:56:42', '2025-05-22 13:56:42', 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order_tickets`
--
ALTER TABLE `order_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `animals`
--
ALTER TABLE `animals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `order_tickets`
--
ALTER TABLE `order_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
