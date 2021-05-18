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

        
    }

?>