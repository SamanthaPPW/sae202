  <div class="contenu">

  <?php if (isset($_SESSION['message'])): ?>
      <p style="color: green"><?= $_SESSION['message'] ?></p>
      <?php unset($_SESSION['message']); ?>
  <?php endif; ?>

  <table>
      <thead>
          <tr>
              <th>Date</th>
              <th>Statut</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
          <?php foreach ($creneaux as $creneau): ?>
              <tr>
                  <td><?= htmlspecialchars($creneau['date_creneau']) ?></td>
                  <td><?= $creneau['est_reserve'] ? 'Réservé' : 'Disponible' ?></td>
                  <td>
                      <?php if (!$creneau['est_reserve']): ?>
                        <form method="get" action="/reservation/formulaire_achat">
                          <input type="hidden" name="creneau_id" value="<?= $creneau['id'] ?>">
  <button type="submit">Réserver</button>
</form>

                          </form>
                      <?php else: ?>
                          -
                      <?php endif; ?>
                  </td>
              </tr>
          <?php endforeach; ?>
      </tbody>
  </table>
  </div>
