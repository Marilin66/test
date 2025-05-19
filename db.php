<?php
$host = 'localhost';
$dbname = 'mon_projet';
$username = 'root';
$password = ''; // Mets ton mot de passe si tu en as

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>