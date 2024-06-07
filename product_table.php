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
                <th>Name</th>
                <th>Category</th>
                <th>Color</th>
                <th>Description</th>
                <th>Collection</th>
                <th>Price</th>
                <th>Image</th>
                <th>Modify</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>  
            <?php
                $products = getProductsTable();
                $i=0;
                while($product=mysqli_fetch_assoc($products)){
                    $productid = $product['productid'];
                    if($product['collectionid']){
                    $collection =  getCollectionByID($product['collectionid']);
                    $collectionname = $collection['name'];
                    }
                    else{
                        $collectionname ="-";
                    }
                    echo "<tr>";
                    echo "<td>".$product['name'] . "</td>";
                    echo "<td>".$product['categoryname'] . "</td>";
                    echo "<td>".$product['color'] . "</td>";
                    echo "<td>".$product['description'] . "</td>";
                    echo "<td>".$collectionname . "</td>";
                    echo "<td>".$product['price'] . "</td>";
                    echo "<td>".$product['image'] . "</td>";
                    echo "<td><a href='add_modify_products.php?pid=$productid'>
                    <i class='fa-solid fa-file-pen'></i></a></td>";
                    echo "<td><a href='delete_products.php?pid=$productid'>
                    <i class='fa-solid fa-delete-left'></i></a></td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table> 
        <a href="add_modify_products.php" id="add"><i class="fas fa-plus"></i> Add Products</a>
    </section>
</div>

<?php
include "inc/footer.php";
?>