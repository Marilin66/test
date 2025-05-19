<?php
$host = 'localhost';
$dbname = 'mon_projet'; // remplace par le nom de ta base
$username = 'root'; // par défaut sous WAMP
$password = ''; // mot de passe vide sous WAMP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Active les erreurs PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
