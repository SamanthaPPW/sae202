<h2>Proposer un commentaire</h2>

<?php
if (isset($_SESSION['message'])) {
    echo '<p style="color:green;">' . htmlspecialchars($_SESSION['message']) . '</p>';
    unset($_SESSION['message']);
}
if (isset($_SESSION['error'])) {
    echo '<p style="color:red;">' . htmlspecialchars($_SESSION['error']) . '</p>';
    unset($_SESSION['error']);
}
?>

<form action="/commentaire/envoyer" method="post">
    <textarea name="commentaire_text" rows="5" cols="50" placeholder="Votre commentaire..." required></textarea><br>
    <button type="submit">Envoyer</button>
</form>

<hr>

<h2>Commentaires</h2>

<?php if (!empty($commentaires)): ?>
    <ul>
    <?php foreach ($commentaires as $commentaire): ?>
        <li>
            <strong><?= htmlspecialchars($commentaire['user_name']) ?></strong> 
            (<?= htmlspecialchars($commentaire['date_posted']) ?>) :
            <p><?= nl2br(htmlspecialchars($commentaire['comment_text'])) ?></p>
        </li>
    <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun commentaire approuvé pour le moment.</p>
<?php endif; ?>
