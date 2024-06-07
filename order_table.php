<?php
include "inc/header.php";
?>

<div class="main">
    <?php
    if (isset($_SESSION['message'])) {
        echo " <div id='message'>";
        echo "<h1>" . $_SESSION['message'] . "</h1>";
        echo "</div>";
    }
    ?>
    <section class="product-table">
        <table class="table">
            <thead>
            <tr>
                <th>Userid</th>
                <th>ProductId</th>
                <th>Name and Lastname</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Method</th>
                <th>Status</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Country</th>
                <th>City</th>
                <th>Cardnumber</th>
                <th>Modify</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>  
            <?php
                $orders = getOrder();
                $i=0;
                while($order=mysqli_fetch_assoc($orders)){
                    $orderid = $order['orderid'];
                    echo "<tr>";
                    echo "<td>".$order['userid'] . "</td>";
                    echo "<td>".$order['productid'] . "</td>";
                    echo "<td>".$order['name'] ." ".$order['lastname']. "</td>";
                    echo "<td>".$order['email'] . "</td>";
                    echo "<td>".$order['phone'] . "</td>";
                    echo "<td>".$order['address'] . "</td>";
                    echo "<td>".$order['method'] . "</td>";
                    echo "<td>".$order['status'] . "</td>";
                    echo "<td>".$order['price'] . "</td>";
                    echo "<td>".$order['quantity'] . "</td>";
                    echo "<td>".$order['country'] . "</td>";
                    echo "<td>".$order['city'] . "</td>";
                    echo "<td>".$order['cardnumber'] . "</td>";
                    echo "<td><a href='modify_orders.php?oid=$orderid'>
                    <i class='fa-solid fa-file-pen'></i></a></td>";
                    echo "<td><a href='delete_orders.php?oid=$orderid'>
                    <i class='fa-solid fa-delete-left'></i></a></td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table> 
    </section>
</div>

<?php
include "inc/footer.php";
?>