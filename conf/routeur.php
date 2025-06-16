<?php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
<<<<<<< HEAD
$items = explode('/', $path);

if (empty($items[1])) {
    $controller = 'accueil';
} else {
    $controller = $items[1];
}

if (empty($items[2])) {
    $action = 'index';
} else {
    $action = $items[2];
}

require_once('controller/' . $controller . '_controller.php');
$action();
?>
=======
$item = explode('/', $path);

$controller = isset($item[1]) && $item[1] !== '' ? $item[1] : 'accueil';
$action = isset($item[2]) && $item[2] !== '' ? $item[2] : 'index';

$controllerFile = 'controller/' . $controller . '_controller.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;

    if (function_exists($action)) {
        $action();
    } else {
        echo "Action '$action' non trouvée.";
    }
} else {
    echo "Contrôleur '$controller' non trouvé.";
}
?>
>>>>>>> fa07eac16cb1aac9c925de54a47e459fcdfd927b
