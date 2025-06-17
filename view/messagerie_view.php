<form action="index.php?action=envoyerMessage" method="post">
  <div class="form-group">
    <label for="message">Message à l'administrateur :</label>
    <textarea name="message" class="form-control" id="message" required></textarea>
  </div>
  <button type="submit" class="btn btn-primary mt-2">Envoyer</button>
</form>

<hr>

<h5>Vos anciens messages</h5>
<ul class="list-group">
  <?php foreach ($messages as $msg): ?>
    <li class="list-group-item"><?= htmlspecialchars($msg['contenu']) ?> <br><small><?= $msg['date_envoi'] ?></small></li>
  <?php endforeach; ?>
</ul>
