<?php
require('model/messagerie_model.php');
require('model/utilisateurs_model.php');

function index() {
    session_start();
    require('view/autres_pages/header.php');
    require('view/autres_pages/menu.php');

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        $user_id = '';
    }

    $messagesE = getMessages($user_id, 'E', null);
    $messagesR = getMessages($user_id, 'R', null);

    require('view/messagerie/messages.php');
    require('view/autres_pages/footer.php');
}

function nouveau_message() {
    session_start();
    $users = getUsers();

    require('view/autres_pages/header.php');
    require('view/autres_pages/menu.php');
    require('view/messagerie/nouveau_message.php');
    require('view/autres_pages/footer.php');
}

function envoyer_message() {
    session_start();
    $expediteur = $_SESSION['user_id'];
    $destinataire = $_POST['message_destinataire_id'];
    $sujet = $_POST['message_sujet'];
    $message = $_POST['message_text'];

    envoyerMessage($expediteur, $destinataire, $sujet, $message);
    $_SESSION['message'] = "Message envoyé avec succès !";
    header('Location:/messagerie');
    exit;
}

function afficher_message() {
    session_start();
    $id = $_GET['id'];
    $messageR = getMessages(null, null, $id);
    
    if ($messageR['message_destinataire_id'] != $_SESSION['user_id'] && $messageR['message_expediteur_id'] != $_SESSION['user_id']) {
        header('Location:/messagerie');
        exit();
    }
    
    require('view/autres_pages/header.php');
    require('view/autres_pages/menu.php');
    require('view/messagerie/message_affiche.php'); 
    require('view/autres_pages/footer.php');
    
}

function supprimer_message() {
    session_start();

    $id = $_GET['id'];
    supprimerMessage($id);

    $_SESSION['message'] = "Message supprimé avec succès !";
    header('Location:/messagerie');
    exit;
}
