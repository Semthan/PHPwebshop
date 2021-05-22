<?php

class OrderController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }


    public function createOrder($user_id, $basket = [])
    {
        $this->model->createOrderInDb($user_id, $basket);
        $_SESSION['basket'] = [];
        header('location: index.php');
    }

    public function shipOrder($order_id)
    {
        $this->model->changeOrderStatus($order_id);
    }
}
