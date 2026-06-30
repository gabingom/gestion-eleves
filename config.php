<?php
// ============================================
// Connexion a la base de donnees (WAMP / MySQL)
// ============================================
// Sous WAMP par defaut : utilisateur "root" et mot de passe vide.

$host   = 'localhost';
$dbname = 'database'; // Remplacez par le nom de votre base de donnees
$user   = 'root';
$pass   = '8900';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die("Erreur de connexion a la base de donnees : " . $e->getMessage());
}
