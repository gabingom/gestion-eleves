<?php
require 'config.php';

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

    // Verifications simples
    if ($nom === '')    $erreurs[] = "Le nom est obligatoire.";
    if ($prenom === '') $erreurs[] = "Le prenom est obligatoire.";
    if ($age === '' || !is_numeric($age) || $age < 3 || $age > 16)
        $erreurs[] = "L'age doit etre un nombre entre 3 et 16.";
    if ($classe === '') $erreurs[] = "La classe est obligatoire.";
    if ($sexe === '')   $erreurs[] = "Le sexe est obligatoire.";

    if (count($erreurs) === 0) {
        $stmt = $pdo->prepare(
            "INSERT INTO eleves (nom, prenom, age, classe, sexe, nom_pere, nom_mere, telephone)
             VALUES (:nom, :prenom, :age, :classe, :sexe, :nom_pere, :nom_mere, :telephone)"
        );
        $stmt->execute([
            ':nom' => $nom, ':prenom' => $prenom, ':age' => $age,
            ':classe' => $classe, ':sexe' => $sexe,
            ':nom_pere' => $nom_pere, ':nom_mere' => $nom_mere,
            ':telephone' => $telephone,
        ]);
        header('Location: index.php?msg=ajout');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un eleve</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="topbar">
        <h1>Ajouter un eleve</h1>
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
                <input type="text" name="nom" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>">
            </label>
            <label>Prenom *
                <input type="text" name="prenom" value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>">
            </label>
            <label>Age *
                <input type="number" name="age" min="3" max="16" value="<?= htmlspecialchars($_POST['age'] ?? '') ?>">
            </label>
            <label>Classe *
                <select name="classe">
                    <option value="">-- Choisir --</option>
                    <?php foreach (['CI','CP','CE1','CE2','CM1','CM2'] as $c): ?>
                        <option value="<?= $c ?>" <?= (($_POST['classe'] ?? '') === $c) ? 'selected' : '' ?>><?= $c ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>Sexe *
                <select name="sexe">
                    <option value="">-- Choisir --</option>
                    <option value="Garcon" <?= (($_POST['sexe'] ?? '') === 'Garcon') ? 'selected' : '' ?>>Garcon</option>
                    <option value="Fille"  <?= (($_POST['sexe'] ?? '') === 'Fille')  ? 'selected' : '' ?>>Fille</option>
                </select>
            </label>
            <label>Nom du pere
                <input type="text" name="nom_pere" value="<?= htmlspecialchars($_POST['nom_pere'] ?? '') ?>">
            </label>
            <label>Nom de la mere
                <input type="text" name="nom_mere" value="<?= htmlspecialchars($_POST['nom_mere'] ?? '') ?>">
            </label>
            <label>Telephone
                <input type="text" name="telephone" value="<?= htmlspecialchars($_POST['telephone'] ?? '') ?>">
            </label>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Enregistrer</button>
                <a href="index.php" class="btn-light">Annuler</a>
            </div>
        </form>
    </main>
</body>
</html>
