<?php 
include "header.php";
if ($sUsername != null){
    echo "<script>window.location.replace('index.php');</script>";
}
?>
<div class="container">
    <br> 
    <div class="card bg-light">
        <article class="card-body mx-auto" style="max-width: 400px;">
            <h4 class="card-title mt-3 text-center">Create Account</h4>
            <p class="divider-text">
                <span class="bg-light">OR</span>
            </p>
            <form method="post">
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                    </div>
                    <input name="email_label" class="form-control" placeholder="Email address" type="email">
                </div> 
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input name="password_label" class="form-control" placeholder="Password" type="password">
                </div>
                <div class="form-group">
                    <button name="LoginSystem" type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
                <p class="text-center">Have not an account? <a href="/register.php">Register</a> </p>
            </form>
        </article>
    </div>
</div>
<?php
if(isset($_POST['LoginSystem']) && isset($_POST['email_label']) && $_POST['email_label'] != '' && $_POST['password_label'] != '' && isset($_POST['password_label'])) {
    $Email = $_POST['email_label'];
    $Password = $_POST['password_label'];
    $query = $conn->query("SELECT * FROM users WHERE email='$Email'", PDO::FETCH_ASSOC)->fetch();
    if (isset($query)) {
        if ($Password ==  $query['password_']) {
            $_SESSION["user_UserID"] = $query['user_id'];
            $_SESSION["user_Username"] = $query['username'];
            $_SESSION["user_Firstname"] = $query['firstname'];
            $_SESSION["user_Surname"] = $query['surname'];
            $_SESSION["user_Email"] = $Email;
            echo "<script>window.location.replace('index.php');</script>";
            die();
        } else {
            echo "<script>alert('Your email and password does not match.');</script>";
        }
    }
}
?>