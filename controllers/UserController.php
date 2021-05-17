<?php

class UserController{

    private $model;
    private $view;

    public function __construct($model, $view){
        $this->model = $model;
        $this->view = $view;
    }

    public function login(){
        $this->view->viewLogin();
        if($_SERVER['REQUEST_METHOD']==='POST')
            $this->processLoginForm();
    }

    public function logout(){
        session_start();
        $_SESSION = [];
        session_destroy();
        header("location: index.php");
    }
    
    public function registerUser(){
        $this->view->viewRegisterUser();
        if($_SERVER['REQUEST_METHOD']==='POST')
            $this->processRegistrationForm();
    }

    private function processLoginForm(){
        $errors = ["Invalid e-mail or password"];

        $emailInput = $this->sanatize($_POST['email']);
        $passwordInput = $this->sanatize($_POST['password']);

        if(empty($emailInput) || empty($passwordInput)){
            $this->view->printMessage($errors);
        }else{
            $this->model->login($emailInput, $passwordInput);
        }
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

    private function sanatize($text){
        $text = trim($text);
        $text = stripslashes($text);
        $text = htmlspecialchars($text);

        return $text;
    }
}