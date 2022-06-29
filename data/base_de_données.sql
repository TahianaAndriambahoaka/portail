drop database portail;
create database portail;
use portail

CREATE TABLE ministere (
  id int PRIMARY KEY AUTO_INCREMENT,
  nom varchar(255)
);

CREATE TABLE `fonction` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(10)
);

CREATE TABLE `admin` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(20),
  `prenom` varchar(50),
  `login` varchar(50),
  `mot_de_passe` varchar(255)
);

CREATE TABLE `region` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(20)
);

CREATE TABLE `district` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(50),
  `id_region` int
);

CREATE TABLE `utilisateur` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(20),
  `prenom` varchar(50),
  `email` varchar(50),
  `telephone1` varchar(20),
  `telephone2` varchar(20),
  `telephone3` varchar(20),
  `id_district` int,
  `id_region` int,
  `ministere` varchar(255),
  `direction` varchar(255),
  `lieu_de_travail` varchar(255),
  `photo_de_profil` text,
  `id_admin` int,
  `date` date
);

CREATE TABLE `demande_inscription` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(20),
  `prenom` varchar(50),
  `email` varchar(50),
  `telephone1` varchar(20),
  `telephone2` varchar(20),
  `telephone3` varchar(20),
  `id_district` int,
  `id_region` int,
  `ministere` varchar(255),
  `direction` varchar(50),
  `lieu_de_travail` varchar(50),
  `photo_de_profil` varchar(255),
  `id_fonction` int,
  `date` date
);

CREATE TABLE `login` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `id_utilisateur` int,
  `login` varchar(50),
  `mot_de_passe` text,
  `id_fonction` int,
  `date_debut_de_carriere` date,
  `id_admin` int REFERENCES admin(id)
);

CREATE TABLE `utilisateur_supprime` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `id_login` int,
  `motif` text,
  `date` date,
  `id_admin` int REFERENCES admin(id)
);

CREATE TABLE `rapport_mensuel` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `id_utilisateur` int,
  `contenu` text,
  `timesheet` varchar(255),
  `rapport` varchar(255),
  `date` date,
  `commentaire` text
);

CREATE TABLE `mission` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `date_debut` date,
  `date_fin` date,
  `localisation` varchar(255),
  `objectif` text,
  `status` boolean
);

CREATE TABLE `utilisateur_mission` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `id_mission` int,
  `id_utilisateur` int,
  `date_debut` date,
  `date_fin` date
);

CREATE TABLE `rapport_de_mission` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `id_mission` int,
  `contenu` text,
  `date_de_rapport` date,
  `commentaire` text
);

CREATE TABLE `photo_rapport_de_mission` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `id_rapport_de_mission` int,
  `photo` varchar(255)
);

CREATE TABLE `type_produit` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(20)
);

CREATE TABLE `produit` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(20),
  `id_type_produit` int,
  `code` text
);

CREATE TABLE `photo_produit` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `id_produit` int,
  `photo` varchar(255)
);

CREATE TABLE `envoie_produit` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `id_produit` int,
  `quantite` int,
  `date` datetime
);

CREATE TABLE `reception_produit` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `id_produit` int,
  `quantite` int,
  `date` datetime,
  `id_envoie_produit` int,
  `fichier_bon_de_reception` varchar(255),
  `commentaire` text
);

CREATE TABLE `theme` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `theme` text
);

CREATE TABLE `sujet` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `id_theme` int,
  `sujet` text,
  `id_utilisateur` int,
  `date` datetime
);

CREATE TABLE `commentaire` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `id_sujet` int,
  `id_utilisateur` int,
  `commentaire` text,
  `date` datetime
);

ALTER TABLE `district` ADD FOREIGN KEY (`id_region`) REFERENCES `region` (`id`);

ALTER TABLE `utilisateur` ADD FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`);

ALTER TABLE `utilisateur` ADD FOREIGN KEY (`id_region`) REFERENCES `region` (`id`);

ALTER TABLE `utilisateur` ADD FOREIGN KEY (`id_district`) REFERENCES `district` (`id`);

ALTER TABLE `demande_inscription` ADD FOREIGN KEY (`id_fonction`) REFERENCES `fonction` (`id`);

ALTER TABLE `demande_inscription` ADD FOREIGN KEY (`id_region`) REFERENCES `region` (`id`);

ALTER TABLE `demande_inscription` ADD FOREIGN KEY (`id_district`) REFERENCES `district` (`id`);

ALTER TABLE `login` ADD FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

ALTER TABLE `login` ADD FOREIGN KEY (`id_fonction`) REFERENCES `fonction` (`id`);

ALTER TABLE `utilisateur_supprime` ADD FOREIGN KEY (`id_login`) REFERENCES `login` (`id`);

ALTER TABLE `rapport_mensuel` ADD FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

ALTER TABLE `utilisateur_mission` ADD FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

ALTER TABLE `utilisateur_mission` ADD FOREIGN KEY (`id_mission`) REFERENCES `mission` (`id`);

ALTER TABLE `rapport_de_mission` ADD FOREIGN KEY (`id_mission`) REFERENCES `mission` (`id`);

ALTER TABLE `photo_rapport_de_mission` ADD FOREIGN KEY (`id_rapport_de_mission`) REFERENCES `rapport_de_mission` (`id`);

ALTER TABLE `produit` ADD FOREIGN KEY (`id_type_produit`) REFERENCES `type_produit` (`id`);

ALTER TABLE `photo_produit` ADD FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`);

ALTER TABLE `envoie_produit` ADD FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`);

ALTER TABLE `reception_produit` ADD FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`);

ALTER TABLE `reception_produit` ADD FOREIGN KEY (`id_envoie_produit`) REFERENCES `envoie_produit` (`id`);

ALTER TABLE `sujet` ADD FOREIGN KEY (`id_theme`) REFERENCES `theme` (`id`);

ALTER TABLE `sujet` ADD FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

ALTER TABLE `commentaire` ADD FOREIGN KEY (`id_sujet`) REFERENCES `sujet` (`id`);

ALTER TABLE `commentaire` ADD FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

INSERT INTO ministere VALUES
(default, 'Ministère de la santé publique'),
(default, 'Ministère de la sécurité publique'),
(default, 'Ministère de la Population, de la Protection Sociale et de la Promotion de la Femme'),
(default, 'Ministère du Développement Numérique, Transformation Digitale, des Postes et des Télécommunications'),
(default, 'Ministère des Mines et des Ressources Stratégiques'),
(default, 'Ministère de la Justice'),
(default, 'Ministère de l\'enseignement supérieur et de la recherche scientifique'),
(default, 'Ministère de l\'Environnement et du Développement Durable'),
(default, 'Ministère de la Défense Nationale'),
(default, 'Ministère des Affaires Etrangères');

INSERT INTO fonction VALUES
(default, 'GCR'),
(default, 'ATR'),
(default, 'RLS');


INSERT INTO region VALUES
(default, 'Alaotra mangoro'),
(default, 'Amoron\'i Mania'),
(default, 'Analamanga'),
(default, 'Analanjirofo'),
(default, 'Androy'),
(default, 'Anosy'),
(default, 'Atsimo Andrefana'),
(default, 'Atsimo Atsinanana'),
(default, 'Atsinanana'),
(default, 'Betsiboka'),
(default, 'Boeny'),
(default, 'Bongolava'),
(default, 'Diana'),
(default, 'Fitovinany'),
(default, 'Haute Matsiatra'),
(default, 'Ihorombe'),
(default, 'Itasy'),
(default, 'Melaky'),
(default, 'Menabe'),
(default, 'Sava'),
(default, 'Sofia'),
(default, 'Vakinankaratra'),
(default, 'Vatovavy');

-- mysql --local-infile=1 -u root -p

SET GLOBAL local_infile=1;

-- LOAD DATA LOCAL INFILE "./regions.csv" INTO TABLE region
-- FIELDS TERMINATED BY ','
-- LINES TERMINATED BY '\n'
-- IGNORE 1 ROWS
-- (id, nom);

LOAD DATA LOCAL INFILE "./districts.csv" INTO TABLE district
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(id, nom, id_region);

INSERT INTO admin VALUES
(default, 'nom_administrateur', 'prénom_administrateur', 'administrateur@admin.mg', sha2('administrateur', 256));
