<?php
if (!file_exists(__DIR__ . '/db.php')) {
    die('Fichier db.php introuvable');
}
require_once(__DIR__ . '/db.php');  
<<<<<<< HEAD
=======

>>>>>>> 7054ab97beb032561d637c9b4b2a8252cd6eda29
function getUserById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUsers() {
    $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
    $stmt = $db->prepare('SELECT id, nom, prenom FROM utilisateurs');
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function emailExists(string $email): bool {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetchColumn() > 0;
}

function getAdminUser() {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE role = 'admin' LIMIT 1");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createUser(string $nom, string $prenom, string $email, string $telephone, string $password): bool {
    global $pdo;
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $token = bin2hex(random_bytes(32)); // token 64 caractères hex

    $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe, is_confirmed, confirmation_token) VALUES (?, ?, ?, ?, ?, 0, ?)");
    return $stmt->execute([$nom, $prenom, $email, $telephone, $hash, $token]) ? $token : false;
}

function getUserByEmail(string $email) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

