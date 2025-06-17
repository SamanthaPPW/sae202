<?php
require_once(__DIR__ . '/../../model/db.php');

function getAllUsers() {
    global $pdo; 

    $sql = "SELECT id, nom, prenom, email, telephone, date_inscription FROM utilisateurs";
    $stmt = $pdo->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUserByEmail(string $email) {
    global $pdo;

    $sql = "SELECT * FROM utilisateurs WHERE email = :email LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
