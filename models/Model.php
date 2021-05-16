<?php
class Model{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function fetchAllProducts(){
        $categories = $this->db->select("SELECT * FROM categories");
        return $categories;
    }
    public function fetchAllCategories(){
        $products = $this->db->select("SELECT * FROM products");
        return $products;
    }

    public function fetchProductById($id){
        $statement = "SELECT * from products WHERE id = :id";
        $params = array(":id => $id");
        $product  = $this->db->select($statement, $params);
        //print_r($product);
        return $movie[0] ?? false;
    }

    public function fetchCustomerById($id){
        $statement = "SELECT * FROM users WHERE id =:id";
        $parameters = array(':id' => $id);
        $customer = $this->db->select($statement,$parameters);
        return $customer[0] ?? false;
    }

    public function saveOrder($customer_id, $movie_id)
    {
        $customer = $this->fetchCustomerById($customer_id);
        if (!$customer) return false;

        $statement = "INSERT INTO orders (customer_id, film_id)  
                      VALUES (:customer_id, :film_id)";
        $parameters = array(
            ':customer_id' => $customer_id,
            ':film_id' => $movie_id
        );

        // Ordernummer
        $lastInsertId = $this->db->insert($statement, $parameters);

        return array('customer' => $customer, 'lastInsertId' => $lastInsertId);
    }
}
