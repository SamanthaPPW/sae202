<?php
require_once('../model/db.php');

$query = "SELECT id, nom, prenom, email, telephone, date_inscription FROM utilisateurs";
$result = $pdo->query($query);

echo "<h2>Liste des utilisateurs</h2>";
echo "<table border='1'>
<tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Téléphone</th><th>Date inscription</th></tr>";

while ($user = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>".$user['id']."</td>";
    echo "<td>".$user['nom']."</td>";
    echo "<td>".$user['prenom']."</td>";
    echo "<td>".$user['email']."</td>";
    echo "<td>".$user['telephone']."</td>";
    echo "<td>".$user['date_inscription']."</td>";
    echo "</tr>";
}
echo "</table>";
?>
