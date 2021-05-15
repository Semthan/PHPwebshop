<?php

class UserModel{
    private $db;

    public function __construct($database){
        $this->db = $database;
    } 

    public function registerNewUser($params){
        $stmt = "INSERT INTO users (user_id, first_name, last_name, email, tel, adress, password)
                 VALUES (NULL, :first_name, :last_name, :email, :tel, :adress, :password)";
        
        $userDetails = $params;
            
        $this->db->insert($stmt, $userDetails);
    }

    public function checkEmailAvailability($params){
        $stmt = "SELECT * FROM users WHERE email = :email";
        $email = [':email'=>$params];

        $response = $this->db->select($stmt, $email);

        if(!$response)
            return true;
    }
}
