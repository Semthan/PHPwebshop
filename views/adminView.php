<?php

    class AdminView{

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
    }

?>