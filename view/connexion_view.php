<div class="contenu">
    <h1>Connexion</h1>
    <form method="post" action="/connexion/verif_connexion">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Se connecter</button>
    </form>

    <?php 
    if (!empty($error_message)) {
        echo '<p class="error">' . htmlspecialchars($error_message) . '</p>';
    }
    if (!empty($success_message)) {
        echo '<p class="success">' . htmlspecialchars($success_message) . '</p>';
    }
    if (isset($_GET['error']) && $_GET['error'] === 'account_not_confirmed') {
        echo '<p class="error">Votre compte n\'a pas encore été confirmé. Vérifiez votre email.</p>';
    }
    ?>
    
    <p>Pas encore inscrit ? <a href="/connexion/inscription">Inscrivez-vous ici</a>.</p>
</div>
