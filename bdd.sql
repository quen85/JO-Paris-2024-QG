-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Dim 15 Octobre 2017 à 16:26
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `jo`
--

-- --------------------------------------------------------

--
-- Structure de la table `athlete`
--

CREATE TABLE `athlete` (
  `id_athlete` int(11) NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idPays` int(11) DEFAULT NULL,
  `idDiscipline` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `athlete`
--

INSERT INTO `athlete` (`id_athlete`, `lastname`, `birthday`, `picture`, `firstname`, `idPays`, `idDiscipline`) VALUES
(4, 'Bolt', '1987-08-21', 'e61bbba54899961ea71d004b8021ff79.jpeg', 'Usain', 13, 2),
(5, 'Phelps', '1985-06-30', '66956bf07a37965e4a81ab79936893bf.jpeg', 'Michael', 11, 3),
(8, 'Manaudou', '1990-11-12', '00a8d074dbc7cf1665bf94fc716555e2.jpeg', 'Florent', 3, 3),
(10, 'Bosse', '1992-05-11', 'b6396e33014b449a70c9ada3754b1f8c.jpeg', 'Pierre-Ambroise', 3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `discipline`
--

CREATE TABLE `discipline` (
  `id_discipline` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `discipline`
--

INSERT INTO `discipline` (`id_discipline`, `name`) VALUES
(2, '400m'),
(3, '100m nage libre'),
(5, '800m');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `id_pays` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `flag` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `pays`
--

INSERT INTO `pays` (`id_pays`, `name`, `flag`) VALUES
(3, 'France', '62813621e08f8d4b0dec2bbe26d86723.png'),
(5, 'Espagne', 'a012b743a4f292a15a05218c1002f277.png'),
(6, 'Italie', '88929328e9ee3ab791d29d4cf33bb2fe.png'),
(7, 'Angleterre', '02676259aa04d4772421c9419a6e5d64.png'),
(8, 'Belgique', '2b267b5ab457e23a7fa424171ba87b87.png'),
(9, 'Luxembourg', 'da1a6a4c61be4607a3c5f3674efa9a82.png'),
(10, 'Pays-Bas', '2f1e0b219593f8707e6b69cf9d3a6003.png'),
(11, 'Etats-Unis', 'f9ebf8bb966886d76312c0f085d542c0.png'),
(12, 'Grèce', '879baba41f216d04cdcfd18ace616ba9.png'),
(13, 'Jamaïque', 'd4d18b1707f8f69416d1960b689aac4e.png'),
(15, 'Allemagne', 'a6102c878e0a2e4b645e348ecadfe504.png');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `athlete`
--
ALTER TABLE `athlete`
  ADD PRIMARY KEY (`id_athlete`),
  ADD KEY `IDX_C03B832147626230` (`idPays`),
  ADD KEY `IDX_C03B8321F74AF0D5` (`idDiscipline`);

--
-- Index pour la table `discipline`
--
ALTER TABLE `discipline`
  ADD PRIMARY KEY (`id_discipline`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`id_pays`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `athlete`
--
ALTER TABLE `athlete`
  MODIFY `id_athlete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `discipline`
--
ALTER TABLE `discipline`
  MODIFY `id_discipline` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `id_pays` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `athlete`
--
ALTER TABLE `athlete`
  ADD CONSTRAINT `FK_C03B832147626230` FOREIGN KEY (`idPays`) REFERENCES `pays` (`id_pays`),
  ADD CONSTRAINT `FK_C03B8321F74AF0D5` FOREIGN KEY (`idDiscipline`) REFERENCES `discipline` (`id_discipline`);