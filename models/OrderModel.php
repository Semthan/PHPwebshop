<?php

class OrderModel{
    
    private $db;

    public function __construct($database){
        $this->db = $database;
    }

    public function createOrderInDb($user_id, $basket){
        $stmt = "INSERT INTO orders (order_id, users_id, order_date, shipped)
                 VALUES (NULL, :id, CURRENT_TIMESTAMP, 0)";

        $id = ["id"=>$user_id];

        $lastInsertId = $this->db->insert($stmt, $id);

        foreach($basket as $item){
            $stmt = "INSERT INTO orders_has_products (order_id, product_id, amount)
                     VALUES (:order_id, :product_id, :amount)";

            $inputParams = [
                ":order_id" => $lastInsertId,
                ":product_id" => $item['id'],
                ":amount" => $item['amount']
            ];

            $this->db->insert($stmt, $inputParams);
        }
    }

    public function changeOrderStatus($order_id){
        $stmt = "UPDATE orders SET shipped = :statusVar";

        $shipped = [":statusVar"=>1];

        $this->db->update($stmt, $shipped);
    }

    public function deleteOrderInDb($order_id){
        $this->updateStock($order_id);

        $stmt1 = "DELETE FROM orders WHERE orders.order_id = :id";
        $stmt2 = "DELETE * FROM orders_has_products WHERE order_id = :id";

        $id = [":id" => $order_id];

        $this->db->delete($stmt1, $id);
        $this->db->delete($stmt2, $id);
    }

    private function updateStock($order_id){
        $stmt = "SELECT * FROM orders_has_products WHERE order_id = :id";

        $id = [":id" => $order_id];

        $products = $this->db->select($stmt, $id);

        foreach($products as $item){
            $stmt = "UPDATE products SET stock = stock + :amount WHERE products.products_id = :id";

            $inputParams = [
                ":amount" => $item['amount'],
                ":id" => $item['product_id']
            ];

            $this->db->update($stmt, $inputParams);
        }
    }
}