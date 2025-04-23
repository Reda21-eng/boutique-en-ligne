CREATE DATABASE IF NOT EXISTS boutique_en_ligne;
USE boutique_en_ligne;

-- Utilisateur
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    mot_de_passe VARCHAR(255),
    role ENUM('client', 'admin') DEFAULT 'client',
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Catégorie
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100)
);

-- Sous-catégorie
CREATE TABLE sous_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    categorie_id INT,
    FOREIGN KEY (categorie_id) REFERENCES categories(id)
);

-- Produit
CREATE TABLE produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150),
    description TEXT,
    prix DECIMAL(10,2),
    stock INT,
    image_url VARCHAR(255),
    categorie_id INT,
    sous_categorie_id INT,
    date_ajout DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categorie_id) REFERENCES categories(id),
    FOREIGN KEY (sous_categorie_id) REFERENCES sous_categories(id)
);

-- Commande
CREATE TABLE commandes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT,
    date_commande DATETIME DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('en attente', 'validée', 'annulée') DEFAULT 'en attente',
    total DECIMAL(10,2),
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id)
);

-- Commande_Produit (relation n-n)
CREATE TABLE commande_produits (
    commande_id INT,
    produit_id INT,
    quantite INT,
    prix_unitaire DECIMAL(10,2),
    PRIMARY KEY (commande_id, produit_id),
    FOREIGN KEY (commande_id) REFERENCES commandes(id),
    FOREIGN KEY (produit_id) REFERENCES produits(id)
);

-- Panier
CREATE TABLE paniers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id)
);

-- Panier_Produit (relation n-n)
CREATE TABLE panier_produits (
    panier_id INT,
    produit_id INT,
    quantite INT,
    PRIMARY KEY (panier_id, produit_id),
    FOREIGN KEY (panier_id) REFERENCES paniers(id),
    FOREIGN KEY (produit_id) REFERENCES produits(id)
);
