<div class="contenu">
    <h1>Inscription</h1>
    <form method="post" action="/connexion/validation_inscription">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" placeholder="Entrez votre nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" placeholder="exemple@mail.com" required>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>

        <button type="submit">S'inscrire</button>
    </form>

    <?php if (!empty($error_message)) : ?>
        <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>

    <?php if (!empty($success_message)) : ?>
        <p class="success"><?php echo htmlspecialchars($success_message); ?></p>
    <?php endif; ?>

    <p>Déjà inscrit ? <a href="/connexion">Connectez-vous ici</a>.</p>
</div>
