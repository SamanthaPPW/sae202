<div class="contenu">
    <h1>Inscription</h1>
    <form method="post" action="/connexion/inscription">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">S'inscrire</button>
    </form>

    <?php if (isset($error_message)) : ?>
        <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>

    <p>Déjà inscrit ? <a href="/connexion">Connectez-vous ici</a>.</p>
</div>