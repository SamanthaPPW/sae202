<?php 
require('model/users_model.php');
function index()
{
    require('view/autres_pages/header.php');  
    require('view/autres_pages/menu.php');
    require('view/profil_view.php');
    require('view/autres_pages/footer.php');

    $user = get_user_by_id($_SESSION['user_id']);
}
