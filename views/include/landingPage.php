<!-- <div class="row d-flex justify-content-center">
    <?php 
        /* foreach($products as $index){
            $product =
                "
                <div class=' m-1 card bg-success col-3'>
                    <img src='$index[img_src]' class='card-img-top' alt='$index[title]''>
                    <div class='card-body'>
                        <h5 class='card-title'>$index[title]</h5>
                        <p class='card-text'>Price $index[price]</p>
                        <a href='#' class='btn btn-primary'>Add To Cart</a>
                    </div>
                </div>
                ";    
            echo $product; 
        }  */
    ?>
</div> -->
<div class="row d-flex justify-content-center">
    <div class="img-fluid"style="background: url(https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.ikea.com%2Fms%2Fsv_SE%2Fimg%2Ffy17%2Fata%2Fikea-serie-seo-fargrik_PH141113_1060x460.jpg&f=1&nofb=1); height:250px">
        dsd
    </div>
    <h2>Categories</h2>
    <?php 
        foreach($products as $index){
            $product =
                "
                <div class=' m-1 card bg-success col-3'>
                    <div class='card-body'>
                        <a href='#' class='btn btn-primary'>$index[title]</a>
                    </div>
                </div>
                ";
 
            echo $product; 
        }
    ?>
</div>

    