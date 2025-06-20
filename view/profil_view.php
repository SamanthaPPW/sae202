<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil <?php echo htmlspecialchars($user['role'] ?? 'Utilisateur'); ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .profile-container {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .profile-container:hover {
            transform: translateY(-5px);
        }

        .profile-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 20"><defs><radialGradient id="a" cx="50%" cy="40%"><stop offset="0%" style="stop-color:white;stop-opacity:0.1"/><stop offset="100%" style="stop-color:white;stop-opacity:0"/></radialGradient></defs><rect width="100" height="20" fill="url(%23a)"/></svg>');
            opacity: 0.3;
        }

        .profile-name {
            font-size: 2.2em;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .admin-badge, .user-badge {
            display: inline-flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.9em;
            font-weight: 600;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            z-index: 1;
        }

        .admin-badge::before {
            content: '👑';
            margin-right: 8px;
            font-size: 1.2em;
        }

        .user-badge::before {
            content: '👤';
            margin-right: 8px;
            font-size: 1.2em;
        }

        .profile-content {
            padding: 40px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .info-card {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 25px;
            border-radius: 15px;
            border-left: 4px solid #4f46e5;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateX(5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .info-card h3 {
            color: #1e293b;
            font-size: 1.1em;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .info-card h3::before {
            content: '📋';
            margin-right: 10px;
            font-size: 1.2em;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #475569;
        }

        .info-value {
            color: #1e293b;
            font-weight: 500;
        }

        .email-value {
            color: #4f46e5;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .email-value:hover {
            color: #7c3aed;
        }

        .actions-section {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95em;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .btn-logout {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }

        .btn::before {
            margin-right: 8px;
            font-size: 1.1em;
        }

        .btn-primary::before {
            content: '✏️';
        }

        .btn-secondary::before {
            content: '💬';
        }

        .btn-logout::before {
            content: '🚪';
        }

        .admin-panel {
            background: linear-gradient(135deg, #fef3c7 0%, #f59e0b 20%, #d97706 100%);
            padding: 25px;
            border-radius: 15px;
            border: 1px solid #f59e0b;
            position: relative;
            overflow: hidden;
            display: <?php echo (isset($user['role']) && $user['role'] === 'admin') ? 'block' : 'none'; ?>;
        }

        .admin-panel::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%, 100% { transform: rotate(0deg); }
            50% { transform: rotate(180deg); }
        }

        .admin-panel h3 {
            color: #92400e;
            font-size: 1.2em;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .admin-panel h3::before {
            content: '⚙️';
            margin-right: 10px;
            font-size: 1.3em;
        }

        .admin-panel p {
            color: #78350f;
            line-height: 1.6;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .admin-access-btn {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
            position: relative;
            z-index: 1;
            text-decoration: none;
        }

        .admin-access-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.4);
        }

        .admin-access-btn::before {
            content: '🔐';
            margin-right: 8px;
            font-size: 1.1em;
        }

        @media (max-width: 768px) {
            .profile-container {
                margin: 10px;
            }
            
            .profile-content {
                padding: 20px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .actions-section {
                flex-direction: column;
            }
            
            .btn {
                text-align: center;
                justify-content: center;
            }
        }
    </style>
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
                    <p style="margin-top: 15px; color: #64748b; line-height: 1.6;">
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