<?php
require_once(__DIR__ . '/../model/db.php');

function index(){
    require __DIR__ . '/../view/autres_pages/header.php';
    require __DIR__ . '/../view/autres_pages/menu.php';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['id'])) {
        header('Location: /connexion?error=not_logged_in');
        exit;
    }
    
    $user = getUserById($_SESSION['id']);
    
    if (!$user) {
        header('Location: /connexion?error=user_not_found');
        exit;
    }
    
    require_once(__DIR__ . '/../view/profil_view.php');
    require __DIR__ . '/../view/autres_pages/footer.php';
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
            try {
                $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe, date_creation) VALUES (?, ?, ?, ?, ?, NOW())");
                $stmt->execute([$nom, $prenom, $email, $telephone, $mot_de_passe]);
                header('Location: /profil');
                exit;
            } catch (PDOException $e) {
                $error = "Erreur lors de l'inscription : " . $e->getMessage();
            }
        } else {
            $error = "Veuillez remplir tous les champs obligatoires.";
        }
    }
    
    require_once(__DIR__ . '/../view/inscription_view.php');
}

function modifier(){
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['id'])) {
        header('Location: /connexion?error=not_logged_in');
        exit;
    }
    
    $user = getUserById($_SESSION['id']);
    
    if (!$user) {
        header('Location: /connexion?error=user_not_found');
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        $email = $_POST['email'] ?? '';
        $telephone = $_POST['telephone'] ?? '';
        
        if ($nom && $prenom && $email) {
            try {
                global $pdo;
                $stmt = $pdo->prepare("UPDATE utilisateurs SET nom = ?, prenom = ?, email = ?, telephone = ? WHERE id = ?");
                $stmt->execute([$nom, $prenom, $email, $telephone, $_SESSION['id']]);
                
                header('Location: /profil?success=profile_updated');
                exit;
            } catch (PDOException $e) {
                $error = "Erreur lors de la mise à jour : " . $e->getMessage();
            }
        } else {
            $error = "Veuillez remplir tous les champs obligatoires.";
        }
    }
    
    require_once(__DIR__ . '/../view/modifier_profil_view.php');
}

function getUserById($id) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur lors de la récupération de l'utilisateur : " . $e->getMessage());
        return false;
    }
}
?>