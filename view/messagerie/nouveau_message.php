<div id="contenu">
    <h1> Nouveau message </h1>
    <p> Voici le formulaire pour envoyer un nouveau message : </p>
<form method="post" action="/messagerie/envoyer_message">
    <label for="destinataire">Destinataire :</label>
    <select name="message_destinataire_id">
        <?php foreach ($users as $utilisateur): ?>
            <option value="<?= $utilisateur['user_id'] ?>">
            <?= htmlspecialchars($utilisateur['user_nom'] . ' ' . $utilisateur['user_prenom']) ?>

            </option>
        <?php endforeach; ?>
    </select>
    <label for="sujet">Sujet :</label>
    <input type="text" name="message_sujet" required>
    <label for="message">Message :</label>
    <textarea name="message_text" required></textarea>
    <input type="submit" value="Envoyer">
</form>
</div>