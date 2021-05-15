<?php

$username = "";
$password = "";
$username_error = "";
$password_error = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Enter a username"
    }else{
        $sql = "SELECT id FROM users WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql))
    }
}
