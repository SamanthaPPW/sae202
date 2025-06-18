<?php
require_once 'conf/conf.inc.php';

function getMessages($user_id, $type = null, $id = null) {
    $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);

    if ($id !== null) {
        $stmt = $db->prepare("SELECT * FROM messages WHERE message_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if ($type === 'E') {
        $stmt = $db->prepare("
            SELECT messages.*, users.user_prenom, users.user_nom FROM messages JOIN users ON messages.message_destinataire_id = users.user_id WHERE messages.message_expediteur_id = :user_id ORDER BY messages.message_date_envoi DESC");
    } elseif ($type === 'R') {
        $stmt = $db->prepare("
            SELECT messages.*, users.user_prenom, users.user_nom FROM messages JOIN users ON messages.message_expediteur_id = users.user_id WHERE messages.message_destinataire_id = :user_id ORDER BY messages.message_date_envoi DESC");
    } else {
        return [];
    }

    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function envoyerMessage($expediteur, $destinataire, $sujet, $message) {
    $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
    $stmt = $db->prepare("
        INSERT INTO messages 
        (message_expediteur_id, message_destinataire_id, message_sujet, message_text, message_date_envoi) 
        VALUES 
        (:expediteur, :destinataire, :sujet, :message, NOW())
    ");

    $stmt->bindParam(':expediteur', $expediteur);
    $stmt->bindParam(':destinataire', $destinataire);
    $stmt->bindParam(':sujet', $sujet);
    $stmt->bindParam(':message', $message);

    return $stmt->execute();
}

function supprimerMessage($id) {
    $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
    $stmt = $db->prepare("DELETE FROM messages WHERE message_id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}
