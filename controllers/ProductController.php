<?php
    class ProductController{
        private $productModel;
        private $productView;

        public function __construct($productModel, $productView){
            $this->productModel = $productModel;
            $this->productView = $productView;
            
        }

        public function edit(){
            $asignment = $_GET['asignment'] ?? "";
            $id = $_GET['id'] ??  "";
            switch ($asignment) {
                case "edit":
                    $this->editProduct($id);
                    break;
                case "add":
                    $this->addProduct($id);
                    break;
                case "delete":
                    $this->deleteProduct($id);
                    break;
                case "showproducts":
                    $this->adminProducts();
                    break;
                default:
                    $this->customerProducts();
                    break;
            };
        }

        public function productForm($id){

            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $this->processForm("edit", $id);
            }
            else{
                $this->productView->ViewHeader();
                $this->getProductForm();
                $this->productView->ViewFooter();
            }
            
        }
        
        public function adminProducts(){
            $this->productView->ViewHeader();
            $this->getAdminProducts();
            $this->productView->ViewFooter();
        }

        public function customerProducts(){
            $this->productView->ViewHeader();
            $this->getCustomerProducts();
            $this->productView->ViewFooter();
        }

        public function getAdminProducts(){
            $products = $this->productModel->fetchAllProducts();
            $this->productView->AdminViewAllProducts($products);
        }
        public function getCustomerProducts(){
            $products = $this->productModel->fetchAllProducts();
           $this->productView->customerViewProducts($products);
        }

        public function getProductForm(){
            if(isset($_GET['id'])){
                $product = $this->productModel->fetchOneProduct($_GET['id']);
            }
            isset($_GET['id'])?
                $product = $this->productModel->fetchOneProduct($_GET['id'])
                :
                $product = "";
            $this->productView->productForm($product);
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
                $this->productModel->addProduct($productData);
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
                $this->productModel->editProduct($productData, $id );
            }
        }

        public function addProduct(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $this->processForm("add");}
            else {
                $this->productView->ViewHeader();
                $this->productView->productForm(null);
                $this->productView->ViewFooter();

            }
        }

        public function editProduct($id){
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $this->processForm("edit", $id);
            }
            else{
                $this->productForm($id);
            }
                        
        }

        private function deleteProduct($id){
            $this->productModel->setAvailabilityToFalse($id);
            header('Location: ?page=editproduct&asignment=showproducts');
        }
        
        private function sanatize($text){
            $text = trim($text);
            $text = stripslashes($text);
            $text = htmlspecialchars($text);
    
            return $text;
        }

    
    }
