<?php

include "inc/header.php";
if(isset($_GET['oid'])){
    $orderid = $_GET['oid'];
    $order = getOrderById($orderid);
    $name = $order['name'].$order['lastname'];
    $productid = $order['productid'];
    $price = $order['price'];
    $quantity = $order['quantity'];
    $price = $order['price'];
    $status = $order['status'];
}
if(isset($_POST['delete'])){
    deleteOrder($orderid);
}
?>


<section class="product-page">
    <div class="form">
        <h1>Delete Order</h1>
        <br>       
        <br>
        <form id="product-f" method="post">
            <div class="inputAndLabels">
                <label for="name">Name</label> <br>
                <input disabled type="text" id="name" name="name"   value="<?php if(!empty($name)) echo $name ?>">
            </div>
            <div class="inputAndLabels">
                <label for="productid">ProductID</label> <br>
                <input disabled type="text" id="productid" productid="productid"   value="<?php if(!empty($productid)) echo $productid ?>">
            </div>
            <div class="inputAndLabels">
                <label for="price">Price</label> <br>
                <input disabled type="text" id="price" price="price"   value="<?php if(!empty($price)) echo $price ?>">
            </div>
            <div class="inputAndLabels">
                <label for="quantity">Quantity</label> <br>
                <input disabled type="text" id="quantity" quantity="quantity"   value="<?php if(!empty($quantity)) echo $quantity ?>">
            </div>
            <div class="inputAndLabels">
                <label for="status">Status</label> <br>
                <select disabled id="status" name="status">
                    <option value="">Pick a status</option>
                    <?php
                    $statusList = array("Processing"=>"Processing","delivered"=>"Delivered","shipped"=>"Shipped",
                    "canceled"=>"Canceled");
                    foreach ($statusList as $key => $value) {
                        if($status==$key){
                            $selected="selected";
                        }
                        else{$selected=" ";}
                        echo "<option value='".$key."' " .$selected. ">".$value."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="inputAndLabels">
                <div>
                  <input  type='submit' id='submit-button' name='delete' value='Delete'>
                </div>
            </div>
        </form>
    </div>
</section>

<?php
include "inc/footer.php";
?>