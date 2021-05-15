<?php

class UserController{

    private $model;
    private $view;

    public function __construct($model, $view){
        $this->model = $model;
        $this->view = $view;
        $this->router();
    }

    private function router(){
        $page = $_GET['page'] ?? "";

        switch($page){
            case "register":
                $this->registerUser();
                break;
            case "login":
                $this->login();
                break;
        }
    }

    private function login(){

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
            
            $email = $this->sanatize($_POST['email']);

            if($this->model->checkEmailAvailability($email)!==true){
                array_push($errors, "E-mail redan registrerad");
            }else{
                $userDetails[':email'] = $email;
            }
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
            $password = $this->sanatize($_POST['password']);
            $userDetails[':password'] = password_hash($password, PASSWORD_DEFAULT);
        }
    
        if(count($errors)>0){
            $this->view->printMessage($errors);
        }else{
            $this->model->registerNewUser($userDetails);
        }
    }

    public function sanatize($text){
        $text = trim($text);
        $text = stripslashes($text);
        $text = htmlspecialchars($text);

        return $text;
    }
}