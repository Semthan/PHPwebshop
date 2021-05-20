<?php
     /* $product? */
     $Form = <<<HTML
        <div class='input-group mb-3'>
            <form class='input-group-prepend' method="post" action=''>
                <input type='text' name='title' placeholder='title'>
                <input type='text' name='price' placeholder='price'>
                <input type='text' name='stock' placeholder='stock'>
                <input type='text' name='img_src' placeholder='img'>
                <input type='text' name='description' placeholder='description'>
                <select name="category_id">
                    <option value="1"> Tröjor </option>
                    <option value="3"> slipsar </option>
                    <option value="4"> byxor </option>
                </select>
                <button type='submit' class='btn btn-primary'>Primary</button>
            </form>
         </div>
        HTML;
    
     /* $Form = "
         <form>
         <input placeholder='$product[title]'>
         <input placeholder='$product[price]'>
         
         </form>
     "; */
     echo $Form;
?>