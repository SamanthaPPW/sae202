
<div class="grid-inscription">
    <div class="img-inscription">
        <img src="/view/assets/800x924.png" alt="Image d'inscription">
    </div>
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
if (isset($_GET['success']) && $_GET['success'] === 'account_confirmed') {
    echo '<p class="success">Votre compte a été confirmé avec succès, vous pouvez maintenant vous connecter.</p>';
}
?>
    <p>Pas encore inscrit ? <a href="/connexion/inscription">Inscrivez-vous ici</a>.</p>
</div>
</div>
