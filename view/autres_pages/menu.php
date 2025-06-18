<?php session_start();?>

<header>
  <img src="/view/img/logo.png" alt="Logo de l'event" id="logo">

  <nav>
    <a href="/">Accueil</a>
    <a href="/concept">Concept</a>
    <a href="/infos">Informations</a>

    <?php if (isset($_SESSION['id'])) : ?>
      <a href="/profil">Profil</a>
      <a href="/messagerie">Messagerie</a>

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
    <?php var_dump($_SESSION);
if (isset($_SESSION['user_id'])) {
    echo "Connecté en tant que " . htmlspecialchars($_SESSION['user_nom']);
} else {
    echo "Non connecté";
}
;endif; ?>
  </nav>
</header>
