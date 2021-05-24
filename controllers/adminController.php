<?php


class AdminController
{

    private $adminView;
    private $adminModel;

    public function __construct($adminModel, $adminView,)
    {
        $this->adminModel = $adminModel;
        $this->adminView = $adminView;
    }

    public function admin()
    {
        $url = getURL();
        $path = $url[0] ?? "";

        switch ($path) {
            case "orders":
                $this->orders();
                break;
            case "editProduct":
                $this->editProduct();
                break;
            default:
                $this->adminMenu();
                break;
        }
    }

    private function orders()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->adminModel->changeOrderStatus($_POST['id']);
            header("Refresh:0");
        }

        $orders = $this->adminModel->fetchAllOrders();
        $this->adminView->viewHeader("HEJ");
        $this->adminView->viewAdminOrders($orders);
        $this->adminView->viewFooter();
    }

    private function adminMenu()
    {
        $this->adminView->viewHeader("HEJ");
        $this->getAdminMenu();
        $this->adminView->viewFooter();
    }

    private function getAdminMenu()
    {
        $this->adminView->viewAdminMenu();
    }

    private function editProduct()
    {
        header("Location: ?page=editproduct&asignment=edit");
    }

    function getUrl()
    {
        if (isset($_GET['path'])) {
            $url = rtrim($_GET['path'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            //print_r($url);
            return $url;
        }
    }
}
