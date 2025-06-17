<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Profil utilisateur</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .profile-container {
        max-width: 800px;
        margin: 40px auto;
    }
  </style>
</head>
<body>
  <div class="profile-container">
    <div class="card">
      <div class="card-body text-center">
        <img src="https://via.placeholder.com/150" class="rounded-circle mb-3" width="150" height="150" alt="avatar">
        <h3><?= htmlspecialchars($user['prenom']) ?> <?= htmlspecialchars($user['nom']) ?></h3>
        <p>Email : <?= htmlspecialchars($user['email']) ?></p>
        <p>Téléphone : <?= htmlspecialchars($user['telephone']) ?></p>
        <a href="index.php?action=editProfil" class="btn btn-primary">Modifier mes infos</a>
      </div>
    </div>
  </div>
</body>
</html>
