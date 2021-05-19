<?php
    class ProductView{
        public function allProducts($products){
            echo "<a href='?product=add'>Add clothes</a>";
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

        public function productForm($product){
            include('views/include/products/productForm.php');

        }

    
    }
