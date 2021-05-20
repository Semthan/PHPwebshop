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

        $basket = $_SESSION['basket'];
        if (empty($basket)) {
            $product = ['id' => $product_id, 'amount' => $amount];
            array_push($basket, $product);
        } else {
            foreach ($basket as $item) {
                if ($item['id'] === $product_id) {
                    $item['amount'] = $item['amount'] + $amount;
                } else {
                    $product = ['id' => $product_id, 'amount' => $amount];
                    array_push($basket, $product);
                }
            }
        }


        // foreach ($basket as $item) {
        //     array_push($array, $item['id']);
        // }

        // if (in_array($product_id, $array)) {


        //     foreach ($basket as $item => $key) {
        //         if ($key['id'] === $product_id) {

        //             // $keyValue = $key['amount'] + $amount;
        //             $key['amount'] =  $key['amount'] + $amount;
        //         }
        //         echo $key['amount']; //Rätt amount
        //     }
        //     //Nollställer :(

        // } else {




        //     $product = ["id" => $product_id, "amount" => $amount];
        //     echo "Hello World";
        //     array_push($basket, $product);
        // }
        echo gettype($basket);
        $_SESSION['basket'] = $basket;
        $stmt = "UPDATE products SET stock = stock -$amount WHERE product_id=$product_id";

        $this->db->insert($stmt);
    }

    // public function countBasket($count)
    // {
    //     return $count + 1;
    // }
    // basket = [
    //     [
    //         "id"=>$product_id,
    //         "amount"=>5
    //     ],
    //     [
    //         "id"=>$product_id,
    //         "amount"=>2
    //     ]
    // ]

    public function createOrder($user_id, $basket = [])
    {
    }

    public function deleteOrder($order_id)
    {
    }
}
