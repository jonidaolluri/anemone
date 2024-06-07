<?php
session_start();
$dbconn;
dbConnection();

function dbConnection(){
    global $dbconn;
    $dbconn=mysqli_connect("localhost",'root','','anemone');
    if(!$dbconn){
        die("DB connection failed".mysqli_error($dbconn));
    }
}

/**product functions */
function getProducts(){
    global $dbconn;
    $sql = "SELECT productid, categoryid, collectionid, name, image, price FROM products";
    return mysqli_query($dbconn,$sql);
}

function getProductsTable(){
    global $dbconn;
    $sql = "SELECT p.productid, p.categoryid, p.collectionid, p.name,p.color, p.image, p.price,p.description,
     c.name as categoryname FROM products p INNER JOIN categories c ON p.categoryid=c.categoryid";
    return mysqli_query($dbconn,$sql);
}

function getProductById($productid){
    global $dbconn;
    $sql = "SELECT categoryid, collectionid, name,color, image, price,description FROM products";
    $sql .= " WHERE productid=$productid";
    $result = mysqli_query($dbconn,$sql);
    if(mysqli_num_rows($result)==1){
        return mysqli_fetch_assoc($result);
    }
}

function getProductsByCategory($categoryid){
    global $dbconn;
    $sql = "SELECT productid, collectionid, name, image, price FROM products WHERE categoryid=$categoryid";
    return mysqli_query($dbconn,$sql);
}

function addProduct($name,$category,$color,$description,$price,$image,$collection){
    global $dbconn;
    $sql = "INSERT INTO products (name,categoryid,color,description,price,image,collectionid) VALUES 
        ('$name',$category,'$color','$description',$price,'$image',$collection)";
    $result = mysqli_query($dbconn,$sql);
    if($result){
        $_SESSION['message']="Product added successfully";
        header("Location: product_table.php");
    }else{
        die("Product could not be added" . mysqli_error($dbconn));
    }
}

function modifyProduct($productid,$name,$category,$color,$description,$price,$image,$collection){
    global $dbconn;
    $sql = "UPDATE products SET name='$name',description='$description',color='$color',price=$price,image='$image',
        collectionid=$collection,categoryid = $category WHERE productid=$productid";
    $result = mysqli_query($dbconn,$sql);
    if($result){
        $_SESSION['message']="Product modified successfully";
        header("Location: product_table.php");
    }else{
        die("Product could not be modified" . mysqli_error($dbconn));
    }
}

function deleteProduct($productid){
    global $dbconn;
    $sql = "DELETE FROM products WHERE productid=$productid";
    $result = mysqli_query($dbconn,$sql);
    if($result){
        $_SESSION['message']="Product deleted successfully";
        header("Location: product_table.php");
    }else{
        die("Product could not be deleted" . mysqli_error($dbconn));
    }
}

/**category function */
function getCategory(){
    global $dbconn;
    $sql = "SELECT * FROM categories";
    return mysqli_query($dbconn,$sql);
}

/**collection functions */
function getCollection(){
    global $dbconn;
    $sql = "SELECT * FROM collections";
    return mysqli_query($dbconn,$sql);
}

function getCollectionByID($collectionid){
    global $dbconn;
    $sql = "SELECT name FROM collections WHERE collectionid=$collectionid";
    $result = mysqli_query($dbconn,$sql);
    if(mysqli_num_rows($result)==1){
        return mysqli_fetch_assoc($result);
    }
}

/**user functions */

function getUserID($userid){
    global $dbconn;
    $sql = "SELECT name, lastname,email, password, phone, address, role FROM users WHERE userid=$userid";
    $result = mysqli_query($dbconn,$sql);
    if(mysqli_num_rows($result)==1){
        return mysqli_fetch_assoc($result);
    }
}
function addGuestUser(){
    global $dbconn;
    $sql = "INSERT INTO users (role) VALUES ('2')";
    $result = mysqli_query($dbconn,$sql);
    if($result){
        // $user = get();
       
    }else{
        die("User was not added" . mysqli_error($dbconn));
    }
}
/** login functions */
function login($email,$password){
    global $dbconn;
    $sql = "SELECT userid, name, lastname, phone, address, role FROM users WHERE email='$email' AND password='$password' ";
    $result = mysqli_query($dbconn,$sql);
    if(mysqli_num_rows($result)==1){
            $user=array();
            $userData = mysqli_fetch_assoc($result);
            $user['userid'] = $userData['userid'];
            $user['name'] = $userData['name'];
            $user['lastname'] = $userData['lastname'];
            $user['email'] = $email;
            $user['password'] = $password;
            $user['phone'] = $userData['phone'];
            $user['address'] = $userData['address'];
            $user['role'] = $userData['role'];
            $_SESSION['user']=$user;
            header("Location: profile.php");
        }
    else{
        $warningMessage= "Invalid email or password";
        echo'<script>swal("' .$warningMessage. '", "", "warning");</script>';
        }
}

/** registration functions */
function register($name,$lastname,$email,$password, $cpassword){
    if(emailExists($email)){
        $warningMessage= "Email already exists. Please enter a different email";
        echo'<script>swal("' .$warningMessage. '", "", "warning");</script>';
   }
   else{
        if($password==$cpassword){
            global $dbconn;
            $sql = "INSERT INTO users (name, lastname, email, password) VALUES ('$name','$lastname','$email','$password')";
            $result = mysqli_query($dbconn,$sql);
            if($result){
                login($email,$password);
                $successMessage="You created an account successfully";
                echo '<script>swal("' .$successMessage. '", "", "success");</script>';
            }
            else{
                die("Registration failed" . mysqli_error($dbconn));
            }
        }
        else{
            $warningMessage= "Passwords do not match";
            echo'<script>swal("' .$warningMessage. '", "", "warning");</script>';
        }
    }
}

function emailExists($email){
    global $dbconn;
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($dbconn, $sql);
    if(mysqli_num_rows($result)>0){
        return true;
    }
    else{return false;}
}


/** Profile functions */

function modifyProfile($userid,$name,$lastname,$email,$password,$phone){
    if(emailExists($email) && $email!=$_SESSION['user']['email']){
        $warningMessage= "Email already exists. Please enter a different email";
        echo'<script>swal("' .$warningMessage. '", "", "warning");</script>';
   }
   else{
        global $dbconn;
        $sql = "UPDATE users SET name = '$name', lastname = '$lastname', email='$email', password='$password', phone='$phone'
         WHERE userid = $userid";
        $result = mysqli_query($dbconn,$sql);
        if($result){
            $successMessage="You succesfully modified your profile";
            echo '<script>swal("' .$successMessage. '", "", "success");</script>';
        }
        else{
            die(mysqli_error($dbconn));
        }
    }
}

/*  sign out */
function signout(){
    if (isset($_GET['argument']) && $_GET['argument'] === 'signout') {
        session_destroy(); 
    } 
}

signout();

/* wishlist */
function wishlistExists($userid,$productid){
    global $dbconn;
    $sql = "SELECT * FROM wishlist WHERE userid=$userid AND productid=$productid";
    $result = mysqli_query($dbconn, $sql);
    if(mysqli_num_rows($result)>0){
        return true;
    }
    else{return false;}
}

function addToWishlist($userid,$productid){
    if(wishlistExists($userid,$productid)){
        $warningMessage= "This item is already in your wishlist";
        echo'<script>swal("' .$warningMessage. '", "", "warning");</script>';
    }
    else{
        global $dbconn;
        $product = getProductById($productid);
        $price = $product['price'];
        $sql = "INSERT INTO wishlist (userid,productid,price) VALUES ($userid,$productid,$price)";
        $result = mysqli_query($dbconn,$sql);
        if($result){
            $successMessage="Product added to your wishlist";
            echo '<script>swal("' .$successMessage. '", "", "success");</script>';
        }else{
            die("Product could not be added to wishlist" . mysqli_error($dbconn));
        }
    }
}

function getWishlistItemsNumber($userid){
    global $dbconn;
    $sql = "SELECT * FROM wishlist WHERE userid=$userid";
    $result = mysqli_query($dbconn, $sql);
    return mysqli_num_rows($result);
}

function getWishlistById($userid){
    global $dbconn;
    $sql = "SELECT * FROM wishlist WHERE userid=$userid";
    return mysqli_query($dbconn,$sql);
    
}
function deleteFromWishlist($wishlistid){
    global $dbconn;
    $sql = "DELETE FROM wishlist WHERE wishlistid=$wishlistid";
    $result = mysqli_query($dbconn,$sql);
    if($result){
        $successMessage="Product deleted from your wishlist";
        echo '<script>swal("' .$successMessage. '", "", "success");</script>';
    }
    else{
        die(mysqli_error($dbconn));
    }
}


/** cart functions */
function addToCart($userid,$productid,$quantity){
    global $dbconn;
    $product = getProductById($productid);
    $price = $product['price'];
    $sql = "INSERT INTO cart (userid,productid,price,quantity) VALUES ($userid,$productid,$price,$quantity)";
    $result = mysqli_query($dbconn,$sql);
    if($result){
        $successMessage="Product added to your cart";
        echo '<script>swal("' .$successMessage. '", "", "success");</script>';
    }else{
        die("Product could not be added to cart" . mysqli_error($dbconn));
    }
}
function addAllToCart($wishlistArray){
    global $dbconn;
    for($i=0;$i<count($wishlistArray);$i++){
        $productid= $wishlistArray[$i]['productid'];
        $userid= $wishlistArray[$i]['userid'];
        $price= $wishlistArray[$i]['price'];
        $quantity= $wishlistArray[$i]['quantity'];
        $sql = "INSERT INTO cart (userid,productid,price,quantity) VALUES ($userid,$productid,$price,$quantity)";
        $result = mysqli_query($dbconn,$sql);
        if($result){
            $successMessage="Products added to your cart";
            echo '<script>swal("' .$successMessage. '", "", "success");</script>';
        }else{
            die("Products could not be added to cart" . mysqli_error($dbconn));
        }
        
    }
}

function getCartItemsNumber($userid){
    global $dbconn;
    $sql = "SELECT * FROM cart WHERE userid=$userid";
    $result = mysqli_query($dbconn, $sql);
    return mysqli_num_rows($result);
}

function getCartById($userid){
    global $dbconn;
    $sql = "SELECT * FROM cart c INNER JOIN products p ON c.productid=p.productid WHERE userid=$userid";
    return mysqli_query($dbconn,$sql);
    
}
function deleteFromCart($cartid){
    global $dbconn;
    $sql = "DELETE FROM cart WHERE cartid=$cartid";
    $result = mysqli_query($dbconn,$sql);
    if($result){
        $successMessage="Product deleted from your cart";
        echo '<script>swal("' .$successMessage. '", "", "success");</script>';
    }
    else{
        die(mysqli_error($dbconn));
    }
}

function emptyCart($userid){
    global $dbconn;
    $sql = "DELETE FROM cart WHERE userid=$userid";
    $result = mysqli_query($dbconn,$sql);
    if($result){
        $successMessage="Your cart is empty";
        echo '<script>swal("' .$successMessage. '", "", "success");</script>';
    }
    else{
        die(mysqli_error($dbconn));
    }
}

function emptyCartAfterOrder($userid){
    global $dbconn;
    $sql = "DELETE FROM cart WHERE userid=$userid";
    $result = mysqli_query($dbconn,$sql);
    if($result){
        
    }
    else{
        die(mysqli_error($dbconn));
    }
}

function editCartQuantity($cartid,$quantity){
    global $dbconn;
    $sql = "UPDATE cart SET quantity = $quantity WHERE cartid = $cartid";
    $result = mysqli_query($dbconn,$sql);
    if($result){
    }
    else{
        die(mysqli_error($dbconn));
    }
}

/** order functions */
function addOrder($userid,$productid,$price,$quantity,$nameOrder,$lastnameOrder,$email,$phone,$address,$country,$city,$method,$cardnumber){
    global $dbconn;
    $sql = "INSERT INTO orders (userid,productid,price,quantity,name,lastname,email,phone,address,country,city,method,cardnumber)
     VALUES ($userid,$productid,$price,$quantity,'$nameOrder','$lastnameOrder','$email','$phone','$address',
     '$country','$city','$method','$cardnumber')";
    $result = mysqli_query($dbconn,$sql);
    if($result){
        $successMessage="Thank you for your purchase";
        echo '<script>swal("' .$successMessage. '", "", "success");</script>';
    }else{
        die("Could not place order" . mysqli_error($dbconn));
    }
}

function getOrderByUserId($userid){
    global $dbconn;
    $sql = "SELECT * FROM orders WHERE userid=$userid";
    return mysqli_query($dbconn,$sql);
    
}
function getOrderById($orderid){
    global $dbconn;
    $sql = "SELECT * FROM orders WHERE orderid=$orderid";
    $result= mysqli_query($dbconn,$sql);
    if(mysqli_num_rows($result)==1){
        return mysqli_fetch_assoc($result);
    } 
}
function getOrder(){
    global $dbconn;
    $sql = "SELECT * FROM orders";
    return mysqli_query($dbconn,$sql);
}
function modifyOrder($orderid,$status){
    global $dbconn;
    $sql = "UPDATE orders SET status = '$status' WHERE orderid = $orderid";
    $result = mysqli_query($dbconn,$sql);
    if($result){
        $_SESSION['message']="Order modified successfully";
        header("Location: order_table.php");
    }else{
        die("Order could not be modified" . mysqli_error($dbconn));
    }
}

function deleteOrder($orderid){
    global $dbconn;
    $sql = "DELETE FROM orders WHERE orderid=$orderid";
    $result = mysqli_query($dbconn,$sql);
    if($result){
        $_SESSION['message']="Order deleted successfully";
        header("Location: order_table.php");
    }else{
        die("Order could not be deleted" . mysqli_error($dbconn));
    }
}

function cancelOrder($orderid){
    global $dbconn;
    $sql = "UPDATE orders SET status = 'canceled' WHERE orderid = $orderid";
    $result = mysqli_query($dbconn,$sql);
    if($result){
        $successMessage="Ordered canceled successfully";
        echo '<script>swal("' .$successMessage. '", "", "success");</script>';
    }
    else{
        die(mysqli_error($dbconn));
    }
}

/**message */
function message(){
    if (isset($_GET['argument']) && $_GET['argument'] === 'message') {
        unset( $_SESSION['message']); 
    } 
}
message();
?>

