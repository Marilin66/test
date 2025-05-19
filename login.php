<?php
require 'db.php';
session_start();
if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header('Location: index.php');
        exit;
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>

<link rel="stylesheet" href="style.css">
<h2>Connexion</h2>
<form method="post">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br>
    <button type="submit">Se connecter</button>
</form>
<?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
<a href="register.php">Créer un compte</a>