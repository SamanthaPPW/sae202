<?php
function index() {
    require 'view/autres_pages/header.php';
    require 'view/autres_pages/menu.php';
    require(__DIR__ . '/../view/mentions_view.php');
    require 'view/autres_pages/footer.php';
}
