<?php 
include "inc/header.php";

$userid = $_SESSION['user']['userid'];


?>
 
<div class="main">
    <div class="welcome">
        <img src="img/YL4uVxoZzzZzq0rOKLbY.jpeg" height="150px" width="120px" >
        <div>
            <h1>Orders</h1>
            <p>Fames ac turpis egestas sed tempus urna et. Mattis pellentesque id nibh tortor.
                Dui vivamus arcu felis bibendum ut tristique et. Odio tempor orci dapibus ultrices in.
                A condimentum vitae sapien pellentesque habitant. In nisl nisi scelerisque eu. Ultrices
                dui sapien eget mi proin.</p>
        </div>
    </div>
    <section class="products">
        <div class="container-box">
            <?php
            $orders = getOrderByUserId($userid);
            while($order=mysqli_fetch_assoc($orders)){
                $orderid = $order['orderid'];
                $productid = $order['productid'];
                $product = getProductById($productid);
                echo "<form action='' method='POST' class='box'>";
                echo "<a href='viewproduct.php?pid=$productid'><img class='image' src='img/".$product['image']. "'/></a>";
                if($order['status']=='canceled'){
                    echo "<button disabled type='submit' id='deleteFromCart' name='cancel'><i class='fa-solid fa-xmark'></i></button>";
                    echo "<p class='status'>Canceled</p>";
                }
                else if($order['status']=='delivered'){
                    echo "<button disabled type='submit' id='deleteFromCart' name='cancel'><i class='fa-solid fa-check'></i></i></button>";
                    echo "<p class='status'>Delivered</p>";
                }
                else if($order['status']=='Processing'){
                    echo "<button disabled type='submit' id='deleteFromCart' name='cancel'><i class='fa-solid fa-spinner'></i></button>";
                    echo "<p class='status'>Delivered</p>";
                }
                else{
                    echo "<button disabled type='submit' id='deleteFromCart' name='cancel'><i class='fa-solid fa-truck-fast'></i></button>";
                    echo "<p class='status'>Shipped</p>";
                }
                echo "<div class='flex'>";
                echo "<div>";
                echo "<a class='line' href='viewproduct.php?pid=$productid'><h3 class='name'>" .$product['name']. "</h3></a>";
                echo "<input type='hidden' name='productid' value=" .$productid. ">";
                echo "<p class='price'>price $" .$order['price']. "</p>";
                echo "</div>";
                echo "</div>";
                echo "<a class='line' href='vieworder.php?oid=$orderid'><p class='itemTotal'><span>View Order</span></p></a>";
                echo " </form>";
            }
            ?> 
        </div>
    </section>
</div>
<?php 
include "inc/footer.php";
 ?>
