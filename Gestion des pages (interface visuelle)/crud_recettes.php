<?php

// 1. Créer un utilisateur (INSERT)
function createRecette($name, $description, $ingredients,) {
    global $pdo;

    // Requête d'insertion
    $sql = "INSERT INTO Recette (name, description, ingredients) VALUES (:name, :description, :ingredients)";
    $stmt = $pdo->prepare($sql);

    // Lier les paramètres
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':ingredients', $ingredients);

    try {
        // Exécution de la requête
        $stmt->execute();
        return "Recette créé avec succès.";
    } catch (PDOException $e) {
        return "Erreur lors de l'insertion : " . $e->getMessage();
    }
}

// 2. Lire tous les utilisateurs (SELECT)
function readRecettes() {
    global $pdo;

    // Requête de sélection
    $sql = "SELECT id, name, FROM Recette";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Récupère tous les résultats sous forme de tableau associatif
}

function deleteUser($id) {
    global $pdo;

    // Requête de suppression
    $sql = "DELETE FROM Recette WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    try {
        // Exécution de la requête
        $stmt->execute();
        return "Recette supprimé avec succès.";
    } catch (PDOException $e) {
        return "Erreur lors de la suppression : " . $e->getMessage();
    }
}

function updateUser($id, $name, $description, $ingredients) {
    global $pdo;

    // Requête de mise à jour.
    $sql = "UPDATE Recette SET name = :name, description = :description, ingredients = :ingredients WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    try{
        $stmt->execute();
        return "Recette modifié avec succès.";
    } catch (PDOException $e) {
        return "Erreur lors de la modification : " . $e->getMessage();
    }
}