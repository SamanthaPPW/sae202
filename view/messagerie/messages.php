<div class="contenu">
<?php if (isset($_SESSION['message'])): ?>
  <p style="color: green; font-weight: bold;"><?= $_SESSION['message'] ?></p>
  <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<h1> Messagerie </h1>
<a href="/messagerie/nouveau_message">Envoyer un nouveau message</a>

<!-- Tableau des messages reçus -->
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

<!-- Tableau des messages envoyés -->
<h2>Messages envoyés</h2>
<table>
    <thead>
        <tr>
            <th>Destinataire</th>
            <th>Sujet</th>
            <th>Date</th>
            <th>Afficher</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($messagesE as $message): ?>
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
</div>
