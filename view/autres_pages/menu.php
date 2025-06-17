<?php session_start(); 

if (isset($_GET['debug_login'])) {
  $_SESSION['user_nom'] = "toto";
  header("Location: /"); 
  exit;
}

if (isset($_GET['debug_logout'])) {
  session_unset();
  session_destroy();
  header("Location: /");
  exit;
}
?>

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

    <?php if (isset($_SESSION['user_nom'])): ?>
      <div class="connexion">
        Bienvenue <?= htmlspecialchars($_SESSION['user_nom']) ?>
        <a href="?debug_logout">Déconnexion</a>
      </div>
    <?php else: ?>
      <div class="connexion">
        <a href="?debug_login">Connexion (debug)</a> 
        <a href="/connexion/inscription">Inscription</a>
      </div>
    <?php endif; ?>
  </nav>
</header>
