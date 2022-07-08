-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 08 juil. 2022 à 14:04
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `creationdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `img` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id_category`, `title`, `creationdate`, `img`) VALUES
(1, 'Sport', '2022-06-27 11:58:18', 'public/images/categories/sport.jpg'),
(2, 'Informatique', '2022-06-27 11:58:28', 'public/images/categories/informatique.jpg'),
(3, 'Cuisine', '2022-07-07 16:45:08', 'public/images/categories/cuisine.jpg'),
(4, 'Jardinage', '2022-07-08 09:40:29', 'public/images/categories/jardinage.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `content` text,
  `creationdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  PRIMARY KEY (`id_message`),
  KEY `topic_id` (`topic_id`),
  KEY `message_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `content`, `creationdate`, `user_id`, `topic_id`) VALUES
(1, 'Premier message topic Football', '2022-06-27 14:29:06', 1, 1),
(2, 'Premier message catégorie athlétisme', '2022-06-27 14:31:42', 1, 2),
(3, 'Premier message catégorie Tennis', '2022-06-27 14:32:27', 1, 3),
(7, 'Deuxième message topic Football', '2022-06-27 14:45:29', 2, 1),
(26, 'Test du PHP orienté objet', '2022-07-06 12:31:35', 4, 33),
(27, 'Test du Javascript', '2022-07-06 12:40:35', 4, 34),
(30, 'Deuxi&egrave;me message cat&eacute;gorie Tennis', '2022-07-06 16:18:25', 4, 3),
(35, 'Test du HTML', '2022-07-06 16:28:49', 4, 38),
(36, 'Test du CSS', '2022-07-06 16:29:24', 4, 39),
(38, 'Deuxi&egrave;me message CSS', '2022-07-06 16:38:03', 4, 39),
(39, 'Premier message sujet Basket-Ball', '2022-07-07 15:31:59', 4, 41);

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

DROP TABLE IF EXISTS `topic`;
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `creationdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `closed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_topic`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `topic`
--

INSERT INTO `topic` (`id_topic`, `title`, `user_id`, `category_id`, `creationdate`, `closed`) VALUES
(1, 'Le Football', 1, 1, '2022-06-27 11:42:39', 0),
(2, 'l\'Athlétisme', 1, 1, '2022-06-27 11:43:10', 0),
(3, 'Le Tennis', 1, 1, '2022-06-27 11:43:52', 0),
(33, 'Le PHP', 4, 2, '2022-07-06 12:31:35', 0),
(34, 'Le JavaScript', 4, 2, '2022-07-06 12:40:35', 0),
(38, 'L&#39;HTML', 4, 2, '2022-07-06 16:28:49', 0),
(39, 'Le CSS', 4, 2, '2022-07-06 16:29:24', 0),
(41, 'Le Basket-Ball', 4, 1, '2022-07-07 15:31:59', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `roles` json DEFAULT NULL,
  `registerdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `state` tinyint(1) DEFAULT '1',
  `picture` varchar(80) NOT NULL DEFAULT 'public/images/default.webp',
  `birthdate` date DEFAULT NULL,
  `gender` varchar(64) DEFAULT NULL,
  `country` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nickname`, `email`, `password`, `roles`, `registerdate`, `state`, `picture`, `birthdate`, `gender`, `country`) VALUES
(1, 'Pseudo-1', 'pseudo-1@mail.com', 'test1', '[\"ROLE_USER\"]', '2022-06-17 09:37:25', 1, 'public/images/default.webp', '1990-04-03', 'Homme', 'France'),
(2, 'Pseudo-2', 'pseudo-2@mail.com', 'password', '[\"ROLE_USER\"]', '2022-06-27 14:29:28', 1, 'public/images/default.webp', '2000-06-01', 'Femme', 'France'),
(4, 'Dylan68', 'test@test.fr', '$2y$10$whfYUpWc/2T3T29gZizQ9e00OH4VJ7PkKMxIr8iZI1wUa2Uei9owO', '[\"ROLE_ADMIN\"]', '2022-07-01 19:37:54', 1, 'public/images/default.webp', '1995-03-31', 'Homme', 'France'),
(6, 'NouveauProfil', 'nouveauprofil@gmail.com', '$2y$10$WMlbboKRGXome1t4vIEF5u.PiD3w5HZV0/E9o8uONM2FjKzBRwaFS', '[\"ROLE_USER\"]', '2022-07-08 14:37:10', 1, 'public/images/default.webp', '2022-07-05', 'Homme', 'France'),
(10, 'azerty', 'azerty@azerty.fr', '$2y$10$.P1IAUf/1kqEiXSNBMajIu2vxBZmoMew1FoB3lixCucpatcRWvmBW', '[\"ROLE_USER\"]', '2022-07-08 15:20:54', 1, 'public/images/default.webp', '2022-07-08', 'Homme', 'France'),
(12, 'NouveauProfillll', 'nouveauprofil@gmail.fr', '$2y$10$7W38ePl04Ait8L5svgXecOeZeMzMprzGE3Kh7p3s6qH2g.HQqGxYy', '[\"ROLE_USER\"]', '2022-07-08 15:48:31', 1, 'public/images/default.webp', '2022-07-08', 'Homme', 'France');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `topic_id` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_message_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
