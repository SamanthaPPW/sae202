<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Back Office - Liste des utilisateurs</title>
</head>
<body>
    <h1>Liste des utilisateurs</h1>
    <a href="index.php?action=logout">Déconnexion</a>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Téléphone</th><th>Date inscription</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
            <tr>
                <td><?=htmlspecialchars($user['id'])?></td>
                <td><?=htmlspecialchars($user['nom'])?></td>
                <td><?=htmlspecialchars($user['prenom'])?></td>
                <td><?=htmlspecialchars($user['email'])?></td>
                <td><?=htmlspecialchars($user['telephone'])?></td>
                <td><?=htmlspecialchars($user['date_inscription'])?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
