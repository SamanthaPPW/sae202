<div class="grid-inscription">
    <div class="img-inscription">
        <img src="/view/assets/800x924 1.png" alt="Image d'inscription">
    </div>
    <div class="contenu">
        <h1>Inscription</h1>
        <form method="post" action="/connexion/validation_inscription">
            <input type="text" id="nom" name="nom" placeholder="Nom" required>
            <input type="text" id="prenom" name="prenom" placeholder="Adresse mail" required>
            <input type="email" id="email" name="email" placeholder="Mot de Passe" required>
            <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
            <div class="checkbox-container">
                <input type="checkbox" id="conditions" name="conditions" required>
                <label for="conditions">J'accepte les politiques de confidentialité</label>
            </div>
            <button type="submit">S'inscrire</button>
        </form>
        
        <!-- Gestion des erreurs -->
        <?php if (!empty($error_message)) : ?>
            <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        
        <!-- Gestion des succès -->
        <?php if (!empty($success_message)) : ?>
            <p class="success"><?php echo htmlspecialchars($success_message); ?></p>
        <?php endif; ?>
        
        <p>Vous êtes déjà un compte ? <a href="/connexion">Connectez</a></p>
    </div>
</div>