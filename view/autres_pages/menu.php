<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['role']= 'admin';
$_SESSION['id'] = 1; // Simuler un utilisateur connecté pour l'exemple
$_SESSION['nom'] = 'John Doe'; // Simuler un nom d'utilisateur pour l'exemple


?>
<header>
    <div class="topnav">
        <a href="/" class="active"><img src="/view/assets/logoevent.svg" alt="Logo de l'event" id="logo"></a>
        <img src="/view/assets/typo.svg" alt="Titre de l'event" id="typo">
        <div id="liens">
            <!-- Liens toujours visibles -->
            <a href="/">ACCUEIL</a>
            <a href="/concept">CONCEPT</a>
            <a href="/infos">INFOS PRATIQUES</a>
            
            <?php if (isset($_SESSION['id'])) : ?>
                <!-- Liens pour utilisateurs connectés -->
                <a href="/messagerie">MESSAGERIE</a>
                
                <!-- Liens admin (si applicable) -->
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <a href="/admin">ADMIN</a>
                <?php endif; ?>
                
                <div class="connexion">
                  <a href="/profil" class="profile-link">Bienvenue <?= htmlspecialchars($_SESSION['nom'] ?? 'Utilisateur') ?></a>
                  <a href="/connexion/deconnexion" class="logout-link">DÉCONNEXION</a>
                </div>
            <?php else: ?>
                <!-- Liens pour utilisateurs non connectés -->
                <div class="connexion">
                    <a href="/connexion">CONNEXION</a>
                    <a href="/connexion/inscription">INSCRIPTION</a>
                </div>
            <?php endif; ?>
            
            <div class="langue">FR</div>
        </div>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</header>