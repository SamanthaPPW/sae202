-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 23 juin 2025 à 12:54
-- Version du serveur : 10.11.6-MariaDB-0+deb12u1
-- Version de PHP : 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae202`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `comment_text` text NOT NULL,
  `date_posted` datetime DEFAULT current_timestamp(),
  `is_approved` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `creneaux`
--

CREATE TABLE `creneaux` (
  `id` int(11) NOT NULL,
  `date_creneau` datetime NOT NULL,
  `est_reserve` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `creneaux`
--

INSERT INTO `creneaux` (`id`, `date_creneau`, `est_reserve`) VALUES
(1, '2025-07-03 19:00:00', 1),
(2, '2025-07-03 20:30:00', 0),
(3, '2025-07-04 19:00:00', 0),
(4, '2025-07-04 20:30:00', 0),
(5, '2025-07-05 19:00:00', 0),
(6, '2025-07-05 20:30:00', 0),
(7, '2025-07-10 19:00:00', 0),
(8, '2025-07-10 20:30:00', 0),
(9, '2025-07-11 19:00:00', 0),
(10, '2025-07-11 20:30:00', 0),
(11, '2025-07-12 19:00:00', 0),
(12, '2025-07-12 20:30:00', 0),
(13, '2025-07-17 19:00:00', 0),
(14, '2025-07-17 20:30:00', 0),
(15, '2025-07-18 19:00:00', 0),
(16, '2025-07-18 20:30:00', 0),
(17, '2025-07-19 19:00:00', 0),
(18, '2025-07-19 20:30:00', 0),
(19, '2025-07-24 19:00:00', 0),
(20, '2025-07-24 20:30:00', 0),
(21, '2025-07-25 19:00:00', 0),
(22, '2025-07-25 20:30:00', 0),
(23, '2025-07-26 19:00:00', 0),
(24, '2025-07-26 20:30:00', 0),
(25, '2025-07-31 19:00:00', 0),
(26, '2025-07-31 20:30:00', 0),
(27, '2025-08-01 19:00:00', 0),
(28, '2025-08-01 20:30:00', 0),
(29, '2025-08-02 19:00:00', 0),
(30, '2025-08-02 20:30:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `message_expediteur_id` int(11) NOT NULL,
  `message_destinataire_id` int(11) NOT NULL,
  `message_sujet` varchar(100) NOT NULL,
  `message_text` text NOT NULL,
  `message_date_envoi` date NOT NULL,
  `statut` varchar(10) NOT NULL DEFAULT 'non_lu',
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`message_id`, `message_expediteur_id`, `message_destinataire_id`, `message_sujet`, `message_text`, `message_date_envoi`, `statut`, `user_id`) VALUES
(1, 2, 2, 'sujis', 'dhjigerjih', '2025-06-18', 'non_lu', NULL),
(2, 2, 3, 'j\'en ai marre fejieffzekji', 'j\'en ai marre ejzfkhrglrelkghehilhvhvdfjhujgrfiqhufhuffdvjfdvjhfvhudfvhujdfvfvhdfvhudvhgdfhfdvgdsnjvdzgjndhndfvjhsbdvdhjfbvdfjvb', '2025-06-18', 'non_lu', NULL),
(3, 5, 2, 'cdv', 'dgdf', '2025-06-18', 'non_lu', NULL),
(4, 2, 1, 'Salut', 'Saluuuuuuuut', '2025-06-18', 'non_lu', NULL),
(5, 3, 1, 'efbjihkgfbjim', 'jkfkeedk', '2025-06-19', 'non_lu', NULL),
(6, 3, 1, 'xc', 'vcc', '2025-06-23', 'non_lu', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `creneau_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_reservation` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `creneau_id`, `user_id`, `date_reservation`) VALUES
(1, 1, 3, '2025-06-23 08:31:58'),
(2, 4, 3, '2025-06-23 12:34:08'),
(3, 5, 3, '2025-06-23 12:38:56');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `date_inscription` timestamp NULL DEFAULT current_timestamp(),
  `role` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `telephone`, `date_inscription`, `role`) VALUES
(1, 'Bertone', 'Nambinintsoa Joshua', 'nambinintsoa.bertone@etudiant.univ-reims.fr', '$2y$10$dz/IyRqtD73gAeusFudNx.Q5cfLb.CeCrEkET3uzQhZjtv0..KYqm', NULL, '2025-06-17 07:57:03', 'admin'),
(2, 'test', 'test', 'test.test@example.com', '$2y$10$2K76kCUlOW2jFbMhAvWgYuRDT75n9HzFKjSW.pa/eNNLQ/wnh9PoC', '', '2025-06-18 08:00:20', 'user'),
(3, 'Pacheco-Pires Wiss', 'Samantha', 'samanthappw@gmail.com', '$2y$10$2vint..31fKeCEjvSCBM6.mj0o5V1zIHTDSt.BMRFli1AJsAJ5ab.', '', '2025-06-18 09:46:12', 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `creneaux`
--
ALTER TABLE `creneaux`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_reservation` (`creneau_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `creneaux`
--
ALTER TABLE `creneaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`creneau_id`) REFERENCES `creneaux` (`id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `utilisateurs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
