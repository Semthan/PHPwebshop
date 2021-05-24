<?php
class CartController
{

    private $productModel;
    private $db;
    private $view;

    public function __construct($model, $view, $database, $productModel)
    {
        $this->model = $model;
        $this->view = $view;
        $this->db = $database;
        $this->productModel = $productModel;
    }

    public function removeFromBasket($product_id, $amount){
        $basket = $_SESSION['basket'];

        foreach ($basket as $key => $item) {
            if ($item['id'] === $product_id) {
                if($item['amount'] == 1){
                    unset($basket[$key]);
                }else{
                    $item['amount'] -= $amount;
                    $basket[$key] = $item;
                }
            
            }
        }

        $stmt = "UPDATE products SET stock = stock +$amount WHERE product_id=$product_id";
        $this->db->update($stmt);

        $_SESSION['basket'] = $basket;
        
        header("location: index.php");

    }

    public function addToCart($product_id, $amount, $path)
        {
    
            $array = [];
    
    
            if (empty($_SESSION['basket'])) {
                $basket = $_SESSION['basket'];
                $product = ['id' => $product_id, 'amount' => $amount];
                array_push($basket, $product);
                $_SESSION['basket'] = $basket;
            } else {
                $basket = $_SESSION['basket'];
    
                foreach ($basket as $item) {
                    array_push($array, $item['id']);
                }
                if (in_array($product_id, $array)) {
                    foreach ($basket as $key => $item) {
    
                        if ($item['id'] === $product_id) {
                            $item['amount'] += $amount;
                            $basket[$key] = $item;
                        }
                    }
                } else {
    
                    $product = ['id' => $product_id, 'amount' => $amount];
                    array_push($basket, $product);
                }
                $_SESSION['basket'] = $basket; 
            }
            
            header("location:". $path);
    
            $stmt = "UPDATE products SET stock = stock -$amount WHERE product_id=$product_id";
    
            $this->db->update($stmt);
        }
    
    
    public function cart(){
        $productData = [];
        foreach($_SESSION["basket"] as $item){
            $product = $this->productModel->fetchOneProduct($item["id"]);
            array_push($productData, $product);
        }

        $this->view->cartProducts($_SESSION["basket"],  $productData);
    }

    public function updateStockOnSessionEnd($cart){
        foreach($cart as $item){
            $stmt = "UPDATE products SET stock = stock + :amount WHERE product_id = :id";

            $inputParams = [
                ":amount" => $item['amount'],
                ":id" => $item['product_id']
            ];

            $this->db->update($stmt, $inputParams);
        }
    }

    public function cart2(){
        $path = $_GET['path'] ?? "";
        $id = $_GET['id'] ?? "";
        ECHO "hej";

        switch ($path) {
            case "add":
                $this->addToCart($id, 1, "index.php");
                break;
            case "remove":
            //$this->addToCart($id, 1, "index.php?");
                    break;
            default:
                $this->cart();
            break;  
        } 
    }
}


    ?>