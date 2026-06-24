# Gestion des eleves (primaire)

Petite plateforme web pour gerer les eleves d'une ecole primaire : ajout, liste,
recherche, modification et suppression. Chaque eleve a un nom, un prenom, un age,
une classe, un sexe, le nom des parents et un telephone.

Projet realise en binome dans le cadre du TP DevOps (Git / GitHub).

## Technologies

- PHP (PDO)
- MySQL
- HTML / CSS
- WAMP (Apache + MySQL)

## Installation (sur chaque machine)

1. Installer et demarrer **WAMP** (l'icone doit etre verte).
2. Copier le dossier du projet dans le repertoire **www** de WAMP :
   `C:\wamp64\www\gestion-eleves`
3. Importer la base de donnees :
   - Ouvrir **phpMyAdmin** (http://localhost/phpmyadmin)
   - Cliquer sur l'onglet **Importer**
   - Choisir le fichier `database.sql` et lancer l'import
4. Verifier `config.php` (par defaut : utilisateur `root`, mot de passe vide).
5. Ouvrir dans le navigateur : http://localhost/gestion-eleves/

## Structure du projet

| Fichier         | Role                                      |
|-----------------|-------------------------------------------|
| `index.php`     | Liste des eleves + recherche              |
| `ajouter.php`   | Formulaire d'ajout                        |
| `modifier.php`  | Formulaire de modification                |
| `supprimer.php` | Suppression d'un eleve                    |
| `config.php`    | Connexion a la base de donnees            |
| `database.sql`  | Script de creation de la base             |
| `style.css`     | Feuille de style                          |

## Travail en binome

Voir le fichier `GUIDE-GIT.md` pour la procedure Git (branches, push, pull, conflits).
