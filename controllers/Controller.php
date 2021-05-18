<?php

class Controller{

    private $model;
    private $view;

    public function __construct($model, $view){
        $this->model = $model;
        $this->view = $view;
    }

    private function getHeader($title){
        $this->view->viewHeader($title);
    }

    private function getFooter(){
        $this->view->viewFooter();
    }

    public function details(){
        $this->getHeader("//placeholder---varans titel//");
        $this->getFooter();
    }
    
    public function checkout(){
        $this->getHeader("Kassa");
        $this->getFooter();
    }

    public function showProfile(){
        $this->getHeader("//placeholder---användarens namn//");
        $this->getFooter();
    }

    public function admin(){
        $this->model; 
        $this->getHeader("Admin"); 
        echo "KEVIN";
        $this->getFooter();
    }

    public function showProducts(){
        $category = $_GET['category'] ?? "Välkommen";
        $this->getHeader($category);
        $this->getFooter();
    }    
}
