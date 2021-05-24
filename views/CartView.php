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
        for ($x = 0; $x < count($products); $x++) {
            $title = $products[$x][0]['title'];
            $id = $products[$x][0]['product_id'];
            $price = $products[$x][0]['price'];
            $img = $products[$x][0]['img_src'];
            $available = $products[$x][0]['available'];
            $amount = $cart[$x]['amount'];

            $html = <<<HTML
                <div class="row d-flex m-2 p-2 text-center border">
                    <div class="col-2">
                        <img src="$img" class="img-thumbnail border-white">
                    </div>
                    <div class="col-4">
                        <h5>$title</h5>
                    </div>  
                    <div class="col-4">
                        <p>$price</p>
                    </div> 
                    <div class="col-2">
                    <a href="?page=cart&path=add&id=$id&cart=true"><i class="text-dark fas fa-plus"></i></a>
                        <p>$amount</p>
                        <a href="?page=cart&path=remove&id=$id&cart=true"><i class="text-dark fas fa-minus"></i></a>
                    </div> 
                </div>    
            HTML;
            echo $html;
        }
        echo "</pre>";
        echo "<a href='?page=order'>Create order</a>";
    }
}
