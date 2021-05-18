<?php 
    class ProductModel{
        private $db; 

        public function __construct($database)
        {
            $this->db = $database;
        }

        public function deleteProduct($productId){
            
            $statement = "DELETE FROM products WHERE $productId";
            $this->db->delete($statement);
            header('Location: "https://localhost/webb20/PHPwebshop/index.php?page=admin"');
        }

        public function fetchAllProducts()
        {
            $products = $this->db->select("SELECT * FROM products");
            return $products;
        }
    }