<?php
    class ProductView{
        public function allProducts($products){
 
            echo "<div class='row'>";
            foreach($products as $current){
                $product = "
                    <div class='col-4'>
                    <p>$current[title]</p>
                    <a href='#'> edit </a>
                    <a href='?delete=$current[product_id]'> delete </a>
                    </div>
                    
                ";
                echo $product;
             }
            echo "</div>";
        }
    }
