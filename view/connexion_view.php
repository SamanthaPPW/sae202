<!--Il faut un placeholder sur chaque onglets-->

<div class="contenu">
    <h1>Connexion</h1>
    <form method="post" action="/connexion/verif_connexion">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Se connecter</button>
    </form>

    <?php if (!empty($error_message)) : ?>
    <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
<?php endif; ?>

<?php if (!empty($success_message)) : ?>
    <p class="success"><?php echo htmlspecialchars($success_message); ?></p>
<?php endif; ?>

    
    <p>Pas encore inscrit ? <a href="/connexion/inscription">Inscrivez-vous ici</a>.</p>
</div>