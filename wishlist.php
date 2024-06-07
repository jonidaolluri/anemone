<?php 
include "inc/header.php";

$userid = $_SESSION['user']['userid'];

if(isset($_POST['addToCart'])){
    addToCart($userid,$_POST['productid'],$_POST['quantity']);
}
if(isset($_POST['deleteFromWishlist'])){
    $wishlistid = $_POST['wishlistid'];
    deleteFromWishlist($wishlistid);
}

?>
 
<div class="main">
    <div class="welcome">
        <img src="img/YL4uVxoZzzZzq0rOKLbY.jpeg" height="150px" width="120px" >
        <div>
            <h1>Wishlist</h1>
            <p>Fames ac turpis egestas sed tempus urna et. Mattis pellentesque id nibh tortor.
                Dui vivamus arcu felis bibendum ut tristique et. Odio tempor orci dapibus ultrices in.
                A condimentum vitae sapien pellentesque habitant. In nisl nisi scelerisque eu. Ultrices
                dui sapien eget mi proin.</p>
        </div>
    </div>
    <section class="products">
        <div class="container-box">
        <?php
            $wishlists = getWishlistById($userid);
            $wishlistArray=array();
            $i=0;
            $total=0;
            while($wishlist=mysqli_fetch_assoc($wishlists)){
                $wishlistid = $wishlist['wishlistid'];
                $productid = $wishlist['productid'];
                $product = getProductById($productid);
                if(isset($_POST['quantity'])){
                    $quantity= $_POST['quantity'];
                }else{$quantity=1;}
                $wishlistArray[]= array('userid' => $_SESSION['user']['userid'],'productid' => $productid,'price' => $product['price'],'quantity' => $quantity);
                echo "<form action='' method='POST' class='box'>";
                echo "<a href='viewproduct.php?pid=$productid'><img class='image' src='img/".$product['image']. "'/></a>";
                echo "<button type='submit' id='deleteFromWishlist' name='deleteFromWishlist'><i class='fa-solid fa-delete-left'></i></button>";
                echo "<div class='flex'>";
                echo "<div>";
                echo "<a class='line' href='viewproduct.php?pid=$productid'><h3 class='name'>" .$product['name']. "</h3></a>";
                echo "<input type='hidden' name='wishlistid' value=" .$wishlistid. ">";
                echo "<input type='hidden' name='productid' value=" .$productid. ">";
                echo "<p class='price'>price $" .$product['price']. "</p>";
                $total+=$product['price'];
                echo "</div>";
                echo "<button type='submit' id='addToCart' name='addToCart'><i class='fa-solid fa-cart-shopping'></i></button>";
                echo "</div>";
                echo "<input type='number' name='quantity' required min='1' value='1' max='99' maxlength='2' class='quantity'>";
                echo "<a class='btn' href='checkout.php?pid=$productid'>Buy Now</a>";
                echo " </form>";
                $i++;
            }

        ?> 
        </div>
        <?php if($total!=0){ 
                echo    "<div class='cart-total'>";
                echo        "<div class='button'>";
                echo            "<form id='bag' method='POST'>";
                echo                "<button type='submit' class='btn' name='addAllToCart'><span>Add all to cart<span></i></button>";
                echo            "</form>";
                echo        "</div>";         
                echo    "</div>";
                }  
                else{
                    echo    "<div class='cart-total'>";
                    echo "<p><span>Your wishlist is empty!</span></p>";
                    echo    "</div>";
                }
                if(isset($_POST['addAllToCart'])){
                    print_r($wishlistArray);
                    addAllToCart($wishlistArray);
                }
        ?>
    </section>
</div>
<?php 
include "inc/footer.php";
 ?>
