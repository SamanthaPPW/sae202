<?php require_once 'db.php';

function getCreneaux() {
  global $pdo;
  $stmt = $pdo->query("SELECT c.id, c.date_creneau,(SELECT COUNT(*) FROM reservations r WHERE r.creneau_id = c.id) AS nb_reservations FROM creneaux c ORDER BY c.date_creneau ASC");
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getNombreReservations($creneauId) {
  global $pdo;
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM reservations WHERE creneau_id = ?");
  $stmt->execute([$creneauId]);
  return (int)$stmt->fetchColumn();
}

function reserverCreneau($creneauId, $userId) {
  global $pdo;

  if (getNombreReservations($creneauId) >= 20) {
      return false;
  }
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM reservations WHERE creneau_id = ? AND user_id = ?");
  $stmt->execute([$creneauId, $userId]);
  if ($stmt->fetchColumn() > 0) {
      return false; 
  }


  $stmt = $pdo->prepare("INSERT INTO reservations (creneau_id, user_id) VALUES (?, ?)");
  return $stmt->execute([$creneauId, $userId]);
}

function getCreneauById($id) {
  global $pdo;
  $stmt = $pdo->prepare("SELECT c.id, c.date_creneau, (SELECT COUNT(*) FROM reservations r WHERE r.creneau_id = c.id) AS nb_reservations FROM creneaux c WHERE c.id = ?");
  $stmt->execute([$id]);
  return $stmt->fetch(PDO::FETCH_ASSOC);
}
