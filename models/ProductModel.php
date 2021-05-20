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
        public function editProduct($params, $id){
            $stmt = "UPDATE products SET
                title = :title, 
                price = :price, 
                stock = :stock,
                img_src = :img_src,
                description = :description,
                category_id = :category_id
                WHERE product_id = :id";
            
            $productData = $params;
            print_r($productData);
            $this->db->update($stmt, $productData);
            header('Location: index.php?page=admin');
        }

        public function fetchAllProducts()
        {
            $products = $this->db->select("SELECT * FROM products");
            return $products;
        }
        public function fetchOneProduct($productId)
        {
            $stmt = "SELECT * FROM products WHERE product_id = :id";
            $product = $this->db->select($stmt, ["id"=>$productId]);
            return $product;
        }

        
    }
