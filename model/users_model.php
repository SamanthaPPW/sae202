<?php
require_once 'conf/conf.inc.php';

function verif_utilisateur($email)
{
    $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
    $stmt = $db->prepare('SELECT * FROM users WHERE user_mail = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function inscription_utilisateur($nom, $prenom, $email, $password_hashed)
{
    $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
    $stmt = $db->prepare('INSERT INTO users (user_nom, user_prenom, user_mail, user_password) VALUES (:nom, :prenom, :email, :password)');
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password_hashed);

    return $stmt->execute();
}

