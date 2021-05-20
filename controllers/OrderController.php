<?php

class OrderController{

    private $model;

    public function __construct($model){
        $this->model = $model;
    }

    public function testCreateOrder(){
        $basket = [
            [
                "id" => 4,
                "amount" => 2
            ],
            [
                "id" => 2,
                "amount" => 1
            ]
        ];
        
        $this->model->createOrderInDb(1, $basket);
    }

    public function testDeleteOrder(){
        $order_id = 2;
        $this->model->deleteOrderInDb($order_id);
    }
}