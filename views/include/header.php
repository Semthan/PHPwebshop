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
                <a class="navbar-brand" href="#">
                    <h1>Logo</h1>
                </a>
                <div class="collapse navbar-collapse nav-font">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item" data-toggle="collapse" data-target=".navbar-collapse.show">
                            <a class="nav-link" href="#">
                                <h3>Login</h3>
                            </a>
                        </li>
                        <li class="nav-item" data-toggle="collapse" data-target=".navbar-collapse.show">
                            <a class="nav-link" href="?page=register">
                                <h3>Register</h3>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <?php
    if (isset($_SESSION['id'])) {
        echo "<p>Logged in as $_SESSION[name]</p>";
        echo "<a href='?page=logout'>Log out</a>";
    } else {
        echo "<a href='?page=login'>Log in</a>";
    }
    ?>