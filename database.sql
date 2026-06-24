-- ============================================
-- Base de donnees : Gestion des eleves (primaire)
-- A importer dans phpMyAdmin (WAMP)
-- ============================================

CREATE DATABASE IF NOT EXISTS gestion_eleves
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE gestion_eleves;

CREATE TABLE IF NOT EXISTS eleves (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    nom             VARCHAR(50)  NOT NULL,
    prenom          VARCHAR(50)  NOT NULL,
    age             INT          NOT NULL,
    classe          VARCHAR(20)  NOT NULL,
    sexe            VARCHAR(10)  NOT NULL,
    nom_pere        VARCHAR(100) DEFAULT NULL,
    nom_mere        VARCHAR(100) DEFAULT NULL,
    telephone       VARCHAR(20)  DEFAULT NULL,
    date_creation   TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Quelques eleves d'exemple
INSERT INTO eleves (nom, prenom, age, classe, sexe, nom_pere, nom_mere, telephone) VALUES
('Ngom',  'Awa',     8,  'CE1', 'Fille', 'Moussa Ngom',   'Fatou Diop',    '770000001'),
('Fall',  'Ibrahima',9,  'CE2', 'Garcon','Cheikh Fall',   'Aida Sarr',     '770000002'),
('Sow',   'Mariama', 7,  'CP',  'Fille', 'Amadou Sow',    'Khady Ba',      '770000003');
