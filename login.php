<?php
session_start(); // Démarrez la session

$servername = "localhost";
$username = "root";
$password = "root";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=utilisateurs", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connexion réussie !";
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $req = $bdd->prepare("SELECT * FROM users WHERE email = :email AND mdp = :mdp");
        $req->execute(array(
            "email" => $email,
            "mdp" => $password
        ));
        $rep = $req->fetch();

        if ($rep !== false) {
            // L'authentification est réussie, stockez le pseudo dans la session
            $_SESSION['pseudo'] = $rep['pseudo'];
            // Redirigez l'utilisateur vers la page principale
            header("Location: index.php");
            exit;
        } else {
            $error_msg = "Email ou mot de passe incorrect.";
        }
    }
}
?>

<form method="POST" action="">
    <label for="email">Email</label>
    <input type="email" placeholder="Entrez votre e-mail..." id="email" name="email">

    <label for="password">Mot de passe</label>
    <input type="password" placeholder="Entrez votre mot de passe..." id="password" name="password">

    <input type="submit" value="Se connecter" name="ok">
</form>

<?php
if (isset($error_msg)) {
    echo "<p>$error_msg</p>";
}
?>
