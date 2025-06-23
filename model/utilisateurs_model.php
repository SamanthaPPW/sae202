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



//function verif_utilisateur($email) {
//    $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
//    $stmt = $db->prepare('SELECT * FROM users WHERE user_mail = :email');
//    $stmt->bindParam(':email', $email);
//    $stmt->execute();

//    return $stmt->fetch(PDO::FETCH_ASSOC);
//}
function createUser(string $nom, string $prenom, string $email, string $telephone, string $password): bool {
    global $pdo;
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([$nom, $prenom, $email, $telephone, $hash]);
}

//function inscription_utilisateur($nom, $prenom, $email, $password_hashed) {
//    $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
//    $stmt = $db->prepare('INSERT INTO users (user_nom, user_prenom, user_mail, user_password) VALUES (:nom, :prenom, :email, :password)');
//    $stmt->bindParam(':nom', $nom);
//    $stmt->bindParam(':prenom', $prenom);
//    $stmt->bindParam(':email', $email);
//    $stmt->bindParam(':password', $password_hashed);

//    return $stmt->execute();
//}


function getUserByEmail(string $email) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

