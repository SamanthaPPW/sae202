<?php
require_once(__DIR__ . '/db.php');

function getMessages($user_id, $type = null, $id = null) {
    global $pdo;
    
    if ($id !== null) {
        $stmt = $pdo->prepare("SELECT * FROM messages WHERE message_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    if ($type === 'E') {
        $stmt = $pdo->prepare("
            SELECT messages.*, utilisateurs.prenom, utilisateurs.nom 
            FROM messages 
            JOIN utilisateurs ON messages.message_destinataire_id = utilisateurs.id 
            WHERE messages.message_expediteur_id = :id 
            ORDER BY messages.message_date_envoi DESC
        ");
    } elseif ($type === 'R') {
        $stmt = $pdo->prepare("
            SELECT messages.*, utilisateurs.prenom, utilisateurs.nom 
            FROM messages 
            JOIN utilisateurs ON messages.message_expediteur_id = utilisateurs.id 
            WHERE messages.message_destinataire_id = :id 
            ORDER BY messages.message_date_envoi DESC
        ");
    } else {
        return [];
    }
    
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function envoyerMessage($expediteur, $destinataire, $sujet, $message) {
    global $pdo;
    
    $stmt = $pdo->prepare("
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
    global $pdo;
    
    $stmt = $pdo->prepare("DELETE FROM messages WHERE message_id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    return $stmt->execute();
}