<?php


    class AdminController {

        private $view;
        private $adminView;
        private $model; 

        public function __construct($model, $view, $adminView){
            $this -> model = $model;
            $this -> view = $view;
            $this -> adminView = $adminView;

        }

        public function orders(){
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $this->model->changeOrderStatus($_POST['id']);  
                header("Refresh:0");
            }
            
            $orders = $this->model->fetchAllOrders();
            $this->view->viewHeader("HEJ");
            $this->adminView->viewAdminOrders($orders);
            $this->view->viewFooter();
        }
    }
?>