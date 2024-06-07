<?php 
include "inc/header.php";
$userid = $_SESSION['user']['userid'];

if(isset($_GET['oid'])){
    $orderid = $_GET['oid'];
    $order = getOrderById($orderid);
    $quantity = $order['quantity'];
    $status = $order['status'];
    $productid = $order['productid'];
    $product = getProductById($productid);
    $name = $product['name'];
    $price = $product['price'];
    $image = $product['image'];
    $collectionid = $product['collectionid'];

}
if(isset($_POST['cancelOrder'])){
    cancelOrder($orderid);
}

?>
 
<div class="main">

    <section class="products">
        <div class="item">
            <form action='' method='POST' class='item-box'>
            <img class='image' src='img/<?php echo $image;?>'/></a>
            <div class="item-details">
                <div class='details'>
                    <h3 class='name'><?php echo $name;?></h3>
                    <p class='price'>$<?php echo $price;?></p>
                   
                </div>
                <?php
                if($status!="delivered"){
                    echo "<div class='flex'>";
                    echo "<button type='submit' id='' name='cancelOrder'>Cancel order <i class='fa-solid fa-xmark'></i></button>";
                    echo " </div>";

                }
                ?>
                <!-- <div class='flex'>
                    <button type='submit' id='' name='cancelOrder'>Cancel order <i class='fa-solid fa-xmark'></i></button>
                </div> -->
                <input disabled type='number' name='quantity' required min='1' value='<?php echo $quantity;?>' max='99' maxlength='2' class='quantity'>
            </div>
            </form> 
        </div>
 
    </section>
</div>
<?php 
include "inc/footer.php";
 ?>
