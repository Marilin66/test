<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$stmt = $pdo->query("SELECT produits.*, users.username FROM produits JOIN users ON produits.cree_par = users.id ORDER BY produits.created_at DESC");
$produits = $stmt->fetchAll();
?>

<link rel="stylesheet" href="style.css">
<h1>Liste des produits</h1>
<?php foreach ($produits as $produit): ?>
    <div class="produit">
        <h2><?= htmlspecialchars($produit['nom']) ?></h2>
        <p><?= nl2br(htmlspecialchars($produit['description'])) ?></p>
        <p><strong>Prix :</strong> <?= $produit['prix'] ?> €</p>
        <p><em>Ajouté par <?= htmlspecialchars($produit['username']) ?></em></p>
        <form action="panier.php" method="POST"> <input type="hidden" name="produit_id" value="<?=$produit['id'] ?>"><button type="submit">Passer la commande button</form>
    </div>
<?php endforeach; ?>

<a href="logout.php">Déconnexion</a>
<?php if ($_SESSION['user']['ifadmin']): ?>
    | <a href="ajout_produit.php">Ajouter un produit</a>
<?php endif; ?>
