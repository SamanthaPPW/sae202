<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= isset($user['id']) ? 'Modifier' : 'Ajouter' ?> un utilisateur</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #0a0a0f;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            color: #e2e8f0;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 25% 25%, rgba(139, 69, 219, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(59, 130, 246, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(16, 185, 129, 0.1) 0%, transparent 50%);
            pointer-events: none;
            animation: backgroundShift 20s ease-in-out infinite;
        }

        @keyframes backgroundShift {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .container {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(30, 41, 59, 0.95) 100%);
            border: 1px solid rgba(71, 85, 105, 0.3);
            border-radius: 2rem;
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            padding: 3rem;
            width: 100%;
            max-width: 520px;
            backdrop-filter: blur(20px);
            position: relative;
            animation: slideInUp 0.8s ease-out;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #8b45db, #3b82f6, #10b981);
            border-radius: 2rem 2rem 0 0;
            animation: gradientShift 3s ease-in-out infinite;
        }

        @keyframes gradientShift {
            0%, 100% { background: linear-gradient(90deg, #8b45db, #3b82f6, #10b981); }
            33% { background: linear-gradient(90deg, #3b82f6, #10b981, #8b45db); }
            66% { background: linear-gradient(90deg, #10b981, #8b45db, #3b82f6); }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .header h1 {
            font-size: 2.25rem;
            font-weight: 700;
            background: linear-gradient(135deg, #8b45db 0%, #3b82f6 50%, #10b981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            animation: textGlow 2s ease-in-out infinite alternate;
        }

        @keyframes textGlow {
            from { filter: brightness(1); }
            to { filter: brightness(1.2); }
        }

        .header p {
            color: #94a3b8;
            font-size: 1rem;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 2rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.75rem;
            color: #cbd5e0;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: color 0.3s ease;
        }

        .form-group input {
            width: 100%;
            padding: 1.25rem 1rem;
            border: 2px solid rgba(71, 85, 105, 0.4);
            border-radius: 1rem;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(15, 23, 42, 0.8);
            color: #f1f5f9;
            backdrop-filter: blur(10px);
            position: relative;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3b82f6;
            background: rgba(15, 23, 42, 0.95);
            box-shadow: 
                0 0 0 4px rgba(59, 130, 246, 0.1),
                0 10px 25px rgba(59, 130, 246, 0.1);
            transform: translateY(-2px);
        }

        .form-group input:focus + label,
        .form-group:focus-within label {
            color: #3b82f6;
        }

        .form-group input::placeholder {
            color: #64748b;
            transition: color 0.3s ease;
        }

        .form-group input:focus::placeholder {
            color: #94a3b8;
        }

        .required {
            color: #ef4444;
            font-weight: 700;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .password-note {
            font-size: 0.75rem;
            color: #64748b;
            margin-top: 0.5rem;
            font-style: italic;
            opacity: 0.8;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            margin-top: 2.5rem;
        }

        .btn {
            flex: 1;
            padding: 1.25rem 2rem;
            border: none;
            border-radius: 1rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            text-align: center;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, #8b45db 0%, #3b82f6 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(139, 69, 219, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 35px rgba(139, 69, 219, 0.4);
        }

        .btn-primary:active {
            transform: translateY(-1px) scale(1.01);
        }

        .btn-secondary {
            background: linear-gradient(135deg, rgba(71, 85, 105, 0.8) 0%, rgba(51, 65, 85, 0.8) 100%);
            color: #e2e8f0;
            border: 1px solid rgba(71, 85, 105, 0.5);
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, rgba(71, 85, 105, 0.9) 0%, rgba(51, 65, 85, 0.9) 100%);
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .error-messages {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%);
            color: #fca5a5;
            padding: 1.25rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(239, 68, 68, 0.3);
            backdrop-filter: blur(10px);
            animation: slideInDown 0.5s ease-out;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-messages ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .error-messages li {
            margin-bottom: 0.5rem;
            position: relative;
            padding-left: 2rem;
            display: flex;
            align-items: center;
        }

        .error-messages li:before {
            content: "⚠️";
            position: absolute;
            left: 0;
            font-size: 1.125rem;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-3px); }
            75% { transform: translateX(3px); }
        }

        .error-messages li:last-child {
            margin-bottom: 0;
        }

        .form-group {
            position: relative;
        }

        .form-group::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #8b45db, #3b82f6);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .form-group:focus-within::after {
            width: 100%;
        }

        @media (max-width: 600px) {
            .container {
                padding: 2rem;
                margin: 1rem;
            }
            
            .btn-group {
                flex-direction: column;
            }
            
            .header h1 {
                font-size: 1.875rem;
            }

            body {
                padding: 1rem;
            }
        }

        .btn.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .btn.loading::after {
            content: '';
            position: absolute;
            width: 1rem;
            height: 1rem;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
        }

        @keyframes spin {
            0% { transform: translateY(-50%) rotate(0deg); }
            100% { transform: translateY(-50%) rotate(360deg); }
        }

        .form-group input:valid:not(:placeholder-shown) {
            border-color: #10b981;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.1);
        }

        .form-group input:invalid:not(:placeholder-shown):not(:focus) {
            border-color: #ef4444;
            box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><?= isset($user['id']) ? 'Modifier l\'utilisateur' : 'Ajouter un utilisateur' ?></h1>
            <p><?= isset($user['id']) ? 'Modifiez les informations de l\'utilisateur' : 'Remplissez les informations pour créer un nouvel utilisateur' ?></p>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="error-messages">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= isset($user['id']) ? 'index.php?action=editUser&id=' . $user['id'] : 'index.php?action=addUser' ?>">
            <div class="form-group">
                <label for="nom">Nom <span class="required">*</span></label>
                <input 
                    type="text" 
                    id="nom" 
                    name="nom" 
                    value="<?= htmlspecialchars($user['nom'] ?? '') ?>" 
                    placeholder="Entrez le nom"
                    required
                >
            </div>

            <div class="form-group">
                <label for="prenom">Prénom <span class="required">*</span></label>
                <input 
                    type="text" 
                    id="prenom" 
                    name="prenom" 
                    value="<?= htmlspecialchars($user['prenom'] ?? '') ?>" 
                    placeholder="Entrez le prénom"
                    required
                >
            </div>

            <div class="form-group">
                <label for="email">Email <span class="required">*</span></label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="<?= htmlspecialchars($user['email'] ?? '') ?>" 
                    placeholder="exemple@email.com"
                    required
                >
            </div>

            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input 
                    type="tel" 
                    id="telephone" 
                    name="telephone" 
                    value="<?= htmlspecialchars($user['telephone'] ?? '') ?>" 
                    placeholder="06 12 34 56 78"
                >
            </div>

            <div class="form-group">
                <label for="mot_de_passe">
                    Mot de passe 
                    <?php if (isset($user['id'])): ?>
                        (laisser vide pour ne pas modifier)
                    <?php else: ?>
                        <span class="required">*</span>
                    <?php endif; ?>
                </label>
                <input 
                    type="password" 
                    id="mot_de_passe" 
                    name="mot_de_passe" 
                    placeholder="Entrez le mot de passe"
                    <?= !isset($user['id']) ? 'required' : '' ?>
                >
                <div class="password-note">
                    Le mot de passe doit contenir au moins 6 caractères
                </div>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">
                    <?= isset($user['id']) ? '✏️ Modifier' : '➕ Ajouter' ?>
                </button>
                <a href="index.php?action=index" class="btn btn-secondary">
                    ❌ Annuler
                </a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                
                input.addEventListener('blur', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            const form = document.querySelector('form');
            const submitBtn = document.querySelector('.btn-primary');
            
            form.addEventListener('submit', function() {
                submitBtn.classList.add('loading');
                submitBtn.innerHTML = submitBtn.innerHTML.includes('Modifier') ? 
                    '⏳ Modification...' : '⏳ Ajout...';
            });
        });
    </script>
</body>
</html>