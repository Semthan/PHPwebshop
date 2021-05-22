<?php

class UserModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function login($email, $password){
        $stmt = "SELECT user_id, password, first_name, last_name, admin FROM users WHERE email = :email";

        $user = $this->db->select($stmt, [':email' => $email]);

        if (!$user) {
            return false;
        } else {
            $user = $user[0];
            if (password_verify($password, $user['password'])) {
                session_start();

                $_SESSION['loggedin'] = true;
                $_SESSION['admin'] = $user['admin'];
                $_SESSION['id'] = $user['user_id'];
                $_SESSION['name'] = $user['first_name'] . " " . $user['last_name'];

                $user['admin'] ? header("location: index.php?page=admin") : header("location: index.php");
            }else{
                return false;
            }
        }
    }

    public function registerNewUser($params){
        $stmt = "INSERT INTO users (user_id, first_name, last_name, email, tel, adress, password, admin)
                 VALUES (NULL, :first_name, :last_name, :email, :tel, :adress, :password, 0)";
        
        $userDetails = $params;

        $this->db->insert($stmt, $userDetails);
    }

    public function updateUserInDb($params)
    {
        $stmt = "UPDATE users SET 
                first_name = :first_name, 
                last_name = :last_name, 
                email = :email,
                tel = :tel,
                adress = :adress,
                password = :password
                WHERE user_id = :id";

        $userDetails = $params;
        $_SESSION['name'] = $params[':first_name'] . " " . $params[':last_name'];

        $_SESSION['name'] = $userDetails[':first_name'] . " " . $userDetails[':last_name'];
        $this->db->update($stmt, $userDetails);

        header("Refresh:0");
    }

    // public function deleteUserFromDb($params){
    //     $stmt = "DELETE FROM users WHERE user_id = :id";

    //     $id = [":id" => $params];

    //     $this->db->delete($stmt, $id);
    // }

    public function checkEmailAvailability($params){
        $stmt = "SELECT * FROM users WHERE email = :email";
        $email = [':email' => $params];

        $unAvailable = $this->db->select($stmt, $email);

        if ($unAvailable && $unAvailable[0]['user_id'] !== $_SESSION['id'])
            return false;
    }

    public function getCurrentUser($params)
    {
        $stmt = "SELECT * FROM users WHERE user_id = :id";

        $id = [':id' => $params];

        return $this->db->select($stmt, $id);
    }    

    public function updateStockOnLogout($cart){
        foreach($cart as $item){
            $stmt = "UPDATE products SET stock = stock + :amount WHERE product_id = :id";

            $inputParams = [
                ":amount" => $item['amount'],
                ":id" => $item['id']
            ];

            $this->db->update($stmt, $inputParams);
        }
    }
}
