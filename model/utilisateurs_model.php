<?php
require_once(__DIR__ . '/db.php');  

function getUserById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function emailExists(string $email): bool {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetchColumn() > 0;
}

function createUser(string $nom, string $prenom, string $email, string $telephone, string $password): bool {
    global $pdo;
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([$nom, $prenom, $email, $telephone, $hash]);
}

function getUserByEmail(string $email) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}