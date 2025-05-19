<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$stmt = $pdo->prepare("
    SELECT c.id, p.nom, p.prix, c.created_at 
    FROM commandes c 
    JOIN produits p ON c.produit_id = p.id 
    WHERE c.user_id = ?
    ORDER BY c.created_at DESC
");
$stmt->execute([$_SESSION['user']['id']]);
$commandes = $stmt->fetchAll();
?>

<link rel="stylesheet" href="style.css">
<h2>Mes Commandes</h2>
<?php foreach ($commandes as $cmd): ?>
    <div class="produit">
        <h3><?= htmlspecialchars($cmd['nom']) ?></h3>
        <p><strong><?= $cmd['prix'] ?> €</strong></p>
        <p>Commandé le : <?= $cmd['created_at'] ?></p>
    </div>
<?php endforeach; ?>
<a href="index.php">Retour à l'accueil</a>