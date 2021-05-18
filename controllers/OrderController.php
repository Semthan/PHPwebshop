<?php

class OrderController{

    private $model;
    private $view;

    public function __construct($model, $view){
        $this->model = $model;
        $this->view = $view;
    }

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

    public function createOrder($user_id, $basket = []){
        
    }

    public function deleteOrder($order_id){

    }
}