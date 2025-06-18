<?php
require_once 'conf/EXEMPLE_conf.inc.php';

function verif_utilisateur($email) {
    $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
    $stmt = $db->prepare('SELECT * FROM users WHERE user_mail = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function inscription_utilisateur($nom, $prenom, $email, $password_hashed) {
    $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
    $stmt = $db->prepare('INSERT INTO users (user_nom, user_prenom, user_mail, user_password) VALUES (:nom, :prenom, :email, :password)');
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password_hashed);

    return $stmt->execute();
}

function get_user_by_id($id) {
    $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
    $stmt = $db->prepare('SELECT user_nom, user_prenom FROM users WHERE user_id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUsers() {
    $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
    $stmt = $db->prepare('SELECT user_id, user_nom, user_prenom FROM users');
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
