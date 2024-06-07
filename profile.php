<?php 
include "inc/header.php";
if(isset($_SESSION['user']['userid'])){
    $userid = $_SESSION['user']['userid'];
    $user = getUserID($userid);
    $name = $user['name'];
    $lastname = $user['lastname'];
    $email = $user['email'];
    $phone = $user['phone'];
    $address = $user['address'];
    $password = $user['password'];
}

if(isset($_POST['edit'])){
    modifyProfile($userid,$_POST['name'],$_POST['lastname'],$_POST['email'],$_POST['password'],$_POST['phone']);
}
?>

<div class="profile-page">
    <div class="welcome">
        <h1>Welcome   <?php if(!empty($name)) echo $name ?>!</h1>
    </div>
    <section>
        <div class="container">
            <div>
            <i class="fa-solid fa-tag"></i>
            <a class="button" href="orders.php"><h1>My Orders</h1></a>
            </div>
            <div>
            <i class="fa-solid fa-heart"></i>
            <a class="button" href="wishlist.php"><h1>My Wishlist</h1></a>
            </div>
        </div>
        <div class="form">
            <form id="edit" method="POST">
                <input type="text" placeholder="Name" id="name" name="name" value="<?php if(!empty($name)) echo $name ?>"/>
                <input type="text" placeholder="Lastname" id="lastname" name="lastname" value="<?php if(!empty($lastname)) echo $lastname ?>"/>
                <input type="email" placeholder="Email" id="email" name="email" value="<?php if(!empty($email)) echo $email ?>"/>
                <input type="text" placeholder="Address" id="address" name="address" value="<?php if(!empty($address)) echo $address ?>"/>
                <input type="tel" placeholder="Phone Number" id="phone" name="phone" value="<?php if(!empty($phone)) echo $phone ?>"/>
                <input type="password" placeholder="Password" id="password" name="password" value="<?php if(!empty($password)) echo $password ?>"/>
                <input type="submit" id="submit-button" name="edit" value="Edit">
            </form>
        </div>
    </section>
</div>
<?php 
include "inc/footer.php";
 ?>
