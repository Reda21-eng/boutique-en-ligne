-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 24 avr. 2025 à 11:04
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `manga-meow`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int DEFAULT NULL,
  `date_commande` datetime DEFAULT CURRENT_TIMESTAMP,
  `statut` enum('en attente','validée','annulée') DEFAULT 'en attente',
  `total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande_produits`
--

DROP TABLE IF EXISTS `commande_produits`;
CREATE TABLE IF NOT EXISTS `commande_produits` (
  `commande_id` int NOT NULL,
  `produit_id` int NOT NULL,
  `quantite` int DEFAULT NULL,
  `prix_unitaire` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`commande_id`,`produit_id`),
  KEY `produit_id` (`produit_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paniers`
--

DROP TABLE IF EXISTS `paniers`;
CREATE TABLE IF NOT EXISTS `paniers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier_produits`
--

DROP TABLE IF EXISTS `panier_produits`;
CREATE TABLE IF NOT EXISTS `panier_produits` (
  `panier_id` int NOT NULL,
  `produit_id` int NOT NULL,
  `quantite` int DEFAULT NULL,
  PRIMARY KEY (`panier_id`,`produit_id`),
  KEY `produit_id` (`produit_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) DEFAULT NULL,
  `description` text,
  `prix` decimal(10,2) DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `categorie_id` int DEFAULT NULL,
  `sous_categorie_id` int DEFAULT NULL,
  `date_ajout` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `categorie_id` (`categorie_id`),
  KEY `sous_categorie_id` (`sous_categorie_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sous_categories`
--

DROP TABLE IF EXISTS `sous_categories`;
CREATE TABLE IF NOT EXISTS `sous_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `categorie_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `role` enum('client','admin') DEFAULT 'client',
  `date_inscription` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
