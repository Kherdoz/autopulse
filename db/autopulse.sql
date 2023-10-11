-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 11 oct. 2023 à 18:55
-- Version du serveur : 8.0.30
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `autopulse`
--

-- --------------------------------------------------------

--
-- Structure de la table `cars`
--

CREATE TABLE `cars` (
  `id` int NOT NULL,
  `make` varchar(255) NOT NULL,
  `accounte` varchar(255) NOT NULL,
  `fuel` varchar(255) NOT NULL,
  `mileage` int NOT NULL,
  `years` int NOT NULL,
  `price` int NOT NULL,
  `originalFileName` varchar(255) NOT NULL,
  `usercars_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `cars`
--

INSERT INTO `cars` (`id`, `make`, `accounte`, `fuel`, `mileage`, `years`, `price`, `originalFileName`, `usercars_id`) VALUES
(18, 'rf', 'rrrrrr', 'hybride', 2, 1992, 3, 'Capture d\'écran 2023-09-12 162705.png', 2),
(19, 'aa', 'aa', 'electrique', 1, 1990, 1, 'Capture d\'écran 2023-09-11 104433.png', 1),
(20, 'ee', 'eeeeeeeeeee', 'diesel', 1, 1990, 1, '1.jpg', 1),
(21, 'vl', 'zzzzz', 'electrique', 1, 1990, 1, '1.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `createdAt`) VALUES
(1, 'rrrrrrrrr', 'rrrrrrrrrrrrrr', 'gilles@gmail.com', '$2y$10$WFRmwbp6j4ugDTgAriixf.aBzazjXhwlMiYNXzUlEd1NLaSrjwuHy', '2023-09-17 09:20:53'),
(2, 'lub', 'gilles', 'gilou@gmail.com', '$2y$10$EnHNZGnXVti912oH2IHP8eL1CkqotSijsIsTlZ45F0gUDSnTJozfq', '2023-10-08 21:52:41');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`usercars_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`usercars_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
