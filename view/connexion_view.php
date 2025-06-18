<div class="contenu">
    <h1>Connexion</h1>
    <form method="post" action="/connexion">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Se connecter</button>
    </form>

    <?php if (isset($error_message)) : ?>
        <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
    <?php var_dump($_SESSION); endif; ?>
    
    <p>Pas encore inscrit ? <a href="/connexion/inscription">Inscrivez-vous ici</a>.</p>
</div>