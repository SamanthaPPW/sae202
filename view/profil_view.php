<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil <?php echo htmlspecialchars($user['role'] ?? 'Utilisateur'); ?></title>
    <link rel="stylesheet" href="/view/css/style.css">
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <h1 class="profile-name">
                <?php echo htmlspecialchars($user['prenom'] . ' ' . $user['nom']); ?>
            </h1>
            <div class="<?php echo (isset($user['role']) && $user['role'] === 'admin') ? 'admin-badge' : 'user-badge'; ?>">
                <?php echo htmlspecialchars($user['role'] ?? 'utilisateur'); ?>
            </div>
        </div>
        
        <div class="profile-content">
            <div class="info-grid">
                <div class="info-card">
                    <h3>Informations du compte</h3>
                    <div class="info-item">
                        <span class="info-label">ID :</span>
                        <span class="info-value"><?php echo htmlspecialchars($user['id']); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Rôle :</span>
                        <span class="info-value"><?php echo htmlspecialchars($user['role'] ?? 'utilisateur'); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Membre depuis :</span>
                        <span class="info-value">
                            <?php 
                            if (isset($user['date_creation'])) {
                                echo date('d/m/Y', strtotime($user['date_creation']));
                            } else {
                                echo 'Non disponible';
                            }
                            ?>
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email :</span>
                        <a href="mailto:<?php echo htmlspecialchars($user['email']); ?>" class="info-value email-value">
                            <?php echo htmlspecialchars($user['email']); ?>
                        </a>
                    </div>
                    <?php if (isset($user['telephone']) && !empty($user['telephone'])): ?>
                    <div class="info-item">
                        <span class="info-label">Téléphone :</span>
                        <span class="info-value"><?php echo htmlspecialchars($user['telephone']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="info-card">
                    <h3>Informations personnelles</h3>
                    <div class="info-item">
                        <span class="info-label">Prénom :</span>
                        <span class="info-value"><?php echo htmlspecialchars($user['prenom']); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Nom :</span>
                        <span class="info-value"><?php echo htmlspecialchars($user['nom']); ?></span>
                    </div>
                    <p style="margin-top: 15px; color: #F5F5F5; line-height: 1.6; font-family: 'DM Sans', sans-serif; font-size: 16px;">
                        Bienvenue sur votre profil ! Ici vous pouvez consulter vos informations personnelles et gérer votre compte.
                    </p>
                </div>
            </div>
            
            <div class="actions-section">
                <a href="/profil/modifier" class="btn btn-primary">Modifier le profil</a>
                <a href="/messagerie" class="btn btn-secondary">Messagerie</a>
                <a href="/deconnexion/confirm" class="btn btn-logout">Se déconnecter</a>
            </div>
            
            <?php if (isset($user['role']) && $user['role'] === 'admin'): ?>
            <div class="admin-panel">
                <h3>Panneau d'administration</h3>
                <p>Vous avez accès aux fonctionnalités d'administration. Vous pouvez gérer les utilisateurs, modérer le contenu et configurer le système.</p>
                <a href="/admin" class="admin-access-btn">Accéder à l'administration</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>