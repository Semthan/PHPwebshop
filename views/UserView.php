<?php

class UserView{    

    public function viewHome(){
        include_once("views/include/header.php");
        include_once("views/include/footer.php");
    }

    public function viewRegisterUser(){
        include_once("views/include/register.php");
    }

    public function viewUpdateUser($userData){
        include_once("views/include/profile.php");
    }

    public function viewLogin(){
        include_once("views/include/login.php");
    }

    public function printMessage($errors){

        $template = "<ul>";
        foreach($errors as $error){
            $template .= "<li>$error</li>";
        }
        $template .= "</ul>";
        
        echo $template;
    }
}