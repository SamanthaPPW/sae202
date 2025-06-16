<?php session_start(); ?>
<header>
  <img src="/view/img/logo.png" alt="Logo de l'event" id="logo">
<nav>
  <a href="/">Accueil</a>
  <a href="/concept">Concept</a>
  <a href="/infos">Informations</a>
  
  <?php if (isset($_SESSION['user_nom'])) :?>
  <a href="/profil">Profil</a>
  <a href="/messagerie">Messagerie</a>
  <?php endif; ?>

  <?php if (isset($_SESSION['user_nom'])){
    echo '<div class="connexion">Bienvenue ' . htmlspecialchars($_SESSION['user_nom']) . ' <a href="/connexion/deconnexion">Déconnexion</a></div>';
  }
  else {
    echo '<div class="connexion">
            <a href="/connexion">Connexion</a> 
            <a href="/connexion/inscription">Inscription</a>
          </div>';
  }
  ?>
  </div>
</nav>
</header>