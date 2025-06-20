<?php
function index() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    session_unset();
    session_destroy();
    
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }
    
    header('Location: /?message=disconnected');
    exit;
}

function confirm() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['id'])) {
        header('Location: /connexion');
        exit;
    }
    
    require_once(__DIR__ . '/../view/deconnexion_view.php');
}
?>