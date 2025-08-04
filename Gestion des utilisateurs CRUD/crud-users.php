<?php

function connect_database() : PDO {
    $database = new PDO("mysql:host=127.0.0.1;dbname=app-database", "root", "root");
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Ajout de la gestion des erreurs
    return $database;
}

// Create
function create_user(string $email, string $password) : int | null {
    $database = connect_database();

    // Requête préparée pour insérer un utilisateur
    $request = $database->prepare("INSERT INTO Utilisateur (email, password) VALUES (?, ?)");

    // Exécution de la requête avec le hash du mot de passe
    $isSuccessful = $request->execute([$email, password_hash($password, PASSWORD_DEFAULT)]);

    // Si l'insertion réussit, on retourne l'ID de l'utilisateur inséré
    if ($isSuccessful) {
        return (int) $database->lastInsertId(); // Cast explicite en int
    } else {
        return null; // Retourne null en cas d'échec
    }
}
?>
