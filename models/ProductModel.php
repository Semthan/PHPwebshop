<?php 
    class ProductModel{
        private $db; 

        public function __construct($database)
        {
            $this->db = $database;
        }

        public function deleteProduct($productId){
            
            $statement = "DELETE FROM products WHERE product_id = :id";
            $this->db->delete($statement, ["id"=>$productId]);
            header('Location: index.php?page=admin');
        }
        
        public function addProduct($params){
            $stmt = "INSERT INTO products (product_id, title, price, stock, img_src, description, category_id)
            VALUES (null, :title,:price,:stock,:img_src, :description, :category_id)";
            
            $productData = $params;
            print_r($productData);
            $this->db->insert($stmt, $productData);
            header('Location: index.php?page=admin');
        }

        public function fetchAllProducts()
        {
            $products = $this->db->select("SELECT * FROM products");
            return $products;
        }

        
    }
