<?php 
include "inc/header.php";

$userid = $_SESSION['user']['userid'];


if(isset($_POST['deleteFromCart'])){
    deleteFromCart($_POST['cartid']);
}

if(isset($_POST['empty'])){
    echo "<script>console.log(1);</script>";
    emptyCart($userid);
}

if(isset($_POST['editCart'])){
    editCartQuantity($_POST['cartid'],$_POST['quantity']);
}

?>
 
<div class="main">
    <div class="welcome">
        <img src="img/YL4uVxoZzzZzq0rOKLbY.jpeg" height="150px" width="120px" >
        <div>
            <h1>Cart</h1>
            <p>Fames ac turpis egestas sed tempus urna et. Mattis pellentesque id nibh tortor.
                Dui vivamus arcu felis bibendum ut tristique et. Odio tempor orci dapibus ultrices in.
                A condimentum vitae sapien pellentesque habitant. In nisl nisi scelerisque eu. Ultrices
                dui sapien eget mi proin.</p>
        </div>
    </div>
    <section class="products">
        <div class="container-box">
            <?php
            $carts = getCartById($userid);
            $total=0;
            $itemTotal=0;
            while($cart=mysqli_fetch_assoc($carts)){
                $cartid = $cart['cartid'];
                $productid = $cart['productid'];
                echo "<form action='' method='POST' class='box'>";
                echo "<a href='viewproduct.php?pid=$productid'><img class='image' src='img/".$cart['image']. "'/></a>";
                echo "<button type='submit' id='deleteFromCart' name='deleteFromCart'><i class='fa-solid fa-delete-left'></i></button>";
                echo "<div class='flex'>";
                echo "<div>";
                echo "<a class='line' href='viewproduct.php?pid=$productid'><h3 class='name'>" .$cart['name']. "</h3></a>";
                echo "<input type='hidden' name='cartid' value=" .$cartid. ">";
                echo "<input type='hidden' name='productid' value=" .$productid. ">";
                echo "<p class='price'>price $" .$cart['price']. "</p>";
                echo "</div>";
                echo "</div>";
                echo "<input type='number' name='quantity' required min='1'  max='99' maxlength='2' class='quantity' value='".$cart['quantity']."'>";
                echo "<button type='submit' id='editCart' name='editCart'><i class='fa-solid fa-edit'></i></button>";
                $itemTotal = $cart['price']*$cart['quantity'];
                echo "<p class='itemTotal'>Item total: $".$cart['price']." x ".$cart['quantity']." = <span>$$itemTotal</span></p>";
                $total+=$itemTotal;
                echo "<a class='btn' href='checkout.php?pid=$productid'>Buy Now</a>";
                echo " </form>";
            }
            ?> 
        </div>
        <?php if($total!=0){ 
        echo    "<div class='cart-total'>";
        echo        "<p>total amount : <span>$".$total."</span></p>";
        echo        "<div class='button'>";
        echo            "<button type='submit' name='shop' class='shop' ><i class='fa-solid fa-basket-shopping'></i></button>";
        echo            "<a href='checkout.php' class='btn'><span>Proceed to Checkout<span></a>";
        echo        "</div>";
        echo        "<form method='POST'>";
        echo            "<button type='submit' name='empty' class='empty' ><i class='fa-solid fa-trash'></i>Empty cart</button>";
        echo        "</form>";            
        echo    "</div>";
        }  
        else{
            echo    "<div class='cart-total'>";
            echo "<p><span>Your cart is empty!</span></p>";
            echo    "</div>";
        }
        ?>
    </section>
</div>
<?php 
include "inc/footer.php";
 ?>
