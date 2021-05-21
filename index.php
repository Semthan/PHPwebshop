<?php

session_start();

require_once("models/Database.php");
require_once("models/Model.php");
require_once("models/UserModel.php");
require_once("models/Datapopulater.php");
include_once "produktlista.php";

require_once("views/View.php");
require_once("views/UserView.php");

require_once("controllers/Controller.php");
require_once("controllers/UserController.php");
require_once("controllers/OrderController.php");

$database       = new Database("webshop", "Harald", "password");

$model          = new Model($database);
$view           = new View();
$controller     = new Controller($model, $view);

$userModel      = new UserModel($database);
$userView       = new UserView();
$userController = new UserController($userModel, $userView);
$datapopulate   = new Populater($database);
$basket         = new OrderController($model, $view, $database);

$page = $_GET['page'] ?? "";

switch ($page) {
    case "categorypop":
        $datapopulate->categoryPop($categories);
        break;
    case "productpop":
        $datapopulate->productPop($products);
        break;
    case "addtobasket":
        $basket->addToBasket(3, 3);
        break;
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
