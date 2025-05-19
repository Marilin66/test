<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produit_id = $_POST['produit_id'];
    if (!in_array($produit_id, $_SESSION['panier'])) {
        $_SESSION['panier'][] = $produit_id;
    }
}

$ids = $_SESSION['panier'];
$produits = [];

if (count($ids) > 0) {
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT * FROM produits WHERE id IN ($placeholders)");
    $stmt->execute($ids);
    $produits = $stmt->fetchAll();
}
?>

<link rel="stylesheet" href="style.css">
<h2>Mon Panier</h2>
<?php foreach ($produits as $produit): ?>
    <div class="produit">
        <h3><?= htmlspecialchars($produit['nom']) ?></h3>
        <p><?= htmlspecialchars($produit['description']) ?></p>
        <p><strong><?= $produit['prix'] ?> €</strong></p>
    </div>
<?php endforeach; ?>
<form method="post" action="valider_commande.php">
    <button type="submit">Valider la commande</button>
</form>
<a href="index.php">Retour à l'accueil</a>