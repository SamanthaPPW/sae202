<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
}?>

<header>
  <img src="/view/img/logo.png" alt="Logo de l'event" id="logo">

  <nav>
    <a href="/">Accueil</a>
    <a href="/concept">Concept</a>
    <a href="/infos">Informations</a>

    <?php
    if (isset($_SESSION['user_id'])) {
        echo '<a href="/connexion/deconnexion">Déconnexion</a>';
        echo '<a href="/profil">Profil</a>';
        echo '<a href="/messagerie">Messagerie</a>';
    } else {
        echo '<a href="/connexion">Connexion</a>';
        echo '<a href="/connexion/inscription">Inscription</a>'
        ;
        
    }?>
  </header>