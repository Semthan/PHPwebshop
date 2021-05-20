<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <title><?php echo $title ?></title>
</head>

<body class="container">
    <div class="row">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <h1>Fakeia</h1>
                </a>
                <div class="collapse navbar-collapse nav-font">
                    <ul class="navbar-nav ms-auto">

                        <?php
                        if (isset($_SESSION['id'])) {
                            echo "<li class='nav-item' data-toggle='collapse' data-target='.navbar-collapse.show'>
                                    <a class='nav-link' href='?page=profile'>
                                        <h3>$_SESSION[name]</h3>
                                    </a>
                                  </li>";
                            echo "<li class='nav-item' data-toggle='collapse' data-target='.navbar-collapse.show'>
                                    <a class='nav-link' href='#'>
                                        <h3>Orders</h3>
                                    </a>
                                  </li>";
                            echo "<li class='nav-item' data-toggle='collapse' data-target='.navbar-collapse.show'>
                                    <a class='nav-link' href='#'>
                                        <h3>Cart</h3>
                                    </a>
                                  </li>";
                            echo "<li class='nav-item' data-toggle='collapse' data-target='.navbar-collapse.show'>
                                    <a class='nav-link' href='?page=logout'>
                                        <h3>Log out</h3>
                                    </a>
                                  </li>";
                        } else {
                            echo "<li class='nav-item' data-toggle='collapse' data-target='.navbar-collapse.show'>
                                        <a class='nav-link' href='?page=login'>
                                        <h3>Login</h3>
                                        </a>
                                  </li>";
                            echo "<li class='nav-item' data-toggle='collapse' data-target='.navbar-collapse.show'>
                                        <a class='nav-link' href='?page=register'>
                                            <h3>Register</h3>
                                        </a>
                                  </li>";

                            echo "<li class='nav-item' data-toggle='collapse' data-target='.navbar-collapse.show'>
                                    <a class='nav-link' href='#'>
                                        <h3>Cart</h3>
                                    </a>
                                  </li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <hr>
    </div>