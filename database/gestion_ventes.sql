-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 23 jan. 2022 à 20:13
-- Version du serveur :  10.1.30-MariaDB
-- Version de PHP :  7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestion_ventes`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `Code_Client` bigint(20) UNSIGNED NOT NULL,
  `Nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `Pseudo` varchar(50) COLLATE utf8_bin NOT NULL,
  `Password` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`Code_Client`, `Nom`, `Pseudo`, `Password`) VALUES
(1, 'Marechal', 'Client-001', 'Cli-001'),
(2, 'Harel', 'Client-002', 'Cli-002'),
(3, 'Guichar', 'Client-003', 'Cli-003'),
(4, 'Landecy', 'Client-004', 'Cli-004'),
(5, 'Lapeyer', 'Client-005', 'Cli-005'),
(6, 'Villain', 'Client-006', 'Cli-006'),
(7, 'Belorgey', 'Client-007', 'Cli-007'),
(8, 'Boufares', 'Client-008', 'Cli-008'),
(9, 'Grenier', 'Client-009', 'Cli-009'),
(10, 'Souque', 'Client-010', 'Cli-010'),
(11, 'Keromnes', 'Client-011', 'Cli-011'),
(12, 'Labrune', 'Client-012', 'Cli-012'),
(13, 'Masson', 'Client-013', 'Cli-013'),
(14, 'Cussy', 'Client-014', 'Cli-014'),
(15, 'Vandendriessche', 'Client-015', 'Cli-015');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `Numéro_Commande` bigint(20) UNSIGNED NOT NULL,
  `Code_Client` bigint(20) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`Numéro_Commande`, `Code_Client`, `Date`) VALUES
(1, 13, '1992-01-12'),
(2, 14, '1992-01-12'),
(3, 1, '1992-02-18'),
(4, 2, '1992-03-25'),
(5, 5, '1992-08-30'),
(6, 10, '1992-12-27'),
(7, 8, '1993-02-12'),
(8, 11, '1993-03-18'),
(9, 2, '1993-04-20'),
(10, 7, '1993-05-05'),
(11, 15, '1993-05-15'),
(12, 13, '1993-05-29'),
(13, 14, '1993-06-06'),
(14, 13, '1993-06-22'),
(15, 15, '1993-07-01'),
(16, 1, '1993-07-24'),
(17, 4, '1993-07-30'),
(18, 6, '1993-07-31'),
(19, 7, '1993-08-01'),
(44, 1, '2022-01-23'),
(45, 1, '2022-01-23'),
(46, 1, '2022-01-23'),
(47, 1, '2022-01-23'),
(48, 1, '2022-01-23'),
(49, 1, '2022-01-23'),
(50, 1, '2022-01-23'),
(51, 1, '2022-01-23'),
(52, 1, '2022-01-23'),
(53, 1, '2022-01-23'),
(54, 1, '2022-01-23'),
(55, 1, '2022-01-23'),
(56, 3, '2022-01-23');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `Code_F` bigint(20) UNSIGNED NOT NULL,
  `Nom_F` varchar(50) COLLATE utf8_bin NOT NULL,
  `Ville_F` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`Code_F`, `Nom_F`, `Ville_F`) VALUES
(1, 'Mohammedi', 'Vannes Cedex'),
(2, 'Hazouard', 'Troys Cedex'),
(3, 'Perrigault', 'Villeneuve d\'Asco'),
(4, 'Supriez', 'Cosnes Longwy'),
(5, 'Kern', 'SChiltigheim'),
(6, 'Cornette', 'Lieusaint'),
(7, 'Arabyan', 'Avon'),
(8, 'Baudru', 'Auch'),
(9, 'Lebreton', 'Octeville'),
(10, 'De Bry', 'Magnanville'),
(11, 'Vrevin', 'Every Cedex'),
(12, 'Helin', 'Vienne'),
(13, 'Perrault', 'Saint Malo'),
(14, 'Olivier', 'Bobigny'),
(15, 'Barbe', 'Nimes'),
(16, 'Prat', 'Niort'),
(17, 'Nakache', 'Gap Cedex'),
(18, 'Ordronneau', 'Meaux'),
(19, '', ''),
(20, '', ''),
(21, 'Bubler', 'Saint-Denis');

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

CREATE TABLE `ligne_commande` (
  `Numéro_Commande` bigint(20) NOT NULL,
  `Code_Produit` bigint(20) NOT NULL,
  `Qte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ligne_commande`
--

INSERT INTO `ligne_commande` (`Numéro_Commande`, `Code_Produit`, `Qte`) VALUES
(0, 2, 2),
(1, 13, 2),
(2, 5, 1),
(2, 7, 1),
(3, 7, 3),
(3, 8, 1),
(3, 10, 1),
(4, 12, 5),
(5, 2, 3),
(6, 6, 2),
(7, 7, 6),
(8, 13, 10),
(9, 12, 50),
(10, 2, 8),
(11, 7, 40),
(12, 1, 2),
(13, 11, 10),
(13, 12, 1),
(14, 2, 1),
(14, 10, 1),
(15, 7, 1),
(15, 8, 2),
(16, 3, 6),
(16, 4, 4),
(16, 8, 10),
(17, 5, 1),
(18, 9, 3),
(19, 2, 2),
(44, 3, 1),
(45, 3, 1),
(46, 2, 1),
(47, 3, 1),
(47, 4, 1),
(47, 6, 9),
(48, 7, 9),
(48, 12, 6),
(49, 1, 2),
(49, 8, 6),
(50, 12, 4),
(51, 2, 17),
(51, 7, 6),
(52, 4, 20),
(53, 3, 2),
(54, 2, 6),
(54, 4, 10),
(54, 6, 9),
(54, 11, 10),
(55, 13, 41),
(56, 3, 10),
(56, 7, 15);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `Code_panier` bigint(20) UNSIGNED NOT NULL,
  `Code_Produit` bigint(20) NOT NULL,
  `Code_Client` bigint(20) NOT NULL,
  `Qte` int(11) NOT NULL,
  `Total_produit` double(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `Code_Produit` bigint(20) UNSIGNED NOT NULL,
  `Désignation` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `Prix_Unitaire` double(10,2) DEFAULT NULL,
  `Famille` varchar(2) COLLATE utf8_bin DEFAULT NULL,
  `Code_F` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`Code_Produit`, `Désignation`, `Prix_Unitaire`, `Famille`, `Code_F`) VALUES
(1, 'Coins à lettres', 27.60, NULL, 1),
(2, 'Etiquettes', 54.50, NULL, 1),
(3, 'Imprimantes la Jolie', 3450.00, NULL, 3),
(4, 'Manuel Utile', 137.00, NULL, 16),
(5, 'Micro Super Plus', 8990.00, NULL, 15),
(6, 'Informatique Facile', 150.00, NULL, 15),
(7, 'Souris Optique', 235.00, NULL, 15),
(8, 'Agenda', 47.50, NULL, 4),
(9, 'Guide d\'achat des micros', 174.95, NULL, 5),
(10, 'Ecran Protection', 120.00, NULL, 6),
(11, 'Clé USB', 89.00, NULL, 6),
(12, 'Machine à écrire', 1700.00, NULL, 1),
(13, 'Trombones', 12.95, NULL, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`Code_Client`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`Numéro_Commande`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`Code_F`);

--
-- Index pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD PRIMARY KEY (`Numéro_Commande`,`Code_Produit`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`Code_panier`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`Code_Produit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `Code_Client` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `Numéro_Commande` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `Code_F` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `Code_panier` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `Code_Produit` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
