<?php
session_start();

$error = ''; // Variable pour gérer les erreurs de formulaire

// Vérifie si l'utilisateur est déjà connecté via la session
if (isset($_SESSION['user_id'])) {
    // Si déjà connecté, redirige vers la page d'accueil
    header("Location: index.php");
    exit();
}

// Vérifie si le formulaire a été soumis via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);   // Nettoie l'email pour éviter les espaces inutiles
    $password = $_POST['password'];

    // Validation simple des entrées
    if (empty($email) || empty($password)) {
        $error = "Veuillez remplir tous les champs.";
    } else {
        try {
            // Connexion à la base de données
            $pdo = new PDO("mysql:host=127.0.0.1;dbname=Recette;", "root", "root");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prépare la requête pour récupérer l'utilisateur par email
            $stmt = $pdo->prepare("SELECT id, email, password FROM User WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifie si l'utilisateur existe et si le mot de passe est correct
            if ($user && password_verify($password, $user['password'])) {
                // Crée la session utilisateur
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];

                // Redirige vers la page d'accueil après la connexion réussie
                header("Location: index.php");
                exit();
            } else {
                $error = "Email ou mot de passe incorrect.";
            }
        } catch (PDOException $e) {
            $error = "Erreur de base de données : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h2>Se connecter</h2>

    <?php if ($error): ?>
        <div style="color: red;"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
