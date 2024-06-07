<?php 
include "inc/header.php";

if(isset($_SESSION['user']['userid'])){
    $userid = $_SESSION['user']['userid'];
    $user = getUserID($userid);
    $nameUser = $user['name'];
    print_r( $user);

    $lastname = $user['lastname'];
    $email = $user['email'];
    $phone = $user['phone'];
    echo $user['address'];
    $address = $user['address'];
    
}

if(isset($_GET['pid'])){
    $productid = $_GET['pid'];
    $product = getProductById($productid);
    $name = $product['name'];
    $price = $product['price'];
    $image = $product['image'];
    $color = $product['color'];
    $description = $product['description'];
    $collectionid = $product['collectionid'];}
    
if(isset($_POST['order'])){
    $nameOrder = $_POST['name'];
    $lastnameOrder = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $method = $_POST['method'];
    $cardnumber = $_POST['cardnumber'];
    if(isset($_GET['pid'])){
        addOrder($userid,$productid,$price,1,$nameOrder,$lastnameOrder,$email,$phone,$address,$country,$city,$method,$cardnumber);
    }
    else{
        $carts = getCartById($userid);
        while($cart=mysqli_fetch_assoc($carts)){
            addOrder($userid,$cart['productid'],$cart['price'],$cart['quantity'],$nameOrder,$lastnameOrder,$email,$phone,$address,$country,$city,$method,$cardnumber);
            emptyCartAfterOrder($userid);
        }
    }
}

?>
 
<div class="main">
    <div class="welcome">
        <img src="img/YL4uVxoZzzZzq0rOKLbY.jpeg" height="150px" width="120px" >
        <div>
            <h1>Checkout</h1>
            <p>Fames ac turpis egestas sed tempus urna et. Mattis pellentesque id nibh tortor.
                Dui vivamus arcu felis bibendum ut tristique et. Odio tempor orci dapibus ultrices in.
                A condimentum vitae sapien pellentesque habitant. In nisl nisi scelerisque eu. Ultrices
                dui sapien eget mi proin.</p>
        </div>
    </div>
    <section class="products-checkout">
        <div class='billing-page'>  
            <div class="form">     
                <form id="checkout" method="POST">
                    <legend>Billing details</legend>
                    <input type="text" placeholder="Name" id="name" name="name" value="<?php if(!empty($nameUser)) echo $nameUser ?>"/>
                    <input type="text" placeholder="Lastname" id="lastname" name="lastname" value="<?php if(!empty($lastname)) echo $lastname ?>"/>
                    <input type="email" placeholder="Email" id="email" name="email" value="<?php if(!empty($email)) echo $email ?>"/>
                    <input type="tel" placeholder="Phone" id="phone" name="phone" value="<?php if(!empty($phone)) echo $phone ?>"/>
                    <input type="text" placeholder="Address" id="address" name="address" value="<?php if(!empty($address)) echo $address ?>"/>
                    <input type="text" placeholder="Country" id="country" name="country"/>
                    <select name='city' class='input'>
                        <option value=''>City</option>
                        <option value='Prishtina'>Pristina</option>
                        <option value='Gjakova'>Gjakova</option>
                        <option value='Prizren'>Prizren</option>
                        <option value='Mitrovica'>Mitrovica</option>
                        <option value='Ferizaj'>Ferizaj</option>
                        <option value='Gjilan'>Gjilan</option>
                        <option value='Istog'>Istog</option>
                        <option value='Lipjan'>Lipjan</option>
                    </select>
                    <select name='method' class='input'>
                        <option value=''>Payment method</option>
                        <option value='credit-card'>Credit Card</option>
                        <option value='paypal'>Paypal</option>
                    </select>
                    <input type='text' placeholder='Card Number' name='cardnumber' id='card-number'>
                    <input type="submit" id="submit-button" name="order" class='btn' value="Complete Purchase">
                </form>
            </div>
        </div>
        <div class='right'>
            <div class="container-box-products">
                <?php
                $total=0;
                if(isset($_GET['pid'])){
                    echo "<div class='item'>
                        <div class='box'>
                            <img class='image' src='img/".$image."'></a>
                            <div class='item-details'>
                                <div class='details'>
                                    <h3 class='name'>".$name."</h3>
                                    <p class='price'>$".$price."</p>
                                    <p class='price'>Color: ".$color."</p>
                                    <p class='price'>Quantity: 1</p>
                                </div>
                            </div>
                        </div> 
                    </div>";
                    $total=$price;
                }
                

                else{
                    $carts = getCartById($userid);
                    $itemTotal=0;
                    while($cart=mysqli_fetch_assoc($carts)){
                    $cartid = $cart['cartid'];
                    $productid = $cart['productid'];
                    echo "<div class='item'>
                                <div class='box'>
                                    <img class='image' src='img/".$cart['image']."'></a>
                                    <div class='item-details'>
                                        <div class='details'>
                                            <h3 class='name'>".$cart['name']."</h3>
                                            <p class='price'>$".$cart['price']."</p>
                                            <p class='price'>Color: ".$cart['color']."</p>
                                            <p class='price'>Quantity: ".$cart['quantity']."</p>";
                    $itemTotal = $cart['price']*$cart['quantity'];
                    $total+=$itemTotal;
                    echo                "</div>
                                    </div>
                                    <p class='itemTotal'>Item total: $".$cart['price']." x ".$cart['quantity']." = <span>$".$itemTotal."</span></p>
                                </div> 
                            </div>";
                }
                }
                ?> 
            </div>
            <?php if($total!=0){ 
            echo    "<div class='cart-total'>";
            echo        "<p>total amount : <span>$".$total."</span></p>";  
            echo    "</div>";
            }  
            ?>
        <div>
    </section>
</div>
<?php 
include "inc/footer.php";
 ?>
