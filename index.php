<?php
require 'config.php';

// Recherche simple
$recherche = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($recherche !== '') {
    $stmt = $pdo->prepare(
        "SELECT * FROM eleves
         WHERE nom LIKE :q OR prenom LIKE :q OR classe LIKE :q
         ORDER BY nom, prenom"
    );
    $stmt->execute([':q' => '%' . $recherche . '%']);
} else {
    $stmt = $pdo->query("SELECT * FROM eleves ORDER BY nom, prenom");
}
$eleves = $stmt->fetchAll();

// Message apres une action
$message = isset($_GET['msg']) ? $_GET['msg'] : '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des eleves</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="topbar">
        <h1>Ecole primaire — Gestion des eleves</h1>
    </header>

    <main class="container">

        <?php if ($message === 'ajout'): ?>
            <p class="alert ok">Eleve ajoute avec succes.</p>
        <?php elseif ($message === 'modif'): ?>
            <p class="alert ok">Eleve modifie avec succes.</p>
        <?php elseif ($message === 'suppr'): ?>
            <p class="alert ok">Eleve supprime.</p>
        <?php endif; ?>

        <div class="toolbar">
            <form method="get" class="search">
                <input type="text" name="q" placeholder="Rechercher par nom, prenom ou classe..."
                       value="<?= htmlspecialchars($recherche) ?>">
                <button type="submit">Rechercher</button>
                <?php if ($recherche !== ''): ?>
                    <a class="btn-light" href="index.php">Reinitialiser</a>
                <?php endif; ?>
            </form>
            <a class="btn-primary" href="ajouter.php">+ Ajouter un eleve</a>
        </div>

        <p class="count"><?= count($eleves) ?> eleve(s)</p>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Age</th>
                    <th>Classe</th>
                    <th>Sexe</th>
                    <th>Pere</th>
                    <th>Mere</th>
                    <th>Telephone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($eleves) === 0): ?>
                    <tr><td colspan="9" class="empty">Aucun eleve pour le moment.</td></tr>
                <?php else: ?>
                    <?php foreach ($eleves as $e): ?>
                        <tr>
                            <td><?= htmlspecialchars($e['nom']) ?></td>
                            <td><?= htmlspecialchars($e['prenom']) ?></td>
                            <td><?= (int)$e['age'] ?></td>
                            <td><?= htmlspecialchars($e['classe']) ?></td>
                            <td><?= htmlspecialchars($e['sexe']) ?></td>
                            <td><?= htmlspecialchars($e['nom_pere']) ?></td>
                            <td><?= htmlspecialchars($e['nom_mere']) ?></td>
                            <td><?= htmlspecialchars($e['telephone']) ?></td>
                            <td class="actions">
                                <a class="btn-edit" href="modifier.php?id=<?= $e['id'] ?>">Modifier</a>
                                <a class="btn-del" href="supprimer.php?id=<?= $e['id'] ?>"
                                   onclick="return confirm('Supprimer cet eleve ?');">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </main>

    <footer class="footer">
        <p>TP DevOps — Projet binome — Gestion des eleves</p>
    </footer>
</body>
</html>
