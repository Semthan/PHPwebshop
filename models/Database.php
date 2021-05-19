<?php

class Database
{
    private $conn = null;

    public function __construct($database, $username = "root", $password = "root",  $servername = "localhost")
    {
        $dsn = "mysql:host=$servername;dbname=$database;charset=UTF8";

        try {
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }


    private function execute($statement, $input_parameters = [])
    {
        try {
            $stmt = $this->conn->prepare($statement);
            $stmt->execute($input_parameters);
            return $stmt;
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage() . "<br>";
            throw new Exception($e->getMessage()());
        }
    }

    public function select($statement, $input_parameters = [])
    {
        $stmt = $this->execute($statement, $input_parameters);
        return $stmt->fetchAll();
    }

    public function insert($statement, $input_parameters = [])
    {
        $stmt = $this->execute($statement, $input_parameters);
        return $this->conn->lastInsertId();
    }

    public function update($statement, $input_parameters = [])
    {
        $stmt = $this->execute($statement, $input_parameters);
    }

    public function delete($statement, $input_parameters = [])
    {
        $stmt = $this->execute($statement, $input_parameters);
    }
}
