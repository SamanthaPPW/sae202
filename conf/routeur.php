<?php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
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
