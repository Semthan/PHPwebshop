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