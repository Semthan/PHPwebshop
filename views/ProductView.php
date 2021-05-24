<?php
class ProductView
{
    public function viewHeader()
    {
        include_once("views/include/header.php");
    }

    public function viewFooter()
    {
        include_once("views/include/footer.php");
    }

    public function AdminViewAllProducts($products)
    {

        echo "<a href='?page=editproduct&asignment=add'>Add clothes </a>";
        echo "<div class='row'>";
        foreach ($products as $current) {
            $html = <<<HTML
                <div class='col-4'>
                    <p>$current[title]</p>
                    <a href='?page=editproduct&asignment=edit&id=$current[product_id]'> edit </a>
                    <a href='?page=editproduct&asignment=delete&id=$current[product_id]'> delete </a>
                </div>
                HTML;
            echo $html;
        }
        echo "</div>";
    }

    public function productForm($product)
    {
        include('views/include/products/productForm.php');
    }

    public function customerViewProducts($products)
    {
        foreach ($products as $current) {
            if($current['available']){
                echo "<div class='card m-auto text-center' style='width: 10rem;'>
                <img src='$current[img_src]' class='card-img-bottom' alt='...'>
                <div class='card-body'>
                    <h5 class='card-title'>$current[title]</h5>
                    <p class='card-text'>$current[price]</p>
                    <a href='?page=cart&path=add&id=$current[product_id]&index=true'><button class='btn btn-dark'>Add to cart</button></a>
                    <a href='?page=remove&id=$current[product_id]&index=true'><p>-</p></a>
                </div>
                </div>";
            }
        }
    }
}
