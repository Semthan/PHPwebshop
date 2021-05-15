<?php

class UserView{    
    public function viewRegisterUser(){
        include_once("views/include/register.php");
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