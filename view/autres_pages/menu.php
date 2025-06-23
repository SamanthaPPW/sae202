<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
  <div class="topnav">
    <a href="/" class="active"><img src="/view/assets/logoevent.svg" alt="Logo de l'event" id="logo"></a>
    <img src="/view/assets/typo.svg" alt="Titre de l'event" id="typo">
    
    <div id="liens">
      <a href="/">Accueil</a>
      <a href="/concept">Concept</a>
      <a href="/infos">Informations</a>
      

      <?php if (isset($_SESSION['id'])) : ?>
        <a href="/profil">Profil</a>
        <a href="/messagerie">Contact</a>
        <a href="/reservation">Réserver</a>

        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
          <a href="/admin">Admin</a>
        <?php endif; ?>

        <div class="connexion">
          Bienvenue <?= htmlspecialchars($_SESSION['nom'] ?? 'Utilisateur') ?>
          <a href="/connexion/deconnexion">Déconnexion</a>
        </div>

      <?php else: ?>
        <div class="connexion">
          <a href="/connexion">Connexion</a>
          <a href="/connexion/inscription">Inscription</a>
        </div>
      <?php endif; ?>
    </div> 

    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
      <i class="fa fa-bars"></i>
    </a>
  </div> 
</header>
