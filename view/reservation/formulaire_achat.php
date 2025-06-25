<?php

if (!isset($_GET['creneau_id'])) {
    die("Aucun créneau sélectionné.");
}
$creneau_id = $_GET['creneau_id'];

require_once __DIR__ . '/../../model/reservation_model.php'; 

$creneau = getCreneauById($creneau_id);
if (!$creneau) {
    die("Créneau invalide.");
}
?>
<div class="contenu">
<h1>Formulaire de paiement</h1>
<form method="post" action="/reservation/valider">
    <input type="hidden" name="creneau_id" value="<?= htmlspecialchars($creneau_id) ?>">
    
    <p>Nom complet : <?= htmlspecialchars($_SESSION['nom'] ?? '') ?></p>
    
    <br> Ce n'est pas vous ? <a href="/connexion/deconnexion">Se déconnecter</a><br>

    <label>Nom sur la carte :</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($_SESSION['nom'] ?? '') ?>" required><br>

    <label>Numéro de carte :</label>
    <input type="text" name="carte" required><br>

    <label>Date d'expiration :</label>
    <input type="month" name="expiration" required><br>

    <label>Cryptogramme :</label>
    <input type="text" name="code_securite" required><br>

    <label>Nombre de participants :</label>
    <select name="nombre_participants" required>
        <?php
        $maxParticipants = 20 - $creneau['nb_reservations']; 
        $maxParticipants = max($maxParticipants, 1); 
            for ($i = 1; $i <= $maxParticipants; $i++): ?>
            <option value="<?= $i ?>"><?= $i ?></option>
        <?php endfor; ?>
    </select><br>

    <p>Le créneau sélectionné est le <?= htmlspecialchars($creneau['date_creneau']) ?>.</p>
    <p>Le prix est de 39€ par participant, passant à 33€ pour un groupe de 16.</p>
    <p>Prix total : <span id="prix_total"></span></p>

    <button type="submit">Payer et réserver</button><button type="button" onclick="window.location.href='/reservation/agenda'">Annuler</button>
</form> 
</div>

