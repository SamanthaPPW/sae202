<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Connexion Administrateur</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #2c2c2c 0%, #1a1a1a 100%);
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #eaeaea;
        }

        .login-container {
            background-color: #1f1f1f;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            font-weight: 500;
            font-size: 26px;
            margin-bottom: 25px;
            color: #eaeaea;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 18px;
            font-size: 14px;
            color: #ccc;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #444;
            border-radius: 6px;
            font-size: 14px;
            margin-top: 6px;
            background-color: #2a2a2a;
            color: #fff;
        }

        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: #888;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #e63946;
        }

        button {
            padding: 12px;
            background-color: #e63946;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #c62832;
        }

        .error {
            color: #e63946;
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Connexion administrateur</h1>
        <?php if (!empty($error)) : ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form action="index.php?action=doLogin" method="post">
            <label>Email :
                <input type="email" name="email" placeholder="Votre email" required>
            </label>
            <label>Mot de passe :
                <input type="password" name="password" placeholder="Votre mot de passe" required>
            </label>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
