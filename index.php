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

$database       = new Database("webshop", "Harald", "password");

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
$adminController = new AdminController($adminModel, $adminView);

$url = getUrl();
$page = $url[0] ?? "";

switch ($page) {
    case "admin":
        $_SESSION['admin'] ? $adminController->admin() : $controller->error();
        break;
    case "editproduct":
        $productController->edit();
        break;
    case "cart":
        $cartController->cart2();

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
        isset($_SESSION['id']) ? $orderController->createOrder($_SESSION['id'], $_SESSION['basket']) : $userController->login();
        break;
    default:
        $productController->customerProducts();
}

function getUrl()
{
    if (isset($_GET['page'])) {
        $url = rtrim($_GET['page'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        //print_r($url);
        return $url;
    }
}
