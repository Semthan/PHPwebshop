<?php


    class AdminController {

        private $adminView;
        private $adminModel; 

        public function __construct($adminModel, $adminView,){
            $this -> adminModel = $adminModel;
            $this -> adminView = $adminView;

        }

        public function admin(){  
            $path = $_GET['path'] ?? "";

            switch ($path) {
                case "orders":
                    $this->orders();
                    break;
                case "editProduct":
                    $this->editProduct();
                        break;
                default:
                    $this->adminMenu();
                    break;  
            } 
        }
            
        private function orders(){
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $this->adminModel->changeOrderStatus($_POST['id']);  
                header("Refresh:0");
            }
                
            $orders = $this->adminModel->fetchAllOrders();
            $this->adminView->viewHeader("HEJ");
            $this->getAdminOrders($orders);
            $this->adminView->viewFooter();
        }
            
        private function adminMenu(){
            $this->adminView->viewHeader("HEJ");
            $this->getAdminMenu();
            $this->adminView->viewFooter();
        }


        //view getters
        private function getAdminMenu(){
            $this->adminView->viewAdminMenu();
        }

        public function getAdminOrders($orders){
            $this->adminView->viewAdminOrders($orders);
        }
        
        private function editProduct(){  
            header("Location: ?page=editproduct&asignment=edit");
        }
    }
?>