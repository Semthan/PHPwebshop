<?php
class ProductView
{
    public function allProducts($products)
    {
        echo "<a href='?product=add'>Add clothes </a>";
        echo "<div class='row'>";
        foreach ($products as $current) {
            $product = "
                    <div class='col-4'>
                    <p>$current[title]</p>
                    <a href='?product=edit&id=$current[product_id]'> edit </a>
                    <a href='?delete=$current[product_id]'> delete </a>
                    </div>
                    
                ";
            echo $product;
        }
        echo "</div>";
    }

    public function productForm($product)
    {
        include('views/include/products/productForm.php');
    }

    public function showProducts($products)
    {
        
        foreach ($products as $current) {
            echo "<div class='card m-auto text-center' style='width: 10rem;'>
            <img src='$current[img_src]' class='card-img-bottom' alt='...'>
            <div class='card-body'>
                <h5 class='card-title'>$current[title]</h5>
                <p class='card-text'>$current[price]</p>
                <a href='?page=addtobasket&id=$current[product_id]&index=true'><button class='btn btn-dark'>Add to cart</button></a>
                <a href='?page=removefrombasket&id=$current[product_id]&index=true'><p>-</p></a>
            </div>
            </div>";
        }
    }
}
