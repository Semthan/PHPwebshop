<?php

session_start();

require_once ("models/Database.php");
require_once ("models/Model.php");
require_once ("models/UserModel.php");

require_once ("views/View.php");
require_once ("views/UserView.php");

require_once ("controllers/Controller.php");
require_once ("controllers/UserController.php");

$database       = new Database("webshop", "root", "root");

$model          = new Model($database);
$view           = new View();
$controller     = new Controller($model, $view);

$userModel      = new UserModel($database);
$userView       = new UserView();
$userController = new UserController($userModel, $userView);

$page = $_GET['page'] ?? "";

switch($page){
    case "details":
        $controller->details();
        break;
    case "checkout":
        $controller->checkout();
        break;
    case "profile":
        $controller->showProfile();
        break;
    case "admin":
        $controller->admin();
        break;
    case "register":
        $userController->registerUser();
        break;
    case "login":
        $userController->login();
        break;
    case "logout":
        $userController->logout();
        break;
    default:
        $controller->showProducts();
}