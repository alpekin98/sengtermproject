<?php 
include "header.php";
?>
<div class="container h-100">
    <div class="d-flex justify-content-center h-100">
        <div class="user_card">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    <img src="idea.png" class="brand_logo" alt="Idea_LOGO">
                </div>
            </div>
            <div class="d-flex justify-content-center form_container">
                <form method="post">
                    <h4 class="card-title mt-3 text-center">Create Account</h4>
                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input name="Firstname" class="form-control input_user" placeholder="First name" type="text">
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input name="Lastname" class="form-control input_user" placeholder="Lastname" type="text">
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text"> <i class="fas fa-user"></i> </span>
                        </div>
                        <input name="Username" class="form-control input_user" placeholder="Username" type="text">
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text"> <i class="fas fa-envelope"></i> </span>
                        </div>
                        <input name="Email" class="form-control input_user" placeholder="Email Address" type="email">
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text"> <i class="fas fa-lock"></i> </span>
                        </div>
                        <input name="Password" class="form-control input_user" placeholder="Create password" type="password">
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input name="ConfirmPassword" class="form-control input_user" placeholder="Repeat password" type="password">
                    </div>
                    <div class="d-flex justify-content-center mt-3 login_container">
                        <button type="submit" name="RegisterSystem" class="btn login_btn"> Create Account  </button>
                    </div>
                </form>
            </div>
            <div class="mt-4">
                <div class="d-flex justify-content-center links">
                Have an account? <a href="login.php" class="ml-2">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
<?php

$Username = $_POST['Username'];
$Firstname = $_POST['Firstname'];
$Lastname = $_POST['Lastname'];
$Email = $_POST['Email'];
$ConfirmPassword = $_POST['ConfirmPassword'];
$Password = $_POST['Password'];


if(isset($_POST['RegisterSystem']) && isset($_POST['Username']) && $_POST['Username'] != '' && $_POST['Email'] != '' && isset($_POST['Email'])) {
    if ($Email == null || $Email == '') {
        header('Location: index.php');
    }

    if ($ConfirmPassword == $Password) {
        $sqlAddUser = "INSERT IGNORE INTO users(firstname,surname,email,username,password_,image_link)
        VALUES ('$Firstname','$Lastname','$Email','$Username','$Password','nouser.png');";
        $conn->exec($sqlAddUser);
        $query = $conn->query("SELECT * FROM users WHERE email='$Email'", PDO::FETCH_ASSOC)->fetch();
        if (isset($query)) {
            if ($Password == $query['password_']) {
                $_SESSION["user_UserID"] = $query['user_id'];
                $_SESSION["user_Username"] = $query['username'];
                $_SESSION["user_Firstname"] = $query['firstname'];
                $_SESSION["user_Surname"] = $query['surname'];
                $_SESSION["user_Email"] = $Email;
                echo "<script>window.location.replace('index.php');</script>";
            } else {
                echo "<script>alert('Registiration failed.');</script>";
            }
        }
    }
}
?>