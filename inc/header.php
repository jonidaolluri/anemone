<?php
include "functions.php";

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'></link>  
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css"/>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/b2520bc0f4.js" crossorigin="anonymous"></script>
    <title>Anemone</title>
</head>
<body> 
<header class="header">
    <div class="header-container">
        <a href="index.php" class="logo"><img src="img/logo.png"></a>
        <div class="icons">
            <a <?php if(!isset($_SESSION['user'])){echo "href='login.php'";} ?> id="user-button"><i class="fa-solid fa-user"></i></a>
            <?php
            if(isset($_SESSION['user'])){
            $userid = $_SESSION['user']['userid'];
            $wishlistItemsNumber = getWishlistItemsNumber($userid);
            $cartItemsNumber = getCartItemsNumber($userid);
            
            echo "<a href='wishlist.php' class='cart-button'><i class='fa-solid fa-heart'></i><sup>$wishlistItemsNumber</sup></a>";
            echo "<a href='cart.php' class='cart-button'><i class='fa-solid fa-cart-shopping'></i><sup>$cartItemsNumber</sup></a>";     
            }
            ?>
            <i id="menu-button" class="fa-solid fa-bars"></i>
        </div>
    </div>
    <nav class="navbar">
            <ul class="nav-items">
                <li><a href="products.php">All</a></li>
                <li><a href="rings.php">Rings</a></li>
                <li><a href="necklaces.php">Necklaces</a></li>
                <li><a href="bracelets.php">Bracelets</a></li>
                <li><a href="earrings.php">Earrings</a></li>
                <?php
                if(isset($_SESSION['user']) && $_SESSION['user']['role']==0){
                    echo "<li class='admin'><a href='product_table.php'>Manage products</a></li>";
                    echo "<li><a href='order_table.php'>Manage orders</a></li>";

                }
                ?>
            </ul>
    </nav>
    <div class='profile-box'>
        <ul>
        <li><a href='profile.php'>My Profile</a></li>
        <li><a href='#' id='sign-out'>Sign Out</a></li>
        </ul>
    </div>
</header>

