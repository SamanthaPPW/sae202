<?php
if (!file_exists(__DIR__ . '/db.php')) {
    die('Fichier db.php introuvable');
}
require_once(__DIR__ . '/db.php');  
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

function createUser($nom, $prenom, $email, $telephone, $password) {
    global $pdo;

    $token = bin2hex(random_bytes(16)); // Génère un token aléatoire
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe, confirmation_token, is_confirmed) VALUES (?, ?, ?, ?, ?, ?, 0)";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$nom, $prenom, $email, $telephone, $hash, $token]);

    if ($result) {
        return $token;  // Retourne bien le token à utiliser dans le mail
    } else {
        return false;
    }
}

function getUserByEmail(string $email) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

