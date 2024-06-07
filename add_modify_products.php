<?php
include "inc/header.php";
if(isset($_GET['pid'])){
    $productid = $_GET['pid'];
    $product = getProductById($productid);
    $name = $product['name'];
    $categoryid = $product['categoryid'];
    $color = $product['color'];
    $description = $product['description'];
    $price = $product['price'];
    $image = $product['image'];
    if( $product['collectionid']==""){
        $collectionid=NULL;
    }
    else{
        $collectionid = $product['collectionid'];
    }
}
if(isset($_POST['add'])){
    addProduct($_POST['name'],$_POST['category'],$_POST['color'],
    $_POST['description'],$_POST['price'],$_POST['image'],$_POST['collection']);
}
else if(isset($_POST['modify'])){
    modifyProduct($productid,$_POST['name'],$_POST['category'],$_POST['color'],
    $_POST['description'],$_POST['price'],$_POST['image'],$_POST['collection']);
}
?>

<section class="product-page">
    <div class="form">
        <?php
        if(isset($_GET['pid'])){
            echo "<h1>Modify Product</h1>";
        }
        else{
            echo "<h1>Add Product</h1>";
        }
        ?>
        <br>       
        <br>
        <form id="product-f" method="post">
            <div class="inputAndLabels">
                <label for="name">Name</label> <br>
                <input type="text" id="name" name="name"   value="<?php if(!empty($name)) echo $name ?>">
            </div>
            <div class="inputAndLabels">
                <label for="category">Category</label> <br>
                <select id="category" name="category">
                    <option value="">Pick a category</option>
                    <?php
                        $categories=getCategory();
                        while ($category = mysqli_fetch_assoc($categories)) {
                            $selected;
                            if($categoryid==$category['categoryid']){
                                $selected="selected";
                            }
                            else{$selected=" ";}
                            $name=$category['name'];
                            echo "<option value='".$category['categoryid']. "'" . $selected . ">$name</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="inputAndLabels">
                <label for="color">Color</label> <br>
                <input type="text" id="color" name="color" 
                    value="<?php if(!empty($color)) echo $color ?>">
            </div>
            <div class="inputAndLabels">
                <label for="image">Image</label> <br>
                <input type="file"  accept='image/*' id="image" name="image" 
                    value="<?php if(!empty($image)) echo $image ?>">
            </div>
            <div class="inputAndLabels">
                <label for="description">Description</label> <br>
                <textarea id="description" name="description" rows='5' cols='40'
                 ><?php if(!empty($description)) echo $description ?></textarea>
            </div>
            <div class="inputAndLabels">
                <label for="collection">Collection</label> <br>
                <select id="collection" name="collection">
                    <option value=NULL>Pick a collection</option>
                    <?php
                        $collections=getCollection();
                        while ($collection = mysqli_fetch_assoc($collections)) {
                            $selected;
                            if($collectionid==$collection['collectionid']){
                                $selected="selected";
                            }
                            else{$selected=" ";}
                            echo $selected."aa";
                            $name=$collection['name'];
                            echo "<option value='".$collection['collectionid']. "'" . $selected . ">$name</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="inputAndLabels">
                <label for="price">price</label> <br>
                <input type="text" id="price" name="price" 
                    value="<?php if(!empty($price)) echo $price ?>">
            </div>
            <div class="inputAndLabels">
                <div>
                    <?php
                    if(isset($_GET['pid'])){
                        echo "<input  type='submit' id='submit-button' name='modify' value='Modify'>";
                    }
                    else{
                       echo "<input  type='submit' id='submit-button' name='add' value='Add'>";
                    }
                    ?>
                </div>
            </div>
        </form>
    </div>
</section>

<?php
include "inc/footer.php";
?>