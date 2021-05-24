<?php

class CartView
{
    public function viewHeader()
    {
        include_once("views/include/header.php");
    }

    public function viewFooter()
    {
        include_once("views/include/footer.php");
    }

    public function viewCartProducts($cart, $products)
    {
        echo '<pre>';
        print_r($_SESSION['cart']);
        print_r($products);

        for ($x = 0; $x < count($products); $x++) {
            $title = $products[$x][0]['title'];
            $id = $products[$x][0]['product_id'];
            $price = $products[$x][0]['price'];
            $img = $products[$x][0]['img_src'];
            $amount = $cart[$x]['amount'];


            $productCard = <<<HTML
                <div class='card m-auto text-center' style='width: 10rem;'>
                    <img src='$img' class='card-img-bottom' alt='...'>
                    <div class='card-body'>
                        <h5 class='card-title'>title: $title</h5>
                        <p class='card-text'>price: $price</p>
                        <p class='card-text'>amount: $amount</p>
                        <p class='card-text'>id: $id</p>
                        <a href='?page=cart&path=add&id=$id&cart=true'><p>+</p></a>
                        <a href='?page=cart&path=remove&id=$id&cart=true'><p>-</p></a>
                        </div>
                </div>
                HTML;

            echo $productCard;
        }
        echo "</pre>";
        echo "<a href='?page=order'>Create order</a>";
    }
}
