-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 03 déc. 2025 à 23:51
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `culture`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteurs`
--

CREATE TABLE `auteurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-fortify.2fa_codes.031b9c8d7e4fad068bf9bf080be683c6', 'i:58826490;', 1764794773);

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `texte` text NOT NULL,
  `note` int(11) NOT NULL,
  `date` date NOT NULL,
  `id_utilisateur` bigint(20) UNSIGNED NOT NULL,
  `id_contenu` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `texte`, `note`, `date`, `id_utilisateur`, `id_contenu`, `created_at`, `updated_at`) VALUES
(1, 'Excellent article ! Très instructif sur les traditions béninoises.', 5, '2024-01-25', 2, 1, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(2, 'Merci pour ce partage. J\'ai appris beaucoup de choses sur l\'histoire.', 4, '2024-02-15', 3, 1, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(4, 'Très bon article. J\'y étais l\'année dernière, c\'était magnifique !', 5, '2024-02-01', 5, 1, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(5, 'Intéressant, mais j\'aurais aimé plus de détails sur les masques.', 3, '2024-03-05', 2, 1, '2025-12-02 14:56:57', '2025-12-02 14:56:57');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire_notes`
--

CREATE TABLE `commentaire_notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commentaire_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `note` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contenus`
--

CREATE TABLE `contenus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `texte` text DEFAULT NULL,
  `statut` varchar(50) NOT NULL DEFAULT 'en_attente',
  `date_creation` date NOT NULL,
  `date_validation` date DEFAULT NULL,
  `id_region` bigint(20) UNSIGNED NOT NULL,
  `id_langue` bigint(20) UNSIGNED NOT NULL,
  `id_moderateur` bigint(20) UNSIGNED NOT NULL DEFAULT 2,
  `id_type_contenu` bigint(20) UNSIGNED NOT NULL,
  `id_auteur` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `note` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contenus`
--

INSERT INTO `contenus` (`id`, `titre`, `texte`, `statut`, `date_creation`, `date_validation`, `id_region`, `id_langue`, `id_moderateur`, `id_type_contenu`, `id_auteur`, `created_at`, `updated_at`, `note`) VALUES
(1, 'La Fête du vodoun', 'La Fête du vodoun est une cérémonie traditionnelle du Bénin. Elle est célébrée en l\'honneur des ancêtres et des esprits.', 'validé', '2024-01-25', '2024-01-27', 2, 6, 4, 1, 2, '2025-12-02 14:56:57', '2025-12-02 14:56:57', NULL),
(2, 'maison de vacances', 'Salut', 'en-attente', '2025-12-02', NULL, 1, 12, 2, 6, 6, '2025-12-02 15:14:05', '2025-12-02 15:14:05', NULL),
(3, 'Title: Vodun Azǎn lɛ: Gbigbɔ kpo Akɔta Benin Tɔn kpo sín Xwèɖuɖu', 'Vodun Azǎn lɛ nyí xwè to lɛ bǐ tɔn ɖé bo nɔ ɖu Vodun sín nǔɖiɖó lɛ, aca lɛ kpo gbigbɔ tɔn lɛ kpo sín xwè, bo nyí dodónu ɖé bo nɔ xlɛ́ mɛ alɔkpa e Benin nyí é ɖé, bo lɛ́ nyí tɔ́gbó lɛ sín gǔ. Ðò janvier ɖokpo ɖokpo mɛ ɔ, toxo hwexónu tɔn Ouidah tɔn wɛ nɔ huzu ayixa e mɛ nǔwiwa enɛ nɔ xò nǔ ɖè é, bo nɔ yí mɛ afatɔ́n mɔkpan sín gbɛ̀ ɔ bǐ mɛ. Nǔwiwa mímɛ́ lɛ, weɖuɖu sinsɛn tɔn lɛ (Zangbeto kpo Egungun kpo sín ɖiɖe e è tuùn ganji lɛ é lɔ ɖ’emɛ), hanjiji ɖò kɔ́xota ɖò tɔdo ɔ mɛ, kpo nǔɖiɖó lɛ ɖiɖexlɛ́ kpo wɛ ɖò tuto ɔ mɛ, bɔ enɛ nɔ huzu toxo ɔ dó huzu fí e è nɔ mɔ aca kpo lee nǔ nɔ cí nú mɛ é kpo ɖè é ɖé. Jonɔ lɛ sixu lɛ́ kpɔ́n Vodun Gletoxo ɔ, fí e mɛ gbɛtɔ́ lɛ nɔ nɔ é ɖé wɛ, bɔ è nɔ bló alɔnuzɔ́ lɛ, nǔɖuɖu xá ɔ mɛ tɔn lɛ kpo nǔwiwa vovo lɛ kpo ɖè. Vodun Azǎn lɛ sín linlin wɛ nyí ɖɔ è ni sɔ́ nǔɖokan Benin tɔn lɛ sù, bo ɖè sinsɛn Vodun tɔn sín nǔ e ɖò hwlahwlá lɛ é síìn, lobo lɛ́ bló bɔ xóɖɔɖókpɔ́ ɖò aca lɛ tɛntin na lidǒ. Gbɛ̀ e mɛ aca tɔ́gbó lɛ tɔn lɛ nɔ kpé nǔ égbé tɔn lɛ ɖè é ɖé mɛ ɖiɖó gɔ́ngɔ́n wɛ é nyí.', 'validé', '2025-12-08', NULL, 3, 1, 2, 2, 5, NULL, NULL, 5);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `langues`
--

CREATE TABLE `langues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_langue` varchar(100) NOT NULL,
  `code_langue` varchar(5) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `langues`
--

INSERT INTO `langues` (`id`, `nom_langue`, `code_langue`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Fon', 'FN', 'Principale langue du Sud du Bénin, largement utilisée à Cotonou, Abomey et Porto-Novo. Le fon est une langue riche en proverbes, chants et traditions royales du royaume du Danhomè.', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(2, 'Yoruba', 'YO', 'Langue parlée surtout au Sud-Est du Bénin, notamment à Porto-Novo et dans les communautés yoruba du plateau. Dotée d’un héritage religieux et culturel fort.', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(3, 'Dendi', 'DE', 'Langue majeure du Nord du Bénin, surtout à Kandi et Malanville. Le dendi est influencé par le haoussa et le zarma.', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(4, 'Goun', 'GO', 'Langue étroitement liée au fon, principalement parlée à Porto-Novo et dans les régions avoisinantes. Très présente dans les arts traditionnels.', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(5, 'Bariba', 'BA', 'Langue parlée dans le Nord-Est du Bénin, notamment à Parakou et Nikki. Elle porte l’héritage guerrier et historique du royaume bariba.', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(6, 'Adja', 'AD', 'Langue parlée dans le Sud-Ouest du Bénin, surtout à Lokossa et Dogbo. L’adja est lié culturellement au fon et au goun.', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(7, 'Béti', 'BT', 'Langue parlée par des groupes minoritaires du Centre du Bénin. Riche en contes et traditions orales.', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(8, 'Peulh (Fulfulde)', 'PL', 'Langue des communautés nomades et semi-nomades peulhs, très présente dans le Nord du pays. Connue pour sa musicalité et son vocabulaire pastoral.', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(9, 'Ottamari', 'OT', 'Langue parlée dans la région de Natitingou par les peuples Somba. Elle accompagne une culture architecturale unique (tata somba).', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(10, 'Wémè (Ouémègbé)', 'WM', 'Langue parlée autour de la vallée de l’Ouémé. Très utilisée dans les chants et rituels traditionnels.', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(11, 'Nagot', 'NG', 'Langue yoruboïde parlée par les communautés nagot dans le centre et le sud du Bénin. Riche en traditions orales et en histoire migratoire.', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(12, 'Ditamari', 'DT', 'Langue parlée dans les montagnes de l’Atacora. Associée aux peuples tamberma, réputés pour leurs habitations fortifiées.', '2025-12-02 14:56:55', '2025-12-02 14:56:55');

-- --------------------------------------------------------

--
-- Structure de la table `login_histories`
--

CREATE TABLE `login_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id_old` bigint(20) UNSIGNED DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `login_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `login_histories`
--

INSERT INTO `login_histories` (`id`, `user_id_old`, `user_type`, `ip_address`, `user_agent`, `login_at`, `created_at`, `updated_at`, `user_id`) VALUES
(2, NULL, 'App\\Models\\Utilisateur', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-02 19:22:46', '2025-12-02 19:22:46', '2025-12-02 19:22:46', 6),
(3, NULL, 'App\\Models\\User', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', '2025-12-03 05:21:51', '2025-12-03 05:21:51', '2025-12-03 05:21:51', 2),
(4, NULL, 'App\\Models\\User', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', '2025-12-03 08:35:16', '2025-12-03 08:35:16', '2025-12-03 08:35:16', 2),
(5, NULL, 'App\\Models\\User', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-03 08:36:08', '2025-12-03 08:36:08', '2025-12-03 08:36:08', 2),
(6, NULL, 'App\\Models\\User', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', '2025-12-03 16:28:03', '2025-12-03 16:28:03', '2025-12-03 16:28:03', 2),
(7, NULL, 'App\\Models\\User', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-03 19:06:37', '2025-12-03 19:06:37', '2025-12-03 19:06:37', 2);

-- --------------------------------------------------------

--
-- Structure de la table `medias`
--

CREATE TABLE `medias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chemin` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `prix` int(11) NOT NULL DEFAULT 0,
  `transaction_id` varchar(255) DEFAULT NULL,
  `type` enum('image','video') NOT NULL,
  `id_contenu` bigint(20) UNSIGNED NOT NULL,
  `id_type_contenu` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `medias`
--

INSERT INTO `medias` (`id`, `chemin`, `description`, `prix`, `transaction_id`, `type`, `id_contenu`, `id_type_contenu`, `created_at`, `updated_at`) VALUES
(1, 'images/expo.jpg', 'Photo de fresque', 0, NULL, 'image', 1, 5, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(7, 'medias/ouidah.mp4', 'super', 0, NULL, 'video', 3, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_03_15_000000_create_auteurs_table', 1),
(5, '2025_11_21_143809_create_roles_table', 1),
(6, '2025_11_21_143933_create_type_media_table', 1),
(7, '2025_11_21_144041_create_type_contenu_table', 1),
(8, '2025_11_21_144139_create_langues_table', 1),
(9, '2025_11_21_144238_create_regions_table', 1),
(10, '2025_11_21_144300_create_parler_table', 1),
(11, '2025_11_22_160802_create_utilisateurs_table', 1),
(12, '2025_11_22_194832_create_contenus_table', 1),
(13, '2025_11_22_204828_create_commentaires_table', 1),
(14, '2025_11_22_205217_create_medias_table', 1),
(15, '2025_11_24_201332_add_role_to_users_table', 1),
(16, '2025_11_24_221905_add_two_factor_columns_to_users_table', 1),
(17, '2025_11_25_194611_create_login_histories_table', 1),
(18, '2025_11_26_092155_add_type_to_medias_table', 1),
(19, '2025_11_29_182713_add_note_table', 1),
(20, '2025_11_29_185947_create_commentaire_notes_table', 1),
(21, '2025_11_30_060200_update_utilisateurs_table', 1),
(22, '2025_11_30_070000_reset_utilisateurs_table', 1),
(23, '2025_11_30_074949_add_price_and_transaction_id_to_medias_table', 1),
(24, '2025_12_01_155313_remove_password_column_from_utilisateurs_table', 1),
(25, '2025_12_02_142718_update_login_histories_table', 1),
(26, '2025_12_02_151839_update_date_validation_in_contenus_table', 1),
(27, '2025_12_02_161200_update_id_moderateur_default_in_contenus_table', 2),
(28, '2025_12_02_201703_update_login_histories_for_polymorphic_relation', 3),
(29, '2025_12_03_204905_add_profile_photo_path_to_users_table', 4),
(30, '2025_12_03_221032_create_paiements_table', 5);

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

CREATE TABLE `paiements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `contenu_id` bigint(20) UNSIGNED NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `statut` varchar(255) NOT NULL,
  `donnees_transaction` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`donnees_transaction`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `parler`
--

CREATE TABLE `parler` (
  `id_region` bigint(20) UNSIGNED NOT NULL,
  `id_langue` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `parler`
--

INSERT INTO `parler` (`id_region`, `id_langue`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(1, 2, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(1, 3, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(1, 4, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(1, 5, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(1, 6, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(1, 7, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(1, 8, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(1, 9, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(1, 10, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(1, 11, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(1, 12, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(2, 1, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(2, 2, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(2, 3, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(2, 4, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(2, 5, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(2, 6, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(2, 7, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(2, 8, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(2, 9, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(2, 10, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(2, 11, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(2, 12, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(3, 1, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(3, 2, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(3, 3, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(3, 4, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(3, 5, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(3, 6, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(3, 7, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(3, 8, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(3, 9, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(3, 10, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(3, 11, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(3, 12, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(4, 1, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(4, 2, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(4, 3, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(4, 4, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(4, 5, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(4, 6, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(4, 7, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(4, 8, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(4, 9, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(4, 10, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(4, 11, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(4, 12, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(5, 1, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(5, 2, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(5, 3, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(5, 4, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(5, 5, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(5, 6, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(5, 7, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(5, 8, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(5, 9, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(5, 10, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(5, 11, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(5, 12, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(6, 1, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(6, 2, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(6, 3, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(6, 4, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(6, 5, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(6, 6, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(6, 7, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(6, 8, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(6, 9, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(6, 10, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(6, 11, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(6, 12, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(7, 1, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(7, 2, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(7, 3, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(7, 4, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(7, 5, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(7, 6, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(7, 7, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(7, 8, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(7, 9, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(7, 10, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(7, 11, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(7, 12, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(8, 1, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(8, 2, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(8, 3, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(8, 4, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(8, 5, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(8, 6, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(8, 7, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(8, 8, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(8, 9, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(8, 10, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(8, 11, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(8, 12, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(9, 1, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(9, 2, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(9, 3, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(9, 4, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(9, 5, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(9, 6, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(9, 7, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(9, 8, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(9, 9, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(9, 10, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(9, 11, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(9, 12, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(10, 1, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(10, 2, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(10, 3, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(10, 4, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(10, 5, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(10, 6, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(10, 7, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(10, 8, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(10, 9, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(10, 10, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(10, 11, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(10, 12, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(11, 1, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(11, 2, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(11, 3, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(11, 4, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(11, 5, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(11, 6, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(11, 7, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(11, 8, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(11, 9, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(11, 10, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(11, 11, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(11, 12, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(12, 1, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(12, 2, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(12, 3, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(12, 4, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(12, 5, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(12, 6, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(12, 7, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(12, 8, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(12, 9, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(12, 10, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(12, 11, '2025-12-02 14:56:58', '2025-12-02 14:56:58'),
(12, 12, '2025-12-02 14:56:58', '2025-12-02 14:56:58');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_region` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `population` int(11) NOT NULL,
  `superficie` int(11) NOT NULL,
  `localisation` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id`, `nom_region`, `description`, `population`, `superficie`, `localisation`, `created_at`, `updated_at`) VALUES
(1, 'Littoral', 'Région urbaine et économique abritant Cotonou, la plus grande ville du Bénin. Centre commercial majeur, port autonome et carrefour culturel moderne.', 2200000, 79, 'Sud du Bénin', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(2, 'Atlantique', 'Région côtière avec de belles plages, la ville historique d’Abomey-Calavi et des zones touristiques très développées.', 1250000, 3233, 'Sud du Bénin', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(3, 'Ouémé', 'Région traversée par le fleuve Ouémé, regroupant Porto-Novo et de riches traditions culturelles. Importante activité agricole.', 1150000, 1281, 'Sud-Est du Bénin', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(4, 'Plateau', 'Région vallonnée à forte activité agricole, connue pour ses cultures vivrières et ses marchés traditionnels animés.', 850000, 3264, 'Sud-Est du Bénin', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(5, 'Mono', 'Région frontalière du Togo, riche en plages, villages de pêcheurs et fêtes traditionnelles.', 500000, 1396, 'Sud-Ouest du Bénin', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(6, 'Couffo', 'Région rurale à fort patrimoine culturel adja. Climat propice à l’agriculture et aux cultures maraîchères.', 750000, 2404, 'Sud-Ouest du Bénin', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(7, 'Zou', 'Région historique abritant Abomey, ancienne capitale du royaume du Danhomè. Très riche en musées, traditions et monuments.', 1100000, 5263, 'Centre-Sud du Bénin', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(8, 'Collines', 'Région montagneuse et au centre du pays, connue pour ses collines, ses paysages naturels et ses chefferies traditionnelles.', 800000, 13631, 'Centre du Bénin', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(9, 'Borgou', 'Région vaste et stratégique abritant Parakou. Carrefour commercial du Centre-Nord, diverse en ethnies et traditions.', 1500000, 25956, 'Centre-Nord du Bénin', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(10, 'Alibori', 'Plus grande région du Bénin, abritant Kandi et Malanville. Riche en élevage, agriculture et culture dendi.', 90000, 26242, 'Nord-Est du Bénin', '2025-12-02 14:56:55', '2025-12-03 08:54:39'),
(11, 'Atacora', 'Région montagneuse et touristique avec Natitingou, les cascades, le parc de la Pendjari et les habitats tata somba.', 800000, 20199, 'Nord-Ouest du Bénin', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(12, 'Donga', 'Région montagneuse et agricole abritant Djougou. Mélange de cultures bariba, peulh et yom.', 700000, 11126, 'Nord-Ouest du Bénin', '2025-12-02 14:56:55', '2025-12-02 14:56:55');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_role` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `nom_role`, `created_at`, `updated_at`) VALUES
(1, 'Administrateur', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(2, 'Modérateur', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(3, 'Auteur', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(4, 'Lecteur', '2025-12-02 14:56:55', '2025-12-02 14:56:55');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('onjhCXAt9MyhzPSyCRLy67VYk5qSysi4I1kfp1o2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT0FvQ3QzcU5CUGxNc2ROQ0VmaFNEcTc4Um1vOUl2NlRJSEgwY3Y4YyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb250ZW51IjtzOjU6InJvdXRlIjtzOjc6ImNvbnRlbnUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1764798162),
('VYknBGd9EnTH3CkzWuFn1CUxNCDd2BlYSs2hOMCn', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOWZhQmtVVmJyclJacm5aQUo0S0luR2F0SnJSRFB0VFBUbEx5U3V2VSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYWllbWVudC9lcnJvciI7czo1OiJyb3V0ZSI7czoxNDoicGFpZW1lbnQuZXJyb3IiO319', 1764805201);

-- --------------------------------------------------------

--
-- Structure de la table `type_contenus`
--

CREATE TABLE `type_contenus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_type_contenu` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_contenus`
--

INSERT INTO `type_contenus` (`id`, `nom_type_contenu`, `created_at`, `updated_at`) VALUES
(1, 'Article', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(2, 'Histoire', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(3, 'Tradition', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(4, 'Recette', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(5, 'Musique', '2025-12-02 14:56:56', '2025-12-02 14:56:56'),
(6, 'Danse', '2025-12-02 14:56:56', '2025-12-02 14:56:56');

-- --------------------------------------------------------

--
-- Structure de la table `type_medias`
--

CREATE TABLE `type_medias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_type_media` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_medias`
--

INSERT INTO `type_medias` (`id`, `nom_type_media`, `created_at`, `updated_at`) VALUES
(1, 'Image', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(2, 'Vidéo', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(3, 'Audio', '2025-12-02 14:56:55', '2025-12-02 14:56:55'),
(4, 'Document', '2025-12-02 14:56:55', '2025-12-02 14:56:55');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('user','manager','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `profile_photo_path`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Test User', 'test@example.com', '2025-12-02 14:56:58', NULL, '$2y$12$uxHmEcLneuwDB8zLiax75uMFELTDPNABJ8Hdm4fWtT7Y3VWjojVpq', NULL, NULL, NULL, 'rYxi50lKPF', '2025-12-02 14:56:59', '2025-12-02 14:56:59', 'user'),
(2, 'Maurice Comlan', 'maurice.comlan@uac.bj', NULL, NULL, '$2y$12$H9BvZgxoGIRWh5kizNOYp.47Sm.SvMHwboouoGoYmskzw8fdETfa2', 'eyJpdiI6IlQ1OTRHRFNMQUJtbVZJRmZLL21ySlE9PSIsInZhbHVlIjoiK09wZEJ4RFVnN3VmcWZkY09lWE5nS0JSMk51U0djZ25rK0V3Tis1S3RPND0iLCJtYWMiOiIyYTg2Yzc0YjhlNmUyZmRmMjY5ZDFmODA2OWFmMjBmYjhlNmEwNzRmMTgwMDRjYWYyYWUzYjNlMmQzYzcyOTFhIiwidGFnIjoiIn0=', 'eyJpdiI6Ikt4SWZITC9IaGk2TGRoVTBsOWRmMnc9PSIsInZhbHVlIjoiRjVlTjhWNmxXb0VaL2N3QXh0L2pmcTN2c2NpSlhEbHBVby8xQ29kODdlMGVoSDJNcUpzUjBYNGdrSU82MDkzUnA2STFiVmlHL3JsNTRHNG5peVV0MVFaQkppWFhaNWxReDhUMDN6ajRURkpMNTU5ZThDbCsvcTFNZ3ZEVVJTbXpWNm9Ma3psdEtaMkhuaHNmOWhnbnVBTENlcUl2aUdUblRWK3lSMzVGZGcvSkdUVFUzZHl0VVhNYlRlbGZTVU15SjUyck1UbGhYZHd6enBNY3lrSzhtbi9XdHJKNUNPRnlKSm1tckY1SmVVQWdwampneDR2Nm1qa1U0Z3VXRnpKT0JkWExLTkQzSjMyNmd0NzZnMHp1UEE9PSIsIm1hYyI6IjZlNGFiYTczNTViZDJiZWJjMDk3NTFmNjIwZjRmMTUwMDIyNGJiN2NlNDg3MWVkNjUzY2Y4YzFkMmUzNDc0MTYiLCJ0YWciOiIifQ==', NULL, NULL, '2025-12-02 20:31:20', '2025-12-03 05:35:11', 'user'),
(3, 'GLELE Jefferson', 'micheeglele@gmail.com', NULL, NULL, '$2y$12$sYiCgRiUCi0i5nG8CzkTm.ozYYk4.KKIetQinwp/4ZpSc2xlgwIS.', 'eyJpdiI6ImpscjVMTFRadkU0dDlwY0dPdzJUZWc9PSIsInZhbHVlIjoiSlVtaUVtQnprRmxKdWNNQ0xGNjlvSGFxelY4aHloenIvaitxVHVNTHNLND0iLCJtYWMiOiI2MjlhYTUyMTZkNzc3YWEwYzk0YThkMTE5OGFlMzJkOGJhMGUxMzZhYmNkOGZhNjkyM2E3MmQ2Y2M2MzkyMWUyIiwidGFnIjoiIn0=', 'eyJpdiI6IkZDakdHYVFHTEdCOS9YUGt1TDYzTVE9PSIsInZhbHVlIjoicWFCYnRSeTlOQkorK095THN1amQwZ2xQSUdhRlhuRmlMM2lGS0NockZHdStZTzAreUNQQWNIMGpFOTJYZVRvM25KSGc4Zjg3Qys4TTVtaW5YNmFRbGUzYjRwUjZOVDdsYnBrcXgzZWVtM1FHUnN4ajZzbm1MUmJucFVBM0lsQlFwYTh6OXpWMGpHRDRMNlhlSGRpK0lTNFhWc1VBS3d0eDltNmQ2N3BobjFMSFVkQXpMQjRZRXdyUEdacXVMckxkalluTU5lWEpDdG5nWGc0aDRUWExxMzgwSW5UUllFSkZmaGd4cTZvTGw5OG9renczdVZxdDVYK3QwSlFPMmlwMnhlZXI5Vklud3Zob2I4ZmpTcElmdmc9PSIsIm1hYyI6IjVlNWI4NTEzZTQ1YmZlNWUxM2RiNGY1OWIyMzYzNjQ2NTVlMmM4YjQ0MGY5Y2VjNTc5OGZmNGQ5NDcwZWY0MmMiLCJ0YWciOiIifQ==', '2025-12-03 19:45:13', NULL, '2025-12-03 19:44:20', '2025-12-03 19:45:13', 'user');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `statut` varchar(50) NOT NULL DEFAULT 'en_attente',
  `date_naissance` date NOT NULL,
  `date_inscription` date NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `id_role` bigint(20) UNSIGNED NOT NULL,
  `id_langue` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`, `email_verified_at`, `statut`, `date_naissance`, `date_inscription`, `mot_de_passe`, `remember_token`, `photo`, `id_role`, `id_langue`, `created_at`, `updated_at`) VALUES
(2, 'ASSANI', 'Amadis', 'assani.amadis@example.com', NULL, 'actif', '1988-08-22', '2024-01-15', '$2y$12$Qo3uf23pwN006kjU3OMURuD.322/6lcJR6mDS36SrDIH8haHLVvyq', NULL, 'photos/assani.jpg', 1, 2, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(3, 'AYO', 'Ola', 'ola.ayo@example.com', NULL, 'actif', '1992-03-10', '2024-02-01', '$2y$12$Ytazb0zF92oA42/DY.WPKOJFCqMlDn94/WxX.KqUSSlwFyyVWV/S.', NULL, 'photos/ola.jpg', 1, 2, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(4, 'AYO', 'Mari', 'aissatou.ayo@example.com', NULL, 'actif', '1985-11-30', '2023-12-01', '$2y$12$wEzWaz4QhPA895qii0U8LOdF25pNBtU3y8LKBg8Q0MxM3XjWyQy0.', NULL, 'photos/aissatou.jpg', 2, 2, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(5, 'BEHANZIN', 'Jey', 'jey.behanzin@example.com', NULL, 'en_attente', '1995-07-18', '2024-03-05', '$2y$12$FzSggb6ATECN8QuX/DuKkODLI8sfX7kGwv1j65yAXKyNUso6E3GOK', NULL, 'photos/jey.jpg', 1, 2, '2025-12-02 14:56:57', '2025-12-02 14:56:57'),
(6, 'ATTOKO', 'Maurel', 'aatokomaurel@gmail.com', NULL, 'actif', '2013-01-02', '2025-12-02', '$2y$12$RNWwm9eD60Jz7wMQZ6bl0eq.vqZqvdTdHgaM.KTC0axfZMioZmSgq', NULL, 'default.jpg', 3, 1, '2025-12-02 15:07:05', '2025-12-02 15:07:05');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `auteurs`
--
ALTER TABLE `auteurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `auteurs_email_unique` (`email`);

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
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commentaires_id_utilisateur_foreign` (`id_utilisateur`),
  ADD KEY `commentaires_id_contenu_foreign` (`id_contenu`);

--
-- Index pour la table `commentaire_notes`
--
ALTER TABLE `commentaire_notes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `commentaire_notes_commentaire_id_user_id_unique` (`commentaire_id`,`user_id`),
  ADD KEY `commentaire_notes_user_id_foreign` (`user_id`);

--
-- Index pour la table `contenus`
--
ALTER TABLE `contenus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contenus_id_region_foreign` (`id_region`),
  ADD KEY `contenus_id_langue_foreign` (`id_langue`),
  ADD KEY `contenus_id_type_contenu_foreign` (`id_type_contenu`),
  ADD KEY `contenus_id_auteur_foreign` (`id_auteur`),
  ADD KEY `contenus_id_moderateur_foreign` (`id_moderateur`);

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
-- Index pour la table `langues`
--
ALTER TABLE `langues`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `langues_nom_langue_unique` (`nom_langue`),
  ADD UNIQUE KEY `langues_code_langue_unique` (`code_langue`);

--
-- Index pour la table `login_histories`
--
ALTER TABLE `login_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_histories_user_id_foreign` (`user_id_old`);

--
-- Index pour la table `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medias_id_contenu_foreign` (`id_contenu`),
  ADD KEY `medias_id_type_contenu_foreign` (`id_type_contenu`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paiements_user_id_foreign` (`user_id`),
  ADD KEY `paiements_contenu_id_foreign` (`contenu_id`);

--
-- Index pour la table `parler`
--
ALTER TABLE `parler`
  ADD PRIMARY KEY (`id_region`,`id_langue`),
  ADD KEY `parler_id_langue_foreign` (`id_langue`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regions_nom_region_unique` (`nom_region`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_nom_role_unique` (`nom_role`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `type_contenus`
--
ALTER TABLE `type_contenus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_contenus_nom_type_contenu_unique` (`nom_type_contenu`);

--
-- Index pour la table `type_medias`
--
ALTER TABLE `type_medias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_medias_nom_type_media_unique` (`nom_type_media`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `utilisateurs_email_unique` (`email`),
  ADD KEY `utilisateurs_id_role_foreign` (`id_role`),
  ADD KEY `utilisateurs_id_langue_foreign` (`id_langue`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `auteurs`
--
ALTER TABLE `auteurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `commentaire_notes`
--
ALTER TABLE `commentaire_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contenus`
--
ALTER TABLE `contenus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT pour la table `langues`
--
ALTER TABLE `langues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `login_histories`
--
ALTER TABLE `login_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `medias`
--
ALTER TABLE `medias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `paiements`
--
ALTER TABLE `paiements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `type_contenus`
--
ALTER TABLE `type_contenus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `type_medias`
--
ALTER TABLE `type_medias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_id_contenu_foreign` FOREIGN KEY (`id_contenu`) REFERENCES `contenus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentaires_id_utilisateur_foreign` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commentaire_notes`
--
ALTER TABLE `commentaire_notes`
  ADD CONSTRAINT `commentaire_notes_commentaire_id_foreign` FOREIGN KEY (`commentaire_id`) REFERENCES `commentaires` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentaire_notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `contenus`
--
ALTER TABLE `contenus`
  ADD CONSTRAINT `contenus_id_auteur_foreign` FOREIGN KEY (`id_auteur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contenus_id_langue_foreign` FOREIGN KEY (`id_langue`) REFERENCES `langues` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contenus_id_moderateur_foreign` FOREIGN KEY (`id_moderateur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contenus_id_region_foreign` FOREIGN KEY (`id_region`) REFERENCES `regions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contenus_id_type_contenu_foreign` FOREIGN KEY (`id_type_contenu`) REFERENCES `type_contenus` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `medias`
--
ALTER TABLE `medias`
  ADD CONSTRAINT `medias_id_contenu_foreign` FOREIGN KEY (`id_contenu`) REFERENCES `contenus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medias_id_type_contenu_foreign` FOREIGN KEY (`id_type_contenu`) REFERENCES `type_contenus` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD CONSTRAINT `paiements_contenu_id_foreign` FOREIGN KEY (`contenu_id`) REFERENCES `contenus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `paiements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `parler`
--
ALTER TABLE `parler`
  ADD CONSTRAINT `parler_id_langue_foreign` FOREIGN KEY (`id_langue`) REFERENCES `langues` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parler_id_region_foreign` FOREIGN KEY (`id_region`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_id_langue_foreign` FOREIGN KEY (`id_langue`) REFERENCES `langues` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `utilisateurs_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
