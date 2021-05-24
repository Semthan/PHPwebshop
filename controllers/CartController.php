<?php
class CartController
{

    private $productModel;
    private $db;
    private $view;

    public function __construct($model, $cartView, $database, $productModel)
    {
        $this->model = $model;
        $this->cartView = $cartView;
        $this->db = $database;
        $this->productModel = $productModel;
    }

    public function cart(){
        $path = $_GET['path'] ?? "";
        $id = $_GET['id'] ?? "";

        switch ($path) {
            case "add":
                $this->addToCart($id, 1, "index.php");
                break;
            case "remove":
            $this->removeFromcart($id, 1);
                    break;
            case "showcart":
            $this->showCart();
                    break;
            default:
            break;  
        } 
    }

    public function removeFromcart($product_id, $amount){
        $cart = $_SESSION['cart'];

        foreach ($cart as $key => $item) {
            if ($item['id'] === $product_id) {
                if($item['amount'] == 1){
                    unset($cart[$key]);
                }else{
                    $item['amount'] -= $amount;
                    $cart[$key] = $item;
                }
            
            }
        }

        $stmt = "UPDATE products SET stock = stock +$amount WHERE product_id=$product_id";
        $this->db->update($stmt);

        $_SESSION['cart'] = $cart;
        
        isset($_GET['index'])?header("location: index.php"):header("location: index.php?page=cart");

       

    }

    public function addToCart($product_id, $amount){
        $array = [];
        if (empty($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            $product = ['id' => $product_id, 'amount' => $amount];
            array_push($cart, $product);
            $_SESSION['cart'] = $cart;
        } else {
            $cart = $_SESSION['cart'];

            foreach ($cart as $item) {
                array_push($array, $item['id']);
            }
            if (in_array($product_id, $array)) {
                foreach ($cart as $key => $item) {

                    if ($item['id'] === $product_id) {
                        $item['amount'] += $amount;
                        $cart[$key] = $item;
                    }
                }
            } else {

                $product = ['id' => $product_id, 'amount' => $amount];
                array_push($cart, $product);
            }
            $_SESSION['cart'] = $cart; 
        }
        
        isset($_GET['index'])?header("location: index.php"):header("location: index.php?page=cart&path=showcart");
            
        $stmt = "UPDATE products SET stock = stock -$amount WHERE product_id=$product_id";

        $this->db->update($stmt);
    }
    
    public function showCart(){
        $productData = [];
        foreach($_SESSION["cart"] as $item){
            $product = $this->productModel->fetchOneProduct($item["id"]);
            array_push($productData, $product);
        }

        $this->cartView->viewHeader();
        $this->getCartProducts($productData);
        $this->cartView->viewFooter();
    }

    public function getCartProducts($productData){
        $this->cartView->viewCartProducts($_SESSION["cart"],  $productData);
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

}
