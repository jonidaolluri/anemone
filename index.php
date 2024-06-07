<?php 
include "inc/header.php";
 ?>
<div class="main">
<section class="top">
        <div class="slider-top">
            <div class="slider__slider slide1">
                <div class="overlay"></div>
                <div class="slide-detail">
                    <h1>Welcome</h1>
                    <a href="products.php" class="button">Shop Now</a>
                </div>
                <!-- <div class="hero-dec-top"></div>
                <div class="hero-dec-bottom"></div> -->
            </div>
            <!--------------------------------------->
            <div class="slider__slider slide2">
                <div class="overlay"></div>
                <div class="slide-detail">
                    <h1>Check out our new collections</h1>
                    <a href="products.php" class="button">Shop Now</a>
                </div>
                <!-- <div class="hero-dec-top"></div>
                <div class="hero-dec-bottom"></div> -->
            </div>
            <!--------------------------------------->
            <div class="slider__slider slide3">
                <div class="overlay"></div>
                <div class="slide-detail">
                    <h1>Find what you need</h1>
                    <a href="products.php" class="button">Shop Now</a>
                </div>
                <!-- <div class="hero-dec-top"></div>
                <div class="hero-dec-bottom"></div> -->
            </div>
                <!--------------------------------------->
            <div class="left-arrow"><i class="fa-solid fa-left-long"></i></div>
            <div class="right-arrow"><i class="fa-solid fa-right-long"></i></div>
        </div>
    </section>
    <!------------------------------->
    <div class="links">
        <div class="cards">
            <a href="rings.php" ><img src="img/MrbGH1L5n9KjGvAq1fJw.jpg" /></a>
            <p>Rings</p>
        </div>
        <div class="cards">
            <a href="necklaces.php" ><img src="img/eJaDf2fL9sEp9HOzsmVl.jpg" /></a>
            <p>Necklaces</p>
        </div>
        <div class="cards">
            <a href="bracelets.php" ><img src="img/dF9A1DwUrLSc76qvBbAp.jpg" /></a> 
            <p>Bracelets</p>
        </div>
        <div class="cards">
            <a href="earrings.php" ><img src="img/VSvxVXyZMtFTkg8siIch.jpg" /></a>
            <p>Earrings</p>  
        </div>           
    </div>
    <!------------------------------->
    <section class="slider-container">
        <a href="products.php"><h1>Find what you need!</h1></a>
        <div class="slider-middle">
            <div id="image-container">
            <img src="img/6tkYPrulaW5WYeOnBxl2.jpeg" class="slide" width="600" height="400" />
            <img src="img/gdz7oCjYn5H7ZZZ18Guc.jpeg" class="slide" width="600" height="400" />
            </div>
            <div class="buttons">
            <a id="slide-1" ></a>
            <a id="slide-2" ></a>
            </div>
        </div>
    </section>
    <!------------------------>
    <section class="wrapper">
        <div class="product-slider">
            <?php
            $products = getProducts();
            $i=0;
            while($product=mysqli_fetch_assoc($products)){
                $productid = $product['productid'];
                echo "<div class='cards'>";
                echo "<a href='viewproduct.php?pid=$productid'><img src='img/".$product['image']. "'/></a>";
                echo "<p>" .$product['name']. "   $" .$product['price']. "</p>";
                echo "</div>";
            }
            ?> 
        </div>
    </section>
    <!------------------------>
    <section class="collections">
        <div class="container">
            <div class="collection-card">
                <div class="img">
                    <img src="img/ecPKm6pPRNsNrbDfVRog.jpeg" alt="">
                </div>
                <div>
                    <h1>Offers</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                         ut labore et dolore magna aliqua. Amet tellus cras adipiscing enim. Tellus in hac habitasse 
                         platea. Tristique senectus et netus et malesuada fames. Sed tempus urna et pharetra. Amet 
                         volutpat consequat mauris nunc congue nisi vitae suscipit tellus. Maecenas sed enim ut sem 
                         viverra aliquet eget. Venenatis cras sed felis eget velit aliquet sagittis id. Dui sapien 
                         eget mi proin sed. Phasellus vestibulum lorem sed risus ultricies tristique nulla aliquet.
                    </p>
                </div>
            </div>
            <div class="collection-card">
                <div>
                    <h1>Collections</h1>
                    <p>In nulla posuere sollicitudin aliquam ultrices sagittis orci a. In nulla posuere sollicitudin
                        aliquam ultrices sagittis orci a. Ullamcorper a lacus vestibulum sed arcu non odio euismod.
                        Ultrices tincidunt arcu non sodales. Pharetra sit amet aliquam id diam maecenas ultricies.
                        Venenatis lectus magna fringilla urna. Tempus egestas sed sed risus pretium. Morbi tincidunt
                        augue interdum velit euismod in pellentesque massa
                    </p>
                </div>
                <div class="img">
                    <img src="img/vhPrYcwIoPMX1G8IN8tW.jpeg" alt="">
                </div>                
            </div> 
        </div>
    </section>
</div>
<?php 
include "inc/footer.php";
 ?>
