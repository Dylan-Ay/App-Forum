-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 30 juin 2022 à 13:59
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
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id_category`, `title`, `creationdate`) VALUES
(1, 'Sport', '2022-06-27 11:58:18'),
(2, 'Informatique', '2022-06-27 11:58:28');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `content`, `creationdate`, `user_id`, `topic_id`) VALUES
(1, 'Premier message topic Football', '2022-06-27 14:29:06', 1, 1),
(2, 'Premier message catégorie athlétisme', '2022-06-27 14:31:42', 1, 2),
(3, 'Premier message catégorie Tennis', '2022-06-27 14:32:27', 1, 3),
(7, 'Deuxième message topic Football', '2022-06-27 14:45:29', 2, 1),
(14, 'Premier message du basket-ball', '2022-06-29 09:54:02', 1, 15);

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `topic`
--

INSERT INTO `topic` (`id_topic`, `title`, `user_id`, `category_id`, `creationdate`, `closed`) VALUES
(1, 'Le Football', 1, 1, '2022-06-27 11:42:39', 0),
(2, 'l\'Athlétisme', 1, 1, '2022-06-27 11:43:10', 0),
(3, 'Le Tennis', 1, 1, '2022-06-27 11:43:52', 0),
(15, 'Le Basket-Ball', 1, 1, '2022-06-29 09:54:02', 0),
(16, 'Test', 1, 1, '2022-06-29 09:57:02', 0),
(17, 'Test', 1, 1, '2022-06-29 09:58:37', 0),
(18, 'Je test', 1, 1, '2022-06-29 09:59:01', 0);

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
  `role` varchar(128) DEFAULT 'Membre',
  `registerdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `state` tinyint(1) DEFAULT '1',
  `picture` varchar(80) NOT NULL DEFAULT 'public/images/default.webp',
  `birthdate` date DEFAULT NULL,
  `gender` varchar(64) DEFAULT NULL,
  `country` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nickname`, `email`, `password`, `role`, `registerdate`, `state`, `picture`, `birthdate`, `gender`, `country`) VALUES
(1, 'Pseudo-1', 'pseudo-1@mail.com', 'password', 'Membre', '2022-06-17 09:37:25', 1, 'public/images/default.webp', '1990-04-03', 'Homme', 'France'),
(2, 'Pseudo-2', 'pseudo-2@mail.com', 'password', 'Membre', '2022-06-27 14:29:28', 1, 'public/images/default.webp', '2000-06-01', 'Femme', 'France'),
(3, 'test', 'test@test.fr', '$2y$10$3tqLWmr4ERgG8aIbC9SVeeWZUWZitP0wjkbE18kfYsNTxrC4hNFzK', 'Membre', '2022-06-30 15:31:09', 1, 'public/images/default.webp', '2022-06-16', 'Homme', 'France');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `topic_id` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  ADD CONSTRAINT `user_message_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
