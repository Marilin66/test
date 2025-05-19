<?php
session_start();
require_once 'config.php'; // fichier de connexion PDO à ta base de données

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header("Location: login.php");
    exit();
}

// Vérifie si un produit a été envoyé
if (isset($_POST['produit_id']) && isset($_POST['quantite'])) {
    $utilisateur_id = $_SESSION['utilisateur_id'];
    $produit_id = $_POST['produit_id'];
    $quantite = $_POST['quantite'];

    try {
        $stmt = $pdo->prepare("INSERT INTO commandes (utilisateur_id, produit_id, quantite) VALUES (?, ?, ?)");
        $stmt->execute([$utilisateur_id, $produit_id, $quantite]);
        header("Location: index.php?message=Commande passée avec succès");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Données manquantes pour passer la commande.";
}
?>