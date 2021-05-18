<?php
class Model
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function fetchAllProducts()
    {
        $products = $this->db->select("SELECT * FROM products");
        return $products;
    }

    public function fetchProductById($id)
    {
        $statement = "SELECT * from products WHERE products_id = :id";
        $params = array(":id => $id");
        $product  = $this->db->select($statement, $params);
        //print_r($product);
        return $movie[0] ?? false;
    }

    public function fetchCustomerById($id)
    {
        $statement = "SELECT * FROM users WHERE users_id =:id";
        $parameters = array(':id' => $id);
        $customer = $this->db->select($statement, $parameters);
        return $customer[0] ?? false;
    }

    public function saveOrder($users_id, $products_id)
    {
        $user = $this->fetchCustomerById($users_id);
        if (!$user) return false;

        $statement = "INSERT INTO orders (customer_id, products_id)  
                      VALUES (:customer_id, :products_id)";
        $parameters = array(
            ':customer_id' => $users_id,
            ':film_id' => $products_id
        );

        // Ordernummer
        $lastInsertId = $this->db->insert($statement, $parameters);

        return array('customer' => $user, 'lastInsertId' => $lastInsertId);
    }
}
