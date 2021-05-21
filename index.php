<?php

session_start();

require_once("models/Database.php");
require_once("models/Model.php");
require_once("models/UserModel.php");
require_once("models/OrderModel.php");
require_once("models/ProductModel.php");

require_once("views/View.php");
require_once("views/UserView.php");
require_once("views/ProductView.php");

require_once("controllers/Controller.php");
require_once("controllers/UserController.php");
require_once("controllers/OrderController.php");
require_once("controllers/ProductController.php");

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

$orderModel      = new OrderModel($database);
$basket = new OrderController($model, $view, $database);

$page = $_GET['page'] ?? "";
$product = $_GET['product'] ?? "";

if (isset($_GET['delete'])) $productModel->deleteProduct($_GET['delete']);
//if(isset($_GET['edit'])) $productController->editProduct($_GET['edit']);

switch ($product) {
    case "add":
        $productController->addProduct();
        break;
    case "edit":
        $productController->editProduct($_GET['id']);
        break;
    case "addProduct":
        $productController->addNewProduct();
        break;
}

switch ($page) {
    case "details":
        $controller->details();
        break;
    case "checkout":
        $controller->checkout();
        break;
    case "admin":
        $_SESSION['admin'] ? $controller->admin() : $controller->error();
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
    case "order":
        $orderController->testCreateOrder();
        break;
    case "deleteOrder":
        $orderController->testDeleteOrder();
        break;
    default:
        $controller->showProducts();
}
