<?php

    class AdminView{

        public function viewHeader($title)
        {
            include_once("views/include/header.php");
        }
        public function viewFooter()
        {
            include_once("views/include/footer.php");
        }

        public function viewAdminOrders($orders)
        {   

            foreach ($orders as $current) {
                $id= $current['order_id'];
                $date= $current['order_date'];
                
                $current['shipped']? $shipped = "Shipped": $shipped = "not shipped"; 
                $order = "
                <div class='col-4 border'>
                    <p>Order ID: $id</p>
                    <p>Date: $date</p>
                    <p>Shipped: $shipped</p>
                    
                    <form method='POST' action=''>
                        <input type='hidden' value='$id' name='id'>
                        <button type='submit' class='btn btn-primary' value=''>Primary</button></a>
                    </form>
                </div>
                    ";

                echo $order;
            }
            echo "</div>"; 
        }

        public function viewAdminMenu(){
            $html = <<<HTML
            <div>
                <a href="?page=admin&path=orders"> ORDERS</a>
                <a href='?page=editproduct&asignment=showproducts'> EDIT ORDERS</a> 
            </div>
            
            HTML;
            echo $html;
        }

        public function AdminViewAllProducts($products){
            
            echo "<a href='?page=editproduct&asignment=add'>Add clothes </a>";
            echo "<div class='row'>";
            foreach ($products as $current) {
                $html = <<<HTML
                <div class='col-4'>
                    <p>$current[title]</p>
                    <a href='?page=editproduct&asignment=edit&id=$current[product_id]'> edit </a>
                    <a href='?delete=$current[product_id]'> delete </a>
                </div>
                HTML;
                echo $html;
            }
            echo "</div>";
        }

    }

?>