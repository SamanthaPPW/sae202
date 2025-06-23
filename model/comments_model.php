<?php
require_once(__DIR__ . '/db.php');

function ajouterCommentaire($user_id, $user_name, $comment_text) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO comments (user_id, user_name, comment_text) VALUES (?, ?, ?)");
    return $stmt->execute([$user_id, $user_name, $comment_text]);
}
function getCommentaires() {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM comments ORDER BY date_posted DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}