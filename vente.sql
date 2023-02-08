-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 24 déc. 2022 à 11:06
-- Version du serveur : 8.0.31-0ubuntu0.22.04.1
-- Version de PHP : 8.1.2-1ubuntu2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vente`
--

-- --------------------------------------------------------

--
-- Structure de la table `ts_images`
--

CREATE TABLE `ts_images` (
  `id` int NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_mini` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_produit` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ts_magasins`
--

CREATE TABLE `ts_magasins` (
  `id` int NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ts_manuels`
--

CREATE TABLE `ts_manuels` (
  `id` int NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sommaire` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ts_pays`
--

CREATE TABLE `ts_pays` (
  `id` int NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'iso 3166 alpha 2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ts_produits`
--

CREATE TABLE `ts_produits` (
  `id` int NOT NULL,
  `denomination` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'code barre',
  `date_creation` datetime NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '0',
  `descriptif` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_manuel` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ts_produits_magasins`
--

CREATE TABLE `ts_produits_magasins` (
  `id` int NOT NULL,
  `id_produit` int NOT NULL,
  `id_magasin` int NOT NULL,
  `quantite` int NOT NULL,
  `prix_unitaire` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ts_produits_pays`
--

CREATE TABLE `ts_produits_pays` (
  `id_produit` int NOT NULL,
  `id_pays` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ts_images`
--
ALTER TABLE `ts_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ts_images_ts_produits1_idx` (`id_produit`);

--
-- Index pour la table `ts_magasins`
--
ALTER TABLE `ts_magasins`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ts_manuels`
--
ALTER TABLE `ts_manuels`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ts_pays`
--
ALTER TABLE `ts_pays`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ts_produits`
--
ALTER TABLE `ts_produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ts_produits_ts_manuels_idx` (`id_manuel`);

--
-- Index pour la table `ts_produits_magasins`
--
ALTER TABLE `ts_produits_magasins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ts_produits_magasins_ts_produits1_idx` (`id_produit`),
  ADD KEY `fk_ts_produits_magasins_ts_magasins1_idx` (`id_magasin`);

--
-- Index pour la table `ts_produits_pays`
--
ALTER TABLE `ts_produits_pays`
  ADD PRIMARY KEY (`id_produit`,`id_pays`),
  ADD KEY `fk_ts_produits_ts_pays_ts_pays1_idx` (`id_pays`),
  ADD KEY `fk_ts_produits_ts_pays_ts_produits1_idx` (`id_produit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ts_images`
--
ALTER TABLE `ts_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ts_magasins`
--
ALTER TABLE `ts_magasins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ts_manuels`
--
ALTER TABLE `ts_manuels`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ts_pays`
--
ALTER TABLE `ts_pays`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ts_produits`
--
ALTER TABLE `ts_produits`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ts_produits_magasins`
--
ALTER TABLE `ts_produits_magasins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ts_images`
--
ALTER TABLE `ts_images`
  ADD CONSTRAINT `fk_ts_images_ts_produits1` FOREIGN KEY (`id_produit`) REFERENCES `ts_produits` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `ts_produits`
--
ALTER TABLE `ts_produits`
  ADD CONSTRAINT `fk_ts_produits_ts_manuels` FOREIGN KEY (`id_manuel`) REFERENCES `ts_manuels` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `ts_produits_magasins`
--
ALTER TABLE `ts_produits_magasins`
  ADD CONSTRAINT `fk_ts_produits_magasins_ts_magasins1` FOREIGN KEY (`id_magasin`) REFERENCES `ts_magasins` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ts_produits_magasins_ts_produits1` FOREIGN KEY (`id_produit`) REFERENCES `ts_produits` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `ts_produits_pays`
--
ALTER TABLE `ts_produits_pays`
  ADD CONSTRAINT `fk_ts_produits_ts_pays_ts_pays1` FOREIGN KEY (`id_pays`) REFERENCES `ts_pays` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ts_produits_ts_pays_ts_produits1` FOREIGN KEY (`id_produit`) REFERENCES `ts_produits` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
