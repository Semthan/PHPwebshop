<?php 
    class ProductModel{
        private $db; 

        public function __construct($database)
        {
            $this->db = $database;
        }

        public function deleteProduct($productId){
            
            $statement = "DELETE * FROM products WHERE product_id = :id";
            $this->db->delete($statement, ["id"=>$productId]);
            header('Location: "https://localhost/webb20/PHPwebshop/index.php?page=admin"');
        }

        public function fetchAllProducts()
        {
            $products = $this->db->select("SELECT * FROM products");
            return $products;
        }
    }