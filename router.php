<?php
include_once "utils/defaults.php";
include_once "models/DB.php";
include_once "models/Tarea.php";

$controller = $_GET['controller'];
$action = $_GET['action'];
$id = $_GET['id'];

if (empty($action))
    $action = "index";

$ctrlName = $controller . "Controller";
include "./controllers/$ctrlName.php";
$ctrl = new $ctrlName;
$ctrl->{$action}($id);
