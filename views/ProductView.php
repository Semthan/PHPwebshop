<?php
    class ProductView{
        public function allProducts($products){
 
            echo "<div class='d-flex'>";
            foreach($products as $current){
                $product = "
                    
                    <p>$current[title]</p>
                    <a href='#'> edit </a>
                    <a href='?delete=$current[product_id]'> delete </a>
                    
                ";
                echo $product;
             }
            echo "</div>";
        }
    }
