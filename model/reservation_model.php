<?php require_once 'db.php';

function getCreneaux() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM creneaux ORDER BY date_creneau ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function reserverCreneau($creneauId, $userId) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE creneaux SET est_reserve = 1, user_id = ? WHERE id = ? AND est_reserve = 0");
    return $stmt->execute([$userId, $creneauId]);
}
