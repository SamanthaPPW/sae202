<div class="contenu messagerie">
<?php if (isset($_SESSION['message'])): ?>
  <p style="color: green; font-weight: bold;"><?= $_SESSION['message'] ?></p>
  <?php unset($_SESSION['message']); ?>
<?php endif; ?>
<section id="nouv">
    <h1> Nouveau message </h1>
<form method="post" action="/messagerie/envoyer_message">
    <label for="destinataire">Destinataire :</label>
    <select name="message_destinataire_id" class="rect1" >
        <option value="" disabled selected>Choisissez l'admin à qui envoyer un message</option>
        <?php foreach ($users as $utilisateur): ?>
            <option value="<?= $utilisateur['id'] ?>">
            <?= htmlspecialchars($utilisateur['nom'] . ' ' . $utilisateur['prenom'])?>

            </option>
        <?php endforeach; ?>
    </select>
    <label for="sujet">Objet du message :</label>
    <input type="text" name="message_sujet" required class="rect1" placeholder="Objet du message :">
    <label for="message">Message :</label>
    <textarea class ="rect2" 
    name="message_text" required placeholder="Votre message"></textarea>
    <input type="submit" value="Envoyer" id="env">
</form>
</section>
<section id="list">
<h2>Messages reçus</h2>
<table>
    <thead>
        <tr>
            <th>Expéditeur</th>
            <th>Sujet</th>
            <th>Date</th>
            <th>Afficher</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($messagesR as $message): ?>
            <tr>
                <td><?php echo $message['prenom'] . ' ' . $message['nom']; ?></td>
                <td><?= htmlspecialchars($message['message_sujet']) ?></td>
                <td><?= htmlspecialchars($message['message_date_envoi']) ?></td>
                <td><a href="/messagerie/afficher_message?id=<?= $message['message_id'] ?>">Afficher</a></td>
                <td><a href="/messagerie/supprimer_message?id=<?= $message['message_id'] ?>">Supprimer</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</section>
</div>