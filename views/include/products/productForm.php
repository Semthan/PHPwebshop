<?php
     $product?
     $Form = "
     <div class='input-group mb-3'>
     <form class='input-group-prepend method='POST' action='addproduct.php'>
         <input type='text' placeholder='title'>
         <input type='text' placeholder='price'>
         <input type='text' placeholder='stock'>
         <input type='text' placeholder='img'>
         <select>
             <option> Tröjor </option>
             <option> slipsar </option>
             <option> byxor </option>
         </select>
         <input placeholder='description'>
         <button type='submit' class='btn btn-primary'>Primary</button>
         </form>
         </div>
     ":
     $Form = "
         <form>
         <input placeholder='$product[title]'>
         <input placeholder='$product[price]'>
         
         </form>
     ";
     echo $Form;
?>