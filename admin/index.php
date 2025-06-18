<?php
session_start();
define('ROOT', realpath(__DIR__ . '/..') . '/');
require_once(ROOT . 'conf/EXEMPLE_conf.inc.php');
require_once(ROOT . 'model/db.php');

$controller = 'admin';
$action = 'index';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

require_once('controller/' . $controller . '_controller.php');

if (function_exists($action)) {
    $action();
} else {
    echo "Action inconnue.";
}