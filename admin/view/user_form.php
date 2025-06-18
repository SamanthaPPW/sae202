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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #222 0%, #555 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #eee;
        }

        .container {
            background: #111;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.8);
            padding: 40px;
            width: 100%;
            max-width: 500px;
            backdrop-filter: blur(10px);
            color: #ddd;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #eee;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .header p {
            color: #bbb;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #eee;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 15px;
            border: 2px solid #666;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #222;
            color: #eee;
        }

        .form-group input:focus {
            outline: none;
            border-color: #e94e77;
            background: #111;
            box-shadow: 0 0 0 3px rgba(233, 78, 119, 0.3);
        }

        .form-group input::placeholder {
            color: #888;
        }

        .required {
            color: #e94e77;
        }

        .password-note {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
            font-style: italic;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 15px 25px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            display: inline-block;
            color: #eee;
        }

        .btn-primary {
            background: linear-gradient(135deg, #e94e77 0%, #c5305d 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(233, 78, 119, 0.5);
        }

        .btn-secondary {
            background: #555;
            color: white;
        }

        .btn-secondary:hover {
            background: #444;
            transform: translateY(-2px);
        }

        .error-messages {
            background: #3a1e24;
            color: #f08080;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            border: 1px solid #f08080;
        }

        .error-messages ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .error-messages li {
            margin-bottom: 5px;
            position: relative;
            padding-left: 20px;
        }

        .error-messages li:before {
            content: "⚠️";
            position: absolute;
            left: 0;
        }

        .error-messages li:last-child {
            margin-bottom: 0;
        }

        @media (max-width: 480px) {
            .container {
                padding: 25px;
            }
            
            .btn-group {
                flex-direction: column;
            }
            
            .header h1 {
                font-size: 24px;
            }
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
</body>
</html>
