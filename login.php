<?php 
include "inc/header.php";

if(isset($_POST['login'])){
    login($_POST['lemail'],$_POST['lpassword']);
}
if(isset($_POST['register'])){
    echo "<script>console.log('what');</script>";
    register($_POST['name'],$_POST['lastname'],$_POST['email'],$_POST['password'],$_POST['cpassword']);
}
?>

<div class="login-page">
    <div class="form">
        <form id="login-f" method="POST">
            <div class="inputAndLabels">
                <input type="email" placeholder="Email" id="lemail" name="lemail">
            </div>
            <div class="inputAndLabels">
                <input type="password" placeholder="Password" id="lpassword" name="lpassword">
            </div>
            <input type="submit" id="submit-button" name="login" value="Log in">
            <p class="form-message">Not registered? <button id="register-show">Create an account</button></p>
        </form>
        <form id="register-f" method="POST">
            <div class="inputAndLabels">
                <input type="text" placeholder="Name" id="name" name="name"/>
            </div>
            <div class="inputAndLabels">
                <input type="text" placeholder="Lastname" id="lastname" name="lastname"/>
            </div>
            <div class="inputAndLabels">
                <input type="email" placeholder="Email" id="email" name="email"/>
            </div>
            <div class="inputAndLabels">
                <input type="password" placeholder="Password" id="password" name="password"/>
            </div>
            <div class="inputAndLabels">
                <input type="password" placeholder="Confirm password" id="cpassword" name="cpassword"/>
            </div>
            <input type="submit" id="submit-button" name="register" value="Register">
            <p class="form-message">Already registered? <button id="login-show">Sign in</button></p>
        </form>
    </div>
</div>
<?php 
include "inc/footer.php";
 ?>
