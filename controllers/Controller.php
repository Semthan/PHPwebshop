<?php

class Controller{

    private $model;
    private $register;
    private $view;

    public function __construct($model, $view, $register){
        $this->model = $model;
        $this->view = $view;
        $this->register_model = $register; 
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
            default:
                $this->showProducts();
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
        $this->registerUser();
        $this->getFooter();
    }

    private function registerUser(){
        $this->view->viewRegisterUser();
        if($_SERVER['REQUEST_METHOD']==='POST')
            $this->processRegistrationForm();
    }

    private function processRegistrationForm(){
        $errors = [];
        $userDetails = [];

        if(empty(trim($_POST['first_name']))){
            array_push($errors, "Förnamn saknas");
        }else{
            $userDetails[':first_name'] = $this->sanatize($_POST['first_name']);
        }
    
        if(empty(trim($_POST['last_name']))){
            array_push($errors, "Efternamn saknas");
        }else{
            $userDetails[':last_name'] = $this->sanatize($_POST['last_name']);
        }
    
        if(empty(trim($_POST['email']))){
            array_push($errors, "E-mail saknas");
        }else{
            $userDetails[':email'] = $this->sanatize($_POST['email']);
        }
    
        if(empty(trim($_POST['tel']))){
            array_push($errors, "Telefonnummer saknas");
        }else{
            $userDetails[':tel'] = $this->sanatize($_POST['tel']);
        }
    
        if(empty(trim($_POST['adress']))){
            array_push($errors, "Adress saknas");
        }else{
            $userDetails[':adress'] = $this->sanatize($_POST['adress']);
        }
    
        if(empty(trim($_POST['password']))){
            array_push($errors, "Lösenord saknas");
        }else{
            $userDetails[':password'] = $this->sanatize($_POST['password']);
        }
    
        if(count($errors)>0){
            return $errors;
        }else{
            $this->register_model->registerNewUser($userDetails);
        }
    }

    public function sanatize($text){
        $text = trim($text);
        $text = stripslashes($text);
        $text = htmlspecialchars($text);

        return $text;
    }
}
