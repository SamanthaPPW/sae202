<?php
if (!isset($_GET['creneau_id'])) {
    die("Aucun créneau sélectionné.");
}
$creneau_id = $_GET['creneau_id'];
?>

<h1>Formulaire de paiement</h1>
<form method="post" action="/paiement/valider">
    <input type="hidden" name="creneau_id" value="<?= $creneau_id ?>">
    
    <label>Nom complet :</label>
    <input type="text" name="nom" required><br>

    <label>Numéro de carte :</label>
    <input type="text" name="carte" required><br>

    <label>Date d'expiration :</label>
    <input type="month" name="expiration" required><br>

    <label>Cryptogramme :</label>
    <input type="text" name="code_securite" required><br>

    <button type="submit">Payer et réserver</button>
</form>
