<?php

session_start();
!isset($_SESSION["basket"]) && $_SESSION["basket"] = [];


//Models
require_once("models/Database.php");
require_once("models/Model.php");
require_once("models/UserModel.php");
require_once("models/OrderModel.php");
require_once("models/ProductModel.php");
require_once("models/AdminModel.php");


//Views
require_once("views/View.php");
require_once("views/UserView.php");
require_once("views/ProductView.php");
require_once("views/CartView.php");
require_once("views/adminView.php");


//Controllers
require_once("controllers/Controller.php");
require_once("controllers/UserController.php");
require_once("controllers/OrderController.php");
require_once("controllers/ProductController.php");
require_once("controllers/CartController.php");
require_once("controllers/AdminController.php");

$database       = new Database("webshop", "root", "root");

//Models
$model          = new Model($database);
$productModel   = new ProductModel($database);
$userModel      = new UserModel($database);
$orderModel      = new OrderModel($database);
$adminModel      = new AdminModel($database);

//Views
$view           = new View();
$userView       = new UserView();
$productView    = new productView();
$cartView       = new CartView();
$adminView       = new AdminView();

//Controllers
$userController    = new UserController($userModel, $userView);
$productController = new ProductController($productModel, $productView);
$controller        = new Controller($model, $view, $productController);

$orderController = new OrderController($orderModel);
$cartController  = new CartController($model, $cartView, $database, $productModel);
$adminController   = new AdminController($adminModel, $view, $adminView);

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
        case "adminorders":
            $adminController->orders();
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
    case "addtobasket":
        if(isset($_GET['cart'])){$cartController->addtobasket($_GET["id"],1,'index.php?page=cart');}
        if(isset($_GET['index'])){$cartController->addtobasket($_GET["id"],1,'index.php');}
        break;
    case "removefrombasket":
        if(isset($_GET['cart'])){$cartController->removeFromBasket($_GET["id"],1,'index.php?page=cart');}
        if(isset($_GET['index'])){$cartController->removeFromBasket($_GET["id"],1, 'index.php');} 
        break;
    case "cart":
        $cartController->cart();
        break;
    case "order":
        isset($_SESSION['id']) ? $orderController->createOrder($_SESSION['id'],$_SESSION['basket']) : $userController->login();
        break;
    default:
        $controller->showProducts();
}
