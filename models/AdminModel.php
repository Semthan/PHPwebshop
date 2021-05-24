<?php
    class AdminModel{

        public function __construct($database){
            $this->db = $database;
        }

        public function changeOrderStatus($order_id){
            $stmt = "UPDATE orders SET shipped = :shipped WHERE order_id = :id";
        
            $params = [
                ":shipped" => 1,
                ":id" => $order_id
            ];
            $this->db->update($stmt, $params);
        }

        public function fetchAllOrders(){
            $stmt = "SELECT * FROM orders";
            return $this->db->select($stmt);
        }

        public function fetchAllProducts()
        {
            $products = $this->db->select("SELECT * FROM products");
            return $products;
        }
        
    }

?>