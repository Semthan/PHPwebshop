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


    public function createOrder($user_id, $basket = [])
    {
    }

    public function deleteOrder($order_id)
    {
    }
}
