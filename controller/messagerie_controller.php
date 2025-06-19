<?php
require_once(__DIR__ . '/../model/messagerie_model.php');
require_once(__DIR__ . '/../model/utilisateurs_model.php');

function index() {
    session_start();
    require('view/autres_pages/header.php');
    require('view/autres_pages/menu.php');
    
    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
        $messagesE = getMessages($user_id, 'E', null);
        $messagesR = getMessages($user_id, 'R', null);
    } else {
        header('Location: /connexion');
        exit;
    }
    
    require('view/messagerie/messages.php');
    require('view/autres_pages/footer.php');
}

function nouveau_message() {
    session_start();
    
    if (!isset($_SESSION['id'])) {
        header('Location: /connexion');
        exit;
    }
    
    $users = getUsers();
    require('view/autres_pages/header.php');
    require('view/autres_pages/menu.php');
    require('view/messagerie/nouveau_message.php');
    require('view/autres_pages/footer.php');
}

function envoyer_message() {
    session_start();
    
    if (!isset($_SESSION['id'])) {
        header('Location: /connexion');
        exit;
    }
    
    $expediteur = $_SESSION['id'];
    $destinataire = $_POST['message_destinataire_id'];
    $sujet = $_POST['message_sujet'];
    $message = $_POST['message_text'];
    
    if (envoyerMessage($expediteur, $destinataire, $sujet, $message)) {
        $_SESSION['message'] = "Message envoyé avec succès !";
    } else {
        $_SESSION['error'] = "Erreur lors de l'envoi du message.";
    }
    
    header('Location: /messagerie');
    exit;
}

function afficher_message() {
    session_start();
    
    if (!isset($_SESSION['id'])) {
        header('Location: /connexion');
        exit;
    }
    
    $id = $_GET['id'];
    $messageR = getMessages(null, null, $id);
    
    if (!$messageR || ($messageR['message_destinataire_id'] != $_SESSION['id'] && $messageR['message_expediteur_id'] != $_SESSION['id'])) {
        header('Location: /messagerie');
        exit();
    }
    
    require('view/autres_pages/header.php');
    require('view/autres_pages/menu.php');
    require('view/messagerie/message_affiche.php');
    require('view/autres_pages/footer.php');
}

function supprimer_message() {
    session_start();
    
    if (!isset($_SESSION['id'])) {
        header('Location: /connexion');
        exit;
    }
    
    $id = $_GET['id'];
    
    if (supprimerMessage($id)) {
        $_SESSION['message'] = "Message supprimé avec succès !";
    } else {
        $_SESSION['error'] = "Erreur lors de la suppression du message.";
    }
    
    header('Location: /messagerie');
    exit;
}