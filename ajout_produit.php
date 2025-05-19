<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['ifadmin'] != 1) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $cree_par = $_SESSION['user']['id'];

    $stmt = $pdo->prepare("INSERT INTO produits (nom, description, prix, cree_par) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $description, $prix, $cree_par]);

    header('Location: index.php');
    exit;
}
?>

<link rel="stylesheet" href="style.css">
<h2>Ajouter un produit</h2>
<form method="post">
    <input type="text" name="nom" placeholder="Nom du produit" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <input type="number" name="prix" placeholder="Prix" step="0.01" required><br>
    <button type="submit">Ajouter</button>
</form>
<a href="index.php">Retour à l'accueil</a>