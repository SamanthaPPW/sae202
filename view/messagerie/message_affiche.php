<div class="contenu">
    <?php
    echo '<h2>Objet : ' . htmlspecialchars($messageR['message_sujet']) . '</h2>';
    echo '<h2>Expéditeur : ' . htmlspecialchars($messageR['message_expediteur_id']) . '</h2>';
    echo '<h2>Destinataire : ' . htmlspecialchars($messageR['message_destinataire_id']) . '</h2>';
    echo '<h4>Message : ' . nl2br(htmlspecialchars($messageR['message_text'])) . '</h4>';
    echo '<h4>Date d\'envoi : ' . htmlspecialchars($messageR['message_date_envoi']) . '</h4>';
    echo '<a href="/messagerie">Retour à la liste des messages</a>';
    ?>
</div>
