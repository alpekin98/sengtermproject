<?php
include 'header.php';

$id = $_SESSION["user_UserID"];

if ($_SESSION["user_Username"] == null) {
    echo "<script>
    window.location.replace('index.php')
    </script>";
}

if (isset($_POST['Username_']) && $_POST['Username_'] != '') {
    $username = $_POST['Username_'];
    $query = $conn->query("UPDATE users SET username='$username' WHERE user_id=$id", PDO::FETCH_ASSOC);
    $query->setFetchMode(PDO::FETCH_ASSOC);
}

if (isset($_POST['last_name']) && $_POST['last_name'] != '') {
    $lastname = $_POST['last_name'];
    $query = $conn->query("UPDATE users SET surname='$lastname' WHERE user_id=$id", PDO::FETCH_ASSOC);
    $query->setFetchMode(PDO::FETCH_ASSOC);
}

if (isset($_POST['first_name']) && $_POST['first_name'] != '') {
    $firstname = $_POST['first_name'];
    $query = $conn->query("UPDATE users SET firstname='$firstname' WHERE user_id=$id", PDO::FETCH_ASSOC);
    $query->setFetchMode(PDO::FETCH_ASSOC);
}

if (isset($_POST['email']) && $_POST['email'] != '') {
    $email = $_POST['email'];
    $query = $conn->query("UPDATE users SET email='$email' WHERE user_id=$id", PDO::FETCH_ASSOC);
    $query->setFetchMode(PDO::FETCH_ASSOC);
}

if (isset($_POST['Password_']) && $_POST['Password_'] != '') {
    $Password_ = $_POST['Password_'];
    $query = $conn->query("UPDATE users SET password_='$Password_' WHERE user_id=$id", PDO::FETCH_ASSOC);
    $query->setFetchMode(PDO::FETCH_ASSOC);
}

$query = $conn->query("SELECT * FROM users WHERE user_id='$id'", PDO::FETCH_ASSOC);
if ($count = $query->rowCount()) {
    if ($count > 0) {
        // Email and password match
        $sql = "SELECT user_id,firstname,surname,username,email,image_link
                FROM users WHERE user_id='$id'";
        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        while ($r = $q->fetch()) {
            $_SESSION["user_UserID"] = $r['user_id'];
            $_SESSION["user_Username"] = $r['username'];
            $_SESSION["user_Firstname"] = $r['firstname'];
            $_SESSION["user_Surname"] = $r['surname'];
            $_SESSION["user_Email"] = $r['email'];
            $_SESSION["image_link"] = $r['image_link'];
        }
    }
}

if (isset($_POST["submit"])) {
    $target_dir = "uploads/";
    $imagesize = 5000000;
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            //echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "<script>alert('Sorry, file already exists.');</script>";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > $imagesize) {
        echo "<script>alert('Sorry, your file is too large. Maximum ".($imagesize/1000000)." MB is allowed');</script>";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file was not uploaded.');</script>";
        
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            $query = $conn->query("UPDATE users SET image_link='$target_file ' WHERE user_id=$id", PDO::FETCH_ASSOC);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            echo ("<meta http-equiv='refresh' content='1'>");
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?><br>
<body>
    <div class="page-container">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="text-center">
                        <img src="<?php echo $_SESSION["image_link"]?>" class="avatar img-circle img-thumbnail" alt="avatar"> 
                        <form action="profile.php" method="post" enctype="multipart/form-data">
                    </div>
                    <div class="mtop20">
                        <div class="container">
                            <div class="row">
                                <div class="col text-center">
                                    <div class="btn-group btn-group-or" role="group">
                                        <button type="button" class="btn btn-secondary">
                                            <i class="fa fa-camera"></i>
                                            <input style="display:none;" type="file" name="fileToUpload" id="fileToUpload"/>
                                            <label for="fileToUpload" style=" margin-top: 7px; ">Choose Photo</label>
                                        </button>
                                        <div class="or"></div>
                                        <input type="submit" value="Upload Photo" class="btn btn-success" name="submit">
                                    </div>  
                                </div>    
                            </div>    
                        </div> 
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <form id="form1" name="form1" action="profile.php" method="post"><hr>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="first_name">
                                                <h4><p><strong>First name </strong></p></h4>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $_SESSION["user_Firstname"]; ?></p>
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-outline-warning" id="slideEditFirstName" type="button"> Edit</button>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="first_name">
                                                <p id="NewFirstName"><strong> New First Name </strong></p>
                                            </label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="first_name" id="first_name"  title="enter your first name if any.">
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-xs btn-warning pull-right" id="slideSaveFirstName" name ="slideSaveFirstName" type="submit">Save</button>
                                        </div>                        
                                    </div><hr> 
                                </div>                       
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-5">  
                                            <label for="last_name">
                                                <h4><p><strong>Last name </strong></p></h4>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php echo $_SESSION["user_Surname"]; ?>
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-outline-warning" id="slideEditLastName" type="button"> Edit</button>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="first_name">
                                                <p id="NewLastName"><strong> New Last Name </strong></p>
                                            </label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="last_name" id="last_name"  title="enter your last name if any.">
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-xs btn-warning pull-right" id="slideSaveLastName" name ="slideSaveLastName" type="submit">Save</button>
                                        </div>
                                    </div><hr>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-5"> 
                                            <label for="email">
                                                <h4><p><strong>Email </strong></p></h4>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php echo $_SESSION["user_Email"]; ?>
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-outline-warning" id="slideEditEmail" type="button">Edit</button>
                                        </div>  
                                        <div class="col-md-3">
                                            <label for="email">
                                                <p id="NewEmail"><strong> New Email </strong></p>
                                            </label>
                                        </div>  
                                        <div class="col-md-8">
                                            <input type="email" class="form-control" name="email" id="email"  title="enter your email.">  
                                        </div> 
                                        <div class="col-md-1">
                                            <button class="btn btn-xs btn-warning pull-right" id="slideSaveEmail" name ="slideSaveEmail" type="submit">Save</button>
                                        </div>
                                    </div><hr>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="Username">
                                                <h4><p><strong>Username </strong></p></h4>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php echo $_SESSION["user_Username"]; ?>
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-outline-warning" id="slideEditUsername" type="button">Edit</button>
                                        </div> 
                                        <div class="col-md-3">
                                            <label for="Username">
                                                <p id ="NewUserName"><strong> New Username </strong></p>
                                            </label>
                                        </div> 
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="Username_" id="Username_" title="enter your username.">
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-xs btn-warning pull-right" id="slideSaveUsername" name ="slideSaveUsername" type="submit">Save</button>
                                        </div>
                                    </div><hr>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label>
                                                <h4><p><strong>Password</strong></p></h4>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            *****
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-outline-warning" id="slideEditPassword" type="button"> Edit</button>
                                        </div> 
                                        <div class="col-md-3">
                                            <label for="Password">
                                                <p id="CurrentPass"><strong>New Password</strong></p>
                                            </label>
                                        </div> 
                                        <div class = "col-md-8">
                                            <input type="text" class="form-control" name="Password_" id="Password_" title="enter your password.">
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-xs btn-warning pull-right" id="slideSavePassword" name ="slideSavePassword" type="submit">Save</button>
                                        </div>
                                    </div><hr>
                                </div>
                            </from>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</body>
<script>
$(document).ready(function(){
    
    $("#first_name").toggle();
    $("#NewFirstName").toggle();
    $("#slideSaveFirstName").toggle();

    $("#NewLastName").toggle();
    $("#last_name").toggle();
    $("#slideSaveLastName").toggle();

    $("#NewEmail").toggle();
    $("#email").toggle();
    $("#slideSaveEmail").toggle();

    $("#NewUserName").toggle();
    $("#Username_").toggle();
    $("#slideSaveUsername").toggle();

    $("#CurrentPass").toggle();
    $("#Password_").toggle();
    $("#slideSavePassword").toggle();
    
    $("#slideEditFirstName").click(function(){
        $("#first_name").slideToggle("fast");
        $("#NewFirstName").slideToggle("fast");
        $("#slideSaveFirstName").slideToggle("fast");
    });

    $("#slideEditLastName").click(function(){
        $("#NewLastName").slideToggle("fast");
        $("#last_name").slideToggle("fast");
        $("#slideSaveLastName").slideToggle("fast");
    });

    $("#slideEditEmail").click(function(){
        $("#NewEmail").slideToggle("fast");
        $("#email").slideToggle("fast");
        $("#slideSaveEmail").slideToggle("fast");
    });

    $("#slideEditUsername").click(function(){
        $("#NewUserName").slideToggle("fast");
        $("#Username_").slideToggle("fast");
        $("#slideSaveUsername").slideToggle("fast");
    });

    $("#slideEditPassword").click(function(){
        $("#CurrentPass").slideToggle("fast");
        $("#Password_").slideToggle("fast");
        $("#slideSavePassword").slideToggle("fast");
    });
});
</script> 

