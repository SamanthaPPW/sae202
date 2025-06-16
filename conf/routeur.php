<?php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$items = explode('/', $path);

$controller = isset($items[1]) && $items[1] !== '' ? $items[1] : 'accueil';
$action = isset($items[2]) && $items[2] !== '' ? $items[2] : 'index';

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
