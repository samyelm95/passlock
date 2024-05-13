<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté, auquel cas rediriger vers index.php
if(isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier les identifiants de connexion
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérifier les identifiants de connexion (exemple basique, à remplacer par un système sécurisé)
    if ($username === 'utilisateur' && $password === 'motdepasse') {
        // Stocker le nom d'utilisateur dans une session
        $_SESSION['username'] = $username;
        // Rediriger vers index.php
        header("Location: index.php");
        exit;
    } else {
        // Afficher un message d'erreur si les informations de connexion sont incorrectes
        $message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div id="connexion">
    <h1>Connexion</h1>
    
    <!-- Afficher le message d'erreur s'il y en a un -->
    <?php if(isset($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username"> Nom d'utilisateur :</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Mot de passe :</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Connexion</button>
    </form>
</div>

</body>
</html>

