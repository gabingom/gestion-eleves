<?php
require 'config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Recuperer l'eleve
$stmt = $pdo->prepare("SELECT * FROM eleves WHERE id = :id");
$stmt->execute([':id' => $id]);
$eleve = $stmt->fetch();

if (!$eleve) {
    die("Eleve introuvable. <a href='index.php'>Retour</a>");
}

$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom       = trim($_POST['nom'] ?? '');
    $prenom    = trim($_POST['prenom'] ?? '');
    $age       = trim($_POST['age'] ?? '');
    $classe    = trim($_POST['classe'] ?? '');
    $sexe      = trim($_POST['sexe'] ?? '');
    $nom_pere  = trim($_POST['nom_pere'] ?? '');
    $nom_mere  = trim($_POST['nom_mere'] ?? '');
    $telephone = trim($_POST['telephone'] ?? '');

    if ($nom === '')    $erreurs[] = "Le nom est obligatoire.";
    if ($prenom === '') $erreurs[] = "Le prenom est obligatoire.";
    if ($age === '' || !is_numeric($age) || $age < 3 || $age > 16)
        $erreurs[] = "L'age doit etre un nombre entre 3 et 16.";
    if ($classe === '') $erreurs[] = "La classe est obligatoire.";
    if ($sexe === '')   $erreurs[] = "Le sexe est obligatoire.";

    if (count($erreurs) === 0) {
        $stmt = $pdo->prepare(
            "UPDATE eleves
             SET nom=:nom, prenom=:prenom, age=:age, classe=:classe, sexe=:sexe,
                 nom_pere=:nom_pere, nom_mere=:nom_mere, telephone=:telephone
             WHERE id=:id"
        );
        $stmt->execute([
            ':nom' => $nom, ':prenom' => $prenom, ':age' => $age,
            ':classe' => $classe, ':sexe' => $sexe,
            ':nom_pere' => $nom_pere, ':nom_mere' => $nom_mere,
            ':telephone' => $telephone, ':id' => $id,
        ]);
        header('Location: index.php?msg=modif');
        exit;
    }
    // En cas d'erreur, on reaffiche ce que l'utilisateur a saisi
    $eleve = array_merge($eleve, $_POST);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un eleve</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="topbar">
        <h1>Modifier un professeur</h1>
    </header>

    <main class="container">
        <?php if ($erreurs): ?>
            <div class="alert err">
                <ul>
                    <?php foreach ($erreurs as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" class="card-form">
            <label>Nom *
                <input type="text" name="nom" value="<?= htmlspecialchars($eleve['nom']) ?>">
            </label>
            <label>Prenom *
                <input type="text" name="prenom" value="<?= htmlspecialchars($eleve['prenom']) ?>">
            </label>
            <label>Age *
                <input type="number" name="age" min="3" max="16" value="<?= htmlspecialchars($eleve['age']) ?>">
            </label>
            <label>Classe *
                <select name="classe">
                    <?php foreach (['CI','CP','CE1','CE2','CM1','CM2'] as $c): ?>
                        <option value="<?= $c ?>" <?= ($eleve['classe'] === $c) ? 'selected' : '' ?>><?= $c ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>Sexe *
                <select name="sexe">
                    <option value="Garcon" <?= ($eleve['sexe'] === 'Garcon') ? 'selected' : '' ?>>Garcon</option>
                    <option value="Fille"  <?= ($eleve['sexe'] === 'Fille')  ? 'selected' : '' ?>>Fille</option>
                </select>
            </label>
            <label>Nom du pere
                <input type="text" name="nom_pere" value="<?= htmlspecialchars($eleve['nom_pere']) ?>">
            </label>
            <label>Nom de la mere
                <input type="text" name="nom_mere" value="<?= htmlspecialchars($eleve['nom_mere']) ?>">
            </label>
            <label>Telephone
                <input type="text" name="telephone" value="<?= htmlspecialchars($eleve['telephone']) ?>">
            </label>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Enregistrer les modifications</button>
                <a href="index.php" class="btn-light">Annuler</a>
            </div>
        </form>
    </main>
</body>
</html>
