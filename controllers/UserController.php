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
        $error = [0 => "Invalid e-mail or password"];

        $emailInput = $this->sanatize($_POST['email']);
        $passwordInput = $this->sanatize($_POST['password']);

        if(empty($emailInput) || empty($passwordInput)){
            $this->view->printMessage($error);
        }else{
            $status = $this->model->login($emailInput, $passwordInput);
            if(!$status)
                $this->view->printMessage($error);
        }
    }

    private function processRegistrationForm(){
        $errors = [];
        $userDetails = [];

        $first_name = $this->sanatize($_POST['first_name']);
        $last_name = $this->sanatize($_POST['last_name']);
        $email = $this->sanatize($_POST['email']);
        $tel = $this->sanatize($_POST['tel']);
        $adress = $this->sanatize($_POST['adress']);
        $password = $this->sanatize($_POST['password']);

        if(!$first_name)
            array_push($errors, "Förnamn saknas");

        if(!$last_name)
            array_push($errors, "Efternamn saknas");
        
        if(!$email){
            array_push($errors, "E-mail saknas");
        }elseif($this->model->checkEmailAvailability($email)!==true){ 
            array_push($errors, "E-mail redan registrerad");
        }

        if(!$tel)
            array_push($errors, "Telefonnummer saknas");

        if(!$adress)
            array_push($errors, "Adress saknas");
        
        if(!$password)
            array_push($errors, "Lösenord saknas");

    
        if(count($errors)>0){
            $this->view->printMessage($errors);
        }else{
            $userDetails = [
                ":first_name" => $first_name,
                ":last_name" => $last_name,
                ":email" => $email,
                ":tel" => $tel,
                ":adress" => $adress,
                ":password" => password_hash($password, PASSWORD_DEFAULT)
            ];
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