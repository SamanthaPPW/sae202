<?php
require_once(__DIR__ . '/../conf/conf.inc.php');

try {
    $pdo = new PDO(
        'mysql:host=' . HOST . ';dbname=' . DBNAME . ';charset=utf8',
        USER,
        PASSWORD
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}
?>
