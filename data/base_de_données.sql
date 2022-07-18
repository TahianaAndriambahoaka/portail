drop database portail;
create database portail;
use portail

CREATE TABLE ministere (
  id int PRIMARY KEY AUTO_INCREMENT,
  nom varchar(255)
);

CREATE TABLE fonction (
  id int PRIMARY KEY AUTO_INCREMENT,
  nom varchar(10)
);

CREATE TABLE personne (
  id int PRIMARY KEY AUTO_INCREMENT,
  nom varchar(20),
  prenom varchar(50),
  est_admin boolean
);

CREATE TABLE admin (
  id int PRIMARY KEY AUTO_INCREMENT,
  id_personne int REFERENCES personne(id),
  login varchar(50),
  mot_de_passe varchar(255)
);

CREATE TABLE region (
  id int PRIMARY KEY AUTO_INCREMENT,
  nom varchar(20)
);

CREATE TABLE district (
  id int PRIMARY KEY AUTO_INCREMENT,
  nom varchar(50),
  id_region int REFERENCES region(id)
);

CREATE TABLE utilisateur (
  id int PRIMARY KEY AUTO_INCREMENT,
  id_personne int REFERENCES personne(id),
  email varchar(50),
  telephone1 varchar(20),
  telephone2 varchar(20),
  telephone3 varchar(20),
  id_district int REFERENCES district(id),
  id_region int REFERENCES region(id),
  ministere varchar(255),
  direction varchar(255),
  lieu_de_travail varchar(255),
  photo_de_profil text,
  id_admin int REFERENCES admin(id),
  date date
);

CREATE TABLE demande_inscription (
  id int PRIMARY KEY AUTO_INCREMENT,
  nom varchar(20),
  prenom varchar(50),
  email varchar(50),
  telephone1 varchar(20),
  telephone2 varchar(20),
  telephone3 varchar(20),
  id_district int REFERENCES district(id),
  id_region int REFERENCES region(id),
  ministere varchar(255),
  direction varchar(50),
  lieu_de_travail varchar(50),
  photo_de_profil varchar(255),
  id_fonction int REFERENCES fonction(id),
  date date
);

CREATE TABLE login (
  id int PRIMARY KEY AUTO_INCREMENT,
  id_utilisateur int REFERENCES utilisateur(id),
  login varchar(50),
  mot_de_passe text,
  id_fonction int REFERENCES fonction(id),
  date_debut_de_carriere date,
  id_admin int REFERENCES admin(id)
);

CREATE TABLE utilisateur_supprime (
  id int PRIMARY KEY AUTO_INCREMENT,
  id_login int REFERENCES login(id),
  motif text,
  date date,
  id_admin int REFERENCES admin(id)
);

CREATE TABLE rapport_mensuel (
  id int PRIMARY KEY AUTO_INCREMENT,
  id_utilisateur int REFERENCES utilisateur(id),
  contenu text,
  timesheet varchar(255),
  rapport varchar(255),
  date date,
  commentaire text
);

CREATE TABLE mission (
  id int PRIMARY KEY AUTO_INCREMENT,
  date_debut date,
  date_fin date,
  localisation varchar(255),
  objectif text,
  statut boolean
);

CREATE TABLE utilisateur_mission (
  id int PRIMARY KEY AUTO_INCREMENT,
  id_mission int REFERENCES mission(id),
  id_utilisateur int REFERENCES utilisateur(id),
  date_debut date,
  date_fin date
);

CREATE TABLE rapport_de_mission (
  id int PRIMARY KEY AUTO_INCREMENT,
  id_mission int REFERENCES mission(id),
  contenu text,
  date_de_rapport date,
  commentaire text
);

CREATE TABLE photo_rapport_de_mission (
  id int PRIMARY KEY AUTO_INCREMENT,
  id_rapport_de_mission int REFERENCES rapport_de_mission(id),
  photo varchar(255)
);

CREATE TABLE type_produit (
  id int PRIMARY KEY AUTO_INCREMENT,
  nom varchar(20)
);

CREATE TABLE produit (
  id int PRIMARY KEY AUTO_INCREMENT,
  nom varchar(20),
  id_type_produit int REFERENCES type_produit(id),
  code text
);

CREATE TABLE photo_produit (
  id int PRIMARY KEY AUTO_INCREMENT,
  id_produit int REFERENCES produit(id),
  photo varchar(255)
);

CREATE TABLE envoie_produit (
  id int PRIMARY KEY AUTO_INCREMENT,
  id_produit int REFERENCES produit(id),
  quantite int,
  date datetime
);

CREATE TABLE reception_produit (
  id int PRIMARY KEY AUTO_INCREMENT,
  id_produit int REFERENCES produit(id),
  quantite int,
  date datetime,
  id_envoie_produit int REFERENCES envoie_produit(id),
  fichier_bon_de_reception varchar(255),
  commentaire text
);

CREATE TABLE theme (
  id int PRIMARY KEY AUTO_INCREMENT,
  theme text,
  id_admin int REFERENCES admin(id)
);

CREATE TABLE sujet (
  id int PRIMARY KEY AUTO_INCREMENT,
  id_theme int REFERENCES theme(id),
  sujet text,
  id_personne int REFERENCES personne(id),
  date datetime
);

CREATE TABLE commentaire (
  id int PRIMARY KEY AUTO_INCREMENT,
  id_sujet int REFERENCES sujet(id),
  id_personne int REFERENCES personne(id),
  commentaire text,
  date datetime
);

CREATE TABLE mot_de_passe_oublie (
  id int PRIMARY KEY AUTO_INCREMENT,
  nom varchar(20),
  prenom varchar(50),
  email varchar(50),
  date date
);

INSERT INTO ministere VALUES
(default, 'Ministère de la Santé Publique'),
(default, 'Ministère de la Sécurité Publique'),
(default, 'Ministère de la Population, de la Protection Sociale et de la Promotion de la Femme'),
(default, 'Ministère du Développement Numérique, Transformation Digitale, des Postes et des Télécommunications'),
(default, 'Ministère des Mines et des Ressources Stratégiques'),
(default, 'Ministère de la Justice'),
(default, 'Ministère de l Enseignement Supérieur et de la Recherche Scientifique'),
(default, 'Ministère de l Environnement et du Développement Durable'),
(default, 'Ministère de la Défense Nationale'),
(default, 'Ministère des Affaires Etrangères');

INSERT INTO fonction VALUES
(default, 'GCR'),
(default, 'ATR'),
(default, 'RLS');

INSERT INTO region VALUES
(default, 'Alaotra mangoro'),
(default, 'Amoron i Mania'),
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

INSERT INTO personne VALUES
(default, 'nom_administrateur', 'prénom_administrateur', true);
INSERT INTO admin VALUES
(default, 1, 'administrateur@admin.mg', sha2('administrateur', 256));

INSERT INTO theme VALUES
(default, 'Évènements', 1),
(default, 'Coordination', 1),
(default, 'Finance', 1),
(default, 'Opérations & techniques', 1),
(default, 'Passation des marchés', 1),
(default, 'Logistique & intrants', 1);

-- SELECT TABLE_SCHEMA AS portail,
--   ROUND(SUM(DATA_LENGTH + INDEX_LENGTH) / 1024 / 1024, 2) AS Size in MB
--   FROM information_schema.TABLES
--   WHERE TABLE_SCHEMA="portail";
