<?php

class OrderController
{
    private $db;
    private $model;
    private $view;

    public function __construct($model, $view, $database)
    {
        $this->model = $model;
        $this->view = $view;
        $this->db = $database;
    }

    public function addToBasket($product_id, $amount)
    {

        $array = [];


        if (empty($_SESSION['basket'])) {
            $basket = $_SESSION['basket'];
            $product = ['id' => $product_id, 'amount' => $amount];
            array_push($basket, $product);
            $_SESSION['basket'] = $basket;
        } else {
            $basket = $_SESSION['basket'];

            foreach ($basket as $item) {
                array_push($array, $item['id']);
            }
            if (in_array($product_id, $array)) {
                foreach ($basket as $key => $item) {

                    if ($item['id'] === $product_id) {
                        $item['amount'] += $amount;
                        $basket[$key] = $item;
                    }
                }
            } else {

                $product = ['id' => $product_id, 'amount' => $amount];
                array_push($basket, $product);
            }
            $_SESSION['basket'] = $basket;
        }




        $stmt = "UPDATE products SET stock = stock -$amount WHERE product_id=$product_id";

        $this->db->insert($stmt);
    }



    public function createOrder($user_id, $basket = [])
    {
    }

    public function deleteOrder($order_id)
    {
    }
}