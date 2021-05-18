<?php

class Populater
{
    private $db;


    public function __construct($database)
    {
        $this->db = $database;
    }


    public function productPop($products)

    {


        foreach ($products as $item => $key) {

            $stmt = "INSERT INTO products (product_id,title, price, stock, img_src, category_id, description)
                 VALUES (NULL, :title, :price, :stock, :img_src, :category, :description)";

            $productDetails = $key;

            $this->db->insert($stmt, $productDetails);
        }
    }
}
