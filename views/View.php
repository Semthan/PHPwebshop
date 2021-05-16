<?php

class View
{
    public function viewHeader($title)
    {
        include_once("views/include/header.php");
    }

    public function viewFooter()
    {
        include_once("views/include/footer.php");
    }
    public function viewLandingPage($products)
    {
        include_once("views/include/landingPage.php");
        
    }

    public function viewDetailsPage()
    {
        include_once("views/include/details.php");
    }

    public function viewAdminPage()
    {
        include_once("views/include/admin.php");
    }

    public function viewCheckoutPage()
    {
        include_once("views/include/checkout.php");
    }

    public function viewProfilePage()
    {
        include_once("views/include/profile.php");
    }
}
