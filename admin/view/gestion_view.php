<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<title>Back Office - Liste des utilisateurs</title>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #2c2c2c 0%, #1a1a1a 100%);
    margin: 0;
    padding: 40px;
    color: #eaeaea;
}

h1 {
    text-align: center;
    font-weight: 500;
    font-size: 32px;
    margin-bottom: 30px;
}

a {
    display: inline-block;
    background-color: #e63946;
    color: white;
    padding: 10px 18px;
    text-decoration: none;
    border-radius: 6px;
    margin-bottom: 20px;
    float: right;
    transition: background-color 0.3s ease;
}

a:hover {
    background-color: #0f9f77;
}

.filter-tabs {
    margin-bottom: 20px;
    clear: both;
}

.filter-tabs a {
    margin-right: 10px;
    padding: 6px 12px;
    border-radius: 6px;
    background-color: #333;
    color: #eaeaea;
    text-decoration: none;
    font-size: 14px;
}

.filter-tabs a.active {
    background-color: #e63946;
    font-weight: bold;
}

.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
    clear: both;
}

.stat-card {
    background-color: #1f1f1f;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
    text-align: center;
}

.stat-number {
    font-size: 28px;
    font-weight: bold;
    color: #e63946;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 14px;
    color: #aaa;
}

.recent-users-section h2 {
    font-size: 20px;
    margin-bottom: 15px;
    color: #eaeaea;
}

.recent-users-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
}

.recent-user-card {
    background-color: #2a2a2a;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-left: 4px solid #e63946;
}

.user-info strong {
    display: block;
    color: #fff;
    margin-bottom: 3px;
}

.user-info small {
    color: #bbb;
    font-size: 12px;
}

.user-time {
    background-color: #444;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 12px;
    color: #e63946;
    font-weight: bold;
}

.table-container {
    background-color: #1e1e1e;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 15px;
    color: #eaeaea;
}

thead {
    background-color: #111;
    color: #e63946;
}

th, td {
    text-align: left;
    padding: 14px 16px;
    border-bottom: 1px solid #333;
}

tbody tr:hover {
    background-color: #292929;
}

tbody tr:last-child td {
    border-bottom: none;
}

/* Styles pour les boutons d'action */
.action-buttons {
    display: flex;
    gap: 8px;
}

.btn-edit {
    background-color: #28a745;
    color: white;
    padding: 6px 12px;
    text-decoration: none;
    border-radius: 4px;
    font-size: 12px;
    transition: background-color 0.3s ease;
    margin: 0;
    float: none;
    display: inline-block;
}

.btn-edit:hover {
    background-color: #218838;
}

.btn-delete {
    background-color: #dc3545;
    color: white;
    padding: 6px 12px;
    text-decoration: none;
    border-radius: 4px;
    font-size: 12px;
    transition: background-color 0.3s ease;
    margin: 0;
    float: none;
    display: inline-block;
}

.btn-delete:hover {
    background-color: #c82333;
}
</style>
</head>
<body>
<?php
$period = $period ?? 'today';
$users = $users ?? [];
$recent_users = $recent_users ?? [];
$stats = $stats ?? [];
?>

<h1>Gestion des utilisateurs</h1>
<a href="index.php?action=logout" style="background-color: #333;">Déconnexion</a>
<a href="index.php?action=addUser">Ajouter un utilisateur</a>

<div class="filter-tabs">
    <a href="?period=today" class="<?= $period === 'today' ? 'active' : '' ?>">Aujourd'hui</a>
    <a href="?period=week" class="<?= $period === 'week' ? 'active' : '' ?>">Cette semaine</a>
    <a href="?period=month" class="<?= $period === 'month' ? 'active' : '' ?>">Ce mois</a>
</div>

<div class="stats-container">
    <div class="stat-card">
        <div class="stat-number"><?= $stats['total_users'] ?? 0 ?></div>
        <div class="stat-label">Total utilisateurs</div>
    </div>
    <div class="stat-card">
        <div class="stat-number"><?= $stats['monthly_registrations'] ?? 0 ?></div>
        <div class="stat-label">Ce mois</div>
    </div>
    <div class="stat-card">
        <div class="stat-number"><?= $stats['weekly_registrations'] ?? 0 ?></div>
        <div class="stat-label">Cette semaine</div>
    </div>
    <div class="stat-card">
        <div class="stat-number"><?= $stats['today_registrations'] ?? 0 ?></div>
        <div class="stat-label">Aujourd'hui</div>
    </div>
</div>

<?php if (!empty($recent_users)): ?>
<div class="recent-users-section">
    <?php
    $label = match ($period) {
        'today' => "aujourd'hui",
        'week' => "cette semaine",
        'month' => "ce mois",
        default => "",
    };
    ?>
    <h2>Utilisateurs créés <?= $label ?></h2>
    <div class="recent-users-container">
        <?php foreach($recent_users as $user): ?>
        <div class="recent-user-card">
            <div class="user-info">
                <strong><?= htmlspecialchars($user['prenom']) ?> <?= htmlspecialchars($user['nom']) ?></strong>
                <small><?= htmlspecialchars($user['email']) ?></small>
            </div>
            <div class="user-time">
                <?= date('H:i', strtotime($user['date_inscription'])) ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<div class="table-container">
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Date inscription</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['nom']) ?></td>
            <td><?= htmlspecialchars($user['prenom']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['telephone']) ?></td>
            <td><?= htmlspecialchars($user['date_inscription']) ?></td>
            <td>
                <div class="action-buttons">
                    <a href="index.php?action=editUser&id=<?= $user['id'] ?>" class="btn-edit">Modifier</a>
                    <a href="index.php?action=deleteUser&id=<?= $user['id'] ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
// Confirmation avant suppression
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.')) {
                e.preventDefault();
            }
        });
    });
});
</script>

</body>
</html>