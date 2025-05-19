<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['ifadmin'] != 1) {
    header('Location: index.php');
    exit;
}

$users = $pdo->query("SELECT id, username, email, ifadmin FROM users")->fetchAll();
$produits = $pdo->query("SELECT * FROM produits")->fetchAll();
$commandes = $pdo->query("SELECT * FROM commandes")->fetchAll();
?>

<link rel="stylesheet" href="style.css">
<h2>Interface Admin</h2>

<h3>Utilisateurs</h3>
<ul>
    <?php foreach ($users as $user): ?>
        <li><?= $user['username'] ?> - <?= $user['email'] ?> - Admin: <?= $user['ifadmin'] ?></li>
    <?php endforeach; ?>
</ul>

<h3>Produits</h3>
<ul>
    <?php foreach ($produits as $p): ?>
        <li><?= $p['nom'] ?> - <?= $p['prix'] ?> €</li>
    <?php endforeach; ?>
</ul>

<h3>Commandes</h3>
<ul>
    <?php foreach ($commandes as $c): ?>
        <li>Commande #<?= $c['id'] ?> - Utilisateur: <?= $c['user_id'] ?> - Produit: <?= $c['produit_id'] ?></li>
    <?php endforeach; ?>
</ul>

<a href="index.php">Retour</a>