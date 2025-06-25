<?php
session_start();
require_once __DIR__ . '/../model/reservation_model.php';
require_once __DIR__ . '/../model/utilisateurs_model.php';

function index() {
    agenda();
    
}

function agenda() {
  require 'view/autres_pages/header.php';
  require 'view/autres_pages/menu.php';
    if (!isset($_SESSION['id'])) {
        header('Location: /connexion');
        exit;
    }

    $creneaux = getCreneaux();
    require __DIR__ . '/../view/reservation_view.php';
    require 'view/autres_pages/footer.php';
}

function reserver() {
    if (!isset($_SESSION['id'])) {
        header('Location: /connexion');
        exit;
    }

    if (isset($_POST['creneau_id'])) {
        reserverCreneau($_POST['creneau_id'], $_SESSION['id']);
        $_SESSION['message'] = "Créneau réservé avec succès !";
    } else {
        $_SESSION['error'] = "Erreur de réservation.";
    }

    header('Location: /reservation');
    exit;
}

function formulaire_achat() {
    if (!isset($_SESSION['id'])) {
        header('Location: /connexion');
        exit;
    }

    $creneau_id = $_GET['creneau_id'] ?? null;
    if (!$creneau_id) {
        $_SESSION['message'] = "Aucun créneau sélectionné.";
        header('Location: /reservation/agenda');
        exit;
    }

    require 'view/autres_pages/header.php';
    require 'view/autres_pages/menu.php';
    require __DIR__ . '/../view/reservation/formulaire_achat.php';
    require 'view/autres_pages/footer.php';
}

function valider() {
    if (!isset($_SESSION['id'])) {
        header('Location: /connexion');
        exit;
    }

    if (
        isset($_POST['creneau_id'], $_POST['nom'], $_POST['carte'], $_POST['expiration'], $_POST['code_securite'], $_POST['nombre_participants'])
    ) {
        $creneauId = $_POST['creneau_id'];
        $userId = $_SESSION['id'];
        $nb = (int)$_POST['nombre_participants'];
        $creneau = getCreneauById($creneauId);
        $placesRestantes = 20 - $creneau['nb_reservations'];

        if ($nb > $placesRestantes) {
            $_SESSION['message'] = "Pas assez de places disponibles.";
            header('Location: /reservation/formulaire_achat?creneau_id=' . $creneauId);
            exit;
        }

        for ($i = 0; $i < $nb; $i++) {
            reserverCreneau($creneauId, $userId);
        }

        // Envoi des mails
        $utilisateur = getUserById($userId); 
        $email = $utilisateur['email'];
        $prenom = ucfirst($utilisateur['prenom']);
        $nom = ucfirst($utilisateur['nom']);

        // Mail à l'admin
        $subject_admin = "Nouvelle réservation - $prenom $nom";
        $message_admin = "Nom: $nom\nPrénom: $prenom\nEmail: $email\n";
        $message_admin .= "Créneau: " . date('d/m/Y H:i', strtotime($creneau['date_creneau'])) . "\n";
        $message_admin .= "Nombre de participants: $nb\n";
        $headers_admin = "From: $email\r\n";
        $headers_admin .= "Reply-To: $email\r\n";
        $headers_admin .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $headers_admin .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $email_admin = "mmi24f08@mmi-troyes.fr";

        mail($email_admin, $subject_admin, $message_admin, $headers_admin);

        // Mail de confirmation à l'utilisateur
        $subject_user = "Confirmation de votre réservation";
        $message_user = "
        <html>
        <head><title>Confirmation de réservation</title></head>
        <body>
            <p>Bonjour $prenom $nom,</p>
            <p>Votre réservation a bien été confirmée :</p>
            <ul>
                <li>Créneau : <strong>" . date('d/m/Y H:i', strtotime($creneau['date_creneau'])) . "</strong></li>
                <li>Nombre de participants : <strong>$nb</strong></li>
            </ul>
            <p>Merci pour votre réservation, amusez-vous bien !</p>
        </body>
        </html>
        ";
        $headers_user = "From: mmi24f08@mmi-troyes.fr\r\n";
        $headers_user .= "Reply-To: noreply@mmi-troyes.fr\r\n";
        $headers_user .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $headers_user .= "Content-Type: text/html; charset=UTF-8\r\n";

        mail($email, $subject_user, $message_user, $headers_user);

        $_SESSION['message'] = "Réservation confirmée pour $prenom $nom ($nb participant(s)) ! Un email de confirmation a été envoyé.";
        header('Location: /reservation/agenda');
        exit;
    } else {
        $_SESSION['message'] = "Erreur dans le formulaire de paiement.";
        header('Location: /reservation/agenda');
        exit;
    }
}
