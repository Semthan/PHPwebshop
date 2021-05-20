<?php
echo "<pre>";
$title = $product[0]["title"];
$price = $product[0]["price"];
$stock = $product[0]["stock"];
$img = $product[0]["img_src"];
$description = $product[0]["description"];
$category = $product[0]["category_id"];
$id = $product[0]["product_id"];

echo "</pre>";
    $product? 
    $Form ="
        <div class='input-group mb-3'>
            <form class='input-group-prepend' method='post' action=''>
                <input type='text' name='title' placeholder='title' value='$title'>
                <input type='text' name='price' placeholder='price' value='$price'>
                <input type='text' name='stock' placeholder='stock' value='$stock'>
                <input type='text' name='img_src' placeholder='img' value='$img'>
                <input type='text' name='description' placeholder='description' value='$description'>
                <input type='hidden' name='product_id' value='$id'>
                <select name='category_id' default='$category'>
                    <option value='1'> Tröjor </option>
                    <option value='3'> slipsar </option>
                    <option value='4'> byxor </option>
                </select>
                <button type='submit' class='btn btn-primary'>Primary</button>
            </form>
         </div>"
        
    :
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
    echo $Form;
?>