<?php 
include "inc/header.php";

if(isset($_GET['pid'])){
    $productid = $_GET['pid'];
    $product = getProductById($productid);
    $name = $product['name'];
    $price = $product['price'];
    $image = $product['image'];
    $color = $product['color'];
    $description = $product['description'];
    $collectionid = $product['collectionid'];

}
if(isset($_SESSION['user'])){

    $userid = $_SESSION['user']['userid'];
    if(isset($_POST['addToWishlist'])){
        addToWishlist($userid, $productid);
    }
    if(isset($_POST['addToCart'])){
        addToCart($userid, $productid,$_POST['quantity']);
    }
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
                    <p class='d'><?php echo $description;?></p>
                    <p class='price'>color: <?php echo $color;?></p>
                </div>
                <div class='flex'>
                    <button type='submit' id='addToWishlist' name='addToWishlist'>Add to Wishlist <i class='fa-solid fa-heart'></i></button>
                    <button type='submit' id='addToCart' name='addToCart'>Add to Cart <i class='fa-solid fa-cart-shopping'></i></button>
                </div>
                <input type='number' name='quantity' required min='1' value='1' max='99' maxlength='2' class='quantity'>
                <?php  if(isset($_SESSION['user'])){
                echo "<a class='btn' href='checkout.php?pid=$productid'>Buy Now</a>";
                }
                ?>
            </div>
            </form>   

        </div>
 
    </section>
</div>
<?php 
include "inc/footer.php";
 ?>
