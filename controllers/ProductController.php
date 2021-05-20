<?php
    class ProductController{
        private $model;
        private $view;

        public function __construct($model, $view){
            $this->model = $model;
            $this->view = $view;
            
        }


        public function productCards(){
            $products = $this->model->fetchAllProducts();
            $this->view->allProducts($products);
        }

        public function processAddform(){
            $errors = [];
            $productData = [];

            $title = $this->sanatize($_POST['title']);
            $price = $this->sanatize($_POST['price']);
            $stock = $this->sanatize($_POST['stock']);
            $img = $this->sanatize($_POST['img_src']);
            $description = $this->sanatize($_POST['description']);
            $category_id = $this->sanatize($_POST['category_id']);
            
            $productData = [
                ":title" => $title,
                ":price" => $price,
                ":stock" => $stock,
                ":img_src" => $img,
                ":description" => $description,
                ":category_id" => $category_id,
            ];
            

            $this->model->addProduct($productData);
        }

        public function addProduct(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $this->processAddform();}
            else {
                $this->view->productForm(null);
            }
        }

        public function addNewProduct(){
            
            
           
        }

        private function sanatize($text){
            $text = trim($text);
            $text = stripslashes($text);
            $text = htmlspecialchars($text);
    
            return $text;
        }
    
    }

?>