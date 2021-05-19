<?php

session_start();

require_once ("models/Database.php");
require_once ("models/Model.php");
require_once ("models/UserModel.php");
require_once ("models/ProductModel.php");

require_once ("views/View.php");
require_once ("views/UserView.php");
require_once ("views/ProductView.php");

require_once ("controllers/Controller.php");
require_once ("controllers/UserController.php");
require_once ("controllers/ProductController.php");

$database       = new Database("webshop", "root", "root");

//Models
$model          = new Model($database);
$productModel   = new ProductModel($database);
$userModel      = new UserModel($database);

//Views
$view           = new View();
$userView       = new UserView();
$productView    = new productView();

//Controllers
$userController = new UserController($userModel, $userView);
$productController = new ProductController($productModel, $productView);
$controller     = new Controller($model, $view, $productController);

$page = $_GET['page'] ?? "";
$product = $_GET['product'] ?? "";

if(isset($_GET['delete'])) $productModel->deleteProduct($_GET['delete']);

switch($product){
    case "add":
        $productController->addProduct();
        break;
    default:
        $controller->showProducts();
}

switch($page){
    case "details":
        $controller->details();
        break;
    case "checkout":
        $controller->checkout();
        break;
    case "admin":
        $controller->admin();
        break;
    case "profile":
        $userController->updateUser();
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
