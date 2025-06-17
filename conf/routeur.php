<?php
// Récupération de la seconde partie de l'URL - le chemin
$path = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);

// Découpage du chemin et stockage des "morceaux" dans un tableau
// On découpe à chaque symbole "/" rencontré
$items = explode('/',$path);

// Le premier "morceau" - $items[0] sera toujours vide
// Le second "morceau" - $items[1] détermine le contrôleur
// Si le "morceau" est vide , le contrôleur sera accueil_controller
if (empty($items[1])) {
   $controller = 'accueil';
}else{
   $controller = $items[1];
}

// Le dernier "morceau" analysé - $items[2] détermine la fonction dans le contrôleur
// si le "morceau" est vide la fonction à appeler sera index()
if (empty($items[2])) {
 $action = 'index';
}else{
 $action =$items[2];
}

// On appelle le code du controleur
require_once('controller/'.$controller.'_controller.php');
// On execute l'action qui est donc une fonction du contôleur.
$action();


?>