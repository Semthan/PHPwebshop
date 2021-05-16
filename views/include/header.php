<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
</head>

<body class="container">
    <h1 class="text-center"><?php echo $title; ?></h1>
    <?php
        if(isset($_SESSION['id'])){
            echo "<p>Logged in as $_SESSION[name]</p>";
            echo "<a href='?page=logout'>Log out</a>";
        }else{
            echo "<a href='?page=login'>Log in</a>";
        }
    ?>