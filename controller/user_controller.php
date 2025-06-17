<?php
require_once('../model/db.php');

function index(){
    global $pdo;
    $stmt = $pdo->query("SELECT id, nom, prenom, email, telephone, date_inscription FROM utilisateurs");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    require('view/users/list.php');
}

function add(){
    global $pdo;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        $email = $_POST['email'] ?? '';
        $telephone = $_POST['telephone'] ?? '';
        $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

        if ($nom && $prenom && $email && $mot_de_passe) {
            $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nom, $prenom, $email, $telephone, $mot_de_passe]);
            header('Location: /user/index');
            exit;
        } else {
            $error = "Veuillez remplir tous les champs obligatoires.";
        }
    }

    require('view/users/add.php');
}

function profil() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?action=connexion');
        exit;
    }

    $user = getUserById($_SESSION['user_id']); // depuis le modèle
    require_once('view/profil_view.php');
}
function getUserById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
