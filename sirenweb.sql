-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 12 juil. 2022 à 19:24
-- Version du serveur :  8.0.29-0ubuntu0.20.04.3
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sirenweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `app_cart`
--

CREATE TABLE `app_cart` (
  `id` int NOT NULL,
  `customer_id` int DEFAULT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `app_cart`
--

INSERT INTO `app_cart` (`id`, `customer_id`, `date_time`) VALUES
(2, 5, '2022-07-19 23:27:48');

-- --------------------------------------------------------

--
-- Structure de la table `app_customer`
--

CREATE TABLE `app_customer` (
  `id` int NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `app_customer`
--

INSERT INTO `app_customer` (`id`, `email`, `phoneNumber`) VALUES
(3, 'lionelle@gmail.com', '691324578'),
(4, 'dada modifié', 'hello'),
(5, 'dede', 'hello'),
(6, 'dada', 'hello');

-- --------------------------------------------------------

--
-- Structure de la table `app_product`
--

CREATE TABLE `app_product` (
  `id` int NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `app_product`
--

INSERT INTO `app_product` (`id`, `code`, `title`, `price`) VALUES
(1, 'a1', 'Souris', 5000),
(2, 'a2', 'Clavier', 8000);

-- --------------------------------------------------------

--
-- Structure de la table `cart_customer`
--

CREATE TABLE `cart_customer` (
  `cart_id` int NOT NULL,
  `customer_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220708075439', '2022-07-11 10:17:17', 474);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `app_cart`
--
ALTER TABLE `app_cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E8DAD179395C3F3` (`customer_id`);

--
-- Index pour la table `app_customer`
--
ALTER TABLE `app_customer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `app_product`
--
ALTER TABLE `app_product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cart_customer`
--
ALTER TABLE `cart_customer`
  ADD PRIMARY KEY (`cart_id`,`customer_id`),
  ADD KEY `IDX_1FA6C1621AD5CDBF` (`cart_id`),
  ADD KEY `IDX_1FA6C1629395C3F3` (`customer_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `app_cart`
--
ALTER TABLE `app_cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `app_customer`
--
ALTER TABLE `app_customer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `app_product`
--
ALTER TABLE `app_product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `app_cart`
--
ALTER TABLE `app_cart`
  ADD CONSTRAINT `FK_E8DAD179395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `app_customer` (`id`);

--
-- Contraintes pour la table `cart_customer`
--
ALTER TABLE `cart_customer`
  ADD CONSTRAINT `FK_1FA6C1621AD5CDBF` FOREIGN KEY (`cart_id`) REFERENCES `app_cart` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1FA6C1629395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `app_customer` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
