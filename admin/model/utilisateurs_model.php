<?php
require_once(__DIR__ . '/../../model/db.php');

function getAllUsers(): array {
    global $pdo;
    
    $stmt = $pdo->query("SELECT * FROM utilisateurs ORDER BY date_inscription DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUserByEmail(string $email): ?array {
    global $pdo;

    $sql = "SELECT * FROM utilisateurs WHERE email = :email LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user ?: null;
}

function getUserStats(): array {
    global $pdo;

    $stats = [];

    try {
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM utilisateurs");
        $stats['total_users'] = (int)$stmt->fetch(PDO::FETCH_ASSOC)['total'];

        $stmt = $pdo->query("SELECT COUNT(*) as monthly FROM utilisateurs WHERE MONTH(date_inscription) = MONTH(CURRENT_DATE()) AND YEAR(date_inscription) = YEAR(CURRENT_DATE())");
        $stats['monthly_registrations'] = (int)$stmt->fetch(PDO::FETCH_ASSOC)['monthly'];

        $stmt = $pdo->query("SELECT COUNT(*) as weekly FROM utilisateurs WHERE WEEK(date_inscription) = WEEK(CURRENT_DATE()) AND YEAR(date_inscription) = YEAR(CURRENT_DATE())");
        $stats['weekly_registrations'] = (int)$stmt->fetch(PDO::FETCH_ASSOC)['weekly'];

        $stmt = $pdo->query("SELECT COUNT(*) as today FROM utilisateurs WHERE DATE(date_inscription) = CURRENT_DATE()");
        $stats['today_registrations'] = (int)$stmt->fetch(PDO::FETCH_ASSOC)['today'];
    } catch (PDOException $e) {
        $stats = [
            'total_users' => 0,
            'monthly_registrations' => 0,
            'weekly_registrations' => 0,
            'today_registrations' => 0
        ];
    }

    return $stats;
}

function getRecentUsers(string $period = 'today'): array {
    global $pdo;
    
    switch($period) {
        case 'today':
            $sql = "SELECT * FROM utilisateurs WHERE DATE(date_inscription) = CURDATE() ORDER BY date_inscription DESC";
            break;
        case 'week':
            $sql = "SELECT * FROM utilisateurs WHERE date_inscription >= DATE_SUB(NOW(), INTERVAL 7 DAY) ORDER BY date_inscription DESC";
            break;
        case 'month':
            $sql = "SELECT * FROM utilisateurs WHERE date_inscription >= DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY date_inscription DESC";
            break;
        default:
            $sql = "SELECT * FROM utilisateurs ORDER BY date_inscription DESC";
            break;
    }
    
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUserById(int $id): ?array {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = :id LIMIT 1");
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user ?: null;
}

function insertUser(array $data): bool {
    global $pdo;

    $sql = "INSERT INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe, date_inscription)
            VALUES (:nom, :prenom, :email, :telephone, :mot_de_passe, NOW())";

    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        'nom' => $data['nom'],
        'prenom' => $data['prenom'],
        'email' => $data['email'],
        'telephone' => $data['telephone'],
        'mot_de_passe' => $data['mot_de_passe'],
    ]);
}

function updateUserById(int $id, array $data): bool {
    global $pdo;

    $fields = [];
    $params = [];

    foreach ($data as $key => $value) {
        $fields[] = "$key = :$key";
        $params[$key] = $value;
    }
    $params['id'] = $id;

    $sql = "UPDATE utilisateurs SET " . implode(', ', $fields) . " WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    return $stmt->execute($params);
}

function deleteUserById(int $id): bool {
    global $pdo;

    $stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE id = :id");
    return $stmt->execute(['id' => $id]);
}
