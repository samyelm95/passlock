<?php
session_start(); // Démarrez la session

// Vérifiez si le formulaire d'inscription a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données du formulaire d'inscription
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insérez les données dans la base de données (ex. en utilisant PDO)
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "votre_base_de_donnees";

    try {
        $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparez et exécutez la requête pour insérer les données dans la base de données
        $stmt = $bdd->prepare("INSERT INTO users (pseudo, email, password) VALUES (:pseudo, :email, :password)");
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password_hash); // N'oubliez pas de hasher le mot de passe avant de l'insérer dans la base de données
        $password_hash = password_hash($password, PASSWORD_DEFAULT); // Hash du mot de passe
        $stmt->execute();

        // Si l'inscription est réussie, créez une session pour l'utilisateur
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['email'] = $email;

        // Redirigez l'utilisateur vers la page d'accueil ou toute autre page après l'inscription
        header("Location: index.html");
        exit;
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
