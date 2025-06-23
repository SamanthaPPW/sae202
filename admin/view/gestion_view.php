<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<title>Dashboard - Gestion des utilisateurs</title>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: #0f0f23;
    color: #e2e8f0;
    line-height: 1.6;
}
.sidebar {
    position: fixed;
    left: 0;
    top: 0;
    width: 280px;
    height: 100vh;
    background: linear-gradient(180deg, #1e1e3f 0%, #16213e 100%);
    padding: 2rem 0;
    border-right: 1px solid #2d3748;
    z-index: 1000;
}

.sidebar-header {
    padding: 0 2rem 2rem;
    border-bottom: 1px solid #2d3748;
    margin-bottom: 2rem;
}

.sidebar-header h1 {
    font-size: 1.5rem;
    font-weight: 700;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.nav-menu {
    list-style: none;
    padding: 0 1rem;
}

.nav-item {
    margin-bottom: 0.5rem;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    color: #cbd5e0;
    text-decoration: none;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    font-weight: 500;
}

.nav-link:hover, .nav-link.active {
    background: rgba(102, 126, 234, 0.1);
    color: #667eea;
    transform: translateX(4px);
}

.nav-icon {
    width: 20px;
    height: 20px;
    margin-right: 0.75rem;
    fill: currentColor;
}

.main-content {
    margin-left: 280px;
    min-height: 100vh;
    background: #0f0f23;
}

.header {
    background: rgba(30, 30, 63, 0.8);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid #2d3748;
    padding: 1rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 100;
}

.header-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #f7fafc;
}

.header-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.btn {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 0.5rem;
    text-decoration: none;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
}

.btn-secondary {
    background: #2d3748;
    color: #cbd5e0;
    border: 1px solid #4a5568;
}

.btn-secondary:hover {
    background: #4a5568;
    color: #f7fafc;
}

.dashboard-content {
    padding: 2rem;
}

.filter-section {
    margin-bottom: 2rem;
}

.filter-tabs {
    display: flex;
    gap: 0.5rem;
    background: #1a202c;
    padding: 0.5rem;
    border-radius: 0.75rem;
    border: 1px solid #2d3748;
    width: fit-content;
}

.filter-tab {
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    text-decoration: none;
    color: #a0aec0;
    font-weight: 500;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.filter-tab.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.filter-tab:hover:not(.active) {
    background: #2d3748;
    color: #e2e8f0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
    border: 1px solid #4a5568;
    border-radius: 1rem;
    padding: 1.5rem;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    border-color: #667eea;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #667eea, #764ba2);
}

.stat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.stat-icon {
    width: 40px;
    height: 40px;
    background: rgba(102, 126, 234, 0.1);
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #667eea;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: #f7fafc;
    margin-bottom: 0.25rem;
}

.stat-label {
    color: #a0aec0;
    font-size: 0.875rem;
    font-weight: 500;
}

.recent-users-section {
    margin-bottom: 2rem;
}

.section-header {
    display: flex;
    justify-content: between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #f7fafc;
}

.recent-users-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 1rem;
    margin-bottom: 1rem;
}

.user-card {
    background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
    border: 1px solid #4a5568;
    border-radius: 0.75rem;
    padding: 1rem;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.user-card::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
    background: linear-gradient(180deg, #667eea, #764ba2);
}

.user-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    border-color: #667eea;
}

.user-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.user-details strong {
    display: block;
    color: #f7fafc;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.user-details small {
    color: #a0aec0;
    font-size: 0.875rem;
}

.user-time {
    background: rgba(102, 126, 234, 0.1);
    color: #667eea;
    padding: 0.25rem 0.75rem;
    border-radius: 0.5rem;
    font-size: 0.75rem;
    font-weight: 600;
}

.table-section {
    background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
    border: 1px solid #4a5568;
    border-radius: 1rem;
    overflow: hidden;
}

.table-header {
    padding: 1.5rem;
    border-bottom: 1px solid #4a5568;
    display: flex;
    justify-content: between;
    align-items: center;
}

.table-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: #f7fafc;
}

.table-container {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background: #16213e;
}

th {
    padding: 1rem 1.5rem;
    text-align: left;
    font-weight: 600;
    color: #cbd5e0;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 1px solid #4a5568;
}

td {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #2d3748;
    color: #e2e8f0;
}

tbody tr {
    transition: all 0.2s ease;
}

tbody tr:hover {
    background: rgba(102, 126, 234, 0.05);
}

tbody tr:last-child td {
    border-bottom: none;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.75rem;
    border-radius: 0.375rem;
}

.btn-edit {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: white;
}

.btn-edit:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(72, 187, 120, 0.3);
}

.btn-delete {
    background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
    color: white;
}

.btn-delete:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(245, 101, 101, 0.3);
}

@media (max-width: 1024px) {
    .sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    
    .main-content {
        margin-left: 0;
    }
    
    .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
    
    .recent-users-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .dashboard-content {
        padding: 1rem;
    }
    
    .header {
        padding: 1rem;
    }
    
    .header-actions {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .filter-tabs {
        flex-wrap: wrap;
        width: 100%;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.stat-card, .user-card, .table-section {
    animation: fadeInUp 0.6s ease-out;
}

.stat-card:nth-child(2) { animation-delay: 0.1s; }
.stat-card:nth-child(3) { animation-delay: 0.2s; }
.stat-card:nth-child(4) { animation-delay: 0.3s; }
</style>
</head>
<body>
<?php
$period = $period ?? 'today';
$users = $users ?? [];
$recent_users = $recent_users ?? [];
$stats = $stats ?? [];
?>

<aside class="sidebar">
    <div class="sidebar-header">
        <h1>Dashboard</h1>
    </div>
    <nav>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="#" class="nav-link active">
                    <svg class="nav-icon" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    Utilisateurs
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <svg class="nav-icon" viewBox="0 0 24 24">
                        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                    </svg>
                    Statistiques
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <svg class="nav-icon" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    Paramètres
                </a>
            </li>
        </ul>
    </nav>
</aside>

<main class="main-content">
    <header class="header">
        <h1 class="header-title">Gestion des utilisateurs</h1>
        <div class="header-actions">
            <a href="index.php?action=addUser" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                </svg>
                Nouvel utilisateur
            </a>
            <a href="index.php?action=logout" class="btn btn-secondary">Déconnexion</a>
        </div>
    </header>

    <div class="dashboard-content">
        <div class="filter-section">
            <div class="filter-tabs">
                <a href="?period=today" class="filter-tab <?= $period === 'today' ? 'active' : '' ?>">Aujourd'hui</a>
                <a href="?period=week" class="filter-tab <?= $period === 'week' ? 'active' : '' ?>">Cette semaine</a>
                <a href="?period=month" class="filter-tab <?= $period === 'month' ? 'active' : '' ?>">Ce mois</a>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zm4 18v-6h2.5l-2.54-7.63c-.34-1.02-1.27-1.74-2.35-1.74-.23 0-.46.03-.69.09L15 7.37c-.47.22-.8.67-.8 1.18 0 .65.42 1.19 1 1.45v.67c0 .57.43 1.06 1 1.33V22h2z"/>
                        </svg>
                    </div>
                </div>
                <div class="stat-number"><?= $stats['total_users'] ?? 0 ?></div>
                <div class="stat-label">Total utilisateurs</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                        </svg>
                    </div>
                </div>
                <div class="stat-number"><?= $stats['monthly_registrations'] ?? 0 ?></div>
                <div class="stat-label">Ce mois</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M9 11H7v6h2v-6zm4 0h-2v6h2v-6zm4 0h-2v6h2v-6zm2.5-5H19V4h-2v2H7V4H5v2H4.5C3.67 6 3 6.67 3 7.5S3.67 9 4.5 9H19v10H5V9h-.5C3.67 9 3 8.33 3 7.5S3.67 6 4.5 6z"/>
                        </svg>
                    </div>
                </div>
                <div class="stat-number"><?= $stats['weekly_registrations'] ?? 0 ?></div>
                <div class="stat-label">Cette semaine</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm4.2 14.2L11 13V7h1.5v5.2l4.5 2.7-.8 1.3z"/>
                        </svg>
                    </div>
                </div>
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
            <div class="section-header">
                <h2 class="section-title">Utilisateurs créés <?= $label ?></h2>
            </div>
            <div class="recent-users-grid">
                <?php foreach($recent_users as $user): ?>
                <div class="user-card">
                    <div class="user-info">
                        <div class="user-details">
                            <strong><?= htmlspecialchars($user['prenom']) ?> <?= htmlspecialchars($user['nom']) ?></strong>
                            <small><?= htmlspecialchars($user['email']) ?></small>
                        </div>
                        <div class="user-time">
                            <?= date('H:i', strtotime($user['date_inscription'])) ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="table-section">
            <div class="table-header">
                <h3 class="table-title">Tous les utilisateurs</h3>
            </div>
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
                                    <a href="index.php?action=editUser&id=<?= $user['id'] ?>" class="btn btn-edit btn-sm">Modifier</a>
                                    <a href="index.php?action=deleteUser&id=<?= $user['id'] ?>" class="btn btn-delete btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.')) {
                e.preventDefault();
            }
        });
    });

    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    document.querySelectorAll('.stat-card, .user-card, .table-section').forEach(el => {
        observer.observe(el);
    });
});
</script>

</body>
</html>