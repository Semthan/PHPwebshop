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

        echo json_encode($_SESSION['basket']);
        // foreach ($products as $item => $key) {

        //     $stmt = "INSERT INTO products (product_id,title, price, stock, img_src, category_id, description)
        //          VALUES (NULL, :title, :price, :stock, :img_src, :category, :description)";

        //     $productDetails = $key;

        //     $this->db->insert($stmt, $productDetails);
        // }
    }

    public function categoryPop($categories)
    {


        foreach ($categories as $item => $key) {
            $stmt = "INSERT INTO category (category_id,title)
                 VALUES (NULL, :title)";
            $categoryDetails = $key;

            $this->db->insert($stmt, $categoryDetails);
        }
    }
}
