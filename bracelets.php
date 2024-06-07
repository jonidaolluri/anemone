<?php 
include "inc/header.php";
if(isset($_SESSION['user'])){

    $userid = $_SESSION['user']['userid'];
    if(isset($_POST['addToWishlist'])){
        addToWishlist($userid,$_POST['productid']);
    }
    if(isset($_POST['addToCart'])){
        addToCart($userid,$_POST['productid'],$_POST['quantity']);
    }
}
?>
<div class="main">
    <div class="welcome">
        <div>
            <img src="img/ACgEWM4lglpMdDL2fAkx.jpg" height="150px" width="120px" >
        </div>
        <div>
            <h1>Bracelets</h1>
            <p>Velit scelerisque in dictum non consectetur a erat. Laoreet id donec
                 ultrices tincidunt arcu non sodales neque sodales. Condimentum mattis
                  pellentesque id nibh tortor id aliquet lectus. Elementum nibh tellus 
                  molestie nunc non blandit. Cras fermentum odio eu feugiat pretium nibh 
                  ipsum consequat nisl..</p>
        </div>
    </div>
    <section class="products">
        <div class="container-box">
        <?php
            $products = getProductsByCategory(3);
            $i=0;
            while($product=mysqli_fetch_assoc($products)){
                $productid = $product['productid'];
                echo "<form action='' method='POST' class='box'>";
                echo "<a href='viewproduct.php?pid=$productid'><img class='image' src='img/".$product['image']. "'/></a>";
                echo "<button type='submit' id='addToWishlist' name='addToWishlist'><i class='fa-solid fa-heart'></i></button>";
                echo "<div class='flex'>";
                echo "<div>";
                echo "<a class='line' href='viewproduct.php?pid=$productid'><h3 class='name'>" .$product['name']. "</h3></a>";
                echo "<input type='hidden' name='productid' value=" .$productid. ">";
                echo "<p class='price'>price $" .$product['price']. "</p>";
                echo "</div>";
                echo "<button type='submit' id='addToCart' name='addToCart'><i class='fa-solid fa-cart-shopping'></i></button>";
                echo "</div>";
                echo "<input type='number' name='quantity' required min='1' value='1' max='99' maxlength='2' class='quantity'>";
                if(isset($_SESSION['user'])){
                echo "<a class='btn' href='checkout.php?pid=$productid'>Buy Now</a>";
                }
                echo " </form>";
            }

            ?> 
        </div>
    </section>
</div>
<?php 
include "inc/footer.php";
 ?>
