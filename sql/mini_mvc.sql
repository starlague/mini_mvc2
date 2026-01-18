-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 18 jan. 2026 à 12:49
-- Version du serveur : 9.1.0
-- Version de PHP : 8.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mini_mvc`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `statut` varchar(50) NOT NULL,
  `date_commande` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adresse_livraison` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `user_id`, `total`, `statut`, `date_commande`, `adresse_livraison`) VALUES
(1, 1, 425.97, 'en_attente', '2026-01-18 09:31:43', 'rsiugsigsg'),
(2, 1, 111.74, 'en_attente', '2026-01-18 13:14:10', 'riughergieg'),
(3, 1, 115.65, 'en_attente', '2026-01-18 13:39:42', 'sfqrggzgq'),
(4, 1, 25.99, 'en_attente', '2026-01-18 13:48:00', 'fssrqzggrfvge');

-- --------------------------------------------------------

--
-- Structure de la table `commande_produit`
--

DROP TABLE IF EXISTS `commande_produit`;
CREATE TABLE IF NOT EXISTS `commande_produit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `commande_id` int NOT NULL,
  `produit_id` int NOT NULL,
  `quantite` int NOT NULL,
  `prix_unitaire` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `commande_id` (`commande_id`),
  KEY `produit_id` (`produit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commande_produit`
--

INSERT INTO `commande_produit` (`id`, `commande_id`, `produit_id`, `quantite`, `prix_unitaire`) VALUES
(1, 1, 1, 2, 199.99),
(2, 1, 2, 1, 25.99),
(3, 2, 4, 1, 35.75),
(4, 2, 3, 1, 75.99),
(5, 3, 6, 1, 115.65),
(6, 4, 2, 1, 25.99);

-- --------------------------------------------------------

--
-- Structure de la table `paniers`
--

DROP TABLE IF EXISTS `paniers`;
CREATE TABLE IF NOT EXISTS `paniers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL DEFAULT '0',
  `produit_id` int NOT NULL DEFAULT '0',
  `quantite` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_paniers_user` (`user_id`),
  KEY `FK_paniers_produits` (`produit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prix` float NOT NULL,
  `description` text NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `prix`, `description`, `image`) VALUES
(1, 'Canapé simple', 199.99, 'Canapé simple deux place avec deux coussins.', 'canape1.png'),
(2, 'Petite armoire', 25.99, 'Une petite armoire en bois, parfait pour ranger des chaussures.', 'armoire-chaussure.png'),
(3, 'Bureau', 75.99, 'Un bureau simple en bois de sapin avec des pieds et poignées en acier. Il dispose de 4 espaces de rangements. Parfait pour travailler.', 'bureau.png'),
(4, 'Chaise de bureau ', 35.75, 'Une chaise de bureau en similicuir avec différent mode d\'inclinaison et accoudoirs\r\n. ', 'chaise-bureau.png'),
(5, 'Armoire à vêtements', 152.89, 'Une armoire pour ranger vos vêtements dans un style moderne avec du bois de chêne.  ', 'armoire-vetements.png'),
(6, 'Bibliothèque', 115.65, 'J\'ai plus d\'inspiration pour les description. ', 'bibliotheque.png');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `prenom`, `nom`, `email`) VALUES
(1, 'test1', 'TEST1', 'test1@gmail.com'),
(2, 'test2', 'TEST2', 'test2@gmail.com'),
(3, 'Test3', 'TEST3', 'test3@gmail.com'),
(4, 'Test4', 'TEST4', 'test4@gmail.com'),
(5, 'Test5', 'TEST5', 'test5@gmail.com'),
(6, 'Test6', 'TEST6', 'test6@gmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
