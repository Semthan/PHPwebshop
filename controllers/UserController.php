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

    public function updateUser(){
        $currentDetails = $this->model->getCurrentUser($_SESSION['id']);
        $userData = [
            "first_name" => $currentDetails[0]['first_name'],
            "last_name" => $currentDetails[0]['last_name'],
            "email" => $currentDetails[0]['email'],
            "tel" => $currentDetails[0]['tel'],
            "adress" => $currentDetails[0]['adress'],
        ];
        $this->view->viewUpdateUser($userData);
        if($_SERVER['REQUEST_METHOD']==='POST')
            $this->processUpdateUserForm($currentDetails);
    }

    public function deleteUser(){
        $id = $_SESSION['id'];
        $this->logout();
        $this->model->deleteUserFromDb($id);
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
        }elseif($this->model->checkEmailAvailability($email)===false){ 
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
                ":password" => password_hash($password, PASSWORD_DEFAULT),
            ];
            $this->model->registerNewUser($userDetails);
            // loggar in och routar till index direkt efter ok registrering
            $this->login();
        }
    }

    private function processUpdateUserForm($currentDetails){
        $errors = [];
        $userDetails = [];

        $first_name = $this->sanatize($_POST['first_name']);
        $last_name = $this->sanatize($_POST['last_name']);
        $email = $this->sanatize($_POST['email']);
        $tel = $this->sanatize($_POST['tel']);
        $adress = $this->sanatize($_POST['adress']);

        $passwordInput = $this->sanatize($_POST['password']);
        
        $password = $passwordInput ? password_hash($passwordInput, PASSWORD_DEFAULT) 
                                   : $currentDetails[0]['password'];

        if(!$first_name)
            $first_name = $currentDetails[0]['first_name'];

        if(!$last_name)
            $last_name = $currentDetails[0]['last_name'];


        if(!$email){
            $email = $currentDetails[0]['email'];
        }elseif($this->model->checkEmailAvailability($email)===false){ 
            array_push($errors, "E-mail redan registrerad");
        }

        if(!$tel)
            $tel = $currentDetails[0]['tel'];

        if(!$adress)
            $adress = $currentDetails[0]['adress'];
                
        if(count($errors)>0){
            $this->view->printMessage($errors);
        }else{
            $userDetails = [
                ":first_name" => $first_name,
                ":last_name" => $last_name,
                ":email" => $email,
                ":tel" => $tel,
                ":adress" => $adress,
                ":password" => $password,
                ":id" => $_SESSION['id']
            ];
            $this->model->updateUserInDb($userDetails);
        }
    }

    private function sanatize($text){
        $text = trim($text);
        $text = stripslashes($text);
        $text = htmlspecialchars($text);

        return $text;
    }
}