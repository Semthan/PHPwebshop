<?php

class UserModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function login($email, $password)
    {
        $stmt = "SELECT user_id, password, first_name, last_name FROM users WHERE email = :email";

        $user = $this->db->select($stmt, [':email' => $email]);

        if (!$user) {
            return "Invalid e-mail or password";
        } else {
            $user = $user[0];
            if (password_verify($password, $user['password'])) {
                session_start();

                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $user['user_id'];
                $_SESSION['name'] = $user['first_name'] . " " . $user['last_name'];
                $_SESSION['basket'] = [];

                header("location: index.php");
            } else {
                return "Invalid e-mail or password";
            }
        }
    }

    public function registerNewUser($params)
    {
        $stmt = "INSERT INTO users (user_id, first_name, last_name, email, tel, adress, password)
                 VALUES (NULL, :first_name, :last_name, :email, :tel, :adress, :password)";

        $userDetails = $params;

        $this->db->insert($stmt, $userDetails);
    }

    public function checkEmailAvailability($params)
    {
        $stmt = "SELECT * FROM users WHERE email = :email";
        $email = [':email' => $params];

        $response = $this->db->select($stmt, $email);

        if (!$response)
            return true;
    }
}
