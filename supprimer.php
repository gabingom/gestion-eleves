<?php
require 'config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM eleves WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header('Location: index.php?msg=suppr');
exit;
