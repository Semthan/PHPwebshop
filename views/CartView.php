<?php

class CartView
{

    public function cartProducts($cart, $products)
    {
        include_once('include/header.php');
        echo '<pre>';
        print_r($_SESSION['basket']);

        for ($x = 0; $x < count($products); $x++) {
            $title = $products[$x][0]['title'];
            $id = $products[$x][0]['product_id'];
            $price = $products[$x][0]['price'];
            $img = $products[$x][0]['img_src'];
            $available = $products[$x][0]['available'];
            $amount = $cart[$x]['amount'];


            $productCard = "
                    <div class='card m-auto text-center' style='width: 10rem;'>
                        <img src='$img' class='card-img-bottom' alt='...'>
                        <div class='card-body'>
                            <h5 class='card-title'>$title</h5>
                            <p class='card-text'>$price</p>
                            <p class='card-text'>$amount</p>
                            <p class='card-text'>$id</p>";

            if($available){
                $productCard .= "
                    <a href='?page=addToCart&id=$id&cart=true'><p>+</p></a>
                ";
            }

            $productCard .= "
                            <a href='?page=removefrombasket&id=$id&cart=true'><p>-</p></a>
                        </div>
                    </div>";

            echo $productCard;
        }

        echo "<a href='?page=order'>Create order</a>";
        include_once('include/footer.php');
    }
}
