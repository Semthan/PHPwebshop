<?php
    class ProductController{
        private $model;
        private $view;

        public function __construct($model, $view){
            $this->model = $model;
            $this->view = $view;
            
        }

        public function showAllProducts(){
            $products = $this->model->fetchAllProducts();
            $this->view->showProducts($products);
        }

        public function productCards(){
            $products = $this->model->fetchAllProducts();
            $this->view->allProducts($products);
        }

        public function productCard(){
            $product = $this->model->fetchOneProduct($_GET['id']);
            
            $this->view->productForm($product);
        }

        public function processForm($toDo){
            $errors = [];
            $productData = [];

            $id = $this->sanatize($_POST["product_id"]);
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
                ":category_id" => $category_id
                
            ];
            
            if($toDo=="add"){
                $this->model->addProduct($productData);
            }
            if($toDo=="edit"){  
                $productData = [
                    "id" => $id,
                    ":title" => $title,
                    ":price" => $price,
                    ":stock" => $stock,
                    ":img_src" => $img,
                    ":description" => $description,
                    ":category_id" => $category_id
                    
                ];
                //array_push($productData, ["id" => $id]);
                $this->model->editProduct($productData, $id );
            }
        }

        public function addProduct(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $this->processForm("add");}
            else {
                $this->view->productForm(null);
            }
        }
        public function editProduct($id){

            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $this->processForm("edit", $id);
            }
                else{

                    $this->productCard();
                }
                        
        }

        private function sanatize($text){
            $text = trim($text);
            $text = stripslashes($text);
            $text = htmlspecialchars($text);
    
            return $text;
        }
    
    }
