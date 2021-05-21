<?php

    class CartView{

        public function cartProducts($cart, $products){
            include_once('include/header.php');
            /* echo '<pre>';
            print_r($products); */
            for($x = 0; $x < count($products); $x++){
                $productCard = "
                    <div>
                        <h3>$products[$x][0][title]</h3>
                        <h3>$products[$x][0][product_id]</h3>
                    </div>
                ";
                //print_r($products[$x][0]['title']);
                echo $products[$x][0]['title'];
            }

            /* foreach($cart as $item){
                echo '<pre>';
                print_r($item);
                print_r($products[$item['id']]);

                echo '</pre>';
            } */
            include_once('include/footer.php');
        }

    }
?>