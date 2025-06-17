<?php session_start(); ?>

<header>
  <img src="/view/img/logo.png" alt="Logo de l'event" id="logo">

  <nav>
    <a href="/">Accueil</a>
    <a href="/concept">Concept</a>
    <a href="/infos">Informations</a>

    <?php if (isset($_SESSION['user_nom'])) : ?>
      <a href="/profil">Profil</a>
      <a href="/messagerie">Messagerie</a>
    <?php endif; ?>

    <?php
    if (isset($_SESSION['user_nom'])) {
        echo '<a href="/connexion/deconnexion">Déconnexion</a>';
    } else {
        echo '<a href="/connexion">Connexion</a>';
        echo '<a href="/connexion/inscription">Inscription</a>'
        ;
        echo '<a href="/profil">Profil</a>';
    }?>
  </header>