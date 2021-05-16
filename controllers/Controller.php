<?php

class Controller{

    private $model;
    private $view;

    public function __construct($model, $view){
        $this->model = $model;
        $this->view = $view;
    }

    public function main(){
        $this->router();
    }

    private function router(){
        $page = $_GET['page'] ?? "";

        switch($page){
            case "details":
                $this->details();
                break;
            case "checkout":
                $this->checkout();
                break;
            case "profile":
                $this->showProfile();
                break;
            case "admin":
                $this->admin();
                break;
            case "products";
                $this->showProducts();
            default:
                $this->landingPage();
        }
    }

    private function getHeader($title){
        $this->view->viewHeader($title);
    }

    private function getFooter(){
        $this->view->viewFooter();
    }

    private function details(){
        $this->getHeader("//placeholder---varans titel//");
        $this->getFooter();
    }
    
    private function checkout(){
        $this->getHeader("Kassa");
        $this->getFooter();
    }

    private function showProfile(){
        $this->getHeader("//placeholder---användarens namn//");
        $this->getFooter();
    }

    private function admin(){
        $this->getHeader("Admin");
        $this->getFooter();
    }
    
    private function showProducts(){
        $category = $_GET['category'] ?? "Välkommen";
        $this->getHeader($category);
        $this->getFooter();
    }

    private function landingPage(){
        
        $this->getHeader("Logo");
        $products = $this->model->fetchAllProducts();
        $this->view->viewLandingPage($products);
        $this->getFooter();
    }
}