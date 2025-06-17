<?php

function index() {
    require_once('view/autres_pages/header.php');
    require_once('view/autres_pages/menu.php');
    require_once('view/accueil_view.php');
    require_once('view/autres_pages/footer.php');
}

function accueil() {
    index();
}
?>