DROP DATABASE IF EXISTS porsche2;
CREATE DATABASE porsche2;
USE porsche2;

-- Table Utilisateurs
CREATE TABLE Utilisateurs (
    ID_Utilisateur INT NOT NULL AUTO_INCREMENT,
    Nom VARCHAR(50) NOT NULL,
    Prenom VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Mdp VARCHAR(255) NOT NULL,
    num VARCHAR(20),
    Role ENUM('Client', 'Concess') NOT NULL DEFAULT 'Client', 
    PRIMARY KEY (ID_Utilisateur)
);

-- Table Voitures
CREATE TABLE Voitures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marque VARCHAR(255) NOT NULL,
    modele VARCHAR(255) NOT NULL,
    annee INT NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    image VARCHAR(255) NOT NULL
);

-- Table Essais
CREATE TABLE Essais (
    ID_Essai INT AUTO_INCREMENT PRIMARY KEY,
    ID_Utilisateur INT NOT NULL,
    ID_Voiture INT NOT NULL,
    date_demande DATETIME DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('En attente', 'Acceptée', 'Refusée') DEFAULT 'En attente',
    FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateurs(ID_Utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (ID_Voiture) REFERENCES Voitures(id) ON DELETE CASCADE
);

-- Table DemandeEssai (Gestion des essais avec nouvelles infos)
CREATE TABLE DemandeEssai (
    ID_Demande INT AUTO_INCREMENT PRIMARY KEY,
    ID_Utilisateur INT NOT NULL,
    ID_Voiture INT NOT NULL,
    date_demande TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_voulue DATE NOT NULL,  -- Date souhaitée pour l'essai
    fin_validite_permis DATE NOT NULL, -- Date de fin de validité du permis
    annee_permis INT NOT NULL, -- Année d'obtention du permis
    accompagnant VARCHAR(255) NULL, -- Optionnel : nom d'un accompagnant
    statut ENUM('En attente', 'Acceptée', 'Refusée') DEFAULT 'En attente',
    FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateurs(ID_Utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (ID_Voiture) REFERENCES Voitures(id) ON DELETE CASCADE
);

-- Table Panier
CREATE TABLE Panier (
    ID_Panier INT AUTO_INCREMENT PRIMARY KEY,
    ID_Utilisateur INT NOT NULL,
    ID_Voiture INT NOT NULL,
    quantite INT NOT NULL DEFAULT 1,
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateurs(ID_Utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (ID_Voiture) REFERENCES Voitures(id) ON DELETE CASCADE
);
