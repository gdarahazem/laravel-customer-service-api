-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 02 août 2025 à 18:47
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `laravel-customer-service-api`
--

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `email`, `phone`, `company`, `address`, `city`, `state`, `postal_code`, `country`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Karelle', 'Runolfsdottir', 'adrain.kemmer@example.com', '+1 (364) 355-7742', 'Kerluke, Willms and Ondricka', '1479 Otha Ways Suite 557', 'Jasttown', 'Iowa', '90129', 'Nicaragua', 'inactive', '2025-08-02 14:38:30', '2025-08-02 14:38:30'),
(2, 'Jasen', 'Fadel', 'cristina.kerluke@example.net', '689-606-2149', 'Emard Group', '15452 Vesta Forest Suite 339', 'Ornburgh', 'North Carolina', '73594-8271', 'Sao Tome and Principe', 'inactive', '2025-08-02 14:38:30', '2025-08-02 14:38:30'),
(3, 'Ara', 'Zieme', 'kertzmann.lloyd@example.org', '786.528.0319', 'Gerhold Group', '4526 Bosco Club Suite 319', 'Vivianefort', 'Massachusetts', '41793', 'Albania', 'inactive', '2025-08-02 14:38:30', '2025-08-02 14:38:30'),
(4, 'Daisha', 'Anderson', 'hannah.turner@example.net', '479.525.8497', 'Fay-Morissette', '477 Kemmer Mews', 'South Willieberg', 'Ohio', '81647-4105', 'Senegal', 'inactive', '2025-08-02 14:38:30', '2025-08-02 14:38:30'),
(5, 'Isaiah', 'White', 'wintheiser.greyson@example.org', '1-657-668-0436', 'Hermiston, Reynolds and Kshlerin', '152 Effertz Radial Suite 080', 'Carolanneborough', 'New Hampshire', '45250-4295', 'Senegal', 'inactive', '2025-08-02 14:38:30', '2025-08-02 14:38:30'),
(6, 'Solon', 'Osinski', 'garnet57@example.net', '678.415.2948', 'Lowe, Brown and Braun', '3417 Michel Stravenue Apt. 595', 'McKenziebury', 'South Carolina', '68380-2014', 'Russian Federation', 'active', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(7, 'Ebba', 'Bruen', 'lindsey.schowalter@example.com', '864.264.1188', 'Schuppe, Windler and Harber', '8341 Kerluke Roads Apt. 337', 'East Margaretta', 'Pennsylvania', '94469', 'Estonia', 'inactive', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(8, 'Lucious', 'Roob', 'von.savanah@example.net', '+1-463-799-7105', 'Kilback, Mitchell and Wisozk', '4049 Russel Garden', 'South Dennis', 'Nebraska', '87806-9649', 'Equatorial Guinea', 'active', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(9, 'Kaley', 'Luettgen', 'jenkins.everett@example.com', '+1 (402) 674-9228', 'Gusikowski-Jacobs', '9703 Zula Dam Apt. 072', 'Dorotheaville', 'Arizona', '03398-3544', 'Togo', 'inactive', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(10, 'Marvin', 'Thiel', 'ffarrell@example.com', '+1-718-829-8405', 'Fahey-Kovacek', '2020 Ashlynn Flats', 'Runolfsdottirstad', 'Mississippi', '38960', 'Moldova', 'inactive', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(11, 'Branson', 'Kunde', 'iwatsica@example.com', '+1-857-399-0489', 'Farrell-Reinger', '990 Schmitt Via Suite 193', 'Andyburgh', 'Wyoming', '36148', 'El Salvador', 'inactive', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(12, 'Nayeli', 'Harvey', 'heaven81@example.net', '+1-603-590-7861', 'Fadel, Bruen and Pfeffer', '754 Carlotta View', 'South Mauriciofurt', 'Nebraska', '76840-3002', 'Saint Kitts and Nevis', 'inactive', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(13, 'Kaitlin', 'Lockman', 'beverly17@example.net', '820.623.9559', 'Bechtelar, Davis and Abernathy', '588 Camylle Burg', 'Port Jackeline', 'New York', '27562', 'Estonia', 'active', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(14, 'Madison', 'Torphy', 'zstanton@example.net', '(631) 920-4240', 'Balistreri, Wuckert and Murray', '640 Oberbrunner Stravenue', 'Hoegermouth', 'Kentucky', '53843-4715', 'Tokelau', 'active', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(15, 'David', 'Glover', 'twatsica@example.com', '1-678-270-2349', 'Runolfsson-Borer', '2824 Labadie Corner', 'Roslynburgh', 'Delaware', '75737', 'Romania', 'active', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(16, 'Kaley', 'Legros', 'darrell93@example.org', '1-260-517-2286', 'Graham Inc', '86117 Metz Ramp', 'Henryberg', 'New Mexico', '09895', 'Bouvet Island (Bouvetoya)', 'inactive', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(17, 'Aurelie', 'Fahey', 'tate11@example.com', '774.264.9140', 'Labadie-Stamm', '86526 Lewis Spurs', 'Lafayetteshire', 'Oklahoma', '85712-9232', 'Portugal', 'inactive', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(18, 'Rosemarie', 'Kuhlman', 'jensen04@example.org', '207-996-4218', 'Dibbert, Hauck and Reichel', '972 Smitham Summit', 'Aiyanaside', 'Massachusetts', '20122-7587', 'Saint Martin', 'active', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(19, 'Eriberto', 'Kuvalis', 'kozey.eveline@example.com', '+1.847.378.4521', 'Nader, Franecki and Raynor', '36101 Rippin Points Apt. 451', 'East Ryleefort', 'New Mexico', '61676-0595', 'South Africa', 'active', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(20, 'Yazmin', 'Christiansen', 'kristian.vandervort@example.com', '351.397.0709', 'Haley-Conroy', '455 Brandon Throughway Apt. 063', 'Sanfordbury', 'Minnesota', '89831', 'Bangladesh', 'inactive', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(21, 'Jeramie', 'Langworth', 'corwin.dell@example.net', '860.883.2447', 'Hilpert, Herman and Wintheiser', '8887 Taya Via Apt. 893', 'North Kyleighview', 'Delaware', '52416', 'South Africa', 'active', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(22, 'Ernie', 'Auer', 'grady98@example.org', '+1-920-634-2610', 'Dach, Turcotte and Sanford', '28639 Petra Village Suite 989', 'Johnsside', 'Minnesota', '81694-5950', 'Argentina', 'active', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(23, 'Marcella', 'Block', 'margarette.runolfsson@example.org', '+16064267056', 'Rice, Steuber and Donnelly', '31909 Schuster Harbors', 'Lloydtown', 'Washington', '05847', 'Hong Kong', 'active', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(24, 'Wilfrid', 'Stehr', 'tkovacek@example.net', '+1.346.344.0156', 'Rowe Ltd', '449 Bosco Flat Suite 810', 'West Augustland', 'Minnesota', '39552', 'Morocco', 'active', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(25, 'Nash', 'Jakubowski', 'okutch@example.org', '+1.586.675.8954', 'Gutmann-Mante', '45046 Daugherty Spurs', 'Hahnport', 'Minnesota', '52027', 'Anguilla', 'active', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(26, 'hazzzim', 'Gdaraa', 'hazim.gdara@gmail.com', '+1987654321', 'Updated Acme Corporation', '123 RUE DE POMME', 'tUNIS', 'TT', '10001', 'tn', 'active', '2025-08-02 17:33:57', '2025-08-02 17:36:45');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_07_12_182958_create_personal_access_tokens_table', 1),
(5, '2025_08_02_152932_create_customers_table', 2),
(6, '2025_08_02_181127_create_services_table', 3);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'api-token', 'b67e04dc3f8979d768f62e056b9f0afaf6747816f291c6807bb8a523188f72ad', '[\"*\"]', NULL, NULL, '2025-08-02 14:21:14', '2025-08-02 14:21:14'),
(2, 'App\\Models\\User', 1, 'api-token', '250da3c66aaa982826a97eda446a5eab7905f05c1fa75ba1caeb9dcbf6853159', '[\"*\"]', NULL, NULL, '2025-08-02 14:21:39', '2025-08-02 14:21:39'),
(3, 'App\\Models\\User', 1, 'api-token', 'b6c32835c6233afafd4cadccfe5388aae22080ea1d879d968d5523e72cc95104', '[\"*\"]', NULL, NULL, '2025-08-02 14:29:13', '2025-08-02 14:29:13'),
(4, 'App\\Models\\User', 2, 'api-token', 'd785a3fd95fc125ab657eefc8ff01101feb114019c19557b3891c977e0baedf7', '[\"*\"]', NULL, NULL, '2025-08-02 17:28:43', '2025-08-02 17:28:43'),
(5, 'App\\Models\\User', 2, 'api-token', 'bf3dc52457b733c46ee9fa966f286d4e8c23ecb66cac022939a8b205540edebe', '[\"*\"]', '2025-08-02 17:41:59', NULL, '2025-08-02 17:30:12', '2025-08-02 17:41:59');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` enum('consultation','development','maintenance','support','training','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('active','inactive','pending','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `duration_hours` int DEFAULT NULL,
  `features` json DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_customer_id_foreign` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `customer_id`, `name`, `description`, `type`, `price`, `status`, `start_date`, `end_date`, `duration_hours`, `features`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 'Web Development', 'Quia necessitatibus dignissimos iusto officia ipsa delectus sequi vel. Necessitatibus voluptatem voluptatem nisi iste voluptates doloribus iure. Et aut animi incidunt cumque.', 'training', 7077.58, 'inactive', '2025-02-07', '2025-11-06', 292, '[\"Mobile Optimization\", \"Admin Panel\", \"Analytics Integration\"]', NULL, '2025-08-02 17:21:33', '2025-08-02 17:21:33'),
(2, 2, 'Web Development', 'Aut et libero et delectus error maxime sunt. Quia reprehenderit nihil velit ipsum rem earum iusto. Et et nihil dolor.', 'training', 9044.05, 'active', '2025-05-25', '2025-08-23', 360, '[\"User Authentication\", \"Analytics Integration\", \"Real-time Updates\", \"Third-party APIs\"]', NULL, '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(3, 2, 'Technical Consultation', 'Sapiente tenetur officiis officia laboriosam accusantium. Doloribus voluptates ut dignissimos eveniet magnam consequatur doloremque. Suscipit voluptate accusantium fuga temporibus laudantium qui. Fugit rerum officiis beatae vitae et nostrum.', 'consultation', 2653.24, 'completed', '2025-05-18', '2025-11-12', 408, '[\"Third-party APIs\", \"Security Features\", \"Mobile Optimization\"]', 'Asperiores modi cupiditate perspiciatis ea sit perspiciatis esse.', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(4, 3, 'Security Audit', 'Dolor ut adipisci aut eveniet eum. Dolores doloribus nihil non et adipisci. Saepe in deleniti debitis laboriosam nam reprehenderit minima ipsum. Consectetur vel sit assumenda expedita optio et suscipit doloribus.', 'other', 9604.42, 'active', '2025-03-14', '2026-01-18', 408, '[\"Third-party APIs\", \"Analytics Integration\", \"SEO Optimization\", \"Admin Panel\"]', 'Minima iste iure est aspernatur.', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(5, 4, 'Maintenance Package', 'Et maiores iusto soluta praesentium est. Ut voluptatibus laboriosam esse quis. Sint cum dolorem numquam sint tenetur.', 'development', 1198.48, 'completed', '2025-08-23', '2025-12-12', 500, '[\"Admin Panel\", \"User Authentication\", \"Analytics Integration\", \"Responsive Design\", \"Third-party APIs\"]', NULL, '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(6, 4, 'Web Development', 'Reprehenderit omnis fugit necessitatibus maxime. A aut corporis possimus iusto odit saepe. Pariatur eius velit ea omnis neque.', 'support', 1411.21, 'completed', '2025-05-10', '2025-05-18', 342, '[\"Analytics Integration\", \"Admin Panel\"]', 'Est tenetur culpa tempora voluptatem ea.', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(7, 5, 'System Integration', 'Non ut totam vero rerum fugit. Unde distinctio sed quia ipsam qui sed exercitationem ullam. Sit suscipit sunt asperiores in velit aut.', 'development', 2367.25, 'pending', '2025-05-03', '2025-05-24', 238, '[\"Analytics Integration\", \"Payment Integration\", \"Security Features\", \"User Authentication\"]', 'Eius et adipisci nihil sunt veniam et maiores.', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(8, 5, 'System Integration', 'Velit et fugiat necessitatibus explicabo repudiandae quidem. Minima necessitatibus molestias dolorem ratione eos provident culpa. Inventore distinctio quia quos id totam a.', 'maintenance', 614.00, 'inactive', '2025-02-04', '2025-07-06', 282, '[\"Admin Panel\", \"Analytics Integration\", \"User Authentication\", \"Third-party APIs\"]', 'Ratione sed esse id aspernatur et quia.', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(9, 6, 'System Integration', 'Unde ut non sed alias corrupti. Et autem voluptatem veritatis laboriosam consectetur quidem. Soluta sed repudiandae nam et aspernatur pariatur. A quis et omnis vel. Sit nemo facere at ex.', 'consultation', 8781.02, 'inactive', '2025-05-06', '2025-11-12', 149, '[\"Mobile Optimization\", \"User Authentication\", \"SEO Optimization\", \"Third-party APIs\", \"Analytics Integration\"]', NULL, '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(10, 7, 'E-commerce Solution', 'Animi vel blanditiis et consequatur blanditiis. Beatae iure quis ut illum ut. Doloribus non esse et quaerat. Et vitae hic ipsam omnis doloribus sapiente autem. Non voluptatem consectetur dignissimos dolorem.', 'support', 8056.53, 'inactive', '2025-03-10', '2025-05-04', 352, '[\"Security Features\", \"Mobile Optimization\", \"Analytics Integration\"]', 'Rerum error consequatur soluta soluta facere distinctio.', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(11, 8, 'E-commerce Solution', 'Et ipsam ducimus ex in rerum. Fuga tempora consectetur est sit libero consectetur debitis. Perspiciatis adipisci itaque consequatur sequi eos omnis. Porro totam fugiat blanditiis ex cum.', 'development', 4305.16, 'completed', '2025-08-18', '2025-11-12', 78, '[\"Responsive Design\", \"SEO Optimization\"]', 'Nulla mollitia est veritatis facilis amet aut architecto.', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(12, 9, 'Database Design', 'Aperiam dolore eum ex eum voluptatem et. Corrupti eveniet sint qui ad quas. Nihil ut itaque fugit beatae quo.', 'other', 2055.74, 'completed', '2025-06-28', '2026-01-07', 101, '[\"Admin Panel\", \"Mobile Optimization\"]', 'Id in ad enim quis accusantium.', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(13, 10, 'Technical Consultation', 'Aspernatur aperiam molestias et iste ipsam saepe aliquid. Porro natus atque ut animi molestiae repellendus quia odit. Non est vel omnis facilis eaque ex.', 'development', 3272.22, 'inactive', '2025-06-10', '2025-08-30', 200, '[\"Mobile Optimization\", \"Security Features\", \"Third-party APIs\", \"Admin Panel\", \"Real-time Updates\"]', NULL, '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(14, 11, 'Security Audit', 'Animi minus nemo similique ratione aut. Aut numquam error est itaque molestias non et. Illum esse debitis porro.', 'support', 8281.19, 'inactive', '2025-06-20', '2025-09-06', 391, '[\"Mobile Optimization\", \"Real-time Updates\", \"Responsive Design\", \"Third-party APIs\"]', NULL, '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(15, 12, 'Database Design', 'Est quas et officiis aut consequuntur et voluptatibus. Voluptate quae odio accusamus aut sunt velit.', 'development', 1949.58, 'completed', '2025-06-06', '2025-10-01', 213, '[\"Security Features\", \"Real-time Updates\", \"Responsive Design\", \"Mobile Optimization\"]', 'Eius et cumque repudiandae omnis iste ut molestias.', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(16, 13, 'Technical Consultation', 'Est qui eos cupiditate accusantium dolorum quaerat. Et qui quia velit officia odio eos. Corporis unde dicta rerum. Repellendus aut animi dolorum ab accusantium voluptatem corporis.', 'other', 1308.30, 'completed', '2025-05-29', '2025-11-29', 336, '[\"Admin Panel\", \"User Authentication\", \"Analytics Integration\", \"Third-party APIs\", \"Payment Integration\"]', 'Error nam quam mollitia eos nulla.', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(17, 14, 'Maintenance Package', 'Officia culpa voluptatibus ab est fugiat maiores ab. Sed tempora officiis in vero enim sed. Ipsa in autem sequi ipsam quas.', 'maintenance', 4117.71, 'pending', '2025-06-10', '2025-08-24', 124, '[\"Real-time Updates\", \"Analytics Integration\", \"Security Features\", \"Third-party APIs\", \"Mobile Optimization\"]', NULL, '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(18, 15, 'Database Design', 'Nulla eaque doloremque ullam ad quo mollitia iste. Nostrum quae perferendis cumque expedita.', 'consultation', 921.98, 'completed', '2025-06-21', '2025-09-26', 203, '[\"SEO Optimization\", \"Responsive Design\", \"Real-time Updates\", \"Analytics Integration\", \"Security Features\"]', 'Accusamus ex qui porro sint ex repudiandae occaecati vero.', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(19, 16, 'API Development', 'Minus illo eum reprehenderit sapiente. Maiores iste rem dolores et ut enim est. Aut aut voluptas nihil repellat similique modi nesciunt. Delectus aut quis ab est aut.', 'consultation', 1340.37, 'active', '2025-08-26', '2026-01-09', 321, '[\"Security Features\", \"User Authentication\", \"Mobile Optimization\"]', 'Et odio error debitis nesciunt.', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(20, 17, 'Mobile App Development', 'At aperiam id voluptas eius minus. Quod laudantium velit harum voluptas. Id enim saepe totam est exercitationem magni dolores repellat. Amet voluptatibus ea dolore porro sequi.', 'consultation', 5622.70, 'pending', '2025-07-14', '2025-12-19', 266, '[\"Security Features\", \"Third-party APIs\", \"Analytics Integration\"]', 'Ratione velit beatae repellendus ratione molestiae.', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(21, 18, 'Mobile App Development', 'Magnam non possimus neque illo eos distinctio dolor. Est reprehenderit voluptatum unde. Tempore architecto voluptatem eligendi aliquam.', 'training', 5481.12, 'pending', '2025-07-11', '2025-11-29', 419, '[\"Admin Panel\", \"Real-time Updates\", \"Analytics Integration\", \"Security Features\", \"Payment Integration\"]', NULL, '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(22, 19, 'System Integration', 'Dolor odit sint voluptas est iste quibusdam voluptas placeat. Fugiat voluptate unde voluptas ut rem. Est quia ut aspernatur laboriosam dicta sequi quod.', 'training', 3253.10, 'pending', '2025-07-11', '2025-09-12', 485, '[\"Analytics Integration\", \"Responsive Design\", \"Security Features\", \"Admin Panel\"]', NULL, '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(23, 20, 'Mobile App Development', 'Est impedit aut vitae ex culpa. Non ullam illo cumque molestiae mollitia quod ea perspiciatis. Eum sit molestiae et ullam labore aspernatur qui sint.', 'maintenance', 5173.20, 'pending', '2025-05-19', '2025-07-23', 473, '[\"Security Features\", \"SEO Optimization\"]', NULL, '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(24, 21, 'Technical Consultation', 'Rerum ea id dolore ducimus. Rerum est eum asperiores dolor ad ipsum nulla. Est quae accusantium modi consequatur illo. Aut officiis odit sit ut omnis et. Eveniet dolorum nam fugiat sed.', 'other', 1124.15, 'inactive', '2025-03-21', '2025-10-10', 155, '[\"User Authentication\", \"Mobile Optimization\", \"Analytics Integration\", \"Security Features\"]', 'Quia unde non eos delectus et qui et.', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(25, 22, 'E-commerce Solution', 'Est sit dolorum error nemo ratione ab. Fugit ipsam odit asperiores illum soluta iste ratione labore. Id qui aspernatur ex enim.', 'maintenance', 9804.19, 'active', '2025-02-24', '2026-01-27', 305, '[\"Analytics Integration\", \"Admin Panel\", \"User Authentication\", \"Real-time Updates\"]', 'Id aspernatur esse est eveniet.', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(26, 23, 'Performance Optimization', 'Ea amet alias ad repudiandae. Occaecati debitis vitae qui voluptas tempora error fugit. Dolores pariatur quam temporibus laudantium. Corrupti possimus eos mollitia consequatur totam laudantium tenetur.', 'development', 4518.75, 'active', '2025-08-22', '2025-09-24', 76, '[\"Real-time Updates\", \"Mobile Optimization\", \"SEO Optimization\", \"Responsive Design\", \"Third-party APIs\"]', 'Architecto aperiam velit enim alias ut at.', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(27, 24, 'Security Audit', 'Quos a possimus doloribus expedita sequi qui voluptatem. Dolorem molestiae dolorem enim. Saepe incidunt quos quis nihil voluptatem.', 'support', 4253.77, 'completed', '2025-07-18', '2026-01-28', 285, '[\"Payment Integration\", \"Third-party APIs\", \"Analytics Integration\", \"Mobile Optimization\"]', 'Nesciunt omnis corrupti commodi repudiandae repellendus impedit cupiditate.', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(28, 25, 'System Integration', 'Dolor sint voluptatem rerum quisquam. Et quidem nobis neque repellat. Dolores excepturi rerum suscipit accusamus dolore. Dolor dolores temporibus mollitia ut voluptates odit autem.', 'consultation', 6183.58, 'pending', '2025-02-12', '2025-03-08', 353, '[\"Mobile Optimization\", \"User Authentication\", \"Analytics Integration\"]', 'Qui et atque dolor dolorem ut nemo et.', '2025-08-02 17:21:34', '2025-08-02 17:21:34'),
(29, 26, 'E-commerce Website Development', 'Complete e-commerce solution with modern features including payment integration, inventory management, and admin panel', 'development', 5000.00, 'active', '2025-08-05', '2025-09-24', 200, '[\"Responsive Design\", \"Payment Gateway Integration\", \"Admin Panel\", \"Inventory Management\", \"SEO Optimization\", \"Mobile Optimization\"]', 'Client prefers React frontend with Laravel backend. Requires integration with existing CRM system.', '2025-08-02 17:40:43', '2025-08-02 17:40:43');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Hazem Gdara', 'hazem@gmail.com', NULL, '$2y$12$u5SowaJ4dn3YfnYz50hDIOEFqs2GAnq3xxPk54Zc4V6atwr3ObRzq', NULL, '2025-08-02 14:21:14', '2025-08-02 14:21:14'),
(2, 'hazem1', 'hazem1@gmail.com', NULL, '$2y$12$nUGcwikec5GJ3p3OIpdX7eXWcYUIdSHIooWC1AkPsGXlbf1YXF9pS', NULL, '2025-08-02 17:28:42', '2025-08-02 17:28:42');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
